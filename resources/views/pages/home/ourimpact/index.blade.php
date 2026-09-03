@include('layouts.home.head')

<title>Our Impact | NUST Sharing Network</title>

<style>
    /* =========================================================
       NUST SHARING NETWORK - OUR IMPACT
    ========================================================= */

    :root {
        --impact-primary: #123b60;
        --impact-primary-dark: #082944;
        --impact-primary-light: #1c527c;

        --impact-gold: #fabc4d;
        --impact-gold-dark: #d99b24;

        --impact-white: #ffffff;

        --impact-light: #f6f8fb;
        --impact-light-alt: #eef3f7;

        --impact-border: #e4e9ef;

        --impact-text: #24364a;
        --impact-muted: #6f7f90;
        --impact-success: #2e8b66;
    }

    html {
        scroll-behavior: smooth;
    }

    body {
        background: var(--impact-white);
        color: var(--impact-text);
    }


    /* =========================================================
       COMMON SECTION
    ========================================================= */

    .impact-section {
        padding: 90px 0;
    }

    .impact-first-section {
        padding-top: 90px;
    }

    .impact-section-light {
        background: var(--impact-light);
    }

    .impact-section-heading {
        max-width: 760px;
        margin: 0 auto 52px;
        text-align: center;
    }

    .impact-section-label {
        display: inline-block;
        margin-bottom: 10px;

        color: var(--impact-gold-dark);

        font-size: 12px;
        font-weight: 800;
        letter-spacing: 1.7px;

        text-transform: uppercase;
    }

    .impact-section-heading h2,
    .impact-content-title {
        color: var(--impact-primary);

        font-size: clamp(28px, 4vw, 40px);
        font-weight: 800;

        line-height: 1.2;
    }

    .impact-section-heading p {
        max-width: 690px;

        margin: 15px auto 0;

        color: var(--impact-muted);

        font-size: 15px;
        line-height: 1.8;
    }


    /* =========================================================
       INTRODUCTION
    ========================================================= */

    .impact-intro-image {
        position: relative;

        min-height: 480px;

        overflow: hidden;

        border-radius: 24px;

        background:
            linear-gradient(
                rgba(10, 43, 70, 0.13),
                rgba(10, 43, 70, 0.13)
            ),
            url('{{ asset("templates/assets/sliders/slider2.png") }}');

        background-size: cover;
        background-position: center;

        box-shadow:
            0 20px 55px
            rgba(18, 59, 96, 0.13);
    }

    .impact-intro-image::after {
        content: "";

        position: absolute;

        width: 140px;
        height: 140px;

        right: -35px;
        bottom: -35px;

        border-radius: 50%;

        background: var(--impact-gold);

        opacity: 0.9;
    }

    .impact-intro-content {
        padding-left: 25px;
    }

    .impact-intro-content p {
        color: var(--impact-muted);

        font-size: 15px;
        line-height: 1.9;
    }

    .impact-feature-list {
        margin-top: 28px;
    }

    .impact-feature-item {
        display: flex;
        align-items: flex-start;

        gap: 14px;

        margin-bottom: 17px;
    }

    .impact-feature-icon {
        flex: 0 0 42px;

        width: 42px;
        height: 42px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 12px;

        background:
            rgba(250, 188, 77, 0.18);

        color: var(--impact-primary);

        font-size: 16px;
    }

    .impact-feature-item h6 {
        margin: 1px 0 4px;

        color: var(--impact-primary);

        font-size: 15px;
        font-weight: 700;
    }

    .impact-feature-item p {
        margin: 0;

        font-size: 13px;
        line-height: 1.65;
    }


    /* =========================================================
       IMPACT STATISTICS
    ========================================================= */

    .impact-stat-card {
        position: relative;

        height: 100%;

        overflow: hidden;

        padding: 34px 28px;

        background: var(--impact-white);

        border: 1px solid var(--impact-border);

        border-radius: 18px;

        transition: 0.35s ease;
    }

    .impact-stat-card:hover {
        transform: translateY(-7px);

        border-color:
            rgba(250, 188, 77, 0.70);

        box-shadow:
            0 18px 40px
            rgba(18, 59, 96, 0.10);
    }

    .impact-stat-card::after {
        content: "";

        position: absolute;

        width: 110px;
        height: 110px;

        top: -40px;
        right: -40px;

        border-radius: 50%;

        background:
            rgba(250, 188, 77, 0.13);
    }

    .impact-stat-icon {
        position: relative;

        z-index: 2;

        width: 54px;
        height: 54px;

        display: flex;
        align-items: center;
        justify-content: center;

        margin-bottom: 25px;

        border-radius: 14px;

        background: var(--impact-primary);

        color: var(--impact-gold);

        font-size: 20px;
    }

    .impact-stat-number {
        position: relative;

        z-index: 2;

        display: block;

        margin-bottom: 9px;

        color: var(--impact-primary);

        font-size: 40px;
        font-weight: 800;

        line-height: 1;
    }

    .impact-stat-title {
        position: relative;

        z-index: 2;

        display: block;

        margin-bottom: 7px;

        color: var(--impact-text);

        font-size: 15px;
        font-weight: 700;
    }

    .impact-stat-description {
        position: relative;

        z-index: 2;

        margin: 0;

        color: var(--impact-muted);

        font-size: 13px;
        line-height: 1.65;
    }


    /* =========================================================
       ACTIVE COMMUNITY
    ========================================================= */

    .impact-active-card {
        position: relative;

        height: 100%;

        overflow: hidden;

        padding: 32px;

        border-radius: 18px;

        background:
            linear-gradient(
                145deg,
                var(--impact-primary-dark),
                var(--impact-primary)
            );

        transition: 0.35s ease;
    }

    .impact-active-card:hover {
        transform: translateY(-6px);

        box-shadow:
            0 20px 45px
            rgba(18, 59, 96, 0.18);
    }

    .impact-active-card::after {
        content: "";

        position: absolute;

        width: 120px;
        height: 120px;

        top: -50px;
        right: -50px;

        border-radius: 50%;

        background:
            rgba(250, 188, 77, 0.10);
    }

    .impact-active-icon {
        position: relative;

        z-index: 2;

        width: 52px;
        height: 52px;

        display: flex;
        align-items: center;
        justify-content: center;

        margin-bottom: 22px;

        border-radius: 14px;

        background:
            rgba(255, 255, 255, 0.10);

        color: var(--impact-gold);

        font-size: 20px;
    }

    .impact-active-number {
        position: relative;

        z-index: 2;

        display: block;

        margin-bottom: 9px;

        color: var(--impact-white);

        font-size: 38px;
        font-weight: 800;

        line-height: 1;
    }

    .impact-active-title {
        position: relative;

        z-index: 2;

        display: block;

        margin-bottom: 8px;

        color: var(--impact-gold);

        font-size: 15px;
        font-weight: 700;
    }

    .impact-active-description {
        position: relative;

        z-index: 2;

        margin-bottom: 0;

        color:
            rgba(255, 255, 255, 0.67);

        font-size: 13px;
        line-height: 1.7;
    }


    /* =========================================================
       VERIFIED COMMUNITY / ROLE DISTRIBUTION
    ========================================================= */

    .impact-verified-number {
        margin-top: 28px;

        padding: 24px 26px;

        background: var(--impact-white);

        border:
            1px solid
            var(--impact-border);

        border-radius: 16px;
    }

    .impact-verified-number .impact-stat-number {
        margin-bottom: 8px;
    }

    .impact-role-wrapper {
        padding: 35px;

        background: var(--impact-white);

        border:
            1px solid
            var(--impact-border);

        border-radius: 20px;

        box-shadow:
            0 15px 35px
            rgba(18, 59, 96, 0.05);
    }

    .impact-role-row {
        margin-bottom: 27px;
    }

    .impact-role-row:last-child {
        margin-bottom: 0;
    }

    .impact-role-header {
        display: flex;

        align-items: center;
        justify-content: space-between;

        gap: 20px;

        margin-bottom: 9px;
    }

    .impact-role-name {
        display: flex;

        align-items: center;

        gap: 10px;

        color: var(--impact-primary);

        font-size: 14px;
        font-weight: 700;
    }

    .impact-role-name i {
        width: 34px;
        height: 34px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 9px;

        background:
            rgba(250, 188, 77, 0.17);

        color: var(--impact-primary);
    }

    .impact-role-value {
        color: var(--impact-primary);

        font-size: 14px;
        font-weight: 800;
    }

    .impact-role-progress {
        height: 8px;

        overflow: hidden;

        border-radius: 50px;

        background: #e8edf2;
    }

    .impact-role-progress-bar {
        height: 100%;

        border-radius: 50px;

        background:
            linear-gradient(
                90deg,
                var(--impact-primary),
                var(--impact-gold)
            );

        transition: width 0.8s ease;
    }


    /* =========================================================
       SHARING PROCESS
    ========================================================= */

    .impact-process-card {
        height: 100%;

        padding: 34px 25px;

        background: var(--impact-white);

        border:
            1px solid
            var(--impact-border);

        border-radius: 18px;

        text-align: center;

        transition: 0.35s ease;
    }

    .impact-process-card:hover {
        transform: translateY(-6px);

        box-shadow:
            0 18px 40px
            rgba(18, 59, 96, 0.09);
    }

    .impact-process-number {
        width: 55px;
        height: 55px;

        margin:
            0 auto 20px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 16px;

        background: var(--impact-primary);

        color: var(--impact-gold);

        font-size: 17px;
        font-weight: 800;
    }

    .impact-process-card h5 {
        margin-bottom: 11px;

        color: var(--impact-primary);

        font-size: 17px;
        font-weight: 750;
    }

    .impact-process-card p {
        margin: 0;

        color: var(--impact-muted);

        font-size: 13px;
        line-height: 1.75;
    }


    /* =========================================================
       IMPACT AREAS
    ========================================================= */

    .impact-area-card {
        height: 100%;

        padding: 35px 30px;

        background: var(--impact-white);

        border:
            1px solid
            var(--impact-border);

        border-radius: 18px;

        transition: 0.35s ease;
    }

    .impact-area-card:hover {
        transform: translateY(-7px);

        border-color: var(--impact-gold);

        box-shadow:
            0 18px 38px
            rgba(18, 59, 96, 0.09);
    }

    .impact-area-icon {
        width: 58px;
        height: 58px;

        display: flex;
        align-items: center;
        justify-content: center;

        margin-bottom: 22px;

        border-radius: 15px;

        background:
            rgba(250, 188, 77, 0.17);

        color: var(--impact-primary);

        font-size: 23px;
    }

    .impact-area-card h5 {
        margin-bottom: 12px;

        color: var(--impact-primary);

        font-size: 18px;
        font-weight: 750;
    }

    .impact-area-card p {
        margin-bottom: 0;

        color: var(--impact-muted);

        font-size: 14px;
        line-height: 1.8;
    }


    /* =========================================================
       TRUST SECTION
    ========================================================= */

    .impact-trust-section {
        position: relative;

        overflow: hidden;

        padding: 95px 0;

        background:
            linear-gradient(
                135deg,
                var(--impact-primary-dark),
                var(--impact-primary)
            );
    }

    .impact-trust-section::before {
        content: "";

        position: absolute;

        width: 380px;
        height: 380px;

        right: -140px;
        top: -160px;

        border:
            65px solid
            rgba(250, 188, 77, 0.06);

        border-radius: 50%;
    }

    .impact-trust-content {
        position: relative;

        z-index: 2;
    }

    .impact-trust-content h2 {
        margin-bottom: 18px;

        color: var(--impact-white);

        font-size:
            clamp(29px, 4vw, 40px);

        font-weight: 800;

        line-height: 1.2;
    }

    .impact-trust-content > p {
        color:
            rgba(255, 255, 255, 0.72);

        line-height: 1.85;
    }

    .impact-trust-card {
        position: relative;

        z-index: 2;

        height: 100%;

        display: flex;

        gap: 15px;

        padding: 23px;

        border:
            1px solid
            rgba(255, 255, 255, 0.11);

        border-radius: 15px;

        background:
            rgba(255, 255, 255, 0.07);
    }

    .impact-trust-icon {
        flex: 0 0 42px;

        width: 42px;
        height: 42px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 12px;

        background: var(--impact-gold);

        color: var(--impact-primary-dark);
    }

    .impact-trust-card h6 {
        margin-bottom: 5px;

        color: var(--impact-white);

        font-weight: 700;
    }

    .impact-trust-card p {
        margin-bottom: 0;

        color:
            rgba(255, 255, 255, 0.68);

        font-size: 13px;
        line-height: 1.65;
    }


    /* =========================================================
       DONOR / BENEFICIARY
    ========================================================= */

    .impact-community-card {
        position: relative;

        overflow: hidden;

        height: 100%;

        padding: 42px;

        border-radius: 22px;
    }

    .impact-community-card::after {
        content: "";

        position: absolute;

        width: 180px;
        height: 180px;

        right: -90px;
        bottom: -95px;

        border-radius: 50%;
    }

    .impact-community-card.donor {
        background: var(--impact-primary);

        color: var(--impact-white);
    }

    .impact-community-card.donor::after {
        background:
            rgba(250, 188, 77, 0.10);
    }

    .impact-community-card.beneficiary {
        background: var(--impact-gold);

        color: var(--impact-primary-dark);
    }

    .impact-community-card.beneficiary::after {
        background:
            rgba(18, 59, 96, 0.08);
    }

    .impact-community-icon {
        position: relative;

        z-index: 2;

        width: 62px;
        height: 62px;

        display: flex;
        align-items: center;
        justify-content: center;

        margin-bottom: 25px;

        border-radius: 18px;

        font-size: 25px;
    }

    .donor .impact-community-icon {
        background:
            rgba(255, 255, 255, 0.10);

        color: var(--impact-gold);
    }

    .beneficiary .impact-community-icon {
        background:
            rgba(18, 59, 96, 0.11);

        color: var(--impact-primary);
    }

    .impact-community-card h3 {
        position: relative;

        z-index: 2;

        margin-bottom: 13px;

        font-size: 26px;
        font-weight: 800;
    }

    .impact-community-card p {
        position: relative;

        z-index: 2;

        margin-bottom: 27px;

        line-height: 1.8;
    }

    .donor p {
        color:
            rgba(255, 255, 255, 0.75);
    }

    .beneficiary p {
        color:
            rgba(8, 41, 68, 0.78);
    }


    /* =========================================================
       BUTTONS
    ========================================================= */

    .impact-btn {
        position: relative;

        z-index: 2;

        display: inline-flex;
        align-items: center;
        justify-content: center;

        gap: 9px;

        padding: 13px 27px;

        border-radius: 50px;

        text-decoration: none;

        font-size: 14px;
        font-weight: 700;

        transition: 0.3s ease;
    }

    .impact-btn-light {
        background: var(--impact-white);

        color: var(--impact-primary);
    }

    .impact-btn-light:hover {
        background: var(--impact-gold);

        color: var(--impact-primary-dark);
    }

    .impact-btn-dark {
        background: var(--impact-primary);

        color: var(--impact-white);
    }

    .impact-btn-dark:hover {
        background: var(--impact-primary-dark);

        color: var(--impact-gold);
    }


    /* =========================================================
       FINAL CTA
    ========================================================= */

    .impact-final-cta {
        padding: 95px 0;

        background: var(--impact-light);
    }

    .impact-final-box {
        position: relative;

        overflow: hidden;

        padding: 60px 40px;

        border-radius: 26px;

        background:
            linear-gradient(
                115deg,
                rgba(8, 41, 68, 0.97),
                rgba(18, 59, 96, 0.93)
            );

        text-align: center;
    }

    .impact-final-box::after {
        content: "";

        position: absolute;

        width: 220px;
        height: 220px;

        bottom: -130px;
        right: -70px;

        border-radius: 50%;

        background: var(--impact-gold);

        opacity: 0.10;
    }

    .impact-final-box h2 {
        position: relative;

        z-index: 2;

        max-width: 800px;

        margin:
            0 auto 15px;

        color: var(--impact-white);

        font-size:
            clamp(30px, 4vw, 43px);

        font-weight: 800;
    }

    .impact-final-box p {
        position: relative;

        z-index: 2;

        max-width: 700px;

        margin:
            0 auto 30px;

        color:
            rgba(255, 255, 255, 0.72);
    }

    .impact-final-actions {
        position: relative;

        z-index: 2;

        display: flex;

        justify-content: center;

        flex-wrap: wrap;

        gap: 12px;
    }

    .impact-btn-gold {
        background: var(--impact-gold);

        color: var(--impact-primary-dark);
    }

    .impact-btn-gold:hover {
        background: var(--impact-white);

        color: var(--impact-primary);
    }

    .impact-btn-outline {
        border:
            1px solid
            rgba(255, 255, 255, 0.45);

        color: var(--impact-white);
    }

    .impact-btn-outline:hover {
        background: var(--impact-white);

        color: var(--impact-primary);
    }


    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 991.98px) {

        .impact-section,
        .impact-trust-section,
        .impact-final-cta {
            padding: 75px 0;
        }

        .impact-first-section {
            padding-top: 75px;
        }

        .impact-intro-content {
            padding-left: 0;

            margin-top: 45px;
        }

        .impact-intro-image {
            min-height: 390px;
        }

    }


    @media (max-width: 767.98px) {

        .impact-section,
        .impact-trust-section,
        .impact-final-cta {
            padding: 60px 0;
        }

        .impact-first-section {
            padding-top: 60px;
        }

        .impact-section-heading {
            margin-bottom: 38px;
        }

        .impact-community-card {
            padding: 32px 25px;
        }

        .impact-final-box {
            padding: 45px 22px;
        }

        .impact-role-wrapper {
            padding: 25px 20px;
        }

    }

