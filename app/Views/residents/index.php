<h1>Residents</h1>

<p>Resident records and household information.</p>

<p>
    <a href="<?= url('residents/create') ?>">Register Resident</a>
</p>

<form action="<?= url('residents') ?>" method="GET">
    <input
        type="text"
        name="search"
        value="<?= htmlspecialchars($search ?? '') ?>"
        placeholder="Search residents..."
    >

    <button type="submit">Search</button>

    <?php if (!empty($search)): ?>
        <a href="<?= url('residents') ?>">Clear</a>
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
                            <a href="<?= url('residents/' . $resident['id']) ?>">View</a>
                            <a href="<?= url('residents/' . $resident['id'] . '/edit') ?>">Edit</a>

                            <form
                                action="<?= url('residents/' . $resident['id'] . '/archive') ?>"
                                method="POST"
                                style="display:inline;"
                                onsubmit="return confirm('Archive this resident?');"
                            >
                                <button type="submit">Archive</button>
                            </form>
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