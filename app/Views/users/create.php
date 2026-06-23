<h1>Add User</h1>

<div class="action-bar">
    <a class="action-link" href="<?= url('users') ?>">&larr; Back</a>
</div>

<form action="<?= url('users/store') ?>" method="POST">
    <div class="form-section">
        <div>
            <label for="name">Name</label>
            <input type="text" id="name" name="name" required>
        </div>

        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div>
            <label for="password">Temporary Password</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div>
            <label for="role">Role</label>
            <select id="role" name="role" required>
                <option value="staff">Staff</option>
                <option value="admin">Admin</option>
            </select>
        </div>

        <button type="submit" class="button-primary">Create User</button>
    </div>
</form>
