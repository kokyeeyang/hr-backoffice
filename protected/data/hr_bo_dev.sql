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
  `admin_priv` enum('admin','manager','hr', 'normal user') NOT NULL,
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
  `finding_method` varchar(60) NULL,
  `candidate_signature` varchar(60) NOT NULL,
  `candidate_signature_date` datetime NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
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
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
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
  `ending_salary` int(10) NOT NULL,
  `allowances` int(10) NOT NULL,
  `leave_reason` varchar(80) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE employment_referee (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `candidate_id` int(25) NOT NULL,
  `supervisor_name` varchar(50) NOT NULL,
  `supervisor_company` varchar(50) NOT NULL,
  `supervisor_occupation` varchar(50) NOT NULL,
  `supervisor_contact` varchar(50) NOT NULL,
  `years_known` int(5) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE employment_general_question (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `candidate_id` int(25) NOT NULL,
  `has_physical_ailment` int(11) NOT NULL,
  `has_been_convicted` int(11) NOT NULL,
  `offense` varchar(50) NULL,
  `convicted_date` datetime NULL,
  `date_of_discharge` datetime NULL,
  `has_company_contact` int(11) NOT NULL,
  `company_contact_name` varchar(50) NULL,
  `relationship_with_candidate` varchar(50) NULL,
  `has_conflict_of_interest` int(11) NOT NULL,
  `has_own_transport` int(11) NOT NULL,
  `has_applied_before` int(11) NOT NULL,
  `commencement_date` datetime NOT NULL,
  `good_conduct_consent` int(11) NOT NULL,
  `expected_salary` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE employment_job_opening (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_title` varchar(50) NULL,
  `department` varchar(50) NULL,
  `interviewing_manager` varchar(50) NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/* Yee Yang 04/06/2019 */
ALTER TABLE `employment_candidate` 
  ADD `job_id` int(11) NOT NULL;

/* Yee Yang 11/06/2019 */
ALTER TABLE `employment_referee`
  ADD `supervisor_email` varchar(50) NULL;

ALTER TABLE employment_candidate 
  ADD `candidate_agree_terms` int(11) NOT NULL  AFTER `candidate_signature`;

ALTER TABLE employment_candidate
  DROP COLUMN `candidate_signature`,
  ADD COLUMN `candidate_image` varchar(100) NULL AFTER `job_id`;

/* Yee Yang 19/06/2019 */
CREATE TABLE employment_link_token (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(50) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/* Yee Yang 20/06/2019 */
ALTER TABLE employment_candidate
  ADD COLUMN `candidate_resume` varchar(100) NULL AFTER `candidate_image`,
  ADD COLUMN `candidate_cover_letter` varchar(100) NULL AFTER `candidate_resume`;

ALTER TABLE employment_candidate 
  ADD `candidate_status` bool NULL DEFAULT '0' AFTER `finding_method`;

/* Added by YY 21/08/19 */
ALTER TABLE employment_general_question
  ADD `ailment_description` varchar(50) NULL AFTER `has_physical_ailment`;

CREATE TABLE training_onboarding_checklist_category (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(50) NOT NULL,
  `description` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE training_onboarding_checklist (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `onboarding_item_id` varchar(50) NOT NULL,
  `candidate_id` varchar(40) NOT NULL,
  `completed` bool NULL DEFAULT '0',
  `completed_date` varchar(40) NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(40) NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO training_onboarding_checklist_category (category, description)
VALUES ("A", "Introduction and Welcome"),
("B", "Organizational Structure"),
("C", "Job Description"),
("D", "Site Specific Information"),
("E", "Conditions of Employment"),
("F", "On-the-Job Training"),
("G", "Good Conduct Policy"),
("H", "Payroll Panda"),
("I", "Access Creation");

CREATE TABLE training_onboarding_items (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `onboarding_item` varchar(300) NOT NULL,
  `category` varchar(50) NOT NULL,
  `responsibility` varchar(50) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(40) NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO training_onboarding_items (onboarding_item, category, responsibility)
VALUES ("Offer letter", "A", "HR"),
("Induction form", "A", "HR"),
("Insurance form", "A", "HR"),
("Work place guideline", "A", "HR"),
("Application form (ic,certs, resume, passport photo, payslip)", "A", "HR"),
("Access card", "A", "HR"),
("Personal particular form", "A", "HR"),
("Organization chart", "B", "HR"),
("Introduce to their immediate team & other departments", "B", "HR"),
("Employee understand the key objectives of their role and how their role fits in to the wider organization", "C", "Line manager"),
("Washrooms, pantry, entry and exit points, public transport, parking (if applicable) etc", "D", "HR"),
("Office hours, lunch hours etc", "D", "HR"),
("Employee understand their conditions of employment(Probation period, visa regulations if applicable etc)", "E", "HR"),
("Training schedule", "F", "HR"),
("Application for good conduct certification online : http://ekonsular.kln.gov.my/", "G", "HR"),
("User training", "H", "HR"),
("Email account, Asana, Bit8, Skype groups, Dropbox, Door access", "I", "Adrian"),
("Live chats", "I", "Mahen")          

ALTER TABLE employment_candidate
  ADD `remarks` varchar(400) NULL AFTER `candidate_signature_date`;

ALTER TABLE employment_job_opening 
  ADD `is_managerial_position` tinyint(1) UNSIGNED NOT NULL DEFAULT '0'
  AFTER `interviewing_manager`;

CREATE TABLE employment_offer_letter_templates (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `offer_letter_title` varchar(300) NOT NULL,
  `offer_letter_description` varchar(300) NOT NULL,
  `department` varchar(100) NOT NULL,
  `is_managerial` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `offer_letter_content` text NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(40) NULL,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by` varchar(40) NULL,
   PRIMARY KEY (`id`) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE employment_interview_questions (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `candidate_id` varchar(40) NOT NULL,
  `suitable_experience` varchar(500) NULL,
  `aspirations` varchar(500) NULL,
  `passion` varchar(500) NULL,
  `background` varchar(500) NULL,
  `commute` varchar(200) NULL,
  `experience` varchar(500) NULL,
  `leave_reason` varchar(500) NULL,
  `notice_period` varchar(200) NULL,
  `interviewing_with_other_companies` varchar(300) NULL,
  `family_status` varchar(500) NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(40) NULL,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by` varchar(40) NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE department (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department_title` varchar(80) NULL,
  `department_description` varchar(300) NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(40) NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE admin 
  ADD `admin_department` varchar(80) NULL AFTER `admin_priv`;

CREATE TABLE onboarding_checklist_items (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(140) NULL,
  `department_owner` int(11) NOT NULL,
  `is_offloading_item` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `is_managerial` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(40) NULL,
  PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE onboarding_checklist_items_mapping (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `checklist_item_id` int(11) NOT NULL,
  `checklist_template_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (checklist_item_id) REFERENCES onboarding_checklist_items(id),
  FOREIGN KEY (checklist_template_id) REFERENCES onboarding_checklist_template(id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE onboarding_checklist_template (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(160) NULL,
  `description` varchar(160) NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(40) NULL,
  PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE admin
  ADD FOREIGN KEY (admin_department) REFERENCES department(id);

ALTER TABLE admin
  MODIFY COLUMN admin_id int(11) NOT NULL AUTO_INCREMENT;

CREATE TABLE onboarding_checklist_user_mapping (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `checklist_items_mapping_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(40) NULL,
  PRIMARY KEY (`id`),  
  FOREIGN KEY (user_id) REFERENCES admin(admin_id),
  FOREIGN KEY (checklist_items_mapping_id) REFERENCES onboarding_checklist_items_mapping(id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE department CHANGE department_title title varchar(80);
ALTER TABLE department CHANGE department_description description varchar(300);

CREATE TABLE employment_offer_letter_templates_mapping (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `offer_letter_template_id` int(11) UNSIGNED NOT NULL,
  `department_id` int(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (offer_letter_template_id) REFERENCES employment_offer_letter_templates(id),
  FOREIGN KEY (department_id) REFERENCES department(id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE employment_candidate_status (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(160) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;