</style>


<body>


{{-- @include('layouts.home.preloader') --}}

@include('layouts.home.header')



{{-- ============================================================
     INTRODUCTION
============================================================ --}}

<section class="impact-section impact-first-section">

    <div class="container">

        <div class="row align-items-center g-5">


            <div class="col-lg-6">

                <div class="impact-intro-image"></div>

            </div>


            <div class="col-lg-6">

                <div class="impact-intro-content">


                    <span class="impact-section-label">
                        Why Our Work Matters
                    </span>


                    <h1 class="impact-content-title mb-4">

                        Building a Community Around
                        Responsible Sharing

                    </h1>


                    <p>

                        Educational support becomes more meaningful
                        when communities have a structured way to
                        connect available resources with genuine
                        student needs.

                    </p>


                    <p>

                        NUST Sharing Network provides that connection
                        by bringing donors and beneficiaries together
                        within a transparent and accountable platform.

                    </p>


                    <div class="impact-feature-list">


                        <div class="impact-feature-item">

                            <div class="impact-feature-icon">

                                <i class="fas fa-hand-holding-heart"></i>

                            </div>


                            <div>

                                <h6>
                                    Meaningful Giving
                                </h6>

                                <p>
                                    Donors become part of a structured
                                    educational support community.
                                </p>

                            </div>

                        </div>


                        <div class="impact-feature-item">

                            <div class="impact-feature-icon">

                                <i class="fas fa-user-graduate"></i>

                            </div>


                            <div>

                                <h6>
                                    Beneficiary Support
                                </h6>

                                <p>
                                    Eligible students participate through
                                    dedicated beneficiary accounts.
                                </p>

                            </div>

                        </div>


                        <div class="impact-feature-item">

                            <div class="impact-feature-icon">

                                <i class="fas fa-shield-alt"></i>

                            </div>


                            <div>

                                <h6>
                                    Responsible Participation
                                </h6>

                                <p>
                                    Administrative oversight helps maintain
                                    accountability across the Sharing Network.
                                </p>

                            </div>

                        </div>


                    </div>


                </div>

            </div>


        </div>

    </div>

