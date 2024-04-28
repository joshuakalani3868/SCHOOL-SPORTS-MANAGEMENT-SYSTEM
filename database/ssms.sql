-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2024 at 05:44 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ssms`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `facility_name` int(11) DEFAULT NULL,
  `facility_type` enum('indoor','outdoor') NOT NULL,
  `description` text DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `event_time` time NOT NULL,
  `host_school` varchar(255) DEFAULT NULL,
  `participant_school` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `event_name`, `facility_name`, `facility_type`, `description`, `start_date`, `end_date`, `event_time`, `host_school`, `participant_school`) VALUES
(1, 'Maseno Opens Tournament', 8, 'outdoor', 'Maseno to host it\'s annual  field games', '2024-04-06', '2024-04-07', '07:30:00', '1', '2,5,6'),
(2, 'Maseno Rugby Fifteens', 3, 'outdoor', 'Maseno to host Rugby15\'s round off 16', '2024-04-13', '2024-04-14', '10:30:00', '1', '5,6,7,8'),
(3, 'Maseno Hockey quaters', 4, 'outdoor', 'Maseno to host Hockey quater stages', '2024-04-20', '2024-04-21', '08:30:00', '1', '2,5,6'),
(4, 'Maseno Tennis group stages', 1, 'indoor', 'Maseno to host Tennis group stages', '2024-04-06', '2024-04-07', '16:30:00', '1', '7,8'),
(5, 'Maseno long distance regionals', 8, 'outdoor', 'Maseno to host host Long distance regional athletics', '2024-04-27', '2024-04-28', '08:30:00', '1', '2,7'),
(6, 'Maseno swiming opens', 9, 'indoor', 'Maseno to host swimming opens competitions', '2024-04-12', '2024-04-12', '10:30:00', '1', '2,3,4,5,6,7,8'),
(7, 'Maseno kick boxing counties', 6, 'indoor', 'Maseno to host county kick boxing event', '2024-04-05', '2024-04-05', '10:30:00', '1', '2'),
(8, 'Maseno Hockey semi\'s', 3, 'outdoor', 'Maseno to host Hockey semis', '2024-05-11', '2024-05-12', '08:30:00', '1', '3,4,8'),
(9, 'Maseno swiming finals', 5, 'indoor', 'Maseno to host Swimming finals', '2024-05-24', '2024-05-24', '10:30:00', '1', '5,6'),
(10, 'Maseno Rugby sevens finals', 3, 'outdoor', 'Maseno to host Rugby Sevens finals', '2024-05-03', '2024-05-03', '08:30:00', '1', '4');

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

CREATE TABLE `facilities` (
  `id` int(11) NOT NULL,
  `facility_name` varchar(255) NOT NULL,
  `facility_type` enum('indoor','outdoor','arena') NOT NULL,
  `sports_available` text DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL,
  `operating_time_start` time DEFAULT NULL,
  `operating_time_end` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `facilities`
--

INSERT INTO `facilities` (`id`, `facility_name`, `facility_type`, `sports_available`, `capacity`, `operating_time_start`, `operating_time_end`) VALUES
(1, 'Maseno Hindocha Hall', 'indoor', 'Tennis', 100, '16:30:00', '20:30:00'),
(2, 'Maseno GSQ', 'outdoor', 'Football', 200, '08:30:00', '20:30:00'),
(3, 'Maseno Hq Grounds', 'outdoor', 'Rugby', 300, '10:30:00', '20:30:00'),
(4, 'Maseno Hospital Grounds', 'outdoor', 'Hockey', 150, '08:30:00', '20:30:00'),
(5, 'Maseno City Campus', 'indoor', 'Swimming', 70, '09:30:00', '18:30:00'),
(6, 'Maseno GSQ', 'indoor', 'Kick boxing', 50, '10:30:00', '18:30:00'),
(7, 'Maseno GSQ', 'outdoor', 'Basketball', 150, '10:30:00', '18:30:00'),
(8, 'Maseno Mosque Grounds', 'outdoor', 'Long Distance Race', 100, '08:30:00', '20:30:00'),
(9, 'Maseno City Campus', 'indoor', 'Water polo', 70, '10:30:00', '18:30:00'),
(11, 'Maseno Hindocha Hall', 'indoor', 'Baseball', 100, '16:30:00', '20:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `facility_sport`
--

CREATE TABLE `facility_sport` (
  `facility_id` int(11) NOT NULL,
  `sport_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
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
  `draw_b_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`id`, `event_id`, `sport_id`, `student_id`, `sport_type`, `rank`, `score_line`, `draw_a_id`, `draw_b_id`) VALUES
(1, 1, 1, NULL, 'team', 'winner', '3-0', 1, 5),
(2, 2, 7, NULL, 'team', 'second place', '11-34', 1, 8),
(3, 5, 5, 9, 'single', 'winner', '1:56.23 ', 1, 6),
(4, 7, 10, 15, 'single', 'participated', '2-0', 4, 3),
(5, 4, 2, 13, 'single', 'third place', '13-20', 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

CREATE TABLE `schools` (
  `school_id` int(11) NOT NULL,
  `school_name` varchar(50) NOT NULL,
  `school_location` varchar(50) DEFAULT NULL,
  `contact_person_name` varchar(50) DEFAULT NULL,
  `contact_person_email` varchar(50) DEFAULT NULL,
  `contact_person_phone` varchar(15) DEFAULT NULL,
  `is_host` enum('host','participant') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schools`
