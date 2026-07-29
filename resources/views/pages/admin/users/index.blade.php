@include('layouts.admin.head')

<title>Manage Users</title>

<body>

    {{-- New Sidebar --}}
    @include('layouts.admin.sidebar')


    {{-- Main Content --}}
    <div class="nsn-main">

        {{-- New Topbar --}}
        @include('layouts.admin.header')


        <main class="nsn-content">

            {{-- Page Header --}}
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">

                <div>
                    <h3 class="fw-bold text-dark mb-1">
                        User Management
                    </h3>

                    <p class="text-secondary small mb-0">
                        View, search, import, export and manage registered users.
                    </p>
                </div>

                <div class="d-flex flex-wrap align-items-center gap-2">

                    <a
                        href="{{ route('admin.user.export') }}"
                        class="btn btn-dark d-flex align-items-center gap-2"
                    >
                        <i class="bi bi-download"></i>
                        <span>Export All</span>
                    </a>

                    <a
                        href="{{ route('admin.user.create') }}"
                        class="btn btn-primary d-flex align-items-center gap-2"
                    >
                        <i class="bi bi-person-plus"></i>
                        <span>Add User</span>
                    </a>

                </div>

            </div>


            {{-- Breadcrumb --}}
            <nav aria-label="breadcrumb" class="mb-4">

                <ol class="breadcrumb small mb-0">

                    <li class="breadcrumb-item">
                        <a
                            href="{{ route('dashboard') }}"
                            class="text-decoration-none"
                        >
                            <i class="bi bi-house-door me-1"></i>
                            Dashboard
                        </a>
                    </li>

                    <li
                        class="breadcrumb-item active"
                        aria-current="page"
                    >
                        Users
                    </li>

                </ol>

            </nav>


            {{-- Alert Messages --}}
            @include('layouts.admin.alert')


            {{-- Import Users Card --}}
            <div class="card border-0 shadow-sm rounded-4 mb-4">

                <div class="card-body p-4">

                    <div class="row align-items-center g-3">

                        <div class="col-12 col-lg-5">

                            <div class="d-flex align-items-center gap-3">

                                <span
                                    class="d-inline-flex align-items-center justify-content-center rounded-circle bg-success-subtle text-success flex-shrink-0"
                                    style="width: 46px; height: 46px;"
                                >
                                    <i class="bi bi-file-earmark-spreadsheet fs-5"></i>
                                </span>

                                <div>
                                    <h5 class="fw-semibold text-dark mb-1">
                                        Import Users
                                    </h5>

                                    <p class="text-secondary small mb-0">
                                        Upload an Excel or CSV file containing user records.
                                    </p>
                                </div>

                            </div>

                        </div>


                        <div class="col-12 col-lg-7">

                            <form
                                action="{{ route('admin.user.import') }}"
                                method="POST"
                                enctype="multipart/form-data"
                            >
                                @csrf

                                <div class="row g-2">

                                    <div class="col-12 col-md">
                                        <input
                                            type="file"
                                            name="file"
                                            class="form-control @error('file') is-invalid @enderror"
                                            accept=".xlsx,.xls,.csv"
                                            required
                                        >

                                        @error('file')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-auto">
                                        <button
                                            type="submit"
                                            class="btn btn-success w-100"
                                        >
                                            <i class="bi bi-cloud-arrow-up me-1"></i>
                                            Import Users
                                        </button>
                                    </div>

                                </div>

                            </form>

                        </div>

                    </div>

                </div>

            </div>


            {{-- Users Card --}}
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

                {{-- Card Header --}}
                <div class="card-header bg-white border-bottom px-4 py-3">

                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">

                        <div>
                            <h5 class="fw-semibold text-dark mb-1">
                                User Profiles
                            </h5>

                            <p class="text-secondary small mb-0">
                                Total registered users:
                                <span class="fw-semibold text-dark">
                                    {{ $users->total() }}
                                </span>
                            </p>
                        </div>


                        {{-- Search Form --}}
                        <form
                            method="GET"
                            action="{{ route('admin.user.index') }}"
                            class="d-flex flex-wrap align-items-center gap-2"
                        >
                            <div class="input-group">

                                <span class="input-group-text bg-light">
                                    <i class="bi bi-search"></i>
                                </span>

                                <input
                                    type="search"
                                    name="search"
                                    value="{{ request('search') }}"
                                    class="form-control"
                                    placeholder="Search users..."
                                    aria-label="Search users"
                                >

                            </div>

                            <button
                                type="submit"
                                class="btn btn-primary"
                            >
                                Search
                            </button>

                            @if (request()->filled('search'))
                                <a
                                    href="{{ route('admin.user.index') }}"
                                    class="btn btn-light border"
                                >
                                    <i class="bi bi-x-circle me-1"></i>
                                    Reset
                                </a>
                            @endif

                        </form>

                    </div>

                </div>


                {{-- Bulk Action Form --}}
                <form
                    method="POST"
                    id="bulkForm"
                >
                    @csrf


                    {{-- Bulk Action Bar --}}
                    <div class="bg-light border-bottom px-4 py-3">

                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">

                            <div class="d-flex align-items-center gap-2">

                                <i class="bi bi-check2-square text-primary"></i>

                                <span class="small text-secondary">
                                    <span
                                        id="selectedCount"
                                        class="fw-semibold text-dark"
                                    >
                                        0
                                    </span>
                                    users selected
                                </span>

                            </div>


                            <div class="d-flex flex-wrap align-items-center gap-2">

                                <button
                                    type="submit"
                                    id="exportSelectedButton"
                                    formaction="{{ route('admin.user.export.selected') }}"
                                    class="btn btn-outline-dark btn-sm"
                                    disabled
                                >
                                    <i class="bi bi-download me-1"></i>
                                    Export Selected
                                </button>

                                <button
                                    type="submit"
                                    id="deleteSelectedButton"
                                    formaction="{{ route('admin.user.delete.selected') }}"
                                    class="btn btn-outline-danger btn-sm"
                                    disabled
                                    onclick="return confirm('Are you sure you want to delete the selected users?');"
                                >
                                    <i class="bi bi-trash3 me-1"></i>
                                    Delete Selected
                                </button>

                            </div>

                        </div>

                    </div>


                    {{-- Users Table --}}
                    <div class="table-responsive">

                        <table class="table table-hover align-middle mb-0">

                            <thead class="table-light">
                                <tr>
                                    <th class="px-4 py-3">
                                        <div class="form-check mb-0">
                                            <input
                                                type="checkbox"
                                                id="select-all"
                                                class="form-check-input"
                                                aria-label="Select all users"
                                            >
                                        </div>
                                    </th>

                                    <th class="py-3 text-secondary small">
                                        #
                                    </th>

                                    <th class="py-3 text-secondary small">
                                        User
                                    </th>

                                    <th class="py-3 text-secondary small">
                                        Qalam ID
                                    </th>

                                    <th class="py-3 text-secondary small">
                                        Contact
                                    </th>

                                    <th class="py-3 text-secondary small">
                                        Role
                                    </th>

                                    <th class="py-3 text-secondary small">
                                        Joined
                                    </th>

                                    <th class="px-4 py-3 text-secondary small text-end">
                                        Actions
                                    </th>
                                </tr>
                            </thead>


                            <tbody>

                                @forelse ($users as $key => $user)

                                    @php
                                        $role = strtolower($user->role);

                                        $roleBadge = match ($role) {
                                            'admin' => 'bg-success-subtle text-success',
                                            'donor' => 'bg-primary-subtle text-primary',
                                            'beneficiary' => 'bg-info-subtle text-info-emphasis',
                                            default => 'bg-secondary-subtle text-secondary',
                                        };
                                    @endphp

                                    <tr>

                                        {{-- Checkbox --}}
                                        <td class="px-4">

                                            <div class="form-check mb-0">
                                                <input
                                                    type="checkbox"
                                                    name="ids[]"
                                                    value="{{ $user->id }}"
                                                    class="form-check-input user-checkbox"
                                                    aria-label="Select {{ $user->name }}"
                                                >
                                            </div>

                                        </td>


                                        {{-- Number --}}
                                        <td>
                                            <span class="text-secondary">
                                                {{ $users->firstItem() + $key }}
                                            </span>
                                        </td>


                                        {{-- User --}}
                                        <td>

                                            <div class="d-flex align-items-center gap-3">

                                                @if ($user->image)
                                                    <img
                                                        src="{{ asset('admin/asset/profilephoto/' . $user->image) }}"
                                                        alt="{{ $user->name }}"
                                                        width="42"
                                                        height="42"
                                                        class="rounded-circle border object-fit-cover flex-shrink-0"
                                                    >
                                                @else
                                                    <span
                                                        class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary-subtle text-primary fw-semibold flex-shrink-0"
                                                        style="width: 42px; height: 42px;"
                                                    >
                                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                                    </span>
                                                @endif

                                                <div>
                                                    <div class="fw-semibold text-dark">
                                                        {{ $user->name }}
                                                    </div>

                                                    <small class="text-secondary">
                                                        User ID: #{{ $user->id }}
                                                    </small>
                                                </div>

                                            </div>

                                        </td>


                                        {{-- Qalam ID --}}
                                        <td>
                                            @if ($user->qalam_id)
                                                <span class="badge bg-light text-dark border fw-normal">
                                                    {{ $user->qalam_id }}
                                                </span>
                                            @else
                                                <span class="text-secondary small">
                                                    Not available
                                                </span>
                                            @endif
                                        </td>


                                        {{-- Contact --}}
                                        <td>

                                            <div class="small text-dark mb-1">
                                                <i class="bi bi-envelope text-secondary me-1"></i>
                                                {{ $user->email }}
                                            </div>

                                            @if ($user->phone)
                                                <div class="small text-secondary">
                                                    <i class="bi bi-telephone me-1"></i>
                                                    {{ $user->phone }}
                                                </div>
                                            @else
                                                <small class="text-secondary">
                                                    No phone number
                                                </small>
                                            @endif

                                        </td>


                                        {{-- Role --}}
                                        <td>
                                            <span class="badge rounded-pill {{ $roleBadge }} px-3 py-2">
                                                {{ ucfirst($user->role) }}
                                            </span>
                                        </td>


                                        {{-- Joined Date --}}
                                        <td>

                                            <div class="small text-dark">
                                                <i class="bi bi-calendar3 text-secondary me-1"></i>
                                                {{ optional($user->created_at)->format('d M Y') }}
                                            </div>

                                            <small class="text-secondary">
                                                {{ optional($user->created_at)->diffForHumans() }}
                                            </small>

                                        </td>


                                        {{-- Actions --}}
                                        <td class="px-4 text-end">

                                            <div class="d-inline-flex align-items-center gap-2">

                                                <a
                                                    href="{{ route('admin.user.edit', $user->id) }}"
                                                    class="btn btn-outline-warning btn-sm"
                                                    title="Edit user"
                                                >
                                                    <i class="bi bi-pencil-square me-1"></i>
                                                    Edit
                                                </a>

                                                <a
                                                    href="{{ route('admin.user.destroy', $user->id) }}"
                                                    class="btn btn-outline-danger btn-sm"
                                                    title="Delete user"
                                                    onclick="return confirm('Are you sure you want to delete this user?');"
                                                >
                                                    <i class="bi bi-trash3 me-1"></i>
                                                    Delete
                                                </a>

                                            </div>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="8" class="text-center py-5">

                                            <div class="d-flex flex-column align-items-center">

                                                <span
                                                    class="d-inline-flex align-items-center justify-content-center rounded-circle bg-light text-secondary mb-3"
                                                    style="width: 64px; height: 64px;"
                                                >
                                                    <i class="bi bi-people fs-3"></i>
                                                </span>

                                                <h6 class="fw-semibold text-dark mb-1">
                                                    No users found
                                                </h6>

                                                <p class="text-secondary small mb-3">
                                                    @if (request()->filled('search'))
                                                        No users match your search.
                                                    @else
                                                        No registered users are available.
                                                    @endif
                                                </p>

                                                @if (request()->filled('search'))
                                                    <a
                                                        href="{{ route('admin.user.index') }}"
                                                        class="btn btn-primary btn-sm"
                                                    >
                                                        <i class="bi bi-arrow-counterclockwise me-1"></i>
                                                        Clear Search
                                                    </a>
                                                @else
                                                    <a
                                                        href="{{ route('admin.user.create') }}"
                                                        class="btn btn-primary btn-sm"
                                                    >
                                                        <i class="bi bi-person-plus me-1"></i>
                                                        Add User
                                                    </a>
                                                @endif

                                            </div>

                                        </td>
                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </form>


                {{-- Pagination --}}
                @if ($users->hasPages())

                    <div class="card-footer bg-white border-top px-4 py-3">

                        <div class="d-flex flex-column flex-md-row align-items-center justify-content-between gap-3">

                            <p class="text-secondary small mb-0">
                                Showing
                                <span class="fw-semibold text-dark">
                                    {{ $users->firstItem() }}
                                </span>
                                to
                                <span class="fw-semibold text-dark">
                                    {{ $users->lastItem() }}
                                </span>
                                of
                                <span class="fw-semibold text-dark">
                                    {{ $users->total() }}
                                </span>
                                users
                            </p>

                            <div>
                                {{ $users->withQueryString()->links() }}
                            </div>

                        </div>

                    </div>

                @endif

            </div>

        </main>

    </div>


    @include('layouts.admin.script')


    {{-- Select All and Bulk Action Script --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const selectAll = document.getElementById('select-all');

            const userCheckboxes = Array.from(
                document.querySelectorAll('.user-checkbox')
            );

            const selectedCount = document.getElementById('selectedCount');

            const exportButton = document.getElementById(
                'exportSelectedButton'
            );

            const deleteButton = document.getElementById(
                'deleteSelectedButton'
            );

            function updateBulkActions() {
                const checkedUsers = userCheckboxes.filter(function (checkbox) {
                    return checkbox.checked;
                });

                const checkedCount = checkedUsers.length;

                if (selectedCount) {
                    selectedCount.textContent = checkedCount;
                }

                if (exportButton) {
                    exportButton.disabled = checkedCount === 0;
                }

                if (deleteButton) {
                    deleteButton.disabled = checkedCount === 0;
                }

                if (selectAll) {
                    selectAll.checked =
                        userCheckboxes.length > 0 &&
                        checkedCount === userCheckboxes.length;

                    selectAll.indeterminate =
                        checkedCount > 0 &&
                        checkedCount < userCheckboxes.length;
                }
            }

            if (selectAll) {
                selectAll.addEventListener('change', function () {
                    userCheckboxes.forEach(function (checkbox) {
                        checkbox.checked = selectAll.checked;
                    });

                    updateBulkActions();
                });
            }

            userCheckboxes.forEach(function (checkbox) {
                checkbox.addEventListener('change', updateBulkActions);
            });

            updateBulkActions();
        });
    </script>

</body>
