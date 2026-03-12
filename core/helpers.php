<?php

function view(string $view, array $data = []): void
{
    extract($data);
    require __DIR__ . '/../app/views/layouts/header.php';
    require __DIR__ . '/../app/views/' . $view . '.php';
    require __DIR__ . '/../app/views/layouts/footer.php';
}

function redirect(string $path): void
{
    header('Location: ' . $path);
    exit;
}

function auth_user(): ?array
{
    return $_SESSION['user'] ?? null;
}

function require_login(): void
{
    if (!auth_user()) {
        redirect('/?page=login');
    }
}

function require_admin(): void
{
    $user = auth_user();
    if (!$user || $user['role'] !== 'admin') {
        redirect('/');
    }
}

function flash(string $type, string $message): void
{
    $_SESSION['flash'] = ['type' => $type, 'message' => $message];
}

function get_flash(): ?array
{
    $flash = $_SESSION['flash'] ?? null;
    unset($_SESSION['flash']);
    return $flash;
}
