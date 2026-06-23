<?php

namespace App\Controllers;

//use App\Models\User;
//use App\Config\Database;
use App\Services\ReportService;

class DashboardController extends Controller {
    public function index() {
        $this->requireAuth();

        $reportService = new ReportService();
        $stats = $reportService->dashboardStats();

        return $this->render('dashboard/index', [
            'title' => 'B-Link Dashboard',
            'stats' => $stats
        ]);
    }
}