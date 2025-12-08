# SmartCampus Docker-Database-Project

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

# SmartCampus — Deliverable 4: Data Model & Architecture
## Project Summary:
SmartCampus is a platform to streamline student services across campus: advising, counseling, IT support, appointment booking, and service requests. This repository contains the database schema and deployment artifacts (Docker Compose)

## Project link:
- GitHub project: https://github.com/users/wbt6/projects/2

## Technologies used
- Database: Postgres (containerized via Docker Compose)
- Containerization: Docker & Docker Compose
- Backend: Node.js + Express or Python + FastAPI
- Frontend: Bootstrap, HTML and JS
- Cache: Redis (optional)
- Monitoring: Prometheus + Grafana (optional)
- Reverse proxy: Nginx
- CI/CD: GitHub Actions

## Contents
- `README.md` — this file
- `init-db` — two MySQL scripts, one to create and one to insert test data into the database
- `docker-compose.yml` — MySQL container example









