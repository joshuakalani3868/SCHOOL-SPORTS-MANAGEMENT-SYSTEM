CREATE TABLE events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    event_name VARCHAR(255) NOT NULL,
    type ENUM('indoor', 'outdoor') NOT NULL,
    description TEXT,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    event_time TIME NOT NULL
);

ALTER TABLE events CHANGE COLUMN type facility_type ENUM('indoor', 'outdoor') NOT NULL;


ALTER TABLE events 
ADD COLUMN facility_name INT,
ADD CONSTRAINT fk_facility_name FOREIGN KEY (facility_name) REFERENCES facilities(id) ON DELETE CASCADE;


-- First, change the position of the column
ALTER TABLE events 
CHANGE COLUMN facility_name facility_name INT AFTER event_name;

-- Then, add the foreign key constraint
ALTER TABLE events 
ADD CONSTRAINT fk_facility_name FOREIGN KEY (facility_name) REFERENCES facilities(id) ON DELETE CASCADE;


CREATE TABLE events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    event_name VARCHAR(255) NOT NULL,
    facility_name INT,
    facility_type ENUM('indoor', 'outdoor') NOT NULL,
    description TEXT,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    event_time TIME NOT NULL,
    CONSTRAINT fk_facility_name FOREIGN KEY (facility_name) REFERENCES facilities(id) ON DELETE CASCADE
);

-- Add the facility_name column
ALTER TABLE events 
ADD COLUMN facility_name INT AFTER event_name;
