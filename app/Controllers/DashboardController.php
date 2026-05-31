<?php

namespace App\Controllers;

//use App\Models\User;
//use App\Config\Database;

class DashboardController extends Controller {
    public function index() {
        $this->requireAuth();

        return $this->render('dashboard/index', [
            'title' => 'B-Link Dashboard'
        ]);
    }
}