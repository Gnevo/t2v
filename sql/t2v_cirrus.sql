-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 01, 2014 at 06:10 PM
-- Server version: 5.5.31
-- PHP Version: 5.3.10-1ubuntu3.10

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
-- Table structure for table `atl_warnings`
--

CREATE TABLE IF NOT EXISTS `atl_warnings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee` varchar(7) COLLATE utf8_swedish_ci NOT NULL,
  `date` date NOT NULL,
  `time_from` float(4,2) NOT NULL,
  `time_to` float(4,2) NOT NULL,
  `customer` varchar(7) COLLATE utf8_swedish_ci NOT NULL,
  `extra_hours` float(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `employee` (`employee`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=320 ;

-- --------------------------------------------------------

--
-- Table structure for table `billing`
--

CREATE TABLE IF NOT EXISTS `billing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_number` varchar(25) COLLATE utf8_swedish_ci DEFAULT NULL,
  `bill_date` date NOT NULL,
  `no_active_customers` int(11) NOT NULL DEFAULT '0',
  `price_per_customer` float NOT NULL DEFAULT '0',
  `no_sms` int(11) NOT NULL DEFAULT '0',
  `price_per_sms` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE IF NOT EXISTS `chat` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `from_chat` varchar(7) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `to_chat` varchar(7) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `message` text COLLATE utf8_swedish_ci,
  `sent` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `recd` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `from_chat` (`from_chat`),
  KEY `to_chat` (`to_chat`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=56 ;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `username` varchar(7) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `code` varchar(10) COLLATE utf8_swedish_ci DEFAULT NULL,
  `first_name` varchar(30) COLLATE utf8_swedish_ci DEFAULT NULL,
  `last_name` varchar(40) COLLATE utf8_swedish_ci DEFAULT NULL,
  `gender` tinyint(4) NOT NULL DEFAULT '1',
  `century` int(2) NOT NULL DEFAULT '19' COMMENT 'birth of century',
  `social_security` varchar(10) COLLATE utf8_swedish_ci DEFAULT NULL,
  `address` text COLLATE utf8_swedish_ci,
  `city` varchar(50) COLLATE utf8_swedish_ci DEFAULT NULL,
  `post` varchar(10) COLLATE utf8_swedish_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8_swedish_ci DEFAULT NULL,
  `mobile` varchar(20) COLLATE utf8_swedish_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_swedish_ci DEFAULT NULL,
  `date` date NOT NULL,
  `date_inactive` date DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0-disabled, 1-active',
  `fkkn` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1-fk,2-kn',
  PRIMARY KEY (`username`),
  UNIQUE KEY `social_security` (`social_security`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_appoiments`
--

CREATE TABLE IF NOT EXISTS `customer_appoiments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer` varchar(216) COLLATE utf8_swedish_ci DEFAULT NULL,
  `appoiment_date` datetime DEFAULT NULL,
  `appoiment_address` blob,
  `phone_number` double DEFAULT NULL,
  `reason` varchar(2295) COLLATE utf8_swedish_ci DEFAULT NULL,
  `remarks` blob,
  `contact_person_name` varchar(2295) COLLATE utf8_swedish_ci DEFAULT NULL,
  `phone_number_cp` varchar(2295) COLLATE utf8_swedish_ci DEFAULT NULL,
  `email_cp` varchar(2295) COLLATE utf8_swedish_ci DEFAULT NULL,
  `reminder_before_date` varchar(2295) COLLATE utf8_swedish_ci DEFAULT NULL,
  `reminder_time` varchar(45) COLLATE utf8_swedish_ci DEFAULT NULL,
  `repeat_until_due_date` varchar(9) COLLATE utf8_swedish_ci DEFAULT NULL,
  `email_alert` varchar(9) COLLATE utf8_swedish_ci DEFAULT NULL,
  `cust_email` varchar(2295) COLLATE utf8_swedish_ci DEFAULT NULL,
  `sms_alert` varchar(9) COLLATE utf8_swedish_ci DEFAULT NULL,
  `cust_number` varchar(2295) COLLATE utf8_swedish_ci DEFAULT NULL,
  `last_alert_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `customer_attachment`
--

CREATE TABLE IF NOT EXISTS `customer_attachment` (
  `customer` varchar(7) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `documents` text COLLATE utf8_swedish_ci,
  KEY `customer` (`customer`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_contract`
--

CREATE TABLE IF NOT EXISTS `customer_contract` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `customer` varchar(7) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `date_from` date NOT NULL COMMENT 'date from',
  `date_to` date NOT NULL COMMENT 'date to',
  `hour` float(10,2) NOT NULL COMMENT 'total hours alloted',
  `fkkn` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1-fk,2-kn',
  PRIMARY KEY (`id`),
  KEY `customer` (`customer`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=37 ;

-- --------------------------------------------------------

--
-- Table structure for table `customer_contract_billing`
--

CREATE TABLE IF NOT EXISTS `customer_contract_billing` (
  `contract_id` bigint(20) NOT NULL,
  `first_name` varchar(30) COLLATE utf8_swedish_ci DEFAULT NULL,
  `last_name` varchar(40) COLLATE utf8_swedish_ci DEFAULT NULL,
  `mobile` varchar(20) COLLATE utf8_swedish_ci DEFAULT NULL,
  `email` varchar(80) COLLATE utf8_swedish_ci DEFAULT NULL,
  `city` varchar(30) COLLATE utf8_swedish_ci DEFAULT NULL,
  `oncall` tinyint(1) DEFAULT NULL,
  `awake` tinyint(1) DEFAULT NULL,
  `oncall2` tinyint(1) DEFAULT NULL,
  `iss` tinyint(1) DEFAULT NULL COMMENT '1 for iss in KN',
  `sol` tinyint(1) DEFAULT NULL COMMENT '1for sol in KN',
  `something` tinyint(1) DEFAULT NULL,
  `comments` text COLLATE utf8_swedish_ci,
  `kn_name` varchar(50) COLLATE utf8_swedish_ci DEFAULT NULL,
  `kn_address` varchar(100) COLLATE utf8_swedish_ci DEFAULT NULL,
  `kn_postno` int(11) DEFAULT NULL,
  `kn_reference_no` varchar(15) COLLATE utf8_swedish_ci DEFAULT NULL,
  `kn_box` varchar(15) COLLATE utf8_swedish_ci DEFAULT NULL,
  KEY `contract_id` (`contract_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_contract_decision`
--

CREATE TABLE IF NOT EXISTS `customer_contract_decision` (
  `contract_id` bigint(20) NOT NULL,
  `first_name` varchar(30) COLLATE utf8_swedish_ci DEFAULT NULL,
  `last_name` varchar(40) COLLATE utf8_swedish_ci DEFAULT NULL,
  `mobile` varchar(20) COLLATE utf8_swedish_ci DEFAULT NULL,
  `email` varchar(80) COLLATE utf8_swedish_ci DEFAULT NULL,
  `city` varchar(30) COLLATE utf8_swedish_ci DEFAULT NULL,
  `comments_time` text COLLATE utf8_swedish_ci,
  `comments_other` text COLLATE utf8_swedish_ci,
  `documents` text COLLATE utf8_swedish_ci,
  KEY `contract_id` (`contract_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_documentation`
--

CREATE TABLE IF NOT EXISTS `customer_documentation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer` varchar(7) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `completed_date` timestamp NULL DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8_swedish_ci DEFAULT NULL,
  `employee` varchar(7) COLLATE utf8_swedish_ci DEFAULT NULL,
  `note_type` varchar(30) COLLATE utf8_swedish_ci DEFAULT NULL,
  `notes` text COLLATE utf8_swedish_ci,
  `priority` varchar(15) COLLATE utf8_swedish_ci DEFAULT NULL,
  `description` text COLLATE utf8_swedish_ci,
  `status` varchar(10) COLLATE utf8_swedish_ci DEFAULT NULL,
  `writable` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `customer` (`customer`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=72 ;

-- --------------------------------------------------------

--
-- Table structure for table `customer_equipment`
--

CREATE TABLE IF NOT EXISTS `customer_equipment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `equipment` varchar(255) COLLATE utf8_swedish_ci DEFAULT NULL,
  `serial_number` varchar(50) COLLATE utf8_swedish_ci DEFAULT NULL,
  `customer` varchar(7) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `employee` varchar(7) COLLATE utf8_swedish_ci DEFAULT NULL,
  `issue_date` date NOT NULL,
  `return_date` date DEFAULT NULL,
  `remarks` tinytext COLLATE utf8_swedish_ci,
  PRIMARY KEY (`id`),
  KEY `customer` (`customer`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=39 ;

-- --------------------------------------------------------

--
-- Table structure for table `customer_guardian`
--

CREATE TABLE IF NOT EXISTS `customer_guardian` (
  `customer` varchar(7) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `first_name` varchar(20) COLLATE utf8_swedish_ci DEFAULT NULL,
  `last_name` varchar(30) COLLATE utf8_swedish_ci DEFAULT NULL,
  `mobile` varchar(20) COLLATE utf8_swedish_ci DEFAULT NULL,
  `email` varchar(80) COLLATE utf8_swedish_ci DEFAULT NULL,
  `address` text CHARACTER SET utf8 COLLATE utf8_bin,
  `first_name2` varchar(30) COLLATE utf8_swedish_ci DEFAULT NULL,
  `last_name2` varchar(30) COLLATE utf8_swedish_ci DEFAULT NULL,
  `mobile2` varchar(20) COLLATE utf8_swedish_ci DEFAULT NULL,
  `email2` varchar(80) COLLATE utf8_swedish_ci DEFAULT NULL,
  `address2` text CHARACTER SET utf8 COLLATE utf8_bin,
  KEY `customer` (`customer`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_health`
--

CREATE TABLE IF NOT EXISTS `customer_health` (
  `customer` varchar(7) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `health_care` longtext COLLATE utf8_swedish_ci,
  `occupational_therapists` longtext COLLATE utf8_swedish_ci,
  `physiotherapists` longtext COLLATE utf8_swedish_ci,
  `other` longtext COLLATE utf8_swedish_ci,
  KEY `customer` (`customer`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_implimentation`
--

CREATE TABLE IF NOT EXISTS `customer_implimentation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer` varchar(7) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `history` text COLLATE utf8_swedish_ci,
  `diagnosis` text COLLATE utf8_swedish_ci,
  `mission` text COLLATE utf8_swedish_ci,
  `intervention` text COLLATE utf8_swedish_ci,
  `travel` varchar(50) COLLATE utf8_swedish_ci DEFAULT NULL,
  `work` varchar(20) COLLATE utf8_swedish_ci DEFAULT NULL,
  `email` varchar(80) COLLATE utf8_swedish_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8_swedish_ci DEFAULT NULL,
  `work_comment` text COLLATE utf8_swedish_ci,
  `travel_comment` text COLLATE utf8_swedish_ci,
  `writable` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `customer` (`customer`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=66 ;

-- --------------------------------------------------------

--
-- Table structure for table `customer_relative`
--

CREATE TABLE IF NOT EXISTS `customer_relative` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `customer` varchar(7) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `name` varchar(60) COLLATE utf8_swedish_ci DEFAULT NULL,
  `relation` varchar(30) COLLATE utf8_swedish_ci DEFAULT NULL,
  `address` tinytext COLLATE utf8_swedish_ci,
  `city` varchar(50) COLLATE utf8_swedish_ci DEFAULT NULL,
  `phone` varchar(30) COLLATE utf8_swedish_ci DEFAULT NULL,
  `work_phone` varchar(30) COLLATE utf8_swedish_ci DEFAULT NULL,
  `mobile` varchar(20) COLLATE utf8_swedish_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_swedish_ci DEFAULT NULL,
  `other` text COLLATE utf8_swedish_ci,
  PRIMARY KEY (`id`),
  KEY `customer` (`customer`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `customer_work`
--

CREATE TABLE IF NOT EXISTS `customer_work` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer` varchar(7) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `work` text COLLATE utf8_swedish_ci,
  `history` text COLLATE utf8_swedish_ci,
  `clinical_picture` text COLLATE utf8_swedish_ci,
  `medications` text COLLATE utf8_swedish_ci,
  `devolution` varchar(10) COLLATE utf8_swedish_ci DEFAULT NULL,
  `special_diet` text COLLATE utf8_swedish_ci,
  `writable` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `customer` (`customer`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=26 ;

-- --------------------------------------------------------

--
-- Table structure for table `delete_google_calender`
--

CREATE TABLE IF NOT EXISTS `delete_google_calender` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `google_id` varchar(30) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `devicetokens`
--

CREATE TABLE IF NOT EXISTS `devicetokens` (
  `username` varchar(7) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `devicetoken` tinytext COLLATE utf8_swedish_ci,
  KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email`
--

CREATE TABLE IF NOT EXISTS `email` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `from` varchar(7) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `to` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `subject` tinytext COLLATE utf8_swedish_ci,
  `message` longtext COLLATE utf8_swedish_ci,
  PRIMARY KEY (`id`),
  KEY `from` (`from`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci COMMENT='Internal mails' AUTO_INCREMENT=52 ;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE IF NOT EXISTS `employee` (
  `username` varchar(7) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `century` int(2) NOT NULL DEFAULT '19' COMMENT 'birth of century',
  `code` varchar(10) COLLATE utf8_swedish_ci DEFAULT NULL,
  `social_security` varchar(10) COLLATE utf8_swedish_ci DEFAULT NULL,
  `first_name` varchar(30) COLLATE utf8_swedish_ci DEFAULT NULL,
  `last_name` varchar(40) COLLATE utf8_swedish_ci DEFAULT NULL,
  `gender` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `address` text COLLATE utf8_swedish_ci,
  `city` varchar(50) COLLATE utf8_swedish_ci DEFAULT NULL,
  `post` varchar(10) COLLATE utf8_swedish_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8_swedish_ci DEFAULT NULL,
  `mobile` varchar(20) COLLATE utf8_swedish_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_swedish_ci DEFAULT NULL,
  `date` date NOT NULL,
  `date_inactive` date DEFAULT NULL,
  `color` varchar(7) COLLATE utf8_swedish_ci DEFAULT '#FFFFFF',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0-disabled, 1-Active',
  `prv_swap` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0. do not have privilege for swapping the slot, 1. have privilege for swapping the slot',
  `max_hours` float(8,2) DEFAULT NULL,
  `monthly_salary` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1-monthly salary',
  `start_day` varchar(6) COLLATE utf8_swedish_ci DEFAULT NULL COMMENT 'day starting of an employee',
  UNIQUE KEY `social_secutrity` (`social_security`),
  KEY `username` (`username`),
  KEY `status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee_attachment`
--

CREATE TABLE IF NOT EXISTS `employee_attachment` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `employee` varchar(7) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `documents` varchar(255) COLLATE utf8_swedish_ci DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `employee` (`employee`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=37 ;

-- --------------------------------------------------------

--
-- Table structure for table `employee_contract`
--

CREATE TABLE IF NOT EXISTS `employee_contract` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee` varchar(7) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `date_from` date NOT NULL COMMENT 'date from',
  `date_to` date DEFAULT NULL COMMENT 'date to',
  `hour` float(10,2) DEFAULT NULL COMMENT 'weekly normal hours',
  `monthly_oncall_hour` float(10,2) DEFAULT NULL COMMENT 'monthly maximum oncall hours for contract checking',
  `customer_name` varchar(50) COLLATE utf8_swedish_ci DEFAULT NULL,
  `customer_social_secutrity` varchar(10) COLLATE utf8_swedish_ci DEFAULT NULL,
  `tmp_long_assistance_from` date DEFAULT NULL,
  `tmp_long_assistance_to` date DEFAULT NULL,
  `tmp_assistance_for` varchar(255) COLLATE utf8_swedish_ci DEFAULT NULL,
  `absence_from` date DEFAULT NULL,
  `absence_to` date DEFAULT NULL,
  `special_appointment` tinyint(1) DEFAULT NULL,
  `probationary_from` date DEFAULT NULL,
  `probationary_to` date DEFAULT NULL,
  `open_ended_appointment` tinyint(1) DEFAULT NULL,
  `prevailing_collective` varchar(50) COLLATE utf8_swedish_ci DEFAULT NULL,
  `fulltime` tinyint(1) DEFAULT NULL,
  `part_time` float(4,2) DEFAULT NULL,
  `salary_month` float(10,2) DEFAULT NULL,
  `salary_hour` float(10,2) DEFAULT NULL,
  `incl_salary` tinyint(1) DEFAULT NULL,
  `excl_salary` tinyint(1) DEFAULT NULL,
  `incl_wages` tinyint(1) DEFAULT NULL,
  `act_salary` float(10,2) DEFAULT NULL,
  `bank_account` varchar(30) COLLATE utf8_swedish_ci DEFAULT NULL,
  `leave_per_year` varchar(50) COLLATE utf8_swedish_ci DEFAULT NULL,
  `incl_holiday_pay` tinyint(1) DEFAULT NULL,
  `excl_holiday_pay` tinyint(1) DEFAULT NULL,
  `incl_salary_compensation` varchar(20) COLLATE utf8_swedish_ci DEFAULT NULL,
  `special_condition` tinytext COLLATE utf8_swedish_ci,
  `notes` tinytext COLLATE utf8_swedish_ci,
  `alloc_employee` varchar(7) COLLATE utf8_swedish_ci DEFAULT NULL,
  `alloc_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'contract creating date',
  `sign_date` timestamp NULL DEFAULT NULL COMMENT 'contract signing date',
  PRIMARY KEY (`id`),
  KEY `employee` (`employee`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=68 ;

-- --------------------------------------------------------

--
-- Table structure for table `employee_salary`
--

CREATE TABLE IF NOT EXISTS `employee_salary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee` varchar(7) COLLATE utf8_bin NOT NULL,
  `effect_from` date NOT NULL,
  `effect_to` date NOT NULL,
  `normal` float(6,2) NOT NULL,
  `travel` float(6,2) NOT NULL,
  `break` float(6,2) NOT NULL,
  `oncall` float(6,2) NOT NULL,
  `overtime` float(6,2) NOT NULL,
  `quality_overtime` float(6,2) NOT NULL,
  `more_time` float(6,2) NOT NULL,
  `some_other_time` float(6,2) NOT NULL,
  `training_time` float(6,2) NOT NULL,
  `call_training` float(6,2) NOT NULL,
  `personal_meeting` float(6,2) NOT NULL,
  `voluntary` float(6,2) NOT NULL DEFAULT '0.00',
  `complementary` float(6,2) NOT NULL DEFAULT '0.00',
  `complementary_oncall` float(6,2) NOT NULL DEFAULT '0.00',
  `holiday_big` float(6,2) NOT NULL COMMENT 'Big Holiday',
  `holiday_red` float(6,2) NOT NULL COMMENT 'Holiday',
  `insurance` float(12,2) NOT NULL,
  `clone_from` int(11) DEFAULT NULL,
  `increment_percentage` float(6,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `employee` (`employee`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=40 ;

-- --------------------------------------------------------

--
-- Table structure for table `employee_salary_inconvenient`
--

CREATE TABLE IF NOT EXISTS `employee_salary_inconvenient` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee` varchar(7) COLLATE utf8_bin NOT NULL,
  `inconvenient_group_id` int(11) NOT NULL,
  `effect_from` date NOT NULL,
  `effect_to` date DEFAULT NULL,
  `amount` float(6,2) NOT NULL,
  `clone_from` int(11) DEFAULT NULL,
  `increment_percentage` float(6,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `inconvenient_group_id` (`inconvenient_group_id`),
  KEY `employee` (`employee`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=231 ;

-- --------------------------------------------------------

--
-- Table structure for table `employee_skill`
--

CREATE TABLE IF NOT EXISTS `employee_skill` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `employee` varchar(7) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `skill` varchar(100) COLLATE utf8_swedish_ci DEFAULT NULL,
  `description` text COLLATE utf8_swedish_ci,
  PRIMARY KEY (`id`),
  KEY `employee` (`employee`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=17 ;

-- --------------------------------------------------------

--
-- Table structure for table `emp_inconvinient_time`
--

CREATE TABLE IF NOT EXISTS `emp_inconvinient_time` (
  `time_id` double NOT NULL AUTO_INCREMENT,
  `emp_username` varchar(765) COLLATE utf8_swedish_ci DEFAULT NULL,
  `inconvinient_evening` float DEFAULT NULL,
  `inconvinient_night` float DEFAULT NULL,
  `inconvinient_holiday` float DEFAULT NULL,
  `on_call_holiday` float DEFAULT NULL,
  `on_call_bigholiday` float DEFAULT NULL,
  `on_call` float DEFAULT NULL,
  `inconvinient_week_holiday` float DEFAULT NULL,
  `date_from` date DEFAULT NULL,
  `date_to` date DEFAULT NULL,
  `added_by` varchar(765) COLLATE utf8_swedish_ci DEFAULT NULL,
  PRIMARY KEY (`time_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=117 ;

-- --------------------------------------------------------

--
-- Table structure for table `emp_preferred_time`
--

CREATE TABLE IF NOT EXISTS `emp_preferred_time` (
  `timeid` int(11) NOT NULL AUTO_INCREMENT,
  `employee` varchar(7) COLLATE utf8_bin NOT NULL,
  `fromdate` date DEFAULT NULL,
  `todate` date DEFAULT NULL,
  PRIMARY KEY (`timeid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `emp_preferred_time_slot`
--

CREATE TABLE IF NOT EXISTS `emp_preferred_time_slot` (
  `slotid` int(11) NOT NULL,
  `day` enum('1','2','3','4','5','6','7') COLLATE utf8_bin NOT NULL,
  `preferredtime` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `overtime` enum('0','1') COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `emp_salary`
--

CREATE TABLE IF NOT EXISTS `emp_salary` (
  `salaryId` double NOT NULL AUTO_INCREMENT,
  `emp_username` varchar(765) COLLATE utf8_swedish_ci DEFAULT NULL,
  `salary_per_month` float DEFAULT NULL,
  `salary_per_hour` float DEFAULT NULL,
  `date_from` date DEFAULT NULL,
  `date_to` date DEFAULT NULL,
  `added_by` varchar(765) COLLATE utf8_swedish_ci DEFAULT NULL,
  PRIMARY KEY (`salaryId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=72 ;

-- --------------------------------------------------------

--
-- Table structure for table `exports_lon`
--

CREATE TABLE IF NOT EXISTS `exports_lon` (
  `year` int(11) NOT NULL,
  `app` varchar(255) COLLATE utf8_swedish_ci DEFAULT NULL,
  `month` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `employee` varchar(7) COLLATE utf8_swedish_ci DEFAULT NULL,
  `employeeName` varchar(45) COLLATE utf8_swedish_ci DEFAULT NULL,
  `filename` varchar(64) COLLATE utf8_swedish_ci DEFAULT NULL,
  `employees` text COLLATE utf8_swedish_ci NOT NULL,
  `employee_exported` varchar(7) COLLATE utf8_swedish_ci NOT NULL,
  `customers` text COLLATE utf8_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `export_lon_config`
--

CREATE TABLE IF NOT EXISTS `export_lon_config` (
  `internal` varchar(16) COLLATE utf8_swedish_ci DEFAULT NULL,
  `external` varchar(16) COLLATE utf8_swedish_ci DEFAULT NULL,
  `monthly` varchar(16) COLLATE utf8_swedish_ci DEFAULT NULL,
  UNIQUE KEY `internal` (`internal`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `export_lon_mail`
--

CREATE TABLE IF NOT EXISTS `export_lon_mail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee` varchar(7) COLLATE utf8_bin NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `send_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `export_lon_sms`
--

CREATE TABLE IF NOT EXISTS `export_lon_sms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee` varchar(7) COLLATE utf8_bin NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `send_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `fkkn_form_defaults`
--

CREATE TABLE IF NOT EXISTS `fkkn_form_defaults` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer` varchar(7) COLLATE utf8_bin NOT NULL,
  `bargaining` tinyint(4) DEFAULT NULL COMMENT 'Section 5 choice',
  `other_bargaining_text` text COLLATE utf8_bin COMMENT 'Section 5 Other options text',
  `agreement_types` varchar(7) COLLATE utf8_bin DEFAULT NULL COMMENT 'Format: choice1||choice2||choice3 (Section 6)',
  `agreement_type2_company` varchar(30) COLLATE utf8_bin DEFAULT NULL COMMENT 'Section 6 - company Name',
  `agreement_type2_orgNo` varchar(25) COLLATE utf8_bin DEFAULT NULL COMMENT 'Section 6 -  Organization Number',
  `employer_role` varchar(75) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='To save previous Form values' AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Table structure for table `general_customer_employee_settings`
--

CREATE TABLE IF NOT EXISTS `general_customer_employee_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `settings_owner` varchar(7) COLLATE utf8_bin NOT NULL,
  `customer` varchar(7) COLLATE utf8_bin DEFAULT NULL,
  `employee` varchar(7) COLLATE utf8_bin DEFAULT NULL,
  `dont_show_slot_operation_flag` tinyint(1) DEFAULT NULL COMMENT 'flag used in slot-drop, slot manual entry, employee-assignment',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='General settings for customer-employee relationship' AUTO_INCREMENT=57 ;

-- --------------------------------------------------------

--
-- Table structure for table `global_setting`
--

CREATE TABLE IF NOT EXISTS `global_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `schedule_time_diff` int(5) NOT NULL DEFAULT '15',
  `emp_max_hours` float(8,2) NOT NULL DEFAULT '480.00',
  `maxhours_per_week` float(8,2) DEFAULT NULL,
  `max_overtime` float(8,2) NOT NULL,
  `insurance_personal` float(8,2) NOT NULL DEFAULT '0.00',
  `insurance_subsitute` float(8,2) NOT NULL DEFAULT '0.00',
  `on_call` float(8,2) DEFAULT '0.00',
  `inconvinient_evening` float(8,2) DEFAULT '0.00',
  `inconvinient_night` float(8,2) DEFAULT '0.00',
  `inconvinient_holiday` float(8,2) DEFAULT '0.00',
  `inconvinient_week_holiday` float(8,2) DEFAULT '0.00',
  `on_call_holiday` float(8,2) DEFAULT '0.00',
  `on_call_bigholiday` float(8,2) DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=72 ;

-- --------------------------------------------------------

--
-- Table structure for table `history_certification_report`
--

CREATE TABLE IF NOT EXISTS `history_certification_report` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `employee` varchar(7) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `file` varchar(80) COLLATE utf8_swedish_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `employee` (`employee`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `history_samsida_work_report`
--

CREATE TABLE IF NOT EXISTS `history_samsida_work_report` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `fkkn` tinyint(1) NOT NULL COMMENT '1-FK, 2-KN',
  `customer` varchar(7) COLLATE utf8_bin NOT NULL,
  `employee` varchar(7) COLLATE utf8_bin DEFAULT NULL,
  `generated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `file_name` varchar(80) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `customer` (`customer`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='For Time management assistant bill (samsida) report' AUTO_INCREMENT=120 ;

-- --------------------------------------------------------

--
-- Table structure for table `history_sick_report`
--

CREATE TABLE IF NOT EXISTS `history_sick_report` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `employee` varchar(7) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `customer` varchar(7) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `file` varchar(80) COLLATE utf8_swedish_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `employee` (`employee`),
  KEY `customer` (`customer`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=46 ;

-- --------------------------------------------------------

--
-- Table structure for table `holiday_block`
--

CREATE TABLE IF NOT EXISTS `holiday_block` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `block_master_id` int(6) NOT NULL COMMENT 'holiday_blok -> id',
  `day` int(11) NOT NULL,
  `type` tinyint(1) NOT NULL COMMENT '1-Red day, 2-Big day',
  PRIMARY KEY (`id`),
  KEY `block_master_id` (`block_master_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=199 ;

-- --------------------------------------------------------

--
-- Table structure for table `holiday_block_master`
--

CREATE TABLE IF NOT EXISTS `holiday_block_master` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_swedish_ci NOT NULL,
  `group_id` int(11) NOT NULL,
  `effect_from` int(4) NOT NULL,
  `effect_to` int(4) DEFAULT NULL,
  `date_from` varchar(5) COLLATE utf8_swedish_ci NOT NULL,
  `date_to` varchar(5) COLLATE utf8_swedish_ci NOT NULL,
  `start_time` float(4,2) NOT NULL,
  `end_time` float(4,2) NOT NULL,
  `type` tinyint(1) NOT NULL COMMENT '1-Holiday, 2-Big Holiday',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=30 ;

-- --------------------------------------------------------

--
-- Table structure for table `inconvenient_timing`
--

CREATE TABLE IF NOT EXISTS `inconvenient_timing` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `root_id` int(6) NOT NULL DEFAULT '0',
  `group_id` int(11) NOT NULL COMMENT 'gruop all cloned inconvenients of one type into one group',
  `name` varchar(50) COLLATE utf8_swedish_ci DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 - Normal, 3 - Oncall',
  `effect_from` date NOT NULL COMMENT 'effect from date',
  `effect_to` date DEFAULT NULL COMMENT 'effect to date',
  `time_from` float(4,2) NOT NULL,
  `time_to` float(4,2) NOT NULL,
  `days` varchar(30) COLLATE utf8_swedish_ci DEFAULT NULL,
  `amount` float(6,2) NOT NULL,
  `nature` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 - descret, 1- contigeous',
  PRIMARY KEY (`id`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=114 ;

-- --------------------------------------------------------

--
-- Table structure for table `leave`
--

CREATE TABLE IF NOT EXISTS `leave` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_pay` tinyint(1) NOT NULL DEFAULT '1',
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
  KEY `group_id` (`group_id`),
  KEY `date` (`date`),
  KEY `status` (`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=571 ;

-- --------------------------------------------------------

--
-- Table structure for table `leave_notification`
--

CREATE TABLE IF NOT EXISTS `leave_notification` (
  `employee` varchar(7) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'employee username',
  `email` varchar(30) COLLATE utf8_swedish_ci DEFAULT NULL,
  `mobile` varchar(30) COLLATE utf8_swedish_ci DEFAULT NULL,
  KEY `employee` (`employee`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leave_sms`
--

CREATE TABLE IF NOT EXISTS `leave_sms` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `slot` bigint(20) NOT NULL,
  `employee` varchar(7) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `send_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0-pending with confirmation sender, 1- accept, 2-rejected, 3-received yes, 4-pending with confirmation sender 1, 5- pending withot confirmation, 6- pending without conf sender1, 7 - pending without conf  rej=1, 8- pending without conf sender=1 reje=1',
  `receive_time` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `message` text COLLATE utf8_swedish_ci,
  `alloc_employee` varchar(7) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  KEY `slot` (`slot`),
  KEY `employee` (`employee`),
  KEY `alloc_employee` (`alloc_employee`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `log_login`
--

CREATE TABLE IF NOT EXISTS `log_login` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `username` varchar(7) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `login_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'login time stamp',
  `logout_time` timestamp NULL DEFAULT NULL COMMENT 'logout time stamp',
  `ip` varchar(25) COLLATE utf8_swedish_ci DEFAULT NULL,
  `browser` varchar(255) COLLATE utf8_swedish_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=7064 ;

-- --------------------------------------------------------

--
-- Table structure for table `log_password`
--

CREATE TABLE IF NOT EXISTS `log_password` (
  `username` varchar(7) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `passwords` longtext COLLATE utf8_swedish_ci,
  KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log_sms`
--

CREATE TABLE IF NOT EXISTS `log_sms` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `from_user` varchar(20) COLLATE utf8_swedish_ci DEFAULT NULL,
  `to_user` varchar(7) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `to_no` varchar(20) COLLATE utf8_swedish_ci DEFAULT NULL,
  `message` text COLLATE utf8_swedish_ci,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL COMMENT '0-pending, 1-outgoing',
  PRIMARY KEY (`id`),
  KEY `to_user` (`to_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=286 ;

-- --------------------------------------------------------

--
-- Table structure for table `log_sms_incomming`
--

CREATE TABLE IF NOT EXISTS `log_sms_incomming` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from_user` varchar(7) COLLATE utf8_swedish_ci DEFAULT NULL,
  `message` varchar(10) COLLATE utf8_swedish_ci DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `from` (`from_user`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `mail`
--

CREATE TABLE IF NOT EXISTS `mail` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `root_id` bigint(20) DEFAULT NULL,
  `method` tinyint(4) NOT NULL COMMENT '0.normal,1.reply,2.forward',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `from` varchar(7) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `to` varchar(7) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `subject` tinytext COLLATE utf8_swedish_ci,
  `message` longtext COLLATE utf8_swedish_ci,
  `attachments` text COLLATE utf8_swedish_ci,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 - Unread , 1 - Read, 2 - Saved',
  PRIMARY KEY (`id`),
  KEY `from` (`from`),
  KEY `to` (`to`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci COMMENT='Internal mails' AUTO_INCREMENT=170 ;

-- --------------------------------------------------------

--
-- Table structure for table `mc_leave`
--

CREATE TABLE IF NOT EXISTS `mc_leave` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `leave_id` int(11) NOT NULL COMMENT 'group_id of leave',
  `leave_status` tinyint(1) NOT NULL,
  `read_users` longtext COLLATE utf8_swedish_ci,
  PRIMARY KEY (`id`),
  KEY `leave_id` (`leave_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=1001 ;

-- --------------------------------------------------------

--
-- Table structure for table `mc_note`
--

CREATE TABLE IF NOT EXISTS `mc_note` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `note_id` int(11) NOT NULL,
  `read_users` longtext COLLATE utf8_swedish_ci,
  PRIMARY KEY (`id`),
  KEY `note_id` (`note_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=208 ;

-- --------------------------------------------------------

--
-- Table structure for table `memory_slots`
--

CREATE TABLE IF NOT EXISTS `memory_slots` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customer` varchar(7) COLLATE utf8_swedish_ci DEFAULT NULL,
  `time_from` float(4,2) NOT NULL,
  `time_to` float(4,2) NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0-Normal, 3-Oncall',
  PRIMARY KEY (`id`),
  KEY `customer` (`customer`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=538 ;

-- --------------------------------------------------------

--
-- Table structure for table `message_request_details`
--

CREATE TABLE IF NOT EXISTS `message_request_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` varchar(7) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `reciever_ids` text COLLATE utf8_swedish_ci,
  `message_id` int(11) NOT NULL,
  `accept` text COLLATE utf8_swedish_ci,
  `rejet` text COLLATE utf8_swedish_ci,
  `read` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `apt_time` text COLLATE utf8_swedish_ci,
  `rej_time` text COLLATE utf8_swedish_ci,
  `read_time` text COLLATE utf8_swedish_ci,
  `date` datetime NOT NULL,
  `con_status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  KEY `message_id` (`message_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `message_tm_admin`
--

CREATE TABLE IF NOT EXISTS `message_tm_admin` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `userid` varchar(7) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `mreq_id` int(11) NOT NULL DEFAULT '0',
  `message_id` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `message_id` (`message_id`),
  KEY `userid` (`userid`),
  KEY `mreq_id` (`mreq_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `note`
--

CREATE TABLE IF NOT EXISTS `note` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_user` varchar(7) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `customer` varchar(7) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `title` tinytext COLLATE utf8_swedish_ci,
  `description` longtext COLLATE utf8_swedish_ci,
  `visibility` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 - Public, 2 - Private, 3- All, 4- Admin Only',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1 - Active, 0 - Forbidden',
  `last_updated_user` varchar(7) COLLATE utf8_swedish_ci DEFAULT NULL,
  `last_updated_date` timestamp NULL DEFAULT NULL,
  `attachment` text COLLATE utf8_swedish_ci,
  PRIMARY KEY (`id`),
  KEY `created_user` (`created_user`),
  KEY `cusrtomer` (`customer`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=85 ;

-- --------------------------------------------------------

--
-- Table structure for table `pdf_work_report`
--

CREATE TABLE IF NOT EXISTS `pdf_work_report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jag` tinyint(4) DEFAULT NULL COMMENT '1_Jag får ersättning med förhöjt timbelopp',
  `date` date DEFAULT NULL,
  `employee` varchar(10) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `customer` varchar(7) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `organizer` varchar(100) COLLATE utf8_swedish_ci DEFAULT NULL,
  `contact_organizer` varchar(100) COLLATE utf8_swedish_ci DEFAULT NULL,
  `permission_national_board` smallint(6) DEFAULT NULL COMMENT 'Har anordnaren tillstånd från Socialstyrelsen?',
  `provider_ftax` smallint(6) DEFAULT NULL COMMENT '3_Har anordnaren F-skattsedel?',
  `telehone_areacode` varchar(100) COLLATE utf8_swedish_ci DEFAULT NULL,
  `been_hospital_month` smallint(6) DEFAULT NULL COMMENT '4_Har du vårdats på sjukhus eller liknande den här månaden?',
  `from_date` varchar(10) COLLATE utf8_swedish_ci DEFAULT NULL,
  `to_date` varchar(10) COLLATE utf8_swedish_ci DEFAULT NULL,
  `hospital` varchar(100) COLLATE utf8_swedish_ci DEFAULT NULL,
  `apply_assistance` tinyint(11) DEFAULT NULL COMMENT '4_Ja, för',
  `hours_included` varchar(100) COLLATE utf8_swedish_ci DEFAULT NULL,
  `assistance_allowance_paid` varchar(5) COLLATE utf8_swedish_ci DEFAULT NULL,
  `organizer1` varchar(100) COLLATE utf8_swedish_ci DEFAULT NULL,
  `organizer2` varchar(100) COLLATE utf8_swedish_ci DEFAULT NULL,
  `ftax1` tinyint(4) DEFAULT NULL COMMENT '6_Har anordnaren F-skattsedel?_1',
  `ftax2` tinyint(4) DEFAULT NULL COMMENT '6_Har anordnaren F-skattsedel?_2',
  `money_left_purchase` int(11) DEFAULT NULL COMMENT '6_Finns det pengar kvar som du inte har använt för att köpa personlig assistans?',
  `money_left` varchar(100) COLLATE utf8_swedish_ci DEFAULT NULL,
  `salary_cost_per_hour` float(15,2) DEFAULT NULL,
  `total_inconv_time_emp_hour` float(15,2) DEFAULT NULL,
  `help_cost_hour` float(15,2) DEFAULT NULL,
  `tranning_cost_hour` float(15,2) DEFAULT NULL,
  `try_staff_cost_hour` float(15,2) DEFAULT NULL,
  `admin_cost_hour` float(15,2) DEFAULT NULL,
  `salary_cost_period` float(15,2) DEFAULT NULL,
  `total_inconv_time_emp_period` float(15,2) DEFAULT NULL,
  `help_cost_reriod` float(15,2) DEFAULT NULL,
  `tranning_cost_period` float(15,2) DEFAULT NULL,
  `try_staff_cost_period` float(15,2) DEFAULT NULL,
  `admin_cost_period` float(15,2) DEFAULT NULL,
  `total_cost_period` float(15,2) DEFAULT NULL,
  `total_cost_hour` float(15,2) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `cost_emp_to_customer` float(15,2) DEFAULT NULL,
  `provided_info_annex` enum('0','1') CHARACTER SET utf8 COLLATE utf8_bin DEFAULT '0',
  `txt_8_1` text CHARACTER SET utf8 COLLATE utf8_bin,
  `txt_8_2` text CHARACTER SET utf8 COLLATE utf8_bin,
  `txt_8_3` text CHARACTER SET utf8 COLLATE utf8_bin,
  PRIMARY KEY (`id`),
  KEY `customer` (`customer`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=17 ;

-- --------------------------------------------------------

--
-- Table structure for table `privileges`
--

CREATE TABLE IF NOT EXISTS `privileges` (
  `employee` varchar(7) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `customer` varchar(7) COLLATE utf8_swedish_ci DEFAULT NULL,
  `swap` tinyint(1) NOT NULL DEFAULT '0',
  `process` tinyint(1) NOT NULL DEFAULT '0',
  `add_slot` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `fkkn` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `slot_type` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `add_customer` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `add_employee` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `remove_customer` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `remove_employee` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `leave` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `copy_single_slot` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `copy_single_slot_option` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `copy_day_slot` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `copy_day_slot_option` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `split_slot` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `delete_slot` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `delete_day_slot` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `delete_multiple_slots` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `contract_override` tinyint(1) NOT NULL,
  `atl_override` tinyint(1) NOT NULL,
  `change_time` tinyint(3) NOT NULL DEFAULT '0',
  `no_pay_leave` tinyint(4) NOT NULL DEFAULT '0',
  KEY `employee` (`employee`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `privileges_forms`
--

CREATE TABLE IF NOT EXISTS `privileges_forms` (
  `employee` varchar(7) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `fkkn` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `leave` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `certificate` tinyint(3) unsigned NOT NULL DEFAULT '0',
  KEY `employee` (`employee`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `privileges_general`
--

CREATE TABLE IF NOT EXISTS `privileges_general` (
  `employee` varchar(7) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `add_employee` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `add_customer` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `edit_employee` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `edit_customer` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `inconvenient_timing` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `administration` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `chat` tinyint(4) NOT NULL DEFAULT '0',
  `survey` tinyint(4) NOT NULL DEFAULT '0',
  `create_template` tinyint(4) NOT NULL DEFAULT '0',
  `use_template` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`employee`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `privileges_mc`
--

CREATE TABLE IF NOT EXISTS `privileges_mc` (
  `employee` varchar(7) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `leave_notification` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `leave_approval` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `leave_rejection` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `leave_edit` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `notes` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `notes_approval` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `notes_rejection` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `cirrus_mail` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `external_mail` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `sms` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `notes_attchment` tinyint(3) NOT NULL DEFAULT '0',
  KEY `employee` (`employee`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `privileges_reports`
--

CREATE TABLE IF NOT EXISTS `privileges_reports` (
  `employee` varchar(7) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `customer_data` tinyint(3) NOT NULL DEFAULT '0',
  `customer_leave` tinyint(3) NOT NULL DEFAULT '0',
  `customer_granded_vs_used` tinyint(3) NOT NULL DEFAULT '0',
  `customer_employee_connection` tinyint(3) NOT NULL DEFAULT '0',
  `customer_schedule` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `customer_horizontal` tinyint(3) NOT NULL DEFAULT '0',
  `customer_overview` tinyint(3) NOT NULL DEFAULT '0',
  `customer_vacation_planning` tinyint(3) NOT NULL DEFAULT '0',
  `employee_data` tinyint(3) NOT NULL DEFAULT '0',
  `employee_leave` tinyint(3) NOT NULL DEFAULT '0',
  `employee_percentage` tinyint(3) NOT NULL DEFAULT '0',
  `employee_schedule` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `employee_workreport` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `atl_warning` tinyint(3) NOT NULL DEFAULT '0',
  KEY `employee` (`employee`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `report_signing`
--

CREATE TABLE IF NOT EXISTS `report_signing` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `employee` varchar(7) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `customer` varchar(7) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `date` date NOT NULL,
  `signin_employee` varchar(7) COLLATE utf8_swedish_ci DEFAULT NULL,
  `signin_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `signin_tl` varchar(7) COLLATE utf8_swedish_ci DEFAULT NULL,
  `signin_tl_date` timestamp NULL DEFAULT NULL,
  `signin_sutl` varchar(7) COLLATE utf8_swedish_ci DEFAULT NULL,
  `signin_sutl_date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `employee` (`employee`),
  KEY `date` (`date`),
  KEY `customer` (`customer`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=61 ;

-- --------------------------------------------------------

--
-- Table structure for table `salary_main`
--

CREATE TABLE IF NOT EXISTS `salary_main` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `effect_from` date NOT NULL,
  `effect_to` date NOT NULL,
  `normal` float(6,2) NOT NULL,
  `travel` float(6,2) NOT NULL,
  `break` float(6,2) NOT NULL,
  `oncall` float(6,2) NOT NULL,
  `overtime` float(6,2) NOT NULL,
  `quality_overtime` float(6,2) NOT NULL,
  `more_time` float(6,2) NOT NULL,
  `some_other_time` float(6,2) NOT NULL,
  `training_time` float(6,2) NOT NULL,
  `call_training` float(6,2) NOT NULL,
  `personal_meeting` float(6,2) NOT NULL,
  `voluntary` float(6,2) NOT NULL DEFAULT '0.00',
  `complementary` float(6,2) NOT NULL DEFAULT '0.00',
  `complementary_oncall` float(6,2) NOT NULL DEFAULT '0.00',
  `holiday_big` float(6,2) NOT NULL COMMENT 'Big Holiday',
  `holiday_red` float(6,2) NOT NULL COMMENT 'Holiday',
  `insurance` float(12,2) NOT NULL,
  `clone_from` int(11) DEFAULT NULL,
  `increment_percentage` float(6,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `samsida`
--

CREATE TABLE IF NOT EXISTS `samsida` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `customer` varchar(7) COLLATE utf8_bin NOT NULL,
  `how_is_asst_provided` varchar(10) COLLATE utf8_bin NOT NULL COMMENT 'Section 3',
  `how_is_asst_provided_orgno` varchar(25) COLLATE utf8_bin DEFAULT NULL COMMENT 'Section 3 Organization Number',
  `did_u_hostpilized_this_month` tinyint(1) NOT NULL COMMENT 'Section 4 main choice',
  `hostpilized_date_from` date DEFAULT NULL COMMENT 'Section 4 Date-from',
  `hostpilized_date_to` date DEFAULT NULL COMMENT 'Section 4 Date-to',
  `hospital` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT 'Section 4 Sjukhus',
  `did_u_included_hospitalized_hours` tinyint(1) DEFAULT NULL COMMENT 'Section 4 (Row 3 choice)',
  `hostpitalized_hours` varchar(8) COLLATE utf8_bin DEFAULT NULL COMMENT 'Section 4 (Row 3 text)',
  `other_info` text COLLATE utf8_bin COMMENT 'Section 5 text',
  `did_u_provide_info_annex` tinyint(1) NOT NULL COMMENT 'Section 5 choice',
  `signed_customer_phno` varchar(20) COLLATE utf8_bin DEFAULT NULL COMMENT 'Section 6(telephone)',
  `signature_options` tinyint(4) DEFAULT NULL COMMENT 'Section 6 (row 3 choices)',
  `signed_employer_name` varchar(75) COLLATE utf8_bin DEFAULT NULL COMMENT 'Section 7(name)',
  `signed_employer_telephone` varchar(20) COLLATE utf8_bin DEFAULT NULL COMMENT 'Section 7(telephone)',
  `do_u_hire_asst_provider` tinyint(1) NOT NULL COMMENT 'Section 8 (row 1 choice)',
  `asst_provider_orgno` varchar(15) COLLATE utf8_bin DEFAULT NULL COMMENT 'Section 8 (row 1 orgno)',
  `have_money_left_not_to_purchase1` tinyint(1) DEFAULT NULL COMMENT 'Section 8 (row2 choices)',
  `money_left1` varchar(10) COLLATE utf8_bin DEFAULT NULL COMMENT 'Section 8 (row2 text)',
  `is_u_r_ur_asst_provider` tinyint(1) NOT NULL COMMENT 'Section 8 (row3 choice)',
  `do_u_get_himself_money` tinyint(1) NOT NULL COMMENT 'Section 8 (row4 choice)',
  `asst_provider1` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT 'Section 8 (assistant1)',
  `asst_provider_orgno1` varchar(15) COLLATE utf8_bin DEFAULT NULL COMMENT 'Section 8 (assistant orgno1)',
  `asst_provider2` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT 'Section 8 (assistant2)',
  `asst_provider_orgno2` varchar(15) COLLATE utf8_bin DEFAULT NULL COMMENT 'Section 8 (assistant orgno2)',
  `asst_provider3` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT 'Section 8 (assistant3)',
  `asst_provider_orgno3` varchar(15) COLLATE utf8_bin DEFAULT NULL COMMENT 'Section 8 (assistant orgno3)',
  `do_u_attach_receipt` tinyint(1) NOT NULL COMMENT 'Section 8 (row 8 choices)',
  `money_left_not_to_purchase2` tinyint(1) DEFAULT NULL COMMENT 'Section 8 (row9 choice)',
  `money_left2` varchar(10) COLLATE utf8_bin DEFAULT NULL COMMENT 'Section 8 (row9 text)',
  `do_u_live_outside_EEA_country` tinyint(1) NOT NULL COMMENT 'Section 8 (row10 choice)',
  `accounting_date_from` date DEFAULT NULL COMMENT 'Section 9 date-from',
  `accounting_date_to` date DEFAULT NULL COMMENT 'Section 9 date-to',
  `salary_excl_OB_cost` double(11,2) DEFAULT NULL COMMENT 'cost-perid table (row 1)',
  `salary_excl_OB_period` double(11,2) DEFAULT NULL COMMENT 'cost-perid table (row 1)',
  `salary_OB_cost` double(11,2) DEFAULT NULL COMMENT 'cost-perid table (row 2)',
  `salary_OB_period` double(11,2) DEFAULT NULL COMMENT 'cost-perid table (row 2)',
  `assist_expenses_cost` double(11,2) DEFAULT NULL COMMENT 'cost-perid table (row 3)',
  `assist_expenses_period` double(11,2) DEFAULT NULL COMMENT 'cost-perid table (row 3)',
  `training_cost` double(11,2) DEFAULT NULL COMMENT 'cost-perid table (row 4)',
  `training_period` double(11,2) DEFAULT NULL COMMENT 'cost-perid table (row 4)',
  `staff_expense_cost` double(11,2) DEFAULT NULL COMMENT 'cost-perid table (row 5)',
  `staff_expense_period` double(11,2) DEFAULT NULL COMMENT 'cost-perid table (row 5)',
  `administration_cost` double(11,2) DEFAULT NULL COMMENT 'cost-perid table (row 6)',
  `administration_period` double(11,2) DEFAULT NULL COMMENT 'cost-perid table (row 6)',
  `working_hours_4_customer` int(11) NOT NULL DEFAULT '0' COMMENT 'Working hours for customer (Section 9)',
  PRIMARY KEY (`id`),
  KEY `customer` (`customer`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='For employee pdf work report summery' AUTO_INCREMENT=27 ;

-- --------------------------------------------------------

--
-- Table structure for table `schedule_copy`
--

CREATE TABLE IF NOT EXISTS `schedule_copy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tid` int(50) DEFAULT NULL,
  `employee` varchar(63) COLLATE utf8_bin DEFAULT NULL,
  `customer` varchar(63) COLLATE utf8_bin DEFAULT NULL,
  `fkkn` tinyint(1) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time_from` float(4,2) DEFAULT NULL,
  `time_to` float(4,2) DEFAULT NULL,
  `type` tinyint(1) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `relation_id` double DEFAULT NULL,
  `comment` blob,
  `alloc_emp` varchar(63) COLLATE utf8_bin DEFAULT NULL,
  `alloc_comment` blob,
  `cust_comment` blob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=335 ;

-- --------------------------------------------------------

--
-- Table structure for table `schedule_template`
--

CREATE TABLE IF NOT EXISTS `schedule_template` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `customer` varchar(63) COLLATE utf8_bin DEFAULT NULL,
  `Added_date` date DEFAULT NULL,
  `temp_name` varchar(765) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`tid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Table structure for table `sick_form_defaults`
--

CREATE TABLE IF NOT EXISTS `sick_form_defaults` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer` varchar(7) COLLATE utf8_bin NOT NULL,
  `uppdrag` text COLLATE utf8_bin,
  `fullmakt` varchar(4) COLLATE utf8_bin NOT NULL COMMENT 'Format: check1||check2',
  `reference_number` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `check_values` varchar(10) COLLATE utf8_bin DEFAULT NULL COMMENT 'Format: choice1||choice2||choice3||choice4',
  PRIMARY KEY (`id`),
  KEY `customer` (`customer`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='To save previous Form values of Sick form' AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `signing_employer`
--

CREATE TABLE IF NOT EXISTS `signing_employer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer` varchar(7) COLLATE utf8_bin NOT NULL,
  `year` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `fkkn` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=100 ;

-- --------------------------------------------------------

--
-- Table structure for table `signing_employer_data`
--

CREATE TABLE IF NOT EXISTS `signing_employer_data` (
  `master_id` int(11) NOT NULL COMMENT ' id''s from signing_employer table',
  `employee` varchar(7) COLLATE utf8_bin NOT NULL,
  `signing_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `employer` varchar(7) COLLATE utf8_bin NOT NULL,
  `employer_role` varchar(75) COLLATE utf8_bin DEFAULT NULL,
  KEY `master_id` (`master_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `srv_answer_type`
--

CREATE TABLE IF NOT EXISTS `srv_answer_type` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `type_title` varchar(20) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='for survey purpose' AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Table structure for table `srv_categories`
--

CREATE TABLE IF NOT EXISTS `srv_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(25) COLLATE utf8_bin NOT NULL,
  `category_type` tinyint(4) DEFAULT NULL COMMENT '0- form, 1- question (not used now, for future use)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='for survey purpose' AUTO_INCREMENT=23 ;

-- --------------------------------------------------------

--
-- Table structure for table `srv_forms`
--

CREATE TABLE IF NOT EXISTS `srv_forms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(30) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin,
  `date_creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `categories` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `break_numbers` varchar(60) COLLATE utf8_bin DEFAULT NULL COMMENT 'question numbers per page(comma seperated)',
  `question_limit` int(4) NOT NULL DEFAULT '0' COMMENT '0- unlimit questions',
  `status` tinyint(1) DEFAULT '1' COMMENT '0-Locked, 1- Open',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='for survey purpose' AUTO_INCREMENT=29 ;

-- --------------------------------------------------------

--
-- Table structure for table `srv_form_questions`
--

CREATE TABLE IF NOT EXISTS `srv_form_questions` (
  `form_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `question_order` int(11) NOT NULL DEFAULT '1' COMMENT 'order of questions',
  KEY `question_id` (`question_id`),
  KEY `form_id` (`form_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='for survey purpose';

-- --------------------------------------------------------

--
-- Table structure for table `srv_groups`
--

CREATE TABLE IF NOT EXISTS `srv_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(25) COLLATE utf8_bin NOT NULL,
  `group_description` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `group_leader` varchar(7) COLLATE utf8_bin DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `group_leader` (`group_leader`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='for survey purpose' AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `srv_group_members`
--

CREATE TABLE IF NOT EXISTS `srv_group_members` (
  `group_id` int(11) NOT NULL,
  `username` varchar(7) COLLATE utf8_bin NOT NULL,
  KEY `group_id` (`group_id`),
  KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='for survey purpose';

-- --------------------------------------------------------

--
-- Table structure for table `srv_invitation`
--

CREATE TABLE IF NOT EXISTS `srv_invitation` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `invite_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `invite_subject` text COLLATE utf8_bin NOT NULL,
  `invite_message` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='for survey purpose' AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `srv_invitation_members`
--

CREATE TABLE IF NOT EXISTS `srv_invitation_members` (
  `invitation_id` bigint(20) NOT NULL,
  `grp_indv_flag` tinyint(1) NOT NULL COMMENT '0- group, 1- Individuals employee 2- Customer',
  `grp_indv_id` varchar(7) COLLATE utf8_bin NOT NULL COMMENT 'group ID / Invidual UserName',
  KEY `invitation_id` (`invitation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `srv_invitation_surveys`
--

CREATE TABLE IF NOT EXISTS `srv_invitation_surveys` (
  `invitation_id` bigint(20) NOT NULL,
  `survey_id` int(11) NOT NULL,
  KEY `invitation_id` (`invitation_id`),
  KEY `survey_id` (`survey_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `srv_questions`
--

CREATE TABLE IF NOT EXISTS `srv_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_question_ID` int(11) NOT NULL DEFAULT '0' COMMENT '0- have no parent',
  `question` text COLLATE utf8_bin NOT NULL,
  `answer_hint` text COLLATE utf8_bin,
  `answer_type` int(4) NOT NULL DEFAULT '4',
  `categories` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1' COMMENT '0- Can''t Edit(for Finalize Save), 1- Can Edit',
  `comment_flag` tinyint(1) DEFAULT '0' COMMENT '0-No comment, 1-plane text Comment, 2-TextArea Comment',
  `display_style` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0- not specified, 1- horizontal, 2- vertical',
  PRIMARY KEY (`id`),
  KEY `answer_type` (`answer_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='for survey purpose' AUTO_INCREMENT=115 ;

-- --------------------------------------------------------

--
-- Table structure for table `srv_question_answer`
--

CREATE TABLE IF NOT EXISTS `srv_question_answer` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `answer_text` text COLLATE utf8_bin,
  `point` float(4,2) NOT NULL,
  `correct_flag` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0- FALSE, 1- TRUE',
  `default_flag` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0-Not Default, 1- Default',
  PRIMARY KEY (`id`),
  KEY `questionID` (`question_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='for survey purpose' AUTO_INCREMENT=214 ;

-- --------------------------------------------------------

--
-- Table structure for table `srv_surveys`
--

CREATE TABLE IF NOT EXISTS `srv_surveys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_survey_ID` int(11) NOT NULL DEFAULT '0' COMMENT '0- have no parent',
  `survey_title` varchar(30) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin,
  `created_by` varchar(7) COLLATE utf8_bin NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `expire_date` timestamp NULL DEFAULT NULL,
  `status` enum('0','1') COLLATE utf8_bin NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='for survey purpose' AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- Table structure for table `srv_survey_forms`
--

CREATE TABLE IF NOT EXISTS `srv_survey_forms` (
  `survey_id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  `forms_order` int(4) NOT NULL DEFAULT '1' COMMENT 'order of forms',
  KEY `form_id` (`form_id`),
  KEY `survey_id` (`survey_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='for survey purpose';

-- --------------------------------------------------------

--
-- Table structure for table `srv_user_Results`
--

CREATE TABLE IF NOT EXISTS `srv_user_Results` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `survey_id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  `username` varchar(7) COLLATE utf8_bin NOT NULL,
  `user_IP` varchar(15) COLLATE utf8_bin NOT NULL,
  `survey_page` int(11) NOT NULL,
  `answer_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `surveyID` (`survey_id`),
  KEY `formID` (`form_id`),
  KEY `userName` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='for survey purpose' AUTO_INCREMENT=79 ;

-- --------------------------------------------------------

--
-- Table structure for table `srv_user_Results_data`
--

CREATE TABLE IF NOT EXISTS `srv_user_Results_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `result_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer_id_txt` text COLLATE utf8_bin NOT NULL COMMENT 'either ID from question_answer table or a static text',
  `user_comment` text COLLATE utf8_bin,
  PRIMARY KEY (`id`),
  KEY `result_ID` (`result_id`),
  KEY `questionID` (`question_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='for survey purpose' AUTO_INCREMENT=235 ;

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE IF NOT EXISTS `team` (
  `customer` varchar(7) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `employee` varchar(7) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `role` tinyint(1) NOT NULL DEFAULT '3' COMMENT '2 - Team leader, 3 - Assistant, 7 - Super TL',
  `orderId` int(11) DEFAULT NULL,
  KEY `customer` (`customer`),
  KEY `employee` (`employee`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `temp_timetable`
--

CREATE TABLE IF NOT EXISTS `temp_timetable` (
  `id` bigint(20) NOT NULL,
  `employee` varchar(7) COLLATE utf8_bin DEFAULT NULL,
  `empfname` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `emplname` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `type` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `timetable`
--

CREATE TABLE IF NOT EXISTS `timetable` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `employee` varchar(7) COLLATE utf8_swedish_ci DEFAULT NULL,
  `customer` varchar(7) COLLATE utf8_swedish_ci DEFAULT NULL,
  `fkkn` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1-FK, 2-KN',
  `date` date NOT NULL,
  `time_from` float(4,2) NOT NULL,
  `time_to` float(4,2) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0-Normal,1-Travel, 2-Break, 3-on call, 4-overtime, 5-qality overtime, 6-more time, 7-some other time, 8-Training time,  9-Call Training, 10-Personal meeting, 11-voluntary, 12-complementary, 13-complementary on call',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0-forbidden, 1-active, 2-leave, 3-Priliminary',
  `relation_id` bigint(20) DEFAULT NULL,
  `comment` text COLLATE utf8_swedish_ci,
  `alloc_emp` varchar(7) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'login - username (role 1,2)',
  `alloc_comment` text COLLATE utf8_swedish_ci,
  `cust_comment` text COLLATE utf8_swedish_ci,
  `google_id` varchar(50) COLLATE utf8_swedish_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `alloc_emp` (`alloc_emp`),
  KEY `date` (`date`),
  KEY `status` (`status`),
  KEY `employee` (`employee`),
  KEY `customer` (`customer`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=19113 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_task`
--

CREATE TABLE IF NOT EXISTS `user_task` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `userid` varchar(10) COLLATE utf8_swedish_ci DEFAULT NULL,
  `slotids` text COLLATE utf8_swedish_ci,
  `dag` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `dur` time NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=9 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `chat_ibfk_1` FOREIGN KEY (`from_chat`) REFERENCES `t2v_cirrus_common`.`login` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chat_ibfk_2` FOREIGN KEY (`to_chat`) REFERENCES `t2v_cirrus_common`.`login` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_2` FOREIGN KEY (`username`) REFERENCES `t2v_cirrus_common`.`login` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `devicetokens_ibfk_2` FOREIGN KEY (`username`) REFERENCES `t2v_cirrus_common`.`login` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `email`
--
ALTER TABLE `email`
  ADD CONSTRAINT `email_ibfk_2` FOREIGN KEY (`from`) REFERENCES `t2v_cirrus_common`.`login` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_2` FOREIGN KEY (`username`) REFERENCES `t2v_cirrus_common`.`login` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employee_attachment`
--
ALTER TABLE `employee_attachment`
  ADD CONSTRAINT `employee_attachment_ibfk_1` FOREIGN KEY (`employee`) REFERENCES `employee` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employee_contract`
--
ALTER TABLE `employee_contract`
  ADD CONSTRAINT `employee_contract_ibfk_2` FOREIGN KEY (`employee`) REFERENCES `t2v_cirrus_common`.`login` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employee_salary`
--
ALTER TABLE `employee_salary`
  ADD CONSTRAINT `employee_salary_ibfk_1` FOREIGN KEY (`employee`) REFERENCES `employee` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employee_salary_inconvenient`
--
ALTER TABLE `employee_salary_inconvenient`
  ADD CONSTRAINT `employee_salary_inconvenient_ibfk_1` FOREIGN KEY (`employee`) REFERENCES `employee` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `history_samsida_work_report`
--
ALTER TABLE `history_samsida_work_report`
  ADD CONSTRAINT `history_samsida_work_report_ibfk_1` FOREIGN KEY (`customer`) REFERENCES `customer` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `log_login_ibfk_2` FOREIGN KEY (`username`) REFERENCES `t2v_cirrus_common`.`login` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `log_password`
--
ALTER TABLE `log_password`
  ADD CONSTRAINT `log_password_ibfk_2` FOREIGN KEY (`username`) REFERENCES `t2v_cirrus_common`.`login` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `log_sms`
--
ALTER TABLE `log_sms`
  ADD CONSTRAINT `log_sms_ibfk_2` FOREIGN KEY (`to_user`) REFERENCES `t2v_cirrus_common`.`login` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mail`
--
ALTER TABLE `mail`
  ADD CONSTRAINT `mail_ibfk_3` FOREIGN KEY (`from`) REFERENCES `t2v_cirrus_common`.`login` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mail_ibfk_4` FOREIGN KEY (`to`) REFERENCES `t2v_cirrus_common`.`login` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `privileges_forms`
--
ALTER TABLE `privileges_forms`
  ADD CONSTRAINT `privileges_forms_ibfk_1` FOREIGN KEY (`employee`) REFERENCES `employee` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `privileges_general`
--
ALTER TABLE `privileges_general`
  ADD CONSTRAINT `privileges_general_ibfk_1` FOREIGN KEY (`employee`) REFERENCES `employee` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `privileges_mc`
--
ALTER TABLE `privileges_mc`
  ADD CONSTRAINT `privileges_mc_ibfk_1` FOREIGN KEY (`employee`) REFERENCES `employee` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `privileges_reports`
--
ALTER TABLE `privileges_reports`
  ADD CONSTRAINT `privileges_reports_ibfk_2` FOREIGN KEY (`employee`) REFERENCES `employee` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `report_signing`
--
ALTER TABLE `report_signing`
  ADD CONSTRAINT `report_signing_ibfk_1` FOREIGN KEY (`employee`) REFERENCES `employee` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `report_signing_ibfk_2` FOREIGN KEY (`customer`) REFERENCES `customer` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `samsida`
--
ALTER TABLE `samsida`
  ADD CONSTRAINT `samsida_ibfk_1` FOREIGN KEY (`customer`) REFERENCES `customer` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sick_form_defaults`
--
ALTER TABLE `sick_form_defaults`
  ADD CONSTRAINT `sick_form_defaults_ibfk_1` FOREIGN KEY (`customer`) REFERENCES `customer` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `signing_employer_data`
--
ALTER TABLE `signing_employer_data`
  ADD CONSTRAINT `signing_employer_data_ibfk_1` FOREIGN KEY (`master_id`) REFERENCES `signing_employer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `srv_form_questions`
--
ALTER TABLE `srv_form_questions`
  ADD CONSTRAINT `srv_form_questions_ibfk_1` FOREIGN KEY (`form_id`) REFERENCES `srv_forms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `srv_form_questions_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `srv_questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `srv_group_members`
--
ALTER TABLE `srv_group_members`
  ADD CONSTRAINT `srv_group_members_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `srv_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `srv_group_members_ibfk_2` FOREIGN KEY (`username`) REFERENCES `employee` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `srv_invitation_members`
--
ALTER TABLE `srv_invitation_members`
  ADD CONSTRAINT `srv_invitation_members_ibfk_1` FOREIGN KEY (`invitation_id`) REFERENCES `srv_invitation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `srv_invitation_surveys`
--
ALTER TABLE `srv_invitation_surveys`
  ADD CONSTRAINT `srv_invitation_surveys_ibfk_1` FOREIGN KEY (`invitation_id`) REFERENCES `srv_invitation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `srv_invitation_surveys_ibfk_2` FOREIGN KEY (`survey_id`) REFERENCES `srv_surveys` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `srv_questions`
--
ALTER TABLE `srv_questions`
  ADD CONSTRAINT `srv_questions_ibfk_1` FOREIGN KEY (`answer_type`) REFERENCES `srv_answer_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `srv_question_answer`
--
ALTER TABLE `srv_question_answer`
  ADD CONSTRAINT `srv_question_answer_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `srv_questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `srv_survey_forms`
--
ALTER TABLE `srv_survey_forms`
  ADD CONSTRAINT `srv_survey_forms_ibfk_1` FOREIGN KEY (`survey_id`) REFERENCES `srv_surveys` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `srv_survey_forms_ibfk_2` FOREIGN KEY (`form_id`) REFERENCES `srv_forms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `srv_user_Results`
--
ALTER TABLE `srv_user_Results`
  ADD CONSTRAINT `srv_user_Results_ibfk_1` FOREIGN KEY (`survey_id`) REFERENCES `srv_surveys` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `srv_user_Results_ibfk_2` FOREIGN KEY (`form_id`) REFERENCES `srv_forms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `srv_user_Results_data`
--
ALTER TABLE `srv_user_Results_data`
  ADD CONSTRAINT `srv_user_Results_data_ibfk_1` FOREIGN KEY (`result_id`) REFERENCES `srv_user_Results` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `srv_user_Results_data_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `srv_questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `timetable_ibfk_2` FOREIGN KEY (`alloc_emp`) REFERENCES `t2v_cirrus_common`.`login` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
