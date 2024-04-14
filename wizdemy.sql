-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 14, 2024 at 05:34 PM
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
  `status` varchar(50) DEFAULT 'active'
) ;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `username`, `password`, `email`, `created_at`, `updated_at`, `status`) VALUES
(1, 'balami', '$2y$10$xg4cEpISn.H7pvQX8ae8Cu/D0r7nUtfG6sdyr5lBVPWIDxwzObjfe', 'rayyan@gmail.com', '2024-04-09 17:39:13', '2024-04-12 14:09:30', 'active'),
(5, 'rahul', '$2y$10$JMdIXP0fREvGKYtXKQmh6Oaobz7meQZopInOKugTUbeUlDnYY1AmO', 'rahul@gmail.com', '2024-04-12 11:07:08', '2024-04-14 16:02:39', 'suspend'),
(6, 'dummy', '$2y$10$q1GUe9OYZJvUzR0lMnkm4eShQ0Y7Q3lz0WUYi6WdyX8kUsOb/kLOy', 'dummy@gmail.com', '2024-04-12 11:17:18', '2024-04-14 16:02:31', 'suspend');

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
) ;

-- --------------------------------------------------------

--
-- Table structure for table `bookmarks`
--

CREATE TABLE `bookmarks` (
  `bookmark_id` int NOT NULL,
  `user_id` int NOT NULL,
  `material_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ;

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
) ;

-- --------------------------------------------------------

--
-- Table structure for table `follow_relation`
--

CREATE TABLE `follow_relation` (
  `follow_relationship_id` int NOT NULL,
  `follower_id` int NOT NULL,
  `following_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ;

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
) ;

--
-- Dumping data for table `github_projects`
--

