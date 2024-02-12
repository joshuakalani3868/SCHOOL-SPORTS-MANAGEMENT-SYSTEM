-- Set role as admin for a user with username 'admin_user'
UPDATE users SET role = 'admin' WHERE username = 'admin_user';

-- Set role as coach for a user with username 'coach_user'
UPDATE users SET role = 'coach' WHERE username = 'coach_user';

-- Set role as student for a user with username 'student_user'
UPDATE users SET role = 'student' WHERE username = 'student_user';
