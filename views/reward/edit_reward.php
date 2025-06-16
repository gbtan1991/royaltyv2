<?php 
require_once __DIR__ . '/../../config/session.php';
?>

<div class="edit-reward-page">

    <h2>Edit Reward</h2>

    <div class="notification">
        <?php if(isset($_GET['success'])): ?>
            <p style="color: green;"><?= htmlspecialchars($_GET['success']) ?></p>
        <?php endif; ?>
        <?php if(isset($_GET['error'])): ?>
            <p style="color: red;"><?= htmlspecialchars($_GET['error']) ?></p>
        <?php endif; ?>
    </div>

    <form action="index.php?page=update_reward" method="post">
        <input type="hidden" name="id" value="<?= htmlspecialchars($reward['id']) ?>">

        <div class="label-field">
            <label for="reward_name">Reward Name:</label>
            <input type="text" id="reward_name" name="reward_name" value="<?= htmlspecialchars($reward['reward_name']) ?>" required>
        </div>

        <div class="label-field">
            <label for="required_points">Required Points:</label>
            <input type="number" id="required_points" name="required_points" value="<?= htmlspecialchars($reward['required_points']) ?>" required>
        </div>

        <div class="label-field">
            <label for="reward_description">Reward Description:</label>
            <textarea id="reward_description" name="reward_description" required><?= htmlspecialchars($reward['reward_description']) ?></textarea>
        </div>

        <div class="button-fields">
            <button type="submit"><i class="fa-solid fa-plus"></i><p>Save Changes</p></button>
            <a href="index.php?page=reward_view"><i class="fa-solid fa-ban"></i><p>Cancel</p></a>
        </div>
    </form>

</div>
