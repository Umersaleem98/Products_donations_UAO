@include('layouts.home.head')

<title>Explore Needs | NUST Sharing Network</title>

<style>

    /* =========================================================
       NUST SHARING NETWORK - EXPLORE NEEDS
    ========================================================= */

    :root {
        --needs-primary: #123b60;
        --needs-primary-dark: #082944;
        --needs-primary-light: #1d527c;

        --needs-gold: #fabc4d;
        --needs-gold-dark: #d99b24;

        --needs-white: #ffffff;
        --needs-light: #f6f8fb;
        --needs-border: #e3e9ef;

        --needs-text: #25384b;
        --needs-muted: #6f7e8e;
    }


    html {
        scroll-behavior: smooth;
    }


    body {
        background: var(--needs-white);
        color: var(--needs-text);
    }


    /* =========================================================
       SHORT HERO BANNER
    ========================================================= */

    .needs-short-hero {
        position: relative;

        min-height: 260px;

        display: flex;
        align-items: center;

        overflow: hidden;

        background:
            linear-gradient(
                90deg,
                rgba(8, 41, 68, .96) 0%,
                rgba(18, 59, 96, .91) 55%,
                rgba(18, 59, 96, .75) 100%
            ),
            url('{{ asset("templates/assets/sliders/slider1.png") }}');

        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }


    .needs-short-hero::before {
        content: "";

        position: absolute;

        width: 280px;
        height: 280px;

        right: -120px;
        top: -150px;

        border: 45px solid rgba(250, 188, 77, .08);

        border-radius: 50%;
    }


    .needs-short-hero::after {
        content: "";

        position: absolute;

        width: 180px;
        height: 180px;

        left: -70px;
        bottom: -120px;

        border-radius: 50%;

        background: rgba(250, 188, 77, .05);
    }


    .needs-short-hero-content {
        position: relative;

        z-index: 2;

        max-width: 760px;

        padding: 48px 0;
    }


    .needs-short-breadcrumb {
        display: flex;
        align-items: center;
        flex-wrap: wrap;

        gap: 8px;

        margin-bottom: 13px;

        font-size: 13px;
    }


    .needs-short-breadcrumb a {
        color: rgba(255, 255, 255, .68);

        text-decoration: none;

        transition: .3s ease;
    }


    .needs-short-breadcrumb a:hover {
        color: var(--needs-gold);
    }


    .needs-short-breadcrumb span {
        color: var(--needs-gold);
    }


    .needs-short-label {
        display: inline-flex;
        align-items: center;

        gap: 7px;

        margin-bottom: 12px;

        color: var(--needs-gold);

        font-size: 11px;
        font-weight: 800;

        letter-spacing: 1.5px;

        text-transform: uppercase;
    }


    .needs-short-hero h1 {
        margin-bottom: 12px;

        color: var(--needs-white);

        font-size: clamp(30px, 4vw, 46px);

        font-weight: 800;

        line-height: 1.15;
    }


    .needs-short-hero h1 span {
        color: var(--needs-gold);
    }


    .needs-short-hero p {
        max-width: 680px;

        margin: 0;

        color: rgba(255, 255, 255, .76);

        font-size: 15px;

        line-height: 1.75;
    }


    /* =========================================================
       SECTION HEADINGS
    ========================================================= */

    .needs-section {
        padding: 90px 0;
    }


    .needs-first-section {
        padding-top: 80px;
    }


    .needs-section-light {
        background: var(--needs-light);
    }


    .needs-section-heading {
        max-width: 760px;

        margin: 0 auto 50px;

        text-align: center;
    }


    .needs-section-label {
        display: inline-block;

        margin-bottom: 10px;

        color: var(--needs-gold-dark);

        font-size: 12px;

        font-weight: 800;

        letter-spacing: 1.7px;

        text-transform: uppercase;
    }


    .needs-section-heading h1,
    .needs-section-heading h2 {
        margin-bottom: 15px;

        color: var(--needs-primary);

        font-size: clamp(28px, 4vw, 40px);

        font-weight: 800;

        line-height: 1.2;
    }


    .needs-section-heading p {
        max-width: 680px;

        margin: auto;

        color: var(--needs-muted);

        font-size: 15px;

        line-height: 1.8;
    }


    /* =========================================================
       INTRODUCTION
    ========================================================= */

    .needs-intro-card {
        position: relative;

        height: 100%;

        overflow: hidden;

        padding: 32px 28px;

        border: 1px solid var(--needs-border);

        border-radius: 18px;

        background: var(--needs-white);

        transition: all .35s ease;
    }


    .needs-intro-card::before {
        content: "";

        position: absolute;

        width: 100px;
        height: 100px;

        top: -60px;
        right: -60px;

        border-radius: 50%;

        background: rgba(250, 188, 77, .12);
    }


    .needs-intro-card:hover {
        transform: translateY(-6px);

        border-color:
            rgba(250, 188, 77, .7);

        box-shadow:
            0 18px 40px
            rgba(18, 59, 96, .08);
    }


    .needs-intro-icon {
        position: relative;

        z-index: 2;

        width: 55px;
        height: 55px;

        display: flex;
        align-items: center;
        justify-content: center;

        margin-bottom: 20px;

        border-radius: 15px;

        background:
            rgba(250, 188, 77, .17);

        color: var(--needs-primary);

        font-size: 21px;

        transition: .3s ease;
    }


    .needs-intro-card:hover
    .needs-intro-icon {
        background: var(--needs-primary);

        color: var(--needs-gold);
    }


    .needs-intro-card h5 {
        position: relative;

        z-index: 2;

        margin-bottom: 10px;

        color: var(--needs-primary);

        font-size: 18px;

        font-weight: 750;
    }


    .needs-intro-card p {
        position: relative;

        z-index: 2;

        margin: 0;

        color: var(--needs-muted);

        font-size: 14px;

        line-height: 1.75;
    }


    /* =========================================================
       CATEGORY SECTION
    ========================================================= */

    .needs-categories-section {
        padding: 95px 0;

        background: var(--needs-light);
    }


    .needs-category-count-box {
        max-width: 500px;

        margin:
            -20px auto 45px;

        text-align: center;
    }


    .needs-category-count {
        display: inline-flex;

        align-items: center;

        gap: 9px;

        padding: 10px 20px;

        border:
            1px solid
            var(--needs-border);

        border-radius: 50px;

        background: var(--needs-white);

        color: var(--needs-muted);

        font-size: 13px;

        box-shadow:
            0 8px 25px
            rgba(18, 59, 96, .04);
    }


    .needs-category-count strong {
        color: var(--needs-primary);
    }


    .needs-category-count i {
        color: var(--needs-gold-dark);
    }


    /* =========================================================
       CATEGORY CARD
    ========================================================= */

    .needs-category-card {
        position: relative;

        height: 100%;

        min-height: 245px;

        display: flex;

        flex-direction: column;

        justify-content: space-between;

        overflow: hidden;

        padding: 30px;

        border:
            1px solid
            var(--needs-border);

        border-radius: 20px;

        background: var(--needs-white);

        transition: .35s ease;
    }


    .needs-category-card::before {
        content: "";

        position: absolute;

        width: 150px;
        height: 150px;

        right: -85px;
        top: -85px;

        border-radius: 50%;

        background:
            rgba(250, 188, 77, .16);

        transition: .4s ease;
    }


    .needs-category-card::after {
        content: "";

        position: absolute;

        width: 80px;
        height: 80px;

        right: -45px;
        bottom: -45px;

        border-radius: 50%;

        background:
            rgba(18, 59, 96, .05);
    }


    .needs-category-card:hover {
        transform:
            translateY(-8px);

        border-color:
            rgba(250, 188, 77, .85);

        box-shadow:
            0 20px 45px
            rgba(18, 59, 96, .11);
    }


    .needs-category-card:hover::before {
        transform: scale(1.15);
    }


    .needs-category-icon {
        position: relative;

        z-index: 2;

        width: 62px;
        height: 62px;

        display: flex;

        align-items: center;
        justify-content: center;

        margin-bottom: 28px;

        border-radius: 17px;

        background: var(--needs-primary);

        color: var(--needs-gold);

        font-size: 24px;

        transition: .3s ease;
    }


    .needs-category-card:hover
    .needs-category-icon {
        background: var(--needs-gold);

        color: var(--needs-primary-dark);

        transform: rotate(-5deg);
    }


    .needs-category-content {
        position: relative;

        z-index: 2;
    }


    .needs-category-number {
        display: block;

        margin-bottom: 7px;

        color: var(--needs-gold-dark);

        font-size: 11px;

        font-weight: 800;

        letter-spacing: 1px;

        text-transform: uppercase;
    }


    .needs-category-card h4 {
        margin-bottom: 8px;

        color: var(--needs-primary);

        font-size: 20px;

        font-weight: 750;

        line-height: 1.35;
    }


    .needs-category-card p {
        margin-bottom: 0;

        color: var(--needs-muted);

        font-size: 13px;

        line-height: 1.7;
    }


    .needs-category-footer {
        position: relative;

        z-index: 2;

        display: flex;

        justify-content: space-between;
        align-items: center;

        margin-top: 24px;

        padding-top: 17px;

        border-top:
            1px solid #edf0f3;
    }


    .needs-category-slug {
        max-width: 75%;

        overflow: hidden;

        color: #9aa6b1;

        text-overflow: ellipsis;

        white-space: nowrap;

        font-size: 11px;
    }


    .needs-category-arrow {
        width: 34px;
        height: 34px;

        display: flex;

        align-items: center;
        justify-content: center;

        border-radius: 50%;

        background:
            rgba(250, 188, 77, .16);

        color: var(--needs-primary);

        font-size: 12px;

        transition: .3s;
    }


    .needs-category-card:hover
    .needs-category-arrow {
        background: var(--needs-primary);

        color: var(--needs-gold);

        transform: translateX(3px);
    }


    /* =========================================================
       EMPTY CATEGORY STATE
    ========================================================= */

    .needs-empty-state {
        padding: 70px 30px;

        border:
            1px dashed #cad4de;

        border-radius: 20px;

        background: var(--needs-white);

        text-align: center;
    }


    .needs-empty-icon {
        width: 75px;
        height: 75px;

        display: flex;
        align-items: center;
        justify-content: center;

        margin:
            0 auto 20px;

        border-radius: 50%;

        background:
            rgba(250, 188, 77, .17);

        color: var(--needs-primary);

        font-size: 28px;
    }


    .needs-empty-state h4 {
        color: var(--needs-primary);

        font-weight: 750;
    }


    .needs-empty-state p {
        max-width: 550px;

        margin:
            10px auto 0;

        color: var(--needs-muted);
    }


    /* =========================================================
       HOW SHARING WORKS
    ========================================================= */

    .needs-process-card {
        position: relative;

        height: 100%;

        overflow: hidden;

        padding: 32px 24px;

        border:
            1px solid
            var(--needs-border);

        border-radius: 18px;

        background: var(--needs-white);

        text-align: center;

        transition: .35s ease;
    }


    .needs-process-card:hover {
        transform:
            translateY(-6px);

        border-color:
            rgba(250, 188, 77, .6);

        box-shadow:
            0 18px 40px
            rgba(18, 59, 96, .08);
    }


    .needs-process-number {
        width: 55px;
        height: 55px;

        display: flex;
        align-items: center;
        justify-content: center;

        margin:
            0 auto 20px;

        border-radius: 15px;

        background: var(--needs-primary);

        color: var(--needs-gold);

        font-size: 17px;

        font-weight: 800;

        transition: .3s ease;
    }


    .needs-process-card:hover
    .needs-process-number {
        background: var(--needs-gold);

        color: var(--needs-primary-dark);
    }


    .needs-process-card h5 {
        margin-bottom: 10px;

        color: var(--needs-primary);

        font-size: 17px;

        font-weight: 750;
    }


    .needs-process-card p {
        margin-bottom: 0;

        color: var(--needs-muted);

        font-size: 13px;

        line-height: 1.75;
    }


    /* =========================================================
       RESPONSIBLE SHARING
    ========================================================= */

    .needs-responsible-section {
        position: relative;

        overflow: hidden;

        padding: 95px 0;

        background:
            linear-gradient(
                135deg,
                var(--needs-primary-dark),
                var(--needs-primary)
            );
    }


    .needs-responsible-section::before {
        content: "";

        position: absolute;

        width: 380px;
        height: 380px;

        top: -170px;
        right: -130px;

        border:
            65px solid
            rgba(250, 188, 77, .06);

        border-radius: 50%;
    }


    .needs-responsible-section::after {
        content: "";

        position: absolute;

        width: 260px;
        height: 260px;

        bottom: -180px;
        left: -80px;

        border-radius: 50%;

        background:
            rgba(250, 188, 77, .04);
    }


    .needs-responsible-content {
        position: relative;

        z-index: 2;
    }


    .needs-responsible-content h2 {
        margin-bottom: 18px;

        color: var(--needs-white);

        font-size:
            clamp(29px, 4vw, 40px);

        font-weight: 800;

        line-height: 1.2;
    }


    .needs-responsible-content > p {
        color:
            rgba(255, 255, 255, .72);

        line-height: 1.85;
    }


    .needs-responsible-card {
        position: relative;

        z-index: 2;

        height: 100%;

        display: flex;

        align-items: flex-start;

        gap: 14px;

        padding: 22px;

        border:
            1px solid
            rgba(255, 255, 255, .1);

        border-radius: 14px;

        background:
            rgba(255, 255, 255, .07);

        transition: .3s ease;
    }


    .needs-responsible-card:hover {
        transform: translateY(-4px);

        border-color:
            rgba(250, 188, 77, .35);

        background:
            rgba(255, 255, 255, .10);
    }


    .needs-responsible-icon {
        flex: 0 0 42px;

        width: 42px;
        height: 42px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 11px;

        background: var(--needs-gold);

        color: var(--needs-primary-dark);
    }


    .needs-responsible-card h6 {
        margin-bottom: 5px;

        color: white;

        font-weight: 700;
    }


    .needs-responsible-card p {
        margin: 0;

        color:
            rgba(255, 255, 255, .67);

        font-size: 12px;

        line-height: 1.65;
    }


    /* =========================================================
       FINAL CTA
    ========================================================= */

    .needs-cta-section {
        padding: 95px 0;

        background: var(--needs-light);
    }


    .needs-cta-box {
        position: relative;

        overflow: hidden;

        padding: 60px 45px;

        border-radius: 25px;

        background: var(--needs-gold);
    }


    .needs-cta-box::before {
        content: "";

        position: absolute;

        width: 180px;
        height: 180px;

        left: -110px;
        top: -110px;

        border-radius: 50%;

        border:
            35px solid
            rgba(18, 59, 96, .06);
    }


    .needs-cta-box::after {
        content: "";

        position: absolute;

        width: 280px;
        height: 280px;

        right: -100px;
        bottom: -150px;

        border:
            50px solid
            rgba(18, 59, 96, .08);

        border-radius: 50%;
    }


    .needs-cta-content {
        position: relative;

        z-index: 2;
    }


    .needs-cta-box h2 {
        margin-bottom: 12px;

        color: var(--needs-primary-dark);

        font-size:
            clamp(28px, 4vw, 40px);

        font-weight: 800;
    }


    .needs-cta-box p {
        max-width: 700px;

        margin-bottom: 0;

        color:
            rgba(8, 41, 68, .76);

        line-height: 1.8;
    }


    .needs-cta-btn {
        position: relative;

        z-index: 2;

        display: inline-flex;

        align-items: center;
        justify-content: center;

        gap: 9px;

        padding: 14px 28px;

        border-radius: 50px;

        background: var(--needs-primary);

        color: white;

        text-decoration: none;

        font-size: 14px;

        font-weight: 700;

        transition: .3s ease;
    }


    .needs-cta-btn:hover {
        background: var(--needs-primary-dark);

        color: var(--needs-gold);

        transform: translateY(-2px);
    }


    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 991.98px) {

        .needs-section,
        .needs-categories-section,
        .needs-responsible-section,
        .needs-cta-section {
            padding: 70px 0;
        }


        .needs-first-section {
            padding-top: 70px;
        }


        .needs-cta-box {
            padding: 45px 35px;
        }

    }


    @media (max-width: 767.98px) {

        .needs-short-hero {
            min-height: 230px;
        }


        .needs-short-hero-content {
            padding: 38px 0;
        }


        .needs-short-hero h1 {
            font-size: 31px;
        }


        .needs-short-hero p {
            font-size: 14px;
        }


        .needs-section,
        .needs-categories-section,
        .needs-responsible-section,
        .needs-cta-section {
            padding: 60px 0;
        }


        .needs-first-section {
            padding-top: 60px;
        }


        .needs-section-heading {
            margin-bottom: 38px;
        }


        .needs-category-card {
            min-height: auto;

            padding: 27px 24px;
        }


        .needs-cta-box {
            padding: 40px 25px;
        }

    }


    @media (max-width: 575.98px) {

        .needs-short-hero {
            min-height: 220px;
        }


        .needs-short-breadcrumb {
            font-size: 12px;
        }


        .needs-short-hero h1 {
            font-size: 28px;
        }


        .needs-section-heading h1,
        .needs-section-heading h2 {
            font-size: 28px;
        }


        .needs-category-card {
            border-radius: 16px;
        }


        .needs-cta-btn {
            width: 100%;
        }

    }

