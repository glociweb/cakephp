-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 02, 2015 at 04:54 AM
-- Server version: 5.5.42-cll
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `navneeld_wire`
--

-- --------------------------------------------------------

--
-- Table structure for table `ce_actionitems`
--

CREATE TABLE IF NOT EXISTS `ce_actionitems` (
  `id` varchar(36) NOT NULL,
  `project_id` varchar(36) NOT NULL,
  `note_id` varchar(36) NOT NULL,
  `action_type` varchar(36) NOT NULL COMMENT 'mention=>if user mentioned in note as attendie ; action=>if user mentioned in action item',
  `username` varchar(255) NOT NULL,
  `completed` int(11) NOT NULL,
  `priority` varchar(50) NOT NULL DEFAULT 'normal',
  `action_content` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ce_actionitems`
--

INSERT INTO `ce_actionitems` (`id`, `project_id`, `note_id`, `action_type`, `username`, `completed`, `priority`, `action_content`, `created`, `modified`) VALUES
('55929543-bb44-4459-ab39-20550a11ef94', '558b8b6e-71ec-4c2f-8fd1-2b330a11ef94', '', 'action', 'admin', 0, 'normal', ' &nbsp;<a class="red action-items" contenteditable="false" href="#">admin</a>&nbsp;this is low priority task<select class="priority"><option value="low">Low</option><option value="normal">Normal</option><option value="high">High</option></select>', '2015-06-30 13:10:27', '2015-06-30 13:10:27'),
('55929543-3200-4f8c-8557-20540a11ef94', '558b8b6e-71ec-4c2f-8fd1-2b330a11ef94', '', 'action', 'admin3', 0, 'normal', ' &nbsp;<a class="red action-items" contenteditable="false" href="#">admin3</a>&nbsp;this is by default normal<span data-original-title="click to change priority" data-rel="tooltip" contenteditable="false" class="prioritychange label normal">normal</span>', '2015-06-30 13:10:27', '2015-06-30 13:10:27'),
('55929543-d634-41b3-84d0-20560a11ef94', '558b8b6e-71ec-4c2f-8fd1-2b330a11ef94', '', 'action', 'kumar', 0, 'normal', ' &nbsp;<a class="red action-items" contenteditable="false" href="#">kumar</a>&nbsp;i can change on click the priority lable<span data-original-title="click to change priority" data-rel="tooltip" contenteditable="false" class="prioritychange label normal">normal</span>', '2015-06-30 13:10:27', '2015-06-30 13:10:27'),
('55929543-aa38-42d0-bdee-20530a11ef94', '558b8b6e-71ec-4c2f-8fd1-2b330a11ef94', '', 'action', 'superadmin', 0, 'normal', ' &nbsp;<a class="red action-items" contenteditable="false" href="#">superadmin</a>&nbsp;this is on high priority task&nbsp;<span data-original-title="click to change priority" data-rel="tooltip" contenteditable="false" class="prioritychange label high">high</span>', '2015-06-30 13:10:27', '2015-06-30 13:13:08'),
('5592955d-6334-49c5-b836-22150a11ef94', '55924f6a-65e8-4279-93d6-257c0a11ef94', '', 'action', 'admin', 0, 'normal', ' &nbsp;<a class="red action-items" contenteditable="false" href="#">admin</a>&nbsp;this is low priority task<span data-original-title="click to change priority" data-rel="tooltip" contenteditable="false" class="prioritychange label high">high</span>', '2015-06-30 13:10:53', '2015-06-30 13:10:53'),
('55936fa8-efdc-42b7-b3e0-3f3a0a11ef94', '55924f6a-65e8-4279-93d6-257c0a11ef94', '', 'mention', 'superadmin', 0, 'normal', 'superadmin at 01-07-15 04:42:16', '2015-07-01 04:42:16', '2015-07-01 04:42:16'),
('55936fa8-b434-41ca-802d-3f3c0a11ef94', '55924f6a-65e8-4279-93d6-257c0a11ef94', '', 'mention', 'user1', 0, 'normal', 'user1 at 01-07-15 04:42:16', '2015-07-01 04:42:16', '2015-07-01 04:42:16'),
('55936fa8-f724-4f21-b5ed-3f3b0a11ef94', '55924f6a-65e8-4279-93d6-257c0a11ef94', '', 'action', 'superadmin', 1, 'normal', ' &nbsp;<a class="red action-items" href="#" contenteditable="true">superadmin</a> this is very important<br><span data-original-title="click to change priority" data-rel="tooltip" class="prioritychange label normal" contenteditable="true">normal</span>', '2015-07-01 04:42:16', '2015-07-01 05:03:14'),
('55936fa8-7dec-4f74-8fb3-3f420a11ef94', '55924f6a-65e8-4279-93d6-257c0a11ef94', '', 'mention', 'user', 0, 'normal', 'user at 01-07-15 04:42:16', '2015-07-01 04:42:16', '2015-07-01 04:42:16'),
('55936fa8-882c-48df-a019-3f3e0a11ef94', '55924f6a-65e8-4279-93d6-257c0a11ef94', '', 'mention', 'user2', 0, 'normal', 'user2 at 01-07-15 04:42:16', '2015-07-01 04:42:16', '2015-07-01 04:42:16'),
('5593aff2-c1b0-41ed-965a-30700a11ef94', '5593afc0-2b0c-46fb-9dbc-2d7a0a11ef94', '', 'mention', 'user', 0, 'normal', 'user at 01-07-15 09:16:34', '2015-07-01 09:16:34', '2015-07-01 09:16:34'),
('5593aff2-b150-4c7c-a16e-30810a11ef94', '5593afc0-2b0c-46fb-9dbc-2d7a0a11ef94', '', 'mention', 'user1', 0, 'normal', 'user1 at 01-07-15 09:16:34', '2015-07-01 09:16:34', '2015-07-01 09:16:34'),
('5593aff2-70c4-4ea4-bec6-30820a11ef94', '5593afc0-2b0c-46fb-9dbc-2d7a0a11ef94', '', 'mention', 'user2', 0, 'normal', 'user2 at 01-07-15 09:16:34', '2015-07-01 09:16:34', '2015-07-01 09:16:34'),
('5593d699-85fc-4721-93b4-7b800a11ef94', '5593afc0-2b0c-46fb-9dbc-2d7a0a11ef94', '', 'mention', 'user', 0, 'normal', 'user at 01-07-15 12:01:29', '2015-07-01 12:01:29', '2015-07-01 12:01:29'),
('5593d699-329c-4ff4-a3b8-7b810a11ef94', '5593afc0-2b0c-46fb-9dbc-2d7a0a11ef94', '', 'mention', 'user2', 0, 'normal', 'user2 at 01-07-15 12:01:29', '2015-07-01 12:01:29', '2015-07-01 12:01:29'),
('5593d699-a12c-4d47-96bd-7b830a11ef94', '5593afc0-2b0c-46fb-9dbc-2d7a0a11ef94', '', 'mention', 'user1', 0, 'normal', 'user1 at 01-07-15 12:01:29', '2015-07-01 12:01:29', '2015-07-01 12:01:29'),
('5593d699-fbd0-4215-b515-7b850a11ef94', '5593afc0-2b0c-46fb-9dbc-2d7a0a11ef94', '', 'mention', 'kumar', 0, 'normal', 'kumar at 01-07-15 12:01:29', '2015-07-01 12:01:29', '2015-07-01 12:01:29'),
('5593d699-1e34-45f0-bfed-7b880a11ef94', '5593afc0-2b0c-46fb-9dbc-2d7a0a11ef94', '', 'action', 'user1', 0, 'normal', ' &nbsp;<a class="red action-items" contenteditable="false" href="#">user1</a>&nbsp;this is your task<span contenteditable="false" class="prioritychange label high">high</span>', '2015-07-01 12:01:29', '2015-07-01 12:01:29'),
('5593d69a-8394-486d-a6c6-7baf0a11ef94', '5593afc0-2b0c-46fb-9dbc-2d7a0a11ef94', '', 'mention', 'user2', 0, 'normal', 'user2 at 01-07-15 12:01:30', '2015-07-01 12:01:30', '2015-07-01 12:01:30'),
('5593d69a-ab00-4152-b40d-7bb10a11ef94', '5593afc0-2b0c-46fb-9dbc-2d7a0a11ef94', '', 'mention', 'user', 0, 'normal', 'user at 01-07-15 12:01:30', '2015-07-01 12:01:30', '2015-07-01 12:01:30'),
('5593d792-d890-4cf2-9517-0d050a11ef94', '5593afc0-2b0c-46fb-9dbc-2d7a0a11ef94', '', 'action', 'superadmin', 0, 'normal', ' &nbsp;<a class="red action-items" contenteditable="false" href="#">superadmin</a>&nbsp;this task should complete till monday<span data-original-title="click to change priority" data-rel="tooltip" contenteditable="false" class="prioritychange label normal">normal</span>', '2015-07-01 12:05:38', '2015-07-01 12:05:38'),
('5593d792-b730-4bfb-ab1b-0d060a11ef94', '5593afc0-2b0c-46fb-9dbc-2d7a0a11ef94', '', 'mention', 'user1', 0, 'normal', 'user1 at 01-07-15 12:05:38', '2015-07-01 12:05:38', '2015-07-01 12:05:38'),
('5593d792-c1c0-4e72-a151-0d090a11ef94', '5593afc0-2b0c-46fb-9dbc-2d7a0a11ef94', '', 'mention', 'user', 0, 'normal', 'user at 01-07-15 12:05:38', '2015-07-01 12:05:38', '2015-07-01 12:05:38'),
('5593d792-df10-436b-84d9-0d0a0a11ef94', '5593afc0-2b0c-46fb-9dbc-2d7a0a11ef94', '', 'mention', 'user2', 0, 'normal', 'user2 at 01-07-15 12:05:38', '2015-07-01 12:05:38', '2015-07-01 12:05:38'),
('5593d792-7024-4fc0-8c5c-0d0c0a11ef94', '5593afc0-2b0c-46fb-9dbc-2d7a0a11ef94', '', 'mention', 'superadmin', 0, 'normal', 'superadmin at 01-07-15 12:05:38', '2015-07-01 12:05:38', '2015-07-01 12:05:38'),
('5593d792-3c58-473d-b79f-0d0b0a11ef94', '5593afc0-2b0c-46fb-9dbc-2d7a0a11ef94', '', 'action', 'admin2', 0, 'normal', ' &nbsp;<a class="red action-items" contenteditable="false" href="#">admin2</a>&nbsp;designing is your task<span data-original-title="click to change priority" data-rel="tooltip" contenteditable="false" class="prioritychange label normal">normal</span>', '2015-07-01 12:05:38', '2015-07-01 12:05:38'),
('5593d793-b4d4-4d44-9014-0d260a11ef94', '5593afc0-2b0c-46fb-9dbc-2d7a0a11ef94', '', 'mention', 'admin2', 0, 'normal', 'admin2 at 01-07-15 12:05:39', '2015-07-01 12:05:39', '2015-07-01 12:05:39'),
('5593d7d0-f0ac-4437-8055-119b0a11ef94', '55924f6a-65e8-4279-93d6-257c0a11ef94', '', 'action', 'admin2', 0, 'normal', ' &nbsp;<a class="red action-items" contenteditable="true" href="#">admin2</a>&nbsp;designing is your task<span data-original-title="click to change priority" data-rel="tooltip" contenteditable="true" class="prioritychange label normal">normal</span>', '2015-07-01 12:06:40', '2015-07-01 12:06:40'),
('5593d7d0-9e9c-41b8-9a28-119d0a11ef94', '55924f6a-65e8-4279-93d6-257c0a11ef94', '', 'mention', 'user2', 0, 'normal', 'user2 at 01-07-15 12:06:40', '2015-07-01 12:06:40', '2015-07-01 12:06:40'),
('5593d7d0-c9fc-4eb5-9102-119e0a11ef94', '55924f6a-65e8-4279-93d6-257c0a11ef94', '', 'mention', 'user', 0, 'normal', 'user at 01-07-15 12:06:40', '2015-07-01 12:06:40', '2015-07-01 12:06:40'),
('5593d7d0-0628-4066-a7dc-11a40a11ef94', '55924f6a-65e8-4279-93d6-257c0a11ef94', '', 'mention', 'superadmin', 0, 'normal', 'superadmin at 01-07-15 12:06:40', '2015-07-01 12:06:40', '2015-07-01 12:06:40'),
('5593d7d0-ec24-4bc1-be74-11a30a11ef94', '55924f6a-65e8-4279-93d6-257c0a11ef94', '', 'action', 'superadmin', 1, 'normal', ' &nbsp;<a class="red action-items" contenteditable="true" href="#">superadmin</a>&nbsp;this task should complete till monday<span data-original-title="click to change priority" data-rel="tooltip" contenteditable="true" class="prioritychange label normal">normal</span>', '2015-07-01 12:06:40', '2015-07-02 03:43:04'),
('5593d7d0-bd80-4486-8571-11a50a11ef94', '55924f6a-65e8-4279-93d6-257c0a11ef94', '', 'mention', 'user1', 0, 'normal', 'user1 at 01-07-15 12:06:40', '2015-07-01 12:06:40', '2015-07-01 12:06:40'),
('559507e8-dd44-4396-b23e-3bb90a11ef94', '55924f6a-65e8-4279-93d6-257c0a11ef94', '', 'action', 'superadmin', 0, 'normal', ' &nbsp;<a class="red action-items" contenteditable="true" href="#">superadmin</a>&nbsp;this task should complete till monday<span data-rel="tooltip" contenteditable="true" class="prioritychange label normal" data-original-title="" title="">normal</span>', '2015-07-02 09:44:08', '2015-07-02 09:44:08'),
('559507e8-3814-4914-aa0a-3bb80a11ef94', '55924f6a-65e8-4279-93d6-257c0a11ef94', '', 'mention', 'user2', 0, 'normal', 'user2 at 02-07-15 09:44:08', '2015-07-02 09:44:08', '2015-07-02 09:44:08'),
('559507e8-aa8c-4ee2-a452-3bbb0a11ef94', '55924f6a-65e8-4279-93d6-257c0a11ef94', '', 'mention', 'user1', 0, 'normal', 'user1 at 02-07-15 09:44:08', '2015-07-02 09:44:08', '2015-07-02 09:44:08'),
('559507e8-5418-446a-814e-3bba0a11ef94', '55924f6a-65e8-4279-93d6-257c0a11ef94', '', 'mention', 'user', 0, 'normal', 'user at 02-07-15 09:44:08', '2015-07-02 09:44:08', '2015-07-02 09:44:08'),
('559507e8-1664-4878-9dc1-3bbc0a11ef94', '55924f6a-65e8-4279-93d6-257c0a11ef94', '', 'mention', 'superadmin', 0, 'normal', 'superadmin at 02-07-15 09:44:08', '2015-07-02 09:44:08', '2015-07-02 09:44:08'),
('559507e8-b6f4-40cf-b6dd-3bbd0a11ef94', '55924f6a-65e8-4279-93d6-257c0a11ef94', '', 'action', 'admin2', 0, 'normal', ' &nbsp;<a class="red action-items" contenteditable="true" href="#">admin2</a>&nbsp;designing is your task<span data-rel="tooltip" contenteditable="true" class="prioritychange label normal" data-original-title="" title="">normal</span>', '2015-07-02 09:44:08', '2015-07-02 09:44:08'),
('559507e9-cf20-4cf7-a7bf-3be70a11ef94', '55924f6a-65e8-4279-93d6-257c0a11ef94', '', 'mention', 'admin2', 0, 'normal', 'admin2 at 02-07-15 09:44:09', '2015-07-02 09:44:09', '2015-07-02 09:44:09'),
('559507e9-ae90-4529-bb34-3bec0a11ef94', '55924f6a-65e8-4279-93d6-257c0a11ef94', '', 'mention', 'superadmin', 0, 'normal', 'superadmin at 02-07-15 09:44:09', '2015-07-02 09:44:09', '2015-07-02 09:44:09');

-- --------------------------------------------------------

--
-- Table structure for table `ce_attachments`
--

CREATE TABLE IF NOT EXISTS `ce_attachments` (
  `id` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment_id` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `link_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `file_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `file_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `file_dir` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `file_size` int(11) DEFAULT NULL,
  `file_extension` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `attachment_to_user_idx` (`user_id`),
  KEY `attachment_to_comment_idx` (`comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ce_charts`
--

CREATE TABLE IF NOT EXISTS `ce_charts` (
  `id` varchar(36) NOT NULL,
  `chart_name` varchar(100) NOT NULL,
  `chart_code` varchar(100) NOT NULL,
  `chart_json` text NOT NULL,
  `chart_wiki` text NOT NULL,
  `created` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `modified` datetime NOT NULL,
  `chart_update_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ce_charts`
--

INSERT INTO `ce_charts` (`id`, `chart_name`, `chart_code`, `chart_json`, `chart_wiki`, `created`, `user_id`, `modified`, `chart_update_by`) VALUES
('5594d13e-8aa4-495f-961b-4a02c0a8011f', 'this is test', '6f524793bbf50407c70d6950b3d713ac', '{ "class": "go.GraphLinksModel",\n  "linkFromPortIdProperty": "fromPort",\n  "linkToPortIdProperty": "toPort",\n  "nodeDataArray": [ \n{"category":"Start", "text":"Start", "key":-1, "loc":"360 70", "info":"", "link":""},\n{"category":"multyport", "text":"Multi I/O", "figure":"Rectangle", "key":-2, "loc":"360 270", "info":"", "link":""}\n ],\n  "linkDataArray": [  ]}', '', '2015-07-02 05:50:54', 55796, '2015-07-02 05:51:04', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ce_clients`
--

CREATE TABLE IF NOT EXISTS `ce_clients` (
  `id` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `user_count` int(6) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ce_clients`
--

INSERT INTO `ce_clients` (`id`, `title`, `user_count`, `created`, `modified`) VALUES
('557aadad-d5a4-49f6-93ea-7f3d0a11ef94', 'test client', 8, '2015-06-12 10:00:13', '2015-06-12 10:00:13');

-- --------------------------------------------------------

--
-- Table structure for table `ce_comments`
--

CREATE TABLE IF NOT EXISTS `ce_comments` (
  `id` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `phase_id` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` varchar(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` varchar(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `needsaction` tinyint(1) NOT NULL DEFAULT '0',
  `priority` varchar(6) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'normal',
  `completed_date` datetime DEFAULT NULL,
  `completed_ip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `attachment_count` int(6) NOT NULL DEFAULT '0',
  `admin_only` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comment_to_user_idx` (`user_id`),
  KEY `comment_to_phase_idx` (`phase_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ce_comments`
--

INSERT INTO `ce_comments` (`id`, `phase_id`, `parent_id`, `user_id`, `content`, `needsaction`, `priority`, `completed_date`, `completed_ip`, `attachment_count`, `admin_only`, `created`, `modified`) VALUES
('5593f0c7-2b04-4d11-b859-05750a11ef94', '55914095-b398-49de-969f-76990a11ef94', NULL, '557aae3f-cfec-4944-a4de-09b00a11ef94', 'test coment on notes test coment on notes test coment on notes test coment on notes test coment on notes test coment on notes test coment on notes test coment on notes ', 0, 'normal', NULL, NULL, 0, 0, '2015-07-01 13:53:11', '2015-07-01 13:53:11'),
('5593f0d1-6964-4972-a3c1-06330a11ef94', '55914095-b398-49de-969f-76990a11ef94', '5593f0c7-2b04-4d11-b859-05750a11ef94', '557aae3f-cfec-4944-a4de-09b00a11ef94', 'test coment on notes test coment on notes test coment on notes test coment on notes ', 0, 'normal', NULL, NULL, 0, 0, '2015-07-01 13:53:21', '2015-07-01 13:53:21');

-- --------------------------------------------------------

--
-- Table structure for table `ce_configurations`
--

CREATE TABLE IF NOT EXISTS `ce_configurations` (
  `id` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `System-name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `System-language` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'en-gb',
  `System-timezone` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Europe/London',
  `System-logo_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `System-logo_dir` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `System-comments_desc` tinyint(1) NOT NULL DEFAULT '1',
  `System-maintenance` tinyint(1) NOT NULL DEFAULT '0',
  `Uploads-extension_blacklist` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'exe,bat',
  `Email-checked_default` tinyint(1) NOT NULL DEFAULT '0',
  `Email-transport` varchar(6) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'mail',
  `Email-email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Email-sender` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Email-host` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Email-port` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Email-username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Email-password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Email-invitationsubject` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Invitation to Online Project Management',
  `Email-invitationtext_text` text COLLATE utf8_unicode_ci NOT NULL,
  `Email-activity_subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Activity in Online Project Management',
  `Email-progressactivity_text` text COLLATE utf8_unicode_ci,
  `Email-commentactivity_text` text COLLATE utf8_unicode_ci,
  `Email-taskactivity_text` text COLLATE utf8_unicode_ci,
  `Preview-max_width` int(6) NOT NULL DEFAULT '260',
  `Preview-max_height` int(6) NOT NULL DEFAULT '260',
  `Color-topbar_fill` varchar(7) COLLATE utf8_unicode_ci NOT NULL DEFAULT '#2c2c2c',
  `Color-topbar_text` varchar(7) COLLATE utf8_unicode_ci NOT NULL DEFAULT '#999999',
  `Color-link` varchar(7) COLLATE utf8_unicode_ci NOT NULL DEFAULT '#0088cc',
  `Layout-fluid` tinyint(1) NOT NULL DEFAULT '0',
  `Misc-showpoweredby` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ce_configurations`
--

INSERT INTO `ce_configurations` (`id`, `System-name`, `System-language`, `System-timezone`, `System-logo_name`, `System-logo_dir`, `System-comments_desc`, `System-maintenance`, `Uploads-extension_blacklist`, `Email-checked_default`, `Email-transport`, `Email-email`, `Email-sender`, `Email-host`, `Email-port`, `Email-username`, `Email-password`, `Email-invitationsubject`, `Email-invitationtext_text`, `Email-activity_subject`, `Email-progressactivity_text`, `Email-commentactivity_text`, `Email-taskactivity_text`, `Preview-max_width`, `Preview-max_height`, `Color-topbar_fill`, `Color-topbar_text`, `Color-link`, `Layout-fluid`, `Misc-showpoweredby`, `created`, `modified`) VALUES
('557aad30-fbc8-442b-b430-77db0a11ef94', 'Project management', 'en-gb', 'Europe/London', 'logo.jpg', '557aad30-fbc8-442b-b430-77db0a11ef94', 1, 0, 'exe,bat', 0, 'mail', 'manoj@rudrainnovatives.com', 'equity build finance', NULL, NULL, NULL, NULL, 'Invitation to Online Project Management', 'Dear {UserName},\n\nYou have been invited to join the project {ProjectName} on our online project management portal.\n\nThis will enable you to participate in following the project''s progress as well as allow you to comment on any of the project''s phases.\n\nYou can log-on to the project here: {ProjectUrl}\n\nYour username is: {UserEmail}\n{StartIsNewUser}\nYour temporary password is: {TempPassword}\n\nPlease make sure you change your temporary password during your first visit.\n{EndIsNewUser}\n\n\nKind regards,\n{SystemName}\n', 'Activity in Online Project Management', 'Dear {UserName},\n                \nThere has been some new activity in the project {ProjectName}.\n\n{User} changed the progress of the phase {PhaseName} from {OldPercentage} to {NewPercentage}.\n\nYou can view the affected project phase here: {PhaseUrl}\n\n\nKind regards,\n{SystemName}\n', 'Dear {UserName},\n                \nThere has been some new activity in the project {ProjectName}.\n\n{User} has created a new {CommentType} in the phase {PhaseName}.\n\nYou can view the {CommentType} here: {CommentUrl}\n\n\nKind regards,\n{SystemName}\n', 'Dear {UserName},\n                \nThere has been some new activity in the project {ProjectName}.\n\n{User} has changed the status of a task in the phase {PhaseName} to {TaskStatus}.\n\nYou can view the task here: {CommentUrl}\n\n\nKind regards,\n{SystemName}          \n', 260, 260, '#2c2c2c', '#999999', '#0088cc', 1, 0, '2015-06-12 09:58:08', '2015-06-16 10:00:49');

-- --------------------------------------------------------

--
-- Table structure for table `ce_departments`
--

CREATE TABLE IF NOT EXISTS `ce_departments` (
  `id` varchar(36) NOT NULL,
  `dep_name` varchar(100) NOT NULL,
  `dep_head` varchar(36) NOT NULL,
  `dep_status` tinyint(1) NOT NULL COMMENT '1=>active;0=>inactive',
  `dep_description` text NOT NULL,
  `created` datetime DEFAULT NULL,
  `dep_create_by` varchar(36) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `dep_update_by` varchar(36) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ce_departments`
--

INSERT INTO `ce_departments` (`id`, `dep_name`, `dep_head`, `dep_status`, `dep_description`, `created`, `dep_create_by`, `modified`, `dep_update_by`) VALUES
('55913929-88dc-49ba-aaff-036f0a11ef94', 'Designing', '557aad55-084c-4026-8e35-7a060a11ef94', 1, 'this is just a designing department . Check is the head for this ', '2015-06-29 12:25:13', NULL, '2015-06-29 12:25:13', NULL),
('5591393e-bd94-47b2-8e3d-04f70a11ef94', 'Development', '557aae22-8630-49f6-a5ae-07f20a11ef94', 1, 'this is just a designing department . Check is the head for this ', '2015-06-29 12:25:34', NULL, '2015-06-29 12:25:34', NULL),
('5591394a-b400-4830-a790-05ae0a11ef94', 'Management', '557aae62-9830-4177-9870-0b9a0a11ef94', 1, 'this is just a designing department . Check is the head for this ', '2015-06-29 12:25:46', NULL, '2015-06-29 12:25:46', NULL),
('55913958-e880-4aa7-b6ae-06820a11ef94', 'test department', '557aadcc-e1d4-44fc-b835-02f90a11ef94', 1, 'this is just a designing department . Check is the head for this ', '2015-06-29 12:26:00', NULL, '2015-06-29 12:26:00', NULL),
('55913965-c6a8-4eb7-9169-07560a11ef94', 'department123', '557aae22-8630-49f6-a5ae-07f20a11ef94', 1, 'this is just a designing department . Check is the head for this ', '2015-06-29 12:26:13', NULL, '2015-06-29 12:26:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ce_notes`
--

CREATE TABLE IF NOT EXISTS `ce_notes` (
  `id` varchar(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `project_id` varchar(36) NOT NULL,
  `version` varchar(20) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `comment_count` int(11) NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ce_notes`
--

INSERT INTO `ce_notes` (`id`, `project_id`, `version`, `title`, `slug`, `comment_count`, `description`, `created`, `modified`) VALUES
('5593d794-d214-4958-a922-0d370a11ef94', '558b8b6e-71ec-4c2f-8fd1-2b330a11ef94', '1.0', 'this is interlinked note', 'this_is_interlinked_note', 0, '\r\n			\r\n<input placeholder="Enter Note title" value="2015-07-01Meeting Notes" name="data[Notes][title]" class="note_title" maxlength="255" type="text" id="NotesTitle"><br>\r\n   <h2 class="border-none" contenteditable="true">Date</h2>\r\n   <input style="display:none;" class="datepicker hasDatepicker" id="dp1435752264658">\r\n   <p>﻿<time class="non-editable" datetime="2015-06-27" contenteditable="false" onselectstart="return false;">01 Jul 2015</time>﻿</p>\r\n   <h2 class="border-none" contenteditable="true">Attendees</h2>\r\n   <div contenteditable="true" id="mention-text" type="text" class="user-depart-list text-placeholder border-none" data-text="add users as an attendee(@for user #for a department''s users)."> &nbsp;<a class="red mentions" contenteditable="false" href="#">user1</a>&nbsp; &nbsp;<a class="red mentions" contenteditable="false" href="#">user2</a>&nbsp; &nbsp;<a class="red mentions" contenteditable="false" href="#">user</a>&nbsp; &nbsp;<a class="red mentions" contenteditable="false" href="#">superadmin</a>&nbsp; &nbsp;<a class="red mentions" contenteditable="false" href="#">admin2</a>&nbsp; </div>\r\n   <div id="display-dept" style="display: none;">			<div class="display_box">\r\n			<img src="/projectmanager/users/avatar/557aad55-084c-4026-8e35-7a060a11ef94/coder.png" class="image">	\r\n			<a class="addname2" title="superadmin">\r\n			rex&nbsp;Johnson</a><br>\r\n			<span style="display: inherit;font-size:12px; color:#999999">@superadmin</span>\r\n			</div>\r\n					<div class="display_box">\r\n			<img src="/projectmanager/users/avatar/557aadcc-e1d4-44fc-b835-02f90a11ef94/administrator.png" class="image">	\r\n			<a class="addname2" title="admin">\r\n			Robert &nbsp;curstn</a><br>\r\n			<span style="display: inherit;font-size:12px; color:#999999">@admin</span>\r\n			</div>\r\n					<div class="display_box">\r\n			<img src="/projectmanager/users/avatar/557aae22-8630-49f6-a5ae-07f20a11ef94/User.png" class="image">	\r\n			<a class="addname2" title="admin2">\r\n			sherolock&nbsp;holms</a><br>\r\n			<span style="display: inherit;font-size:12px; color:#999999">@admin2</span>\r\n			</div>\r\n					<div class="display_box">\r\n			<img src="/projectmanager/users/avatar/557aae3f-cfec-4944-a4de-09b00a11ef94/tf_141210_Myanmar-1.jpg" class="image">	\r\n			<a class="addname2" title="admin3">\r\n			undertaker&nbsp;</a><br>\r\n			<span style="display: inherit;font-size:12px; color:#999999">@admin3</span>\r\n			</div>\r\n					<div class="display_box">\r\n			<img src="/projectmanager/users/avatar/557e680f-c130-4462-9ebd-60a70a11ef94/Crius-Responsive-Photography-Creative-Portfolio.jpg" class="image">	\r\n			<a class="addname2" title="kumar">\r\n			mozil&nbsp;Firefox</a><br>\r\n			<span style="display: inherit;font-size:12px; color:#999999">@kumar</span>\r\n			</div>\r\n		</div>\r\n	<div id="msgbox-dept" style="display: none;">Type the name of someone or something...</div>\r\n	\r\n   <h2 class="border-none" contenteditable="true">Goals</h2>\r\n   <div class="editable mce-content-body" id="mce_0" contenteditable="true" spellcheck="false" style="position: relative;"><p>Set goals, objectives or some context for this meeting.</p></div><input type="hidden" name="mce_0">\r\n   <h2 class="border-none" contenteditable="true">Discussion items</h2>\r\n   <div class="editable mce-content-body" id="mce_20" contenteditable="true" spellcheck="false" style="position: relative;"><table class="table mce-item-table" style="border: 1px solid #e2e2e2;" data-mce-style="border: 1px solid #e2e2e2;"><tbody><tr><th class="confluenceTh">Time</th><th class="confluenceTh">Item</th><th class="confluenceTh">Who</th><th class="confluenceTh">Notes</th></tr><tr><td class="confluenceTd"><span class="text-placeholder">5min</span></td><td class="confluenceTd"><span class="text-placeholder">Agenda item</span></td><td class="confluenceTd"><span class="text-placeholder">Name</span></td><td class="confluenceTd"><ul><li><span class="text-placeholder">Notes for this agenda item</span></li></ul></td></tr><tr><td class="confluenceTd"><br></td><td class="confluenceTd"><br></td><td class="confluenceTd"><br></td><td class="confluenceTd"><br></td></tr></tbody></table></div><input type="hidden" name="mce_20">\r\n   <h2 class="border-none" contenteditable="true">Action items</h2>\r\n   <div contenteditable="true" id="action-text" type="text" class="userlist text-placeholder border-none" data-text="Type your task here. Use @ to assign a user."></div>\r\n	<div id="display" style="display: none;">			<div class="display_box">\r\n			<img src="/projectmanager/users/avatar/557aad55-084c-4026-8e35-7a060a11ef94/coder.png" class="image">	\r\n			<a class="addname" title="superadmin">\r\n			rex&nbsp;Johnson</a><br>\r\n			<span style="display: inherit;font-size:12px; color:#999999">@superadmin</span>\r\n			</div>\r\n					<div class="display_box">\r\n			<img src="/projectmanager/users/avatar/557aadcc-e1d4-44fc-b835-02f90a11ef94/administrator.png" class="image">	\r\n			<a class="addname" title="admin">\r\n			Robert &nbsp;curstn</a><br>\r\n			<span style="display: inherit;font-size:12px; color:#999999">@admin</span>\r\n			</div>\r\n					<div class="display_box">\r\n			<img src="/projectmanager/users/avatar/557aae22-8630-49f6-a5ae-07f20a11ef94/User.png" class="image">	\r\n			<a class="addname" title="admin2">\r\n			sherolock&nbsp;holms</a><br>\r\n			<span style="display: inherit;font-size:12px; color:#999999">@admin2</span>\r\n			</div>\r\n					<div class="display_box">\r\n			<img src="/projectmanager/users/avatar/557aae3f-cfec-4944-a4de-09b00a11ef94/tf_141210_Myanmar-1.jpg" class="image">	\r\n			<a class="addname" title="admin3">\r\n			undertaker&nbsp;</a><br>\r\n			<span style="display: inherit;font-size:12px; color:#999999">@admin3</span>\r\n			</div>\r\n					<div class="display_box">\r\n			<img src="/projectmanager/users/avatar/557e680f-c130-4462-9ebd-60a70a11ef94/Crius-Responsive-Photography-Creative-Portfolio.jpg" class="image">	\r\n			<a class="addname" title="kumar">\r\n			mozil&nbsp;Firefox</a><br>\r\n			<span style="display: inherit;font-size:12px; color:#999999">@kumar</span>\r\n			</div>\r\n		</div>\r\n	<div id="msgbox" style="display: none;">Type the name of someone or something...</div>\r\n	<div class="action-wrapper">\r\n	\r\n	<div class="single-action"><input type="checkbox" name="task" class="mark-as-done"><div contenteditable="true" class="items-action"> &nbsp;<a class="red action-items" contenteditable="false" href="#">superadmin</a>&nbsp;this task should complete till monday<span data-original-title="click to change priority" data-rel="tooltip" contenteditable="false" class="prioritychange label normal">normal</span></div></div><div class="single-action"><input type="checkbox" name="task" class="mark-as-done"><div contenteditable="true" class="items-action"> &nbsp;<a class="red action-items" contenteditable="false" href="#">admin2</a>&nbsp;designing is your task<span data-original-title="click to change priority" data-rel="tooltip" contenteditable="false" class="prioritychange label normal">normal</span></div></div></div>\r\n	\r\n\r\n		', '2015-07-01 12:05:40', '2015-07-01 12:05:40'),
('5593d794-c784-4d67-8815-0d370a11ef94', '55924f6a-65e8-4279-93d6-257c0a11ef94', '1.2', '2015-07-01Meeting Notes', 'this_is_interlinked_note_1', 0, '\r\n			 \r\n\r\n			\r\n<input placeholder="Enter Note title" value="2015-07-01Meeting Notes" name="data[Notes][title]" class="note_title" maxlength="255" type="text" id="NotesTitle"><br>\r\n   <h2 class="border-none" contenteditable="true">Date</h2>\r\n   <input style="display:none;" class="datepicker hasDatepicker" id="dp1435752264658">\r\n   <p>﻿<time class="non-editable" datetime="2015-06-27" contenteditable="true" onselectstart="return false;">01 Jul 2015</time>﻿</p>\r\n   <h2 class="border-none" contenteditable="true">Attendees</h2>\r\n   <div contenteditable="true" id="mention-text" type="text" class="user-depart-list text-placeholder border-none" data-text="add users as an attendee(@for user #for a department''s users)."> &nbsp;<a class="red mentions" contenteditable="true" href="#">user1</a>&nbsp; &nbsp;<a class="red mentions" contenteditable="true" href="#">user2</a>&nbsp; &nbsp;<a class="red mentions" contenteditable="true" href="#">user</a>&nbsp; &nbsp;<a class="red mentions" contenteditable="true" href="#">superadmin</a>&nbsp; &nbsp;<a class="red mentions" contenteditable="true" href="#">admin2</a>&nbsp; &nbsp; &nbsp;<a class="red mentions" contenteditable="false" href="#">admin2</a>&nbsp; &nbsp;<a class="red mentions" contenteditable="false" href="#">superadmin</a>&nbsp; </div>\r\n   <div id="display-dept" style="display: none;">			<div class="display_box">\r\n			<img src="/users/avatar/557aad55-084c-4026-8e35-7a060a11ef94/coder.png" class="image">	\r\n			<a class="addname2" title="superadmin">\r\n			rex&nbsp;Johnson</a><br>\r\n			<span style="display: inherit;font-size:12px; color:#999999">@superadmin</span>\r\n			</div>\r\n					<div class="display_box">\r\n			<img src="/users/avatar/557aae62-9830-4177-9870-0b9a0a11ef94/administrator.png" class="image">	\r\n			<a class="addname2" title="user1">\r\n			The &nbsp;Rock</a><br>\r\n			<span style="display: inherit;font-size:12px; color:#999999">@user1</span>\r\n			</div>\r\n					<div class="display_box">\r\n			<img src="/users/avatar/557aae85-1950-4452-8674-0da70a11ef94/Businessman.png" class="image">	\r\n			<a class="addname2" title="user2">\r\n			gerry&nbsp;sandhu</a><br>\r\n			<span style="display: inherit;font-size:12px; color:#999999">@user2</span>\r\n			</div>\r\n					<div class="display_box">\r\n			<img src="/users/avatar/557aaeaa-d68c-41b4-a79f-0fcc0a11ef94/2013-mtm-polo-r-wrc-street-02.jpg" class="image">	\r\n			<a class="addname2" title="user">\r\n			Opera&nbsp;Mini</a><br>\r\n			<span style="display: inherit;font-size:12px; color:#999999">@user</span>\r\n			</div>\r\n		</div>\r\n	<div id="msgbox-dept" style="display: none;">Type the name of someone or something...</div>\r\n	\r\n   <h2 class="border-none" contenteditable="true">Goals</h2>\r\n   <div class="editable mce-content-body" id="mce_0" contenteditable="true" spellcheck="false" style="position: relative;"><p>Set goals, objectives or some context for this meeting.</p></div><input type="hidden" name="mce_0"><input type="hidden" name="mce_0">\r\n   <h2 class="border-none" contenteditable="true">Discussion items</h2>\r\n   <div class="editable mce-content-body" id="mce_20" contenteditable="true" spellcheck="false" style="position: relative;"><table class="table mce-item-table" style="border: 1px solid #e2e2e2;" data-mce-style="border: 1px solid #e2e2e2;"><tbody><tr><th class="confluenceTh">Time</th><th class="confluenceTh">Item</th><th class="confluenceTh">Who</th><th class="confluenceTh">Notes</th></tr><tr><td class="confluenceTd"><span class="text-placeholder">5min</span></td><td class="confluenceTd"><span class="text-placeholder">Agenda item</span></td><td class="confluenceTd"><span class="text-placeholder">Name</span></td><td class="confluenceTd"><ul><li><span class="text-placeholder">Notes for this agenda item</span></li></ul></td></tr><tr><td class="confluenceTd"><br></td><td class="confluenceTd"><br></td><td class="confluenceTd"><br></td><td class="confluenceTd"><br></td></tr></tbody></table></div><input type="hidden" name="mce_20"><input type="hidden" name="mce_20">\r\n   <h2 class="border-none" contenteditable="true">Action items</h2>\r\n   <div contenteditable="true" id="action-text" type="text" class="userlist text-placeholder border-none" data-text="Type your task here. Use @ to assign a user."></div>\r\n	<div id="display" style="display: none;">			<div class="display_box">\r\n			<img src="/projectmanager/users/avatar/557aad55-084c-4026-8e35-7a060a11ef94/coder.png" class="image">	\r\n			<a class="addname" title="superadmin">\r\n			rex&nbsp;Johnson</a><br>\r\n			<span style="display: inherit;font-size:12px; color:#999999">@superadmin</span>\r\n			</div>\r\n					<div class="display_box">\r\n			<img src="/projectmanager/users/avatar/557aadcc-e1d4-44fc-b835-02f90a11ef94/administrator.png" class="image">	\r\n			<a class="addname" title="admin">\r\n			Robert &nbsp;curstn</a><br>\r\n			<span style="display: inherit;font-size:12px; color:#999999">@admin</span>\r\n			</div>\r\n					<div class="display_box">\r\n			<img src="/projectmanager/users/avatar/557aae22-8630-49f6-a5ae-07f20a11ef94/User.png" class="image">	\r\n			<a class="addname" title="admin2">\r\n			sherolock&nbsp;holms</a><br>\r\n			<span style="display: inherit;font-size:12px; color:#999999">@admin2</span>\r\n			</div>\r\n					<div class="display_box">\r\n			<img src="/projectmanager/users/avatar/557aae3f-cfec-4944-a4de-09b00a11ef94/tf_141210_Myanmar-1.jpg" class="image">	\r\n			<a class="addname" title="admin3">\r\n			undertaker&nbsp;</a><br>\r\n			<span style="display: inherit;font-size:12px; color:#999999">@admin3</span>\r\n			</div>\r\n					<div class="display_box">\r\n			<img src="/projectmanager/users/avatar/557e680f-c130-4462-9ebd-60a70a11ef94/Crius-Responsive-Photography-Creative-Portfolio.jpg" class="image">	\r\n			<a class="addname" title="kumar">\r\n			mozil&nbsp;Firefox</a><br>\r\n			<span style="display: inherit;font-size:12px; color:#999999">@kumar</span>\r\n			</div>\r\n		</div>\r\n	<div id="msgbox" style="display: none;">Type the name of someone or something...</div>\r\n	<div class="action-wrapper">\r\n	\r\n	<div class="single-action"><input type="checkbox" name="task" class="mark-as-done" checked="checked"><div contenteditable="true" class="items-action mark-done"> &nbsp;<a class="red action-items" contenteditable="true" href="#">superadmin</a>&nbsp;this task should complete till monday<span data-rel="tooltip" contenteditable="true" class="prioritychange label normal" data-original-title="" title="">normal</span></div></div><div class="single-action"><input type="checkbox" name="task" class="mark-as-done"><div contenteditable="true" class="items-action"> &nbsp;<a class="red action-items" contenteditable="true" href="#">admin2</a>&nbsp;designing is your task<span data-rel="tooltip" contenteditable="true" class="prioritychange label normal" data-original-title="" title="">normal</span></div></div></div>\r\n	\r\n\r\n				', '2015-07-01 12:05:40', '2015-07-02 09:44:09'),
('5593d794-fa74-45e6-8477-0d370a11ef94', '5593afc0-2b0c-46fb-9dbc-2d7a0a11ef94', '1.0', 'this is interlinked note', 'this_is_interlinked_note_2', 0, '\r\n			\r\n<input placeholder="Enter Note title" value="2015-07-01Meeting Notes" name="data[Notes][title]" class="note_title" maxlength="255" type="text" id="NotesTitle"><br>\r\n   <h2 class="border-none" contenteditable="true">Date</h2>\r\n   <input style="display:none;" class="datepicker hasDatepicker" id="dp1435752264658">\r\n   <p>﻿<time class="non-editable" datetime="2015-06-27" contenteditable="false" onselectstart="return false;">01 Jul 2015</time>﻿</p>\r\n   <h2 class="border-none" contenteditable="true">Attendees</h2>\r\n   <div contenteditable="true" id="mention-text" type="text" class="user-depart-list text-placeholder border-none" data-text="add users as an attendee(@for user #for a department''s users)."> &nbsp;<a class="red mentions" contenteditable="false" href="#">user1</a>&nbsp; &nbsp;<a class="red mentions" contenteditable="false" href="#">user2</a>&nbsp; &nbsp;<a class="red mentions" contenteditable="false" href="#">user</a>&nbsp; &nbsp;<a class="red mentions" contenteditable="false" href="#">superadmin</a>&nbsp; &nbsp;<a class="red mentions" contenteditable="false" href="#">admin2</a>&nbsp; </div>\r\n   <div id="display-dept" style="display: none;">			<div class="display_box">\r\n			<img src="/projectmanager/users/avatar/557aad55-084c-4026-8e35-7a060a11ef94/coder.png" class="image">	\r\n			<a class="addname2" title="superadmin">\r\n			rex&nbsp;Johnson</a><br>\r\n			<span style="display: inherit;font-size:12px; color:#999999">@superadmin</span>\r\n			</div>\r\n					<div class="display_box">\r\n			<img src="/projectmanager/users/avatar/557aadcc-e1d4-44fc-b835-02f90a11ef94/administrator.png" class="image">	\r\n			<a class="addname2" title="admin">\r\n			Robert &nbsp;curstn</a><br>\r\n			<span style="display: inherit;font-size:12px; color:#999999">@admin</span>\r\n			</div>\r\n					<div class="display_box">\r\n			<img src="/projectmanager/users/avatar/557aae22-8630-49f6-a5ae-07f20a11ef94/User.png" class="image">	\r\n			<a class="addname2" title="admin2">\r\n			sherolock&nbsp;holms</a><br>\r\n			<span style="display: inherit;font-size:12px; color:#999999">@admin2</span>\r\n			</div>\r\n					<div class="display_box">\r\n			<img src="/projectmanager/users/avatar/557aae3f-cfec-4944-a4de-09b00a11ef94/tf_141210_Myanmar-1.jpg" class="image">	\r\n			<a class="addname2" title="admin3">\r\n			undertaker&nbsp;</a><br>\r\n			<span style="display: inherit;font-size:12px; color:#999999">@admin3</span>\r\n			</div>\r\n					<div class="display_box">\r\n			<img src="/projectmanager/users/avatar/557e680f-c130-4462-9ebd-60a70a11ef94/Crius-Responsive-Photography-Creative-Portfolio.jpg" class="image">	\r\n			<a class="addname2" title="kumar">\r\n			mozil&nbsp;Firefox</a><br>\r\n			<span style="display: inherit;font-size:12px; color:#999999">@kumar</span>\r\n			</div>\r\n		</div>\r\n	<div id="msgbox-dept" style="display: none;">Type the name of someone or something...</div>\r\n	\r\n   <h2 class="border-none" contenteditable="true">Goals</h2>\r\n   <div class="editable mce-content-body" id="mce_0" contenteditable="true" spellcheck="false" style="position: relative;"><p>Set goals, objectives or some context for this meeting.</p></div><input type="hidden" name="mce_0">\r\n   <h2 class="border-none" contenteditable="true">Discussion items</h2>\r\n   <div class="editable mce-content-body" id="mce_20" contenteditable="true" spellcheck="false" style="position: relative;"><table class="table mce-item-table" style="border: 1px solid #e2e2e2;" data-mce-style="border: 1px solid #e2e2e2;"><tbody><tr><th class="confluenceTh">Time</th><th class="confluenceTh">Item</th><th class="confluenceTh">Who</th><th class="confluenceTh">Notes</th></tr><tr><td class="confluenceTd"><span class="text-placeholder">5min</span></td><td class="confluenceTd"><span class="text-placeholder">Agenda item</span></td><td class="confluenceTd"><span class="text-placeholder">Name</span></td><td class="confluenceTd"><ul><li><span class="text-placeholder">Notes for this agenda item</span></li></ul></td></tr><tr><td class="confluenceTd"><br></td><td class="confluenceTd"><br></td><td class="confluenceTd"><br></td><td class="confluenceTd"><br></td></tr></tbody></table></div><input type="hidden" name="mce_20">\r\n   <h2 class="border-none" contenteditable="true">Action items</h2>\r\n   <div contenteditable="true" id="action-text" type="text" class="userlist text-placeholder border-none" data-text="Type your task here. Use @ to assign a user."></div>\r\n	<div id="display" style="display: none;">			<div class="display_box">\r\n			<img src="/projectmanager/users/avatar/557aad55-084c-4026-8e35-7a060a11ef94/coder.png" class="image">	\r\n			<a class="addname" title="superadmin">\r\n			rex&nbsp;Johnson</a><br>\r\n			<span style="display: inherit;font-size:12px; color:#999999">@superadmin</span>\r\n			</div>\r\n					<div class="display_box">\r\n			<img src="/projectmanager/users/avatar/557aadcc-e1d4-44fc-b835-02f90a11ef94/administrator.png" class="image">	\r\n			<a class="addname" title="admin">\r\n			Robert &nbsp;curstn</a><br>\r\n			<span style="display: inherit;font-size:12px; color:#999999">@admin</span>\r\n			</div>\r\n					<div class="display_box">\r\n			<img src="/projectmanager/users/avatar/557aae22-8630-49f6-a5ae-07f20a11ef94/User.png" class="image">	\r\n			<a class="addname" title="admin2">\r\n			sherolock&nbsp;holms</a><br>\r\n			<span style="display: inherit;font-size:12px; color:#999999">@admin2</span>\r\n			</div>\r\n					<div class="display_box">\r\n			<img src="/projectmanager/users/avatar/557aae3f-cfec-4944-a4de-09b00a11ef94/tf_141210_Myanmar-1.jpg" class="image">	\r\n			<a class="addname" title="admin3">\r\n			undertaker&nbsp;</a><br>\r\n			<span style="display: inherit;font-size:12px; color:#999999">@admin3</span>\r\n			</div>\r\n					<div class="display_box">\r\n			<img src="/projectmanager/users/avatar/557e680f-c130-4462-9ebd-60a70a11ef94/Crius-Responsive-Photography-Creative-Portfolio.jpg" class="image">	\r\n			<a class="addname" title="kumar">\r\n			mozil&nbsp;Firefox</a><br>\r\n			<span style="display: inherit;font-size:12px; color:#999999">@kumar</span>\r\n			</div>\r\n		</div>\r\n	<div id="msgbox" style="display: none;">Type the name of someone or something...</div>\r\n	<div class="action-wrapper">\r\n	\r\n	<div class="single-action"><input type="checkbox" name="task" class="mark-as-done"><div contenteditable="true" class="items-action"> &nbsp;<a class="red action-items" contenteditable="false" href="#">superadmin</a>&nbsp;this task should complete till monday<span data-original-title="click to change priority" data-rel="tooltip" contenteditable="false" class="prioritychange label normal">normal</span></div></div><div class="single-action"><input type="checkbox" name="task" class="mark-as-done"><div contenteditable="true" class="items-action"> &nbsp;<a class="red action-items" contenteditable="false" href="#">admin2</a>&nbsp;designing is your task<span data-original-title="click to change priority" data-rel="tooltip" contenteditable="false" class="prioritychange label normal">normal</span></div></div></div>\r\n	\r\n\r\n		', '2015-07-01 12:05:40', '2015-07-01 12:05:40');

-- --------------------------------------------------------

--
-- Table structure for table `ce_notescomments`
--

CREATE TABLE IF NOT EXISTS `ce_notescomments` (
  `id` varchar(36) NOT NULL,
  `note_id` varchar(36) NOT NULL,
  `parent_id` varchar(36) NOT NULL,
  `user_id` varchar(36) NOT NULL,
  `content` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ce_notescomments`
--

INSERT INTO `ce_notescomments` (`id`, `note_id`, `parent_id`, `user_id`, `content`, `created`, `modified`) VALUES
('5593f098-8f88-4ef8-98b7-02510a11ef94', '5593d794-d214-4958-a922-0d370a11ef94', '0', '557aae3f-cfec-4944-a4de-09b00a11ef94', 'test coment on notes', '2015-07-01 13:52:24', '2015-07-01 13:52:24'),
('5593f0a3-e5f4-4b82-a9d5-03200a11ef94', '5593d794-d214-4958-a922-0d370a11ef94', '0', '557aae3f-cfec-4944-a4de-09b00a11ef94', 'test coment on notes  asgsdfhdhg', '2015-07-01 13:52:35', '2015-07-01 13:52:35'),
('5593f0ae-698c-4919-af66-03ce0a11ef94', '5593d794-d214-4958-a922-0d370a11ef94', '0', '557aae3f-cfec-4944-a4de-09b00a11ef94', 'test coment on notes dfhdfgfjgfj', '2015-07-01 13:52:46', '2015-07-01 13:52:46');

-- --------------------------------------------------------

--
-- Table structure for table `ce_noteshistories`
--

CREATE TABLE IF NOT EXISTS `ce_noteshistories` (
  `id` varchar(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `project_id` varchar(36) NOT NULL,
  `note_id` varchar(36) NOT NULL,
  `version` varchar(30) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `comment_count` int(11) NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ce_noteshistories`
--

INSERT INTO `ce_noteshistories` (`id`, `project_id`, `note_id`, `version`, `title`, `slug`, `comment_count`, `description`, `created`, `modified`) VALUES
('5593d7d2-7e40-4303-b387-11c20a11ef94', '55924f6a-65e8-4279-93d6-257c0a11ef94', '5593d794-c784-4d67-8815-0d370a11ef94', '1.0', 'this is interlinked note', 'this_is_interlinked_note', 0, '\r\n			\r\n<input placeholder="Enter Note title" value="2015-07-01Meeting Notes" name="data[Notes][title]" class="note_title" maxlength="255" type="text" id="NotesTitle"><br>\r\n   <h2 class="border-none" contenteditable="true">Date</h2>\r\n   <input style="display:none;" class="datepicker hasDatepicker" id="dp1435752264658">\r\n   <p>﻿<time class="non-editable" datetime="2015-06-27" contenteditable="false" onselectstart="return false;">01 Jul 2015</time>﻿</p>\r\n   <h2 class="border-none" contenteditable="true">Attendees</h2>\r\n   <div contenteditable="true" id="mention-text" type="text" class="user-depart-list text-placeholder border-none" data-text="add users as an attendee(@for user #for a department''s users)."> &nbsp;<a class="red mentions" contenteditable="false" href="#">user1</a>&nbsp; &nbsp;<a class="red mentions" contenteditable="false" href="#">user2</a>&nbsp; &nbsp;<a class="red mentions" contenteditable="false" href="#">user</a>&nbsp; &nbsp;<a class="red mentions" contenteditable="false" href="#">superadmin</a>&nbsp; &nbsp;<a class="red mentions" contenteditable="false" href="#">admin2</a>&nbsp; </div>\r\n   <div id="display-dept" style="display: none;">			<div class="display_box">\r\n			<img src="/projectmanager/users/avatar/557aad55-084c-4026-8e35-7a060a11ef94/coder.png" class="image">	\r\n			<a class="addname2" title="superadmin">\r\n			rex&nbsp;Johnson</a><br>\r\n			<span style="display: inherit;font-size:12px; color:#999999">@superadmin</span>\r\n			</div>\r\n					<div class="display_box">\r\n			<img src="/projectmanager/users/avatar/557aadcc-e1d4-44fc-b835-02f90a11ef94/administrator.png" class="image">	\r\n			<a class="addname2" title="admin">\r\n			Robert &nbsp;curstn</a><br>\r\n			<span style="display: inherit;font-size:12px; color:#999999">@admin</span>\r\n			</div>\r\n					<div class="display_box">\r\n			<img src="/projectmanager/users/avatar/557aae22-8630-49f6-a5ae-07f20a11ef94/User.png" class="image">	\r\n			<a class="addname2" title="admin2">\r\n			sherolock&nbsp;holms</a><br>\r\n			<span style="display: inherit;font-size:12px; color:#999999">@admin2</span>\r\n			</div>\r\n					<div class="display_box">\r\n			<img src="/projectmanager/users/avatar/557aae3f-cfec-4944-a4de-09b00a11ef94/tf_141210_Myanmar-1.jpg" class="image">	\r\n			<a class="addname2" title="admin3">\r\n			undertaker&nbsp;</a><br>\r\n			<span style="display: inherit;font-size:12px; color:#999999">@admin3</span>\r\n			</div>\r\n					<div class="display_box">\r\n			<img src="/projectmanager/users/avatar/557e680f-c130-4462-9ebd-60a70a11ef94/Crius-Responsive-Photography-Creative-Portfolio.jpg" class="image">	\r\n			<a class="addname2" title="kumar">\r\n			mozil&nbsp;Firefox</a><br>\r\n			<span style="display: inherit;font-size:12px; color:#999999">@kumar</span>\r\n			</div>\r\n		</div>\r\n	<div id="msgbox-dept" style="display: none;">Type the name of someone or something...</div>\r\n	\r\n   <h2 class="border-none" contenteditable="true">Goals</h2>\r\n   <div class="editable mce-content-body" id="mce_0" contenteditable="true" spellcheck="false" style="position: relative;"><p>Set goals, objectives or some context for this meeting.</p></div><input type="hidden" name="mce_0">\r\n   <h2 class="border-none" contenteditable="true">Discussion items</h2>\r\n   <div class="editable mce-content-body" id="mce_20" contenteditable="true" spellcheck="false" style="position: relative;"><table class="table mce-item-table" style="border: 1px solid #e2e2e2;" data-mce-style="border: 1px solid #e2e2e2;"><tbody><tr><th class="confluenceTh">Time</th><th class="confluenceTh">Item</th><th class="confluenceTh">Who</th><th class="confluenceTh">Notes</th></tr><tr><td class="confluenceTd"><span class="text-placeholder">5min</span></td><td class="confluenceTd"><span class="text-placeholder">Agenda item</span></td><td class="confluenceTd"><span class="text-placeholder">Name</span></td><td class="confluenceTd"><ul><li><span class="text-placeholder">Notes for this agenda item</span></li></ul></td></tr><tr><td class="confluenceTd"><br></td><td class="confluenceTd"><br></td><td class="confluenceTd"><br></td><td class="confluenceTd"><br></td></tr></tbody></table></div><input type="hidden" name="mce_20">\r\n   <h2 class="border-none" contenteditable="true">Action items</h2>\r\n   <div contenteditable="true" id="action-text" type="text" class="userlist text-placeholder border-none" data-text="Type your task here. Use @ to assign a user."></div>\r\n	<div id="display" style="display: none;">			<div class="display_box">\r\n			<img src="/projectmanager/users/avatar/557aad55-084c-4026-8e35-7a060a11ef94/coder.png" class="image">	\r\n			<a class="addname" title="superadmin">\r\n			rex&nbsp;Johnson</a><br>\r\n			<span style="display: inherit;font-size:12px; color:#999999">@superadmin</span>\r\n			</div>\r\n					<div class="display_box">\r\n			<img src="/projectmanager/users/avatar/557aadcc-e1d4-44fc-b835-02f90a11ef94/administrator.png" class="image">	\r\n			<a class="addname" title="admin">\r\n			Robert &nbsp;curstn</a><br>\r\n			<span style="display: inherit;font-size:12px; color:#999999">@admin</span>\r\n			</div>\r\n					<div class="display_box">\r\n			<img src="/projectmanager/users/avatar/557aae22-8630-49f6-a5ae-07f20a11ef94/User.png" class="image">	\r\n			<a class="addname" title="admin2">\r\n			sherolock&nbsp;holms</a><br>\r\n			<span style="display: inherit;font-size:12px; color:#999999">@admin2</span>\r\n			</div>\r\n					<div class="display_box">\r\n			<img src="/projectmanager/users/avatar/557aae3f-cfec-4944-a4de-09b00a11ef94/tf_141210_Myanmar-1.jpg" class="image">	\r\n			<a class="addname" title="admin3">\r\n			undertaker&nbsp;</a><br>\r\n			<span style="display: inherit;font-size:12px; color:#999999">@admin3</span>\r\n			</div>\r\n					<div class="display_box">\r\n			<img src="/projectmanager/users/avatar/557e680f-c130-4462-9ebd-60a70a11ef94/Crius-Responsive-Photography-Creative-Portfolio.jpg" class="image">	\r\n			<a class="addname" title="kumar">\r\n			mozil&nbsp;Firefox</a><br>\r\n			<span style="display: inherit;font-size:12px; color:#999999">@kumar</span>\r\n			</div>\r\n		</div>\r\n	<div id="msgbox" style="display: none;">Type the name of someone or something...</div>\r\n	<div class="action-wrapper">\r\n	\r\n	<div class="single-action"><input type="checkbox" name="task" class="mark-as-done"><div contenteditable="true" class="items-action"> &nbsp;<a class="red action-items" contenteditable="false" href="#">superadmin</a>&nbsp;this task should complete till monday<span data-original-title="click to change priority" data-rel="tooltip" contenteditable="false" class="prioritychange label normal">normal</span></div></div><div class="single-action"><input type="checkbox" name="task" class="mark-as-done"><div contenteditable="true" class="items-action"> &nbsp;<a class="red action-items" contenteditable="false" href="#">admin2</a>&nbsp;designing is your task<span data-original-title="click to change priority" data-rel="tooltip" contenteditable="false" class="prioritychange label normal">normal</span></div></div></div>\r\n	\r\n\r\n		', '2015-07-01 12:06:42', '2015-07-01 12:06:42'),
('559507e9-e7fc-41ba-95fb-3bf00a11ef94', '55924f6a-65e8-4279-93d6-257c0a11ef94', '5593d794-c784-4d67-8815-0d370a11ef94', '1.1', '2015-07-01Meeting Notes', '2015-07-01meeting_notes', 0, '\n\n			\n<input placeholder="Enter Note title" value="2015-07-01Meeting Notes" name="data[Notes][title]" class="note_title" maxlength="255" type="text" id="NotesTitle" readonly=""><br>\n   <h2 class="border-none" contenteditable="false">Date</h2>\n   <input style="display:none;" class="datepicker hasDatepicker" id="dp1435752264658">\n   <p>﻿<time class="non-editable" datetime="2015-06-27" contenteditable="false" onselectstart="return false;">01 Jul 2015</time>﻿</p>\n   <h2 class="border-none" contenteditable="false">Attendees</h2>\n   <div contenteditable="false" id="mention-text" type="text" class="user-depart-list text-placeholder border-none" data-text="add users as an attendee(@for user #for a department''s users)."> &nbsp;<a class="red mentions" contenteditable="false" href="#">user1</a>&nbsp; &nbsp;<a class="red mentions" contenteditable="false" href="#">user2</a>&nbsp; &nbsp;<a class="red mentions" contenteditable="false" href="#">user</a>&nbsp; &nbsp;<a class="red mentions" contenteditable="false" href="#">superadmin</a>&nbsp; &nbsp;<a class="red mentions" contenteditable="false" href="#">admin2</a>&nbsp; </div>\n   <div id="display-dept" style="display: none;">			<div class="display_box">\n			<img src="/projectmanager/users/avatar/557aad55-084c-4026-8e35-7a060a11ef94/coder.png" class="image">	\n			<a class="addname2" title="superadmin">\n			rex&nbsp;Johnson</a><br>\n			<span style="display: inherit;font-size:12px; color:#999999">@superadmin</span>\n			</div>\n					<div class="display_box">\n			<img src="/projectmanager/users/avatar/557aadcc-e1d4-44fc-b835-02f90a11ef94/administrator.png" class="image">	\n			<a class="addname2" title="admin">\n			Robert &nbsp;curstn</a><br>\n			<span style="display: inherit;font-size:12px; color:#999999">@admin</span>\n			</div>\n					<div class="display_box">\n			<img src="/projectmanager/users/avatar/557aae22-8630-49f6-a5ae-07f20a11ef94/User.png" class="image">	\n			<a class="addname2" title="admin2">\n			sherolock&nbsp;holms</a><br>\n			<span style="display: inherit;font-size:12px; color:#999999">@admin2</span>\n			</div>\n					<div class="display_box">\n			<img src="/projectmanager/users/avatar/557aae3f-cfec-4944-a4de-09b00a11ef94/tf_141210_Myanmar-1.jpg" class="image">	\n			<a class="addname2" title="admin3">\n			undertaker&nbsp;</a><br>\n			<span style="display: inherit;font-size:12px; color:#999999">@admin3</span>\n			</div>\n					<div class="display_box">\n			<img src="/projectmanager/users/avatar/557e680f-c130-4462-9ebd-60a70a11ef94/Crius-Responsive-Photography-Creative-Portfolio.jpg" class="image">	\n			<a class="addname2" title="kumar">\n			mozil&nbsp;Firefox</a><br>\n			<span style="display: inherit;font-size:12px; color:#999999">@kumar</span>\n			</div>\n		</div>\n	<div id="msgbox-dept" style="display: none;">Type the name of someone or something...</div>\n	\n   <h2 class="border-none" contenteditable="false">Goals</h2>\n   <div class="editable mce-content-body" id="mce_0" contenteditable="true" spellcheck="false" style="position: relative;"><p>Set goals, objectives or some context for this meeting.</p></div><input type="hidden" name="mce_0">\n   <h2 class="border-none" contenteditable="false">Discussion items</h2>\n   <div class="editable mce-content-body" id="mce_20" contenteditable="true" spellcheck="false" style="position: relative;"><table class="table mce-item-table" style="border: 1px solid #e2e2e2;" data-mce-style="border: 1px solid #e2e2e2;"><tbody><tr><th class="confluenceTh">Time</th><th class="confluenceTh">Item</th><th class="confluenceTh">Who</th><th class="confluenceTh">Notes</th></tr><tr><td class="confluenceTd"><span class="text-placeholder">5min</span></td><td class="confluenceTd"><span class="text-placeholder">Agenda item</span></td><td class="confluenceTd"><span class="text-placeholder">Name</span></td><td class="confluenceTd"><ul><li><span class="text-placeholder">Notes for this agenda item</span></li></ul></td></tr><tr><td class="confluenceTd"><br></td><td class="confluenceTd"><br></td><td class="confluenceTd"><br></td><td class="confluenceTd"><br></td></tr></tbody></table></div><input type="hidden" name="mce_20">\n   <h2 class="border-none" contenteditable="false">Action items</h2>\n   <div contenteditable="false" id="action-text" type="text" class="userlist text-placeholder border-none" data-text="Type your task here. Use @ to assign a user."></div>\n	<div id="display" style="display: none;">			<div class="display_box">\n			<img src="/projectmanager/users/avatar/557aad55-084c-4026-8e35-7a060a11ef94/coder.png" class="image">	\n			<a class="addname" title="superadmin">\n			rex&nbsp;Johnson</a><br>\n			<span style="display: inherit;font-size:12px; color:#999999">@superadmin</span>\n			</div>\n					<div class="display_box">\n			<img src="/projectmanager/users/avatar/557aadcc-e1d4-44fc-b835-02f90a11ef94/administrator.png" class="image">	\n			<a class="addname" title="admin">\n			Robert &nbsp;curstn</a><br>\n			<span style="display: inherit;font-size:12px; color:#999999">@admin</span>\n			</div>\n					<div class="display_box">\n			<img src="/projectmanager/users/avatar/557aae22-8630-49f6-a5ae-07f20a11ef94/User.png" class="image">	\n			<a class="addname" title="admin2">\n			sherolock&nbsp;holms</a><br>\n			<span style="display: inherit;font-size:12px; color:#999999">@admin2</span>\n			</div>\n					<div class="display_box">\n			<img src="/projectmanager/users/avatar/557aae3f-cfec-4944-a4de-09b00a11ef94/tf_141210_Myanmar-1.jpg" class="image">	\n			<a class="addname" title="admin3">\n			undertaker&nbsp;</a><br>\n			<span style="display: inherit;font-size:12px; color:#999999">@admin3</span>\n			</div>\n					<div class="display_box">\n			<img src="/projectmanager/users/avatar/557e680f-c130-4462-9ebd-60a70a11ef94/Crius-Responsive-Photography-Creative-Portfolio.jpg" class="image">	\n			<a class="addname" title="kumar">\n			mozil&nbsp;Firefox</a><br>\n			<span style="display: inherit;font-size:12px; color:#999999">@kumar</span>\n			</div>\n		</div>\n	<div id="msgbox" style="display: none;">Type the name of someone or something...</div>\n	<div class="action-wrapper">\n	\n	<div class="single-action"><input type="checkbox" name="task" class="mark-as-done" checked="checked"><div contenteditable="false" class="items-action mark-done"> &nbsp;<a class="red action-items" contenteditable="false" href="#">superadmin</a>&nbsp;this task should complete till monday<span data-rel="tooltip" contenteditable="false" class="prioritychange label normal">normal</span></div></div><div class="single-action"><input type="checkbox" name="task" class="mark-as-done"><div contenteditable="false" class="items-action"> &nbsp;<a class="red action-items" contenteditable="false" href="#">admin2</a>&nbsp;designing is your task<span data-rel="tooltip" contenteditable="false" class="prioritychange label normal">normal</span></div></div></div>\n	\n\n		', '2015-07-02 09:44:09', '2015-07-02 09:44:09');

-- --------------------------------------------------------

--
-- Table structure for table `ce_notesversions`
--

CREATE TABLE IF NOT EXISTS `ce_notesversions` (
  `id` varchar(36) NOT NULL,
  `note_id` varchar(36) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `version` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ce_notifications`
--

CREATE TABLE IF NOT EXISTS `ce_notifications` (
  `id` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `project_id` varchar(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phase_id` varchar(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` varchar(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `model` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `foreign_key` varchar(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `action` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `field` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value_new` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `value_old` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notification_to_project_idx` (`project_id`),
  KEY `notification_to_user_idx` (`user_id`),
  KEY `notification_to_phase_idx` (`phase_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ce_notifications`
--

INSERT INTO `ce_notifications` (`id`, `project_id`, `phase_id`, `user_id`, `model`, `foreign_key`, `title`, `action`, `field`, `value_new`, `value_old`, `deleted`, `created`) VALUES
('55929543-32a0-47a6-bfd9-20530a11ef94', '558b8b6e-71ec-4c2f-8fd1-2b330a11ef94', NULL, '557aad55-084c-4026-8e35-7a060a11ef94', 'Actionitems', '55929543-aa38-42d0-bdee-20530a11ef94', ' &nbsp;superadmin&nbsp;this is on high priority task&nbsp;high', 'create', NULL, NULL, NULL, 0, '2015-06-30 13:10:27'),
('55929543-54d4-4eb6-a221-20550a11ef94', '558b8b6e-71ec-4c2f-8fd1-2b330a11ef94', NULL, '557aad55-084c-4026-8e35-7a060a11ef94', 'Actionitems', '55929543-bb44-4459-ab39-20550a11ef94', ' &nbsp;admin&nbsp;this is low priority taskLowNormalHigh', 'create', NULL, NULL, NULL, 0, '2015-06-30 13:10:27'),
('55929543-9100-42eb-a3bb-20560a11ef94', '558b8b6e-71ec-4c2f-8fd1-2b330a11ef94', NULL, '557aad55-084c-4026-8e35-7a060a11ef94', 'Actionitems', '55929543-d634-41b3-84d0-20560a11ef94', ' &nbsp;kumar&nbsp;i can change on click the priority lablenormal', 'create', NULL, NULL, NULL, 0, '2015-06-30 13:10:27'),
('55929543-ba68-4204-9ca4-20540a11ef94', '558b8b6e-71ec-4c2f-8fd1-2b330a11ef94', NULL, '557aad55-084c-4026-8e35-7a060a11ef94', 'Actionitems', '55929543-3200-4f8c-8557-20540a11ef94', ' &nbsp;admin3&nbsp;this is by default normalnormal', 'create', NULL, NULL, NULL, 0, '2015-06-30 13:10:27'),
('55929543-dc2c-4065-a33d-205c0a11ef94', '55924f6a-65e8-4279-93d6-257c0a11ef94', NULL, '557aad55-084c-4026-8e35-7a060a11ef94', 'Notes', NULL, 'this is with priority change', 'create', NULL, NULL, NULL, 1, '2015-06-30 13:10:27'),
('5592955d-0218-44d4-9697-22150a11ef94', '55924f6a-65e8-4279-93d6-257c0a11ef94', NULL, '557aad55-084c-4026-8e35-7a060a11ef94', 'Actionitems', '5592955d-6334-49c5-b836-22150a11ef94', ' &nbsp;admin&nbsp;this is low priority taskhigh', 'create', NULL, NULL, NULL, 0, '2015-06-30 13:10:53'),
('55936eaa-b744-4759-850f-2ff40a11ef94', '55924f6a-65e8-4279-93d6-257c0a11ef94', NULL, '557aad55-084c-4026-8e35-7a060a11ef94', 'Notes', '55936eaa-91dc-4cff-bed7-2ff40a11ef94', '2015-07-01Meeting Notes', 'create', NULL, NULL, NULL, 0, '2015-07-01 04:38:02'),
('55936fa8-19dc-43ec-a540-3f420a11ef94', '55924f6a-65e8-4279-93d6-257c0a11ef94', NULL, '557aad55-084c-4026-8e35-7a060a11ef94', 'Actionitems', '55936fa8-7dec-4f74-8fb3-3f420a11ef94', 'user at 01-07-15 04:42:16', 'create', NULL, NULL, NULL, 0, '2015-07-01 04:42:16'),
('55936fa8-4550-4637-bea2-3f3e0a11ef94', '55924f6a-65e8-4279-93d6-257c0a11ef94', NULL, '557aad55-084c-4026-8e35-7a060a11ef94', 'Actionitems', '55936fa8-882c-48df-a019-3f3e0a11ef94', 'user2 at 01-07-15 04:42:16', 'create', NULL, NULL, NULL, 0, '2015-07-01 04:42:16'),
('55936fa8-5ca4-4b99-ba54-3f3c0a11ef94', '55924f6a-65e8-4279-93d6-257c0a11ef94', NULL, '557aad55-084c-4026-8e35-7a060a11ef94', 'Actionitems', '55936fa8-b434-41ca-802d-3f3c0a11ef94', 'user1 at 01-07-15 04:42:16', 'create', NULL, NULL, NULL, 0, '2015-07-01 04:42:16'),
('55936fa8-5f18-409a-8b43-3f3a0a11ef94', '55924f6a-65e8-4279-93d6-257c0a11ef94', NULL, '557aad55-084c-4026-8e35-7a060a11ef94', 'Actionitems', '55936fa8-efdc-42b7-b3e0-3f3a0a11ef94', 'superadmin at 01-07-15 04:42:16', 'create', NULL, NULL, NULL, 0, '2015-07-01 04:42:16'),
('55936fa8-8d9c-4dea-b2b9-3f3b0a11ef94', '55924f6a-65e8-4279-93d6-257c0a11ef94', NULL, '557aad55-084c-4026-8e35-7a060a11ef94', 'Actionitems', '55936fa8-f724-4f21-b5ed-3f3b0a11ef94', ' &nbsp;superadmin this is very importantnormal', 'create', NULL, NULL, NULL, 0, '2015-07-01 04:42:16'),
('5593afc0-8e6c-4bb5-9e87-2d7a0a11ef94', '5593afc0-2b0c-46fb-9dbc-2d7a0a11ef94', NULL, '557aad55-084c-4026-8e35-7a060a11ef94', 'Project', '5593afc0-2b0c-46fb-9dbc-2d7a0a11ef94', 'project 3', 'create', NULL, NULL, NULL, 0, '2015-07-01 09:15:44'),
('5593aff2-1bf0-49a0-9e62-30820a11ef94', '5593afc0-2b0c-46fb-9dbc-2d7a0a11ef94', NULL, '557aad55-084c-4026-8e35-7a060a11ef94', 'Actionitems', '5593aff2-70c4-4ea4-bec6-30820a11ef94', 'user2 at 01-07-15 09:16:34', 'create', NULL, NULL, NULL, 0, '2015-07-01 09:16:34'),
('5593aff2-2c0c-4211-8788-30810a11ef94', '5593afc0-2b0c-46fb-9dbc-2d7a0a11ef94', NULL, '557aad55-084c-4026-8e35-7a060a11ef94', 'Actionitems', '5593aff2-b150-4c7c-a16e-30810a11ef94', 'user1 at 01-07-15 09:16:34', 'create', NULL, NULL, NULL, 0, '2015-07-01 09:16:34'),
('5593aff2-7c10-4a9b-8412-30700a11ef94', '5593afc0-2b0c-46fb-9dbc-2d7a0a11ef94', NULL, '557aad55-084c-4026-8e35-7a060a11ef94', 'Actionitems', '5593aff2-c1b0-41ed-965a-30700a11ef94', 'user at 01-07-15 09:16:34', 'create', NULL, NULL, NULL, 0, '2015-07-01 09:16:34'),
('5593aff3-3cd0-4f17-be00-30870a11ef94', '5593afc0-2b0c-46fb-9dbc-2d7a0a11ef94', NULL, '557aad55-084c-4026-8e35-7a060a11ef94', 'Notes', '5593aff3-bb78-48b8-8036-30870a11ef94', 'this is linked note', 'create', NULL, NULL, NULL, 0, '2015-07-01 09:16:35'),
('5593d699-19b0-4f0e-91c4-7b800a11ef94', '5593afc0-2b0c-46fb-9dbc-2d7a0a11ef94', NULL, '557aad55-084c-4026-8e35-7a060a11ef94', 'Actionitems', '5593d699-85fc-4721-93b4-7b800a11ef94', 'user at 01-07-15 12:01:29', 'create', NULL, NULL, NULL, 0, '2015-07-01 12:01:29'),
('5593d699-5360-401e-918b-7b830a11ef94', '5593afc0-2b0c-46fb-9dbc-2d7a0a11ef94', NULL, '557aad55-084c-4026-8e35-7a060a11ef94', 'Actionitems', '5593d699-a12c-4d47-96bd-7b830a11ef94', 'user1 at 01-07-15 12:01:29', 'create', NULL, NULL, NULL, 0, '2015-07-01 12:01:29'),
('5593d699-ab48-482c-a362-7b850a11ef94', '5593afc0-2b0c-46fb-9dbc-2d7a0a11ef94', NULL, '557aad55-084c-4026-8e35-7a060a11ef94', 'Actionitems', '5593d699-fbd0-4215-b515-7b850a11ef94', 'kumar at 01-07-15 12:01:29', 'create', NULL, NULL, NULL, 0, '2015-07-01 12:01:29'),
('5593d699-bcf8-43bc-ba49-7b810a11ef94', '5593afc0-2b0c-46fb-9dbc-2d7a0a11ef94', NULL, '557aad55-084c-4026-8e35-7a060a11ef94', 'Actionitems', '5593d699-329c-4ff4-a3b8-7b810a11ef94', 'user2 at 01-07-15 12:01:29', 'create', NULL, NULL, NULL, 0, '2015-07-01 12:01:29'),
('5593d699-e6ac-4fc9-acff-7b880a11ef94', '5593afc0-2b0c-46fb-9dbc-2d7a0a11ef94', NULL, '557aad55-084c-4026-8e35-7a060a11ef94', 'Actionitems', '5593d699-1e34-45f0-bfed-7b880a11ef94', ' &nbsp;user1&nbsp;this is your taskhigh', 'create', NULL, NULL, NULL, 0, '2015-07-01 12:01:29'),
('5593d69a-5184-4e5a-88c9-7baf0a11ef94', '5593afc0-2b0c-46fb-9dbc-2d7a0a11ef94', NULL, '557aad55-084c-4026-8e35-7a060a11ef94', 'Actionitems', '5593d69a-8394-486d-a6c6-7baf0a11ef94', 'user2 at 01-07-15 12:01:30', 'create', NULL, NULL, NULL, 0, '2015-07-01 12:01:30'),
('5593d69a-75d0-487e-9ece-7bb10a11ef94', '5593afc0-2b0c-46fb-9dbc-2d7a0a11ef94', NULL, '557aad55-084c-4026-8e35-7a060a11ef94', 'Actionitems', '5593d69a-ab00-4152-b40d-7bb10a11ef94', 'user at 01-07-15 12:01:30', 'create', NULL, NULL, NULL, 0, '2015-07-01 12:01:30'),
('5593d69a-e640-4523-92e7-7bb00a11ef94', '5593afc0-2b0c-46fb-9dbc-2d7a0a11ef94', NULL, '557aad55-084c-4026-8e35-7a060a11ef94', 'Noteshistory', '5593d69a-5c08-4df0-b537-7bb00a11ef94', 'this is linked note', 'create', NULL, NULL, NULL, 0, '2015-07-01 12:01:30'),
('5593d792-5458-4174-b902-0d0c0a11ef94', '5593afc0-2b0c-46fb-9dbc-2d7a0a11ef94', NULL, '557aad55-084c-4026-8e35-7a060a11ef94', 'Actionitems', '5593d792-7024-4fc0-8c5c-0d0c0a11ef94', 'superadmin at 01-07-15 12:05:38', 'create', NULL, NULL, NULL, 0, '2015-07-01 12:05:38'),
('5593d792-6198-4a73-98e5-0d090a11ef94', '5593afc0-2b0c-46fb-9dbc-2d7a0a11ef94', NULL, '557aad55-084c-4026-8e35-7a060a11ef94', 'Actionitems', '5593d792-c1c0-4e72-a151-0d090a11ef94', 'user at 01-07-15 12:05:38', 'create', NULL, NULL, NULL, 0, '2015-07-01 12:05:38'),
('5593d792-70f4-41ca-929c-0d050a11ef94', '5593afc0-2b0c-46fb-9dbc-2d7a0a11ef94', NULL, '557aad55-084c-4026-8e35-7a060a11ef94', 'Actionitems', '5593d792-d890-4cf2-9517-0d050a11ef94', ' &nbsp;superadmin&nbsp;this task should complete till mondaynormal', 'create', NULL, NULL, NULL, 0, '2015-07-01 12:05:38'),
('5593d792-800c-4978-a632-0d060a11ef94', '5593afc0-2b0c-46fb-9dbc-2d7a0a11ef94', NULL, '557aad55-084c-4026-8e35-7a060a11ef94', 'Actionitems', '5593d792-b730-4bfb-ab1b-0d060a11ef94', 'user1 at 01-07-15 12:05:38', 'create', NULL, NULL, NULL, 0, '2015-07-01 12:05:38'),
('5593d792-a01c-44fd-84ac-0d0a0a11ef94', '5593afc0-2b0c-46fb-9dbc-2d7a0a11ef94', NULL, '557aad55-084c-4026-8e35-7a060a11ef94', 'Actionitems', '5593d792-df10-436b-84d9-0d0a0a11ef94', 'user2 at 01-07-15 12:05:38', 'create', NULL, NULL, NULL, 0, '2015-07-01 12:05:38'),
('5593d792-d3fc-45ac-ac97-0d0b0a11ef94', '5593afc0-2b0c-46fb-9dbc-2d7a0a11ef94', NULL, '557aad55-084c-4026-8e35-7a060a11ef94', 'Actionitems', '5593d792-3c58-473d-b79f-0d0b0a11ef94', ' &nbsp;admin2&nbsp;designing is your tasknormal', 'create', NULL, NULL, NULL, 0, '2015-07-01 12:05:38'),
('5593d793-7770-4a06-882b-0d260a11ef94', '5593afc0-2b0c-46fb-9dbc-2d7a0a11ef94', NULL, '557aad55-084c-4026-8e35-7a060a11ef94', 'Actionitems', '5593d793-b4d4-4d44-9014-0d260a11ef94', 'admin2 at 01-07-15 12:05:39', 'create', NULL, NULL, NULL, 0, '2015-07-01 12:05:39'),
('5593d794-f440-4e0e-998d-0d370a11ef94', '5593afc0-2b0c-46fb-9dbc-2d7a0a11ef94', NULL, '557aad55-084c-4026-8e35-7a060a11ef94', 'Notes', '5593d794-fa74-45e6-8477-0d370a11ef94', 'this is interlinked note', 'create', NULL, NULL, NULL, 0, '2015-07-01 12:05:40'),
('5593d7d0-05d4-4701-a630-119e0a11ef94', '55924f6a-65e8-4279-93d6-257c0a11ef94', NULL, '557aad55-084c-4026-8e35-7a060a11ef94', 'Actionitems', '5593d7d0-c9fc-4eb5-9102-119e0a11ef94', 'user at 01-07-15 12:06:40', 'create', NULL, NULL, NULL, 0, '2015-07-01 12:06:40'),
('5593d7d0-4714-4063-8809-11a50a11ef94', '55924f6a-65e8-4279-93d6-257c0a11ef94', NULL, '557aad55-084c-4026-8e35-7a060a11ef94', 'Actionitems', '5593d7d0-bd80-4486-8571-11a50a11ef94', 'user1 at 01-07-15 12:06:40', 'create', NULL, NULL, NULL, 0, '2015-07-01 12:06:40'),
('5593d7d0-6e1c-480e-90a1-119d0a11ef94', '55924f6a-65e8-4279-93d6-257c0a11ef94', NULL, '557aad55-084c-4026-8e35-7a060a11ef94', 'Actionitems', '5593d7d0-9e9c-41b8-9a28-119d0a11ef94', 'user2 at 01-07-15 12:06:40', 'create', NULL, NULL, NULL, 0, '2015-07-01 12:06:40'),
('5593d7d0-a9e0-4517-9422-119b0a11ef94', '55924f6a-65e8-4279-93d6-257c0a11ef94', NULL, '557aad55-084c-4026-8e35-7a060a11ef94', 'Actionitems', '5593d7d0-f0ac-4437-8055-119b0a11ef94', ' &nbsp;admin2&nbsp;designing is your tasknormal', 'create', NULL, NULL, NULL, 0, '2015-07-01 12:06:40'),
('5593d7d0-cbe4-45c9-8e7d-11a40a11ef94', '55924f6a-65e8-4279-93d6-257c0a11ef94', NULL, '557aad55-084c-4026-8e35-7a060a11ef94', 'Actionitems', '5593d7d0-0628-4066-a7dc-11a40a11ef94', 'superadmin at 01-07-15 12:06:40', 'create', NULL, NULL, NULL, 0, '2015-07-01 12:06:40'),
('5593d7d0-e7c8-471d-b706-11a30a11ef94', '55924f6a-65e8-4279-93d6-257c0a11ef94', NULL, '557aad55-084c-4026-8e35-7a060a11ef94', 'Actionitems', '5593d7d0-ec24-4bc1-be74-11a30a11ef94', ' &nbsp;superadmin&nbsp;this task should complete till mondaynormal', 'create', NULL, NULL, NULL, 0, '2015-07-01 12:06:40'),
('5593d7d2-3438-4ea0-88da-11c20a11ef94', '55924f6a-65e8-4279-93d6-257c0a11ef94', NULL, '557aad55-084c-4026-8e35-7a060a11ef94', 'Noteshistory', '5593d7d2-7e40-4303-b387-11c20a11ef94', 'this is interlinked note', 'create', NULL, NULL, NULL, 0, '2015-07-01 12:06:42'),
('5593f0c7-f0a4-4f25-8a19-05750a11ef94', '558b8b6e-71ec-4c2f-8fd1-2b330a11ef94', '55914095-b398-49de-969f-76990a11ef94', '557aae3f-cfec-4944-a4de-09b00a11ef94', 'Comment', '5593f0c7-2b04-4d11-b859-05750a11ef94', 'test coment on notes test coment on notes test coment on notes test coment on notes test coment on notes test coment on notes test coment on notes test coment on notes ', 'create', NULL, NULL, NULL, 0, '2015-07-01 13:53:11'),
('5593f0d1-6b34-49aa-a113-06330a11ef94', '558b8b6e-71ec-4c2f-8fd1-2b330a11ef94', '55914095-b398-49de-969f-76990a11ef94', '557aae3f-cfec-4944-a4de-09b00a11ef94', 'Comment', '5593f0d1-6964-4972-a3c1-06330a11ef94', 'test coment on notes test coment on notes test coment on notes test coment on notes ', 'create', NULL, NULL, NULL, 0, '2015-07-01 13:53:21'),
('559507e8-15ec-45ad-ac92-3bba0a11ef94', '55924f6a-65e8-4279-93d6-257c0a11ef94', NULL, '557aad55-084c-4026-8e35-7a060a11ef94', 'Actionitems', '559507e8-5418-446a-814e-3bba0a11ef94', 'user at 02-07-15 09:44:08', 'create', NULL, NULL, NULL, 0, '2015-07-02 09:44:08'),
('559507e8-5770-4af7-a576-3bb90a11ef94', '55924f6a-65e8-4279-93d6-257c0a11ef94', NULL, '557aad55-084c-4026-8e35-7a060a11ef94', 'Actionitems', '559507e8-dd44-4396-b23e-3bb90a11ef94', ' &nbsp;superadmin&nbsp;this task should complete till mondaynormal', 'create', NULL, NULL, NULL, 0, '2015-07-02 09:44:08'),
('559507e8-7750-4144-9f4c-3bbb0a11ef94', '55924f6a-65e8-4279-93d6-257c0a11ef94', NULL, '557aad55-084c-4026-8e35-7a060a11ef94', 'Actionitems', '559507e8-aa8c-4ee2-a452-3bbb0a11ef94', 'user1 at 02-07-15 09:44:08', 'create', NULL, NULL, NULL, 0, '2015-07-02 09:44:08'),
('559507e8-922c-4a9d-9e2d-3bbd0a11ef94', '55924f6a-65e8-4279-93d6-257c0a11ef94', NULL, '557aad55-084c-4026-8e35-7a060a11ef94', 'Actionitems', '559507e8-b6f4-40cf-b6dd-3bbd0a11ef94', ' &nbsp;admin2&nbsp;designing is your tasknormal', 'create', NULL, NULL, NULL, 0, '2015-07-02 09:44:08'),
('559507e8-df40-4a3c-9be6-3bbc0a11ef94', '55924f6a-65e8-4279-93d6-257c0a11ef94', NULL, '557aad55-084c-4026-8e35-7a060a11ef94', 'Actionitems', '559507e8-1664-4878-9dc1-3bbc0a11ef94', 'superadmin at 02-07-15 09:44:08', 'create', NULL, NULL, NULL, 0, '2015-07-02 09:44:08'),
('559507e8-f8bc-4572-bb13-3bb80a11ef94', '55924f6a-65e8-4279-93d6-257c0a11ef94', NULL, '557aad55-084c-4026-8e35-7a060a11ef94', 'Actionitems', '559507e8-3814-4914-aa0a-3bb80a11ef94', 'user2 at 02-07-15 09:44:08', 'create', NULL, NULL, NULL, 0, '2015-07-02 09:44:08'),
('559507e9-744c-48f8-a21f-3bec0a11ef94', '55924f6a-65e8-4279-93d6-257c0a11ef94', NULL, '557aad55-084c-4026-8e35-7a060a11ef94', 'Actionitems', '559507e9-ae90-4529-bb34-3bec0a11ef94', 'superadmin at 02-07-15 09:44:09', 'create', NULL, NULL, NULL, 0, '2015-07-02 09:44:09'),
('559507e9-9a94-44d9-a42e-3be70a11ef94', '55924f6a-65e8-4279-93d6-257c0a11ef94', NULL, '557aad55-084c-4026-8e35-7a060a11ef94', 'Actionitems', '559507e9-cf20-4cf7-a7bf-3be70a11ef94', 'admin2 at 02-07-15 09:44:09', 'create', NULL, NULL, NULL, 0, '2015-07-02 09:44:09'),
('559507e9-accc-4c5b-a58e-3bf00a11ef94', '55924f6a-65e8-4279-93d6-257c0a11ef94', NULL, '557aad55-084c-4026-8e35-7a060a11ef94', 'Noteshistory', '559507e9-e7fc-41ba-95fb-3bf00a11ef94', '2015-07-01Meeting Notes', 'create', NULL, NULL, NULL, 0, '2015-07-02 09:44:09');

-- --------------------------------------------------------

--
-- Table structure for table `ce_org_charts`
--

CREATE TABLE IF NOT EXISTS `ce_org_charts` (
  `id` varchar(36) NOT NULL,
  `chart_name` varchar(255) NOT NULL,
  `user_id` varchar(36) NOT NULL,
  `chart_code` varchar(100) NOT NULL,
  `chart_json` text NOT NULL,
  `chart_wiki` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `chart_update_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ce_org_charts`
--

INSERT INTO `ce_org_charts` (`id`, `chart_name`, `user_id`, `chart_code`, `chart_json`, `chart_wiki`, `created`, `modified`, `chart_update_by`) VALUES
('5594ba43-224c-4068-a41d-2ed30a11ef94', 'test name', '557aad55-084c-4026-8e35-7a060a11ef94', '7b8397a7e104e6d8fee3429d64eb4361', '{ "class": "go.GraphLinksModel",\n  "linkFromPortIdProperty": "fromPort",\n  "linkToPortIdProperty": "toPort",\n  "nodeDataArray": [ \n{"category":"Start", "text":"Start", "key":-1, "loc":"300 50", "info":"", "link":""},\n{"category":"Diamond", "text":"???", "figure":"Diamond", "key":-5, "loc":"280 190", "info":"", "link":""},\n{"category":"Diamond", "text":"???", "figure":"Diamond", "key":-3, "loc":"480 190", "info":"", "link":""},\n{"text":"Stop", "figure":"StopSign", "key":-7, "loc":"650 190", "info":"", "link":""},\n{"category":"multyport", "text":"Multi I/O", "figure":"Rectangle", "key":-2, "loc":"190 380", "info":"", "link":"", "size":"74.80201721191406 130"},\n{"category":"multyport", "text":"Multi I/O", "figure":"Rectangle", "key":-6, "loc":"420 380", "info":"", "link":"", "size":"74.80201721191406 134"},\n{"category":"End", "text":"End", "key":-9, "loc":"350 550", "info":"", "link":""}\n ],\n  "linkDataArray": [ \n{"from":-1, "to":-5, "fromPort":"B", "toPort":"T", "points":[300,82.03461633726609,300,92.03461633726609,300,119.83160717986351,280,119.83160717986351,280,147.62859802246095,280,157.62859802246095]},\n{"from":-5, "to":-3, "fromPort":"R", "toPort":"L", "points":[323.3578643798828,190,333.3578643798828,190,380,190,380,190,426.6421356201172,190,436.6421356201172,190]},\n{"from":-3, "to":-7, "fromPort":"R", "toPort":"L", "points":[523.3578643798828,190,533.3578643798828,190,569.2598517158317,190,569.2598517158317,190,605.1618390517807,190,615.1618390517807,190]},\n{"from":-2, "to":-6, "fromPort":"right3", "toPort":"left3", "points":[227.40100860595703,354,237.40100860595703,354,305,354,305,353.2,372.59899139404297,353.2,382.59899139404297,353.2]},\n{"from":-6, "to":-2, "fromPort":"left2", "toPort":"right2", "points":[382.59899139404297,380,372.59899139404297,380,305,380,305,380,237.40100860595703,380,227.40100860595703,380]},\n{"from":-2, "to":-6, "fromPort":"right1", "toPort":"left1", "points":[227.40100860595703,406,237.40100860595703,406,305,406,305,406.8,372.59899139404297,406.8,382.59899139404297,406.8]},\n{"from":-2, "to":-5, "fromPort":"top2", "toPort":"", "points":[190,315,190,305,190,268.68570098876955,280,268.68570098876955,280,232.37140197753908,280,222.37140197753908]},\n{"from":-5, "to":-2, "fromPort":"L", "toPort":"left1", "points":[236.6421356201172,190,226.6421356201172,190,79,190,79,406,142.59899139404297,406,152.59899139404297,406]},\n{"from":-1, "to":-2, "fromPort":"L", "toPort":"left2", "points":[267.9653836627339,50,257.9653836627339,50,130,50,130,380,142.59899139404297,380,152.59899139404297,380]},\n{"from":-3, "to":-6, "fromPort":"B", "toPort":"right2", "points":[480,222.37140197753908,480,232.37140197753908,480,380,473.7005043029785,380,467.40100860595703,380,457.40100860595703,380]},\n{"from":-7, "to":-6, "fromPort":"B", "toPort":"right1", "points":[650,213.0364844642402,650,223.0364844642402,650,406.8,558.7005043029785,406.8,467.40100860595703,406.8,457.40100860595703,406.8]},\n{"from":-1, "to":-9, "fromPort":"R", "toPort":"T", "points":[332.03461633726613,50,342.03461633726613,50,350,50,350,280,350,510,350,520]},\n{"from":-6, "to":-9, "fromPort":"", "toPort":"R", "points":[420,447,420,457,420,550,403.94216830231426,550,387.88433660462846,550,377.88433660462846,550]},\n{"from":-2, "to":-9, "fromPort":"bottom2", "toPort":"L", "points":[190,445,190,455,190,550,251.05783169768577,550,312.11566339537154,550,322.11566339537154,550]},\n{"from":-7, "to":-9, "fromPort":"R", "toPort":"R", "points":[684.8381609482193,190,694.8381609482193,190,694.8381609482193,550,541.3612487764238,550,387.88433660462846,550,377.88433660462846,550]}\n ]}', '<p><iframe src="//www.youtube.com/embed/DpsyGweP5so" width="738" height="300"></iframe></p>', '2015-07-02 04:12:51', '2015-07-02 07:50:22', 0),
('5594baa2-a7a8-4849-a26e-34560a11ef94', 'test name', '557aad55-084c-4026-8e35-7a060a11ef94', '321612a720e5f70f6931172a7df268e4', '{ "class": "go.GraphLinksModel",\n  "linkFromPortIdProperty": "fromPort",\n  "linkToPortIdProperty": "toPort",\n  "nodeDataArray": [ {"category":"Diamond", "text":"???", "figure":"GenderFemale", "key":-5, "loc":"290 80", "info":"", "link":""} ],\n  "linkDataArray": [  ]}', '', '2015-07-02 04:14:26', '2015-07-02 04:14:36', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ce_phases`
--

CREATE TABLE IF NOT EXISTS `ce_phases` (
  `id` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `project_id` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `position` int(6) DEFAULT NULL,
  `percent_completed` int(11) NOT NULL DEFAULT '0',
  `date_start` datetime NOT NULL,
  `date_end` datetime NOT NULL,
  `comment_count` int(6) NOT NULL DEFAULT '0',
  `client_can_update` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `phase_to_project_idx` (`project_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ce_phases`
--

INSERT INTO `ce_phases` (`id`, `project_id`, `title`, `slug`, `description`, `position`, `percent_completed`, `date_start`, `date_end`, `comment_count`, `client_can_update`, `created`, `modified`) VALUES
('55914095-b398-49de-969f-76990a11ef94', '558b8b6e-71ec-4c2f-8fd1-2b330a11ef94', 'test phase', 'test_phase', 'sadgtdfhgdfh', 1, 62, '2015-06-28 23:00:00', '2015-08-27 23:00:00', 2, 1, '2015-06-29 12:56:53', '2015-06-30 09:19:44'),
('5591409f-ce8c-4a8a-a92d-77360a11ef94', '558b8b6e-71ec-4c2f-8fd1-2b330a11ef94', 'test phase2', 'test_phase2', 'ghjfdjghj', 2, 0, '2015-08-27 23:00:00', '2015-08-28 23:00:00', 0, 1, '2015-06-29 12:57:03', '2015-06-29 12:57:03'),
('559140ab-a128-4595-805d-77eb0a11ef94', '558b8b6e-71ec-4c2f-8fd1-2b330a11ef94', 'test phase3', 'test_phase3', 'dfjfhjghj', 3, 0, '2015-08-28 23:00:00', '2015-10-02 23:00:00', 0, 1, '2015-06-29 12:57:15', '2015-06-29 12:57:15');

-- --------------------------------------------------------

--
-- Table structure for table `ce_projects`
--

CREATE TABLE IF NOT EXISTS `ce_projects` (
  `id` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `phase_count` int(6) NOT NULL DEFAULT '0',
  `percent_completed` float(5,2) NOT NULL DEFAULT '0.00',
  `date_start` datetime DEFAULT NULL,
  `date_end` datetime DEFAULT NULL,
  `archived` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ce_projects`
--

INSERT INTO `ce_projects` (`id`, `title`, `slug`, `description`, `phase_count`, `percent_completed`, `date_start`, `date_end`, `archived`, `created`, `modified`) VALUES
('558b8b6e-71ec-4c2f-8fd1-2b330a11ef94', 'test project', 'test_project', 'this is just a test project .. ', 3, 20.67, '2015-06-28 23:00:00', '2015-10-02 23:00:00', 0, '2015-06-25 05:02:38', '2015-06-25 05:02:38'),
('55924f6a-65e8-4279-93d6-257c0a11ef94', 'dummy project', 'dummy_project', 'this is just a dummy project check it as much as you can.', 0, 0.00, NULL, NULL, 0, '2015-06-30 08:12:26', '2015-06-30 08:12:26'),
('5593afc0-2b0c-46fb-9dbc-2d7a0a11ef94', 'project 3', 'project_3', 'this is just a test project to check linked notes', 0, 0.00, NULL, NULL, 0, '2015-07-01 09:15:44', '2015-07-01 09:15:44');

-- --------------------------------------------------------

--
-- Table structure for table `ce_projects_clients`
--

CREATE TABLE IF NOT EXISTS `ce_projects_clients` (
  `id` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `project_id` varchar(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `client_id` varchar(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `projects_client_to_project_idx` (`project_id`),
  KEY `projects_client_to_client_idx` (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ce_projects_clients`
--

INSERT INTO `ce_projects_clients` (`id`, `project_id`, `client_id`) VALUES
('558b8b6e-b088-44bc-89ff-2b330a11ef94', '558b8b6e-71ec-4c2f-8fd1-2b330a11ef94', '557aadad-d5a4-49f6-93ea-7f3d0a11ef94'),
('55924f6a-a358-41e6-bc78-257c0a11ef94', '55924f6a-65e8-4279-93d6-257c0a11ef94', '557aadad-d5a4-49f6-93ea-7f3d0a11ef94'),
('5593afc0-57b0-4a68-a6ba-2d7a0a11ef94', '5593afc0-2b0c-46fb-9dbc-2d7a0a11ef94', '557aadad-d5a4-49f6-93ea-7f3d0a11ef94');

-- --------------------------------------------------------

--
-- Table structure for table `ce_projects_users`
--

CREATE TABLE IF NOT EXISTS `ce_projects_users` (
  `id` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `project_id` varchar(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` varchar(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cm_projects_users_cm_projects1_idx` (`project_id`),
  KEY `fk_cm_projects_users_cm_users1_idx` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ce_users`
--

CREATE TABLE IF NOT EXISTS `ce_users` (
  `id` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `client_id` varchar(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `department` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `temp_password` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'client',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `receivenotifications` tinyint(1) NOT NULL DEFAULT '1',
  `avatarpath` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatarpath_dir` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastactivity` datetime DEFAULT NULL,
  `language` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'en-gb',
  `timezone` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Europe/London',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_to_client_idx` (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ce_users`
--

INSERT INTO `ce_users` (`id`, `client_id`, `department`, `username`, `fname`, `lname`, `email`, `password`, `temp_password`, `role`, `active`, `receivenotifications`, `avatarpath`, `avatarpath_dir`, `lastactivity`, `language`, `timezone`, `created`, `modified`) VALUES
('557aad55-084c-4026-8e35-7a060a11ef94', NULL, '', 'superadmin', 'rex', 'Johnson', 'info@rudrainnovatives.com', '598688b5d073ecbf24095056a3c4afb1f2629e3f', NULL, 'admin', 1, 1, 'coder.png', '557aad55-084c-4026-8e35-7a060a11ef94', '2015-07-02 09:45:01', 'en-gb', 'Europe/London', '2015-06-12 09:58:45', '2015-07-02 09:29:24'),
('557aadcc-e1d4-44fc-b835-02f90a11ef94', '557aadad-d5a4-49f6-93ea-7f3d0a11ef94', '55913929-88dc-49ba-aaff-036f0a11ef94', 'admin', 'Robert ', 'curstn', 'admin@gmail.com', 'fbf8577c5c9fce4480b61318d1ec489c988060b4', NULL, 'client', 1, 1, 'administrator.png', '557aadcc-e1d4-44fc-b835-02f90a11ef94', '2015-07-01 04:00:22', 'en-gb', 'Europe/London', '2015-06-12 10:00:44', '2015-06-29 12:27:34'),
('557aadf9-d340-4de8-8253-05ad0a11ef94', '557aadad-d5a4-49f6-93ea-7f3d0a11ef94', '55913958-e880-4aa7-b6ae-06820a11ef94', 'editor', 'vin', 'diesel', 'editor@gmail.com', '2a379a48bb5053c697abda7973842605241072ae', 'editor', 'client', 1, 1, 'Businessman.png', '557aadf9-d340-4de8-8253-05ad0a11ef94', NULL, 'en-gb', 'Europe/London', '2015-06-12 10:01:29', '2015-06-29 12:27:55'),
('557aae22-8630-49f6-a5ae-07f20a11ef94', '557aadad-d5a4-49f6-93ea-7f3d0a11ef94', '55913965-c6a8-4eb7-9169-07560a11ef94', 'admin2', 'sherolock', 'holms', 'admin2@gmail.com', 'cef46c05d3337d122e934e9f0a31888c259c287c', NULL, 'client', 1, 1, 'User.png', '557aae22-8630-49f6-a5ae-07f20a11ef94', '2015-06-12 12:42:18', 'en-gb', 'Europe/London', '2015-06-12 10:02:10', '2015-06-29 12:28:14'),
('557aae3f-cfec-4944-a4de-09b00a11ef94', '557aadad-d5a4-49f6-93ea-7f3d0a11ef94', '55913929-88dc-49ba-aaff-036f0a11ef94', 'admin3', 'undertaker', '', 'admin3@gmail.com', '28632ff00d890a20ab17930bbe2c49b6e771867a', NULL, 'client', 1, 1, 'tf_141210_Myanmar-1.jpg', '557aae3f-cfec-4944-a4de-09b00a11ef94', '2015-07-01 13:54:49', 'en-gb', 'Europe/London', '2015-06-12 10:02:39', '2015-06-29 12:28:29'),
('557aae62-9830-4177-9870-0b9a0a11ef94', '557aadad-d5a4-49f6-93ea-7f3d0a11ef94', '5591393e-bd94-47b2-8e3d-04f70a11ef94', 'user1', 'The ', 'Rock', 'user1@gmail.com', '4a5aa9b66173e37bc10475923867afca422c36b2', 'user1', 'client', 1, 0, 'administrator.png', '557aae62-9830-4177-9870-0b9a0a11ef94', NULL, 'en-gb', 'Europe/London', '2015-06-12 10:03:14', '2015-06-29 12:28:57'),
('557aae85-1950-4452-8674-0da70a11ef94', '557aadad-d5a4-49f6-93ea-7f3d0a11ef94', '5591393e-bd94-47b2-8e3d-04f70a11ef94', 'user2', 'gerry', 'sandhu', 'user2@gmail.com', '948bc02fc1b843b2746fbf8fa8315de7d8eed2a4', 'user2', 'client', 1, 1, 'Businessman.png', '557aae85-1950-4452-8674-0da70a11ef94', NULL, 'en-gb', 'Europe/London', '2015-06-12 10:03:49', '2015-06-29 12:29:30'),
('557aaeaa-d68c-41b4-a79f-0fcc0a11ef94', '557aadad-d5a4-49f6-93ea-7f3d0a11ef94', '5591393e-bd94-47b2-8e3d-04f70a11ef94', 'user', 'Opera', 'Mini', 'user@gmail.com', 'f26c2261f2bc344be3b592764bbae3356ac18d1c', NULL, 'client', 1, 1, '2013-mtm-polo-r-wrc-street-02.jpg', '557aaeaa-d68c-41b4-a79f-0fcc0a11ef94', '2015-06-12 12:10:55', 'en-gb', 'Europe/Copenhagen', '2015-06-12 10:04:26', '2015-06-29 12:29:45'),
('557e680f-c130-4462-9ebd-60a70a11ef94', '557aadad-d5a4-49f6-93ea-7f3d0a11ef94', '5591394a-b400-4830-a790-05ae0a11ef94', 'kumar', 'mozil', 'Firefox', 'kumar@gmail.com', '3cc5dd8cb4c5598a17603e183254d10d7770acd0', NULL, 'client', 1, 0, 'Crius-Responsive-Photography-Creative-Portfolio.jpg', '557e680f-c130-4462-9ebd-60a70a11ef94', '2015-06-16 10:32:22', 'en-gb', 'Europe/London', '2015-06-15 05:52:15', '2015-06-29 12:29:59');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_departments`
--

CREATE TABLE IF NOT EXISTS `tbl_departments` (
  `dep_id` int(11) NOT NULL AUTO_INCREMENT,
  `dep_name` varchar(100) NOT NULL,
  `dep_head` varchar(100) NOT NULL,
  `dep_status` tinyint(1) NOT NULL COMMENT '1=>active;0=>inactive',
  `dep_description` text NOT NULL,
  `dep_create_dt` bigint(20) DEFAULT NULL,
  `dep_create_by` int(11) DEFAULT NULL,
  `dep_update_dt` timestamp NULL DEFAULT NULL,
  `dep_update_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`dep_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_departments`
--

INSERT INTO `tbl_departments` (`dep_id`, `dep_name`, `dep_head`, `dep_status`, `dep_description`, `dep_create_dt`, `dep_create_by`, `dep_update_dt`, `dep_update_by`) VALUES
(4, 'check department', '52', 1, 'this si just a check department', 1433237699, NULL, NULL, NULL),
(5, 'department2', '54', 1, '', 1433240343, NULL, NULL, NULL),
(6, 'department3', '52', 1, '', 1433240430, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_flowcharts`
--

CREATE TABLE IF NOT EXISTS `tbl_flowcharts` (
  `chart_id` int(11) NOT NULL AUTO_INCREMENT,
  `chart_name` varchar(100) NOT NULL,
  `chart_code` varchar(100) NOT NULL,
  `chart_json` text NOT NULL,
  `chart_wiki` text NOT NULL,
  `chart_create_dt` datetime NOT NULL,
  `chart_create_by` int(11) NOT NULL,
  `chart_update_dt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `chart_update_by` int(11) NOT NULL,
  PRIMARY KEY (`chart_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `tbl_flowcharts`
--

INSERT INTO `tbl_flowcharts` (`chart_id`, `chart_name`, `chart_code`, `chart_json`, `chart_wiki`, `chart_create_dt`, `chart_create_by`, `chart_update_dt`, `chart_update_by`) VALUES
(15, 'myfirst flowchart', 'e438c2f9d04a3a39956c3d40a57d0206', '{ "class": "go.GraphLinksModel",\n  "linkFromPortIdProperty": "fromPort",\n  "linkToPortIdProperty": "toPort",\n  "nodeDataArray": [ \n{"category":"Start", "text":"Start", "key":-1, "loc":"84.00000000000003 46.99999999999999", "info":"", "link":""},\n{"category":"multyport", "text":"Multi I/O", "figure":"Rectangle", "key":-2, "loc":"0 335.2", "info":" this has only text ...... no attachment available ", "link":"", "size":"74 105", "visible":true},\n{"category":"multyport", "text":"Multi I/O", "figure":"Rectangle", "key":-4, "loc":"192 335.2", "info":" this is information about this node that this as information . Do you want to know more about this ?? just click the belo attachment", "link":"were captured; Australian casualties", "size":"70 103", "visible":true, "visible2":true, "color":"rgb(158,0,127)", "stroke":"black"},\n{"text":"Step", "key":-6, "loc":"93 468", "info":"", "link":""},\n{"category":"End", "text":"chart end here", "key":-10, "loc":"523 411.5", "info":"", "link":"", "size":"94 96", "visible":false},\n{"category":"Diamond", "text":"???", "figure":"Diamond", "key":-5, "loc":"28 160.5", "info":"this is just a information", "link":"Commonwealth War Graves", "size":"86.71572875976562 75.74280395507813", "visible":true, "visible2":true, "color":"rgb(199,176,176)", "stroke":"black"},\n{"category":"Comment", "text":"Comment", "figure":"RoundedRectangle", "key":-7, "loc":"660 390", "info":"", "link":""}\n ],\n  "linkDataArray": [ \n{"from":-2, "to":-4, "fromPort":"right3", "toPort":"left3", "points":[42,319.2,52,319.2,100.12499999999994,319.2,100.12499999999994,319.6000000000001,148.2499999999999,319.6000000000001,158.2499999999999,319.6000000000001]},\n{"from":-4, "to":-2, "fromPort":"left2", "toPort":"right2", "points":[158.2499999999999,340.2000000000001,148.2499999999999,340.2000000000001,100.12499999999994,340.2000000000001,100.12499999999994,340.2,52,340.2,42,340.2]},\n{"from":-2, "to":-4, "fromPort":"right1", "toPort":"left1", "points":[42,361.2,52,361.2,100.12499999999994,361.2,100.12499999999994,360.8000000000001,148.2499999999999,360.8000000000001,158.2499999999999,360.8000000000001]},\n{"from":-1, "to":-6, "fromPort":"R", "toPort":"T", "points":[116.03461633726609,47,126.03461633726609,47,126.03461633726609,264.2994576742483,93,264.2994576742483,93,441.56429901123045,93,451.56429901123045]},\n{"from":-2, "fromPort":"bottom1", "toPort":"T", "points":[-9.8,392.7,-9.8,402.7,234.5,402.7,234.5,275.5,419,275.5,429,275.5]},\n{"from":-5, "to":-2, "fromPort":"B", "toPort":"top3", "visible":true, "points":[28.000000000000007,198.37140197753905,28.000000000000007,208.37140197753905,28.000000000000007,243.03570098876952,19.8,243.03570098876952,19.8,277.7,19.8,287.7]},\n{"from":-1, "to":-5, "fromPort":"B", "toPort":"T", "points":[84.00000000000003,79.03461633726607,84.00000000000003,89.03461633726607,84.00000000000003,100.83160717986351,28.000000000000007,100.83160717986351,28.000000000000007,112.62859802246093,28.000000000000007,122.62859802246093]},\n{"from":-5, "to":-4, "fromPort":"R", "toPort":"top1", "visible":true, "points":[71.35786437988281,160.5,81.35786437988281,160.5,179.2499999999999,160.5,179.2499999999999,219.60000000000005,179.2499999999999,278.7000000000001,179.2499999999999,288.7000000000001]},\n{"from":-5, "to":-2, "fromPort":"L", "toPort":"left3", "visible":true, "points":[-15.357864379882805,160.5,-25.357864379882805,160.5,-42,160.5,-42,239.85,-42,319.2,-32,319.2]},\n{"points":[228.2499999999999,319.6000000000001,238.2499999999999,319.6000000000001,391.12499999999994,319.6000000000001,391.12499999999994,318,544,318,554,318], "from":-4, "fromPort":"right3"},\n{"points":[228.2499999999999,340.2000000000001,238.2499999999999,340.2000000000001,375.12499999999994,340.2000000000001,375.12499999999994,274,512,274,522,274], "from":-4, "fromPort":"right2"},\n{"from":-4, "to":-10, "fromPort":"bottom1", "toPort":"L", "points":[179.2499999999999,391.7000000000001,179.2499999999999,401.7000000000001,179.2499999999999,411.5,322.62499999999994,411.5,466,411.5,476,411.5]},\n{"from":-4, "to":-10, "fromPort":"bottom2", "toPort":"T", "points":[193.2499999999999,391.7000000000001,193.2499999999999,401.7000000000001,355.87499999999994,401.7000000000001,355.87499999999994,353.5,523,353.5,523,363.5]},\n{"from":-2, "fromPort":"bottom1", "toPort":"L", "points":[-9.8,392.7,-9.8,402.7,-9.8,457.85,83.62001037597656,457.85,83.62001037597656,513,83.62001037597656,523]},\n{"from":-2, "fromPort":"left1", "toPort":"", "points":[-33.75,359.45,-43.75,359.45,-43.75,167.225,51,167.225,51,63,51,53]},\n{"from":-1, "to":-2, "fromPort":"B", "toPort":"bottom2", "points":[84.00000000000003,79.03461633726607,84.00000000000003,89.03461633726607,84.00000000000003,400.95,43.625000000000014,400.95,3.25,400.95,3.25,390.95]},\n{"to":-10, "fromPort":"", "toPort":"R", "points":[614,395,604,395,592,395,592,411.5,580,411.5,570,411.5]}\n ]}', '<p><iframe src="//www.youtube.com/embed/_lyAEL4Wqao" width="746" height="246"></iframe>The&nbsp;<strong><a title="Battle of Labuan" href="https://en.wikipedia.org/wiki/Battle_of_Labuan">Battle of Labuan</a></strong>&nbsp;was fought between&nbsp;<a title="Allies of World War II" href="https://en.wikipedia.org/wiki/Allies_of_World_War_II">Allied</a>&nbsp;and&nbsp;<a title="Empire of Japan" href="https://en.wikipedia.org/wiki/Empire_of_Japan">Japanese</a>forces in June 1945 during World War II on the island of&nbsp;<a title="Labuan" href="https://en.wikipedia.org/wiki/Labuan">Labuan</a>, in preparation for the Australian&nbsp;<a title="Battle of North Borneo" href="https://en.wikipedia.org/wiki/Battle_of_North_Borneo">invasion of North Borneo</a>. Following weeks of air attacks and a short naval bombardment, the&nbsp;<a title="24th Brigade (Australia)" href="https://en.wikipedia.org/wiki/24th_Brigade_(Australia)">24th Brigade</a>&nbsp;landed on Labuan on 10 June and quickly captured the island''s harbour and main airfield. The greatly outnumbered Japanese garrison was concentrated in a fortified position, and offered little resistance to the landing. The initial attempts to penetrate the Japanese position were not successful, and the area was subjected to a heavy bombardment. A Japanese raiding force attacked Allied positions on 21 June, but was defeated. Later that day, Australian forces overwhelmed the Japanese position, and by mid-July, Australian patrols had killed or captured the remaining Japanese troops on the island. A total of 389 Japanese personnel were killed on Labuan and 11 were captured; Australian casualties included 34 killed. After securing the island, the Allies developed Labuan into a significant base and provided assistance to thousands of civilians who had been&nbsp;<a href="http://koivi.com/">rendered homeless by the pre-invasion</a> bombardment. Following the war, a major&nbsp;<a title="Commonwealth War Graves Commission" href="https://en.wikipedia.org/wiki/Commonwealth_War_Graves_Commission">Commonwealth War Graves Commission</a>&nbsp;cemetery was established on Labuan. (<a title="Battle of Labuan" href="https://en.wikipedia.org/wiki/Battle_of_Labuan"><strong>Full&nbsp;article...</strong></a>)</p>\n<p>&nbsp;</p>\n<p>The&nbsp;<strong><a title="Battle of Labuan" href="https://en.wikipedia.org/wiki/Battle_of_Labuan">Battle of Labuan</a></strong>&nbsp;was fought between&nbsp;<a title="Allies of World War II" href="https://en.wikipedia.org/wiki/Allies_of_World_War_II">Allied</a>&nbsp;and&nbsp;<a title="Empire of Japan" href="https://en.wikipedia.org/wiki/Empire_of_Japan">Japanese</a>forces in June 1945 during World War II on the island of&nbsp;<a title="Labuan" href="https://en.wikipedia.org/wiki/Labuan">Labuan</a>, in preparation for the Australian&nbsp;<a title="Battle of North Borneo" href="https://en.wikipedia.org/wiki/Battle_of_North_Borneo">invasion of North Borneo</a>. Following weeks of air attacks and a short naval bombardment, the&nbsp;<a title="24th Brigade (Australia)" href="https://en.wikipedia.org/wiki/24th_Brigade_(Australia)">24th Brigade</a>&nbsp;landed on Labuan on 10 June and quickly captured the island''s harbour and main airfield. The greatly outnumbered Japanese garrison was concentrated in a fortified position, and offered little resistance to the landing. The initial attempts to penetrate the Japanese position were not successful, and the area was subjected to a heavy bombardment. A Japanese raiding force attacked Allied positions on 21 June, but was defeated. Later that day, Australian forces overwhelmed the Japanese position, and by mid-July, Australian patrols had killed or captured the remaining Japanese troops on the island. A total of 389 Japanese personnel were killed on Labuan and 11 were captured; Australian casualties included 34 killed. After securing the island, the Allies developed Labuan into a significant base and provided assistance to thousands of civilians who had been rendered homeless by the pre-invasion <a href="https://mail.google.com/mail/u/0/#inbox">bombardment</a>. Following the war, a major&nbsp;<a title="Commonwealth War Graves Commission" href="https://en.wikipedia.org/wiki/Commonwealth_War_Graves_Commission">Commonwealth War Graves Commission</a>&nbsp;cemetery was established on Labuan. (<a title="Battle of Labuan" href="https://en.wikipedia.org/wiki/Battle_of_Labuan"><strong>Full&nbsp;article...</strong></a>)</p>', '2030-05-15 11:44:49', 55, '2015-06-04 07:49:45', 1),
(29, 'my flowchart 2', 'c1c36daee59162720ef2eef750904a86', '{ "class": "go.GraphLinksModel",\n  "linkFromPortIdProperty": "fromPort",\n  "linkToPortIdProperty": "toPort",\n  "nodeDataArray": [ \n{"category":"Diamond", "text":"???", "figure":"Diamond", "key":-5, "loc":"-203 -257", "info":"", "link":""},\n{"category":"Start", "text":"Start", "key":-1, "loc":"-327 -318", "info":"", "link":""},\n{"category":"page", "text":"Page", "key":-3, "loc":"-67 -194", "info":"", "link":""},\n{"text":"Step", "key":-4, "loc":"73 -109", "info":"", "link":""},\n{"category":"Diamond", "text":"???", "figure":"Diamond", "key":-6, "loc":"210 -56", "info":"", "link":""},\n{"category":"multyport", "text":"Multi I/O", "figure":"Rectangle", "key":-2, "loc":"112 -249.93570098876955", "info":"", "link":"", "size":"74.80201721191406 141"},\n{"text":"Message", "figure":"MessageToUser", "key":-8, "loc":"346 -259", "info":"", "link":""},\n{"text":"Stop", "figure":"StopSign", "key":-7, "loc":"-15 -325", "info":"", "link":""},\n{"category":"directdata", "text":"Data", "figure":"Cylinder3", "key":-9, "loc":"-157 -60", "info":"", "link":""},\n{"category":"End", "text":"End", "key":-10, "loc":"3 -7", "info":"", "link":""},\n{"category":"Comment", "text":"Comment", "figure":"RoundedRectangle", "key":-11, "loc":"-297 -141", "info":"", "link":""}\n ],\n  "linkDataArray": [ \n{"from":-1, "to":-5, "fromPort":"R", "toPort":"L", "points":[-294.96538366273387,-318,-284.96538366273387,-318,-270.66162402130834,-318,-270.66162402130834,-257,-256.3578643798828,-257,-246.3578643798828,-257]},\n{"from":-1, "to":-3, "fromPort":"B", "toPort":"L", "points":[-327,-285.96538366273387,-327,-275.96538366273387,-327,-194.00000000000003,-215.00761032104492,-194.00000000000003,-103.01522064208984,-194.00000000000003,-93.01522064208984,-194.00000000000003]},\n{"from":-9, "to":-4, "fromPort":"R", "toPort":"L", "points":[-126.66633169991627,-60,-116.66633169991627,-60,-39.023160661969854,-60,-39.023160661969854,-109,38.62001037597656,-109,48.62001037597656,-109]},\n{"from":-9, "to":-10, "fromPort":"L", "toPort":"L", "points":[-187.3336683000837,-60,-197.3336683000837,-60,-197.3336683000837,-7,-116.10900245235608,-7,-34.88433660462846,-7,-24.884336604628455,-7]},\n{"from":-9, "to":-6, "fromPort":"B", "toPort":"L", "points":[-157,-40,-157,-30,18.98790196010045,-30,18.98790196010045,-56,156.6421356201172,-56,166.6421356201172,-56]},\n{"from":-7, "to":-3, "fromPort":"B", "toPort":"R", "points":[-15,-301.9635155357598,-15,-291.9635155357598,-15,-194.00000000000003,-22.992389678955078,-194.00000000000003,-30.984779357910156,-194.00000000000003,-40.984779357910156,-194.00000000000003]},\n{"from":-7, "to":-2, "fromPort":"L", "toPort":"left1", "points":[-49.838160948219276,-325,-59.838160948219276,-325,-59.838160948219276,-221.73570098876957,2.3804152229118465,-221.73570098876957,64.59899139404297,-221.73570098876957,74.59899139404297,-221.73570098876957]},\n{"from":-5, "to":-7, "fromPort":"R", "toPort":"R", "visible":true, "points":[-159.6421356201172,-257,-149.6421356201172,-257,29.838160948219276,-257,29.838160948219276,-291,29.838160948219276,-325,19.838160948219276,-325]},\n{"from":-2, "to":-8, "fromPort":"", "toPort":"L", "points":[149.40100860595703,-249.93570098876955,159.40100860595703,-249.93570098876955,222.53413881574357,-249.93570098876955,222.53413881574357,-259,285.6672690255301,-259,295.6672690255301,-259]},\n{"from":-8, "to":-2, "fromPort":"B", "toPort":"right1", "points":[346,-234.62859802246092,346,-224.62859802246092,346,-221.73570098876957,252.70050430297852,-221.73570098876957,159.40100860595703,-221.73570098876957,149.40100860595703,-221.73570098876957]},\n{"from":-2, "to":-8, "fromPort":"right3", "toPort":"T", "points":[149.40100860595703,-278.13570098876954,159.40100860595703,-278.13570098876954,223.53413881574357,-278.13570098876954,223.53413881574357,-293.37140197753905,346,-293.37140197753905,346,-283.37140197753905]},\n{"from":-2, "to":-7, "fromPort":"left3", "toPort":"R", "points":[74.59899139404297,-278.13570098876954,64.59899139404297,-278.13570098876954,47.21857617113112,-278.13570098876954,47.21857617113112,-325,29.838160948219276,-325,19.838160948219276,-325]},\n{"from":-2, "to":-6, "fromPort":"", "toPort":"T", "points":[112,-179.43570098876955,112,-169.43570098876955,112,-133.9035514831543,210,-133.9035514831543,210,-98.37140197753907,210,-88.37140197753907]},\n{"from":-2, "to":-4, "fromPort":"bottom3", "toPort":"R", "points":[126.96040344238281,-179.43570098876955,126.96040344238281,-169.43570098876955,126.96040344238281,-109,117.17019653320312,-109,107.37998962402344,-109,97.37998962402344,-109]}\n ]}', '', '2009-06-15 09:22:57', 52, '2015-06-09 09:22:57', 1),
(32, 'checking', '55c1c932e0141e7d7562ce8f4969c925', '{ "class": "go.GraphLinksModel",\n  "linkFromPortIdProperty": "fromPort",\n  "linkToPortIdProperty": "toPort",\n  "nodeDataArray": [ \n{"category":"page", "text":"Page", "key":-3, "loc":"-100 120", "info":"", "link":""},\n{"category":"multyport", "text":"Multi I/O", "figure":"Rectangle", "key":-2, "loc":"170 60", "info":"", "link":"Japanese position", "visible2":true},\n{"category":"Comment", "text":"Comment", "figure":"Cube2", "key":-10, "loc":"440 110", "info":"", "link":""}\n ],\n  "linkDataArray": [ \n{"from":-3, "to":-2, "fromPort":"R", "toPort":"left1", "points":[-73.98477935791016,120,-63.984779357910156,120,27.43210601806642,120,27.43210601806642,70.32428039550781,118.848991394043,70.32428039550781,128.848991394043,70.32428039550781]},\n{"from":-2, "to":-3, "fromPort":"left3", "toPort":"T", "points":[128.848991394043,57.1757196044922,118.848991394043,57.1757196044922,-100,57.1757196044922,-100,75.37000930786134,-100,93.56429901123047,-100,103.56429901123047]},\n{"from":-2, "fromPort":"bottom1", "toPort":"", "points":[151.28959655761722,80.18570098876954,151.28959655761722,90.18570098876954,151.28959655761722,138.09285049438478,179,138.09285049438478,179,186,179,196]},\n{"from":-2, "fromPort":"bottom2", "toPort":"", "points":[166.25000000000003,80.18570098876954,166.25000000000003,90.18570098876954,166.25000000000003,126.59285049438478,202,126.59285049438478,202,163,202,173]},\n{"from":-2, "fromPort":"bottom3", "toPort":"", "points":[181.21040344238287,80.18570098876954,181.21040344238287,90.18570098876954,181.21040344238287,116.09285049438478,221,116.09285049438478,221,142,221,152]},\n{"from":-2, "fromPort":"top1", "toPort":"", "points":[151.28959655761722,47.314299011230474,151.28959655761722,37.314299011230474,151.28959655761722,-16,220.6447982788086,-16,290,-16,300,-16]},\n{"from":-2, "fromPort":"", "toPort":"", "points":[166.25000000000003,47.314299011230474,166.25000000000003,37.314299011230474,166.25000000000003,3.657149505615237,270,3.657149505615237,270,-30,270,-40]},\n{"from":-2, "fromPort":"top3", "toPort":"", "points":[181.21040344238287,47.314299011230474,181.21040344238287,37.314299011230474,181.21040344238287,4.657149505615237,249,4.657149505615237,249,-28,249,-38]},\n{"from":-2, "fromPort":"right3", "toPort":"", "points":[203.65100860595706,57.1757196044922,213.65100860595706,57.1757196044922,231,57.1757196044922,231,-34.9121401977539,231,-127,231,-137]},\n{"from":-2, "fromPort":"right3", "toPort":"", "points":[203.65100860595703,57.17571960449219,213.65100860595703,57.17571960449219,297.8255043029785,57.17571960449219,297.8255043029785,114,382,114,392,114]}\n ]}', '<p><iframe src="//www.youtube.com/embed/_lyAEL4Wqao" width="746" height="246"></iframe>The&nbsp;<strong><a title="Battle of Labuan" href="https://en.wikipedia.org/wiki/Battle_of_Labuan">Battle of Labuan</a></strong>&nbsp;was fought between&nbsp;<a title="Allies of World War II" href="https://en.wikipedia.org/wiki/Allies_of_World_War_II">Allied</a>&nbsp;and&nbsp;<a title="Empire of Japan" href="https://en.wikipedia.org/wiki/Empire_of_Japan">Japanese</a>forces in June 1945 during World War II on the island of&nbsp;<a title="Labuan" href="https://en.wikipedia.org/wiki/Labuan">Labuan</a>, in preparation for the Australian&nbsp;<a title="Battle of North Borneo" href="https://en.wikipedia.org/wiki/Battle_of_North_Borneo">invasion of North Borneo</a>. Following weeks of air attacks and a short naval bombardment, the&nbsp;<a title="24th Brigade (Australia)" href="https://en.wikipedia.org/wiki/24th_Brigade_(Australia)">24th Brigade</a>&nbsp;landed on Labuan on 10 June and quickly captured the island''s harbour and main airfield. The greatly outnumbered Japanese garrison was concentrated in a fortified position, and offered little resistance to the landing. The initial attempts to penetrate the Japanese position were not successful, and the area was subjected to a heavy bombardment. A Japanese raiding force attacked Allied positions on 21 June, but was defeated. Later that day, Australian forces overwhelmed the Japanese position, and by mid-July, Australian patrols had killed or captured the remaining Japanese troops on the island. A total of 389 Japanese personnel were killed on Labuan and 11 were captured; Australian casualties included 34 killed. After securing the island, the Allies developed Labuan into a significant base and provided assistance to thousands of civilians who had been&nbsp;<a href="http://koivi.com/">rendered homeless by the pre-invasion</a> bombardment. Following the war, a major&nbsp;<a title="Commonwealth War Graves Commission" href="https://en.wikipedia.org/wiki/Commonwealth_War_Graves_Commission">Commonwealth War Graves Commission</a>&nbsp;cemetery was established on Labuan. (<a title="Battle of Labuan" href="https://en.wikipedia.org/wiki/Battle_of_Labuan"><strong>Full&nbsp;article...</strong></a>)</p>\n<p>&nbsp;</p>\n<p>The&nbsp;<strong><a title="Battle of Labuan" href="https://en.wikipedia.org/wiki/Battle_of_Labuan">Battle of Labuan</a></strong>&nbsp;was fought between&nbsp;<a title="Allies of World War II" href="https://en.wikipedia.org/wiki/Allies_of_World_War_II">Allied</a>&nbsp;and&nbsp;<a title="Empire of Japan" href="https://en.wikipedia.org/wiki/Empire_of_Japan">Japanese</a>forces in June 1945 during World War II on the island of&nbsp;<a title="Labuan" href="https://en.wikipedia.org/wiki/Labuan">Labuan</a>, in preparation for the Australian&nbsp;<a title="Battle of North Borneo" href="https://en.wikipedia.org/wiki/Battle_of_North_Borneo">invasion of North Borneo</a>. Following weeks of air attacks and a short naval bombardment, the&nbsp;<a title="24th Brigade (Australia)" href="https://en.wikipedia.org/wiki/24th_Brigade_(Australia)">24th Brigade</a>&nbsp;landed on Labuan on 10 June and quickly captured the island''s harbour and main airfield. The greatly outnumbered Japanese garrison was concentrated in a fortified position, and offered little resistance to the landing. The initial attempts to penetrate the Japanese position <a href="http://www.google.com">were not successful,</a>&nbsp;and the area was subjected to a heavy bombardment. A Japanese raiding force attacked Allied positions on 21 June, but was defeated. Later that day, Australian forces overwhelmed the Japanese position, and by mid-July, Australian patrols had killed or captured the remaining Japanese troops on the island. A total of 389 Japanese personnel were killed on Labuan and 11 were captured; Australian casualties included 34 killed. After securing the island, the Allies developed Labuan into a significant base and provided assistance to thousands of civilians who had been rendered homeless by the pre-invasion <a href="https://mail.google.com/mail/u/0/#inbox">bombardment</a>. Following the war, a major&nbsp;<a title="Commonwealth War Graves Commission" href="https://en.wikipedia.org/wiki/Commonwealth_War_Graves_Commission">Commonwealth War Graves Commission</a>&nbsp;cemetery was established on Labuan. (<a title="Battle of Labuan" href="https://en.wikipedia.org/wiki/Battle_of_Labuan"><strong>Full&nbsp;article...</strong></a>)</p>', '2011-06-15 06:09:09', 46, '2015-06-11 06:09:09', 1),
(33, 'te', 'cff59e0dc2207b191dd37a58cbfd8a5f', '{ "class": "go.GraphLinksModel",\n  "linkFromPortIdProperty": "fromPort",\n  "linkToPortIdProperty": "toPort",\n  "nodeDataArray": [ \n{"text":"test\\n", "key":-4, "loc":"274.115966796875 149.5622756958008", "info":"", "link":"", "size":"197 152"},\n{"category":"multyport", "text":"Multi I/O", "figure":"Rectangle", "key":-2, "loc":"612.0916213989258 10.062275695800778", "info":"", "link":"", "size":"319 93"},\n{"category":"directdata", "text":"Data", "figure":"Cylinder3", "key":-8, "loc":"400 -240", "info":"", "link":""},\n{"category":"Start", "text":"Start", "key":-1, "loc":"200 -410", "info":"", "link":""}\n ],\n  "linkDataArray": [ \n{"from":-2, "to":-4, "fromPort":"bottom3", "toPort":"R", "points":[675.8916213989257,56.56227569580078,675.8916213989257,66.56227569580078,675.8916213989257,149.5622756958008,529.2537940979004,149.5622756958008,382.615966796875,149.5622756958008,372.615966796875,149.5622756958008]},\n{"from":-8, "to":-2, "fromPort":"B", "toPort":"top2", "points":[400.0000000000001,-220.0000000000001,400.0000000000001,-210.0000000000001,400.0000000000001,-128.21886215209966,612.0916213989258,-128.21886215209966,612.0916213989258,-46.43772430419922,612.0916213989258,-36.43772430419922]},\n{"from":-1, "fromPort":"B", "toPort":"", "points":[200,-377.96538366273387,200,-367.96538366273387,200,-243,282,-243,364,-243,374,-243]},\n{"points":[232.0346163372661,-410,242.0346163372661,-410,438.01730816863306,-410,438.01730816863306,-274,634,-274,644,-274], "from":-1, "fromPort":"R"}\n ]}', '', '2019-06-15 08:26:07', 46, '2015-06-19 08:26:07', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_org_charts`
--

CREATE TABLE IF NOT EXISTS `tbl_org_charts` (
  `chart_id` int(11) NOT NULL AUTO_INCREMENT,
  `chart_name` varchar(100) NOT NULL,
  `chart_code` varchar(100) NOT NULL,
  `chart_json` text NOT NULL,
  `chart_wiki` text NOT NULL,
  `chart_create_dt` datetime NOT NULL,
  `chart_create_by` int(11) NOT NULL,
  `chart_update_dt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `chart_update_by` int(11) NOT NULL,
  PRIMARY KEY (`chart_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tbl_org_charts`
--

INSERT INTO `tbl_org_charts` (`chart_id`, `chart_name`, `chart_code`, `chart_json`, `chart_wiki`, `chart_create_dt`, `chart_create_by`, `chart_update_dt`, `chart_update_by`) VALUES
(3, 'admin''s organization', '56bc832c2b15e99ed1c2f2f89a465c19', '{ "class": "go.GraphLinksModel",\n  "linkFromPortIdProperty": "fromPort",\n  "linkToPortIdProperty": "toPort",\n  "nodeDataArray": [ \n{"category":"Start", "text":"Start", "key":-1, "loc":"-53 -314", "info":"", "link":""},\n{"category":"page", "text":"Page", "key":-3, "loc":"410 -210", "info":"Carl Nielsen (1865–1931) was a Danish musician, conductor and violinist, widely recognized as his country''s greatest composer. Brought up by poor, musically talented parents, he attended the Royal Conservatory in Copenhagen from 1884 through 1886, and premiered his Op 1, Suite for Strings at the age of 23. The following year, he began a 16-year stint as a second violinist in the Royal Danish ", "link":"", "size":"200 71", "visible":true},\n{"text":"new", "loc":"-53 8", "key":-4, "info":"   Carl Nielsen (1865–1931) was a Danish musician, conductor and violinist, widely recognized as his country''s greatest composer. Brought up by poor, musically talented parents, he attended the Royal Conservatory in Copenhagen from 1884 through 1886, and premiered his Op 1, Suite for Strings at the age of 23. The following year, he began a 16-year stint as a second violinist in the Royal Danish ", "link":"", "visible":true},\n{"text":"new", "loc":"-110 -30", "key":-5, "info":"   Carl Nielsen (1865–1931) was a Danish musician, conductor and violinist, widely recognized as his country''s greatest composer. Brought up by poor, musically talented parents, he attended the Royal Conservatory in Copenhagen from 1884 through 1886, and premiered his Op 1, Suite for Strings at the age of 23. The following year, he began a 16-year stint as a second violinist in the Royal Danish ", "link":" http://192.168.1.39/Eb/createflowchart", "visible":true, "visible2":true},\n{"text":"new", "loc":"20 40", "key":-6, "info":"   Carl Nielsen (1865–1931) was a Danish musician, conductor and violinist, widely recognized as his country''s greatest composer. Brought up by poor, musically talented parents, he attended the Royal Conservatory in Copenhagen from 1884 through 1886, and premiered his Op 1, Suite for Strings at the age of 23. The following year, he began a 16-year stint as a second violinist in the Royal Danish ", "link":"http://192.168.1.39/Eb/createflowchart", "visible":true, "visible2":true},\n{"text":"new", "loc":"-170 -70", "key":-7, "info":"   Carl Nielsen (1865–1931) was a Danish musician, conductor and violinist, widely recognized as his country''s greatest composer. Brought up by poor, musically talented parents, he attended the Royal Conservatory in Copenhagen from 1884 through 1886, and premiered his Op 1, Suite for Strings at the age of 23. The following year, he began a 16-year stint as a second violinist in the Royal Danish ", "link":"", "visible":true},\n{"text":"new", "loc":"100 90", "key":-8, "info":"   Carl Nielsen (1865–1931) was a Danish musician, conductor and violinist, widely recognized as his country''s greatest composer. Brought up by poor, musically talented parents, he attended the Royal Conservatory in Copenhagen from 1884 through 1886, and premiered his Op 1, Suite for Strings at the age of 23. The following year, he began a 16-year stint as a second violinist in the Royal Danish ", "link":"", "visible":true, "color":"rgb(174,11,11)", "stroke":"black"},\n{"category":"directdata", "text":"Data", "figure":"Database", "key":-9, "loc":"350 -60", "info":"", "link":""}\n ],\n  "linkDataArray": [ \n{"from":-3, "to":-4, "points":[315,-210,305,-210,144.87595748901367,-210,144.87595748901367,13,-15.248085021972656,13,-25.248085021972656,13]},\n{"from":-3, "to":-5, "points":[315,-210,305,-210,114.50095748901367,-210,114.50095748901367,-25,-75.99808502197266,-25,-85.99808502197266,-25]},\n{"from":-1, "to":-3, "fromPort":"B", "toPort":"T", "points":[-53,-281.96538366273387,-53,-271.96538366273387,-53,-261.23269183136694,415,-261.23269183136694,415,-250.5,415,-240.5]},\n{"from":-3, "to":-6, "points":[315,-210,305,-210,179.50095748901367,-210,179.50095748901367,45,54.001914978027344,45,44.001914978027344,45]},\n{"from":-3, "to":-7, "points":[315,-205,305,-205,86.37595748901367,-205,86.37595748901367,-65,-132.24808502197266,-65,-142.24808502197266,-65], "fromPort":"L", "toPort":"R"},\n{"from":-3, "to":-8, "points":[410,-169.5,410,-159.5,410,-45.46785049438476,105,-45.46785049438476,105,68.56429901123047,105,78.56429901123047]},\n{"points":[-20.965383662733913,-314,-10.965383662733913,-314,85.51730816863304,-314,85.51730816863304,-238,182,-238,192,-238], "fromPort":"R", "from":-1},\n{"from":-1, "fromPort":"L", "toPort":"", "points":[-85.03461633726609,-314,-95.03461633726609,-314,-95.03461633726609,-273.96538366273387,162,-273.96538366273387,162,-274,172,-274]},\n{"from":-1, "to":-8, "fromPort":"R", "toPort":"L", "points":[-20.965383662733913,-314,-10.965383662733913,-314,63,-314,63,95,72.24808502197266,95,82.24808502197266,95]},\n{"from":-9, "fromPort":"R", "toPort":"", "points":[371.3835678100586,-59.999999999999986,381.3835678100586,-59.999999999999986,477,-59.999999999999986,477,-111.5,477,-163,477,-173]},\n{"to":-3, "fromPort":"", "toPort":"R", "points":[780,-205,770,-205,647.5,-205,647.5,-205,525,-205,515,-205]},\n{"points":[288,-359,288,-349,288,-292.5,203,-292.5,203,-236,203,-226]}\n ]}', '', '2009-06-15 07:58:09', 52, '2015-06-09 07:58:09', 1),
(4, 'sdgsgsdfg', '591c57e1d9e3f247026553b3aab01e53', '{ "class": "go.GraphLinksModel",\n  "linkFromPortIdProperty": "fromPort",\n  "linkToPortIdProperty": "toPort",\n  "nodeDataArray": [ \n{"category":"page", "text":"Page", "key":-3, "loc":"-301 -220", "info":"", "link":""},\n{"category":"Start", "text":"Start", "key":-1, "loc":"30 -223", "info":"", "link":""},\n{"text":"Message", "figure":"MessageToUser", "key":-8, "loc":"-153 -15", "info":"", "link":""}\n ],\n  "linkDataArray": [  ]}', '<p>asdgsdgsdgsdgsdggg</p>', '2009-06-15 10:50:20', 52, '2015-06-09 10:50:20', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_profiles`
--

CREATE TABLE IF NOT EXISTS `tbl_profiles` (
  `user_id` int(11) NOT NULL,
  `lastname` varchar(50) NOT NULL DEFAULT '',
  `firstname` varchar(50) NOT NULL DEFAULT '',
  `billingaddress` text NOT NULL,
  `mailingaddress` text NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_profiles`
--

INSERT INTO `tbl_profiles` (`user_id`, `lastname`, `firstname`, `billingaddress`, `mailingaddress`) VALUES
(39, 'dhiman', 'manoj', '', ''),
(40, 'dhiman', 'manoj', '', ''),
(41, 'dhiman', 'moju', '', ''),
(42, 'ojt', 'man', '', ''),
(43, 'dhiman', 'manoj', '', ''),
(44, 'dhiman', 'manoj', '', ''),
(45, 'Innovative', 'Rudra', '', ''),
(46, 'Kumar', 'Manoj', 'this is my billing address', 'this is my mainilng address'),
(52, 'Dhiman', 'Admin', 'gggg', 'heyyyyyyyyyyy'),
(53, 'Dhiman', 'Editor', '', ''),
(54, 'Dhiman', 'Admin2', '', ''),
(55, 'dhiman', 'admin3', '', ''),
(56, 'Dhiman', 'User', '', ''),
(57, 'dhiman', 'User2', '', ''),
(58, 'Sharma', 'User', '', ''),
(60, 'null', 'kumar', '', ''),
(70, 'Kumaro', 'kumaro', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_profiles_fields`
--

CREATE TABLE IF NOT EXISTS `tbl_profiles_fields` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `varname` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `field_type` varchar(50) NOT NULL,
  `field_size` int(3) NOT NULL DEFAULT '0',
  `field_size_min` int(3) NOT NULL DEFAULT '0',
  `required` int(1) NOT NULL DEFAULT '0',
  `match` varchar(255) NOT NULL DEFAULT '',
  `range` varchar(255) NOT NULL DEFAULT '',
  `error_message` varchar(255) NOT NULL DEFAULT '',
  `other_validator` varchar(5000) NOT NULL DEFAULT '',
  `default` varchar(255) NOT NULL DEFAULT '',
  `widget` varchar(255) NOT NULL DEFAULT '',
  `widgetparams` varchar(5000) NOT NULL DEFAULT '',
  `position` int(3) NOT NULL DEFAULT '0',
  `visible` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `varname` (`varname`,`widget`,`visible`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_profiles_fields`
--

INSERT INTO `tbl_profiles_fields` (`id`, `varname`, `title`, `field_type`, `field_size`, `field_size_min`, `required`, `match`, `range`, `error_message`, `other_validator`, `default`, `widget`, `widgetparams`, `position`, `visible`) VALUES
(1, 'lastname', 'Last Name', 'VARCHAR', 50, 3, 1, '', '', 'Incorrect Last Name (length between 3 and 50 characters).', '', '', '', '', 1, 3),
(2, 'firstname', 'First Name', 'VARCHAR', 50, 3, 1, '', '', 'Incorrect First Name (length between 3 and 50 characters).', '', '', '', '', 0, 3),
(3, 'billingaddress', 'Billing Address', 'TEXT', 500, 0, 0, '', '', '', '', '', '', '', 0, 1),
(4, 'mailingaddress', 'Mailing Address', 'TEXT', 500, 0, 0, '', '', '', '', '', '', '', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE IF NOT EXISTS `tbl_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dept_id` int(11) NOT NULL,
  `guid` varchar(100) NOT NULL,
  `user_type` int(11) NOT NULL COMMENT 'superadmin=>100,ADMIN=>101,EDITOR=>102,USER=>103',
  `username` varchar(20) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `activkey` varchar(128) NOT NULL DEFAULT '',
  `createtime` int(10) NOT NULL DEFAULT '0',
  `lastvisit` int(10) NOT NULL DEFAULT '0',
  `superuser` int(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  `subscribed` int(1) NOT NULL DEFAULT '0' COMMENT '0=>notSelect,1=>free, 2=>subscribed',
  `sub_type` int(11) NOT NULL,
  `sub_date` varchar(50) NOT NULL,
  `payment` int(11) NOT NULL,
  `token` varchar(100) NOT NULL,
  `tokn_time` varchar(50) NOT NULL,
  `autorenew` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `status` (`status`),
  KEY `superuser` (`superuser`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=71 ;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `dept_id`, `guid`, `user_type`, `username`, `password`, `email`, `activkey`, `createtime`, `lastvisit`, `superuser`, `status`, `subscribed`, `sub_type`, `sub_date`, `payment`, `token`, `tokn_time`, `autorenew`) VALUES
(46, 0, 'ac0c4558-77fc-4896-9b30-f77afe4d81cd', 100, 'superadmin', '17c4520f6cfd1ab53d8745e84681eb49', 'info@rudrainnovatives.com', '419da50e40846911e0a85b9ef09a1216', 1432977326, 1435823190, 0, 1, 0, 0, '', 0, '', '', 0),
(52, 4, '56bdf244-fd4b-4938-b1c9-a7708893b33c', 101, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@gmail.com', '389ac9ba703542425d315971b6e5d20c', 0, 1435723031, 0, 1, 0, 0, '', 0, '', '', 0),
(53, 4, '77933ea9-a639-4efe-849c-f86677d92de6', 102, 'editor', '5aee9dbd2a188839105073571bee1b1f', 'manoj.ris1@gmail.com', 'bb3893079f502cf56224c880ad27a18c', 0, 0, 0, 1, 0, 0, '', 0, '', '', 0),
(54, 4, 'c4204b7c-72e5-4063-b561-aaf9751caac6', 101, 'admin2', 'c84258e9c39059a89ab77d846ddab909', 'admin2@gmail.com', '646f567d8cd7643406abe52802874d38', 0, 1434112919, 0, 1, 0, 0, '', 0, '', '', 0),
(55, 4, '7a4c5b1b-3661-4e60-9c05-0d281a9be307', 101, 'admin3', '32cacb2f994f6b42183a1300d9a3e8d6', 'admin3@gmail.com', '630c86ab3baaa0a71289a4c83e883bed', 0, 1435751430, 0, 1, 0, 0, '', 0, '', '', 0),
(56, 4, 'b3a52e4a-1b40-46b4-81d5-d05ae01522fa', 103, 'user1', '24c9e15e52afc47c225b757e7bee1f9d', 'user1@gmail.com', 'd959f5b115ec67fa4465b2c9a0663843', 0, 1433842624, 0, 1, 0, 0, '', 0, '', '', 0),
(57, 4, '0fb97ba5-694a-44fc-a04b-560acd37d300', 103, 'user2', '7e58d63b60197ceb55a1c487989a3720', 'user2@gmail.com', '934919195ac3e7e7d38bafdb984cc91e', 0, 1433844043, 0, 1, 0, 0, '', 0, '', '', 0),
(58, 4, '829330e8-0c7a-4eee-adc3-7152bc5c0673', 103, 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 'user@gmail.com', 'a00990b3a8fcc240582adb32b796275e', 1433846820, 1434111028, 0, 1, 0, 0, '', 0, '', '', 0),
(60, 0, '73f230aa-12ca-4797-98cc-740c2c5f7879', 103, 'kumar', '79cfac6387e0d582f83a29a04d0bcdc4', 'kumar@gmail.com', '8e9d1a73031fc09f12d4515ba9d8e65d', 1434347535, 1434449292, 0, 1, 0, 0, '', 0, '', '', 0),
(70, 6, 'ea433387-d69f-414e-aff7-166d3d7b0017', 103, 'kumaro', 'f58a3e2e13d97df0f9def5dd382e5c04', 'kumaro@gmail.com', '5b490ac14431dd7de9d7051a12a890e3', 1434363296, 1434363336, 0, 1, 0, 0, '', 0, '', '', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
