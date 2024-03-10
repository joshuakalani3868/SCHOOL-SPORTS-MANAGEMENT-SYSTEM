CREATE TABLE teams_roster (
    id INT AUTO_INCREMENT PRIMARY KEY,
    coach_id INT NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    monday VARCHAR(255),
    tuesday VARCHAR(255),
    wednesday VARCHAR(255),
    thursday VARCHAR(255),
    friday VARCHAR(255),
    saturday VARCHAR(255),
    sunday VARCHAR(255),
    time_range VARCHAR(255),
    activity_description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (coach_id) REFERENCES teams(coach_id)
);
CREATE TABLE teams_roster (
    id INT PRIMARY KEY AUTO_INCREMENT,
    coach_id INT,
    day_of_week VARCHAR(10),
    activity_time_range VARCHAR(50),
    activity_description VARCHAR(255),
    FOREIGN KEY (coach_id) REFERENCES teams(coach_id)
);
