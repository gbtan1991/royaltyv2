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

    public function addCustomer($username, $fullname, $gender, $birthdate) {
        $stmt = $this->pdo->prepare("INSERT INTO customer (username, fullname, gender, birthdate) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$username, $fullname, $gender, $birthdate]);
    }
}


?>