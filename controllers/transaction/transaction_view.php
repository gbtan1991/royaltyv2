<?php 

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Transaction.php';



$transactionModel = new Transaction($pdo);
$transactions = $transactionModel->getAllTransactions();


require_once __DIR__ . '/../../views/transaction/transaction_view.php';