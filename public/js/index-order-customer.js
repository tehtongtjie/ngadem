document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("search-orders");
    const filterStatus = document.getElementById("filter-status");
    const rows = document.querySelectorAll("tbody tr");
    const cards = document.querySelectorAll(".lg\\:hidden .space-y-4 > div");

    function filterOrders() {
        const searchTerm = searchInput.value.toLowerCase();
        const statusFilter = filterStatus.value;

        rows.forEach((row) => {
            const id = row.cells[0].textContent.toLowerCase();
            const service = row.cells[1].textContent.toLowerCase();
            const status = row.cells[3].textContent
                .toLowerCase()
                .replace(" ", "_");
            const matchesSearch =
                id.includes(searchTerm) || service.includes(searchTerm);
            const matchesStatus = !statusFilter || status === statusFilter;
            row.style.display = matchesSearch && matchesStatus ? "" : "none";
        });

        cards.forEach((card) => {
            const id = card.querySelector("h3").textContent.toLowerCase();
            const service = card
                .querySelector("p:nth-child(2)")
                .textContent.toLowerCase();
            const status = card
                .querySelector("span")
                .textContent.toLowerCase()
                .replace(" ", "_");
            const matchesSearch =
                id.includes(searchTerm) || service.includes(searchTerm);
            const matchesStatus = !statusFilter || status === statusFilter;
            card.style.display = matchesSearch && matchesStatus ? "" : "none";
        });
    }

    searchInput.addEventListener("input", filterOrders);
    filterStatus.addEventListener("change", filterOrders);
});
