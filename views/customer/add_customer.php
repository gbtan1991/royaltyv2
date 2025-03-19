<?php
require_once __DIR__ . "/../../config/database.php";



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register New Customer</title>
</head>
<body>

<h2>Register New Customer</h2>

    <form action="../../controllers/customer/add_customer.php" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required><br><br>
        <label for="fullname">Full name:</label>
        <input type="text" name="fullname" id="fullname" required><br><br>

        <button type="submit">Add</button>
    </form>
    
</body>
</html>