<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= htmlspecialchars($title ?? 'B-Link') ?></title>
        <link rel="stylesheet" href="<?= url('css/style.css') ?>">
    </head>

    <body>
        <nav class="app-nav">
            <a class="brand" href="<?= url('dashboard') ?>">B-Link</a>

            <input type="checkbox" id="nav-toggle" class="nav-toggle">

            <label for="nav-toggle" class="nav-toggle-label">
                &#9776;
            </label>

            <?php if (!empty($_SESSION['user'])): ?>
                <div class="nav-menu">
                    <a href="<?= url('residents') ?>">Residents</a>
                    <a href="<?= url('households') ?>">Households</a>
                    <a href="<?= url('documents') ?>">Documents</a>
                    <a href="<?= url('disaster') ?>">Disaster</a>

                    <?php if (($_SESSION['user']['role'] ?? '') === 'admin'): ?>
                        <a href="<?= url('users') ?>">Users</a>
                    <?php endif; ?>

                    <a href="<?= url('logout') ?>">Logout</a>
                </div>
            <?php endif; ?>
        </nav>

        <main>
            <?php if (!empty($_SESSION['success'])): ?>
                <p class="alert alert-success"><?= htmlspecialchars($_SESSION['success']) ?></p>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>

            <?php if (!empty($_SESSION['error'])): ?>
                <p class="alert alert-error"><?= htmlspecialchars($_SESSION['error']) ?></p>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

            <?= $content ?>
        </main>

        <div id="archiveModal" class="modal-backdrop" hidden>
            <div class="modal-card">
                <h2>Archive Resident</h2>

                <p>
                    This resident will no longer appear in active resident records.
                    You can keep the record for reporting and history
                </p>

                <div class="modal-actions">
                    <button type="button" id="cancelArchive" class="button-secondary">
                        Cancel
                    </button>

                    <button type="button" id="confirmArchive" class="button-danger">
                        Archive
                    </button>
                </div>
            </div>
        </div>

        <script>
            const archiveForms = document.querySelectorAll('.archive-form');
            const archiveModal = document.getElementById('archiveModal');
            const cancelArchive = document.getElementById('cancelArchive');
            const confirmArchive = document.getElementById('confirmArchive');

            let selectedArchiveForm = null;

            archiveForms.forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    event.preventDefault();

                    selectedArchiveForm = form;
                    archiveModal.hidden = false;
                });
            });

            cancelArchive.addEventListener('click', function () {
                archiveModal.hidden = true;
                selectedArchiveForm = null;
            });

            confirmArchive.addEventListener('click', function () {
                if (selectedArchiveForm) {
                    selectedArchiveForm.submit();
                }
            });
        </script>
    </body>
</html>
