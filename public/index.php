<?php
session_start();

require_once __DIR__ . '/../core/helpers.php';
require_once __DIR__ . '/../app/controllers/AuthController.php';
require_once __DIR__ . '/../app/controllers/TravelController.php';
require_once __DIR__ . '/../app/controllers/AdminController.php';

$page = $_GET['page'] ?? 'home';
$auth = new AuthController();
$travel = new TravelController();
$admin = new AdminController();

switch ($page) {
    case 'home':
        $travel->home();
        break;
    case 'login':
        $auth->showLogin();
        break;
    case 'login_submit':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth->login();
            break;
        }
        redirect('/?page=login');
    case 'register':
        $auth->showRegister();
        break;
    case 'register_submit':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth->register();
            break;
        }
        redirect('/?page=register');
    case 'logout':
        $auth->logout();
        break;
    case 'booking':
        $travel->showBooking();
        break;
    case 'booking_submit':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $travel->storeBooking();
            break;
        }
        redirect('/');
    case 'history':
        $travel->history();
        break;
    case 'tracking':
        $travel->tracking();
        break;
    case 'admin':
        $admin->dashboard();
        break;
    default:
        http_response_code(404);
        echo 'Page not found';
}
