-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 25, 2024 at 04:51 PM
-- Server version: 8.3.0
-- PHP Version: 8.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wizdemy`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(50) DEFAULT 'active',
  `deleted_at` timestamp NULL DEFAULT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `admin_action_log`
--

CREATE TABLE `admin_action_log` (
  `action_id` int NOT NULL,
  `target_id` int NOT NULL,
  `target_type` varchar(50) NOT NULL,
  `admin_id` int NOT NULL,
  `action_type` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- --------------------------------------------------------

--
-- Table structure for table `bookmarks`
--

CREATE TABLE `bookmarks` (
  `bookmark_id` int NOT NULL,
  `user_id` int NOT NULL,
  `material_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int NOT NULL,
  `user_id` int NOT NULL,
  `material_id` int NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
);

-- --------------------------------------------------------

--
-- Table structure for table `follow_relation`
--

CREATE TABLE `follow_relation` (
  `follow_relationship_id` int NOT NULL,
  `follower_id` int NOT NULL,
  `following_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
);

-- --------------------------------------------------------

--
-- Table structure for table `github_projects`
--

CREATE TABLE `github_projects` (
  `project_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `repo_link` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(50) DEFAULT 'active'
);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `like_id` int NOT NULL,
  `user_id` int NOT NULL,
  `material_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `material_view`
-- (See below for the actual view)
--
CREATE TABLE `material_view` (
`author` varchar(255)
,`class_faculty` varchar(255)
,`comments_count` bigint
,`created_at` timestamp
,`deleted_at` timestamp
,`description` text
,`document_type` varchar(255)
,`education_level` varchar(255)
,`file_path` varchar(255)
,`format` varchar(255)
,`likes_count` bigint
,`material_id` int
,`private` tinyint(1)
,`request_id` int
,`responded_to` varchar(30)
,`semester` varchar(255)
,`status` varchar(50)
,`subject` varchar(255)
,`thumbnail_path` varchar(255)
,`title` varchar(255)
,`updated_at` timestamp
,`user_id` int
,`user_status` varchar(50)
,`username` varchar(30)
,`views_count` bigint
);

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `report_id` int NOT NULL,
  `user_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(50) DEFAULT 'pending',
  `target_type` varchar(255) DEFAULT NULL,
  `target_id` int DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- --------------------------------------------------------

--
-- Table structure for table `study_materials`
--

CREATE TABLE `study_materials` (
  `material_id` int NOT NULL,
  `user_id` int NOT NULL,
  `request_id` int DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text,
  `document_type` varchar(255) NOT NULL,
  `format` varchar(255) NOT NULL,
  `education_level` varchar(255) NOT NULL,
  `semester` varchar(255) DEFAULT NULL,
  `subject` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `thumbnail_path` varchar(255) NOT NULL,
  `class_faculty` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(50) DEFAULT 'active'
);

-- --------------------------------------------------------

--
-- Table structure for table `study_material_requests`
--

CREATE TABLE `study_material_requests` (
  `request_id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text,
  `education_level` varchar(255) NOT NULL,
  `semester` varchar(255) DEFAULT NULL,
  `subject` varchar(255) NOT NULL,
  `class_faculty` varchar(255) NOT NULL,
  `document_type` varchar(255) NOT NULL,
  `user_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(50) DEFAULT 'active'
);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `private` tinyint(1) DEFAULT '0',
  `bio` varchar(150) DEFAULT 'Hey there! I am using Wizdemy',
  `user_type` varchar(50) DEFAULT NULL,
  `education_level` varchar(100) DEFAULT NULL,
  `enrolled_course` varchar(100) DEFAULT NULL,
  `school_name` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `phone_number` varchar(20) DEFAULT NULL,
  `allow_email` tinyint(1) NOT NULL DEFAULT '1',
  `allow_phone` tinyint(1) NOT NULL DEFAULT '0',
  `status` varchar(50) DEFAULT 'active',
  `deleted_at` timestamp NULL DEFAULT NULL
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `user_profile_view`
-- (See below for the actual view)
--
CREATE TABLE `user_profile_view` (
`allow_email` tinyint(1)
,`allow_phone` tinyint(1)
,`bio` varchar(150)
,`created_at` timestamp
,`deleted_at` timestamp
,`education_level` varchar(100)
,`email` varchar(100)
,`enrolled_course` varchar(100)
,`followers_count` bigint
,`following_count` bigint
,`full_name` varchar(100)
,`materials_count` bigint
,`phone_number` varchar(20)
,`private` tinyint(1)
,`project_count` bigint
,`requests_count` bigint
,`responded_requests_count` bigint
,`status` varchar(50)
,`updated_at` timestamp
,`user_id` int
,`user_type` varchar(50)
,`username` varchar(30)
);

