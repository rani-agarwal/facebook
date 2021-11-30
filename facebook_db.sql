-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2021 at 05:08 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `facebook_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` bigint(20) NOT NULL,
  `type` varchar(10) NOT NULL,
  `likes` text NOT NULL,
  `contentid` bigint(20) NOT NULL,
  `following` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `type`, `likes`, `contentid`, `following`) VALUES
(1, 'post', '[{\"userid\":\"6413942385052\",\"date\":\"2021-11-28 13:05:22\"}]', 824028123, ''),
(2, 'post', '[{\"userid\":\"6413942385052\",\"date\":\"2021-11-28 13:05:34\"}]', 3980308540048, ''),
(3, 'post', '[{\"userid\":\"6413942385052\",\"date\":\"2021-11-28 13:06:21\"}]', 337916, ''),
(4, 'user', '[{\"userid\":\"6413942385052\",\"date\":\"2021-11-28 13:07:07\"},{\"userid\":\"637042\",\"date\":\"2021-11-29 05:07:20\"}]', 6413942385052, '{\"1\":{\"userid\":\"637042\",\"date\":\"2021-11-28 13:07:49\"},\"2\":{\"userid\":\"53905\",\"date\":\"2021-11-29 05:41:10\"}}'),
(5, 'user', '[{\"userid\":\"6413942385052\",\"date\":\"2021-11-29 05:41:10\"},{\"userid\":\"637042\",\"date\":\"2021-11-29 05:41:45\"}]', 53905, ''),
(6, 'user', '[{\"userid\":\"6413942385052\",\"date\":\"2021-11-28 13:07:49\"}]', 637042, '[{\"userid\":\"6413942385052\",\"date\":\"2021-11-29 05:07:21\"},{\"userid\":\"53905\",\"date\":\"2021-11-29 05:41:46\"}]'),
(7, 'post', '[{\"userid\":\"637042\",\"date\":\"2021-11-29 05:06:42\"}]', 95797626436175471, ''),
(8, 'post', '[{\"userid\":\"6413942385052\",\"date\":\"2021-11-29 05:39:55\"}]', 84734567046858063, ''),
(9, 'post', '[{\"userid\":\"6413942385052\",\"date\":\"2021-11-29 05:40:06\"}]', 57127, '');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) NOT NULL,
  `postid` bigint(20) NOT NULL,
  `post` text NOT NULL,
  `image` varchar(500) NOT NULL,
  `has_image` tinyint(1) NOT NULL,
  `is_profile_image` tinyint(1) NOT NULL,
  `is_cover_image` tinyint(1) NOT NULL,
  `parent` bigint(20) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `userid` bigint(20) NOT NULL,
  `likes` int(11) NOT NULL,
  `comments` int(11) NOT NULL,
  `tags` varchar(2048) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `postid`, `post`, `image`, `has_image`, `is_profile_image`, `is_cover_image`, `parent`, `date`, `userid`, `likes`, `comments`, `tags`) VALUES
(1, 824028123, '', 'uploads/6413942385052/u9PnWglG1IDVkJE.jpg', 1, 0, 0, 0, '2021-11-28 17:35:18', 6413942385052, 1, 2, '[]'),
(2, 3980308540048, 'Car', '', 0, 0, 0, 824028123, '2021-11-28 17:35:31', 6413942385052, 1, 0, '[]'),
(3, 337916, '', 'uploads/6413942385052/c0sAtb8VByanMHg.jpg', 1, 0, 0, 824028123, '2021-11-28 17:36:15', 6413942385052, 1, 0, '[]'),
(4, 6512373, '', 'uploads/6413942385052/JOLaTsBRUjBJvqY.jpg', 1, 0, 0, 0, '2021-11-28 17:36:36', 6413942385052, 0, 0, '[]'),
(5, 7727146219190268626, '', 'uploads/6413942385052/UU2oUmsBx7r8wVg.jpg', 1, 0, 0, 0, '2021-11-28 17:38:24', 6413942385052, 0, 0, '[]'),
(6, 208078253, '', 'uploads/6413942385052/18KsMTr55ZyTRGg.jpg', 1, 0, 0, 0, '2021-11-29 09:18:11', 6413942385052, 0, 0, '[]'),
(7, 95797626436175471, '', 'uploads/637042/7Izo6pAF5bPijoZ.jpg', 1, 0, 0, 0, '2021-11-29 09:36:38', 637042, 1, 1, '[]'),
(8, 964196, 'Flower !', '', 0, 0, 0, 95797626436175471, '2021-11-29 09:36:54', 637042, 0, 0, '[]'),
(9, 690299633043146641, '', 'uploads/53905/WlkRtK7sdWQ8icK.jpg', 1, 0, 0, 0, '2021-11-29 09:39:39', 53905, 0, 0, '[]'),
(10, 84734567046858063, '', 'uploads/6413942385052/Q8SJaNW4kOy0fZ0.jpg', 1, 0, 0, 0, '2021-11-29 10:09:50', 6413942385052, 1, 1, '[]'),
(11, 57127, 'nice', '', 0, 0, 0, 84734567046858063, '2021-11-29 10:10:03', 6413942385052, 1, 0, '[]');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `userid` bigint(20) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `profile_image` varchar(500) NOT NULL,
  `cover_image` varchar(500) NOT NULL,
  `date` year(4) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(64) NOT NULL,
  `url_address` varchar(100) NOT NULL,
  `likes` int(11) NOT NULL,
  `tag_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `userid`, `first_name`, `last_name`, `gender`, `profile_image`, `cover_image`, `date`, `email`, `password`, `url_address`, `likes`, `tag_name`) VALUES
(1, 6413942385052, 'Rani', 'Agarwal', 'Female', '', '', 0000, 'raniag681@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'rani.agarwal', 2, 'raniagarwal'),
(2, 53905, 'Prashansha', 'Agarwal', 'Female', '', '', 0000, 'agarwal@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'prashansha.agarwal', 2, 'prashanshaagarwal'),
(3, 637042, 'Radhika', 'Mundhra', 'Female', '', '', 0000, 'radhika@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'radhika.mundhra', 1, 'radhikamundhra');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type` (`type`),
  ADD KEY `contentid` (`contentid`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `postid` (`postid`),
  ADD KEY `date` (`date`),
  ADD KEY `parent` (`parent`),
  ADD KEY `userid` (`userid`),
  ADD KEY `likes` (`likes`),
  ADD KEY `comments` (`comments`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`),
  ADD KEY `date` (`date`),
  ADD KEY `email` (`email`),
  ADD KEY `url_address` (`url_address`),
  ADD KEY `likes` (`likes`),
  ADD KEY `tag_name` (`tag_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
