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
                            <i class="mdi mdi-account-plus"></i>
                        </span> Create User
                    </h3>
                </div>

                <!-- FORM -->
                <div class="row">
                    <div class="col-md-8">

                        <div class="card">
                            <div class="card-body">

                                <form method="POST"
                                      action="{{ route('admin.user.store') }}"
                                      enctype="multipart/form-data">

                                    @csrf

                                    <!-- NAME -->
                                    <div class="mb-3">
                                        <label>Name</label>
                                        <input type="text" name="name" class="form-control" required>
                                    </div>

                                    <!-- EMAIL -->
                                    <div class="mb-3">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control" required>
                                    </div>

                                    <!-- PASSWORD -->
                                    <div class="mb-3">
                                        <label>Password</label>
                                        <input type="password" name="password" class="form-control" required>
                                    </div>

                                    <!-- ROLE -->
                                    <div class="mb-3">
                                        <label>Role</label>
                                        <select name="role" class="form-control" required>
                                            <option value="">Select Role</option>
                                            <option value="admin">Admin</option>
                                            <option value="user">User</option>
                                            <option value="donor">Donor</option>
                                        </select>
                                    </div>

                                    <!-- QALAM ID -->
                                    <div class="mb-3">
                                        <label>Qalam ID</label>
                                        <input type="text" name="qalam_id" class="form-control">
                                    </div>

                                    <!-- IMAGE -->
                                    <div class="mb-3">
                                        <label>Profile Photo</label>
                                        <input type="file" name="image" class="form-control">
                                    </div>

                                    <!-- BUTTONS -->
                                    <button type="submit" class="btn btn-primary">
                                        Save User
                                    </button>

                                    <a href="{{ route('admin.user.index') }}"
                                       class="btn btn-secondary">
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