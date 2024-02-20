CREATE TABLE Student_Sports (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    sport_id INT NOT NULL,
    FOREIGN KEY (student_id) REFERENCES users(id),
    FOREIGN KEY (sport_id) REFERENCES Sports(id)
);
