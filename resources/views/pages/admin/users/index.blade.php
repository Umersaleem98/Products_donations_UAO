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
                            </span> Users
                        </h3>
                    </div>

                    <div class="row">
                        <div class="col-12">

                            <div class="card shadow-sm">

                                <!-- HEADER -->
                                <div class="card-header">

                                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                                        <h5 class="mb-0">User Profiles</h5>

                                        <div class="d-flex gap-2 flex-wrap">

                                            <!-- EXPORT ALL -->
                                            <a href="{{ route('admin.user.export') }}" class="btn btn-dark btn-sm">
                                                Export All
                                            </a>

                                            <!-- IMPORT -->
                                            <form action="{{ route('admin.user.import') }}" method="POST"
                                                enctype="multipart/form-data" class="d-flex gap-2">
                                                @csrf

                                                <input type="file" name="file"
                                                    class="form-control form-control-sm" required>

                                                <button type="submit" class="btn btn-success btn-sm">
                                                    Import
                                                </button>
                                            </form>

                                        </div>
                                    </div>
                                </div>

                                <!-- BODY -->
                                <div class="card-body">

                                    @if (session('success'))
                                        <div class="alert alert-success">{{ session('success') }}</div>
                                    @endif

                                    @if (session('error'))
                                        <div class="alert alert-danger">{{ session('error') }}</div>
                                    @endif

                                    <!-- 🔍 SEARCH + PER PAGE -->
                                    <div class="d-flex justify-content-between mb-3 flex-wrap gap-2">

                                        <!-- SEARCH -->
                                        <form method="GET" action="{{ route('admin.user.index') }}"
                                            class="d-flex gap-2">
                                            <input type="text" name="search" value="{{ request('search') }}"
                                                class="form-control form-control-sm"
                                                placeholder="Search name, email, qalam id">

                                            <button class="btn btn-primary btn-sm">Search</button>
                                            <a href="{{ route('admin.user.index') }}"
                                                class="btn btn-dark btn-sm">Reset</a>
                                        </form>


                                        <!-- PER PAGE -->
                                        <form method="GET" action="{{ route('admin.user.index') }}">
                                            <select name="per_page" onchange="this.form.submit()"
                                                class="form-control form-control-sm">

                                                <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10
                                                </option>
                                                <option value="20" {{ $perPage == 20 ? 'selected' : '' }}>20
                                                </option>
                                                <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50
                                                </option>
                                                <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>100
                                                </option>

                                            </select>
                                        </form>

                                    </div>

                                    <!-- FORM -->
                                    <form method="POST">
                                        @csrf

                                        <!-- BULK ACTIONS -->
                                        <div class="mb-3 d-flex gap-2">

                                            <button type="submit"
                                                formaction="{{ route('admin.user.export.selected') }}"
                                                class="btn btn-dark btn-sm">
                                                Export Selected
                                            </button>

                                            <button type="submit"
                                                formaction="{{ route('admin.user.delete.selected') }}"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Delete selected users?')">
                                                Delete Selected
                                            </button>

                                        </div>

                                        <!-- TABLE -->
                                        <table class="table table-bordered table-hover align-middle">

                                            <thead>
                                                <tr>
                                                    <th>
                                                        <input type="checkbox" id="select-all">
                                                    </th>
                                                    <th>#</th>
                                                    <th>Image</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Role</th>
                                                    <th>Qalam ID</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>

                                                @forelse($users as $key => $user)
                                                    <tr>
                                                        <td>
                                                            <input type="checkbox" name="ids[]"
                                                                value="{{ $user->id }}" class="user-checkbox">
                                                        </td>

                                                        <td>{{ $users->firstItem() + $key }}</td>

                                                        <td>
                                                            @if ($user->image)
                                                                <img src="{{ asset('admin/asset/profilephoto/' . $user->image) }}"
                                                                    width="50" height="50"
                                                                    style="object-fit:cover;border-radius:50%;">
                                                            @else
                                                                N/A
                                                            @endif
                                                        </td>

                                                        <td>{{ $user->name }}</td>
                                                        <td>{{ $user->email }}</td>

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

                                                        <td>{{ $user->qalam_id ?? 'N/A' }}</td>

                                                        <td class="d-flex gap-1">

                                                            <a href="{{ route('admin.user.edit', $user->id) }}"
                                                                class="btn btn-warning btn-sm">
                                                                Edit
                                                            </a>
                                                            <a href="{{ route('admin.user.destroy', $user->id) }}"
                                                                class="btn btn-danger btn-sm">
                                                                Delete
                                                            </a>

                                                        </td>
                                                    </tr>

                                                @empty
                                                    <tr>
                                                        <td colspan="8" class="text-center">No users found</td>
                                                    </tr>
                                                @endforelse

                                            </tbody>
                                        </table>

                                    </form>

                                </div>

                                <!-- PAGINATION -->
                                <div class="d-flex justify-content-end m-3">
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
            document.querySelectorAll('.user-checkbox').forEach(cb => cb.checked = this.checked);
        });
    </script>
