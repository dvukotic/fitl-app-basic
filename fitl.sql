-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 22, 2017 at 02:41 PM
-- Server version: 5.7.17-0ubuntu0.16.04.1
-- PHP Version: 7.1.1-1+deb.sury.org~xenial+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fitl`
--

-- --------------------------------------------------------

--
-- Table structure for table `TBL_Invoice`
--

CREATE TABLE `TBL_Invoice` (
  `_id` bigint(20) NOT NULL,
  `_tid` bigint(20) NOT NULL,
  `_ts_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `_user_add` bigint(20) NOT NULL,
  `_ts_mod` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `_user_mod` bigint(20) DEFAULT NULL,
  `_cancel` tinyint(4) DEFAULT NULL,
  `document_number` varchar(30) NOT NULL,
  `document_date` datetime NOT NULL,
  `due_date` date NOT NULL,
  `status_cancel` tinyint(4) DEFAULT NULL,
  `status_sent` tinyint(4) DEFAULT NULL,
  `status_print` tinyint(4) DEFAULT NULL,
  `customer_FK` bigint(20) NOT NULL,
  `salesperson_FK` bigint(20) NOT NULL,
  `description` varchar(1024) DEFAULT NULL,
  `comment` varchar(1024) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `TBL_Invoice`
--
ALTER TABLE `TBL_Invoice`
  ADD PRIMARY KEY (`_id`),
  ADD KEY `IDX_invoice_customer_FK` (`customer_FK`),
  ADD KEY `IDX_invoice_salesperson_FK` (`salesperson_FK`),
  ADD KEY `IDX_invoice_documentnumber__tid` (`document_number`,`_tid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `TBL_Invoice`
--
ALTER TABLE `TBL_Invoice`
  MODIFY `_id` bigint(20) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
