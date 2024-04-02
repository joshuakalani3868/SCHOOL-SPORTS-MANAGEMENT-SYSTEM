CREATE TABLE Schools (
    school_id INT AUTO_INCREMENT PRIMARY KEY,
    school_name VARCHAR(50) NOT NULL,
    school_location VARCHAR(50),
    contact_person_name VARCHAR(50),
    contact_person_email VARCHAR(50),
    contact_person_phone VARCHAR(15),
    is_host ENUM('host', 'participant') NOT NULL
);
