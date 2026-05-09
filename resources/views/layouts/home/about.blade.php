<style>
    /* ABOUT SECTION */
    .about-section {
        padding: 100px 0;
        background: var(--light-color);
        overflow: hidden;
    }

    /* IMAGE AREA */
    .about-images {
        position: relative;
        min-height: 520px;
    }

    .about-img-box {
        position: absolute;
        overflow: hidden;
        border-radius: 20px;
        box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        transition: 0.4s ease;
    }

    .about-img-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: 0.5s ease;
    }

    .about-img-box:hover img {
        transform: scale(1.08);
    }

    .about-img-box:hover {
        transform: translateY(-8px);
    }

    /* IMAGE POSITIONS */
    .img-one {
        width: 320px;
        height: 400px;
        top: 0;
        left: 0;
        z-index: 2;
    }

    .img-two {
        width: 220px;
        height: 250px;
        bottom: 0;
        left: 260px;
        z-index: 3;
        border: 6px solid #fff;
    }

    .img-three {
        width: 180px;
        height: 180px;
        top: 40px;
        right: 0;
        z-index: 1;
    }

    /* BADGE */
    .experience-badge {
        position: absolute;
        bottom: 20px;
        left: 20px;
        background-color: #3B71B8;
        color: white;
        padding: 18px 25px;
        border-radius: 15px;
        font-weight: 700;
        z-index: 5;
        box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    }

    /* CONTENT */
    .about-content h3 {
        font-size: 2rem;
        font-weight: 700;
        color: var(--dark-color);
        margin-bottom: 20px;
    }

    .about-content p {
        color: #666;
        line-height: 1.8;
        margin-bottom: 16px;
        font-size: 15px;
    }

    .feature-list {
        list-style: none;
        padding: 0;
        margin-top: 20px;
    }

    .feature-list li {
        padding: 8px 0;
        color: var(--dark-color);
        font-weight: 500;
        font-size: 15px;
    }

    .feature-list li i {
        color: var(--secondary-color);
        margin-right: 10px;
    }

    /* READ MORE */
    .more-text {
        display: none;
    }

    .read-more-btn {
        border: none;
        background: var(--secondary-color);
        color: var(--dark-color);
        padding: 12px 28px;
        border-radius: 50px;
        font-weight: 600;
        margin-top: 10px;
        transition: 0.3s ease;
    }

    .read-more-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.15);
    }

    /* RESPONSIVE */
    @media (max-width: 991px) {

        .about-images {
            min-height: 450px;
            margin-bottom: 50px;
        }

        .img-one {
            width: 260px;
            height: 320px;
        }

        .img-two {
            width: 180px;
            height: 200px;
            left: 180px;
        }

        .img-three {
            width: 140px;
            height: 140px;
        }
    }

    @media (max-width: 576px) {

        .about-images {
            min-height: 380px;
        }

        .img-one {
            width: 220px;
            height: 270px;
        }

        .img-two {
            width: 140px;
            height: 160px;
            left: 140px;
        }

        .img-three {
            width: 110px;
            height: 110px;
        }

        .about-content h3 {
            font-size: 1.6rem;
        }
    }
</style>

<!-- ABOUT SECTION -->
<section class="about-section" id="about">
    <div class="container">
        <div class="row align-items-center">

            <!-- LEFT SIDE IMAGES -->
            <div class="col-lg-6 mb-5 mb-lg-0" data-aos="fade-right">

                <div class="about-images">

                    <!-- IMAGE 1 -->
                    <div class="about-img-box img-one">
                        <img src="{{ asset('templates/assets/images/about1.png') }}"
                            alt="Students">
                    </div>

                    <!-- IMAGE 2 -->
                    <div class="about-img-box img-two">
                        <img src="{{ asset('templates/assets/images/about2.png') }}"
                            alt="Education Support">
                    </div>

                    <!-- IMAGE 3 -->
                    <div class="about-img-box img-three">
                        <img src="{{ asset('templates/assets/images/about3.png') }}"
                            alt="NUST Community">
                    </div>

                    <!-- BADGE -->
                    <div class="experience-badge">
                        <div style="font-size: 2rem; line-height:1;">NUST</div>
                        <div style="font-size: 0.9rem;">Gift Store</div>
                    </div>

                </div>

            </div>

            <!-- RIGHT SIDE CONTENT -->
            <div class="col-lg-6" data-aos="fade-left">

                <div class="about-content">

                    <div class="section-header text-start mb-4">
                        <h2 style="display:block; text-align:left; color: #3B71B8">
                            WHO ARE WE?
                        </h2>

                        <p style="text-align:left; margin-left:0;">
                            Supporting students through generosity
                        </p>
                    </div>

                    <h3>Helping Students Continue Their Journey</h3>

                    <p>
                        The NUST Gift Store is a donation platform created to support students who
                        struggle to afford essential academic tools such as laptops, books,
                        calculators, clothing, and gadgets.
                    </p>

                    <p>
                        Our goal is simple — to ensure that no deserving student falls behind
                        because of limited resources.
                    </p>

                    <!-- HIDDEN CONTENT -->
                    <div class="more-text" id="moreContent">

                        <p>
                            Every contribution can make a meaningful difference in a student’s life.
                            A donated laptop, calculator, or set of books can help someone study
                            with confidence and continue their education with dignity.
                        </p>

                        <p>
                            Together, we can create equal opportunities and rewrite scholar stories.
                        </p>

                        <ul class="feature-list">
                            <li><i class="fas fa-check-circle"></i> Transparent donation process</li>
                            <li><i class="fas fa-check-circle"></i> Verified donors & beneficiaries</li>
                            <li><i class="fas fa-check-circle"></i> Support for essential student needs</li>
                            <li><i class="fas fa-check-circle"></i> Community-driven impact</li>
                        </ul>

                    </div>

                    <!-- BUTTON -->
                    <button class="read-more-btn" id="readMoreBtn">
                        Read More
                    </button>

                </div>

            </div>

        </div>
    </div>
</section>

<!-- READ MORE SCRIPT -->
<script>
    const readMoreBtn = document.getElementById("readMoreBtn");
    const moreContent = document.getElementById("moreContent");

    readMoreBtn.addEventListener("click", function () {

        if (moreContent.style.display === "block") {
            moreContent.style.display = "none";
            readMoreBtn.innerText = "Read More";
        } else {
            moreContent.style.display = "block";
            readMoreBtn.innerText = "Read Less";
        }

    });
</script>