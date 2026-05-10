<style>
    /* HERO SLIDER */
    .hero-slider {
        position: relative;
        height: 100vh;
        min-height: 700px;
        overflow: hidden;
    }

    .slide {
        position: absolute;
        inset: 0;
        opacity: 0;
        transition: opacity 1s ease-in-out;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .slide.active {
        opacity: 1;
        z-index: 2;
    }

    /* BACKGROUND IMAGE */
    .slide-bg {
        position: absolute;
        inset: 0;
        background-size: cover;
        background-position: center center;
        background-repeat: no-repeat;
        transform: scale(1.05);
    }

    /* DARK OVERLAY */
    .slide::before {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(
            to right,
            rgba(0,0,0,0.75),
            rgba(0,0,0,0.45)
        );
        z-index: 1;
    }

    /* CONTENT */
    .slide-content {
        position: relative;
        z-index: 3;
        text-align: center;
        color: var(--white);
        max-width: 850px;
        padding: 0 20px;
    }

    .slide-content h1 {
        font-size: 4rem;
        font-weight: 800;
        margin-bottom: 20px;
        text-transform: uppercase;
        line-height: 1.2;
        letter-spacing: 1px;
    }

    .slide-content h1 span {
        color: var(--secondary-color);
    }

    .slide-content p {
        font-size: 1.1rem;
        line-height: 1.9;
        margin-bottom: 35px;
        color: rgba(255,255,255,0.9);
    }

    /* BUTTONS */
    .btn-hero {
        display: inline-block;
        padding: 14px 38px;
        background: var(--secondary-color);
        color: var(--dark-color);
        text-decoration: none;
        border-radius: 50px;
        font-weight: 700;
        font-size: 1rem;
        transition: 0.3s ease;
        margin: 8px;
        border: 2px solid var(--secondary-color);
    }

    .btn-hero:hover {
        background: transparent;
        color: var(--white);
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(250, 189, 77, 0.3);
    }

    .btn-hero-outline {
        background: transparent;
        color: var(--white);
        border: 2px solid var(--white);
    }

    .btn-hero-outline:hover {
        background: var(--white);
        color: var(--primary-color);
    }

    /* ARROWS */
    .slider-arrows {
        position: absolute;
        top: 50%;
        left: 0;
        width: 100%;
        transform: translateY(-50%);
        z-index: 10;
        display: flex;
        justify-content: space-between;
        padding: 0 30px;
    }

    .slider-arrow {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: rgba(255,255,255,0.15);
        backdrop-filter: blur(10px);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--white);
        font-size: 1.3rem;
        cursor: pointer;
        transition: 0.3s ease;
        border: 1px solid rgba(255,255,255,0.2);
    }

    .slider-arrow:hover {
        background: var(--secondary-color);
        color: var(--dark-color);
    }

    /* DOTS */
    .slider-controls {
        position: absolute;
        bottom: 40px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 10;
        display: flex;
        gap: 12px;
    }

    .slider-dot {
        width: 14px;
        height: 14px;
        border-radius: 50%;
        background: rgba(255,255,255,0.5);
        cursor: pointer;
        transition: 0.3s ease;
    }

    .slider-dot.active {
        background: var(--secondary-color);
        transform: scale(1.3);
    }

    /* RESPONSIVE */
    @media (max-width: 991px) {

        .hero-slider {
            min-height: 650px;
        }

        .slide-content h1 {
            font-size: 3rem;
        }

        .slide-content p {
            font-size: 1rem;
        }
    }

    @media (max-width: 576px) {

        .hero-slider {
            min-height: 600px;
        }

        .slide-content h1 {
            font-size: 2.2rem;
        }

        .slide-content p {
            font-size: 0.95rem;
            line-height: 1.7;
        }

        .btn-hero {
            padding: 12px 25px;
            font-size: 0.95rem;
        }

        .slider-arrow {
            width: 45px;
            height: 45px;
            font-size: 1rem;
        }
    }
