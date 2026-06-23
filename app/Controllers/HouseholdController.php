<?php

namespace App\Controllers;

use App\Models\Household;

class HouseholdController extends Controller {
    public function index() {
        $this->requireAuth();

        $householdModel = new Household();
        $households = $householdModel->all();

        return $this->render('households/index', [
            'title' => 'Households',
            'households' => $households
        ]);
    }

    public function create() {
        $this->requireAuth();

        return $this->render('households/create', [
            'title' => 'Register Household'
        ]);
    }

    public function store() {
        $this->requireAuth();

        $householdNo = trim($_POST['household_no'] ?? '');
        $purok = trim($_POST['purok'] ?? '');

        if ($householdNo === '' || $purok === '') {
            $_SESSION['error'] = 'Household number and purok are required.';
            redirect('households/create');
        }

        $householdModel = new Household();

        $householdModel->create([
            'household_no' => $householdNo,
            'head_resident_id' => !empty($_POST['head_resident_id']) ? $_POST['head_resident_id'] : null,
            'purok' => $purok,
            'sitio' => $_POST['sitio'] ?? null,
            'street' => $_POST['street'] ?? null,
            'house_no' => $_POST['house_no'] ?? null,
            'address' => $_POST['address'] ?? null,
            'household_type' => $_POST['household_type'] ?? null,
            'monthly_income' => $_POST['monthly_income'] ?? null,
        ]);

        $_SESSION['success'] = 'Household registered successfully.';
        redirect('households');
    }

    public function edit($id) {
        $this->requireAuth();

        $householdModel = new Household();
        $household = $householdModel->find($id);

        if (!$household) {
            http_response_code(404);
            echo 'Household not found.';
            exit;
        }

        $residents = $householdModel->residents($id);

        return $this->render('households/edit', [
            'title' => 'Edit Household',
            'household' => $household,
            'residents' => $residents
        ]);
    }

    public function update($id) {
        $this->requireAuth();

        $householdNo = trim($_POST['household_no'] ?? '');
        $purok = trim($_POST['purok'] ?? '');

        if ($householdNo === '' || $purok === '') {
            $_SESSION['error'] = 'Household number and purok are required.';
            redirect('households/' . $id . '/edit');
        }

        $householdModel = new Household();

        $householdModel->update($id, [
            'household_no' => $householdNo,
            'head_resident_id' => !empty($_POST['head_resident_id']) ? $_POST['head_resident_id'] : null,
            'purok' => $purok,
            'sitio' => $_POST['sitio'] ?? null,
            'street' => $_POST['street'] ?? null,
            'house_no' => $_POST['house_no'] ?? null,
            'address' => $_POST['address'] ?? null,
            'household_type' => $_POST['household_type'] ?? null,
            'monthly_income' => $_POST['monthly_income'] ?? null,
        ]);

        $_SESSION['success'] = 'Household updated successfully.';
        redirect('households');
    }

    public function show($id) {
        $this->requireAuth();

        $householdModel = new Household();
        $household = $householdModel->find($id);

        if (!$household) {
            http_response_code(404);
            echo 'Household not found.';
            exit;
        }

        $residents = $householdModel->residents($id);

        return $this->render('households/show', [
            'title' => 'Household Profile',
            'household' => $household,
            'residents' => $residents
        ]);
    }
}