</style>


<body>


{{-- @include('layouts.home.preloader') --}}

@include('layouts.home.header')



{{-- ============================================================
     SHORT HERO BANNER
============================================================ --}}

<section class="needs-short-hero">

    <div class="container">

        <div class="needs-short-hero-content">


            <div class="needs-short-breadcrumb">

                <a href="{{ url('/') }}">
                    Home
                </a>

                <span>
                    /
                </span>

                <span>
                    Explore Needs
                </span>

            </div>


            <span class="needs-short-label">

                <i class="fas fa-hand-holding-heart"></i>

                NUST Sharing Network

            </span>


            <h1>

                Explore Educational
                <span>Needs</span>

            </h1>


            <p>

                Discover the different areas where educational
                support can make a meaningful difference. Explore
                available need categories and become part of a
                responsible community built around sharing and
                student support.

            </p>


        </div>

    </div>

</section>



{{-- ============================================================
     INTRODUCTION
============================================================ --}}

<section class="needs-section needs-first-section">

    <div class="container">


        <div class="needs-section-heading">


            <span class="needs-section-label">
                Sharing With Purpose
            </span>


            <h2>
                Understanding Educational Needs
            </h2>


            <p>

                Different students may require different forms of
                educational support. The NUST Sharing Network organizes
                these needs into clear categories, helping create a
                more structured connection between donors and
                beneficiaries.

            </p>


        </div>


        <div class="row g-4">


            {{-- ORGANIZED CATEGORIES --}}

            <div class="col-lg-4 col-md-6">


                <div class="needs-intro-card">


                    <div class="needs-intro-icon">

                        <i class="fas fa-layer-group"></i>

                    </div>


                    <h5>
                        Organized Categories
                    </h5>


                    <p>

                        Educational needs are organized into categories
                        so visitors can easily understand the different
                        areas supported by the Sharing Network.

                    </p>


                </div>


            </div>



            {{-- STUDENT-CENTERED SUPPORT --}}

            <div class="col-lg-4 col-md-6">


                <div class="needs-intro-card">


                    <div class="needs-intro-icon">

                        <i class="fas fa-user-graduate"></i>

                    </div>


                    <h5>
                        Student-Centered Support
                    </h5>


                    <p>

                        Each category represents a potential area where
                        educational support can contribute to a student's
                        academic journey.

                    </p>


                </div>


            </div>



            {{-- MEANINGFUL CONNECTIONS --}}

            <div class="col-lg-4 col-md-6">


                <div class="needs-intro-card">


                    <div class="needs-intro-icon">

                        <i class="fas fa-handshake"></i>

                    </div>


                    <h5>
                        Meaningful Connections
                    </h5>


                    <p>

                        The Sharing Network provides a structured
                        pathway for donors and eligible beneficiaries
                        to connect responsibly.

                    </p>


                </div>


            </div>


        </div>


    </div>

