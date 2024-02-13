CREATE TABLE facility_sport (
    facility_id INT,
    sport_id INT,
    FOREIGN KEY (facility_id) REFERENCES facilities(id),
    FOREIGN KEY (sport_id) REFERENCES sports(id),
    PRIMARY KEY (facility_id, sport_id)
);
