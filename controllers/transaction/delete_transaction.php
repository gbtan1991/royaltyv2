<?php 
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Transaction.php';
require_once __DIR__ . '/../../config/session.php';


// Ensure admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header('Location: ../../public/login.php');
    exit;
}

// Check if transaction ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: ../../views/transaction/transaction_view.php?error=Missing Transaction Id');
    exit;
}

$transactionId = $_GET['id'];
$transactionModel = new Transaction($pdo);

if ($transactionModel->deleteTransaction($transactionId)) {
    header('Location: transaction_view.php?success=Transaction Deleted Successfully');
    exit;
} else {
    header('Location: transaction_view.php?error=Failed to Delete Transaction');
    exit;
}
    



?>