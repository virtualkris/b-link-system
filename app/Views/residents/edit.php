<h1>Edit Resident</h1>

<div class="action-bar">
    <a class="action-link" href="<?= url('residents/' . $resident['id']) ?>">&larr; Back</a>
</div>

<?php if (!empty($errors)): ?>
    <ul>
        <?php foreach ($errors as $error): ?>
            <li><?= htmlspecialchars($error) ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<form action="<?= url('residents/' . $resident['id'] . '/update') ?>" method="POST">
    <div class="form-grid form-grid-3">
        <section class="form-section">
            <div>
                <label for="household_id">Household</label>
                <select id="household_id" name="household_id">
                    <option value="">No household yet</option>

                    <?php foreach ($households as $household): ?>
                        <option value="<?= htmlspecialchars($household['id']) ?>" <?= $resident['household_id'] == $household['id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($household['household_no']) ?> -
                            Purok <?= htmlspecialchars($household['purok']) ?> -
                            <?= htmlspecialchars($household['resident_count']) ?> resident(s)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <h2>Personal Information</h2>

            <div>
                <label for="first_name">First Name</label>
                <input 
                    type="text" 
                    id="first_name" 
                    name="first_name"
                    value="<?= htmlspecialchars($resident['first_name']) ?>" 
                    required
                >
            </div>

            <div>
                <label for="middle_name">Middle Name</label>
                <input 
                    type="text" 
                    id="middle_name" 
                    name="middle_name"
                    value="<?= htmlspecialchars($resident['middle_name']) ?>"
                >
            </div>

            <div>
                <label for="last_name">Last Name</label>
                <input 
                    type="text" 
                    id="last_name" 
                    name="last_name"
                    value="<?= htmlspecialchars($resident['last_name']) ?>" 
                    required
                >
            </div>

            <div>
                <label for="suffix">Suffix</label>
                <input 
                    type="text" 
                    id="suffix" 
                    name="suffix"
                    value="<?= htmlspecialchars($resident['suffix']) ?>"
                >
            </div>

            <div>
                <label for="gender">Gender</label>
                <select id="gender" name="gender" required>
                    <option value="">Select gender</option>
                    <option value="male" <?= $resident['gender'] === 'male' ? 'selected' : ''?>>Male</option>
                    <option value="female" <?= $resident['gender'] === 'female' ? 'selected' : '' ?>>Female</option>
                </select>
            </div>

            <div>
                <label for="birthdate">Birthdate</label>
                <input 
                    type="date" 
                    id="birthdate" 
                    name="birthdate"
                    value="<?= htmlspecialchars($resident['birthdate']) ?>" 
                    required
                >
            </div>

            <div>
                <label for="birthplace">Birthplace</label>
                <input 
                    type="text" 
                    id="birthplace" 
                    name="birthplace"
                    value="<?= htmlspecialchars($resident['birthplace']) ?>"
                >
            </div>

            <div>
                <label for="civil_status">Civil Status</label>
                <select id="civil_status" name="civil_status" required>
                    <option value="">Select status</option>
                    <option value="single" <?= $resident['civil_status'] === 'single' ? 'selected' : '' ?>>Single</option>
                    <option value="married" <?= $resident['civil_status'] === 'married' ? 'selected' : '' ?>>Married</option>
                    <option value="widowed" <?= $resident['civil_status'] === 'widowed' ? 'selected' : '' ?>>Widowed</option>
                    <option value="separated" <?= $resident['civil_status'] === 'separated' ? 'selected' : '' ?>>Separated</option>
                </select>
            </div>
        </section>
        
        <section class="form-section">
            <h2>Contact & Background</h2>

            <div>
                <label for="contact_number">Contact Number</label>
                <input 
                    type="text" 
                    id="contact_number" 
                    name="contact_number"
                    value="<?= htmlspecialchars($resident['contact_number']) ?>"
                >
            </div>

            <div>
                <label for="occupation">Occupation</label>
                <input 
                    type="text" 
                    id="occupation" 
                    name="occupation"
                    value="<?= htmlspecialchars($resident['occupation']) ?>"
                >
            </div>

            <div>
                <label for="educational_attainment">Educational Attainment</label>
                <input 
                    type="text" 
                    id="educational_attainment" 
                    name="educational_attainment"
                    value="<?= htmlspecialchars($resident['educational_attainment']) ?>"
                >
            </div>

            <div>
                <label for="voter_status">Voter Status</label>
                <select id="voter_status" name="voter_status" required>
                    <option value="not_registered" <?= $resident['voter_status'] === 'not_registered' ?'selected' : '' ?>>Not Registered</option>
                    <option value="registered" <?= $resident['voter_status'] === 'registered' ? 'selected' : '' ?>>Registered</option>
                </select>
            </div>

            <div>
                <label for="precinct_no">Precinct No.</label>
                <input 
                    type="text" 
                    id="precinct_no" 
                    name="precinct_no"
                    value="<?= htmlspecialchars($resident['precinct_no']) ?>"
                >
            </div>

            <h2>Sectoral & Vulnerability Information</h2>

            <label>
                <input 
                    type="checkbox" 
                    name="sector_senior_citizen" 
                    value="1"
                    <?= $resident['sector_senior_citizen'] ? 'checked' : '' ?>
                >
                Senior Citizen
            </label>

            <label>
                <input 
                    type="checkbox" 
                    name="sector_pwd" 
                    value="1"
                    <?= $resident['sector_pwd'] ? 'checked' : '' ?>
                >
                Person with Disability
            </label>

            <label>
                <input 
                    type="checkbox" 
                    name="sector_solo_parent" 
                    value="1"
                    <?= $resident['sector_solo_parent'] ? 'checked' : '' ?>
                >
                Solo Parent
            </label>

            <label>
                <input 
                    type="checkbox" 
                    name="sector_indigenous_people" 
                    value="1"
                    <?= $resident['sector_indigenous_people'] ? 'checked' : '' ?>
                >
                Indigenous People
            </label>

            <label>
                <input 
                    type="checkbox" 
                    name="sector_4ps_member" 
                    value="1"
                    <?= $resident['sector_4ps_member'] ? 'checked' : '' ?>
                >
                4Ps Member
            </label>

            <label>
                <input 
                    type="checkbox" 
                    name="sector_out_of_school_youth" 
                    value="1"
                    <?= $resident['sector_out_of_school_youth'] ? 'checked' : '' ?>
                >
                Out-of-School Youth
                </label>

            <label>
                <input 
                    type="checkbox" 
                    name="is_pregnant" 
                    value="1"
                    <?= $resident['is_pregnant'] ? 'checked' : '' ?>
                >
                Pregnant
            </label>

            <label>
                <input 
                    type="checkbox" 
                    name="is_lactating_mother" 
                    value="1"
                    <?= $resident['is_lactating_mother'] ? 'checked' : '' ?>
                >
                Lactating Mother
            </label>

            <label>
                <input 
                    type="checkbox" 
                    name="is_bedridden" 
                    value="1"
                    <?= $resident['is_bedridden'] ? 'checked' : '' ?>
                >
                Bedridden
            </label>
        </section>

        <section class="form-section">
            <h2>Health & Evacuation Monitoring</h2>

            <label>
                <input
                    type="checkbox"
                    name="has_medical_condition"
                    value="1"
                    <?= $resident['has_medical_condition'] ? 'checked' : '' ?>
                >
                Has Medical Condition
            </label>

            <div>
                <label for="medical_condition_details">Medical Condition Details</label>
                <textarea name="medical_condition_details" id="medical_condition_details"><?= htmlspecialchars($resident['medical_condition_details'] ?? '') ?></textarea>
            </div>

            <label>
                <input 
                    type="checkbox"
                    name="needs_medicine"
                    value="1"
                    <?= $resident['needs_medicine'] ? 'checked' : '' ?>
                >
                Needs Medicine
            </label>

            <div>
                <label for="mobility_status">Mobility Status</label>
                <select name="mobility_status" id="mobility_status">
                    <option value="normal" <?= $resident['mobility_status'] === 'normal' ? 'selected' : '' ?>>Normal</option>
                    <option value="limited" <?= $resident['mobility_status'] === 'limited' ? 'selected' : '' ?>>Limited</option>
                    <option value="assisted" <?= $resident['mobility_status'] === 'assisted' ? 'selected' : '' ?>>Assisted</option>
                    <option value="immobile" <?= $resident['mobility_status'] === 'immobile' ? 'selected' : '' ?>>Immobile</option>
                </select>
            </div>

            <div>
                <label for="evacuation_priority">Evacuation Priority</label>
                <select name="evacuation_priority" id="evacuation_priority">
                    <option value="low" <?= $resident['evacuation_priority'] === 'low' ? 'selected' : '' ?>>Low</option>
                    <option value="medium" <?= $resident['evacuation_priority'] === 'medium' ? 'selected' : '' ?>>Medium</option>
                    <option value="high" <?= $resident['evacuation_priority'] === 'high' ? 'selected' : '' ?>>High</option>
                    <option value="critical" <?= $resident['evacuation_priority'] === 'critical' ? 'selected' : '' ?>>Critical</option>
                </select>
            </div>

            <h2>Emergency Contact</h2>

            <div>
                <label for="emergency_contact_name">Emergency Contact</label>
                <input 
                    type="text" 
                    id="emergency_contact_name" 
                    name="emergency_contact_name"
                    value="<?= htmlspecialchars($resident['emergency_contact_name']) ?>"
                >
            </div>

            <div>
                <label for="emergency_contact_number">Emergency Contact Number</label>
                <input 
                    type="text" 
                    id="emergency_contact_number" 
                    name="emergency_contact_number"
                    value="<?= htmlspecialchars($resident['emergency_contact_number']) ?>"
                >
            </div>
        </section>
    </div>

    <div class="form-actions">
        <button type="submit" class="button-primary">Save Resident</button>
    </div>
</form>