-- --------------------------------------------------------

--
-- Table structure for table `views`
--

CREATE TABLE `views` (
  `view_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `material_id` int NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
);

-- --------------------------------------------------------

--
-- Structure for view `material_view`
--
DROP TABLE IF EXISTS `material_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `material_view`  AS SELECT `m`.`material_id` AS `material_id`, `m`.`status` AS `status`, `m`.`user_id` AS `user_id`, `m`.`request_id` AS `request_id`, `m`.`title` AS `title`, `m`.`description` AS `description`, `m`.`document_type` AS `document_type`, `m`.`format` AS `format`, `m`.`education_level` AS `education_level`, `m`.`semester` AS `semester`, `m`.`subject` AS `subject`, `m`.`author` AS `author`, `m`.`file_path` AS `file_path`, `m`.`thumbnail_path` AS `thumbnail_path`, `m`.`class_faculty` AS `class_faculty`, `m`.`created_at` AS `created_at`, `m`.`updated_at` AS `updated_at`, `u1`.`private` AS `private`, `u1`.`username` AS `username`, `u1`.`deleted_at` AS `deleted_at`, `u1`.`status` AS `user_status`, `u2`.`username` AS `responded_to`, count(distinct `l`.`like_id`) AS `likes_count`, count(distinct `c`.`comment_id`) AS `comments_count`, count(distinct `v`.`view_id`) AS `views_count` FROM ((((((`study_materials` `m` left join `users` `u1` on((`u1`.`user_id` = `m`.`user_id`))) left join `study_material_requests` `r` on((`r`.`request_id` = `m`.`request_id`))) left join `users` `u2` on((`u2`.`user_id` = `r`.`user_id`))) left join `likes` `l` on((`l`.`material_id` = `m`.`material_id`))) left join `comments` `c` on((`c`.`material_id` = `m`.`material_id`))) left join `views` `v` on((`v`.`material_id` = `m`.`material_id`))) GROUP BY `m`.`material_id`, `m`.`status`, `u1`.`private`, `u1`.`username`, `u2`.`username` ORDER BY `m`.`created_at` DESC ;

-- --------------------------------------------------------

--
-- Structure for view `user_profile_view`
--
DROP TABLE IF EXISTS `user_profile_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `user_profile_view`  AS SELECT `u`.`user_id` AS `user_id`, `u`.`status` AS `status`, `u`.`private` AS `private`, `u`.`allow_email` AS `allow_email`, `u`.`allow_phone` AS `allow_phone`, `u`.`username` AS `username`, `u`.`full_name` AS `full_name`, `u`.`email` AS `email`, `u`.`phone_number` AS `phone_number`, `u`.`education_level` AS `education_level`, `u`.`enrolled_course` AS `enrolled_course`, `u`.`bio` AS `bio`, `u`.`created_at` AS `created_at`, `u`.`updated_at` AS `updated_at`, `u`.`deleted_at` AS `deleted_at`, `u`.`user_type` AS `user_type`, count(distinct `f1`.`follower_id`) AS `followers_count`, count(distinct `f2`.`following_id`) AS `following_count`, count(distinct `r`.`request_id`) AS `requests_count`, count(distinct `m`.`material_id`) AS `materials_count`, count(distinct `p`.`project_id`) AS `project_count`, count(distinct (case when (`s`.`request_id` is not null) then `s`.`user_id` end)) AS `responded_requests_count` FROM (((((((`users` `u` left join `follow_relation` `fr` on((`u`.`user_id` = `fr`.`following_id`))) left join `follow_relation` `f1` on((`f1`.`following_id` = `u`.`user_id`))) left join `follow_relation` `f2` on((`f2`.`follower_id` = `u`.`user_id`))) left join `study_material_requests` `r` on((`r`.`user_id` = `u`.`user_id`))) left join `study_materials` `m` on((`m`.`user_id` = `u`.`user_id`))) left join `github_projects` `p` on((`p`.`user_id` = `u`.`user_id`))) left join `study_materials` `s` on(((`s`.`user_id` = `u`.`user_id`) and (`s`.`request_id` is not null)))) GROUP BY `u`.`user_id`, `u`.`status`, `u`.`private`, `u`.`allow_email`, `u`.`allow_phone`, `u`.`username`, `u`.`full_name`, `u`.`email`, `u`.`phone_number`, `u`.`education_level`, `u`.`enrolled_course`, `u`.`bio`, `u`.`created_at`, `u`.`updated_at`, `u`.`user_type`, `u`.`deleted_at` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `admin_action_log`
--
ALTER TABLE `admin_action_log`
  ADD PRIMARY KEY (`action_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD PRIMARY KEY (`bookmark_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `material_id` (`material_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `material_id` (`material_id`);

--
-- Indexes for table `follow_relation`
--
ALTER TABLE `follow_relation`
  ADD PRIMARY KEY (`follow_relationship_id`),
  ADD KEY `follower_id` (`follower_id`),
  ADD KEY `following_id` (`following_id`);

--
-- Indexes for table `github_projects`
--
ALTER TABLE `github_projects`
  ADD PRIMARY KEY (`project_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`like_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `material_id` (`material_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `study_materials`
--
ALTER TABLE `study_materials`
  ADD PRIMARY KEY (`material_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `request_id` (`request_id`);

--
-- Indexes for table `study_material_requests`
--
ALTER TABLE `study_material_requests`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `views`
--
ALTER TABLE `views`
  ADD PRIMARY KEY (`view_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `material_id` (`material_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin_action_log`
--
ALTER TABLE `admin_action_log`
  MODIFY `action_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bookmarks`
--
ALTER TABLE `bookmarks`
  MODIFY `bookmark_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `follow_relation`
--
ALTER TABLE `follow_relation`
  MODIFY `follow_relationship_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `github_projects`
--
ALTER TABLE `github_projects`
  MODIFY `project_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `like_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `report_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `study_materials`
--
ALTER TABLE `study_materials`
  MODIFY `material_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `study_material_requests`
--
ALTER TABLE `study_material_requests`
  MODIFY `request_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `views`
--
ALTER TABLE `views`
  MODIFY `view_id` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_action_log`
--
ALTER TABLE `admin_action_log`
  ADD CONSTRAINT `admin_action_log_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`admin_id`) ON UPDATE RESTRICT;

--
-- Constraints for table `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD CONSTRAINT `bookmarks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookmarks_ibfk_2` FOREIGN KEY (`material_id`) REFERENCES `study_materials` (`material_id`) ON DELETE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`material_id`) REFERENCES `study_materials` (`material_id`) ON DELETE CASCADE;

--
-- Constraints for table `follow_relation`
--
ALTER TABLE `follow_relation`
  ADD CONSTRAINT `follow_relation_ibfk_1` FOREIGN KEY (`follower_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `follow_relation_ibfk_2` FOREIGN KEY (`following_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `github_projects`
--
ALTER TABLE `github_projects`
  ADD CONSTRAINT `github_projects_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`material_id`) REFERENCES `study_materials` (`material_id`) ON DELETE CASCADE;

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `study_materials`
--
ALTER TABLE `study_materials`
  ADD CONSTRAINT `study_materials_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `study_materials_ibfk_2` FOREIGN KEY (`request_id`) REFERENCES `study_material_requests` (`request_id`) ON DELETE SET NULL;

--
-- Constraints for table `study_material_requests`
--
ALTER TABLE `study_material_requests`
  ADD CONSTRAINT `study_material_requests_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `views`
--
ALTER TABLE `views`
  ADD CONSTRAINT `views_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `views_ibfk_2` FOREIGN KEY (`material_id`) REFERENCES `study_materials` (`material_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- bossAdmin details for login --
INSERT INTO `admins`(`username`, `password`, `email`)
VALUES(
    'bossAdmin',
    '$2y$10$xg4cEpISn.H7pvQX8ae8Cu/D0r7nUtfG6sdyr5lBVPWIDxwzObjfe',
    'bossAdmin@wizdemy.com'
);