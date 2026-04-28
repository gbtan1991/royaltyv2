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

    public function edit($id)
    {
        // Fetch combined data from the Model
        $admin = Admin::findWithUser($id);

        // If no admin is found (e.g., someone types a random ID in the URL)
        if (!$admin) {
            return redirect('admin?error=not_found');
        }

        return view('admin/edit', ['admin' => $admin]);

    }

    public function update($id)
    {
        try {
            BaseModel::transaction(function () use ($id) {
                // 1. Get the admin to find the linked user_id
                $admin = Admin::find($id);
                $userId = $admin['user_id'];

                // 2. Update the User table (first_name, last_name, email)
                User::update($userId, $_POST);

                // 3. Update the Admin table (role/access_level, is_active)
                // Note: Since your form uses 'role', we map it to 'access_level'
                $adminData = $_POST;
                $adminData['access_level'] = $_POST['role'];

                Admin::update($id, $adminData);
            });

            return redirect('admin?success=updated');
        } catch (Exception $e) {
            die("Update failed: " . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            // Use our transaction to ensure the delete happens cleanly
            BaseModel::transaction(function () use ($id) {
                Admin::delete($id);
            });

            return redirect('admin?success=deleted');
        } catch (Exception $e) {
            die("Delete failed: " . $e->getMessage());
        }
    }
}


