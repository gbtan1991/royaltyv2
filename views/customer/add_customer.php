<?php
require_once __DIR__ . '/../../config/database.php';

?>

<div class="add-customer-page">



<h2>Register New Customer</h2>

<div class="notification">
<?php if(isset($_GET['success'])): ?>
        <p style="color: green;"><?= htmlspecialchars($_GET['success']) ?></p>
    <?php endif; ?>
    <?php if(isset($_GET['error'])): ?>
        <p style="color: red;"><?= htmlspecialchars($_GET['error']) ?></p>
    <?php endif; ?>

</div>


<form action="index.php?page=save_customer" method="post">
    
    <div class="label-fields">
    <label for="username">Username:</label>
    <input type="text" name="username" id="username" required><br><br>
    </div>

   <div class="label-fields">
    <label for="fullname">Full name:&nbsp;</label>
    <input type="text" name="fullname" id="fullname" required><br><br>
    </div>


   <div class="info-fields">
       
       <div class="gender-options">
           
           <label>Gender:</label><br>
        <label for="gender-male">
            <input type="radio" name="gender" id="gender-male" value="Male" required>
            Male <i class="fa-solid fa-mars"></i>
        </label>
        
        <label for="gender-female">
            <input type="radio" name="gender" id="gender-female" value="Female">
            Female <i class="fa-solid fa-venus"></i>
        </label><br><br>
    </div>
    <div class="birthdate-field">
        <p><label for="birthdate">Birthdate:</label></p>
        <input type="date" name="birthdate" id="birthdate" required>

    </div>   
</div>
    <div class="button-fields">
        <button type="submit"><i class="fa-solid fa-plus"></i><p>Add</p></button>
        <a href="index.php?page=customer_view"><i class="fa-solid fa-ban"></i><p>Cancel</p></a>

    </div>
</form>


</div>