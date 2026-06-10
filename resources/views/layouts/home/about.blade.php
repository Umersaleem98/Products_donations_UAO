<style>
    /* ABOUT SECTION */
    .about-section {
        padding: 100px 0;
        background: var(--light-color);
        overflow: hidden;
    }

    /* IMAGE AREA (UNCHANGED) */
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

    .img-one { width: 320px; height: 400px; top: 0; left: 0; }
    .img-two { width: 220px; height: 250px; bottom: 0; left: 260px; border: 6px solid #fff; }
    .img-three { width: 180px; height: 180px; top: 40px; right: 0; }

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

    /* =========================
       SMOOTH READ MORE SECTION
    ========================== */

    .more-text {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.6s ease, opacity 0.6s ease;
        opacity: 0;
    }

    .more-text.show {
        max-height: 600px;
        opacity: 1;
    }

    .read-more-btn {
        border: none;
        background: var(--secondary-color);
        color: var(--dark-color);
        padding: 12px 28px;
        border-radius: 50px;
        font-weight: 600;
        margin-top: 10px;
        cursor: pointer;
        transition: 0.3s ease;
    }

    .read-more-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.15);
    }

    /* RESPONSIVE (UNCHANGED) */
</style>

<!-- ABOUT SECTION -->
<section class="about-section" id="about">
    <div class="container">
        <div class="row align-items-center">

            <!-- IMAGES (UNCHANGED) -->
            <div class="col-lg-6 mb-5 mb-lg-0">
                <div class="about-images">

                    <div class="about-img-box img-one">
                        <img src="{{ asset('templates/assets/images/about1.png') }}">
                    </div>

                    <div class="about-img-box img-two">
                        <img src="{{ asset('templates/assets/images/about2.png') }}">
                    </div>

                    <div class="about-img-box img-three">
                        <img src="{{ asset('templates/assets/images/about3.png') }}">
                    </div>

                    <div class="experience-badge">
                        <div style="font-size: 1.6rem;">NUST</div>
                        <div style="font-size: 0.9rem;">Sharing Network</div>
                    </div>

                </div>
            </div>

            <!-- CONTENT -->
            <div class="col-lg-6">

                <div class="about-content">

                    <h2 style="color:#3B71B8;">WHO WE ARE</h2>
                    <p>Empowering education through structured student support and resource sharing</p>

                    <h3>Supporting Academic Continuity at NUST</h3>

                    <p>
                        NUST Sharing Network is a structured donation and resource-sharing platform
                        designed to assist students who face financial barriers in accessing essential academic tools.
                    </p>

                    <p>
                        Our mission is to ensure equal access to educational resources such as laptops,
                        books, calculators, and learning essentials.
                    </p>

                    <!-- MORE CONTENT -->
                    <div class="more-text" id="moreContent">

                        <p>
                            Through transparent and verified contributions, we help bridge the gap
                            between donors and students in need.
                        </p>

                        <p>
                            Every contribution directly supports academic growth and long-term student success.
                        </p>

                        <ul class="feature-list">
                            <li><i class="fas fa-check-circle"></i> Transparent donation system</li>
                            <li><i class="fas fa-check-circle"></i> Verified student support network</li>
                            <li><i class="fas fa-check-circle"></i> Equal access to academic resources</li>
                            <li><i class="fas fa-check-circle"></i> Community-driven impact model</li>
                        </ul>

                    </div>

                    <button class="read-more-btn" id="readMoreBtn">
                        Read More
                    </button>

                </div>

            </div>

        </div>
    </div>
</section>

<!-- SMOOTH TOGGLE SCRIPT -->
<script>
    const btn = document.getElementById("readMoreBtn");
    const more = document.getElementById("moreContent");

    btn.addEventListener("click", () => {
        more.classList.toggle("show");

        btn.innerText = more.classList.contains("show")
            ? "Read Less"
            : "Read More";
    });
</script>
