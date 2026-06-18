<h1>Documents</h1>

<p>Generated barangay documents and certificates.</p>

<p>
    <a href="<?= url('documents/create') ?>">Generate Document</a>
</p>

<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>Control No.</th>
            <th>Resident</th>
            <th>Document Type</th>
            <th>Purpose</th>
            <th>Issued By</th>
            <th>Issued At</th>
        </tr>
    </thead>

    <tbody>
        <?php if (!empty($documents)): ?>
            <?php foreach ($documents as $document): ?>
                <tr>
                    <td><?= htmlspecialchars($document['control_no']) ?></td>
                    <td>
                        <?= htmlspecialchars($document['last_name']) ?>,
                        <?= htmlspecialchars($document['first_name']) ?>
                        <?= htmlspecialchars($document['middle_name']) ?>
                    </td>
                    <td><?= htmlspecialchars(str_replace('_', ' ', ucwords($document['document_type'], '_'))) ?></td>
                    <td><?= htmlspecialchars($document['purpose'] ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($document['issued_by_name'] ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($document['issued_at']) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6">No documents generated yet.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>