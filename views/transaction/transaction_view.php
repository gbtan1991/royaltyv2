<?php
require_once '../helpers/format.php';
?>

<div class="transaction-view-layout">
    <h2>Transactions</h2>

    <?php if(isset($_GET['success'])): ?>
    <p style="color: green;"><?= htmlspecialchars($_GET['success']) ?></p>
    <?php endif; ?>
    <?php if(isset($_GET['error'])): ?>
    <p style="color: red;"><?= htmlspecialchars($_GET['error']) ?></p>
    <?php endif; ?>



<input type="text" id="search-transaction" placeholder="Search Transaction">
    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer ID</th>
                <th>Processed By</th>
                <th>Total Amount</th>
                <th>Points Earned</th>
                <th>Transaction Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="transaction-table-body">
            <?php if (!empty($transactions)): ?>
                <?php foreach ($transactions as $transaction) : ?>
                    <tr>
                        <td><?= htmlspecialchars($transaction['id']) ?></td>
                        <td><?= htmlspecialchars($transaction['customer_username']) ?></td>
                        <td><?= formatAdmin($transaction['admin_username']) ?></td>
                        <td><?= htmlspecialchars($transaction['total_amount']) ?></td>
                        <td><?= intval($transaction['total_amount'] / 5) ?></td>
                        <td><?= formatDateTime($transaction['transaction_date']) ?></td>
                        <td class="table-actions">
                    <a href="index.php?page=delete_transaction&id=<?= $transaction['id'] ?>" class="delete-button" onclick="return confirm('Are you sure you want to delete this transaction?')"><i class="fa-solid fa-trash"></i></a>
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

</div>


<div id="pagination-controls">
    <button id="prev-page" class="pagination"
</div>


<script src="../../../assets/js/customer.js">
    console.log('Customer JS loaded');

</script>