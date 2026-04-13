<?php 
require_once __DIR__ . '/../../config/session.php';
?>

<div class="edit-customer-page">


<h2>Edit Customer</h2>

<div class="notification">


    <?php if(isset($_GET['success'])): ?>
        <p style="color: green;"><?= htmlspecialchars($_GET['success']) ?></p>
    <?php endif; ?>
    <?php if(isset($_GET['error'])): ?>
        <p style="color: red;"><?= htmlspecialchars($_GET['error']) ?></p>
    <?php endif; ?>

</div>

    <form action="index.php?page=update_customer" method="post">
        
        <input type="hidden" name="id" value="<?= htmlspecialchars($customer['id']) ?>">
        
        <div class="label-field">            
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" value="<?= htmlspecialchars($customer['username']) ?>" required><br><br>
        </div>

        <div class="label-field">

        <label for="fullname">Full Name:</label>
        <input type="text" name="fullname" id="fullname" value="<?= htmlspecialchars($customer['fullname']) ?>" required><br><br>

        </div>

        <div class="info-fields">
        <div class="gender-options">

        <label>Gender:</label><br>

        <label for="gender-male">
            <input type="radio" name="gender" value="Male" <?= ($customer['gender'] == 'Male') ? 'checked' : '' ?> required> Male <i class="fa-solid fa-mars"></i>
        </label>

        <label for="gender-female">
            <input type="radio" name="gender" value="Female" <?= ($customer['gender'] == 'Female') ? 'checked' : '' ?>> Female <i class="fa-solid fa-venus"></i>
        </label>

        </div>

        <div class="birthdate-field">
        <label for="birthdate">Birthdate:</label>
        <input type="date" name="birthdate" id="birthdate" value="<?= htmlspecialchars($customer['birthdate']) ?>" required><br><br>
        </div>
        </div>
        <div class="button-fields">
            <button type="submit"><i class="fa-solid fa-plus"></i><p>Save Changes</p></button>
        <a href="index.php?page=customer_view"><i class="fa-solid fa-ban"></i><p>Cancel</p></a>

        </div>
    </form>

    </div>
