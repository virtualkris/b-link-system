<h1>Resident Profile</h1>

<p>
    <a href="<?= url('residents') ?>">Back to Residents</a>
    <a href="<?= url('residents/' . $resident['id'] . '/edit') ?>">Edit</a>
</p>

<form
    action="<?= url('residents/' . $resident['id'] . '/archive') ?>"
    method="POST"
    onsubmit="return confirm('Archive this resident?');"
>
    <button type="submit">Archive</button>
</form>

<h2>Personal Information</h2>

<p>
    <strong>Name:</strong>
    <?= htmlspecialchars($resident['first_name']) ?>
    <?= htmlspecialchars($resident['middle_name'] ?? '') ?>
    <?= htmlspecialchars($resident['last_name']) ?>
    <?= htmlspecialchars($resident['suffix'] ?? '') ?>
</p>

<p>
    <strong>Gender:</strong>
    <?= htmlspecialchars(ucfirst($resident['gender'])) ?>
</p>

<p>
    <strong>Birthdate:</strong>
    <?= htmlspecialchars($resident['birthdate']) ?>
</p>

<p>
    <strong>Birthplace:</strong>
    <?= htmlspecialchars($resident['birthplace'] ?? 'N/A') ?>
</p>

<p>
    <strong>Civil Status:</strong>
    <?= htmlspecialchars($resident['civil_status']) ?>
</p>

<p>
    <strong>Nationality:</strong>
    <?= htmlspecialchars($resident['nationality'] ?? 'N/A') ?>
</p>

<p>
    <strong>Religion:</strong>
    <?= htmlspecialchars($resident['religion'] ?? 'N/A') ?>
</p>

<h2>Household Information</h2>

<p>
    <strong>Household No.:</strong>
    <?=  htmlspecialchars($resident['household_no'] ?? 'No household') ?>
</p>

<p>
    <strong>Purok:</strong>
    <?= htmlspecialchars($resident['purok'] ?? 'N/A') ?>
</p>

<p>
    <strong>Address:</strong>
    <?= htmlspecialchars($resident['address'] ?? 'N/A') ?>
</p>

<h2>Contact & Background</h2>

<p>
    <strong>Contact Number</strong>
    <?= htmlspecialchars($resident['contact_number'] ?? 'N/A') ?>
</p>

<p>
    <strong>Email:</strong>
    <?= htmlspecialchars($resident['email'] ?? 'N/A') ?>
</p>

<p>
    <strong>Occupation:</strong>
    <?= htmlspecialchars($resident['occupation'] ?? 'N/A') ?>
</p>

<p>
    <strong>Educational Attainment:</strong>
    <?= htmlspecialchars($resident['educational_attainment'] ?? 'N/A') ?>
</p>

<p>
    <strong>Voter Status:</strong>
    <?= htmlspecialchars($resident['voter_status']) ?>
</p>

<p>
    <strong>Precinct No.:</strong>
    <?= htmlspecialchars($resident['precinct_no'] ?? 'N/A') ?>
</p>

<h2>Sectoral & Vulnerability</h2>

<ul>
    <?php if ($resident['sector_senior_citizen']): ?>
        <li>Senior Citizen</li>
    <?php endif; ?>
    <?php if ($resident['sector_pwd']): ?>
        <li>Person with Disability</li>
    <?php endif; ?>
    <?php if ($resident['sector_solo_parent']): ?>
        <li>Solo Parent</li>
    <?php endif; ?>
    <?php if ($resident['sector_indigenous_people']): ?>
        <li>Indigenous People</li>
    <?php endif; ?>
    <?php if ($resident['sector_4ps_member']): ?>
        <li>4Ps Member</li>
    <?php endif; ?>
    <?php if ($resident['sector_out_of_school_youth']): ?>
        <li>Out-of-School Youth</li>
    <?php endif; ?>
    <?php if ($resident['is_minor']): ?>
        <li>Minor</li>
    <?php endif; ?>
    <?php if ($resident['is_pregnant']): ?>
        <li>Pregnant</li>
    <?php endif; ?>
    <?php if ($resident['is_lactating_mother']): ?>
        <li>Lactating Mother</li>
    <?php endif; ?>
    <?php if ($resident['is_bedridden']): ?>
        <li>Bedridden</li>
    <?php endif; ?>
</ul>

<h2>Emergency Contact</h2>

<p>
    <strong>Name:</strong>
    <?= htmlspecialchars($resident['emergency_contact_name'] ?? 'N/A') ?>
</p>

<p>
    <strong>Number:</strong>
    <?= htmlspecialchars($resident['emergency_contact_number'] ?? 'N/A') ?>
</p>