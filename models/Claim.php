<?php
require_once __DIR__ . '/../../config/database.php';

class Claim {
    private $pdo;

    //Constructor to automatically use the database connection
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    //Fetch all claims
    public function getAllClaims() {
        $stmt = $this->pdo->query("SELECT * FROM claim ORDER BY id ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //Add new claim
    public function addClaim($customer_id, $admin_id, $reward_id,  $points_used, $remarks) {
        $stmt = $this->pdo->prepare('INSERT INTO claim (customer_id, admin_id, reward_id, points_used, remarks) VALUES (?, ?, ?, ?, ?)');
        return $stmt->execute([$customer_id, $admin_id, $reward_id, $points_used, $remarks]);
    }
}