<?php

$router = require_once __DIR__ ."/../bootstrap/app.php";

use App\Models\User;
use App\Helpers\Utils;

// 1. Fetch the data
$allUsers = User::all();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BaseModel Test - User List</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; padding: 20px; background-color: #f4f7f6; }
        .container { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h2 { color: #333; border-bottom: 2px solid #3498db; padding-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #3498db; color: white; }
        tr:nth-child(even) { background-color: #f2f2f2; }
        tr:hover { background-color: #e9f5ff; }
        .status { color: #27ae60; font-weight: bold; }
    </style>
</head>
<body>

<div class="container">
    <h2><span class="status">●</span> BaseModel Diagnostic: All Users</h2>
    
    <p>Total Records: <strong><?= count($allUsers) ?></strong></p>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Birthdate</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($allUsers)): ?>
                <?php foreach ($allUsers as $user): ?>
                    <tr>
                        <td><?= $user['id'] ?></td>
                        <td><?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) ?></td>
                        <td><code><?= htmlspecialchars($user['username']) ?></code></td>
                        <td><?= htmlspecialchars($user['email']) ?></td>
                        <td><?= !empty($user['birthdate']) ? $user['birthdate'] : '<em style="color:#999">Not set</em>' ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" style="text-align:center;">The table is currently empty.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>

<?php
// We stop the script here so the Router doesn't try to run and overwrite our test
exit;