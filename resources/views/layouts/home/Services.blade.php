<style>
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
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            transition: all 0.4s ease;
            border: 1px solid rgba(0, 0, 0, 0.05);
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
</style>

<!-- Services Section -->
<section class="services-section py-5" id="services">
    <div class="container"> <!-- Section Header -->
        <div class="section-header text-center mb-5" data-aos="fade-up">
            <h2 class="fw-bold">Our Services</h2>
            <p class="text-muted"> Comprehensive solutions for donors and beneficiaries </p>
        </div> <!-- Services Row -->
        <div class="row g-4"> <!-- Service Card 1 -->
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="0">
                <div class="service-card h-100 text-center">
                    <div class="service-icon"> <i class="fas fa-laptop-code"></i> </div>
                    <h4 class="text-dark">Impact Through Tech Support</h4>
                    <p class="text-justify"> Through gadget donations, you can help students gain access to laptops,
                        financial calculators, mobile devices, and essential digital tools that enable them to stay
                        connected, complete assignments, participate confidently in academic activities, and thrive in
                        today’s technology-driven learning environment. </p>
                </div>
            </div> <!-- Service Card 2 -->
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="service-card h-100 text-center">
                    <div class="service-icon"> <i class="fas fa-graduation-cap"></i> </div>
                    <h4 class="text-dark">Academically Enable</h4>
                    <p class="text-justify"> Equipping students with essential academic resources including notebooks,
                        diaries, stationery, and learning materials to support organized learning, effective
                        note-taking, and sustained academic excellence. These tools help students stay prepared,
                        structured, and fully engaged in their academic journey, enabling consistent performance and
                        success. </p>
                </div>
            </div> <!-- Service Card 3 -->
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="service-card h-100 text-center">
                    <div class="service-icon"> <i class="fas fa-shirt"></i> </div>
                    <h4 class="text-dark">Clothing & Daily Essentials Support</h4>
                    <p class="text-justify"> Supporting students with essential clothing and daily-use necessities
                        including apparel, bags, winter essentials, and personal care items to ensure comfort, dignity,
                        and confidence in their academic journey. By meeting basic needs, we enable students to focus
                        fully on learning and campus life without barriers. </p>
                </div>
            </div>
        </div>
    </div>
</section>
