@include('layouts.admin.head')

<title>Create User</title>

<body>

    {{-- New Sidebar --}}
    @include('layouts.admin.sidebar')


    {{-- Main Content --}}
    <div class="nsn-main">

        {{-- New Topbar --}}
        @include('layouts.admin.header')


        <main class="nsn-content">

            {{-- Page Header --}}
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">

                <div>
                    <h3 class="fw-bold text-dark mb-1">
                        Create User
                    </h3>

                    <p class="text-secondary small mb-0">
                        Create a new administrator, donor or beneficiary account.
                    </p>
                </div>

                <a
                    href="{{ route('admin.user.index') }}"
                    class="btn btn-light border d-flex align-items-center gap-2"
                >
                    <i class="bi bi-arrow-left"></i>
                    <span>Back to Users</span>
                </a>

            </div>


            {{-- Breadcrumb --}}
            <nav aria-label="breadcrumb" class="mb-4">

                <ol class="breadcrumb small mb-0">

                    <li class="breadcrumb-item">
                        <a
                            href="{{ route('dashboard') }}"
                            class="text-decoration-none"
                        >
                            <i class="bi bi-house-door me-1"></i>
                            Dashboard
                        </a>
                    </li>

                    <li class="breadcrumb-item">
                        <a
                            href="{{ route('admin.user.index') }}"
                            class="text-decoration-none"
                        >
                            Users
                        </a>
                    </li>

                    <li
                        class="breadcrumb-item active"
                        aria-current="page"
                    >
                        Create User
                    </li>

                </ol>

            </nav>


            {{-- Alerts --}}
            @include('layouts.admin.alert')


            <div class="row justify-content-center">

                <div class="col-12 col-xl-10">

                    <form
                        method="POST"
                        action="{{ route('admin.user.store') }}"
                        enctype="multipart/form-data"
                    >
                        @csrf


                        <div class="row g-4">

                            {{-- User Information --}}
                            <div class="col-12 col-lg-8">

                                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

                                    {{-- Card Header --}}
                                    <div class="card-header bg-white border-bottom px-4 py-3">

                                        <div class="d-flex align-items-center gap-3">

                                            <span
                                                class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary-subtle text-primary flex-shrink-0"
                                                style="width: 46px; height: 46px;"
                                            >
                                                <i class="bi bi-person-plus fs-5"></i>
                                            </span>

                                            <div>
                                                <h5 class="fw-semibold text-dark mb-1">
                                                    Account Information
                                                </h5>

                                                <p class="text-secondary small mb-0">
                                                    Enter the user’s personal and login information.
                                                </p>
                                            </div>

                                        </div>

                                    </div>


                                    {{-- Card Body --}}
                                    <div class="card-body p-4">

                                        <div class="row g-4">

                                            {{-- Name --}}
                                            <div class="col-12 col-md-6">

                                                <label
                                                    for="userName"
                                                    class="form-label fw-semibold"
                                                >
                                                    Full Name
                                                    <span class="text-danger">*</span>
                                                </label>

                                                <div class="input-group">

                                                    <span class="input-group-text bg-light">
                                                        <i class="bi bi-person"></i>
                                                    </span>

                                                    <input
                                                        type="text"
                                                        id="userName"
                                                        name="name"
                                                        value="{{ old('name') }}"
                                                        class="form-control @error('name') is-invalid @enderror"
                                                        placeholder="Enter full name"
                                                        autocomplete="name"
                                                        required
                                                        autofocus
                                                    >

                                                    @error('name')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror

                                                </div>

                                            </div>


                                            {{-- Email --}}
                                            <div class="col-12 col-md-6">

                                                <label
                                                    for="userEmail"
                                                    class="form-label fw-semibold"
                                                >
                                                    Email Address
                                                    <span class="text-danger">*</span>
                                                </label>

                                                <div class="input-group">

                                                    <span class="input-group-text bg-light">
                                                        <i class="bi bi-envelope"></i>
                                                    </span>

                                                    <input
                                                        type="email"
                                                        id="userEmail"
                                                        name="email"
                                                        value="{{ old('email') }}"
                                                        class="form-control @error('email') is-invalid @enderror"
                                                        placeholder="Enter email address"
                                                        autocomplete="email"
                                                        required
                                                    >

                                                    @error('email')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror

                                                </div>

                                            </div>


                                            {{-- Phone --}}
                                            <div class="col-12 col-md-6">

                                                <label
                                                    for="userPhone"
                                                    class="form-label fw-semibold"
                                                >
                                                    Phone Number
                                                    <span class="text-danger">*</span>
                                                </label>

                                                <div class="input-group">

                                                    <span class="input-group-text bg-light">
                                                        <i class="bi bi-telephone"></i>
                                                    </span>

                                                    <input
                                                        type="tel"
                                                        id="userPhone"
                                                        name="phone"
                                                        value="{{ old('phone') }}"
                                                        class="form-control @error('phone') is-invalid @enderror"
                                                        placeholder="For example: 03001234567"
                                                        autocomplete="tel"
                                                        required
                                                    >

                                                    @error('phone')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror

                                                </div>

                                            </div>


                                            {{-- Password --}}
                                            <div class="col-12 col-md-6">

                                                <label
                                                    for="userPassword"
                                                    class="form-label fw-semibold"
                                                >
                                                    Password
                                                    <span class="text-danger">*</span>
                                                </label>

                                                <div class="input-group">

                                                    <span class="input-group-text bg-light">
                                                        <i class="bi bi-lock"></i>
                                                    </span>

                                                    <input
                                                        type="password"
                                                        id="userPassword"
                                                        name="password"
                                                        class="form-control @error('password') is-invalid @enderror"
                                                        placeholder="Enter password"
                                                        autocomplete="new-password"
                                                        required
                                                    >

                                                    <button
                                                        type="button"
                                                        id="togglePassword"
                                                        class="btn btn-outline-secondary"
                                                        aria-label="Show or hide password"
                                                    >
                                                        <i
                                                            id="passwordIcon"
                                                            class="bi bi-eye"
                                                        ></i>
                                                    </button>

                                                    @error('password')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror

                                                </div>

                                                <div class="form-text">
                                                    Use at least 8 characters for a secure password.
                                                </div>

                                            </div>


                                            {{-- Role --}}
                                            <div class="col-12 col-md-6">

                                                <label
                                                    for="role"
                                                    class="form-label fw-semibold"
                                                >
                                                    User Role
                                                    <span class="text-danger">*</span>
                                                </label>

                                                <select
                                                    name="role"
                                                    id="role"
                                                    class="form-select @error('role') is-invalid @enderror"
                                                    required
                                                >
                                                    <option value="">
                                                        Select role
                                                    </option>

                                                    <option
                                                        value="admin"
                                                        @selected(old('role') === 'admin')
                                                    >
                                                        Admin
                                                    </option>

                                                    <option
                                                        value="beneficiary"
                                                        @selected(old('role') === 'beneficiary')
                                                    >
                                                        Beneficiary
                                                    </option>

                                                    <option
                                                        value="donor"
                                                        @selected(old('role') === 'donor')
                                                    >
                                                        Donor
                                                    </option>
                                                </select>

                                                @error('role')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror

                                                <div class="form-text">
                                                    The role determines the user’s portal access.
                                                </div>

                                            </div>


                                            {{-- Qalam ID --}}
                                            <div
                                                class="col-12 col-md-6 d-none"
                                                id="qalamIdWrapper"
                                            >
                                                <label
                                                    for="qalam_id"
                                                    class="form-label fw-semibold"
                                                >
                                                    Qalam ID
                                                    <span class="text-danger">*</span>
                                                </label>

                                                <div class="input-group">

                                                    <span class="input-group-text bg-light">
                                                        <i class="bi bi-person-badge"></i>
                                                    </span>

                                                    <input
                                                        type="text"
                                                        name="qalam_id"
                                                        id="qalam_id"
                                                        value="{{ old('qalam_id') }}"
                                                        class="form-control @error('qalam_id') is-invalid @enderror"
                                                        placeholder="Enter beneficiary Qalam ID"
                                                    >

                                                    @error('qalam_id')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror

                                                </div>

                                                <div class="form-text">
                                                    Qalam ID is required only for beneficiaries.
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>


                            {{-- Profile Photo --}}
                            <div class="col-12 col-lg-4">

                                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">

                                    <div class="card-header bg-white border-bottom px-4 py-3">

                                        <h5 class="fw-semibold text-dark mb-1">
                                            Profile Photo
                                        </h5>

                                        <p class="text-secondary small mb-0">
                                            Upload an optional user profile image.
                                        </p>

                                    </div>


                                    <div class="card-body p-4">

                                        {{-- Image Preview --}}
                                        <div class="text-center mb-4">

                                            <span
                                                id="defaultAvatar"
                                                class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary-subtle text-primary fw-bold fs-2"
                                                style="width: 120px; height: 120px;"
                                            >
                                                <i class="bi bi-person"></i>
                                            </span>

                                            <img
                                                id="imagePreview"
                                                src=""
                                                alt="Profile preview"
                                                width="120"
                                                height="120"
                                                class="rounded-circle border border-3 object-fit-cover d-none"
                                            >

                                        </div>


                                        <label
                                            for="profileImage"
                                            class="form-label fw-semibold"
                                        >
                                            Select Image
                                        </label>

                                        <input
                                            type="file"
                                            id="profileImage"
                                            name="image"
                                            class="form-control @error('image') is-invalid @enderror"
                                            accept="image/jpeg,image/png,image/jpg,image/webp"
                                        >

                                        @error('image')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                        <div class="form-text">
                                            Accepted formats: JPG, PNG and WebP.
                                        </div>

                                    </div>

                                </div>

                            </div>


                            {{-- Form Actions --}}
                            <div class="col-12">

                                <div class="card border-0 shadow-sm rounded-4">

                                    <div class="card-body px-4 py-3">

                                        <div class="d-flex flex-column-reverse flex-sm-row align-items-sm-center justify-content-between gap-3">

                                            <p class="text-secondary small mb-0">
                                                <i class="bi bi-info-circle me-1"></i>
                                                Fields marked with an asterisk are required.
                                            </p>

                                            <div class="d-flex flex-column-reverse flex-sm-row gap-2">

                                                <a
                                                    href="{{ route('admin.user.index') }}"
                                                    class="btn btn-light border"
                                                >
                                                    <i class="bi bi-x-circle me-1"></i>
                                                    Cancel
                                                </a>

                                                <button
                                                    type="submit"
                                                    class="btn btn-primary"
                                                >
                                                    <i class="bi bi-person-check me-1"></i>
                                                    Save User
                                                </button>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </main>

    </div>


    @include('layouts.admin.script')


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const roleSelect = document.getElementById('role');
            const qalamWrapper =
                document.getElementById('qalamIdWrapper');
            const qalamInput = document.getElementById('qalam_id');

            const passwordInput =
                document.getElementById('userPassword');
            const togglePassword =
                document.getElementById('togglePassword');
            const passwordIcon =
                document.getElementById('passwordIcon');

            const profileImage =
                document.getElementById('profileImage');
            const imagePreview =
                document.getElementById('imagePreview');
            const defaultAvatar =
                document.getElementById('defaultAvatar');


            function toggleQalamField() {
                if (!roleSelect || !qalamWrapper || !qalamInput) {
                    return;
                }

                if (roleSelect.value === 'beneficiary') {
                    qalamWrapper.classList.remove('d-none');
                    qalamInput.setAttribute('required', 'required');
                } else {
                    qalamWrapper.classList.add('d-none');
                    qalamInput.removeAttribute('required');
                    qalamInput.value = '';
                }
            }


            if (roleSelect) {
                roleSelect.addEventListener(
                    'change',
                    toggleQalamField
                );

                toggleQalamField();
            }


            if (togglePassword && passwordInput && passwordIcon) {
                togglePassword.addEventListener('click', function () {
                    const passwordHidden =
                        passwordInput.type === 'password';

                    passwordInput.type =
                        passwordHidden ? 'text' : 'password';

                    passwordIcon.classList.toggle(
                        'bi-eye',
                        !passwordHidden
                    );

                    passwordIcon.classList.toggle(
                        'bi-eye-slash',
                        passwordHidden
                    );
                });
            }


            if (
                profileImage &&
                imagePreview &&
                defaultAvatar
            ) {
                profileImage.addEventListener('change', function () {
                    const selectedFile = this.files[0];

                    if (!selectedFile) {
                        imagePreview.src = '';
                        imagePreview.classList.add('d-none');
                        defaultAvatar.classList.remove('d-none');
                        return;
                    }

                    if (!selectedFile.type.startsWith('image/')) {
                        this.value = '';

                        imagePreview.src = '';
                        imagePreview.classList.add('d-none');
                        defaultAvatar.classList.remove('d-none');

                        alert('Please select a valid image file.');
                        return;
                    }

                    const reader = new FileReader();

                    reader.addEventListener('load', function (event) {
                        imagePreview.src = event.target.result;
                        imagePreview.classList.remove('d-none');
                        defaultAvatar.classList.add('d-none');
                    });

                    reader.readAsDataURL(selectedFile);
                });
            }
        });
    </script>

</body>
