<?php

namespace App\Models;

use App\Core\Database;
use App\Helpers\Utils;
use Exception;
use PDO;

class Customer
{
    public static function getAll()
    {
        $db = Database::getConnection();

        $query = "SELECT  
            c.id,
            c.member_id,
            c.loyalty_tier,
            c.last_login,
            c.is_active,
            u.first_name,
            u.last_name,
            u.username,
            u.email,
            u.birthdate
     
            FROM customers c
            JOIN users u ON c.user_id = u.id
            ORDER BY u.id DESC";

        $stmt = $db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        Utils::dd($query);


    }

    public static function find($id)
    {
        $db = Database::getConnection();

        $query = "SELECT
            c.*,
            u.first_name, u.last_name, u.username, u.email, u.birthdate, u.created_at
            FROM customers c
            JOIN users u ON a.user_id = u.id
            WHERE c.id = :id;
            LIMIT 1";

            $stmt = $db->prepare($query);
            $stmt->execute(['id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public static function store($data)
    {
        $db = Database::getConnection();

        try {
        // Start the transaction to ensure both inserts happend or not at all
        $db->beginTransaction();

        // 1. Create the base User
        // This return the ID from the 'users' table
         $userId = User::store($data);
        
        if (!$userId) {
            throw new Exception("User creation failed.");
        }

        // 2. Create the Customer entry
         $query = "INSERT INTO customers (user_id, member_id, loyalty_tier, is_active) 
         VALUES (:user_id, :member_id, :loyalty_tier, :is_active)";
         
         $stmt = $db->prepare($query);
         $stmt->execute([
            'user_id' => $userId,
            'member_id' => $data['member_id'] ?? null,
            'loyalty_tier' => $data['loyalty_tier'] ?? null,
            'is_active' => $data['is_active'] ?? 1
         ]);

         // Everyhing worked! Commit to the database
         $db->commit();
         return true;

        
        } catch (Exception $e) {
           // Something went wrong, undo all changes
           $db->rollback();

           die("DEBUG ERROR: " . $e->getMessage());
           error_log("Error creating customer: " . $e->getMessage());
           return false;
        }
    }


    
}