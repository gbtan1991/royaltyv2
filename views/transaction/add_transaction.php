<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Customer.php';
require_once __DIR__ . '/../../config/session.php';

// Ensure admin is logged in
if (!isset($_SESSION['admin'])) {
    header('Location: ../../public/login.php');
    exit;
}

$customerModel = new Customer($pdo);
$customers = $customerModel->getAllCustomers();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Transaction</title>
</head>
<body>
    <h2>Add Transaction</h2>

    <?php if (isset($_GET['error'])): ?>
        <p style="color: red;"><?= htmlspecialchars($_GET['error']) ?></p>
    <?php endif; ?>
    <?php if (isset($_GET['success'])): ?>
        <p style="color: green;"><?= htmlspecialchars($_GET['success']) ?></p>
    <?php endif; ?>

    <form action="../../controllers/transaction/add_transaction.php" method="POST">
        <label for="customer_id">Select Customer:</label>
        <select name="customer_id" required>
            <option value="">-- Select Customer --</option>
            <?php foreach ($customers as $customer): ?>
                <option value="<?= $customer['id'] ?>">
                    <?= htmlspecialchars($customer['fullname']) ?> (Points: <?= $customer['total_points'] ?>)
                </option>
            <?php endforeach; ?>
        </select>
        <br><br>

        <label for="total_amount">Amount Paid (PHP):</label>
        <input type="number" name="total_amount" step="0.01" required>
        <br><br>

        <button type="submit">Add Transaction</button>
    </form>

    <br>
    <a href="transaction_view.php">View Transactions</a>
</body>
</html>
