<?php


namespace App\Controllers\admin;

use App\Models\Admin;


class AdminController {


    public function index() {
        $admins = Admin::getAll();
        require __DIR__ . '/../../../views/admin/index.php';

    }


}

//     // GET /admin - Display a list of admins
//     public function index() {
//         $admins = Admin::getAll();
//         require __DIR__ . '/../../../views/admin/index.php';
//     }

//     // GET /admin/create - Show the form for creating a new admin
//     public function create() {
//         require __DIR__ . '/../../../views/admin/create.php';
//     }

//     // POST /admin/store - Store a newly created admin in database
//    public function store() {
//     // We pass the whole $_POST array containing user and admin details
//     if (Admin::store($_POST)) {
//         // Success! Redirect to the list
//         header('Location: /royaltyv2/public/admin');
//         exit();
//     } else {
//         // Handle error (e.g., duplicate username or database issue)
//         echo "Failed to create admin. Username or Email might already be taken.";
//     }
// }

//     // GET /admin/show/{id} - Display a specific admin
//     public function show($id) {
//     $admin = Admin::find($id);

//     if (!$admin) {
//         // Handle the case where the admin doesn't exist
//         die("Administrator not found.");
//     }

//     require __DIR__ . '/../../../views/admin/show.php';
// }

//     // GET /admin/edit/{id} - Show the form for editing an admin
//     public function edit($id) {
//     $admin = Admin::find($id); // This uses the JOIN method we wrote for 'show'

//     if (!$admin) {
//         die("Administrator not found.");
//     }

//     require __DIR__ . '/../../../views/admin/edit.php';
// }

//     // POST /admin/update/{id} - Update the specified admin in database
//     public function update($id) {
//     if (Admin::update($id, $_POST)) {
//         header('Location: /royaltyv2/public/admin/show/' . $id);
//         exit();
//     } else {
//         echo "Update failed. The email might already be taken by another user.";
//     }
// }

//     // POST /admin/destroy/{id} - Remove the specified admin from database
//     public function destroy($id) {
//     if (Admin::delete($id)) {
//         // Successfully deleted
//         header('Location: /royaltyv2/public/admin');
//         exit();
//     } else {
//         echo "Error: Could not delete the administrator.";
//     }
// }
