const AdminModule = {
    init: function () {
        this.bindEvents();
    },

    bindEvents: function () {
        let searchInput = document.getElementById("search-admin");
        if (searchInput) {
            searchInput.addEventListener("keyup", (event) => {
                this.searchAdmins();
            });
        }
    },

    searchAdmins: function () {
        let query = document.getElementById("search-admin").value;

        let xhr = new XMLHttpRequest();
        xhr.open("GET", "../../controllers/admin/search_admin.php?search=" + encodeURIComponent(query), true);
       
        xhr.onload = function () {
            if (this.status == 200) {
                document.getElementById("admin-table-body").innerHTML = this.responseText;
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
    AdminModule.init();
});