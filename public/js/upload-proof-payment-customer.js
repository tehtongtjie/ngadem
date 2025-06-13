document.addEventListener("DOMContentLoaded", function () {
    const dropZone = document.getElementById("drop-zone");
    const fileInput = document.getElementById("bukti_pembayaran");
    const preview = document.getElementById("preview");
    const previewImage = document.getElementById("preview-image");
    const removePreview = document.getElementById("remove-preview");
    const submitButton = document.getElementById("submit-button");
    const form = document.getElementById("upload-form");

    // Handle file selection and drag-and-drop
    function handleFile(file) {
        if (!file.type.startsWith("image/")) {
            alert(
                "Hanya file gambar yang diperbolehkan (JPG, PNG, JPEG, GIF, SVG)."
            );
            return;
        }
        if (file.size > 2 * 1024 * 1024) {
            alert("Ukuran file maksimum adalah 2MB.");
            return;
        }
        const reader = new FileReader();
        reader.onload = function (e) {
            preview.classList.remove("hidden");
            previewImage.src = e.target.result;
        };
        reader.readAsDataURL(file);
    }

    fileInput.addEventListener("change", function () {
        if (this.files.length > 0) {
            handleFile(this.files[0]);
        }
    });

    dropZone.addEventListener("dragover", function (e) {
        e.preventDefault();
        this.classList.add("border-yellow-500", "bg-yellow-50");
    });

    dropZone.addEventListener("dragleave", function () {
        this.classList.remove("border-yellow-500", "bg-yellow-50");
    });

    dropZone.addEventListener("drop", function (e) {
        e.preventDefault();
        this.classList.remove("border-yellow-500", "bg-yellow-50");
        const file = e.dataTransfer.files[0];
        handleFile(file);
        fileInput.files = e.dataTransfer.files;
    });

    // Remove preview
    removePreview.addEventListener("click", function () {
        preview.classList.add("hidden");
        previewImage.src = "";
        fileInput.value = "";
    });

    // Disable submit button during submission
    form.addEventListener("submit", function () {
        submitButton.disabled = true;
        submitButton.innerHTML =
            '<i class="fas fa-spinner fa-spin mr-2"></i> Mengunggah...';
    });
});
