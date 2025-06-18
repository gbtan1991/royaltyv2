const ClaimModule = {
    rowsPerPage: 17,
    currentPage: 1,

    init: function () {
        this.bindEvents();
        this.setupPagination(); // Initialize pagination on load
    },

    bindEvents: function () {
        const searchInput = document.getElementById("search-claim");
        if (searchInput) {
            searchInput.addEventListener("input", () => {
                this.filterTable();
                this.setupPagination(); // Re-render pagination after filtering
            });
        }
    },

    filterTable: function () {
        const query = document.getElementById("search-claim").value.toLowerCase();
        const tableBody = document.getElementById("claim-table-body");
        const rows = Array.from(tableBody.querySelectorAll("tr"));

        rows.forEach(row => {
            const rowText = row.innerText.toLowerCase();
            row.style.display = rowText.includes(query) ? "" : "none";
        });

        this.currentPage = 1; // Reset to first page after search
    },

    setupPagination: function () {
        const tableBody = document.getElementById("claim-table-body");
        const allRows = Array.from(tableBody.querySelectorAll("tr")).filter(row => row.style.display !== "none");
        const totalRows = allRows.length;
        const totalPages = Math.ceil(totalRows / this.rowsPerPage);
        const paginationContainer = document.getElementById("pagination-controls");

        paginationContainer.innerHTML = ""; // Clear existing buttons

        if (totalPages <= 1) {
            this.showPage(allRows); // Show all if only 1 page
            return;
        }

        this.showPage(allRows); // Display current page rows

        for (let i = 1; i <= totalPages; i++) {
            const button = document.createElement("button");
            button.textContent = i;
            button.className = "pagination-button";
            if (i === this.currentPage) button.classList.add("active");

            button.addEventListener("click", () => {
                this.currentPage = i;
                this.showPage(allRows);
                this.updatePaginationButtons(); // Just update button state
            });

            paginationContainer.appendChild(button);
        }
    },

    updatePaginationButtons: function () {
        const buttons = document.querySelectorAll("#pagination-controls .pagination-button");
        buttons.forEach((btn, index) => {
            if ((index + 1) === this.currentPage) {
                btn.classList.add("active");
            } else {
                btn.classList.remove("active");
            }
        });
    },

    showPage: function (visibleRows) {
        const start = (this.currentPage - 1) * this.rowsPerPage;
        const end = this.currentPage * this.rowsPerPage;

        visibleRows.forEach((row, index) => {
            row.style.display = (index >= start && index < end) ? "" : "none";
        });
    }
};

// Initialize after DOM is fully loaded
document.addEventListener("DOMContentLoaded", () => {
    ClaimModule.init();
});
