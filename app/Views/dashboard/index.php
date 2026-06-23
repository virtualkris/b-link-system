<h1>B-Link Dashboard</h1>

<p>Integrated Resident Information & Services Management System</p>

<?php if (!empty($_SESSION['user'])): ?>
    <p>Welcome, <?= htmlspecialchars($_SESSION['user']['name']) ?></p>
    <p>Role: <?= htmlspecialchars($_SESSION['user']['role']) ?></p>

    <h2>Overview</h2>
    
    <div class="stats-grid">
        <div class="stat-card">
            <span>Total Residents</span>
            <strong><?= htmlspecialchars($stats['total_residents'] ?? 0) ?></strong>
        </div>

        <div class="stat-card">
            <span>Total Households</span>
            <strong><?= htmlspecialchars($stats['total_households'] ?? 0) ?></strong>
        </div>

        <div class="stat-card">
            <span>Generated Documents</span>
            <strong><?= htmlspecialchars($stats['total_documents'] ?? 0) ?></strong>
        </div>

        <div class="stat-card">
            <span>Active Disaster Reports</span>
            <strong><?= htmlspecialchars($stats['active_disaster_reports'] ?? 0) ?></strong>
        </div>
    </div>
    
    <h2>Residents Breakdown</h2>

    <?php
         $totalResidents = max((int)($stats['total_residents'] ?? 0), 1);

        $residentBars = [
            'Male Residents' => (int)($stats['male'] ?? 0),
            'Female Residents' => (int)($stats['female'] ?? 0),
            'Senior Citizens' => (int)($stats['senior_citizens'] ?? 0),
            'Minor' => (int)($stats['minors'] ?? 0),
            'PWD' => (int)($stats['pwd'] ?? 0),
            'Out-of-School Youth' => (int)($stats['out_of_school_youth'] ?? 0),
        ];
    ?>

    <div class="chart-card">
        <?php foreach ($residentBars as $label => $value): ?>
            <?php $percent = min(100, round(($value / $totalResidents) * 100)); ?>

            <div class="bar-row">
                <div class="bar-label">
                    <span><?= htmlspecialchars($label) ?></span>
                    <strong><?= htmlspecialchars($value) ?></strong>
                </div>

                <div class="bar-meter">
                    <div class="bar-track">
                        <div class="bar-fill" style="width: <?= htmlspecialchars($percent) ?>%;"></div>
                    </div>

                    <span class="bar-percent"><?= htmlspecialchars($percent) ?>%</span>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <h2>Disaster Monitoring</h2>

    <div class="stats-grid">
        <div class="stat-card stat-warning">
            <span>Affected Households</span>
            <strong><?= htmlspecialchars($stats['total_affected_households'] ?? 0) ?></strong>
        </div>

        <div class="stat-card stat-warning">
            <span>Affected Residents</span>
            <strong><?= htmlspecialchars($stats['total_affected_residents'] ?? 0) ?></strong>
        </div>

        <div class="stat-card stat-warning">
            <span>Critical Priority</span>
            <strong><?= htmlspecialchars($stats['critical_evacuation_priority'] ?? 0) ?></strong>
        </div>

        <div class="stat-card stat-warning">
            <span>High Priority</span>
            <strong><?= htmlspecialchars($stats['high_evacuation_priority'] ?? 0) ?></strong>
        </div>
    </div>
<?php endif; ?>