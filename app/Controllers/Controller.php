<?php

namespace App\Controllers;

abstract class Controller {
    protected function render($viewName, $data = []) {
        extract($data);

        ob_start();
        include __DIR__ . "/../Views/{$viewName}.php";
        $content = ob_get_clean();
        
        include __DIR__ . '/../Views/layouts/main.php';
    }

    protected function requireAuth() {
        if (empty($_SESSION['user'])) {
            redirect('login');
            exit;
        }
    }

    protected function requireRole($roles) {
        $this->requireAuth();

        if (!is_array($roles)) {
            $roles = [$roles];
        }

        $userRole = $_SESSION['user']['role'] ?? null;

        if (!in_array($userRole, $roles)) {
            http_response_code(403);
            echo "403 - Forbidden";
            exit;
        }
    }
}