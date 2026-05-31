<h1>B-Link Dashboard</h1>

<p>Integrated Resident Information & Services Management System</p>

<?php if (!empty($_SESSION['user'])): ?>
    <p>Welcome, <?= htmlspecialchars($_SESSION['user']['name']) ?></p>
    <p>Role: <?= htmlspecialchars($_SESSION['user']['role']) ?></p>
<?php endif; ?>