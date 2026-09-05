<?php

namespace App\Http\Controllers\Admin;

use App\Exports\UsersExport;
use App\Exports\UsersSelectedExport;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
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

        'role' => [
            'nullable',
            Rule::in([
                'admin',
                'donor',
                'beneficiary',
            ]),
        ],

        'status' => [
            'nullable',
            Rule::in([
                'active',
                'suspended',
                'blocked',
            ]),
        ],
    ]);

    $perPage = (int) ($validated['per_page'] ?? 20);

    $search = trim(
        $validated['search'] ?? ''
    );

    $role = $validated['role'] ?? null;

    $status = $validated['status'] ?? null;


    /*
    |--------------------------------------------------------------------------
    | User Query
    |--------------------------------------------------------------------------
    */

    $users = User::query()

        ->with([
            'statusChangedBy',
            'beneficiaryProfile',
            'donorProfile',
        ])

        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */

        ->when(
            $search !== '',
            function ($query) use ($search) {

                $query->where(
                    function ($subQuery) use ($search) {

                        $subQuery
                            ->where(
                                'name',
                                'like',
                                "%{$search}%"
                            )

                            ->orWhere(
                                'email',
                                'like',
                                "%{$search}%"
                            )

                            ->orWhere(
                                'phone',
                                'like',
                                "%{$search}%"
                            )

                            ->orWhere(
                                'qalam_id',
                                'like',
                                "%{$search}%"
                            )

                            ->orWhere(
                                'role',
                                'like',
                                "%{$search}%"
                            )

                            ->orWhere(
                                'account_status',
                                'like',
                                "%{$search}%"
                            );
                    }
                );
            }
        )


        /*
        |--------------------------------------------------------------------------
        | Role Filter
        |--------------------------------------------------------------------------
        */

        ->when(
            $role,
            fn ($query) =>
            $query->where(
                'role',
                $role
            )
        )


        /*
        |--------------------------------------------------------------------------
        | Account Status Filter
        |--------------------------------------------------------------------------
        */

        ->when(
            $status,
            fn ($query) =>
            $query->where(
                'account_status',
                $status
            )
        )


        ->latest()

        ->paginate($perPage)

        ->withQueryString();


    /*
    |--------------------------------------------------------------------------
    | Tab Counts
    |--------------------------------------------------------------------------
    */

    $roleCounts = [

        'all' =>
            User::count(),

        'beneficiary' =>
            User::where(
                'role',
                'beneficiary'
            )->count(),

        'donor' =>
            User::where(
                'role',
                'donor'
            )->count(),

        'admin' =>
            User::where(
                'role',
                'admin'
            )->count(),
    ];


    /*
    |--------------------------------------------------------------------------
    | Status Counts
    |--------------------------------------------------------------------------
    */

    $statusCounts = [

        'all' =>
            User::count(),

        'active' =>
            User::where(
                'account_status',
                'active'
            )->count(),

        'suspended' =>
            User::where(
                'account_status',
                'suspended'
            )->count(),

        'blocked' =>
            User::where(
                'account_status',
                'blocked'
            )->count(),
    ];


    return view(
        'pages.admin.users.index',
        compact(
            'users',
            'perPage',
            'search',
            'role',
            'status',
            'roleCounts',
            'statusCounts'
        )
    );
}


    /*
    |--------------------------------------------------------------------------
    | Create User Page
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view('pages.admin.users.create');
    }


    /*
    |--------------------------------------------------------------------------
    | Store User
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
                'required_if:role,beneficiary',
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
                'mimes:jpg,jpeg,png,webp',
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
                'The profile image must be a JPG, JPEG, PNG or WebP file.',

            'role.in' =>
                'Please select a valid user role.',

            'qalam_id.required_if' =>
                'Qalam ID is required for beneficiary users.',
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

                'qalam_id' =>
                    $validated['role'] === 'beneficiary'
                        ? ($validated['qalam_id'] ?? null)
                        : null,

                'password' =>
                    Hash::make($validated['password']),

                'role' =>
                    $validated['role'],

                'image' =>
                    $imageName,

                'account_status' =>
                    'active',

                'status_reason' =>
                    null,

                'status_changed_at' =>
                    now(),

                'status_changed_by' =>
                    auth()->id(),
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
    | Edit User
    |--------------------------------------------------------------------------
    */

    public function edit(int $id)
    {
        $user = User::with([
            'beneficiaryProfile',
        ])->findOrFail($id);

        return view(
            'pages.admin.users.edit',
            compact('user')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Update User
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        int $id
    ): RedirectResponse {

        $this->ensureCurrentUserIsAdmin();

        $user = User::with('beneficiaryProfile')
            ->findOrFail($id);


        /*
        |--------------------------------------------------------------------------
        | Validation
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            /*
            |--------------------------------------------------------------------------
            | User Data
            |--------------------------------------------------------------------------
            */

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')
                    ->ignore($user->id),
            ],

            'phone' => [
                'nullable',
                'string',
                'max:20',
            ],

            'role' => [
                'required',
                Rule::in([
                    'admin',
                    'donor',
                    'beneficiary',
                ]),
            ],

            'qalam_id' => [
                'required_if:role,beneficiary',
                'nullable',
                'string',
                'max:100',
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
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],


            /*
            |--------------------------------------------------------------------------
            | Beneficiary Personal Information
            |--------------------------------------------------------------------------
            */

            'gender' => [
                'required_if:role,beneficiary',
                'nullable',
                Rule::in([
                    'male',
                    'female',
                    'other',
                ]),
            ],


            /*
            |--------------------------------------------------------------------------
            | Beneficiary Academic Information
            |--------------------------------------------------------------------------
            */

            'institution' => [
                'required_if:role,beneficiary',
                'nullable',
                'string',
                'max:255',
            ],

            'degree_level' => [
                'required_if:role,beneficiary',
                'nullable',
                Rule::in([
                    'UG',
                    'PG',
                    'PhD',
                ]),
            ],

            'degree_program' => [
                'nullable',
                'string',
                'max:255',
            ],

            'department' => [
                'nullable',
                'string',
                'max:255',
            ],

            'semester' => [
                'nullable',
                'string',
                'max:50',
            ],

            'cgpa' => [
                'nullable',
                'numeric',
                'min:0',
                'max:4',
            ],

            'enrollment_year' => [
                'required_if:role,beneficiary',
                'nullable',
                'integer',
                'min:2000',
                'max:2100',
            ],

            /*
             * graduation_year is calculated by server.
             * We don't rely on the value sent from browser.
             */
            'graduation_year' => [
                'nullable',
                'integer',
                'min:2000',
                'max:2100',
            ],


            /*
            |--------------------------------------------------------------------------
            | Beneficiary Family Information
            |--------------------------------------------------------------------------
            */

            'father_status' => [
                'required_if:role,beneficiary',
                'nullable',
                'string',
                'max:255',
            ],

            'guardian_profession' => [
                'nullable',
                'string',
                'max:255',
            ],

            'monthly_income' => [
                'nullable',
                'numeric',
                'min:0',
            ],


            /*
            |--------------------------------------------------------------------------
            | Beneficiary Location Information
            |--------------------------------------------------------------------------
            */

            'province' => [
                'required_if:role,beneficiary',
                'nullable',
                'string',
                'max:255',
            ],

            'domicile' => [
                'nullable',
                'string',
                'max:255',
            ],

            'home_address' => [
                'required_if:role,beneficiary',
                'nullable',
                'string',
                'max:1000',
            ],

        ], [

            'email.unique' =>
                'A user with this email address already exists.',

            'password.confirmed' =>
                'The password confirmation does not match.',

            'image.max' =>
                'The profile image cannot exceed 2 MB.',

            'image.mimes' =>
                'The profile image must be a JPG, JPEG, PNG or WebP file.',

            'role.in' =>
                'Please select a valid user role.',

            'qalam_id.required_if' =>
                'Qalam ID is required for beneficiary users.',

            'gender.required_if' =>
                'Gender is required for beneficiary users.',

            'institution.required_if' =>
                'Institution is required for beneficiary users.',

            'degree_level.required_if' =>
                'Degree level is required for beneficiary users.',

            'enrollment_year.required_if' =>
                'Enrollment year is required for beneficiary users.',

            'father_status.required_if' =>
                'Father status is required for beneficiary users.',

            'province.required_if' =>
                'Province is required for beneficiary users.',

            'home_address.required_if' =>
                'Home address is required for beneficiary users.',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Prevent Current Admin Removing Own Admin Role
        |--------------------------------------------------------------------------
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


        /*
        |--------------------------------------------------------------------------
        | Calculate Beneficiary Graduation Year
        |--------------------------------------------------------------------------
        */

        $graduationYear = null;

        if ($validated['role'] === 'beneficiary') {

            $degreeDuration = match (
                $validated['degree_level'] ?? null
            ) {
                'UG' => 4,
                'PG' => 2,
                'PhD' => 2,
                default => 0,
            };

            if (
                ! empty($validated['enrollment_year'])
                && $degreeDuration > 0
            ) {

                $graduationYear =
                    (int) $validated['enrollment_year']
                    + $degreeDuration;
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Image
        |--------------------------------------------------------------------------
        */

        $newImageName = null;

        $oldImageName =
            $user->image;


        try {

            if ($request->hasFile('image')) {

                $newImageName =
                    $this->uploadProfileImage(
                        $request->file('image')
                    );
            }


            DB::transaction(function () use (
                $user,
                $validated,
                $newImageName,
                $graduationYear
            ) {

                /*
                |--------------------------------------------------------------------------
                | Update User Account
                |--------------------------------------------------------------------------
                */

                $user->name =
                    $validated['name'];

                $user->email =
                    $validated['email'];

                $user->phone =
                    $validated['phone'] ?? null;

                $user->role =
                    $validated['role'];


                /*
                |--------------------------------------------------------------------------
                | Qalam ID
                |--------------------------------------------------------------------------
                |
                | Keep Qalam ID only for beneficiary.
                |
                */

                $user->qalam_id =
                    $validated['role'] === 'beneficiary'
                        ? ($validated['qalam_id'] ?? null)
                        : null;


                /*
                |--------------------------------------------------------------------------
                | Image
                |--------------------------------------------------------------------------
                */

                if ($newImageName) {
                    $user->image = $newImageName;
                }


                /*
                |--------------------------------------------------------------------------
                | Password
                |--------------------------------------------------------------------------
                */

                if (
                    ! empty($validated['password'])
                ) {

                    $user->password =
                        Hash::make(
                            $validated['password']
                        );
                }


                $user->save();


                /*
                |--------------------------------------------------------------------------
                | Beneficiary Profile
                |--------------------------------------------------------------------------
                */

                if (
                    $validated['role'] ===
                    'beneficiary'
                ) {

                    $user
                        ->beneficiaryProfile()
                        ->updateOrCreate(

                            [
                                'user_id' =>
                                    $user->id,
                            ],

                            [
                                /*
                                |--------------------------------------------------------------------------
                                | Personal
                                |--------------------------------------------------------------------------
                                */

                                'gender' =>
                                    $validated['gender']
                                    ?? null,


                                /*
                                |--------------------------------------------------------------------------
                                | Academic
                                |--------------------------------------------------------------------------
                                */

                                'institution' =>
                                    $validated['institution']
                                    ?? null,

                                'degree_level' =>
                                    $validated['degree_level']
                                    ?? null,

                                'degree_program' =>
                                    $validated['degree_program']
                                    ?? null,

                                'department' =>
                                    $validated['department']
                                    ?? null,

                                'semester' =>
                                    $validated['semester']
                                    ?? null,

                                'cgpa' =>
                                    $validated['cgpa']
                                    ?? null,

                                'enrollment_year' =>
                                    $validated['enrollment_year']
                                    ?? null,

                                'graduation_year' =>
                                    $graduationYear,


                                /*
                                |--------------------------------------------------------------------------
                                | Family
                                |--------------------------------------------------------------------------
                                */

                                'father_status' =>
                                    $validated['father_status']
                                    ?? null,

                                'guardian_profession' =>
                                    $validated['guardian_profession']
                                    ?? null,

                                'monthly_income' =>
                                    $validated['monthly_income']
                                    ?? null,


                                /*
                                |--------------------------------------------------------------------------
                                | Location
                                |--------------------------------------------------------------------------
                                */

                                'province' =>
                                    $validated['province']
                                    ?? null,

                                'domicile' =>
                                    $validated['domicile']
                                    ?? null,

                                'home_address' =>
                                    $validated['home_address']
                                    ?? null,
                            ]
                        );
                }

                /*
                |--------------------------------------------------------------------------
                | IMPORTANT
                |--------------------------------------------------------------------------
                |
                | If role changes from beneficiary to donor/admin,
                | beneficiary profile is NOT deleted.
                |
                | This prevents accidental loss of student records.
                |
                */

            });


            /*
            |--------------------------------------------------------------------------
            | Delete Previous Image
            |--------------------------------------------------------------------------
            */

            if (
                $newImageName
                && $oldImageName
            ) {

                $this->deleteProfileImage(
                    $oldImageName
                );
            }


            return redirect()
                ->route('admin.user.index')
                ->with(
                    'success',
                    'User updated successfully.'
                );

        } catch (Throwable $exception) {

            if ($newImageName) {
                $this->deleteProfileImage(
                    $newImageName
                );
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
    | Update Account Status
    |--------------------------------------------------------------------------
    */

    public function updateAccountStatus(
        Request $request,
        User $user
    ): RedirectResponse {

        $this->ensureCurrentUserIsAdmin();


        if ($user->id === auth()->id()) {

            return back()->with(
                'error',
                'You cannot change your own account status.'
            );
        }


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

                Rule::requiredIf(
                    function () use ($request) {

                        return in_array(
                            $request->input(
                                'account_status'
                            ),
                            [
                                'suspended',
                                'blocked',
                            ],
                            true
                        );
                    }
                ),

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

            DB::transaction(
                function () use (
                    $user,
                    $validated
                ) {

                    $newStatus =
                        $validated['account_status'];


                    $user->update([

                        'account_status' =>
                            $newStatus,

                        'status_reason' =>
                            $newStatus === 'active'
                                ? null
                                : trim(
                                    $validated[
                                        'status_reason'
                                    ]
                                ),

                        'status_changed_at' =>
                            now(),

                        'status_changed_by' =>
                            auth()->id(),
                    ]);


                    if (
                        in_array(
                            $newStatus,
                            [
                                'suspended',
                                'blocked',
                            ],
                            true
                        )
                        && config(
                            'session.driver'
                        ) === 'database'
                        && Schema::hasTable(
                            'sessions'
                        )
                    ) {

                        DB::table('sessions')
                            ->where(
                                'user_id',
                                $user->id
                            )
                            ->delete();
                    }
                }
            );


            $message =
                match (
                    $validated[
                        'account_status'
                    ]
                ) {

                    'active' =>
                        "{$user->name}'s account has been activated.",

                    'suspended' =>
                        "{$user->name}'s account has been suspended.",

                    'blocked' =>
                        "{$user->name}'s account has been blocked.",
                };


            return back()->with(
                'success',
                $message
            );

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
    | Delete User
    |--------------------------------------------------------------------------
    */

    public function destroy(
        int $id
    ): RedirectResponse {

        $this->ensureCurrentUserIsAdmin();

        $user =
            User::findOrFail($id);


        if (
            $user->id ===
            auth()->id()
        ) {

            return back()->with(
                'error',
                'You cannot delete your own account.'
            );
        }


        $imageName =
            $user->image;


        try {

            DB::transaction(
                function () use ($user): void {

                    $users =
                        collect([$user]);

                    $this->cleanupUserReferences(
                        $users
                    );

                    $user->delete();
                }
            );


            if ($imageName) {

                $this->deleteProfileImage(
                    $imageName
                );
            }


            return redirect()
                ->route(
                    'admin.user.index'
                )
                ->with(
                    'success',
                    'User deleted successfully.'
                );

        } catch (Throwable $exception) {

            report($exception);

            return back()->with(
                'error',
                'The user could not be deleted. Please check the Laravel log for a remaining related-record constraint.'
            );
        }
    }


    /*
    |--------------------------------------------------------------------------
    | Delete Selected
    |--------------------------------------------------------------------------
    */

    public function deleteSelected(
        Request $request
    ): RedirectResponse {

        $this->ensureCurrentUserIsAdmin();


        $validated =
            $request->validate([

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


        $requestedIds =
            collect($validated['ids'])
                ->map(
                    fn ($id) =>
                    (int) $id
                )
                ->unique()
                ->values();


        $userIds =
            $requestedIds
                ->reject(
                    fn (int $id) =>
                    $id === auth()->id()
                )
                ->values();


        if ($userIds->isEmpty()) {

            return back()->with(
                'error',
                'No deletable users were selected. Your own account cannot be deleted.'
            );
        }


        $users =
            User::query()
                ->whereIn(
                    'id',
                    $userIds
                )
                ->get();


        if ($users->isEmpty()) {

            return back()->with(
                'error',
                'No matching users were found to delete.'
            );
        }


        $imageNames =
            $users
                ->pluck('image')
                ->filter()
                ->values();


        $deletedCount =
            $users->count();


        $skippedOwnAccount =
            $requestedIds
                ->contains(
                    auth()->id()
                );


        try {

            DB::transaction(
                function () use ($users): void {

                    $this
                        ->cleanupUserReferences(
                            $users
                        );

                    foreach ($users as $user) {
                        $user->delete();
                    }
                }
            );


            foreach (
                $imageNames as $imageName
            ) {

                $this->deleteProfileImage(
                    $imageName
                );
            }


            $message =
                "{$deletedCount} user(s) deleted successfully.";


            if ($skippedOwnAccount) {

                $message .=
                    ' Your own account was skipped.';
            }


            return redirect()
                ->route(
                    'admin.user.index'
                )
                ->with(
                    'success',
                    $message
                );

        } catch (Throwable $exception) {

            report($exception);

            return back()->with(
                'error',
                'The selected users could not be deleted. Please check the Laravel log for a remaining related-record constraint.'
            );
        }
    }


    /*
    |--------------------------------------------------------------------------
    | Clean References
    |--------------------------------------------------------------------------
    */

    private function cleanupUserReferences(
        Collection $users
    ): void {

        $userIds =
            $users
                ->pluck('id')
                ->map(
                    fn ($id) =>
                    (int) $id
                )
                ->unique()
                ->values();


        if ($userIds->isEmpty()) {
            return;
        }


        /*
        |--------------------------------------------------------------------------
        | Sessions
        |--------------------------------------------------------------------------
        */

        if (
            Schema::hasTable('sessions')
            && Schema::hasColumn(
                'sessions',
                'user_id'
            )
        ) {

            DB::table('sessions')
                ->whereIn(
                    'user_id',
                    $userIds
                )
                ->delete();
        }


        /*
        |--------------------------------------------------------------------------
        | Status Changed By
        |--------------------------------------------------------------------------
        */

        if (
            Schema::hasColumn(
                'users',
                'status_changed_by'
            )
        ) {

            User::query()
                ->whereIn(
                    'status_changed_by',
                    $userIds
                )
                ->update([
                    'status_changed_by' => null,
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Notifications
        |--------------------------------------------------------------------------
        */

        if (
            Schema::hasTable(
                'notifications'
            )
            && Schema::hasColumn(
                'notifications',
                'notifiable_id'
            )
        ) {

            $notificationQuery =
                DB::table(
                    'notifications'
                )
                    ->whereIn(
                        'notifiable_id',
                        $userIds
                    );


            if (
                Schema::hasColumn(
                    'notifications',
                    'notifiable_type'
                )
            ) {

                $notificationQuery
                    ->whereIn(
                        'notifiable_type',
                        [
                            User::class,
                            'App\Models\User',
                        ]
                    );
            }


            $notificationQuery
                ->delete();
        }


        /*
        |--------------------------------------------------------------------------
        | API Tokens
        |--------------------------------------------------------------------------
        */

        if (
            Schema::hasTable(
                'personal_access_tokens'
            )
            && Schema::hasColumn(
                'personal_access_tokens',
                'tokenable_id'
            )
        ) {

            $tokenQuery =
                DB::table(
                    'personal_access_tokens'
                )
                    ->whereIn(
                        'tokenable_id',
                        $userIds
                    );


            if (
                Schema::hasColumn(
                    'personal_access_tokens',
                    'tokenable_type'
                )
            ) {

                $tokenQuery
                    ->whereIn(
                        'tokenable_type',
                        [
                            User::class,
                            'App\Models\User',
                        ]
                    );
            }


            $tokenQuery
                ->delete();
        }


        /*
        |--------------------------------------------------------------------------
        | Product IDs
        |--------------------------------------------------------------------------
        */

        $productIds =
            collect();


        if (
            Schema::hasTable(
                'products'
            )
            && Schema::hasColumn(
                'products',
                'user_id'
            )
            && Schema::hasColumn(
                'products',
                'id'
            )
        ) {

            $productIds =
                DB::table('products')
                    ->whereIn(
                        'user_id',
                        $userIds
                    )
                    ->pluck('id');
        }


        /*
        |--------------------------------------------------------------------------
        | Product Requests
        |--------------------------------------------------------------------------
        */

        if (
            Schema::hasTable(
                'product_requests'
            )
        ) {

            $requestFilters = [];


            foreach (
                [
                    'donor_id',
                    'beneficiary_id',
                    'user_id',
                ] as $column
            ) {

                if (
                    Schema::hasColumn(
                        'product_requests',
                        $column
                    )
                ) {

                    $requestFilters[] = [
                        'column' =>
                            $column,

                        'values' =>
                            $userIds,
                    ];
                }
            }


            if (
                $productIds->isNotEmpty()
                && Schema::hasColumn(
                    'product_requests',
                    'product_id'
                )
            ) {

                $requestFilters[] = [

                    'column' =>
                        'product_id',

                    'values' =>
                        $productIds,
                ];
            }


            if (
                $requestFilters !== []
            ) {

                $query =
                    DB::table(
                        'product_requests'
                    );


                $query->where(
                    function (
                        $subQuery
                    ) use (
                        $requestFilters
                    ) {

                        foreach (
                            $requestFilters as $index => $filter
                        ) {

                            if (
                                $index === 0
                            ) {

                                $subQuery
                                    ->whereIn(
                                        $filter['column'],
                                        $filter['values']
                                    );

                            } else {

                                $subQuery
                                    ->orWhereIn(
                                        $filter['column'],
                                        $filter['values']
                                    );
                            }
                        }
                    }
                );


                $query->delete();
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Role Specific Tables
        |--------------------------------------------------------------------------
        */

        $directDeleteMap = [

            'beneficiary_profiles' => [
                'user_id',
            ],

            'donor_profiles' => [
                'user_id',
            ],

            'donor_term_acceptances' => [
                'donor_id',
                'user_id',
            ],
        ];


        foreach (
            $directDeleteMap
            as $table => $possibleColumns
        ) {

            if (
                ! Schema::hasTable(
                    $table
                )
            ) {
                continue;
            }


            $availableColumns =
                collect(
                    $possibleColumns
                )
                    ->filter(
                        fn (
                            string $column
                        ) =>
                        Schema::hasColumn(
                            $table,
                            $column
                        )
                    )
                    ->values();


            if (
                $availableColumns
                    ->isEmpty()
            ) {
                continue;
            }


            DB::table($table)
                ->where(
                    function (
                        $query
                    ) use (
                        $availableColumns,
                        $userIds
                    ) {

                        foreach (
                            $availableColumns as $index => $column
                        ) {

                            if (
                                $index === 0
                            ) {

                                $query
                                    ->whereIn(
                                        $column,
                                        $userIds
                                    );

                            } else {

                                $query
                                    ->orWhereIn(
                                        $column,
                                        $userIds
                                    );
                            }
                        }
                    }
                )
                ->delete();
        }


        /*
        |--------------------------------------------------------------------------
        | Products
        |--------------------------------------------------------------------------
        */

        if (
            Schema::hasTable(
                'products'
            )
            && Schema::hasColumn(
                'products',
                'user_id'
            )
        ) {

            DB::table('products')
                ->whereIn(
                    'user_id',
                    $userIds
                )
                ->delete();
        }
    }


    /*
    |--------------------------------------------------------------------------
    | Import Users
    |--------------------------------------------------------------------------
    */

    private const SESSION_KEY =
        'pending_user_import';


    public function preview(
        Request $request
    ): RedirectResponse {

        $request->validate([

            'file' => [
                'required',
                'file',
                'mimes:xlsx,xls,csv',
                'max:5120',
            ],

        ]);


        try {

            $sheets =
                Excel::toCollection(
                    null,
                    $request->file('file')
                );

            $sheet =
                $sheets->first();

        } catch (Throwable $exception) {

            report($exception);

            return back()
                ->withErrors([

                    'file' =>
                        'The spreadsheet could not be read. Please use a valid XLSX, XLS, or CSV file.',
                ]);
        }


        if (
            ! $sheet
            || $sheet->isEmpty()
        ) {

            return back()
                ->withErrors([

                    'file' =>
                        'The selected spreadsheet is empty.',
                ]);
        }


        $headings =
            collect(
                $sheet->first()
            )
                ->map(
                    fn ($heading) =>
                    Str::of(
                        (string) $heading
                    )
                        ->trim()
                        ->lower()
                        ->replace(
                            ' ',
                            '_'
                        )
                        ->value()
                )
                ->all();


        foreach (
            [
                'name',
                'email',
                'phone',
                'password',
                'role',
                'qalam_id',
                'account_status',
                'status_reason',
            ] as $requiredHeading
        ) {

            if (
                ! in_array(
                    $requiredHeading,
                    $headings,
                    true
                )
            ) {

                return back()
                    ->withErrors([

                        'file' =>
                            "Missing Excel heading: {$requiredHeading}.",
                    ]);
            }
        }


        $cleanRows = [];

        $duplicates = [];

        $invalidRows = [];

        $seenEmails = [];

        $seenQalamIds = [];


        $dataRows =
            $sheet
                ->slice(1)
                ->values();


        foreach (
            $dataRows as $index => $row
        ) {

            $excelRow =
                $index + 2;


            $row =
                collect($headings)
                    ->combine(
                        collect($row)
                            ->pad(
                                count(
                                    $headings
                                ),
                                null
                            )
                    )
                    ->all();


            $data =
                $this->normalizeRow(
                    $row
                );


            if (
                $this->emptyRow(
                    $data
                )
            ) {
                continue;
            }


            $validator =
                Validator::make(
                    $data,
                    $this->rules()
                );


            if (
                $validator->fails()
            ) {

                $invalidRows[] = [

                    'row' =>
                        $excelRow,

                    'name' =>
                        $data['name'],

                    'email' =>
                        $data['email'],

                    'errors' =>
                        $validator
                            ->errors()
                            ->all(),
                ];

                continue;
            }


            if (
                $data['role'] !==
                'beneficiary'
            ) {

                $data['qalam_id'] =
                    null;
            }


            $reasons = [];


            if (
                isset(
                    $seenEmails[
                        $data['email']
                    ]
                )
            ) {

                $reasons[] =
                    "Email duplicates Excel row {$seenEmails[$data['email']]}.";

            } elseif (
                User::where(
                    'email',
                    $data['email']
                )->exists()
            ) {

                $reasons[] =
                    'Email already exists in the users table.';
            }


            if (
                $data['qalam_id']
            ) {

                if (
                    isset(
                        $seenQalamIds[
                            $data['qalam_id']
                        ]
                    )
                ) {

                    $reasons[] =
                        "Qalam ID duplicates Excel row {$seenQalamIds[$data['qalam_id']]}.";
                } elseif (
                    User::where(
                        'qalam_id',
                        $data['qalam_id']
                    )->exists()
                ) {

                    $reasons[] =
                        'Qalam ID already exists in the users table.';
                }
            }


            if (
                $reasons !== []
            ) {

                $duplicates[] = [

                    'row' =>
                        $excelRow,

                    'name' =>
                        $data['name'],

                    'email' =>
                        $data['email'],

                    'qalam_id' =>
                        $data['qalam_id'],

                    'reasons' =>
                        $reasons,
                ];

                continue;
            }


            $seenEmails[
                $data['email']
            ] = $excelRow;


            if (
                $data['qalam_id']
            ) {

                $seenQalamIds[
                    $data['qalam_id']
                ] = $excelRow;
            }


            $cleanRows[] =
                $data;
        }


        $token =
            (string) Str::uuid();


        session()->put(
            self::SESSION_KEY,
            [

                'token' =>
                    $token,

                'rows' =>
                    $cleanRows,

                'created_at' =>
                    now()->timestamp,
            ]
        );


        return back()->with(
            'import_preview',
            [

                'token' =>
                    $token,

                'total' =>
                    count($cleanRows)
                    + count($duplicates)
                    + count($invalidRows),

                'clean_count' =>
                    count($cleanRows),

                'duplicates' =>
                    $duplicates,

                'invalid' =>
                    $invalidRows,
            ]
        );
    }


    public function confirm(
        Request $request
    ): RedirectResponse {

        $request->validate([

            'import_token' => [
                'required',
                'uuid',
            ],
        ]);


        $pendingImport =
            session(
                self::SESSION_KEY
            );


        if (
            ! $pendingImport
            || ! hash_equals(
                $pendingImport['token'],
                $request
                    ->string(
                        'import_token'
                    )
                    ->toString()
            )
        ) {

            return redirect()
                ->route(
                    'admin.user.index'
                )
                ->withErrors([

                    'file' =>
                        'The import preview expired. Please upload the file again.',
                ]);
        }


        if (
            (
                $pendingImport[
                    'created_at'
                ] ?? 0
            )
            <
            now()
                ->subMinutes(30)
                ->timestamp
        ) {

            session()->forget(
                self::SESSION_KEY
            );

            return redirect()
                ->route(
                    'admin.user.index'
                )
                ->withErrors([

                    'file' =>
                        'The import preview expired after 30 minutes. Please upload the file again.',
                ]);
        }


        $inserted = 0;

        $raceDuplicates = 0;


        DB::transaction(
            function () use (
                $pendingImport,
                &$inserted,
                &$raceDuplicates
            ): void {

                foreach (
                    $pendingImport['rows']
                    as $data
                ) {

                    $duplicateExists =
                        User::query()
                            ->where(
                                'email',
                                $data['email']
                            )
                            ->when(
                                filled(
                                    $data['qalam_id']
                                ),
                                fn ($query) =>
                                $query->orWhere(
                                    'qalam_id',
                                    $data['qalam_id']
                                )
                            )
                            ->lockForUpdate()
                            ->exists();


                    if (
                        $duplicateExists
                    ) {

                        $raceDuplicates++;

                        continue;
                    }


                    User::create([

                        'name' =>
                            $data['name'],

                        'email' =>
                            $data['email'],

                        'phone' =>
                            $data['phone'],

                        'password' =>
                            $data['password']
                                ?: Str::password(12),

                        'image' =>
                            null,

                        'role' =>
                            $data['role'],

                        'qalam_id' =>
                            $data['qalam_id'],

                        'account_status' =>
                            $data['account_status'],

                        'status_reason' =>
                            $data['status_reason'],

                        'status_changed_at' =>
                            $data[
                                'account_status'
                            ] === 'active'
                                ? null
                                : now(),

                        'status_changed_by' =>
                            auth()->id(),
                    ]);


                    $inserted++;
                }
            }
        );


        session()->forget(
            self::SESSION_KEY
        );


        $message =
            "{$inserted} users imported successfully.";


        if (
            $raceDuplicates > 0
        ) {

            $message .=
                " {$raceDuplicates} newly detected duplicate rows were skipped.";
        }


        return redirect()
            ->route(
                'admin.user.index'
            )
            ->with(
                'success',
                $message
            );
    }


    public function cancel():
        RedirectResponse
    {

        session()->forget(
            self::SESSION_KEY
        );


        return redirect()
            ->route(
                'admin.user.index'
            )
            ->with(
                'info',
                'User import was cancelled.'
            );
    }


    private function rules():
        array
    {

        return [

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email:rfc',
                'max:255',
            ],

            'phone' => [
                'nullable',
                'string',
                'max:30',
                'regex:/^[0-9+\-\s()]+$/',
            ],

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

            'qalam_id' => [
                'required_if:role,beneficiary',
                'nullable',
                'string',
                'max:100',
            ],

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


    private function normalizeRow(
        array $row
    ): array {

        $value =
            fn (string $key) =>
            filled(
                $row[$key] ?? null
            )
                ? trim(
                    (string) $row[$key]
                )
                : null;


        return [

            'name' =>
                $value('name'),

            'email' =>
                $value('email')
                    ? Str::lower(
                        $value('email')
                    )
                    : null,

            'phone' =>
                $value('phone'),

            'password' =>
                $value('password'),

            'role' =>
                Str::lower(
                    $value('role')
                        ?: 'beneficiary'
                ),

            'qalam_id' =>
                $value('qalam_id')
                    ? Str::upper(
                        $value(
                            'qalam_id'
                        )
                    )
                    : null,

            'account_status' =>
                Str::lower(
                    $value(
                        'account_status'
                    )
                        ?: 'active'
                ),

            'status_reason' =>
                $value(
                    'status_reason'
                ),
        ];
    }


    private function emptyRow(
        array $data
    ): bool {

        return blank(
            $data['name']
        )
            && blank(
                $data['email']
            )
            && blank(
                $data['phone']
            )
            && blank(
                $data['password']
            )
            && blank(
                $data['qalam_id']
            )
            && blank(
                $data['status_reason']
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Export All Users
    |--------------------------------------------------------------------------
    */

    public function exportUsers():
        BinaryFileResponse
    {

        $this->ensureCurrentUserIsAdmin();


        return Excel::download(
            new UsersExport(),
            'users.xlsx'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Export Selected Users
    |--------------------------------------------------------------------------
    */

    public function exportSelected(
        Request $request
    ): BinaryFileResponse|RedirectResponse {

        $this->ensureCurrentUserIsAdmin();


        $validated =
            $request->validate([

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
            new UsersSelectedExport(
                $validated['ids']
            ),
            'selected_users.xlsx'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Admin Check
    |--------------------------------------------------------------------------
    */

    private function ensureCurrentUserIsAdmin():
        void
    {

        abort_unless(
            auth()->check()
                && auth()
                    ->user()
                    ->isAdmin(),
            403,
            'Only administrators can perform this action.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Upload Profile Image
    |--------------------------------------------------------------------------
    */

    private function uploadProfileImage(
        $image
    ): string {

        $directory =
            public_path(
                'admins/asset/profilephoto'
            );


        if (
            ! File::isDirectory(
                $directory
            )
        ) {

            File::makeDirectory(
                $directory,
                0755,
                true
            );
        }


        $extension =
            strtolower(
                $image
                    ->getClientOriginalExtension()
            );


        $imageName =
            Str::uuid()
                ->toString()
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
    | Delete Profile Image
    |--------------------------------------------------------------------------
    */

    private function deleteProfileImage(
        ?string $imageName
    ): void {

        if (
            ! $imageName
        ) {
            return;
        }


        $safeImageName =
            basename(
                $imageName
            );


        $imagePath =
            public_path(
                'admins/asset/profilephoto/'
                . $safeImageName
            );


        if (
            File::exists(
                $imagePath
            )
        ) {

            File::delete(
                $imagePath
            );
        }
    }
}