--

INSERT INTO `schools` (`school_id`, `school_name`, `school_location`, `contact_person_name`, `contact_person_email`, `contact_person_phone`, `is_host`) VALUES
(1, 'Maseno University', 'Maseno', 'Mr.Owalo', 'owalo@gmail.com', '0789044567', 'host'),
(2, 'Moi Univeristy', 'Edoret', 'Mr.Kiprono', 'kiprono@gmail.om', '0734567821', 'participant'),
(3, 'Kenyatta University', 'Kiambu', 'Mr.Wanjala', 'wanjala@gmail.com', '0723465789', 'participant'),
(4, 'Strathmore University', 'Nairobi', 'Mr.Kamau', 'kamau@gmil.com', '0789654321', 'participant'),
(5, 'Masinde Muliro', 'Nakuru', 'Mr.Mutiso', 'mutiso@gmail.com', '0788805674', 'participant'),
(6, 'University of Nairobi', 'Nairobi', 'Mr.Kidero', 'kidero@gmail.com', '0744567823', 'participant'),
(7, 'Egerton University', 'Narok', 'Mr.Nkunku', 'nkuku@gmail.com', '0733467512', 'participant'),
(8, 'Mount kenya University', 'Thika', 'Mr.Ahmed', 'ahmed@gmail.com', '0785674321', 'participant');

-- --------------------------------------------------------

--
-- Table structure for table `sports`
--

