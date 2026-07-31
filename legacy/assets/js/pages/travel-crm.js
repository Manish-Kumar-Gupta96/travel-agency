document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".inquiry-item").forEach(item => {
        item.addEventListener("click", () => {
            alert("Demo Version: Inquiry details and communication log will be loaded after backend/API integration.");
        });
    });
    
    document.querySelectorAll(".followup-card tr").forEach((row, index) => {
        if(index === 0) return;
        row.addEventListener("click", () => {
            alert("Demo Version: Lead profile and task details will open after authentication.");
        });
    });

    if(typeof gsap !== "undefined") {
        gsap.from(".hero-content", {
            duration: 1,
            opacity: 0,
            y: 60
        });
        gsap.from(".crm-card", {
            duration: 0.7,
            opacity: 0,
            y: 40,
            stagger: 0.15,
            delay: 0.3
        });
        gsap.from(".pipeline-card", {
            duration: 0.8,
            opacity: 0,
            x: -50,
            delay: 0.6
        });
        gsap.from(".followup-card", {
            duration: 0.8,
            opacity: 0,
            x: 50,
            delay: 0.8
        });
        gsap.from(".inquiry-card", {
            duration: 0.8,
            opacity: 0,
            y: 40,
            delay: 1
        });
    }
});
