@include('layouts.admin.head')

<title>Verify Email | NUST Sharing Network</title>

<style>
    :root {
        --verify-primary: #0065a8;
        --verify-primary-dark: #003f6b;
        --verify-primary-light: #eaf5fc;
        --verify-accent: #f5a623;
        --verify-text: #17212b;
        --verify-muted: #667481;
        --verify-border: #dce5ec;
        --verify-white: #ffffff;
        --verify-danger: #dc3545;
        --verify-success: #198754;
    }

    * {
        box-sizing: border-box;
    }

    body {
        min-height: 100vh;
        margin: 0;
        color: var(--verify-text);
        background:
            radial-gradient(circle at 12% 18%, rgba(0, 101, 168, 0.12), transparent 28%),
            radial-gradient(circle at 88% 82%, rgba(245, 166, 35, 0.15), transparent 25%),
            #f4f8fb;
        font-family: "Inter", "Segoe UI", Arial, sans-serif !important;
    }

    .verify-page {
        display: grid;
        min-height: 100vh;
        padding: 30px 18px;
        place-items: center;
    }

    .verify-card {
        position: relative;
        width: min(100%, 560px);
        padding: 42px;
        overflow: hidden;
        border: 1px solid var(--verify-border);
        border-radius: 24px;
        background: rgba(255, 255, 255, 0.97);
        box-shadow: 0 25px 70px rgba(0, 63, 107, 0.14);
        text-align: center;
    }

    .verify-card::before {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 5px;
        background: linear-gradient(90deg, var(--verify-primary), var(--verify-accent));
        content: "";
    }

    .verify-logo {
        width: 145px;
        max-height: 70px;
        margin-bottom: 24px;
        object-fit: contain;
    }

    .verify-icon {
        display: grid;
        width: 78px;
        height: 78px;
        margin: 0 auto 22px;
        place-items: center;
        border-radius: 22px;
        color: var(--verify-primary);
        background: var(--verify-primary-light);
        font-size: 1.8rem;
    }

    .verify-card h1 {
        margin: 0 0 12px;
        font-size: clamp(1.75rem, 4vw, 2.25rem);
        font-weight: 780;
    }

    .verify-description {
        margin: 0 0 24px;
        color: var(--verify-muted);
        font-size: 0.95rem;
        line-height: 1.7;
    }

    .verify-delivery-note {
        display: flex;
        gap: 12px;
        align-items: flex-start;
        margin-bottom: 22px;
        padding: 14px 15px;
        border: 1px solid #f2d39b;
        border-radius: 11px;
        color: #76510f;
        background: #fff8e9;
        font-size: 0.86rem;
        line-height: 1.55;
        text-align: left;
    }

    .verify-delivery-note i {
        flex-shrink: 0;
        margin-top: 3px;
        color: var(--verify-accent);
    }

    .verify-delivery-note strong {
        color: #5f4009;
    }

    .verify-status,
    .verify-errors {
        margin-bottom: 20px;
        padding: 13px 15px;
        border-radius: 11px;
        font-size: 0.86rem;
        line-height: 1.55;
        text-align: left;
    }

    .verify-status {
        border: 1px solid #b9dfca;
        color: #12643b;
        background: #effaf4;
    }

    .verify-errors {
        border: 1px solid #f2c5c5;
        color: #a12b2b;
        background: #fff2f2;
    }

    .verify-label {
        display: block;
        margin-bottom: 8px;
        font-size: 0.87rem;
        font-weight: 700;
        text-align: left;
    }

    .verify-input {
        display: block;
        width: 100%;
        height: 50px;
        margin-bottom: 13px;
        padding: 10px 15px;
        border: 1px solid var(--verify-border);
        border-radius: 11px;
        outline: none;
        color: var(--verify-text);
        background: var(--verify-white);
        font-size: 0.93rem;
    }

    .verify-input:focus {
        border-color: var(--verify-primary);
        box-shadow: 0 0 0 4px rgba(0, 101, 168, 0.10);
    }

    .verify-button {
        display: flex;
        gap: 9px;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 50px;
        border: 0;
        border-radius: 11px;
        color: var(--verify-white);
        background: linear-gradient(135deg, var(--verify-primary), var(--verify-primary-dark));
        font-size: 0.91rem;
        font-weight: 750;
        cursor: pointer;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .verify-button:hover {
        box-shadow: 0 10px 24px rgba(0, 76, 128, 0.24);
        transform: translateY(-2px);
    }

    .verify-help {
        margin: 18px 0 0;
        color: var(--verify-muted);
        font-size: 0.82rem;
        line-height: 1.55;
    }

    .verify-login-link {
        display: inline-block;
        margin-top: 19px;
        color: var(--verify-primary);
        font-size: 0.87rem;
        font-weight: 750;
        text-decoration: none;
    }

    .verify-login-link:hover {
        text-decoration: underline;
    }

    @media (max-width: 575.98px) {
        .verify-card {
            padding: 34px 22px;
            border-radius: 18px;
        }
    }
</style>

<body>
    <main class="verify-page">
        <section class="verify-card" aria-labelledby="verify-title">
            <img
                class="verify-logo"
                src="{{ asset('admins/assets/images/logos/logo.png') }}"
                alt="NUST Sharing Network"
            >

            <div class="verify-icon" aria-hidden="true">
                <i class="fa fa-envelope"></i>
            </div>

            <h1 id="verify-title">Verify Your Email</h1>

            <p class="verify-description">
                We sent a verification link to your registered email address.
                Open the email and select the verification button. You will be
                signed in automatically and redirected to your donor dashboard.
            </p>

            <div class="verify-delivery-note" role="note">
                <i class="fa fa-info-circle"></i>

                <div>
                    <strong>Cannot find the email?</strong><br>
                    Please check your Spam or Junk folder and look for an email
                    from <strong>NUST Sharing Network</strong>.
                </div>
            </div>

            @if (session('status'))
                <div class="verify-status" role="status">
                    <i class="fa fa-check-circle"></i>
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="verify-errors" role="alert">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form
                method="POST"
                action="{{ route('verification.send') }}"
            >
                @csrf

                <label class="verify-label" for="verification_email">
                    Registered Email Address
                </label>

                <input
                    class="verify-input"
                    type="email"
                    name="email"
                    id="verification_email"
                    value="{{ old('email', session('email')) }}"
                    placeholder="Enter your registered email address"
                    autocomplete="email"
                    required
                >

                <button class="verify-button" type="submit">
                    <i class="fa fa-paper-plane"></i>
                    Resend Verification Email
                </button>
            </form>

            <p class="verify-help">
                Still did not receive it? Confirm your email address above and
                select <strong>Resend Verification Email</strong>.
            </p>

            <a class="verify-login-link" href="{{ route('login') }}">
                <i class="fa fa-arrow-left"></i>
                Return to Login
            </a>
        </section>
    </main>

    @include('layouts.admin.script')
</body>
