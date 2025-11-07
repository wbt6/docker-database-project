INSERT INTO users (name, email, role, department_id) VALUES
('Alice Student', 'alice@umbc.edu', 'student', NULL),
('Bob Student', 'bob@umbc.edu', 'student', NULL),
('Dr. Smith', 'smith@umbc.edu', 'staff', 1),
('Tutor Jane', 'jane@umbc.edu', 'staff', 2),
('Admin Sam', 'admin@umbc.edu', 'admin', 1);
 
INSERT INTO staff_availability (staff_id, start_time, end_time, location, is_virtual) VALUES
(3, '2025-11-05 10:00', '2025-11-05 11:00', 'ENG 102', FALSE),
(4, '2025-11-06 14:00', '2025-11-06 15:00', NULL, TRUE);
 
INSERT INTO appointments (student_id, staff_id, service_type, appointment_time, status) VALUES
(1, 3, 'Advising', '2025-11-05 10:00', 'booked'),
(2, 4, 'Tutoring', '2025-11-06 14:00', 'booked');
 
INSERT INTO tickets (student_id, category, description) VALUES
(1, 'Technical', 'Issue joining virtual tutoring session'),
(2, 'Advising', 'Advisor unavailable for scheduled appointment');