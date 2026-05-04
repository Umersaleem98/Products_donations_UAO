@include('layouts.admin.head')
<title>Update profiles</title>
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
                                <i class="mdi mdi-home"></i>
                            </span> Donor Profile
                        </h3>
                    </div>

                    <!-- FORM -->
                    <div class="row">
                        <div class="col-md-10">

                            <div class="card">
                                <div class="card-body">

                                    <!-- ALERTS -->
                                    @if(session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif

                                    @if($errors->any())
                                        <div class="alert alert-danger">
                                            <ul class="mb-0">
                                                @foreach($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <form method="POST"
                                          action="{{ route('donor.profile.update') }}"
                                          enctype="multipart/form-data">

                                        @csrf

                                        <!-- ================= USER INFO ================= -->
                                        <h5 class="mb-3">User Information</h5>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label>Name</label>
                                                <input type="text"
                                                       name="name"
                                                       class="form-control form-control-sm"
                                                       placeholder="Enter name"
                                                       value="{{ old('name', $user->name) }}">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Email</label>
                                                <input type="email"
                                                       name="email"
                                                       class="form-control form-control-sm"
                                                       placeholder="Enter email"
                                                       value="{{ old('email', $user->email) }}">
                                            </div>
                                        </div>

                                        <!-- ================= IMAGE ================= -->
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label>Profile Image</label>
                                                <input type="file"
                                                       name="image"
                                                       class="form-control form-control-sm">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Preview</label><br>

                                                @if($user->image)
                                                    <img src="{{ asset('admin/asset/profilephoto/' . $user->image) }}"
                                                         width="100"
                                                         height="100"
                                                         style="object-fit:cover;border-radius:8px;border:1px solid #ddd;">
                                                @else
                                                    <span>No Image</span>
                                                @endif

                                            </div>
                                        </div>

                                        <!-- ================= DONOR PROFILE ================= -->
                                        <h5 class="mb-3 mt-4">Donor Profile</h5>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label>Organization</label>
                                                <input type="text"
                                                       name="organization"
                                                       class="form-control form-control-sm"
                                                       placeholder="Enter organization"
                                                       value="{{ old('organization', optional($user->donorProfile)->organization) }}">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Phone</label>
                                                <input type="text"
                                                       name="phone"
                                                       class="form-control form-control-sm"
                                                       placeholder="Enter phone number"
                                                       value="{{ old('phone', optional($user->donorProfile)->phone) }}">
                                            </div>
                                        </div>

                                        <!-- ================= PASSWORD ================= -->
                                        <h5 class="mb-3 mt-4">Change Password</h5>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label>Current Password</label>
                                                <input type="password"
                                                       name="current_password"
                                                       class="form-control form-control-sm"
                                                       placeholder="Current password">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>New Password</label>
                                                <input type="password"
                                                       name="password"
                                                       class="form-control form-control-sm"
                                                       placeholder="New password">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label>Confirm Password</label>
                                                <input type="password"
                                                       name="password_confirmation"
                                                       class="form-control form-control-sm"
                                                       placeholder="Confirm password">
                                            </div>
                                        </div>

                                        <!-- BUTTON -->
                                        <button class="btn btn-primary btn-sm">
                                            Update Profile
                                        </button>

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