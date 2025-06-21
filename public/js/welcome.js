document.addEventListener("DOMContentLoaded", function () {
    // Navbar Scroll Behavior
    const navbar = document.getElementById("navbar");
    window.addEventListener("scroll", function () {
        if (window.scrollY > 50) {
            navbar.classList.add("scrolled");
        } else {
            navbar.classList.remove("scrolled");
        }
    });

    // Mobile Menu Toggle
    const mobileMenuBtn = document.getElementById("mobile-menu-btn");
    const mobileMenu = document.getElementById("mobile-menu");
    const mobileMenuClose = document.getElementById("mobile-menu-close");
    const mobileLinks = document.querySelectorAll("#mobile-menu a");

    // Buka menu saat tombol hamburger diklik
    mobileMenuBtn.addEventListener("click", function () {
        mobileMenu.classList.add("open");
    });

    // Tutup menu saat tombol close diklik
    mobileMenuClose.addEventListener("click", function () {
        mobileMenu.classList.remove("open");
    });

    // Tutup menu saat salah satu link diklik
    mobileLinks.forEach((link) => {
        link.addEventListener("click", function () {
            mobileMenu.classList.remove("open");
        });
    });

    // Testimonial Slider
    const testimonialTrack = document.getElementById("testimonial-track");
    const testimonialPrev = document.getElementById("testimonial-prev");
    const testimonialNext = document.getElementById("testimonial-next");
    const testimonialDots = document.querySelectorAll(".testimonial-dot");
    let currentTestimonial = 0;
    const totalTestimonials = testimonialDots.length;

    // Update tampilan testimonial
    function updateTestimonial() {
        testimonialTrack.style.transform = `translateX(-${
            currentTestimonial * 100
        }%)`;
        testimonialDots.forEach((dot, index) => {
            dot.classList.toggle("bg-orange-500", index === currentTestimonial);
            dot.classList.toggle("bg-gray-300", index !== currentTestimonial);
        });
    }

    // Navigasi next testimonial
    testimonialNext.addEventListener("click", function () {
        currentTestimonial = (currentTestimonial + 1) % totalTestimonials;
        updateTestimonial();
    });

    // Navigasi prev testimonial
    testimonialPrev.addEventListener("click", function () {
        currentTestimonial =
            (currentTestimonial - 1 + totalTestimonials) % totalTestimonials;
        updateTestimonial();
    });

    // Klik pada dot untuk memilih testimonial
    testimonialDots.forEach((dot, index) => {
        dot.addEventListener("click", function () {
            currentTestimonial = index;
            updateTestimonial();
        });
    });

    // Auto-slide testimonial setiap 5 detik
    setInterval(function () {
        currentTestimonial = (currentTestimonial + 1) % totalTestimonials;
        updateTestimonial();
    }, 5000);

    // Lightbox Gallery
    const lightbox = document.getElementById("lightbox");
    const lightboxImg = document.getElementById("lightbox-img");
    const lightboxClose = document.getElementById("lightbox-close");
    const galleryItems = document.querySelectorAll(".gallery-item");

    // Tampilkan gambar di lightbox saat gambar diklik
    galleryItems.forEach((item) => {
        item.addEventListener("click", function () {
            lightboxImg.src = this.dataset.src;
            lightbox.classList.add("active");
        });
    });

    // Tutup lightbox saat tombol close diklik
    lightboxClose.addEventListener("click", function () {
        lightbox.classList.remove("active");
    });

    // Tutup lightbox saat klik di luar gambar
    lightbox.addEventListener("click", function (e) {
        if (e.target === lightbox) {
            lightbox.classList.remove("active");
        }
    });

    // Smooth Scrolling Anchor
    document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
        anchor.addEventListener("click", function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute("href"));
            if (target) {
                target.scrollIntoView({ behavior: "smooth" });
            }
        });
    });
});