CREATE TABLE `sports` (
  `id` int(11) NOT NULL,
  `sport_name` varchar(255) NOT NULL,
  `sport_type` enum('single','double','team') NOT NULL,
  `game_type` enum('per_meter','per_quarter','per_half','per_inning','per_set','per_period','per_round') NOT NULL,
  `number_of_players` int(11) NOT NULL,
  `facility_type` enum('indoor','outdoor') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sports`
--

INSERT INTO `sports` (`id`, `sport_name`, `sport_type`, `game_type`, `number_of_players`, `facility_type`) VALUES
(1, 'Hockey', 'team', 'per_quarter', 12, 'outdoor'),
(2, 'Tennis', 'single', 'per_set', 1, 'indoor'),
(3, 'Basketball', 'team', 'per_quarter', 5, 'outdoor'),
(4, 'Swimming', 'single', 'per_meter', 1, 'indoor'),
(5, 'Long Distance Race', 'single', 'per_meter', 1, 'outdoor'),
(6, 'Football', 'team', 'per_half', 12, 'outdoor'),
(7, 'Rugby', 'team', 'per_half', 15, 'outdoor'),
(8, 'Baseball', 'team', 'per_inning', 9, 'indoor'),
(9, 'Water polo', 'single', 'per_period', 7, 'indoor'),
(10, 'Kick boxing', 'single', 'per_round', 1, 'indoor');

-- --------------------------------------------------------

--
-- Table structure for table `student_sports`
--

CREATE TABLE `student_sports` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `sport_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_sports`
--

INSERT INTO `student_sports` (`id`, `student_id`, `sport_id`) VALUES
(1, 7, 1),
(2, 31, 1),
(3, 32, 1),
(4, 42, 1),
(5, 20, 2),
(6, 3, 2),
(7, 39, 5),
(8, 40, 9),
(9, 17, 5),
(10, 18, 7),
(11, 38, 5),
(12, 16, 7),
(13, 19, 2),
(14, 22, 8),
(15, 23, 1),
(16, 5, 2),
(17, 47, 1),
(18, 15, 9),
(19, 9, 5),
(20, 12, 10),
(21, 13, 1);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` int(11) NOT NULL,
  `coach_id` int(11) NOT NULL,
  `sport_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `coach_id`, `sport_id`, `student_id`) VALUES
(32, 4, 1, 7),
(59, 4, 1, 13),
(64, 4, 1, 23),
(25, 4, 1, 31),
(28, 4, 1, 32),
(29, 4, 1, 42),
(30, 4, 1, 47),
(37, 6, 2, 3),
(65, 6, 2, 5),
(38, 6, 2, 19),
(36, 6, 2, 20),
(66, 8, 9, 15),
(49, 8, 9, 40),
(67, 46, 5, 9),
(44, 46, 5, 17),
(43, 46, 5, 38),
(33, 46, 5, 39),
(68, 48, 10, 12);

-- --------------------------------------------------------

--
-- Table structure for table `teams_roster`
--

CREATE TABLE `teams_roster` (
  `id` int(11) NOT NULL,
  `coach_id` int(11) DEFAULT NULL,
  `day_of_week` enum('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday') DEFAULT NULL,
  `activity_time_range` varchar(50) DEFAULT NULL,
  `activity_description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teams_roster`
--

INSERT INTO `teams_roster` (`id`, `coach_id`, `day_of_week`, `activity_time_range`, `activity_description`) VALUES
(6, 4, 'Monday', '16:00-18:30', 'ball works'),
(7, 4, 'Wednesday', '16:30-17:30', 'Endurance run'),
(9, 4, 'Thursday', '16:30-17:30', 'dribbling and control'),
(10, 46, 'Monday', '16:00-18:30', 'cardio'),
(11, 46, 'Friday', '16:00-18:30', 'full body stretches and flexibility '),
(12, 46, 'Saturday', '08:30-10:30', 'morning run around the block'),
(13, 8, 'Monday', '16:00-18:30', 'lungs expansion and endurance'),
(14, 8, 'Thursday', '16:00-18:30', 'formations practice'),
(15, 8, 'Friday', '16:30-17:30', 'pre game match'),
(16, 6, 'Monday', '16:00-18:30', 'arms and legs workout'),
(17, 6, 'Friday', '16:00-18:30', 'tennis court suicide drill'),
(18, 48, 'Monday', '16:00-18:30', 'knuckles hardening and timing drill');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT curtime(),
  `role` varchar(50) NOT NULL DEFAULT 'student',
  `age` int(11) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `pwd`, `email`, `created_at`, `role`, `age`, `gender`, `phone_number`) VALUES
(1, 'john', '$2y$10$n0U0wRptZJ.Lr3g8LK4IBeAdkCSTJflwoz270/DnLoBaOSUd/RAu.', 'johndoe@gmail.com', '2024-03-06 15:10:21', 'admin', 54, 'male', '0711999261'),
(2, 'dolan', '$2y$10$NxCOctSX2JpN.5XB.rJkkOzOmo4qbADXd.4aBJLQli8glMoLMNQS6', 'dolan@gmail.com', '2024-03-06 15:23:30', 'admin', 44, 'male', '0726024454'),
(3, 'mary', '$2y$10$IGvNcCbUVbGp84xzjZmw4u5kTJ5sI2pb6VG/KnFBcwjRKvASUb7CG', 'mary@gmail.com', '2024-03-06 15:25:38', 'student', 23, 'female', '07260 24453'),
(4, 'richard', '$2y$10$HMVE.YAyDCvAAk9XRIS9g.378MwUsdiK7ewjqawx2d0Zul8hEKGxG', 'richard@gmail.com', '2024-03-06 15:39:58', 'coach', 34, 'male', '0723499986'),
(5, 'sam', '$2y$10$pWXV0IQkctSS2Xo5o7liDOKY75V2smLZQoLQ2mebfeKIqtzU8VLvC', 'sam@gmail.com', '2024-03-06 15:56:55', 'student', 19, 'female', '0788354672'),
(6, 'krewella', '$2y$10$g0gBePSH8M2gW5eoI36s5OSkQqnsil5gJj/UhUuwvYMmVSNmla6pW', 'krewella@gmail.com', '2024-03-06 15:57:49', 'coach', 21, 'female', '0789654378'),
(7, 'kaka', '$2y$10$1JhQagupfoNByFmRG2uaJu6jx08P8ab5CrXft2HoEEM.Pf9HgZq1.', 'kaka@gmail.com', '2024-03-06 15:59:34', 'student', 22, 'male', '0734562170'),
(8, 'lydia', '$2y$10$RSewTcVMm6tE7ft5QPXeou3VntWOUc5KqwsAvhr/7BScLikNxltpy', 'lydia@gmail.com', '2024-03-06 16:14:31', 'coach', 35, 'female', '0734562134'),
(9, 'mathew', '$2y$10$XlvGpyoqOLkMoMRDOmg6nOSJSPEzMqJGDOCdlPChyg/edGFj0O3U.', 'mathew@gmail.com', '2024-03-06 16:24:41', 'student', 16, 'male', '0768974563'),
(10, 'vincent', '$2y$10$TFdVhrpApUnItUXE6Pe9mecC8q3cehPDxWTfL5txqERmRYp/bUBWm', 'Vincent@gmail.com', '2024-03-06 16:25:32', 'coach', 56, 'male', '0789009345'),
(11, 'lisa', '$2y$10$FgUeNaZK3mfv3ERhyWV59OVy9gNghdVvUoPNHwcWdAynxiXbWwP52', 'lisa@gmail.com', '2024-03-06 17:57:57', 'student', 23, 'female', '0756777345'),
(12, 'saka', '$2y$10$ghThJZlO6nhz.ldq12sjbOsWrJ5YJHVC0pfteEfYp//QWxE30Wr0u', 'saka@gmail.com', '2024-03-06 19:31:43', 'student', 21, 'male', '0711765432'),
(13, 'halsey', '$2y$10$8Eb3NgYBrUTS5x4GQzyLOuxeIKM.ZaGSXKeJ.jY4jFtn1lAsI3fGC', 'halsey@gmail.com', '2024-03-06 19:32:49', 'student', 21, 'female', '0745674342'),
(14, 'james', '$2y$12$Kxrfvc0q6lKN2.R61Tdadu.Fx8bGrNEg99kkagrGRp5UTkKx.CbCu', 'james@gmail.com', '2024-03-06 19:33:23', 'student', NULL, NULL, NULL),
(15, 'jack', '$2y$10$zVTVC5Dbdz//aCmTY8TrAOe7TWKzgHMVnpDrkXOD8eWOhknoYLrsW', 'jack@gmail.com', '2024-03-06 20:04:00', 'student', 16, 'male', '0789654321'),
(16, 'mark', '$2y$10$FZHBCFQc3H9UCj2dGhmQjOxIxQD9jNiDJx8DMbG6XqvfbuuvvWY6q', 'mark@gmail.com', '2024-03-06 20:04:29', 'student', 19, 'male', '0789265473'),
(17, 'faith', '$2y$10$BE4wQCDRGrBaf563biBE0.TDuJo.Lj3Kx9QxuM/4FKlJJOcRE/TUG', 'faith@gmail.com', '2024-03-06 20:04:49', 'student', 17, 'female', '0723456765'),
(18, 'babu', '$2y$10$zUL2PbcfOPL9vyA8jpBRGOUAjvh4q1KPq9KcLgRKkGpVJ80QWKmoO', 'babu@gmail.com', '2024-03-06 20:05:05', 'student', 23, 'male', '0745678543'),
(19, 'lady', '$2y$10$wwZqcRdfQXL/.0foNaMrAObjU0nPjEUfOqTZKfgd/6.eDzLLdZYs2', 'lady@gmail.com', '2024-03-06 20:05:22', 'student', 20, 'female', '0789654563'),
(20, 'lucy', '$2y$10$HtXVYnXtJmv8lSIG1kiV4euZZTuzr3HZaXDJDwkSxkx6BELL2vRZK', 'lucy@gmail.com', '2024-03-06 20:05:39', 'student', 21, 'male', '0734567832'),
(21, 'lloyd', '$2y$12$Jyg6WIledPwPeAgl3HGMHejYTDIgCKaifVjD68J0u7cQrxKATZ9Tu', 'lloyd@gmail.com', '2024-03-06 20:06:00', 'student', NULL, NULL, NULL),
(22, 'boss', '$2y$10$iM4F/aPEcI/ty2nOV6qk1OrCeBnle0hAvKYWtbFwdHbBdf6lrUzp2', 'boss@gmail.com', '2024-03-06 20:06:16', 'student', 23, 'male', '0723654782'),
(23, 'doc', '$2y$12$3UwIoqzmQtKoFRDLwSLq9uzUNXcKvhmOPzzpuuJleru3C9KgPyASq', 'doc@gmail.com', '2024-03-06 20:06:33', 'student', NULL, NULL, NULL),
(24, 'miss', '$2y$12$GWCtZ/vZPAy7dugeARUEiOXUacc7yLGcsjyb4WSPg1VcbuIMys30C', 'miss@gmail.com', '2024-03-06 20:06:49', 'student', NULL, NULL, NULL),
(25, 'dan', '$2y$12$0zH2unQNnMXYEBk/JE3jkOmQA1GIYC3StmnWcUMQ4GkRNUp/B.rZC', 'dan@gmail.com', '2024-03-06 20:07:25', 'student', NULL, NULL, NULL),
(26, 'fun', '$2y$12$m2n8W.F165LNif2sSNFDFeF1HaXtHI2zqjuQQNFK8s0MmZDrt8kgq', 'fun@gmail.com', '2024-03-06 20:07:45', 'student', NULL, NULL, NULL),
(27, 'george', '$2y$12$GhiU8HHPI/bGfd/UEoXu7uTbY4GjYXLt4EyjyKnPostnC/1stFc4K', 'george@gmail.com', '2024-03-06 20:08:06', 'student', NULL, NULL, NULL),
(28, 'dony', '$2y$12$Yc2ROgBtBMLaGBTKipzW1uUTPQdnQnJODDKkKRLVkw.rMZxt7gwGy', 'dony@gmail.com', '2024-03-06 20:08:23', 'student', NULL, NULL, NULL),
(29, 'fanco', '$2y$12$eFrocD605zQ7rXMWNGear.Ts.F4jnCHblpN7tRLyrtrRNDHpJiGYa', 'fanco@gmail.com', '2024-03-06 20:08:41', 'student', NULL, NULL, NULL),
(30, 'bie', '$2y$10$VtoNmF5kYGy6qDhecMgUFeI.TvIcAssR7Ok4wiP9/T6GapJj9AAQS', 'bie@gmail.com', '2024-03-06 20:08:57', 'coach', 43, 'female', '0789432123'),
(31, 'loki', '$2y$12$lvmXoRIJVatkulJLHQJyIujlfv9zKMnPI7nb.w3BIlUooMo5T6aWK', 'loki@gmail.com', '2024-03-06 20:09:14', 'student', NULL, NULL, NULL),
(32, 'thor', '$2y$12$hF0A94a9fnq48fdHJzk5i.1ra7N3DYS0/WpkmPbHh19cTNJpDfAaa', 'thor@gmail.com', '2024-03-06 20:10:10', 'student', NULL, NULL, NULL),
(33, 'ordin', '$2y$12$MNrNE/UIZWyo4VAe/QrGvuetxpGqNCdc/q7tlw91Ru9ryrpfxhFfq', 'ordin@gmail.com', '2024-03-06 20:10:28', 'student', NULL, NULL, NULL),
(34, 'marcus', '$2y$12$UT/QtUQxRz7GRs8rp0jLBur/L9yHH1udhjoo1Acj7FjTiNXVnHiea', 'marcus@gmail.com', '2024-03-06 20:11:04', 'student', NULL, NULL, NULL),
(35, 'waigo', '$2y$12$EaadGM9v3wpqbQYpXc668ulhX7QBhfg2OYTHwNjQ4PlxR6pybZW3W', 'waigo@gmail.com', '2024-03-06 20:11:27', 'student', NULL, NULL, NULL),
(36, 'jeru', '$2y$12$lT7yAr0QMIEz55IRGW1nU.L139zN4WdlINCcswg4FRP1w2QDSi9mS', 'jeru@gmail.com', '2024-03-06 20:11:42', 'student', NULL, NULL, NULL),
(37, 'fuk', '$2y$12$hi40UrHMIr3W/TMSe3OyQOl8btMVzDm0CsGSmMg3M4TTyrD/y6sge', 'fuk@gmail.com', '2024-03-06 20:11:59', 'student', NULL, NULL, NULL),
(38, 'okay', '$2y$10$cWrvtIFuhLF7OslGnEUe8uEFCOSgka1uIPMPQ1q4qpp/Bf35zK.fu', 'okay@gmail.com', '2024-03-06 20:12:15', 'student', 22, 'female', '0756432546'),
(39, 'joke', '$2y$12$UjvIiHFsn.Rp320mLCjkjeJMjc/E3uFdpV1uJHOvtTrV.nA9wsLEm', 'joke@gmail.com', '2024-03-06 20:12:30', 'student', NULL, NULL, NULL),
(40, 'tasha', '$2y$12$ZfT6sLAwEABO4mYLCphl7OSRkIguJ0t3h50OzwYkBbcE7YbuiIQC2', 'tasha@gmail.com', '2024-03-06 20:12:48', 'student', NULL, NULL, NULL),
(41, 'dakas', '$2y$12$fu10KSREhTzwdoxwsYhUjuy.WAZwkq.ztxuvV9wir2gnG9tdwk.K6', 'dakas@gmail.com', '2024-03-06 20:13:34', 'student', NULL, NULL, NULL),
(42, 'waah', '$2y$12$0.k4hzF2vU3mSiydjzop5Oi7OXnDE6mGQ.xa0JB9Sv0B/n8koIxCy', 'waah@gmail.com', '2024-03-06 20:13:49', 'student', NULL, NULL, NULL),
(43, 'ruth', '$2y$12$YXqA0Sv1/n3b19loO275quMHkXFLLrpqMDA35V38u5r7tsc5egzR.', 'ruth@gmail.com', '2024-03-06 20:14:13', 'student', NULL, NULL, NULL),
(44, 'jane', '$2y$12$J7lj7RTsQ9JB8DypqmbqkeRDc834j4E7rKH0Pyc/SnzrKvXwGLGCS', 'jane@gmail.com', '2024-03-06 20:14:37', 'student', NULL, NULL, NULL),
(45, 'alvin', '$2y$12$CG7/RgfHcqv3WOVc24QXiOQIS8T4EBmCG/I/kaGpmezv0vxdDBiYG', 'alvin@gmail.com', '2024-03-06 20:15:10', 'student', NULL, NULL, NULL),
(46, 'david', '$2y$10$PWntW.PMR8kQ1XUcYd9S5Oh8fD8QkIfh0hA2lIYJ7ejobTJcq34F.', 'david@gmail.com', '2024-03-06 21:35:50', 'coach', 50, 'male', '0711567843'),
(47, 'ezekiel', '$2y$12$khIkedLRPcMM3NumRvAWA.Z5nM8dG5I/mjspp4QBYlqD.M1Q9F/Wu', 'ezekiel@gmail.com', '2024-03-07 08:39:10', 'student', NULL, NULL, NULL),
(48, 'haland', '$2y$10$XOloU0pqkh/O242BHUF8ROWisF9QLCSbeAsSqlEp26cewNyBXdSDO', 'haland@gmail.com', '2024-03-09 14:57:29', 'coach', 45, 'male', '0711876543'),
(49, 'arteta', '$2y$12$Gyncg5fs1J42ySfVEytOAOvI2gtU2bfWtsFO2nRAcUvqzwfZF02lO', 'arteta@gmail.com', '2024-04-28 16:38:24', 'student', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_facility_name` (`facility_name`);

--
-- Indexes for table `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `facility_sport`
--
ALTER TABLE `facility_sport`
  ADD PRIMARY KEY (`facility_id`,`sport_id`),
  ADD KEY `sport_id` (`sport_id`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_event` (`event_id`),
  ADD KEY `fk_sport` (`sport_id`),
  ADD KEY `fk_student` (`student_id`),
  ADD KEY `fk_draw_a` (`draw_a_id`),
  ADD KEY `fk_draw_b` (`draw_b_id`);

--
-- Indexes for table `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`school_id`);

--
-- Indexes for table `sports`
--
ALTER TABLE `sports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_sports`
--
ALTER TABLE `student_sports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `sport_id` (`sport_id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_mapping` (`coach_id`,`student_id`,`sport_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `sport_id` (`sport_id`);

--
-- Indexes for table `teams_roster`
--
ALTER TABLE `teams_roster`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teams_roster_ibfk_1` (`coach_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `schools`
--
ALTER TABLE `schools`
  MODIFY `school_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sports`
--
ALTER TABLE `sports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `student_sports`
--
ALTER TABLE `student_sports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `teams_roster`
--
ALTER TABLE `teams_roster`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `fk_facility_name` FOREIGN KEY (`facility_name`) REFERENCES `facilities` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `facility_sport`
--
ALTER TABLE `facility_sport`
  ADD CONSTRAINT `facility_sport_ibfk_1` FOREIGN KEY (`facility_id`) REFERENCES `facilities` (`id`),
  ADD CONSTRAINT `facility_sport_ibfk_2` FOREIGN KEY (`sport_id`) REFERENCES `sports` (`id`);

--
-- Constraints for table `results`
--
ALTER TABLE `results`
  ADD CONSTRAINT `fk_draw_a` FOREIGN KEY (`draw_a_id`) REFERENCES `schools` (`school_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_draw_b` FOREIGN KEY (`draw_b_id`) REFERENCES `schools` (`school_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_event` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sport` FOREIGN KEY (`sport_id`) REFERENCES `sports` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_student` FOREIGN KEY (`student_id`) REFERENCES `teams` (`student_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `student_sports`
--
ALTER TABLE `student_sports`
  ADD CONSTRAINT `student_sports_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `student_sports_ibfk_2` FOREIGN KEY (`sport_id`) REFERENCES `sports` (`id`);

--
-- Constraints for table `teams`
--
ALTER TABLE `teams`
  ADD CONSTRAINT `teams_ibfk_1` FOREIGN KEY (`coach_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `teams_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `teams_ibfk_3` FOREIGN KEY (`sport_id`) REFERENCES `sports` (`id`);

--
-- Constraints for table `teams_roster`
--
ALTER TABLE `teams_roster`
  ADD CONSTRAINT `teams_roster_ibfk_1` FOREIGN KEY (`coach_id`) REFERENCES `teams` (`coach_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
