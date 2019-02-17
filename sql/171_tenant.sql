-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2019 at 01:17 PM
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
  `applied_term` varchar(32) NOT NULL,
  `start_date` datetime,
  `end_date` datetime
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `applied_stall`
--

INSERT INTO `applied_stall` (`app_id`, `client_id`, `category_id`, `business_name`, `date_applied`, `date_approved`, `application_status`, `applied_term`) VALUES
(21, 29, 18, 'Calisthenics Philippines', '2019-01-25 19:12:22', NULL, 'Approved', '4 years'),
(22, 29, 8, 'Oxygen', '2019-01-25 19:23:21', NULL, 'Disapproved', '2 years'),
(23, 29, 8, 'Bench', '2019-01-25 19:48:45', NULL, 'Approved', '2 years'),
(24, 30, 10, 'iStore', '2019-01-26 19:11:06', NULL, 'Approved', '4 years');

--
-- Triggers `applied_stall`
--
DELIMITER $$
CREATE TRIGGER `application_automation` AFTER UPDATE ON `applied_stall` FOR EACH ROW BEGIN
 IF (new.application_status = 'Approved') THEN
	INSERT INTO contract (client_id, app_id, category_id, business_name, contract_term, start_date, end_date, remark) VALUES (new.client_id, new.app_id, new.category_id, new.business_name, new.applied_term, new.start_date, new.end_date, 'Confirmed');
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
(27, 21, 13, 'Approved'),
(28, 21, 14, 'Unapproved'),
(29, 21, 15, 'Approved'),
(30, 21, 16, 'Approved'),
(31, 21, 17, 'Unapproved'),
(32, 22, 14, 'Disapproved'),
(33, 22, 17, 'Disapproved'),
(34, 23, 18, 'Approved'),
(35, 23, 19, 'Approved'),
(36, 24, 14, 'Approved'),
(37, 24, 17, 'Approved');

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
(6, 'Arts, Crafts and Collectibles'),
(7, 'Books ang Magazines'),
(8, 'Clothing, Shoes and Accessories'),
(9, 'Computers, Accessories and Services'),
(10, 'Electronics and Telecom'),
(11, 'Entertainment and Media'),
(12, 'Financial Services and Products'),
(13, 'Food Retail and Service'),
(14, 'Gifts and Flowers'),
(15, 'Government'),
(16, 'Health and Personal Care'),
(17, 'Pets and Animals'),
(18, 'Sports'),
(19, 'Travel'),
(20, 'Vehicle Sales'),
(21, 'Vehicle Service and Accessories'),
(22, 'Toys and Hobbies'),
(23, 'Arcade');

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
(29, 'Carlo Miguel', 'Dy', 'carlomigueldy@gmail.com', 'Maigo', '09167764350'),
(30, 'Nove', 'Lactuan', 'nove.lactuan@gmail.com', 'Tubod', '09252248799');

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
  `renewal_status` varchar(32) NOT NULL DEFAULT 'Pending',
  `verified` varchar(32) DEFAULT 'False' 
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contract`
--

INSERT INTO `contract` (`contract_id`, `app_id`, `client_id`, `category_id`, `business_name`, `start_date`, `end_date`, `date_approved`, `remark`, `contract_term`, `renewal_status`) VALUES
(18, 21, 29, 18, 'Calisthenics Philippines', '2019-01-25 00:00:00', '2019-01-28 00:00:00', '2019-01-25 19:13:49', 'Confirmed', '4 years', 'Pending'),
(20, 23, 29, 8, 'Bench', '2019-01-25 00:00:00', '2019-01-26 00:00:00', '2019-01-25 19:49:22', 'Confirmed', '4 years', 'Pending'),
(21, 24, 30, 10, 'iStore', '2019-01-26 00:00:00', '2019-01-31 00:00:00', '2019-01-26 19:11:16', 'Confirmed', '4 years', 'Pending');

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
(10, 18, 13),
(11, 21, 14),
(12, 18, 15),
(13, 18, 16),
(14, 21, 17),
(15, 20, 18),
(16, 20, 19),
(17, NULL, 20),
(18, NULL, 21),
(19, NULL, 22);

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
(21, 29, 20, '2019-01-25 20:22:26', 'Approved', '4 years');

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
(7, 21, 18),
(8, 21, 19);

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
(2, 21, 3751.5, 3751.5, 0, '2019-01-26 00:00:00', 'January'),
(4, 21, 3751.5, 3751.5, 0, '2019-01-26 19:56:04', 'February'),
(5, 21, 3751.5, 3250, 501.5, '2019-01-26 20:01:30', 'March'),
(6, 21, 3751.5, 0, 3751.5, NULL, 'April'),
(7, 21, 4251.7, 0, 4251.7, NULL, 'May'),
(8, 21, 4251.7, 0, 4251.7, NULL, 'June');

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
(13, '1', '1A', '350x350', 1000.5, '2019-01-21 00:00:00'),
(14, '1', '1B', '450x450', 1750.95, '2019-01-21 00:00:00'),
(15, '1', '1C', '450x450', 1250.75, '2019-01-21 00:00:00'),
(16, '1', '1D', '350x350', 1000.5, '2019-01-21 00:00:00'),
(17, '1', '1E', '500x500', 2500.75, '2019-01-21 00:00:00'),
(18, '2', '2A', '350x350', 1150.75, '2019-01-22 00:00:00'),
(19, '2', '2B', '350x350', 1150.75, '2019-01-22 00:00:00'),
(20, '2', '2C', '450x450', 1850.95, '2019-01-22 00:00:00'),
(21, '2', '2D', '500x500', 2000.25, '2019-01-22 00:00:00'),
(22, '2', '2E', '500x500', 2000.25, '2019-01-22 00:00:00');

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
(30, 14, 1250.75, '2019-01-21 00:00:00', '2019-01-21 00:00:00');

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
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'admin', '$2y$10$jHkDiN56hsnaiahFqS2kueUOCglf1LUaX.WcrQVQ3kvribfNaIXKW', '2019-01-26 20:09:03');

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
  ADD PRIMARY KEY (`stall_id`),
  ADD UNIQUE KEY `unique_block` (`block_no`);

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
  MODIFY `app_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `applied_stall_details`
--
ALTER TABLE `applied_stall_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `business_classification`
--
ALTER TABLE `business_classification`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `contract`
--
ALTER TABLE `contract`
  MODIFY `contract_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `occupied_stalls`
--
ALTER TABLE `occupied_stalls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `renewal`
--
ALTER TABLE `renewal`
  MODIFY `renewal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `renewal_details`
--
ALTER TABLE `renewal_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `rental_payment`
--
ALTER TABLE `rental_payment`
  MODIFY `rentp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `stalls`
--
ALTER TABLE `stalls`
  MODIFY `stall_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `stall_pricehistory`
--
ALTER TABLE `stall_pricehistory`
  MODIFY `priceh_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
