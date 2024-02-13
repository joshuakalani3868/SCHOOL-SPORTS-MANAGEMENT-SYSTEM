CREATE TABLE facilities (
    id INT AUTO_INCREMENT PRIMARY KEY,
    facility_name VARCHAR(255) NOT NULL,
    facility_type ENUM('indoor', 'outdoor', 'arena') NOT NULL,
    sports_available TEXT,
    capacity INT,
    operating_hours VARCHAR(255)
);
