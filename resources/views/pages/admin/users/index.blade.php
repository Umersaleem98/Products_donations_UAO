@include('layouts.admin.head')
<title>Index Users</title>

<body>
    <div class="container-scroller">

        @include('layouts.admin.header')

        <div class="container-fluid page-body-wrapper">

            @include('layouts.admin.sidebar')

            <div class="main-panel">
                <div class="content-wrapper">

                    <!-- PAGE HEADER -->
                    <div class="page-header">
                        <h3 class="page-title">
                            <span class="page-title-icon bg-gradient-primary text-white me-2">
                                <i class="mdi mdi-account"></i>
                            </span>
                            Users
                        </h3>
                    </div>

                    <div class="row">
                        <div class="col-12">

                            <div class="card shadow-sm border-0">

                                <!-- HEADER -->
                                <div class="card-header bg-white border-bottom py-3">

                                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                                        <!-- LEFT -->
                                        <div>
                                            <h5 class="mb-1 fw-bold">User Profiles</h5>

                                            <!-- TOTAL USERS -->
                                            <small class="text-muted">
                                                Total Users:
                                                <span class="fw-bold text-dark">
                                                    {{ $users->total() }}
                                                </span>
                                            </small>
                                        </div>

                                        <!-- RIGHT -->
                                        <div class="d-flex gap-2 flex-wrap">

                                            <!-- EXPORT ALL -->
                                            <a href="{{ route('admin.user.export') }}"
                                                class="btn btn-dark btn-sm">
                                                <i class="mdi mdi-download me-1"></i>
                                                Export All
                                            </a>

                                            <!-- IMPORT -->
                                            <form action="{{ route('admin.user.import') }}"
                                                method="POST"
                                                enctype="multipart/form-data"
                                                class="d-flex gap-2">
                                                @csrf

                                                <input type="file"
                                                    name="file"
                                                    class="form-control form-control-sm"
                                                    required>

                                                <button type="submit"
                                                    class="btn btn-success btn-sm">
                                                    <i class="mdi mdi-upload me-1"></i>
                                                    Import
                                                </button>
                                            </form>

                                        </div>
                                    </div>
                                </div>

                                <!-- BODY -->
                                <div class="card-body">

                                    @include('layouts.admin.alert')

                                    <!-- SEARCH + PER PAGE -->
                                    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">

                                        <!-- SEARCH -->
                                        <form method="GET"
                                            action="{{ route('admin.user.index') }}"
                                            class="d-flex gap-2 flex-wrap">

                                            <input type="text"
                                                name="search"
                                                value="{{ request('search') }}"
                                                class="form-control form-control-sm"
                                                placeholder="Search name, email, qalam id"
                                                style="min-width:250px;">

                                            <button class="btn btn-primary btn-sm">
                                                <i class="mdi mdi-magnify"></i>
                                                Search
                                            </button>

                                            <a href="{{ route('admin.user.index') }}"
                                                class="btn btn-dark btn-sm">
                                                Reset
                                            </a>
                                        </form>

                                        <!-- PER PAGE -->
                                        <form method="GET"
                                            action="{{ route('admin.user.index') }}">

                                            <select name="per_page"
                                                onchange="this.form.submit()"
                                                class="form-select form-select-sm">

                                                <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>
                                                    10
                                                </option>

                                                <option value="20" {{ $perPage == 20 ? 'selected' : '' }}>
                                                    20
                                                </option>

                                                <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>
                                                    50
                                                </option>

                                                <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>
                                                    100
                                                </option>

                                            </select>
                                        </form>

                                    </div>

                                    <!-- TABLE SECTION -->
                                    <div class="border rounded-3 p-3 bg-light">

                                        <!-- SECTION HEADER -->
                                        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">

                                            <div>
                                                <h6 class="mb-1 fw-bold">
                                                    Users Table
                                                </h6>

                                                <small class="text-muted">
                                                    Showing
                                                    {{ $users->firstItem() ?? 0 }}
                                                    to
                                                    {{ $users->lastItem() ?? 0 }}
                                                    of
                                                    {{ $users->total() }}
                                                    users
                                                </small>
                                            </div>

                                            <!-- BULK FORM -->
                                            <form method="POST" id="bulk-form">
                                                @csrf

                                                <div class="d-flex gap-2">

                                                    <button type="submit"
                                                        formaction="{{ route('admin.user.export.selected') }}"
                                                        class="btn btn-dark btn-sm">
                                                        <i class="mdi mdi-file-export"></i>
                                                        Export Selected
                                                    </button>

                                                    <button type="submit"
                                                        formaction="{{ route('admin.user.delete.selected') }}"
                                                        class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Delete selected users?')">
                                                        <i class="mdi mdi-delete"></i>
                                                        Delete Selected
                                                    </button>

                                                </div>
                                            </form>

                                        </div>

                                        <!-- TABLE -->
                                        <div class="table-responsive">

                                            <form method="POST">
                                                @csrf

                                                <table class="table table-bordered table-hover align-middle mb-0 bg-white">

                                                    <thead class="table-light">
                                                        <tr>
                                                            <th width="40">
                                                                <input type="checkbox" id="select-all">
                                                            </th>

                                                            <th>#</th>
                                                            <th>Image</th>
                                                            <th>Name</th>
                                                            <th>Email</th>
                                                            <th>Role</th>
                                                            <th>Qalam ID</th>
                                                            <th width="160">Action</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>

                                                        @forelse($users as $key => $user)
                                                            <tr>

                                                                <td>
                                                                    <input type="checkbox"
                                                                        name="ids[]"
                                                                        value="{{ $user->id }}"
                                                                        class="user-checkbox">
                                                                </td>

                                                                <td>
                                                                    {{ $users->firstItem() + $key }}
                                                                </td>

                                                                <td>
                                                                    @if ($user->image)

                                                                        <img src="{{ asset('admin/asset/profilephoto/' . $user->image) }}"
                                                                            width="50"
                                                                            height="50"
                                                                            class="rounded-circle border"
                                                                            style="object-fit:cover;">

                                                                    @else

                                                                        <span class="text-muted">
                                                                            N/A
                                                                        </span>

                                                                    @endif
                                                                </td>

                                                                <td class="fw-semibold">
                                                                    {{ $user->name }}
                                                                </td>

                                                                <td>
                                                                    {{ $user->email }}
                                                                </td>

                                                                <td>

                                                                    @php
                                                                        $role = strtolower($user->role);

                                                                        $badgeClass = match ($role) {
                                                                            'admin' => 'bg-primary',
                                                                            'donor' => 'bg-danger',
                                                                            'beneficiary' => 'bg-info',
                                                                            default => 'bg-secondary',
                                                                        };
                                                                    @endphp

                                                                    <span class="badge {{ $badgeClass }}">
                                                                        {{ ucfirst($user->role) }}
                                                                    </span>

                                                                </td>

                                                                <td>
                                                                    {{ $user->qalam_id ?? 'N/A' }}
                                                                </td>

                                                                <td>

                                                                    <div class="d-flex gap-1">

                                                                        <a href="{{ route('admin.user.edit', $user->id) }}"
                                                                            class="btn btn-warning btn-sm">
                                                                            Edit
                                                                        </a>

                                                                        <a href="{{ route('admin.user.destroy', $user->id) }}"
                                                                            class="btn btn-danger btn-sm"
                                                                            onclick="return confirm('Delete this user?')">
                                                                            Delete
                                                                        </a>

                                                                    </div>

                                                                </td>

                                                            </tr>

                                                        @empty

                                                            <tr>
                                                                <td colspan="8" class="text-center py-4">
                                                                    No users found
                                                                </td>
                                                            </tr>

                                                        @endforelse

                                                    </tbody>

                                                </table>
                                            </form>

                                        </div>

                                    </div>

                                </div>

                                <!-- PAGINATION -->
                                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 px-3 py-3 border-top">

                                    <small class="text-muted">
                                        Total Records:
                                        <strong>{{ $users->total() }}</strong>
                                    </small>

                                    {{ $users->links() }}

                                </div>

                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    @include('layouts.admin.script')

    <!-- SELECT ALL -->
    <script>
        document.getElementById('select-all').addEventListener('click', function() {

            document.querySelectorAll('.user-checkbox').forEach(cb => {
                cb.checked = this.checked;
            });

        });
    </script>

</body>