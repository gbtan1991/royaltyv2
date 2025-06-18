<?php
require_once __DIR__ . '/../../config/database.php';
?>

<div class="add-reward-page">

    <h2>Add New Reward</h2>

    <div class="notification">
        <?php if(isset($_GET['success'])): ?>
            <p style="color: green;"><?= htmlspecialchars($_GET['success']) ?></p>
        <?php endif; ?>
        <?php if(isset($_GET['error'])): ?>
            <p style="color: red;"><?= htmlspecialchars($_GET['error']) ?></p>
        <?php endif; ?>
    </div>

    <form action="index.php?page=save_reward" method="post">

        <div class="label-fields">
            <label for="reward_name">Reward Name:</label>
            <input type="text" id="reward_name" name="reward_name" required><br><br>
        </div>

        <div class="label-fields">
            <label for="required_points">Required Points:</label>
            <input type="number" id="required_points" name="required_points" required><br><br>
        </div>

        <div class="label-fields">
            <label for="reward_description">Reward Description:</label>
            <textarea id="reward_description" name="reward_description" required></textarea><br><br>
        </div>

        <div class="button-fields">
            <button type="submit"><i class="fa-solid fa-plus"></i><p>Add</p></button>
            <a href="index.php?page=reward_view"><i class="fa-solid fa-ban"></i><p>Cancel</p></a>
        </div>

    </form>

</div>
