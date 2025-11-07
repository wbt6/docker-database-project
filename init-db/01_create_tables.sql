CREATE TABLE departments (
	department_id SERIAL PRIMARY KEY,
	name VARCHAR(100) NOT NULL
);
CREATE TABLE users (
	user_id SERIAL PRIMARY KEY,
	name VARCHAR(100) NOT NULL,
	email VARCHAR(100) UNIQUE NOT NULL,
	role VARCHAR(20) CHECK (role IN ('student', 'staff', 'admin')) NOT NULL,
	department_id INT REFERENCES departments(department_id),
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE staff_availability (
	availability_id SERIAL PRIMARY KEY,
	staff_id INT REFERENCES users(user_id),
	start_time TIMESTAMP NOT NULL,
	end_time TIMESTAMP NOT NULL,
	location VARCHAR(100),
	is_virtual BOOLEAN DEFAULT FALSE
);
CREATE TABLE appointments (
	appointment_id SERIAL PRIMARY KEY,
	student_id INT REFERENCES users(user_id),
	staff_id INT REFERENCES users(user_id),
	service_type VARCHAR(50),
	appointment_time TIMESTAMP NOT NULL,
	status VARCHAR(20) DEFAULT 'booked'
    	CHECK (status IN ('booked', 'canceled', 'completed')),
	notes TEXT
);
CREATE TABLE tickets (
	ticket_id SERIAL PRIMARY KEY,
	student_id INT REFERENCES users(user_id),
	category VARCHAR(50),
	description TEXT NOT NULL,
	status VARCHAR(20) DEFAULT 'open'
    	CHECK (status IN ('open', 'in progress', 'resolved')),
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
