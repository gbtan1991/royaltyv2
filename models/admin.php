<?php
require_once __DIR__ . '/../config/database.php';


class Admin{
    public static function getAdminByUsername($pdo, $username){

        $stmt = $pdo->prepare("SELECT * FROM admin WHERE username = ?");
        $stmt->execute([$username]);
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$admin) {
            exit;
        }
        return $admin;
        
    }

    public static function addAdmin($pdo, $username, $password, $role = 'admin') {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO admin (username, password_hash, role) VALUES (?, ?, ?)");
        return $stmt->execute([$username, $hashed_password, $role]);
    }
}



?>