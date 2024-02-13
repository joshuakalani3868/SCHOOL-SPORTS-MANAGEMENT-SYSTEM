CREATE TABLE sports (
    id INT AUTO_INCREMENT PRIMARY KEY,
    sport_name VARCHAR(255) NOT NULL,
    sport_type ENUM('single', 'double', 'team') NOT NULL,
    game_type ENUM('per_meter', 'duration') NOT NULL,
    number_of_players INT NOT NULL
);
