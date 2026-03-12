<?php

require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Schedule.php';
require_once __DIR__ . '/../models/Booking.php';
require_once __DIR__ . '/../../core/helpers.php';

class AdminController
{
    public function dashboard(): void
    {
        require_admin();
        view('admin/dashboard', [
            'title' => 'Admin Dashboard',
            'userCount' => User::countUsers(),
            'scheduleCount' => Schedule::countSchedules(),
            'bookingCount' => Booking::countBookings(),
            'recentBookings' => array_slice(Booking::all(), 0, 10),
        ]);
    }
}
