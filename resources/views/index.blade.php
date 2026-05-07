<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NUST Gift Store - Donate Gadgets, Change Lives</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #3B71B8;
            --secondary-color: #FABD4D;
            --dark-color: #1a1a2e;
            --light-color: #f8f9fa;
            --white: #ffffff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        ::-webkit-scrollbar-thumb {
            background: var(--primary-color);
            border-radius: 5px;
        }

        /* Navbar */
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            padding: 15px 0;
        }

        .navbar.scrolled {
            padding: 10px 0;
            box-shadow: 0 5px 30px rgba(0,0,0,0.15);
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.8rem;
            color: var(--primary-color) !important;
        }

        .navbar-brand i {
            color: var(--secondary-color);
            margin-right: 10px;
        }

        .nav-link {
            font-weight: 500;
            color: var(--dark-color) !important;
            margin: 0 15px;
            position: relative;
            transition: all 0.3s ease;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 3px;
            background: var(--secondary-color);
            transition: width 0.3s ease;
            border-radius: 2px;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .nav-link:hover {
            color: var(--primary-color) !important;
        }

        .btn-donate-nav {
            background: var(--secondary-color);
            color: var(--dark-color) !important;
            padding: 10px 25px;
            border-radius: 50px;
            font-weight: 600;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-donate-nav:hover {
            background: var(--primary-color);
            color: var(--white) !important;
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(59, 113, 184, 0.4);
        }

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
            background: rgba(255,255,255,0.5);
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
            background: rgba(255,255,255,0.2);
            backdrop-filter: blur(10px);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-size: 1.5rem;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid rgba(255,255,255,0.3);
        }

        .slider-arrow:hover {
            background: var(--secondary-color);
            color: var(--dark-color);
            border-color: var(--secondary-color);
        }

        /* Stats Section */
        .stats-section {
            background: var(--primary-color);
            padding: 60px 0;
            position: relative;
            overflow: hidden;
        }

        .stats-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 400px;
            height: 400px;
            background: rgba(250, 189, 77, 0.1);
            border-radius: 50%;
        }

        .stat-item {
            text-align: center;
            color: var(--white);
            padding: 20px;
        }

        .stat-item i {
            font-size: 3rem;
            color: var(--secondary-color);
            margin-bottom: 15px;
            display: block;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 5px;
        }

        .stat-label {
            font-size: 1rem;
            opacity: 0.9;
        }

        /* Section Headers */
        .section-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .section-header h2 {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--dark-color);
            margin-bottom: 15px;
            position: relative;
            display: inline-block;
        }

        .section-header h2::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: var(--secondary-color);
            border-radius: 2px;
        }

        .section-header p {
            color: #666;
            font-size: 1.1rem;
            max-width: 600px;
            margin: 20px auto 0;
        }

        /* About Section */
        .about-section {
            padding: 100px 0;
            background: var(--light-color);
        }

        .about-img {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(0,0,0,0.15);
        }

        .about-img img {
            width: 100%;
            height: auto;
            transition: transform 0.5s ease;
        }

        .about-img:hover img {
            transform: scale(1.05);
        }

        .about-img .experience-badge {
            position: absolute;
            bottom: 30px;
            right: -20px;
            background: var(--secondary-color);
            color: var(--dark-color);
            padding: 20px 30px;
            border-radius: 15px;
            font-weight: 700;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .about-content h3 {
            font-size: 2rem;
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 20px;
        }

        .about-content p {
            color: #666;
            line-height: 1.8;
            margin-bottom: 20px;
        }

        .feature-list {
            list-style: none;
            padding: 0;
        }

        .feature-list li {
            padding: 10px 0;
            color: var(--dark-color);
            font-weight: 500;
        }

        .feature-list li i {
            color: var(--secondary-color);
            margin-right: 10px;
            font-size: 1.2rem;
        }

        /* Services Section */
        .services-section {
            padding: 100px 0;
            background: var(--white);
        }

        .service-card {
            background: var(--white);
            border-radius: 20px;
            padding: 40px 30px;
            text-align: center;
            box-shadow: 0 10px 40px rgba(0,0,0,0.08);
            transition: all 0.4s ease;
            border: 1px solid rgba(0,0,0,0.05);
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .service-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: var(--primary-color);
            transform: scaleX(0);
            transition: transform 0.4s ease;
        }

        .service-card:hover::before {
            transform: scaleX(1);
        }

        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 60px rgba(59, 113, 184, 0.2);
        }

        .service-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary-color), #5a8fd4);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            font-size: 2rem;
            color: var(--white);
            transition: all 0.4s ease;
            position: relative;
        }

        .service-card:hover .service-icon {
            background: var(--secondary-color);
            color: var(--dark-color);
            transform: rotateY(360deg);
        }

        .service-card h4 {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 15px;
        }

        .service-card p {
            color: #666;
            line-height: 1.7;
            font-size: 0.95rem;
        }

        /* Products Categories */
        .categories-section {
            padding: 100px 0;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        }

        .category-card {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            height: 350px;
            cursor: pointer;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .category-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .category-card:hover img {
            transform: scale(1.1);
        }

        .category-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 50%;
            background: linear-gradient(to top, rgba(59, 113, 184, 0.9), transparent);
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 30px;
            transition: height 0.4s ease;
        }

        .category-card:hover .category-overlay {
            height: 100%;
            background: linear-gradient(to top, rgba(59, 113, 184, 0.95), rgba(59, 113, 184, 0.7));
        }

        .category-overlay h4 {
            color: var(--white);
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .category-overlay p {
            color: rgba(255,255,255,0.9);
            font-size: 0.9rem;
            margin-bottom: 15px;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.4s ease;
        }

        .category-card:hover .category-overlay p {
            opacity: 1;
            transform: translateY(0);
        }

        .category-btn {
            display: inline-block;
            padding: 8px 25px;
            background: var(--secondary-color);
            color: var(--dark-color);
            text-decoration: none;
            border-radius: 25px;
            font-weight: 600;
            font-size: 0.9rem;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.4s ease;
        }

        .category-card:hover .category-btn {
            opacity: 1;
            transform: translateY(0);
        }

        /* How It Works */
        .how-it-works {
            padding: 100px 0;
            background: var(--white);
        }

        .step-card {
            text-align: center;
            padding: 30px;
            position: relative;
        }

        .step-number {
            width: 60px;
            height: 60px;
            background: var(--primary-color);
            color: var(--white);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: 800;
            margin: 0 auto 20px;
            position: relative;
            z-index: 2;
        }

        .step-card::after {
            content: '';
            position: absolute;
            top: 60px;
            left: 50%;
            width: 100%;
            height: 2px;
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            z-index: 1;
        }

        .col-lg-4:last-child .step-card::after {
            display: none;
        }

        .step-icon {
            font-size: 2.5rem;
            color: var(--secondary-color);
            margin-bottom: 15px;
        }

        .step-card h4 {
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 10px;
        }

        .step-card p {
            color: #666;
            font-size: 0.95rem;
        }

        /* Testimonials */
        .testimonials-section {
            padding: 100px 0;
            background: var(--primary-color);
            position: relative;
            overflow: hidden;
        }

        .testimonials-section::before {
            content: '\201C';
            position: absolute;
            top: -50px;
            left: 50px;
            font-size: 300px;
            color: rgba(255,255,255,0.05);
            font-family: serif;
            line-height: 1;
        }

        .testimonials-section .section-header h2,
        .testimonials-section .section-header p {
            color: var(--white);
        }

        .testimonial-card {
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px;
            color: var(--white);
            border: 1px solid rgba(255,255,255,0.2);
        }

        .testimonial-card .stars {
            color: var(--secondary-color);
            margin-bottom: 20px;
            font-size: 1.2rem;
        }

        .testimonial-card p {
            font-size: 1.1rem;
            line-height: 1.8;
            margin-bottom: 25px;
            font-style: italic;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .testimonial-author img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            border: 3px solid var(--secondary-color);
        }

        .testimonial-author h5 {
            margin: 0;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .testimonial-author span {
            font-size: 0.9rem;
            opacity: 0.8;
        }

        /* CTA Section */
        .cta-section {
            padding: 100px 0;
            background: linear-gradient(135deg, var(--primary-color), #2a5a9e);
            text-align: center;
            color: var(--white);
            position: relative;
            overflow: hidden;
        }

        .cta-section::before,
        .cta-section::after {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: rgba(250, 189, 77, 0.1);
        }

        .cta-section::before {
            top: -100px;
            left: -100px;
        }

        .cta-section::after {
            bottom: -100px;
            right: -100px;
        }

        .cta-section h2 {
            font-size: 2.8rem;
            font-weight: 800;
            margin-bottom: 20px;
        }

        .cta-section p {
            font-size: 1.2rem;
            margin-bottom: 40px;
            opacity: 0.9;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .btn-cta {
            display: inline-block;
            padding: 18px 50px;
            background: var(--secondary-color);
            color: var(--dark-color);
            text-decoration: none;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1.2rem;
            transition: all 0.3s ease;
            border: 2px solid var(--secondary-color);
        }

        .btn-cta:hover {
            background: transparent;
            color: var(--white);
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.3);
        }

        /* Footer */
        .footer {
            background: var(--dark-color);
            color: var(--white);
            padding: 80px 0 0;
        }

        .footer-widget h4 {
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 25px;
            color: var(--secondary-color);
        }

        .footer-widget p {
            color: rgba(255,255,255,0.7);
            line-height: 1.8;
            margin-bottom: 20px;
        }

        .footer-links {
            list-style: none;
            padding: 0;
        }

        .footer-links li {
            margin-bottom: 12px;
        }

        .footer-links a {
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .footer-links a:hover {
            color: var(--secondary-color);
            padding-left: 5px;
        }

        .footer-links a i {
            font-size: 0.8rem;
            color: var(--secondary-color);
        }

        .social-links {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .social-links a {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: rgba(255,255,255,0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 1.1rem;
        }

        .social-links a:hover {
            background: var(--secondary-color);
            color: var(--dark-color);
            transform: translateY(-3px);
        }

        .footer-contact li {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            margin-bottom: 20px;
            color: rgba(255,255,255,0.7);
        }

        .footer-contact li i {
            color: var(--secondary-color);
            font-size: 1.2rem;
            margin-top: 5px;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,0.1);
            margin-top: 60px;
            padding: 25px 0;
            text-align: center;
            color: rgba(255,255,255,0.5);
        }

        .footer-bottom a {
            color: var(--secondary-color);
            text-decoration: none;
        }

        /* Back to Top */
        .back-to-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
            background: var(--secondary-color);
            color: var(--dark-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            cursor: pointer;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 1000;
            border: none;
            box-shadow: 0 5px 20px rgba(0,0,0,0.2);
        }

        .back-to-top.show {
            opacity: 1;
            visibility: visible;
        }

        .back-to-top:hover {
            background: var(--primary-color);
            color: var(--white);
            transform: translateY(-3px);
        }

        /* Animations */
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }

        .floating {
            animation: float 3s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .pulse {
            animation: pulse 2s ease-in-out infinite;
        }

        /* Responsive */
        @media (max-width: 991px) {
            .slide-content h1 {
                font-size: 2.5rem;
            }
            
            .step-card::after {
                display: none;
            }
            
            .about-img .experience-badge {
                right: 20px;
            }
        }

        @media (max-width: 768px) {
            .slide-content h1 {
                font-size: 2rem;
            }
            
            .slide-content p {
                font-size: 1rem;
            }
            
            .section-header h2 {
                font-size: 2rem;
            }
            
            .cta-section h2 {
                font-size: 2rem;
            }
        }

        /* Loading Animation */
        .loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--white);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            transition: opacity 0.5s ease;
        }

        .loader.hidden {
            opacity: 0;
            pointer-events: none;
        }

        .loader-spinner {
            width: 60px;
            height: 60px;
            border: 5px solid var(--light-color);
            border-top-color: var(--primary-color);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>
</head>
<body>

    <!-- Loader -->
    <div class="loader" id="loader">
        <div class="loader-spinner">
              <img src="{{ asset('admins/assets/images/logos/logo.png') }}" alt="NUST Gift Store" class="navbar-brand-img" style="width: 80px; height: 80px">
        </div>
    </div>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg fixed-top" id="navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                 <img src="{{ asset('admins/assets/images/logos/logo.png') }}" alt="NUST Gift Store" class="navbar-brand-img" style="width: 80px; height: 80px"> <span style="color: var(--secondary-color);">NUST</span> Gift Store
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="#categories">Categories</a></li>
                    <li class="nav-item"><a class="nav-link" href="#how-it-works">How It Works</a></li>
                    <li class="nav-item"><a class="nav-link" href="#testimonials">Stories</a></li>
                    <li class="nav-item"><a class="btn btn-donate-nav" href="#donate">Donate Now</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Slider -->
    <section class="hero-slider" id="home">
        <div class="slide active">
            <div class="slide-bg" style="background-image: url('https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?w=1920');"></div>
            <div class="slide-content" data-aos="fade-up">
                <h1>Donate <span>Gadgets</span>, Change Lives</h1>
                <p>Join NUST Gift Store in bridging the digital divide. Your unused laptops, books, and mobile devices can empower students and transform futures.</p>
                <div>
                    <a href="#donate" class="btn-hero">Start Donating</a>
                    <a href="#how-it-works" class="btn-hero btn-hero-outline">Learn More</a>
                </div>
            </div>
        </div>
        
        <div class="slide">
            <div class="slide-bg" style="background-image: url('https://images.unsplash.com/photo-1509062522246-3755977927d7?w=1920');"></div>
            <div class="slide-content">
                <h1>Education <span>For All</span></h1>
                <p>Every book donated opens a door to knowledge. Every laptop shared creates an opportunity. Be the reason someone achieves their dreams.</p>
                <div>
                    <a href="#categories" class="btn-hero">Browse Categories</a>
                    <a href="#about" class="btn-hero btn-hero-outline">Our Mission</a>
                </div>
            </div>
        </div>
        
        <div class="slide">
            <div class="slide-bg" style="background-image: url('https://images.unsplash.com/photo-1521791136064-7986c2920216?w=1920');"></div>
            <div class="slide-content">
                <h1>Connect <span>Communities</span></h1>
                <p>From donors to beneficiaries, we build bridges of hope. Your generosity creates ripples of positive change across NUST and beyond.</p>
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

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="0">
                    <div class="stat-item">
                        <i class="fas fa-laptop"></i>
                        <div class="stat-number" data-count="1250">0</div>
                        <div class="stat-label">Gadgets Donated</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="stat-item">
                        <i class="fas fa-users"></i>
                        <div class="stat-number" data-count="850">0</div>
                        <div class="stat-label">Beneficiaries Helped</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="stat-item">
                        <i class="fas fa-book"></i>
                        <div class="stat-number" data-count="3200">0</div>
                        <div class="stat-label">Books Distributed</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="stat-item">
                        <i class="fas fa-heart"></i>
                        <div class="stat-number" data-count="500">0</div>
                        <div class="stat-label">Happy Donors</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about-section" id="about">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6" data-aos="fade-right">
                    <div class="about-img">
                        <img src="https://images.unsplash.com/photo-1531482615713-2afd69097998?w=800" alt="About NUST Gift Store">
                        <div class="experience-badge">
                            <div style="font-size: 2rem; line-height: 1;">5+</div>
                            <div style="font-size: 0.9rem;">Years of Service</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="about-content">
                        <div class="section-header text-start mb-4">
                            <h2 style="display: block; text-align: left;">Who Are We?</h2>
                            <p style="text-align: left; margin-left: 0;">Empowering through generosity</p>
                        </div>
                        <h3>Making Technology Accessible for Everyone</h3>
                        <p>NUST Gift Store is a pioneering donation platform dedicated to bridging the digital divide within our academic community. We connect generous donors with deserving beneficiaries, ensuring that essential gadgets and educational resources reach those who need them most.</p>
                        <p>Our mission is simple yet powerful: to ensure no student is left behind due to lack of access to technology. From laptops for programming courses to books for research, every donation makes a tangible difference.</p>
                        <ul class="feature-list">
                            <li><i class="fas fa-check-circle"></i> Secure and transparent donation process</li>
                            <li><i class="fas fa-check-circle"></i> Verified beneficiaries and donors</li>
                            <li><i class="fas fa-check-circle"></i> Wide range of acceptable items</li>
                            <li><i class="fas fa-check-circle"></i> Community-driven impact tracking</li>
                        </ul>
                        <a href="#services" class="btn-hero mt-4">Explore Our Services</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services-section" id="services">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2>Our Services</h2>
                <p>Comprehensive solutions for donors and beneficiaries</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="0">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-laptop"></i>
                        </div>
                        <h4>Gadget Donation</h4>
                        <p>Donate laptops, tablets, smartphones, and other electronic devices. We ensure secure data wiping and proper refurbishment before delivery to beneficiaries.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-book-open"></i>
                        </div>
                        <h4>Book Exchange</h4>
                        <p>Share textbooks, reference materials, and novels. Our book donation service helps students access educational resources without financial burden.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <h4>Mobile Device Program</h4>
                        <p>Donate smartphones and mobile accessories. Help students stay connected with online classes, research resources, and academic communities.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-tools"></i>
                        </div>
                        <h4>Repair & Refurbish</h4>
                        <p>Our technical team repairs and refurbishes donated items to ensure beneficiaries receive fully functional, quality devices ready for immediate use.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-hand-holding-heart"></i>
                        </div>
                        <h4>Matching Service</h4>
                        <p>We intelligently match donations with beneficiaries based on specific needs, academic requirements, and urgency levels for maximum impact.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h4>Impact Tracking</h4>
                        <p>Track the journey of your donation from drop-off to delivery. Receive updates on how your contribution is making a difference in someone's life.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="categories-section" id="categories">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2>Product Categories</h2>
                <p>Browse items you can donate or request</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="0">
                    <div class="category-card">
                        <img src="https://images.unsplash.com/photo-1496181133206-80ce9b88a853?w=600" alt="Laptops">
                        <div class="category-overlay">
                            <h4>Laptops & Computers</h4>
                            <p>Notebooks, desktops, monitors, and accessories for academic and professional use.</p>
                            <a href="#" class="category-btn">View Items</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="100">
                    <div class="category-card">
                        <img src="https://images.unsplash.com/photo-1512820790803-83ca734da794?w=600" alt="Books">
                        <div class="category-overlay">
                            <h4>Books & Journals</h4>
                            <p>Textbooks, reference books, research papers, and educational magazines.</p>
                            <a href="#" class="category-btn">View Items</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="200">
                    <div class="category-card">
                        <img src="https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=600" alt="Mobile">
                        <div class="category-overlay">
                            <h4>Mobile Devices</h4>
                            <p>Smartphones, tablets, power banks, chargers, and mobile accessories.</p>
                            <a href="#" class="category-btn">View Items</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="300">
                    <div class="category-card">
                        <img src="https://images.unsplash.com/photo-1550009158-9ebf69173e03?w=600" alt="Accessories">
                        <div class="category-overlay">
                            <h4>Accessories</h4>
                            <p>Headphones, keyboards, mice, webcams, bags, and other peripherals.</p>
                            <a href="#" class="category-btn">View Items</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="400">
                    <div class="category-card">
                        <img src="https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=600" alt="Stationery">
                        <div class="category-overlay">
                            <h4>Stationery & Supplies</h4>
                            <p>Calculators, scientific instruments, art supplies, and writing materials.</p>
                            <a href="#" class="category-btn">View Items</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="500">
                    <div class="category-card">
                        <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=600" alt="Software">
                        <div class="category-overlay">
                            <h4>Software & Licenses</h4>
                            <p>Educational software, OS licenses, antivirus, and productivity tools.</p>
                            <a href="#" class="category-btn">View Items</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="how-it-works" id="how-it-works">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2>How It Works</h2>
                <p>Simple steps to make a difference</p>
            </div>
            <div class="row">
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="0">
                    <div class="step-card">
                        <div class="step-number">1</div>
                        <div class="step-icon"><i class="fas fa-user-plus"></i></div>
                        <h4>Register</h4>
                        <p>Create your account as a donor or beneficiary. Complete your profile with necessary details and verification.</p>
                    </div>
                </div>
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="step-card">
                        <div class="step-number">2</div>
                        <div class="step-icon"><i class="fas fa-hand-holding-usd"></i></div>
                        <h4>Donate or Request</h4>
                        <p>List items you wish to donate or browse available items. Specify condition, specifications, and urgency level.</p>
                    </div>
                </div>
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="400">
                    <div class="step-card">
                        <div class="step-number">3</div>
                        <div class="step-icon"><i class="fas fa-people-carry"></i></div>
                        <h4>Connect & Deliver</h4>
                        <p>We match and facilitate the exchange. Track your donation journey and receive confirmation of delivery.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="testimonials-section" id="testimonials">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2>Success Stories</h2>
                <p>Hear from our community members</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="0">
                    <div class="testimonial-card">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p>"NUST Gift Store helped me get a laptop for my final year project. I couldn't afford one, and this platform connected me with a generous donor. Forever grateful!"</p>
                        <div class="testimonial-author">
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100" alt="Student">
                            <div>
                                <h5>Ahmed Khan</h5>
                                <span>Computer Science Student</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="testimonial-card">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p>"Donating my old books through this platform was seamless. Knowing they helped multiple students with their studies gives me immense satisfaction."</p>
                        <div class="testimonial-author">
                            <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=100" alt="Donor">
                            <div>
                                <h5>Dr. Sarah Ahmad</h5>
                                <span>Faculty Member & Donor</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="testimonial-card">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p>"The mobile phone I received helped me attend online classes during the pandemic. This initiative truly changes lives. Highly recommended!"</p>
                        <div class="testimonial-author">
                            <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=100" alt="Student">
                            <div>
                                <h5>Fatima Ali</h5>
                                <span>Engineering Student</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section" id="donate">
        <div class="container" data-aos="zoom-in">
            <h2>Ready to Make a Difference?</h2>
            <p>Join hundreds of donors and beneficiaries in creating a more equitable academic environment. Your contribution, no matter how small, creates lasting impact.</p>
            <a href="#" class="btn-cta pulse">Donate Now</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="footer-widget">
                        <h4><i class="fas fa-gift me-2"></i>NUST Gift Store</h4>
                        <p>Empowering education through technology. We bridge the gap between those who have and those who need, creating a stronger academic community.</p>
                        <div class="social-links">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <div class="footer-widget">
                        <h4>Quick Links</h4>
                        <ul class="footer-links">
                            <li><a href="#home"><i class="fas fa-chevron-right"></i> Home</a></li>
                            <li><a href="#about"><i class="fas fa-chevron-right"></i> About Us</a></li>
                            <li><a href="#services"><i class="fas fa-chevron-right"></i> Services</a></li>
                            <li><a href="#categories"><i class="fas fa-chevron-right"></i> Categories</a></li>
                            <li><a href="#how-it-works"><i class="fas fa-chevron-right"></i> How It Works</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <div class="footer-widget">
                        <h4>Categories</h4>
                        <ul class="footer-links">
                            <li><a href="#"><i class="fas fa-chevron-right"></i> Laptops</a></li>
                            <li><a href="#"><i class="fas fa-chevron-right"></i> Books</a></li>
                            <li><a href="#"><i class="fas fa-chevron-right"></i> Mobiles</a></li>
                            <li><a href="#"><i class="fas fa-chevron-right"></i> Accessories</a></li>
                            <li><a href="#"><i class="fas fa-chevron-right"></i> Software</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="footer-widget">
                        <h4>Contact Us</h4>
                        <ul class="footer-contact" style="list-style: none; padding: 0;">
                            <li>
                                <i class="fas fa-map-marker-alt"></i>
                                <span>NUST Main Campus, H-12, Islamabad, Pakistan</span>
                            </li>
                            <li>
                                <i class="fas fa-phone"></i>
                                <span>+92 51 9085 1234</span>
                            </li>
                            <li>
                                <i class="fas fa-envelope"></i>
                                <span>info@nustgiftstore.edu.pk</span>
                            </li>
                            <li>
                                <i class="fas fa-clock"></i>
                                <span>Mon - Fri: 9:00 AM - 5:00 PM</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2026 NUST Gift Store. All Rights Reserved. Designed with <i class="fas fa-heart" style="color: #FABD4D;"></i> for the NUST Community</p>
            </div>
        </div>
    </footer>

    <!-- Back to Top -->
    <button class="back-to-top" id="backToTop">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <script>
        $(document).ready(function() {
            // Remove loader
            setTimeout(function() {
                $('#loader').addClass('hidden');
            }, 1000);

            // Initialize AOS Animation Library
            AOS.init({
                duration: 1000,
                once: true,
                offset: 100,
                easing: 'ease-out-cubic'
            });

            // Navbar scroll effect
            $(window).scroll(function() {
                if ($(this).scrollTop() > 50) {
                    $('#navbar').addClass('scrolled');
                } else {
                    $('#navbar').removeClass('scrolled');
                }

                // Back to top button
                if ($(this).scrollTop() > 300) {
                    $('#backToTop').addClass('show');
                } else {
                    $('#backToTop').removeClass('show');
                }
            });

            // Back to top functionality
            $('#backToTop').click(function() {
                $('html, body').animate({scrollTop: 0}, 800);
            });

            // Smooth scrolling for navigation links
            $('a[href^="#"]').on('click', function(e) {
                e.preventDefault();
                var target = $(this.getAttribute('href'));
                if (target.length) {
                    $('html, body').animate({
                        scrollTop: target.offset().top - 70
                    }, 800);
                }
            });

            // Hero Slider
            let currentSlide = 0;
            const slides = $('.slide');
            const dots = $('.slider-dot');
            const totalSlides = slides.length;

            function showSlide(index) {
                slides.removeClass('active');
                dots.removeClass('active');
                slides.eq(index).addClass('active');
                dots.eq(index).addClass('active');
                
                // Reset and trigger AOS animation for slide content
                slides.eq(index).find('[data-aos]').removeClass('aos-animate');
                setTimeout(function() {
                    slides.eq(index).find('[data-aos]').addClass('aos-animate');
                }, 100);
            }

            function nextSlide() {
                currentSlide = (currentSlide + 1) % totalSlides;
                showSlide(currentSlide);
            }

            function prevSlide() {
                currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
                showSlide(currentSlide);
            }

            // Auto slide
            let slideInterval = setInterval(nextSlide, 5000);

            // Manual controls
            $('#nextSlide').click(function() {
                clearInterval(slideInterval);
                nextSlide();
                slideInterval = setInterval(nextSlide, 5000);
            });

            $('#prevSlide').click(function() {
                clearInterval(slideInterval);
                prevSlide();
                slideInterval = setInterval(nextSlide, 5000);
            });

            $('.slider-dot').click(function() {
                clearInterval(slideInterval);
                currentSlide = $(this).data('slide');
                showSlide(currentSlide);
                slideInterval = setInterval(nextSlide, 5000);
            });

            // Counter Animation
            function animateCounter($element) {
                var countTo = $element.attr('data-count');
                $({countNum: $element.text()}).animate({
                    countNum: countTo
                }, {
                    duration: 2000,
                    easing: 'swing',
                    step: function() {
                        $element.text(Math.floor(this.countNum));
                    },
                    complete: function() {
                        $element.text(this.countNum);
                    }
                });
            }

            // Trigger counters when in viewport
            var countersTriggered = false;
            $(window).scroll(function() {
                var statsSection = $('.stats-section');
                if (statsSection.length) {
                    var sectionTop = statsSection.offset().top - $(window).height() + 100;
                    if ($(this).scrollTop() > sectionTop && !countersTriggered) {
                        $('.stat-number').each(function() {
                            animateCounter($(this));
                        });
                        countersTriggered = true;
                    }
                }
            });

            // Parallax effect for hero slides
            $(window).scroll(function() {
                var scrolled = $(this).scrollTop();
                $('.slide-bg').css('transform', 'translateY(' + (scrolled * 0.5) + 'px)');
            });

            // Add hover effect to service cards
            $('.service-card').hover(
                function() {
                    $(this).find('.service-icon').addClass('floating');
                },
                function() {
                    $(this).find('.service-icon').removeClass('floating');
                }
            );
        });
    </script>
</body>
</html>