</section>



{{-- ============================================================
     DATABASE CATEGORIES
============================================================ --}}

<section
    class="needs-categories-section"
    id="need-categories"
>

    <div class="container">


        <div class="needs-section-heading">


            <span class="needs-section-label">
                Explore Needs
            </span>


            <h2>
                Educational Need Categories
            </h2>


            <p>

                Explore all categories currently available through
                the NUST Sharing Network. Categories are managed
                dynamically and automatically appear here when
                added to the platform.

            </p>


        </div>



        {{-- TOTAL CATEGORIES --}}

        <div class="needs-category-count-box">


            <div class="needs-category-count">


                <i class="fas fa-layer-group"></i>


                <span>


                    <strong>

                        {{ number_format($totalCategories ?? 0) }}

                    </strong>


                    {{

                        ($totalCategories ?? 0) == 1
                            ? 'category'
                            : 'categories'

                    }}

                    available


                </span>


            </div>


        </div>



        {{-- CATEGORY GRID --}}

        <div class="row g-4">


            @forelse($categories as $index => $category)


                <div class="col-xl-3 col-lg-4 col-md-6">


                    <div class="needs-category-card">


                        <div>


                            <div class="needs-category-icon">

                                <i class="fas fa-folder-open"></i>

                            </div>


                            <div class="needs-category-content">


                                <span class="needs-category-number">


                                    Category


                                    {{ str_pad(
                                        $index + 1,
                                        2,
                                        '0',
                                        STR_PAD_LEFT
                                    ) }}


                                </span>


                                <h4>

                                    {{ $category->name }}

                                </h4>


                                <p>

                                    Educational support category
                                    available through the NUST
                                    Sharing Network.

                                </p>


                            </div>


                        </div>


                        <div class="needs-category-footer">


                            <span class="needs-category-slug">

                                {{ $category->slug }}

                            </span>


                            <span class="needs-category-arrow">

                                <i class="fas fa-arrow-right"></i>

                            </span>


                        </div>


                    </div>


                </div>


            @empty


                <div class="col-12">


                    <div class="needs-empty-state">


                        <div class="needs-empty-icon">

                            <i class="fas fa-layer-group"></i>

                        </div>


                        <h4>
                            No Categories Available
                        </h4>


                        <p>

                            No educational need categories have been
                            added yet. Categories created from the
                            administration panel will automatically
                            appear on this page.

                        </p>


                    </div>


                </div>


            @endforelse


        </div>


    </div>

