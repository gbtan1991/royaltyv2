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

<div class="add-transaction-page">


    <h2>Add New Transaction</h2>

    <?php if (isset($_GET['error'])): ?>
        <p style="color: red;"><?= htmlspecialchars($_GET['error']) ?></p>
    <?php endif; ?>
    <?php if (isset($_GET['success'])): ?>
        <p style="color: green;"><?= htmlspecialchars($_GET['success']) ?></p>
    <?php endif; ?>

    <form action="index.php?page=save_transaction" method="POST">
 
    <div class="label-fields">
        <label for="customer_id">Select Customer:</label>
        <select name="customer_id" required>

            <option value="">-- Select Customer --</option>
            <?php foreach ($customers as $customer): ?>
                <option value="<?= $customer['id'] ?>">
                    <?= htmlspecialchars($customer['username']) ?> (Points: <?= $customer['total_points'] ?>)
                </option>
            <?php endforeach; ?>
        </select>
        
    </div>
    <div class="label-fields">
        
        <label for="total_amount">Amount Paid (PHP):</label>
        <input type="number" name="total_amount" step="0.01" required>
        
    </div>

    <div class="button-fields">
        <button type="submit"><i class="fa-solid fa-check"></i>Confirm Transaction</button>
        <a href="index.php?page=dashboard"><i class="fa-solid fa-ban"></i>Cancel</a>

    </div>
    </form>



</div>