</section>



{{-- ============================================================
     PRIMARY USER STATISTICS
============================================================ --}}

<section class="impact-section impact-section-light">

    <div class="container">


        <div class="impact-section-heading">


            <span class="impact-section-label">
                Community in Numbers
            </span>


            <h2>
                The NUST Sharing Network Community
            </h2>


            <p>

                Our platform brings together different participants
                with one shared purpose: creating a responsible and
                supportive educational sharing ecosystem.

            </p>


        </div>


        <div class="row g-4">


            {{-- TOTAL USERS --}}

            <div class="col-xl-3 col-md-6">

                <div class="impact-stat-card">


                    <div class="impact-stat-icon">

                        <i class="fas fa-users"></i>

                    </div>


                    <span
                        class="impact-stat-number impact-counter"
                        data-target="{{ $totalUsers ?? 0 }}"
                    >
                        0
                    </span>


                    <span class="impact-stat-title">
                        Registered Users
                    </span>


                    <p class="impact-stat-description">

                        Total accounts registered across the
                        NUST Sharing Network.

                    </p>


                </div>

            </div>


            {{-- DONORS --}}

            <div class="col-xl-3 col-md-6">

                <div class="impact-stat-card">


                    <div class="impact-stat-icon">

                        <i class="fas fa-hand-holding-heart"></i>

                    </div>


                    <span
                        class="impact-stat-number impact-counter"
                        data-target="{{ $totalDonors ?? 0 }}"
                    >
                        0
                    </span>


                    <span class="impact-stat-title">
                        Registered Donors
                    </span>


                    <p class="impact-stat-description">

                        Users registered as donors who can
                        participate in educational resource sharing.

                    </p>


                </div>

            </div>


            {{-- BENEFICIARIES --}}

            <div class="col-xl-3 col-md-6">

                <div class="impact-stat-card">


                    <div class="impact-stat-icon">

                        <i class="fas fa-user-graduate"></i>

                    </div>


                    <span
                        class="impact-stat-number impact-counter"
                        data-target="{{ $totalBeneficiaries ?? 0 }}"
                    >
                        0
                    </span>


                    <span class="impact-stat-title">
                        Beneficiaries
                    </span>


                    <p class="impact-stat-description">

                        Students registered as beneficiaries
                        within the Sharing Network.

                    </p>


                </div>

            </div>


            {{-- ADMINS --}}

            <div class="col-xl-3 col-md-6">

                <div class="impact-stat-card">


                    <div class="impact-stat-icon">

                        <i class="fas fa-user-shield"></i>

                    </div>


                    <span
                        class="impact-stat-number impact-counter"
                        data-target="{{ $totalAdmins ?? 0 }}"
                    >
                        0
                    </span>


                    <span class="impact-stat-title">
                        Administrators
                    </span>


                    <p class="impact-stat-description">

                        Administrative accounts responsible
                        for platform oversight and management.

                    </p>


                </div>

            </div>


        </div>


    </div>

