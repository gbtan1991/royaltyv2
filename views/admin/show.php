<div class="container">
    <div style="margin-bottom: 20px;">
        <a href="/royaltyv2/public/admin" style="text-decoration: none; color: #666;">← Back to Admin List</a>
    </div>

    <div class="profile-card" style="border: 1px solid #ddd; padding: 25px; border-radius: 12px; background: #fff; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h2 style="margin: 0;">Admin Profile: <?= htmlspecialchars($admin['username'] ?? 'N/A') ?></h2>
            <span style="background: #007bff; color: white; padding: 6px 15px; border-radius: 20px; font-size: 0.85em; font-weight: bold; text-transform: uppercase;">
                <?= htmlspecialchars($admin['role'] ?? 'Staff') ?>
            </span>
        </div>
        
        <hr style="border: 0; border-top: 1px solid #eee; margin: 20px 0;">

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 30px;">
            <div>
                <h4 style="color: #555; margin-bottom: 15px; border-left: 3px solid #007bff; padding-left: 10px;">Personal Information</h4>
                <p><strong>Full Name:</strong> <?= htmlspecialchars(($admin['first_name'] ?? '') . ' ' . ($admin['last_name'] ?? '')) ?></p>
                <p><strong>Email:</strong> <?= htmlspecialchars($admin['email'] ?? 'Not provided') ?></p>
                <p><strong>Birthdate:</strong> 
                    <?= !empty($admin['birthdate']) ? date('M d, Y', strtotime($admin['birthdate'])) : '<span style="color: #999;">Not set</span>' ?>
                </p>
            </div>

            <div>
                <h4 style="color: #555; margin-bottom: 15px; border-left: 3px solid #28a745; padding-left: 10px;">System Details</h4>
                <p><strong>Account Status:</strong> 
                    <?= ($admin['is_active'] ?? 0) ? '<span style="color:green; font-weight:bold;">● Active</span>' : '<span style="color:red; font-weight:bold;">● Inactive</span>' ?>
                </p>
                <p><strong>Registered On:</strong> 
                    <?= !empty($admin['created_at']) ? date('M d, Y', strtotime($admin['created_at'])) : 'N/A' ?>
                </p>
                <p><strong>Last System Access:</strong> 
                    <span style="color: #666;">
                        <?= !empty($admin['last_login']) ? date('M d, Y | H:i', strtotime($admin['last_login'])) : 'Never logged in' ?>
                    </span>
                </p>
            </div>
        </div>

        <div style="margin-top: 35px; border-top: 1px solid #eee; padding-top: 20px; display: flex; gap: 10px;">
            <a href="/royaltyv2/public/admin/edit/<?= $admin['id'] ?>" 
               style="background: #f39c12; color: white; padding: 10px 25px; text-decoration: none; border-radius: 6px; font-weight: 500;">
               Edit Account Details
            </a>
            
            <form action="/royaltyv2/public/admin/delete/<?= $admin['id'] ?>" method="POST" onsubmit="return confirm('Are you sure?');" style="display:inline;">
                <button type="submit" style="background: #e74c3c; color: white; border: none; padding: 10px 20px; border-radius: 6px; cursor: pointer;">
                    Deactivate
                </button>
            </form>
        </div>
    </div>
</div>