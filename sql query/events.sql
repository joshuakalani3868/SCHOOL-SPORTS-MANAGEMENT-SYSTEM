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

-- Add new columns for school names
ALTER TABLE events
    ADD COLUMN host_school VARCHAR(255),
    ADD COLUMN participant_school VARCHAR(255);












-- Add the facility_name column
ALTER TABLE events 
ADD COLUMN facility_name INT AFTER event_name;


CREATE TABLE events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    event_name VARCHAR(255) NOT NULL,
    host_school_id INT,
    participant_school_id INT,
    facility_name INT,
    facility_type ENUM('indoor', 'outdoor') NOT NULL,
    description TEXT,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    event_time TIME NOT NULL,
    CONSTRAINT fk_host_school_id FOREIGN KEY (host_school_id) REFERENCES Schools(school_id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_participant_school_id FOREIGN KEY (participant_school_id) REFERENCES Schools(school_id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_facility_name FOREIGN KEY (facility_name) REFERENCES facilities(id) ON DELETE CASCADE
);

ALTER TABLE events
ADD COLUMN host_school INT,
ADD COLUMN participant_school INT,
ADD CONSTRAINT fk_host_school FOREIGN KEY (host_school) REFERENCES Schools(school_id) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT fk_participant_school FOREIGN KEY (participant_school) REFERENCES Schools(school_id) ON DELETE CASCADE ON UPDATE CASCADE;

-- Remove the existing columns for school IDs
ALTER TABLE events
    DROP COLUMN host_school,
    DROP COLUMN participant_school;

    
