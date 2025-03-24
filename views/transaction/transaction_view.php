<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Transaction.php';

$transactionModel = new Transaction($pdo);
$transactions = $transactionModel->getAllTransactions();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Transactions</title>
    
</head>
<body>
    <h2>Transactions</h2>
    
    <form id="transaction-form">
        <label for="customer_id">Customer ID:</label>
        <input type="number" id="customer_id" name="customer_id" required>

        <label for="total_amount">Amount Paid:</label>
        <input type="number" id="total_amount" name="total_amount" required>

        <button type="submit">Add Transaction</button>
    </form>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer</th>
                <th>Admin</th>
                <th>Total Amount</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody id="transaction-table-body">
            <?php foreach ($transactions as $transaction) : ?>
                <tr>
                    <td><?= htmlspecialchars($transaction['id']) ?></td>
                    <td><?= htmlspecialchars($transaction['customer']) ?></td>
                    <td><?= htmlspecialchars($transaction['admin']) ?></td>
                    <td><?= htmlspecialchars($transaction['total_amount']) ?></td>
                    <td><?= htmlspecialchars($transaction['transaction_date']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script src="../../assets/js/transaction.js"></script>
</body>
</html>
