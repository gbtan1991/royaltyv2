<?php 
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../config/session.php';
require_once __DIR__ . '/../../models/Customer.php';

if (!isset($_SESSION['admin'])){
    header('Location: ../../public/login.php');
    exit();
}

$customerModel = new Customer($pdo);
$customers = $customerModel->getAllCustomers(); // Fetch all customers

require_once __DIR__ . '/../../views/customer/customer_view.php'; // ✅ Corrected file name
