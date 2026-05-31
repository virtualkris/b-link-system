<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title><?= htmlspecialchars($title ?? 'B-Link') ?></title>
    </head>

    <body>
        <nav>
            <a href="<?= url('dashboard') ?>">B-Link</a>

            <?php if (!empty($_SESSION['user'])): ?>
                <a href="<?= url('logout') ?>">Logout</a>
            <?php endif; ?>
        </nav>

        <main>
            <?= $content ?>
        </main>
    </body>
</html>