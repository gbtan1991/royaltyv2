<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Transaction.php';
require_once __DIR__ . '/../../models/Customer.php';
require_once __DIR__ . '/../../config/session.php';

// Ensure admin is logged in
if (!isset($_SESSION['admin']) || !is_array($_SESSION['admin'])) {
    die("Session error: Admin not logged in.");
}

$admin_id = $_SESSION['admin']['id']; // Getting the admin's ID

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer_id = $_POST['customer_id'];
    $total_amount = $_POST['total_amount'];

    // Validate input
    if (empty($customer_id) || empty($total_amount)) {
        header("Location: ../../views/transaction/add_transaction.php?error=Missing required fields");
        exit;
    }

    $transactionModel = new Transaction($pdo);
    $customerModel = new Customer($pdo);

    // Add transaction to the database
    if ($transactionModel->addTransaction($customer_id, $admin_id, $total_amount)) {
        // Update customer points
        $pointsEarned = floor($total_amount / 5); // 5 pesos = 30 mins = 1 point
        $customerModel->updateCustomerPoints($customer_id, $pointsEarned);

        header("Location: ../../views/transaction/transaction_view.php?success=Transaction added successfully");
        exit;
    } else {
        header("Location: ../../views/transaction/add_transaction.php?error=Failed to add transaction");
        exit;
    }
} else {
    header("Location: ../../views/transaction/add_transaction.php");
    exit;
}
?>
