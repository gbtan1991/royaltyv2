<?php
require_once __DIR__ . '/../config/database.php';

class Transaction {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

        
    public function getAllTransactions() {
        $stmt = $this->pdo->query(
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
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
