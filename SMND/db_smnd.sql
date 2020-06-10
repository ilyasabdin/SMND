-- phpMyAdmin SQL Dump
-- version 5.0.0-alpha1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2019 at 09:54 PM
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
(7, 'TEST', 'tes', 'Gedung F Lantai 7 Ruang 7.4', '2019-12-11 16:37:00', 'sdcscsdcsdcsdcsdcsd', '2019-12-14 16:37:25', '2019-12-14 16:37:25', 2, 'materi-191214041225.pdf', 0, 0),
(8, 'sdcsdcsdcsdc', 'dscsdcsc', 'Gedung F Lantai 7 Ruang 7.4', '2019-12-10 20:40:00', 'cdscscsdcsdcscsdcsdcsdcsdc', '2019-12-14 20:40:35', '2019-12-14 20:40:35', 2, 'materi-191214081235.pdf', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `list_peserta`
--

CREATE TABLE `list_peserta` (
  `id_agenda` int(11) NOT NULL,
  `id_peserta` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `list_peserta`
--

INSERT INTO `list_peserta` (`id_agenda`, `id_peserta`, `id`) VALUES
(5, 1, 7),
(5, 3, 8),
(5, 4, 9),
(6, 1, 10),
(6, 3, 11),
(6, 4, 12),
(7, 1, 13),
(7, 3, 14),
(7, 4, 15),
(8, 2, 16),
(8, 1, 17),
(8, 3, 18),
(8, 4, 19);

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
  `image` varchar(128) NOT NULL,
  `create_at` datetime NOT NULL,
  `update_at` datetime NOT NULL,
  `materi` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notula`
--

INSERT INTO `notula` (`id`, `id_agenda`, `catatan`, `image`, `create_at`, `update_at`, `materi`) VALUES
(125, 7, '{\"ops\":[{\"attributes\":{\"bold\":true},\"insert\":\"Catatan : \"},{\"attributes\":{\"header\":1},\"insert\":\"\\n\"},{\"attributes\":{\"list\":\"ordered\"},\"insert\":\"\\n\"},{\"insert\":\"aaaaaaa\"},{\"attributes\":{\"list\":\"ordered\"},\"insert\":\"\\n\\n\\n\\n\"},{\"attributes\":{\"bold\":true},\"insert\":\"Dokumentasi : \"},{\"attributes\":{\"header\":1},\"insert\":\"\\n\"},{\"attributes\":{\"list\":\"ordered\"},\"insert\":\"\\n\"},{\"insert\":\"aaaaaaaaa\"},{\"attributes\":{\"list\":\"ordered\"},\"insert\":\"\\n\\n\\n\\n\"}]}', 'image-notula-7-191214061203.jpeg', '2019-12-14 18:22:03', '2019-12-14 18:22:03', 'materi-notula-7-191214061203.pdf');

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
  `aksi_selanjutnya` text DEFAULT NULL,
  `create_at` datetime NOT NULL,
  `pesan` text DEFAULT NULL,
  `judul` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `aksi`, `target`, `id_target`, `id_user`, `aksi_selanjutnya`, `create_at`, `pesan`, `judul`) VALUES
(7, 'create', 'notula', 2, 4, 'https://smnd.app/Report_C/Detail_notula/123', '2019-12-14 17:52:19', 'Judul agenda : TEST', 'Sekertaris membuat notula rapat TEST');

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
  `Judul Video` varchar(200) NOT NULL,
  `pathvideo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `video`
--

INSERT INTO `video` (`id_video`, `Judul Video`, `pathvideo`) VALUES
(1, '', '.../uploads/video/audiovideo-1560666567.webm.'),
(2, '', 'audiovideo-1560667190.webm'),
(3, '', 'audiovideo-1560667533.webm'),
(4, '', 'audiovideo-1560667560.webm'),
(5, '', 'audiovideo-1560667788.webm'),
(6, '', 'audiovideo-1560667852.webm'),
(7, '', 'audiovideo-1560667936.webm'),
(8, '', 'audiovideo-1560667992.webm'),
(9, '', 'audiovideo-1561041061.webm'),
(11, '', 'audiovideo-1561041661.webm'),
(12, '', 'audiovideo-1561086879.webm'),
(13, '', 'audiovideo-1563984251.webm'),
(14, '', 'audiovideo-1571801213.webm');

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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notula`
--
ALTER TABLE `notula`
  ADD PRIMARY KEY (`id`);

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
  ADD UNIQUE KEY `id_video` (`id_video`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agenda`
--
ALTER TABLE `agenda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `list_peserta`
--
ALTER TABLE `list_peserta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `notula`
--
ALTER TABLE `notula`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
  MODIFY `id_video` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

