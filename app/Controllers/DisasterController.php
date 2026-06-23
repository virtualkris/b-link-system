<?php

namespace App\Controllers;

use App\Services\DisasterService;

class DisasterController extends Controller {
    public function index() {
        $this->requireAuth();

        $filters = [
            'category' => $_GET['category'] ??'',
            'purok' => $_GET['purok'] ??'',
            'gender' => $_GET['gender'] ??'',
            'report_status' => $_GET['report_status'] ?? 'active',
        ];

        $disasterService = new DisasterService();

        $residents = $disasterService->filterResidents($filters);
        $puroks = $disasterService->getPuroks();
        $householdCounts = $disasterService->householdCountsByPurok();
        $disasterReports = $disasterService->getDisasterReports($filters['report_status']);
            
        return $this->render('disaster/index', [
            'title' => 'Disaster Response',
            'residents' => $residents,
            'puroks' => $puroks,
            'householdCounts' => $householdCounts,
            'disasterReports' => $disasterReports,
            'filters' => $filters
        ]);
    }

    public function storeReport() {
        $this->requireAuth();

        $disasterService = new DisasterService();

        $disasterName = trim($_POST['disaster_name'] ?? '');
        $purok = trim($_POST['purok'] ?? '');
        $reportDate = $_POST['report_date'] ?? date('Y-m-d');

        if ($disasterName === '' || $purok === '' || $reportDate === '') {
            $_SESSION['error'] = 'Disaster name, affected purok, and report date are required.';
            redirect('disaster');
        }

        $disasterService->createDisasterReport([
            'disaster_name' => $disasterName,
            'purok' => $purok,
            'report_date' => $reportDate,
            'affected_households' => $_POST['affected_households'] ?? 0,
            'affected_residents' => $_POST['affected_residents'] ?? 0,
            'status' => $_POST['status'] ?? 'monitoring',
            'remarks' => $_POST['remarks'] ?? null,
            'reported_by' => $_SESSION['user']['id'] ?? null,
        ]);

        $_SESSION['success'] = 'Disaster report saved successfully.';
        redirect('disaster');
    }

    public function updateReportStatus($id) {
        $this->requireAuth();

        $status = $_POST['status'] ?? 'monitoring';

        $disasterService = new DisasterService();
        $disasterService->updateDisasterReportStatus($id, $status);

        $_SESSION['success'] = 'Disaster report status updated.';
        redirect('disaster');
    }
}