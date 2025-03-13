<?php 
require_once __DIR__ . "../../config/database.php";

// Check if user is superadmin
if ($_SESSION['role'] !== 'superadmin') {
    header('Location: ../views/dashboard.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Admin</title>
</head>
<body>

    <h2> Add Admin </h2>

    <form action="../../controllers/admin/add_admin.php" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required><br><br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br><br>
        <select name="role">
            <option value="admin">Admin</option>
            <option value="superadmin">Super Admin</option>
        </select>

        <button type="submit">Add</button>

</form>

    <a href="../../controllers/admin/admin_view.php">Back to Manage Admins</a>
    
</body>
</html>