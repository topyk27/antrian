-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 24, 2019 at 01:02 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `antrian`
--

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id` int(11) NOT NULL,
  `no_antrian` int(11) DEFAULT NULL,
  `perkara` varchar(255) NOT NULL,
  `penggugat` text NOT NULL,
  `tergugat` text,
  `jadwal_sidang` date NOT NULL,
  `ruang_sidang` int(11) NOT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`id`, `no_antrian`, `perkara`, `penggugat`, `tergugat`, `jadwal_sidang`, `ruang_sidang`, `status`) VALUES
(1, 1, '1', '1', '1', '0001-01-01', 1, NULL),
(2, 2, '2', '2', '2', '0002-02-02', 2, NULL),
(5, 3, '3', '3', '3', '0003-03-03', 1, NULL),
(6, 4, '4', '4', '4', '0004-04-04', 1, NULL),
(7, 5, '5', '5', '5', '0005-05-05', 1, NULL),
(8, 6, '6', '6', '6', '0006-06-06', 2, NULL),
(9, 7, '7', '7', '7', '0007-07-07', 1, NULL),
(10, 8, '8', '8', '8', '0008-08-08', 2, NULL),
(11, 9, '9', '9', '9', '0009-09-09', 1, NULL),
(12, 10, '10', '10', '10', '0010-10-10', 2, NULL),
(13, 11, '11', '11', '11', '0011-11-11', 1, NULL),
(14, 12, '12', '12', '12', '0012-12-12', 2, NULL),
(15, 1, '630/Pdt.G/2019/PA.Tgr', 'Ahmadi bin Kamarudin', 'Sumarni binti Samsudin', '2019-10-16', 1, NULL),
(16, 2, '725/Pdt.G/2019/PA.Tgr', 'Apri Puji Astuti binti Supadi', 'Gian Kareka bin Eko Sulistiono', '2019-10-16', 1, NULL),
(17, 3, '737/Pdt.G/2019/PA.Tgr', 'Hildayanti binti Abustan', 'Abdul Mutalib bin Lahiya', '2019-10-16', 1, NULL),
(18, 4, '738/Pdt.G/2019/PA.Tgr', 'Misna imah binti Sukono', 'Widayat bin Jianto', '2019-10-16', 1, NULL),
(19, 5, '1024/Pdt.G/2019/PA.Tgr', 'Tri Utami Binti Mardi Utomo', 'Deni Ismail Bin mulyodimejo', '2019-10-16', 1, NULL),
(20, 1, '630/Pdt.G/2019/PA.Tgr', 'Ahmadi bin Kamarudin', 'Sumarni binti Samsudin', '2019-10-22', 1, 'masuk');

-- --------------------------------------------------------

--
-- Table structure for table `ruang_sidang`
--

CREATE TABLE `ruang_sidang` (
  `id` int(11) NOT NULL,
  `ruang_sidang` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ruang_sidang`
--

INSERT INTO `ruang_sidang` (`id`, `ruang_sidang`) VALUES
(1, '1'),
(2, '2');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `ruang_sidang` int(11) NOT NULL,
  `role` enum('admin','petugas') NOT NULL,
  `voice` enum('Indonesian Female','Indonesian Male','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `ruang_sidang`, `role`, `voice`) VALUES
(1, 'ruang1', '827ccb0eea8a706c4c34a16891f84e7b', 1, 'petugas', 'Indonesian Female'),
(2, 'ruang2', '827ccb0eea8a706c4c34a16891f84e7b', 2, 'petugas', 'Indonesian Male'),
(3, 'admin', '827ccb0eea8a706c4c34a16891f84e7b', 2, 'admin', 'Indonesian Male');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ruang_sidang` (`ruang_sidang`);

--
-- Indexes for table `ruang_sidang`
--
ALTER TABLE `ruang_sidang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ruang_sidang_user` (`ruang_sidang`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `ruang_sidang`
--
ALTER TABLE `ruang_sidang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD CONSTRAINT `jadwal_ibfk_1` FOREIGN KEY (`ruang_sidang`) REFERENCES `ruang_sidang` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
