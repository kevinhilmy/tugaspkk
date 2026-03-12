<section class="stats-grid">
    <div class="stat card"><h3>Total Users</h3><p><?= (int)$userCount ?></p></div>
    <div class="stat card"><h3>Total Schedules</h3><p><?= (int)$scheduleCount ?></p></div>
    <div class="stat card"><h3>Total Bookings</h3><p><?= (int)$bookingCount ?></p></div>
</section>

<section class="card">
    <h2>Recent Bookings</h2>
    <div class="table-wrap">
        <table>
            <thead><tr><th>Code</th><th>User</th><th>Route</th><th>Seat</th><th>Departure</th></tr></thead>
            <tbody>
                <?php foreach ($recentBookings as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row['booking_code']) ?></td>
                    <td><?= htmlspecialchars($row['user_name']) ?></td>
                    <td><?= htmlspecialchars($row['origin']) ?> → <?= htmlspecialchars($row['destination']) ?></td>
                    <td><?= htmlspecialchars($row['seat_number']) ?></td>
                    <td><?= htmlspecialchars($row['departure_time']) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>
