-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2025 at 01:06 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `football_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `option_id` int(11) NOT NULL,
  `question_id` int(11) DEFAULT NULL,
  `option_text` varchar(255) DEFAULT NULL,
  `is_correct` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`option_id`, `question_id`, `option_text`, `is_correct`) VALUES
(9, 4, 'Liverpool  ', 0),
(10, 4, 'Manchester United', 1),
(11, 4, 'Arsenal', 0),
(12, 4, 'Leeds United ', 0);

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE `players` (
  `player_id` int(11) NOT NULL,
  `p_name` varchar(100) DEFAULT NULL,
  `p_age` int(11) DEFAULT NULL,
  `p_team` varchar(100) DEFAULT NULL,
  `p_position` varchar(50) DEFAULT NULL,
  `p_height` decimal(4,1) DEFAULT NULL,
  `p_weight` decimal(4,1) DEFAULT NULL,
  `p_country` varchar(50) DEFAULT NULL,
  `status` enum('Active','Retired') DEFAULT 'Active',
  `p_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `players`
--

INSERT INTO `players` (`player_id`, `p_name`, `p_age`, `p_team`, `p_position`, `p_height`, `p_weight`, `p_country`, `status`, `p_image`) VALUES
(9, 'Erling Haaland', 24, 'Manchester City', 'ST', NULL, NULL, 'Norway', 'Active', 'erling_haaland.jpg'),
(10, 'Kevin De Bruyne', 33, 'Manchester City', 'CM', 0.0, 0.0, 'Belgium', 'Active', 'kevin_de_bruyne.jpg'),
(11, 'Phil Foden', 25, 'Manchester City', 'LW', NULL, NULL, 'England', 'Active', 'phil_foden.jpg'),
(12, 'Bernardo Silva', 30, 'Manchester City', 'CAM', NULL, NULL, 'Portugal', 'Active', 'bernardo_silva.jpg'),
(13, 'Rodri', 28, 'Manchester City', 'CDM', NULL, NULL, 'Spain', 'Active', 'rodri.jpg'),
(14, 'Julián Álvarez', 25, 'Manchester City', 'ST', NULL, NULL, 'Argentina', 'Active', 'julian_alvarez.jpg'),
(15, 'Mohamed Salah', 33, 'Liverpool', 'RW', NULL, NULL, 'Egypt', 'Active', 'mohamed_salah.jpg'),
(16, 'Virgil van Dijk', 34, 'Liverpool', 'CB', NULL, NULL, 'Netherlands', 'Active', 'virgil_van_dijk.jpg'),
(17, 'Trent Alexander-Arnold', 27, 'Liverpool', 'RB', NULL, NULL, 'England', 'Active', 'trent_alexander_arnold.jpg'),
(18, 'Alisson Becker', 33, 'Liverpool', 'GK', NULL, NULL, 'Brazil', 'Active', 'alisson_becker.jpg'),
(19, 'Bukayo Saka', 24, 'Arsenal', 'RW', NULL, NULL, 'England', 'Active', 'bukayo_saka.jpg'),
(20, 'Martin Ødegaard', 26, 'Arsenal', 'CAM', NULL, NULL, 'Norway', 'Active', 'martin_odegaard.jpg'),
(21, 'Declan Rice', 26, 'Arsenal', 'CDM', NULL, NULL, 'England', 'Active', 'declan_rice.jpg'),
(22, 'Gabriel Jesus', 28, 'Arsenal', 'ST', NULL, NULL, 'Brazil', 'Active', 'gabriel_jesus.jpg'),
(23, 'William Saliba', 24, 'Arsenal', 'CB', NULL, NULL, 'France', 'Active', 'william_saliba.jpg'),
(24, 'Son Heung-min', 33, 'Tottenham Hotspur', 'LW', NULL, NULL, 'South Korea', 'Active', 'son_heung_min.jpg'),
(25, 'James Maddison', 29, 'Tottenham Hotspur', 'CAM', NULL, NULL, 'England', 'Active', 'james_maddison.jpg'),
(26, 'Cristian Romero', 27, 'Tottenham Hotspur', 'CB', NULL, NULL, 'Argentina', 'Active', 'cristian_romero.jpg'),
(27, 'Ollie Watkins', 29, 'Aston Villa', 'ST', NULL, NULL, 'England', 'Active', 'ollie_watkins.jpg'),
(28, 'Emiliano Martínez', 33, 'Aston Villa', 'GK', NULL, NULL, 'Argentina', 'Active', 'emiliano_martinez.jpg'),
(29, 'Youri Tielemans', 28, 'Aston Villa', 'CM', NULL, NULL, 'Belgium', 'Active', 'youri_tielemans.jpg'),
(30, 'Cole Palmer', 23, 'Chelsea', 'RW', NULL, NULL, 'England', 'Active', 'cole_palmer.jpg'),
(31, 'Enzo Fernández', 24, 'Chelsea', 'CM', NULL, NULL, 'Argentina', 'Active', 'enzo_fernandez.jpg'),
(32, 'Raheem Sterling', 31, 'Chelsea', 'LW', NULL, NULL, 'England', 'Active', 'raheem_sterling.jpg'),
(33, 'Reece James', 25, 'Chelsea', 'RB', NULL, NULL, 'England', 'Active', 'reece_james.jpg'),
(34, 'Nick Pope', 33, 'Newcastle United', 'GK', NULL, NULL, 'England', 'Active', 'nick_pope.jpg'),
(35, 'Bruno Guimarães', 28, 'Newcastle United', 'CM', NULL, NULL, 'Brazil', 'Active', 'bruno_guimaraes.jpg'),
(36, 'Alexander Isak', 26, 'Newcastle United', 'ST', NULL, NULL, 'Sweden', 'Active', 'alexander_isak.jpg'),
(37, 'Anthony Gordon', 24, 'Newcastle United', 'LW', NULL, NULL, 'England', 'Active', 'anthony_gordon.jpg'),
(38, 'Jarrod Bowen', 28, 'West Ham United', 'RW', NULL, NULL, 'England', 'Active', 'jarrod_bowen.jpg'),
(39, 'James Ward-Prowse', 30, 'West Ham United', 'CM', NULL, NULL, 'England', 'Active', 'james_ward_prowse.jpg'),
(40, 'Lucas Paquetá', 28, 'West Ham United', 'CAM', NULL, NULL, 'Brazil', 'Active', 'lucas_paqueta.jpg'),
(41, 'Darwin Núñez', 26, 'Liverpool', 'ST', NULL, NULL, 'Uruguay', 'Active', 'darwin_nunez.jpg'),
(42, 'Marcus Rashford', 28, 'Manchester United', 'LW', NULL, NULL, 'England', 'Active', 'marcus_rashford.jpg'),
(43, 'Bruno Fernandes', 31, 'Manchester United', 'CAM', NULL, NULL, 'Portugal', 'Active', 'bruno_fernandes.jpg'),
(44, 'Casemiro', 33, 'Manchester United', 'CDM', NULL, NULL, 'Brazil', 'Active', 'casemiro.jpg'),
(45, 'Rasmus Højlund', 22, 'Manchester United', 'ST', NULL, NULL, 'Denmark', 'Active', 'rasmus_hojlund.jpg'),
(46, 'Alejandro Garnacho', 21, 'Manchester United', 'LW', NULL, NULL, 'Argentina', 'Active', 'alejandro_garnacho.jpg'),
(47, 'Kai Havertz', 26, 'Arsenal', 'CAM', NULL, NULL, 'Germany', 'Active', 'kai_havertz.jpg'),
(48, 'Pedro Neto', 25, 'Wolverhampton Wanderers', 'RW', NULL, NULL, 'Portugal', 'Active', 'pedro_neto.jpg'),
(49, 'Dominic Solanke', 28, 'Bournemouth', 'ST', NULL, NULL, 'England', 'Active', 'dominic_solanke.jpg'),
(50, 'Evan Ferguson', 21, 'Brighton & Hove Albion', 'ST', NULL, NULL, 'Ireland', 'Active', 'evan_ferguson.jpg'),
(51, 'James Tavernier', 33, 'Rangers', 'RB', NULL, NULL, 'England', 'Active', 'james_tavernier.jpg'),
(52, 'João Palhinha', 29, 'Fulham', 'CDM', NULL, NULL, 'Portugal', 'Active', 'joao_palhinha.jpg'),
(53, 'Kaoru Mitoma', 27, 'Brighton & Hove Albion', 'LW', NULL, NULL, 'Japan', 'Active', 'kaoru_mitoma.jpg'),
(54, 'David Raya', 30, 'Arsenal', 'GK', NULL, NULL, 'Spain', 'Active', 'david_raya.jpg'),
(55, 'Sandro Tonali', 25, 'Newcastle United', 'CM', NULL, NULL, 'Italy', 'Active', 'sandro_tonali.jpg'),
(56, 'Cristiano Ronaldo', 40, 'Al Nassr', 'ST', NULL, NULL, 'Portugal', 'Active', 'cristiano_ronaldo.jpg'),
(57, 'Lionel Messi', 38, 'Inter Miami', 'RW', NULL, NULL, 'Argentina', 'Active', 'lionel_messi.jpg'),
(58, 'Wayne Rooney', 39, 'Derby County', 'ST', NULL, NULL, 'England', 'Retired', 'wayne_rooney.jpg'),
(59, 'Thierry Henry', 47, 'New York Red Bulls', 'ST', NULL, NULL, 'France', 'Retired', 'thierry_henry.jpg'),
(60, 'Steven Gerrard', 45, 'LA Galaxy', 'CM', NULL, NULL, 'England', 'Retired', 'steven_gerrard.jpg'),
(61, 'Frank Lampard', 47, 'New York City FC', 'CM', NULL, NULL, 'England', 'Retired', 'frank_lampard.jpg'),
(62, 'Didier Drogba', 46, 'Montreal Impact', 'ST', NULL, NULL, 'Ivory Coast', 'Retired', 'didier_drogba.jpg'),
(63, 'John Terry', 44, 'Aston Villa', 'CB', NULL, NULL, 'England', 'Retired', 'john_terry.jpg'),
(64, 'David Beckham', 50, 'Paris Saint-Germain', 'RM', NULL, NULL, 'England', 'Retired', 'david_beckham.jpg'),
(65, 'Rio Ferdinand', 46, 'Queens Park Rangers', 'CB', NULL, NULL, 'England', 'Retired', 'rio_ferdinand.jpg'),
(66, 'Paul Scholes', 50, 'Manchester United', 'CM', NULL, NULL, 'England', 'Retired', 'paul_scholes.jpg'),
(67, 'Xabi Alonso', 43, 'Bayern Munich', 'CDM', NULL, NULL, 'Spain', 'Retired', 'xabi_alonso.jpg'),
(68, 'Petr Čech', 43, 'Arsenal', 'GK', NULL, NULL, 'Czech Republic', 'Retired', 'petr_cech.jpg'),
(69, 'Robin van Persie', 42, 'Feyenoord', 'ST', NULL, NULL, 'Netherlands', 'Retired', 'robin_van_persie.jpg'),
(70, 'Sergio Agüero', 37, 'Barcelona', 'ST', NULL, NULL, 'Argentina', 'Retired', 'sergio_aguero.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `player_statistics`
--

CREATE TABLE `player_statistics` (
  `stat_id` int(11) NOT NULL,
  `player_id` int(11) DEFAULT NULL,
  `season` varchar(20) DEFAULT NULL,
  `matches_played` int(11) DEFAULT NULL,
  `goals` int(11) DEFAULT NULL,
  `assists` int(11) DEFAULT NULL,
  `saves` int(11) DEFAULT NULL,
  `rating` decimal(3,1) DEFAULT NULL,
  `preferred_foot` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `player_statistics`
--

INSERT INTO `player_statistics` (`stat_id`, `player_id`, `season`, `matches_played`, `goals`, `assists`, `saves`, `rating`, `preferred_foot`) VALUES
(53, 9, '2024/25', 28, 27, 6, 0, 9.5, 'Left'),
(54, 10, '2024/25', 26, 8, 15, 0, 9.2, 'Right'),
(55, 11, '2024/25', 25, 12, 7, 0, 8.8, 'Left'),
(56, 12, '2024/25', 25, 6, 11, 0, 8.6, 'Left'),
(57, 13, '2024/25', 27, 4, 6, 0, 8.9, 'Right'),
(58, 14, '2024/25', 27, 10, 4, 0, 8.4, 'Right'),
(59, 15, '2024/25', 27, 22, 9, 0, 9.4, 'Left'),
(60, 16, '2024/25', 27, 4, 3, 0, 8.8, 'Right'),
(61, 17, '2024/25', 26, 3, 10, 0, 8.5, 'Right'),
(62, 18, '2024/25', 28, 0, 0, 92, 9.0, 'Right'),
(63, 19, '2024/25', 27, 15, 9, 0, 8.8, 'Left'),
(64, 20, '2024/25', 26, 8, 10, 0, 8.6, 'Left'),
(65, 21, '2024/25', 28, 4, 5, 0, 8.4, 'Right'),
(66, 22, '2024/25', 22, 9, 6, 0, 8.3, 'Right'),
(67, 23, '2024/25', 27, 2, 2, 0, 8.5, 'Right'),
(68, 24, '2024/25', 27, 16, 7, 0, 8.9, 'Right'),
(69, 25, '2024/25', 25, 7, 8, 0, 8.4, 'Right'),
(70, 26, '2024/25', 26, 3, 1, 0, 8.3, 'Right'),
(71, 27, '2024/25', 26, 18, 6, 0, 8.8, 'Right'),
(72, 28, '2024/25', 27, 0, 0, 96, 9.1, 'Right'),
(73, 29, '2024/25', 24, 2, 3, 0, 7.9, 'Right'),
(74, 30, '2024/25', 23, 9, 5, 0, 8.3, 'Left'),
(75, 31, '2024/25', 26, 3, 6, 0, 8.0, 'Right'),
(76, 32, '2024/25', 25, 6, 4, 0, 8.1, 'Right'),
(77, 33, '2024/25', 22, 1, 2, 0, 7.8, 'Right'),
(78, 34, '2024/25', 27, 0, 0, 90, 8.9, 'Right'),
(79, 35, '2024/25', 28, 5, 9, 0, 8.8, 'Right'),
(80, 36, '2024/25', 26, 18, 3, 0, 8.7, 'Right'),
(81, 37, '2024/25', 26, 10, 5, 0, 8.4, 'Right'),
(82, 38, '2024/25', 25, 13, 6, 0, 8.6, 'Left'),
(83, 39, '2024/25', 27, 5, 12, 0, 8.5, 'Right'),
(84, 40, '2024/25', 25, 7, 7, 0, 8.4, 'Left'),
(85, 41, '2024/25', 26, 15, 5, 0, 8.6, 'Right'),
(86, 42, '2024/25', 26, 12, 8, 0, 8.5, 'Right'),
(87, 43, '2024/25', 26, 9, 11, 0, 8.7, 'Right'),
(88, 44, '2024/25', 25, 4, 5, 0, 8.3, 'Right'),
(89, 45, '2024/25', 24, 10, 4, 0, 8.4, 'Left'),
(90, 46, '2024/25', 24, 7, 6, 0, 8.3, 'Right'),
(91, 47, '2024/25', 26, 8, 9, 0, 8.6, 'Left'),
(92, 48, '2024/25', 23, 6, 4, 0, 8.2, 'Left'),
(93, 49, '2024/25', 27, 14, 4, 0, 8.5, 'Right'),
(94, 50, '2024/25', 21, 8, 2, 0, 8.1, 'Right'),
(95, 51, '2024/25', 27, 5, 7, 0, 8.3, 'Right'),
(96, 52, '2024/25', 26, 2, 3, 0, 8.0, 'Right'),
(97, 53, '2024/25', 25, 9, 5, 0, 8.4, 'Right'),
(98, 54, '2024/25', 28, 0, 0, 94, 9.0, 'Right'),
(99, 55, '2024/25', 25, 2, 3, 0, 8.2, 'Right'),
(100, 56, '2017/18', 35, 26, 5, 0, 9.4, 'Right'),
(101, 57, '2023/24', 28, 24, 11, 0, 9.6, 'Left'),
(102, 58, '2010/11', 36, 27, 8, 0, 9.0, 'Right'),
(103, 59, '2004/05', 37, 30, 14, 0, 9.5, 'Right'),
(104, 60, '2012/13', 35, 13, 9, 0, 8.8, 'Right'),
(105, 61, '2011/12', 36, 12, 11, 0, 8.9, 'Right'),
(106, 62, '2011/12', 35, 12, 6, 0, 8.7, 'Right'),
(107, 63, '2011/12', 33, 4, 1, 0, 8.2, 'Right'),
(108, 64, '2012/13', 25, 6, 7, 0, 8.5, 'Right'),
(109, 65, '2012/13', 30, 2, 0, 0, 8.3, 'Right'),
(110, 66, '2011/12', 29, 8, 6, 0, 8.4, 'Right'),
(111, 67, '2012/13', 28, 5, 7, 0, 8.5, 'Right'),
(112, 68, '2018/19', 34, 0, 0, 105, 8.9, 'Left'),
(113, 69, '2018/19', 25, 16, 6, 0, 8.7, 'Left'),
(114, 70, '2021/22', 20, 12, 4, 0, 8.8, 'Right');

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `question_id` int(11) NOT NULL,
  `quiz_id` int(11) DEFAULT NULL,
  `question_text` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`question_id`, `quiz_id`, `question_text`) VALUES
(4, 2, 'Which club won the first-ever Premier League title in 1992–93?');

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` (
  `quiz_id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`quiz_id`, `title`) VALUES
