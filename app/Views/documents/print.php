<h1><?= htmlspecialchars(str_replace('_', ' ', ucwords($document['document_type'], '_'))) ?></h1>

<p><strong>Control No:</strong> <?= htmlspecialchars($document['control_no']) ?></p>
<p><strong>Issued At:</strong> <?= htmlspecialchars($document['issued_at']) ?></p>

<hr>

<p>
    To whom it may concern:
</p>

<p>
    <?= nl2br(htmlspecialchars($document['content'])) ?>
</p>

<br><br>

<p>
    _______________________________<br>
    Barangay Official / Authorized Staff
</p>

<p>
    Issued by: <?= htmlspecialchars($document['issued_by_name'] ?? 'N/A') ?>
</p>

<div class="action-bar">
    <button class="button-primary" onclick="window.print()">Print</button>
    <a class="action-link" href="<?= url('documents')?>">&larr; Back</a>
</div>

<style>
    @media print {
        nav,
        .app-nav,
        .nav-toggle,
        .nav-toggle-label,
        .alert,
        .action-bar,
        button,
        a {
            display: none !important;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }
    }
</style>
