-- phpMyAdmin SQL Dump
-- version 4.6.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 27, 2017 at 11:51 PM
-- Server version: 5.7.20-0ubuntu0.16.04.1
-- PHP Version: 5.6.32-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `church_camp`
--

-- --------------------------------------------------------

--
-- Table structure for table `churches`
--

CREATE TABLE `churches` (
  `id` int(11) NOT NULL,
  `country` int(11) DEFAULT NULL,
  `state` int(11) DEFAULT NULL,
  `district` int(11) DEFAULT NULL,
  `name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `churches`
--

INSERT INTO `churches` (`id`, `country`, `state`, `district`, `name`) VALUES
(1, 1, 1, 1, 'Thiruvananthapuram'),
(2, 1, 1, 2, 'Kollam'),
(3, 1, 1, 6, 'Pooyamkutty');

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('0ecaead2d88e6dc93ce22cef172db69e6d563a33', '::1', 1511797688, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531313739373435313b),
('1489a6df7f9793c2f1248590e046c9377da98002', '::1', 1511791609, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531313739313430373b),
('32ea4ae42e22375bcfff44deb4400497110903bb', '::1', 1511801731, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531313830313733313b),
('39a35299b67e2e8fb494a181269f66da5758d084', '::1', 1511796829, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531313739363832333b),
('4ff0f7605c9b0245ffa131184efece6b6ece1de0', '::1', 1511791924, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531313739313831353b),
('5b50bdf5ebb7822d1af8abf9944049db44195499', '::1', 1511782979, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531313738323833343b),
('70ec216e92e682ecfc3d8b7e27fc7bd08747923c', '::1', 1511801372, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531313830313233323b),
('7504033a6d601404a74a5b5624e27d3f871f6f0e', '::1', 1511802545, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531313830323534333b),
('7b92b8235314130629565d704211882261c96244', '::1', 1511806481, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531313830363432343b),
('8e4ded15bcc75993f4d4d293824794be42767026', '::1', 1511799042, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531313739383735333b),
('8e53bbe7f167cb63cc3d05e8502555aa36e33813', '::1', 1511796551, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531313739363531313b),
('94309f2f8525d8165e4841a0f17286612a41bad0', '::1', 1511792717, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531313739323533383b),
('a2790ee70a4256337583cab2182edcbe09a35804', '::1', 1511784310, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531313738343038343b),
('ac6e40c6a6747d27f4fecd62bbc45dce1173f93c', '::1', 1511802386, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531313830323131373b),
('ad939790a70a5fbbd641d88872f2dcbe00e35bbc', '::1', 1511797297, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531313739373133343b),
('af460c48385557553053ce551b22480c80cb4c42', '::1', 1511782347, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531313738323038343b),
('b70db1f9588354be8e923c5d4fbc61dff351763e', '::1', 1511796475, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531313739363139393b),
('b7f5c2934ef2b37e00c599060119cea7e01f8bcb', '::1', 1511799633, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531313739393633333b),
('c45806602b9100263c54da34665de62181c43b7c', '::1', 1511796169, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531313739353839333b),
('c78312821a4a9a66dc81993c431dd52592f2b5a4', '::1', 1511798226, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531313739373936393b),
('d004e7dd0cea7592803aa70674122be104282d77', '::1', 1511793051, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531313739323930373b),
('f1f756cb9199391f6cdd8da22ffdaf5fa5d32bcb', '::1', 1511799602, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531313739393331343b),
('f6cc4c270ff3b73d0c2bdef740281033e1f6fed9', '::1', 1511798514, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531313739383336323b),
('f8c0921cbf5138bf9ef647eeab91a63a0f3a5623', '::1', 1511793299, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531313739333233373b),
('ffb8fd7a7d60c48bd1d9c2373114c8ab3fd6c367', '::1', 1511792177, 0x5f5f63695f6c6173745f726567656e65726174657c693a313531313739323137343b);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`) VALUES
(1, 'India'),
(2, 'United States'),
(3, 'Keniya');

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` int(11) NOT NULL,
  `country` int(11) DEFAULT NULL,
  `state` int(11) DEFAULT NULL,
  `name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `country`, `state`, `name`) VALUES
(1, 1, 1, 'Thiruvananthapuram'),
(2, 1, 1, 'Kollam'),
(3, 1, 1, 'Pathanamthitta'),
(4, 1, 1, 'Kottayam'),
(5, 1, 1, 'Alapuzha'),
(6, 1, 1, 'Ernakulam'),
(7, 1, 1, 'Idukki');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `id` int(11) NOT NULL,
  `church` int(11) DEFAULT NULL,
  `name` varchar(250) NOT NULL,
  `gender` enum('M','F') NOT NULL DEFAULT 'M',
  `age` int(11) DEFAULT NULL,
  `accommodation` tinyint(4) NOT NULL DEFAULT '1',
  `day1` enum('0','1') NOT NULL DEFAULT '0',
  `day2` enum('0','1') NOT NULL DEFAULT '0',
  `day3` enum('0','1') NOT NULL DEFAULT '0',
  `day4` enum('0','1') NOT NULL DEFAULT '0',
  `hot_water` enum('0','1') NOT NULL DEFAULT '0',
  `milk` enum('0','1') NOT NULL DEFAULT '0',
  `inserted_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` int(11) NOT NULL,
  `country` int(11) DEFAULT NULL,
  `name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `country`, `name`) VALUES
(1, 1, 'Kerala'),
(2, 1, 'Tamilnadu'),
(3, 1, 'Andra Pradesh'),
(4, 1, 'Karnataka');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `avatar` varchar(255) DEFAULT 'default.jpg',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_admin` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `is_confirmed` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `avatar`, `created_at`, `updated_at`, `is_admin`, `is_confirmed`, `is_deleted`) VALUES
(1, 'admin', 'mail@cjoel.com', '$2y$10$/ln0DpANqQon/Sn3HYT5ZOCY9m/6.yIkAEE1n4F5fajCV0d0Scz72', 'default.jpg', '2017-11-27 17:33:15', NULL, 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `churches`
--
ALTER TABLE `churches`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_country_id` (`country`),
  ADD KEY `fk_state_id` (`state`),
  ADD KEY `fk_district_id` (`district`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_dist_country_id` (`country`),
  ADD KEY `fk_dist_state_id` (`state`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_reg_church_id` (`church`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_state_country_id` (`country`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `churches`
--
ALTER TABLE `churches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `churches`
--
ALTER TABLE `churches`
  ADD CONSTRAINT `fk_country_id` FOREIGN KEY (`country`) REFERENCES `countries` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_district_id` FOREIGN KEY (`district`) REFERENCES `districts` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_state_id` FOREIGN KEY (`state`) REFERENCES `states` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `districts`
--
ALTER TABLE `districts`
  ADD CONSTRAINT `fk_dist_country_id` FOREIGN KEY (`country`) REFERENCES `countries` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_dist_state_id` FOREIGN KEY (`state`) REFERENCES `states` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `registration`
--
ALTER TABLE `registration`
  ADD CONSTRAINT `fk_reg_church_id` FOREIGN KEY (`church`) REFERENCES `churches` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `states`
--
ALTER TABLE `states`
  ADD CONSTRAINT `fk_state_country_id` FOREIGN KEY (`country`) REFERENCES `countries` (`id`) ON DELETE SET NULL;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
