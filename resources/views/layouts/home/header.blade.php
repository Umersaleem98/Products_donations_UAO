<style>

    /* =========================
       NAVBAR
    ========================== */

    .navbar {
        background: rgba(255, 255, 255, 0.96);
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
        font-weight: 800;
        font-size: 1.7rem;
        color: var(--primary-color) !important;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .navbar-brand-img {
        width: 150px !important;
        height: 80px !important;
        object-fit: contain;
    }

    .navbar-brand span {
        color: var(--secondary-color);
    }

    /* =========================
       NAV LINKS
    ========================== */

    .navbar-nav {
        gap: 5px; /* Reduced gap between nav items */
    }

    .nav-item {
        margin: 0;
        padding: 0;
    }

    .nav-link {
        font-weight: 600;
        color: var(--dark-color) !important;
        padding: 8px 12px !important; /* Reduced spacing */
        position: relative;
        transition: all 0.3s ease;
        font-size: 15px;
    }

    .nav-link::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 12px;
        width: 0;
        height: 3px;
        background: var(--secondary-color);
        transition: width 0.3s ease;
        border-radius: 10px;
    }

    .nav-link:hover::after {
        width: calc(100% - 24px);
    }

    .nav-link:hover {
        color: var(--primary-color) !important;
    }

    /* =========================
       DONATE BUTTON
    ========================== */

    .btn-donate-nav {
        background: var(--secondary-color);
        color: var(--dark-color) !important;
        padding: 9px 20px !important;
        border-radius: 50px;
        font-weight: 700;
        border: none;
        transition: all 0.3s ease;
        margin-left: 8px;
        font-size: 14px;
    }

    .btn-donate-nav:hover {
        background: var(--primary-color);
        color: var(--white) !important;
        transform: translateY(-2px);
        box-shadow: 0 5px 20px rgba(59, 113, 184, 0.35);
    }

    /* =========================
       TOGGLER
    ========================== */

    .navbar-toggler {
        border: none;
        box-shadow: none !important;
    }

    .navbar-toggler:focus {
        box-shadow: none !important;
    }

    /* =========================
       MOBILE RESPONSIVE
    ========================== */

    @media (max-width: 991px) {

        .navbar-collapse {
            background: #fff;
            padding: 20px;
            border-radius: 15px;
            margin-top: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        }

        .navbar-nav {
            gap: 0;
        }

        .nav-link {
            padding: 12px 10px !important;
        }

        .btn-donate-nav {
            margin-top: 10px;
            margin-left: 0;
            display: inline-block;
            text-align: center;
        }

        .navbar-brand {
            font-size: 1.4rem;
        }

        .navbar-brand-img {
            width: 60px !important;
            height: 60px !important;
        }
    }

</style>


<!-- =========================
     NAVIGATION
========================== -->

<nav class="navbar navbar-expand-lg fixed-top" id="navbar">

    <div class="container-fluid px-lg-4 px-3">

        <!-- Logo -->
        <a class="navbar-brand" href="{{ route('home') }}">

            <img src="{{ asset('admins/assets/images/logos/logo.png') }}"
                 alt="NUST Gift Store"
                 class="navbar-brand-img">
        </a>

        <!-- Mobile Toggle -->
        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav">

            <span class="navbar-toggler-icon"></span>

        </button>

        <!-- Navbar Links -->
        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav ms-auto align-items-lg-center">

                <li class="nav-item">
                    <a class="nav-link" href="#home">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#about">About</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#services">Services</a>
                </li>

                {{-- <li class="nav-item">
                    <a class="nav-link" href="#categories">Categories</a>
                </li> --}}

                <li class="nav-item">
                    <a class="nav-link" href="#how-it-works">How It Works</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#testimonials">Stories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                </li>

                <li class="nav-item">
                    <a class="btn btn-donate-nav" href="#donate">
                        Donate Now
                    </a>
                </li>

            </ul>

        </div>

    </div>

</nav>