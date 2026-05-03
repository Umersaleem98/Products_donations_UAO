@include('layouts.admin.head')

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

                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item active">
                                    Overview
                                </li>
                            </ul>
                        </nav>
                    </div>

                    <!-- USERS TABLE -->
                    <div class="row">
                        <div class="col-12">

                            <div class="card shadow-sm">

                                <!-- HEADER -->
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5>User Profiles</h5>

                                    <a href="{{ route('admin.user.create') }}"
                                       class="btn btn-primary btn-sm">
                                        + Add User
                                    </a>
                                </div>

                                <!-- BODY -->
                                <div class="card-body">

                                    @if(session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif

                                    <table class="table table-bordered table-hover align-middle">

                                        <thead>
                                            <tr>
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
                                                <td>{{ $key + 1 }}</td>

                                                <!-- IMAGE -->
                                                <td>
                                                    @if($user->image)
                                                        <img src="{{ asset('admin/asset/profilephoto/'.$user->image) }}"
                                                             width="60"
                                                             height="60"
                                                             style="object-fit:cover;border-radius:50%;">
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>

                                                <!-- NAME -->
                                                <td>{{ $user->name }}</td>

                                                <!-- EMAIL -->
                                                <td>{{ $user->email }}</td>

                                                <!-- ROLE -->
                                                <td>
                                                    <span class="badge bg-info text-dark">
                                                        {{ ucfirst($user->role) }}
                                                    </span>
                                                </td>

                                                <!-- QALAM ID -->
                                                <td>{{ $user->qalam_id ?? 'N/A' }}</td>

                                                <!-- ACTION -->
                                                <td>

                                                    <a href="{{ route('admin.user.edit', $user->id) }}"
                                                       class="btn btn-warning btn-sm">
                                                        Edit
                                                    </a>

                                                    <form action="{{ route('admin.user.destroy', $user->id) }}"
                                                          method="POST"
                                                          style="display:inline-block">

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
                                                <td colspan="7" class="text-center">
                                                    No users found
                                                </td>
                                            </tr>

                                        @endforelse

                                        </tbody>

                                    </table>

                                </div>

                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

@include('layouts.admin.script')