</style>

<!-- HERO SLIDER -->
<section class="hero-slider" id="home">

    <!-- SLIDE 1 -->
    <div class="slide active">

        <div class="slide-bg"
            style="background-image: url('{{ asset('templates/assets/sliders/slider1.png') }}');">
        </div>

        <div class="slide-content" data-aos="fade-up">

            <h1>
                Donate <span>Gadgets</span>, Change Lives
            </h1>

            <p>
                Join NUST Gift Store in bridging the digital divide.
                Your unused laptops, books, and mobile devices can
                empower students and transform futures.
            </p>

            <div>
                <a href="#donate" class="btn-hero">Start Donating</a>
                <a href="#how-it-works" class="btn-hero btn-hero-outline">
                    Learn More
                </a>
            </div>

        </div>

    </div>

    <!-- SLIDE 2 -->
    <div class="slide">

        <div class="slide-bg"
            style="background-image: url('{{ asset('templates/assets/sliders/slider2.png') }}');">
        </div>

        <div class="slide-content">

            <h1>
                Education <span>For All</span>
            </h1>

            <p>
                Every book donated opens a door to knowledge.
                Every laptop shared creates an opportunity.
                Be the reason someone achieves their dreams.
            </p>

            <div>
                <a href="#categories" class="btn-hero">Browse Categories</a>
                <a href="#about" class="btn-hero btn-hero-outline">
                    Our Mission
                </a>
            </div>

        </div>

    </div>

    <!-- SLIDE 3 -->
    <div class="slide">

        <div class="slide-bg"
            style="background-image: url('{{ asset('templates/assets/sliders/slider3.png') }}');">
        </div>

        <div class="slide-content">

            <h1>
                Connect <span>Communities</span>
            </h1>

            <p>
                From donors to beneficiaries, we build bridges of hope.
                Your generosity creates ripples of positive change across
                NUST and beyond.
            </p>

            <div>
                <a href="#services" class="btn-hero">Our Services</a>
                <a href="#testimonials" class="btn-hero btn-hero-outline">
                    Success Stories
                </a>
            </div>

        </div>

    </div>

    <!-- ARROWS -->
    <div class="slider-arrows">
        <div class="slider-arrow" id="prevSlide">
            <i class="fas fa-chevron-left"></i>
        </div>

        <div class="slider-arrow" id="nextSlide">
            <i class="fas fa-chevron-right"></i>
        </div>
    </div>

    <!-- DOTS -->
    <div class="slider-controls">
        <div class="slider-dot active" data-slide="0"></div>
        <div class="slider-dot" data-slide="1"></div>
        <div class="slider-dot" data-slide="2"></div>
    </div>

</section>

<!-- SLIDER SCRIPT -->
<script>
    const slides = document.querySelectorAll(".slide");
    const dots = document.querySelectorAll(".slider-dot");
    const nextBtn = document.getElementById("nextSlide");
    const prevBtn = document.getElementById("prevSlide");

    let currentSlide = 0;

    function showSlide(index) {

        slides.forEach((slide) => {
            slide.classList.remove("active");
        });

        dots.forEach((dot) => {
            dot.classList.remove("active");
        });

        slides[index].classList.add("active");
        dots[index].classList.add("active");

    }

    function nextSlide() {
        currentSlide = (currentSlide + 1) % slides.length;
        showSlide(currentSlide);
    }

    function prevSlide() {
        currentSlide = (currentSlide - 1 + slides.length) % slides.length;
        showSlide(currentSlide);
    }

    nextBtn.addEventListener("click", nextSlide);
    prevBtn.addEventListener("click", prevSlide);

    dots.forEach((dot, index) => {
        dot.addEventListener("click", () => {
            currentSlide = index;
            showSlide(currentSlide);
        });
    });

    // AUTO SLIDE
    setInterval(nextSlide, 5000);
</script>