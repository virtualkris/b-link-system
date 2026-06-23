<h1>Register Household</h1>

<div class="action-bar">
    <a class="action-link" href="<?= url('households') ?>">&larr; Back</a>
</div>

<form action="<?= url('households/store') ?>" method="POST">
    <div class="form-section">
        <div>
            <label for="household_no">Household Number</label>
            <input type="text" id="household_no" name="household_no" required>
        </div>

        <div>
            <label for="purok">Purok</label>
            <input type="text" id="purok" name="purok" required>
        </div>

        <div>
            <label for="sitio">Sitio</label>
            <input type="text" id="sitio" name="sitio">
        </div>

        <div>
            <label for="street">Street</label>
            <input type="text" id="street" name="street">
        </div>

        <div>
            <label for="house_no">House No.</label>
            <input type="text" id="house_no" name="house_no">
        </div>

        <div>
            <label for="address">Full Address</label>
            <textarea id="address" name="address"></textarea>
        </div>

        <div>
            <label for="household_type">Household Type</label>
            <select id="household_type" name="household_type">
                <option value="">Select type</option>
                <option value="nuclear">Nuclear</option>
                <option value="extended">Extended</option>
                <option value="single_parent">Single Parent</option>
                <option value="solo_living">Solo Living</option>
                <option value="other">Other</option>
            </select>
        </div>

        <div>
            <label for="monthly_income">Monthly Income</label>
            <input type="number" id="monthly_income" name="monthly_income" min="0" step="0.01">
        </div>

        <button type="submit" class="button-primary">Save Household</button>
    </div>
</form>
