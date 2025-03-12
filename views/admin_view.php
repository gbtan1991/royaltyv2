<?php 
require_once __DIR__ . '/../helpers/format.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Management</title>
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

    <h2>Admin Accounts</h2>

    <!-- Notifications -->
    <?php if (isset($_GET['success'])): ?>
        <p style="color: green;"><?= htmlspecialchars($_GET['success']) ?></p>
    <?php endif; ?>
    <?php if (isset($_GET['error'])): ?>
        <p style="color: red;"><?= htmlspecialchars($_GET['error']) ?></p>
    <?php endif; ?>

    <!-- Admin Table -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Role</th>
                <th>Created At</th>
                <th>Modified At</th>
                <th colspan="2">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($admins as $admin): ?>
                <tr>
                    <td><?= htmlspecialchars($admin['id']) ?></td>
                    <td><?= htmlspecialchars($admin['username']) ?></td>
                    <td> <?php 
        if ($admin['role'] === 'superadmin') {
            echo 'Super Admin';
        } else {
            echo 'Admin';
        }
    ?></td>
                    <td><?= formatDateTime($admin['created_at']) ?></td>
                    <td><?= formatDateTime($admin['modified_at']) ?></td>
                    <td>
                        <a href="../controllers/admin_edit.php?id=<?= $admin['id'] ?>">Edit</a> 
    </td>
                    <td><a href="../controllers/delete_admin.php?id=<?= $admin['id'] ?>" onclick="return confirm('Are you sure you want to delete this admin?');">Delete</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <br>
    <a href="../views/add_admin.php">Add New Admin</a> |
    <a href="../views/dashboard.php">Back to Dashboard</a>

</body>
</html>