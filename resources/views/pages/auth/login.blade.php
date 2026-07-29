@include('layouts.admin.head')

<title>Login | NUST Sharing Network</title>

<style>
    :root {
        --primary: #0065a8;
        --primary-dark: #003f6b;
        --primary-light: #eaf5fc;
        --accent: #f5a623;
        --text-dark: #17212b;
        --text-muted: #667481;
        --border: #dce5ec;
        --white: #ffffff;
        --danger-light: #fff2f2;
    }

    * {
        box-sizing: border-box;
    }

    body {
        min-height: 100vh;
        margin: 0;
        color: var(--text-dark);
        background-color: #f4f8fb;
        font-family: inherit;
    }

    .auth-page {
        position: relative;
        display: flex;
        min-height: 100vh;
        overflow: hidden;
    }

    /* Left information panel */
    .auth-information {
        position: relative;
        display: flex;
        flex: 0 0 48%;
        align-items: center;
        padding: 70px;
        overflow: hidden;
        color: var(--white);
        background:
            linear-gradient(
                135deg,
                rgba(0, 63, 107, 0.97),
                rgba(0, 101, 168, 0.90)
            ),
            url('{{ asset("admins/assets/images/backgrounds/nust-campus.jpg") }}')
            center/cover no-repeat;
    }

    .auth-information::before,
    .auth-information::after {
        position: absolute;
        border-radius: 50%;
        content: "";
        pointer-events: none;
    }

    .auth-information::before {
        top: -180px;
        right: -130px;
        width: 420px;
        height: 420px;
        border: 70px solid rgba(255, 255, 255, 0.06);
    }

    .auth-information::after {
        bottom: -180px;
        left: -130px;
        width: 400px;
        height: 400px;
        background: rgba(245, 166, 35, 0.10);
    }

    .information-content {
        position: relative;
        z-index: 2;
        width: 100%;
        max-width: 620px;
        margin: auto;
    }

    .brand-logo-wrapper {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 38px;
        padding: 12px 18px;
        border-radius: 14px;
        background-color: rgba(255, 255, 255, 0.96);
    }

    .brand-logo-wrapper img {
        display: block;
        width: 145px;
        max-height: 70px;
        object-fit: contain;
    }

    .information-badge {
        display: inline-flex;
        gap: 9px;
        align-items: center;
        margin-bottom: 20px;
        padding: 8px 14px;
        border: 1px solid rgba(255, 255, 255, 0.22);
        border-radius: 50px;
        background-color: rgba(255, 255, 255, 0.10);
        font-size: 0.85rem;
        font-weight: 600;
        letter-spacing: 0.4px;
    }

    .information-badge::before {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background-color: var(--accent);
        content: "";
    }

    .information-content h1 {
        max-width: 560px;
        margin-bottom: 20px;
        color: var(--white);
        font-size: clamp(2.3rem, 4vw, 4rem);
        font-weight: 750;
        line-height: 1.12;
    }

    .information-content > p {
        max-width: 560px;
        margin-bottom: 34px;
        color: rgba(255, 255, 255, 0.82);
        font-size: 1.05rem;
        line-height: 1.8;
    }

    .platform-features {
        display: grid;
        gap: 14px;
    }

    .platform-feature {
        display: flex;
        gap: 14px;
        align-items: center;
    }

    .feature-icon {
        display: flex;
        flex: 0 0 40px;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 11px;
        color: var(--primary-dark);
        background-color: var(--accent);
        font-size: 1rem;
        font-weight: 700;
    }

    .feature-content strong {
        display: block;
        margin-bottom: 2px;
        color: var(--white);
        font-size: 0.95rem;
    }

    .feature-content span {
        color: rgba(255, 255, 255, 0.68);
        font-size: 0.84rem;
    }

    /* Right login panel */
    .auth-form-panel {
        position: relative;
        display: flex;
        flex: 1;
        align-items: center;
        justify-content: center;
        padding: 45px 55px;
        background-color: #f7fafc;
    }

    .auth-form-panel::before {
        position: absolute;
        top: 0;
        right: 0;
        width: 220px;
        height: 220px;
        border-radius: 0 0 0 100%;
        background-color: var(--primary-light);
        content: "";
    }

    .login-container {
        position: relative;
        z-index: 2;
        width: 100%;
        max-width: 490px;
    }

    .mobile-logo {
        display: none;
        margin-bottom: 25px;
        text-align: center;
    }

    .mobile-logo img {
        width: 135px;
        max-height: 65px;
        object-fit: contain;
    }

    .login-heading {
        margin-bottom: 28px;
    }

    .login-heading h2 {
        margin-bottom: 9px;
        color: var(--text-dark);
        font-size: 2rem;
        font-weight: 750;
    }

    .login-heading p {
        margin-bottom: 0;
        color: var(--text-muted);
        line-height: 1.6;
    }

    /* Error messages */
    .login-alert {
        margin-bottom: 22px;
        padding: 14px 16px;
        border: 1px solid #f2c5c5;
        border-radius: 12px;
        color: #a12b2b;
        background-color: var(--danger-light);
        font-size: 0.9rem;
    }

    .login-alert ul {
        margin: 0;
        padding-left: 18px;
    }

    /* Form elements */
    .form-field {
        margin-bottom: 18px;
    }

    .form-label {
        display: block;
        margin-bottom: 8px;
        color: var(--text-dark);
        font-size: 0.89rem;
        font-weight: 650;
    }

    .required-mark {
        color: #dc3545;
    }

    .input-wrapper {
        position: relative;
    }

    .input-icon {
        position: absolute;
        top: 50%;
        left: 16px;
        z-index: 2;
        color: #83919d;
        transform: translateY(-50%);
        pointer-events: none;
    }

    .login-control {
        width: 100%;
        height: 52px;
        padding: 10px 16px 10px 45px;
        border: 1px solid var(--border);
        border-radius: 12px;
        outline: none;
        color: var(--text-dark);
        background-color: var(--white);
        font-size: 0.95rem;
        transition:
            border-color 0.2s ease,
            box-shadow 0.2s ease;
    }

    select.login-control {
        cursor: pointer;
    }

    .login-control::placeholder {
        color: #9aa5ae;
    }

    .login-control:hover {
        border-color: #a9bbc8;
    }

    .login-control:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(0, 101, 168, 0.10);
    }

    .login-control.is-invalid {
        border-color: #dc3545;
    }

    .field-error {
        display: block;
        margin-top: 6px;
        color: #dc3545;
        font-size: 0.82rem;
    }

    .password-control {
        padding-right: 50px;
    }

    .password-toggle {
        position: absolute;
        top: 50%;
        right: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 38px;
        height: 38px;
        padding: 0;
        border: 0;
        border-radius: 9px;
        color: #697884;
        background: transparent;
        cursor: pointer;
        transform: translateY(-50%);
        transition: 0.2s ease;
    }

    .password-toggle:hover {
        color: var(--primary);
        background-color: var(--primary-light);
    }

    /* Image CAPTCHA */
    .captcha-box {
        margin-bottom: 18px;
        padding: 17px;
        border: 1px solid var(--border);
        border-radius: 15px;
        background-color: var(--white);
    }

    .captcha-heading {
        display: flex;
        gap: 10px;
        align-items: flex-start;
        margin-bottom: 13px;
    }

    .captcha-heading i {
        margin-top: 3px;
        color: var(--primary);
    }

    .captcha-heading label {
        margin: 0;
        color: var(--text-dark);
        font-size: 0.88rem;
        font-weight: 650;
        line-height: 1.5;
    }

    .captcha-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
    }

    .captcha-item {
        position: relative;
        display: block;
        min-height: 90px;
        margin: 0;
        overflow: hidden;
        border: 2px solid transparent;
        border-radius: 11px;
        background-color: #edf2f5;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .captcha-item:hover {
        border-color: var(--primary);
        transform: translateY(-2px);
    }

    .captcha-item img {
        display: block;
        width: 100%;
        height: 90px;
        object-fit: cover;
    }

    .captcha-item input {
        position: absolute;
        top: 9px;
        left: 9px;
        z-index: 3;
        width: 19px;
        height: 19px;
        accent-color: var(--primary);
        cursor: pointer;
    }

    .captcha-checkmark {
        position: absolute;
        inset: 0;
        border: 3px solid transparent;
        border-radius: 9px;
        pointer-events: none;
    }

    .captcha-item input:checked ~ .captcha-checkmark {
        border-color: var(--primary);
        background-color: rgba(0, 101, 168, 0.10);
    }

    /* Remember row */
    .form-options {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .remember-wrapper {
        display: inline-flex;
        gap: 8px;
        align-items: center;
        color: var(--text-muted);
        font-size: 0.9rem;
        cursor: pointer;
    }

    .remember-wrapper input {
        width: 17px;
        height: 17px;
        margin: 0;
        accent-color: var(--primary);
        cursor: pointer;
    }

    /* Submit button */
    .btn-login {
        display: flex;
        gap: 10px;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 52px;
        padding: 10px 20px;
        border: 0;
        border-radius: 12px;
        color: var(--white);
        background: linear-gradient(
            135deg,
            var(--primary),
            var(--primary-dark)
        );
        font-size: 0.95rem;
        font-weight: 700;
        letter-spacing: 0.5px;
        cursor: pointer;
        transition:
            transform 0.2s ease,
            box-shadow 0.2s ease;
    }

    .btn-login:hover {
        color: var(--white);
        box-shadow: 0 10px 24px rgba(0, 76, 128, 0.25);
        transform: translateY(-2px);
    }

    .btn-login:active {
        box-shadow: none;
        transform: translateY(0);
    }

    .login-support {
        margin-top: 22px;
        color: var(--text-muted);
        font-size: 0.85rem;
        line-height: 1.6;
        text-align: center;
    }

    .login-support i {
        margin-right: 5px;
        color: var(--primary);
    }

    /* Tablet */
    @media (max-width: 991.98px) {
        .auth-information {
            flex-basis: 42%;
            padding: 45px 35px;
        }

        .information-content h1 {
            font-size: 2.5rem;
        }

        .auth-form-panel {
            padding: 40px 35px;
        }
    }

    /* Mobile */
    @media (max-width: 767.98px) {
        .auth-page {
            display: block;
        }

        .auth-information {
            display: none;
        }

        .auth-form-panel {
            min-height: 100vh;
            padding: 35px 20px;
        }

        .auth-form-panel::before {
            width: 130px;
            height: 130px;
        }

        .mobile-logo {
            display: block;
        }

        .login-container {
            max-width: 520px;
        }

        .login-heading {
            margin-bottom: 24px;
            text-align: center;
        }

        .login-heading h2 {
            font-size: 1.75rem;
        }
    }

    /* Small mobile */
    @media (max-width: 420px) {
        .auth-form-panel {
            align-items: flex-start;
            padding: 25px 15px;
        }

        .captcha-box {
            padding: 13px;
        }

        .captcha-grid {
            gap: 7px;
        }

        .captcha-item,
        .captcha-item img {
            height: 78px;
            min-height: 78px;
        }
    }
</style>

<body>

<main class="auth-page">

    <!-- Left Platform Information -->
    <section class="auth-information">
        <div class="information-content">

            <div class="brand-logo-wrapper">
                <img
                    src="{{ asset('admins/assets/images/logos/logo.png') }}"
                    alt="NUST Sharing Network"
                >
            </div>

            <div class="information-badge">
                NUST Community Initiative
            </div>

            <h1>
                Share More.<br>
                Support Others.
            </h1>

            <p>
                NUST Sharing Network connects donors with beneficiaries
                through a secure and transparent platform, helping useful
                resources reach the people who need them most.
            </p>

            <div class="platform-features">

                <div class="platform-feature">
                    <div class="feature-icon">
                        <i class="fa fa-shield"></i>
                    </div>

                    <div class="feature-content">
                        <strong>Secure and Verified</strong>
                        <span>
                            Protected access for every registered user
                        </span>
                    </div>
                </div>

                <div class="platform-feature">
                    <div class="feature-icon">
                        <i class="fa fa-handshake"></i>
                    </div>

                    <div class="feature-content">
                        <strong>Community Support</strong>
                        <span>
                            Connecting donors with deserving beneficiaries
                        </span>
                    </div>
                </div>

                <div class="platform-feature">
                    <div class="feature-icon">
                        <i class="fa fa-gift"></i>
                    </div>

                    <div class="feature-content">
                        <strong>Meaningful Sharing</strong>
                        <span>
                            Give useful items a new purpose
                        </span>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Login Form -->
    <section class="auth-form-panel">
        <div class="login-container">

            <!-- Mobile Logo -->
            <div class="mobile-logo">
                <img
                    src="{{ asset('admins/assets/images/logos/logo.png') }}"
                    alt="NUST Sharing Network"
                >
            </div>

            <div class="login-heading">
                <h2>Welcome Back</h2>

                <p>
                    Select your role and enter your account details
                    to access the Sharing Network.
                </p>
            </div>

            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="login-alert" role="alert">
                    <strong>
                        Please correct the following:
                    </strong>

                    <ul class="mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Role -->
                <div class="form-field">
                    <label for="role" class="form-label">
                        Sign in as
                        <span class="required-mark">*</span>
                    </label>

                    <div class="input-wrapper">
                        <i class="fa fa-users input-icon"></i>

                        <select
                            name="role"
                            id="role"
                            class="login-control
                                   @error('role') is-invalid @enderror"
                            required
                        >
                            <option value="">
                                Select your role
                            </option>

                            <option
                                value="beneficiary"
                                {{ old('role') === 'beneficiary'
                                    ? 'selected'
                                    : '' }}
                            >
                                Beneficiary
                            </option>

                            <option
                                value="donor"
                                {{ old('role') === 'donor'
                                    ? 'selected'
                                    : '' }}
                            >
                                Donor
                            </option>

                            <option
                                value="admin"
                                {{ old('role') === 'admin'
                                    ? 'selected'
                                    : '' }}
                            >
                                Administrator
                            </option>
                        </select>
                    </div>

                    @error('role')
                        <span class="field-error">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <!-- Qalam ID -->
                <div
                    class="form-field"
                    id="qalam_id_field"
                    style="{{ old('role') === 'beneficiary'
                        ? ''
                        : 'display: none;' }}"
                >
                    <label for="qalam_id" class="form-label">
                        Qalam ID
                        <span class="required-mark">*</span>
                    </label>

                    <div class="input-wrapper">
                        <i class="fa fa-id-card input-icon"></i>

                        <input
                            type="text"
                            inputmode="numeric"
                            name="qalam_id"
                            id="qalam_id"
                            class="login-control
                                   @error('qalam_id') is-invalid @enderror"
                            placeholder="Enter your Qalam ID"
                            value="{{ old('qalam_id') }}"
                            autocomplete="off"
                        >
                    </div>

                    @error('qalam_id')
                        <span class="field-error">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <!-- Email -->
                <div class="form-field">
                    <label for="email" class="form-label">
                        Email address
                        <span class="required-mark">*</span>
                    </label>

                    <div class="input-wrapper">
                        <i class="fa fa-envelope input-icon"></i>

                        <input
                            type="email"
                            name="email"
                            id="email"
                            class="login-control
                                   @error('email') is-invalid @enderror"
                            placeholder="Enter your email address"
                            value="{{ old('email') }}"
                            autocomplete="email"
                            required
                        >
                    </div>

                    @error('email')
                        <span class="field-error">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-field">
                    <label for="password" class="form-label">
                        Password
                        <span class="required-mark">*</span>
                    </label>

                    <div class="input-wrapper">
                        <i class="fa fa-lock input-icon"></i>

                        <input
                            type="password"
                            name="password"
                            id="password"
                            class="login-control password-control
                                   @error('password') is-invalid @enderror"
                            placeholder="Enter your password"
                            autocomplete="current-password"
                            required
                        >

                        <button
                            type="button"
                            class="password-toggle"
                            id="passwordToggle"
                            aria-label="Show password"
                        >
                            <i
                                class="fa fa-eye"
                                id="passwordIcon"
                            ></i>
                        </button>
                    </div>

                    @error('password')
                        <span class="field-error">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <!-- Image CAPTCHA -->
              <!-- Image CAPTCHA -->