INSERT INTO `github_projects` (`project_id`, `user_id`, `repo_link`, `created_at`, `updated_at`, `status`) VALUES
(2, 2, 'https://github.com/Rayyan-Balami/wizdemy', '2024-04-11 08:25:00', '2024-04-11 08:25:00', 'active'),
(3, 1, 'https://github.com/Rayyan-Balami/EduExchange', '2024-04-11 16:18:41', '2024-04-11 16:18:41', 'active'),
(4, 1, 'https://github.com/Nishanmahat8/doctor', '2024-04-11 16:19:41', '2024-04-11 16:19:41', 'active'),
(5, 1, 'https://github.com/Satishcg12/safetour-frontend', '2024-04-11 16:19:57', '2024-04-11 16:19:57', 'active'),
(6, 1, 'https://github.com/phhop/website', '2024-04-11 16:20:19', '2024-04-11 16:20:19', 'active'),
(7, 1, 'https://github.com/flukeout/css-diner', '2024-04-11 16:21:02', '2024-04-11 16:21:02', 'active'),
(8, 1, 'https://github.com/laravel/framework', '2024-04-11 16:22:04', '2024-04-14 14:22:49', 'active'),
(9, 1, 'https://github.com/reliese/laravel', '2024-04-11 16:22:30', '2024-04-11 16:22:30', 'active'),
(10, 1, 'https://github.com/facebook/react', '2024-04-11 16:23:01', '2024-04-11 16:23:01', 'active'),
(11, 3, 'https://github.com/vuejs/vue', '2024-04-11 16:29:13', '2024-04-11 16:29:13', 'active'),
(13, 1, 'https://github.com/HiFIi/GoogleSearchMaterialDesignConcept', '2024-04-11 16:32:43', '2024-04-11 16:32:43', 'active'),
(14, 1, 'https://github.com/bitbandtesting/LongRepoNameLongRepoNameLongRepoNameLongRepoNameLongRepoNameLongRepoNameLongRepoName', '2024-04-11 16:34:09', '2024-04-11 16:34:09', 'active'),
(15, 1, 'https://github.com/jimkang/you-can-stop-naming-repos-awesome', '2024-04-11 16:40:42', '2024-04-11 16:40:42', 'active'),
(16, 1, 'https://github.com/HashenUdara/edoc-doctor-appointment-system', '2024-04-11 16:42:51', '2024-04-11 16:42:51', 'active'),
(17, 1, 'https://github.com/sultanbepari/STEPin_Restaurant_Food_Odering_Management_System', '2024-04-11 16:43:46', '2024-04-11 16:43:46', 'active'),
(18, 3, 'https://github.com/Nasir1004/My_FoodApp', '2024-04-11 16:45:12', '2024-04-11 16:45:12', 'active'),
(19, 3, 'https://github.com/julia-/room-booking-system', '2024-04-11 16:45:57', '2024-04-11 16:45:57', 'active'),
(20, 3, 'https://github.com/SamiurRahmanMukul/React-Project-Hotel-Room-Booking', '2024-04-11 16:46:54', '2024-04-11 16:46:54', 'active'),
(21, 3, 'https://github.com/acidanthera/AppleALC', '2024-04-11 16:48:52', '2024-04-11 16:48:52', 'active'),
(22, 3, 'https://github.com/balderdashy/waterline', '2024-04-11 16:49:29', '2024-04-11 16:49:29', 'active'),
(23, 2, 'https://github.com/zhongyang219/TrafficMonitor', '2024-04-11 16:50:29', '2024-04-11 16:50:29', 'active'),
(24, 3, 'https://github.com/facebookarchive/augmented-traffic-control', '2024-04-11 16:50:50', '2024-04-11 16:50:50', 'active'),
(25, 2, 'https://github.com/xiaochus/TrafficFlowPrediction', '2024-04-11 16:52:52', '2024-04-11 16:52:52', 'active'),
(26, 3, 'https://github.com/VHAINNOVATIONS/Maternity-Tracker', '2024-04-11 16:53:17', '2024-04-11 16:53:17', 'active'),
(27, 2, 'https://github.com/erikflowers/weather-icons', '2024-04-11 16:54:40', '2024-04-11 16:54:40', 'active'),
(28, 2, 'https://github.com/leapfrogtechnology/nepali-date-picker', '2024-04-11 16:55:08', '2024-04-11 16:55:08', 'active'),
(29, 2, 'https://github.com/TachibanaYoshino/AnimeGAN', '2024-04-11 16:59:15', '2024-04-11 16:59:15', 'active'),
(30, 2, 'https://github.com/vikhyatsingh123/Naruto-Shippuden', '2024-04-11 16:59:57', '2024-04-14 14:19:52', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `like_id` int NOT NULL,
  `user_id` int NOT NULL,
  `material_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `material_view`
-- (See below for the actual view)
--
CREATE TABLE `material_view` (
`material_id` int
,`status` varchar(50)
,`user_id` int
,`request_id` int
,`title` varchar(255)
,`description` text
,`document_type` varchar(255)
,`format` varchar(255)
,`education_level` varchar(255)
,`semester` varchar(255)
,`subject` varchar(255)
,`author` varchar(255)
,`file_path` varchar(255)
,`thumbnail_path` varchar(255)
,`class_faculty` varchar(255)
,`created_at` timestamp
,`updated_at` timestamp
,`private` tinyint(1)
,`username` varchar(30)
,`responded_to` varchar(30)
,`likes_count` bigint
,`comments_count` bigint
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
) ;

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
) ;

--
-- Dumping data for table `study_materials`
--

INSERT INTO `study_materials` (`material_id`, `user_id`, `request_id`, `title`, `description`, `document_type`, `format`, `education_level`, `semester`, `subject`, `author`, `file_path`, `thumbnail_path`, `class_faculty`, `created_at`, `updated_at`, `status`) VALUES
(3, 1, NULL, 'Q &amp; A | Maths | BCA | 1st Sem | JANE SMITH', 'In BCA&#039;s first semester, Jane Smith delves into the realm of mathematics, exploring sets, relations, functions, matrices, and calculus. These foundational concepts pave the way for her understanding of computational theories and their practical applications in computer science. Through rigorous study and problem-solving, she builds a solid mathematical foundation essential for her academic and professional growth.', 'question', 'typed', 'bachelor', 'first', 'Maths', 'jane smith', 'assets/uploads/documents/6617b14d5a441_.pdf', 'assets/uploads/thumbnails/6617b14d5a2ed_.png', 'bca', '2024-04-11 09:45:49', '2024-04-11 09:45:49', 'active'),
(4, 1, NULL, 'LabReport OS | BCA 4rth sem | Rosy Teacher', 'In the fourth semester of BCA, under the guidance of Professor Rosy, students undertake practical exercises and experiments in Operating Systems (OS). These lab sessions provide hands-on experience in system administration, process management, memory allocation, and file systems. Through these activities, students gain a deeper understanding of OS concepts and develop essential skills for managing and troubleshooting computer systems effectively.', 'labreport', 'handwritten', 'bachelor', 'fourth', 'Operating System', 'Rosy Teacher', 'assets/uploads/documents/6617b30890c05_.pdf', 'assets/uploads/thumbnails/6617b30890840_.png', 'bca', '2024-04-11 09:53:12', '2024-04-11 09:53:12', 'active'),
(5, 1, NULL, 'Coffee notes | HM | 12 class | Management | Cafy Park', 'The description is Cofee notes | HM | 12 class | Management | Cafy Park Cofee notes | HM | 12 class | Management | Cafy Park Cofee notes | HM | 12 class | Management | Cafy Park Cofee notes | HM | 12 class | Management | Cafy Park Cofee notes | HM | 12 class | Management | Cafy Park Cofee notes | HM | 12 class | Management | Cafy Park', 'note', 'photo', 'school', '', 'Hotel Management', 'Cafy Park', 'assets/uploads/documents/6617b63a0ecde_.pdf', 'assets/uploads/thumbnails/6617b63a0e7ce_.png', '12 class', '2024-04-11 10:06:50', '2024-04-11 14:25:52', 'active'),
(6, 2, NULL, 'WEB DEV Notes | BCA | 3rd &amp; 4rth Sem | Rayyan Balami', 'WEB DEV Notes | BCA | 3rd &amp; 4rth Sem | Rayyan Balami WEB DEV Notes | BCA | 3rd &amp; 4rth Sem | Rayyan Balami WEB DEV Notes | BCA | 3rd &amp; 4rth Sem | Rayyan Balami WEB DEV Notes | BCA | 3rd &amp; 4rth Sem | Rayyan Balami WEB DEV Notes | BCA | 3rd &amp; 4rth Sem | Rayyan Balami WEB DEV Notes | BCA | 3rd &amp; 4rth Sem | Rayyan Balami WEB DEV Notes | BCA | 3rd &amp; 4rth Sem | Rayyan Balami WEB', 'note', 'handwritten', 'bachelor', 'third', 'web development', 'rayyan balami', 'assets/uploads/documents/6617f64d23c26_.pdf', 'assets/uploads/thumbnails/6617f64d238f2_.png', 'bca', '2024-04-11 14:40:13', '2024-04-11 14:40:13', 'active'),
(7, 1, 5, 'I Pizza You | HM Notes | 12 class | Amy Pizu | 🍕', 'This in response of request made my Mr. Elon, he needed notes for HM 12 class, here is a note in related topic . hope this hepls you well in your studies, I found this note online from oter side so i am uplaoding here , the actual author of this note is Mrs, Amy Pizu', 'note', 'typed', '+2', '', 'hotel management', 'Amy Pizu', 'assets/uploads/documents/661803ab53f58_.pdf', 'assets/uploads/thumbnails/661803ab53c19_.png', '12 class', '2024-04-11 15:37:15', '2024-04-11 15:37:15', 'active'),
(8, 3, 4, 'Note of Microprocessor | BCA | 2nd Sem | 2024 | Mahesh Rao Teacher | Kathmandu Business Campus', 'the description of this notes are :\r\n1 &gt; Note of Microprocessor | BCA | 2nd Sem | 2024 | Mahesh Rao Teacher | Kathmandu Business Campus\r\n2 &gt; Note of Microprocessor | BCA | 2nd Sem | 2024 | Mahesh Rao Teacher | Kathmandu Business Campus\r\n3 &gt; Note of Microprocessor | BCA | 2nd Sem | 2024 | Mahesh Rao Teacher | Kathmandu Business Campus', 'note', 'typed', 'bachelor', 'fourth', 'microprocessor', 'Mahesh Rao Teacher', 'assets/uploads/documents/66180945cbbc2_.pdf', 'assets/uploads/thumbnails/66180945cb8cd_.png', 'bca', '2024-04-11 16:01:09', '2024-04-11 16:01:09', 'active'),
(9, 2, 6, 'DSA Notes - Queue &amp; Stack | CSIT Field | John Johnson | 2024', 'DSA Notes - Queue &amp; Stack | CSIT Field | John Johnson | 2024 DSA Notes - Queue &amp; Stack | CSIT Field | John Johnson | 2024 DSA Notes - Queue &amp; Stack | CSIT Field | John Johnson | 2024 DSA Notes - Queue &amp; Stack | CSIT Field | John Johnson | 2024 DSA Notes - Queue &amp; Stack | CSIT Field | John Johnson | 2024 DSA Notes - Queue &amp; Stack | CSIT Field | John Johnson | 2024', 'note', 'photo', 'bachelor', 'third', 'DSA', 'John Johnson', 'assets/uploads/documents/661828dfbf74e_.pdf', 'assets/uploads/thumbnails/661828dfbf22b_.png', 'csit', '2024-04-11 18:15:59', '2024-04-11 18:15:59', 'active'),
(10, 2, 8, 'labreport of all subject in BCA 4rth sem', 'labreport of all subject in BCA 4rth sem labreport of all subject in BCA 4rth sem labreport of all subject in BCA 4rth sem labreport of all subject in BCA 4rth sem labreport of all subject in BCA 4rth sem', 'labreport', 'handwritten', 'bachelor', 'fourth', 'All subject', 'elon musk', 'assets/uploads/documents/6618ed52daac0_.pdf', 'assets/uploads/thumbnails/6618ed52da8c2_.png', 'bca', '2024-04-12 08:14:10', '2024-04-12 08:14:10', 'active'),
(11, 2, 7, 'Past Questions of Java for BCA 3rd sem', 'Past Questions of Java for BCA 3rd sem Past Questions of Java for BCA 3rd sem Past Questions of Java for BCA 3rd sem Past Questions of Java for BCA 3rd sem Past Questions of Java for BCA 3rd sem Past Questions of Java for BCA 3rd sem', 'question', 'photo', 'bachelor', 'fourth', 'java', 'Rayyan balami', 'assets/uploads/documents/6618ede0be7c9_.pdf', 'assets/uploads/thumbnails/6618ede0be5d8_.png', 'bca', '2024-04-12 08:16:32', '2024-04-12 08:16:32', 'active'),
(12, 3, 7, 'Java for BCA 3rd sem |  Past Questions | Answers', 'Java for BCA 3rd sem |  Past Questions | Answers Java for BCA 3rd sem |  Past Questions | Answers Java for BCA 3rd sem |  Past Questions | Answers Java for BCA 3rd sem |  Past Questions | Answers', 'question', 'photo', 'bachelor', 'fourth', 'java', 'bca notes', 'assets/uploads/documents/6618eed7d07b0_.pdf', 'assets/uploads/thumbnails/6618eed7d050c_.png', 'bca', '2024-04-12 08:20:39', '2024-04-12 08:20:39', 'active'),
(13, 1, 9, 'Numerical method Notes | All covered | BCA | 4rth Sem', 'Numerical method Notes | All covered | BCA | 4rth Sem Numerical method Notes | All covered | BCA | 4rth Sem Numerical method Notes | All covered | BCA | 4rth Sem Numerical method Notes | All covered | BCA | 4rth Sem Numerical method Notes | All covered | BCA | 4rth Sem Numerical method Notes | All covered | BCA | 4rth Sem', 'note', 'handwritten', 'bachelor', 'fourth', 'Numerical method', 'Fam guy', 'assets/uploads/documents/6618f1abb9c91_.pdf', 'assets/uploads/thumbnails/6618f1abb9abb_.png', 'bca', '2024-04-12 08:32:43', '2024-04-12 08:32:43', 'active'),
(14, 3, NULL, 'Lets&#039;s learn Tailwind 🪼| Web Dev Course | Free Notes | 2024', 'Lets&#039;s learn Tailwind 🪼| Web Dev Course | Free Notes | 2024 Lets&#039;s learn Tailwind 🪼| Web Dev Course | Free Notes | 2024 Lets&#039;s learn Tailwind 🪼| Web Dev Course | Free Notes | 2024 Lets&#039;s learn Tailwind 🪼| Web Dev Course | Free Notes | 2024 Lets&#039;s learn Tailwind 🪼| Web Dev Course | Free Notes | 2024', 'note', 'typed', '+2', '', 'Computer science', 'harry youtuber', 'assets/uploads/documents/6618f2b6c239a_.pdf', 'assets/uploads/thumbnails/6618f2b6c2031_.png', '11 class', '2024-04-12 08:37:10', '2024-04-12 08:37:10', 'active'),
(15, 1, 10, 'Notes of software engineering | BCA &amp; CSIT | By : Rompom Teacher', 'Notes of software engineering | BCA &amp; CSIT | By : Rompom Teacher Notes of software engineering | BCA &amp; CSIT | By : Rompom Teacher Notes of software engineering | BCA &amp; CSIT | By : Rompom Teacher Notes of software engineering | BCA &amp; CSIT | By : Rompom Teacher Notes of software engineering | BCA &amp; CSIT | By : Rompom Teacher Notes of software engineering | BCA &amp; CSIT | By : Rompom Teacher', 'note', 'typed', 'bachelor', 'fourth', 'software engineering', 'Rompom Teacher Youtubey', 'assets/uploads/documents/6618f38689fb8_.pdf', 'assets/uploads/thumbnails/6618f38689d54_.png', 'csit', '2024-04-12 08:40:38', '2024-04-12 08:40:38', 'active'),
(16, 3, NULL, 'Javascript notes all bachelor level | 2024 | #JS', 'Javascript notes all bachelor level | 2024 | #JS Javascript notes all bachelor level | 2024 | #JS Javascript notes all bachelor level | 2024 | #JS Javascript notes all bachelor level | 2024 | #JS Javascript notes all bachelor level | 2024 | #JS', 'note', 'typed', 'bachelor', '', 'java script', 'rahul rahi', 'assets/uploads/documents/6618f4fc80e6f_.pdf', 'assets/uploads/thumbnails/6618f4fc80b38_.png', 'All Bachlor', '2024-04-12 08:46:52', '2024-04-12 08:46:52', 'active'),
(17, 1, NULL, 'Uploading from mobile', 'Uploading from mobile Uploading from mobile Uploading from mobile', 'labreport', 'typed', 'school', '', 'Xyz', 'Ryn', 'assets/uploads/documents/66193846984c9_.pdf', 'assets/uploads/thumbnails/6619384698206_.jpg', 'Xyz', '2024-04-12 13:33:58', '2024-04-12 13:33:58', 'active'),
(18, 1, NULL, '🤓🍕🔍 🤓🍕🔍', '🤔🤣🤣🤣🤣😘😁😶😊🤌🏀🤭😁🫂😶😯😶😊🤥😎👐😶😯😶', 'note', 'typed', 'school', 'fourth', '🤓🍕🔍', '🤓🍕🔍', 'assets/uploads/documents/661939002b474_.pdf', 'assets/uploads/thumbnails/661939002b264_.jpg', '🤓🍕🔍', '2024-04-12 13:37:04', '2024-04-14 17:01:23', 'suspend'),
(19, 1, NULL, '🤗🤗🤗🤗🤗', 'Oke this is nice material 👌 👍', 'question', 'typed', 'school', '', '🤗🤗🤗', '🤗🤗🤗', 'assets/uploads/documents/6619396ff2f94_.pdf', 'assets/uploads/thumbnails/6619396ff2d01_.jpg', '😆😆😆', '2024-04-12 13:38:55', '2024-04-14 17:27:20', 'active');

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
) ;

--
-- Dumping data for table `study_material_requests`
--

INSERT INTO `study_material_requests` (`request_id`, `title`, `description`, `education_level`, `semester`, `subject`, `class_faculty`, `document_type`, `user_id`, `created_at`, `updated_at`, `status`) VALUES
(4, 'Note of Microprocessor | BCA | 2nd Sem | 2024', 'my needs are such that Note of Microprocessor | BCA | 2nd Sem | 2024 Note of Microprocessor | BCA | 2nd Sem | 2024 Note of Microprocessor | BCA | 2nd Sem | 2024 Note of Microprocessor | BCA | 2nd Sem | 2024 Note of Microprocessor | BCA | 2nd Sem | 2024 Note of Microprocessor | BCA | 2nd Sem | 2024 Note of Microprocessor | BCA | 2nd Sem | 2024 Note of Microprocessor | BCA | 2nd Sem | 2024 Note of Microprocessor | BCA | 2nd Sem | 2024', 'bachelor', 'fourth', 'microprocessor', 'bca', 'note', 2, '2024-04-11 15:15:43', '2024-04-11 15:15:43', 'active'),
(5, 'I need a notes on making pizza steps for 12 class hotel management exam', 'my description of this request is this that and that .my description of this request is this that and that .my description of this request is this that and that .my description of this request is this that and that .my description of this request is this that and that .', '+2', '', 'hotel management', '12 class', 'note', 2, '2024-04-11 15:31:33', '2024-04-11 15:31:33', 'active'),
(6, 'Need DSA Notes for CSIT Field', 'Need DSA Notes for CSIT Field Need DSA Notes for CSIT Field Need DSA Notes for CSIT Field Need DSA Notes for CSIT Field Need DSA Notes for CSIT Field', 'bachelor', 'third', 'DSA', 'csit', 'note', 1, '2024-04-11 16:17:38', '2024-04-11 16:17:38', 'active'),
(7, 'Need Past Questions of Java for BCA 3rd sem student exam purpuse', 'Need Past Questions of Java for BCA 3rd sem student exam purpuse Need Past Questions of Java for BCA 3rd sem student exam purpuse Need Past Questions of Java for BCA 3rd sem student exam purpuse Need Past Questions of Java for BCA 3rd sem student exam purpuse Need Past Questions of Java for BCA 3rd sem student exam purpuse Need Past Questions of Java for BCA 3rd sem student exam purpuse Need Past Questions of Java for BCA 3rd sem student exam purpuse Need Past Questions of Java for BCA 3rd sem student exam purpuse Need Past Question', 'bachelor', 'fourth', 'java', 'bca', 'question', 1, '2024-04-12 07:55:58', '2024-04-12 07:55:58', 'active'),
(8, 'Need labreport of all subject in BCA 4rth sem', 'Need labreport of all subject in BCA 4rth sem Need labreport of all subject in BCA 4rth sem Need labreport of all subject in BCA 4rth sem Need labreport of all subject in BCA 4rth sem Need labreport of all subject in BCA 4rth sem Need labreport of all subject in BCA 4rth sem Need labreport of all subject in BCA 4rth sem Need labreport of all subject in BCA 4rth sem ', 'bachelor', 'fourth', 'All subject', 'bca', 'labreport', 1, '2024-04-12 08:10:39', '2024-04-12 08:10:39', 'active'),
(9, 'Numerical method Notes is needed | urgetly | bca', 'Numerical method Notes is needed | urgetly | bca Numerical method Notes is needed | urgetly | bca Numerical method Notes is needed | urgetly | bca Numerical method Notes is needed | urgetly | bca Numerical method Notes is needed | urgetly | bca', 'bachelor', 'fourth', 'Numerical method', 'bca', 'note', 1, '2024-04-12 08:25:42', '2024-04-12 08:25:42', 'active'),
(10, 'Need notes of software engineering', 'Need notes of software engineering Need notes of software engineering Need notes of software engineering', 'bachelor', 'fourth', 'software engineering', 'csit', 'note', 2, '2024-04-12 08:38:52', '2024-04-14 10:57:14', 'suspend'),
(11, 'Note 1', 'Description for Note 1', 'Education Level', 'Semester', 'Subject', 'Class Faculty', 'note', 1, '2024-04-14 11:17:55', '2024-04-14 11:17:55', 'active'),
(12, 'Note 2', 'Description for Note 2', 'Education Level', 'Semester', 'Subject', 'Class Faculty', 'note', 1, '2024-04-14 11:17:55', '2024-04-14 11:17:55', 'active'),
(13, 'Note 3', 'Description for Note 3', 'Education Level', 'Semester', 'Subject', 'Class Faculty', 'note', 1, '2024-04-14 11:17:55', '2024-04-14 11:17:55', 'active'),
(14, 'Note 4', 'Description for Note 4', 'Education Level', 'Semester', 'Subject', 'Class Faculty', 'note', 1, '2024-04-14 11:17:55', '2024-04-14 11:17:55', 'active'),
(15, 'Note 5', 'Description for Note 5', 'Education Level', 'Semester', 'Subject', 'Class Faculty', 'note', 1, '2024-04-14 11:17:55', '2024-04-14 11:17:55', 'active'),
(16, 'Note 6', 'Description for Note 6', 'Education Level', 'Semester', 'Subject', 'Class Faculty', 'note', 1, '2024-04-14 11:17:55', '2024-04-14 11:17:55', 'active'),
(17, 'Note 7', 'Description for Note 7', 'Education Level', 'Semester', 'Subject', 'Class Faculty', 'note', 1, '2024-04-14 11:17:55', '2024-04-14 11:17:55', 'active'),
(18, 'Note 8', 'Description for Note 8', 'Education Level', 'Semester', 'Subject', 'Class Faculty', 'note', 1, '2024-04-14 11:17:55', '2024-04-14 11:17:55', 'active'),
(19, 'Note 9', 'Description for Note 9', 'Education Level', 'Semester', 'Subject', 'Class Faculty', 'note', 1, '2024-04-14 11:17:55', '2024-04-14 14:11:01', 'active'),
(26, 'Question 1', 'Description for Question 1', 'Education Level', 'Semester', 'Subject', 'Class Faculty', 'question', 1, '2024-04-14 11:17:55', '2024-04-14 11:23:06', 'suspend'),
(28, 'Question 3', 'Description for Question 3', 'Education Level', 'Semester', 'Subject', 'Class Faculty', 'question', 1, '2024-04-14 11:17:55', '2024-04-14 11:17:55', 'active'),
(29, 'Question 4', 'Description for Question 4', 'Education Level', 'Semester', 'Subject', 'Class Faculty', 'question', 1, '2024-04-14 11:17:55', '2024-04-14 11:17:55', 'active'),
(30, 'Question 5', 'Description for Question 5', 'Education Level', 'Semester', 'Subject', 'Class Faculty', 'question', 1, '2024-04-14 11:17:55', '2024-04-14 11:17:55', 'active'),
(31, 'Question 6', 'Description for Question 6', 'Education Level', 'Semester', 'Subject', 'Class Faculty', 'question', 1, '2024-04-14 11:17:55', '2024-04-14 11:17:55', 'active'),
(32, 'Question 7', 'Description for Question 7', 'Education Level', 'Semester', 'Subject', 'Class Faculty', 'question', 1, '2024-04-14 11:17:55', '2024-04-14 11:17:55', 'active'),
(33, 'Question 8', 'Description for Question 8', 'Education Level', 'Semester', 'Subject', 'Class Faculty', 'question', 1, '2024-04-14 11:17:55', '2024-04-14 11:17:55', 'active'),
(34, 'Question 9', 'Description for Question 9', 'Education Level', 'Semester', 'Subject', 'Class Faculty', 'question', 1, '2024-04-14 11:17:55', '2024-04-14 11:17:55', 'active'),
(35, 'Question 10', 'Description for Question 10', 'Education Level', 'Semester', 'Subject', 'Class Faculty', 'question', 1, '2024-04-14 11:17:55', '2024-04-14 11:17:55', 'active'),
(41, 'Lab Report 1', 'Description for Lab Report 1', 'Education Level', 'Semester', 'Subject', 'Class Faculty', 'labreport', 1, '2024-04-14 11:17:55', '2024-04-14 11:17:55', 'active'),
(42, 'Lab Report 2', 'Description for Lab Report 2', 'Education Level', 'Semester', 'Subject', 'Class Faculty', 'labreport', 1, '2024-04-14 11:17:55', '2024-04-14 11:17:55', 'active'),
(43, 'Lab Report 3', 'Description for Lab Report 3', 'Education Level', 'Semester', 'Subject', 'Class Faculty', 'labreport', 1, '2024-04-14 11:17:55', '2024-04-14 11:17:55', 'active'),
(44, 'Lab Report 4', 'Description for Lab Report 4', 'Education Level', 'Semester', 'Subject', 'Class Faculty', 'labreport', 1, '2024-04-14 11:17:55', '2024-04-14 11:17:55', 'active'),
(45, 'Lab Report 5', 'Description for Lab Report 5', 'Education Level', 'Semester', 'Subject', 'Class Faculty', 'labreport', 1, '2024-04-14 11:17:55', '2024-04-14 11:17:55', 'active'),
(50, 'Lab Report 10', 'Description for Lab Report 10', 'Education Level', 'Semester', 'Subject', 'Class Faculty', 'labreport', 1, '2024-04-14 11:17:55', '2024-04-14 11:17:55', 'active');

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
  `status` varchar(50) DEFAULT 'active'
) ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `full_name`, `private`, `bio`, `user_type`, `education_level`, `enrolled_course`, `school_name`, `password`, `created_at`, `updated_at`, `phone_number`, `allow_email`, `allow_phone`, `status`) VALUES
(1, 'sus', 'sus@gmail.com', 'rayyan balami', 0, 'Hey there! I am using Wizdemy', 'student', 'bachelor', '', '', '$2y$10$YyUmiw7m6Dd27qPBP./4O.8YpT44u3bpIjDa5EogHw.t475x5rH1C', '2024-04-09 09:20:49', '2024-04-13 13:00:53', '9844475577', 1, 1, 'active'),
(2, 'fulu', 'elon@gmail.com', 'fulkumari stha', 1, 'Hey there! I am using Wizdemy', 'institution', 'diploma', '', '', '$2y$10$Tgdgk3MKwNlk8AZdqBSbreLqNrzCIy9o9CmFDvg0vceZqEKGb7lBG', '2024-04-10 10:11:34', '2024-04-14 14:47:55', '9844475577', 1, 1, 'active'),
(3, 'KBC-COLLEGE', 'kbc@gmail.com', 'Kathmandu Business Campus', 0, 'We are colloege offering an education on BCA, BBS', 'institution', 'bachelor', '', '', '$2y$10$uF5VidyWK8IkxaYDDFxx3uc1S1FPEa/8ai8FOQXuvWQ0f319bZ4HG', '2024-04-11 15:39:17', '2024-04-13 08:14:04', '', 1, 0, 'active'),
(7, 'user4', 'user4@example.com', 'User Four', 0, 'Hey there! I am User Four.', 'Student', 'Bachelor', 'Physics', 'University Four', 'password4', '2024-04-14 11:01:17', '2024-04-14 14:11:32', '1234567893', 1, 0, 'suspend'),
(8, 'user5', 'user5@example.com', 'User Five', 0, 'Hey there! I am User Five.', 'Student', 'Master', 'Chemistry', 'University Five', 'password5', '2024-04-14 11:01:17', '2024-04-14 13:52:11', '1234567894', 1, 0, 'active'),
(9, 'user6', 'user6@example.com', 'User Six', 0, 'Hey there! I am User Six.', 'Student', 'PhD', 'Biology', 'University Six', 'password6', '2024-04-14 11:01:17', '2024-04-14 13:52:07', '1234567895', 1, 0, 'suspend'),
(10, 'user7', 'user7@example.com', 'User Seven', 0, 'Hey there! I am User Seven.', 'Student', 'Bachelor', 'History', 'University Seven', 'password7', '2024-04-14 11:01:17', '2024-04-14 11:01:17', '1234567896', 1, 0, 'active'),
(11, 'user8', 'user8@example.com', 'User Eight', 0, 'Hey there! I am User Eight.', 'Student', 'Bachelor', 'Geography', 'University Eight', 'password8', '2024-04-14 11:01:17', '2024-04-14 11:01:17', '1234567897', 1, 0, 'active'),
(12, 'user9', 'user9@example.com', 'User Nine', 0, 'Hey there! I am User Nine.', 'Student', 'Master', 'Economics', 'University Nine', 'password9', '2024-04-14 11:01:17', '2024-04-14 11:01:17', '1234567898', 1, 0, 'active'),
(13, 'user10', 'user10@example.com', 'User Ten', 0, 'Hey there! I am User Ten.', 'Student', 'Bachelor', 'Finance', 'University Ten', 'password10', '2024-04-14 11:01:17', '2024-04-14 11:01:17', '1234567899', 1, 0, 'active');

-- --------------------------------------------------------

--
-- Stand-in structure for view `user_profile_view`
-- (See below for the actual view)
--
CREATE TABLE `user_profile_view` (
`user_id` int
,`status` varchar(50)
,`private` tinyint(1)
,`allow_email` tinyint(1)
,`allow_phone` tinyint(1)
,`username` varchar(30)
,`full_name` varchar(100)
,`email` varchar(100)
,`phone_number` varchar(20)
,`education_level` varchar(100)
,`enrolled_course` varchar(100)
,`bio` varchar(150)
,`created_at` timestamp
,`updated_at` timestamp
,`user_type` varchar(50)
,`followers_count` bigint
,`following_count` bigint
,`requests_count` bigint
,`materials_count` bigint
,`project_count` bigint
,`responded_requests_count` bigint
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
) ;

-- --------------------------------------------------------

--
-- Structure for view `material_view`
--
DROP TABLE IF EXISTS `material_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `material_view`  AS SELECT `m`.`material_id` AS `material_id`, `m`.`status` AS `status`, `m`.`user_id` AS `user_id`, `m`.`request_id` AS `request_id`, `m`.`title` AS `title`, `m`.`description` AS `description`, `m`.`document_type` AS `document_type`, `m`.`format` AS `format`, `m`.`education_level` AS `education_level`, `m`.`semester` AS `semester`, `m`.`subject` AS `subject`, `m`.`author` AS `author`, `m`.`file_path` AS `file_path`, `m`.`thumbnail_path` AS `thumbnail_path`, `m`.`class_faculty` AS `class_faculty`, `m`.`created_at` AS `created_at`, `m`.`updated_at` AS `updated_at`, `u1`.`private` AS `private`, `u1`.`username` AS `username`, `u2`.`username` AS `responded_to`, count(distinct `l`.`like_id`) AS `likes_count`, count(distinct `c`.`comment_id`) AS `comments_count`, count(distinct `v`.`view_id`) AS `views_count` FROM ((((((`study_materials` `m` left join `users` `u1` on((`u1`.`user_id` = `m`.`user_id`))) left join `study_material_requests` `r` on((`r`.`request_id` = `m`.`request_id`))) left join `users` `u2` on((`u2`.`user_id` = `r`.`user_id`))) left join `likes` `l` on((`l`.`material_id` = `m`.`material_id`))) left join `comments` `c` on((`c`.`material_id` = `m`.`material_id`))) left join `views` `v` on((`v`.`material_id` = `m`.`material_id`))) GROUP BY `m`.`material_id`, `m`.`status`, `u1`.`private`, `u1`.`username`, `u2`.`username` ORDER BY `m`.`created_at` DESC ;

-- --------------------------------------------------------

--
-- Structure for view `user_profile_view`
--
DROP TABLE IF EXISTS `user_profile_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `user_profile_view`  AS SELECT `u`.`user_id` AS `user_id`, `u`.`status` AS `status`, `u`.`private` AS `private`, `u`.`allow_email` AS `allow_email`, `u`.`allow_phone` AS `allow_phone`, `u`.`username` AS `username`, `u`.`full_name` AS `full_name`, `u`.`email` AS `email`, `u`.`phone_number` AS `phone_number`, `u`.`education_level` AS `education_level`, `u`.`enrolled_course` AS `enrolled_course`, `u`.`bio` AS `bio`, `u`.`created_at` AS `created_at`, `u`.`updated_at` AS `updated_at`, `u`.`user_type` AS `user_type`, count(distinct `f1`.`follower_id`) AS `followers_count`, count(distinct `f2`.`following_id`) AS `following_count`, count(distinct `r`.`request_id`) AS `requests_count`, count(distinct `m`.`material_id`) AS `materials_count`, count(distinct `p`.`project_id`) AS `project_count`, count(distinct (case when (`s`.`request_id` is not null) then `s`.`user_id` end)) AS `responded_requests_count` FROM (((((((`users` `u` left join `follow_relation` `fr` on((`u`.`user_id` = `fr`.`following_id`))) left join `follow_relation` `f1` on((`f1`.`following_id` = `u`.`user_id`))) left join `follow_relation` `f2` on((`f2`.`follower_id` = `u`.`user_id`))) left join `study_material_requests` `r` on((`r`.`user_id` = `u`.`user_id`))) left join `study_materials` `m` on((`m`.`user_id` = `u`.`user_id`))) left join `github_projects` `p` on((`p`.`user_id` = `u`.`user_id`))) left join `study_materials` `s` on(((`s`.`user_id` = `u`.`user_id`) and (`s`.`request_id` is not null)))) GROUP BY `u`.`user_id`, `u`.`status`, `u`.`private`, `u`.`allow_email`, `u`.`allow_phone`, `u`.`username`, `u`.`full_name`, `u`.`email`, `u`.`phone_number`, `u`.`education_level`, `u`.`enrolled_course`, `u`.`bio`, `u`.`created_at`, `u`.`updated_at`, `u`.`user_type` ;

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
  MODIFY `admin_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
  MODIFY `project_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

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
  MODIFY `material_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `study_material_requests`
--
ALTER TABLE `study_material_requests`
  MODIFY `request_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

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
