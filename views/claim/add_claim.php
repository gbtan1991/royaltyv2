<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../config/session.php';
require_once __DIR__ . '/../../models/Customer.php';
require_once __DIR__ . '/../../models/Reward.php';

if (!isset($_SESSION['admin'])){
    header('Location: ../../public/login.php');
    exit();
}

$rewardModel = new Reward($pdo);
$rewards = $rewardModel->getAllRewards();

$customerModel = new Customer($pdo);
$customers = $customerModel->getAllCustomers();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Claim Rewards</title>
</head>
<body>
    <h2>Claim Rewards</h2>

    <?php if(isset($_GET['success'])): ?>
        <p style="color: green;"><?= htmlspecialchars($_GET['success']) ?></p>
    <?php endif; ?>
    <?php if(isset($_GET['error'])): ?>
        <p style="color: red;"><?= htmlspecialchars($_GET['error']) ?></p>
    <?php endif; ?>

    <form action="../../controllers/claim/add_claim.php" method="post">
        <label for="reward_id">Select Reward:</label>
        <select name="reward_id" id="reward_id" required>
            <option value="">-- Select Reward --</option>
            <?php foreach ($rewards as $reward): ?>
                <option value="<?= $reward['id'] ?>" data-required="<?= $reward['required_points'] ?>">
                    <?= htmlspecialchars($reward['reward_name']) ?> (Required: <?= $reward['required_points'] ?> pts)
                </option>
            <?php endforeach; ?>
        </select>
        <br><br>

        <label for="customer_id">Select Customer:</label>
        <select name="customer_id" id="customer_id" required>
            <option value="">-- Select Customer --</option>
            <?php foreach ($customers as $customer): ?>
                <option value="<?= $customer['id'] ?>" data-points="<?= $customer['total_points'] ?>" hidden>
                    <?= htmlspecialchars($customer['username']) ?> (Points: <?= $customer['total_points'] ?>)
                </option>
            <?php endforeach; ?>
        </select>
        <br><br>

        <label for="remarks">Remarks (optional):</label><br>
        <input type="text" name="remarks" id="remarks">
        <br><br>

        <input type="submit" value="Claim Reward">
    </form>

    <script>
    const rewardSelect = document.getElementById('reward_id');
    const customerSelect = document.getElementById('customer_id');

    // Store the initial customer options as data, not DOM elements
    const allCustomerOptions = Array.from(customerSelect.options).map(option => ({
        value: option.value,
        text: option.textContent,
        points: parseInt(option.dataset.points || 0),
    }));

    rewardSelect.addEventListener('change', function () {
        const requiredPoints = parseInt(this.options[this.selectedIndex].dataset.required || 0);

        customerSelect.innerHTML = '<option value="">-- Select Customer --</option>';

        allCustomerOptions.forEach(option => {
            if (option.points >= requiredPoints) {
                const opt = document.createElement('option');
                opt.value = option.value;
                opt.textContent = option.text;
                opt.dataset.points = option.points;
                customerSelect.appendChild(opt);
            }
        });
    });
</script>

</body>
</html>
