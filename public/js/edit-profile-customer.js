document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("profile-form");
    const submitButton = document.getElementById("submit-button");
    // Toggle password visibility
    document.querySelectorAll(".toggle-password").forEach((button) => {
        button.addEventListener("click", function () {
            const targetId = this.getAttribute("data-target");
            const input = document.getElementById(targetId);
            const icon = this.querySelector("i");
            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                input.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        });
    });

    // Disable submit button during submission
    form.addEventListener("submit", () => {
        submitButton.disabled = true;
        submitButton.innerHTML =
            '<i class="fas fa-spinner fa-spin mr-2"></i> Menyimpan...';
    });

    // Client-side phone validation
    const phoneInput = document.getElementById("phone");
    phoneInput.addEventListener("input", function () {
        const phonePattern = /^(\+62|0)[0-9]{9,12}$/;
        if (this.value && !phonePattern.test(this.value)) {
            this.setCustomValidity(
                "Nomor telepon harus dalam format Indonesia, contoh: +6281234567890 atau 081234567890"
            );
        } else {
            this.setCustomValidity("");
        }
    });
});
