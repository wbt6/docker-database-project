# SmartCampus Docker-Database-Project

## What
A sample Postgres database running in Docker with schema creation and sample data using `init-db/` scripts.

## Start
1. `docker compose up -d`
2. Wait for container to initialize (watch logs with `docker logs -f project_db`)

## Connect
- Host: `localhost`
- Port: `5432`
- DB: `projectdb`
- User: `student`
- Password: `student123`

Use `docker exec -it project_db psql -U student -d projectdb` to run queries.

## Stop / Remove
- Stop: `docker compose down`
- Stop + remove volumes (reset): `docker compose down -v`

## Files
- `docker-compose.yml` — runs postgres service
- `init-db/01_create_tables.sql` — DDL
- `init-db/02_insert_data.sql` — sample data

# SmartCampus — Deliverable 4: Data Model & Architecture

## Project link:
- GitHub project: https://github.com/users/wbt6/projects/2

## Technologies used
- Database: MySQL 8 (containerized via Docker Compose)
- Containerization: Docker & Docker Compose
- Backend: Node.js + Express (recommended) or Python + FastAPI
- Frontend: React (recommended) or static HTML/CSS
- Cache: Redis (optional)
- Monitoring: Prometheus + Grafana (optional)
- Reverse proxy: Nginx
- CI/CD: GitHub Actions

## Contents
- `README.md` — this file
- `init-db` — two MySQL scripts, one to create and one to insert test data into the database
- `docker-compose.yml` — MySQL container example