(2, 'Premier League');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_results`
--

CREATE TABLE `quiz_results` (
  `result_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `quiz_id` int(11) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `total_questions` int(11) DEFAULT NULL,
  `correct_answers` int(11) DEFAULT NULL,
  `wrong_answers` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_results`
--

INSERT INTO `quiz_results` (`result_id`, `user_id`, `quiz_id`, `score`, `total_questions`, `correct_answers`, `wrong_answers`) VALUES
(13, 1, 2, 1, 1, 1, 0),
(14, 1, 2, 1, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `role` varchar(20) DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `role`) VALUES
(1, 'Koushik', '1974kamalsharma@gmail.com', '$2y$10$Di2c/MBLFI5fc3EAAhI/qujTvuNhzNrRv0mAPZpehLdhlvI3u9Xca', 'admin'),
(7, 'system', 'admin@gmail', '$2y$10$0SiREfWa/vGOGWK80jjcNOkJjjYRcLF1JvcBDf4QLvAN2t8DaiHXy', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `user_answers`
--

CREATE TABLE `user_answers` (
  `answer_id` int(11) NOT NULL,
  `result_id` int(11) DEFAULT NULL,
  `question_id` int(11) DEFAULT NULL,
  `selected_answer` varchar(255) DEFAULT NULL,
  `is_correct` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_answers`
