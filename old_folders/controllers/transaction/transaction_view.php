<?php 

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../config/session.php';
require_once __DIR__ . '/../../models/Transaction.php';

if(!isset($_SESSION['admin'])){
    header('Location: ../../public/login.php');
    exit();
}



$transactionModel = new Transaction($pdo);
$transactions = $transactionModel->getAllTransactions();


require_once __DIR__ . '/../../views/transaction/transaction_view.php';