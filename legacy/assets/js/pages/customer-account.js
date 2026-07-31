document.addEventListener("DOMContentLoaded", () => {
    // Tab active switcher
    document.querySelectorAll(".account-sidebar li").forEach(item => {
        item.addEventListener("click", () => {
            document.querySelectorAll(".account-sidebar li").forEach(li => li.classList.remove("active"));
            item.classList.add("active");
            alert(item.textContent.trim() + " section selected. Active profile details updated.");
        });
    });

    // Profile form submit demo
    const profileForm = document.querySelector(".profile-card form");
    if (profileForm) {
        profileForm.addEventListener("submit", (e) => {
            e.preventDefault();
            alert("Demo Profile Updated Successfully!");
        });
    }

    // GSAP animations if present
    if (typeof gsap !== "undefined") {
        gsap.from(".account-sidebar", {
            x: -50,
            opacity: 0,
            duration: 0.8
        });
        gsap.from(".account-stats div", {
            y: 40,
            opacity: 0,
            stagger: 0.15,
            duration: 0.7,
            delay: 0.2
        });
        gsap.from(".booking-card, .profile-card, .wishlist-card", {
            y: 40,
            opacity: 0,
            stagger: 0.2,
            duration: 0.8,
            delay: 0.4
        });
    }
});
