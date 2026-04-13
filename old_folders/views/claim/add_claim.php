<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../config/session.php';
require_once __DIR__ . '/../../models/Customer.php';
require_once __DIR__ . '/../../models/Reward.php';

if (!isset($_SESSION['admin'])) {
    header('Location: ../../public/login.php');
    exit();
}

$customerModel = new Customer($pdo);
$customers = $customerModel->getAllCustomers();

$rewardModel = new Reward($pdo);
$rewards = $rewardModel->getAllRewards();
?>

<div class="add-claim-page">
    <h2>Claim Rewards</h2>

    <div class="notification">

    <?php if (isset($_GET['success'])): ?>
        <p style="color: green;"><?= htmlspecialchars($_GET['success']) ?></p>
    <?php endif; ?>
    <?php if (isset($_GET['error'])): ?>
        <p style="color: red;"><?= htmlspecialchars($_GET['error']) ?></p>
    <?php endif; ?>

    </div>



    <form action="index.php?page=save_claim" method="post">

    <div class="wrapper-layout">

        <div class="label-fields">
            <label for="customer_id">Select Customer:</label>
            <select name="customer_id" id="customer_id" required>
                <option value="">-- Select Customer --</option>
                <?php foreach ($customers as $customer): ?>
                    <option value="<?= $customer['id'] ?>" data-points="<?= $customer['total_points'] ?>">
                        <?= htmlspecialchars($customer['username']) ?> (Points: <?= $customer['total_points'] ?>)
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            
            <div class="label-fields">
                <label for="reward_id">Select Reward:</label>
            <select name="reward_id" id="reward_id" required disabled>
                <option value="">-- Select Reward --</option>
                <?php foreach ($rewards as $reward): ?>
                    <option value="<?= $reward['id'] ?>" data-required="<?= $reward['required_points'] ?>">
                        <?= htmlspecialchars($reward['reward_name']) ?> (Required: <?= $reward['required_points'] ?> pts)
                    </option>
                    <?php endforeach; ?>
                </select>
        </div>
        
    
        
        <div class="info-fields">

        <label for="remarks">Remarks (optional):</label>
        <textarea name="remarks" id="remarks" class="remarks"></textarea>   
        
        </div>
    <div class="button-fields">

        <button type="submit"><i class="fa-solid fa-plus"></i>Add</button>
           <a href="index.php?page=claim_view" class="cancel-link"><i class="fa-solid fa-ban"></i>Cancel</a>
      
    </div>


    </form>
     </div>
   
    <script>
        const customerSelect = document.getElementById('customer_id');
        const rewardSelect = document.getElementById('reward_id');

        const allRewardOptions = Array.from(rewardSelect.options).map(option => ({
            value: option.value,
            text: option.textContent,
            requiredPoints: parseInt(option.dataset.required || 0),
        }));

        customerSelect.addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];
            const customerPoints = parseInt(selectedOption.dataset.points || 0);

            rewardSelect.innerHTML = '<option value="">-- Select Reward --</option>';
            rewardSelect.disabled = true;

            allRewardOptions.forEach(option => {
                if (customerPoints >= option.requiredPoints) {
                    const opt = document.createElement('option');
                    opt.value = option.value;
                    opt.textContent = option.text;
                    opt.dataset.required = option.requiredPoints;
                    rewardSelect.appendChild(opt);
                }
            });

            rewardSelect.disabled = false;
        });
    </script>
</div>
