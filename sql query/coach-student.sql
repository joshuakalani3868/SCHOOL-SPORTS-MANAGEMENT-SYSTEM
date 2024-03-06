-- Create Coach_Student Table
CREATE TABLE IF NOT EXISTS teams (
    id INT AUTO_INCREMENT PRIMARY KEY,
    coach_id INT NOT NULL,
    student_id INT NOT NULL,
    sport_id INT NOT NULL,
    FOREIGN KEY (coach_id) REFERENCES users(id),
    FOREIGN KEY (student_id) REFERENCES users(id),
    FOREIGN KEY (sport_id) REFERENCES Sports(id),
    UNIQUE KEY unique_mapping (coach_id, student_id, sport_id)
);

--new table
CREATE TABLE IF NOT EXISTS Coach_Student (
    id INT AUTO_INCREMENT PRIMARY KEY,
    coach_id INT NOT NULL,
    student_id INT NOT NULL,
    sport_id INT NOT NULL,
    team_id INT, -- Add a new column to store the team ID
    FOREIGN KEY (coach_id) REFERENCES users(id),
    FOREIGN KEY (student_id) REFERENCES users(id),
    FOREIGN KEY (sport_id) REFERENCES Sports(id),
    FOREIGN KEY (team_id) REFERENCES team(id), -- Reference to a new Team table
    UNIQUE KEY unique_mapping (coach_id, student_id, sport_id)
);
