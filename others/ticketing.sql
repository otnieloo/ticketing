-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2021 at 04:38 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ticketing`
--

-- --------------------------------------------------------

--
-- Table structure for table `list_ticket`
--

CREATE TABLE `list_ticket` (
  `ticket_id` varchar(20) NOT NULL,
  `ticket_number` varchar(10) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `priority` tinyint(1) NOT NULL,
  `date_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `list_ticket`
--

INSERT INTO `list_ticket` (`ticket_id`, `ticket_number`, `subject`, `status`, `priority`, `date_modified`, `date_created`) VALUES
('310ad43e-4d9f-11ec-8', '2', 'Test subject final', 1, 3, '2021-11-25 10:24:22', '2021-11-25 10:24:22'),
('a52008e0-4d9f-11ec-8', '4', 'Test subject final 3', 0, 3, '2021-11-25 10:27:37', '2021-11-25 10:27:37');

-- --------------------------------------------------------

--
-- Table structure for table `list_ticket_message`
--

CREATE TABLE `list_ticket_message` (
  `ticket_message_id` int(11) NOT NULL,
  `ticket_number` varchar(20) NOT NULL,
  `message` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `list_ticket_message`
--

INSERT INTO `list_ticket_message` (`ticket_message_id`, `ticket_number`, `message`, `date_created`) VALUES
(1, '2', 'Test message final', '2021-11-25 10:24:22'),
(3, '2', 'Test reply final 2', '2021-11-25 10:25:19'),
(4, '2', 'Test reply final 2 2', '2021-11-25 10:25:37'),
(6, '4', 'Test message final 3', '2021-11-25 10:27:37'),
(7, '2', 'Test reply final 2 3', '2021-11-25 10:30:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `list_ticket`
--
ALTER TABLE `list_ticket`
  ADD PRIMARY KEY (`ticket_id`),
  ADD UNIQUE KEY `ticket_number` (`ticket_number`);

--
-- Indexes for table `list_ticket_message`
--
ALTER TABLE `list_ticket_message`
  ADD PRIMARY KEY (`ticket_message_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `list_ticket_message`
--
ALTER TABLE `list_ticket_message`
  MODIFY `ticket_message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
