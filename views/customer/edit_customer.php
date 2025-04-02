<?php 
require_once __DIR__ . '/../../config/session.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Customer</title>
</head>
<body>

    <h2>Edit Customer</h2>

    <?php if(isset($_GET['success'])): ?>
        <p style="color: green;"><?= htmlspecialchars($_GET['success']) ?></p>
    <?php endif; ?>
    <?php if(isset($_GET['error'])): ?>
        <p style="color: red;"><?= htmlspecialchars($_GET['error']) ?></p>
    <?php endif; ?>

    <form action="../../controllers/customer/edit_customer.php" method="post">
        <input type="hidden" name="id" value="<?= htmlspecialchars($customer['id']) ?>">

        <label for="username">Username:</label>
        <input type="text" name="username" id="username" value="<?= htmlspecialchars($customer['username']) ?>" required><br><br>

        <label for="fullname">Full Name:</label>
        <input type="text" name="fullname" id="fullname" value="<?= htmlspecialchars($customer['fullname']) ?>" required><br><br>

        <label>Gender:</label><br>
        <input type="radio" name="gender" value="Male" <?= ($customer['gender'] == 'Male') ? 'checked' : '' ?> required> Male
        <input type="radio" name="gender" value="Female" <?= ($customer['gender'] == 'Female') ? 'checked' : '' ?>> Female
        <br><br>

        <label for="birthdate">Birthdate:</label>
        <input type="date" name="birthdate" id="birthdate" value="<?= htmlspecialchars($customer['birthdate']) ?>" required><br><br>

        <button type="submit">Save Changes</button>
    </form>

</body>
</html>
