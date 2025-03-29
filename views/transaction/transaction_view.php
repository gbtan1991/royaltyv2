<?php

require_once '../../helpers/format.php';

if(!isset($_SESSION['admin_id'])){
    header('Location: public/login.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transactions</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

    <h2>Transactions</h2>
    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer ID</th>
                <th>Processed By</th>
                <th>Total Amount</th>
                <th>Transaction Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($transactions)): ?>
                <?php foreach ($transactions as $transaction) : ?>
                    <tr>
                        <td><?= htmlspecialchars($transaction['id']) ?></td>
                        <td><?= htmlspecialchars($transaction['customer_username']) ?></td>
                        <td><?= htmlspecialchars($transaction['admin_username']) ?></td>
                        <td><?= htmlspecialchars($transaction['total_amount']) ?></td>
                        <td><?= formatDateTime($transaction['transaction_date']) ?></td>
                        <td>
    <a href="../../controllers/transaction/delete_transaction.php?id=<?= $transaction['id'] ?>"
       onclick="return confirm('Are you sure you want to delete this transaction?')">
       Delete
    </a>
</td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">No Transactions Found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <br>
    <a href="../../views/transaction/add_transaction.php">Add Transaction</a>
    <a href="../../views/dashboard.php">Back to Dashboard</a>

</body>
</html>
