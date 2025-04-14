<?php
require_once __DIR__ . '/../../helpers/format.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View CLaims</title>
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
    <h2>List of Claims</h2>
    
    <?php if(isset($_GET['success'])): ?>
        <p style="color: green;"><?= htmlspecialchars($_GET['success']) ?></p>
    <?php endif; ?>
    <?php if(isset($_GET['error'])): ?>
        <p style="color: red;"><?= htmlspecialchars($_GET['error']) ?></p>
    <?php endif; ?>

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
        <tbody>
            <?php if(!empty($claims)): ?>
                <?php foreach ($claims as $claim) : ?>
                    <tr>
                        <td><?= htmlspecialchars($claim['id']) ?></td>
                        <td><?= htmlspecialchars($claim['customer_username']) ?></td>
                        <td><?= htmlspecialchars($claim['admin_username']) ?></td>
                        <td><?= htmlspecialchars($claim['reward_name']) ?></td>
                        <td><?= htmlspecialchars($claim['points_used']) ?></td>
                        <td><?= htmlspecialchars($claim['claim_date']) ?></td>
                        <td><?= htmlspecialchars($claim['claim_status']) ?></td>
                        <td><?= htmlspecialchars($claim['remarks']) ?></td>
                        <td><a href="edit_claim.php?id=<?= htmlspecialchars($claim['id']) ?>">Edit</a></td>
                        <td><a href="delete_claim.php?id=<?= htmlspecialchars($claim['id']) ?>" onclick="return confirm('Are you sure you want to delete this claim?');">Delete</a></td>

                    </tr>

                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="9">No claims found.</td>
                </tr>
            <?php endif; ?>
        </thead>    
    
    </table>
    <br>
    <a href="../../views/claim/add_claim.php">Add New Claim</a>
    <a href="../../views/dashboard.php">Back to Dashboard</a>

</body>
</html>