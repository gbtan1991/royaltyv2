const CustomerModule = {
    init: function () {
        this.bindEvents();
    },

    bindEvents: function () {
        let searchInput = document.getElementById("search-customer");
        if (searchInput) {
            searchInput.addEventListener("keyup", () => {
                this.searchCustomers();
            });
            // Also bind frontend filter on input to cover instant filtering
            searchInput.addEventListener("input", () => {
                this.filterTable();
            });
        }
    },

    searchCustomers: function () {
        let query = document.getElementById("search-customer").value.trim();

        if (query.length === 0) {
            // If empty search, reload full table via AJAX or optionally do nothing
            this.loadAllCustomers();
            return;
        }

        let xhr = new XMLHttpRequest();
        xhr.open("GET", "controllers/customer/search_customer.php?search=" + encodeURIComponent(query), true);

        xhr.onload = () => {
            if (xhr.status === 200) {
                const customerTableBody = document.getElementById("customer-table-body");
                customerTableBody.innerHTML = xhr.responseText;
            } else {
                console.error("AJAX Error. Status:", xhr.status);
            }
        };

        xhr.onerror = () => {
            console.error("Network Error!");
        };

        xhr.send();
    },

    loadAllCustomers: function () {
        // Optional: You can implement AJAX call to reload full customer list
        // or simply do nothing to keep current rows.
        // For example:
        // let xhr = new XMLHttpRequest();
        // xhr.open("GET", "controllers/customer/customer_list.php", true);
        // xhr.onload = () => { ... }
        // xhr.send();

        // For now, just show all rows if AJAX is not used:
        this.filterTable(""); // Show all rows
    },

    filterTable: function () {
        const searchInput = document.getElementById("search-customer");
        if (!searchInput) return;

        const query = searchInput.value.toLowerCase();
        const tableBody = document.getElementById("customer-table-body");
        if (!tableBody) return;

        const rows = Array.from(tableBody.querySelectorAll("tr"));
        rows.forEach(row => {
            const rowText = row.innerText.toLowerCase();
            row.style.display = rowText.includes(query) ? "" : "none";
        });
    }
};

// Initialize after DOM is fully loaded
document.addEventListener("DOMContentLoaded", () => {
    CustomerModule.init();
});
