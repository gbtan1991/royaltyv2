const CustomerModule = {
    init: function () {
        this.bindEvents();
    },

    bindEvents: function () {
        let searchInput = document.getElementById("search-customer");
        if (searchInput) {
            searchInput.addEventListener("keyup", (event) => {
                this.searchCustomers();
            });
        }
    },

    searchCustomers: function () {
        let query = document.getElementById("search-customer").value;

        let xhr = new XMLHttpRequest();
        xhr.open("GET", "../../controllers/customer/search_customer.php?search=" + encodeURIComponent(query), true);

        xhr.onload = function () {
            if (this.status == 200) {
                document.getElementById("customer-table-body").innerHTML = this.responseText;
            } else {
                console.error("AJAX Error. Status:", xhr.status);
            }
        };

        xhr.onerror = function () {
            console.error("Network Error!");
        };

        xhr.send();
    },
};

// Ensure the script runs only after the page loads
document.addEventListener("DOMContentLoaded", function () {
    CustomerModule.init();
});



document.addEventListener("DOMContentLoaded", function () {
    const rowsPerPage = 10;
    const tableBody = document.getElementById("customer-table-body");
    const rows = Array.from(tableBody.querySelectorAll("tr"));
    const pagination = document.getElementById("pagination-controls");

    function renderPage(page) {
        const start = (page - 1) * rowsPerPage;
        const end = start + rowsPerPage;

        rows.forEach((row, index) => {
            row.style.display = index >= start && index < end ? "" : "none";
        });

        renderPaginationControls(page);
    }

    function renderPaginationControls(currentPage) {
        const totalPages = Math.ceil(rows.length / rowsPerPage);
        pagination.innerHTML = "";

        for (let i = 1; i <= totalPages; i++) {
            const btn = document.createElement("button");
            btn.textContent = i;
            btn.classList.add("pagination-btn");
            if (i === currentPage) btn.style.fontWeight = "bold";
            btn.addEventListener("click", () => renderPage(i));
            pagination.appendChild(btn);
        }
    }

    renderPage(1);
});
