<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Transaction.php';
require_once __DIR__ . '/../../models/Customer.php';
require_once __DIR__ . '/../../config/session.php';

if(!isset($_SESSION['admin_id'])){
    header('Location: public/login.php');
    exit();
}


 // Getting the admin's ID

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer_id = $_POST['customer_id'];
    $admin_id = $_SESSION['admin_id'];
    $total_amount = $_POST['total_amount'];

    // Validate input
    if (empty($customer_id) || empty($total_amount)) {
        header("Location: index.php?page=add_transaction&error=Missing required fields");
        exit;
    }

    $transactionModel = new Transaction($pdo);
    $customerModel = new Customer($pdo);

    // Add transaction to the database
    if ($transactionModel->addTransaction($customer_id, $admin_id, $total_amount)) {
        // Update customer points
        $pointsEarned = floor($total_amount / 5); // 5 pesos = 30 mins = 1 point
        $customerModel->updateCustomerPoints($customer_id, $pointsEarned);

        header("Location: index.php?page=transaction_view&success=Transaction added successfully");
        exit;
    } else {
        header("Location: index.php?page=transaction_view&error=Failed to add transaction");
        exit;
    }
} else {
    header("Location: index.php?page=add_transaction");
    exit;
}
?>
