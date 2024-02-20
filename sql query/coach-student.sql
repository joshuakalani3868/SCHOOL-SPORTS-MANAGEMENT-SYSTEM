-- Create Coach_Student_Mapping Table
CREATE TABLE IF NOT EXISTS Coach_Student_Mapping (
    id INT AUTO_INCREMENT PRIMARY KEY,
    coach_id INT NOT NULL,
    student_id INT NOT NULL,
    sport_id INT NOT NULL,
    FOREIGN KEY (coach_id) REFERENCES users(id),
    FOREIGN KEY (student_id) REFERENCES users(id),
    FOREIGN KEY (sport_id) REFERENCES Sports(id),
    UNIQUE KEY unique_mapping (coach_id, student_id, sport_id)
);