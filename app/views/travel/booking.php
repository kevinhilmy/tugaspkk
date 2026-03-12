<section class="card">
    <h2>Book Seat</h2>
    <p><strong><?= htmlspecialchars($schedule['origin']) ?> → <?= htmlspecialchars($schedule['destination']) ?></strong></p>
    <p>Departure: <?= htmlspecialchars($schedule['departure_time']) ?> | Price: Rp <?= number_format((float)$schedule['price'], 0, ',', '.') ?></p>

    <form method="POST" action="/?page=booking_submit" id="bookingForm">
        <input type="hidden" name="schedule_id" value="<?= (int)$schedule['id'] ?>">
        <input type="hidden" name="seat_number" id="seatNumber" required>

        <label>Passenger Name</label>
        <input type="text" name="passenger_name" required>

        <h3>Select Seat</h3>
        <div id="seatMap" data-booked='<?= json_encode($bookedSeats) ?>'></div>
        <p>Selected Seat: <strong id="selectedSeat">None</strong></p>

        <button type="submit">Confirm Booking</button>
    </form>
</section>
<script type="module" src="/assets/js/seat-map.js"></script>