</section>



{{-- ============================================================
     HOW THE NETWORK WORKS
============================================================ --}}

<section class="needs-section">

    <div class="container">


        <div class="needs-section-heading">


            <span class="needs-section-label">

                How It Works

            </span>


            <h2>

                From Educational Need to Meaningful Support

            </h2>


            <p>

                NUST Sharing Network provides a structured process
                that connects educational needs with responsible
                community sharing.

            </p>


        </div>


        <div class="row g-4">


            <div class="col-lg-3 col-md-6">


                <div class="needs-process-card">


                    <div class="needs-process-number">

                        01

                    </div>


                    <h5>

                        Identify the Need

                    </h5>


                    <p>

                        Educational needs are organized into
                        appropriate categories on the Sharing
                        Network.

                    </p>


                </div>


            </div>



            <div class="col-lg-3 col-md-6">


                <div class="needs-process-card">


                    <div class="needs-process-number">

                        02

                    </div>


                    <h5>

                        Community Sharing

                    </h5>


                    <p>

                        Donors can contribute useful educational
                        resources according to student needs.

                    </p>


                </div>


            </div>



            <div class="col-lg-3 col-md-6">


                <div class="needs-process-card">


                    <div class="needs-process-number">

                        03

                    </div>


                    <h5>

                        Verification

                    </h5>


                    <p>

                        Beneficiary participation and requests
                        move through the required verification
                        process.

                    </p>


                </div>


            </div>



            <div class="col-lg-3 col-md-6">


                <div class="needs-process-card">


                    <div class="needs-process-number">

                        04

                    </div>


                    <h5>

                        Create Impact

                    </h5>


                    <p>

                        Successful sharing helps transform
                        available resources into meaningful
                        educational support.

                    </p>


                </div>


            </div>


        </div>


    </div>

