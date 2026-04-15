<?php

namespace App\Models;

use App\Core\Database;

class Admin {
    
    public static function getAll() {
        $db = Database::getConnection();
        
        $query = "SELECT users.username, users.first_name, admins.role, admins.last_login 
                  FROM users 
                  JOIN admins ON users.id = admins.user_id";
                  
        $stmt = $db->query($query);
        return $stmt->fetchAll();
    }
}