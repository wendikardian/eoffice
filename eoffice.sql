-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Sep 2020 pada 23.28
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
(19, 11, '2020-08-10 14:08:50'),
(21, 11, '2020-08-12 09:52:13'),
(22, 9, '2020-08-12 09:52:44'),
(23, 11, '2020-08-20 14:59:41'),
(24, 10, '2020-08-20 15:00:05'),
(25, 11, '2020-08-21 18:21:28'),
(26, 10, '2020-08-21 20:38:02'),
(27, 11, '2020-08-22 14:28:02'),
(28, 10, '2020-08-22 18:50:58'),
(32, 9, '2020-08-26 03:01:49'),
(33, 11, '2020-08-26 16:35:42'),
(35, 10, '2020-08-26 16:36:59'),
(36, 11, '2020-08-28 02:00:46'),
(37, 11, '2020-08-29 13:13:55'),
(38, 10, '2020-08-29 13:14:07'),
(39, 9, '2020-08-29 13:14:27'),
(40, 11, '2020-09-01 03:22:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `announcement`
--

CREATE TABLE `announcement` (
  `id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `caption` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `announcement`
--

INSERT INTO `announcement` (`id`, `created_by`, `date`, `caption`, `image`) VALUES
(3, 1, 1598262987, 'You Need To Calm Down', '11111.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `assignment`
--

CREATE TABLE `assignment` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `recepient_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `info` varchar(255) NOT NULL,
  `created_at` int(11) NOT NULL,
  `deadline_at` int(11) NOT NULL,
  `submited_at` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `is_deleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `assignment`
--

INSERT INTO `assignment` (`id`, `sender_id`, `recepient_id`, `title`, `info`, `created_at`, `deadline_at`, `submited_at`, `status`, `file`, `is_deleted`) VALUES
(1, 16, 10, 'Karya Project', 'sadsadasd', 1598961987, 1599142140, 1599055469, 2, 'PKI.docx', 0),
(2, 16, 9, 'Tugas Laporan', 'Uji Coba', 1598964475, 1599278940, 1599279999, 2, NULL, 0),
(3, 16, 11, 'HELLO WORLD', 'TEST', 1598966950, 1599886740, NULL, 1, NULL, 1),
(4, 16, 10, 'Uji Telat', 'Uji Coba', 1598970551, 1598844600, 1599055800, 2, 'How_to_Mininet_ODL.docx', 0),
(5, 16, 10, 'Design Grapich', 'Make\'s a logo based on client request', 1599014797, 1599706800, 1599055822, 2, 'stackdriver.docx', 0),
(6, 16, 10, 'Percobaan', 'Percobaan', 1599059623, 1599148800, NULL, 1, NULL, 0),
(7, 16, 10, 'Percobaan', 'sadsad', 1599059891, 1599110400, NULL, 1, NULL, 1),
(8, 16, 10, 'Percobaan', 'asdasd', 1599059919, 1599067140, NULL, 1, NULL, 1),
(10, 16, 10, 'Reporting assignment for 26 August', 'Completed ur report with a normal format', 1599621390, 1599883200, 1599664014, 2, 'WendiKardian-NDG-2-SIJA1-certificate1.pdf', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `assignment_group`
--

CREATE TABLE `assignment_group` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `info` varchar(255) NOT NULL,
  `created_at` int(11) NOT NULL,
  `deadline_at` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `assignment_group`
--

INSERT INTO `assignment_group` (`id`, `sender_id`, `group_id`, `title`, `info`, `created_at`, `deadline_at`, `is_deleted`) VALUES
(1, 16, 2, 'Laporan perkembangan perusahaan', 'Uji Coba', 1599406803, 1599547740, 0),
(2, 16, 2, 'Uji COba', 'ASSSALAMUALAIKUM', 1599407783, 1599624000, 0),
(3, 16, 4, 'HELLO WORLD GOOD NIGHT', 'TEST', 1599411086, 1599879600, 0),
(6, 16, 2, 'asdasd', 'asdasdas', 1599623088, 1600404300, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `assignment_group_member`
--

CREATE TABLE `assignment_group_member` (
  `id` int(11) NOT NULL,
  `assignment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `submited_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `assignment_group_member`
--

INSERT INTO `assignment_group_member` (`id`, `assignment_id`, `user_id`, `file`, `status`, `submited_at`) VALUES
(1, 1, 1, 'wendi.doc', 2, 123213123),
(3, 3, 1, 'stackdriver1.docx', 2, 1599455556),
(4, 1, 10, 'CERT-00EHNTBF.jpg', 2, 1599458313),
(5, 2, 10, 'WendiKardian-NDG-2-SIJA1-certificate.pdf', 2, 1599458368),
(6, 6, 10, 'wendikardian-SMK1+ITCS+201808+SIJ-Certificate.pdf', 2, 1599664897),
(7, 6, 1, 'WendiKardian-NDG-SIJA1-certificate.pdf', 2, 1599665132);

-- --------------------------------------------------------

--
-- Struktur dari tabel `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `comment`
--

INSERT INTO `comment` (`id`, `uid`, `aid`, `comment`, `date`) VALUES
(1, 1, 3, 'Uji coba', 1598288354),
(2, 1, 3, 'asdasdsad', 1598288577),
(3, 1, 3, 'hei', 1598288889),
(4, 10, 3, 'Siap', 1598289019),
(8, 11, 3, 'Nah Nah Nah', 1598291575);

-- --------------------------------------------------------

--
-- Struktur dari tabel `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `info` varchar(255) NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `event`
--

INSERT INTO `event` (`id`, `created_by`, `date`, `subject`, `info`, `type`) VALUES
(2, 1, 1597942800, 'Uji coba', 'Uji coba', 1),
(3, 1, 1598115600, 'taytay', 'tay', 2),
(5, 1, 1598115600, 'sadsad', 'asdsadasdasd', 1),
(6, 1, 1598029200, 'taylor', 'asdaslkdn', 1),
(8, 1, 1597942800, 'sadasdasd', 'sadasdasdasdas', 2),
(9, 1, 1597942800, 'wendi', 'wendi', 1),
(11, 1, 1598461200, 'wendi', 'wendiwendiwendiwendiwendi', 1),
(13, 1, 1598029200, 'Piknik Perusahaan', 'Piknik memperingati ulang tahun perusahaan yang ke 17 tahun', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `file_private`
--

CREATE TABLE `file_private` (
  `id` int(11) NOT NULL,
  `folder_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `file_private`
--

INSERT INTO `file_private` (`id`, `folder_id`, `title`, `owner_id`, `date`) VALUES
(1, 1, 'PKK_Tabel_Progress.docx', 1, 1596299774),
(2, 4, '31_WendiKardian_BirrulWalidain.pdf', 1, 1596306189),
(3, 5, 'Materi_Konspirasi.pdf', 1, 1596306229),
(4, 4, '31_WendiKardian_Membaca-MenulisPython.docx', 1, 1598681867);

-- --------------------------------------------------------

--
-- Struktur dari tabel `file_public`
--

CREATE TABLE `file_public` (
  `id` int(11) NOT NULL,
  `folder_id` int(11) NOT NULL,
  `file` varchar(255) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `file_public`
--

INSERT INTO `file_public` (`id`, `folder_id`, `file`, `owner_id`, `date`) VALUES
(1, 1, 'PKI.docx', 1, 1596230375),
(2, 2, 'stackdriver.docx', 1, 1596230516),
(3, 2, 'stackdriver1.docx', 1, 1596231151),
(4, 2, '32__Wendi_Kardian_-_Analisa_Poac.docx', 1, 1596231168),
(5, 2, '32__Wendi_Kardian_-_Tabel_Progress_akhir.docx', 1, 1596232921),
(6, 1, 'logo.PNG', 1, 1596299258),
(9, 3, 'ABSEN_SIJA_A_@44.xlsx', 10, 1598584119),
(10, 4, '31_WendiKardian_tuple.docx', 1, 1598586009),
(11, 1, 'rangkuman_python.docx', 10, 1598586124);

-- --------------------------------------------------------

--
-- Struktur dari tabel `folder_private`
--

CREATE TABLE `folder_private` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `date` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `folder_private`
--

INSERT INTO `folder_private` (`id`, `title`, `owner_id`, `date`, `password`, `is_active`) VALUES
(1, 'wendi', 1, 1596296892, '$2y$10$TWoajell6fh96vAttFysWORUJ9tKz1EPIlVGl9Q1.YtX1f66/N4q.', 1),
(4, 'hello', 1, 1596305829, '$2y$10$0/Ek14dt2EIYQv1p1x1V/OmeiZO3yQEwLaiO9GtzUTd3w.LNq6SCG', 1),
(5, 'test', 1, 1596305882, '$2y$10$iwwR5Qj5VoEhzNoPxf2XDeudI9R2BEEPOKwvR5hLYIksuFXxmgkCi', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `folder_public`
--

CREATE TABLE `folder_public` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `folder_public`
--

INSERT INTO `folder_public` (`id`, `title`, `owner_id`, `date`) VALUES
(1, 'Data Kantor', 1, 1596222513),
(2, 'Data penting harian', 1, 1596224038),
(3, 'Data Rapat pertama', 1, 1597200802),
(4, 'Data Taylor Swift', 10, 1598584051);

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
(2, 'sija', 1, '$2y$10$YW5Rgspy4OTSK705.jDo1umNkIWZx3o6bDHLwbNTsvOwd9gGmKHm6', 'Taylor-Swift-press-by-Mert-and-Marcus-2019-billboard-fea-1500.jpg'),
(3, 'wendi', 1, '$2y$10$pnqehTcy0uAYxV60ibFznemc3iBNjLn.jbnpYMesKZGaJLQoOc17C', 'default_group.jpg'),
(4, 'taylor', 1, '$2y$10$4ojnAREEix2dSDzhvdJxoeaH1w3HMxRPttpAqDBmkgh8/4DuH4Cve', 'default_group.jpg');

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
(13, 2, 10),
(14, 2, 1);

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
(25, 7, 1, 'DUH', 'DUH', 1596485303, 1, NULL, 0, 0, 1),
(26, 11, 1, 'Ini Uji Coba', 'Perkenalkan nama saya uji coba, nice to meet ya', 1598291634, 1, NULL, 0, 0, 1),
(27, 1, 11, 'Nice to meet ya too', 'My name is wendi kardian', 1598291687, 1, NULL, 0, 0, 1),
(28, 16, 1, 'Ini Surat', 'Hello Wendi', 1598908244, 1, NULL, 0, 0, 1),
(29, 1, 16, 'Hello', 'HEIII', 1598908293, 1, NULL, 0, 0, 1),
(30, 16, 10, 'hi taylor', 'nice to meet u', 1599624883, 1, NULL, 0, 0, 0),
(31, 16, 10, 'hi taylor', 'nice to meet u', 1599624956, 1, NULL, 0, 0, 1),
(32, 10, 16, 'hello', 'too', 1599625036, 1, NULL, 0, 0, 1),
(33, 16, 10, 'hei', 'heihei', 1599625091, 1, NULL, 0, 0, 1),
(34, 16, 1, 'Please check employee absent last week', 'ASAP', 1599665186, 1, NULL, 0, 0, 1),
(35, 1, 16, 'OKAY BOS', 'Thanks', 1599665217, 1, NULL, 0, 0, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `recepient_id` int(11) NOT NULL,
  `desc` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `date` int(11) NOT NULL,
  `is_read` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `notification`
--

INSERT INTO `notification` (`id`, `sender_id`, `recepient_id`, `desc`, `url`, `date`, `is_read`) VALUES
(1, 16, 10, 'New Assignment has been added', 'assignment/assignment', 1599621390, 0),
(2, 16, 10, 'New Assignment has been added', 'assignment/groupassignment', 1599623088, 0),
(3, 16, 1, 'New Assignment has been added', 'assignment/groupassignment', 1599623088, 0),
(4, 16, 10, 'You got some new point = 100', 'profile/point/10', 1599623779, 0),
(5, 16, 10, ' You have new message', 'mailbox/inbox', 1599624956, 0),
(6, 10, 16, ' You have new message', 'mailbox/inbox', 1599625037, 0),
(7, 16, 10, ' You have new message', 'mailbox/inbox', 1599625092, 0),
(8, 10, 16, 'taylor has completed the assignment', 'mailbox/inbox', 1599663927, 0),
(9, 10, 16, 'taylor has edited the assignment', 'bos/assignment', 1599664014, 0),
(10, 10, 16, 'taylor has completed the group assignment', 'bos/groupassignment', 1599664897, 0),
(11, 1, 16, 'Wendi Kardian has completed the group assignment', 'bos/groupassignment', 1599665021, 0),
(12, 1, 16, 'Wendi Kardian has edited the group assignment', 'bos/groupassignment', 1599665132, 0),
(13, 16, 1, ' You have new message', 'mailbox/inbox', 1599665186, 0),
(14, 1, 16, ' You have new message', 'mailbox/inbox', 1599665217, 0),
(15, 16, 1, 'You got some new point = 100', 'profile/point/1', 1599665238, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `point_plus`
--

CREATE TABLE `point_plus` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `recepient_id` int(11) NOT NULL,
  `point` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `desc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `point_plus`
--

INSERT INTO `point_plus` (`id`, `sender_id`, `recepient_id`, `point`, `date`, `desc`) VALUES
(1, 16, 10, -100, '2020-09-07 15:32:03', 'For Completed you work '),
(2, 16, 9, 500, '2020-09-07 15:54:22', 'Work Desk'),
(3, 16, 10, 200, '2020-08-08 08:55:25', 'Completed new assignment'),
(4, 16, 10, 500, '2020-09-08 09:27:08', 'Uji Coba'),
(5, 16, 10, 500, '2020-09-08 10:25:14', 'Test'),
(6, 16, 10, -50, '2020-09-08 10:45:17', 'Bolos'),
(7, 16, 11, -50, '2020-09-08 11:04:33', 'TEST`'),
(8, 16, 10, 100, '2020-09-09 09:13:05', 'Thanks for helping :)'),
(9, 16, 10, -50, '2020-09-09 09:13:47', 'Late For completed ur assignment'),
(10, 16, 1, 100, '2020-09-09 09:14:10', 'Completed ur work'),
(11, 16, 10, 100, '2020-09-09 10:55:50', 'Congrats'),
(12, 16, 10, 100, '2020-09-09 10:56:19', 'Congrats'),
(13, 16, 1, 100, '2020-09-09 22:27:18', 'Thanks for ur work');

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
(1, '0', 'Wendi Kardian', 'wendikardian@gmail.com', 'team-11.jpg', '$2y$10$Tv0NIIES7HosMba/PovGEu4xb1/c1JZcytftMEnSPIoeId/jXqCNu', 1, 1, 1595478019, '+62896422512589', ''),
(9, '0', 'adele', 'adele@gmail.com', 'default.jpg', '$2y$10$sB06KGnXuMoZca4KP5av1ulMt5zc4GZSxXcs/E0.CCk2Kzn.Fvh0C', 3, 1, 1596960493, '+62', 'adele@gmail.com.png'),
(10, '0', 'taylor', 'taylor@gmail.com', 'images.jpg', '$2y$10$/yoiTq0CrCRCSAiW9u3GUu61CWo0sKfdqCZch.xaEzzekhcRlszZe', 3, 1, 1596980249, '+62', 'taylor@gmail.com.png'),
(11, '0', 'ujicoba', 'ujicoba@gmail.com', 'default.jpg', '$2y$10$gbPpO1JyXzM/dker6JqdXun/JVz3WK62H4feerrYO89ISp7/jCL3S', 3, 1, 1596980264, '+62', 'ujicoba@gmail.com.png'),
(16, '0', 'wendi alison swift', 'wendialisonswift@gmail.com', 'default.jpg', '$2y$10$46sPrgtf1vHM1lqWP9mAKe/0EVBSmC28Aiya/kR7vl0xZffrx8CcW', 2, 1, 1598800468, '+62', 'wendialisonswift@gmail.com.png');

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
(26, 3, 11),
(27, 1, 10),
(28, 2, 12);

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
(9, 'Event', 'fas fa-calendar-alt'),
(11, 'Group', 'fa fa-users'),
(12, 'Bos', 'fa fa-bold');

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
(4, 'guest'),
(6, 'Cleaning Service');

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
(15, 7, 'Group Assignment', 'assignment/groupassignment', 1),
(16, 8, 'Add Assignment', 'addassignment/addassignment', 1),
(17, 8, 'On Proccess Assignment', 'addassignment/onproccess', 1),
(18, 8, 'Completed Assignment', 'addassignment/completedassignment', 1),
(19, 9, 'Event', 'event/event', 1),
(21, 6, 'Draft', 'mailbox/draft', 1),
(22, 1, 'Group Management', 'dashboard/group', 1),
(23, 11, 'Group', 'group/group', 1),
(24, 11, 'My Group', 'group/mygroup', 1),
(25, 1, 'Absent', 'dashboard/absent', 1),
(26, 9, 'Announcement', 'event/announcement', 1),
(27, 12, 'Assignment', 'bos/assignment', 1),
(28, 12, 'Point', 'bos/point', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `date_created` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_token`
--

INSERT INTO `user_token` (`id`, `email`, `token`, `date_created`) VALUES
(6, 'wendikardian@gmail.com', 'oo4k/PaSbYPGhFWor2KJ9UEvQ8qYfEdMj8cGik5d23A=', '1598802362'),
(7, 'wendialisonswift@gmail.com', 'nczdx86+D5T4Is20CoLORO2DeLPMsGbZUMNA+DHOHh0=', '1598802568');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absensi_masuk`
--
ALTER TABLE `absensi_masuk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `assignment`
--
ALTER TABLE `assignment`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `assignment_group`
--
ALTER TABLE `assignment_group`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `assignment_group_member`
--
ALTER TABLE `assignment_group_member`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

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
-- Indeks untuk tabel `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `point_plus`
--
ALTER TABLE `point_plus`
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
-- Indeks untuk tabel `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absensi_masuk`
--
ALTER TABLE `absensi_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT untuk tabel `announcement`
--
ALTER TABLE `announcement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `assignment`
--
ALTER TABLE `assignment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `assignment_group`
--
ALTER TABLE `assignment_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `assignment_group_member`
--
ALTER TABLE `assignment_group_member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `file_private`
--
ALTER TABLE `file_private`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `file_public`
--
ALTER TABLE `file_public`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `folder_private`
--
ALTER TABLE `folder_private`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `folder_public`
--
ALTER TABLE `folder_public`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `group`
--
ALTER TABLE `group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `group_member`
--
ALTER TABLE `group_member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `mail`
--
ALTER TABLE `mail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT untuk tabel `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `point_plus`
--
ALTER TABLE `point_plus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
