CREATE TABLE results (
    id INT AUTO_INCREMENT PRIMARY KEY,
    event_name VARCHAR(255) NOT NULL,
    sport_name VARCHAR(255) NOT NULL,
    sport_type ENUM('single', 'double', 'team') NOT NULL,
    rank ENUM('winner', 'first place', 'second place', 'third place', 'participated') NOT NULL,
    score_line VARCHAR(255)
    student_name VARCHAR(255)
);


CREATE TABLE results (
    id INT AUTO_INCREMENT PRIMARY KEY,
    event_id INT NOT NULL,
    sport_id INT NOT NULL,
    student_id INT NOT NULL,
    sport_type ENUM('single', 'double', 'team') NOT NULL,
    rank ENUM('winner', 'first place', 'second place', 'third place', 'participated') NOT NULL,
    score_line VARCHAR(255),
    FOREIGN KEY (event_id) REFERENCES events(id),
    FOREIGN KEY (sport_id) REFERENCES sports(id),
    FOREIGN KEY (student_id) REFERENCES teams(student_id)
);

ALTER TABLE results MODIFY COLUMN student_id INT NULL;
