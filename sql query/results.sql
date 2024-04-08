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

ALTER TABLE results
DROP FOREIGN KEY `results_ibfk_3`, -- Dropping existing foreign key constraint
ADD CONSTRAINT `results_ibfk_3` FOREIGN KEY (`student_id`) REFERENCES `teams` (`student_id`) ON DELETE CASCADE;

SHOW CREATE TABLE results;
ALTER TABLE results DROP FOREIGN KEY `results_ibfk_3`;
ALTER TABLE results
ADD CONSTRAINT `results_ibfk_3` FOREIGN KEY (`student_id`) REFERENCES `teams` (`student_id`) ON DELETE CASCADE;

ALTER TABLE results
DROP FOREIGN KEY `results_ibfk_3`, 
ADD CONSTRAINT `results_ibfk_3` FOREIGN KEY (`student_id`) REFERENCES `student_sports` (`student_id`) ON DELETE CASCADE;


-- Table structure for table `results`
--
ALTER TABLE `results`
ADD COLUMN `draw_a_id` int(11) DEFAULT NULL,
ADD COLUMN `draw_b_id` int(11) DEFAULT NULL,
ADD CONSTRAINT `fk_draw_a` FOREIGN KEY (`draw_a_id`) REFERENCES `schools` (`school_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fk_draw_b` FOREIGN KEY (`draw_b_id`) REFERENCES `schools` (`school_id`) ON DELETE CASCADE ON UPDATE CASCADE;


-- Table structure for table `results`
--
CREATE TABLE `results` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `sport_id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `sport_type` enum('single','double','team') NOT NULL,
  `rank` enum('winner','first place','second place','third place','participated') NOT NULL,
  `score_line` varchar(255) DEFAULT NULL,
  `draw_a_id` int(11) DEFAULT NULL,
  `draw_b_id` int(11) DEFAULT NULL,
  CONSTRAINT `fk_draw_a` FOREIGN KEY (`draw_a_id`) REFERENCES `schools` (`school_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_draw_b` FOREIGN KEY (`draw_b_id`) REFERENCES `schools` (`school_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ;