</section>



{{-- ============================================================
     ACTIVE COMMUNITY
============================================================ --}}

<section class="impact-section">

    <div class="container">


        <div class="impact-section-heading">


            <span class="impact-section-label">
                Active Community
            </span>


            <h2>
                Active Participation Across the Network
            </h2>


            <p>

                These statistics represent active accounts
                currently able to participate within the
                NUST Sharing Network.

            </p>


        </div>


        <div class="row g-4 justify-content-center">


            {{-- ACTIVE USERS --}}

            <div class="col-lg-4 col-md-6">

                <div class="impact-active-card">


                    <div class="impact-active-icon">

                        <i class="fas fa-user-check"></i>

                    </div>


                    <span
                        class="impact-active-number impact-counter"
                        data-target="{{ $activeUsers ?? 0 }}"
                    >
                        0
                    </span>


                    <span class="impact-active-title">
                        Active Users
                    </span>


                    <p class="impact-active-description">

                        Accounts currently marked as active
                        within the Sharing Network.

                    </p>


                </div>

            </div>


            {{-- ACTIVE DONORS --}}

            <div class="col-lg-4 col-md-6">

                <div class="impact-active-card">


                    <div class="impact-active-icon">

                        <i class="fas fa-hands-helping"></i>

                    </div>


                    <span
                        class="impact-active-number impact-counter"
                        data-target="{{ $activeDonors ?? 0 }}"
                    >
                        0
                    </span>


                    <span class="impact-active-title">
                        Active Donors
                    </span>


                    <p class="impact-active-description">

                        Donor accounts currently active and
                        eligible to participate on the platform.

                    </p>


                </div>

            </div>


            {{-- ACTIVE BENEFICIARIES --}}

            <div class="col-lg-4 col-md-6">

                <div class="impact-active-card">


                    <div class="impact-active-icon">

                        <i class="fas fa-graduation-cap"></i>

                    </div>


                    <span
                        class="impact-active-number impact-counter"
                        data-target="{{ $activeBeneficiaries ?? 0 }}"
                    >
                        0
                    </span>


                    <span class="impact-active-title">
                        Active Beneficiaries
                    </span>


                    <p class="impact-active-description">

                        Beneficiary accounts currently active
                        within the Sharing Network.

                    </p>


                </div>

            </div>


        </div>


    </div>

