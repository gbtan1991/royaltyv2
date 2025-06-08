<?php
require_once __DIR__ . '/../../helpers/format.php';
?>

<div class="claim-view-layout">
    <h2>List of Claims</h2>
    <?php if(isset($_GET['success'])): ?>
        <p style="color: green;"><?= htmlspecialchars($_GET['success']) ?></p>
    <?php endif; ?>
    <?php if(isset($_GET['error'])): ?>
        <p style="color: red;"><?= htmlspecialchars($_GET['error']) ?></p>
    <?php endif; ?>

<input type="text" id="search-claim" placeholder="Search Claim">


    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer Username</th>
                <th>Admin Assisted</th>
                <th>Reward Type</th>
                <th>Points Used</th>
                <th>Claim Date</th>
                <th>Claim Status</th>
                <th>Remarks</th>
            <th colspan="2">Actions</th>
            </tr>
        </thead>
        <tbody id="claim-table-body">
            <?php if(!empty($claims)): ?>
                <?php foreach ($claims as $claim) : ?>
                    <tr>
                        <td><?= htmlspecialchars($claim['id']) ?></td>
                        <td><?= htmlspecialchars($claim['customer_username']) ?></td>
                        <td><?= formatAdmin($claim['admin_username']) ?></td>
                        <td><?= htmlspecialchars($claim['reward_name']) ?></td>
                        <td><?= htmlspecialchars($claim['points_used']) ?></td>
                        <td><?= htmlspecialchars($claim['claim_date']) ?></td>
                        <td><?= htmlspecialchars($claim['claim_status']) ?></td>
                        <td><?= htmlspecialchars($claim['remarks']) ?></td>
                        <td class="table-actions"><a href="index.php?page=delete_claim&id=<?= htmlspecialchars($claim['id']) ?>" class="delete-button" onclick="return confirm('Are you sure you want to delete this claim?');"><i class="fa-solid fa-trash"></i></a></td>

                    </tr>

                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="9">No claims found.</td>
                </tr>
            <?php endif; ?>
        </thead>    
    
    </table>
   

</div>
    
<div id="pagination-controls">
    <button id="prev-page" class="pagination"


</div>
