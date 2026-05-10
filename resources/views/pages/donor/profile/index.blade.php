@include('layouts.admin.head')

<title>Update Profile</title>

<style>

    .card{
        border-radius:20px;
        border:none;
        box-shadow:0 0 25px rgba(0,0,0,0.07);
    }

    .card-body{
        padding:35px;
    }

    .form-control{
        border-radius:10px;
        border:1px solid #dcdcdc;
    }

    .form-control-sm{
        height:48px;
        font-size:14px;
    }

    textarea.form-control{
        height:auto;
    }

    label{
        font-weight:600;
        margin-bottom:8px;
        color:#333;
    }

    .profile-image{
        width:120px;
        height:120px;
        object-fit:cover;
        border-radius:12px;
        border:2px solid #eee;
    }

    .section-title{
        font-size:18px;
        font-weight:700;
        margin-bottom:25px;
        color:#222;
        border-left:4px solid #4B49AC;
        padding-left:12px;
    }

    .btn-update{
        padding:10px 35px;
        border-radius:10px;
        font-weight:600;
        font-size:15px;
    }

</style>

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

                        Donor Profile

                    </h3>

                </div>

                <!-- FORM SECTION -->
                <div class="row justify-content-center">

                    <div class="col-lg-12 grid-margin stretch-card">

                        <div class="card">

                            <div class="card-body">

                               

                                @include('layouts.admin.alert')

                                <form method="POST"
                                      action="{{ route('donor.profile.update') }}"
                                      enctype="multipart/form-data">

                                    @csrf

                                    <!-- USER INFORMATION -->

                                    <div class="section-title">
                                        User Information
                                    </div>

                                    <div class="row">

                                        <div class="col-md-4 mb-4">

                                            <label>Name</label>

                                            <input type="text"
                                                   name="name"
                                                   class="form-control form-control-sm"
                                                   placeholder="Enter name"
                                                   value="{{ old('name', $user->name) }}">

                                        </div>

                                        <div class="col-md-4 mb-4">

                                            <label>Email</label>

                                            <input type="email"
                                                   name="email"
                                                   class="form-control form-control-sm"
                                                   placeholder="Enter email"
                                                   value="{{ old('email', $user->email) }}">

                                        </div>

                                    </div>

                                    <!-- PROFILE IMAGE -->

                                    <div class="section-title mt-4">
                                        Profile Image
                                    </div>

                                    <div class="row align-items-center">

                                        <div class="col-md-4 mb-4">

                                            <label>Upload Image</label>

                                            <input type="file"
                                                   name="image"
                                                   class="form-control form-control-sm">

                                        </div>

                                        <div class="col-md-4 mb-4">

                                            <label>Preview</label>

                                            <div class="mt-2">

                                                @if($user->image)

                                                    <img src="{{ asset('admin/asset/profilephoto/' . $user->image) }}"
                                                         class="profile-image">

                                                @else

                                                    <span class="text-muted">
                                                        No Image Uploaded
                                                    </span>

                                                @endif

                                            </div>

                                        </div>

                                    </div>

                                    <!-- DONOR PROFILE -->

                                    <div class="section-title mt-4">
                                        Donor Profile
                                    </div>

                                    <div class="row">

                                        <div class="col-md-4 mb-4">

                                            <label>Organization</label>

                                            <input type="text"
                                                   name="organization"
                                                   class="form-control form-control-sm"
                                                   placeholder="Enter organization"
                                                   value="{{ old('organization', optional($user->donorProfile)->organization) }}">

                                        </div>

                                        <div class="col-md-4 mb-4">

                                            <label>Designation</label>

                                            <input type="text"
                                                   name="designation"
                                                   class="form-control form-control-sm"
                                                   placeholder="Enter designation"
                                                   value="{{ old('designation', optional($user->donorProfile)->designation) }}">

                                        </div>

                                        <div class="col-md-4 mb-4">

                                            <label>Country</label>

                                            <input type="text"
                                                   name="country"
                                                   class="form-control form-control-sm"
                                                   placeholder="Enter country"
                                                   value="{{ old('country', optional($user->donorProfile)->country) }}">

                                        </div>

                                        <div class="col-md-12 mb-4">

                                            <label>Address</label>

                                            <textarea name="address"
                                                      class="form-control"
                                                      rows="4"
                                                      placeholder="Enter address">{{ old('address', optional($user->donorProfile)->address) }}</textarea>

                                        </div>

                                    </div>

                                    <!-- PASSWORD SECTION -->

                                    <div class="section-title mt-4">
                                        Change Password
                                    </div>

                                    <div class="row">

                                        <div class="col-md-4 mb-4">

                                            <label>Current Password</label>

                                            <input type="password"
                                                   name="current_password"
                                                   class="form-control form-control-sm"
                                                   placeholder="Current password">

                                        </div>

                                        <div class="col-md-4 mb-4">

                                            <label>New Password</label>

                                            <input type="password"
                                                   name="password"
                                                   class="form-control form-control-sm"
                                                   placeholder="New password">

                                        </div>

                                        <div class="col-md-4 mb-4">

                                            <label>Confirm Password</label>

                                            <input type="password"
                                                   name="password_confirmation"
                                                   class="form-control form-control-sm"
                                                   placeholder="Confirm password">

                                        </div>

                                    </div>

                                    <!-- BUTTON -->

                                    <div class="mt-4">

                                        <button type="submit"
                                                class="btn btn-primary btn-update">

                                            Update Profile

                                        </button>

                                    </div>

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

