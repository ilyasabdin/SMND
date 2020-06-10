-- phpMyAdmin SQL Dump
-- version 5.0.0-alpha1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2019 at 01:26 AM
-- Server version: 10.3.20-MariaDB-0ubuntu0.19.04.1
-- PHP Version: 7.3.11-1+ubuntu19.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_smnd`
--

-- --------------------------------------------------------

--
-- Table structure for table `agenda`
--

CREATE TABLE `agenda` (
  `id` int(11) NOT NULL,
  `judul` varchar(128) NOT NULL,
  `pembahasan` varchar(256) NOT NULL,
  `tempat` varchar(128) NOT NULL,
  `tanggal` datetime NOT NULL,
  `catatan` text DEFAULT NULL,
  `create_at` datetime NOT NULL,
  `update_at` datetime NOT NULL,
  `id_pemimpin` int(11) NOT NULL,
  `materi` text DEFAULT NULL,
  `is_finish` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'yang ubah ketua',
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'status di ubah sama admin'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agenda`
--

INSERT INTO `agenda` (`id`, `judul`, `pembahasan`, `tempat`, `tanggal`, `catatan`, `create_at`, `update_at`, `id_pemimpin`, `materi`, `is_finish`, `status`) VALUES
(6, 'A', 'B', 'Gedung F Lantai 7 Ruang 7.4', '2019-12-31 20:54:00', 'dscsdcsdcsdcsdc', '2019-12-19 20:54:18', '2019-12-19 20:54:18', 1, 'materi-191219081218.pdf', 0, 1),
(7, 'B', 'A', 'Gedung F Lantai 7 Ruang 7.7', '2019-12-31 20:54:00', 'aasxaxasxasxasx', '2019-12-19 20:54:47', '2019-12-19 20:54:47', 1, '1', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `list_peserta`
--

CREATE TABLE `list_peserta` (
  `id_agenda` int(11) NOT NULL,
  `id_peserta` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `kehadiran` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `list_peserta`
--

INSERT INTO `list_peserta` (`id_agenda`, `id_peserta`, `id`, `kehadiran`) VALUES
(6, 2, 18, 0),
(6, 3, 19, 0),
(6, 4, 20, 0),
(7, 2, 21, 1),
(7, 3, 22, 1),
(7, 4, 23, 1);

-- --------------------------------------------------------

--
-- Table structure for table `list_peserta_sub`
--

CREATE TABLE `list_peserta_sub` (
  `id_subagenda` int(11) NOT NULL,
  `id_peserta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notula`
--

CREATE TABLE `notula` (
  `id` int(11) NOT NULL,
  `id_agenda` int(11) NOT NULL,
  `catatan` text DEFAULT NULL,
  `image` text NOT NULL,
  `create_at` datetime NOT NULL,
  `update_at` datetime NOT NULL,
  `materi` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `role`) VALUES
(1, 'Admin'),
(2, 'User'),
(3, 'Ketua'),
(4, 'Sekertaris');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `aksi` varchar(50) NOT NULL,
  `target` varchar(50) NOT NULL,
  `id_target` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_select` int(11) NOT NULL,
  `aksi_selanjutnya` text DEFAULT NULL,
  `create_at` datetime NOT NULL,
  `pesan` text DEFAULT NULL,
  `judul` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sub_agenda`
--

CREATE TABLE `sub_agenda` (
  `id` int(11) NOT NULL,
  `pembahasan` varchar(256) NOT NULL,
  `tempat` varchar(128) NOT NULL,
  `tanggal` datetime NOT NULL,
  `id_agenda` int(11) NOT NULL,
  `id_notula` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_agenda`
--

INSERT INTO `sub_agenda` (`id`, `pembahasan`, `tempat`, `tanggal`, `id_agenda`, `id_notula`) VALUES
(1, 'Pembahasan UAS 2', 'H 1.6', '2019-11-25 14:00:00', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `email` varchar(128) CHARACTER SET utf8 NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `email`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(1, 'Ilyas Abdi', 'ilyasabdi24@gmail.com', '$2y$10$iCtOvfh1FuK6wIFM9MebPOuQCUKILucgNB/wH/OqSYG8IKr5eDvki', 2, 1, 1575088771),
(2, 'Aisa Hannarista', 'aisahanna1997@gmail.com', '$2y$10$maK98fEipBz6Wba5QpitIeohU7BAzwsWExhgVdQsEuoC0VDdk9l.G', 3, 1, 1573723196),
(3, 'Jhon lennon', 'jonlenonn182@gmail.com', '$2y$10$zG2EDM3Mc6RXxQLhooibLuZXzeeeOvhjue4yrg6ItNllAGTjBGM1q', 1, 1, 1573747849),
(4, 'Sekertaris', 'emailsekertaris@gmail.com', '$2y$10$WSRNSrdh65I4jRYSQ9BPkembUQtdi6dcZAG68R1bGEiHXYDKZ4BMW', 4, 1, 1573899375);

-- --------------------------------------------------------

--
-- Table structure for table `user_acces_menu`
--

CREATE TABLE `user_acces_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_acces_menu`
--

INSERT INTO `user_acces_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(3, 1, 5),
(4, 2, 2),
(5, 3, 5),
(6, 3, 3),
(7, 4, 5),
(8, 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Admin_C'),
(2, 'User_C'),
(3, 'Ketua_C'),
(4, 'Sekertaris_C'),
(5, 'Manage');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `judul` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `judul`, `url`, `icon`, `is_active`) VALUES
(1, 2, 'Agenda', 'Agenda_C', 'fas fa-fw fa-calendar', 1),
(2, 2, 'Notula', 'Notula_C', 'fas fa-fw fa-table', 1),
(4, 2, 'Video', 'Audiovideo_C', 'fas fa-fw fa-table', 1),
(5, 1, 'Data User', 'Admin_C/listUser', 'fas fa-fw fa-user', 1),
(6, 1, 'Tambah Notula', 'Notula_C/tambahNotula', 'fas fa-fw fa-file', 1),
(7, 4, 'Buat Notula', 'Capture_C', 'fas fa-fw fa-file', 1),
(8, 4, 'Record Video', 'Dokumentasi_video_C', 'fas fa-fw fa-video', 1),
(9, 3, 'Buat Agenda', 'Agenda_C/add_agenda', 'fas fa-fw fa-calendar', 1),
(10, 5, 'Agenda', 'Agenda_C/manageAgenda', 'fas fa-fw fa-calendar', 1),
(11, 5, 'Notula', 'Notula_C/manageNotula', 'fas fa-fw fa-file', 1),
(12, 5, 'Video', 'Notula_C/manageVideo', 'fas fa-fw fa-table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `token` varchar(128) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_token`
--

INSERT INTO `user_token` (`id`, `email`, `token`, `date_created`) VALUES
(6, 'ilyasabdi24@gmail.com', '3fa6e7d2f6ebc53765d16438641bd89f', 1575093559),
(7, 'ilyasabdi24@gmail.com', 'e03ea06c6a74c96e32e1641413196bc3', 1575096797);

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE `video` (
  `id_video` int(11) NOT NULL,
  `id_agenda` int(11) NOT NULL,
  `pathvideo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `list_peserta`
--
ALTER TABLE `list_peserta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `1tomany_peserta_to_agenda` (`id_agenda`),
  ADD KEY `1to1_relation_peserta_to_user` (`id_peserta`);

--
-- Indexes for table `notula`
--
ALTER TABLE `notula`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk1to1notulaagenda` (`id_agenda`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_agenda`
--
ALTER TABLE `sub_agenda`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_acces_menu`
--
ALTER TABLE `user_acces_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `video`
--
ALTER TABLE `video`
  ADD UNIQUE KEY `id_video` (`id_video`),
  ADD KEY `agenda_fk_vidoe` (`id_agenda`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agenda`
--
ALTER TABLE `agenda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `list_peserta`
--
ALTER TABLE `list_peserta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `notula`
--
ALTER TABLE `notula`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `sub_agenda`
--
ALTER TABLE `sub_agenda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_acces_menu`
--
ALTER TABLE `user_acces_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `video`
--
ALTER TABLE `video`
  MODIFY `id_video` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `list_peserta`
--
ALTER TABLE `list_peserta`
  ADD CONSTRAINT `1to1_relation_peserta_to_user` FOREIGN KEY (`id_peserta`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `1tomany_peserta_to_agenda` FOREIGN KEY (`id_agenda`) REFERENCES `agenda` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notula`
--
ALTER TABLE `notula`
  ADD CONSTRAINT `fk1to1notulaagenda` FOREIGN KEY (`id_agenda`) REFERENCES `agenda` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `video`
--
ALTER TABLE `video`
  ADD CONSTRAINT `agenda_fk_vidoe` FOREIGN KEY (`id_agenda`) REFERENCES `agenda` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

