const mobileMenuButton = document.getElementById("mobile-menu-button");
const mobileMenuCloseButton = document.getElementById(
    "mobile-menu-close-button"
);
const mobileNav = document.getElementById("mobile-nav");
const navbar = document.querySelector(".navbar");

// Toggle mobile menu
function toggleMobileMenu() {
    const isOpen = mobileNav.classList.contains("mobile-nav-enter-active");
    mobileNav.classList.toggle("mobile-nav-enter", !isOpen);
    mobileNav.classList.toggle("mobile-nav-enter-active", !isOpen);
    mobileMenuButton.setAttribute("aria-expanded", !isOpen);
}

// Close mobile menu
function closeMobileMenu() {
    mobileNav.classList.remove("mobile-nav-enter-active");
    mobileNav.classList.add("mobile-nav-exit-active");
    setTimeout(() => {
        mobileNav.classList.remove("mobile-nav-exit-active");
        mobileNav.classList.add("mobile-nav-enter");
        mobileMenuButton.setAttribute("aria-expanded", "false");
    }, 300);
}

// Event listeners
mobileMenuButton.addEventListener("click", toggleMobileMenu);
mobileMenuCloseButton.addEventListener("click", closeMobileMenu);

// Navbar scroll effect
window.addEventListener("scroll", () => {
    navbar.classList.toggle("scrolled", window.scrollY > 50);
});

// Close mobile menu on link click
mobileNav.querySelectorAll("a").forEach((link) => {
    link.addEventListener("click", closeMobileMenu);
});
