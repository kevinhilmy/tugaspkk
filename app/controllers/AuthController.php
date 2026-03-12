<?php

require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../../core/helpers.php';

class AuthController
{
    public function showLogin(): void
    {
        view('auth/login', ['title' => 'Login']);
    }

    public function login(): void
    {
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $user = User::findByEmail($email);

        if (!$user || !password_verify($password, $user['password_hash'])) {
            flash('error', 'Invalid email or password.');
            redirect('/?page=login');
        }

        $_SESSION['user'] = [
            'id' => (int) $user['id'],
            'full_name' => $user['full_name'],
            'email' => $user['email'],
            'role' => $user['role'],
        ];

        flash('success', 'Welcome back, ' . $user['full_name'] . '!');
        redirect('/');
    }

    public function showRegister(): void
    {
        view('auth/register', ['title' => 'Register']);
    }

    public function register(): void
    {
        $fullName = trim($_POST['full_name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if ($fullName === '' || $email === '' || strlen($password) < 6) {
            flash('error', 'Fill all fields and use min 6 chars password.');
            redirect('/?page=register');
        }

        if (User::findByEmail($email)) {
            flash('error', 'Email already registered.');
            redirect('/?page=register');
        }

        User::create($fullName, $email, $password);
        flash('success', 'Registration successful. Please login.');
        redirect('/?page=login');
    }

    public function logout(): void
    {
        session_destroy();
        session_start();
        flash('success', 'Logged out successfully.');
        redirect('/?page=login');
    }
}
