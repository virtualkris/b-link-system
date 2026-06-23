<h1>Register Resident</h1>

<?php if (!empty($errors)): ?>
    <ul>
        <?php foreach ($errors as $error): ?>
            <li><?= htmlspecialchars($error) ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<div class="action-bar">
    <a class="action-link" href="<?= url('residents') ?>">&larr; Back</a>
</div>

<form action="<?= url('residents/store') ?>" method="POST">
    <div class="form-grid form-grid-3">
        <section class="form-section">
            <div>
                <label for="household_id">Household</label>
                <select id="household_id" name="household_id">
                    <option value="">No household yet</option>

                    <?php foreach ($households as $household): ?>
                        <option value="<?= htmlspecialchars($household['id']) ?>">
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
                <input type="text" id="first_name" name="first_name" value="<?= htmlspecialchars($old['first_name'] ?? '') ?>" required>
            </div>

            <div>
                <label for="middle_name">Middle Name</label>
                <input type="text" id="middle_name" name="middle_name">
            </div>

            <div>
                <label for="last_name">Last Name</label>
                <input type="text" id="last_name" name="last_name" required>
            </div>

            <div>
                <label for="suffix">Suffix</label>
                <input type="text" id="suffix" name="suffix">
            </div>

            <div>
                <label for="gender">Gender</label>
                <select id="gender" name="gender" required>
                    <option value="">Select gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>

            <div>
                <label for="birthdate">Birthdate</label>
                <input type="date" id="birthdate" name="birthdate" required>
            </div>

            <div>
                <label for="birthplace">Birthplace</label>
                <input type="text" id="birthplace" name="birthplace">
            </div>

            <div>
                <label for="civil_status">Civil Status</label>
                <select id="civil_status" name="civil_status" required>
                    <option value="">Select status</option>
                    <option value="single">Single</option>
                    <option value="married">Married</option>
                    <option value="widowed">Widowed</option>
                    <option value="separated">Separated</option>
                </select>
            </div>
        </section>

        <section class="form-section">
            <h2>Contact & Background</h2>

            <div>
                <label for="contact_number">Contact Number</label>
                <input type="text" id="contact_number" name="contact_number">
            </div>

            <div>
                <label for="occupation">Occupation</label>
                <input type="text" id="occupation" name="occupation">
            </div>

            <div>
                <label for="educational_attainment">Educational Attainment</label>
                <input type="text" id="educational_attainment" name="educational_attainment">
            </div>

            <div>
                <label for="voter_status">Voter Status</label>
                <select id="voter_status" name="voter_status" required>
                    <option value="not_registered">Not Registered</option>
                    <option value="registered">Registered</option>
                </select>
            </div>

            <div>
                <label for="precinct_no">Precinct No.</label>
                <input type="text" id="precinct_no" name="precinct_no">
            </div>

            <h2>Sectoral & Vulnerability Information</h2>

            <label>
                <input type="checkbox" name="sector_senior_citizen" value="1">
                Senior Citizen
            </label>

            <label>
                <input type="checkbox" name="sector_pwd" value="1">
                Person with Disability
            </label>

            <label>
                <input type="checkbox" name="sector_solo_parent" value="1">
                Solo Parent
            </label>

            <label>
                <input type="checkbox" name="sector_indigenous_people" value="1">
                Indigenous People
            </label>

            <label>
                <input type="checkbox" name="sector_4ps_member" value="1">
                4Ps Member
            </label>

            <label>
                <input type="checkbox" name="sector_out_of_school_youth" value="1">
                Out-of-School Youth
            </label>

            <label>
                <input type="checkbox" name="is_pregnant" value="1">
                Pregnant
            </label>

            <label>
                <input type="checkbox" name="is_lactating_mother" value="1">
                Lactating Mother
            </label>

            <label>
                <input type="checkbox" name="is_bedridden" value="1">
                Bedridden
            </label>
        </section>

        <section class="form-section">
            <h2>Health & Evacuation Monitoring</h2>

            <label>
                <input type="checkbox" name="has_medical_condition" value="1">
                Has Medical Condition
            </label>

            <div>
                <label for="medical_condition_details">Medical Condition Details</label>
                <textarea name="medical_condition_details" id="medical_condition_details"></textarea>
            </div>

            <label>
                <input type="checkbox" name="needs_medicine" value="1">
                Needs Medicine
            </label>

            <div>
                <label for="mobility_status">Mobility Status</label>
                <select name="mobility_status" id="mobility_status">
                    <option value="normal">Normal</option>
                    <option value="limited">Limited</option>
                    <option value="assisted">Assisted</option>
                    <option value="immobile">Immobile</option>
                </select>
            </div>

            <div>
                <label for="evacuation_priority">Evacuation Priority</label>
                <select name="evacuation_priority" id="evacuation_priority">
                    <option value="low">Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>
                    <option value="critical">Critical</option>
                </select>
            </div>

            <h2>Emergency Contact</h2>

            <div>
                <label for="emergency_contact_name">Emergency Contact</label>
                <input type="text" id="emergency_contact_name" name="emergency_contact_name">
            </div>

            <div>
                <label for="emergency_contact_number">Emergency Contact Number</label>
                <input type="text" id="emergency_contact_number" name="emergency_contact_number">
            </div>
        </section>
    </div>

    <div class="form-actions">
        <button type="submit" class="button-primary">Save Resident</button>
    </div>
</form>
