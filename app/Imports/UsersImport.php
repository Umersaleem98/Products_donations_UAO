<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToCollection, WithHeadingRow, SkipsEmptyRows
{
    /*
    |--------------------------------------------------------------------------
    | Import results
    |--------------------------------------------------------------------------
    */

    private int $importedCount = 0;
    private int $updatedCount = 0;
    private int $skippedCount = 0;

    private array $duplicates = [];
    private array $failures = [];

    /*
    |--------------------------------------------------------------------------
    | Adjustable import settings
    |--------------------------------------------------------------------------
    */

    public function __construct(
        private readonly bool $updateExisting = false,
        private readonly ?int $importedBy = null
    ) {
    }

    /*
    |--------------------------------------------------------------------------
    | Import collection
    |--------------------------------------------------------------------------
    */

    public function collection(Collection $rows): void
    {
        foreach ($rows as $index => $row) {
            /*
             * Because row 1 contains headings, actual Excel data begins
             * from row number 2.
             */
            $rowNumber = $index + 2;

            $data = $this->prepareRow($row);

            if ($this->isCompletelyEmpty($data)) {
                $this->skippedCount++;
                continue;
            }

            $validator = Validator::make(
                $data,
                $this->rules($data),
                $this->messages()
            );

            if ($validator->fails()) {
                $this->addFailure(
                    $rowNumber,
                    $data,
                    $validator->errors()->all()
                );

                continue;
            }

            /*
             * Qalam ID is only applicable to beneficiaries.
             */
            if ($data['role'] !== 'beneficiary') {
                $data['qalam_id'] = null;
            }

            $existingUser = User::query()
                ->where('email', $data['email'])
                ->first();

            if ($existingUser && ! $this->updateExisting) {
                $this->duplicates[] = [
                    'row' => $rowNumber,
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'reason' => 'A user with this email already exists.',
                ];

                $this->skippedCount++;
                continue;
            }

            try {
                DB::transaction(function () use (
                    $existingUser,
                    $data
                ): void {
                    if ($existingUser) {
                        $this->updateUser($existingUser, $data);
                        $this->updatedCount++;

                        return;
                    }

                    $this->createUser($data);
                    $this->importedCount++;
                });
            } catch (\Throwable $exception) {
                report($exception);

                $this->addFailure(
                    $rowNumber,
                    $data,
                    [
                        'The row could not be imported because of a database error.',
                    ]
                );
            }
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Prepare one Excel row
    |--------------------------------------------------------------------------
    */

    private function prepareRow(Collection $row): array
    {
        $role = $this->nullableString($row->get('role'));

        $accountStatus = $this->nullableString(
            $row->get('account_status')
        );

        return [
            'name' => $this->nullableString($row->get('name')),

            'email' => $this->normalizeEmail(
                $row->get('email')
            ),

            'phone' => $this->normalizePhone(
                $row->get('phone')
            ),

            'password' => $this->nullableString(
                $row->get('password')
            ),

            /*
             * Change these defaults to null if your database columns
             * are nullable and you do not want default values.
             */
            'role' => $role
                ? strtolower($role)
                : 'beneficiary',

            'qalam_id' => $this->nullableString(
                $row->get('qalam_id')
            ),

            'account_status' => $accountStatus
                ? strtolower($accountStatus)
                : 'active',

            'status_reason' => $this->nullableString(
                $row->get('status_reason')
            ),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Validation
    |--------------------------------------------------------------------------
    */

    private function rules(array $data): array
    {
        $emailRules = [
            'required',
            'email:rfc',
            'max:255',
        ];

        /*
         * A new email must be unique. When update mode is enabled,
         * the existing record with the same email is allowed.
         */
        if (! $this->updateExisting) {
            $emailRules[] = Rule::unique('users', 'email');
        }

        $qalamRules = [
            'nullable',
            'string',
            'max:100',
        ];

        if ($data['role'] === 'beneficiary') {
            /*
             * Remove "required" below if beneficiary Qalam ID
             * is optional in your application.
             */
            $qalamRules[] = 'required';

            $existingUser = ! empty($data['email'])
                ? User::where('email', $data['email'])->first()
                : null;

            $uniqueQalamId = Rule::unique(
                'users',
                'qalam_id'
            );

            if ($existingUser && $this->updateExisting) {
                $uniqueQalamId->ignore($existingUser->id);
            }

            $qalamRules[] = $uniqueQalamId;
        }

        return [
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => $emailRules,

            'phone' => [
                'nullable',
                'string',
                'max:30',
                'regex:/^[0-9+\-\s()]+$/',
            ],

            /*
             * Password is optional in the sheet. A secure generated
             * password will be used for new users when it is empty.
             */
            'password' => [
                'nullable',
                'string',
                'min:8',
                'max:100',
            ],

            'role' => [
                'required',
                Rule::in([
                    'admin',
                    'donor',
                    'beneficiary',
                ]),
            ],

            'qalam_id' => $qalamRules,

            'account_status' => [
                'required',
                Rule::in([
                    'active',
                    'suspended',
                    'blocked',
                ]),
            ],

            'status_reason' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ];
    }

    private function messages(): array
    {
        return [
            'name.required' => 'The user name is required.',
            'email.required' => 'The email address is required.',
            'email.email' => 'The email address is invalid.',
            'email.unique' => 'The email address already exists.',
            'password.min' => 'The password must contain at least 8 characters.',
            'role.in' => 'Role must be admin, donor, or beneficiary.',
            'qalam_id.required' => 'Qalam ID is required for beneficiaries.',
            'qalam_id.unique' => 'The Qalam ID already exists.',
            'account_status.in' => 'Account status must be active, suspended, or blocked.',
            'phone.regex' => 'The phone number contains invalid characters.',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Create user
    |--------------------------------------------------------------------------
    */

    private function createUser(array $data): User
    {
        /*
         * The User model has a "hashed" password cast, so assigning
         * a plain password here stores it as a secure hash.
         *
         * A random password is used when the Excel password is empty.
         */
        $password = $data['password'] ?: Str::password(12);

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => $password,
            'image' => null,
            'role' => $data['role'],
            'qalam_id' => $data['qalam_id'],
            'account_status' => $data['account_status'],
            'status_reason' => $data['status_reason'],

            'status_changed_at' => $data['account_status'] !== 'active'
                ? now()
                : null,

            'status_changed_by' => $this->importedBy,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Update existing user
    |--------------------------------------------------------------------------
    */

    private function updateUser(User $user, array $data): void
    {
        $updateData = [
            'name' => $data['name'],
            'phone' => $data['phone'],
            'role' => $data['role'],
            'qalam_id' => $data['qalam_id'],
            'account_status' => $data['account_status'],
            'status_reason' => $data['status_reason'],
            'status_changed_by' => $this->importedBy,
            'status_changed_at' => now(),
        ];

        /*
         * Keep the existing password when the Excel password is empty.
         */
        if (! empty($data['password'])) {
            $updateData['password'] = $data['password'];
        }

        $user->update($updateData);
    }

    /*
    |--------------------------------------------------------------------------
    | Normalization helpers
    |--------------------------------------------------------------------------
    */

    private function nullableString(mixed $value): ?string
    {
        if ($value === null) {
            return null;
        }

        $value = trim((string) $value);

        return $value === '' ? null : $value;
    }

    private function normalizeEmail(mixed $value): ?string
    {
        $email = $this->nullableString($value);

        return $email ? strtolower($email) : null;
    }

    private function normalizePhone(mixed $value): ?string
    {
        $phone = $this->nullableString($value);

        if ($phone === null) {
            return null;
        }

        /*
         * Excel sometimes changes numeric values to decimal strings.
         */
        if (preg_match('/^\d+\.0$/', $phone)) {
            $phone = strstr($phone, '.', true);
        }

        return $phone;
    }

    private function isCompletelyEmpty(array $data): bool
    {
        return empty($data['name'])
            && empty($data['email'])
            && empty($data['phone'])
            && empty($data['password'])
            && empty($data['qalam_id'])
            && empty($data['status_reason']);
    }

    private function addFailure(
        int $rowNumber,
        array $data,
        array $errors
    ): void {
        $this->failures[] = [
            'row' => $rowNumber,
            'name' => $data['name'] ?? null,
            'email' => $data['email'] ?? null,
            'errors' => $errors,
        ];

        $this->skippedCount++;
    }

    /*
    |--------------------------------------------------------------------------
    | Import result getters
    |--------------------------------------------------------------------------
    */

    public function getImportedCount(): int
    {
        return $this->importedCount;
    }

    public function getUpdatedCount(): int
    {
        return $this->updatedCount;
    }

    public function getSkippedCount(): int
    {
        return $this->skippedCount;
    }

    public function getDuplicates(): array
    {
        return $this->duplicates;
    }

    public function getFailures(): array
    {
        return $this->failures;
    }

    public function getResults(): array
    {
        return [
            'imported' => $this->importedCount,
            'updated' => $this->updatedCount,
            'skipped' => $this->skippedCount,
            'duplicates' => $this->duplicates,
            'failures' => $this->failures,
        ];
    }
}
