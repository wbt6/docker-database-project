# SmartCampus PHP Prototype

This repository contains a simple PHP + PostgreSQL prototype for the SmartCampus use-cases you provided.

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

> Note: Your repository already contains a Docker Compose for the database and `init_db` with tables and test entries. This app Dockerfile is intended to run as a separate service in the same Docker network as that DB.

## Quick start (local, Docker Desktop)
1. Ensure your database compose is running (the repo's existing `docker-compose.yml` that creates the DB and `init_db`).
2. Build the PHP app container:
```bash
docker build -t smartcampus-php-app .
```
3. Run with environment variables pointing to your DB container:
```bash
docker run -p 8080:80 -e DB_HOST=db -e DB_PORT=5432 -e DB_NAME=smartcampusdb -e DB_USER=student -e DB_PASS=student123 --network your_db_network smartcampus-php-app
```
4. Open `http://localhost:8080` and use the Test Login page to select a user (student/staff/admin) — test accounts must exist in the DB.

## Notes & limitations
- This is a small prototype. Many features (SSO integration, recurring availability expansion, report generation, two-way calendar sync, email notifications) are marked "not currently available" and would require additional backend work.
- All PHP files include the filename as the first line comment as requested.
- If you want a `docker-compose.yml` that includes both the DB and app, I can add one — but you indicated your repo already has a compose for the DB.

## Development tips
- For debugging DB connection issues, set the environment variables to match your DB service and check the container logs.
- Use `init_db` SQL to seed the DB with student/staff/admin accounts (your repo already includes these).

