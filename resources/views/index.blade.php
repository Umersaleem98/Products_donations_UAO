<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NUST Gift Store - Empowering Students Through Generosity</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #3B71B8;
            --primary-dark: #2a5a9e;
            --primary-light: #e8f0fc;
            --secondary: #FABD4D;
            --secondary-dark: #e5a832;
            --dark: #1a1a2e;
            --light: #f8f9fa;
            --gray: #6c757d;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
            background: #fff;
        }

        /* Scroll Progress Bar */
        .scroll-progress {
            position: fixed;
            top: 0;
            left: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            z-index: 9999;
            width: 0%;
            transition: width 0.1s;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
        }
        ::-webkit-scrollbar-track {
            background: var(--light);
        }
        ::-webkit-scrollbar-thumb {
            background: var(--primary);
            border-radius: 5px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary-dark);
        }

        /* Navbar */
        .navbar {
            transition: all 0.4s ease;
            padding: 1rem 0;
            background: transparent;
        }

        .navbar.scrolled {
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(20px);
            box-shadow: 0 4px 30px rgba(0,0,0,0.1);
            padding: 0.5rem 0;
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.5rem;
            color: var(--primary) !important;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .navbar-brand i {
            color: var(--secondary);
            font-size: 1.8rem;
            animation: float 3s ease-in-out infinite;
        }

        .nav-link {
            font-weight: 500;
            color: var(--dark) !important;
            position: relative;
            margin: 0 0.5rem;
            transition: all 0.3s;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 3px;
            background: var(--secondary);
            border-radius: 2px;
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .nav-link:hover {
            color: var(--primary) !important;
        }

        .btn-donate-nav {
            background: var(--secondary);
            color: var(--dark) !important;
            font-weight: 600;
            padding: 0.5rem 1.5rem;
            border-radius: 50px;
            border: none;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(250, 189, 77, 0.4);
        }

        .btn-donate-nav:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(250, 189, 77, 0.6);
            background: var(--secondary-dark);
        }

        /* Hero Section */
        .hero {
            min-height: 100vh;
            background: linear-gradient(135deg, var(--primary) 0%, #1e3a5f 100%);
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            opacity: 0.5;
        }

        /* Floating Shapes */
        .shape {
            position: absolute;
            border-radius: 50%;
            background: rgba(255,255,255,0.05);
            animation: float 6s ease-in-out infinite;
        }

        .shape-1 {
            width: 300px;
            height: 300px;
            top: -100px;
            right: -100px;
            animation-delay: 0s;
        }

        .shape-2 {
            width: 200px;
            height: 200px;
            bottom: 10%;
            left: -50px;
            animation-delay: 2s;
        }

        .shape-3 {
            width: 150px;
            height: 150px;
            top: 40%;
            right: 20%;
            animation-delay: 4s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-30px) rotate(10deg); }
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(250, 189, 77, 0.2);
            border: 1px solid rgba(250, 189, 77, 0.4);
            color: var(--secondary);
            padding: 0.5rem 1.2rem;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 500;
            margin-bottom: 1.5rem;
            animation: fadeInDown 1s ease;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            color: #fff;
            line-height: 1.2;
            margin-bottom: 1.5rem;
            animation: fadeInUp 1s ease 0.2s both;
        }

        .hero-title span {
            color: var(--secondary);
            position: relative;
        }

        .hero-title span::after {
            content: '';
            position: absolute;
            bottom: 5px;
            left: 0;
            width: 100%;
            height: 8px;
            background: rgba(250, 189, 77, 0.3);
            border-radius: 4px;
            z-index: -1;
        }

        .hero-subtitle {
            font-size: 1.2rem;
            color: rgba(255,255,255,0.8);
            margin-bottom: 2rem;
            max-width: 500px;
            animation: fadeInUp 1s ease 0.4s both;
        }

        .hero-buttons {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            animation: fadeInUp 1s ease 0.6s both;
        }

        .btn-hero-primary {
            background: var(--secondary);
            color: var(--dark);
            font-weight: 600;
            padding: 1rem 2.5rem;
            border-radius: 50px;
            border: none;
            font-size: 1.1rem;
            transition: all 0.3s;
            box-shadow: 0 10px 30px rgba(250, 189, 77, 0.4);
        }

        .btn-hero-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(250, 189, 77, 0.6);
            background: var(--secondary-dark);
        }

        .btn-hero-outline {
            background: transparent;
            color: #fff;
            font-weight: 600;
            padding: 1rem 2.5rem;
            border-radius: 50px;
            border: 2px solid rgba(255,255,255,0.3);
            font-size: 1.1rem;
            transition: all 0.3s;
        }

        .btn-hero-outline:hover {
            background: rgba(255,255,255,0.1);
            border-color: #fff;
            transform: translateY(-3px);
        }

        /* Hero Stats */
        .hero-stats {
            position: absolute;
            bottom: 50px;
            left: 0;
            right: 0;
            z-index: 2;
        }

        .stat-card {
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 20px;
            padding: 1.5rem;
            text-align: center;
            color: #fff;
            transition: all 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-10px);
            background: rgba(255,255,255,0.15);
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--secondary);
        }

        .stat-label {
            font-size: 0.9rem;
            opacity: 0.8;
        }

        /* Floating Cards Animation */
        .floating-cards {
            position: relative;
            height: 500px;
        }

        .float-card {
            position: absolute;
            background: #fff;
            border-radius: 20px;
            padding: 1.5rem;
            box-shadow: 0 20px 60px rgba(0,0,0,0.2);
            animation: cardFloat 5s ease-in-out infinite;
        }

        .float-card-1 {
            top: 10%;
            right: 10%;
            width: 220px;
            animation-delay: 0s;
        }

        .float-card-2 {
            top: 40%;
            right: 30%;
            width: 200px;
            animation-delay: 1.5s;
        }

        .float-card-3 {
            top: 60%;
            right: 5%;
            width: 240px;
            animation-delay: 3s;
        }

        @keyframes cardFloat {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(2deg); }
        }

        .float-card-icon {
            width: 50px;
            height: 50px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .float-card-1 .float-card-icon { background: var(--primary-light); color: var(--primary); }
        .float-card-2 .float-card-icon { background: #fff3cd; color: var(--secondary-dark); }
        .float-card-3 .float-card-icon { background: #d4edda; color: #28a745; }

        /* Section Styles */
        .section-padding {
            padding: 100px 0;
        }

        .section-header {
            text-align: center;
            margin-bottom: 4rem;
        }

        .section-label {
            display: inline-block;
            background: var(--primary-light);
            color: var(--primary);
            padding: 0.4rem 1.2rem;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 1rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .section-title {
            font-size: 2.8rem;
            font-weight: 800;
            color: var(--dark);
            margin-bottom: 1rem;
        }

        .section-title span {
            color: var(--primary);
        }

        .section-subtitle {
            color: var(--gray);
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto;
        }

        /* How It Works */
        .how-it-works {
            background: linear-gradient(180deg, #fff 0%, var(--primary-light) 100%);
        }

        .step-card {
            background: #fff;
            border-radius: 24px;
            padding: 2.5rem;
            text-align: center;
            position: relative;
            transition: all 0.4s;
            border: 2px solid transparent;
            height: 100%;
        }

        .step-card:hover {
            transform: translateY(-15px);
            border-color: var(--primary);
            box-shadow: 0 25px 50px rgba(59, 113, 184, 0.15);
        }

        .step-number {
            width: 60px;
            height: 60px;
            background: var(--primary);
            color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0 auto 1.5rem;
            position: relative;
        }

        .step-number::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            border: 3px solid var(--secondary);
            top: -5px;
            right: -5px;
            z-index: -1;
        }

        .step-icon {
            width: 80px;
            height: 80px;
            background: var(--primary-light);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: var(--primary);
            margin: 0 auto 1.5rem;
            transition: all 0.3s;
        }

        .step-card:hover .step-icon {
            background: var(--primary);
            color: #fff;
            transform: rotateY(360deg);
        }

        .step-title {
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 0.8rem;
            color: var(--dark);
        }

        .step-desc {
            color: var(--gray);
            font-size: 0.95rem;
            line-height: 1.7;
        }

        /* Categories */
        .category-card {
            position: relative;
            border-radius: 24px;
            overflow: hidden;
            height: 300px;
            cursor: pointer;
            transition: all 0.4s;
        }

        .category-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 30px 60px rgba(0,0,0,0.2);
        }

        .category-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: all 0.5s;
        }

        .category-card:hover .category-img {
            transform: scale(1.1);
        }

        .category-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 2rem;
            background: linear-gradient(transparent, rgba(0,0,0,0.8));
            color: #fff;
            transition: all 0.3s;
        }

        .category-card:hover .category-overlay {
            padding-bottom: 2.5rem;
        }

        .category-icon {
            width: 50px;
            height: 50px;
            background: var(--secondary);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            color: var(--dark);
            margin-bottom: 1rem;
        }

        .category-title {
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 0.3rem;
        }

        .category-count {
            font-size: 0.9rem;
            opacity: 0.8;
        }

        /* Featured Products */
        .product-card {
            background: #fff;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0,0,0,0.08);
            transition: all 0.4s;
            height: 100%;
            border: 1px solid rgba(0,0,0,0.05);
        }

        .product-card:hover {
            transform: translateY(-15px);
            box-shadow: 0 25px 60px rgba(59, 113, 184, 0.2);
        }

        .product-img-wrapper {
            position: relative;
            height: 220px;
            overflow: hidden;
            background: var(--primary-light);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .product-img {
            width: 60%;
            height: auto;
            transition: all 0.5s;
        }

        .product-card:hover .product-img {
            transform: scale(1.1) rotate(5deg);
        }

        .product-badge {
            position: absolute;
            top: 15px;
            left: 15px;
            background: var(--secondary);
            color: var(--dark);
            padding: 0.3rem 1rem;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .product-body {
            padding: 1.5rem;
        }

        .product-category {
            color: var(--primary);
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 0.5rem;
        }

        .product-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 0.5rem;
        }

        .product-desc {
            color: var(--gray);
            font-size: 0.9rem;
            margin-bottom: 1rem;
            line-height: 1.6;
        }

        .product-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 1rem;
            border-top: 1px solid #eee;
        }

        .product-condition {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 0.85rem;
            color: #28a745;
            font-weight: 500;
        }

        .btn-request {
            background: var(--primary);
            color: #fff;
            border: none;
            padding: 0.5rem 1.2rem;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-request:hover {
            background: var(--primary-dark);
            transform: scale(1.05);
        }

        /* Impact Section */
        .impact-section {
            background: var(--primary);
            position: relative;
            overflow: hidden;
        }

        .impact-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 600px;
            height: 600px;
            background: rgba(250, 189, 77, 0.1);
            border-radius: 50%;
        }

        .impact-section::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -10%;
            width: 400px;
            height: 400px;
            background: rgba(255,255,255,0.05);
            border-radius: 50%;
        }

        .impact-content {
            position: relative;
            z-index: 2;
        }

        .impact-title {
            color: #fff;
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
        }

        .impact-title span {
            color: var(--secondary);
        }

        .impact-text {
            color: rgba(255,255,255,0.85);
            font-size: 1.1rem;
            line-height: 1.8;
            margin-bottom: 2rem;
        }

        .impact-stat-box {
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 20px;
            padding: 2rem;
            text-align: center;
            color: #fff;
            transition: all 0.3s;
        }

        .impact-stat-box:hover {
            transform: translateY(-10px);
            background: rgba(255,255,255,0.15);
        }

        .impact-number {
            font-size: 3rem;
            font-weight: 800;
            color: var(--secondary);
            line-height: 1;
        }

        .impact-label {
            margin-top: 0.5rem;
            font-size: 1rem;
            opacity: 0.9;
        }

        /* Testimonials */
        .testimonial-card {
            background: #fff;
            border-radius: 24px;
            padding: 2.5rem;
            box-shadow: 0 15px 40px rgba(0,0,0,0.08);
            position: relative;
            margin-top: 2rem;
            transition: all 0.3s;
        }

        .testimonial-card:hover {
            transform: translateY(-10px);
        }

        .testimonial-quote {
            position: absolute;
            top: -20px;
            left: 30px;
            width: 50px;
            height: 50px;
            background: var(--secondary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--dark);
            font-size: 1.2rem;
        }

        .testimonial-text {
            font-size: 1.05rem;
            color: var(--gray);
            line-height: 1.8;
            margin-bottom: 1.5rem;
            font-style: italic;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .author-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: var(--primary-light);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: var(--primary);
            font-size: 1.2rem;
        }

        .author-info h5 {
            font-size: 1rem;
            font-weight: 700;
            margin-bottom: 0.2rem;
            color: var(--dark);
        }

        .author-info p {
            font-size: 0.85rem;
            color: var(--gray);
            margin: 0;
        }

        /* CTA Section */
        .cta-section {
            background: linear-gradient(135deg, var(--dark) 0%, #16213e 100%);
            position: relative;
            overflow: hidden;
        }

        .cta-pattern {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .cta-content {
            position: relative;
            z-index: 2;
            text-align: center;
        }

        .cta-title {
            font-size: 3rem;
            font-weight: 800;
            color: #fff;
            margin-bottom: 1.5rem;
        }

        .cta-title span {
            color: var(--secondary);
        }

        .cta-text {
            color: rgba(255,255,255,0.8);
            font-size: 1.2rem;
            max-width: 600px;
            margin: 0 auto 2rem;
        }

        .btn-cta-primary {
            background: var(--secondary);
            color: var(--dark);
            font-weight: 700;
            padding: 1.2rem 3rem;
            border-radius: 50px;
            border: none;
            font-size: 1.1rem;
            transition: all 0.3s;
            box-shadow: 0 10px 30px rgba(250, 189, 77, 0.4);
            margin: 0.5rem;
        }

        .btn-cta-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(250, 189, 77, 0.6);
            background: var(--secondary-dark);
        }

        .btn-cta-outline {
            background: transparent;
            color: #fff;
            font-weight: 700;
            padding: 1.2rem 3rem;
            border-radius: 50px;
            border: 2px solid rgba(255,255,255,0.3);
            font-size: 1.1rem;
            transition: all 0.3s;
            margin: 0.5rem;
        }

        .btn-cta-outline:hover {
            background: rgba(255,255,255,0.1);
            border-color: #fff;
            transform: translateY(-3px);
        }

        /* Footer */
        .footer {
            background: var(--dark);
            color: #fff;
            padding: 80px 0 30px;
        }

        .footer-brand {
            font-size: 1.8rem;
            font-weight: 800;
            color: #fff;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 1.5rem;
        }

        .footer-brand i {
            color: var(--secondary);
        }

        .footer-desc {
            color: rgba(255,255,255,0.7);
            line-height: 1.8;
            margin-bottom: 2rem;
        }

        .footer-title {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: var(--secondary);
        }

        .footer-links {
            list-style: none;
            padding: 0;
        }

        .footer-links li {
            margin-bottom: 0.8rem;
        }

        .footer-links a {
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .footer-links a:hover {
            color: var(--secondary);
            padding-left: 5px;
        }

        .footer-social {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .social-icon {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: rgba(255,255,255,0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1.1rem;
            transition: all 0.3s;
            text-decoration: none;
        }

        .social-icon:hover {
            background: var(--secondary);
            color: var(--dark);
            transform: translateY(-5px);
        }

        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,0.1);
            margin-top: 3rem;
            padding-top: 2rem;
            text-align: center;
            color: rgba(255,255,255,0.5);
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-on-scroll {
            opacity: 0;
            transform: translateY(40px);
            transition: all 0.8s ease;
        }

        .animate-on-scroll.animated {
            opacity: 1;
            transform: translateY(0);
        }

        /* Pulse Animation for CTA */
        .pulse {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(250, 189, 77, 0.7); }
            70% { box-shadow: 0 0 0 20px rgba(250, 189, 77, 0); }
            100% { box-shadow: 0 0 0 0 rgba(250, 189, 77, 0); }
        }

        /* Wave Separator */
        .wave-separator {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            overflow: hidden;
            line-height: 0;
        }

        .wave-separator svg {
            position: relative;
            display: block;
            width: calc(100% + 1.3px);
            height: 80px;
        }

        /* Responsive */
        @media (max-width: 991px) {
            .hero-title { font-size: 2.5rem; }
            .section-title { font-size: 2rem; }
            .cta-title { font-size: 2rem; }
            .floating-cards { display: none; }
            .hero-stats { position: relative; bottom: auto; margin-top: 3rem; }
        }

        @media (max-width: 768px) {
            .hero-title { font-size: 2rem; }
            .hero-buttons { justify-content: center; }
            .section-padding { padding: 60px 0; }
        }

        /* Loading Spinner */
        .spinner-wrapper {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 99999;
            transition: opacity 0.5s;
        }

        .spinner-wrapper.hidden {
            opacity: 0;
            pointer-events: none;
        }

        .custom-spinner {
            width: 60px;
            height: 60px;
            border: 4px solid var(--primary-light);
            border-top-color: var(--primary);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Particle Canvas */
        #particles-canvas {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
        }
    </style>
</head>
<body>

    <!-- Loading Spinner -->
    <div class="spinner-wrapper" id="spinner">
        <div class="custom-spinner"></div>
    </div>

    <!-- Scroll Progress -->
    <div class="scroll-progress" id="scrollProgress"></div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top" id="navbar">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-gift"></i>
                NUST Gift Store
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#how-it-works">How It Works</a></li>
                    <li class="nav-item"><a class="nav-link" href="#categories">Categories</a></li>
                    <li class="nav-item"><a class="nav-link" href="#products">Products</a></li>
                    <li class="nav-item"><a class="nav-link" href="#impact">Impact</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item ms-lg-3">
                        <a href="#donate" class="btn btn-donate-nav">
                            <i class="fas fa-heart me-2"></i>Donate Now
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <canvas id="particles-canvas"></canvas>
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>
        
        <div class="container">
            <div class="row align-items-center min-vh-100 pt-5">
                <div class="col-lg-6 hero-content">
                    <div class="hero-badge">
                        <i class="fas fa-sparkles"></i>
                        Empowering NUST Students Since 2024
                    </div>
                    <h1 class="hero-title">
                        Give a Gift,<br>
                        Change a <span>Student's Life</span>
                    </h1>
                    <p class="hero-subtitle">
                        Join our community of donors and help NUST students access the gadgets, 
                        books, and tools they need to succeed in their academic journey.
                    </p>
                    <div class="hero-buttons">
                        <a href="#donate" class="btn btn-hero-primary pulse">
                            <i class="fas fa-hand-holding-heart me-2"></i>Donate a Product
                        </a>
                        <a href="#products" class="btn btn-hero-outline">
                            <i class="fas fa-search me-2"></i>Browse Products
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <div class="floating-cards">
                        <div class="float-card float-card-1">
                            <div class="float-card-icon">
                                <i class="fas fa-laptop"></i>
                            </div>
                            <h5>Laptop Donated</h5>
                            <p class="text-muted mb-0" style="font-size: 0.9rem;">Helped 50+ students</p>
                        </div>
                        <div class="float-card float-card-2">
                            <div class="float-card-icon">
                                <i class="fas fa-book"></i>
                            </div>
                            <h5>Books Shared</h5>
                            <p class="text-muted mb-0" style="font-size: 0.9rem;">200+ textbooks</p>
                        </div>
                        <div class="float-card float-card-3">
                            <div class="float-card-icon">
                                <i class="fas fa-calculator"></i>
                            </div>
                            <h5>Calculators</h5>
                            <p class="text-muted mb-0" style="font-size: 0.9rem;">Engineering tools</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Hero Stats -->
        <div class="hero-stats">
            <div class="container">
                <div class="row g-4">
                    <div class="col-6 col-md-3">
                        <div class="stat-card">
                            <div class="stat-number" data-count="500">0</div>
                            <div class="stat-label">Products Donated</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="stat-card">
                            <div class="stat-number" data-count="1200">0</div>
                            <div class="stat-label">Students Helped</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="stat-card">
                            <div class="stat-number" data-count="350">0</div>
                            <div class="stat-label">Active Donors</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="stat-card">
                            <div class="stat-number" data-count="15">0</div>
                            <div class="stat-label">Categories</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="wave-separator">
            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" fill="#ffffff"></path>
            </svg>
        </div>
    </section>

    <!-- How It Works -->
    <section class="section-padding how-it-works" id="how-it-works">
        <div class="container">
            <div class="section-header animate-on-scroll">
                <span class="section-label">Process</span>
                <h2 class="section-title">How It <span>Works</span></h2>
                <p class="section-subtitle">Simple steps to donate or receive products that can make a real difference in student life.</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4 animate-on-scroll">
                    <div class="step-card">
                        <div class="step-number">1</div>
                        <div class="step-icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <h4 class="step-title">Register & List</h4>
                        <p class="step-desc">Create your account as a donor or beneficiary. List the products you want to donate or browse available items.</p>
                    </div>
                </div>
                <div class="col-md-4 animate-on-scroll">
                    <div class="step-card">
                        <div class="step-number">2</div>
                        <div class="step-icon">
                            <i class="fas fa-handshake"></i>
                        </div>
                        <h4 class="step-title">Connect & Request</h4>
                        <p class="step-desc">Beneficiaries browse categories and send requests for products they need. Donors review and approve requests.</p>
                    </div>
                </div>
                <div class="col-md-4 animate-on-scroll">
                    <div class="step-card">
                        <div class="step-number">3</div>
                        <div class="step-icon">
                            <i class="fas fa-gift"></i>
                        </div>
                        <h4 class="step-title">Receive & Share</h4>
                        <p class="step-desc">Products are handed over to beneficiaries. Share your success story and inspire others to join the community.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories -->
    <section class="section-padding" id="categories" style="background: #fff;">
        <div class="container">
            <div class="section-header animate-on-scroll">
                <span class="section-label">Browse</span>
                <h2 class="section-title">Product <span>Categories</span></h2>
                <p class="section-subtitle">Explore all categories of study and student life essentials available for donation.</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4 col-lg-3 animate-on-scroll">
                    <div class="category-card">
                        <img src="https://images.unsplash.com/photo-1496181133206-80ce9b88a853?w=400&h=300&fit=crop" alt="Laptops" class="category-img">
                        <div class="category-overlay">
                            <div class="category-icon"><i class="fas fa-laptop"></i></div>
                            <h4 class="category-title">Laptops & Computers</h4>
                            <p class="category-count">45 Products Available</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-lg-3 animate-on-scroll">
                    <div class="category-card">
                        <img src="https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=400&h=300&fit=crop" alt="Books" class="category-img">
                        <div class="category-overlay">
                            <div class="category-icon"><i class="fas fa-book"></i></div>
                            <h4 class="category-title">Books & Textbooks</h4>
                            <p class="category-count">120 Products Available</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-lg-3 animate-on-scroll">
                    <div class="category-card">
                        <img src="https://images.unsplash.com/photo-1587829741301-dc798b83add3?w=400&h=300&fit=crop" alt="Electronics" class="category-img">
                        <div class="category-overlay">
                            <div class="category-icon"><i class="fas fa-plug"></i></div>
                            <h4 class="category-title">Electronics</h4>
                            <p class="category-count">35 Products Available</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-lg-3 animate-on-scroll">
                    <div class="category-card">
                        <img src="https://images.unsplash.com/photo-1516979187457-637abb4f9353?w=400&h=300&fit=crop" alt="Stationery" class="category-img">
                        <div class="category-overlay">
                            <div class="category-icon"><i class="fas fa-pen"></i></div>
                            <h4 class="category-title">Stationery & Supplies</h4>
                            <p class="category-count">80 Products Available</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-lg-3 animate-on-scroll">
                    <div class="category-card">
                        <img src="https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=400&h=300&fit=crop" alt="Calculators" class="category-img">
                        <div class="category-overlay">
                            <div class="category-icon"><i class="fas fa-calculator"></i></div>
                            <h4 class="category-title">Calculators</h4>
                            <p class="category-count">25 Products Available</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-lg-3 animate-on-scroll">
                    <div class="category-card">
                        <img src="https://images.unsplash.com/photo-1519389950473-47ba0277781c?w=400&h=300&fit=crop" alt="Lab Equipment" class="category-img">
                        <div class="category-overlay">
                            <div class="category-icon"><i class="fas fa-flask"></i></div>
                            <h4 class="category-title">Lab Equipment</h4>
                            <p class="category-count">15 Products Available</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-lg-3 animate-on-scroll">
                    <div class="category-card">
                        <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=400&h=300&fit=crop" alt="Audio" class="category-img">
                        <div class="category-overlay">
                            <div class="category-icon"><i class="fas fa-headphones"></i></div>
                            <h4 class="category-title">Audio & Headphones</h4>
                            <p class="category-count">30 Products Available</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-lg-3 animate-on-scroll">
                    <div class="category-card">
                        <img src="https://images.unsplash.com/photo-1434030216411-0b793f4b4173?w=400&h=300&fit=crop" alt="Accessories" class="category-img">
                        <div class="category-overlay">
                            <div class="category-icon"><i class="fas fa-backpack"></i></div>
                            <h4 class="category-title">Bags & Accessories</h4>
                            <p class="category-count">40 Products Available</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Products -->
    <section class="section-padding" id="products" style="background: linear-gradient(180deg, #fff 0%, var(--primary-light) 100%);">
        <div class="container">
            <div class="section-header animate-on-scroll">
                <span class="section-label">Available Now</span>
                <h2 class="section-title">Featured <span>Products</span></h2>
                <p class="section-subtitle">Browse recently donated products ready to be claimed by deserving students.</p>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-4 animate-on-scroll">
                    <div class="product-card">
                        <div class="product-img-wrapper">
                            <span class="product-badge">New</span>
                            <i class="fas fa-laptop product-img" style="font-size: 5rem; color: var(--primary);"></i>
                        </div>
                        <div class="product-body">
                            <div class="product-category">Laptops</div>
                            <h4 class="product-title">Dell Latitude 5490</h4>
                            <p class="product-desc">Intel Core i5, 8GB RAM, 256GB SSD. Perfect for programming and research work.</p>
                            <div class="product-footer">
                                <span class="product-condition"><i class="fas fa-check-circle"></i> Good Condition</span>
                                <button class="btn btn-request">Request</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 animate-on-scroll">
                    <div class="product-card">
                        <div class="product-img-wrapper">
                            <span class="product-badge">Popular</span>
                            <i class="fas fa-book product-img" style="font-size: 5rem; color: var(--primary);"></i>
                        </div>
                        <div class="product-body">
                            <div class="product-category">Textbooks</div>
                            <h4 class="product-title">Calculus - Early Transcendentals</h4>
                            <p class="product-desc">8th Edition by James Stewart. Essential for engineering mathematics courses.</p>
                            <div class="product-footer">
                                <span class="product-condition"><i class="fas fa-check-circle"></i> Like New</span>
                                <button class="btn btn-request">Request</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 animate-on-scroll">
                    <div class="product-card">
                        <div class="product-img-wrapper">
                            <i class="fas fa-calculator product-img" style="font-size: 5rem; color: var(--primary);"></i>
                        </div>
                        <div class="product-body">
                            <div class="product-category">Calculators</div>
                            <h4 class="product-title">Casio fx-991ES PLUS</h4>
                            <p class="product-desc">Scientific calculator with 417 functions. Approved for all NUST exams.</p>
                            <div class="product-footer">
                                <span class="product-condition"><i class="fas fa-check-circle"></i> Excellent</span>
                                <button class="btn btn-request">Request</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 animate-on-scroll">
                    <div class="product-card">
                        <div class="product-img-wrapper">
                            <i class="fas fa-headphones product-img" style="font-size: 5rem; color: var(--primary);"></i>
                        </div>
                        <div class="product-body">
                            <div class="product-category">Audio</div>
                            <h4 class="product-title">Sony WH-1000XM4</h4>
                            <p class="product-desc">Noise cancelling wireless headphones. Great for focused study sessions.</p>
                            <div class="product-footer">
                                <span class="product-condition"><i class="fas fa-check-circle"></i> Good Condition</span>
                                <button class="btn btn-request">Request</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 animate-on-scroll">
                    <div class="product-card">
                        <div class="product-img-wrapper">
                            <span class="product-badge">Urgent</span>
                            <i class="fas fa-tablet-alt product-img" style="font-size: 5rem; color: var(--primary);"></i>
                        </div>
                        <div class="product-body">
                            <div class="product-category">Tablets</div>
                            <h4 class="product-title">iPad Air (4th Gen)</h4>
                            <p class="product-desc">64GB WiFi. Ideal for digital note-taking and online classes.</p>
                            <div class="product-footer">
                                <span class="product-condition"><i class="fas fa-check-circle"></i> Very Good</span>
                                <button class="btn btn-request">Request</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 animate-on-scroll">
                    <div class="product-card">
                        <div class="product-img-wrapper">
                            <i class="fas fa-flask product-img" style="font-size: 5rem; color: var(--primary);"></i>
                        </div>
                        <div class="product-body">
                            <div class="product-category">Lab Equipment</div>
                            <h4 class="product-title">Digital Multimeter Kit</h4>
                            <p class="product-desc">Professional multimeter with probes and carrying case. For EE/CS labs.</p>
                            <div class="product-footer">
                                <span class="product-condition"><i class="fas fa-check-circle"></i> New</span>
                                <button class="btn btn-request">Request</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-5 animate-on-scroll">
                <a href="#" class="btn btn-donate-nav" style="padding: 1rem 2.5rem; font-size: 1.1rem;">
                    View All Products <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Impact Section -->
    <section class="section-padding impact-section" id="impact">
        <div class="container impact-content">
            <div class="row align-items-center">
                <div class="col-lg-6 animate-on-scroll">
                    <h2 class="impact-title">Making Real <span>Impact</span></h2>
                    <p class="impact-text">
                        Every donated product opens a door to opportunity. From laptops that enable online learning 
                        to textbooks that reduce financial burden, your generosity creates ripples of positive change 
                        across the NUST community. Join hundreds of donors who believe in the power of sharing.
                    </p>
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="#donate" class="btn btn-hero-primary">
                            <i class="fas fa-heart me-2"></i>Start Donating
                        </a>
                        <a href="#" class="btn btn-hero-outline">
                            <i class="fas fa-play-circle me-2"></i>Watch Stories
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row g-4">
                        <div class="col-6 animate-on-scroll">
                            <div class="impact-stat-box">
                                <div class="impact-number" data-count="95">0</div>
                                <div class="impact-label">% Satisfaction Rate</div>
                            </div>
                        </div>
                        <div class="col-6 animate-on-scroll">
                            <div class="impact-stat-box">
                                <div class="impact-number" data-count="48">0</div>
                                <div class="impact-label">Hours Avg. Response</div>
                            </div>
                        </div>
                        <div class="col-6 animate-on-scroll">
                            <div class="impact-stat-box">
                                <div class="impact-number" data-count="100">0</div>
                                <div class="impact-label">% Free Service</div>
                            </div>
                        </div>
                        <div class="col-6 animate-on-scroll">
                            <div class="impact-stat-box">
                                <div class="impact-number" data-count="50">0</div>
                                <div class="impact-label">+ Departments Covered</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="section-padding" style="background: #fff;">
        <div class="container">
            <div class="section-header animate-on-scroll">
                <span class="section-label">Stories</span>
                <h2 class="section-title">What People <span>Say</span></h2>
                <p class="section-subtitle">Hear from our donors and beneficiaries about their experience with NUST Gift Store.</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4 animate-on-scroll">
                    <div class="testimonial-card">
                        <div class="testimonial-quote"><i class="fas fa-quote-left"></i></div>
                        <p class="testimonial-text">
                            "I received a laptop through this platform that completely changed my academic life. 
                            I can now attend online classes and complete my programming assignments without any issues. 
                            Forever grateful to the donor!"
                        </p>
                        <div class="testimonial-author">
                            <div class="author-avatar">AK</div>
                            <div class="author-info">
                                <h5>Ahmed Khan</h5>
                                <p>SEECS, 3rd Year</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 animate-on-scroll">
                    <div class="testimonial-card">
                        <div class="testimonial-quote"><i class="fas fa-quote-left"></i></div>
                        <p class="testimonial-text">
                            "Donating my old engineering textbooks was the best decision. Knowing that a junior 
                            student is using them to excel in their courses gives me immense satisfaction. 
                            This platform makes giving so easy and meaningful."
                        </p>
                        <div class="testimonial-author">
                            <div class="author-avatar">SR</div>
                            <div class="author-info">
                                <h5>Sara Rizvi</h5>
                                <p>Alumni, Class of 2023</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 animate-on-scroll">
                    <div class="testimonial-card">
                        <div class="testimonial-quote"><i class="fas fa-quote-left"></i></div>
                        <p class="testimonial-text">
                            "As a faculty member, I've seen firsthand how this initiative bridges the resource gap. 
                            Students who couldn't afford lab equipment are now fully participating in practical sessions. 
                            Truly a remarkable community effort."
                        </p>
                        <div class="testimonial-author">
                            <div class="author-avatar">DA</div>
                            <div class="author-info">
                                <h5>Dr. Ali</h5>
                                <p>Faculty, SMME</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="section-padding cta-section" id="donate">
        <div class="cta-pattern"></div>
        <div class="container">
            <div class="cta-content animate-on-scroll">
                <h2 class="cta-title">Ready to Make a <span>Difference?</span></h2>
                <p class="cta-text">
                    Whether you have a gadget to donate or you're a student in need, 
                    NUST Gift Store is here to connect generosity with opportunity.
                </p>
                <div class="d-flex justify-content-center flex-wrap">
                    <a href="#" class="btn btn-cta-primary pulse">
                        <i class="fas fa-hand-holding-heart me-2"></i>Donate a Product
                    </a>
                    <a href="#" class="btn btn-cta-outline">
                        <i class="fas fa-search me-2"></i>Browse & Request
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-4">
                    <div class="footer-brand">
                        <i class="fas fa-gift"></i>
                        NUST Gift Store
                    </div>
                    <p class="footer-desc">
                        A community-driven platform connecting donors with NUST students in need. 
                        Together, we can ensure every student has access to the tools they need to succeed.
                    </p>
                    <div class="footer-social">
                        <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4">
                    <h4 class="footer-title">Quick Links</h4>
                    <ul class="footer-links">
                        <li><a href="#home"><i class="fas fa-chevron-right"></i> Home</a></li>
                        <li><a href="#how-it-works"><i class="fas fa-chevron-right"></i> How It Works</a></li>
                        <li><a href="#categories"><i class="fas fa-chevron-right"></i> Categories</a></li>
                        <li><a href="#products"><i class="fas fa-chevron-right"></i> Products</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-4">
                    <h4 class="footer-title">For Donors</h4>
                    <ul class="footer-links">
                        <li><a href="#"><i class="fas fa-chevron-right"></i> Donate Item</a></li>
                        <li><a href="#"><i class="fas fa-chevron-right"></i> Track Donation</a></li>
                        <li><a href="#"><i class="fas fa-chevron-right"></i> Tax Benefits</a></li>
                        <li><a href="#"><i class="fas fa-chevron-right"></i> Success Stories</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-4">
                    <h4 class="footer-title">For Students</h4>
                    <ul class="footer-links">
                        <li><a href="#"><i class="fas fa-chevron-right"></i> Browse Products</a></li>
                        <li><a href="#"><i class="fas fa-chevron-right"></i> Send Request</a></li>
                        <li><a href="#"><i class="fas fa-chevron-right"></i> My Requests</a></li>
                        <li><a href="#"><i class="fas fa-chevron-right"></i> Guidelines</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-4">
                    <h4 class="footer-title">Contact</h4>
                    <ul class="footer-links">
                        <li><a href="#"><i class="fas fa-envelope"></i> info@nustgiftstore.edu</a></li>
                        <li><a href="#"><i class="fas fa-phone"></i> +92-51-9085-1234</a></li>
                        <li><a href="#"><i class="fas fa-map-marker-alt"></i> NUST H-12, Islamabad</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p class="mb-0">© {{ date('Y') }} NUST Gift Store. All rights reserved. Made with <i class="fas fa-heart text-danger"></i> for NUST Students.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Loading Spinner
        window.addEventListener('load', () => {
            setTimeout(() => {
                document.getElementById('spinner').classList.add('hidden');
            }, 500);
        });

        // Navbar Scroll Effect
        window.addEventListener('scroll', () => {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }

            // Scroll Progress
            const scrollProgress = document.getElementById('scrollProgress');
            const scrollTop = window.scrollY;
            const docHeight = document.documentElement.scrollHeight - window.innerHeight;
            const scrollPercent = (scrollTop / docHeight) * 100;
            scrollProgress.style.width = scrollPercent + '%';
        });

        // Smooth Scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });

        // Intersection Observer for Animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animated');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.animate-on-scroll').forEach(el => {
            observer.observe(el);
        });

        // Counter Animation
        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const counters = entry.target.querySelectorAll('[data-count]');
                    counters.forEach(counter => {
                        const target = parseInt(counter.getAttribute('data-count'));
                        const duration = 2000;
                        const step = target / (duration / 16);
                        let current = 0;
                        
                        const updateCounter = () => {
                            current += step;
                            if (current < target) {
                                counter.textContent = Math.floor(current);
                                requestAnimationFrame(updateCounter);
                            } else {
                                counter.textContent = target + (target > 100 ? '+' : '');
                            }
                        };
                        updateCounter();
                    });
                    counterObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });

        document.querySelectorAll('.hero-stats, .impact-section').forEach(section => {
            counterObserver.observe(section);
        });

        // Particle Animation
        const canvas = document.getElementById('particles-canvas');
        const ctx = canvas.getContext('2d');
        let particles = [];

        function resizeCanvas() {
            canvas.width = canvas.offsetWidth;
            canvas.height = canvas.offsetHeight;
        }
        resizeCanvas();
        window.addEventListener('resize', resizeCanvas);

        class Particle {
            constructor() {
                this.x = Math.random() * canvas.width;
                this.y = Math.random() * canvas.height;
                this.size = Math.random() * 3 + 1;
                this.speedX = Math.random() * 1 - 0.5;
                this.speedY = Math.random() * 1 - 0.5;
                this.opacity = Math.random() * 0.5 + 0.1;
            }
            update() {
                this.x += this.speedX;
                this.y += this.speedY;
                if (this.x > canvas.width) this.x = 0;
                if (this.x < 0) this.x = canvas.width;
                if (this.y > canvas.height) this.y = 0;
                if (this.y < 0) this.y = canvas.height;
            }
            draw() {
                ctx.fillStyle = `rgba(255, 255, 255, ${this.opacity})`;
                ctx.beginPath();
                ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
                ctx.fill();
            }
        }

        function initParticles() {
            particles = [];
            for (let i = 0; i < 50; i++) {
                particles.push(new Particle());
            }
        }
        initParticles();

        function animateParticles() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            particles.forEach(p => {
                p.update();
                p.draw();
            });
            requestAnimationFrame(animateParticles);
        }
        animateParticles();

        // Parallax Effect for Hero Shapes
        window.addEventListener('scroll', () => {
            const scrolled = window.scrollY;
            document.querySelectorAll('.shape').forEach((shape, index) => {
                const speed = 0.5 + (index * 0.2);
                shape.style.transform = `translateY(${scrolled * speed}px)`;
            });
        });

        // Button Click Feedback
        document.querySelectorAll('.btn-request').forEach(btn => {
            btn.addEventListener('click', function() {
                this.innerHTML = '<i class="fas fa-check me-1"></i> Requested';
                this.style.background = '#28a745';
                setTimeout(() => {
                    this.innerHTML = 'Request';
                    this.style.background = '';
                }, 2000);
            });
        });
    </script>
</body>
</html>