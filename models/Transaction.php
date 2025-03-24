<?php 

require_once __DIR__ . '/../config/database.php';

class Transaction {
    private $pdo;


    public function __construct(){
        $this->pdo = $pdo;
    }

    // Add a new transaction
    public function addTransactions($customer_id, $admin_id, $total_amount){
        $stmt = $this->pdo->prepare("INSERT INTO transaction (customer_id, admin_id, total_amount) VALUES (?, ?, ?)");
        $stmt->execute([$customer_id, $admin_id, $total_amount]);

        // Calculating points (5 pesos = 30 minutes = 1 point)
        $points = floor($total_amount / 5);

        // Update customer points
        $stmt = $this->pdo->prepare("UPDATE customer SET total_points = total_points + ? WHERE id =");
        return $stmt->execute([$points, $customer_id]);
    }

    // Fetch all transactions
    public function getAllTransactions() {
        $stmt = $this->pdo->query("
            SELECT t.id, 
            c.username AS customer, 
            a.username AS admin,
            t.total_amount,
            t.transaction_date 
            FROM transaction t
            JOIN customer c ON t.customer_id = c.id
            JOIN admin a ON t.admin_id = a.id
            ORDER BY t.transaction_date DESC
            ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
    