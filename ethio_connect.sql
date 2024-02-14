-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 13, 2024 at 04:48 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ethio_connect`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category`) VALUES
(1, 'School_and_Education'),
(2, 'Sports'),
(3, 'Food'),
(4, 'Photography'),
(5, 'Buy_and_Sell'),
(6, 'Science_and_Tech'),
(7, 'Health_and_Fitness'),
(8, 'Funny'),
(9, 'Arts_and_Culture'),
(10, 'Games'),
(12, 'Travel_and_Places'),
(13, 'Movies_and_TV');

-- --------------------------------------------------------

--
-- Table structure for table `follower`
--

CREATE TABLE `follower` (
  `following_id` int(11) NOT NULL,
  `follower_id` int(11) NOT NULL,
  `follow_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `follower`
--

INSERT INTO `follower` (`following_id`, `follower_id`, `follow_id`) VALUES
(177, 8, 5),
(192, 5, 6),
(195, 5, 9),
(197, 6, 5),
(200, 6, 9),
(228, 4, 5),
(229, 4, 6),
(239, 8, 4),
(241, 8, 6),
(242, 8, 9),
(254, 7, 4),
(255, 7, 5),
(256, 7, 6),
(257, 7, 8),
(258, 7, 9),
(262, 9, 4),
(263, 11, 4),
(264, 10, 11);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `group_id` int(11) NOT NULL,
  `group_name` varchar(256) NOT NULL,
  `category` varchar(256) NOT NULL,
  `profile_pic` varchar(256) NOT NULL,
  `cover_pic` varchar(256) NOT NULL,
  `date` date NOT NULL,
  `owner_id` int(11) NOT NULL,
  `web_address` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`group_id`, `group_name`, `category`, `profile_pic`, `cover_pic`, `date`, `owner_id`, `web_address`) VALUES
(2, 'football', 'Sports', 'Sports.png', 'Sports.png', '2024-02-13', 11, 'football6567173_11');

-- --------------------------------------------------------

--
-- Table structure for table `group_members`
--

CREATE TABLE `group_members` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `group_posts`
--

CREATE TABLE `group_posts` (
  `post_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `text` text NOT NULL,
  `image1` varchar(256) NOT NULL,
  `image2` varchar(256) NOT NULL,
  `image3` varchar(256) NOT NULL,
  `post_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `messages_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `file1` varchar(255) NOT NULL,
  `file2` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `states` varchar(10) NOT NULL DEFAULT 'unread',
  `file3` varchar(255) NOT NULL,
  `edit` text NOT NULL DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`messages_id`, `sender_id`, `receiver_id`, `message`, `file1`, `file2`, `date`, `states`, `file3`, `edit`) VALUES
(402, 6, 4, 'dagi', '', '', '2021-11-02', 'read', '', 'false'),
(403, 6, 4, 'tefahaa', '', '', '2021-11-02', 'read', '', 'true'),
(405, 9, 8, 'lol', '', '', '2021-11-03', 'read', '', 'true'),
(406, 8, 6, 'asd', '', '', '2021-11-03', 'unread', '', 'false'),
(407, 8, 6, 'asdsds', '', '', '2021-11-03', 'unread', '', 'false'),
(408, 10, 11, 'hey sexyyyy', '', '', '2024-02-13', 'read', '', 'false'),
(409, 11, 10, 'hey handsome', '', '', '2024-02-13', 'unread', '', 'false');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` int(11) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `notification` text NOT NULL,
  `recipient_id` int(11) NOT NULL,
  `notifier` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notification_id`, `date`, `notification`, `recipient_id`, `notifier`) VALUES
