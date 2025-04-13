<?php
require_once __DIR__ . '/../../helpers/format.php';

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Rewards</title>
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
        <h2>List of Rewards</h2>


        <!-- Notifications for adding -->
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
                    <th>Reward Name</th>
                    <th>Required Points</th>
                    <th>Reward Description</th>
                    <th>Created Date</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                <?php if(!empty($reward)) : ?>
                    <?php foreach($reward as $rewards) : ?>
                        <tr>
                            <td><?= htmlspecialchars($rewards['id']) ?></td>    
                            <td><?= htmlspecialchars($rewards['reward_name']) ?></td>
                            <td><?= htmlspecialchars($rewards['required_points']) ?></td>
                            <td><?= htmlspecialchars($rewards['reward_description']) ?></td>
                            <td><?= formatDateTime($rewards['created_at']) ?></td>
                            <td><a href="../../controllers/reward/reward_edit.php?id=<?= $rewards['id'] ?>">Edit</a></td>
                            <td><a href="../../controllers/reward/delete_reward.php?id=<?= $rewards['id'] ?>" onclick="return confirm('Are you sure you want to delete this reward?')">Delete</a></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">Theres no current rewards</td>
                    </tr>
                <?php endif; ?>
            </tbody>

        </table>
        <br>

        <a href="../../views/reward/add_reward.php">Add New Rewards</a>
        <a href="../../views/dashboard.php">Back to Dashboard</a>
        
</body>
</html>