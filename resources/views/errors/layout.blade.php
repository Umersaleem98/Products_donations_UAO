<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <meta name="robots" content="noindex, nofollow">

    <title>
        @yield('code') | {{ config('app.name', 'NUST Sharing Network') }}
    </title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            font-family: Arial, Helvetica, sans-serif;
            color: #1f2937;
            background:
                radial-gradient(
                    circle at top left,
                    rgba(0, 96, 140, 0.12),
                    transparent 40%
                ),
                linear-gradient(135deg, #f4f8fb, #e8f1f6);
        }

        .error-wrapper {
            width: 100%;
            max-width: 760px;
        }

        .error-card {
            overflow: hidden;
            text-align: center;
            background: #ffffff;
            border: 1px solid rgba(0, 96, 140, 0.12);
            border-radius: 22px;
            box-shadow: 0 22px 60px rgba(15, 23, 42, 0.12);
        }

        .error-header {
            height: 8px;
            background: linear-gradient(90deg, #00608c, #0088b8, #faaf19);
        }

        .error-content {
            padding: 55px 40px;
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 34px;
            color: #00608c;
            font-size: 17px;
            font-weight: 700;
        }

        .brand-mark {
            width: 38px;
            height: 38px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            background: #00608c;
            border-radius: 11px;
        }

        .error-code {
            margin-bottom: 12px;
            color: #00608c;
            font-size: clamp(72px, 15vw, 130px);
            font-weight: 800;
            line-height: 0.9;
            letter-spacing: -5px;
        }

        .error-title {
            margin-bottom: 14px;
            color: #172033;
            font-size: clamp(25px, 4vw, 36px);
            font-weight: 750;
        }

        .error-message {
            max-width: 560px;
            margin: 0 auto 30px;
            color: #667085;
            font-size: 16px;
            line-height: 1.7;
        }

        .error-reference {
            margin: -14px auto 28px;
            color: #667085;
            font-size: 13px;
        }

        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            justify-content: center;
        }

        .btn {
            min-width: 145px;
            display: inline-block;
            padding: 13px 22px;
            color: #ffffff;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            border: 1px solid #00608c;
            border-radius: 10px;
            background: #00608c;
            transition: 0.2s ease;
        }

        .btn:hover {
            color: #ffffff;
            background: #004c70;
            border-color: #004c70;
            transform: translateY(-2px);
        }

        .btn-outline {
            color: #00608c;
            background: #ffffff;
        }

        .btn-outline:hover {
            color: #ffffff;
            background: #00608c;
        }

        .footer-text {
            margin-top: 36px;
            color: #98a2b3;
            font-size: 13px;
        }

        @media (max-width: 576px) {
            body {
                padding: 15px;
            }

            .error-content {
                padding: 42px 22px;
            }

            .error-code {
                letter-spacing: -2px;
            }

            .actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <main class="error-wrapper">
        <section class="error-card">
            <div class="error-header"></div>

            <div class="error-content">
                <div class="brand">
                    <span class="brand-mark">NS</span>
                    <span>NUST Sharing Network</span>
                </div>

                <div class="error-code">
                    @yield('code')
                </div>

                <h1 class="error-title">
                    @yield('title')
                </h1>

                <p class="error-message">
                    @yield('message')
                </p>

                @hasSection('reference')
                    <p class="error-reference">
                        @yield('reference')
                    </p>
                @endif

                <div class="actions">
                    @auth
                        <a
                            href="{{ route('dashboard') }}"
                            class="btn"
                        >
                            Go to Dashboard
                        </a>
                    @else
                        <a
                            href="{{ url('/') }}"
                            class="btn"
                        >
                            Go to Home
                        </a>
                    @endauth

                    <a
                        href="{{ url()->previous() }}"
                        class="btn btn-outline"
                    >
                        Go Back
                    </a>
                </div>

                <p class="footer-text">
                    If the problem continues, please contact the system administrator.
                </p>
            </div>
        </section>
    </main>
</body>
</html>
