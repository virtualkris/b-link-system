<h1>Disaster Response</h1>

<p class="no-print">Filter residents for relief distribution and emergency response.</p>

<div class="action-bar">
    <button class="button-primary" onclick="window.print()">Print Disaster Report</button>
</div>

<form action="<?= url('disaster/reports/store') ?>" method="POST">
    <div>
        <label for="disaster_name">Disaster/Event Name</label>
        <input type="text" name="disaster_name" id="disaster_name" required>
    </div>

    <div>
        <label for="report_purok">Affected Purok</label>
        <select name="purok" id="report_purok" required>
            <option value="">Select purok</option>
            
            <?php foreach ($puroks as $purok): ?>
                <option value="<?= htmlspecialchars($purok['purok']) ?>">
                    <?= htmlspecialchars($purok['purok']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div>
        <label for="report_date">Report Date</label>
        <input type="date" name="report_date" id="report_date" value="<?= date('Y-m-d') ?>" required>
    </div>

    <div>
        <label for="affected_households">Affected Households</label>
        <input type="number" name="affected_households" id="affected_households" min="0" value="0">
    </div>

    <div>
        <label for="affected_residents">Affected Residents</label>
        <input type="number" name="affected_residents" id="affected_residents" min="0" value="0">
    </div>

    <div>
        <label for="status">Status</label>
        <select name="status" id="status">
            <option value="monitoring">Monitoring</option>
            <option value="evacuating">Evacuating</option>
            <option value="relief_distributed">Relief Distributed</option>
            <option value="resolved">Resolved</option>
        </select>
    </div>

    <div>
        <label for="remarks">Remarks</label>
        <textarea name="remarks" id="remarks"></textarea>
    </div>

    <button type="submit" class="button-primary">Save Report</button>
</form>

<form action="<?= url('disaster') ?>" method="GET">
    <label for="report_status">Report Status</label>
    <select name="report_status" id="report_status">
        <option value="active" <?= ($filters['report_status'] ?? 'active') === 'active' ? 'selected' : '' ?>>Active Reports</option>
        <option value="resolved" <?= ($filters['report_status'] ?? '') === 'resolved' ? 'selected' : '' ?>>Resolved Reports</option>
        <option value="all" <?= ($filters['report_status'] ?? '') === 'all' ? 'selected' : '' ?>>All reports</option>
    </select>

    <button type="submit" class="button-primary">Filter Reports</button>
</form>

<h2>Affected Area Monitoring</h2>

<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>Event</th>
            <th>Purok</th>
            <th>Date</th>
            <th>Affected Households</th>
            <th>Affected Residents</th>
            <th>Status</th>
            <th>Reported By</th>
            <th>Remarks</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        <?php if (!empty($disasterReports)): ?>
            <?php foreach ($disasterReports as $report): ?>
                <tr>
                    <td><?= htmlspecialchars($report['disaster_name']) ?></td>
                    <td><?= htmlspecialchars($report['purok']) ?></td>
                    <td><?= htmlspecialchars($report['report_date']) ?></td>
                    <td><?= htmlspecialchars($report['affected_households']) ?></td>
                    <td><?= htmlspecialchars($report['affected_residents']) ?></td>
                    <td><?= htmlspecialchars(str_replace('_', ' ', ucwords($report['status'], '_'))) ?></td>
                    <td><?= htmlspecialchars($report['reported_by_name'] ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($report['remarks'] ?? 'N/A') ?></td>
                    <td>
                        <form action="<?= url('disaster/reports/' . $report['id'] . '/status') ?>" method="POST">
                            <select name="status">
                                <option value="monitoring" <?= $report['status'] === 'monitoring' ? 'selected' : '' ?>>Monitoring</option>
                                <option value="evacuating" <?= $report['status'] === 'evacuating' ? 'selected' : '' ?>>Evacuating</option>
                                <option value="relief_distributed" <?= $report['status'] === 'relief_distributed' ? 'selected' : '' ?>>Relief Distributed</option>
                                <option value="resolved" <?= $report['status'] === 'resolved' ? 'selected' : '' ?>>Resolved</option>
                            </select>

                            <button type="submit" class="button-primary">Update</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="9">No disaster reports yet.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<form action="<?= url('disaster') ?>" method="GET">
    <div>
        <label for="category">Category</label>
        <select id="category" name="category">
            <option value="">All residents</option>
            <option value="seniors" <?= ($filters['category'] ?? '') === 'seniors' ? 'selected' : '' ?>>Senior Citizens</option>
            <option value="minors" <?= ($filters['category'] ?? '') === 'minors' ? 'selected' : '' ?>>Minors</option>
            <option value="pwd" <?= ($filters['category'] ?? '') === 'pwd' ? 'selected' : '' ?>>Persons with Disability</option>
            <option value="solo_parent" <?= ($filters['category'] ?? '') === 'solo_parent' ? 'selected' : '' ?>>Solo Parents</option>
            <option value="out_of_school_youth" <?= ($filters['category'] ?? '') === 'out_of_school_youth' ? 'selected' : '' ?>>Out-of-School Youth</option>
            <option value="pregnant" <?= ($filters['category'] ?? '') === 'pregnant' ? 'selected' : '' ?>>Pregnant Residents</option>
            <option value="lactating_mother" <?= ($filters['category'] ?? '') === 'lactating_mother' ? 'selected' : '' ?>>Lactating Mothers</option>
            <option value="bedridden" <?= ($filters['category'] ?? '') === 'bedridden' ? 'selected' : '' ?>>Bedridden Residents</option>
            <option value="4ps_member" <?= ($filters['category'] ?? '') === '4ps_member' ? 'selected' : '' ?>>4Ps Members</option>
        </select>
    </div>

    <div>
        <label for="purok">Purok</label>
        <select id="purok" name="purok">
            <option value="">All puroks</option>

            <?php foreach ($puroks as $purok): ?>
                <option
                    value="<?= htmlspecialchars($purok['purok']) ?>"
                    <?= ($filters['purok'] ?? '') === $purok['purok'] ? 'selected' : '' ?>
                >
                    <?= htmlspecialchars($purok['purok']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div>
        <label for="gender">Gender</label>
        <select id="gender" name="gender">
            <option value="">All genders</option>
            <option value="male" <?= ($filters['gender'] ?? '') === 'male' ? 'selected' : '' ?>>Male</option>
            <option value="female" <?= ($filters['gender'] ?? '') === 'female' ? 'selected' : '' ?>>Female</option>
        </select>
    </div>

    <button type="submit" class="button-primary">Apply Filters</button>
    <a class="action-link" href="<?= url('disaster') ?>">Clear</a>
</form>

<h2>Households by Purok</h2>

<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>Purok</th>
            <th>Households</th>
        </tr>
    </thead>

    <tbody>
        <?php if (!empty($householdCounts)): ?>
            <?php foreach ($householdCounts as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row['purok'] ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($row['household_count']) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="2">No household data available.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<h2>Results</h2>

<p>Total results: <?= count($residents) ?></p>

<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>Name</th>
            <th>Gender</th>
            <th>Birthdate</th>
            <th>Household no.</th>
            <th>Purok</th>
            <th>Address</th>
            <th>Sector/Vulnerability</th>
            <th>Mobility</th>
            <th>Evacuation Priority</th>
            <th>Health Notes</th>
        </tr>
    </thead>

    <tbody>
        <?php if (!empty($residents)): ?>
            <?php foreach ($residents as $resident): ?>
                <tr>
                    <td>
                        <?= htmlspecialchars($resident['last_name']) ?>,
                        <?= htmlspecialchars($resident['first_name']) ?>,
                        <?= htmlspecialchars($resident['middle_name'] ?? '') ?>,
                    </td>
                    <td><?= htmlspecialchars(ucfirst($resident['gender'])) ?></td>
                    <td><?= htmlspecialchars($resident['birthdate']) ?></td>
                    <td><?= htmlspecialchars($resident['household_no'] ?? 'No household') ?></td>
                    <td><?= htmlspecialchars($resident['purok'] ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($resident['address'] ?? 'N/A') ?></td>
                    <td>
                        <?php
                            $vulnerabilities = [];

                            if ($resident['sector_senior_citizen']) {
                                $vulnerabilities[] = 'Senior Citizen';
                            }

                            if ($resident['is_minor']) {
                                $vulnerabilities[] = 'Minor';
                            }

                            if ($resident['sector_pwd']) {
                                $vulnerabilities[] = 'PWD';
                            }

                            if ($resident['sector_solo_parent']) {
                                $vulnerabilities[] = 'Solo Parent';
                            }

                            if ($resident['sector_4ps_member']) {
                                $vulnerabilities[] = '4Ps Member';
                            }

                            if ($resident['sector_out_of_school_youth']) {
                                $vulnerabilities[] = 'Out-of-School Youth';
                            }

                            if ($resident['is_pregnant']) {
                                $vulnerabilities[] = 'Pregnant';
                            }

                            if ($resident['is_lactating_mother']) {
                                $vulnerabilities[] = 'Lactating Mother';
                            }

                            if ($resident['is_bedridden']) {
                                $vulnerabilities[] = 'Bedridden';
                            }
                        ?>

                        <?= !empty($vulnerabilities) ? htmlspecialchars(implode(', ', $vulnerabilities)) : 'None listed' ?>
                    </td>
                    <td><?= htmlspecialchars(ucfirst($resident['mobility_status'] ?? 'normal')) ?></td>
                    <td><?= htmlspecialchars(ucfirst($resident['evacuation_priority'] ?? 'low')) ?></td>
                    <td>
                        <?php if ($resident['has_medical_condition']): ?>
                            Medical condition: <?= htmlspecialchars($resident['medical_condition_details'] ?? 'Unspecified') ?>
                        <?php else: ?>
                            None listed
                        <?php endif; ?>

                        <?php if ($resident['needs_medicine']): ?>
                            Needs medicine
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="10">No residents found for the selected filters.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<style>
    @media print {
        @page {
            size: landscape;
            margin: 8mm;
        }

        nav,
        .app-nav,
        .nav-toggle,
        .nav-toggle-label,
        .alert,
        .no-print,
        .action-bar,
        form,
        button,
        a {
            display: none !important;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
        }

        table {
            display: table !important;
            width: 100% !important;
            border-collapse: collapse;
            overflow: visible !important;
            white-space: normal !important;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 5px;
            font-size: 9px;
            white-space: normal !important;
            word-break: break-word;
        }

        h1 {
            font-size: 18px;
            margin: 0 0 10px;
        }

        h2 {
            font-size: 14px;
            margin: 12px 0 6px;
        }

        p {
            margin: 6px 0;
        }
    }
</style>
