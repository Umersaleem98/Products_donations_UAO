@include('layouts.admin.head')

<title>Beneficiary Profile</title>

<style>

    .card{
        border:none;
        border-radius:20px;
        box-shadow:0 0 25px rgba(0,0,0,0.06);
    }

    .card-body{
        padding:35px;
    }

    .section-title{
        font-size:18px;
        font-weight:700;
        color:#222;
        margin-bottom:25px;
        padding-left:14px;
        border-left:4px solid #4B49AC;
    }

    .form-control{
        border-radius:10px;
        border:1px solid #d7d7d7;
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

    .btn-update{
        padding:11px 35px;
        border-radius:10px;
        font-size:15px;
        font-weight:600;
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
                            <i class="mdi mdi-account-circle"></i>
                        </span>

                        Beneficiary Profile

                    </h3>

                </div>

                <!-- ✅ ALERT INCLUDED HERE (IMPORTANT POSITION) -->
                @include('layouts.admin.alert')

                <!-- FORM SECTION -->
                <div class="row justify-content-center">

                    <div class="col-lg-12 grid-margin stretch-card">

                        <div class="card">

                            <div class="card-body">

                                <form method="POST"
                                      action="{{ route('Beneficiary.profile.update') }}"
                                      enctype="multipart/form-data">

                                    @csrf

                                    <!-- USER INFORMATION -->
                                    <div class="section-title">User Information</div>

                                    <div class="row">

                                        <div class="col-md-4 mb-4">
                                            <label>Name</label>
                                            <input type="text" name="name"
                                                   class="form-control form-control-sm"
                                                   value="{{ old('name', $user->name) }}">
                                        </div>

                                        <div class="col-md-4 mb-4">
                                            <label>Email</label>
                                            <input type="email" name="email"
                                                   class="form-control form-control-sm"
                                                   value="{{ old('email', $user->email) }}">
                                        </div>

                                    </div>

                                    <!-- PROFILE IMAGE -->
                                    <div class="section-title mt-4">Profile Image</div>

                                    <div class="row align-items-center">

                                        <div class="col-md-4 mb-4">
                                            <label>Upload Image</label>
                                            <input type="file" name="image"
                                                   class="form-control form-control-sm">
                                        </div>

                                        <div class="col-md-4 mb-4">
                                            <label>Preview</label>

                                            @if($user->image)
                                                <img src="{{ asset('admin/asset/profilephoto/' . $user->image) }}"
                                                     class="profile-image">
                                            @else
                                                <span class="text-muted">No Image Uploaded</span>
                                            @endif

                                        </div>

                                    </div>

                                    <!-- BENEFICIARY INFO -->
                                    <div class="section-title mt-4">Beneficiary Information</div>

                                    <div class="row">

                                        <div class="col-md-4 mb-4">
                                            <label>Institution</label>
                                            <input type="text" name="institution"
                                                   class="form-control form-control-sm"
                                                   value="{{ old('institution', optional($user->beneficiaryProfile)->institution) }}">
                                        </div>

                                        <div class="col-md-4 mb-4">
                                            <label>Father Status</label>
                                            <input type="text" name="father_status"
                                                   class="form-control form-control-sm"
                                                   value="{{ old('father_status', optional($user->beneficiaryProfile)->father_status) }}">
                                        </div>

                                        <div class="col-md-4 mb-4">
                                            <label>Guardian Profession</label>
                                            <input type="text" name="guardian_profession"
                                                   class="form-control form-control-sm"
                                                   value="{{ old('guardian_profession', optional($user->beneficiaryProfile)->guardian_profession) }}">
                                        </div>

                                        <div class="col-md-4 mb-4">
                                            <label>Monthly Income</label>
                                            <input type="number" step="0.01"
                                                   name="monthly_income"
                                                   class="form-control form-control-sm"
                                                   value="{{ old('monthly_income', optional($user->beneficiaryProfile)->monthly_income) }}">
                                        </div>

                                        <div class="col-md-4 mb-4">
                                            <label>Province</label>
                                            <input type="text" name="province"
                                                   class="form-control form-control-sm"
                                                   value="{{ old('province', optional($user->beneficiaryProfile)->province) }}">
                                        </div>

                                        <div class="col-md-4 mb-4">
                                            <label>Domicile</label>
                                            <input type="text" name="domicile"
                                                   class="form-control form-control-sm"
                                                   value="{{ old('domicile', optional($user->beneficiaryProfile)->domicile) }}">
                                        </div>

                                        <div class="col-md-12 mb-4">
                                            <label>Home Address</label>
                                            <textarea name="home_address"
                                                      rows="4"
                                                      class="form-control">{{ old('home_address', optional($user->beneficiaryProfile)->home_address) }}</textarea>
                                        </div>

                                    </div>

                                    <!-- PASSWORD -->
                                    <div class="section-title mt-4">Change Password</div>

                                    <div class="row">

                                        <div class="col-md-4 mb-4">
                                            <label>Current Password</label>
                                            <input type="password" name="current_password"
                                                   class="form-control form-control-sm">
                                        </div>

                                        <div class="col-md-4 mb-4">
                                            <label>New Password</label>
                                            <input type="password" name="password"
                                                   class="form-control form-control-sm">
                                        </div>

                                        <div class="col-md-4 mb-4">
                                            <label>Confirm Password</label>
                                            <input type="password" name="password_confirmation"
                                                   class="form-control form-control-sm">
                                        </div>

                                    </div>

                                    <button type="submit"
                                            class="btn btn-primary btn-update mt-3">
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

</body>