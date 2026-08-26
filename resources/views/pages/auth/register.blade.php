@include('layouts.admin.head')

<title>Register | NUST Sharing Network</title>

<style>
    :root {
        --auth-primary: #0065a8;
        --auth-primary-dark: #003f6b;
        --auth-primary-light: #eaf5fc;
        --auth-accent: #f5a623;
        --auth-text: #17212b;
        --auth-muted: #667481;
        --auth-border: #dce5ec;
        --auth-white: #ffffff;
        --auth-background: #f4f8fb;
        --auth-danger: #dc3545;
        --auth-danger-light: #fff2f2;
        --auth-success: #198754;
        --auth-font: "Inter", "Segoe UI", Arial, sans-serif;
    }

    * {
        box-sizing: border-box;
    }

    html,
    body {
        min-height: 100%;
        margin: 0;
    }

    body,
    input,
    select,
    button,
    textarea,
    label,
    a,
    p,
    span,
    small,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        font-family: var(--auth-font) !important;
    }

    body {
        min-height: 100vh;
        color: var(--auth-text);
        background-color: var(--auth-background);
    }

    /* ==========================================================
       MAIN AUTH PAGE
    ========================================================== */

    .auth-page {
        position: relative;
        display: flex;
        min-height: 100vh;
        overflow: hidden;
    }

    /* ==========================================================
       LEFT INFORMATION PANEL
    ========================================================== */

    .auth-information {
        position: relative;
        display: flex;
        flex: 0 0 42%;
        align-items: center;
        padding: 55px 65px;
        overflow: hidden;
        color: var(--auth-white);

        background:
            linear-gradient(
                135deg,
                rgba(0, 63, 107, 0.97),
                rgba(0, 101, 168, 0.90)
            ),
            url('{{ asset('admins/assets/images/backgrounds/nust-campus.jpg') }}')
            center center / cover no-repeat;
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
        background-color: rgba(245, 166, 35, 0.10);
    }

    .information-content {
        position: relative;
        z-index: 2;
        width: 100%;
        max-width: 580px;
        margin: auto;
    }

    /* ==========================================================
       LOGO
    ========================================================== */

    .brand-logo-wrapper {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 30px;
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

    /* ==========================================================
       BADGE
    ========================================================== */

    .information-badge {
        display: inline-flex;
        gap: 9px;
        align-items: center;
        margin-bottom: 18px;
        padding: 8px 14px;
        border: 1px solid rgba(255, 255, 255, 0.22);
        border-radius: 50rem;
        background-color: rgba(255, 255, 255, 0.10);
        font-size: 0.84rem;
        font-weight: 600;
        letter-spacing: 0.4px;
    }

    .information-badge::before {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background-color: var(--auth-accent);
        content: "";
    }

    /* ==========================================================
       INFORMATION CONTENT
    ========================================================== */

    .information-content h1 {
        max-width: 540px;
        margin: 0 0 18px;
        color: var(--auth-white);
        font-size: clamp(2.2rem, 3.5vw, 3.6rem);
        font-weight: 750;
        line-height: 1.12;
    }

    .information-description {
        max-width: 530px;
        margin: 0 0 30px;
        color: rgba(255, 255, 255, 0.82);
        font-size: 1rem;
        line-height: 1.75;
    }

    /* ==========================================================
       FEATURES
    ========================================================== */

    .platform-features {
        display: grid;
        gap: 13px;
    }

    .platform-feature {
        display: flex;
        gap: 13px;
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
        color: var(--auth-primary-dark);
        background-color: var(--auth-accent);
        font-size: 1rem;
    }

    .feature-content strong {
        display: block;
        margin-bottom: 2px;
        color: var(--auth-white);
        font-size: 0.93rem;
        font-weight: 700;
    }

    .feature-content span {
        color: rgba(255, 255, 255, 0.68);
        font-size: 0.82rem;
    }

    /* ==========================================================
       RIGHT FORM PANEL
    ========================================================== */

    .auth-form-panel {
        position: relative;
        display: flex;
        flex: 1;
        align-items: center;
        justify-content: center;
        padding: 40px 55px;
        overflow-y: auto;
        background-color: #f7fafc;
    }

    .auth-form-panel::before {
        position: absolute;
        top: 0;
        right: 0;
        width: 220px;
        height: 220px;
        border-radius: 0 0 0 100%;
        background-color: var(--auth-primary-light);
        content: "";
    }

    .register-container {
        position: relative;
        z-index: 2;
        width: 100%;
        max-width: 650px;
        padding: 15px 0;
    }

    /* ==========================================================
       MOBILE LOGO
    ========================================================== */

    .mobile-logo {
        display: none;
        margin-bottom: 22px;
        text-align: center;
    }

    .mobile-logo img {
        width: 135px;
        max-height: 65px;
        object-fit: contain;
    }

    /* ==========================================================
       HEADING
    ========================================================== */

    .register-heading {
        margin-bottom: 25px;
    }

    .register-heading h2 {
        margin: 0 0 8px;
        color: var(--auth-text);
        font-size: 2rem;
        font-weight: 750;
    }

    .register-heading p {
        margin: 0;
        color: var(--auth-muted);
        line-height: 1.6;
    }

    /* ==========================================================
       ALERT
    ========================================================== */

    .register-alert {
        display: flex;
        gap: 12px;
        align-items: flex-start;
        margin-bottom: 22px;
        padding: 14px 16px;
        border: 1px solid #f2c5c5;
        border-radius: 12px;
        color: #a12b2b;
        background-color: var(--auth-danger-light);
        font-size: 0.88rem;
    }

    .register-alert-icon {
        flex-shrink: 0;
        margin-top: 2px;
    }

    .register-alert strong {
        display: block;
        margin-bottom: 5px;
    }

    .register-alert ul {
        margin: 0;
        padding-left: 18px;
    }

    .beneficiary-notice {
        display: flex;
        grid-column: 1 / -1;
        gap: 12px;
        align-items: flex-start;
        margin-bottom: 20px;
        padding: 14px 16px;
        border: 1px solid #b9d9ee;
        border-radius: 12px;
        color: var(--auth-primary-dark);
        background-color: var(--auth-primary-light);
        font-size: 0.84rem;
        line-height: 1.55;
    }

    .beneficiary-notice i {
        flex-shrink: 0;
        margin-top: 3px;
        color: var(--auth-primary);
    }

    .beneficiary-notice strong {
        display: block;
        margin-bottom: 2px;
    }

    .beneficiary-notice a {
        color: var(--auth-primary-dark);
        font-weight: 700;
        text-decoration: underline;
    }

    .register-control:disabled {
        color: var(--auth-text);
        background-color: #eef3f7;
        cursor: not-allowed;
        opacity: 1;
    }

    /* ==========================================================
       FORM GRID
    ========================================================== */

    .register-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 0 18px;
    }

    .form-field {
        margin-bottom: 17px;
    }

    .form-field.full-width {
        grid-column: 1 / -1;
    }

    .register-label {
        display: block;
        margin-bottom: 8px;
        color: var(--auth-text);
        font-size: 0.88rem;
        font-weight: 650;
    }

    .required-mark {
        color: var(--auth-danger);
    }

    /* ==========================================================
       INPUTS
    ========================================================== */

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

    .register-control {
        display: block;
        width: 100%;
        height: 50px;
        padding: 10px 16px 10px 45px;
        border: 1px solid var(--auth-border);
        border-radius: 11px;
        outline: none;
        color: var(--auth-text);
        background-color: var(--auth-white);
        font-size: 0.93rem;
        transition:
            border-color 0.2s ease,
            box-shadow 0.2s ease;
    }

    .register-control::placeholder {
        color: #9aa5ae;
    }

    /* Remove number input arrows in Chrome, Edge, Safari and Opera */
    .register-control[type="number"]::-webkit-outer-spin-button,
    .register-control[type="number"]::-webkit-inner-spin-button {
        margin: 0;
        -webkit-appearance: none;
    }

    /* Remove number input arrows in Firefox */
    .register-control[type="number"] {
        appearance: textfield;
        -moz-appearance: textfield;
    }

    .register-control:hover {
        border-color: #a9bbc8;
    }

    .register-control:focus {
        border-color: var(--auth-primary);
        box-shadow: 0 0 0 4px rgba(0, 101, 168, 0.10);
    }

    .register-control.is-invalid {
        border-color: var(--auth-danger);
    }

    select.register-control {
        cursor: pointer;
    }

    .field-error {
        display: block;
        margin-top: 6px;
        color: var(--auth-danger);
        font-size: 0.8rem;
    }

    /* ==========================================================
       PASSWORD
    ========================================================== */

    .password-control {
        padding-right: 52px;
    }

    .password-toggle {
        position: absolute;
        top: 50%;
        right: 7px;
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
        transition:
            color 0.2s ease,
            background-color 0.2s ease;
    }

    .password-toggle:hover {
        color: var(--auth-primary);
        background-color: var(--auth-primary-light);
    }

    /* ==========================================================
       PASSWORD REQUIREMENTS
    ========================================================== */

    .password-hint {
        display: flex;
        gap: 6px;
        align-items: center;
        margin-top: 7px;
        color: var(--auth-muted);
        font-size: 0.76rem;
    }

    .password-hint i {
        color: var(--auth-primary);
    }

    /* ==========================================================
       TERMS
    ========================================================== */

    .terms-wrapper {
        display: flex;
        gap: 9px;
        align-items: flex-start;
        margin: 2px 0 19px;
        color: var(--auth-muted);
        font-size: 0.83rem;
        line-height: 1.5;
        cursor: pointer;
    }

    .terms-wrapper input {
        flex-shrink: 0;
        width: 17px;
        height: 17px;
        margin-top: 2px;
        accent-color: var(--auth-primary);
        cursor: pointer;
    }

    .terms-wrapper a {
        color: var(--auth-primary);
        font-weight: 600;
        text-decoration: none;
    }

    .terms-wrapper a:hover {
        text-decoration: underline;
    }

    /* ==========================================================
       REGISTER BUTTON
    ========================================================== */

    .btn-register {
        display: flex;
        gap: 10px;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 52px;
        padding: 10px 20px;
        border: 0;
        border-radius: 12px;
        color: var(--auth-white);
        background: linear-gradient(
            135deg,
            var(--auth-primary),
            var(--auth-primary-dark)
        );
        font-size: 0.95rem;
        font-weight: 700;
        letter-spacing: 0.4px;
        cursor: pointer;
        transition:
            transform 0.2s ease,
            box-shadow 0.2s ease;
    }

    .btn-register:hover {
        color: var(--auth-white);
        box-shadow: 0 10px 24px rgba(0, 76, 128, 0.25);
        transform: translateY(-2px);
    }

    .btn-register:active {
        box-shadow: none;
        transform: translateY(0);
    }

    .btn-register:disabled {
        cursor: not-allowed;
        opacity: 0.7;
        transform: none;
    }

    /* ==========================================================
       LOGIN LINK
    ========================================================== */

    .already-account {
        margin: 18px 0 0;
        color: var(--auth-muted);
        font-size: 0.86rem;
        text-align: center;
    }

    .already-account a {
        color: var(--auth-primary);
        font-weight: 700;
        text-decoration: none;
    }

    .already-account a:hover {
        text-decoration: underline;
    }

    /* ==========================================================
       SECURITY MESSAGE
    ========================================================== */

    .register-support {
        margin: 15px 0 0;
        color: var(--auth-muted);
        font-size: 0.78rem;
        line-height: 1.5;
        text-align: center;
    }

    .register-support i {
        margin-right: 5px;
        color: var(--auth-primary);
    }

    /* ==========================================================
       TABLET
    ========================================================== */

    @media (max-width: 1100px) {

        .auth-information {
            flex-basis: 40%;
            padding: 45px 35px;
        }

        .auth-form-panel {
            padding: 35px 35px;
        }

        .information-content h1 {
            font-size: 2.5rem;
        }
    }

    /* ==========================================================
       MOBILE
    ========================================================== */

    @media (max-width: 767.98px) {

        .auth-page {
            display: block;
        }

        .auth-information {
            display: none;
        }

        .auth-form-panel {
            min-height: 100vh;
            padding: 30px 20px;
        }

        .auth-form-panel::before {
            width: 130px;
            height: 130px;
        }

        .mobile-logo {
            display: block;
        }

        .register-container {
            max-width: 520px;
        }

        .register-heading {
            margin-bottom: 23px;
            text-align: center;
        }

        .register-heading h2 {
            font-size: 1.75rem;
        }

        .register-grid {
            grid-template-columns: 1fr;
            gap: 0;
        }

        .form-field.full-width {
            grid-column: auto;
        }
    }

    /* ==========================================================
       SMALL MOBILE
    ========================================================== */

    @media (max-width: 420px) {

        .auth-form-panel {
            align-items: flex-start;
            padding: 25px 15px;
        }

        .register-heading h2 {
            font-size: 1.55rem;
        }

        .register-control,
        .btn-register {
            height: 50px;
        }
    }
