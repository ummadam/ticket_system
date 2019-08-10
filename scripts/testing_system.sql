-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 10, 2019 at 04:42 AM
-- Server version: 10.1.40-MariaDB-0ubuntu0.18.04.1
-- PHP Version: 7.2.19-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `testing_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `id` int(11) NOT NULL,
  `ticketId` int(11) DEFAULT NULL,
  `sender` varchar(250) DEFAULT NULL,
  `rcpt` varchar(250) DEFAULT NULL,
  `body` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`id`, `ticketId`, `sender`, `rcpt`, `body`) VALUES
(1, 11, 'User2', 'admin', 'Hello'),
(2, 11, 'User2', 'admin', 'Hi'),
(3, 6, 'User1', 'admin', 'Hi'),
(4, 0, 'Admin', 'admin', 'Hi'),
(5, 0, 'User1', 'admin', 'salem'),
(6, 0, 'User1', 'admin', 'kak ty'),
(7, 5, 'User2', 'admin', 'Dddd'),
(8, 7, 'User2', 'admin', 'SSSS');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `problem` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `username`, `problem`) VALUES
(1, 'Admin', 'Класса user нет'),
(2, 'Admin', 'Нет подключения к БД'),
(3, 'Admin', 'asdlkjskdjskjf'),
(4, 'User1', 'hjghjfghfgh'),
(5, 'User2', 'sdkjsklfs'),
(6, 'User1', 'sdkjsklfs'),
(7, 'User2', 'sdkjsklfs'),
(8, 'User1', 'asd,m,s.ad'),
(9, 'aslkdsd', 'sdakndmas'),
(10, 'User1', 'sdkljs'),
(11, 'User2', ',sdnms'),
(12, 'User2', 'jkhdsjkf'),
(13, 'User2', 'sdsfd');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
