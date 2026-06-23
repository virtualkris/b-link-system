<h1>Login</h1>

<div class="login-page">
    <div class="login-card">
        <h1>B-Link</h1>
        <p>Barangay Information & Services Management System</p>

        <?php if (!empty($error)): ?>
            <p class="alert alert-error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <form action="<?= url('login') ?>" method="POST">
            <div>
                <label for="email">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    required
                >
            </div>

            <div>
                <label for="password">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    required
                >
            </div>

            <button type="submit" class="button-primary">Login</button>
        </form>
    </div>
</div>
