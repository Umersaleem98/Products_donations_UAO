@include('layouts.admin.head')

<body>
    <div class="container-scroller">

        @include('layouts.admin.header')

        <div class="container-fluid page-body-wrapper">

            @include('layouts.admin.sidebar')

            <div class="main-panel">
                <div class="content-wrapper">

                    <!-- HEADER -->
                    <div class="page-header">
                        <h3 class="page-title">
                            <span class="page-title-icon bg-gradient-primary text-white me-2">
                                <i class="mdi mdi-account-edit"></i>
                            </span> Edit User
                        </h3>
                    </div>

                    <!-- FORM -->
                    <div class="row">
                        <div class="col-md-8">

                            <div class="card">
                                <div class="card-body">

                                    <form method="POST" action="{{ route('admin.user.update', $user->id) }}"
                                        enctype="multipart/form-data">

                                        @csrf
                                        @method('PUT')

                                        <!-- NAME -->
                                        <div class="mb-3">
                                            <label>Name</label>
                                            <input type="text" name="name" value="{{ $user->name }}"
                                                class="form-control" required>
                                        </div>

                                        <!-- EMAIL -->
                                        <div class="mb-3">
                                            <label>Email</label>
                                            <input type="email" name="email" value="{{ $user->email }}"
                                                class="form-control" required>
                                        </div>

                                        <!-- PASSWORD (OPTIONAL) -->
                                        <div class="mb-3">
                                            <label>Password (leave blank to keep current)</label>
                                            <input type="password" name="password" class="form-control">
                                        </div>

                                        <!-- ROLE -->
                                        <div class="mb-3">
                                            <label>Role</label>
                                            <select name="role" class="form-control" required>
                                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>
                                                    Admin</option>
                                                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>
                                                    User</option>
                                                <option value="donor" {{ $user->role == 'donor' ? 'selected' : '' }}>
                                                    Donor</option>
                                            </select>
                                        </div>

                                        <!-- QALAM ID -->
                                        <div class="mb-3">
                                            <label>Qalam ID</label>
                                            <input type="text" name="qalam_id" value="{{ $user->qalam_id }}"
                                                class="form-control">
                                        </div>

                                        <!-- CURRENT IMAGE -->
                                        <div class="mb-3">
                                            <label>Current Profile Photo</label><br>

                                            @if ($user->image)
                                                <img src="{{ asset('admin/asset/profilephoto/' . $user->image) }}"
                                                    width="80" height="80"
                                                    style="object-fit:cover;border-radius:50%;">
                                            @else
                                                <p>No image found</p>
                                            @endif
                                        </div>

                                        <!-- NEW IMAGE -->
                                        <div class="mb-3">
                                            <label>Change Profile Photo</label>
                                            <input type="file" name="image" class="form-control">
                                        </div>

                                        <!-- BUTTONS -->
                                        <button type="submit" class="btn btn-success">
                                            Update User
                                        </button>

                                        <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">
                                            Back
                                        </a>

                                    </form>

                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    @include('layouts.admin.script')
