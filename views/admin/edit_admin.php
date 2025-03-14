<?php 
require_once __DIR__ . '/../../config/session.php';


if (!isset($_SESSION['admin']) || $_SESSION['role'] !== 'superadmin') {
    header('Location: ../public/login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Admin</title>
</head>
<body>

<h2>Edit Admin Account</h2>

<!-- Notifications -->
<?php if (isset($_GET['error'])): ?>
    <p style="color: red;"><?= htmlspecialchars($_GET['error']) ?></p>
<?php endif; ?>


<form action="../../controllers/admin/edit_admin.php" method="post">
    <input type="hidden" name="id" value="<?= htmlspecialchars($admin['id']) ?>">

    <label for="username">Username:</label><br>
    <input type="text" name="username" id="username" value="<?= htmlspecialchars($admin['username']) ?>" required><br><br>

    <label for="password">Password (leave blank to keep current):</label><br>
    <input type="password" name="password" id="password"><br><br>

    <label for="role">Role:</label><br>
    <select name="role" id="role">
        <option value="admin" <?= $admin['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
        <option value="superadmin" <?= $admin['role'] == 'superadmin' ? 'selected' : '' ?>>Super Admin</option>
    </select><br><br>

    <button type="submit">Save Changes</button>
</form>
</body>
</html>