</section>



{{-- ============================================================
     VERIFIED COMMUNITY
============================================================ --}}

<section class="impact-section impact-section-light">

    <div class="container">


        <div class="row align-items-center g-5">


            <div class="col-lg-5">


                <span class="impact-section-label">
                    Verified Community
                </span>


                <h2 class="impact-content-title mb-3">

                    Building Trust Through
                    Verified Participation

                </h2>


                <p
                    style="
                        color:#6f7f90;
                        line-height:1.85;
                    "
                >

                    Email verification provides an additional layer
                    of confidence by helping ensure that registered
                    participants use verified email accounts within
                    the platform.

                </p>


                <div class="impact-verified-number">


                    <span
                        class="impact-stat-number impact-counter"
                        data-target="{{ $verifiedUsers ?? 0 }}"
                    >
                        0
                    </span>


                    <span class="impact-stat-title">
                        Verified Accounts
                    </span>


                </div>


            </div>


            <div class="col-lg-7">


                @php

                    $donorPercentage =
                        ($totalUsers ?? 0) > 0
                            ? round(
                                (($totalDonors ?? 0) / $totalUsers) * 100
                            )
                            : 0;


                    $beneficiaryPercentage =
                        ($totalUsers ?? 0) > 0
                            ? round(
                                (($totalBeneficiaries ?? 0) / $totalUsers) * 100
                            )
                            : 0;


                    $adminPercentage =
                        ($totalUsers ?? 0) > 0
                            ? round(
                                (($totalAdmins ?? 0) / $totalUsers) * 100
                            )
                            : 0;

                @endphp


                <div class="impact-role-wrapper">


                    {{-- DONORS --}}

                    <div class="impact-role-row">


                        <div class="impact-role-header">


                            <span class="impact-role-name">

                                <i class="fas fa-hand-holding-heart"></i>

                                Donors

                            </span>


                            <span class="impact-role-value">

                                {{ $donorPercentage }}%

                            </span>


                        </div>


                        <div class="impact-role-progress">

                            <div
                                class="impact-role-progress-bar"
                                style="width: {{ $donorPercentage }}%;"
                            ></div>

                        </div>


                    </div>


                    {{-- BENEFICIARIES --}}

                    <div class="impact-role-row">


                        <div class="impact-role-header">


                            <span class="impact-role-name">

                                <i class="fas fa-user-graduate"></i>

                                Beneficiaries

                            </span>


                            <span class="impact-role-value">

                                {{ $beneficiaryPercentage }}%

                            </span>


                        </div>


                        <div class="impact-role-progress">

                            <div
                                class="impact-role-progress-bar"
                                style="width: {{ $beneficiaryPercentage }}%;"
                            ></div>

                        </div>


                    </div>


                    {{-- ADMINS --}}

                    <div class="impact-role-row">


                        <div class="impact-role-header">


                            <span class="impact-role-name">

                                <i class="fas fa-user-shield"></i>

                                Administrators

                            </span>


                            <span class="impact-role-value">

                                {{ $adminPercentage }}%

                            </span>


                        </div>


                        <div class="impact-role-progress">

                            <div
                                class="impact-role-progress-bar"
                                style="width: {{ $adminPercentage }}%;"
                            ></div>

                        </div>


                    </div>


                </div>


            </div>


        </div>


    </div>

