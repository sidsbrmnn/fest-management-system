-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 05, 2019 at 10:28 AM
-- Server version: 8.0.18
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `festmanagement`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(98707, 'Technical'),
(98708, 'Brainstorming'),
(98709, 'Cultural'),
(98710, 'Sports'),
(98711, 'Gaming'),
(98712, 'Fun');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `event_type` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `event_date` date NOT NULL,
  `event_fee` int(11) NOT NULL,
  `event_desc` text NOT NULL,
  `organiser_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `event_name`, `event_type`, `category_id`, `event_date`, `event_fee`, `event_desc`, `organiser_id`) VALUES
(313813, 'Coding & Debugging', 'Individual', 98707, '2019-12-18', 100, 'Can you beat the time? Most importantly, the errors?', 67547);

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `log_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `log_user` varchar(255) NOT NULL,
  `log_message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`log_time`, `log_user`, `log_message`) VALUES
('2019-12-03 10:47:53', 'sidsbrmnn@gmail.com', 'Signed up as a user'),
('2019-12-03 16:40:39', 'sidsbrmnn@gmail.com', 'Registered a participant');

-- --------------------------------------------------------

--
-- Table structure for table `organisers`
--

CREATE TABLE `organisers` (
  `organiser_id` int(11) NOT NULL,
  `organiser_name` varchar(255) NOT NULL,
  `organiser_phone` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `organisers`
--

INSERT INTO `organisers` (`organiser_id`, `organiser_name`, `organiser_phone`) VALUES
(67547, 'Revanth', '7895374954');

-- --------------------------------------------------------

--
-- Table structure for table `participants`
--

CREATE TABLE `participants` (
  `participant_id` int(11) NOT NULL,
  `participant_name` varchar(255) NOT NULL,
  `participant_email` varchar(255) NOT NULL,
  `participant_phone` varchar(10) NOT NULL,
  `registered_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `participants`
--

INSERT INTO `participants` (`participant_id`, `participant_name`, `participant_email`, `participant_phone`, `registered_by`) VALUES
(213648, 'Shyam A', 'shyamasv.a@gmail.com', '8874298334', 'sidsbrmnn@gmail.com');

--
-- Triggers `participants`
--
DELIMITER $$
CREATE TRIGGER `log_participant` AFTER INSERT ON `participants` FOR EACH ROW INSERT INTO logs (log_user, log_message)
VALUES (NEW.registered_by, 'Registered a participant')
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `registrations`
--

CREATE TABLE `registrations` (
  `participant_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `registrations`
--

INSERT INTO `registrations` (`participant_id`, `event_id`) VALUES
(213648, 313813);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `contribution` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`full_name`, `email`, `pass`, `phone`, `contribution`) VALUES
('Siddharth Subramanian', 'sidsbrmnn@gmail.com', '332b3091416bc4687821c4653f1c6eb1', '9535572838', 0);

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `log_user` AFTER INSERT ON `users` FOR EACH ROW INSERT INTO logs (log_user, log_message)
VALUES (NEW.email, 'Signed up as a user')
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `organiser_id` (`organiser_id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD KEY `log_user` (`log_user`);

--
-- Indexes for table `organisers`
--
ALTER TABLE `organisers`
  ADD PRIMARY KEY (`organiser_id`);

--
-- Indexes for table `participants`
--
ALTER TABLE `participants`
  ADD PRIMARY KEY (`participant_id`),
  ADD KEY `registered_by` (`registered_by`);

--
-- Indexes for table `registrations`
--
ALTER TABLE `registrations`
  ADD KEY `participant_id` (`participant_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98713;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=313814;

--
-- AUTO_INCREMENT for table `organisers`
--
ALTER TABLE `organisers`
  MODIFY `organiser_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67548;

--
-- AUTO_INCREMENT for table `participants`
--
ALTER TABLE `participants`
  MODIFY `participant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=213649;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE RESTRICT,
  ADD CONSTRAINT `events_ibfk_2` FOREIGN KEY (`organiser_id`) REFERENCES `organisers` (`organiser_id`) ON DELETE RESTRICT;

--
-- Constraints for table `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `logs_ibfk_1` FOREIGN KEY (`log_user`) REFERENCES `users` (`email`) ON DELETE RESTRICT;

--
-- Constraints for table `participants`
--
ALTER TABLE `participants`
  ADD CONSTRAINT `participants_ibfk_1` FOREIGN KEY (`registered_by`) REFERENCES `users` (`email`) ON DELETE RESTRICT;

--
-- Constraints for table `registrations`
--
ALTER TABLE `registrations`
  ADD CONSTRAINT `registrations_ibfk_1` FOREIGN KEY (`participant_id`) REFERENCES `participants` (`participant_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `registrations_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`) ON DELETE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
