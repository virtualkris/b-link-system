<h1>Household Profile</h1>

<div class="action-bar">
    <a class="action-link" href="<?= url('households') ?>">&larr; Back</a>
    <a class="action-link" href="<?= url('households/' . $household['id'] . '/edit') ?>">Edit</a>
</div>

<div class="resident-profile-card">
    <section class="resident-profile-column">
        <h2>Household Information</h2>

        <p><strong>Household No.:</strong> <?= htmlspecialchars($household['household_no']) ?></p>
        <p><strong>Purok:</strong> <?= htmlspecialchars($household['purok']) ?></p>
        <p><strong>Sitio:</strong> <?= htmlspecialchars($household['sitio'] ?? 'N/A') ?></p>
        <p><strong>Street:</strong> <?= htmlspecialchars($household['street'] ?? 'N/A') ?></p>
        <p><strong>House No.:</strong> <?= htmlspecialchars($household['house_no'] ?? 'N/A') ?></p>
        <p><strong>Address:</strong> <?= htmlspecialchars($household['address'] ?? 'N/A') ?></p>
    </section>

    <section class="resident-profile-column">
        <h2>Classification</h2>

        <p><strong>Household Type:</strong> <?= htmlspecialchars($household['household_type'] ?? 'N/A') ?></p>
        <p><strong>Monthly Income:</strong> <?= htmlspecialchars($household['monthly_income'] ?? 'N/A') ?></p>
        <p><strong>Residents:</strong> <?= count($residents) ?></p>
    </section>

    <section class="resident-profile-column">
        <h2>Members</h2>

        <?php if (!empty($residents)): ?>
            <ul>
                <?php foreach ($residents as $resident): ?>
                    <li>
                        <?= htmlspecialchars($resident['last_name']) ?>,
                        <?= htmlspecialchars($resident['first_name']) ?>
                        <?= htmlspecialchars($resident['middle_name'] ?? '') ?>
                        <?= htmlspecialchars($resident['suffix'] ?? '') ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No residents assigned to this household yet.</p>
        <?php endif; ?>
    </section>
</div>
