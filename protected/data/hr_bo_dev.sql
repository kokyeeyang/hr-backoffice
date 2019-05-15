-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 07, 2019 at 09:16 PM
-- Server version: 5.7.26-0ubuntu0.16.04.1
-- PHP Version: 7.3.4-1+ubuntu16.04.1+deb.sury.org+3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hr_bo_dev`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) UNSIGNED NOT NULL,
  `admin_username` varchar(16) NOT NULL,
  `admin_password` varchar(40) CHARACTER SET latin1 NOT NULL,
  `admin_display_name` varchar(50) NOT NULL,
  `admin_status` int(1) NOT NULL,
  `admin_priv` enum('admin','manager','hr') NOT NULL,
  `admin_login_retry_times` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `admin_last_login` datetime NOT NULL,
  `admin_modified_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `admin_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_username`, `admin_password`, `admin_display_name`, `admin_status`, `admin_priv`, `admin_login_retry_times`, `admin_last_login`, `admin_modified_datetime`, `admin_datetime`) VALUES
(1, 'hrboroot', '8aebe17f2b4add6f04fb1c25c3cb80e9e867a70e', 'Admin', 1, 'admin', 0, '2019-05-07 12:10:56', '2019-05-06 04:12:37', '2019-05-03 20:59:22');

-- --------------------------------------------------------

--
-- Table structure for table `admin_activity_log`
--

CREATE TABLE `admin_activity_log` (
  `admin_activity_log_id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` int(11) UNSIGNED NOT NULL,
  `admin_activity_log_ip` varchar(15) NOT NULL,
  `admin_activity_log_controller` varchar(50) NOT NULL,
  `admin_activity_log_action` varchar(50) NOT NULL,
  `admin_activity_log_params` text NOT NULL,
  `admin_activity_log_modified_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `admin_activity_log_datetime` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `admin_login_log`
--

CREATE TABLE `admin_login_log` (
  `admin_login_log_id` int(11) UNSIGNED NOT NULL,
  `admin_login_log_username` varchar(20) NOT NULL,
  `admin_login_log_ip` varchar(20) NOT NULL,
  `admin_login_log_status` tinyint(1) UNSIGNED NOT NULL COMMENT '1:fail, 2:success, 3:retry over',
  `admin_login_log_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `whitelisted_ip`
--

CREATE TABLE `whitelisted_ip` (
  `id` int(11) NOT NULL,
  `label` varchar(50) NOT NULL,
  `ip_address` varchar(20) NOT NULL,
  `duration` int(15) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `whitelisted_ip`
--

INSERT INTO `whitelisted_ip` (`id`, `label`, `ip_address`, `duration`, `created_date`, `created_by`) VALUES
(38, 'office', '211.24.92.109', 9999, '2019-04-23 00:00:00', '9'),
(39, 'myubuntu', '192.168.56.1', 9999, '2019-05-03 00:00:00', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `admin_activity_log`
--
ALTER TABLE `admin_activity_log`
  ADD PRIMARY KEY (`admin_activity_log_id`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `admin_id_2` (`admin_id`,`admin_activity_log_controller`);

--
-- Indexes for table `admin_login_log`
--
ALTER TABLE `admin_login_log`
  ADD PRIMARY KEY (`admin_login_log_id`),
  ADD KEY `admin_login_log_username` (`admin_login_log_username`);

--
-- Indexes for table `whitelisted_ip`
--
ALTER TABLE `whitelisted_ip`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `admin_activity_log`
--
ALTER TABLE `admin_activity_log`
  MODIFY `admin_activity_log_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `admin_login_log`
--
ALTER TABLE `admin_login_log`
  MODIFY `admin_login_log_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `whitelisted_ip`
--
ALTER TABLE `whitelisted_ip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

/* Yee Yang 13/5/2019 */
CREATE TABLE employment_candidate (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(50) NOT NULL,
  `id_no` varchar(40) NOT NULL,
  `address` varchar(80) NOT NULL,
  `contact_no` varchar(25) NOT NULL,
  `email_address` varchar(60) NOT NULL,
  `date_of_birth` datetime NOT NULL,
  `marital_status` varchar(20) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `nationality` varchar(30) NOT NULL,
  `terminated_before` int(11) NULL DEFAULT '0',
  `termination_reason` varchar(60) NULL,
  `reference_consent` int(11) NULL DEFAULT '1',
  `refuse_reference_reason` varchar(60) NULL,
  `position_applied` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/* Yee Yang 14/5/2019 */
CREATE TABLE employment_education (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `candidate_id` int(25) NOT NULL,
  `school_name` varchar(40) NOT NULL,
  `start_year` varchar(4) NOT NULL,
  `end_year` varchar(4) NOT NULL,
  `qualification` varchar(40) NOT NULL,
  `grade` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/* Yee Yang 15/5/2019 */
CREATE TABLE employment_job_experience (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `candidate_id` int(25) NOT NULL,
  `company_name` varchar(50) NOT NULL,
  `start_date` varchar(10) NOT NULL,
  `end_date` varchar(10) NOT NULL,
  `position_held` varchar(10) NOT NULL,
  `starting_salary` int(10) NOT NULL,
  `ending_salary` int(10) NOT NULL,
  `allowances` int(10) NOT NULL,
  `leave_reason` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;