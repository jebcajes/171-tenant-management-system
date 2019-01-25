-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2019 at 01:32 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `171_tenant`
--

-- --------------------------------------------------------

--
-- Table structure for table `applied_stall`
--

CREATE TABLE `applied_stall` (
  `app_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `business_name` varchar(128) DEFAULT NULL,
  `date_applied` datetime DEFAULT CURRENT_TIMESTAMP,
  `date_approved` datetime DEFAULT NULL,
  `application_status` varchar(32) DEFAULT 'Unapproved',
  `applied_term` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `applied_stall`
--

INSERT INTO `applied_stall` (`app_id`, `client_id`, `category_id`, `business_name`, `date_applied`, `date_approved`, `application_status`, `applied_term`) VALUES
(1, 1, 1, 'Chowking', '2019-01-18 21:44:53', NULL, 'Disapproved', '1 year'),
(2, 2, 2, 'Dyckies', '2019-01-18 21:44:53', NULL, 'Approved', '2 year'),
(3, 3, 5, 'Pornhub', '2019-01-18 23:43:29', NULL, 'Approved', '1 year'),
(4, 5, 1, 'Lubot', '2019-01-18 23:45:26', NULL, 'Approved', '1 year'),
(5, 7, 1, 'Balay', '2019-01-18 23:48:39', NULL, 'Approved', '1 year'),
(6, 9, 4, 'Cabido Busters', '2019-01-18 23:49:54', NULL, 'Approved', '1 year'),
(7, 1, 4, 'Pussy Factory', '2019-01-19 00:48:42', NULL, 'Unapproved', '1 year'),
(8, 11, 1, 'dsddsds', '2019-01-19 01:54:48', NULL, 'Unapproved', '1 year'),
(9, 12, 2, 'Software Engineering', '2019-01-19 03:41:29', NULL, 'Disapproved', '1 year'),
(10, 16, 2, 'Pussy', '2019-01-19 03:43:13', NULL, 'Approved', '1 year'),
(11, 22, 1, 'Uranus', '2019-01-19 03:46:10', NULL, 'Disapproved', '1 year'),
(12, 24, 1, 'Uranus', '2019-01-19 03:47:03', NULL, 'Approved', '1 year'),
(13, 26, 1, 'Uranus', '2019-01-19 03:47:23', NULL, 'Approved', '1 year'),
(14, 2, 1, 'Hehe', '2019-01-20 19:44:11', NULL, 'Unapproved', ''),
(15, 2, 1, 'heheh', '2019-01-20 19:44:44', NULL, 'Unapproved', ''),
(16, 2, 1, 'Hehe', '2019-01-20 19:44:59', NULL, 'Unapproved', ''),
(17, 2, 2, 'Hehe Dy', '2019-01-20 19:46:46', NULL, 'Unapproved', '3 years');

--
-- Triggers `applied_stall`
--
DELIMITER $$
CREATE TRIGGER `application_automation` AFTER UPDATE ON `applied_stall` FOR EACH ROW BEGIN
 IF (new.application_status = 'Approved') THEN
	INSERT INTO contract (client_id, app_id, category_id, business_name) VALUES (new.client_id, new.app_id, new.category_id, new.business_name);
 END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `applied_stall_details`
--

CREATE TABLE `applied_stall_details` (
  `id` int(11) NOT NULL,
  `app_id` int(11) NOT NULL,
  `stall_id` int(11) NOT NULL,
  `stall_application_status` varchar(32) DEFAULT 'Unapproved'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `applied_stall_details`
--

INSERT INTO `applied_stall_details` (`id`, `app_id`, `stall_id`, `stall_application_status`) VALUES
(1, 1, 4, 'Approved'),
(2, 1, 5, 'Approved'),
(3, 2, 6, 'Approved'),
(4, 6, 10, 'Approved'),
(5, 6, 11, 'Approved'),
(6, 6, 12, 'Disapproved'),
(7, 7, 8, 'Approved'),
(8, 8, 8, 'Unapproved'),
(9, 9, 8, 'Unapproved'),
(10, 9, 9, 'Unapproved'),
(11, 10, 7, 'Unapproved'),
(12, 11, 8, 'Unapproved'),
(13, 12, 8, 'Unapproved'),
(14, 13, 8, 'Unapproved'),
(15, 14, 12, 'Unapproved'),
(16, 15, 12, 'Unapproved'),
(17, 16, 12, 'Unapproved'),
(18, 17, 12, 'Unapproved'),
(19, 2, 12, 'Approved'),
(20, 2, 11, 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `business_classification`
--

CREATE TABLE `business_classification` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `business_classification`
--

INSERT INTO `business_classification` (`category_id`, `category_name`) VALUES
(1, 'Restaurant'),
(2, 'Clothing Shop'),
(3, 'Barber Shop'),
(4, 'Arcade'),
(5, 'Adult');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `client_id` int(11) NOT NULL,
  `fname` varchar(32) NOT NULL,
  `lname` varchar(32) NOT NULL,
  `email` varchar(64) NOT NULL,
  `address` varchar(128) NOT NULL,
  `contact` varchar(24) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`client_id`, `fname`, `lname`, `email`, `address`, `contact`) VALUES
(1, 'Jeb ', 'Cajes', 'jeb.cajes@gmail.com', 'Luinab', '09352296969'),
(2, 'Carlo Miguel', 'Dy', 'carlomigueldy@gmail.com', 'Maigo', '09146696969'),
(3, 'Carlo', 'Dy', 'carlody@gmail.com', 'Maigo', '09359213126'),
(5, 'Tae', 'Ho', 'tae.ho@gmail.com', 'Igit ni Cabido', '09172254487'),
(7, 'Jeb', 'XD', 'jeb.xd@gmail.com', 'Luinabskie', '0492394832'),
(9, 'Galpin', 'Dotados', 'galpin.dotados@gmail.com', 'Black Market', '0987443132'),
(11, 'dasdasd', 'sdsdasd', 'asdasdasd', 'dsdsds', 'sdsdsd'),
(12, 'Manny', 'Cabido', 'manny.cabido@yahoo.com', 'Iligan', '09258879784'),
(16, 'Mother', 'Fucker', 'mother.fucker@pornhub.com', 'Vagina', '09846996969'),
(22, 'Butt', 'Hole', 'butt.hole@gmail.com', 'Anus', '09884758777'),
(24, 'Butt', 'Hole', 'butt.hole@gmail.comm', 'Anus', '09884758777'),
(26, 'Butt', 'Hole', 'butt.hole@gmail.commd', 'Anus', '098847587772');

-- --------------------------------------------------------

--
-- Table structure for table `contract`
--

CREATE TABLE `contract` (
  `contract_id` int(11) NOT NULL,
  `app_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `business_name` varchar(128) DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `date_approved` datetime DEFAULT CURRENT_TIMESTAMP,
  `remark` varchar(32) DEFAULT 'Pending',
  `contract_term` varchar(32) NOT NULL DEFAULT 'Pending',
  `renewal_status` varchar(32) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contract`
--

INSERT INTO `contract` (`contract_id`, `app_id`, `client_id`, `category_id`, `business_name`, `start_date`, `end_date`, `date_approved`, `remark`, `contract_term`, `renewal_status`) VALUES
(1, 1, 1, 1, 'Chowking', '2019-01-20 00:00:00', '2019-01-21 00:00:00', '2019-01-18 21:47:03', 'Confirmed', '3 years', 'Pending'),
(2, 2, 2, 2, 'Dyckies', '2019-01-27 00:00:00', '2019-01-28 00:00:00', NULL, 'Confirmed', '1 year', 'Sent'),
(3, 1, 1, 1, 'Chowking', '2019-01-20 00:00:00', '2019-01-21 00:00:00', '2019-01-19 01:36:38', 'Confirmed', '1 year', 'Pending'),
(4, 2, 2, 2, 'Dyckies', NULL, NULL, '2019-01-19 01:39:07', 'Cancelled', '1 year', 'Sent'),
(5, 3, 3, 5, 'Pornhub', NULL, NULL, '2019-01-20 10:15:26', 'Cancelled', '3 years', 'Pending'),
(6, 4, 5, 1, 'Lubot', '2019-01-20 00:00:00', '2019-02-20 00:00:00', '2019-01-20 10:16:30', 'Confirmed', '2 years', 'Pending'),
(7, 5, 7, 1, 'Balay', '2019-01-20 00:00:00', '2019-02-24 00:00:00', '2019-01-20 10:18:35', 'Confirmed', '2 years', 'Pending'),
(8, 1, 1, 1, 'Chowking', '2019-01-27 00:00:00', '2019-03-28 00:00:00', '2019-01-20 10:57:01', 'Confirmed', 'Pending', 'Sent'),
(9, 13, 26, 1, 'Uranus', NULL, NULL, '2019-01-20 10:58:23', 'Confirmed', '1 year', 'Pending'),
(10, 1, 1, 1, 'Chowking', NULL, NULL, '2019-01-20 11:52:25', 'Pending', 'Pending', 'Sent'),
(11, 2, 2, 2, 'Dyckies', '2019-01-21 00:00:00', '2019-01-28 00:00:00', '2019-01-20 11:52:27', 'Confirmed', '1 year', 'Sent'),
(12, 2, 2, 2, 'Dyckies', NULL, NULL, '2019-01-20 11:56:57', 'Confirmed', '4 years', 'Pending'),
(13, 12, 24, 1, 'Uranus', NULL, NULL, '2019-01-20 11:58:26', 'Confirmed', '2 years', 'Pending'),
(14, 10, 16, 2, 'Pussy', NULL, NULL, '2019-01-20 11:58:42', 'Confirmed', '3 years', 'Pending'),
(15, 6, 9, 4, 'Cabido Busters', '2019-01-20 00:00:00', '2019-01-27 00:00:00', '2019-01-20 13:48:23', 'Confirmed', '4 years', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `occupied_stalls`
--

CREATE TABLE `occupied_stalls` (
  `id` int(11) NOT NULL,
  `contract_id` int(11) DEFAULT NULL,
  `stall_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `occupied_stalls`
--

INSERT INTO `occupied_stalls` (`id`, `contract_id`, `stall_id`) VALUES
(1, 1, 4),
(2, 1, 5),
(3, 2, 6),
(4, 2, 7),
(5, 8, 8),
(6, 7, 9),
(7, 15, 10),
(8, 15, 11),
(9, 2, 12);

-- --------------------------------------------------------

--
-- Table structure for table `renewal`
--

CREATE TABLE `renewal` (
  `renewal_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `contract_id` int(11) NOT NULL,
  `date_applied_renewal` datetime DEFAULT CURRENT_TIMESTAMP,
  `renewal_status` varchar(32) DEFAULT 'Unapproved',
  `renewal_term` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `renewal`
--

INSERT INTO `renewal` (`renewal_id`, `client_id`, `contract_id`, `date_applied_renewal`, `renewal_status`, `renewal_term`) VALUES
(1, 1, 1, '2019-01-18 21:55:51', 'Approved', '1 year'),
(2, 1, 1, '2019-01-19 02:03:43', 'Approved', '1 year'),
(3, 1, 1, '2019-01-19 02:08:32', 'Approved', '1 year'),
(4, 1, 1, '2019-01-19 02:13:07', 'Approved', '2 years'),
(5, 1, 1, '2019-01-19 02:21:38', 'Approved', '3 years'),
(6, 1, 3, '2019-01-19 02:27:57', 'Approved', '4 years'),
(7, 1, 3, '2019-01-19 02:28:00', 'Approved', '4 years'),
(8, 1, 3, '2019-01-19 02:29:02', 'Unapproved', '4 years'),
(9, 1, 3, '2019-01-19 02:29:31', 'Unapproved', '4 years'),
(10, 2, 2, '2019-01-19 02:30:13', 'Unapproved', '2 years'),
(11, 2, 4, '2019-01-19 03:24:43', 'Unapproved', '1 year'),
(12, 2, 2, '2019-01-20 20:07:09', 'Approved', '1 year'),
(13, 2, 11, '2019-01-20 20:21:56', 'Approved', '1 year'),
(14, 1, 1, '2019-01-20 20:29:13', 'Approved', '3 years'),
(15, 1, 3, '2019-01-20 20:29:13', 'Approved', '1 year'),
(16, 1, 8, '2019-01-20 20:29:14', 'Unapproved', '1 year'),
(17, 1, 10, '2019-01-20 20:29:16', 'Unapproved', '4 years');

-- --------------------------------------------------------

--
-- Table structure for table `renewal_details`
--

CREATE TABLE `renewal_details` (
  `id` int(11) NOT NULL,
  `renewal_id` int(11) NOT NULL,
  `stall_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `renewal_details`
--

INSERT INTO `renewal_details` (`id`, `renewal_id`, `stall_id`) VALUES
(1, 1, 4),
(2, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `rental_payment`
--

CREATE TABLE `rental_payment` (
  `rentp_id` int(11) NOT NULL,
  `contract_id` int(11) NOT NULL,
  `total_amount` double DEFAULT '0',
  `amount_paid` double DEFAULT '0',
  `balance` double DEFAULT '0',
  `date_paid` datetime DEFAULT NULL,
  `rent_month` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rental_payment`
--

INSERT INTO `rental_payment` (`rentp_id`, `contract_id`, `total_amount`, `amount_paid`, `balance`, `date_paid`, `rent_month`) VALUES
(1, 1, 1750, 0, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stalls`
--

CREATE TABLE `stalls` (
  `stall_id` int(11) NOT NULL,
  `floor_no` varchar(1) NOT NULL,
  `block_no` varchar(20) NOT NULL,
  `block_dimension` varchar(11) NOT NULL,
  `stall_price` double NOT NULL,
  `price_date_effectivity` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stalls`
--

INSERT INTO `stalls` (`stall_id`, `floor_no`, `block_no`, `block_dimension`, `stall_price`, `price_date_effectivity`) VALUES
(4, '1', '1A', '50x50', 650, '2019-01-23 00:00:00'),
(5, '1', '1B', '100x100', 1000, '2019-01-28 00:00:00'),
(6, '2', '2A', '100x100', 1000, '2019-01-21 00:00:00'),
(7, '2', '2B', '300x450', 4500, '2019-01-21 00:00:00'),
(8, '2', '2C', '500x500', 6000, '2019-01-21 00:00:00'),
(9, '2', '2D', '650x500', 6500, '2019-01-21 00:00:00'),
(10, '3', '3A', '500x500', 2750.95, '2019-01-21 00:00:00'),
(11, '3', '3B', '500x500', 2750.95, '2019-01-21 00:00:00'),
(12, '4', '4A', '500x500', 2540.85, '2019-01-22 00:00:00');

--
-- Triggers `stalls`
--
DELIMITER $$
CREATE TRIGGER `empty_stalls` AFTER INSERT ON `stalls` FOR EACH ROW BEGIN
	INSERT INTO occupied_stalls (stall_id) VALUES (new.stall_id);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `price_history` AFTER UPDATE ON `stalls` FOR EACH ROW BEGIN
	INSERT INTO stall_pricehistory (stall_price, stall_id, date_end, date_effectivity)
    VALUES (old.stall_price, new.stall_id,  new.price_date_effectivity, old.price_date_effectivity);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `stall_pricehistory`
--

CREATE TABLE `stall_pricehistory` (
  `priceh_id` int(11) NOT NULL,
  `stall_id` int(11) NOT NULL,
  `stall_price` double NOT NULL,
  `date_end` datetime DEFAULT NULL,
  `date_effectivity` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stall_pricehistory`
--

INSERT INTO `stall_pricehistory` (`priceh_id`, `stall_id`, `stall_price`, `date_end`, `date_effectivity`) VALUES
(27, 4, 950, '2019-01-04 00:00:00', '2019-01-04 00:00:00'),
(28, 4, 650, '2019-01-23 00:00:00', '2019-01-04 00:00:00'),
(29, 4, 650, '2019-01-23 00:00:00', '2019-01-23 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applied_stall`
--
ALTER TABLE `applied_stall`
  ADD PRIMARY KEY (`app_id`),
  ADD KEY `fk_app_client_id` (`client_id`),
  ADD KEY `fk_app_category_id` (`category_id`);

--
-- Indexes for table `applied_stall_details`
--
ALTER TABLE `applied_stall_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_appd_app_id` (`app_id`),
  ADD KEY `fk_appd_stall_id` (`stall_id`);

--
-- Indexes for table `business_classification`
--
ALTER TABLE `business_classification`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`client_id`),
  ADD UNIQUE KEY `unique_email` (`email`);

--
-- Indexes for table `contract`
--
ALTER TABLE `contract`
  ADD PRIMARY KEY (`contract_id`),
  ADD KEY `fk_cont_app_id` (`app_id`),
  ADD KEY `fk_cont_client_id` (`client_id`),
  ADD KEY `fk_cont_category_id` (`category_id`);

--
-- Indexes for table `occupied_stalls`
--
ALTER TABLE `occupied_stalls`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_occ_contract_id` (`contract_id`),
  ADD KEY `fk_occ_stall_id` (`stall_id`);

--
-- Indexes for table `renewal`
--
ALTER TABLE `renewal`
  ADD PRIMARY KEY (`renewal_id`),
  ADD KEY `fk_renewal_client_id` (`client_id`),
  ADD KEY `fk_renewal_contract_id` (`contract_id`);

--
-- Indexes for table `renewal_details`
--
ALTER TABLE `renewal_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_rend_renewal_id` (`renewal_id`),
  ADD KEY `fk_rend_stall_id` (`stall_id`);

--
-- Indexes for table `rental_payment`
--
ALTER TABLE `rental_payment`
  ADD PRIMARY KEY (`rentp_id`),
  ADD KEY `fk_rent_contract_id` (`contract_id`);

--
-- Indexes for table `stalls`
--
ALTER TABLE `stalls`
  ADD PRIMARY KEY (`stall_id`);

--
-- Indexes for table `stall_pricehistory`
--
ALTER TABLE `stall_pricehistory`
  ADD PRIMARY KEY (`priceh_id`),
  ADD KEY `fk_priceh_stall_id` (`stall_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applied_stall`
--
ALTER TABLE `applied_stall`
  MODIFY `app_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `applied_stall_details`
--
ALTER TABLE `applied_stall_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `business_classification`
--
ALTER TABLE `business_classification`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `contract`
--
ALTER TABLE `contract`
  MODIFY `contract_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `occupied_stalls`
--
ALTER TABLE `occupied_stalls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `renewal`
--
ALTER TABLE `renewal`
  MODIFY `renewal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `renewal_details`
--
ALTER TABLE `renewal_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rental_payment`
--
ALTER TABLE `rental_payment`
  MODIFY `rentp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stalls`
--
ALTER TABLE `stalls`
  MODIFY `stall_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `stall_pricehistory`
--
ALTER TABLE `stall_pricehistory`
  MODIFY `priceh_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applied_stall`
--
ALTER TABLE `applied_stall`
  ADD CONSTRAINT `fk_app_category_id` FOREIGN KEY (`category_id`) REFERENCES `business_classification` (`category_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_app_client_id` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`) ON DELETE CASCADE;

--
-- Constraints for table `applied_stall_details`
--
ALTER TABLE `applied_stall_details`
  ADD CONSTRAINT `fk_appd_app_id` FOREIGN KEY (`app_id`) REFERENCES `applied_stall` (`app_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_appd_stall_id` FOREIGN KEY (`stall_id`) REFERENCES `stalls` (`stall_id`) ON DELETE CASCADE;

--
-- Constraints for table `contract`
--
ALTER TABLE `contract`
  ADD CONSTRAINT `fk_cont_app_id` FOREIGN KEY (`app_id`) REFERENCES `applied_stall` (`app_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_cont_category_id` FOREIGN KEY (`category_id`) REFERENCES `business_classification` (`category_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_cont_client_id` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`) ON DELETE CASCADE;

--
-- Constraints for table `occupied_stalls`
--
ALTER TABLE `occupied_stalls`
  ADD CONSTRAINT `fk_occ_contract_id` FOREIGN KEY (`contract_id`) REFERENCES `contract` (`contract_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_occ_stall_id` FOREIGN KEY (`stall_id`) REFERENCES `stalls` (`stall_id`) ON DELETE CASCADE;

--
-- Constraints for table `renewal`
--
ALTER TABLE `renewal`
  ADD CONSTRAINT `fk_renewal_client_id` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_renewal_contract_id` FOREIGN KEY (`contract_id`) REFERENCES `contract` (`contract_id`) ON DELETE CASCADE;

--
-- Constraints for table `renewal_details`
--
ALTER TABLE `renewal_details`
  ADD CONSTRAINT `fk_rend_renewal_id` FOREIGN KEY (`renewal_id`) REFERENCES `renewal` (`renewal_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_rend_stall_id` FOREIGN KEY (`stall_id`) REFERENCES `stalls` (`stall_id`) ON DELETE CASCADE;

--
-- Constraints for table `rental_payment`
--
ALTER TABLE `rental_payment`
  ADD CONSTRAINT `fk_rent_contract_id` FOREIGN KEY (`contract_id`) REFERENCES `contract` (`contract_id`) ON DELETE CASCADE;

--
-- Constraints for table `stall_pricehistory`
--
ALTER TABLE `stall_pricehistory`
  ADD CONSTRAINT `fk_priceh_stall_id` FOREIGN KEY (`stall_id`) REFERENCES `stalls` (`stall_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
