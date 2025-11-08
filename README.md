# Docker Database Project

## Overview
This project deliverable runs a PostgreSQL database in Docker, initialized automatically with tables and data.

## How to Run
1. Clone the repository:
   git clone https://github.com/wbt6/docker-database-project.git
   cd docker-database-project

2. Start database container
   docker compose up -d

3. Connect to the database
   docker exec -it smartcampus_db psql -U student -d smartcampusdb

4. Run
   SELECT * FROM departments
   SELECT * FROM users;
   SELECT * FROM staff_availability
   SELECT * FROM appointments;
   SELECT * FROM tickets;

## How to remove
docker compose down
