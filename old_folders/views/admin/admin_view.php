<?php 
require_once __DIR__ . '/../../helpers/format.php';


?>

<div class="admin-view-layout">
 
    <h2>Admin Accounts</h2>

    <!-- Notifications -->
    <?php if (isset($_GET['success'])): ?>
        <p style="color: green;"><?= htmlspecialchars($_GET['success']) ?></p>
    <?php endif; ?>
    <?php if (isset($_GET['error'])): ?>
        <p style="color: red;"><?= htmlspecialchars($_GET['error']) ?></p>
    <?php endif; ?>

  
    

    <!-- Admin Table -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Role</th>
                <th>Created At</th>
                <th>Modified At</th>
                <th colspan="2">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($admins as $admin): ?>
                <tr>
                    <td><?= htmlspecialchars($admin['id']) ?></td>
                    <td><?= htmlspecialchars($admin['username']) ?></td>
                    <td> <?php 
        if ($admin['role'] === 'superadmin') {
            echo 'Super Admin';
        } else {
            echo 'Admin';
        }
    ?></td>
                    <td><?= formatDateTime($admin['created_at']) ?></td>
                    <td><?= formatDateTime($admin['modified_at']) ?></td>
                    <td class="table-actions">
                        <a href="index.php?page=edit_admin&id=<?= $admin['id'] ?>"><i class="fa-solid fa-wrench"></i></a> 
    
                    <a href="index.php?page=delete_admin&id=<?= $admin['id'] ?>" class="delete-button" onclick="return confirm('Are you sure you want to delete this admin?');"><i class="fa-solid fa-trash"></i></a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    


</div>
