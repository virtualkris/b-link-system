<?php

namespace App\Controllers;

use App\Models\User;

class UserController extends Controller {
    public function index() {
        $this->requireRole('admin');

        $userModel = new User();
        $users = $userModel->all();

        return $this->render('users/index', [
            'title' => 'Users',
            'users' => $users
        ]);
    }

    public function create() {
        $this->requireRole('admin');

        return $this->render('users/create', [
            'title' => 'Add User'
        ]);
    }

    public function store() {
        $this->requireRole('admin');

        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $role = $_POST['role'] ?? 'staff';

        if ($name === '' || $email === '' || $password === '') {
            $_SESSION['error'] = 'Name, email, and password are required.';
            redirect('users/create');
        }

        if (!in_array($role, ['admin', 'staff'])) {
            $_SESSION['error'] = 'Invalid role selected.';
            redirect('users/create');
        }

        $userModel = new User();

        if ($userModel->findByEmail($email)) {
            $_SESSION['error'] = 'Email is already registered.';
            redirect('users/create');
        }

        $userModel->create([
            'name' => $name,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'role' => $role
        ]);

        $_SESSION['success'] = 'User account created successfully.';
        redirect('users');
    }
}