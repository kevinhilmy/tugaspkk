<?php

require_once __DIR__ . '/../../core/Database.php';

class Booking
{
    public static function getBookedSeats(int $scheduleId): array
    {
        $pdo = Database::connection();
        $stmt = $pdo->prepare('SELECT seat_number FROM bookings WHERE schedule_id = :schedule_id AND status = "confirmed"');
        $stmt->execute(['schedule_id' => $scheduleId]);
        return array_column($stmt->fetchAll(), 'seat_number');
    }

    public static function create(int $userId, int $scheduleId, string $seatNumber, string $passengerName): bool
    {
        $pdo = Database::connection();
        $stmt = $pdo->prepare('INSERT INTO bookings (user_id, schedule_id, seat_number, passenger_name, booking_code)
                               VALUES (:user_id, :schedule_id, :seat_number, :passenger_name, :booking_code)');

        return $stmt->execute([
            'user_id' => $userId,
            'schedule_id' => $scheduleId,
            'seat_number' => $seatNumber,
            'passenger_name' => $passengerName,
            'booking_code' => strtoupper(substr(md5(uniqid((string) mt_rand(), true)), 0, 10)),
        ]);
    }

    public static function byUser(int $userId): array
    {
        $pdo = Database::connection();
        $stmt = $pdo->prepare('SELECT b.*, s.route_type, s.origin, s.destination, s.departure_time, s.arrival_time, s.price
                               FROM bookings b
                               JOIN schedules s ON s.id = b.schedule_id
                               WHERE b.user_id = :user_id
                               ORDER BY b.created_at DESC');
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll();
    }

    public static function all(): array
    {
        $pdo = Database::connection();
        $sql = 'SELECT b.*, u.full_name AS user_name, s.origin, s.destination, s.departure_time
                FROM bookings b
                JOIN users u ON u.id = b.user_id
                JOIN schedules s ON s.id = b.schedule_id
                ORDER BY b.created_at DESC';
        return $pdo->query($sql)->fetchAll();
    }

    public static function countBookings(): int
    {
        $pdo = Database::connection();
        return (int) $pdo->query('SELECT COUNT(*) FROM bookings WHERE status = "confirmed"')->fetchColumn();
    }
}
