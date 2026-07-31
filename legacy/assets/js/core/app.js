/*==================================================
TRAVELNEST GLOBAL JAVASCRIPT
Version: 1.0
==================================================*/

document.addEventListener("DOMContentLoaded", () => {
    
    // Core Elements
    const header = document.querySelector(".header-site");
    const hamburger = document.querySelector(".hamburger-menu");
    const navMenu = document.querySelector(".nav-menu-wrapper");
    const navItems = document.querySelectorAll(".nav-item");

    /*=========================================
    1. STICKY GLASS HEADER
    =========================================*/
    const handleScroll = () => {
        if (window.scrollY > 50) {
            header.classList.add("header-scrolled");
        } else {
            header.classList.remove("header-scrolled");
        }
    };
    window.addEventListener("scroll", handleScroll);
    handleScroll(); // Initial check

    /*=========================================
    2. RESPONSIVE NAVIGATION MENU
    =========================================*/
    if (hamburger && navMenu) {
        hamburger.addEventListener("click", () => {
            hamburger.classList.toggle("active");
            navMenu.classList.toggle("active");
            document.body.classList.toggle("overflow-hidden"); // Lock body scroll when menu open
        });
    }

    // Mobile Mega Menu Toggle
    navItems.forEach(item => {
        const link = item.querySelector(".nav-link");
        const mega = item.querySelector(".mega-menu");
        
        if (mega && link) {
            link.addEventListener("click", (e) => {
                if (window.innerWidth <= 991) {
                    e.preventDefault();
                    item.classList.toggle("active-mobile");
                }
            });
        }
    });

    /*=========================================
    3. CUSTOM PREMIUM CURSOR
    =========================================*/
    const createCustomCursor = () => {
        // Prevent custom cursor on mobile/touch screens
        if ('ontouchstart' in window || navigator.maxTouchPoints > 0) return;

        const cursorDot = document.createElement("div");
        const cursorOutline = document.createElement("div");

        cursorDot.className = "cursor-dot";
        cursorOutline.className = "cursor-outline";

        document.body.appendChild(cursorDot);
        document.body.appendChild(cursorOutline);

        // Add Cursor Styles Dynamically
        const style = document.createElement("style");
        style.textContent = `
            .cursor-dot, .cursor-outline {
                position: fixed;
                top: 0;
                left: 0;
                transform: translate(-50%, -50%);
                border-radius: 50%;
                z-index: 99999;
                pointer-events: none;
                transition: opacity 0.3s ease, transform 0.1s ease;
                opacity: 0;
            }
            .cursor-dot {
                width: 8px;
                height: 8px;
                background-color: var(--primary);
            }
            .cursor-outline {
                width: 32px;
                height: 32px;
                border: 1.5px solid var(--secondary);
                transition: width 0.3s, height 0.3s, background-color 0.3s, border-color 0.3s, opacity 0.3s, transform 0.08s;
            }
            /* Hover States */
            .cursor-hover .cursor-dot {
                transform: translate(-50%, -50%) scale(1.5);
                background-color: var(--accent);
            }
            .cursor-hover .cursor-outline {
                width: 50px;
                height: 50px;
                border-color: var(--accent);
                background-color: rgba(245, 158, 11, 0.1);
            }
        `;
        document.head.appendChild(style);

        let mouseX = 0;
        let mouseY = 0;
        let outlineX = 0;
        let outlineY = 0;

        window.addEventListener("mousemove", (e) => {
            mouseX = e.clientX;
            mouseY = e.clientY;
            
            cursorDot.style.opacity = "1";
            cursorOutline.style.opacity = "1";
            
            cursorDot.style.left = `${mouseX}px`;
            cursorDot.style.top = `${mouseY}px`;
        });

        // Smooth outline tracking using requestAnimationFrame
        const animateOutline = () => {
            // Delay factor (0.15 = lag effect)
            outlineX += (mouseX - outlineX) * 0.15;
            outlineY += (mouseY - outlineY) * 0.15;

            cursorOutline.style.left = `${outlineX}px`;
            cursorOutline.style.top = `${outlineY}px`;

            requestAnimationFrame(animateOutline);
        };
        animateOutline();

        // Mouse leave window
        document.addEventListener("mouseleave", () => {
            cursorDot.style.opacity = "0";
            cursorOutline.style.opacity = "0";
        });

        // Clickable Hovers
        const clickables = document.querySelectorAll("a, button, select, input, textarea, .swiper-button-next, .swiper-button-prev, .hero-prev, .hero-next, .faq-header");
        clickables.forEach(item => {
            item.addEventListener("mouseenter", () => {
                document.body.classList.add("cursor-hover");
            });
            item.addEventListener("mouseleave", () => {
                document.body.classList.remove("cursor-hover");
            });
        });
    };
    createCustomCursor();

    /*=========================================
    4. SCROLL PROGRESS BAR
    =========================================*/
    const createScrollProgressBar = () => {
        const progressBar = document.createElement("div");
        progressBar.className = "scroll-progress-bar";
        document.body.appendChild(progressBar);

        const style = document.createElement("style");
        style.textContent = `
            .scroll-progress-bar {
                position: fixed;
                top: 0;
                left: 0;
                height: 3px;
                width: 0%;
                background: linear-gradient(90deg, var(--primary), var(--secondary));
                z-index: 99999;
                transition: width 0.1s ease;
            }
        `;
        document.head.appendChild(style);

        window.addEventListener("scroll", () => {
            const scrollTop = window.scrollY;
            const docHeight = document.documentElement.scrollHeight - window.innerHeight;
            const scrollPercent = (scrollTop / docHeight) * 100;
            progressBar.style.width = `${scrollPercent}%`;
        });
    };
    createScrollProgressBar();

    /*=========================================
    5. FLOATING WHATSAPP & SCROLL TO TOP BUTTON
    =========================================*/
    const createFloatingButtons = () => {
        // WhatsApp button
        const waBtn = document.createElement("a");
        waBtn.href = "https://wa.me/1234567890";
        waBtn.target = "_blank";
        waBtn.className = "floating-wa-btn";
        waBtn.innerHTML = `<i class="fa-brands fa-whatsapp"></i>`;
        
        // Scroll To Top button
        const scrollTopBtn = document.createElement("button");
        scrollTopBtn.className = "scroll-top-btn";
        scrollTopBtn.innerHTML = `<i class="fa-solid fa-arrow-up"></i>`;

        const container = document.createElement("div");
        container.className = "floating-actions-container";
        container.appendChild(scrollTopBtn);
        container.appendChild(waBtn);
        document.body.appendChild(container);

        const style = document.createElement("style");
        style.textContent = `
            .floating-actions-container {
                position: fixed;
                bottom: 30px;
                right: 30px;
                display: flex;
                flex-direction: column;
                gap: 15px;
                z-index: 9999;
            }
            .floating-wa-btn, .scroll-top-btn {
                width: 50px;
                height: 50px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                box-shadow: var(--shadow-md);
                transition: var(--transition);
                font-size: 22px;
                color: var(--white);
            }
            .floating-wa-btn {
                background: #25D366;
            }
            .floating-wa-btn:hover {
                transform: translateY(-5px) scale(1.05);
                box-shadow: 0 10px 20px rgba(37, 211, 102, 0.4);
                color: var(--white);
            }
            .scroll-top-btn {
                background: var(--dark-surface);
                border: 1px solid rgba(255, 255, 255, 0.1);
                opacity: 0;
                visibility: hidden;
                transform: translateY(20px);
            }
            .scroll-top-btn.visible {
                opacity: 1;
                visibility: visible;
                transform: translateY(0);
            }
            .scroll-top-btn:hover {
                background: var(--primary);
                transform: translateY(-5px);
                box-shadow: 0 10px 20px rgba(14, 165, 233, 0.4);
            }
            @media (max-width: 575px) {
                .floating-actions-container {
                    bottom: 20px;
                    right: 20px;
                }
            }
        `;
        document.head.appendChild(style);

        // Show/Hide Scroll to Top
        window.addEventListener("scroll", () => {
            if (window.scrollY > 400) {
                scrollTopBtn.classList.add("visible");
            } else {
                scrollTopBtn.classList.remove("visible");
            }
        });

        // Action Trigger
        scrollTopBtn.addEventListener("click", () => {
            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });
        });
    };
    createFloatingButtons();

    /*=========================================
    6. ANIMATED COUNTERS
    =========================================*/
    const initCounters = () => {
        const counters = document.querySelectorAll(".counter-value");
        if (counters.length === 0) return;

        const countSpeed = 200; // Alter duration speed

        const countUp = (counter) => {
            const target = +counter.getAttribute("data-target");
            let count = 0;
            const increment = target / countSpeed;

            const updateCount = () => {
                count += increment;
                if (count < target) {
                    counter.innerText = Math.ceil(count);
                    setTimeout(updateCount, 1);
                } else {
                    counter.innerText = target;
                }
            };
            updateCount();
        };

        const counterObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const counter = entry.target;
                    countUp(counter);
                    observer.unobserve(counter); // Trigger animation once
                }
            });
        }, { threshold: 0.5 });

        counters.forEach(counter => counterObserver.observe(counter));
    };
    initCounters();

});
