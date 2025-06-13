document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("search-payments");
    const filterStatus = document.getElementById("filter-status");
    const rows = document.querySelectorAll("#payments-table tbody tr");
    const cards = document.querySelectorAll(".lg\\:hidden .space-y-4 > div");
    const headers = document.querySelectorAll("#payments-table th[data-sort]");
    let sortDirection = {};

    // Filter function
    function filterPayments() {
        const searchTerm = searchInput.value.toLowerCase();
        const statusFilter = filterStatus.value.toLowerCase();

        rows.forEach((row) => {
            const id = row.cells[0].textContent.toLowerCase();
            const orderId = row.cells[1].textContent.toLowerCase();
            const status = row.cells[4].textContent.toLowerCase();
            const matchesSearch =
                id.includes(searchTerm) || orderId.includes(searchTerm);
            const matchesStatus = !statusFilter || status === statusFilter;
            row.style.display = matchesSearch && matchesStatus ? "" : "none";
        });

        cards.forEach((card) => {
            const id = card.querySelector("h3").textContent.toLowerCase();
            const orderId = card
                .querySelector("p:nth-child(2)")
                .textContent.toLowerCase();
            const status = card.querySelector("span").textContent.toLowerCase();
            const matchesSearch =
                id.includes(searchTerm) || orderId.includes(searchTerm);
            const matchesStatus = !statusFilter || status === statusFilter;
            card.style.display = matchesSearch && matchesStatus ? "" : "none";
        });
    }

    // Sort function
    function sortTable(column, direction) {
        const tbody = document.querySelector("#payments-table tbody");
        const rowsArray = Array.from(rows);

        rowsArray.sort((a, b) => {
            let aValue, bValue;
            if (column === "jumlah_bayar") {
                aValue = parseFloat(a.cells[2].getAttribute("data-amount"));
                bValue = parseFloat(b.cells[2].getAttribute("data-amount"));
            } else if (column === "tanggal_pembayaran") {
                aValue = new Date(a.cells[5].getAttribute("data-date"));
                bValue = new Date(b.cells[5].getAttribute("data-date"));
            } else {
                aValue =
                    a.cells[column === "id" ? 0 : 1].textContent.toLowerCase();
                bValue =
                    b.cells[column === "id" ? 0 : 1].textContent.toLowerCase();
            }

            if (aValue < bValue) return direction === "asc" ? -1 : 1;
            if (aValue > bValue) return direction === "asc" ? 1 : -1;
            return 0;
        });

        tbody.innerHTML = "";
        rowsArray.forEach((row) => tbody.appendChild(row));
    }

    // Handle header click for sorting
    headers.forEach((header) => {
        header.addEventListener("click", function () {
            const column = this.getAttribute("data-sort");
            sortDirection[column] =
                sortDirection[column] === "asc" ? "desc" : "asc";
            sortTable(column, sortDirection[column]);

            // Update sort icons
            headers.forEach(
                (h) =>
                    (h.querySelector("i").className =
                        "fas fa-sort text-gray-400")
            );
            this.querySelector("i").className = `fas fa-sort-${
                sortDirection[column] === "asc" ? "up" : "down"
            }`;
        });
    });

    // Attach event listeners
    searchInput.addEventListener("input", filterPayments);
    filterStatus.addEventListener("change", filterPayments);
});