</style>


<body>

    <main class="auth-page">

        {{-- ================================================= --}}
        {{-- LEFT INFORMATION PANEL --}}
        {{-- ================================================= --}}

        <section class="auth-information">

            <div class="information-content">

                {{-- Logo --}}
                <div class="brand-logo-wrapper">

                    <img
                        src="{{ asset('admins/assets/images/logos/logo.png') }}"
                        alt="NUST Sharing Network"
                    >

                </div>


                {{-- Badge --}}
                <div class="information-badge">
                    Join the NUST Community
                </div>


                {{-- Heading --}}
                <h1>
                    Share More.<br>
                    Make an Impact.
                </h1>


                {{-- Description --}}
                <p class="information-description">
                    Create your NUST Sharing Network account and become
                    part of a trusted community where useful resources
                    can be shared with people who need them.
                </p>


                {{-- Features --}}
                <div class="platform-features">

                    <div class="platform-feature">

                        <div class="feature-icon">
                            <i class="fa fa-user-plus"></i>
                        </div>

                        <div class="feature-content">

                            <strong>
                                Easy Registration
                            </strong>

                            <span>
                                Create your account in just a few steps
                            </span>

                        </div>

                    </div>


                    <div class="platform-feature">

                        <div class="feature-icon">
                            <i class="fa fa-shield"></i>
                        </div>

                        <div class="feature-content">

                            <strong>
                                Secure Platform
                            </strong>

                            <span>
                                Your account information is securely protected
                            </span>

                        </div>

                    </div>


                    <div class="platform-feature">

                        <div class="feature-icon">
                            <i class="fa fa-handshake"></i>
                        </div>

                        <div class="feature-content">

                            <strong>
                                Community Driven
                            </strong>

                            <span>
                                Connect, contribute and support others
                            </span>

                        </div>

                    </div>

                </div>

            </div>

        </section>


        {{-- ================================================= --}}
        {{-- REGISTER PANEL --}}
        {{-- ================================================= --}}

        <section class="auth-form-panel">

            <div class="register-container">

                {{-- Mobile Logo --}}
                <div class="mobile-logo">

                    <img
                        src="{{ asset('admins/assets/images/logos/logo.png') }}"
                        alt="NUST Sharing Network"
                    >

                </div>


                {{-- Heading --}}
                <div class="register-heading">

                    <h2>
                        Create Your Account
                    </h2>

                    <p>
                        Register as a donor and support the
                        NUST Sharing Network community.
                    </p>

                </div>


                {{-- Validation Errors --}}
                @if ($errors->any())

                    <div
                        class="register-alert"
                        role="alert"
                    >

                        <i
                            class="fa fa-exclamation-circle register-alert-icon"
                        ></i>

                        <div>

                            <strong>
                                Please correct the following:
                            </strong>

                            <ul>

                                @foreach ($errors->all() as $error)

                                    <li>
                                        {{ $error }}
                                    </li>

                                @endforeach

                            </ul>

                        </div>

                    </div>

                @endif


                {{-- Registration Form --}}
                <form
                    method="POST"
                    action="{{ route('register.post') }}"
                    id="registerForm"
                >

                    @csrf

                    {{-- Public registration is available to donors only. --}}
                    <input type="hidden" name="role" value="donor">


                    <div class="register-grid">

                        {{-- ================================================= --}}
                        {{-- NAME --}}
                        {{-- ================================================= --}}

                        <div class="form-field">

                            <label
                                for="name"
                                class="register-label"
                            >
                                Full Name
                                <span class="required-mark">*</span>
                            </label>

                            <div class="input-wrapper">

                                <i class="fa fa-user input-icon"></i>

                                <input
                                    type="text"
                                    name="name"
                                    id="name"
                                    value="{{ old('name') }}"
                                    class="register-control @error('name') is-invalid @enderror"
                                    placeholder="e.g., Ali Ahmed"
                                    autocomplete="name"
                                    required
                                >

                            </div>

                            @error('name')

                                <span class="field-error">
                                    {{ $message }}
                                </span>

                            @enderror

                        </div>


                        {{-- ================================================= --}}
                        {{-- EMAIL --}}
                        {{-- ================================================= --}}

                        <div class="form-field">

                            <label
                                for="email"
                                class="register-label"
                            >
                                Email Address
                                <span class="required-mark">*</span>
                            </label>

                            <div class="input-wrapper">

                                <i class="fa fa-envelope input-icon"></i>

                                <input
                                    type="email"
                                    name="email"
                                    id="email"
                                    value="{{ old('email') }}"
                                    class="register-control @error('email') is-invalid @enderror"
                                    placeholder="Enter an active email address"
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


                        {{-- ================================================= --}}
                        {{-- PHONE --}}
                        {{-- ================================================= --}}

                        <div class="form-field">

                            <label
                                for="phone"
                                class="register-label"
                            >
                                Phone Number
                                <span class="required-mark">*</span>
                            </label>

                            <div class="input-wrapper">

                                <i class="fa fa-phone input-icon"></i>

                                <input
                                    type="number"
                                    name="phone"
                                    id="phone"
                                    value="{{ old('phone') }}"
                                    class="register-control @error('phone') is-invalid @enderror"
                                    placeholder="Enter an active number, e.g., 0300 1234567"
                                    inputmode="numeric"
                                    autocomplete="tel"
                                    required
                                >

                            </div>

                            @error('phone')

                                <span class="field-error">
                                    {{ $message }}
                                </span>

                            @enderror

                        </div>


                        {{-- ================================================= --}}
                        {{-- REGISTER AS: PUBLIC REGISTRATION IS DONOR ONLY --}}
                        {{-- ================================================= --}}

                        <div class="form-field">

                            <label
                                for="display_role"
                                class="register-label"
                            >
                                Register As
                                <span class="required-mark">*</span>
                            </label>

                            <div class="input-wrapper">

                                <i class="fa fa-handshake input-icon"></i>

                                <select
                                    id="display_role"
                                    class="register-control"
                                    aria-label="Register as Donor"
                                    disabled
                                >
                                    <option selected>
                                        Donor
                                    </option>
                                </select>

                            </div>

                        </div>


                        {{-- ================================================= --}}
                        {{-- BENEFICIARY INFORMATION --}}
                        {{-- ================================================= --}}

                        <div class="beneficiary-notice" role="note">

                            <i class="fa fa-info-circle"></i>

                            <div>
                                <strong>Are you a beneficiary?</strong>

                                Beneficiary accounts are already registered by
                                the administration. If you have not received
                                your account details or cannot access your
                                account, please contact us at

                                <a href="mailto:{{ config('mail.from.address') }}">
                                    {{ config('mail.from.address') }}
                                </a>.
                            </div>

                        </div>


                        {{-- ================================================= --}}
                        {{-- PASSWORD --}}
                        {{-- ================================================= --}}

                        <div class="form-field">

                            <label
                                for="password"
                                class="register-label"
                            >
                                Password
                                <span class="required-mark">*</span>
                            </label>

                            <div class="input-wrapper">

                                <i class="fa fa-lock input-icon"></i>

                                <input
                                    type="password"
                                    name="password"
                                    id="password"
                                    class="register-control password-control @error('password') is-invalid @enderror"
                                    placeholder="Create a password (minimum 8 characters)"
                                    autocomplete="new-password"
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

                            <div class="password-hint">

                                <i class="fa fa-info-circle"></i>

                                Use at least 8 characters.

                            </div>

                            @error('password')

                                <span class="field-error">
                                    {{ $message }}
                                </span>

                            @enderror

                        </div>


                        {{-- ================================================= --}}
                        {{-- CONFIRM PASSWORD --}}
                        {{-- ================================================= --}}

                        <div class="form-field">

                            <label
                                for="password_confirmation"
                                class="register-label"
                            >
                                Confirm Password
                                <span class="required-mark">*</span>
                            </label>

                            <div class="input-wrapper">

                                <i class="fa fa-lock input-icon"></i>

                                <input
                                    type="password"
                                    name="password_confirmation"
                                    id="password_confirmation"
                                    class="register-control password-control"
                                    placeholder="Re-enter your password"
                                    autocomplete="new-password"
                                    required
                                >

                                <button
                                    type="button"
                                    class="password-toggle"
                                    id="confirmPasswordToggle"
                                    aria-label="Show password"
                                >

                                    <i
                                        class="fa fa-eye"
                                        id="confirmPasswordIcon"
                                    ></i>

                                </button>

                            </div>

                        </div>

                    </div>


                    {{-- ================================================= --}}
                    {{-- TERMS --}}
                    {{-- ================================================= --}}

                    <label class="terms-wrapper">

                        <input
                            type="checkbox"
                            name="terms"
                            value="1"
                            @checked(old('terms'))
                            required
                        >

                        <span>
                            I agree to the terms and conditions of the
                            NUST Sharing Network and confirm that the
                            information provided is accurate.
                        </span>

                    </label>

                    @error('terms')

                        <span class="field-error">
                            {{ $message }}
                        </span>

                    @enderror


                    {{-- ================================================= --}}
                    {{-- REGISTER BUTTON --}}
                    {{-- ================================================= --}}

                    <button
                        type="submit"
                        class="btn-register"
                        id="registerButton"
                    >

                        <span id="registerButtonText">
                            Create Donor Account
                        </span>

                        <i
                            class="fa fa-user-plus"
                            id="registerButtonIcon"
                        ></i>

                    </button>


                    {{-- ================================================= --}}
                    {{-- LOGIN LINK --}}
                    {{-- ================================================= --}}

                    <p class="already-account">

                        Already have an account?

                        <a href="{{ route('login') }}">
                            Sign In
                        </a>

                    </p>


                    {{-- ================================================= --}}
                    {{-- SECURITY MESSAGE --}}
                    {{-- ================================================= --}}

                    <p class="register-support">

                        <i class="fa fa-shield"></i>

                        Your account information is securely processed
                        and protected.

                    </p>

                </form>

            </div>

        </section>

    </main>


    @include('layouts.admin.script')


    <script>

        document.addEventListener('DOMContentLoaded', function () {

            /*
            |--------------------------------------------------------------------------
            | Elements
            |--------------------------------------------------------------------------
            */

            const passwordInput =
                document.getElementById('password');

            const passwordToggle =
                document.getElementById('passwordToggle');

            const passwordIcon =
                document.getElementById('passwordIcon');

            const confirmPasswordInput =
                document.getElementById('password_confirmation');

            const confirmPasswordToggle =
                document.getElementById('confirmPasswordToggle');

            const confirmPasswordIcon =
                document.getElementById('confirmPasswordIcon');

            const registerForm =
                document.getElementById('registerForm');

            const registerButton =
                document.getElementById('registerButton');

            const registerButtonText =
                document.getElementById('registerButtonText');

            const registerButtonIcon =
                document.getElementById('registerButtonIcon');


            /*
            |--------------------------------------------------------------------------
            | Password Visibility Function
            |--------------------------------------------------------------------------
            */

            function setupPasswordToggle(
                input,
                button,
                icon
            ) {

                if (
                    !input ||
                    !button ||
                    !icon
                ) {
                    return;
                }

                button.addEventListener(
                    'click',
                    function () {

                        const isHidden =
                            input.type === 'password';

                        input.type =
                            isHidden
                                ? 'text'
                                : 'password';

                        icon.classList.toggle(
                            'fa-eye',
                            !isHidden
                        );

                        icon.classList.toggle(
                            'fa-eye-slash',
                            isHidden
                        );

                        button.setAttribute(
                            'aria-label',
                            isHidden
                                ? 'Hide password'
                                : 'Show password'
                        );

                    }
                );

            }


            setupPasswordToggle(
                passwordInput,
                passwordToggle,
                passwordIcon
            );


            setupPasswordToggle(
                confirmPasswordInput,
                confirmPasswordToggle,
                confirmPasswordIcon
            );


            /*
            |--------------------------------------------------------------------------
            | Password Confirmation
            |--------------------------------------------------------------------------
            */

            if (
                passwordInput &&
                confirmPasswordInput
            ) {

                function validatePasswordMatch() {

                    if (
                        confirmPasswordInput.value &&
                        passwordInput.value !==
                            confirmPasswordInput.value
                    ) {

                        confirmPasswordInput.setCustomValidity(
                            'Passwords do not match.'
                        );

                    } else {

                        confirmPasswordInput.setCustomValidity(
                            ''
                        );

                    }

                }

                passwordInput.addEventListener(
                    'input',
                    validatePasswordMatch
                );

                confirmPasswordInput.addEventListener(
                    'input',
                    validatePasswordMatch
                );

            }


            /*
            |--------------------------------------------------------------------------
            | Prevent Multiple Form Submissions
            |--------------------------------------------------------------------------
            */

            if (
                registerForm &&
                registerButton &&
                registerButtonText &&
                registerButtonIcon
            ) {

                registerForm.addEventListener(
                    'submit',
                    function () {

                        registerButton.disabled =
                            true;

                        registerButtonText.textContent =
                            'Creating Account...';

                        registerButtonIcon.className =
                            'fa fa-spinner fa-spin';

                    }
                );

            }

        });

    </script>

</body>
