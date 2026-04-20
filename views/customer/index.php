<div class="customer-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h2>Customer Management</h2>
    <a href="/royaltyv2/public/customer/create" class="btn-add" style="background: #28a745; color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px;">+ Add New Customer</a>
</div>

<table border="1" cellpadding="10" style="width: 100%; border-collapse: collapse; text-align: left;">
    <thead style="background-color: #f8f9fa;">
        <tr>
            <th>Member ID</th>
            <th>Full Name</th>
            <th>Username</th>
            <th>Email</th>
            <th>Tier</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($customers)): ?>
            <tr>
                <td colspan="7" style="text-align: center;">No customers found.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($customers as $customer): ?>
            <tr>
                <td><strong><?= htmlspecialchars($customer['member_id']); ?></strong></td>
                <td><?= htmlspecialchars($customer['first_name'] . ' ' . $customer['last_name']) ?></td>
                <td><?= htmlspecialchars($customer['username']) ?></td>
                <td><?= htmlspecialchars($customer['email']) ?></td>
                <td>
                    <?php 
                        // Logic for the badge styling
                        $bg = '#eee'; $color = 'black';
                        if ($customer['loyalty_tier'] == 'Gold') { $bg = 'gold'; }
                        elseif ($customer['loyalty_tier'] == 'Silver') { $bg = 'silver'; }
                        elseif ($customer['loyalty_tier'] == 'Bronze') { $bg = '#cd7f32'; $color = 'white'; }
                    ?>
                    <span class="badge-tier" style="padding: 3px 8px; background: <?= $bg ?>; color: <?= $color ?>; border-radius: 4px; font-size: 0.85em; font-weight: bold;">
                        <?= htmlspecialchars($customer['loyalty_tier']) ?>
                    </span>
                </td>
                <td>
                    <?php if ($customer['is_active']): ?>
                        <span style="color: green;">● Active</span>
                    <?php else: ?>
                        <span style="color: red;">○ Inactive</span>
                    <?php endif; ?>
                </td>
                <td>
                    <a href="/royaltyv2/public/customer/show/<?= $customer['id'] ?>" style="color: #007bff;">View</a> | 
                    <a href="/royaltyv2/public/customer/edit/<?= $customer['id'] ?>" style="color: #f39c12;">Edit</a> | 
                    <form action="/royaltyv2/public/customer/destroy/<?= $customer['id'] ?>" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this customer? This action cannot be undone.');">
                        <button type="submit" style="background: none; border: none; color: #e74c3c; cursor: pointer; padding: 0; font: inherit; text-decoration: underline;">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>