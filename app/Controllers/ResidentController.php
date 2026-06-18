<?php

namespace App\Controllers;

use App\Helpers\Validator;
use App\Models\Household;
use App\Models\Resident;

class ResidentController extends Controller {
    public function index() {
        $this->requireAuth();

        $search = trim($_GET['search'] ?? '');

        $residentModel = new Resident();

        if ($search !== '') {
            $residents = $residentModel->search($search);
        } else {
            $residents = $residentModel->all();
        }

        return $this->render('residents/index', [
            'title' => 'Residents',
            'residents' => $residents,
            'search' => $search
        ]);
    }

    public function create() {
        $this->requireAuth();

        $householdModel = new Household();
        $households = $householdModel->all();

        return $this->render('residents/create', [
            'title' => 'Register Resident',
            'households' => $households
        ]);
    }

    public function store() {
        $this->requireAuth();

        $data = $this->residentDataFromRequest();
        $errors = $this->validateResident($data);

        if (!empty($errors)) {
            $householdModel = new Household();
            $households = $householdModel->all();

            return $this->render('residents/create', [
                'title' => 'Register Resident',
                'households' => $households,
                'errors' => $errors,
                'old' => $_POST
            ]);
        }

        $residentModel = new Resident();
        $residentModel->create($data);

        redirect('residents');

    }

    public function show($id) {
        $this->requireAuth();

        $residentModel = new Resident();
        $resident = $residentModel->find($id);

        if (!$resident) {
            http_response_code(404);
            echo 'Resident not found.';
            exit;
        }

        return $this->render('residents/show', [
            'title' => 'Resident Profile',
            'resident' => $resident
        ]);
    }

    public function edit($id) {
        $this->requireAuth();

        $residentModel = new Resident();
        $resident = $residentModel->find($id);

        if (!$resident) {
            http_response_code(404);
            echo 'Resident not found.';
            exit;
        }

        $householdModel = new Household();
        $households = $householdModel->all();

        return $this->render('residents/edit', [
            'title' => 'Edit Resident',
            'resident' => $resident,
            'households' => $households
        ]);
    }

    public function update($id) {
        $this->requireAuth();

        $data = $this->residentDataFromRequest();
        $errors = $this->validateResident($data);

        if (!empty($errors)) {
            $residentModel = new Resident();
            $resident = $residentModel->find($id);

            $householdModel = new Household();
            $households = $householdModel->all();

            return $this->render('residents/edit', [
                'title' => 'Edit Resident',
                'resident' => array_merge($resident, $_POST),
                'households' => $households,
                'errors' => $errors
            ]);
        }

        $residentModel = new Resident();
        $residentModel->update($id, $data);

        redirect('residents/' . $id);
    }

    public function archive($id) {
        $this->requireAuth();

        $residentModel = new Resident();
        $residentModel->archive($id);

        redirect('residents');
    }

    private function residentDataFromRequest() {
        $birthdate = $_POST['birthdate'] ?? null;
        $isMinor = 0;

        if (!empty($birthdate)) {
            $birthDateObject = new \DateTime($birthdate);
            $today = new \DateTime();
            $age = $today->diff($birthDateObject)->y;

            $isMinor = $age < 18 ? 1 : 0;
        }

        return [
            'household_id' => !empty($_POST['household_id']) ? $_POST['household_id'] : null,
            'first_name' => $_POST['first_name'] ?? '',
            'middle_name' => $_POST['middle_name'] ?? null,
            'last_name' => $_POST['last_name'] ?? '',
            'suffix' => $_POST['suffix'] ?? null,
            'gender' => $_POST['gender'] ?? '',
            'birthdate' => $_POST['birthdate'] ?? '',
            'birthplace' => $_POST['birthplace'] ?? null,
            'civil_status' => $_POST['civil_status'] ?? '',
            'nationality' => $_POST['nationality'] ?? 'Filipino',
            'religion' => $_POST['religion'] ?? null,
            'contact_number' => $_POST['contact_number'] ?? null,
            'email' => $_POST['email'] ?? null,
            'occupation' => $_POST['occupation'] ?? null,
            'educational_attainment' => $_POST['educational_attainment'] ?? null,
            'voter_status' => $_POST['voter_status'] ?? 'not_registered',
            'precinct_no' => $_POST['precinct_no'] ?? null,
            'sector_senior_citizen' => isset($_POST['sector_senior_citizen']) ? 1 : 0,
            'sector_pwd' => isset($_POST['sector_pwd']) ? 1 : 0,
            'sector_solo_parent' => isset($_POST['sector_solo_parent']) ? 1 : 0,
            'sector_indigenous_people' => isset($_POST['sector_indigenous_people']) ? 1 : 0,
            'sector_4ps_member' => isset($_POST['sector_4ps_member']) ? 1 : 0,
            'sector_out_of_school_youth' => isset($_POST['sector_out_of_school_youth']) ? 1 : 0,
            'is_minor' => $isMinor,
            'is_pregnant' => isset($_POST['is_pregnant']) ? 1 : 0,
            'is_lactating_mother' => isset($_POST['is_lactating_mother']) ? 1 : 0,
            'is_bedridden' => isset($_POST['is_bedridden']) ? 1 : 0,
            'emergency_contact_name' => $_POST['emergency_contact_name'] ?? null,
            'emergency_contact_number' => $_POST['emergency_contact_number'] ?? null,
        ];
    }

    private function validateResident($data) {
        $errors = [];

        $errors = array_merge($errors, Validator::required($data, [
            'first_name' => 'First name',
            'last_name' => 'Last name',
            'gender' => 'Gender',
            'birthdate' => 'Birthdate',
            'civil_status' => 'Civil status',
            'voter_status' => 'Voter status',
        ]));

        $errors = array_merge($errors, Validator::in($data, 'gender', ['male', 'female'], 'Gender'));

        $errors = array_merge($errors, Validator::in($data, 'voter_status', [
            'registered',
            'not_registered'
        ], 'Voter status'));

        $errors = array_merge($errors, Validator::date($data, 'birthdate', 'Birthdate'));

        return $errors;
    }
}