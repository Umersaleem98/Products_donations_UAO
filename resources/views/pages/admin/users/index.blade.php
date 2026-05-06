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

                                    <!-- RIGHT SIDE CONTROLS -->
                                    <div class="d-flex align-items-center gap-2 flex-wrap">

                                        <!-- EXPORT ALL -->
                                        <a href="{{ route('admin.user.export') }}"
                                           class="btn btn-dark btn-sm d-flex align-items-center">
                                            Export All
                                        </a>

                                        <!-- IMPORT -->
                                        <form action="{{ route('admin.user.import') }}"
                                              method="POST"
                                              enctype="multipart/form-data"
                                              class="d-flex align-items-center gap-2 mb-0">
                                            @csrf

                                            <input type="file"
                                                   name="file"
                                                   class="form-control form-control-sm"
                                                   style="height: 38px; width: 180px;"
                                                   required>

                                            <button type="submit"
                                                    class="btn btn-success btn-sm"
                                                    style="height: 38px;">
                                                Import
                                            </button>
                                        </form>

                                        <!-- ADD USER -->
                                        <a href="{{ route('admin.user.create') }}"
                                           class="btn btn-primary btn-sm d-flex align-items-center">
                                            + Add User
                                        </a>

                                    </div>
                                </div>
                            </div>

                            <!-- BODY -->
                            <div class="card-body">

                                @if(session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @endif

                                @if(session('error'))
                                    <div class="alert alert-danger">{{ session('error') }}</div>
                                @endif

                                <!-- EXPORT SELECTED -->
                                <form action="{{ route('admin.user.export.selected') }}" method="POST">
                                    @csrf

                                    <div class="mb-3">
                                        <button type="submit"
                                                class="btn btn-dark btn-sm"
                                                style="height: 38px;">
                                            Export Selected
                                        </button>
                                    </div>

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
                                                    <input type="checkbox" name="ids[]" value="{{ $user->id }}" class="user-checkbox">
                                                </td>

                                                <td>{{ $key + 1 }}</td>

                                                <td>
                                                    @if($user->image)
                                                        <img src="{{ asset('admin/asset/profilephoto/'.$user->image) }}"
                                                             width="50" height="50"
                                                             style="object-fit:cover;border-radius:50%;">
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>

                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>

                                                <td>
                                                    <span class="badge bg-info text-dark">
                                                        {{ ucfirst($user->role) }}
                                                    </span>
                                                </td>

                                                <td>{{ $user->qalam_id ?? 'N/A' }}</td>

                                                <td class="d-flex gap-1">

                                                    <a href="{{ route('admin.user.edit', $user->id) }}"
                                                       class="btn btn-warning btn-sm">
                                                        Edit
                                                    </a>

                                                    <!-- FIXED DELETE -->
                                                    <form action="{{ route('admin.user.destroy', $user->id) }}"
                                                          method="POST">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Are you sure?')">
                                                            Delete
                                                        </button>
                                                    </form>

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
document.getElementById('select-all').addEventListener('click', function () {
    document.querySelectorAll('.user-checkbox').forEach(cb => cb.checked = this.checked);
});
</script>