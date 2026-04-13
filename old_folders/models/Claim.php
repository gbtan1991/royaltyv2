<?php
require_once __DIR__ . '/../config/database.php';

class Claim {
    private $pdo;

    //Constructor to automatically use the database connection
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }        

    //Fetch all claims
    public function getAllClaims() {
        $stmt = $this->pdo->query(
            "SELECT 
                cl.id,
                c.username as customer_username,
                a.username as admin_username,
                r.reward_name as reward_name,
                cl.points_used,
                cl.claim_date,
                cl.claim_status,
                cl.remarks
                FROM claim cl
                JOIN customer c ON cl.customer_id = c.id
                JOIN admin a ON cl.admin_id = a.id
                JOIN reward r ON cl.reward_id = r.id
                ORDER BY cl.claim_date DESC"
        );
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //Add new claim
    public function addClaim($customer_id, $admin_id, $reward_id,  $points_used, $remarks) {
        $stmt = $this->pdo->prepare('INSERT INTO claim (customer_id, admin_id, reward_id, points_used, remarks) VALUES (?, ?, ?, ?, ?)');
        return $stmt->execute([$customer_id, $admin_id, $reward_id, $points_used, $remarks]);
    }

public function getLatestClaims($limit = 3) {
    $stmt = $this->pdo->prepare(
        "SELECT 
            cl.id,
            c.username AS customer_username,
            a.username AS admin_username,
            r.reward_name AS reward_name,
            cl.points_used,
            cl.claim_date,
            cl.claim_status,
            cl.remarks
        FROM claim cl
        JOIN customer c ON cl.customer_id = c.id
        JOIN admin a ON cl.admin_id = a.id
        JOIN reward r ON cl.reward_id = r.id
        ORDER BY cl.claim_date DESC
        LIMIT ?"
    );
    $stmt->bindValue(1, (int)$limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
    public function deleteClaim($claimId) {
        // Check if claim exists
        $stmt = $this->pdo->prepare("SELECT * FROM claim where id = ?");
        $stmt->execute([$claimId]);
        $claim = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$claim){
            return false;
        }

        // Calculate the points to be added back to the customer
        $pointsToAdd = $claim['points_used'];
        // Update customer's total points
        $stmt = $this->pdo->prepare("UPDATE customer SET total_points = total_points + ? WHERE id = ?");
        $stmt->execute([$pointsToAdd, $claim['customer_id']]);

        // Delete the claim
        $stmt = $this->pdo->prepare("DELETE FROM claim WHERE id = ?");
        return $stmt->execute([$claimId]);
        
    }
    
}