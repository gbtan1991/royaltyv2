<?php 
require_once __DIR__ . '/../../config/session.php';
?>

<div class="edit-claim-page">

<h2>Adjust Claim</h2>

<div class="notification">

<?php if(isset($_GET['success'])): ?>
    <p style="color: green;"><?= htmlspecialchars($_GET['success']) ?></p>
<?php endif; ?>
<?php if(isset($_GET['error'])): ?>
    <p style="color: red;"><?= htmlspecialchars($_GET['error']) ?></p>
<?php endif; ?>

</div>

    <form action="index.php?page=update_claim" method="post">

        <input type="hidden" name="claim_id" value="<?= $claim['claim_id'] ?>">

        <div class="label-fields">
            <label for="reward_id">Select Reward:</label>
            <select name="reward_id" id="reward_id" required>
                <option value="<?= htmlspecialchars($claim['reward_id']) ?>" selected><?= htmlspecialchars($claim['reward_name']) ?></option>
            </select>
        </div>

    </form>





</div>