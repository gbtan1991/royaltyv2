<?php 
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Transaction.php';
require_once __DIR__ . '/../../config/session.php';

if (!isset($_SESSION['admin'])) {
    header('Location: ../login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
    $customer_id = $_POST['customer_id'];
    $admin_id = $_SESSION['admin']['id'];
    $total_amount = $_POST['total_amount'];

    $transactionModel = new Transaction($pdo);

    if ($transactionModel->addTransactions($customer_id, $total_amount, $admin_id)) {
        echo json_encode(["success" => true, "message" => "Transaction added successfully"];
        ) else {
        echo json_encode(["success" => false, "message" => "Transaction failed to add"];)
        }
    }

}


