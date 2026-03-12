<?php

require_once __DIR__ . '/../models/Schedule.php';
require_once __DIR__ . '/../models/Booking.php';
require_once __DIR__ . '/../../core/helpers.php';

class TravelController
{
    public function home(): void
    {
        $filters = [
            'route_type' => $_GET['route_type'] ?? '',
            'origin' => $_GET['origin'] ?? '',
            'destination' => $_GET['destination'] ?? '',
        ];
        $schedules = Schedule::search($filters);
        view('travel/home', ['title' => 'Travel Booking', 'schedules' => $schedules, 'filters' => $filters]);
    }

    public function showBooking(): void
    {
        require_login();
        $scheduleId = (int) ($_GET['schedule_id'] ?? 0);
        $schedule = Schedule::find($scheduleId);

        if (!$schedule) {
            flash('error', 'Schedule not found.');
            redirect('/');
        }

        $bookedSeats = Booking::getBookedSeats($scheduleId);
        view('travel/booking', [
            'title' => 'Book Seat',
            'schedule' => $schedule,
            'bookedSeats' => $bookedSeats,
        ]);
    }

    public function storeBooking(): void
    {
        require_login();
        $scheduleId = (int) ($_POST['schedule_id'] ?? 0);
        $seatNumber = trim($_POST['seat_number'] ?? '');
        $passengerName = trim($_POST['passenger_name'] ?? '');

        if ($scheduleId <= 0 || $seatNumber === '' || $passengerName === '') {
            flash('error', 'Please fill booking details.');
            redirect('/?page=booking&schedule_id=' . $scheduleId);
        }

        try {
            Booking::create((int) auth_user()['id'], $scheduleId, $seatNumber, $passengerName);
            flash('success', 'Booking confirmed for seat ' . $seatNumber . '.');
            redirect('/?page=history');
        } catch (PDOException $e) {
            flash('error', 'Seat already booked, choose another.');
            redirect('/?page=booking&schedule_id=' . $scheduleId);
        }
    }

    public function history(): void
    {
        require_login();
        $bookings = Booking::byUser((int) auth_user()['id']);
        view('travel/history', ['title' => 'Booking History', 'bookings' => $bookings]);
    }

    public function tracking(): void
    {
        require_login();
        view('travel/tracking', ['title' => 'Live Tracking (Dummy)']);
    }
}
