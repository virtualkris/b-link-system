<h1>Generate Document</h1>

<div class="action-bar">
    <a class="action-link" href="<?= url('documents') ?>">&larr; Back</a>
</div>

<form action="<?= url('documents/store') ?>" method="POST">
    <div>
        <label for="resident_id">Resident</label>
        <select name="resident_id" id="resident_id" required>
            <option value="">Select resident</option>

            <?php foreach ($residents as $resident): ?>
                <option value="<?= htmlspecialchars($resident['id']) ?>">
                    <?= htmlspecialchars($resident['last_name']) ?>,
                    <?= htmlspecialchars($resident['first_name']) ?>
                    <?= htmlspecialchars($resident['middle_name'] ?? '') ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div>
        <label for="document_type">Document Type</label>
        <select name="document_type" id="document_type" required>
            <option value="barangay_clearance">Barangay Clearance</option>
            <option value="certificate_of_residency">Certificate of Residency</option>
            <option value="indigency_certificate">Indigency Certificate</option>
        </select>
    </div>

    <div>
        <label for="purpose">Purpose</label>
        <input type="text" id="purpose" name="purpose" placeholder="e.g. Employment requirement">
    </div>

    <button type="submit" class="button-primary">Generate</button>
</form>
