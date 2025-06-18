<?php
require_once __DIR__ . '/../../helpers/format.php';

?>
<div class="reward-view-layout">

    <h2>Rewards Management</h2>


    <!-- Notifications for adding -->
    <?php if (isset($_GET['success'])): ?>
        <p style="color: green;"><?= htmlspecialchars($_GET['success']) ?></p>
    <?php endif; ?>
    <?php if (isset($_GET['error'])): ?>
        <p style="color: red;"><?= htmlspecialchars($_GET['error']) ?></p>
    <?php endif; ?>



    <input type="text" id="search-reward" placeholder="Search Reward">


    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Reward Name</th>
                <th>Required Points</th>
                <th>Reward Description</th>
                <th>Created Date</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody id="reward-table-body">
            <?php if (!empty($reward)): ?>
                <?php foreach ($reward as $rewards): ?>
                    <tr>
                        <td><?= htmlspecialchars($rewards['id']) ?></td>
                        <td><?= htmlspecialchars($rewards['reward_name']) ?></td>
                        <td><?= htmlspecialchars($rewards['required_points']) ?></td>
                        <td><?= htmlspecialchars($rewards['reward_description']) ?></td>
                        <td><?= formatDateTime($rewards['created_at']) ?></td>
                        <td class="table-actions">
                        <a href="index.php?page=edit_reward&id=<?= $rewards['id'] ?>"><i class="fa-solid fa-wrench"></i></a>
                        <a href="index.php?page=delete_reward&id=<?= $rewards['id'] ?>" class="delete-button" onclick="return confirm('Are you sure you want to delete this reward?')"><i class="fa-solid fa-trash"></i></a>
                    </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">Theres no current rewards</td>
                </tr>
            <?php endif; ?>
        </tbody>

    </table>

</div>

<div id="pagination-controls">
    <button id="prev-page" class="pagination"></button>
</div>
