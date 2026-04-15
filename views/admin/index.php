<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin List</title>
    <style>
        body { font-family: sans-serif; padding: 20px; line-height: 1.6; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #f4f4f4; }
        .badge { background: #e3f2fd; color: #0d47a1; padding: 4px 8px; border-radius: 4px; font-size: 0.8em; }
    </style>
</head>
<body>

    <h1>System Administrators</h1>
    <p>Management view for Royalty V2</p>

    <table>
        <thead>
            <tr>
                <th>Username</th>
                <th>Full Name</th>
                <th>Role</th>
                <th>Last Login</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($admins as $admin): ?>
            <tr>
                <td><strong><?= htmlspecialchars($admin['username']) ?></strong></td>
                <td><?= htmlspecialchars($admin['first_name']) ?></td>
                <td><span class="badge"><?= htmlspecialchars($admin['role']) ?></span></td>
                <td><?= htmlspecialchars($admin['last_login'] ?? 'Never') ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>