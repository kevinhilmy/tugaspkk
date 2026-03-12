<section class="card">
    <h2>Booking History</h2>
    <div class="table-wrap">
    <table>
        <thead><tr><th>Code</th><th>Route</th><th>Seat</th><th>Passenger</th><th>Status</th><th>Booked At</th></tr></thead>
        <tbody>
        <?php foreach ($bookings as $booking): ?>
            <tr>
                <td><?= htmlspecialchars($booking['booking_code']) ?></td>
                <td><?= htmlspecialchars($booking['origin']) ?> → <?= htmlspecialchars($booking['destination']) ?></td>
                <td><?= htmlspecialchars($booking['seat_number']) ?></td>
                <td><?= htmlspecialchars($booking['passenger_name']) ?></td>
                <td><?= htmlspecialchars($booking['status']) ?></td>
                <td><?= htmlspecialchars($booking['created_at']) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    </div>
</section>
