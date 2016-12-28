-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 11, 2016 at 06:44 AM
-- Server version: 10.0.28-MariaDB-0+deb8u1
-- PHP Version: 5.6.27-0+deb8u1

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `pacificnm_camper`
--

-- --------------------------------------------------------

--
-- Table structure for table `acl`
--

CREATE TABLE IF NOT EXISTS `acl` (
`acl_id` int(20) NOT NULL,
  `acl_role_id` int(20) unsigned NOT NULL,
  `acl_resource_id` int(20) unsigned NOT NULL
) ENGINE=InnoDB;

--
-- RELATIONS FOR TABLE `acl`:
--   `acl_resource_id`
--       `acl_resource` -> `acl_resource_id`
--   `acl_role_id`
--       `acl_role` -> `acl_role_id`
--

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acl`
--
ALTER TABLE `acl`
 ADD PRIMARY KEY (`acl_id`), ADD KEY `acl_role_id` (`acl_role_id`), ADD KEY `acl_resource_id` (`acl_resource_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acl`
--
ALTER TABLE `acl`
MODIFY `acl_id` int(20) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `acl`
--
ALTER TABLE `acl`
ADD CONSTRAINT `fk_acl_resource_id` FOREIGN KEY (`acl_resource_id`) REFERENCES `acl_resource` (`acl_resource_id`),
ADD CONSTRAINT `fk_acl_rol_id` FOREIGN KEY (`acl_role_id`) REFERENCES `acl_role` (`acl_role_id`);
SET FOREIGN_KEY_CHECKS=1;
