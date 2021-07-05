-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2021 at 03:29 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `musicplayer`
--

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE `album` (
  `albumid` decimal(10,0) NOT NULL,
  `albumname` varchar(30) DEFAULT NULL,
  `artistid` decimal(10,0) NOT NULL,
  `coverart` varchar(400) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`albumid`, `albumname`, `artistid`, `coverart`) VALUES
('1', 'Bacon and Eggs', '2', 'assets/images/artwork/clearday.jpg'),
('2', 'Pizza head', '5', 'assets/images/artwork/energy.jpg'),
('3', 'Summer Hits', '3', 'assets/images/artwork/goinghigher.jpg'),
('4', 'The movie soundtrack', '2', 'assets/images/artwork/funkyelement.jpg'),
('5', 'Best of the Worst', '1', 'assets/images/artwork/popdance.jpg'),
('6', 'Hello World', '3', 'assets/images/artwork/ukulele.jpg'),
('7', 'Best beats', '4', 'assets/images/artwork/sweet.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `artist`
--

CREATE TABLE `artist` (
  `artistid` decimal(10,0) NOT NULL,
  `artistname` varchar(30) DEFAULT NULL,
  `country` varchar(30) DEFAULT NULL,
  `followers` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `artist`
--

INSERT INTO `artist` (`artistid`, `artistname`, `country`, `followers`) VALUES
('1', 'Mickey', 'USA', '350'),
('2', 'Goofy', 'UK', '400'),
('3', 'Jackson', 'UAE', '900'),
('4', 'Swift', 'USA', '800'),
('5', 'Atif', 'PAK', '500');

-- --------------------------------------------------------

--
-- Table structure for table `playlists`
--

CREATE TABLE `playlists` (
  playlistid int AUTO_INCREMENT,
  playlistname varchar(30) DEFAULT NULL,
  userid decimal(10,0) NOT NULL,
  primary key (playlistid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `playlistsongs`
--

CREATE TABLE `playlistsongs` (
  `p_songsid` decimal(10,0) NOT NULL AUTO_INCREMENT,
  `songid` decimal(10,0) NOT NULL,
  `playlistid` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `songs`
--

CREATE TABLE `songs` (
  `songsid` decimal(10,0) NOT NULL,
  `title` varchar(30) DEFAULT NULL,
  `artistid` decimal(10,0) NOT NULL,
  `albumid` decimal(10,0) NOT NULL,
  `duration` time DEFAULT NULL,
  `genre` varchar(20) DEFAULT NULL,
  `likes` decimal(10,0) DEFAULT NULL,
  `songpath` varchar(400) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `songs`
--

INSERT INTO `songs` (`songsid`, `title`, `artistid`, `albumid`, `duration`, `genre`, `likes`, `songpath`) VALUES
('1', 'Acoustic Breeze', '1', '5', '02:37:00', 'Pop', '10', 'assets/music/bensound-acousticbreeze.mp3'),
('2', 'A new beginning', '1', '5', '02:35:00', 'Pop', '4', 'assets/music/bensound-anewbeginning.mp3'),
('3', 'Better Days', '1', '5', '02:33:00', 'R&B', '10', 'assets/music/bensound-betterdays.mp3'),
('4', 'Buddy', '1', '5', '02:02:00', 'Funky', '13', 'assets/music/bensound-buddy.mp3'),
('5', 'Clear Day', '1', '5', '01:29:00', 'Country', '8', 'assets/music/bensound-clearday.mp3'),
('6', 'Going Higher', '2', '1', '04:04:00', 'Country', '29', 'assets/music/bensound-goinghigher.mp3'),
('7', 'Funny Song', '2', '4', '03:07:00', 'Funky', '11', 'assets/music/bensound-funnysong.mp3'),
('8', 'Funky Element', '2', '1', '03:08:00', 'Funky', '24', 'assets/music/bensound-funkyelement.mp3'),
('9', 'Extreme Action', '2', '1', '08:03:00', 'R&B', '26', 'assets/music/bensound-extremeaction.mp3'),
('10', 'Epic', '2', '4', '02:58:00', 'Pop', '16', 'assets/music/bensound-epic.mp3'),
('11', 'Energy', '2', '1', '02:59:00', 'Pop', '21', 'assets/music/bensound-energy.mp3'),
('12', 'Dubstep', '2', '1', '02:03:00', 'Hip Hop', '21', 'assets/music/bensound-dubstep.mp3'),
('13', 'Happiness', '3', '6', '04:21:00', 'Country', '3', 'assets/music/bensound-happiness.mp3'),
('14', 'Happy Rock', '3', '6', '01:45:00', 'Country', '8', 'assets/music/bensound-happyrock.mp3'),
('15', 'Frenchy', '3', '6', '01:44:00', 'Rock', '8', 'assets/music/bensound-jazzyfrenchy.mp3'),
('16', 'Little Idea', '3', '6', '02:49:00', 'R&B', '11', 'assets/music/bensound-littleidea.mp3'),
('17', 'Memories', '3', '6', '03:50:00', 'Country', '6', 'assets/music/bensound-memories.mp3'),
('18', 'Moose', '4', '7', '02:43:00', 'R&B', '2', 'assets/music/bensound-moose.mp3'),
('19', 'November', '4', '7', '03:32:00', 'Hip Hop', '5', 'assets/music/bensound-november.mp3'),
('20', 'Of Elias Dream', '4', '7', '04:58:00', 'Funky', '3', 'assets/music/bensound-ofeliasdream.mp3'),
('21', 'Pop Dance', '4', '7', '02:42:00', 'Pop', '10', 'assets/music/bensound-popdance.mp3'),
('22', 'Retro Soul', '4', '7', '03:36:00', 'Rock', '10', 'assets/music/bensound-retrosoul.mp3'),
('23', 'Sad Day', '5', '2', '02:28:00', 'Pop', '9', 'assets/music/bensound-sadday.mp3'),
('24', 'Sci-fi', '5', '2', '04:44:00', 'Hip Hop', '2', 'assets/music/bensound-scifi.mp3'),
('25', 'Slow Motion', '5', '2', '03:26:00', 'Pop', '3', 'assets/music/bensound-slowmotion.mp3'),
('26', 'Sunny', '5', '2', '02:20:00', 'Pop', '18', 'assets/music/bensound-sunny.mp3'),
('27', 'Sweet', '5', '2', '05:07:00', 'Country', '14', 'assets/music/bensound-sweet.mp3'),
('28', 'Tenderness ', '3', '3', '02:03:00', 'Hip Hop', '12', 'assets/music/bensound-tenderness.mp3'),
('29', 'The Lounge', '3', '3', '04:16:00', 'Rock', '6', 'assets/music/bensound-thelounge.mp3'),
('30', 'Ukulele', '3', '3', '02:26:00', 'Hip Hop', '18', 'assets/music/bensound-ukulele.mp3'),
('31', 'Tomorrow', '3', '3', '04:54:00', 'Pop', '9', 'assets/music/bensound-tomorrow.mp3');

-- --------------------------------------------------------

--
-- Table structure for table `userplaylist`
--

CREATE TABLE `userplaylist` (
  `userplaylistid` decimal(10,0) NOT NULL,
  `userid` int(11) NOT NULL,
  `playlistid` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `firstname` varchar(20) DEFAULT NULL,
  `lastname` varchar(20) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `accountpassword` varchar(15) DEFAULT NULL,
  `country` varchar(30) DEFAULT NULL,
  `profilepicture` varchar(400) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `username`, `firstname`, `lastname`, `email`, `accountpassword`, `country`, `profilepicture`) VALUES
(1, 'SimpLord', 'Hadeed', 'Shahid', 'Bscs19041@gmail.com', '32250170a0dca92', 'Pakistan', 'assets/images/profile-pics/head_emerald.png'),
(2, 'SimpLord4444', 'Simp', 'Asas', 'Simplord@gmail.com', 'e807f1fcf82d132', 'Fuas', 'assets/images/profile-pics/head_emerald.png'),
(3, 'sadasdas', 'Sas', 'Saasdasd', 'Asdasdasdas@gmail.com', 'a3dcb4d229de6fd', 'afaf', 'assets/images/profile-pics/head_emerald.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`albumid`),
  ADD KEY `artistid` (`artistid`);

--
-- Indexes for table `artist`
--
ALTER TABLE `artist`
  ADD PRIMARY KEY (`artistid`);

--
-- Indexes for table `playlists`
--
ALTER TABLE `playlists`
  ADD PRIMARY KEY (`playlistid`);

--
-- Indexes for table `playlistsongs`
--
ALTER TABLE `playlistsongs`
  ADD PRIMARY KEY (`p_songsid`),
  ADD KEY `songid` (`songid`),
  ADD KEY `playlistid` (`playlistid`);

--
-- Indexes for table `songs`
--
ALTER TABLE `songs`
  ADD PRIMARY KEY (`songsid`),
  ADD KEY `artistid` (`artistid`),
  ADD KEY `albumid` (`albumid`);

--
-- Indexes for table `userplaylist`
--
ALTER TABLE `userplaylist`
  ADD PRIMARY KEY (`userplaylistid`),
  ADD KEY `userid` (`userid`),
  ADD KEY `playlistid` (`playlistid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `album`
--
ALTER TABLE `album`
  ADD CONSTRAINT `album_ibfk_1` FOREIGN KEY (`artistid`) REFERENCES `artist` (`artistid`);

--
-- Constraints for table `playlistsongs`
--
ALTER TABLE `playlistsongs`
  ADD CONSTRAINT `playlistsongs_ibfk_1` FOREIGN KEY (`songid`) REFERENCES `songs` (`songsid`),
  ADD CONSTRAINT `playlistsongs_ibfk_2` FOREIGN KEY (`playlistid`) REFERENCES `playlists` (`playlistid`);

--
-- Constraints for table `songs`
--
ALTER TABLE `songs`
  ADD CONSTRAINT `songs_ibfk_1` FOREIGN KEY (`artistid`) REFERENCES `artist` (`artistid`),
  ADD CONSTRAINT `songs_ibfk_2` FOREIGN KEY (`albumid`) REFERENCES `album` (`albumid`);

--
-- Constraints for table `userplaylist`
--
ALTER TABLE `userplaylist`
  ADD CONSTRAINT `userplaylist_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`),
  ADD CONSTRAINT `userplaylist_ibfk_2` FOREIGN KEY (`playlistid`) REFERENCES `playlists` (`playlistid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