</section>



{{-- ============================================================
     HOW SHARING NETWORK WORKS
============================================================ --}}

<section class="impact-section">

    <div class="container">


        <div class="impact-section-heading">


            <span class="impact-section-label">
                Sharing Journey
            </span>


            <h2>
                How the NUST Sharing Network Works
            </h2>


            <p>

                The platform provides a structured journey
                connecting donors, beneficiaries and
                administrators throughout the sharing process.

            </p>


        </div>


        <div class="row g-4">


            <div class="col-lg col-md-6">

                <div class="impact-process-card">


                    <div class="impact-process-number">
                        01
                    </div>


                    <h5>
                        Join the Network
                    </h5>


                    <p>

                        Participants register on the platform
                        according to their relevant donor or
                        beneficiary role.

                    </p>


                </div>

            </div>


            <div class="col-lg col-md-6">

                <div class="impact-process-card">


                    <div class="impact-process-number">
                        02
                    </div>


                    <h5>
                        Account Verification
                    </h5>


                    <p>

                        Email and account information support
                        responsible participation within the
                        Sharing Network.

                    </p>


                </div>

            </div>


            <div class="col-lg col-md-6">

                <div class="impact-process-card">


                    <div class="impact-process-number">
                        03
                    </div>


                    <h5>
                        Identify Needs
                    </h5>


                    <p>

                        Beneficiaries identify educational needs
                        while donors participate according to
                        available resources.

                    </p>


                </div>

            </div>


            <div class="col-lg col-md-6">

                <div class="impact-process-card">


                    <div class="impact-process-number">
                        04
                    </div>


                    <h5>
                        Administrative Oversight
                    </h5>


                    <p>

                        Administrators help manage platform
                        participation and the required workflows.

                    </p>


                </div>

            </div>


            <div class="col-lg col-md-6">

                <div class="impact-process-card">


                    <div class="impact-process-number">
                        05
                    </div>


                    <h5>
                        Create Impact
                    </h5>


                    <p>

                        Responsible community participation
                        transforms sharing into meaningful
                        educational support.

                    </p>


                </div>

            </div>


        </div>


    </div>

