/*
Sunder Krishna Upreti
This is the file for our database and it connects the website through phpMyAdmin 
*/
-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 29, 2020 at 04:38 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library_management_system`
--
CREATE DATABASE IF NOT EXISTS `library_management_system` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `library_management_system`;

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
CREATE TABLE IF NOT EXISTS `books` (
  `book_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `genre` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `edition` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `count` int(6) NOT NULL,
  PRIMARY KEY (`book_id`)
) ENGINE=InnoDB AUTO_INCREMENT=109 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `title`, `author`, `genre`, `edition`, `count`) VALUES
(4, 'The Hunger Games', 'Suzanne Collins', 'Science Fiction', '1', 6),
(8, 'The Giver', 'Lois Lowry', 'Science Fiction', '2', 5),
(10, 'Fahrenheit 451', 'Ray Bradbury', 'Science Fiction', '1', 2),
(20, 'Lord of the Flies', 'William Golding', 'Science Fiction', NULL, 3),
(99, 'The Origin of Species', 'Charles Darwin', 'History', NULL, 0),
(101, 'The Republic', 'Plato', 'History', NULL, 3),
(103, 'The Art of War', 'Sun Tzu', 'History', NULL, 4),
(105, 'The Diary of a Young Girl', 'Anne Frank', 'History', NULL, 2),
(106, 'Fifty Shades of Grey', 'E.L. James', 'Love', '1', 2),
(107, 'Reflected in You', 'Sylvia Day ', 'Love', NULL, 5),
(108, 'Dark Lover', 'J.R. Ward', 'Love', NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `borrow_return`
--

DROP TABLE IF EXISTS `borrow_return`;
CREATE TABLE IF NOT EXISTS `borrow_return` (
  `transaction_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(6) UNSIGNED NOT NULL,
  `book_id` int(6) UNSIGNED NOT NULL,
  `borrowed` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `borrowed_date` date NOT NULL,
  `returned` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `returned_date` date DEFAULT NULL,
  PRIMARY KEY (`transaction_id`),
  KEY `user_id` (`user_id`,`book_id`),
  KEY `const1` (`book_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `borrow_return`
--

INSERT INTO `borrow_return` (`transaction_id`, `user_id`, `book_id`, `borrowed`, `borrowed_date`, `returned`, `returned_date`) VALUES
(16, 74123, 4, 'Y', '0000-00-00', 'Y', '0000-00-00'),
(17, 74123, 8, 'Y', '0000-00-00', 'Y', '0000-00-00'),
(18, 74123, 4, 'Y', '2020-06-19', 'Y', '0000-00-00'),
(19, 74123, 4, 'Y', '2020-06-19', 'Y', '2020-06-19'),
(20, 74123, 8, 'Y', '2020-06-19', 'Y', '2020-06-19'),
(21, 74123, 4, 'Y', '2020-06-19', 'Y', '2020-06-20'),
(22, 74123, 8, 'Y', '2020-06-19', 'N', '0000-00-00'),
(23, 332211, 105, 'Y', '2020-06-20', 'N', NULL),
(24, 74123, 107, 'Y', '2020-06-20', 'Y', '2020-06-20'),
(25, 332211, 99, 'Y', '2020-06-20', 'N', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

DROP TABLE IF EXISTS `contact_us`;
CREATE TABLE IF NOT EXISTS `contact_us` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(6) UNSIGNED NOT NULL,
  `subject` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(460) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message_date` date NOT NULL,
  PRIMARY KEY (`message_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`message_id`, `user_id`, `subject`, `message`, `message_date`) VALUES
(6, 74123, 'website quality', 'Website is well designed. \r\nI hope you will go on with website updates!', '2020-06-29');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
CREATE TABLE IF NOT EXISTS `feedback` (
  `feedback_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(6) UNSIGNED NOT NULL,
  `emotion` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `suggestion` varchar(320) COLLATE utf8mb4_unicode_ci NOT NULL,
  `feedback_date` date NOT NULL,
  PRIMARY KEY (`feedback_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `user_id`, `emotion`, `suggestion`, `feedback_date`) VALUES
(4, 74123, 'ðŸ˜', 'Good website!', '2020-06-29'),
(5, 74123, 'ðŸ™', 'Not good! ', '2020-06-29'),
(6, 74123, 'ðŸ˜€', 'the best!!!', '2020-06-29'),
(7, 74123, 'ðŸ˜', 'hmmm', '2020-06-29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `phone_number` (`phone_number`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=332212 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `phone_number`, `email`, `password`, `role`) VALUES
(10, 'Judith', 'Fleming', '416-590-3065', 'admin@admin.com ', '123456', 'admin'),
(4546, 'Janet', 'Wetzel', '819-667-3382', 'JanetDWetzel@teleworm.us', '1234', 'student'),
(4547, 'Jean', 'Rathbone', '250-227-7073', 'JeanTRathbone@rhyta.com', '1234', 'student'),
(4550, 'Wendy', 'Bush', '905-641-8979', 'wendyjbush@teleworm.us ', '1234', 'student'),
(4551, 'David', 'Vannatta', '604-930-3384', 'dvann@yahoo.com', '1234', 'student'),
(4552, 'Freddie', 'Jeffries', '819-762-0295', 'fjeff@hotmail.com', '1234', 'student'),
(4553, 'Edward', 'Gibbs', '519-589-5505', 'gibbsed@yahoo.com', '1234', 'student'),
(4554, 'Blake', 'Schwartz', '514-269-1914', 'blakeschwartz@hotmail.com', '1234', 'student'),
(4555, 'Terry', 'Groover', '905-883-3554', 'groover123@yahoo.com', '1234', 'student'),
(74123, 'Rebecca', 'Baker', '416-532-3313', 'rbaker@d.com', '1234', 'student'),
(332211, 'Diane', 'Beasley', '972-723-1729', 'dbeasley@acc.com', '1234', 'student');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `borrow_return`
--
ALTER TABLE `borrow_return`
  ADD CONSTRAINT `const1` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `const2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD CONSTRAINT `contact_us_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
