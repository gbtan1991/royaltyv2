<div class="container">
    <h2>Edit the Customer: <?= htmlspecialchars($customer['username']) ?></h2>

    <form action="/royaltyv2/public/customer/update/<?= $customer['id'] ?>" method="POST">
        <fieldset>
            <legend>Account Information</legend>
            <p>
                <label>First Name:</label><br>
                <input type="text" name="first_name" value="<?= htmlspecialchars($customer['first_name']) ?>" required>
            </p>
            <p>
                <label>Last Name:</label><br>
                <input type="text" name="last_name" value="<?= htmlspecialchars($customer['last_name']) ?>" required>
            </p>
            <p>
                <label>Email:</label><br>
                <input type="email" name="email" value="<?= htmlspecialchars($customer['email']) ?>" required>
            </p>
        </fieldset>

        <fieldset style="margin-top: 20px;">
            <legend>Customer Details</legend>
            <p>
                <label>Loyalty Tier:</label><br>
                <select name="loyalty_tier" required>
                    <option value="Bronze" <?= $customer['loyalty_tier'] == 'Bronze' ? 'selected' : '' ?>>Bronze</option>
                    <option value="Silver" <?= $customer['loyalty_tier'] == 'Silver' ? 'selected' : '' ?>>Silver</option>
                    <option value="Gold" <?= $customer['loyalty_tier'] == 'Gold' ? 'selected' : '' ?>>Gold</option>
                </select>
            </p>
            <p>
                <label>Status:</label><br>
                <select name="is_active">
                    <option value="1" <?= $admin['is_active'] == 1 ? 'selected' : '' ?>>Active</option>
                    <option value="0" <?= $admin['is_active'] == 0 ? 'selected' : '' ?>>Inactive</option>
                </select>
            </p>
        </fieldset>

        <div style="margin-top: 20px;">
            <button type="submit">Update Customer</button>
            <a href="/royaltyv2/public/customer">Cancel</a>
        </div>
    </form>
</div>