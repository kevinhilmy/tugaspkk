<?php

require_once __DIR__ . '/../../core/Database.php';

class Schedule
{
    public static function search(array $filters): array
    {
        $pdo = Database::connection();

        $query = 'SELECT s.*, (s.seats_total - COUNT(b.id)) AS seats_available
                  FROM schedules s
                  LEFT JOIN bookings b ON b.schedule_id = s.id AND b.status = "confirmed"
                  WHERE 1=1';
        $params = [];

        if (!empty($filters['route_type'])) {
            $query .= ' AND s.route_type = :route_type';
            $params['route_type'] = $filters['route_type'];
        }
        if (!empty($filters['origin'])) {
            $query .= ' AND s.origin LIKE :origin';
            $params['origin'] = '%' . $filters['origin'] . '%';
        }
        if (!empty($filters['destination'])) {
            $query .= ' AND s.destination LIKE :destination';
            $params['destination'] = '%' . $filters['destination'] . '%';
        }

        $query .= ' GROUP BY s.id ORDER BY s.departure_time ASC';

        $stmt = $pdo->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public static function find(int $id): ?array
    {
        $pdo = Database::connection();
        $stmt = $pdo->prepare('SELECT * FROM schedules WHERE id = :id LIMIT 1');
        $stmt->execute(['id' => $id]);
        $schedule = $stmt->fetch();
        return $schedule ?: null;
    }

    public static function countSchedules(): int
    {
        $pdo = Database::connection();
        return (int) $pdo->query('SELECT COUNT(*) FROM schedules')->fetchColumn();
    }
}
