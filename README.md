# SmartCampus Docker Database Project

This project sets up a PostgreSQL database inside Docker for the **SmartCampus** system. 
It includes scripts to automatically create and populate tables when the container starts.

---

## 🧱 Project Structure

```
.
├── docker-compose.yml
├── init-db/
│   ├── 01_create_tables.sql
│   └── 02_insert_data.sql
└── screenshots/
```
- `docker-compose.yml` → Starts a PostgreSQL container.
- `init-db/` → SQL scripts that automatically run during container setup.
- `screenshots/` → Evidence of setup and verification.

---

## ▶️ How to Run

1. **Start the Database**
   ```bash
   docker compose up
   ```

2. **Access the Database**
   Open a new terminal and run:
   ```bash
   docker exec -it smartcampus_db psql -U student -d projectdb
   ```

3. **Verify the Tables**
   Inside psql, check that all tables were created and data inserted:
   ```sql
   \dt
   SELECT * FROM departments;
   SELECT * FROM users;
   SELECT * FROM staff_availability;
   SELECT * FROM appointments;
   SELECT * FROM tickets;
   ```

4. **Exit psql**
   ```bash
   \q
   ```

---

## 🧹 How to Stop and Clean Up

```bash
docker compose down
docker compose down -v   # removes the database volume (optional)
```

---

## ⚙️ Troubleshooting

- If port 5432 is already in use, change the left-hand side of the port mapping in `docker-compose.yml`, for example:
  ```yaml
  ports:
    - "55432:5432"
  ```
- Then reconnect using the updated port number.

---
