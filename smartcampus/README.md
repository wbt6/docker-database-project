# SmartCampus PHP Prototype

This repository contains a simple PHP + PostgreSQL prototype.

## Structure
- `index.php` — Test login page (first line comment contains filename).
- `UC-01.php` — Student Dashboard (students land here after login).
- `UC-02.php` — Book Appointment (placeholder).
- `UC-03.php` — Staff Manage Availability (form to add availability).
- `UC-03-create.php` — Handler to insert availability into `staff_availability`.
- `UC-04.php` — Submit & Track Issue (ticket creation).
- `UC-05.php` — Admin Reports (placeholder).
- `db.php` — Database connection helper. Uses environment variables:
  - `DB_HOST` (default: db)
  - `DB_PORT` (default: 5432)
  - `DB_NAME` (default: smartcampusdb)
  - `DB_USER` (default: student)
  - `DB_PASS` (default: student123)
- `assets/` — CSS and JS folders.
- `Dockerfile` — Builds a PHP + Apache image with `pdo_pgsql`.

## Notes & limitations
- This is a small prototype. Many features (SSO integration, recurring availability expansion, report generation, two-way calendar sync, email notifications) are marked "not currently available" and would require additional backend work.
- All PHP files include the filename as the first line comment.

