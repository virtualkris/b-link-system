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

<p>
    <button onclick="window.print()">Print</button>
    <a href="<?= url('documents')?>">Back to Documents</a>
</p>

<style>
    @media print {
        nav,
        button,
        a {
            display: none;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }
    }
</style>