<div class="admin-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h2>Administrator Management</h2>
    <a href="/royaltyv2/public/admin/create" class="btn-add" style="background: #28a745; color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px;">+ Add New Admin</a>
</div>

<table border="1" cellpadding="10" style="width: 100%; border-collapse: collapse; text-align: left;">
    <thead style="background-color: #f8f9fa;">
        <tr>
            <th>Full Name</th>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
            <th>Last Login</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($admins)): ?>
            <tr>
                <td colspan="7" style="text-align: center;">No administrators found.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($admins as $admin): ?>
            <tr>
                <td><strong><?= htmlspecialchars($admin['first_name'] . ' ' . $admin['last_name']) ?></strong></td>
                <td><?= htmlspecialchars($admin['username']) ?></td>
                <td><?= htmlspecialchars($admin['email']) ?></td>
                <td>
                    <span class="badge-role" style="padding: 3px 8px; background: #eee; border-radius: 4px; font-size: 0.85em;">
                        <?= htmlspecialchars($admin['role']) ?>
                    </span>
                </td>
                <td>
                    <?php if ($admin['is_active']): ?>
                        <span style="color: green;">● Active</span>
                    <?php else: ?>
                        <span style="color: red;">○ Inactive</span>
                    <?php endif; ?>
                </td>
                <td><?= $admin['last_login'] ? date('M d, Y H:i', strtotime($admin['last_login'])) : '<span style="color: #999;">Never</span>' ?></td>
                <td>
                    <a href="/royaltyv2/public/admin/show/<?= $admin['id'] ?>" style="color: #007bff;">View</a> | 
                    <a href="/royaltyv2/public/admin/edit/<?= $admin['id'] ?>" style="color: #f39c12;">Edit</a> | 
                    <form action="/royaltyv2/public/admin/destroy/<?= $admin['id'] ?>" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to remove this admin? User account will remain but admin access will be revoked.');">
                        <button type="submit" style="background: none; border: none; color: #e74c3c; cursor: pointer; padding: 0; font: inherit; text-decoration: underline;">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>