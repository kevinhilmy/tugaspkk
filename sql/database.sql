CREATE DATABASE IF NOT EXISTS travel_booking CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE travel_booking;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    role ENUM('user','admin') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE schedules (
    id INT AUTO_INCREMENT PRIMARY KEY,
    route_type ENUM('intercity','airport') NOT NULL,
    origin VARCHAR(100) NOT NULL,
    destination VARCHAR(100) NOT NULL,
    departure_time DATETIME NOT NULL,
    arrival_time DATETIME NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    seats_total INT DEFAULT 24,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    schedule_id INT NOT NULL,
    seat_number VARCHAR(10) NOT NULL,
    passenger_name VARCHAR(100) NOT NULL,
    booking_code VARCHAR(20) NOT NULL UNIQUE,
    status ENUM('confirmed','cancelled') DEFAULT 'confirmed',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (schedule_id) REFERENCES schedules(id) ON DELETE CASCADE,
    UNIQUE KEY unique_schedule_seat (schedule_id, seat_number)
);

INSERT INTO users (full_name, email, password_hash, role)
VALUES
('Admin Laragon', 'admin@travel.local', '$2y$12$OOj76Qb/cjd28lzM0SMS7O42D6Nbg3v0ujQu84mTRRXDBD8mVICa2', 'admin');
-- password: admin123

INSERT INTO schedules (route_type, origin, destination, departure_time, arrival_time, price, seats_total)
VALUES
('intercity', 'Jakarta', 'Bandung', DATE_ADD(NOW(), INTERVAL 1 DAY), DATE_ADD(NOW(), INTERVAL 1 DAY + INTERVAL 3 HOUR), 120000, 24),
('intercity', 'Bandung', 'Yogyakarta', DATE_ADD(NOW(), INTERVAL 2 DAY), DATE_ADD(NOW(), INTERVAL 2 DAY + INTERVAL 7 HOUR), 240000, 24),
('airport', 'Central Jakarta', 'Soekarno-Hatta Airport', DATE_ADD(NOW(), INTERVAL 6 HOUR), DATE_ADD(NOW(), INTERVAL 8 HOUR), 90000, 24),
('airport', 'South Jakarta', 'Halim Airport', DATE_ADD(NOW(), INTERVAL 4 HOUR), DATE_ADD(NOW(), INTERVAL 5 HOUR), 70000, 24);
