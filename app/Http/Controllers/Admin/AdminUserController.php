<?php

namespace App\Http\Controllers\Admin;

use App\Exports\UsersExport;
use App\Exports\UsersSelectedExport;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Throwable;

class AdminUserController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Display users
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $validated = $request->validate([
            'search' => [
                'nullable',
                'string',
                'max:100',
            ],
            'per_page' => [
                'nullable',
                'integer',
                Rule::in([10, 20, 50, 100]),
            ],
        ]);

        $perPage = (int) ($validated['per_page'] ?? 20);
        $search = trim($validated['search'] ?? '');

        $users = User::query()
            ->with('statusChangedBy')
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($subQuery) use ($search) {
                    $subQuery
                        ->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%")
                        ->orWhere('qalam_id', 'like', "%{$search}%")
                        ->orWhere('role', 'like', "%{$search}%")
                        ->orWhere(
                            'account_status',
                            'like',
                            "%{$search}%"
                        );
                });
            })
            ->latest()
            ->paginate($perPage)
            ->withQueryString();

        return view('pages.admin.users.index', compact(
            'users',
            'perPage',
            'search'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | Display create-user form
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view('pages.admin.users.create');
    }

    /*
    |--------------------------------------------------------------------------
    | Store new user
    |--------------------------------------------------------------------------
    */

    public function store(Request $request): RedirectResponse
    {
        $this->ensureCurrentUserIsAdmin();

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email'),
            ],
            'phone' => [
                'nullable',
                'string',
                'max:20',
            ],
            'qalam_id' => [
                'nullable',
                'string',
                'max:100',
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
            'role' => [
                'required',
                Rule::in([
                    'admin',
                    'donor',
                    'beneficiary',
                ]),
            ],
            'image' => [
                'nullable',
                'file',
                'image',
                'mimes:jpg,jpeg,png',
                'max:2048',
            ],
        ], [
            'email.unique' =>
            'A user with this email address already exists.',

            'password.confirmed' =>
            'The password confirmation does not match.',

            'image.max' =>
            'The profile image cannot exceed 2 MB.',

            'image.mimes' =>
            'The profile image must be a JPG, JPEG or PNG file.',

            'role.in' =>
            'Please select a valid user role.',
        ]);

        $imageName = null;

        try {
            if ($request->hasFile('image')) {
                $imageName = $this->uploadProfileImage(
                    $request->file('image')
                );
            }

            User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'] ?? null,
                'qalam_id' => $validated['qalam_id'] ?? null,
                'password' => Hash::make($validated['password']),
                'role' => $validated['role'],
                'image' => $imageName,

                // New account-status fields
                'account_status' => 'active',
                'status_reason' => null,
                'status_changed_at' => now(),
                'status_changed_by' => auth()->id(),
            ]);

            return redirect()
                ->route('admin.user.index')
                ->with(
                    'success',
                    'User created successfully.'
                );
        } catch (Throwable $exception) {
            if ($imageName) {
                $this->deleteProfileImage($imageName);
            }

            report($exception);

            return back()
                ->withInput()
                ->with(
                    'error',
                    'The user could not be created. Please try again.'
                );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Display edit-user form
    |--------------------------------------------------------------------------
    */

    public function edit(int $id)
    {
        $user = User::findOrFail($id);

        return view(
            'pages.admin.users.edit',
            compact('user')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Update basic user information
    |--------------------------------------------------------------------------
    |
    | Account status is intentionally not changed here. It is handled by the
    | updateAccountStatus() method so that only administrators can change it.
    |
    */

    public function update(
        Request $request,
        int $id
    ): RedirectResponse {
        $this->ensureCurrentUserIsAdmin();

        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'phone' => [
                'nullable',
                'string',
                'max:20',
            ],
            'qalam_id' => [
                'nullable',
                'string',
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
            'password' => [
                'nullable',
                'string',
                'min:8',
                'confirmed',
            ],
            'image' => [
                'nullable',
                'file',
                'image',
                'mimes:jpg,jpeg,png',
                'max:2048',
            ],
        ], [
            'email.unique' =>
            'A user with this email address already exists.',

            'password.confirmed' =>
            'The password confirmation does not match.',

            'image.max' =>
            'The profile image cannot exceed 2 MB.',

            'role.in' =>
            'Please select a valid user role.',
        ]);

        /*
        | Prevent the currently logged-in administrator from removing
        | their own administrator role.
        */

        if (
            $user->id === auth()->id()
            && $validated['role'] !== 'admin'
        ) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'You cannot remove your own administrator role.'
                );
        }

        $newImageName = null;
        $oldImageName = $user->image;

        try {
            if ($request->hasFile('image')) {
                $newImageName = $this->uploadProfileImage(
                    $request->file('image')
                );
            }

            DB::transaction(function () use (
                $user,
                $validated,
                $newImageName
            ) {
                $user->name = $validated['name'];
                $user->email = $validated['email'];
                $user->phone = $validated['phone'] ?? null;
                $user->qalam_id = $validated['qalam_id'] ?? null;
                $user->role = $validated['role'];

                if ($newImageName) {
                    $user->image = $newImageName;
                }

                if (! empty($validated['password'])) {
                    $user->password = Hash::make(
                        $validated['password']
                    );
                }

                $user->save();
            });

            if ($newImageName && $oldImageName) {
                $this->deleteProfileImage($oldImageName);
            }

            return redirect()
                ->route('admin.user.index')
                ->with(
                    'success',
                    'User updated successfully.'
                );
        } catch (Throwable $exception) {
            if ($newImageName) {
                $this->deleteProfileImage($newImageName);
            }

            report($exception);

            return back()
                ->withInput()
                ->with(
                    'error',
                    'The user could not be updated. Please try again.'
                );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Update account status
    |--------------------------------------------------------------------------
    |
    | Only an administrator can activate, suspend or block an account.
    |
    */

    public function updateAccountStatus(
        Request $request,
        User $user
    ): RedirectResponse {
        $this->ensureCurrentUserIsAdmin();

        /*
        | Prevent an administrator from blocking or suspending themselves.
        */

        if ($user->id === auth()->id()) {
            return back()->with(
                'error',
                'You cannot change your own account status.'
            );
        }

        /*
        | Prevent changing another administrator's account status.
        | Remove this condition only if administrators should manage each other.
        */

        if ($user->isAdmin()) {
            return back()->with(
                'error',
                'Another administrator account cannot be suspended or blocked.'
            );
        }

        $validated = $request->validate([
            'account_status' => [
                'required',
                Rule::in([
                    'active',
                    'suspended',
                    'blocked',
                ]),
            ],
            'status_reason' => [
                Rule::requiredIf(function () use ($request) {
                    return in_array(
                        $request->input('account_status'),
                        ['suspended', 'blocked'],
                        true
                    );
                }),
                'nullable',
                'string',
                'max:1000',
            ],
        ], [
            'account_status.required' =>
            'Please select an account status.',

            'account_status.in' =>
            'The selected account status is invalid.',

            'status_reason.required' =>
            'A reason is required when suspending or blocking a user.',

            'status_reason.max' =>
            'The status reason cannot exceed 1000 characters.',
        ]);

        try {
            DB::transaction(function () use ($user, $validated) {
                $newStatus = $validated['account_status'];

                $user->update([
                    'account_status' => $newStatus,

                    'status_reason' => $newStatus === 'active'
                        ? null
                        : trim($validated['status_reason']),

                    'status_changed_at' => now(),

                    'status_changed_by' => auth()->id(),
                ]);

                /*
                | Delete existing database sessions to log the user out
                | immediately after suspension or blocking.
                */

                if (
                    in_array(
                        $newStatus,
                        ['suspended', 'blocked'],
                        true
                    )
                    && config('session.driver') === 'database'
                    && Schema::hasTable('sessions')
                ) {
                    DB::table('sessions')
                        ->where('user_id', $user->id)
                        ->delete();
                }
            });

            $message = match ($validated['account_status']) {
                'active' =>
                "{$user->name}'s account has been activated.",

                'suspended' =>
                "{$user->name}'s account has been suspended.",

                'blocked' =>
                "{$user->name}'s account has been blocked.",
            };

            return back()->with('success', $message);
        } catch (Throwable $exception) {
            report($exception);

            return back()->with(
                'error',
                'The account status could not be updated.'
            );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Delete one user
    |--------------------------------------------------------------------------
    */

    public function destroy(int $id): RedirectResponse
    {
        $this->ensureCurrentUserIsAdmin();

        $user = User::findOrFail($id);

        if ($user->id === auth()->id()) {
            return back()->with(
                'error',
                'You cannot delete your own account.'
            );
        }

        if ($user->isAdmin()) {
            return back()->with(
                'error',
                'Another administrator account cannot be deleted.'
            );
        }

        $imageName = $user->image;

        try {
            DB::transaction(function () use ($user) {
                $user->delete();
            });

            if ($imageName) {
                $this->deleteProfileImage($imageName);
            }

            return redirect()
                ->route('admin.user.index')
                ->with(
                    'success',
                    'User deleted successfully.'
                );
        } catch (Throwable $exception) {
            report($exception);

            return back()->with(
                'error',
                'The user could not be deleted.'
            );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Delete selected users
    |--------------------------------------------------------------------------
    */

    public function deleteSelected(
        Request $request
    ): RedirectResponse {
        $this->ensureCurrentUserIsAdmin();

        $validated = $request->validate([
            'ids' => [
                'required',
                'array',
                'min:1',
            ],
            'ids.*' => [
                'required',
                'integer',
                'distinct',
                'exists:users,id',
            ],
        ], [
            'ids.required' =>
            'Please select at least one user.',

            'ids.min' =>
            'Please select at least one user.',

            'ids.*.exists' =>
            'One of the selected users does not exist.',
        ]);

        $userIds = collect($validated['ids'])
            ->map(fn($id) => (int) $id)
            ->unique()
            ->values();

        /*
        | Never delete the currently authenticated administrator.
        */

        if ($userIds->contains(auth()->id())) {
            return back()->with(
                'error',
                'You cannot delete your own account.'
            );
        }

        /*
        | Prevent bulk deletion of administrator accounts.
        */

        $containsAdministrator = User::query()
            ->whereIn('id', $userIds)
            ->where('role', 'admin')
            ->exists();

        if ($containsAdministrator) {
            return back()->with(
                'error',
                'Administrator accounts cannot be deleted in bulk.'
            );
        }

        $users = User::query()
            ->whereIn('id', $userIds)
            ->get();

        $imageNames = $users
            ->pluck('image')
            ->filter()
            ->values();

        try {
            DB::transaction(function () use ($userIds) {
                User::query()
                    ->whereIn('id', $userIds)
                    ->delete();
            });

            foreach ($imageNames as $imageName) {
                $this->deleteProfileImage($imageName);
            }

            return back()->with(
                'success',
                'Selected users deleted successfully.'
            );
        } catch (Throwable $exception) {
            report($exception);

            return back()->with(
                'error',
                'The selected users could not be deleted.'
            );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Import users
    |--------------------------------------------------------------------------
    */

     private const SESSION_KEY = 'pending_user_import';

    public function preview(Request $request): RedirectResponse
    {
        $request->validate([
            'file' => ['required', 'file', 'mimes:xlsx,xls,csv', 'max:5120'],
        ]);

        try {
            $sheets = Excel::toCollection(null, $request->file('file'));
            $sheet = $sheets->first();
        } catch (\Throwable $exception) {
            report($exception);

            return back()->withErrors([
                'file' => 'The spreadsheet could not be read. Please use a valid XLSX, XLS, or CSV file.',
            ]);
        }

        if (! $sheet || $sheet->isEmpty()) {
            return back()->withErrors(['file' => 'The selected spreadsheet is empty.']);
        }

        $headings = collect($sheet->first())
            ->map(fn ($heading) => Str::of((string) $heading)->trim()->lower()->replace(' ', '_')->value())
            ->all();

        foreach (['name', 'email', 'phone', 'password', 'role', 'qalam_id', 'account_status', 'status_reason'] as $requiredHeading) {
            if (! in_array($requiredHeading, $headings, true)) {
                return back()->withErrors([
                    'file' => "Missing Excel heading: {$requiredHeading}.",
                ]);
            }
        }

        $cleanRows = [];
        $duplicates = [];
        $invalidRows = [];
        $seenEmails = [];
        $seenQalamIds = [];

        $dataRows = $sheet->slice(1)->values();

        foreach ($dataRows as $index => $row) {
            $excelRow = $index + 2;
            $row = collect($headings)->combine(collect($row)->pad(count($headings), null))->all();
            $data = $this->normalizeRow($row);

            if ($this->emptyRow($data)) {
                continue;
            }

            $validator = Validator::make($data, $this->rules());

            if ($validator->fails()) {
                $invalidRows[] = [
                    'row' => $excelRow,
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'errors' => $validator->errors()->all(),
                ];

                continue;
            }

            if ($data['role'] !== 'beneficiary') {
                $data['qalam_id'] = null;
            }

            $reasons = [];

            if (isset($seenEmails[$data['email']])) {
                $reasons[] = "Email duplicates Excel row {$seenEmails[$data['email']]}.";
            } elseif (User::where('email', $data['email'])->exists()) {
                $reasons[] = 'Email already exists in the users table.';
            }

            if ($data['qalam_id']) {
                if (isset($seenQalamIds[$data['qalam_id']])) {
                    $reasons[] = "Qalam ID duplicates Excel row {$seenQalamIds[$data['qalam_id']]}.";
                } elseif (User::where('qalam_id', $data['qalam_id'])->exists()) {
                    $reasons[] = 'Qalam ID already exists in the users table.';
                }
            }

            if ($reasons !== []) {
                $duplicates[] = [
                    'row' => $excelRow,
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'qalam_id' => $data['qalam_id'],
                    'reasons' => $reasons,
                ];

                continue;
            }

            $seenEmails[$data['email']] = $excelRow;

            if ($data['qalam_id']) {
                $seenQalamIds[$data['qalam_id']] = $excelRow;
            }

            $cleanRows[] = $data;
        }

        $token = (string) Str::uuid();

        session()->put(self::SESSION_KEY, [
            'token' => $token,
            'rows' => $cleanRows,
            'created_at' => now()->timestamp,
        ]);

        return back()->with('import_preview', [
            'token' => $token,
            'total' => count($cleanRows) + count($duplicates) + count($invalidRows),
            'clean_count' => count($cleanRows),
            'duplicates' => $duplicates,
            'invalid' => $invalidRows,
        ]);
    }

    public function confirm(Request $request): RedirectResponse
    {
        $request->validate([
            'import_token' => ['required', 'uuid'],
        ]);

        $pendingImport = session(self::SESSION_KEY);

        if (! $pendingImport || ! hash_equals($pendingImport['token'], $request->string('import_token')->toString())) {
            return redirect()->route('admin.user.index')->withErrors([
                'file' => 'The import preview expired. Please upload the file again.',
            ]);
        }

        if (($pendingImport['created_at'] ?? 0) < now()->subMinutes(30)->timestamp) {
            session()->forget(self::SESSION_KEY);

            return redirect()->route('admin.user.index')->withErrors([
                'file' => 'The import preview expired after 30 minutes. Please upload the file again.',
            ]);
        }

        $inserted = 0;
        $raceDuplicates = 0;

        DB::transaction(function () use ($pendingImport, &$inserted, &$raceDuplicates): void {
            foreach ($pendingImport['rows'] as $data) {
                $duplicateExists = User::query()
                    ->where('email', $data['email'])
                    ->when(
                        filled($data['qalam_id']),
                        fn ($query) => $query->orWhere('qalam_id', $data['qalam_id'])
                    )
                    ->lockForUpdate()
                    ->exists();

                if ($duplicateExists) {
                    $raceDuplicates++;
                    continue;
                }

                User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                    'password' => $data['password'] ?: Str::password(12),
                    'image' => null,
                    'role' => $data['role'],
                    'qalam_id' => $data['qalam_id'],
                    'account_status' => $data['account_status'],
                    'status_reason' => $data['status_reason'],
                    'status_changed_at' => $data['account_status'] === 'active' ? null : now(),
                    'status_changed_by' => auth()->id(),
                ]);

                $inserted++;
            }
        });

        session()->forget(self::SESSION_KEY);

        $message = "{$inserted} users imported successfully.";

        if ($raceDuplicates > 0) {
            $message .= " {$raceDuplicates} newly detected duplicate rows were skipped.";
        }

        return redirect()->route('admin.user.index')->with('success', $message);
    }

    public function cancel(): RedirectResponse
    {
        session()->forget(self::SESSION_KEY);

        return redirect()->route('admin.user.index')->with('info', 'User import was cancelled.');
    }

    private function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email:rfc', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30', 'regex:/^[0-9+\-\s()]+$/'],
            'password' => ['nullable', 'string', 'min:8', 'max:100'],
            'role' => ['required', Rule::in(['admin', 'donor', 'beneficiary'])],
            'qalam_id' => ['required_if:role,beneficiary', 'nullable', 'string', 'max:100'],
            'account_status' => ['required', Rule::in(['active', 'suspended', 'blocked'])],
            'status_reason' => ['nullable', 'string', 'max:1000'],
        ];
    }

    private function normalizeRow(array $row): array
    {
        $value = fn (string $key) => filled($row[$key] ?? null) ? trim((string) $row[$key]) : null;

        return [
            'name' => $value('name'),
            'email' => $value('email') ? Str::lower($value('email')) : null,
            'phone' => $value('phone'),
            'password' => $value('password'),
            'role' => Str::lower($value('role') ?: 'beneficiary'),
            'qalam_id' => $value('qalam_id') ? Str::upper($value('qalam_id')) : null,
            'account_status' => Str::lower($value('account_status') ?: 'active'),
            'status_reason' => $value('status_reason'),
        ];
    }

    private function emptyRow(array $data): bool
    {
        return blank($data['name']) && blank($data['email']) && blank($data['phone'])
            && blank($data['password']) && blank($data['qalam_id']) && blank($data['status_reason']);
    }




    /*
    |--------------------------------------------------------------------------
    | Export all users
    |--------------------------------------------------------------------------
    */

    public function exportUsers(): BinaryFileResponse
    {
        $this->ensureCurrentUserIsAdmin();

        return Excel::download(
            new UsersExport(),
            'users.xlsx'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Export selected users
    |--------------------------------------------------------------------------
    */

    public function exportSelected(
        Request $request
    ): BinaryFileResponse|RedirectResponse {
        $this->ensureCurrentUserIsAdmin();

        $validated = $request->validate([
            'ids' => [
                'required',
                'array',
                'min:1',
            ],
            'ids.*' => [
                'required',
                'integer',
                'distinct',
                'exists:users,id',
            ],
        ], [
            'ids.required' =>
            'Please select at least one user.',

            'ids.min' =>
            'Please select at least one user.',
        ]);

        return Excel::download(
            new UsersSelectedExport($validated['ids']),
            'selected_users.xlsx'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Confirm current user is an administrator
    |--------------------------------------------------------------------------
    */

    private function ensureCurrentUserIsAdmin(): void
    {
        abort_unless(
            auth()->check()
                && auth()->user()->isAdmin(),
            403,
            'Only administrators can perform this action.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Upload profile image
    |--------------------------------------------------------------------------
    */

    private function uploadProfileImage(
        $image
    ): string {
        $directory = public_path(
            'admins/asset/profilephoto'
        );

        if (! File::isDirectory($directory)) {
            File::makeDirectory(
                $directory,
                0755,
                true
            );
        }

        $extension = strtolower(
            $image->getClientOriginalExtension()
        );

        $imageName = Str::uuid()->toString()
            . '.'
            . $extension;

        $image->move(
            $directory,
            $imageName
        );

        return $imageName;
    }

    /*
    |--------------------------------------------------------------------------
    | Delete profile image
    |--------------------------------------------------------------------------
    */

    private function deleteProfileImage(
        ?string $imageName
    ): void {
        if (! $imageName) {
            return;
        }

        /*
        | basename prevents directory traversal through a manipulated filename.
        */

        $safeImageName = basename($imageName);

        $imagePath = public_path(
            'admins/asset/profilephoto/'
                . $safeImageName
        );

        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }
    }
}
