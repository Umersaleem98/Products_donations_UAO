<!-- HERO SLIDER STYLE -->
<style>
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

    .slide-bg {
        position: absolute;
        inset: 0;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        transform: scale(1.05);
    }

    .slide::before {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(to right, rgba(0,0,0,0.75), rgba(0,0,0,0.45));
        z-index: 1;
    }

    .slide-content {
        position: relative;
        z-index: 3;
        text-align: center;
        color: #fff;
        max-width: 850px;
        padding: 0 20px;
    }

    .slide-content h1 {
        font-size: 3rem;
        font-weight: 800;
        margin-bottom: 20px;
        text-transform: uppercase;
        line-height: 1.2;
        letter-spacing: 1px;
    }

    .slide-content h1 span {
        color: #fabc4d;
    }

    .slide-content p {
        font-size: 1.1rem;
        line-height: 1.9;
        margin-bottom: 35px;
        color: rgba(255,255,255,0.9);
    }

    .btn-hero {
        display: inline-block;
        padding: 14px 38px;
        background: #fabc4d;
        color: #111;
        text-decoration: none;
        border-radius: 50px;
        font-weight: 700;
        margin: 8px;
        transition: 0.3s ease;
        border: 2px solid #fabc4d;
    }

    .btn-hero:hover {
        background: transparent;
        color: #fff;
    }

    .btn-hero-outline {
        background: transparent;
        color: #fff;
        border: 2px solid #fff;
    }

    .btn-hero-outline:hover {
        background: #fff;
        color: #111;
    }

    .slider-arrows {
        position: absolute;
        top: 50%;
        width: 100%;
        display: flex;
        justify-content: space-between;
        padding: 0 30px;
        z-index: 10;
        transform: translateY(-50%);
    }

    .slider-arrow {
        width: 55px;
        height: 55px;
        border-radius: 50%;
        background: rgba(255,255,255,0.15);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        cursor: pointer;
    }

    .slider-arrow:hover {
        background: #fabc4d;
        color: #111;
    }

    .slider-controls {
        position: absolute;
        bottom: 40px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 10px;
        z-index: 10;
    }

    .slider-dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: rgba(255,255,255,0.5);
        cursor: pointer;
    }

    .slider-dot.active {
        background: #fabc4d;
        transform: scale(1.3);
    }
</style>

<!-- HERO SLIDER -->
<section class="hero-slider" id="home">

    <!-- SLIDE 1 -->
    <div class="slide active">
        <div class="slide-bg" style="background-image: url('{{ asset('templates/assets/sliders/slider1.png') }}');"></div>

        <div class="slide-content">
            <h1>NUST <span>Sharing Network</span></h1>
            <p>
                A centralized platform connecting donors and students to reduce educational inequality.
                We facilitate the donation of laptops, books, and essential learning resources.
            </p>

           <a href="#categories" class="btn-hero">Explore Needs</a>
            <a href="#impact" class="btn-hero btn-hero-outline">Our Impact</a>
        </div>
    </div>

    <!-- SLIDE 2 -->
    <div class="slide">
        <div class="slide-bg" style="background-image: url('{{ asset('templates/assets/sliders/slider2.png') }}');"></div>

        <div class="slide-content">
           <h1>NUST <span>Sharing Network</span></h1>
            <p>
                A centralized platform connecting donors and students to reduce educational inequality.
                We facilitate the donation of laptops, books, and essential learning resources.
            </p>

            <a href="#categories" class="btn-hero">Explore Needs</a>
            <a href="#impact" class="btn-hero btn-hero-outline">Our Impact</a>
        </div>
    </div>

    <!-- SLIDE 3 -->
    <div class="slide">
        <div class="slide-bg" style="background-image: url('{{ asset('templates/assets/sliders/slider3.png') }}');"></div>

        <div class="slide-content">
           <h1>NUST <span>Sharing Network</span></h1>
            <p>
                A centralized platform connecting donors and students to reduce educational inequality.
                We facilitate the donation of laptops, books, and essential learning resources.
            </p>

             <a href="#categories" class="btn-hero">Explore Needs</a>
            <a href="#impact" class="btn-hero btn-hero-outline">Our Impact</a>
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
        slides.forEach(s => s.classList.remove("active"));
        dots.forEach(d => d.classList.remove("active"));

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

    setInterval(nextSlide, 5000);
</script>
