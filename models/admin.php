<?php
require_once __DIR__ . '/../config/database.php';

class Admin {
    private $pdo;

    // Constructor to automatically use the database connection
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Fetch admin by username
    public function getAdminByUsername($username) {
        $stmt = $this->pdo->prepare("SELECT * FROM admin WHERE username = ?");
        $stmt->execute([$username]);
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$admin) {
            throw new Exception("Admin user not found."); // Better error handling
        }
        return $admin;
    }

    // Add a new admin
    public function addAdmin($username, $password, $role = 'admin') {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare("INSERT INTO admin (username, password_hash, role) VALUES (?, ?, ?)");
        return $stmt->execute([$username, $hashed_password, $role]);
    }
}
