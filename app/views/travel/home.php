<section class="card">
    <h2>Search Travel Schedule</h2>
    <form method="GET" class="grid-form">
        <input type="hidden" name="page" value="home">
        <select name="route_type">
            <option value="">All Route Types</option>
            <option value="intercity" <?= ($filters['route_type'] ?? '') === 'intercity' ? 'selected' : '' ?>>Intercity</option>
            <option value="airport" <?= ($filters['route_type'] ?? '') === 'airport' ? 'selected' : '' ?>>Airport</option>
        </select>
        <input type="text" name="origin" placeholder="Origin" value="<?= htmlspecialchars($filters['origin'] ?? '') ?>">
        <input type="text" name="destination" placeholder="Destination" value="<?= htmlspecialchars($filters['destination'] ?? '') ?>">
        <button type="submit">Search</button>
    </form>
</section>

<section class="card">
    <h2>Available Schedules</h2>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Type</th><th>Route</th><th>Departure</th><th>Arrival</th><th>Price</th><th>Seats</th><th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($schedules as $schedule): ?>
                <tr>
                    <td><?= htmlspecialchars($schedule['route_type']) ?></td>
                    <td><?= htmlspecialchars($schedule['origin']) ?> → <?= htmlspecialchars($schedule['destination']) ?></td>
                    <td><?= htmlspecialchars($schedule['departure_time']) ?></td>
                    <td><?= htmlspecialchars($schedule['arrival_time']) ?></td>
                    <td>Rp <?= number_format((float)$schedule['price'], 0, ',', '.') ?></td>
                    <td><?= (int)$schedule['seats_available'] ?></td>
                    <td>
                        <?php if (auth_user()): ?>
                            <a class="btn-small" href="/?page=booking&schedule_id=<?= (int)$schedule['id'] ?>">Book</a>
                        <?php else: ?>
                            <a class="btn-small" href="/?page=login">Login to Book</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>
