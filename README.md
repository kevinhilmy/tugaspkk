# TravelGo - Intercity & Airport Booking (PHP MVC-like)

## Stack
- PHP (vanilla)
- MySQL
- HTML/CSS/Vanilla JS
- Designed for Laragon

## Setup (Laragon)
1. Create DB using `sql/database.sql`.
2. Put project in `laragon/www`.
3. Ensure Apache/Nginx points to project root (`index.php`) or `public/`.
4. Adjust DB credentials in `config/database.php` if needed.
5. Open app in browser.

## Default admin
- Email: `admin@travel.local`
- Password: `admin123`

## Structure
- `app/controllers` - request handlers
- `app/models` - DB access logic
- `app/views` - UI templates
- `core` - helpers and DB singleton
- `public/assets` - CSS/JS
- `sql/database.sql` - schema + seed
