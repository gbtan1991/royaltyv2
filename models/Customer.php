<?php 
require_once __DIR__ . '/../config/database.php';

class Customer {

    private $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    public function getCustomerByUsername($username){
        $stmt = $this->pdo->prepare("SELECT * FROM customer WHERE username = ?");
        $stmt->execute([$username]);
        $customer = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$customer) {
            throw new Exception("Customer not found.");

        }
        return $customer;
    }

    public function getAllCustomers() {
        $stmt = $this->pdo->prepare("SELECT * FROM customer ORDER BY id DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLatestCustomers($limit = 3) {
        $stmt = $this->pdo->prepare("SELECT * FROM customer ORDER BY id DESC LIMIT ?");
        $stmt->bindValue(1, $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addCustomer($username, $fullname, $gender, $birthdate) {
        $stmt = $this->pdo->prepare("INSERT INTO customer (username, fullname, gender, birthdate) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$username, $fullname, $gender, $birthdate]);
    }

    public function getCustomerCount() {
        $stmt = $this->pdo->query("SELECT COUNT(*) as count FROM customer");
        
        if ($stmt) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ? $result['count'] : 0; // Ensure it returns 0 if no result
        } else {
            return 0; // Return 0 if query fails
        }
    }

    public function getCustomerById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM customer WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function updateCustomer($id, $username, $fullname, $gender, $birthdate) {
        $stmt = $this->pdo->prepare("UPDATE customer SET username = ?, fullname = ?, gender = ?, birthdate = ? WHERE id = ?");
        return $stmt->execute([$username, $fullname, $gender, $birthdate, $id]);
    }

    public function deleteCustomer($id) {
        $stmt = $this->pdo->prepare("DELETE FROM customer where id = ?");
        return $stmt->execute([$id]);
    }
    
}

   