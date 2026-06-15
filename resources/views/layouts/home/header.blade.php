<style>
    /* =========================
       NAVBAR
    ========================== */
    .navbar {
        background: #fff;
        backdrop-filter: blur(10px);
        box-shadow: 0 2px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        padding: 10px 0;
    }

    .navbar.scrolled {
        padding: 8px 0;
        box-shadow: 0 5px 25px rgba(0, 0, 0, 0.12);
    }

    /* =========================
       BRAND
    ========================== */
    .navbar-brand {
        display: flex;
        align-items: center;
    }

    .navbar-brand-img {
        width: 150px;
        height: 80px;
        object-fit: contain;
    }

    /* =========================
       CENTER MENU
    ========================== */
    .navbar-nav-center {
        gap: 8px;
    }

    .navbar-nav-center .nav-link {
        font-weight: 600;
        color: var(--dark-color) !important;
        padding: 8px 14px !important;
        position: relative;
        transition: all 0.3s ease;
        font-size: 15px;
    }

    .navbar-nav-center .nav-link::after {
        content: '';
        position: absolute;
        left: 14px;
        bottom: 0;
        width: 0;
        height: 3px;
        background: var(--secondary-color);
        transition: width 0.3s ease;
        border-radius: 20px;
    }

    .navbar-nav-center .nav-link:hover::after {
        width: calc(100% - 28px);
    }

    .navbar-nav-center .nav-link:hover {
        color: var(--primary-color) !important;
    }

    /* =========================
       LOGIN BUTTON
    ========================== */
    .btn-donate-nav {
        background: var(--secondary-color);
        color: var(--dark-color) !important;
        padding: 10px 24px !important;
        border-radius: 50px;
        font-weight: 700;
        border: none;
        transition: all 0.3s ease;
        font-size: 14px;
        text-transform: capitalize;
    }

    .btn-donate-nav:hover {
        background: var(--primary-color);
        color: #fff !important;
        transform: translateY(-2px);
        box-shadow: 0 5px 20px rgba(59, 113, 184, 0.35);
    }

    /* =========================
       DESKTOP LAYOUT
    ========================== */
    @media (min-width: 992px) {
        .navbar-collapse {
            position: relative;
        }

        .navbar-nav-center {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
        }

        .navbar-right {
            margin-left: auto;
        }
    }

    /* =========================
       MOBILE
    ========================== */
    @media (max-width: 991px) {

        .navbar-collapse {
            background: #fff;
            margin-top: 15px;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        }

        .navbar-brand-img {
            width: 120px;
            height: 60px;
        }

        .navbar-nav-center {
            text-align: center;
        }

        .navbar-nav-center .nav-link {
            padding: 12px !important;
        }

        .navbar-right {
            margin-top: 15px;
            text-align: center;
        }

        .btn-donate-nav {
            width: 100%;
            max-width: 220px;
        }
    }
</style>

<!-- =========================
     NAVBAR
========================= -->
<nav class="navbar navbar-expand-lg fixed-top" id="navbar">

    <div class="container-fluid px-lg-4 px-3">

        <!-- Logo -->
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('admins/assets/images/logos/logo1.png') }}"
                 alt="NUST Gift Store"
                 class="navbar-brand-img">
        </a>

        <!-- Mobile Toggle -->
        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav"
                aria-controls="navbarNav"
                aria-expanded="false"
                aria-label="Toggle navigation">

            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu -->
        <div class="collapse navbar-collapse" id="navbarNav">

            <!-- Center Navigation -->
            <ul class="navbar-nav navbar-nav-center">

                <li class="nav-item">
                    <a class="nav-link" href="#home">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#about">About</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#services">Services</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#how-it-works">How It Works</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#testimonials">Stories</a>
                </li>

            </ul>

            <!-- Right Side Button -->
            <div class="navbar-right ms-lg-auto">
                <a class="btn btn-donate-nav" href="{{ route('login') }}">
                    Login
                </a>
            </div>

        </div>

    </div>

</nav>
