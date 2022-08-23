-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 23, 2022 at 04:57 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `report`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminbase`
--

CREATE TABLE `adminbase` (
  `id` int(11) NOT NULL,
  `adminid` varchar(256) NOT NULL,
  `username` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `name` varchar(256) NOT NULL,
  `firstLogin` int(11) NOT NULL DEFAULT 1,
  `department` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `accessLevel` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `adminbase`
--

INSERT INTO `adminbase` (`id`, `adminid`, `username`, `password`, `name`, `firstLogin`, `department`, `email`, `accessLevel`, `status`) VALUES
(1, 'ce7402ad18194776514e6efcae0bf81a', 'soumit', 'e2fc714c4727ee9395f324cd2e7f331f', 'Soumit Das', 0, '6fb73e8a536739deba2f642ebfc4282c', 'its.soumit.das@gmail.com', 12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `departmentid` varchar(256) NOT NULL,
  `departmentname` varchar(256) NOT NULL,
  `departmentcode` varchar(256) NOT NULL,
  `departmentcolor` varchar(256) NOT NULL DEFAULT '#000000',
  `documentTill` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `departmentid`, `departmentname`, `departmentcode`, `departmentcolor`, `documentTill`, `status`) VALUES
(1, '6fb73e8a536739deba2f642ebfc4282c', 'Super Administrator', 'SUADMIN', '#FF0000', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `eventid` varchar(256) NOT NULL,
  `departmentid` varchar(256) NOT NULL,
  `reportid` varchar(256) DEFAULT NULL,
  `name` varchar(256) NOT NULL,
  `fromDate` varchar(256) NOT NULL,
  `toDate` varchar(256) NOT NULL,
  `fromTime` varchar(256) DEFAULT NULL,
  `toTime` varchar(256) DEFAULT NULL,
  `audience` varchar(256) NOT NULL,
  `venue` varchar(256) NOT NULL,
  `description` varchar(2000) NOT NULL,
  `infographic` varchar(256) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `imagefiles`
--

CREATE TABLE `imagefiles` (
  `id` int(11) NOT NULL,
  `imageid` varchar(256) NOT NULL,
  `reportid` varchar(256) NOT NULL,
  `fileLocation` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `id` int(11) NOT NULL,
  `reportid` varchar(256) NOT NULL,
  `departmentid` varchar(256) NOT NULL,
  `adminid` varchar(256) NOT NULL,
  `title` varchar(256) NOT NULL,
  `description` varchar(2000) NOT NULL,
  `objective` varchar(2000) NOT NULL,
  `resource` varchar(2000) DEFAULT NULL,
  `sdate` varchar(256) NOT NULL,
  `edate` varchar(256) NOT NULL,
  `mode` varchar(256) NOT NULL,
  `attendee` int(11) NOT NULL,
  `insertDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `modifyDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `notify` int(11) NOT NULL DEFAULT 0,
  `revision` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `isLocked` int(11) NOT NULL DEFAULT 0,
  `finalDocument` varchar(256) DEFAULT NULL,
  `finalDocumentAvailable` int(11) NOT NULL DEFAULT 0,
  `publicSharing` int(11) NOT NULL DEFAULT 0,
  `reportpassword` varchar(256) DEFAULT NULL,
  `reportShortLink` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `spcRequests`
--

CREATE TABLE `spcRequests` (
  `id` int(11) NOT NULL,
  `requestid` varchar(256) NOT NULL,
  `reportid` varchar(256) NOT NULL,
  `tillDate` varchar(256) NOT NULL,
  `uploaded` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminbase`
--
ALTER TABLE `adminbase`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `imagefiles`
--
ALTER TABLE `imagefiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `spcRequests`
--
ALTER TABLE `spcRequests`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminbase`
--
ALTER TABLE `adminbase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `imagefiles`
--
ALTER TABLE `imagefiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `spcRequests`
--
ALTER TABLE `spcRequests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
