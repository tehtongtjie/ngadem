document.addEventListener("DOMContentLoaded", function () {
    const paymentProof = document.getElementById("payment-proof");
    if (paymentProof) {
        paymentProof.addEventListener("click", function () {
            const modal = document.createElement("div");
            modal.className =
                "fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50";
            modal.innerHTML = `
                            <div class="relative max-w-3xl w-full">
                                <img src="${this.src}" alt="Bukti Pembayaran" class="w-full h-auto rounded-lg">
                                <button class="absolute top-2 right-2 text-white bg-red-500 rounded-full p-2 hover:bg-red-600 transition duration-300">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        `;
            document.body.appendChild(modal);
            modal
                .querySelector("button")
                .addEventListener("click", () => modal.remove());
            modal.addEventListener("click", (e) => {
                if (e.target === modal) modal.remove();
            });
        });
    }
});