</section>



{{-- ============================================================
     RESPONSIBLE SHARING
============================================================ --}}

<section class="needs-responsible-section">

    <div class="container">


        <div class="row align-items-center g-5">


            <div class="col-lg-5">


                <div class="needs-responsible-content">


                    <span
                        class="needs-section-label"
                        style="color:#fabc4d;"
                    >

                        Responsible Sharing

                    </span>


                    <h2>

                        Building a Trusted Sharing Community

                    </h2>


                    <p>

                        NUST Sharing Network is designed to encourage
                        responsible participation, transparency and
                        meaningful educational support between donors
                        and beneficiaries.

                    </p>


                </div>


            </div>


            <div class="col-lg-7">


                <div class="row g-3">


                    <div class="col-md-6">


                        <div class="needs-responsible-card">


                            <div class="needs-responsible-icon">

                                <i class="fas fa-user-check"></i>

                            </div>


                            <div>


                                <h6>
                                    Registered Participants
                                </h6>


                                <p>

                                    Donors and beneficiaries participate
                                    through dedicated accounts.

                                </p>


                            </div>


                        </div>


                    </div>



                    <div class="col-md-6">


                        <div class="needs-responsible-card">


                            <div class="needs-responsible-icon">

                                <i class="fas fa-clipboard-check"></i>

                            </div>


                            <div>


                                <h6>
                                    Structured Process
                                </h6>


                                <p>

                                    Sharing activities move through
                                    clear administrative workflows.

                                </p>


                            </div>


                        </div>


                    </div>



                    <div class="col-md-6">


                        <div class="needs-responsible-card">


                            <div class="needs-responsible-icon">

                                <i class="fas fa-shield-alt"></i>

                            </div>


                            <div>


                                <h6>
                                    Accountability
                                </h6>


                                <p>

                                    Digital records support transparency
                                    throughout the Sharing Network.

                                </p>


                            </div>


                        </div>


                    </div>



                    <div class="col-md-6">


                        <div class="needs-responsible-card">


                            <div class="needs-responsible-icon">

                                <i class="fas fa-handshake"></i>

                            </div>


                            <div>


                                <h6>
                                    Meaningful Connections
                                </h6>


                                <p>

                                    The network connects community
                                    generosity with genuine educational
                                    needs.

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
     FINAL CTA
============================================================ --}}

<section class="needs-cta-section">

    <div class="container">


        <div class="needs-cta-box">


            <div class="row align-items-center g-4">


                <div class="col-lg-8">


                    <div class="needs-cta-content">


                        <span
                            class="needs-section-label"
                            style="color:#123b60;"
                        >

                            Join the Network

                        </span>


                        <h2>

                            Be Part of the NUST Sharing Network

                        </h2>


                        <p>

                            Whether you want to support educational
                            needs as a donor or participate as an
                            eligible beneficiary, join a community
                            built around responsible sharing and
                            meaningful educational impact.

                        </p>


                    </div>


                </div>


                <div class="col-lg-4 text-lg-end">


                    @guest


                        <a
                            href="{{ route('register') }}"
                            class="needs-cta-btn"
                        >

                            Join Sharing Network

                            <i class="fas fa-arrow-right"></i>

                        </a>


                    @else


                        <a
                            href="{{ url('/dashboard') }}"
                            class="needs-cta-btn"
                        >

                            Open Dashboard

                            <i class="fas fa-arrow-right"></i>

                        </a>


                    @endguest


                </div>


            </div>


        </div>


    </div>

</section>



@include('layouts.home.footer')

@include('layouts.home.script')


</body>