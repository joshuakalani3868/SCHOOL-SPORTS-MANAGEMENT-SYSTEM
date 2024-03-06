CREATE TABLE sports (
    id INT AUTO_INCREMENT PRIMARY KEY,
    sport_name VARCHAR(255) NOT NULL,
    sport_type ENUM('single', 'double', 'team') NOT NULL,
    game_type ENUM('per_meter', 'duration') NOT NULL,
    number_of_players INT NOT NULL
);


ALTER TABLE sports
ADD COLUMN game_type ENUM('per_meter', 'per_quarter', 'per_half', 'per_inning', 'per_set', 'per_period', 'per_round') NOT NULL;

ALTER TABLE sports
MODIFY COLUMN game_type ENUM('per_meter', 'per_quarter', 'per_half', 'per_inning', 'per_set', 'per_period', 'per_round') NOT NULL;

ALTER TABLE sports
ADD COLUMN facility_type ENUM('indoor', 'outdoor') NOT NULL AFTER number_of_players;
