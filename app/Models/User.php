<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class User
{

    /**
     * Store the core user details.
     * Returns the new ID so the calling Model can link it.
     */
    public static function store($data)
    {
        $db = Database::getConnection();

        $query = "INSERT INTO users (first_name, last_name, username, email, password, birthdate) 
                  VALUES (:first_name, :last_name, :username, :email, :password, :birthdate)";

        $stmt = $db->prepare($query);

        $success = $stmt->execute([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
            // Handle empty birthdate from form
            'birthdate' => !empty($data['birthdate']) ? $data['birthdate'] : null
        ]);

        return $success ? $db->lastInsertId() : false;
    }

    /**
     * Update user details (Used during Admin Edit)
     */
    public static function update($id, $data)
    {
        $db = Database::getConnection();

        $query = "UPDATE users SET 
                first_name = :first_name, 
                last_name = :last_name, 
                email = :email,
                birthdate = :birthdate
              WHERE id = :id";

        $stmt = $db->prepare($query);
        return $stmt->execute([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'birthdate' => !empty($data['birthdate']) ? $data['birthdate'] : null,
            'id' => $id
        ]);
    }

    /**
     * Delete user (This will auto-delete Admin/Customer due to CASCADE)
     */
   public static function delete($id) {
    $db = Database::getConnection();
    $stmt = $db->prepare("DELETE FROM users WHERE id = :id");
    return $stmt->execute(['id' => $id]);
}
}