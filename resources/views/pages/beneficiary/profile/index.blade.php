@include('layouts.admin.head')

<title>Beneficiary Profile</title>

<style>
    .card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 0 25px rgba(0, 0, 0, 0.06);
    }

    .card-body {
        padding: 35px;
    }

    .section-title {
        font-size: 18px;
        font-weight: 700;
        color: #222;
        margin-bottom: 25px;
        padding-left: 14px;
        border-left: 4px solid #4B49AC;
    }

    .form-control {
        border-radius: 10px;
        border: 1px solid #d7d7d7;
    }

    .form-control-sm {
        height: 48px;
        font-size: 14px;
    }

    textarea.form-control {
        height: auto;
    }

    label {
        font-weight: 600;
        margin-bottom: 8px;
        color: #333;
    }

    .profile-image {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 12px;
        border: 2px solid #eee;
    }

    .btn-update {
        padding: 11px 35px;
        border-radius: 10px;
        font-size: 15px;
        font-weight: 600;
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

                    <!-- ALERT -->
                    @include('layouts.admin.alert')

                    <!-- FORM SECTION -->
                    <div class="row justify-content-center">

                        <div class="col-lg-12 grid-margin stretch-card">

                            <div class="card">

                                <div class="card-body">

                                    <form method="POST" action="{{ route('Beneficiary.profile.update') }}"
                                        enctype="multipart/form-data">

                                        @csrf

                                        <!-- USER INFORMATION -->
                                        <div class="section-title">User Information</div>

                                        <div class="row">

                                            <div class="col-md-4 mb-4">
                                                <label>Name</label>
                                                <input type="text" name="name"
                                                    class="form-control form-control-sm"
                                                    placeholder="Enter your full name"
                                                    value="{{ old('name', $user->name) }}" readonly>
                                            </div>

                                            <div class="col-md-4 mb-4">
                                                <label>Email</label>
                                                <input type="email" name="email"
                                                    class="form-control form-control-sm"
                                                    placeholder="Enter your email address"
                                                    value="{{ old('email', $user->email) }}" readonly>
                                            </div>

                                            <div class="col-md-4 mb-4">
                                                <label>Phone</label>
                                                <input type="text" name="phone"
                                                    class="form-control form-control-sm"
                                                    placeholder="Enter your phone number"
                                                    value="{{ old('phone', $user->phone) }}" readonly>
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

                                                @if ($user->image)
                                                    <img src="{{ asset('admin/asset/profilephoto/' . $user->image) }}"
                                                        class="profile-image">
                                                @else
                                                    <span class="text-muted">No Image Uploaded</span>
                                                @endif

                                            </div>

                                            <div class="col-md-4 mb-4">
                                                <label>Enrollment Year</label>
                                                <input type="number" name="enrollment_year"
                                                    class="form-control form-control-sm" min="2000" max="2100"
                                                    placeholder="Enter Enrollment Year"
                                                    value="{{ old('enrollment_year', optional($user->beneficiaryProfile)->enrollment_year) }}">
                                            </div>

                                            <div class="col-md-4 mb-4">
                                                <label>Graduation Year</label>
                                                <input type="number" name="graduation_year"
                                                    class="form-control form-control-sm" min="2000" max="2100"
                                                    placeholder="Enter Graduation Year"
                                                    value="{{ old('graduation_year', optional($user->beneficiaryProfile)->graduation_year) }}">
                                            </div>



                                        </div>

                                        <!-- BENEFICIARY INFORMATION -->
                                        <div class="section-title mt-4">Beneficiary Information</div>

                                        <div class="row">

                                            <div class="col-md-4 mb-4">
                                                <label>Institution</label>
                                                <select name="institution" class="form-control form-control-sm">
                                                    <option value="">Select Institution</option>

                                                    @php
                                                        $institution = old(
                                                            'institution',
                                                            optional($user->beneficiaryProfile)->institution,
                                                        );
                                                    @endphp

                                                    <option value="SEECS"
                                                        {{ $institution == 'SEECS' ? 'selected' : '' }}>SEECS</option>
                                                    <option value="SMME"
                                                        {{ $institution == 'SMME' ? 'selected' : '' }}>
                                                        SMME</option>
                                                    <option value="SCME"
                                                        {{ $institution == 'SCME' ? 'selected' : '' }}>
                                                        SCME</option>
                                                    <option value="NBS"
                                                        {{ $institution == 'NBS' ? 'selected' : '' }}>
                                                        NBS</option>
                                                    <option value="SADA"
                                                        {{ $institution == 'SADA' ? 'selected' : '' }}>
                                                        SADA</option>
                                                    <option value="SNS"
                                                        {{ $institution == 'SNS' ? 'selected' : '' }}>
                                                        SNS</option>
                                                    <option value="ASAB"
                                                        {{ $institution == 'ASAB' ? 'selected' : '' }}>ASAB</option>
                                                    <option value="S3H"
                                                        {{ $institution == 'S3H' ? 'selected' : '' }}>
                                                        S3H</option>
                                                    <option value="CEME"
                                                        {{ $institution == 'CEME' ? 'selected' : '' }}>CEME</option>
                                                    <option value="MCS"
                                                        {{ $institution == 'MCS' ? 'selected' : '' }}>
                                                        MCS</option>
                                                    <option value="CAE"
                                                        {{ $institution == 'CAE' ? 'selected' : '' }}>
                                                        CAE</option>
                                                    <option value="PNEC"
                                                        {{ $institution == 'PNEC' ? 'selected' : '' }}>PNEC</option>
                                                    <option value="NBC"
                                                        {{ $institution == 'NBC' ? 'selected' : '' }}>
                                                        NBC</option>
                                                </select>
                                            </div>

                                            <div class="col-md-4 mb-4">
                                                <label>Father Status</label>

                                                @php
                                                    $fatherStatus = old(
                                                        'father_status',
                                                        optional($user->beneficiaryProfile)->father_status,
                                                    );
                                                @endphp

                                                <select name="father_status" class="form-control form-control-sm">
                                                    <option value="">Select Status</option>
                                                    <option value="Alive"
                                                        {{ $fatherStatus == 'Alive' ? 'selected' : '' }}>Alive</option>
                                                    <option value="Deceased"
                                                        {{ $fatherStatus == 'Deceased' ? 'selected' : '' }}>Deceased
                                                    </option>
                                                </select>
                                            </div>

                                            <div class="col-md-4 mb-4">
                                                <label>Guardian Profession</label>
                                                <input type="text" name="guardian_profession"
                                                    class="form-control form-control-sm"
                                                    placeholder="Enter guardian profession"
                                                    value="{{ old('guardian_profession', optional($user->beneficiaryProfile)->guardian_profession) }}">
                                            </div>

                                            <div class="col-md-4 mb-4">
                                                <label>Monthly Income</label>
                                                <input type="number" step="0.01" name="monthly_income"
                                                    class="form-control form-control-sm"
                                                    placeholder="Enter monthly income"
                                                    value="{{ old('monthly_income', optional($user->beneficiaryProfile)->monthly_income) }}">
                                            </div>

                                            <div class="col-md-4 mb-4">
                                                <label>Province</label>

                                                @php
                                                    $province = old(
                                                        'province',
                                                        optional($user->beneficiaryProfile)->province,
                                                    );
                                                @endphp

                                                <select name="province" class="form-control form-control-sm">
                                                    <option value="">Select Province</option>

                                                    <option value="Punjab"
                                                        {{ $province == 'Punjab' ? 'selected' : '' }}>
                                                        Punjab</option>
                                                    <option value="Sindh"
                                                        {{ $province == 'Sindh' ? 'selected' : '' }}>
                                                        Sindh</option>
                                                    <option value="Khyber Pakhtunkhwa"
                                                        {{ $province == 'Khyber Pakhtunkhwa' ? 'selected' : '' }}>
                                                        Khyber
                                                        Pakhtunkhwa</option>
                                                    <option value="Balochistan"
                                                        {{ $province == 'Balochistan' ? 'selected' : '' }}>Balochistan
                                                    </option>
                                                    <option value="Gilgit Baltistan"
                                                        {{ $province == 'Gilgit Baltistan' ? 'selected' : '' }}>Gilgit
                                                        Baltistan</option>
                                                    <option value="Azad Jammu & Kashmir"
                                                        {{ $province == 'Azad Jammu & Kashmir' ? 'selected' : '' }}>
                                                        Azad
                                                        Jammu & Kashmir</option>
                                                    <option value="Islamabad Capital Territory"
                                                        {{ $province == 'Islamabad Capital Territory' ? 'selected' : '' }}>
                                                        Islamabad Capital Territory</option>
                                                </select>
                                            </div>

                                            <div class="col-md-4 mb-4">
                                                <label>Domicile</label>
                                                <input type="text" name="domicile"
                                                    class="form-control form-control-sm" placeholder="Enter domicile"
                                                    value="{{ old('domicile', optional($user->beneficiaryProfile)->domicile) }}">
                                            </div>

                                            <div class="col-md-12 mb-4">
                                                <label>Home Address</label>
                                                <textarea name="home_address" rows="4" class="form-control" placeholder="Enter complete home address">{{ old('home_address', optional($user->beneficiaryProfile)->home_address) }}</textarea>
                                            </div>

                                        </div>

                                        <!-- CHANGE PASSWORD -->
                                        <div class="section-title mt-4">Change Password</div>

                                        <div class="row">

                                            <div class="col-md-4 mb-4">
                                                <label>Current Password</label>
                                                <input type="password" name="current_password"
                                                    class="form-control form-control-sm"
                                                    placeholder="Enter current password">
                                            </div>

                                            <div class="col-md-4 mb-4">
                                                <label>New Password</label>
                                                <input type="password" name="password"
                                                    class="form-control form-control-sm"
                                                    placeholder="Enter new password">
                                            </div>

                                            <div class="col-md-4 mb-4">
                                                <label>Confirm Password</label>
                                                <input type="password" name="password_confirmation"
                                                    class="form-control form-control-sm"
                                                    placeholder="Confirm new password">
                                            </div>

                                        </div>

                                        <button type="submit" class="btn btn-primary btn-update mt-3">
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
