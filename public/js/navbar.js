// Fallback script for navbar functionality if navbar.js fails
document.addEventListener("DOMContentLoaded", () => {
    const mobileMenuButton = document.getElementById("mobile-menu-button");
    const mobileMenuCloseButton = document.getElementById(
        "mobile-menu-close-button"
    );
    const mobileNav = document.getElementById("mobile-nav");
    const profileDropdownButton = document.getElementById(
        "profile-dropdown-button"
    );
    const profileDropdownMenu = document.getElementById(
        "profile-dropdown-menu"
    );

    // Toggle mobile menu
    mobileMenuButton.addEventListener("click", () => {
        mobileNav.classList.toggle("show");
        mobileMenuButton.setAttribute(
            "aria-expanded",
            mobileNav.classList.contains("show")
        );
    });

    mobileMenuCloseButton.addEventListener("click", () => {
        mobileNav.classList.remove("show");
        mobileMenuButton.setAttribute("aria-expanded", "false");
    });

    // Close mobile menu when clicking outside
    document.addEventListener("click", (e) => {
        if (
            !mobileNav.contains(e.target) &&
            !mobileMenuButton.contains(e.target)
        ) {
            mobileNav.classList.remove("show");
            mobileMenuButton.setAttribute("aria-expanded", "false");
        }
    });

    // Toggle profile dropdown
    profileDropdownButton.addEventListener("click", () => {
        profileDropdownMenu.classList.toggle("show");
        profileDropdownButton.setAttribute(
            "aria-expanded",
            profileDropdownMenu.classList.contains("show")
        );
    });

    // Close dropdown when clicking outside
    document.addEventListener("click", (e) => {
        if (
            !profileDropdownButton.contains(e.target) &&
            !profileDropdownMenu.contains(e.target)
        ) {
            profileDropdownMenu.classList.remove("show");
            profileDropdownButton.setAttribute("aria-expanded", "false");
        }
    });

    // Keyboard accessibility for dropdown
    profileDropdownButton.addEventListener("keydown", (e) => {
        if (e.key === "Enter" || e.key === " ") {
            e.preventDefault();
            profileDropdownMenu.classList.toggle("show");
            profileDropdownButton.setAttribute(
                "aria-expanded",
                profileDropdownMenu.classList.contains("show")
            );
        }
    });

    // Focus management for dropdown items
    const dropdownItems =
        profileDropdownMenu.querySelectorAll('[role="menuitem"]');
    dropdownItems.forEach((item, index) => {
        item.addEventListener("keydown", (e) => {
            if (e.key === "ArrowDown") {
                e.preventDefault();
                dropdownItems[(index + 1) % dropdownItems.length].focus();
            } else if (e.key === "ArrowUp") {
                e.preventDefault();
                dropdownItems[
                    (index - 1 + dropdownItems.length) % dropdownItems.length
                ].focus();
            } else if (e.key === "Escape") {
                profileDropdownMenu.classList.remove("show");
                profileDropdownButton.setAttribute("aria-expanded", "false");
                profileDropdownButton.focus();
            }
        });
    });
});
