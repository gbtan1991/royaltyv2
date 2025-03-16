<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Admin.php';
require_once __DIR__ . '/../../helpers/format.php';

// Get search input
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

// Fetch matching admins
$adminModel = new Admin($pdo);
$admins = $adminModel->searchAdmins($search); // Assume you already have this function in Admin model

// Return rows as HTML
foreach ($admins as $admin): ?>
    <tr>
        <td><?= htmlspecialchars($admin['id']) ?></td>
        <td><?= htmlspecialchars($admin['username']) ?></td>
        <td><?= $admin['role'] === 'superadmin' ? 'Super Admin' : 'Admin' ?></td>
        <td><?= formatDateTime($admin['created_at']) ?></td>
        <td><?= formatDateTime($admin['modified_at']) ?></td>
        <td><a href="../../controllers/admin/admin_edit.php?id=<?= $admin['id'] ?>">Edit</a></td>
        <td><a href="../../controllers/admin/delete_admin.php?id=<?= $admin['id'] ?>" onclick="return confirm('Are you sure you want to delete this admin?');">Delete</a></td>
    </tr>
<?php endforeach;
?>
