# SmartCampus: A Digital Platform for Optimizing Student Services
##Introduction
This repository contains the code for the Smartcampus website and database. Smartcampus is a centralized digital platform for advising, tutoring, SI sessions, and IT support for UMBC. Within this readme file are instructions which will allow you to run this as an image within dockerhub containers

## Downloading/Running Instructions

1) create a docker network using `docker network create smartcampus_net` via command prompt
2) Clone the repo to your local machine
3) Docker compose up in powershell while in your cloned repo to acquire your database image `docker compose up -d`
4) pull the most recent dockerhub image using command `docker pull wbt6/smartcampus:{tag}` via command prompt
4.5) You can make sure your database is running and correctly has the tables and entries by running `docker exec -it smartcampus_db psql -U student -d smartcampusdb`, followed by 
5) run the command `docker run -d --name smartcampus --network smartcampus_net -e DB_HOST=db -e DB_PORT=5432 -e DB_NAME=smartcampusdb -e DB_USER=student -e DB_PASS=student123 -p 8080:80 wbt6/smartcampus:17`
6) it should create a container named smartcampus, on the same network as the database
7) run the container, which should be at http://localhost:8080, it will take a few seconds to load upon first run, so be patient
8) If all steps are followed, you should see the test login screen. This is where the Single Sign On (SSO) Would be integrated to allow you to use your school login credentials to be used to access the site, but for testing purposes, this page has been provided. For more information about using the Website, see the User Guide

Note that if you are using a database located elsewhere, such as a cloud instance, that you will likely need to change the db file, located in the smartcampus directory, with your database's hostname, db name, username, and password. so long as your web container is able to find it, it should be able to function.

## User Guide
### For Students
When logged in, you will see your dashboard. Here you can view your upcoming appointments, submit tickers, book an appointment, and logout. By clicking **Submit Ticket/Feedback** You are brought to the ticketing page, where you can enter a category for your ticket as well as a description of your concern. This will be sent to admins for review. By Selecting **Book Appointment**, You are brought to the appointment screen. You first select which type of appointment you would like to book from the dropdown, followed by the staff member you would like to book. Then, you can choose between their availability times. **Submit** the appointment and you should be brought back to the dashboard, now with your appointment in the **upcoming appointments** section.

### For Staff
When logged in, you will see the availability manager. Here, you can create availability times for students to be able to book appointments. Simply add a start time and end time, and select whether or not this time is recurring (meaning you will always be available weekly at that time. Note that this feature is currently not available). Click **add availability** to add your availability for students to book.

### For Admins
When logged in, you will be brought to the analytics page. There are currently 2 buttons available: Generate usage report, and Schedule report (note that both are not currently available). Clicking **generate usage report** will create a report on service usage, appointments, ticket trends, and staff performance immediately. Clicking **Schedule report**, you are able to schedule a regular report at a specific time to be sent to a valid email address.

## Technologies used
- Database: Postgres (containerized via Docker Compose)
- Containerization: Docker & Docker Compose
- Backend: PHP, changed from Python FastAPI due to greater experience with PHP
- Frontend: Bootstrap, HTML and JS
- Cache: Redis (optional)
- Monitoring: Prometheus + Grafana (optional)
- Reverse proxy: Nginx
- CI/CD: GitHub Actions

## Contents
- `README.md` — this file
- `init-db` — two MySQL scripts, one to create and one to insert test data into the database
- `docker-compose.yml` — MySQL container example
- `.github/workflows` - contains the workflow which pushes changes to Dockerhub
- `smartcampus` - contains the code for the Smartcampus website









