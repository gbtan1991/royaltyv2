const TransactionModule = {
    init: function () {
        this.bindEvents();
    },

    bindEvents: function () {
        let form = document.getElementById("transaction-form");
        if (form) {
            form.addEventListener("submit", (event) => {
                event.preventDefault();
                this.addTransaction();
            });
        }
    },

    addTransaction: function () {
        let customer_id = document.getElementById("customer_id").value;
        let total_amount = document.getElementById("total_amount").value;

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "../../controllers/transaction/add_transaction.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onload = function () {
            if (this.status == 200) {
                let response = JSON.parse(this.responseText);
                alert(response.message);
                if (response.success) {
                    location.reload();
                }
            } else {
                console.error("AJAX Error: " + xhr.status);
            }
        };

        xhr.onerror = function () {
            console.error("Network Error!");
        };

        xhr.send(`customer_id=${encodeURIComponent(customer_id)}&total_amount=${encodeURIComponent(total_amount)}`);
    },
};

document.addEventListener("DOMContentLoaded", function () {
    TransactionModule.init();
});
