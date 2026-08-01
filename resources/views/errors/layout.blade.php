<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <meta name="robots" content="noindex, nofollow">

    <title>
        @yield('title', 'Error') | NUST Sharing Network
    </title>

    <style>
        :root {
            --primary: #00629b;
            --primary-dark: #004c78;
            --text: #172033;
            --secondary: #667085;
            --border: #e4e9f0;
            --background: #f5f8fc;
            --white: #ffffff;
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            min-height: 100%;
        }

        body {
            min-height: 100vh;
            margin: 0;
            padding: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text);
            background:
                radial-gradient(
                    circle at 15% 15%,
                    rgba(0, 98, 155, 0.12),
                    transparent 32%
                ),
                radial-gradient(
                    circle at 85% 85%,
                    rgba(13, 110, 253, 0.08),
                    transparent 32%
                ),
                var(--background);
            font-family:
                Inter,
                Arial,
                Helvetica,
                sans-serif;
        }

        .error-container {
            width: 100%;
            max-width: 680px;
        }

        .error-card {
            position: relative;
            overflow: hidden;
            padding: 56px 36px;
            text-align: center;
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 24px;
            box-shadow: 0 24px 65px rgba(16, 24, 40, 0.12);
        }

        .error-card::before {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            content: "";
            background: linear-gradient(
                90deg,
                var(--primary),
                #0d6efd
            );
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 30px;
            color: var(--primary);
            font-size: 0.82rem;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .error-icon {
            width: 76px;
            height: 76px;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            background: rgba(0, 98, 155, 0.1);
            border-radius: 50%;
            font-size: 2rem;
            font-weight: 800;
        }

        .error-code {
            margin: 0;
            color: var(--primary);
            font-size: clamp(4rem, 16vw, 7.5rem);
            font-weight: 900;
            line-height: 0.95;
            letter-spacing: -0.06em;
        }

        .error-title {
            margin: 24px 0 12px;
            color: var(--text);
            font-size: clamp(1.4rem, 5vw, 2rem);
            line-height: 1.25;
        }

        .error-message {
            max-width: 500px;
            margin: 0 auto 30px;
            color: var(--secondary);
            font-size: 0.95rem;
            line-height: 1.75;
        }

        .error-actions {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
        }

        .error-button {
            min-width: 140px;
            padding: 12px 20px;
            color: var(--white);
            background: var(--primary);
            border: 1px solid var(--primary);
            border-radius: 10px;
            font-size: 0.9rem;
            font-weight: 700;
            text-decoration: none;
            transition:
                background 0.2s ease,
                transform 0.2s ease;
        }

        .error-button:hover {
            color: var(--white);
            background: var(--primary-dark);
            transform: translateY(-2px);
        }

        .error-button.secondary {
            color: #344054;
            background: var(--white);
            border-color: #d0d5dd;
        }

        .error-button.secondary:hover {
            color: var(--text);
            background: #f8fafc;
        }

        .error-reference {
            margin: 30px 0 0;
            color: #98a2b3;
            font-size: 0.72rem;
        }

        @media (max-width: 575px) {
            body {
                padding: 15px;
            }

            .error-card {
                padding: 40px 20px;
                border-radius: 18px;
            }

            .error-actions {
                flex-direction: column;
            }

            .error-button {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <main class="error-container">
        <section class="error-card">
            <div class="brand">
                NUST Sharing Network
            </div>

            <div class="error-icon" aria-hidden="true">
                @yield('icon', '!')
            </div>

            <p class="error-code">
                @yield('code', 'Error')
            </p>

            <h1 class="error-title">
                @yield('heading', 'Something went wrong')
            </h1>

            <p class="error-message">
                @yield(
                    'message',
                    'We could not complete your request.'
                )
            </p>

            <div class="error-actions">
                <a href="/" class="error-button">
                    Return Home
                </a>

                <a
                    href="javascript:history.back()"
                    class="error-button secondary"
                >
                    Go Back
                </a>
            </div>

            <p class="error-reference">
                If the problem continues, please contact the system
                administrator.
            </p>
        </section>
    </main>
</body>
</html>