(1, '2024-02-13', ' Start following you.', 4, 11),
(2, '2024-02-13', ' Shared your post.', 4, 11),
(3, '2024-02-13', ' Liked your post.', 11, 11),
(4, '2024-02-13', ' Start following you.', 11, 10),
(5, '2024-02-13', ' Liked your post.', 11, 10),
(6, '2024-02-13', ' Liked your post.', 11, 10),
(7, '2024-02-13', ' Comment on your post', 11, 10),
(8, '2024-02-13', ' Send you a message.', 11, 10),
(9, '2024-02-13', ' Send you a message.', 11, 11);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_date` date NOT NULL,
  `text` mediumtext NOT NULL,
  `image1` varchar(255) NOT NULL,
  `image2` varchar(255) NOT NULL,
  `image3` varchar(255) NOT NULL,
  `shares` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `user_id`, `post_date`, `text`, `image1`, `image2`, `image3`, `shares`) VALUES
(26, 4, '2021-10-25', ' we all have that one friend lol 😂\n#r6s #Gaming #funny\n', '4_dagmawihm_114476_60429238_338246330190716_2033105906806181182_n.jpg', '', '', 1),
(36, 6, '2021-10-28', 'What a day wiz my boys\r\n#vibe #friendship ', '6_unset_191258_photo_2021-10-28_18-11-54.jpg', '6_unset_191258_photo_2021-10-28_18-11-56.jpg', '6_unset_191258_photo_2021-10-28_18-11-58.jpg', 2),
(37, 7, '2021-10-28', 'Im sexy and i know it 😎😎😎\r\n#sexy #Brace #photography', '7_kal_brace_791599_photo_2021-10-28_18-11-49 (2).jpg', '7_kal_brace_791599_photo_2021-10-28_18-11-49.jpg', '7_kal_brace_791599_photo_2021-10-28_18-11-50.jpg', 2),
(38, 8, '2021-10-28', 'working on my school project management\r\n#project #work ', '8_amir_kalid_533369_photo_2021-10-28_18-11-43.jpg', '', '', 15),
(39, 9, '2021-10-28', 'Each person must live their life as a model for others.\r\n#modeling \r\n', '9_zola_843420_photo_2021-10-28_18-11-45 (2).jpg', '9_zola_843420_photo_2021-10-28_18-11-47 (2).jpg', '9_zola_843420_photo_2021-10-28_18-11-51 (2).jpg', 5),
(42, 6, '2021-10-28', 'Post Shared from<a href=\"user-profile.php?username=kal_brace\"> @kal_brace</a><br>Im sexy and i know it 😎😎😎\r\n#sexy #Brace #photography', '7_kal_brace_791599_photo_2021-10-28_18-11-49 (2).jpg', '7_kal_brace_791599_photo_2021-10-28_18-11-49.jpg', '7_kal_brace_791599_photo_2021-10-28_18-11-50.jpg', 0),
(66, 4, '2021-10-28', 'Post Shared from<a href=\"user-profile.php?username=zola\"> @zola</a><br>Each person must live their life as a model for others.\r\n#modeling \r\n', '9_zola_843420_photo_2021-10-28_18-11-45 (2).jpg', '9_zola_843420_photo_2021-10-28_18-11-47 (2).jpg', '9_zola_843420_photo_2021-10-28_18-11-51 (2).jpg', 4),
(68, 11, '2024-02-13', 'am hot', '11_Arsema24-02-13604430_761550_photo_2022-12-22_18-58-26.jpg', '', '', 0),
(69, 11, '2021-10-25', 'Post Shared from<a href=\"user-profile.php?username=dagmawihm\"> @dagmawihm</a><br> we all have that one friend lol 😂\n#r6s #Gaming #funny\n', '4_dagmawihm_114476_60429238_338246330190716_2033105906806181182_n.jpg', '', '', 0),
(70, 11, '2024-02-13', '', '11_Arsema24-02-13604430_736316_photo_2022-12-22_18-58-26.jpg', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `post_comment`
--

CREATE TABLE `post_comment` (
  `comment_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `date_comment` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post_comment`
--

INSERT INTO `post_comment` (`comment_id`, `post_id`, `user_id`, `comment`, `date_comment`) VALUES
(48, 39, 4, '😂😂😂😂😂😂😂😂😂😂', '2021-10-29'),
(49, 37, 6, 'nice pic', '2021-10-31');

-- --------------------------------------------------------

--
-- Table structure for table `post_like`
--

CREATE TABLE `post_like` (
  `like_id` int(1) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post_like`
--

INSERT INTO `post_like` (`like_id`, `post_id`, `user_id`) VALUES
(82, 37, 7),
(83, 36, 7),
(85, 39, 4),
(86, 39, 7),
(88, 66, 4),
(89, 26, 4),
(90, 68, 11),
(91, 69, 10),
(92, 68, 10);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `f_name` varchar(20) NOT NULL,
  `l_name` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL DEFAULT 'unset',
  `profile_pic` varchar(255) NOT NULL,
  `cover_pic` varchar(255) NOT NULL DEFAULT 'default_cover.png',
  `dob` date NOT NULL,
  `gender` varchar(1) NOT NULL,
  `bio` varchar(70) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `verification_code` int(7) NOT NULL DEFAULT 1234567,
  `phone_no` varchar(15) NOT NULL DEFAULT 'unset',
  `website` varchar(255) NOT NULL DEFAULT 'http://unset',
  `facebook` varchar(255) NOT NULL DEFAULT 'http://unset',
  `instagram` varchar(255) NOT NULL DEFAULT 'http://unset',
  `twitter` varchar(255) NOT NULL DEFAULT 'http://unset',
  `mail` varchar(50) NOT NULL DEFAULT 'unset@unset',
  `online` varchar(30) NOT NULL DEFAULT 'false',
  `type` varchar(30) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `f_name`, `l_name`, `username`, `profile_pic`, `cover_pic`, `dob`, `gender`, `bio`, `email`, `password`, `verification_code`, `phone_no`, `website`, `facebook`, `instagram`, `twitter`, `mail`, `online`, `type`) VALUES
