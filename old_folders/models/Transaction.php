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

   
    public function deleteTransaction($transactionId) {
        // Get transaction details before deleting
        $stmt = $this->pdo->prepare("SELECT * FROM transaction WHERE id = ?");
        $stmt->execute([$transactionId]);
        $transaction = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if (!$transaction) {
            return false; // Transaction not found
        }
    
        // Calculate points to subtract
        $pointsToDeduct = floor($transaction['total_amount'] / 5);
    
        // Update customer's total points
        $stmt = $this->pdo->prepare("UPDATE customer SET total_points = total_points - ? WHERE id = ?");
        $stmt->execute([$pointsToDeduct, $transaction['customer_id']]);
    
        // Delete the transaction
        $stmt = $this->pdo->prepare("DELETE FROM transaction WHERE id = ?");
        return $stmt->execute([$transactionId]);
    }
    

    public function getTodaysTotalAmount() {
        $stmt = $this->pdo->prepare(
            "SELECT SUM(total_amount) as total_amount
            FROM transaction t 
            WHERE DATE(t.transaction_date) = CURDATE()
            ");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getWeeklyTotalAmount() {
        $stmt = $this->pdo->prepare(
            "SELECT 
            SUM(t.total_amount) as total_amount
        FROM transaction t
        WHERE YEARWEEK(t.transaction_date, 1) = YEARWEEK(CURDATE(), 1)"
        );
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getMonthlyTotalAmount() {
        $stmt = $this->pdo->prepare(
            "SELECT SUM(t.total_amount) as total_amount
            FROM transaction t
            WHERE MONTH(t.transaction_date) = MONTH(CURDATE())
            AND YEAR(t.transaction_date) = YEAR(CURDATE())"
        );
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getDailyEarningsThisMonth() {
        $stmt = $this->pdo->prepare(
            "SELECT 
                DATE(t.transaction_date) as DATE,
                SUM(t.total_amount) as total
             FROM transaction t
             WHERE MONTH(t.transaction_date) = MONTH(CURDATE())
               AND YEAR(t.transaction_date) = YEAR(CURDATE())
             GROUP BY DATE(t.transaction_date)
             ORDER BY DATE ASC"
        );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDailyEarningsThisWeek() {
        $stmt = $this->pdo->prepare(
            "SELECT 
                DATE(t.transaction_date) as DATE,
                SUM(t.total_amount) as total
             FROM transaction t
             WHERE YEARWEEK(t.transaction_date, 1) = YEARWEEK(CURDATE(), 1)
             GROUP BY DATE(t.transaction_date)
             ORDER BY DATE ASC"
        );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