@if(session('captcha_question') && session('captcha_images'))
    <div class="captcha-box">

        <div class="captcha-heading">
            <i class="fa fa-shield-alt"></i>

            <label>
                {{ session('captcha_question') }}
            </label>
        </div>

        <div class="captcha-grid">
            @foreach(session('captcha_images') as $index => $img)
                <label class="captcha-item">

                    <input
                        type="checkbox"
                        name="captcha_selected[]"
                        value="{{ $index }}"
                        {{ in_array(
                            $index,
                            old('captcha_selected', [])
                        ) ? 'checked' : '' }}
                    >

                    <img
                        src="{{ asset('captcha/' . $img['img']) }}"
                        alt="Verification image {{ $index + 1 }}"
                        loading="lazy"
                    >

                    <span class="captcha-checkmark"></span>

                </label>
            @endforeach
        </div>

        @error('captcha_selected')
            <span class="field-error">
                {{ $message }}
            </span>
        @enderror

        @error('captcha_selected.*')
            <span class="field-error">
                {{ $message }}
            </span>
        @enderror

    </div>
@endif

                <!-- Remember Me -->
                <div class="form-options">
                    <label class="remember-wrapper">
                        <input
                            type="checkbox"
                            name="remember"
                            value="1"
                            {{ old('remember') ? 'checked' : '' }}
                        >

                        <span>Keep me signed in</span>
                    </label>
                </div>

                <!-- Submit -->
                <button type="submit" class="btn-login">
                    <span>Sign In Securely</span>
                    <i class="fa fa-arrow-right"></i>
                </button>

                <p class="login-support">
                    <i class="fa fa-lock"></i>
                    Your account information is protected and securely
                    processed.
                </p>

            </form>
        </div>
    </section>

