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
                    <div class="page-header mb-3">
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
                                <div class="card-header bg-white border-bottom">
                                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">

                                        <div>
                                            <h5 class="mb-1 fw-bold">User Profiles</h5>
                                            <small class="text-muted">
                                                Total Users:
                                                <span class="fw-bold text-dark">{{ $users->total() }}</span>
                                            </small>
                                        </div>

                                        <div class="d-flex flex-wrap gap-2 align-items-center">

                                            <!-- EXPORT ALL -->
                                            <a href="{{ route('admin.user.export') }}" class="btn btn-dark btn-sm">
                                                Export All
                                            </a>

                                            <!-- IMPORT -->
                                            <form action="{{ route('admin.user.import') }}" method="POST"
                                                enctype="multipart/form-data" class="d-flex gap-2 m-0">
                                                @csrf

                                                <input type="file" name="file"
                                                    class="form-control form-control-sm" required
                                                    style="max-width:200px;">

                                                <button type="submit" class="btn btn-success btn-sm">
                                                    Import
                                                </button>

                                            </form>

                                        </div>

                                    </div>
                                </div>

                                <!-- BODY -->
                                <div class="card-body">

                                    @include('layouts.admin.alert')

                                    <!-- SEARCH -->
                                    <div class="d-flex justify-content-between flex-wrap gap-2 mb-3">

                                        <form method="GET" action="{{ route('admin.user.index') }}"
                                            class="d-flex gap-2">

                                            <input type="text" name="search" value="{{ request('search') }}"
                                                class="form-control form-control-sm" placeholder="Search users...">

                                            <button class="btn btn-primary btn-sm">
                                                Search
                                            </button>

                                            <a href="{{ route('admin.user.index') }}" class="btn btn-secondary btn-sm">
                                                Reset
                                            </a>

                                        </form>

                                    </div>

                                    <!-- ✅ BULK FORM START (IMPORTANT FIX) -->
                                    <form method="POST" id="bulkForm">
                                        @csrf

                                        <div class="border rounded bg-light p-3">

                                            <!-- ACTION BUTTONS -->
                                            <div class="d-flex justify-content-between flex-wrap gap-2 mb-3">

                                                <h6 class="fw-bold mb-0">Users Table</h6>

                                                <div class="d-flex gap-2">

                                                    <!-- EXPORT SELECTED -->
                                                    <button type="submit"
                                                        formaction="{{ route('admin.user.export.selected') }}"
                                                        class="btn btn-dark btn-sm">
                                                        Export Selected
                                                    </button>

                                                    <!-- DELETE SELECTED -->
                                                    <button type="submit"
                                                        formaction="{{ route('admin.user.delete.selected') }}"
                                                        class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure you want to delete selected users?')">
                                                        Delete Selected
                                                    </button>

                                                </div>

                                            </div>

                                            <!-- TABLE -->
                                            <div class="table-responsive">

                                                <table
                                                    class="table table-hover table-bordered align-middle bg-white mb-0">

                                                    <thead class="table-light">
                                                        <tr>
                                                            <th width="40">
                                                                <input type="checkbox" id="select-all">
                                                            </th>
                                                            <th>#</th>
                                                            <th>Qalam ID</th>
                                                            <th>Name</th>
                                                            <th>Email</th>
                                                            <th>Phone</th>
                                                            <th>Image</th>
                                                            <th>Role</th>

                                                            <th width="150">Action</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>

                                                        @forelse($users as $key => $user)
                                                            <tr>

                                                                <!-- ✅ MUST BE INSIDE FORM -->
                                                                <td>
                                                                    <input type="checkbox" name="ids[]"
                                                                        value="{{ $user->id }}"
                                                                        class="user-checkbox">
                                                                </td>

                                                                <td>{{ $users->firstItem() + $key }}</td>
                                                                  <td>{{ $user->qalam_id ?? 'N/A' }}</td>


                                                                <td>{{ $user->name }}</td>
                                                                <td>{{ $user->email }}</td>
                                                                <td>{{ $user->phone }}</td>

                                                                <td>
                                                                    @if ($user->image)
                                                                        <img src="{{ asset('admin/asset/profilephoto/' . $user->image) }}"
                                                                            width="40" height="40"
                                                                            class="rounded-circle border"
                                                                            style="object-fit: cover;">
                                                                    @else
                                                                        N/A
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @php
                                                                        $role = strtolower($user->role);
                                                                        $badge = match ($role) {
                                                                            'admin' => 'bg-success',
                                                                            'donor' => 'bg-danger',
                                                                            'beneficiary' => 'bg-info',
                                                                            default => 'bg-secondary',
                                                                        };
                                                                    @endphp

                                                                    <span class="badge {{ $badge }}">
                                                                        {{ ucfirst($user->role) }}
                                                                    </span>
                                                                </td>



                                                                <td class="d-flex gap-1">

                                                                    <a href="{{ route('admin.user.edit', $user->id) }}"
                                                                        class="btn btn-warning btn-sm">
                                                                        Edit
                                                                    </a>

                                                                    <a href="{{ route('admin.user.destroy', $user->id) }}"
                                                                        class="btn btn-danger btn-sm"
                                                                        onclick="return confirm('Delete this user?')">
                                                                        Delete
                                                                    </a>

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

                                            </div>

                                        </div>

                                    </form>
                                    <!-- ✅ BULK FORM END -->

                                </div>

                                <!-- PAGINATION -->
                                <div class="card-footer bg-white border-top d-flex justify-content-between">

                                    <small class="text-muted">
                                        Total: <strong>{{ $users->total() }}</strong>
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

    <script>
        document.getElementById('select-all').addEventListener('click', function() {
            document.querySelectorAll('.user-checkbox').forEach(cb => {
                cb.checked = this.checked;
            });
        });
    </script>

</body>
