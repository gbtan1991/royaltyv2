<div class="container">
    <h2>Create New Administrator</h2>
    <p>This will create both a login account and admin permissions.</p>

    <form action="/royaltyv2/public/admin/store" method="POST">
        <fieldset>
            <legend>Account Details</legend>
            <div class="form-group">
                <label>First Name:</label>
                <input type="text" name="first_name" required>
            </div>

            <div class="form-group">
                <label>Last Name:</label>
                <input type="text" name="last_name" required>
            </div>

            <div class="form-group">
                <label>Username:</label>
                <input type="text" name="username" required>
            </div>

            <div class="form-group">
                <label>Email Address:</label>
                <input type="email" name="email" required>
            </div>

            <div class="form-group">
                <label>Password:</label>
                <input type="password" name="password" required>
            </div>

            <div class="form-group">
                <label>Birthdate:</label>
                <input type="date" name="birthdate">
            </div>
        </fieldset>

        <fieldset style="margin-top: 20px;">
            <legend>Administrative Role</legend>
            <div class="form-group">
                <label>System Role:</label>
                <select name="role" required>
                    <option value="Staff">Staff</option>
                    <option value="Manager">Manager</option>
                    <option value="SuperAdmin">SuperAdmin</option>
                </select>
            </div>
        </fieldset>

        <div style="margin-top: 20px;">
            <button type="submit" class="btn-primary">Create Admin</button>
            <a href="/royaltyv2/public/admin" class="btn-secondary">Cancel</a>
        </div>
    </form>
</div>