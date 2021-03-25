-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 17, 2012 at 01:41 PM
-- Server version: 5.1.63
-- PHP Version: 5.3.2-1ubuntu4.18

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `t2v_cirrus`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE IF NOT EXISTS `chat` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `from_chat` varchar(7) COLLATE utf8_bin NOT NULL DEFAULT '',
  `to_chat` varchar(7) COLLATE utf8_bin NOT NULL DEFAULT '',
  `message` text COLLATE utf8_bin NOT NULL,
  `sent` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `recd` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `from_chat` (`from_chat`),
  KEY `to_chat` (`to_chat`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `username` varchar(7) COLLATE utf8_bin NOT NULL,
  `code` varchar(10) COLLATE utf8_bin DEFAULT NULL COMMENT 'customer code',
  `first_name` varchar(30) COLLATE utf8_bin NOT NULL,
  `last_name` varchar(40) COLLATE utf8_bin NOT NULL,
  `century` int(2) NOT NULL DEFAULT '19' COMMENT 'birth of century',
  `social_security` varchar(10) COLLATE utf8_bin NOT NULL COMMENT 'personal number',
  `address` text COLLATE utf8_bin,
  `city` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `post` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `mobile` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `date` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0-disabled, 1-active',
  UNIQUE KEY `social_security` (`social_security`),
  KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `customer_attachment`
--

CREATE TABLE IF NOT EXISTS `customer_attachment` (
  `customer` varchar(7) COLLATE utf8_bin NOT NULL,
  `documents` text COLLATE utf8_bin NOT NULL,
  KEY `customer` (`customer`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `customer_contract`
--

CREATE TABLE IF NOT EXISTS `customer_contract` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `customer` varchar(7) COLLATE utf8_bin NOT NULL,
  `date_from` date NOT NULL COMMENT 'date from',
  `date_to` date NOT NULL COMMENT 'date to',
  `hour` float(10,2) NOT NULL COMMENT 'total hours alloted',
  `fkkn` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1-fk,2-kn',
  PRIMARY KEY (`id`),
  KEY `customer` (`customer`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `customer_contract_billing`
--

CREATE TABLE IF NOT EXISTS `customer_contract_billing` (
  `contract_id` bigint(20) NOT NULL,
  `first_name` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `last_name` varchar(40) COLLATE utf8_bin DEFAULT NULL,
  `mobile` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(80) COLLATE utf8_bin DEFAULT NULL,
  `city` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `oncall` tinyint(1) DEFAULT NULL,
  `awake` tinyint(1) DEFAULT NULL,
  `oncall2` tinyint(1) DEFAULT NULL,
  `iss` tinyint(1) DEFAULT NULL COMMENT '1 for iss in KN',
  `sol` tinyint(1) DEFAULT NULL COMMENT '1for sol in KN',
  `something` tinyint(1) DEFAULT NULL,
  `comments` text COLLATE utf8_bin,
  KEY `contract_id` (`contract_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `customer_contract_decision`
--

CREATE TABLE IF NOT EXISTS `customer_contract_decision` (
  `contract_id` bigint(20) NOT NULL,
  `first_name` varchar(30) COLLATE utf8_bin NOT NULL,
  `last_name` varchar(40) COLLATE utf8_bin NOT NULL,
  `mobile` varchar(20) COLLATE utf8_bin NOT NULL,
  `email` varchar(80) COLLATE utf8_bin NOT NULL,
  `city` varchar(30) COLLATE utf8_bin NOT NULL,
  `comments_time` text COLLATE utf8_bin,
  `comments_other` text COLLATE utf8_bin NOT NULL,
  `documents` text COLLATE utf8_bin NOT NULL COMMENT 'filename will be coma separated',
  KEY `contract_id` (`contract_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `customer_documentation`
--

CREATE TABLE IF NOT EXISTS `customer_documentation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer` varchar(7) COLLATE utf8_bin NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `completed_date` timestamp NULL DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `employee` varchar(7) COLLATE utf8_bin NOT NULL,
  `note_type` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `notes` text COLLATE utf8_bin,
  `priority` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `description` text COLLATE utf8_bin,
  `status` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customer` (`customer`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `customer_equipment`
--

CREATE TABLE IF NOT EXISTS `customer_equipment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `equipment` varchar(255) COLLATE utf8_bin NOT NULL,
  `serial_number` varchar(50) COLLATE utf8_bin NOT NULL,
  `customer` varchar(7) COLLATE utf8_bin NOT NULL,
  `employee` varchar(7) COLLATE utf8_bin NOT NULL,
  `issue_date` date NOT NULL,
  `return_date` date DEFAULT NULL,
  `remarks` tinytext COLLATE utf8_bin,
  PRIMARY KEY (`id`),
  KEY `customer` (`customer`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `customer_guardian`
--

CREATE TABLE IF NOT EXISTS `customer_guardian` (
  `customer` varchar(7) COLLATE utf8_bin NOT NULL,
  `first_name` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `last_name` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `mobile` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(80) COLLATE utf8_bin DEFAULT NULL,
  KEY `customer` (`customer`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `customer_health`
--

CREATE TABLE IF NOT EXISTS `customer_health` (
  `customer` varchar(7) COLLATE utf8_bin NOT NULL,
  `health_care` longtext COLLATE utf8_bin,
  `occupational_therapists` longtext COLLATE utf8_bin,
  `physiotherapists` longtext COLLATE utf8_bin,
  `other` longtext COLLATE utf8_bin,
  KEY `customer` (`customer`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `customer_implimentation`
--

CREATE TABLE IF NOT EXISTS `customer_implimentation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer` varchar(7) COLLATE utf8_bin NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `history` text COLLATE utf8_bin NOT NULL,
  `diagnosis` text COLLATE utf8_bin NOT NULL,
  `mission` text COLLATE utf8_bin NOT NULL,
  `intervention` text COLLATE utf8_bin NOT NULL,
  `travel` varchar(50) COLLATE utf8_bin NOT NULL,
  `work` varchar(20) COLLATE utf8_bin NOT NULL,
  `email` varchar(80) COLLATE utf8_bin NOT NULL,
  `phone` varchar(20) COLLATE utf8_bin NOT NULL,
  `work_comment` text COLLATE utf8_bin NOT NULL,
  `travel_comment` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  KEY `customer` (`customer`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `customer_relative`
--

CREATE TABLE IF NOT EXISTS `customer_relative` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `customer` varchar(7) COLLATE utf8_bin NOT NULL,
  `name` varchar(60) COLLATE utf8_bin DEFAULT NULL,
  `relation` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `address` tinytext COLLATE utf8_bin,
  `city` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `phone` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `work_phone` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `mobile` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `other` text COLLATE utf8_bin,
  PRIMARY KEY (`id`),
  KEY `customer` (`customer`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `customer_work`
--

CREATE TABLE IF NOT EXISTS `customer_work` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer` varchar(7) COLLATE utf8_bin NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `work` text COLLATE utf8_bin,
  `history` text COLLATE utf8_bin,
  `clinical_picture` text COLLATE utf8_bin,
  `medications` text COLLATE utf8_bin,
  `devolution` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `special_diet` text COLLATE utf8_bin,
  PRIMARY KEY (`id`),
  KEY `customer` (`customer`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `devicetokens`
--

CREATE TABLE IF NOT EXISTS `devicetokens` (
  `username` varchar(7) COLLATE utf8_bin NOT NULL,
  `devicetoken` tinytext COLLATE utf8_bin NOT NULL,
  KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `email`
--

CREATE TABLE IF NOT EXISTS `email` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `from` varchar(7) COLLATE utf8_bin NOT NULL,
  `to` text COLLATE utf8_bin NOT NULL,
  `subject` tinytext COLLATE utf8_bin NOT NULL,
  `message` longtext COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  KEY `from` (`from`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Internal mails';

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE IF NOT EXISTS `employee` (
  `username` varchar(7) COLLATE utf8_bin NOT NULL,
  `century` int(2) NOT NULL DEFAULT '19' COMMENT 'birth of century',
  `code` varchar(10) COLLATE utf8_bin DEFAULT NULL COMMENT 'employe code',
  `social_security` varchar(10) COLLATE utf8_bin NOT NULL COMMENT 'personal number',
  `first_name` varchar(30) COLLATE utf8_bin NOT NULL,
  `last_name` varchar(40) COLLATE utf8_bin NOT NULL,
  `address` text COLLATE utf8_bin,
  `city` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `post` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `mobile` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `date` date NOT NULL,
  `color` varchar(7) COLLATE utf8_bin NOT NULL DEFAULT '#FFFFFF',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0-disabled, 1-Active',
  `prv_swap` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0. do not have privilege for swapping the slot, 1. have privilege for swapping the slot',
  UNIQUE KEY `social_secutrity` (`social_security`),
  KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `employee_attachment`
--

CREATE TABLE IF NOT EXISTS `employee_attachment` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `employee` varchar(7) COLLATE utf8_bin NOT NULL,
  `documents` varchar(255) COLLATE utf8_bin NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `employee` (`employee`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `employee_contract`
--

CREATE TABLE IF NOT EXISTS `employee_contract` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee` varchar(7) COLLATE utf8_bin NOT NULL,
  `date_from` date NOT NULL COMMENT 'date from',
  `date_to` date DEFAULT NULL COMMENT 'date to',
  `hour` float(10,2) DEFAULT NULL COMMENT 'total hours alloted',
  `customer_name` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT 'customer',
  `customer_social_secutrity` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `tmp_long_assistance_from` date DEFAULT NULL,
  `tmp_long_assistance_to` date DEFAULT NULL,
  `tmp_assistance_for` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `absence_from` date DEFAULT NULL,
  `absence_to` date DEFAULT NULL,
  `special_appointment` tinyint(1) DEFAULT NULL,
  `probationary_from` date DEFAULT NULL,
  `probationary_to` date DEFAULT NULL,
  `open_ended_appointment` tinyint(1) DEFAULT NULL,
  `prevailing_collective` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `fulltime` tinyint(1) DEFAULT NULL,
  `part_time` float(4,2) DEFAULT NULL,
  `salary_month` float(10,3) DEFAULT NULL,
  `salary_hour` float(10,3) DEFAULT NULL,
  `incl_salary` tinyint(1) DEFAULT NULL,
  `excl_salary` tinyint(1) DEFAULT NULL,
  `incl_wages` tinyint(1) DEFAULT NULL,
  `act_salary` float(10,3) DEFAULT NULL,
  `bank_account` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `leave_per_year` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `incl_holiday_pay` tinyint(1) DEFAULT NULL,
  `excl_holiday_pay` tinyint(1) DEFAULT NULL,
  `incl_salary_compensation` varchar(20) COLLATE utf8_bin DEFAULT NULL COMMENT '1 - Overtime, 2 - Travel, 3 - stand by, 4 - ob, 5 - oncall -- wil be coma separated',
  `special_condition` tinytext COLLATE utf8_bin,
  `notes` tinytext COLLATE utf8_bin,
  `alloc_employee` varchar(7) COLLATE utf8_bin NOT NULL COMMENT 'contract creating employee',
  `alloc_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'contract creating date',
  `sign_date` timestamp NULL DEFAULT NULL COMMENT 'contract signing date',
  PRIMARY KEY (`id`),
  KEY `employee` (`employee`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `employee_skill`
--

CREATE TABLE IF NOT EXISTS `employee_skill` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `employee` varchar(7) COLLATE utf8_bin NOT NULL,
  `skill` varchar(100) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  KEY `employee` (`employee`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `exports`
--

CREATE TABLE IF NOT EXISTS `exports` (
  `year` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `employee` varchar(7) COLLATE utf8_bin NOT NULL,
  `filename` varchar(64) COLLATE utf8_bin NOT NULL,
  `data` blob NOT NULL,
  UNIQUE KEY `period` (`year`,`month`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `export_config`
--

CREATE TABLE IF NOT EXISTS `export_config` (
  `internal` varchar(16) NOT NULL,
  `external` varchar(16) NOT NULL,
  `method` enum('REPLACE','ADD') NOT NULL DEFAULT 'REPLACE',
  `price` float(10,2) NOT NULL DEFAULT '0.00',
  UNIQUE KEY `internal` (`internal`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `history_certification_report`
--

CREATE TABLE IF NOT EXISTS `history_certification_report` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `employee` varchar(7) COLLATE utf8_bin NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `file` varchar(80) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  KEY `employee` (`employee`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `history_sick_report`
--

CREATE TABLE IF NOT EXISTS `history_sick_report` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `employee` varchar(7) COLLATE utf8_bin NOT NULL,
  `customer` varchar(7) COLLATE utf8_bin NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `file` varchar(80) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  KEY `employee` (`employee`),
  KEY `customer` (`customer`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `inconvenient_timing`
--

CREATE TABLE IF NOT EXISTS `inconvenient_timing` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `root_id` int(6) NOT NULL DEFAULT '0',
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 - Normal, 3 - Oncall',
  `effect_from` date NOT NULL COMMENT 'effect from date',
  `effect_to` date DEFAULT NULL COMMENT 'effect to date',
  `time_from` float(4,2) NOT NULL,
  `time_to` float(4,2) NOT NULL,
  `days` varchar(30) COLLATE utf8_bin NOT NULL COMMENT 'days code will be coma separated',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `leave`
--

CREATE TABLE IF NOT EXISTS `leave` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `employee` varchar(7) COLLATE utf8_bin NOT NULL,
  `date` date NOT NULL,
  `time_from` float(4,2) DEFAULT NULL,
  `time_to` float(4,2) DEFAULT NULL,
  `type` int(2) NOT NULL COMMENT '1-Sjuk, 2-Sem, 3-VAB, 4-FP, 5-P-möte, 6-Utbild, 7-Övrigt, 8-Byte',
  `comment` text COLLATE utf8_bin,
  `apply_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'leave applying date',
  `appr_emp` varchar(7) COLLATE utf8_bin NOT NULL COMMENT 'login - username (role 1,2)',
  `appr_date` date DEFAULT NULL,
  `appr_comment` text COLLATE utf8_bin,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0-pending, 1-approved, 2-rejected',
  PRIMARY KEY (`id`),
  KEY `employee` (`employee`),
  KEY `appr_emp` (`appr_emp`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `leave_notification`
--

CREATE TABLE IF NOT EXISTS `leave_notification` (
  `employee` varchar(7) COLLATE utf8_bin NOT NULL COMMENT 'employee username',
  `email` varchar(30) COLLATE utf8_bin NOT NULL COMMENT 'leave ids with coma seperated',
  `mobile` varchar(30) COLLATE utf8_bin NOT NULL COMMENT 'leave ids with coma seperated',
  KEY `employee` (`employee`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `leave_sms`
--

CREATE TABLE IF NOT EXISTS `leave_sms` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `slot` bigint(20) NOT NULL,
  `employee` varchar(7) COLLATE utf8_bin NOT NULL,
  `send_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0-pending with confirmation sender, 1- accept, 2-rejected, 3-received yes, 4-pending with confirmation sender 1, 5- pending withot confirmation, 6- pending without conf sender1, 7 - pending without conf  rej=1, 8- pending without conf sender=1 reje=1',
  `receive_time` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `message` text COLLATE utf8_bin,
  `alloc_employee` varchar(7) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  KEY `slot` (`slot`),
  KEY `employee` (`employee`),
  KEY `alloc_employee` (`alloc_employee`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `log_login`
--

CREATE TABLE IF NOT EXISTS `log_login` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `username` varchar(7) COLLATE utf8_bin NOT NULL,
  `login_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'login time stamp',
  `logout_time` timestamp NULL DEFAULT NULL COMMENT 'logout time stamp',
  `ip` varchar(25) COLLATE utf8_bin NOT NULL,
  `browser` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `log_password`
--

CREATE TABLE IF NOT EXISTS `log_password` (
  `username` varchar(7) COLLATE utf8_bin NOT NULL,
  `passwords` longtext COLLATE utf8_bin NOT NULL COMMENT 'old passwords with coma saparated',
  KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `log_sms`
--

CREATE TABLE IF NOT EXISTS `log_sms` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `from_user` varchar(20) COLLATE utf8_bin NOT NULL,
  `to_user` varchar(7) COLLATE utf8_bin NOT NULL,
  `to_no` varchar(20) COLLATE utf8_bin NOT NULL,
  `message` text COLLATE utf8_bin NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL COMMENT '0-pending, 1-outgoing',
  PRIMARY KEY (`id`),
  KEY `to_user` (`to_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `log_sms_incomming`
--

CREATE TABLE IF NOT EXISTS `log_sms_incomming` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from_user` varchar(7) COLLATE utf8_bin NOT NULL,
  `message` varchar(10) COLLATE utf8_bin NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `from` (`from_user`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `mail`
--

CREATE TABLE IF NOT EXISTS `mail` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `root_id` bigint(20) DEFAULT NULL,
  `method` tinyint(4) NOT NULL COMMENT '0.normal,1.reply,2.forward',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `from` varchar(7) COLLATE utf8_bin NOT NULL,
  `to` varchar(7) COLLATE utf8_bin NOT NULL,
  `subject` tinytext COLLATE utf8_bin NOT NULL,
  `message` longtext COLLATE utf8_bin NOT NULL,
  `attachments` text COLLATE utf8_bin,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 - Unread , 1 - Read, 2 - Saved',
  PRIMARY KEY (`id`),
  KEY `from` (`from`),
  KEY `to` (`to`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Internal mails';

-- --------------------------------------------------------

--
-- Table structure for table `mc_leave`
--

CREATE TABLE IF NOT EXISTS `mc_leave` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `leave_id` int(11) NOT NULL COMMENT 'group_id of leave',
  `leave_status` tinyint(1) NOT NULL,
  `read_users` longtext COLLATE utf8_bin COMMENT 'read username will be coma separated',
  PRIMARY KEY (`id`),
  KEY `leave_id` (`leave_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `mc_note`
--

CREATE TABLE IF NOT EXISTS `mc_note` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `note_id` int(11) NOT NULL,
  `read_users` longtext COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  KEY `note_id` (`note_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `memory_slots`
--

CREATE TABLE IF NOT EXISTS `memory_slots` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customer` varchar(7) COLLATE utf8_bin NOT NULL,
  `time_from` float(4,2) NOT NULL,
  `time_to` float(4,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `customer` (`customer`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `message_request_details`
--

CREATE TABLE IF NOT EXISTS `message_request_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` varchar(7) COLLATE utf8_bin NOT NULL,
  `reciever_ids` text COLLATE utf8_bin NOT NULL,
  `message_id` int(11) NOT NULL,
  `accept` text COLLATE utf8_bin NOT NULL,
  `rejet` text COLLATE utf8_bin NOT NULL,
  `read` text COLLATE utf8_bin NOT NULL,
  `apt_time` text COLLATE utf8_bin NOT NULL,
  `rej_time` text COLLATE utf8_bin NOT NULL,
  `read_time` text COLLATE utf8_bin NOT NULL,
  `date` datetime NOT NULL,
  `con_status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  KEY `message_id` (`message_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `message_tm_admin`
--

CREATE TABLE IF NOT EXISTS `message_tm_admin` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `userid` varchar(7) COLLATE utf8_bin NOT NULL,
  `mreq_id` int(11) NOT NULL DEFAULT '0',
  `message_id` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `message_id` (`message_id`),
  KEY `userid` (`userid`),
  KEY `mreq_id` (`mreq_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `note`
--

CREATE TABLE IF NOT EXISTS `note` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_user` varchar(7) COLLATE utf8_bin NOT NULL,
  `customer` varchar(7) COLLATE utf8_bin NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `title` tinytext COLLATE utf8_bin NOT NULL,
  `description` longtext COLLATE utf8_bin NOT NULL,
  `visibility` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 - Public, 2 - Private',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1 - Active, 0 - Forbidden',
  PRIMARY KEY (`id`),
  KEY `created_user` (`created_user`),
  KEY `cusrtomer` (`customer`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `pdf_work_report`
--

CREATE TABLE IF NOT EXISTS `pdf_work_report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jag` tinyint(4) DEFAULT NULL COMMENT '1_Jag får ersättning med förhöjt timbelopp',
  `date` date DEFAULT NULL,
  `customer` varchar(7) COLLATE utf8_bin DEFAULT NULL,
  `organizer` varchar(100) COLLATE utf8_bin DEFAULT NULL COMMENT 'Anordnare (om du anlitar kommunen, ett kooperativ eller ett assistansföretag)',
  `contact_organizer` varchar(100) COLLATE utf8_bin DEFAULT NULL COMMENT 'Kontaktperson hos anordnaren eller administratör för dig som själv anställer dina assistenter',
  `permission_national_board` smallint(6) DEFAULT NULL COMMENT 'Har anordnaren tillstånd från Socialstyrelsen?',
  `provider_ftax` smallint(6) DEFAULT NULL COMMENT '3_Har anordnaren F-skattsedel?',
  `telehone_areacode` varchar(100) COLLATE utf8_bin DEFAULT NULL COMMENT '3_Telefon, även riktnummer',
  `been_hospital_month` smallint(6) DEFAULT NULL COMMENT '4_Har du vårdats på sjukhus eller liknande den här månaden?',
  `from_date` varchar(10) COLLATE utf8_bin DEFAULT NULL COMMENT '4_Från och med',
  `to_date` varchar(10) COLLATE utf8_bin DEFAULT NULL COMMENT '4_Till och med',
  `hospital` varchar(100) COLLATE utf8_bin DEFAULT NULL COMMENT '4_Sjukhus',
  `apply_assistance` tinyint(11) DEFAULT NULL COMMENT '4_Ja, för',
  `hours_included` varchar(100) COLLATE utf8_bin DEFAULT NULL COMMENT '4_timmar som ingår i redovisningen',
  `assistance_allowance_paid` varchar(5) COLLATE utf8_bin DEFAULT NULL COMMENT '6_Har assistansersättningen betalats ut till anordnare?',
  `organizer1` varchar(100) COLLATE utf8_bin DEFAULT NULL COMMENT '6_Anordnare_1',
  `organizer2` varchar(100) COLLATE utf8_bin DEFAULT NULL COMMENT '6_Anordnare_2',
  `ftax1` tinyint(4) DEFAULT NULL COMMENT '6_Har anordnaren F-skattsedel?_1',
  `ftax2` tinyint(4) DEFAULT NULL COMMENT '6_Har anordnaren F-skattsedel?_2',
  `money_left_purchase` int(11) DEFAULT NULL COMMENT '6_Finns det pengar kvar som du inte har använt för att köpa personlig assistans?',
  `money_left` varchar(100) COLLATE utf8_bin DEFAULT NULL COMMENT '6_Kronor',
  PRIMARY KEY (`id`),
  KEY `customer` (`customer`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `privileges`
--

CREATE TABLE IF NOT EXISTS `privileges` (
  `employee` varchar(7) COLLATE utf8_bin NOT NULL,
  `swap` tinyint(1) DEFAULT '0',
  `process` tinyint(1) DEFAULT '0',
  KEY `employee` (`employee`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `report_signing`
--

CREATE TABLE IF NOT EXISTS `report_signing` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `employee` varchar(7) COLLATE utf8_bin NOT NULL,
  `date` date NOT NULL,
  `signin_employee` varchar(7) COLLATE utf8_bin NOT NULL,
  `signin_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `signin_tl` varchar(7) COLLATE utf8_bin NOT NULL,
  `signin_tl_date` timestamp NULL DEFAULT NULL,
  `signin_sutl` varchar(7) COLLATE utf8_bin NOT NULL,
  `signin_sutl_date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `employee` (`employee`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE IF NOT EXISTS `team` (
  `customer` varchar(7) COLLATE utf8_bin NOT NULL,
  `employee` varchar(7) COLLATE utf8_bin NOT NULL,
  `role` tinyint(1) NOT NULL DEFAULT '3' COMMENT '2 - Team leader, 3 - Assistant, 7 - Super TL',
  KEY `customer` (`customer`),
  KEY `employee` (`employee`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `timetable`
--

CREATE TABLE IF NOT EXISTS `timetable` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `employee` varchar(7) COLLATE utf8_bin DEFAULT NULL COMMENT 'login - username',
  `customer` varchar(7) COLLATE utf8_bin DEFAULT NULL COMMENT 'login - username',
  `fkkn` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1-FK, 2-KN',
  `date` date NOT NULL,
  `time_from` float(4,2) NOT NULL,
  `time_to` float(4,2) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0-Normal,1-Travel, 2-Break, 3-on call, 4-overtime, 5-qality overtime, 6-more time, 7-some other time, 8-Training time',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0-forbidden, 1-active, 2-leave, 3-Priliminary',
  `relation_id` bigint(20) DEFAULT NULL,
  `comment` text COLLATE utf8_bin,
  `alloc_emp` varchar(7) COLLATE utf8_bin NOT NULL COMMENT 'login - username (role 1,2)',
  `alloc_comment` text COLLATE utf8_bin,
  `cust_comment` text COLLATE utf8_bin,
  PRIMARY KEY (`id`),
  KEY `alloc_emp` (`alloc_emp`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `user_task`
--

CREATE TABLE IF NOT EXISTS `user_task` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `userid` varchar(10) COLLATE utf8_bin NOT NULL,
  `slotids` text COLLATE utf8_bin NOT NULL,
  `dag` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `dur` time NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `chat_ibfk_1` FOREIGN KEY (`from_chat`) REFERENCES `time2vie_cirruscomdemo`.`login` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chat_ibfk_2` FOREIGN KEY (`to_chat`) REFERENCES `time2vie_cirruscomdemo`.`login` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`username`) REFERENCES `time2vie_cirruscomdemo`.`login` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer_attachment`
--
ALTER TABLE `customer_attachment`
  ADD CONSTRAINT `customer_attachment_ibfk_1` FOREIGN KEY (`customer`) REFERENCES `customer` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer_contract`
--
ALTER TABLE `customer_contract`
  ADD CONSTRAINT `customer_contract_ibfk_1` FOREIGN KEY (`customer`) REFERENCES `customer` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer_contract_billing`
--
ALTER TABLE `customer_contract_billing`
  ADD CONSTRAINT `customer_contract_billing_ibfk_1` FOREIGN KEY (`contract_id`) REFERENCES `customer_contract` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer_contract_decision`
--
ALTER TABLE `customer_contract_decision`
  ADD CONSTRAINT `customer_contract_decision_ibfk_1` FOREIGN KEY (`contract_id`) REFERENCES `customer_contract` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer_documentation`
--
ALTER TABLE `customer_documentation`
  ADD CONSTRAINT `customer_documentation_ibfk_1` FOREIGN KEY (`customer`) REFERENCES `customer` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer_equipment`
--
ALTER TABLE `customer_equipment`
  ADD CONSTRAINT `customer_equipment_ibfk_1` FOREIGN KEY (`customer`) REFERENCES `customer` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer_guardian`
--
ALTER TABLE `customer_guardian`
  ADD CONSTRAINT `customer_guardian_ibfk_1` FOREIGN KEY (`customer`) REFERENCES `customer` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer_health`
--
ALTER TABLE `customer_health`
  ADD CONSTRAINT `customer_health_ibfk_1` FOREIGN KEY (`customer`) REFERENCES `customer` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer_implimentation`
--
ALTER TABLE `customer_implimentation`
  ADD CONSTRAINT `customer_implimentation_ibfk_1` FOREIGN KEY (`customer`) REFERENCES `customer` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer_relative`
--
ALTER TABLE `customer_relative`
  ADD CONSTRAINT `customer_relative_ibfk_1` FOREIGN KEY (`customer`) REFERENCES `customer` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer_work`
--
ALTER TABLE `customer_work`
  ADD CONSTRAINT `customer_work_ibfk_1` FOREIGN KEY (`customer`) REFERENCES `customer` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `devicetokens`
--
ALTER TABLE `devicetokens`
  ADD CONSTRAINT `devicetokens_ibfk_1` FOREIGN KEY (`username`) REFERENCES `time2vie_cirruscomdemo`.`login` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `email`
--
ALTER TABLE `email`
  ADD CONSTRAINT `email_ibfk_1` FOREIGN KEY (`from`) REFERENCES `time2vie_cirruscomdemo`.`login` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`username`) REFERENCES `time2vie_cirruscomdemo`.`login` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employee_attachment`
--
ALTER TABLE `employee_attachment`
  ADD CONSTRAINT `employee_attachment_ibfk_1` FOREIGN KEY (`employee`) REFERENCES `employee` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employee_contract`
--
ALTER TABLE `employee_contract`
  ADD CONSTRAINT `employee_contract_ibfk_1` FOREIGN KEY (`employee`) REFERENCES `time2vie_cirruscomdemo`.`login` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employee_skill`
--
ALTER TABLE `employee_skill`
  ADD CONSTRAINT `employee_skill_ibfk_1` FOREIGN KEY (`employee`) REFERENCES `employee` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `history_certification_report`
--
ALTER TABLE `history_certification_report`
  ADD CONSTRAINT `history_certification_report_ibfk_1` FOREIGN KEY (`employee`) REFERENCES `employee` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `history_sick_report`
--
ALTER TABLE `history_sick_report`
  ADD CONSTRAINT `history_sick_report_ibfk_1` FOREIGN KEY (`employee`) REFERENCES `employee` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `history_sick_report_ibfk_2` FOREIGN KEY (`customer`) REFERENCES `customer` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `leave`
--
ALTER TABLE `leave`
  ADD CONSTRAINT `leave_ibfk_1` FOREIGN KEY (`employee`) REFERENCES `employee` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `leave_ibfk_2` FOREIGN KEY (`appr_emp`) REFERENCES `employee` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `leave_notification`
--
ALTER TABLE `leave_notification`
  ADD CONSTRAINT `leave_notification_ibfk_1` FOREIGN KEY (`employee`) REFERENCES `employee` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `leave_sms`
--
ALTER TABLE `leave_sms`
  ADD CONSTRAINT `leave_sms_ibfk_1` FOREIGN KEY (`slot`) REFERENCES `timetable` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `leave_sms_ibfk_2` FOREIGN KEY (`employee`) REFERENCES `employee` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `leave_sms_ibfk_3` FOREIGN KEY (`alloc_employee`) REFERENCES `employee` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `log_login`
--
ALTER TABLE `log_login`
  ADD CONSTRAINT `log_login_ibfk_1` FOREIGN KEY (`username`) REFERENCES `time2vie_cirruscomdemo`.`login` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `log_password`
--
ALTER TABLE `log_password`
  ADD CONSTRAINT `log_password_ibfk_1` FOREIGN KEY (`username`) REFERENCES `time2vie_cirruscomdemo`.`login` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `log_sms`
--
ALTER TABLE `log_sms`
  ADD CONSTRAINT `log_sms_ibfk_1` FOREIGN KEY (`to_user`) REFERENCES `time2vie_cirruscomdemo`.`login` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mail`
--
ALTER TABLE `mail`
  ADD CONSTRAINT `mail_ibfk_1` FOREIGN KEY (`from`) REFERENCES `time2vie_cirruscomdemo`.`login` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mail_ibfk_2` FOREIGN KEY (`to`) REFERENCES `time2vie_cirruscomdemo`.`login` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mc_leave`
--
ALTER TABLE `mc_leave`
  ADD CONSTRAINT `mc_leave_ibfk_1` FOREIGN KEY (`leave_id`) REFERENCES `leave` (`group_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mc_note`
--
ALTER TABLE `mc_note`
  ADD CONSTRAINT `mc_note_ibfk_1` FOREIGN KEY (`note_id`) REFERENCES `note` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `message_request_details`
--
ALTER TABLE `message_request_details`
  ADD CONSTRAINT `message_request_details_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `employee` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `message_tm_admin`
--
ALTER TABLE `message_tm_admin`
  ADD CONSTRAINT `message_tm_admin_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `employee` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `message_tm_admin_ibfk_3` FOREIGN KEY (`mreq_id`) REFERENCES `message_request_details` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `note`
--
ALTER TABLE `note`
  ADD CONSTRAINT `note_ibfk_1` FOREIGN KEY (`created_user`) REFERENCES `employee` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `note_ibfk_2` FOREIGN KEY (`customer`) REFERENCES `customer` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pdf_work_report`
--
ALTER TABLE `pdf_work_report`
  ADD CONSTRAINT `pdf_work_report_ibfk_1` FOREIGN KEY (`customer`) REFERENCES `customer` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `privileges`
--
ALTER TABLE `privileges`
  ADD CONSTRAINT `privileges_ibfk_1` FOREIGN KEY (`employee`) REFERENCES `employee` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `report_signing`
--
ALTER TABLE `report_signing`
  ADD CONSTRAINT `report_signing_ibfk_1` FOREIGN KEY (`employee`) REFERENCES `employee` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `team`
--
ALTER TABLE `team`
  ADD CONSTRAINT `team_ibfk_1` FOREIGN KEY (`customer`) REFERENCES `customer` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `team_ibfk_2` FOREIGN KEY (`employee`) REFERENCES `employee` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `timetable`
--
ALTER TABLE `timetable`
  ADD CONSTRAINT `timetable_ibfk_1` FOREIGN KEY (`alloc_emp`) REFERENCES `time2vie_cirruscomdemo`.`login` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