--

INSERT INTO `user_answers` (`answer_id`, `result_id`, `question_id`, `selected_answer`, `is_correct`) VALUES
(13, 13, 4, '10', 1),
(14, 14, 4, '10', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`option_id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`player_id`);

--
-- Indexes for table `player_statistics`
--
ALTER TABLE `player_statistics`
  ADD PRIMARY KEY (`stat_id`),
  ADD UNIQUE KEY `unique_player_stats` (`player_id`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`question_id`),
  ADD KEY `quiz_id` (`quiz_id`);

--
-- Indexes for table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`quiz_id`);

--
-- Indexes for table `quiz_results`
--
ALTER TABLE `quiz_results`
  ADD PRIMARY KEY (`result_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `quiz_id` (`quiz_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_answers`
--
ALTER TABLE `user_answers`
  ADD PRIMARY KEY (`answer_id`),
  ADD KEY `result_id` (`result_id`),
  ADD KEY `question_id` (`question_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `option_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `players`
--
ALTER TABLE `players`
  MODIFY `player_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `player_statistics`
--
ALTER TABLE `player_statistics`
  MODIFY `stat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `quiz`
--
ALTER TABLE `quiz`
  MODIFY `quiz_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `quiz_results`
--
ALTER TABLE `quiz_results`
  MODIFY `result_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_answers`
--
ALTER TABLE `user_answers`
  MODIFY `answer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `options`
--
ALTER TABLE `options`
  ADD CONSTRAINT `options_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `question` (`question_id`);

--
-- Constraints for table `player_statistics`
--
ALTER TABLE `player_statistics`
  ADD CONSTRAINT `fk_player_stats` FOREIGN KEY (`player_id`) REFERENCES `players` (`player_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `player_statistics_ibfk_1` FOREIGN KEY (`player_id`) REFERENCES `players` (`player_id`);

--
-- Constraints for table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_ibfk_1` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`quiz_id`);

--
-- Constraints for table `quiz_results`
--
ALTER TABLE `quiz_results`
  ADD CONSTRAINT `quiz_results_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `quiz_results_ibfk_2` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`quiz_id`);

--
-- Constraints for table `user_answers`
--
ALTER TABLE `user_answers`
  ADD CONSTRAINT `user_answers_ibfk_1` FOREIGN KEY (`result_id`) REFERENCES `quiz_results` (`result_id`),
  ADD CONSTRAINT `user_answers_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `question` (`question_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