</main>

@include('layouts.admin.script')

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const roleSelect = document.getElementById('role');
        const qalamField = document.getElementById(
            'qalam_id_field'
        );
        const qalamInput = document.getElementById('qalam_id');

        const passwordInput = document.getElementById(
            'password'
        );
        const passwordToggle = document.getElementById(
            'passwordToggle'
        );
        const passwordIcon = document.getElementById(
            'passwordIcon'
        );

        /*
         * Display Qalam ID only for beneficiaries.
         */
        function updateQalamField() {
            const isBeneficiary =
                roleSelect.value === 'beneficiary';

            qalamField.style.display = isBeneficiary
                ? 'block'
                : 'none';

            qalamInput.required = isBeneficiary;

            if (!isBeneficiary) {
                qalamInput.value = '';
            }
        }

        roleSelect.addEventListener(
            'change',
            updateQalamField
        );

        /*
         * Show or hide password.
         */
        passwordToggle.addEventListener(
            'click',
            function () {
                const isPassword =
                    passwordInput.type === 'password';

                passwordInput.type = isPassword
                    ? 'text'
                    : 'password';

                passwordIcon.classList.toggle(
                    'fa-eye',
                    !isPassword
                );

                passwordIcon.classList.toggle(
                    'fa-eye-slash',
                    isPassword
                );

                passwordToggle.setAttribute(
                    'aria-label',
                    isPassword
                        ? 'Hide password'
                        : 'Show password'
                );
            }
        );

        updateQalamField();
    });
</script>

</body>
