CREATE TABLE facilities (
    id INT AUTO_INCREMENT PRIMARY KEY,
    facility_name VARCHAR(255) NOT NULL,
    facility_type ENUM('indoor', 'outdoor', 'arena') NOT NULL,
    sports_available TEXT,
    capacity INT,
    operating_time VARCHAR(255)
);

ALTER TABLE facilities
ADD operating_time_start TIME,
ADD operating_time_end TIME;


ALTER TABLE facilities
CHANGE COLUMN operating_hours operating_time VARCHAR(255);

-- Create the facilities table with the new columns
CREATE TABLE facilities (
    id INT AUTO_INCREMENT PRIMARY KEY,
    facility_name VARCHAR(255) NOT NULL,
    facility_type ENUM('indoor', 'outdoor', 'arena') NOT NULL,
    sports_available TEXT,
    capacity INT,
    operating_time_start TIME, -- New column for start time
    operating_time_end TIME -- New column for end time
);

-- Drop the operating_time column as it's no longer needed
ALTER TABLE facilities DROP COLUMN operating_time;