<h1>Edit Household</h1>

<div class="action-bar">
    <a class="action-link" href="<?= url('households') ?>">&larr; Back</a>
</div>

<form action="<?= url('households/' . $household['id'] . '/update') ?>" method="POST">
    <div class="form-section">
        <div>
            <label for="household_no">Household Number</label>
            <input
                type="text"
                id="household_no"
                name="household_no"
                value="<?= htmlspecialchars($household['household_no']) ?>"
                required
            >
        </div>

        <div>
            <label for="head_resident_id">Household Head</label>
            <select id="head_resident_id" name="head_resident_id">
                <option value="">Not assigned</option>

                <?php foreach ($residents as $resident): ?>
                    <option
                        value="<?= htmlspecialchars($resident['id']) ?>"
                        <?= $household['head_resident_id'] == $resident['id'] ? 'selected' : '' ?>
                    >
                        <?= htmlspecialchars($resident['last_name']) ?>,
                        <?= htmlspecialchars($resident['first_name']) ?>
                        <?= htmlspecialchars($resident['middle_name'] ?? '') ?>
                        <?= htmlspecialchars($resident['suffix'] ?? '') ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <?php if (empty($residents)): ?>
                <p>No residents are assigned to this household yet.</p>
            <?php endif; ?>
        </div>

        <div>
            <label for="purok">Purok</label>
            <input
                type="text"
                id="purok"
                name="purok"
                value="<?= htmlspecialchars($household['purok']) ?>"
                required
            >
        </div>

        <div>
            <label for="sitio">Sitio</label>
            <input
                type="text"
                id="sitio"
                name="sitio"
                value="<?= htmlspecialchars($household['sitio'] ?? '') ?>"
            >
        </div>

        <div>
            <label for="street">Street</label>
            <input
                type="text"
                id="street"
                name="street"
                value="<?= htmlspecialchars($household['street'] ?? '') ?>"
            >
        </div>

        <div>
            <label for="house_no">House No.</label>
            <input
                type="text"
                id="house_no"
                name="house_no"
                value="<?= htmlspecialchars($household['house_no'] ?? '') ?>"
            >
        </div>

        <div>
            <label for="address">Full Address</label>
            <textarea id="address" name="address"><?= htmlspecialchars($household['address'] ?? '') ?></textarea>
        </div>

        <div>
            <label for="household_type">Household Type</label>
            <select id="household_type" name="household_type">
                <option value="">Select type</option>
                <option value="nuclear" <?= ($household['household_type'] ?? '') === 'nuclear' ? 'selected' : '' ?>>Nuclear</option>
                <option value="extended" <?= ($household['household_type'] ?? '') === 'extended' ? 'selected' : '' ?>>Extended</option>
                <option value="single_parent" <?= ($household['household_type'] ?? '') === 'single_parent' ? 'selected' : '' ?>>Single Parent</option>
                <option value="solo_living" <?= ($household['household_type'] ?? '') === 'solo_living' ? 'selected' : '' ?>>Solo Living</option>
                <option value="other" <?= ($household['household_type'] ?? '') === 'other' ? 'selected' : '' ?>>Other</option>
            </select>
        </div>

        <div>
            <label for="monthly_income">Monthly Income</label>
            <input
                type="number"
                id="monthly_income"
                name="monthly_income"
                min="0"
                step="0.01"
                value="<?= htmlspecialchars($household['monthly_income'] ?? '') ?>"
            >
        </div>

        <button type="submit" class="button-primary">Update Household</button>
    </div>
</form>
