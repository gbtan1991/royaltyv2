<?php
require_once __DIR__ . '/../config/database.php';

class Reward {
    private $pdo;

    // Constructor to automactically use the database connection
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Fetch all rewards
    public function getAllRewards() {
        $stmt = $this->pdo->query("SELECT * FROM reward ORDER BY id ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    // Add a new reward
    public function addReward($reward_name, $required_points, $reward_description) {
        $stmt = $this->pdo->prepare("INSERT INTO reward (reward_name, required_points, reward_description) VALUES (?, ?, ?)");
        return $stmt->execute([$reward_name, $required_points, $reward_description]);
    }

    // Fetch reward by ID
    public function getRewardById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM reward WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update reward
    public function updateReward($id, $reward_name, $required_points, $reward_description) {
        $stmt = $this->pdo->prepare(
            "UPDATE reward SET reward_name = ?, required_points = ?, reward_description = ? WHERE id = ?"
        );
        return $stmt->execute([$reward_name, $required_points, $reward_description, $id]);
    }
    
    // Delete reward
    public function deleteReward($id) {
        $stmt = $this->pdo->prepare("DELETE FROM reward WHERE id = ?");
        return $stmt->execute([$id]);
    }
    
}



