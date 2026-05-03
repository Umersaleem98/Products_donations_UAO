<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>NUST Gift Store – Give. Receive. Empower.</title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet"/>
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;800&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet"/>

  <style>
    :root {
      --primary: #00608C;
      --primary-dark: #004a6b;
      --primary-light: #007ab0;
      --secondary: #FAAF19;
      --secondary-dark: #d9940e;
      --white: #ffffff;
      --light: #f0f7fb;
      --text: #1a2e3b;
      --muted: #6c8a9a;
    }

    * { margin: 0; padding: 0; box-sizing: border-box; }

    body {
      font-family: 'DM Sans', sans-serif;
      color: var(--text);
      overflow-x: hidden;
      background: #fff;
    }

    h1, h2, h3, h4 { font-family: 'Playfair Display', serif; }

    /* ── Scrollbar ── */
    ::-webkit-scrollbar { width: 6px; }
    ::-webkit-scrollbar-track { background: var(--light); }
    ::-webkit-scrollbar-thumb { background: var(--primary); border-radius: 3px; }

    /* ══════════════════════════════════════
       NAVBAR
    ══════════════════════════════════════ */
    .navbar {
      background: rgba(0, 96, 140, 0.97);
      backdrop-filter: blur(14px);
      -webkit-backdrop-filter: blur(14px);
      padding: 14px 0;
      position: fixed;
      width: 100%;
      top: 0;
      z-index: 1000;
      transition: box-shadow .3s;
      border-bottom: 2px solid rgba(250,175,25,.25);
    }
    .navbar.scrolled { box-shadow: 0 4px 30px rgba(0,0,0,.25); }

    .navbar-brand {
      display: flex;
      align-items: center;
      gap: 12px;
      text-decoration: none;
    }
    .brand-icon {
      width: 44px; height: 44px;
      background: var(--secondary);
      border-radius: 12px;
      display: flex; align-items: center; justify-content: center;
      font-size: 1.4rem;
      animation: pulse-glow 3s infinite;
    }
    @keyframes pulse-glow {
      0%,100% { box-shadow: 0 0 0 0 rgba(250,175,25,.4); }
      50%      { box-shadow: 0 0 0 10px rgba(250,175,25,0); }
    }
    .brand-text { line-height: 1.1; }
    .brand-text span:first-child {
      display: block;
      font-family: 'Playfair Display', serif;
      font-size: 1.25rem;
      font-weight: 800;
      color: #fff;
      letter-spacing: .5px;
    }
    .brand-text span:last-child {
      font-size: .72rem;
      color: var(--secondary);
      letter-spacing: 2.5px;
      text-transform: uppercase;
    }

    .navbar-nav .nav-link {
      color: rgba(255,255,255,.85) !important;
      font-weight: 500;
      font-size: .93rem;
      padding: 8px 14px !important;
      border-radius: 8px;
      transition: all .25s;
      letter-spacing: .3px;
    }
    .navbar-nav .nav-link:hover,
    .navbar-nav .nav-link.active {
      color: #fff !important;
      background: rgba(250,175,25,.18);
    }

    .btn-nav-donor {
      background: var(--secondary);
      color: var(--text) !important;
      font-weight: 700;
      border-radius: 10px;
      padding: 8px 20px !important;
      transition: all .25s;
    }
    .btn-nav-donor:hover {
      background: var(--secondary-dark);
      transform: translateY(-1px);
      box-shadow: 0 6px 18px rgba(250,175,25,.4);
    }

    /* ══════════════════════════════════════
       HERO SLIDER
    ══════════════════════════════════════ */
    #heroSlider { margin-top: 70px; }

    .hero-slide {
      min-height: 92vh;
      position: relative;
      display: flex;
      align-items: center;
      overflow: hidden;
    }

    .slide-bg {
      position: absolute; inset: 0;
      background-size: cover;
      background-position: center;
      transform: scale(1.08);
      transition: transform 6s ease;
    }
    .carousel-item.active .slide-bg { transform: scale(1); }

    .slide-overlay {
      position: absolute; inset: 0;
      background: linear-gradient(
        135deg,
        rgba(0,96,140,.88) 0%,
        rgba(0,74,107,.7) 50%,
        rgba(0,96,140,.4) 100%
      );
    }

    .hero-content { position: relative; z-index: 2; }

    .hero-tag {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: rgba(250,175,25,.18);
      border: 1px solid rgba(250,175,25,.45);
      color: var(--secondary);
      font-size: .82rem;
      font-weight: 600;
      letter-spacing: 2px;
      text-transform: uppercase;
      padding: 7px 16px;
      border-radius: 30px;
      margin-bottom: 20px;
      animation: fadeInDown .7s ease both;
    }

    .hero-title {
      font-size: clamp(2.4rem, 5.5vw, 4.2rem);
      color: #fff;
      line-height: 1.12;
      margin-bottom: 22px;
      animation: fadeInUp .8s .2s ease both;
    }
    .hero-title em { color: var(--secondary); font-style: normal; }

    .hero-desc {
      font-size: 1.1rem;
      color: rgba(255,255,255,.85);
      max-width: 560px;
      line-height: 1.75;
      margin-bottom: 36px;
      animation: fadeInUp .8s .35s ease both;
    }

    .hero-btns { animation: fadeInUp .8s .5s ease both; }

    .btn-hero-primary {
      background: var(--secondary);
      color: var(--text);
      font-weight: 700;
      font-size: 1rem;
      padding: 14px 32px;
      border-radius: 12px;
      border: none;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      transition: all .3s;
      box-shadow: 0 8px 25px rgba(250,175,25,.4);
    }
    .btn-hero-primary:hover {
      background: var(--secondary-dark);
      transform: translateY(-3px);
      box-shadow: 0 14px 35px rgba(250,175,25,.5);
      color: var(--text);
    }

    .btn-hero-outline {
      background: transparent;
      color: #fff;
      font-weight: 600;
      font-size: 1rem;
      padding: 13px 32px;
      border-radius: 12px;
      border: 2px solid rgba(255,255,255,.55);
      display: inline-flex;
      align-items: center;
      gap: 8px;
      transition: all .3s;
    }
    .btn-hero-outline:hover {
      background: rgba(255,255,255,.12);
      border-color: #fff;
      color: #fff;
      transform: translateY(-3px);
    }

    /* Stats strip */
    .hero-stats {
      display: flex;
      gap: 36px;
      flex-wrap: wrap;
      margin-top: 48px;
      animation: fadeInUp .8s .65s ease both;
    }
    .hero-stat-item { text-align: center; }
    .hero-stat-num {
      font-family: 'Playfair Display', serif;
      font-size: 2.1rem;
      font-weight: 800;
      color: var(--secondary);
      line-height: 1;
    }
    .hero-stat-lbl {
      font-size: .78rem;
      color: rgba(255,255,255,.7);
      letter-spacing: 1.5px;
      text-transform: uppercase;
      margin-top: 4px;
    }

    /* Floating card on slide */
    .hero-float-card {
      background: rgba(255,255,255,.1);
      backdrop-filter: blur(20px);
      border: 1px solid rgba(255,255,255,.25);
      border-radius: 20px;
      padding: 28px;
      position: relative;
      z-index: 2;
      animation: float 5s ease-in-out infinite, fadeInRight .9s .4s ease both;
    }
    @keyframes float {
      0%,100% { transform: translateY(0); }
      50%      { transform: translateY(-12px); }
    }
    @keyframes fadeInDown { from { opacity:0; transform: translateY(-20px); } to { opacity:1; transform: translateY(0); } }
    @keyframes fadeInUp   { from { opacity:0; transform: translateY(28px); } to { opacity:1; transform: translateY(0); } }
    @keyframes fadeInRight{ from { opacity:0; transform: translateX(40px); } to { opacity:1; transform: translateX(0); } }

    .float-card-title {
      font-family: 'Playfair Display', serif;
      font-size: 1.15rem;
      color: #fff;
      margin-bottom: 16px;
    }
    .float-item {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 10px 0;
      border-bottom: 1px solid rgba(255,255,255,.12);
    }
    .float-item:last-child { border-bottom: none; }
    .float-item-icon {
      width: 38px; height: 38px;
      background: rgba(250,175,25,.2);
      border-radius: 10px;
      display: flex; align-items: center; justify-content: center;
      color: var(--secondary);
      font-size: 1rem;
      flex-shrink: 0;
    }
    .float-item-text { color: rgba(255,255,255,.9); font-size: .88rem; line-height: 1.35; }
    .float-item-text strong { color: #fff; display: block; font-size: .92rem; }

    /* Carousel controls */
    .carousel-control-prev, .carousel-control-next {
      width: 50px; height: 50px;
      background: rgba(255,255,255,.15);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255,255,255,.25);
      border-radius: 50%;
      top: 50%;
      transform: translateY(-50%);
      opacity: 1;
      transition: all .3s;
    }
    .carousel-control-prev { left: 20px; }
    .carousel-control-next { right: 20px; }
    .carousel-control-prev:hover,
    .carousel-control-next:hover {
      background: var(--secondary);
      border-color: var(--secondary);
    }

    .carousel-indicators [data-bs-target] {
      width: 10px; height: 10px;
      border-radius: 50%;
      background: rgba(255,255,255,.5);
      border: none;
      transition: all .3s;
    }
    .carousel-indicators .active {
      background: var(--secondary);
      width: 28px;
      border-radius: 5px;
    }

    /* ══════════════════════════════════════
       WAVE DIVIDER
    ══════════════════════════════════════ */
    .wave-top { margin-top: -2px; line-height: 0; }
    .wave-top svg { display: block; }

    /* ══════════════════════════════════════
       ABOUT US
    ══════════════════════════════════════ */
    #about { background: var(--light); padding: 100px 0; }

    .section-label {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      font-size: .78rem;
      font-weight: 700;
      letter-spacing: 2.5px;
      text-transform: uppercase;
      color: var(--primary);
      background: rgba(0,96,140,.1);
      padding: 6px 16px;
      border-radius: 20px;
      margin-bottom: 16px;
    }
    .section-label::before {
      content: '';
      display: inline-block;
      width: 6px; height: 6px;
      background: var(--secondary);
      border-radius: 50%;
    }

    .section-title {
      font-size: clamp(1.9rem, 3.5vw, 2.9rem);
      color: var(--text);
      line-height: 1.2;
      margin-bottom: 16px;
    }
    .section-title em { color: var(--primary); font-style: normal; }

    .about-desc {
      color: var(--muted);
      font-size: 1.05rem;
      line-height: 1.8;
      margin-bottom: 28px;
    }

    .about-image-wrap {
      position: relative;
      border-radius: 24px;
      overflow: hidden;
    }
    .about-image-wrap img {
      width: 100%;
      border-radius: 24px;
      box-shadow: 0 24px 70px rgba(0,96,140,.22);
      transition: transform .5s;
    }
    .about-image-wrap:hover img { transform: scale(1.03); }

    .about-badge {
      position: absolute;
      bottom: -20px; left: -20px;
      background: var(--secondary);
      color: var(--text);
      border-radius: 18px;
      padding: 18px 22px;
      text-align: center;
      box-shadow: 0 10px 30px rgba(250,175,25,.4);
    }
    .about-badge-num {
      font-family: 'Playfair Display', serif;
      font-size: 2.2rem;
      font-weight: 800;
      line-height: 1;
    }
    .about-badge-lbl { font-size: .78rem; font-weight: 600; letter-spacing: 1px; }

    .about-feature {
      display: flex;
      align-items: flex-start;
      gap: 16px;
      padding: 18px;
      background: #fff;
      border-radius: 16px;
      border: 1px solid rgba(0,96,140,.08);
      margin-bottom: 14px;
      transition: all .3s;
    }
    .about-feature:hover {
      transform: translateX(6px);
      box-shadow: 0 8px 30px rgba(0,96,140,.1);
      border-color: rgba(0,96,140,.2);
    }
    .af-icon {
      width: 46px; height: 46px;
      background: linear-gradient(135deg, var(--primary), var(--primary-light));
      border-radius: 12px;
      display: flex; align-items: center; justify-content: center;
      color: #fff;
      font-size: 1.2rem;
      flex-shrink: 0;
    }
    .af-title { font-weight: 700; color: var(--text); margin-bottom: 3px; }
    .af-desc  { font-size: .88rem; color: var(--muted); line-height: 1.55; }

    /* ══════════════════════════════════════
       CATEGORIES
    ══════════════════════════════════════ */
    #categories { background: #fff; padding: 100px 0; }

    .categories-header { text-align: center; margin-bottom: 58px; }

    .cat-search {
      background: var(--light);
      border-radius: 14px;
      padding: 10px 10px 10px 20px;
      display: flex;
      align-items: center;
      gap: 10px;
      max-width: 480px;
      margin: 28px auto 0;
      border: 2px solid transparent;
      transition: all .3s;
    }
    .cat-search:focus-within {
      border-color: var(--primary);
      background: #fff;
      box-shadow: 0 4px 20px rgba(0,96,140,.12);
    }
    .cat-search input {
      border: none;
      background: transparent;
      outline: none;
      flex: 1;
      font-size: .95rem;
      color: var(--text);
    }
    .cat-search-btn {
      background: var(--primary);
      color: #fff;
      border: none;
      padding: 10px 20px;
      border-radius: 10px;
      font-weight: 600;
      font-size: .9rem;
      cursor: pointer;
      transition: all .3s;
    }
    .cat-search-btn:hover { background: var(--primary-dark); }

    /* Filter tabs */
    .filter-tabs {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      justify-content: center;
      margin-bottom: 40px;
    }
    .filter-tab {
      padding: 8px 22px;
      border-radius: 30px;
      border: 2px solid var(--primary);
      color: var(--primary);
      font-weight: 600;
      font-size: .88rem;
      cursor: pointer;
      transition: all .25s;
      background: transparent;
    }
    .filter-tab:hover, .filter-tab.active {
      background: var(--primary);
      color: #fff;
      transform: translateY(-2px);
    }

    /* Category Cards */
    .cat-card {
      position: relative;
      border-radius: 20px;
      overflow: hidden;
      cursor: pointer;
      transition: transform .4s, box-shadow .4s;
      height: 220px;
    }
    .cat-card:hover { transform: translateY(-8px); box-shadow: 0 24px 60px rgba(0,96,140,.22); }

    .cat-card-bg {
      position: absolute; inset: 0;
      display: flex; align-items: center; justify-content: center;
      font-size: 5rem;
      transition: transform .4s;
    }
    .cat-card:hover .cat-card-bg { transform: scale(1.12); }

    .cat-card-overlay {
      position: absolute; inset: 0;
      transition: opacity .4s;
    }
    .cat-card-info {
      position: absolute;
      bottom: 0; left: 0; right: 0;
      padding: 20px;
      background: linear-gradient(0deg, rgba(0,0,0,.65) 0%, transparent 100%);
      color: #fff;
    }
    .cat-card-name {
      font-family: 'Playfair Display', serif;
      font-size: 1.15rem;
      font-weight: 700;
      margin-bottom: 2px;
    }
    .cat-card-count { font-size: .82rem; opacity: .8; }
    .cat-card-badge {
      position: absolute;
      top: 14px; right: 14px;
      background: var(--secondary);
      color: var(--text);
      font-size: .72rem;
      font-weight: 700;
      padding: 4px 12px;
      border-radius: 20px;
    }

    /* Product Cards */
    .product-card {
      border-radius: 20px;
      overflow: hidden;
      background: #fff;
      border: 1px solid rgba(0,96,140,.08);
      transition: all .35s;
      position: relative;
    }
    .product-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 20px 55px rgba(0,96,140,.15);
      border-color: rgba(0,96,140,.2);
    }

    .product-img-wrap {
      height: 200px;
      background: var(--light);
      display: flex; align-items: center; justify-content: center;
      font-size: 4.5rem;
      position: relative;
      overflow: hidden;
      transition: background .3s;
    }
    .product-card:hover .product-img-wrap { background: rgba(0,96,140,.06); }

    .product-condition {
      position: absolute;
      top: 12px; left: 12px;
      font-size: .72rem;
      font-weight: 700;
      padding: 4px 12px;
      border-radius: 20px;
      background: var(--primary);
      color: #fff;
    }

    .product-wishlist {
      position: absolute;
      top: 12px; right: 12px;
      width: 34px; height: 34px;
      background: #fff;
      border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
      font-size: .95rem;
      color: var(--muted);
      cursor: pointer;
      transition: all .25s;
      box-shadow: 0 2px 10px rgba(0,0,0,.1);
    }
    .product-wishlist:hover { color: #e74c3c; transform: scale(1.15); }

    .product-body { padding: 18px; }
    .product-cat {
      font-size: .75rem;
      color: var(--primary);
      font-weight: 600;
      letter-spacing: 1px;
      text-transform: uppercase;
      margin-bottom: 6px;
    }
    .product-name {
      font-family: 'Playfair Display', serif;
      font-size: 1.05rem;
      font-weight: 600;
      margin-bottom: 8px;
      color: var(--text);
    }
    .product-meta {
      display: flex;
      align-items: center;
      gap: 12px;
      font-size: .82rem;
      color: var(--muted);
      margin-bottom: 14px;
    }
    .product-footer {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 12px 18px;
      background: var(--light);
      border-top: 1px solid rgba(0,96,140,.06);
    }
    .btn-apply {
      background: var(--primary);
      color: #fff;
      font-weight: 700;
      font-size: .85rem;
      padding: 8px 20px;
      border-radius: 10px;
      border: none;
      cursor: pointer;
      transition: all .25s;
    }
    .btn-apply:hover {
      background: var(--primary-dark);
      transform: translateY(-1px);
      box-shadow: 0 6px 18px rgba(0,96,140,.3);
    }
    .btn-donate-post {
      background: var(--secondary);
      color: var(--text);
      font-weight: 700;
      font-size: .85rem;
      padding: 8px 20px;
      border-radius: 10px;
      border: none;
      cursor: pointer;
      transition: all .25s;
    }
    .btn-donate-post:hover {
      background: var(--secondary-dark);
      transform: translateY(-1px);
    }
    .donor-tag {
      font-size: .78rem;
      color: var(--muted);
    }
    .donor-tag strong { color: var(--primary); }

    /* ══════════════════════════════════════
       HOW IT WORKS
    ══════════════════════════════════════ */
    #how { background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 100%); padding: 100px 0; }
    #how .section-label { color: var(--secondary); background: rgba(250,175,25,.18); }
    #how .section-title { color: #fff; }
    #how .section-title em { color: var(--secondary); }

    .step-card {
      background: rgba(255,255,255,.08);
      border: 1px solid rgba(255,255,255,.15);
      border-radius: 20px;
      padding: 32px 24px;
      text-align: center;
      transition: all .35s;
      height: 100%;
    }
    .step-card:hover {
      background: rgba(255,255,255,.15);
      transform: translateY(-8px);
      box-shadow: 0 20px 50px rgba(0,0,0,.2);
    }
    .step-num {
      width: 56px; height: 56px;
      background: var(--secondary);
      color: var(--text);
      border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
      font-family: 'Playfair Display', serif;
      font-size: 1.5rem;
      font-weight: 800;
      margin: 0 auto 18px;
    }
    .step-icon { font-size: 2.2rem; color: var(--secondary); margin-bottom: 14px; }
    .step-title { font-size: 1.1rem; color: #fff; margin-bottom: 10px; }
    .step-desc { font-size: .9rem; color: rgba(255,255,255,.72); line-height: 1.65; }

    .step-connector {
      display: flex;
      align-items: center;
      justify-content: center;
      padding-top: 60px;
    }
    .step-connector i { font-size: 1.5rem; color: rgba(255,255,255,.3); }

    /* ══════════════════════════════════════
       TESTIMONIALS
    ══════════════════════════════════════ */
    #testimonials { background: var(--light); padding: 100px 0; }
    .testimonials-header { text-align: center; margin-bottom: 58px; }

    .testimonial-card {
      background: #fff;
      border-radius: 20px;
      padding: 32px;
      border: 1px solid rgba(0,96,140,.08);
      position: relative;
      transition: all .35s;
      height: 100%;
    }
    .testimonial-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 18px 50px rgba(0,96,140,.12);
    }
    .quote-icon {
      font-size: 3.5rem;
      color: rgba(0,96,140,.1);
      line-height: 1;
      margin-bottom: 10px;
    }
    .testimonial-text {
      color: var(--muted);
      font-size: .95rem;
      line-height: 1.8;
      margin-bottom: 22px;
    }
    .testimonial-author {
      display: flex;
      align-items: center;
      gap: 12px;
    }
    .author-avatar {
      width: 46px; height: 46px;
      background: linear-gradient(135deg, var(--primary), var(--primary-light));
      border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
      color: #fff;
      font-family: 'Playfair Display', serif;
      font-size: 1.15rem;
      font-weight: 700;
      flex-shrink: 0;
    }
    .author-name { font-weight: 700; color: var(--text); margin-bottom: 2px; }
    .author-role { font-size: .8rem; color: var(--muted); }
    .star-rating { color: var(--secondary); font-size: .9rem; margin-bottom: 12px; }

    /* ══════════════════════════════════════
       NEWSLETTER / CTA
    ══════════════════════════════════════ */
    #cta {
      background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
      padding: 80px 0;
      position: relative;
      overflow: hidden;
    }
    #cta::before {
      content: '';
      position: absolute;
      width: 500px; height: 500px;
      background: rgba(250,175,25,.08);
      border-radius: 50%;
      top: -200px; right: -150px;
    }
    #cta::after {
      content: '';
      position: absolute;
      width: 350px; height: 350px;
      background: rgba(255,255,255,.05);
      border-radius: 50%;
      bottom: -120px; left: -80px;
    }
    .cta-inner { position: relative; z-index: 1; text-align: center; }
    .cta-title { color: #fff; margin-bottom: 12px; font-size: clamp(1.8rem, 3vw, 2.6rem); }
    .cta-sub { color: rgba(255,255,255,.8); font-size: 1.05rem; margin-bottom: 36px; }
    .newsletter-form {
      display: flex;
      max-width: 480px;
      margin: 0 auto;
      gap: 0;
      border-radius: 14px;
      overflow: hidden;
      box-shadow: 0 10px 35px rgba(0,0,0,.2);
    }
    .newsletter-form input {
      flex: 1;
      border: none;
      padding: 16px 22px;
      font-size: .95rem;
      outline: none;
    }
    .newsletter-form button {
      background: var(--secondary);
      color: var(--text);
      font-weight: 700;
      font-size: .95rem;
      padding: 16px 28px;
      border: none;
      cursor: pointer;
      transition: background .25s;
    }
    .newsletter-form button:hover { background: var(--secondary-dark); }

    /* ══════════════════════════════════════
       FOOTER
    ══════════════════════════════════════ */
    footer {
      background: #0a1e2b;
      color: rgba(255,255,255,.75);
      padding: 80px 0 0;
    }

    .footer-brand-text {
      font-family: 'Playfair Display', serif;
      font-size: 1.6rem;
      font-weight: 800;
      color: #fff;
      margin-bottom: 4px;
    }
    .footer-brand-sub {
      font-size: .75rem;
      letter-spacing: 2.5px;
      text-transform: uppercase;
      color: var(--secondary);
    }
    .footer-about {
      font-size: .9rem;
      line-height: 1.8;
      margin: 18px 0 22px;
      max-width: 320px;
    }
    .social-links { display: flex; gap: 10px; flex-wrap: wrap; }
    .social-link {
      width: 38px; height: 38px;
      background: rgba(255,255,255,.07);
      border: 1px solid rgba(255,255,255,.12);
      border-radius: 10px;
      display: flex; align-items: center; justify-content: center;
      color: rgba(255,255,255,.7);
      font-size: 1rem;
      transition: all .25s;
      text-decoration: none;
    }
    .social-link:hover {
      background: var(--secondary);
      border-color: var(--secondary);
      color: var(--text);
      transform: translateY(-3px);
    }

    .footer-heading {
      font-family: 'Playfair Display', serif;
      font-size: 1.1rem;
      color: #fff;
      margin-bottom: 22px;
      position: relative;
      padding-bottom: 12px;
    }
    .footer-heading::after {
      content: '';
      position: absolute;
      bottom: 0; left: 0;
      width: 32px; height: 2px;
      background: var(--secondary);
      border-radius: 2px;
    }

    .footer-links { list-style: none; padding: 0; }
    .footer-links li { margin-bottom: 10px; }
    .footer-links a {
      color: rgba(255,255,255,.65);
      text-decoration: none;
      font-size: .9rem;
      display: flex;
      align-items: center;
      gap: 8px;
      transition: all .2s;
    }
    .footer-links a:hover { color: var(--secondary); padding-left: 6px; }
    .footer-links a::before {
      content: '›';
      color: var(--secondary);
      font-size: 1.1rem;
    }

    .footer-contact-item {
      display: flex;
      gap: 12px;
      margin-bottom: 14px;
    }
    .footer-contact-icon {
      width: 36px; height: 36px;
      background: rgba(0,96,140,.3);
      border-radius: 10px;
      display: flex; align-items: center; justify-content: center;
      color: var(--secondary);
      font-size: .95rem;
      flex-shrink: 0;
    }
    .footer-contact-text { font-size: .88rem; line-height: 1.55; color: rgba(255,255,255,.65); }
    .footer-contact-text strong { color: #fff; display: block; }

    .footer-bottom {
      border-top: 1px solid rgba(255,255,255,.08);
      padding: 22px 0;
      margin-top: 60px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 12px;
    }
    .footer-bottom p { margin: 0; font-size: .85rem; }

    /* ══════════════════════════════════════
       ANIMATIONS & SCROLL
    ══════════════════════════════════════ */
    .animate-on-scroll {
      opacity: 0;
      transform: translateY(30px);
      transition: opacity .7s ease, transform .7s ease;
    }
    .animate-on-scroll.visible { opacity: 1; transform: translateY(0); }
    .animate-delay-1 { transition-delay: .1s !important; }
    .animate-delay-2 { transition-delay: .2s !important; }
    .animate-delay-3 { transition-delay: .3s !important; }
    .animate-delay-4 { transition-delay: .4s !important; }
    .animate-delay-5 { transition-delay: .5s !important; }

    /* ── Back to top ── */
    #backToTop {
      position: fixed;
      bottom: 30px; right: 30px;
      width: 46px; height: 46px;
      background: var(--primary);
      color: #fff;
      border: none;
      border-radius: 12px;
      display: flex; align-items: center; justify-content: center;
      font-size: 1.2rem;
      cursor: pointer;
      opacity: 0;
      transform: translateY(20px);
      transition: all .3s;
      z-index: 999;
      box-shadow: 0 6px 20px rgba(0,96,140,.3);
    }
    #backToTop.show { opacity: 1; transform: translateY(0); }
    #backToTop:hover { background: var(--secondary); color: var(--text); transform: translateY(-3px); }

    /* ── Mobile ── */
    @media (max-width: 768px) {
      .hero-stats { gap: 22px; }
      .about-badge { bottom: -10px; left: -10px; padding: 12px 16px; }
      .step-connector { display: none; }
      .newsletter-form { flex-direction: column; border-radius: 14px; }
      .newsletter-form input, .newsletter-form button { border-radius: 10px; }
      .footer-bottom { justify-content: center; text-align: center; }
    }
  </style>
</head>
<body>

<!-- ═══════════════════════════════
     NAVBAR
═══════════════════════════════ -->
<nav class="navbar navbar-expand-lg" id="mainNav">
  <div class="container">
    <a class="navbar-brand" href="#">
      <div class="brand-icon">🎁</div>
      <div class="brand-text">
        <span>NUST Gift Store</span>
        <span>Empowering Community</span>
      </div>
    </a>
    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu"
      style="color:#fff;">
      <i class="bi bi-list fs-3"></i>
    </button>
    <div class="collapse navbar-collapse" id="navMenu">
      <ul class="navbar-nav mx-auto gap-1">
        <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
        <li class="nav-item"><a class="nav-link" href="#categories">Products</a></li>
        <li class="nav-item"><a class="nav-link" href="#how">How It Works</a></li>
        <li class="nav-item"><a class="nav-link" href="#testimonials">Stories</a></li>
        <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
      </ul>
      <div class="d-flex align-items-center gap-2 mt-3 mt-lg-0">
        <a href="{{ route('login') }}" class="nav-link text-white-75" style="color:rgba(255,255,255,.8);font-weight:500;padding:8px 14px;">
          <i class="bi bi-person-circle me-1"></i>Login
        </a>
        <a href="#" class="btn-nav-donor nav-link">
          <i class="bi bi-gift me-1"></i>Donate Now
        </a>
      </div>
    </div>
  </div>
</nav>

<!-- ═══════════════════════════════
     HERO SLIDER
═══════════════════════════════ -->
<div id="heroSlider" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5500">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#heroSlider" data-bs-slide-to="0" class="active"></button>
    <button type="button" data-bs-target="#heroSlider" data-bs-slide-to="1"></button>
    <button type="button" data-bs-target="#heroSlider" data-bs-slide-to="2"></button>
  </div>

  <div class="carousel-inner">

    <!-- Slide 1 -->
    <div class="carousel-item active">
      <div class="hero-slide">
        <div class="slide-bg" style="background: linear-gradient(160deg, #003d59 0%, #006a99 50%, #004f7a 100%);"></div>
        <div class="slide-overlay"></div>
        <!-- Decorative circles -->
        <div style="position:absolute;width:600px;height:600px;background:rgba(250,175,25,.06);border-radius:50%;top:-200px;right:-100px;pointer-events:none;"></div>
        <div style="position:absolute;width:300px;height:300px;background:rgba(255,255,255,.04);border-radius:50%;bottom:-80px;left:8%;pointer-events:none;"></div>
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-6 hero-content">
              <div class="hero-tag"><i class="bi bi-stars"></i> NUST Community Platform</div>
              <h1 class="hero-title">Share Gifts,<br><em>Change Lives</em></h1>
              <p class="hero-desc">A compassionate marketplace where NUST donors give freely and beneficiaries discover what they need — connecting generosity with genuine need.</p>
              <div class="hero-btns d-flex flex-wrap gap-3">
                <a href="#categories" class="btn-hero-primary"><i class="bi bi-search"></i> Browse Products</a>
                <a href="#" class="btn-hero-outline"><i class="bi bi-gift"></i> Post a Donation</a>
              </div>
              <div class="hero-stats">
                <div class="hero-stat-item">
                  <div class="hero-stat-num">1,200+</div>
                  <div class="hero-stat-lbl">Items Donated</div>
                </div>
                <div class="hero-stat-item">
                  <div class="hero-stat-num">850+</div>
                  <div class="hero-stat-lbl">Beneficiaries</div>
                </div>
                <div class="hero-stat-item">
                  <div class="hero-stat-num">340+</div>
                  <div class="hero-stat-lbl">Active Donors</div>
                </div>
              </div>
            </div>
            <div class="col-lg-5 offset-lg-1 d-none d-lg-block">
              <div class="hero-float-card">
                <div class="float-card-title">🎁 Recent Donations</div>
                <div class="float-item">
                  <div class="float-item-icon"><i class="bi bi-laptop"></i></div>
                  <div class="float-item-text"><strong>Dell Laptop — Good Condition</strong>Posted by Ali Hassan · 2 hrs ago</div>
                </div>
                <div class="float-item">
                  <div class="float-item-icon"><i class="bi bi-book"></i></div>
                  <div class="float-item-text"><strong>Physics Textbooks (Set of 5)</strong>Posted by Sara K. · 5 hrs ago</div>
                </div>
                <div class="float-item">
                  <div class="float-item-icon"><i class="bi bi-bag"></i></div>
                  <div class="float-item-text"><strong>School Supplies Bundle</strong>Posted by Farhan M. · 1 day ago</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Slide 2 -->
    <div class="carousel-item">
      <div class="hero-slide">
        <div class="slide-bg" style="background: linear-gradient(160deg, #004a2f 0%, #006840 50%, #007a4d 100%);"></div>
        <div class="slide-overlay"></div>
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-6 hero-content">
              <div class="hero-tag"><i class="bi bi-people-fill"></i> For Students & Staff</div>
              <h1 class="hero-title">Your Generosity,<br><em>Their Future</em></h1>
              <p class="hero-desc">Donate electronics, books, clothing, and more. Every item you give opens a door for someone who truly needs it at NUST.</p>
              <div class="hero-btns d-flex flex-wrap gap-3">
                <a href="#" class="btn-hero-primary"><i class="bi bi-plus-circle"></i> Post Donation</a>
                <a href="#how" class="btn-hero-outline"><i class="bi bi-play-circle"></i> See How It Works</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Slide 3 -->
    <div class="carousel-item">
      <div class="hero-slide">
        <div class="slide-bg" style="background: linear-gradient(160deg, #3d1a00 0%, #7a3800 50%, #9a4a00 100%);"></div>
        <div class="slide-overlay"></div>
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-6 hero-content">
              <div class="hero-tag"><i class="bi bi-heart-fill"></i> Community First</div>
              <h1 class="hero-title">Find What You<br><em>Need Today</em></h1>
              <p class="hero-desc">Browse through categories, apply for items you need, and let the NUST community take care of the rest — simple, free, and dignified.</p>
              <div class="hero-btns d-flex flex-wrap gap-3">
                <a href="#categories" class="btn-hero-primary"><i class="bi bi-grid"></i> View All Categories</a>
                <a href="#" class="btn-hero-outline"><i class="bi bi-envelope"></i> Contact Us</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div><!-- /.carousel-inner -->

  <button class="carousel-control-prev" type="button" data-bs-target="#heroSlider" data-bs-slide="prev">
    <i class="bi bi-chevron-left text-white fs-5"></i>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#heroSlider" data-bs-slide="next">
    <i class="bi bi-chevron-right text-white fs-5"></i>
  </button>
</div>


<!-- ═══════════════════════════════
     ABOUT US
═══════════════════════════════ -->
<div class="wave-top" style="background:var(--light);">
  <svg viewBox="0 0 1440 60" preserveAspectRatio="none" height="60" width="100%">
    <path d="M0,0 C360,60 1080,60 1440,0 L1440,0 L0,0 Z" fill="#ffffff"/>
  </svg>
</div>

<section id="about">
  <div class="container">
    <div class="row align-items-center g-5">
      <div class="col-lg-5 animate-on-scroll">
        <div class="about-image-wrap">
          <div style="height:420px;background:linear-gradient(135deg,#004a6b 0%,#00608C 50%,#007ab0 100%);border-radius:24px;display:flex;align-items:center;justify-content:center;font-size:9rem;">
            🎓
          </div>
          <div class="about-badge">
            <div class="about-badge-num">5★</div>
            <div class="about-badge-lbl">Community<br>Rated</div>
          </div>
        </div>
      </div>
      <div class="col-lg-7 animate-on-scroll animate-delay-2">
        <div class="section-label">About NUST Gift Store</div>
        <h2 class="section-title">Empowering NUST's<br><em>Generous Community</em></h2>
        <p class="about-desc">NUST Gift Store is an OLX-inspired platform built exclusively for the NUST community. Donors — faculty, staff, and students — post unused or good-condition items for free, while beneficiaries browse and apply with dignity and ease.</p>
        <p class="about-desc">We believe every act of generosity, no matter how small, creates a ripple of positive change. Our platform makes giving and receiving simple, transparent, and meaningful.</p>

        <div class="about-feature animate-on-scroll animate-delay-3">
          <div class="af-icon"><i class="bi bi-shield-check"></i></div>
          <div>
            <div class="af-title">Verified NUST Community</div>
            <div class="af-desc">Only verified NUST members can donate or apply — ensuring safety and trust within the platform.</div>
          </div>
        </div>
        <div class="about-feature animate-on-scroll animate-delay-4">
          <div class="af-icon"><i class="bi bi-hand-thumbs-up"></i></div>
          <div>
            <div class="af-title">Zero Cost, Zero Hassle</div>
            <div class="af-desc">Everything on this platform is completely free. No hidden charges, no commissions — just pure generosity.</div>
          </div>
        </div>
        <div class="about-feature animate-on-scroll animate-delay-5">
          <div class="af-icon"><i class="bi bi-award"></i></div>
          <div>
            <div class="af-title">Dignified Experience</div>
            <div class="af-desc">We prioritize privacy and respect for all parties. Beneficiary information is handled with complete discretion.</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- ═══════════════════════════════
     CATEGORIES + PRODUCTS
═══════════════════════════════ -->
<section id="categories">
  <div class="container">
    <div class="categories-header animate-on-scroll">
      <div class="section-label">Browse & Discover</div>
      <h2 class="section-title">Explore by <em>Category</em></h2>
      <p class="text-muted" style="max-width:560px;margin:0 auto;line-height:1.8;">Find exactly what you need from our growing collection of donated items across all categories.</p>
      <div class="cat-search">
        <i class="bi bi-search text-muted"></i>
        <input type="text" placeholder="Search for books, electronics, clothing…">
        <button class="cat-search-btn">Search</button>
      </div>
    </div>

    <!-- Category Cards -->
    <div class="row g-3 mb-5">
      <div class="col-6 col-md-4 col-lg-2 animate-on-scroll animate-delay-1">
        <div class="cat-card">
          <div class="cat-card-bg" style="background:linear-gradient(135deg,#e3f0f7,#c5e2f0);">📚</div>
          <div class="cat-card-overlay" style="background:linear-gradient(135deg,rgba(0,96,140,.15),rgba(0,96,140,.35));"></div>
          <div class="cat-card-info">
            <div class="cat-card-name">Books</div>
            <div class="cat-card-count">142 items</div>
          </div>
          <div class="cat-card-badge">Popular</div>
        </div>
      </div>
      <div class="col-6 col-md-4 col-lg-2 animate-on-scroll animate-delay-2">
        <div class="cat-card">
          <div class="cat-card-bg" style="background:linear-gradient(135deg,#fff3cd,#ffe08a);">💻</div>
          <div class="cat-card-overlay" style="background:linear-gradient(135deg,rgba(250,175,25,.15),rgba(250,175,25,.35));"></div>
          <div class="cat-card-info">
            <div class="cat-card-name">Electronics</div>
            <div class="cat-card-count">89 items</div>
          </div>
          <div class="cat-card-badge">Hot</div>
        </div>
      </div>
      <div class="col-6 col-md-4 col-lg-2 animate-on-scroll animate-delay-3">
        <div class="cat-card">
          <div class="cat-card-bg" style="background:linear-gradient(135deg,#f0e8f7,#d9c4f0);">👕</div>
          <div class="cat-card-overlay" style="background:linear-gradient(135deg,rgba(120,60,180,.15),rgba(120,60,180,.35));"></div>
          <div class="cat-card-info">
            <div class="cat-card-name">Clothing</div>
            <div class="cat-card-count">218 items</div>
          </div>
        </div>
      </div>
      <div class="col-6 col-md-4 col-lg-2 animate-on-scroll animate-delay-4">
        <div class="cat-card">
          <div class="cat-card-bg" style="background:linear-gradient(135deg,#e8f5e9,#c8e6c9);">🪑</div>
          <div class="cat-card-overlay" style="background:linear-gradient(135deg,rgba(56,142,60,.15),rgba(56,142,60,.35));"></div>
          <div class="cat-card-info">
            <div class="cat-card-name">Furniture</div>
            <div class="cat-card-count">53 items</div>
          </div>
        </div>
      </div>
      <div class="col-6 col-md-4 col-lg-2 animate-on-scroll animate-delay-5">
        <div class="cat-card">
          <div class="cat-card-bg" style="background:linear-gradient(135deg,#fce4ec,#f8bbd0);">🏀</div>
          <div class="cat-card-overlay" style="background:linear-gradient(135deg,rgba(194,24,91,.15),rgba(194,24,91,.35));"></div>
          <div class="cat-card-info">
            <div class="cat-card-name">Sports</div>
            <div class="cat-card-count">67 items</div>
          </div>
        </div>
      </div>
      <div class="col-6 col-md-4 col-lg-2 animate-on-scroll animate-delay-5">
        <div class="cat-card">
          <div class="cat-card-bg" style="background:linear-gradient(135deg,#e0f7fa,#b2ebf2);">🎨</div>
          <div class="cat-card-overlay" style="background:linear-gradient(135deg,rgba(0,151,167,.15),rgba(0,151,167,.35));"></div>
          <div class="cat-card-info">
            <div class="cat-card-name">Stationery</div>
            <div class="cat-card-count">103 items</div>
          </div>
        </div>
      </div>
    </div>

    <!-- Filter tabs -->
    <div class="filter-tabs animate-on-scroll">
      <button class="filter-tab active">All Items</button>
      <button class="filter-tab">Books</button>
      <button class="filter-tab">Electronics</button>
      <button class="filter-tab">Clothing</button>
      <button class="filter-tab">Furniture</button>
      <button class="filter-tab">Sports</button>
      <button class="filter-tab">Stationery</button>
    </div>

    <!-- Product Listing -->
    <div class="row g-4">

      <!-- Product 1 -->
      <div class="col-md-6 col-lg-4 animate-on-scroll animate-delay-1">
        <div class="product-card">
          <div class="product-img-wrap">
            💻
            <span class="product-condition">Like New</span>
            <div class="product-wishlist"><i class="bi bi-heart"></i></div>
          </div>
          <div class="product-body">
            <div class="product-cat">Electronics</div>
            <div class="product-name">Dell Inspiron 15 Laptop</div>
            <div class="product-meta">
              <span><i class="bi bi-geo-alt me-1"></i>H-12, Islamabad</span>
              <span><i class="bi bi-clock me-1"></i>2 hrs ago</span>
            </div>
            <div class="product-meta">
              <span><i class="bi bi-eye me-1"></i>247 views</span>
              <span><i class="bi bi-people me-1"></i>12 applicants</span>
            </div>
          </div>
          <div class="product-footer">
            <div class="donor-tag">by <strong>Ali Hassan</strong></div>
            <button class="btn-apply">Apply Now</button>
          </div>
        </div>
      </div>

      <!-- Product 2 -->
      <div class="col-md-6 col-lg-4 animate-on-scroll animate-delay-2">
        <div class="product-card">
          <div class="product-img-wrap">
            📚
            <span class="product-condition">Good</span>
            <div class="product-wishlist"><i class="bi bi-heart"></i></div>
          </div>
          <div class="product-body">
            <div class="product-cat">Books</div>
            <div class="product-name">Engineering Physics Textbook Set</div>
            <div class="product-meta">
              <span><i class="bi bi-geo-alt me-1"></i>NUST Campus</span>
              <span><i class="bi bi-clock me-1"></i>5 hrs ago</span>
            </div>
            <div class="product-meta">
              <span><i class="bi bi-eye me-1"></i>183 views</span>
              <span><i class="bi bi-people me-1"></i>8 applicants</span>
            </div>
          </div>
          <div class="product-footer">
            <div class="donor-tag">by <strong>Sara Khalid</strong></div>
            <button class="btn-apply">Apply Now</button>
          </div>
        </div>
      </div>

      <!-- Product 3 -->
      <div class="col-md-6 col-lg-4 animate-on-scroll animate-delay-3">
        <div class="product-card">
          <div class="product-img-wrap">
            🪑
            <span class="product-condition">Fair</span>
            <div class="product-wishlist"><i class="bi bi-heart"></i></div>
          </div>
          <div class="product-body">
            <div class="product-cat">Furniture</div>
            <div class="product-name">Study Chair — Adjustable Height</div>
            <div class="product-meta">
              <span><i class="bi bi-geo-alt me-1"></i>Sector F-8</span>
              <span><i class="bi bi-clock me-1"></i>1 day ago</span>
            </div>
            <div class="product-meta">
              <span><i class="bi bi-eye me-1"></i>92 views</span>
              <span><i class="bi bi-people me-1"></i>5 applicants</span>
            </div>
          </div>
          <div class="product-footer">
            <div class="donor-tag">by <strong>Dr. Farhan M.</strong></div>
            <button class="btn-apply">Apply Now</button>
          </div>
        </div>
      </div>

      <!-- Product 4 -->
      <div class="col-md-6 col-lg-4 animate-on-scroll animate-delay-1">
        <div class="product-card">
          <div class="product-img-wrap">
            👕
            <span class="product-condition">New</span>
            <div class="product-wishlist"><i class="bi bi-heart"></i></div>
          </div>
          <div class="product-body">
            <div class="product-cat">Clothing</div>
            <div class="product-name">Winter Jacket (Men, Size M)</div>
            <div class="product-meta">
              <span><i class="bi bi-geo-alt me-1"></i>NUST Campus</span>
              <span><i class="bi bi-clock me-1"></i>2 days ago</span>
            </div>
            <div class="product-meta">
              <span><i class="bi bi-eye me-1"></i>154 views</span>
              <span><i class="bi bi-people me-1"></i>19 applicants</span>
            </div>
          </div>
          <div class="product-footer">
            <div class="donor-tag">by <strong>Hina Baig</strong></div>
            <button class="btn-apply">Apply Now</button>
          </div>
        </div>
      </div>

      <!-- Product 5 -->
      <div class="col-md-6 col-lg-4 animate-on-scroll animate-delay-2">
        <div class="product-card">
          <div class="product-img-wrap">
            🎒
            <span class="product-condition">Good</span>
            <div class="product-wishlist"><i class="bi bi-heart"></i></div>
          </div>
          <div class="product-body">
            <div class="product-cat">Stationery</div>
            <div class="product-name">School Supplies Bundle (Complete)</div>
            <div class="product-meta">
              <span><i class="bi bi-geo-alt me-1"></i>E-11 Islamabad</span>
              <span><i class="bi bi-clock me-1"></i>3 days ago</span>
            </div>
            <div class="product-meta">
              <span><i class="bi bi-eye me-1"></i>201 views</span>
              <span><i class="bi bi-people me-1"></i>27 applicants</span>
            </div>
          </div>
          <div class="product-footer">
            <div class="donor-tag">by <strong>Usman Tariq</strong></div>
            <button class="btn-apply">Apply Now</button>
          </div>
        </div>
      </div>

      <!-- Donate CTA Card -->
      <div class="col-md-6 col-lg-4 animate-on-scroll animate-delay-3">
        <div class="product-card" style="background:linear-gradient(135deg,var(--primary) 0%,var(--primary-light) 100%);border:none;min-height:340px;display:flex;flex-direction:column;align-items:center;justify-content:center;text-align:center;padding:32px;">
          <div style="font-size:3.5rem;margin-bottom:16px;">🎁</div>
          <h4 style="font-family:'Playfair Display',serif;color:#fff;margin-bottom:10px;">Have something to donate?</h4>
          <p style="color:rgba(255,255,255,.8);font-size:.9rem;margin-bottom:22px;line-height:1.7;">Post your item and help a NUST community member in need. It takes less than 2 minutes.</p>
          <button class="btn-donate-post"><i class="bi bi-plus-circle me-2"></i>Post a Donation</button>
        </div>
      </div>

    </div><!-- /.row products -->

    <div class="text-center mt-5 animate-on-scroll">
      <a href="#" class="btn-hero-primary" style="display:inline-flex;">
        <i class="bi bi-grid-3x3-gap"></i> View All Products
      </a>
    </div>

  </div>
</section>


<!-- ═══════════════════════════════
     HOW IT WORKS
═══════════════════════════════ -->
<section id="how">
  <div class="container">
    <div class="text-center mb-5 animate-on-scroll">
      <div class="section-label">Simple Process</div>
      <h2 class="section-title" style="color:#fff;">How <em>It Works</em></h2>
      <p style="color:rgba(255,255,255,.75);max-width:540px;margin:0 auto;line-height:1.8;">Whether you're giving or receiving, the process is designed to be simple, fast, and respectful.</p>
    </div>

    <!-- Donors -->
    <div class="row align-items-center mb-5 animate-on-scroll">
      <div class="col-12 text-center mb-4">
        <span style="background:rgba(250,175,25,.2);color:var(--secondary);font-weight:700;font-size:.85rem;letter-spacing:2px;text-transform:uppercase;padding:8px 20px;border-radius:20px;border:1px solid rgba(250,175,25,.4);">
          <i class="bi bi-gift me-2"></i>For Donors
        </span>
      </div>
    </div>
    <div class="row g-4 mb-5">
      <div class="col-md-4 animate-on-scroll animate-delay-1">
        <div class="step-card">
          <div class="step-num">1</div>
          <div class="step-icon"><i class="bi bi-person-plus"></i></div>
          <h5 class="step-title">Register & Verify</h5>
          <p class="step-desc">Create your account with your NUST email and verify your identity to join the trusted community.</p>
        </div>
      </div>
      <div class="col-md-4 animate-on-scroll animate-delay-2">
        <div class="step-card">
          <div class="step-num">2</div>
          <div class="step-icon"><i class="bi bi-camera"></i></div>
          <h5 class="step-title">Post Your Item</h5>
          <p class="step-desc">Add photos, description, category, and condition of the item you want to donate — it's quick and easy.</p>
        </div>
      </div>
      <div class="col-md-4 animate-on-scroll animate-delay-3">
        <div class="step-card">
          <div class="step-num">3</div>
          <div class="step-icon"><i class="bi bi-check-circle"></i></div>
          <h5 class="step-title">Review & Hand Over</h5>
          <p class="step-desc">Review applicant profiles, select the right beneficiary, and coordinate a safe handover.</p>
        </div>
      </div>
    </div>

    <!-- Beneficiaries -->
    <div class="row align-items-center mb-4 animate-on-scroll">
      <div class="col-12 text-center mb-4">
        <span style="background:rgba(255,255,255,.1);color:#fff;font-weight:700;font-size:.85rem;letter-spacing:2px;text-transform:uppercase;padding:8px 20px;border-radius:20px;border:1px solid rgba(255,255,255,.2);">
          <i class="bi bi-heart me-2"></i>For Beneficiaries
        </span>
      </div>
    </div>
    <div class="row g-4">
      <div class="col-md-4 animate-on-scroll animate-delay-1">
        <div class="step-card">
          <div class="step-num">1</div>
          <div class="step-icon"><i class="bi bi-search"></i></div>
          <h5 class="step-title">Browse & Discover</h5>
          <p class="step-desc">Search through categories to find items that match your needs — books, electronics, clothing, and more.</p>
        </div>
      </div>
      <div class="col-md-4 animate-on-scroll animate-delay-2">
        <div class="step-card">
          <div class="step-num">2</div>
          <div class="step-icon"><i class="bi bi-send"></i></div>
          <h5 class="step-title">Apply Discreetly</h5>
          <p class="step-desc">Submit your application with a brief note. Your information stays private and is only shared with the donor.</p>
        </div>
      </div>
      <div class="col-md-4 animate-on-scroll animate-delay-3">
        <div class="step-card">
          <div class="step-num">3</div>
          <div class="step-icon"><i class="bi bi-bag-check"></i></div>
          <h5 class="step-title">Receive with Dignity</h5>
          <p class="step-desc">Once approved, coordinate with the donor to collect your item. No fees, no judgement — just community.</p>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- ═══════════════════════════════
     TESTIMONIALS
═══════════════════════════════ -->
<section id="testimonials">
  <div class="container">
    <div class="testimonials-header animate-on-scroll">
      <div class="section-label">Community Stories</div>
      <h2 class="section-title">What Our <em>Members Say</em></h2>
    </div>
    <div class="row g-4">
      <div class="col-md-4 animate-on-scroll animate-delay-1">
        <div class="testimonial-card">
          <div class="quote-icon">"</div>
          <div class="star-rating"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></div>
          <p class="testimonial-text">I posted my old laptop that was just collecting dust. Within hours, I had applications from students who genuinely needed it. The process was smooth and heartwarming.</p>
          <div class="testimonial-author">
            <div class="author-avatar">AH</div>
            <div>
              <div class="author-name">Ali Hassan</div>
              <div class="author-role">Faculty — SEECS, NUST</div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 animate-on-scroll animate-delay-2">
        <div class="testimonial-card">
          <div class="quote-icon">"</div>
          <div class="star-rating"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></div>
          <p class="testimonial-text">I was struggling to afford textbooks in my first semester. NUST Gift Store helped me find a complete set within my first week. This platform is a true blessing for students.</p>
          <div class="testimonial-author">
            <div class="author-avatar">SN</div>
            <div>
              <div class="author-name">Sana Naz</div>
              <div class="author-role">BS Student — NUST</div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4 animate-on-scroll animate-delay-3">
        <div class="testimonial-card">
          <div class="quote-icon">"</div>
          <div class="star-rating"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-half"></i></div>
          <p class="testimonial-text">The dignity of the experience is what sets this platform apart. No awkward questions, no stigma — just genuine community support. I've both donated and received items here.</p>
          <div class="testimonial-author">
            <div class="author-avatar">FM</div>
            <div>
              <div class="author-name">Farhan Malik</div>
              <div class="author-role">MS Student — NUST</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- ═══════════════════════════════
     NEWSLETTER / CTA
═══════════════════════════════ -->
<section id="cta">
  <div class="container">
    <div class="cta-inner animate-on-scroll">
      <div class="section-label" style="color:var(--secondary);background:rgba(250,175,25,.15);border-color:rgba(250,175,25,.3);margin:0 auto 16px;">Stay Connected</div>
      <h2 class="cta-title">Never Miss a <em style="color:var(--secondary);font-style:normal;">Donation</em></h2>
      <p class="cta-sub">Subscribe to get notified about new items, platform updates, and community stories.</p>
      <div class="newsletter-form">
        <input type="email" placeholder="Enter your NUST email address…">
        <button><i class="bi bi-bell me-2"></i>Subscribe</button>
      </div>
      <p style="color:rgba(255,255,255,.55);font-size:.8rem;margin-top:14px;"><i class="bi bi-lock me-1"></i>Your email stays private. Unsubscribe anytime.</p>
    </div>
  </div>
</section>


<!-- ═══════════════════════════════
     FOOTER
═══════════════════════════════ -->
<footer id="contact">
  <div class="container">
    <div class="row g-5">
      <!-- Brand -->
      <div class="col-lg-4">
        <div style="display:flex;align-items:center;gap:12px;margin-bottom:14px;">
          <div style="width:44px;height:44px;background:var(--secondary);border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1.4rem;">🎁</div>
          <div>
            <div class="footer-brand-text">NUST Gift Store</div>
            <div class="footer-brand-sub">Empowering Community</div>
          </div>
        </div>
        <p class="footer-about">An OLX-inspired platform built for the NUST community — connecting donors with beneficiaries through the simple act of giving. Free. Safe. Dignified.</p>
        <div class="social-links">
          <a href="#" class="social-link"><i class="bi bi-facebook"></i></a>
          <a href="#" class="social-link"><i class="bi bi-instagram"></i></a>
          <a href="#" class="social-link"><i class="bi bi-twitter-x"></i></a>
          <a href="#" class="social-link"><i class="bi bi-linkedin"></i></a>
          <a href="#" class="social-link"><i class="bi bi-whatsapp"></i></a>
        </div>
      </div>

      <!-- Quick Links -->
      <div class="col-6 col-lg-2">
        <h5 class="footer-heading">Quick Links</h5>
        <ul class="footer-links">
          <li><a href="#">Home</a></li>
          <li><a href="#about">About Us</a></li>
          <li><a href="#categories">Products</a></li>
          <li><a href="#how">How It Works</a></li>
          <li><a href="#testimonials">Stories</a></li>
          <li><a href="{{ route('login') }}">Login / Register</a></li>
        </ul>
      </div>

      <!-- Categories -->
      <div class="col-6 col-lg-2">
        <h5 class="footer-heading">Categories</h5>
        <ul class="footer-links">
          <li><a href="#">Books & Notes</a></li>
          <li><a href="#">Electronics</a></li>
          <li><a href="#">Clothing</a></li>
          <li><a href="#">Furniture</a></li>
          <li><a href="#">Sports Items</a></li>
          <li><a href="#">Stationery</a></li>
        </ul>
      </div>

      <!-- Contact -->
      <div class="col-lg-4">
        <h5 class="footer-heading">Get In Touch</h5>
        <div class="footer-contact-item">
          <div class="footer-contact-icon"><i class="bi bi-geo-alt"></i></div>
          <div class="footer-contact-text">
            <strong>Address</strong>
            NUST, H-12, Islamabad, Pakistan
          </div>
        </div>
        <div class="footer-contact-item">
          <div class="footer-contact-icon"><i class="bi bi-envelope"></i></div>
          <div class="footer-contact-text">
            <strong>Email</strong>
            giftstore@nust.edu.pk
          </div>
        </div>
        <div class="footer-contact-item">
          <div class="footer-contact-icon"><i class="bi bi-telephone"></i></div>
          <div class="footer-contact-text">
            <strong>Phone</strong>
            +92 51 9085 – 1234
          </div>
        </div>
        <div class="footer-contact-item">
          <div class="footer-contact-icon"><i class="bi bi-clock"></i></div>
          <div class="footer-contact-text">
            <strong>Office Hours</strong>
            Mon–Fri, 9:00 AM – 5:00 PM
          </div>
        </div>
      </div>
    </div>

    <div class="footer-bottom">
      <p>© 2025 NUST Gift Store. All rights reserved. Made with <span style="color:var(--secondary);">♥</span> for NUST Community.</p>
      <p style="font-size:.82rem;color:rgba(255,255,255,.4);">
        <a href="#" style="color:rgba(255,255,255,.5);text-decoration:none;">Privacy Policy</a> &nbsp;·&nbsp;
        <a href="#" style="color:rgba(255,255,255,.5);text-decoration:none;">Terms of Use</a>
      </p>
    </div>
  </div>
</footer>

<!-- Back to Top -->
<button id="backToTop" title="Back to top"><i class="bi bi-arrow-up"></i></button>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
  // ── Navbar scroll effect
  const nav = document.getElementById('mainNav');
  window.addEventListener('scroll', () => {
    nav.classList.toggle('scrolled', window.scrollY > 60);
  });

  // ── Back to top
  const backBtn = document.getElementById('backToTop');
  window.addEventListener('scroll', () => {
    backBtn.classList.toggle('show', window.scrollY > 400);
  });
  backBtn.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));

  // ── Scroll animations
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); });
  }, { threshold: 0.12 });
  document.querySelectorAll('.animate-on-scroll').forEach(el => observer.observe(el));

  // ── Filter tabs
  document.querySelectorAll('.filter-tab').forEach(tab => {
    tab.addEventListener('click', function () {
      document.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('active'));
      this.classList.add('active');
    });
  });

  // ── Wishlist toggle
  document.querySelectorAll('.product-wishlist').forEach(btn => {
    btn.addEventListener('click', function () {
      const icon = this.querySelector('i');
      icon.classList.toggle('bi-heart');
      icon.classList.toggle('bi-heart-fill');
      this.style.color = icon.classList.contains('bi-heart-fill') ? '#e74c3c' : '';
    });
  });
</script>
</body>
</html>