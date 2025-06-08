document.addEventListener("DOMContentLoaded", function () {
    const mobileMenuButton = document.getElementById("mobile-menu-button");
    const mobileMenuCloseButton = document.getElementById(
        "mobile-menu-close-button"
    );
    const mobileNav = document.getElementById("mobile-nav");
    const mainHeader = document.getElementById("main-header");
    const headerLogoImg = document.getElementById("header-logo-img");
    const headerLogoText = document.getElementById("header-logo-text");

    // --- JavaScript untuk Dropdown Profil ---
    const profileDropdownButton = document.getElementById(
        "profile-dropdown-button"
    );
    const profileDropdownMenu = document.getElementById(
        "profile-dropdown-menu"
    );
    const profileDropdownArrow = document.getElementById(
        "profile-dropdown-arrow"
    ); // Menambahkan panah

    if (profileDropdownButton && profileDropdownMenu) {
        let dropdownTimeout;

        const showDropdown = () => {
            clearTimeout(dropdownTimeout);
            profileDropdownMenu.classList.remove(
                "opacity-0",
                "invisible",
                "scale-95"
            );
            profileDropdownMenu.classList.add(
                "opacity-100",
                "visible",
                "scale-100"
            );
            if (profileDropdownArrow)
                profileDropdownArrow.classList.add("rotate-180");
        };

        const hideDropdown = () => {
            dropdownTimeout = setTimeout(() => {
                profileDropdownMenu.classList.remove(
                    "opacity-100",
                    "visible",
                    "scale-100"
                );
                profileDropdownMenu.classList.add(
                    "opacity-0",
                    "invisible",
                    "scale-95"
                );
                if (profileDropdownArrow)
                    profileDropdownArrow.classList.remove("rotate-180");
            }, 100);
        };

        profileDropdownButton.addEventListener("click", (event) => {
            event.stopPropagation();
            if (profileDropdownMenu.classList.contains("invisible")) {
                showDropdown();
            } else {
                hideDropdown();
            }
        });

        profileDropdownButton.addEventListener("mouseenter", showDropdown);
        profileDropdownMenu.addEventListener("mouseenter", showDropdown);

        profileDropdownButton.addEventListener("mouseleave", hideDropdown);
        profileDropdownMenu.addEventListener("mouseleave", hideDropdown);

        document.addEventListener("click", (event) => {
            if (
                !profileDropdownButton.contains(event.target) &&
                !profileDropdownMenu.contains(event.target)
            ) {
                hideDropdown();
            }
        });
    }

    const toggleMobileMenu = (open) => {
        if (!mobileNav) return;
        if (open) {
            mobileNav.classList.remove(
                "hidden",
                "opacity-0",
                "pointer-events-none"
            );
            mobileNav.classList.add("opacity-100", "pointer-events-auto");
            document.body.style.overflow = "hidden";
        } else {
            mobileNav.classList.remove("opacity-100", "pointer-events-auto");
            mobileNav.classList.add("opacity-0", "pointer-events-none");
            mobileNav.addEventListener(
                "transitionend",
                function handler() {
                    mobileNav.classList.add("hidden");
                    document.body.style.overflow = "";
                    mobileNav.removeEventListener("transitionend", handler);
                },
                {
                    once: true,
                }
            );
        }
    };

    if (mobileMenuButton) {
        mobileMenuButton.addEventListener("click", () =>
            toggleMobileMenu(true)
        );
    }
    if (mobileMenuCloseButton) {
        mobileMenuCloseButton.addEventListener("click", () =>
            toggleMobileMenu(false)
        );
    }

    if (mobileNav) {
        mobileNav
            .querySelectorAll('a, button[type="submit"]')
            .forEach((item) => {
                item.addEventListener("click", () => toggleMobileMenu(false));
            });
    }

    const handleScroll = () => {
        if (window.scrollY > 50) {
            mainHeader.classList.add("bg-white", "py-3", "shadow-xl");
            mainHeader.classList.remove("bg-transparent", "py-4", "shadow-lg");
            if (headerLogoImg) {
                headerLogoImg.classList.add("h-10");
                headerLogoImg.classList.remove("h-12");
            }
            if (headerLogoText) {
                headerLogoText.classList.add("text-2xl");
                headerLogoText.classList.remove("text-3xl");
            }
        } else {
            mainHeader.classList.remove("bg-white", "py-3", "shadow-xl");
            mainHeader.classList.add("bg-transparent", "py-4", "shadow-lg");
            if (headerLogoImg) {
                headerLogoImg.classList.remove("h-10");
                headerLogoImg.classList.add("h-12");
            }
            if (headerLogoText) {
                headerLogoText.classList.remove("text-2xl");
                headerLogoText.classList.add("text-3xl");
            }
        }
    };

    window.addEventListener("scroll", handleScroll);

    const handleResize = () => {
        if (window.innerWidth >= 1024) {
            const headerNavLinks = document.getElementById("header-nav-links");
            if (headerNavLinks) {
                headerNavLinks.classList.remove("hidden");
                headerNavLinks.classList.add("flex");
            }
            if (mobileNav) {
                toggleMobileMenu(false);
            }
        } else {
            const headerNavLinks = document.getElementById("header-nav-links");
            if (headerNavLinks) {
                headerNavLinks.classList.remove("flex");
                headerNavLinks.classList.add("hidden");
            }
        }
    };

    window.addEventListener("resize", handleResize);

    document.addEventListener("DOMContentLoaded", function () {
        handleScroll();
        handleResize();
    });
});
