<style>
     /* Hero Slider */
        .hero-slider {
            position: relative;
            height: 100vh;
            min-height: 600px;
            overflow: hidden;
        }

        .slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 1s ease-in-out;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .slide.active {
            opacity: 1;
        }

        .slide-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            filter: brightness(0.4);
        }

        .slide-content {
            position: relative;
            z-index: 2;
            text-align: center;
            color: var(--white);
            max-width: 800px;
            padding: 0 20px;
        }

        .slide-content h1 {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .slide-content h1 span {
            color: var(--secondary-color);
        }

        .slide-content p {
            font-size: 1.2rem;
            margin-bottom: 30px;
            line-height: 1.8;
        }

        .btn-hero {
            display: inline-block;
            padding: 15px 40px;
            background: var(--secondary-color);
            color: var(--dark-color);
            text-decoration: none;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            margin: 0 10px;
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

        /* Slider Controls */
        .slider-controls {
            position: absolute;
            bottom: 50px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 10;
            display: flex;
            gap: 15px;
        }

        .slider-dot {
            width: 15px;
            height: 15px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.5);
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .slider-dot.active {
            background: var(--secondary-color);
            transform: scale(1.3);
            border-color: var(--white);
        }

        .slider-arrows {
            position: absolute;
            top: 50%;
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
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-size: 1.5rem;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .slider-arrow:hover {
            background: var(--secondary-color);
            color: var(--dark-color);
            border-color: var(--secondary-color);
        }
</style>


<!-- Hero Slider -->
    <section class="hero-slider" id="home">
        <div class="slide active">
            <div class="slide-bg"
                style="background-image: url('https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?w=1920');">
            </div>
            <div class="slide-content" data-aos="fade-up">
                <h1>Donate <span>Gadgets</span>, Change Lives</h1>
                <p>Join NUST Gift Store in bridging the digital divide. Your unused laptops, books, and mobile devices
                    can empower students and transform futures.</p>
                <div>
                    <a href="#donate" class="btn-hero">Start Donating</a>
                    <a href="#how-it-works" class="btn-hero btn-hero-outline">Learn More</a>
                </div>
            </div>
        </div>

        <div class="slide">
            <div class="slide-bg"
                style="background-image: url('https://images.unsplash.com/photo-1509062522246-3755977927d7?w=1920');">
            </div>
            <div class="slide-content">
                <h1>Education <span>For All</span></h1>
                <p>Every book donated opens a door to knowledge. Every laptop shared creates an opportunity. Be the
                    reason someone achieves their dreams.</p>
                <div>
                    <a href="#categories" class="btn-hero">Browse Categories</a>
                    <a href="#about" class="btn-hero btn-hero-outline">Our Mission</a>
                </div>
            </div>
        </div>

        <div class="slide">
            <div class="slide-bg"
                style="background-image: url('https://images.unsplash.com/photo-1521791136064-7986c2920216?w=1920');">
            </div>
            <div class="slide-content">
                <h1>Connect <span>Communities</span></h1>
                <p>From donors to beneficiaries, we build bridges of hope. Your generosity creates ripples of positive
                    change across NUST and beyond.</p>
                <div>
                    <a href="#services" class="btn-hero">Our Services</a>
                    <a href="#testimonials" class="btn-hero btn-hero-outline">Success Stories</a>
                </div>
            </div>
        </div>

        <div class="slider-arrows">
            <div class="slider-arrow" id="prevSlide"><i class="fas fa-chevron-left"></i></div>
            <div class="slider-arrow" id="nextSlide"><i class="fas fa-chevron-right"></i></div>
        </div>

        <div class="slider-controls">
            <div class="slider-dot active" data-slide="0"></div>
            <div class="slider-dot" data-slide="1"></div>
            <div class="slider-dot" data-slide="2"></div>
        </div>
    </section>