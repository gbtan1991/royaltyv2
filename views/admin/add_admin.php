<?php 
require_once __DIR__ . "/../../config/database.php";

// Check if user is superadmin
if ($_SESSION['role'] !== 'superadmin') {
    header('Location: ../views/dashboard.php');
    exit();
}
?>

<div class="add-admin-page">


    <h2> Add Admin </h2>

    <div class="notification">
<?php if(isset($_GET['success'])): ?>
        <p style="color: green;"><?= htmlspecialchars($_GET['success']) ?></p>
    <?php endif; ?>
    <?php if(isset($_GET['error'])): ?>
        <p style="color: red;"><?= htmlspecialchars($_GET['error']) ?></p>
    <?php endif; ?>

</div>



    <form action="index.php?page=save_admin.php" method="post">

    <div class="label-fields">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required><br><br>
    </div>

    <div class="label-fields">
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br><br>
    </div>

    <div class="info-fields">
        <label for="role">Admin Role</label>
        <select name="role">
            <option value="admin">Admin</option>
            <option value="superadmin">Super Admin</option>
        </select>

    </div>

    <div class="button-fields">
        <button type="submit"><i class="fa-solid fa-plus"></i>Add</button>
        <a href="index.php?page=admin_view"><i class="fa-solid fa-ban"></i>Cancel</a>

    </div>    
</form>

    

</div>

