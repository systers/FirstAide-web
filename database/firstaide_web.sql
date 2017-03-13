-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2017 at 10:38 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1
CREATE DATABASE IF NOT EXISTS firstaide_web;
USE firstaide_web;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `firstaide_web`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `addcomrade` (IN `id` INT(1), IN `mail` VARCHAR(100))  NO SQL
INSERT INTO comrade(comradeid,email)VALUES(id,mail)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `dupemail` (IN `mail` VARCHAR(100))  SELECT *from user where email = mail$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getcomradenum` (IN `inemail` VARCHAR(100), IN `incomradeid` INT(1))  select phonenumber from comrade where email = inemail and comradeid = incomradeid$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `login` (IN `pass` VARCHAR(100), IN `mail` VARCHAR(100))  SELECT * from user where password = pass AND email = mail$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `nameemail` (IN `emailid` VARCHAR(100))  NO SQL
SELECT username from user where email=emailid$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `registration` (IN `mail` VARCHAR(100), IN `uname` VARCHAR(100), IN `pass` VARCHAR(100), IN `country` VARCHAR(100))  INSERT INTO user VALUES(mail,uname,pass,country)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updatecomrade` (IN `id` INT(1), IN `mail` VARCHAR(100), IN `phno` VARCHAR(100))  NO SQL
UPDATE comrade SET phonenumber = phno where email = mail and comradeid = id$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `comrade`
--

CREATE TABLE `comrade` (
  `comradeid` int(1) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phonenumber` varchar(100) DEFAULT NULL,
  `comrade_email` varchar(100) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `email` varchar(100) NOT NULL,
  `username` varchar(100) CHARACTER SET latin1 NOT NULL,
  `password` varchar(100) CHARACTER SET latin1 NOT NULL,
  `host_country` varchar(100) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `comrade`
  ADD PRIMARY KEY (`comradeid`,`email`),
  ADD UNIQUE KEY `comrade_email` (`comrade_email`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`email`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comrade`
--
ALTER TABLE `comrade`
  ADD CONSTRAINT `comrade_ibfk_1` FOREIGN KEY (`email`) REFERENCES `user` (`email`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
