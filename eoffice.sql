-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Agu 2020 pada 14.15
-- Versi server: 10.1.34-MariaDB
-- Versi PHP: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eoffice`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensi_masuk`
--

CREATE TABLE `absensi_masuk` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `absensi_masuk`
--

INSERT INTO `absensi_masuk` (`id`, `user_id`, `date`) VALUES
(13, 11, '2020-08-09 22:12:55'),
(14, 10, '2020-08-09 22:13:02'),
(16, 9, '2020-08-09 22:31:26'),
(19, 11, '2020-08-10 14:08:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `idadmin` int(5) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `namalengkap` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`idadmin`, `username`, `password`, `namalengkap`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Dadung Awuk'),
(4, 'basuki', 'b4e364bb5eab14eedd9ae3d54437d52f', 'Basuki Oke');

-- --------------------------------------------------------

--
-- Struktur dari tabel `file_private`
--

CREATE TABLE `file_private` (
  `id` int(11) NOT NULL,
  `folder_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `file_private`
--

INSERT INTO `file_private` (`id`, `folder_id`, `title`, `owner`, `date`) VALUES
(1, 1, 'PKK_Tabel_Progress.docx', 'Wendi Kardian', 1596299774),
(2, 4, '31_WendiKardian_BirrulWalidain.pdf', 'Wendi Kardian', 1596306189),
(3, 5, 'Materi_Konspirasi.pdf', 'Wendi Kardian', 1596306229);

-- --------------------------------------------------------

--
-- Struktur dari tabel `file_public`
--

CREATE TABLE `file_public` (
  `id` int(11) NOT NULL,
  `folder_id` int(11) NOT NULL,
  `file` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `file_public`
--

INSERT INTO `file_public` (`id`, `folder_id`, `file`, `owner`, `date`) VALUES
(1, 1, 'PKI.docx', 'Wendi Kardian', 1596230375),
(2, 2, 'stackdriver.docx', 'Wendi Kardian', 1596230516),
(3, 2, 'stackdriver1.docx', 'Wendi Kardian', 1596231151),
(4, 2, '32__Wendi_Kardian_-_Analisa_Poac.docx', 'Wendi Kardian', 1596231168),
(5, 2, '32__Wendi_Kardian_-_Tabel_Progress_akhir.docx', 'Wendi Kardian', 1596232921),
(6, 1, 'logo.PNG', 'Wendi Kardian', 1596299258),
(7, 1, 'PANDUAN_PENGGUNAAN.docx', 'Wendi Kardian', 1596299701);

-- --------------------------------------------------------

--
-- Struktur dari tabel `folder_private`
--

CREATE TABLE `folder_private` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `date` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `folder_private`
--

INSERT INTO `folder_private` (`id`, `title`, `owner`, `date`, `password`, `is_active`) VALUES
(1, 'wendi', 'Wendi Kardian', 1596296892, '$2y$10$xECvM2k6ktN4lni7C5rb6OdT7lRdB5VFenyP.wEA8olPZg/NwRpDu', 1),
(4, 'hello', 'Wendi Kardian', 1596305829, '$2y$10$QYAn6ATKPEh6FNZYh3f4OeEpDcKQB3F6eM3MZ4IEaPFAvIbE6YaAS', 1),
(5, 'test', 'Wendi Kardian', 1596305882, '$2y$10$iwwR5Qj5VoEhzNoPxf2XDeudI9R2BEEPOKwvR5hLYIksuFXxmgkCi', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `folder_public`
--

CREATE TABLE `folder_public` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `folder_public`
--

INSERT INTO `folder_public` (`id`, `title`, `owner`, `date`) VALUES
(1, 'Data Kantor', 'Wendi Kardian', 1596222513),
(2, 'Data penting harian', 'Wendi Kardian', 1596224038);

-- --------------------------------------------------------

--
-- Struktur dari tabel `group`
--

CREATE TABLE `group` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `group`
--

INSERT INTO `group` (`id`, `title`, `created_by`, `password`, `image`) VALUES
(2, 'sija', 1, '$2y$10$Kjcnl7oUOwTWl5Tsl2Vbw.yDHExEBWwoMPbKcTkr/Do66c8fpoEEC', 'default_group.jpg'),
(3, 'wendi', 1, '$2y$10$pnqehTcy0uAYxV60ibFznemc3iBNjLn.jbnpYMesKZGaJLQoOc17C', 'default_group.jpg'),
(4, 'taylor', 1, '$2y$10$4ojnAREEix2dSDzhvdJxoeaH1w3HMxRPttpAqDBmkgh8/4DuH4Cve', 'default_group.jpg'),
(5, 'hei', 1, '$2y$10$cFAEH74H06TgYLEsr.mykuRyRJKVJCY3Q/8xD2sebnxGB9P0S6596', 'default_group.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `group_member`
--

CREATE TABLE `group_member` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `group_member`
--

INSERT INTO `group_member` (`id`, `group_id`, `member_id`) VALUES
(6, 3, 1),
(7, 4, 1),
(8, 2, 7),
(12, 2, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(10) NOT NULL,
  `npm` varchar(10) DEFAULT NULL,
  `nama_mhs` varchar(40) DEFAULT NULL,
  `prodi` varchar(40) DEFAULT NULL,
  `tgl_lulus` date DEFAULT NULL,
  `no_ijazah` varchar(40) DEFAULT NULL,
  `ipk` decimal(3,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `npm`, `nama_mhs`, `prodi`, `tgl_lulus`, `no_ijazah`, `ipk`) VALUES
(1, '10010001', 'Dadung Awuk', 'Teknik Informatika', '2018-12-05', '2018/IJ/LI-COM/XII/090', '3.56'),
(2, '10010002', 'Angling Dharma', 'Teknik Informatika', '2018-12-14', '2018/IJ/LI-COM/XII/091', '3.45'),
(3, '10010003', 'Kamandanau', 'Teknik Informatika', '2018-12-11', '2018/IJ/LI-COM/XII/092', '3.00'),
(4, '10010004', 'Mak Lampir', 'Teknik Informatika', '2018-12-18', '2018/IJ/LI-COM/XII/093', '3.40'),
(5, '10010005', 'Grandong', 'Teknik Informatika', '2018-12-04', '2018/IJ/LI-COM/XII/094', '3.20'),
(7, '10010006', 'AGUS SUSANTO', 'Teknik Informatika', '2018-11-22', '2018/IJ/LI-COM/XII/095', '3.53'),
(8, '1001007', 'Basuki', 'Teknik Informatika', '2018-11-13', '2018/IJ/LI-COM/XII/096', '3.61'),
(9, '10010007', 'Ronggo Lawe', 'Teknik Informatika', '2018-11-22', '2018/IJ/LI-COM/XII/097', '3.32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mail`
--

CREATE TABLE `mail` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `recepient_id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `created_at` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `is_deleted_sender` int(11) NOT NULL,
  `is_deleted_recepient` int(11) NOT NULL,
  `is_read` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mail`
--

INSERT INTO `mail` (`id`, `sender_id`, `recepient_id`, `subject`, `message`, `created_at`, `status`, `file`, `is_deleted_sender`, `is_deleted_recepient`, `is_read`) VALUES
(1, 1, 1, 'Hello', 'Test', 1596377214, 1, NULL, 0, 0, 1),
(2, 1, 1, 'sadsad', 'sadasdasd', 1596377395, 2, NULL, 1, 0, 0),
(3, 1, 1, 'hello', 'test', 1596377963, 1, '31_WendiKardian_Documentasi.docx', 0, 0, 1),
(4, 1, 1, 'hihihi', 'hasdbkjasbdjkbasd', 1596377985, 2, NULL, 1, 0, 0),
(5, 1, 1, 'taylor swift', 'test 123', 1596434284, 1, '31_WendiKardian_BirrulWalidain.pdf', 0, 0, 1),
(6, 8, 1, 'Uji Coba', 'Test123', 1596439768, 1, 'Materi_Konspirasi.pdf', 0, 0, 1),
(8, 8, 1, 'sadasdsad', 'sadasdasd', 1596439901, 1, NULL, 0, 0, 1),
(9, 8, 7, 'Hay Taylor', 'Tugas ini sangat penting', 1596440439, 1, NULL, 0, 0, 1),
(10, 7, 8, 'ping', 'ping', 1596440826, 1, NULL, 0, 0, 1),
(11, 8, 7, 'HEIHEI', 'sadasdasd', 1596440872, 1, NULL, 0, 0, 1),
(12, 8, 7, '123', '123', 1596440975, 1, NULL, 0, 0, 1),
(13, 7, 8, '124124124', '123123123123', 1596441111, 1, NULL, 0, 0, 1),
(14, 8, 7, 'aksdnklasndkasndklnasd', 'dsafsdfadfsdfsdf', 1596441149, 1, NULL, 0, 0, 1),
(15, 7, 8, 'OK', 'OK', 1596441179, 1, NULL, 0, 0, 1),
(16, 7, 1, 'TEST', 'TEST', 1596442848, 1, NULL, 0, 0, 1),
(17, 7, 1, 'BOOM', 'BOOM', 1596442889, 1, NULL, 0, 1, 1),
(18, 1, 7, 'Fuckek', 'asdasdasd', 1596442948, 1, NULL, 1, 0, 1),
(25, 7, 1, 'DUH', 'DUH', 1596485303, 1, NULL, 0, 0, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `np` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(11) NOT NULL,
  `date_created` int(11) NOT NULL,
  `telp` varchar(255) DEFAULT NULL,
  `qrcode` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `np`, `name`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`, `telp`, `qrcode`) VALUES
(1, '0', 'Wendi Kardian', 'wendikardian@gmail.com', 'team-11.jpg', '$2y$10$UnRvLrSPK.1.zYUt2g8X.ehXmHc8wuHiOkE.QqUrnDG2p6euyy3c6', 1, 0, 1595478019, '+62896422512589', ''),
(9, '0', 'adele', 'adele@gmail.com', 'default.jpg', '$2y$10$sB06KGnXuMoZca4KP5av1ulMt5zc4GZSxXcs/E0.CCk2Kzn.Fvh0C', 3, 0, 1596960493, '+62', 'adele@gmail.com.png'),
(10, '0', 'taylor', 'taylor@gmail.com', 'default.jpg', '$2y$10$p05Fd3ffeB/Kl9kVQiP46.oZdRf0mbR7p/zjef.NMHCc9Aq5PBkY2', 3, 0, 1596980249, '+62', 'taylor@gmail.com.png'),
(11, '0', 'ujicoba', 'ujicoba@gmail.com', 'default.jpg', '$2y$10$gbPpO1JyXzM/dker6JqdXun/JVz3WK62H4feerrYO89ISp7/jCL3S', 3, 0, 1596980264, '+62', 'ujicoba@gmail.com.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 1, 2),
(4, 2, 2),
(5, 3, 2),
(6, 4, 2),
(7, 1, 3),
(8, 1, 4),
(9, 2, 4),
(10, 3, 4),
(11, 1, 5),
(12, 2, 5),
(13, 1, 6),
(14, 2, 6),
(15, 3, 6),
(16, 1, 7),
(17, 3, 7),
(18, 2, 8),
(19, 1, 9),
(20, 2, 9),
(21, 3, 9),
(23, 2, 10),
(24, 1, 11),
(25, 1, 10),
(26, 3, 11);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`, `icon`) VALUES
(1, 'Dashboard', 'fas fa-tachometer-alt'),
(2, 'Profile', 'fas fa-address-card'),
(3, 'Menu', 'fas fa-ellipsis-h'),
(4, 'File', 'fas fa-folder-open'),
(6, 'Mailbox', 'fas fa-envelope'),
(7, 'Assignment', 'fas fa-tasks'),
(8, 'Add Assignment', 'fas fa-thumbtack'),
(9, 'Event', 'fas fa-calendar-alt'),
(10, 'Management Event', 'fas fa-calendar-check'),
(11, 'Group', 'fa fa-users');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'admin'),
(2, 'bos'),
(3, 'employee'),
(4, 'guest');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `is_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `is_active`) VALUES
(1, 1, 'Dashboard', 'dashboard/index', 1),
(2, 1, 'Role', 'dashboard/role', 1),
(3, 2, 'My Profile', 'profile/profile', 1),
(4, 2, 'Edit Profile', 'profile/editprofile', 1),
(5, 2, 'Change Password', 'profile/changepassword', 1),
(6, 3, 'Menu Management', 'menu/menu', 1),
(7, 3, 'Sub Menu Management', 'menu/submenu', 1),
(8, 4, 'Public File', 'file/publicfile', 1),
(9, 4, 'Private File', 'file/privatefile', 1),
(12, 6, 'Inbox', 'mailbox/inbox', 1),
(13, 6, 'Send Mail', 'mailbox/sent', 1),
(14, 7, 'Assignment', 'assignment/assignment', 1),
(15, 7, 'Completed Assignment', 'assignment/completedassignment', 1),
(16, 8, 'Add Assignment', 'addassignment/addassignment', 1),
(17, 8, 'On Proccess Assignment', 'addassignment/onproccess', 1),
(18, 8, 'Completed Assignment', 'addassignment/completedassignment', 1),
(19, 9, 'Event', 'event/event', 1),
(20, 10, 'Event Management', 'eventmanagement/eventmanagement', 1),
(21, 6, 'Draft', 'mailbox/draft', 1),
(22, 1, 'Group Management', 'dashboard/group', 1),
(23, 11, 'Group', 'group/group', 1),
(24, 11, 'My Group', 'group/mygroup', 1),
(25, 1, 'Absent', 'dashboard/absent', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absensi_masuk`
--
ALTER TABLE `absensi_masuk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`idadmin`);

--
-- Indeks untuk tabel `file_private`
--
ALTER TABLE `file_private`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `file_public`
--
ALTER TABLE `file_public`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `folder_private`
--
ALTER TABLE `folder_private`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `folder_public`
--
ALTER TABLE `folder_public`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `group`
--
ALTER TABLE `group`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `group_member`
--
ALTER TABLE `group_member`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mail`
--
ALTER TABLE `mail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absensi_masuk`
--
ALTER TABLE `absensi_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `idadmin` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `file_private`
--
ALTER TABLE `file_private`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `file_public`
--
ALTER TABLE `file_public`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `folder_private`
--
ALTER TABLE `folder_private`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `folder_public`
--
ALTER TABLE `folder_public`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `group`
--
ALTER TABLE `group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `group_member`
--
ALTER TABLE `group_member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `mail`
--
ALTER TABLE `mail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
