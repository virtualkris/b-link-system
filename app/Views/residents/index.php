<h1>Residents</h1>

<p>Resident records and household information.</p>

<div class="action-bar">
    <a class="button-primary" href="<?= url('residents/create') ?>">+ Register Resident</a>
</div>

<form action="<?= url('residents') ?>" method="GET">
    <input
        type="text"
        name="search"
        value="<?= htmlspecialchars($search ?? '') ?>"
        placeholder="Search residents..."
    >

    <button type="submit" class="button-primary">Search</button>

    <?php if (!empty($search)): ?>
        <a class="action-link" href="<?= url('residents') ?>">Clear</a>
    <?php endif ?>
</form>

<table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>Name</th>
                <th>Gender</th>
                <th>Birthdate</th>
                <th>Civil Status</th>
                <th>Household No.</th>
                <th>Purok</th>
                <th>Voter Status</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            <?php if (!empty($residents)): ?>
                <?php foreach ($residents as $resident): ?>
                    <tr>
                        <td>
                            <?= htmlspecialchars($resident['last_name']) ?>,
                            <?= htmlspecialchars($resident['first_name']) ?>
                            <?= htmlspecialchars($resident['middle_name'] ?? '') ?>
                        </td>

                        <td><?= htmlspecialchars(ucfirst($resident['gender'])) ?></td>
                        <td><?= htmlspecialchars($resident['birthdate']) ?></td>
                        <td><?= htmlspecialchars($resident['civil_status']) ?></td>
                        <td>
                            <?= htmlspecialchars($resident['household_no'] ?? 'No household') ?>
                        </td>
                        <td><?= htmlspecialchars($resident['purok'] ?? 'N/A') ?></td>
                        <td><?= htmlspecialchars($resident['voter_status'])  ?></td>
                        <td>
                            <div class="table-actions">
                                <a class="action-link" href="<?= url('residents/' . $resident['id']) ?>">View</a>
                                <a class="action-link" href="<?= url('residents/' . $resident['id'] . '/edit') ?>">Edit</a>

                                <form
                                    class="archive-form inline-form"
                                    action="<?= url('residents/' . $resident['id'] . '/archive') ?>"
                                    method="POST"
                                >
                                    <button type="submit" class="button-danger">Archive</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8">No residents found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
</table>
