<h1>Households</h1>

<p>Registered household records for the barangay.</p>

<div class="action-bar">
    <a href="<?= url('households/create') ?>" class="button-primary">+ Register Household</a>
</div>

<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>Household No.</th>
            <th>Household Head</th>
            <th>Purok</th>
            <th>Sitio</th>
            <th>Street</th>
            <th>House No.</th>
            <th>Type</th>
            <th>Monthly Income</th>
            <th>Residents</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        <?php if (!empty($households)): ?>
            <?php foreach ($households as $household): ?>
                <tr>
                    <td><?= htmlspecialchars($household['household_no']) ?></td>
                    <td>
                        <?php if (!empty($household['head_last_name'])): ?>
                            <?= htmlspecialchars($household['head_last_name']) ?>,
                            <?= htmlspecialchars($household['head_first_name']) ?>
                            <?= htmlspecialchars($household['head_middle_name'] ?? '') ?>
                            <?= htmlspecialchars($household['head_suffix'] ?? '') ?>
                        <?php else: ?>
                            Not assigned
                        <?php endif; ?> 
                    </td>
                    <td><?= htmlspecialchars($household['purok']) ?></td>
                    <td><?= htmlspecialchars($household['sitio'] ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($household['street'] ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($household['house_no'] ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($household['household_type'] ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($household['monthly_income'] ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($household['resident_count']) ?></td>
                    <td>
                        <div class="table-actions">
                            <a class="action-link" href="<?= url('households/' . $household['id']) ?>">View</a>
                            <a class="action-link" href="<?= url('households/' . $household['id'] . '/edit') ?>">Edit</a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="10">No households found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
