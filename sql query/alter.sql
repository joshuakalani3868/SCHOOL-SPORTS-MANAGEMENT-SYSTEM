ALTER TABLE sports
MODIFY COLUMN game_type ENUM('per_meter', 'per_quarter', 'per_half', 'per_inning', 'per_set', 'per_period', 'per_round') NOT NULL;