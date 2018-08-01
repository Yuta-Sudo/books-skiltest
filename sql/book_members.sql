-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2018 年 5 月 25 日 15:03
-- サーバのバージョン： 10.1.30-MariaDB
-- PHP Version: 5.6.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `books`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `book_members`
--

CREATE TABLE `book_members` (
  `member_id` int(11) NOT NULL,
  `nickname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `profile_pic` varchar(100) DEFAULT NULL,
  `member_del_flg` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `book_members`
--

INSERT INTO `book_members` (`member_id`, `nickname`, `email`, `password`, `profile_pic`, `member_del_flg`, `created`, `modified`) VALUES
(1, 'ぷーさん', ' yuta.sudo.gis@gmail.com', '12345', '20180429181244IMG_8830.JPG', 0, '2018-04-30 03:38:53', NULL),
(2, 'ぷーさん', ' yuta.sudo.gis@gmail.com', '12345', 'こんにちは', 0, '2018-04-30 07:29:25', NULL),
(3, 'ぷーさん', ' yuta.sudo.gis@gmail.com', '12345', 'こんにちは', 0, '2018-04-30 07:29:25', NULL),
(4, 'ぷーさん', ' yuta.sudo.gis@gmail.com', '12345', 'こんにちは', 0, '2018-04-30 07:29:25', NULL),
(5, 'ぷーさん', ' yuta.sudo.gis@gmail.com', '12345', 'こんにちは', 0, '2018-04-30 07:29:25', NULL),
(6, 'ぷーさん', ' yuta.sudo.gis@gmail.com', '12345', 'こんにちは', 0, '2018-04-30 07:29:25', NULL),
(7, 'ぷーさん', ' yuta.sudo.gis@gmail.com', '12345', 'こんにちは', 0, '2018-04-30 07:29:25', NULL),
(8, 'ぷーさん', ' yuta.sudo.gis@gmail.com', '12345', 'こんにちは', 0, '2018-04-30 07:29:25', NULL),
(9, 'ぷーさん', 'yuta.sudo.gis@gmail.com', '906f3a1d927af0ae8e8455fc9ec988c812dbcdc3', '20180510135139S__12845059.jpg', 0, '2018-05-10 21:00:15', NULL),
(10, '須藤悠太', 'st.yuta.gis@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964', '20180515072826iOS からアップロードされた画像.jpg', 0, '2018-05-15 14:28:30', NULL),
(11, 'オカメインコ', 'yuta.sudo.p0212@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964', '20180525124205iOS からアップロードされた画像 (2).jpg', 0, '2018-05-24 19:03:03', '2018-05-25 10:42:05'),
(12, 'dfsafdsafds', 'aaaaaaa@aaaaaaa', '8cb2237d0679ca88db6464eac60da96345513964', '20180524121127iOS からアップロードされた画像 (1).jpg', 0, '2018-05-24 19:11:28', NULL),
(13, 'テスト', 'hogehogehogehogehoge@hogehogehogehogehoge', '8cb2237d0679ca88db6464eac60da96345513964', '20180525142112iOS からアップロードされた画像 (2).jpg', 0, '2018-05-25 20:13:53', '2018-05-25 12:30:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book_members`
--
ALTER TABLE `book_members`
  ADD PRIMARY KEY (`member_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book_members`
--
ALTER TABLE `book_members`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
