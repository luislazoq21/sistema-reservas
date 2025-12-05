INSERT INTO users (name, email, password) VALUES ('Luis Lazo', 'luis@gmail.com', '12345678');

INSERT INTO services (name, description, regular_price, duration_minutes) VALUES
('Service 1', 'Description 1', 99.90, 60),
('Service 2', 'Description 2', 119.90, 80),
('Service 3', 'Description 3', 69.90, 60);

INSERT INTO reservations (service_id, customer_name, customer_email, start_date, end_date, price_paid) VALUES
(1, 'Juan Pérez', 'juan@gmail.com', '2025-12-05 15:00', '2025-12-05 16:00', 99.90),
(2, 'María Zegarra', 'maria@gmail.com', '2025-12-04 15:00', '2025-12-04 16:20', 119.90),
(3, 'Jorge Ramírez', 'jorge@gmail.com', '2025-12-03 15:00', '2025-12-03 16:00', 69.90),
(1, 'Carlos Díaz', 'carlos@gmail.com', '2025-12-02 15:00', '2025-12-02 16:00', 99.90),
(2, 'Araceli García', 'araceli@gmail.com', '2025-12-01 15:00', '2025-12-01 16:20', 119.90);