<?php 
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Transaction.php';


// Check if transaction ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: index.php?page=transaction_view&error=Missing Transaction Id');
    exit;
}

$transactionId = $_GET['id'];
$transactionModel = new Transaction($pdo);

if ($transactionModel->deleteTransaction($transactionId)) {
    header('Location: index.php?page=transaction_view&success=Transaction Deleted Successfully');
    exit;
} else {
    header('Location: index.php?page=transaction_view&error=Failed to Delete Transaction');
    exit;
}
    
