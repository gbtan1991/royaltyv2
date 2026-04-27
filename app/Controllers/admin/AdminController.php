<?php


namespace App\Controllers\admin;

use App\Models\Admin;
use App\Models\BaseModel;
use App\Models\User;
use Exception;


class AdminController
{


    public function index()
    {
        // Fetch admins joined with their user data
        $admins = Admin::adminWithUsers();

        // Load the view you just built
        return view('admin/index', ['admins' => $admins]);
    }


    public function create()
    {
        $roles = ['Staff', 'Manager', 'SuperAdmin']; // Example roles
        return view('admin/create', ['roles' => $roles]);
    }

    public function store()
    {

        if (!empty($_POST['password'])) {
            $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
        }
        try {
            // We use the BaseModel transaction() to wrap both insert()
            BaseModel::transaction(function () {
                $userId = User::insert($_POST);

                $adminData = $_POST;
                $adminData['user_id'] = $userId; // Link the admin to the user
                Admin::insert($adminData);
            });
            redirect('admin');

        } catch (Exception $e) {
            // Handle any errors that occurred during the transaction
            echo "Error creating admin: " . $e->getMessage();
        }


    }

    public function show($id)
    {
        // Fetch combined data from the Model
        $admin = Admin::findWithUser($id);

        // If no admin is found (e.g., someone types a random ID in the URL)
        if (!$admin) {
            return redirect('admin?error=not_found');
        }

        // Pass the $admin array to your show.php view
        return view('admin/show', ['admin' => $admin]);
    }

}


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
