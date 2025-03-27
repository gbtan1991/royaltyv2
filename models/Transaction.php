<?php
require_once __DIR__ . '/../config/database.php';

class Transaction {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

        
    public function getAllTransactions() {
        $stmt = $this->pdo->prepare(
            "SELECT 
                t.id,
                c.username as customer_username,
                a.username as admin_username,
                t.total_amount,
                t.transaction_date
            FROM transaction t
            JOIN customer c ON t.customer_id = c.id
            JOIN admin a ON t.admin_id = a.id
            ORDER BY t.transaction_date DESC"            
        );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addTransaction($customer_id, $admin_id, $total_amount) {
        $stmt = $this->pdo->prepare("
            INSERT INTO transaction (customer_id, admin_id, total_amount) 
            VALUES (?, ?, ?)
        ");
        
        return $stmt->execute([$customer_id, $admin_id, $total_amount]);
    }

    public function getLatestTransaction($limit = 3) {
        $stmt = $this->pdo->prepare(
            "SELECT 
                t.id,
                c.username as customer_name,
                a.username as admin_username,
                t.total_amount,
                t.transaction_date
            FROM transaction t
            JOIN customer c ON t.customer_id = c.id
            JOIN admin a ON t.admin_id = a.id
            ORDER BY t.transaction_date DESC
            "
        );
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
        
    }


}
