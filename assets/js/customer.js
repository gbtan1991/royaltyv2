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
