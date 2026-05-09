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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

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
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
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
            color: rgba(255, 255, 255, 0.9);
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
            color: rgba(255, 255, 255, 0.05);
            font-family: serif;
            line-height: 1;
        }

        .testimonials-section .section-header h2,
        .testimonials-section .section-header p {
            color: var(--white);
        }

        .testimonial-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px;
            color: var(--white);
            border: 1px solid rgba(255, 255, 255, 0.2);
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
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
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
            color: rgba(255, 255, 255, 0.7);
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
            color: rgba(255, 255, 255, 0.7);
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
            background: rgba(255, 255, 255, 0.1);
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
            color: rgba(255, 255, 255, 0.7);
        }

        .footer-contact li i {
            color: var(--secondary-color);
            font-size: 1.2rem;
            margin-top: 5px;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            margin-top: 60px;
            padding: 25px 0;
            text-align: center;
            color: rgba(255, 255, 255, 0.5);
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
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
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

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .floating {
            animation: float 3s ease-in-out infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }
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


    </style>
</head>
