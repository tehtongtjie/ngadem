document.addEventListener("DOMContentLoaded", function () {
    const serviceSelect = document.getElementById("service_id");
    const pricePreview = document.getElementById("price-preview");
    const submitButton = document.getElementById("submit-button");
    const form = document.getElementById("order-form");

    // Update price preview on service selection
    function updatePricePreview() {
        const selectedOption =
            serviceSelect.options[serviceSelect.selectedIndex];
        const price = selectedOption
            ? selectedOption.getAttribute("data-price")
            : 0;
        pricePreview.textContent = price
            ? `Rp${Number(price).toLocaleString("id-ID")}`
            : "Rp0";
    }

    // Disable submit button during submission
    form.addEventListener("submit", function () {
        submitButton.disabled = true;
        submitButton.innerHTML =
            '<i class="fas fa-spinner fa-spin mr-2"></i> Memproses...';
    });

    // Initialize price preview
    updatePricePreview();
    serviceSelect.addEventListener("change", updatePricePreview);

    // Validate date to prevent past dates
    const dateInput = document.getElementById("tanggal_service_diharapkan");
    dateInput.addEventListener("change", function () {
        const selectedDate = new Date(this.value);
        const today = new Date();
        today.setHours(0, 0, 0, 0);
        if (selectedDate < today) {
            this.value = "";
            alert("Tanggal service tidak boleh sebelum hari ini.");
        }
    });
});
