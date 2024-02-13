CREATE TABLE results (
    id INT AUTO_INCREMENT PRIMARY KEY,
    event_name VARCHAR(255) NOT NULL,
    sport_name VARCHAR(255) NOT NULL,
    sport_type ENUM('single', 'double', 'team') NOT NULL,
    rank ENUM('winner', 'first place', 'second place', 'third place', 'participated') NOT NULL,
    score_line VARCHAR(255)
);
