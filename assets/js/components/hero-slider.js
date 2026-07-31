/*==================================================
TRAVELNEST SLIDER CONFIGURATIONS (SWIPER.JS)
Version: 1.0
==================================================*/

document.addEventListener("DOMContentLoaded", () => {
    
    /*=========================================
    1. FULLSCREEN HERO SLIDER
    =========================================*/
    if (document.querySelector(".hero-slider")) {
        const heroSlider = new Swiper(".hero-slider", {
            loop: true,
            speed: 1400,
            effect: "fade",
            fadeEffect: {
                crossFade: true
            },
            grabCursor: true,
            watchSlidesProgress: true,
            preloadImages: true,
            updateOnWindowResize: true,
            autoplay: {
                delay: 6000,
                disableOnInteraction: false,
                pauseOnMouseEnter: true
            },
            keyboard: {
                enabled: true
            },
            navigation: {
                nextEl: ".hero-next",
                prevEl: ".hero-prev"
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true
            },
            on: {
                init: function () {
                    updateCounter(this);
                    animateSlide(this);
                    restartProgress();
                },
                slideChangeTransitionStart: function () {
                    updateCounter(this);
                },
                slideChangeTransitionEnd: function () {
                    animateSlide(this);
                    restartProgress();
                }
            }
        });

        // Hero Counter Update
        function updateCounter(swiper) {
            const current = document.querySelector(".current-slide");
            const total = document.querySelector(".total-slide");
            if (!current || !total) return;

            let index = swiper.realIndex + 1;
            current.textContent = String(index).padStart(2, "0");
            total.textContent = String(swiper.slides.length - swiper.loopedSlides * 2).padStart(2, "0");
        }

        // Hero Slide Duration Progress Bar
        function restartProgress() {
            const bar = document.querySelector(".hero-progress span");
            if (!bar) return;

            bar.style.animation = "none";
            bar.offsetHeight; // Trigger reflow to restart animation
            bar.style.animation = "progressBar 6s linear forwards";
        }

        // GSAP Slide Text Animations
        function animateSlide(swiper) {
            if (typeof gsap === "undefined") return;

            const active = swiper.slides[swiper.activeIndex];
            if (!active) return;

            const tag = active.querySelector(".hero-tag");
            const title = active.querySelector("h1");
            const text = active.querySelector("p");
            const buttons = active.querySelector(".hero-buttons");

            // Reset elements
            gsap.set([tag, title, text, buttons], {
                opacity: 0,
                y: 60
            });

            // Timed animation sequence
            const tl = gsap.timeline();
            tl.to(tag, {
                opacity: 1,
                y: 0,
                duration: 0.6,
                ease: "power3.out"
            })
            .to(title, {
                opacity: 1,
                y: 0,
                duration: 0.8,
                ease: "power3.out"
            }, "-=0.3")
            .to(text, {
                opacity: 1,
                y: 0,
                duration: 0.6,
                ease: "power3.out"
            }, "-=0.4")
            .to(buttons, {
                opacity: 1,
                y: 0,
                duration: 0.6,
                ease: "power3.out"
            }, "-=0.3");
        }

        // Pause slideshow if browser tab is hidden
        document.addEventListener("visibilitychange", () => {
            if (document.hidden) {
                heroSlider.autoplay.stop();
            } else {
                heroSlider.autoplay.start();
                restartProgress();
            }
        });

        // Mouse Wheel Scroll Navigation integration
        let wheelLocked = false;
        window.addEventListener("wheel", (e) => {
            // Only affect slider if page is at the very top (scrolled to 0)
            if (window.scrollY > 10) return;
            if (wheelLocked) return;
            if (Math.abs(e.deltaY) < 40) return;

            wheelLocked = true;
            if (e.deltaY > 0) {
                heroSlider.slideNext();
            } else {
                heroSlider.slidePrev();
            }

            setTimeout(() => {
                wheelLocked = false;
            }, 900);
        });
    }

    /*=========================================
    2. LUXURY TESTIMONIAL SLIDER
    =========================================*/
    if (document.querySelector(".testimonial-slider")) {
        new Swiper(".testimonial-slider", {
            loop: true,
            speed: 1000,
            spaceBetween: 30,
            grabCursor: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
                pauseOnMouseEnter: true
            },
            pagination: {
                el: ".testimonials-pagination",
                clickable: true
            },
            breakpoints: {
                0: {
                    slidesPerView: 1
                },
                768: {
                    slidesPerView: 2
                },
                1200: {
                    slidesPerView: 3
                }
            }
        });
    }

    /*=========================================
    3. TRENDING TOUR PACKAGES SLIDER (HOME)
    =========================================*/
    if (document.querySelector(".packages-slider")) {
        new Swiper(".packages-slider", {
            loop: false,
            speed: 800,
            spaceBetween: 30,
            grabCursor: true,
            pagination: {
                el: ".packages-pagination",
                clickable: true
            },
            breakpoints: {
                0: {
                    slidesPerView: 1
                },
                768: {
                    slidesPerView: 2
                },
                1200: {
                    slidesPerView: 3
                }
            }
        });
    }

});
