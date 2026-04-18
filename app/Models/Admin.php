<?php

namespace App\Models;

use App\Core\Database;
use App\Models\User;
use Exception;
use PDO;

class Admin
{

    // index: Get all admins with user details
    public static function getAll()
    {
        $db = Database::getConnection();

        $query = "SELECT 
                a.id, 
                a.role, 
                a.is_active, 
                a.last_login,
                u.first_name, 
                u.last_name, 
                u.username, 
                u.email
              FROM admins a
              JOIN users u ON a.user_id = u.id
              ORDER BY u.last_name ASC";

        $stmt = $db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    // show/edit: Find one specific admin by ID
    public static function find($id)
    {
        $db = Database::getConnection();

        $query = "SELECT 
                a.*, 
                u.first_name, u.last_name, u.username, u.email, u.birthdate, u.created_at
              FROM admins a
              JOIN users u ON a.user_id = u.id
              WHERE a.id = :id 
              LIMIT 1";

        $stmt = $db->prepare($query);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // store: Create a new admin record
    public static function store($data)
    {
        $db = Database::getConnection();

        try {
            // Start the transaction to ensure both inserts happen or none at all
            $db->beginTransaction();

            // 1. Create the base User
            // This returns the ID from the 'users' table
            $userId = User::store($data);

            if (!$userId) {
                throw new Exception("User creation failed.");
            }

            // 2. Create the Admin entry linked to that User ID
            $query = "INSERT INTO admins (user_id, role, is_active) 
                      VALUES (:user_id, :role, :is_active)";

            $stmt = $db->prepare($query);
            $stmt->execute([
                'user_id' => $userId,
                'role' => $data['role'], // Enum: SuperAdmin, Manager, Staff
                'is_active' => 1
            ]);

            // Everything worked! Commit to the database
            $db->commit();
            return true;

        } catch (Exception $e) {
            // Something went wrong, undo all changes
            $db->rollBack();
            error_log("Admin Store Error: " . $e->getMessage());
            return false;
        }
    }

    // update: Update existing admin details
    public static function update($id, $data)
    {
        $db = Database::getConnection();

        try {
            $db->beginTransaction();

            // 1. Get the admin record to find the associated user_id
            $admin = self::find($id);
            if (!$admin)
                throw new Exception("Admin not found.");

            // 2. Call the User model to update core info
            // We pass $admin['user_id'] because that is the PK for the users table
            User::update($admin['user_id'], $data);

            // 3. Update the Admin specific info (role, is_active)
            $query = "UPDATE admins SET 
                    role = :role, 
                    is_active = :is_active 
                  WHERE id = :id";

            $stmt = $db->prepare($query);
            $stmt->execute([
                'role' => $data['role'],
                'is_active' => $data['is_active'],
                'id' => $id
            ]);

            $db->commit();
            return true;
        } catch (Exception $e) {
            $db->rollBack();
            error_log("Admin Update Error: " . $e->getMessage());
            return false;
        }
    }

    // destroy: Delete an admin record
    public static function delete($id)
    {
        $db = Database::getConnection();

        // First, we need the user_id associated with this admin
        $admin = self::find($id);
        if (!$admin)
            return false;

        // Delete the USER. 
        // Your SQL 'ON DELETE CASCADE' will automatically remove the Admin record.
        return User::delete($admin['user_id']);
    }
}