</section>



{{-- ============================================================
     AREAS OF IMPACT
============================================================ --}}

<section class="impact-section impact-section-light">

    <div class="container">


        <div class="impact-section-heading">


            <span class="impact-section-label">
                Areas of Impact
            </span>


            <h2>
                Creating Value Across the Community
            </h2>


            <p>

                The Sharing Network supports more than resource
                exchange. It helps strengthen participation,
                accessibility, responsibility and community
                engagement.

            </p>


        </div>


        <div class="row g-4">


            <div class="col-lg-4 col-md-6">

                <div class="impact-area-card">


                    <div class="impact-area-icon">

                        <i class="fas fa-laptop"></i>

                    </div>


                    <h5>
                        Digital Accessibility
                    </h5>


                    <p>

                        Resource sharing can help students gain
                        access to the technology required for
                        coursework, research and digital learning.

                    </p>


                </div>

            </div>


            <div class="col-lg-4 col-md-6">

                <div class="impact-area-card">


                    <div class="impact-area-icon">

                        <i class="fas fa-book-open"></i>

                    </div>


                    <h5>
                        Academic Support
                    </h5>


                    <p>

                        Educational resources can support students
                        across different academic requirements
                        throughout their university journey.

                    </p>


                </div>

            </div>


            <div class="col-lg-4 col-md-6">

                <div class="impact-area-card">


                    <div class="impact-area-icon">

                        <i class="fas fa-user-graduate"></i>

                    </div>


                    <h5>
                        Student Empowerment
                    </h5>


                    <p>

                        Beneficiaries become part of an organized
                        network focused on supporting genuine
                        educational needs.

                    </p>


                </div>

            </div>


            <div class="col-lg-4 col-md-6">

                <div class="impact-area-card">


                    <div class="impact-area-icon">

                        <i class="fas fa-users"></i>

                    </div>


                    <h5>
                        Community Participation
                    </h5>


                    <p>

                        Donors, beneficiaries and administrators
                        contribute to a collaborative culture of
                        responsible sharing.

                    </p>


                </div>

            </div>


            <div class="col-lg-4 col-md-6">

                <div class="impact-area-card">


                    <div class="impact-area-icon">

                        <i class="fas fa-recycle"></i>

                    </div>


                    <h5>
                        Responsible Reuse
                    </h5>


                    <p>

                        Reusing educational resources can extend
                        their useful life while creating additional
                        value for students.

                    </p>


                </div>

            </div>


            <div class="col-lg-4 col-md-6">

                <div class="impact-area-card">


                    <div class="impact-area-icon">

                        <i class="fas fa-shield-alt"></i>

                    </div>


                    <h5>
                        Transparent Participation
                    </h5>


                    <p>

                        Structured accounts and administrative
                        oversight help strengthen accountability
                        across the Sharing Network.

                    </p>


                </div>

            </div>


        </div>


    </div>

</section>



{{-- ============================================================
     TRUST & ACCOUNTABILITY
============================================================ --}}

<section class="impact-trust-section">

    <div class="container">


        <div class="row align-items-center g-5">


            <div class="col-lg-5">


                <div class="impact-trust-content">


                    <span
                        class="impact-section-label"
                        style="color:#fabc4d;"
                    >
                        Trust & Accountability
                    </span>


                    <h2>

                        Building a Responsible
                        Sharing Ecosystem

                    </h2>


                    <p>

                        Trust is essential when bringing donors
                        and beneficiaries together. The NUST
                        Sharing Network uses structured accounts,
                        role-based participation and administrative
                        oversight to strengthen accountability.

                    </p>


                </div>


            </div>


            <div class="col-lg-7">


                <div class="row g-3">


                    <div class="col-md-6">

                        <div class="impact-trust-card">


                            <div class="impact-trust-icon">

                                <i class="fas fa-user-check"></i>

                            </div>


                            <div>


                                <h6>
                                    Registered Participants
                                </h6>


                                <p>

                                    Donors and beneficiaries participate
                                    through dedicated user accounts.

                                </p>


                            </div>


                        </div>

                    </div>


                    <div class="col-md-6">

                        <div class="impact-trust-card">


                            <div class="impact-trust-icon">

                                <i class="fas fa-envelope-open-text"></i>

                            </div>


                            <div>


                                <h6>
                                    Email Verification
                                </h6>


                                <p>

                                    Verified email accounts provide an
                                    additional layer of account validation.

                                </p>


                            </div>


                        </div>

                    </div>


                    <div class="col-md-6">

                        <div class="impact-trust-card">


                            <div class="impact-trust-icon">

                                <i class="fas fa-user-shield"></i>

                            </div>


                            <div>


                                <h6>
                                    Administrative Oversight
                                </h6>


                                <p>

                                    Administrators support responsible
                                    platform management and participation.

                                </p>


                            </div>


                        </div>

                    </div>


                    <div class="col-md-6">

                        <div class="impact-trust-card">


                            <div class="impact-trust-icon">

                                <i class="fas fa-lock"></i>

                            </div>


                            <div>


                                <h6>
                                    Account Status Control
                                </h6>


                                <p>

                                    Active, suspended and blocked account
                                    statuses support platform governance.

                                </p>


                            </div>


                        </div>

                    </div>


                </div>


            </div>


        </div>


    </div>

