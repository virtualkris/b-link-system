<?php

namespace App\Controllers;

use App\Models\User;

class AuthController extends Controller {
    public function login() {
        if (!empty($_SESSION['user'])) {
            header('Location: /b-link-system/public/dashboard');
            exit;
        }

        return $this->render('auth/login', [
            'title' => 'Login'
        ]);
    }

    public function authenticate() {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $userModel = new User();
        $user = $userModel->findByEmail($email);

        if (!$user || !password_verify($password, $user['password'])) {
            return $this->render('auth/login', [
                'title' => 'Login',
                'error' => 'Invalid email or password'
            ]);
        }

        $_SESSION['user'] = [
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'role' => $user['role']
        ];

        redirect('dashboard');
        exit;
    }

    public function logout() {
        unset($_SESSION['user']);

        session_destroy();

        redirect('login');
        exit;
    }
}