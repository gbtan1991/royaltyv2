<?php 
require_once __DIR__ . '/../../config/session.php';


if (!isset($_SESSION['admin']) || $_SESSION['role'] !== 'superadmin') {
    header('Location: ../public/login.php');
    exit;
}
?>

<div class="add-admin-page">

<h2>Edit Admin Account</h2>

<!-- Notifications -->

    <div class="notification">
<?php if(isset($_GET['success'])): ?>
        <p style="color: green;"><?= htmlspecialchars($_GET['success']) ?></p>
    <?php endif; ?>
    <?php if(isset($_GET['error'])): ?>
        <p style="color: red;"><?= htmlspecialchars($_GET['error']) ?></p>
    <?php endif; ?>

</div>


<form action="index.php?page=update_admin" method="post">
    <input type="hidden" name="id" value="<?= htmlspecialchars($admin['id']) ?>">

<div class="label-fields">
    <label for="username">Username:</label><br>
    <input type="text" name="username" id="username" value="<?= htmlspecialchars($admin['username']) ?>" required><br><br>
</div>

<div class="label-fields">
    <label for="password">Password (leave blank to keep current):</label><br>
    <input type="password" name="password" id="password"><br><br>
</div>
    
<div class="info-fields">

    <label for="role">Role:</label><br>
    <select name="role" id="role">
        <option value="admin" <?= $admin['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
        <option value="superadmin" <?= $admin['role'] == 'superadmin' ? 'selected' : '' ?>>Super Admin</option>
    </select>
</div>    

<div class="button-fields">
        <button type="submit"><i class="fa-solid fa-check"></i>Update</button>
        <a href="index.php?page=admin_view"><i class="fa-solid fa-ban"></i>Cancel</a>

</div>

</form>

    
</div>
