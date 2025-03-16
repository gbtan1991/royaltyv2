<?php 
require_once __DIR__ . '/../config/database.php';

class Customer {

    private $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    public function getAllCustomers() {
        $stmt = $this->pdo->prepare("SELECT * FROM customer ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}


?>