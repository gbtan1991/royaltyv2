<div class="container">
    <div style="margin-bottom: 20px;">
        <a href="/royaltyv2/public/admin">← Back to List</a>
    </div>

    <div class="profile-card" style="border: 1px solid #ddd; padding: 20px; border-radius: 8px; background: #fff;">
        <div style="display: flex; justify-content: space-between; align-items: start;">
            <h2>Admin Profile: <?= htmlspecialchars($admin['username']) ?></h2>
            <span style="background: #007bff; color: white; padding: 5px 12px; border-radius: 20px; font-size: 0.8em;">
                <?= htmlspecialchars($admin['role']) ?>
            </span>
        </div>
        
        <hr>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div>
                <h4>Personal Information</h4>
                <p><strong>Full Name:</strong> <?= htmlspecialchars($admin['first_name'] . ' ' . $admin['last_name']) ?></p>
                <p><strong>Email:</strong> <?= htmlspecialchars($admin['email']) ?></p>
                <p><strong>Birthdate:</strong> <?= $admin['birthdate'] ? date('M d, Y', strtotime($admin['birthdate'])) : 'Not set' ?></p>
            </div>

            <div>
                <h4>System Details</h4>
                <p><strong>Account Status:</strong> <?= $admin['is_active'] ? '<span style="color:green">Active</span>' : '<span style="color:red">Inactive</span>' ?></p>
                <p><strong>Registered On:</strong> <?= date('M d, Y', strtotime($admin['created_at'])) ?></p>
                <p><strong>Last System Access:</strong> <?= $admin['last_login'] ? date('M d, Y H:i', strtotime($admin['last_login'])) : 'Never' ?></p>
            </div>
        </div>

        <div style="margin-top: 30px; border-top: 1px solid #eee; padding-top: 20px;">
            <a href="/royaltyv2/public/admin/edit/<?= $admin['id'] ?>" class="btn-edit" style="background: #f39c12; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">Edit Account</a>
        </div>
    </div>
</div>