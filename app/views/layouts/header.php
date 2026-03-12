<?php $currentUser = auth_user(); $flash = get_flash(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($title ?? 'Travel Booking') ?></title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
<header class="topbar">
    <div class="container nav-wrap">
        <h1><a href="/">TravelGo</a></h1>
        <nav>
            <a href="/">Schedules</a>
            <?php if ($currentUser): ?>
                <a href="/?page=history">My Bookings</a>
                <a href="/?page=tracking">Tracking</a>
                <?php if ($currentUser['role'] === 'admin'): ?>
                    <a href="/?page=admin">Admin</a>
                <?php endif; ?>
                <a href="/?page=logout">Logout</a>
            <?php else: ?>
                <a href="/?page=login">Login</a>
                <a href="/?page=register">Register</a>
            <?php endif; ?>
        </nav>
    </div>
</header>
<main class="container">
    <?php if ($flash): ?>
        <div class="alert <?= htmlspecialchars($flash['type']) ?>"><?= htmlspecialchars($flash['message']) ?></div>
    <?php endif; ?>
