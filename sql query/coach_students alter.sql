-- Add the team_id column to the existing Coach_Student table
ALTER TABLE Coach_Student
ADD COLUMN team_id INT,
ADD FOREIGN KEY (team_id) REFERENCES team(id);
