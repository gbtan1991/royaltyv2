<?php
require_once __DIR__ . '/../../config/database.php';




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

<?php if(isset($_GET['success'])): ?>
        <p style="color: green;"><?= htmlspecialchars($_GET['success']) ?></p>
    <?php endif; ?>
    <?php if(isset($_GET['error'])): ?>
        <p style="color: red;"><?= htmlspecialchars($_GET['error']) ?></p>
    <?php endif; ?>


<form action="index.php?page=save_customer" method="post">
    <label for="username">Username:</label>
    <input type="text" name="username" id="username" required><br><br>

    <label for="fullname">Full name:</label>
    <input type="text" name="fullname" id="fullname" required><br><br>

    <label>Gender:</label><br>
    <input type="radio" name="gender" id="gender-male" value="Male" required>
    <label for="gender-male">Male</label>
    <input type="radio" name="gender" id="gender-female" value="Female">
    <label for="gender-female">Female</label><br><br>
    
    <label for="birthdate">Birthdate:</label>
    <input type="date" name="birthdate" id="birthdate" required><br><br>

    <button type="submit">Add</button>
    <a href="index.php?page=customer_view">Cancel</a>
</form>
</body>
</html>