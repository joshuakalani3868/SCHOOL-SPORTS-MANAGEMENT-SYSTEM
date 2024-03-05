CREATE TABLE IF NOT EXISTS team (
    id INT AUTO_INCREMENT PRIMARY KEY,
    coach_id INT NOT NULL,
    sport_id INT NOT NULL,
    team_name VARCHAR(255),
    FOREIGN KEY (coach_id) REFERENCES users(id),
    FOREIGN KEY (sport_id) REFERENCES Sports(id)
);
