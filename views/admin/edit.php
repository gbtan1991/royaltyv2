<div class="container">
    <h2>Edit Administrator: <?= htmlspecialchars($admin['username']) ?></h2>

    <form action="/royaltyv2/public/admin/update/<?= $admin['id'] ?>" method="POST">
        <fieldset>
            <legend>Account Information</legend>
            <p>
                <label>First Name:</label><br>
                <input type="text" name="first_name" value="<?= htmlspecialchars($admin['first_name']) ?>" required>
            </p>
            <p>
                <label>Last Name:</label><br>
                <input type="text" name="last_name" value="<?= htmlspecialchars($admin['last_name']) ?>" required>
            </p>
            <p>
                <label>Email:</label><br>
                <input type="email" name="email" value="<?= htmlspecialchars($admin['email']) ?>" required>
            </p>
        </fieldset>

        <fieldset style="margin-top: 20px;">
            <legend>System Permissions</legend>
            <p>
                <label>Role:</label><br>
                <select name="role" required>
                    <option value="Staff" <?= $admin['role'] == 'Staff' ? 'selected' : '' ?>>Staff</option>
                    <option value="Manager" <?= $admin['role'] == 'Manager' ? 'selected' : '' ?>>Manager</option>
                    <option value="SuperAdmin" <?= $admin['role'] == 'SuperAdmin' ? 'selected' : '' ?>>SuperAdmin</option>
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
            <button type="submit">Update Admin</button>
            <a href="/royaltyv2/public/admin">Cancel</a>
        </div>
    </form>
</div>