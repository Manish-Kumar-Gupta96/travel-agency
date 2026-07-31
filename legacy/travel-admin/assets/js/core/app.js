document.addEventListener("DOMContentLoaded", () => {
    if (typeof gsap !== "undefined") {
        gsap.from(".stat-card", {
            opacity: 0,
            y: 30,
            stagger: 0.05,
            duration: 0.5
        });
        gsap.from(".card", {
            opacity: 0,
            y: 30,
            duration: 0.5,
            delay: 0.2
        });
    }
});