(4, 'Dagmawi', 'Hailemariam', 'dagmawihm', 'id.JPG', '20776.jpg', '1998-08-19', 'm', 'Web Developer', 'dagmawihm@gmail.com', '$2y$10$yBQaZ6lVrUD99a1whFcNV.9zLFSf2e9u6Yxb2w05RX8K8bL/UVjCS', 135692, '+251985397585', 'http://dagmawihm.atwebpages.com/', 'https://www.facebook.com/dagmawihm/', 'https://www.instagram.com/dagmawihm/', 'https://twitter.com/dagmawihm', 'dagmawihm@gmail.com', 'false', 'user'),
(5, 'Melat', 'Hagos', 'melat', 'image.jpg', 'tom-clancy-s-rainbow-six-siege-wallpaper-2560x1080-3184_14-2.jpg', '2003-10-20', 'm', 'Programer', 'melat@gmail.com', '$2y$10$jdPjC08zSAVUeeFBPpwADOdGj/4JK.uI6KHTzOSQEmKsCooVJ8Myu', 1234567, 'unset', 'http://unset', 'http://unset', 'http://unset', 'http://unset', 'unset@unset', 'false', 'user'),
(6, 'Yosi', 'Airpod', 'Yosi_airpod', 'photo_2021-10-28_18-11-52.jpg', '7e945160-f699-11ea-beef-f468e8c9049c.cf.jpg', '2003-10-28', 'm', 'Airpod dealer', 'yosi@gmail.com', '$2y$10$5OdDxdb4gscnNMEnD2KTjOZdP6PWInvUZFYP.1nE0pIppaEpUCw9m', 1234567, 'unset', 'http://unset', 'http://unset', 'http://unset', 'http://unset', 'unset@unset', 'false', 'user'),
(7, 'Kal', 'brace', 'kal_brace', 'photo_2021-10-28_18-11-49 (2).jpg', 'download.jpg', '2003-10-28', 'm', 'A smile is always in style', 'kal@gmail.com', '$2y$10$rvL8i8EnmI0JP5CqQuOwL.aR2WrvZGXVtyPeOCmDus78qK4dQLKPa', 1234567, 'unset', 'http://unset', 'http://unset', 'http://unset', 'http://unset', 'unset@unset', 'false', 'user'),
(8, 'amir', 'kalid', 'amir_kalid', 'photo_2021-10-28_18-11-53.jpg', 'download.png', '2003-10-28', 'm', 'project management', 'amir@gmail.com', '$2y$10$Kmnjl19W87NYObch9hAptuVUuFA270PpwEJfUhFdmBfaH2Z4j2AjK', 1234567, '09', 'http://fb.com', 'http://unset', 'http://unset', 'http://unset', 'unset@unset', 'false', 'user'),
(9, 'zola', 'model', 'zola', 'photo_2021-10-28_18-11-46.jpg', 'Modeling-Agency-Facebook-Cover-Design.jpg', '2003-10-28', 'm', 'model', 'zola@gmail.com', '$2y$10$QXHXQKs79Pl1agXfbroUWuIk3h6tdk/yHZdzlt8jtdDQrzUwT5F7G', 1234567, 'unset', 'http://unset', 'http://unset', 'http://unset', 'http://unset', 'unset@unset', 'false', 'user'),
(10, 'Dagmawi', 'Asres', 'Dagmawi24-02-1334878', 'default_m_pp.png', 'default_cover.png', '2005-05-05', 'm', '', 'nevacomputers@gmail.com', '$2y$10$.e8A/JUB2hHiWaL.EIJzOea9Itm4VbJ7TOnoCltVFfTufNYeMf5..', 1234567, 'unset', 'http://unset', 'http://unset', 'http://unset', 'http://unset', 'unset@unset', 'true', 'user'),
(11, 'Arsema', 'Atlaw', 'Arsema24-02-13604430', 'photo_2022-12-22_18-58-26.jpg', 'default_cover.png', '2002-03-10', 'f', '', 'eliasarsema466@gmail.com', '$2y$10$dZEMZnG7gJB/No7uMpFX4uBNJSkXHKV1VuyLg.CP9e9TkA7EqMPre', 157266, 'unset', 'http://unset', 'http://unset', 'http://unset', 'http://unset', 'unset@unset', 'false', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `follower`
--
ALTER TABLE `follower`
  ADD PRIMARY KEY (`following_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `group_members`
--
ALTER TABLE `group_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_posts`
--
ALTER TABLE `group_posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`messages_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `post_comment`
--
ALTER TABLE `post_comment`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `post_like`
--
ALTER TABLE `post_like`
  ADD PRIMARY KEY (`like_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `follower`
--
ALTER TABLE `follower`
  MODIFY `following_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=265;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `group_members`
--
ALTER TABLE `group_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `group_posts`
--
ALTER TABLE `group_posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `messages_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=410;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `post_comment`
--
ALTER TABLE `post_comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `post_like`
--
ALTER TABLE `post_like`
  MODIFY `like_id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