</section>



{{-- ============================================================
     DONORS & BENEFICIARIES
============================================================ --}}

<section class="impact-section">

    <div class="container">


        <div class="impact-section-heading">


            <span class="impact-section-label">
                Join the Network
            </span>


            <h2>
                Two Communities. One Shared Purpose.
            </h2>


            <p>

                Donors and beneficiaries form the core communities
                of the Sharing Network, connected through a
                responsible and transparent digital platform.

            </p>


        </div>


        <div class="row g-4">


            {{-- DONOR --}}

            <div class="col-lg-6">

                <div class="impact-community-card donor">


                    <div class="impact-community-icon">

                        <i class="fas fa-hand-holding-heart"></i>

                    </div>


                    <h3>
                        For Donors
                    </h3>


                    <p>

                        Join a growing community of donors and
                        contribute educational resources that can
                        support students throughout their academic
                        journey.

                    </p>


                    @guest

                        <a
                            href="{{ route('register') }}"
                            class="impact-btn impact-btn-light"
                        >

                            Become a Donor

                            <i class="fas fa-arrow-right"></i>

                        </a>

                    @else

                        <a
                            href="{{ url('/dashboard') }}"
                            class="impact-btn impact-btn-light"
                        >

                            Open Dashboard

                            <i class="fas fa-arrow-right"></i>

                        </a>

                    @endguest


                </div>


            </div>


            {{-- BENEFICIARY --}}

            <div class="col-lg-6">

                <div class="impact-community-card beneficiary">


                    <div class="impact-community-icon">

                        <i class="fas fa-graduation-cap"></i>

                    </div>


                    <h3>
                        For Beneficiaries
                    </h3>


                    <p>

                        Eligible students can join the Sharing
                        Network as beneficiaries and participate
                        within the educational support ecosystem.

                    </p>


                    <a
                        href="{{ route('explore.needs') }}"
                        class="impact-btn impact-btn-dark"
                    >

                        Explore Needs

                        <i class="fas fa-arrow-right"></i>

                    </a>


                </div>


            </div>


        </div>


    </div>

</section>



{{-- ============================================================
     FINAL CTA
============================================================ --}}

<section class="impact-final-cta">

    <div class="container">


        <div class="impact-final-box">


            <span
                class="impact-section-label"
                style="color:#fabc4d;"
            >
                Make an Impact
            </span>


            <h2>

                Be Part of a Community Built Around
                Educational Support

            </h2>


            <p>

                Join the NUST Sharing Network and become part of
                a growing community of donors, beneficiaries and
                responsible participants working together to create
                meaningful educational impact.

            </p>


            <div class="impact-final-actions">


                <a
                    href="{{ route('explore.needs') }}"
                    class="impact-btn impact-btn-gold"
                >

                    Explore Needs

                    <i class="fas fa-arrow-right"></i>

                </a>


                @guest

                    <a
                        href="{{ route('register') }}"
                        class="impact-btn impact-btn-outline"
                    >
                        Join Sharing Network
                    </a>

                @else

                    <a
                        href="{{ url('/dashboard') }}"
                        class="impact-btn impact-btn-outline"
                    >
                        Go to Dashboard
                    </a>

                @endguest


            </div>


        </div>


    </div>

</section>



@include('layouts.home.footer')

@include('layouts.home.script')



{{-- ============================================================
     COUNTER ANIMATION
============================================================ --}}

<script>

    document.addEventListener('DOMContentLoaded', function () {

        const counters =
            document.querySelectorAll('.impact-counter');


        if (!counters.length) {
            return;
        }


        const counterObserver =
            new IntersectionObserver(

                function (entries, observer) {

                    entries.forEach(function (entry) {

                        if (!entry.isIntersecting) {
                            return;
                        }


                        const counter =
                            entry.target;


                        const target =
                            parseInt(
                                counter.dataset.target
                            ) || 0;


                        const duration = 1300;

                        const startTime =
                            performance.now();


                        function animate(currentTime) {

                            const progress =
                                Math.min(

                                    (
                                        currentTime
                                        -
                                        startTime
                                    )
                                    /
                                    duration,

                                    1
                                );


                            const currentValue =
                                Math.floor(
                                    target * progress
                                );


                            counter.textContent =
                                currentValue
                                    .toLocaleString();


                            if (progress < 1) {

                                requestAnimationFrame(
                                    animate
                                );

                            } else {

                                counter.textContent =
                                    target
                                        .toLocaleString();

                            }

                        }


                        requestAnimationFrame(
                            animate
                        );


                        observer.unobserve(
                            counter
                        );

                    });

                },

                {
                    threshold: 0.30
                }
            );


        counters.forEach(function (counter) {

            counterObserver.observe(
                counter
            );

        });

    });

</script>


</body>