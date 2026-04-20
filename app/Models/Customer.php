<?php

namespace App\Models;

use App\Core\Database;
use App\Helpers\Utils;
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


    
}