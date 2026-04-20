<div class="container" style="max-width: 600px; margin: 20px auto; font-family: sans-serif;">
    <h2 style="border-bottom: 2px solid #333; padding-bottom: 10px;">Add New Customer</h2>
    <p>Complete the fields below to register a new member in the royalty system.</p>

    <form action="/royaltyv2/public/customer/store" method="POST" style="background: #fdfdfd; padding: 20px; border: 1px solid #ddd; border-radius: 8px;">
        
        <fieldset style="border: 1px solid #ccc; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
            <legend style="font-weight: bold; padding: 0 10px;">Identity & Account</legend>
            
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px;">First Name:</label>
                <input type="text" name="first_name" style="width: 100%; padding: 8px;" placeholder="e.g. Juan" required>
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px;">Last Name:</label>
                <input type="text" name="last_name" style="width: 100%; padding: 8px;" placeholder="e.g. Dela Cruz" required>
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px;">Username:</label>
                <input type="text" name="username" style="width: 100%; padding: 8px;" required>
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px;">Email Address:</label>
                <input type="email" name="email" style="width: 100%; padding: 8px;" required>
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px;">Password:</label>
                <input type="password" name="password" style="width: 100%; padding: 8px;" required>
            </div>

            <div style="margin-bottom: 5px;">
                <label style="display: block; margin-bottom: 5px;">Birthdate:</label>
                <input type="date" name="birthdate" style="width: 100%; padding: 8px;">
            </div>
        </fieldset>

        <fieldset style="border: 1px solid #ccc; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
            <legend style="font-weight: bold; padding: 0 10px;">Membership Details</legend>
            
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px;">Member ID:</label>
                <input type="text" name="member_id" style="width: 100%; padding: 8px;" placeholder="ROY-001" required>
                <small style="color: #666;">This must be a unique identifier.</small>
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px;">Loyalty Tier:</label>
                <select name="loyalty_tier" style="width: 100%; padding: 8px;" required>
                    <option value="Bronze">Bronze</option>
                    <option value="Silver">Silver</option>
                    <option value="Gold">Gold</option>
                </select>
            </div>

            <div>
                <label style="display: block; margin-bottom: 5px;">Account Status:</label>
                <select name="is_active" style="width: 100%; padding: 8px;">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>
        </fieldset>

        <div style="text-align: right; border-top: 1px solid #eee; padding-top: 15px;">
            <a href="/royaltyv2/public/customer" style="text-decoration: none; color: #666; margin-right: 15px;">Cancel</a>
            <button type="submit" style="background: #28a745; color: white; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer; font-weight: bold;">
                Save Customer
            </button>
        </div>
    </form>
</div>