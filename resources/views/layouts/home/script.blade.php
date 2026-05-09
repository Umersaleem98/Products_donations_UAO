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
                $('html, body').animate({
                    scrollTop: 0
                }, 800);
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
                $({
                    countNum: $element.text()
                }).animate({
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