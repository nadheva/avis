-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Bulan Mei 2022 pada 05.01
-- Versi server: 10.4.19-MariaDB
-- Versi PHP: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pdavi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `approval`
--

CREATE TABLE `approval` (
  `id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `approve_user` int(11) UNSIGNED NOT NULL,
  `update_date` date DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `approve` int(11) NOT NULL,
  `routes` int(11) NOT NULL,
  `updated` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `approval`
--

INSERT INTO `approval` (`id`, `task_id`, `approve_user`, `update_date`, `notes`, `approve`, `routes`, `updated`, `updated_at`) VALUES
(9, 5, 12, '2021-09-29', 'Sippp', 202, 1, 1, '2021-11-04 01:04:48'),
(26, 13, 12, '2021-10-22', 'Good', 202, 1, 1, '2021-11-04 01:04:48'),
(40, 21, 72, NULL, NULL, 1, 1, 0, '2021-11-16 04:26:33'),
(44, 23, 72, NULL, NULL, 1, 1, 1, '2021-11-18 02:24:57'),
(45, 23, 39, NULL, NULL, 2, 2, 1, '2021-11-18 02:24:57'),
(46, 23, 68, NULL, NULL, 3, 3, 1, '2021-11-18 02:24:57'),
(47, 24, 72, NULL, NULL, 1, 1, 1, '2021-11-18 02:26:13'),
(48, 24, 39, NULL, NULL, 2, 2, 1, '2021-11-18 02:26:13'),
(49, 24, 68, NULL, NULL, 3, 3, 1, '2021-11-18 02:26:13'),
(50, 25, 72, NULL, NULL, 1, 1, 1, '2021-11-18 02:27:07'),
(51, 25, 39, NULL, NULL, 2, 2, 1, '2021-11-18 02:27:07'),
(52, 25, 68, NULL, NULL, 3, 3, 1, '2021-11-18 02:27:07'),
(53, 26, 38, '2021-11-26', 'OK, thanks.', 202, 1, 1, '2021-11-26 03:44:27'),
(54, 26, 12, '2021-11-30', 'OK', 202, 1, 1, '2021-11-30 05:22:23'),
(55, 26, 39, NULL, NULL, 1, 1, 1, '2021-11-18 02:28:52'),
(56, 27, 65, NULL, NULL, 1, 1, 0, '2021-11-18 02:35:01'),
(57, 27, 39, NULL, NULL, 1, 1, 0, '2021-11-18 02:35:01'),
(58, 27, 38, NULL, NULL, 1, 1, 0, '2021-11-18 02:35:02'),
(59, 28, 65, NULL, NULL, 1, 1, 0, '2021-11-18 02:37:46'),
(60, 28, 12, NULL, NULL, 1, 1, 0, '2021-11-18 02:37:46'),
(61, 28, 71, NULL, NULL, 2, 2, 0, '2021-11-18 02:37:46'),
(62, 28, 36, NULL, NULL, 3, 3, 0, '2021-11-18 02:37:46'),
(63, 29, 65, NULL, NULL, 1, 1, 0, '2021-11-18 02:45:42'),
(64, 29, 39, NULL, NULL, 1, 1, 0, '2021-11-18 02:45:42'),
(65, 30, 37, NULL, NULL, 1, 1, 1, '2021-11-18 02:48:40'),
(66, 31, 37, NULL, NULL, 1, 1, 1, '2021-11-18 02:50:42'),
(67, 31, 36, NULL, NULL, 2, 2, 1, '2021-11-18 02:50:42'),
(68, 32, 37, NULL, NULL, 1, 1, 1, '2021-11-18 02:51:43'),
(69, 32, 36, NULL, NULL, 2, 2, 1, '2021-11-18 02:51:43'),
(70, 33, 72, NULL, NULL, 1, 1, 0, '2021-11-18 02:56:33'),
(71, 34, 38, NULL, NULL, 1, 1, 0, '2021-11-21 07:47:23'),
(72, 35, 72, NULL, NULL, 1, 1, 1, '2021-11-21 08:00:17'),
(73, 35, 12, '2021-12-16', 'N200 done di 8 Dec 2021', 202, 1, 1, '2021-12-16 09:32:14'),
(74, 36, 38, NULL, NULL, 1, 1, 1, '2021-11-21 08:13:27'),
(75, 36, 12, '2021-12-16', 'Done', 202, 1, 1, '2021-12-16 09:33:38'),
(76, 37, 65, NULL, NULL, 1, 1, 0, '2021-11-21 08:15:21'),
(77, 37, 12, NULL, NULL, 1, 1, 0, '2021-11-21 08:15:21'),
(78, 38, 65, NULL, NULL, 1, 1, 0, '2021-11-21 08:18:12'),
(79, 38, 12, NULL, NULL, 1, 1, 0, '2021-11-21 08:18:12'),
(80, 39, 36, NULL, NULL, 1, 1, 1, '2021-11-21 08:19:49'),
(81, 40, 65, NULL, NULL, 1, 1, 0, '2021-11-21 08:49:06'),
(82, 40, 68, NULL, NULL, 2, 2, 0, '2021-11-21 08:49:06'),
(83, 41, 65, NULL, NULL, 1, 1, 0, '2021-11-21 08:50:37'),
(84, 41, 68, NULL, NULL, 2, 2, 0, '2021-11-21 08:50:37'),
(85, 42, 65, NULL, NULL, 1, 1, 0, '2021-11-21 08:58:32'),
(86, 42, 68, NULL, NULL, 2, 2, 0, '2021-11-21 08:58:32'),
(87, 43, 39, NULL, NULL, 1, 1, 0, '2021-11-21 09:00:08'),
(88, 44, 72, NULL, NULL, 1, 1, 0, '2021-11-21 09:01:48'),
(89, 44, 12, NULL, NULL, 1, 1, 0, '2021-11-21 09:01:48'),
(90, 45, 68, NULL, NULL, 1, 1, 0, '2021-11-21 09:03:45'),
(91, 45, 12, NULL, NULL, 1, 1, 0, '2021-11-21 09:03:45'),
(92, 46, 65, NULL, NULL, 1, 1, 0, '2021-11-21 09:06:08'),
(93, 47, 65, NULL, NULL, 1, 1, 0, '2021-11-21 09:19:29'),
(94, 47, 72, NULL, NULL, 2, 2, 0, '2021-11-21 09:19:29'),
(95, 48, 39, NULL, NULL, 1, 1, 0, '2021-11-30 06:46:14'),
(96, 48, 12, NULL, NULL, 1, 1, 0, '2021-11-30 06:46:14'),
(97, 49, 12, '2021-12-16', 'sample for cav 3 & 4 ready', 202, 1, 1, '2021-12-16 09:33:22'),
(98, 50, 39, NULL, NULL, 1, 1, 0, '2021-12-03 12:25:07'),
(99, 50, 12, NULL, NULL, 2, 2, 0, '2021-12-03 12:25:07'),
(100, 51, 12, NULL, NULL, 1, 1, 0, '2021-12-16 09:59:05'),
(101, 52, 12, NULL, NULL, 1, 1, 0, '2021-12-17 03:04:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `approval_rio`
--

CREATE TABLE `approval_rio` (
  `id` int(11) NOT NULL,
  `rio_id` int(11) NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `approve_user` int(11) UNSIGNED NOT NULL,
  `update_date` date DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `approve` int(11) NOT NULL,
  `updated` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `approval_rio`
--

INSERT INTO `approval_rio` (`id`, `rio_id`, `file`, `approve_user`, `update_date`, `notes`, `approve`, `updated`) VALUES
(3, 3, 'dummies.pdf', 22, '2021-10-04', 'Example notes from approval', 202, 1),
(5, 5, 'dummies (5).pdf', 12, '2021-10-05', 'ini notes', 202, 1),
(9, 9, 'dummies (1).pdf', 39, '2021-10-21', 'Good', 202, 1),
(10, 10, NULL, 12, NULL, 'aaa', 0, 0),
(13, 13, 'dummies.zip', 12, '2021-11-30', '', 202, 1),
(16, 16, NULL, 12, NULL, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_activation_attempts`
--

CREATE TABLE `auth_activation_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_groups`
--

CREATE TABLE `auth_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `auth_groups`
--

INSERT INTO `auth_groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Site Administrator'),
(2, 'user', 'Regular User');

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_groups_permissions`
--

CREATE TABLE `auth_groups_permissions` (
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `auth_groups_permissions`
--

INSERT INTO `auth_groups_permissions` (`group_id`, `permission_id`) VALUES
(1, 1),
(1, 2),
(2, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_groups_users`
--

CREATE TABLE `auth_groups_users` (
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `auth_groups_users`
--

INSERT INTO `auth_groups_users` (`group_id`, `user_id`) VALUES
(1, 1),
(2, 12),
(2, 22),
(2, 24),
(2, 25),
(2, 27),
(2, 28),
(2, 30),
(2, 33),
(2, 36),
(2, 37),
(2, 38),
(2, 39),
(2, 40),
(2, 41),
(2, 65),
(2, 66),
(2, 67),
(2, 68),
(2, 71),
(2, 72),
(2, 73),
(2, 74),
(2, 75),
(2, 76),
(2, 77);

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_logins`
--

CREATE TABLE `auth_logins` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `pass` varchar(255) NOT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `auth_logins`
--

INSERT INTO `auth_logins` (`id`, `ip_address`, `email`, `pass`, `user_id`, `date`, `success`) VALUES
(1, '127.0.0.1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-09-01 11:29:05', 1),
(2, '::1', 'juang@astra-visteon.com', 'Avi123!', 1, '2021-09-01 13:02:38', 1),
(3, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-09-01 16:28:08', 1),
(4, '::1', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-09-01 16:34:25', 1),
(5, '::1', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-09-01 16:35:47', 1),
(6, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-09-02 07:38:54', 1),
(7, '::1', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-09-02 07:48:03', 1),
(8, '::1', 'bimo.prakoso@astra-visteon.com', 'erberb', NULL, '2021-09-02 07:48:15', 0),
(9, '::1', 'alnadiev@visteon.com', 'wevqwv', NULL, '2021-09-02 07:48:50', 0),
(10, '::1', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-09-02 07:49:02', 1),
(11, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-09-02 08:02:49', 1),
(12, '::1', 'reza.andriady@astra-visteon.com', 'Avi123!', NULL, '2021-09-02 09:03:50', 0),
(13, '::1', 'reza.andriady@astra-visteon.com', 'Avi123!', NULL, '2021-09-02 09:04:11', 0),
(14, '::1', 'reza.andriady@astra-visteon.com', 'Avi123!', 22, '2021-09-02 09:04:47', 1),
(15, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-09-02 09:15:20', 1),
(16, '::1', 'reza.andriady@astra-visteon.com', 'Avi123!', 22, '2021-09-02 09:26:15', 1),
(17, '127.0.0.1', 'nasirudin@astra-visteon.com', 'Avi123!', 24, '2021-09-02 11:33:38', 1),
(18, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-09-02 14:08:18', 1),
(19, '::1', 'juang@astra-visteon.com', 'Avi123!', 1, '2021-09-02 15:36:47', 1),
(20, '::1', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-09-02 15:57:29', 1),
(21, '127.0.0.1', 'dhaniar.bayu@astra-visteon.com', 'Avi123!', 37, '2021-09-02 16:20:01', 1),
(22, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-09-03 08:19:14', 1),
(23, '::1', 'juang@astra-visteon.com', 'Avi123!', 1, '2021-09-03 08:47:40', 1),
(24, '::1', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-09-03 08:47:52', 1),
(25, '::1', 'juang@astra-visteon.com', 'Avi123!', 1, '2021-09-03 10:36:00', 1),
(26, '::1', 'dhaniar.bayu@astra-visteon.com', 'Avi123!', 37, '2021-09-03 16:29:52', 1),
(27, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-09-06 07:45:28', 1),
(28, '::1', 'dhaniar.bayu@astra-visteon.com', 'Avi123!', 37, '2021-09-06 08:25:37', 1),
(29, '::1', 'bimo.prakoso@astra-visteon.com', 'Avi1223!', NULL, '2021-09-06 08:32:42', 0),
(30, '::1', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-09-06 08:32:49', 1),
(31, '::1', 'dhaniar.bayu@astra-visteon.com', 'Avi123!', 37, '2021-09-06 11:26:59', 1),
(32, '::1', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-09-06 11:38:03', 1),
(33, '::1', 'dhaniar.bayu@astra-visteon.com', 'Avi123!', 37, '2021-09-06 12:26:11', 1),
(34, '::1', 'juang@visteon.com', 'Avi123!', NULL, '2021-09-06 15:52:52', 0),
(35, '::1', 'juang@astra-visteon.com', 'Avi123!', 1, '2021-09-06 15:53:01', 1),
(36, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-09-06 16:12:17', 1),
(37, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-09-07 07:36:14', 1),
(38, '::1', 'juang@astra-visteon.com', 'Avi123!', 1, '2021-09-07 14:16:46', 1),
(39, '::1', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-09-08 07:41:23', 1),
(40, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-09-08 07:53:10', 1),
(41, '::1', 'bimo.prakoso@astra-visteon.com', 'Avi123123!', NULL, '2021-09-08 13:58:21', 0),
(42, '::1', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-09-08 13:58:35', 1),
(43, '::1', 'amirudin.atmojo@astra-visteon.com', 'Avi123!', NULL, '2021-09-09 07:57:24', 0),
(44, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-09-09 07:58:15', 1),
(45, '::1', 'dhaniar.bayu@astra-visteon.com', 'Avi123!', 37, '2021-09-09 08:03:26', 1),
(46, '::1', 'juang@astra-visteon.com', 'Avi123!', 1, '2021-09-09 09:29:31', 1),
(47, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-09-09 09:37:52', 1),
(48, '::1', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-09-09 10:03:51', 1),
(49, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-09-10 07:56:16', 1),
(50, '::1', 'juang@astra-visteon.com', 'Avi123!', 1, '2021-09-10 08:54:24', 1),
(51, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi2123!', NULL, '2021-09-13 07:39:40', 0),
(52, '::1', 'amirudin.atmojo@astra-visteon.com', 'Avi123!', NULL, '2021-09-13 07:39:48', 0),
(53, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-09-13 07:40:32', 1),
(54, '::1', 'bimo.prakoso@astra-visteon.com', 'Av123!', NULL, '2021-09-13 08:49:23', 0),
(55, '::1', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-09-13 08:49:28', 1),
(56, '::1', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-09-13 08:49:28', 1),
(57, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-09-13 10:53:32', 1),
(58, '::1', 'sallim.fauzy@astra-visteon.com', 'Avi123!', 38, '2021-09-13 11:20:59', 1),
(59, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-09-13 14:31:17', 1),
(60, '::1', 'ian.aliansyah@astra-visteon.com', 'Avi123!', 36, '2021-09-13 14:41:17', 1),
(61, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-09-13 14:51:09', 1),
(62, '::1', 'ian.aliansyah@astra-visteon.com', 'Avi123!', 36, '2021-09-13 15:31:49', 1),
(63, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-09-14 07:42:45', 1),
(64, '::1', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-09-14 07:53:25', 1),
(65, '::1', 'sallim.fauzy@astra-visteon.com', 'Avi123!', 38, '2021-09-14 08:49:43', 1),
(66, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123', NULL, '2021-09-14 11:40:24', 0),
(67, '::1', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-09-14 11:40:48', 1),
(68, '::1', 'sallim.fauzy@astra-visteon.com', 'Avi123', NULL, '2021-09-14 11:45:38', 0),
(69, '::1', 'sallim.fauzy@astra-visteon.com', 'Avi123!', 38, '2021-09-14 11:45:47', 1),
(70, '::1', 'ian.aliansyah@astra-visteon.com', 'Avi123!', 36, '2021-09-14 13:01:25', 1),
(71, '::1', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-09-14 13:26:15', 1),
(72, '::1', 'juang@astra-visteon.com', 'Avi123!', 1, '2021-09-14 15:58:19', 1),
(73, '::1', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-09-14 16:25:44', 1),
(74, '::1', 'reza.andriady@astra-visteon.com', 'Avi123!', 22, '2021-09-14 16:26:43', 1),
(75, '::1', 'sallim.fauzy@astra-visteon.com', 'vi123!', NULL, '2021-09-14 16:31:52', 0),
(76, '::1', 'sallim.fauzy@astra-visteon.com', 'Avi123!', 38, '2021-09-14 16:32:02', 1),
(77, '::1', 'ian.aliansyah@astra-visteon.com', 'Avi123!', 36, '2021-09-14 16:33:13', 1),
(78, '::1', 'sallim.fauzy@astra-visteon.com', 'Avi123!', 38, '2021-09-14 16:34:19', 1),
(79, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-09-15 07:43:30', 1),
(80, '::1', 'juang@astra-visteon.com', 'Avi123!', 1, '2021-09-15 08:17:45', 1),
(81, '::1', 'juang@astra-visteon.com', 'Avi123!', 1, '2021-09-16 07:38:08', 1),
(82, '::1', 'juang@astra-visteon.com', 'Avi123!', 1, '2021-09-16 14:37:10', 1),
(83, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-09-16 14:59:12', 1),
(84, '::1', 'riko@astra-visteon.com', 'Avi123!', NULL, '2021-09-16 15:43:34', 0),
(85, '::1', 'riko@astra-visteon.com', 'Avi12345!', 48, '2021-09-16 15:44:58', 1),
(86, '::1', 'riko@astra-visteon.com', 'Avi123!', NULL, '2021-09-16 16:10:13', 0),
(87, '::1', 'riko@astra-visteon.com', 'Avi12345!', 48, '2021-09-16 16:10:20', 1),
(88, '::1', 'juang@astra-visteon.com', 'Avi123!', 1, '2021-09-16 16:28:39', 1),
(89, '::1', 'juang@astra-visteon.com', 'Avi123!', 1, '2021-09-16 16:35:08', 1),
(90, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-09-17 07:43:22', 1),
(91, '::1', 'riko@astra-visteon.com', 'Avi12345!', 48, '2021-09-17 07:49:09', 1),
(92, '::1', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-09-17 07:57:30', 1),
(93, '::1', 'juang@astra-visteon.com', 'Avi123!', 1, '2021-09-17 09:33:56', 1),
(94, '::1', 'riko@astra-visteon.com', 'Avi123!', 48, '2021-09-17 11:30:08', 1),
(95, '::1', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-09-17 13:01:47', 1),
(96, '::1', 'sallim.fauzy@astra-visteon.com', 'Avi123!', 38, '2021-09-17 13:02:35', 1),
(97, '::1', 'ian.aliansyah@astra-visteon.com', 'Avi123!', 36, '2021-09-17 13:03:32', 1),
(98, '::1', 'sallim.fauzy@astra-visteon.com', 'Avi123!', 38, '2021-09-17 13:05:26', 1),
(99, '::1', 'juang@astra-visteon.com', 'Avi123!', 1, '2021-09-17 13:32:12', 1),
(100, '::1', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-09-17 14:30:06', 1),
(101, '127.0.0.1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-09-20 08:01:14', 1),
(102, '::1', 'juang@astra-visteon.com', 'Avi123!', 1, '2021-09-20 13:03:36', 1),
(103, '127.0.0.1', 'juang@astra-visteon.com', 'Avi123!', 1, '2021-09-21 07:44:25', 1),
(104, '::1', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-09-21 09:09:16', 1),
(105, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-09-22 07:53:13', 1),
(106, '::1', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-09-22 09:17:20', 1),
(107, '::1', 'juang@astra-visteon.com', 'Avi123!', 1, '2021-09-22 12:45:16', 1),
(108, '::1', 'juang@astra-visteon.com', 'Avi123!', 1, '2021-09-23 08:06:18', 1),
(109, '::1', 'juang@astra-visteon.com', 'Avi123!', 1, '2021-09-23 11:26:47', 1),
(110, '::1', 'juang@astra-visteon.com', 'Avi123!', 1, '2021-09-23 15:35:39', 1),
(111, '::1', 'juang@astra-visteon.com', 'Avi123!', 1, '2021-09-23 15:57:01', 1),
(112, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-09-23 16:00:17', 1),
(113, '::1', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-09-23 16:05:36', 1),
(114, '::1', 'sallim.fauzy@astra-visteon.com', 'Avi123!', 38, '2021-09-23 16:12:48', 1),
(115, '::1', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-09-23 16:24:49', 1),
(116, '::1', 'reza.andriady@astra-visteon.com', 'Avi123!', 22, '2021-09-23 16:26:31', 1),
(117, '::1', 'sallim.fauzy@astra-visteon.com', 'Avi123!', 38, '2021-09-23 16:27:31', 1),
(118, '::1', 'ian.aliansyah@astra-visteon.com', 'Avi123!', 36, '2021-09-23 16:29:49', 1),
(119, '::1', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-09-23 16:31:16', 1),
(120, '::1', 'sallim.fauzy@astra-visteon.com', 'Avi123!', 38, '2021-09-23 16:32:14', 1),
(121, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-09-24 07:54:30', 1),
(122, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-09-24 13:04:28', 1),
(123, '10.14.82.34', 'juang@astra-visteon.com', 'Avi123!', 1, '2021-09-24 13:08:57', 1),
(124, '::1', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-09-24 13:42:41', 1),
(125, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-09-24 13:43:15', 1),
(126, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-09-27 07:54:41', 1),
(127, '::1', 'sallim.fauzy@astra-visteon.com', 'Avi123!', 38, '2021-09-27 08:01:15', 1),
(128, '::1', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-09-27 08:08:51', 1),
(129, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-09-27 08:09:17', 1),
(130, '::1', 'bayu.putra@astra-visteon.com', 'Avi123!', 25, '2021-09-27 08:55:59', 1),
(131, '::1', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-09-27 09:14:28', 1),
(132, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-09-27 09:45:15', 1),
(133, '::1', 'bayu.putra@astra-visteon.com', 'Avi123!', 25, '2021-09-27 10:11:10', 1),
(134, '::1', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-09-27 11:08:59', 1),
(135, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-09-27 13:07:23', 1),
(136, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-09-28 07:51:29', 1),
(137, '::1', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-09-28 08:07:05', 1),
(138, '::1', 'sallim.fauzy@astra-visteon.com', 'Avi123!', 38, '2021-09-28 08:14:06', 1),
(139, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-09-28 13:36:57', 1),
(140, '::1', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-09-28 14:00:54', 1),
(141, '::1', 'reza.andriady@astra-visteon.com', 'Avi123!', 22, '2021-09-28 14:01:50', 1),
(142, '::1', 'eko.prasetyo@astra-visteon.com', 'Avi123!', 31, '2021-09-28 14:05:33', 1),
(143, '::1', 'reza.andriady@astra-visteon.com', 'Avi123!', 22, '2021-09-28 15:40:21', 1),
(144, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-09-29 10:12:47', 1),
(145, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-09-30 07:53:12', 1),
(146, '::1', 'reza.andriady@astra-visteon.com', 'Avi123!', 22, '2021-09-30 11:32:40', 1),
(147, '::1', 'eko.prasetyo@astra-visteon.com', 'Avi123!', 31, '2021-09-30 11:33:34', 1),
(148, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-09-30 13:42:51', 1),
(149, '::1', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-09-30 14:07:12', 1),
(150, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-09-30 15:53:09', 1),
(151, '::1', 'reza.andriady@astra-visteon.com', 'Avi123!', 22, '2021-09-30 15:57:40', 1),
(152, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-09-30 16:00:12', 1),
(153, '::1', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-09-30 16:30:03', 1),
(154, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-10-01 07:43:55', 1),
(155, '::1', 'reza.andriady@astra-visteon.com', 'Avi123!', 22, '2021-10-01 07:46:59', 1),
(156, '::1', 'ian.aliansyah@astra-visteon.com', 'Avi123!', 36, '2021-10-01 08:08:07', 1),
(157, '::1', 'eko.prasetyo@astra-visteon.com', 'Avi123!', 31, '2021-10-01 08:09:23', 1),
(158, '::1', 'jemy.akvianto@astra-visteon.com', 'Avi123!', 40, '2021-10-01 08:36:14', 1),
(159, '::1', 'sallim.fauzy@astra-visteon.com', 'Avi123!', 38, '2021-10-01 08:46:07', 1),
(160, '::1', 'ian.aliansyah@astra-visteon.com', 'Avi123!', 36, '2021-10-01 08:51:31', 1),
(161, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-10-01 08:55:58', 1),
(162, '::1', 'jemy.akvianto@astra-visteon.com', 'Avi123!', 40, '2021-10-01 09:08:33', 1),
(163, '::1', 'sallim.fauzy@astra-visteon.com', 'Avi123!', 38, '2021-10-01 09:11:20', 1),
(164, '::1', 'ian.aliansyah@astra-visteon.com', 'Avi123!', 36, '2021-10-01 09:12:00', 1),
(165, '::1', 'jemy.akvianto@astra-visteon.com', 'Avi123!', 40, '2021-10-01 09:24:25', 1),
(166, '::1', 'sallim.fauzy@astra-visteon.com', 'Avi123!', 38, '2021-10-01 09:28:32', 1),
(167, '::1', 'ian.aliansyah@astra-visteon.com', 'Avi123!', 36, '2021-10-01 09:28:55', 1),
(168, '::1', 'juang@astra-visteon.com', 'Avi123!', 1, '2021-10-01 10:23:35', 1),
(169, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-10-01 10:30:37', 1),
(170, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-10-01 10:35:45', 1),
(171, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-10-01 15:10:05', 1),
(172, '::1', 'juang@astra-visteon.com', 'Avi123!', 1, '2021-10-04 07:45:08', 1),
(173, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-10-04 07:45:42', 1),
(174, '::1', 'reza.andriady@astra-visteon.com', 'Avi123!', 22, '2021-10-04 08:48:30', 1),
(175, '::1', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-10-04 08:49:50', 1),
(176, '::1', 'sallim.fauzy@astra-visteon.com', 'Avi123!', 38, '2021-10-04 09:42:18', 1),
(177, '::1', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-10-04 09:46:02', 1),
(178, '::1', 'sallim.fauzy@astra-visteon.com', 'Avi123!', 38, '2021-10-04 09:46:33', 1),
(179, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-10-04 09:53:54', 1),
(180, '::1', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-10-04 09:58:07', 1),
(181, '::1', 'sallim.fauzy@astra-visteon.com', 'Avi123!', 38, '2021-10-04 10:39:15', 1),
(182, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-10-04 12:53:48', 1),
(183, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-10-04 12:55:17', 1),
(184, '::1', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-10-04 13:36:04', 1),
(185, '::1', 'reza.andriady@astra-visteon.com', 'Avi123!', 22, '2021-10-04 14:49:14', 1),
(186, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-10-05 07:46:27', 1),
(187, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-10-05 07:46:27', 1),
(188, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-10-05 07:46:28', 1),
(189, '::1', 'reza.andriady@astra-visteon.com', 'Avi123!', 22, '2021-10-05 07:55:06', 1),
(190, '::1', 'jemy.akvianto@astra-visteon.com', 'Avi123!', 40, '2021-10-05 08:34:01', 1),
(191, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-10-05 10:22:08', 1),
(192, '::1', 'bayu.putra@astra-visteon.com', 'Avi123!', 25, '2021-10-05 10:38:00', 1),
(193, '::1', 'reza.andriady@astra-visteon.com', 'Avi123!', 22, '2021-10-05 10:40:44', 1),
(194, '::1', 'dhaniar.bayu@astra-visteon.com', 'Avi123!', 37, '2021-10-05 12:48:00', 1),
(195, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-10-05 13:03:37', 1),
(196, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-10-05 14:11:34', 1),
(197, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-10-06 07:41:56', 1),
(198, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-10-07 07:47:06', 1),
(199, '::1', 'bayu.putra@astra-visteon.com', 'vi123!', NULL, '2021-10-07 14:24:31', 0),
(200, '::1', 'bayu.putra@astra-visteon.com', 'Avi123!', 25, '2021-10-07 14:24:38', 1),
(201, '::1', 'ian.aliansyah@astra-visteon.com', 'Avi123!', 36, '2021-10-07 14:26:55', 1),
(202, '::1', 'sallim.fauzy@astra-visteon.com', 'Avi123!', 38, '2021-10-07 14:29:20', 1),
(203, '::1', 'ian.aliansyah@astra-visteon.com', 'Avi123!', 36, '2021-10-07 14:30:24', 1),
(204, '::1', 'sallim.fauzy@astra-visteon.com', 'Avi123!', 38, '2021-10-07 14:33:01', 1),
(205, '::1', 'ian.aliasyah@astra-visteon.com', 'Avi123!', NULL, '2021-10-07 14:34:12', 0),
(206, '::1', 'ian.aliansyah@astra-visteon.com', 'Avi123!', 36, '2021-10-07 14:34:28', 1),
(207, '::1', 'nasirudin@astra-visteon.com', 'Avi123!', 24, '2021-10-07 14:38:22', 1),
(208, '::1', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-10-07 15:36:19', 1),
(209, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-10-07 15:48:03', 1),
(210, '::1', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-10-07 16:29:20', 1),
(211, '::1', 'sallim.fauzy@astra-visteon.com', 'Avi123!', 38, '2021-10-07 16:31:04', 1),
(212, '::1', 'ian.aliansyah@astra-visteon.com', 'Avi123!', 36, '2021-10-07 16:32:56', 1),
(213, '::1', 'sallim.fauzy@astra-visteon.com', 'Avi123!', 38, '2021-10-07 16:36:08', 1),
(214, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-10-08 08:02:35', 1),
(215, '::1', 'nasirudin@astra-visteon.com', 'Avi123!', 24, '2021-10-08 08:34:19', 1),
(216, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-10-11 07:54:17', 1),
(217, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-10-12 07:47:42', 1),
(218, '::1', 'reza.andriady@astra-visteon.com', 'Avi123!', 22, '2021-10-12 09:10:36', 1),
(219, '::1', 'juang@astra-visteon.com', 'Avi123!', 1, '2021-10-12 16:14:05', 1),
(220, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-10-13 08:04:50', 1),
(221, '::1', 'juang@astra-visteon.com', 'Avi123!', 1, '2021-10-13 10:03:29', 1),
(222, '10.14.82.163', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-10-13 10:43:25', 1),
(223, '::1', 'juang@astra-visteon.com', 'Avi123!', 1, '2021-10-13 10:47:41', 1),
(224, '::1', 'juang@astra-visteon.com', 'Avi123!', 1, '2021-10-13 10:56:49', 1),
(225, '::1', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-10-13 11:06:26', 1),
(226, '::1', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-10-13 15:15:21', 1),
(227, '::1', 'sallim.fauzy@astra-visteon.com', 'Avi123!', 38, '2021-10-13 15:17:07', 1),
(228, '::1', 'juang@astra-visteon.com', 'Avi123!', 1, '2021-10-13 15:39:23', 1),
(229, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-10-14 07:50:40', 1),
(230, '::1', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-10-14 08:22:39', 1),
(231, '::1', 'reza.andriady@astra-visteon.com', 'Avi123!', 22, '2021-10-14 08:54:42', 1),
(232, '::1', 'ade.sarastiti@astra-visteon.com', 'Avi123!', 39, '2021-10-14 08:58:57', 1),
(233, '::1', 'reza.andriady@astra-visteon.com', 'Avi123!', 22, '2021-10-14 10:58:22', 1),
(234, '::1', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-10-14 11:31:17', 1),
(235, '::1', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-10-14 15:13:19', 1),
(236, '::1', 'ade.sarastiti@astra-visteon.com', 'Avi123!', 39, '2021-10-14 15:57:36', 1),
(237, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-10-15 07:49:48', 1),
(238, '::1', 'bayu.wibisono@astra-visteon.com', 'Avi123!', 66, '2021-10-15 08:40:56', 1),
(239, '::1', 'juang@astra-visteon.com', 'Avi123!', 1, '2021-10-15 08:58:38', 1),
(240, '::1', 'syabanul.khafi@astra-visteon.com', 'Avi123!', 69, '2021-10-15 09:02:07', 1),
(241, '::1', 'jemy.akvianto@astra-visteon.com', 'Avi123!', 40, '2021-10-15 09:02:38', 1),
(242, '::1', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-10-15 10:07:08', 1),
(243, '::1', 'sallim.fauzy@astra-visteon.com', 'Avi123!', 38, '2021-10-15 13:33:28', 1),
(244, '::1', 'reza.andriady@astra-visteon.com', 'Avi123!', 22, '2021-10-15 13:51:47', 1),
(245, '::1', 'jemy.akvianto@astra-visteon.com', 'Avi123!', 40, '2021-10-15 16:06:33', 1),
(246, '::1', 'sallim.fauzy@astra-visteon.com', 'Avi123!', 38, '2021-10-18 07:39:29', 1),
(247, '::1', 'veronica.manurung@astra-visteon.ac.id', 'Avi123!', NULL, '2021-10-18 08:18:39', 0),
(248, '::1', 'agung.budiyanto@astra-visteon.com', 'Avi123!', 68, '2021-10-18 08:19:09', 1),
(249, '::1', 'veronica.verawaty@astra-visteon.com', 'Avi123!', 67, '2021-10-18 08:20:27', 1),
(250, '::1', 'reza.andriady@astra-visteon.com', 'Avi123!', 22, '2021-10-18 08:25:52', 1),
(251, '::1', 'veronica.verawaty@astra-visteon.com', 'Avi123!', 67, '2021-10-18 08:28:58', 1),
(252, '::1', 'agung.budiyanto@astra-visteon.com', 'Avi123!', 68, '2021-10-18 08:29:29', 1),
(253, '::1', 'sallim.fauzy@astra-visteon.com', 'Avi123!', 38, '2021-10-18 08:29:53', 1),
(254, '::1', 'jemy.akvianto@astra-visteon.com', 'Avi123!', 40, '2021-10-18 09:14:12', 1),
(255, '::1', 'reza.andriady@astra-visteon.com', 'Avi123!', 22, '2021-10-18 09:15:16', 1),
(256, '::1', 'veronica.verawaty@astra-visteon.com', 'Avi123!', 67, '2021-10-18 09:18:31', 1),
(257, '::1', 'reza.andriady@astra-visteon.com', 'Avi123!', 22, '2021-10-18 09:23:19', 1),
(258, '::1', 'veronica.verawaty@astra-visteon.com', 'Avi123!', 67, '2021-10-18 09:24:11', 1),
(259, '::1', 'ade.sarastiti@astra-visteon.com', 'Avi123!', 39, '2021-10-18 09:37:37', 1),
(260, '::1', 'agung.budiyanto@astra-visteon.com', 'Avi123!', 68, '2021-10-18 09:38:42', 1),
(261, '::1', 'dhaniar.bayu@astra-visteon.com', 'Avi123!', 37, '2021-10-18 10:47:34', 1),
(262, '::1', 'jemy.akvianto@astra-visteon.com', 'Avi123!', 40, '2021-10-18 10:56:01', 1),
(263, '::1', 'sallim.fauzy@astra-visteon.com', 'Avi123!', 38, '2021-10-18 11:02:55', 1),
(264, '::1', 'bayu.putra@astra-visteon.com', 'Avi123!', 25, '2021-10-18 11:08:10', 1),
(265, '::1', 'veronica.verawaty@astra-visteon.com', 'Avi123!', 67, '2021-10-18 11:10:27', 1),
(266, '::1', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-10-18 13:38:00', 1),
(267, '::1', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-10-19 07:45:43', 1),
(268, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-10-19 08:10:49', 1),
(269, '::1', 'eko.prasetyo@astra-visteon.com', 'Avi123!', 31, '2021-10-19 09:23:57', 1),
(270, '::1', 'reza.andriady@astra-visteon.com', 'Avi123!', 22, '2021-10-19 09:29:25', 1),
(271, '::1', 'sallim.fauzy@astra-visteon.com', 'Avi123!', 38, '2021-10-19 09:34:00', 1),
(272, '::1', 'ian.aliansyah@astra-visteon.com', 'Avi123!', 36, '2021-10-19 10:23:43', 1),
(273, '::1', 'ian.aliansyah@astra-visteon.com', 'Avi123!', 36, '2021-10-19 10:54:07', 1),
(274, '::1', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-10-19 11:12:54', 1),
(275, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-10-19 11:27:31', 1),
(276, '::1', 'agung.budiyanto@astra-visteon.com', 'Avi123!', 68, '2021-10-19 11:33:23', 1),
(277, '::1', 'jemy.akvianto@astra-visteon.com', 'Avi123!', 40, '2021-10-19 12:55:55', 1),
(278, '::1', 'reza.andriady@astra-visteon.com', 'Avi123!', 22, '2021-10-19 13:43:27', 1),
(279, '::1', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-10-19 13:47:41', 1),
(280, '::1', 'agung.budiyanto@astra-visteon.com', 'Avi123!\'', NULL, '2021-10-19 13:54:40', 0),
(281, '::1', 'agung.budiyanto@astra-visteon.com', 'Avi123!', 68, '2021-10-19 13:54:49', 1),
(282, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-10-19 14:07:28', 1),
(283, '::1', 'reza.andriady@astra-visteon.com', 'Avi123!', 22, '2021-10-21 07:43:08', 1),
(284, '::1', 'ade.sarastiti@astra-visteon.com', 'Avi123!', 39, '2021-10-21 08:01:08', 1),
(285, '::1', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-10-21 08:22:47', 1),
(286, '::1', 'reza.andriady@astra-visteon.com', 'Avi123!', 22, '2021-10-21 08:23:26', 1),
(287, '::1', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-10-21 08:24:20', 1),
(288, '::1', 'agung.budiyanto@astra-visteon.com', 'Avi123!', 68, '2021-10-21 08:27:50', 1),
(289, '::1', 'nanan.kriscandono@astra-visteon.com', 'Avi123!', NULL, '2021-10-21 08:29:21', 0),
(290, '::1', 'nanang.kriscandono@astra-visteon.com', 'Avi123!', 65, '2021-10-21 08:29:40', 1),
(291, '::1', 'bayu.putra@astra-visteon.com', 'Avi123!', 25, '2021-10-21 08:30:51', 1),
(292, '::1', 'veronica.verawaty@astra-visteon.com', 'Avi123!', 67, '2021-10-21 08:31:42', 1),
(293, '::1', 'nasirudin@astra-visteon.com', 'Avi123!', 24, '2021-10-21 08:32:56', 1),
(294, '::1', 'agung.budiyanto@astra-visteon.com', 'Avi123!', 68, '2021-10-21 08:33:36', 1),
(295, '::1', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-10-21 08:53:01', 1),
(296, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-10-21 09:18:33', 1),
(297, '::1', 'sallim.fauzy@astra-visteon.com', 'Avi123!', 38, '2021-10-21 09:18:59', 1),
(298, '::1', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-10-21 09:24:44', 1),
(299, '::1', 'sallim.fauzy@astra-visteon.com', 'Avi123!', 38, '2021-10-21 09:51:25', 1),
(300, '::1', 'reza.andriady@astra-visteon.com', 'Avi123!', 22, '2021-10-21 09:53:47', 1),
(301, '::1', 'veronica.verawaty@astra-visteon.com', 'Avi123!', 67, '2021-10-21 09:54:29', 1),
(302, '::1', 'ade.sarastiti@astra-visteon.com', 'Avi123!', 39, '2021-10-21 09:55:04', 1),
(303, '::1', 'agung.budiyanto@astra-visteon.com', 'Avi123!', 68, '2021-10-21 09:55:28', 1),
(304, '::1', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-10-21 09:57:16', 1),
(305, '::1', 'dhaniar.bayu@astra-visteon.com', 'Avi123!', 37, '2021-10-21 10:12:18', 1),
(306, '::1', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-10-21 10:13:32', 1),
(307, '::1', 'bayu.putra@astra-visteon.com', 'Avi123!', 25, '2021-10-21 10:59:22', 1),
(308, '::1', 'nanang.kriscandono@astra-visteon.com', 'Avi123!', 65, '2021-10-21 11:02:50', 1),
(309, '::1', 'reza.andriady@astra-visteon.com', 'Avi123!', 22, '2021-10-21 11:03:49', 1),
(310, '::1', 'veronica.verawaty@astra-visteon.com', 'Avi123!', 67, '2021-10-21 11:04:25', 1),
(311, '::1', 'nasirudin@astra-visteon.com', 'Avi123!', 24, '2021-10-21 11:05:03', 1),
(312, '::1', 'agung.budiyanto@astra-visteon.com', 'Avi123!', 68, '2021-10-21 11:05:40', 1),
(313, '::1', 'dhaniar.bayu@astra-visteon.com', 'Avi123!', 37, '2021-10-21 11:06:55', 1),
(314, '::1', 'ade.sarastiti@astra-visteon.com', 'Avi123!', 39, '2021-10-21 11:09:06', 1),
(315, '10.14.82.151', 'amirudin.suryo@astra-visteon.com', 'Avi123#!', NULL, '2021-10-21 12:39:09', 0),
(316, '10.14.82.151', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-10-21 12:39:25', 1),
(317, '10.14.82.151', 'ade.sarastiti@astra-visteon.com', 'Avi123!', 39, '2021-10-21 12:41:14', 1),
(318, '10.14.83.26', 'ian.aliansyah@astra-visteon.com', 'Avi123!', 36, '2021-10-21 13:25:35', 1),
(319, '::1', 'ade.sarastiti@astra-visteon.com', 'Avi123!', 39, '2021-10-21 14:29:43', 1),
(320, '::1', 'reza.andriady@astra-visteon.com', 'Avi123!', 22, '2021-10-21 15:42:54', 1),
(321, '10.14.82.151', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-10-21 15:48:21', 1),
(322, '10.14.83.26', 'ian.aliansyah@astra-visteon.com', 'Avi2021!', NULL, '2021-10-21 15:58:39', 0),
(323, '10.14.83.26', 'ian.aliansyah@astra-visteon.com', 'Avi123!', 36, '2021-10-21 15:58:54', 1),
(324, '10.14.82.151', 'tri.sativa@astra-visteon.com', 'Avi123!', 30, '2021-10-21 16:04:32', 1),
(325, '10.14.82.151', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-10-21 16:07:45', 1),
(326, '10.14.82.151', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-10-21 16:44:06', 1),
(327, '10.14.82.180', 'nanang.kriscandono@astra-visteon.com', 'Avi123!', 65, '2021-10-21 16:45:40', 1),
(328, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-10-22 07:30:09', 1),
(329, '::1', 'bayu.putra@astra-visteon.com', 'Avi123!', 25, '2021-10-22 07:38:07', 1),
(330, '::1', 'nanang.kriscandono@astra-visteon.com', 'Avi123!', 65, '2021-10-22 07:39:01', 1),
(331, '::1', 'agung.budiyanto@astra-visteon.com', 'Avi123!', 68, '2021-10-22 07:39:31', 1),
(332, '::1', 'ian.aliansyah@astra-visteon.com', 'Avi123!', 36, '2021-10-22 07:39:55', 1),
(333, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-10-22 08:31:53', 1),
(334, '::1', 'reza.andriady@astra-visteon.com', 'Avi123!', 22, '2021-10-22 09:44:36', 1),
(335, '::1', 'nanang.kriscandono@astra-visteon.com', 'Avi123!', 65, '2021-10-22 10:28:06', 1),
(336, '::1', 'ade.sarastiti@astra-visteon.com', 'Avi123!', 39, '2021-10-22 13:06:12', 1),
(337, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-10-25 07:40:24', 1),
(338, '::1', 'ade.sarastiti@astra-visteon.com', 'Avi123!', 39, '2021-10-25 08:10:20', 1),
(339, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-10-26 07:43:07', 1),
(340, '::1', 'juang@astra-visteon.com', 'Avi123!', 1, '2021-10-26 09:14:56', 1),
(341, '::1', 'juang@astra-visteon.com', 'Avi123!', 1, '2021-10-26 13:39:21', 1),
(342, '::1', 'reza.andriady@astra-visteon.com', 'Avi123!', 22, '2021-10-26 13:54:13', 1),
(343, '::1', 'juang@astra-visteon.com', 'Avi123!', 1, '2021-10-27 08:06:12', 1),
(344, '10.14.83.26', 'ian.aliansyah@astra-visteon.com', 'Avi123!', 36, '2021-10-27 08:28:42', 1),
(345, '10.14.82.184', 'sallim.fauzy@astra-visteon.com', 'Komponen42', NULL, '2021-10-27 10:28:28', 0),
(346, '10.14.82.184', 'sallim.fauzy@astra-visteon.com', 'Avi123!', 38, '2021-10-27 10:30:11', 1),
(347, '10.14.82.184', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-10-27 11:32:16', 1),
(348, '10.14.82.184', 'sallim.fauzy@astra-visteon.com', 'Avi123!', 38, '2021-10-27 11:36:12', 1),
(349, '10.14.82.184', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-10-27 11:43:56', 1),
(350, '::1', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-10-27 12:14:04', 1),
(351, '::1', 'dhaniar.bayu@astra-visteon.com', 'Avi123!', 37, '2021-10-27 13:52:44', 1),
(352, '::1', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-10-27 15:46:41', 1),
(353, '::1', 'sallim.fauzy@astra-visteon.com', 'Avi123!', 38, '2021-10-27 15:53:47', 1),
(354, '::1', 'ian.aliansyah@astra-visteon.com', 'Avi123!', 36, '2021-10-27 16:14:26', 1),
(355, '::1', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-10-27 16:32:44', 1),
(356, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-10-28 07:37:00', 1),
(357, '::1', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-10-28 07:54:57', 1),
(358, '::1', 'fajri.ramadhan@astra-visteon.com', 'Avi123!', 77, '2021-10-28 10:24:02', 1),
(359, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-10-28 13:29:54', 1),
(360, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-10-28 13:41:32', 1),
(361, '::1', 'juang@astra-visteon.com', 'Avi123', NULL, '2021-10-28 13:44:31', 0),
(362, '::1', 'juang@astra-visteon.com', 'Avi123!', 1, '2021-10-28 13:44:38', 1),
(363, '::1', 'juang@astra-visteon.com', 'Avi123!', 1, '2021-10-28 13:44:38', 1),
(364, '10.14.82.184', 'sallim.fauzy@astra-visteon.com', 'Avi123!', 38, '2021-10-28 13:55:22', 1),
(365, '::1', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-10-28 14:51:34', 1),
(366, '::1', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-10-28 15:38:08', 1),
(367, '::1', 'dhaniar.bayu@astra-visteon.com', 'Avi123!', 37, '2021-10-29 07:42:07', 1),
(368, '::1', 'dhaniar.bayu@astra-visteon.com', 'Avi123!', 37, '2021-10-29 07:42:57', 1),
(369, '::1', 'admin@astra-visteon.com', 'Avi123!', 1, '2021-11-01 07:39:44', 1),
(370, '::1', 'ade.sarastiti@astra-visteon.com', 'Avi123!', 39, '2021-11-01 09:29:34', 1),
(371, '::1', 'ade.sarastiti@astra-visteon.com', 'Avi123!', 39, '2021-11-01 13:50:50', 1),
(372, '::1', 'juang@astra-visteon.com', 'Avi123!', NULL, '2021-11-02 07:45:09', 0),
(373, '::1', 'admin@astra-visteon.com', 'Avi123!', 1, '2021-11-02 07:45:17', 1),
(374, '::1', 'ade.sarastiti@astra-visteon.com', 'Avi123!', 39, '2021-11-02 08:09:45', 1),
(375, '::1', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-11-02 08:27:43', 1),
(376, '::1', 'reza.andriady@astra-visteon.com', 'Avi123!', 22, '2021-11-02 11:27:51', 1),
(377, '::1', 'admin@astra-visteon.com', 'Ai123!', NULL, '2021-11-02 15:53:07', 0),
(378, '::1', 'admin@astra-visteon.com', 'Avi123!', 1, '2021-11-02 15:53:16', 1),
(379, '::1', 'admin@astra-visteon.com', 'Avi123!', 1, '2021-11-03 07:45:27', 1),
(380, '::1', 'reza.andriady@astra-visteon.com', 'Avi123!', 22, '2021-11-03 07:50:29', 1),
(381, '::1', 'reza.andriady@astra-visteon.com', 'Avi123!', 22, '2021-11-03 07:52:21', 1),
(382, '::1', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-11-03 07:52:39', 1),
(383, '::1', 'sallim.fauzy@astra-visteon.com', 'Avi123!', 38, '2021-11-03 08:26:51', 1),
(384, '::1', 'ian.aliansyah@astra-visteon.com', 'Avi123!', 36, '2021-11-03 09:16:09', 1),
(385, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-11-03 12:39:14', 1),
(386, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-11-03 13:06:07', 1),
(387, '::1', 'ade.sarastiti@astra-visteon.com', 'Avi123!', 39, '2021-11-03 16:00:55', 1),
(388, '::1', 'ade.sarastiti@astra-visteon.com', 'Avi123!', 39, '2021-11-03 16:00:55', 1),
(389, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-11-04 07:39:19', 1),
(390, '::1', 'ade.sarastiti@astra-visteon.com', 'Avi123!', 39, '2021-11-04 10:39:06', 1),
(391, '::1', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-11-04 10:45:28', 1),
(392, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-11-04 14:59:57', 1),
(393, '::1', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-11-04 15:27:08', 1),
(394, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-11-04 15:50:10', 1),
(395, '::1', 'ade.sarastiti@astra-visteon.com', 'Avi123!', 39, '2021-11-04 16:24:18', 1),
(396, '::1', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-11-04 16:45:04', 1),
(397, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-11-04 17:00:41', 1),
(398, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-11-05 07:37:26', 1),
(399, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-11-05 09:34:09', 1),
(400, '::1', 'ade.sarastiti@astra-visteon.com', 'Avi123!', 39, '2021-11-05 09:45:34', 1),
(401, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-11-08 07:40:47', 1),
(402, '::1', 'ade.sarastiti@astra-visteon.com', 'Avi123!', 39, '2021-11-08 07:42:21', 1),
(403, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-11-09 07:45:07', 1),
(404, '::1', 'ade.sarastiti@astra-visteon.com', 'Avi123!', 39, '2021-11-09 10:46:17', 1),
(405, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-11-09 15:56:30', 1),
(406, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-11-09 15:56:31', 1),
(407, '::1', 'ade.sarastiti@astra-visteon.com', 'Avi123!', 39, '2021-11-10 07:46:34', 1),
(408, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123#', NULL, '2021-11-10 09:56:39', 0),
(409, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123#', NULL, '2021-11-10 09:56:44', 0),
(410, '::1', 'amirudin.suryo@astra-visteon.comA', 'Avi123!', NULL, '2021-11-10 09:56:55', 0),
(411, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-11-10 09:57:14', 1),
(412, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-11-11 08:52:22', 1),
(413, '::1', 'dhaniar.bayu@astra-visteon.com', 'Avi123!', 37, '2021-11-11 11:45:56', 1),
(414, '::1', 'admin@astra-visteon.com', 'Avi123!', 1, '2021-11-11 13:54:39', 1),
(415, '10.14.82.163', 'admin@astra-visteon.com', 'Avi123!', 1, '2021-11-11 14:21:55', 1),
(416, '10.14.82.151', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-11-11 14:27:03', 1),
(417, '10.14.82.151', 'dhaniar.bayu@astra-visteon.com', 'Avi123*', NULL, '2021-11-11 14:48:15', 0),
(418, '10.14.82.151', 'dhaniar.bayu@astra-visteon.com', 'Avi123!', 37, '2021-11-11 14:48:42', 1),
(419, '10.14.82.151', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-11-11 15:01:01', 1),
(420, '10.14.82.163', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-11-11 15:37:18', 1),
(421, '10.14.82.163', 'ade.sarastiti@astra-visteon.com', 'Avi123!', 39, '2021-11-11 15:37:39', 1),
(422, '10.14.83.26', 'ian.aliansyah@astra-visteon.com', 'Avi123!', 36, '2021-11-11 16:13:14', 1),
(423, '10.14.82.163', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-11-11 16:13:15', 1),
(424, '10.14.82.184', 'sallim.fauzy@astra-visteon.com', 'Avi123!', 38, '2021-11-11 16:14:42', 1),
(425, '10.14.82.163', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-11-12 08:00:39', 1),
(426, '10.14.82.163', 'admin@astra-visteon.com', 'Avi123!', 1, '2021-11-12 11:01:59', 1),
(427, '10.14.82.163', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-11-12 11:09:55', 1),
(428, '10.14.82.163', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-11-15 07:49:57', 1),
(429, '10.14.82.34', 'admin@astra-visteon.com', 'Avi123!', 1, '2021-11-15 09:57:11', 1),
(430, '10.14.82.163', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-11-15 11:15:52', 1),
(431, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi1223!', NULL, '2021-11-15 11:36:18', 0),
(432, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-11-15 11:36:23', 1),
(433, '::1', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-11-15 11:36:36', 1),
(434, '::1', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-11-15 13:46:53', 1),
(435, '10.14.82.163', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-11-15 14:26:54', 1),
(436, '10.14.82.184', 'sallim.fauzy@astra-visteon.com', 'Avi123!', 38, '2021-11-15 16:19:00', 1),
(437, '10.14.82.151', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-11-15 17:12:43', 1),
(438, '10.14.82.163', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-11-16 07:49:14', 1),
(439, '10.14.82.151', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-11-16 08:27:27', 1),
(440, '10.14.82.163', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-11-16 10:46:01', 1),
(441, '10.14.82.151', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-11-16 11:21:00', 1),
(442, '10.14.82.184', 'sallim.fauzy@astra-visteon.com', 'Avi123!', 38, '2021-11-16 13:37:49', 1),
(443, '10.14.82.151', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-11-16 18:05:43', 1),
(444, '10.14.82.163', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-11-17 07:37:49', 1),
(445, '10.14.82.151', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-11-17 08:20:23', 1),
(446, '10.14.82.184', 'sallim.fauzy@astra-visteon.com', 'Avi123!', 38, '2021-11-17 09:27:43', 1),
(447, '10.14.82.163', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-11-17 09:45:02', 1),
(448, '10.14.83.26', 'ian.aliansyah@astra-visteon.com', 'Avi123!', 36, '2021-11-17 11:03:58', 1),
(449, '10.14.82.154', 'zharfan.firas@astra-visteon.com', '562AVI##', NULL, '2021-11-17 12:00:17', 0),
(450, '10.14.82.154', 'zharfan.firas@astra-visteon.com', 'L430lenovo', NULL, '2021-11-17 12:00:25', 0),
(451, '10.14.82.154', 'zharfan.firas@astra-visteon.com', 'h@Hm^5k2', NULL, '2021-11-17 12:00:45', 0),
(452, '10.14.82.154', 'zharfan.firas@astra-visteon.com', 'Avi123!', 41, '2021-11-17 12:01:44', 1),
(453, '10.14.82.163', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-11-17 13:24:39', 1),
(454, '10.14.83.26', 'ian.aliansyah@astra-visteon.com', 'Avi123!', 36, '2021-11-17 16:08:19', 1),
(455, '10.14.82.184', 'sallim.fauzy@astra-visteon.com', 'Avi123!', 38, '2021-11-17 17:15:36', 1),
(456, '10.14.82.155', 'jemy.akvianto@astra-visteon.com', 'Avi123!', 40, '2021-11-17 17:21:09', 1),
(457, '10.14.82.34', 'sallim.fauzy@astra-visteon.com', 'Avi123!', 38, '2021-11-18 07:57:48', 1),
(458, '10.14.82.151', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-11-18 08:26:04', 1),
(459, '10.14.82.34', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-11-18 09:14:14', 1),
(460, '10.14.82.171', 'rizky.harnaningrum@astra-visteon.com', 'Avi123!', 33, '2021-11-18 09:54:09', 1),
(461, '10.14.82.170', 'awang.andika@astra-visteon.com', 'Avi123!', NULL, '2021-11-18 09:54:57', 0),
(462, '10.14.82.170', 'awang.dwi@astra-visteon.com', 'Avi123!', NULL, '2021-11-18 09:55:11', 0),
(463, '10.14.82.170', 'awang.andika@astra-visteon.com', 'Avl123!', NULL, '2021-11-18 09:56:11', 0),
(464, '10.14.82.170', 'awang.andika@astra-visteon.com', 'AvI123!', NULL, '2021-11-18 09:56:23', 0),
(465, '10.14.82.170', 'awang.andika@astra-visteon.com', 'Avi123!', NULL, '2021-11-18 09:56:39', 0),
(466, '10.14.82.151', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-11-18 13:19:48', 1),
(467, '10.14.82.152', 'reza.andriady@astra-visteon.com', 'Avi123!', 22, '2021-11-18 13:33:27', 1),
(468, '10.14.82.184', 'sallim.fauzy@astra-visteon.com', 'Avi123!', 38, '2021-11-18 13:36:12', 1),
(469, '10.14.82.163', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-11-18 16:29:55', 1),
(470, '10.14.82.151', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-11-18 17:25:59', 1),
(471, '10.14.82.151', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-11-18 19:52:20', 1),
(472, '10.14.82.34', 'admin@astra-visteon.com', 'Avi123!', 1, '2021-11-19 07:45:59', 1),
(473, '10.14.82.34', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-11-19 07:46:55', 1),
(474, '10.14.82.34', 'admin@astra-visteon.com', 'Avi123!', 1, '2021-11-19 07:47:35', 1),
(475, '10.14.82.34', 'reza.andriady@astra-visteon.com', 'Avi123!', 22, '2021-11-19 07:48:27', 1),
(476, '10.14.83.26', 'ian.aliansyah@astra-visteon.com', 'Avi123!', 36, '2021-11-19 13:07:06', 1),
(477, '10.14.83.26', 'ian.aliansyah@astra-visteon.com', 'avis03!', 36, '2021-11-19 13:23:26', 1),
(478, '10.14.82.34', 'admin@astra-visteon.com', 'Avi123!', 1, '2021-11-19 13:53:28', 1),
(479, '10.14.82.34', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-11-19 13:53:48', 1),
(480, '10.14.82.163', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-11-19 14:00:12', 1),
(481, '10.14.82.163', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-11-19 14:38:33', 1),
(482, '10.14.82.163', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-11-19 14:49:30', 1),
(483, '10.14.82.163', 'destya.wijayanti@astra-visteon.com', 'Avi123!', 78, '2021-11-19 14:57:08', 1),
(484, '10.14.82.163', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-11-19 14:59:40', 1),
(485, '10.14.82.163', 'sallim.fauzy@astra-visteon.com', 'Avi123!', 38, '2021-11-19 15:00:33', 1),
(486, '10.14.82.34', 'admin@astra-visteon.com', 'Avi123!', 1, '2021-11-19 15:41:28', 1),
(487, '10.14.82.151', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-11-21 14:43:58', 1),
(488, '10.14.232.16', 'bayu.putra@astra-visteon.com', 'Avi123!', 25, '2021-11-22 00:16:19', 1),
(489, '10.14.82.34', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-11-22 07:53:04', 1),
(490, '10.14.82.152', 'reza.andriady@astra-visteon.com', 'Avi123!', 22, '2021-11-22 08:10:28', 1),
(491, '10.14.82.184', 'sallim.fauzy@astra-visteon.com', 'Avi123!', 38, '2021-11-22 08:12:14', 1),
(492, '10.14.82.34', 'admin@astra-visteon.com', 'Avi123!', 1, '2021-11-22 09:08:08', 1),
(493, '10.14.82.34', 'admin@astra-visteon.com', 'Avi123!', 1, '2021-11-22 10:02:33', 1),
(494, '10.14.82.34', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-11-22 13:37:27', 1),
(495, '10.14.83.26', 'ian.aliansyah@astra-visteon.com', 'Avi123!', NULL, '2021-11-22 13:42:12', 0),
(496, '10.14.83.26', 'ian.aliansyah@astra-visteon.com', 'perm$ta8avis', NULL, '2021-11-22 13:42:26', 0),
(497, '10.14.83.26', 'ian.aliansyah@astra-visteon.com', 'Avi123!', NULL, '2021-11-22 13:45:28', 0),
(498, '10.14.82.184', 'sallim.fauzy@astra-visteon.com', 'Avi123!', 38, '2021-11-22 14:02:06', 1),
(499, '10.14.83.26', 'ian.aliansyah@astra-visteon.com', 'Perm$ta8avis', NULL, '2021-11-22 14:12:45', 0),
(500, '10.14.83.26', 'ian.aliansyah@astra-visteon.com', 'Avi123!', NULL, '2021-11-22 14:13:05', 0),
(501, '10.14.83.26', 'ian.aliansyah@astra-visteon.com', 'Avi123!', NULL, '2021-11-22 14:14:06', 0),
(502, '10.14.83.26', 'ian.aliansyah@astra-visteon.com', 'perm$ta8avis', NULL, '2021-11-22 14:14:17', 0),
(503, '10.14.83.26', 'ian.aliansyah@astra-visteon.com', 'perm$ta8avis', NULL, '2021-11-22 14:14:32', 0),
(504, '10.14.83.26', 'ian.aliansyah@astra-visteon.com', 'perm$ta8', NULL, '2021-11-22 14:17:31', 0),
(505, '10.14.83.26', 'ian.aliansyah@astra-visteon.com', 'perm$ta8avi', NULL, '2021-11-22 14:17:39', 0),
(506, '10.14.83.26', 'ian.aliansyah@astra-visteon.com', 'perm$ta8avis', NULL, '2021-11-22 14:17:48', 0),
(507, '10.14.83.26', 'ian.aliansyah@astra-visteon.com', 'Perm$ta8avis', NULL, '2021-11-22 14:19:01', 0),
(508, '10.14.83.26', 'ian.aliansyah@astra-visteon.com', 'Bali2024#', NULL, '2021-11-22 14:55:31', 0),
(509, '10.14.82.152', 'reza.andriady@astra-visteon.com', 'Avi123!', 22, '2021-11-22 14:57:08', 1),
(510, '10.14.82.184', 'sallim.fauzy@astra-visteon.com', 'Avi123!', 38, '2021-11-23 08:54:23', 1),
(511, '10.14.82.163', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-11-23 08:57:39', 1),
(512, '10.14.82.163', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-11-23 09:28:33', 1),
(513, '10.14.82.151', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-11-23 11:15:49', 1),
(514, '10.14.82.154', 'zharfan.firas@astra-visteon.com', 'AVI123!', NULL, '2021-11-23 11:25:28', 0),
(515, '10.14.82.154', 'zharfan.firas@astra-visteon.com', 'Avi123!', 41, '2021-11-23 11:25:37', 1),
(516, '10.14.82.34', 'admin@astra-visteon.com', 'Avi123!', 1, '2021-11-23 13:03:05', 1),
(517, '10.14.82.159', 'nasirudin@astra-visteon.com', 'Avi123!', 24, '2021-11-23 13:41:54', 1),
(518, '10.14.83.26', 'ian.aliansyah@astra-visteon.com', 'Avi123!', NULL, '2021-11-23 14:12:38', 0),
(519, '10.14.83.26', 'ian.aliansyah@astra-visteon.com', 'aVI123!', NULL, '2021-11-23 14:14:04', 0),
(520, '10.14.83.26', 'ian.aliansyah@astra-visteon.com', 'Avi123!', NULL, '2021-11-23 14:16:39', 0),
(521, '10.14.83.26', 'ian.aliansyah@astra-visteon.com', 'Avi123!', NULL, '2021-11-23 14:16:47', 0),
(522, '10.14.82.153', 'ian.aliansyah@astra-visteon.com', 'Avi123!', 36, '2021-11-23 14:24:54', 1),
(523, '10.14.83.26', 'ian.aliansyah@astra-visteon.com', 'Avi123!', 36, '2021-11-23 14:26:06', 1),
(524, '10.14.82.34', 'admin@astra-visteon.com', 'Avi123!', 1, '2021-11-23 16:03:45', 1),
(525, '10.14.82.34', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-11-23 16:21:24', 1),
(526, '10.14.82.151', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-11-23 20:13:32', 1),
(527, '10.14.82.154', 'zharfan.firas@astra-visteon.com', 'Avi123!', 41, '2021-11-24 08:28:30', 1),
(528, '10.14.83.26', 'ian.aliansyah@astra-visteon.com', 'Avi123!', 36, '2021-11-24 09:19:07', 1),
(529, '10.14.82.152', 'reza.andriady@astra-visteon.com', 'Avi123!', 22, '2021-11-24 11:13:20', 1),
(530, '10.14.82.34', 'admin@astra-visteon.com', 'Avi123!', 1, '2021-11-24 14:16:29', 1),
(531, '10.14.82.152', 'reza.andriady@astra-visteon.com', 'Avi123!', 22, '2021-11-25 08:00:27', 1),
(532, '10.14.82.153', 'admin@astra-visteon.com', 'Avi123!', 1, '2021-11-25 09:12:47', 1),
(533, '10.14.82.34', 'admin@astra-visteon.com', 'Avi123!', 1, '2021-11-25 13:32:57', 1),
(534, '10.14.82.34', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-11-25 13:33:19', 1),
(535, '10.14.82.206', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-11-26 09:18:37', 1),
(536, '10.14.83.26', 'ian.aliansyah@astra-visteon.com', 'Avi1231!', NULL, '2021-11-26 09:58:49', 0),
(537, '10.14.83.26', 'ian.aliansyah@astra-visteon.com', 'Avi123!', 36, '2021-11-26 09:58:54', 1),
(538, '10.14.82.152', 'reza.andriady@astra-visteon.com', 'Avi123!', 22, '2021-11-26 09:59:18', 1),
(539, '10.14.82.184', 'sallim.fauzy@astra-visteon.com', 'Avi123!', 38, '2021-11-26 10:42:28', 1),
(540, '10.14.82.184', 'sallim.fauzy@astra-visteon.com', 'Avi123!', 38, '2021-11-26 14:55:54', 1),
(541, '10.14.82.154', 'zharfan.firas@astra-visteon.com', 'Avi123!', 41, '2021-11-26 15:08:56', 1),
(542, '10.14.82.206', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-11-29 08:27:14', 1),
(543, '10.14.83.26', 'ian.aliansyah@astra-visteon.com', 'Avi123!', 36, '2021-11-29 13:06:50', 1),
(544, '10.14.82.34', 'admin@astra-visteon.com', 'Avi123!', 1, '2021-11-30 11:20:01', 1),
(545, '10.14.82.206', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-11-30 11:49:57', 1),
(546, '10.14.82.34', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-11-30 12:25:08', 1),
(547, '10.14.82.170', 'awang.andika@astra-visteon.com', 'Avi123!', NULL, '2021-11-30 13:36:22', 0),
(548, '10.14.82.170', 'awang.andika@astra-visteon.com', 'Avi123!', NULL, '2021-11-30 13:37:13', 0),
(549, '10.14.82.34', 'awang.andhika@astra-visteon.com', 'Avi123!', 76, '2021-11-30 13:37:30', 1),
(550, '10.14.82.170', 'awang.andika@astra-visteon.com', 'Avi123!', NULL, '2021-11-30 13:37:43', 0),
(551, '10.14.82.170', 'awang.andika@astra-visteon.com', 'Avi123!', NULL, '2021-11-30 13:38:00', 0),
(552, '10.14.82.170', 'awang.andhika@astra-visteon.com', 'Avi123!', 76, '2021-11-30 13:38:50', 1),
(553, '10.14.82.34', 'awang.andika@astra-visteon.com', 'Avi123!', 76, '2021-11-30 14:06:32', 1),
(554, '10.14.82.34', 'admin@astra-visteon.com', 'Avi123!', 1, '2021-11-30 14:07:27', 1),
(555, '10.14.82.206', 'arif.setiawan@astra-visteon.com', 'Avi123!', 74, '2021-11-30 14:26:11', 1),
(556, '10.14.83.26', 'ian.aliansyah@astra-visteon.com', 'Avi123!', 36, '2021-12-01 08:18:50', 1),
(557, '10.14.82.34', 'admin@astra-visteon.com', 'Avi123!', 1, '2021-12-02 07:50:46', 1);
INSERT INTO `auth_logins` (`id`, `ip_address`, `email`, `pass`, `user_id`, `date`, `success`) VALUES
(558, '10.14.83.26', 'ian.aliansyah@astra-visteon.com', 'Avi123!', 36, '2021-12-02 08:23:57', 1),
(559, '10.14.82.34', 'admin@astra-visteon.com', 'Avi123!', 1, '2021-12-02 09:24:45', 1),
(560, '10.14.82.34', 'admin@astra-visteon.com', 'Avi123!', 1, '2021-12-02 13:25:42', 1),
(561, '10.14.82.34', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-12-02 15:34:21', 1),
(562, '10.14.83.26', 'ian.aliansyah@astra-visteon.com', 'Avi123!', 36, '2021-12-02 15:38:52', 1),
(563, '10.14.82.34', 'admin@astra-visteon.com', 'Avi123!', 1, '2021-12-03 09:55:54', 1),
(564, '10.14.82.34', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-12-03 09:56:31', 1),
(565, '10.14.82.34', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-12-03 09:58:53', 1),
(566, '10.14.82.34', 'admin@astra-visteon.com', 'Avi123!', 1, '2021-12-03 10:02:26', 1),
(567, '10.14.82.34', 'admin@astra-visteon.com', 'Avi123!', 1, '2021-12-03 12:57:38', 1),
(568, '10.14.82.206', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-12-03 19:04:20', 1),
(569, '10.14.82.206', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-12-06 19:08:24', 1),
(570, '10.14.82.34', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-12-07 08:32:42', 1),
(571, '10.14.82.206', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-12-07 13:24:58', 1),
(572, '10.14.83.26', 'ian.aliansyah@astra-visteon.com', 'Avi123!', 36, '2021-12-07 13:38:10', 1),
(573, '10.14.82.34', 'admin@astra-visteon.com', 'Avi123!', 1, '2021-12-09 08:06:06', 1),
(574, '10.14.82.34', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-12-09 10:51:58', 1),
(575, '10.14.82.34', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-12-09 10:52:55', 1),
(576, '10.14.82.34', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-12-09 11:04:19', 1),
(577, '10.14.82.184', 'sallim.fauzy@astra-visteon.com', 'Avi123!', 38, '2021-12-09 12:21:30', 1),
(578, '10.14.82.153', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-12-09 14:49:42', 1),
(579, '10.14.82.153', 'admin@astra-visteon.com', 'Avi123!', 1, '2021-12-09 16:02:46', 1),
(580, '10.14.82.184', 'sallim.fauzy@astra-visteon.com', 'Avi123!', 38, '2021-12-09 16:06:16', 1),
(581, '10.14.82.153', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-12-09 16:09:08', 1),
(582, '10.14.82.34', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-12-10 09:38:15', 1),
(583, '10.14.82.34', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-12-10 09:38:42', 1),
(584, '10.14.82.184', 'sallim.fauzy@astra-visteon.com', 'Avi123!', 38, '2021-12-10 11:31:11', 1),
(585, '10.14.82.34', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-12-13 07:51:30', 1),
(586, '10.14.82.184', 'sallim.fauzy@astra-visteon.com', 'Avi123!', 38, '2021-12-13 08:44:37', 1),
(587, '10.14.82.184', 'sallim.fauzy@astra-visteon.com', 'Avi123!', 38, '2021-12-13 11:48:20', 1),
(588, '10.14.82.170', 'awang.andika@astra-visteon.com', 'Avi123!', 76, '2021-12-14 13:34:51', 1),
(589, '10.14.82.206', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-12-14 13:35:29', 1),
(590, '10.14.82.159', 'nasirudin@astra-visteon.com', 'Avi123!', 24, '2021-12-14 13:37:57', 1),
(591, '10.14.83.26', 'ian.aliansyah@astra-visteon.com', 'Avi123!', 36, '2021-12-14 13:44:11', 1),
(592, '10.14.82.163', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-12-15 07:58:23', 1),
(593, '10.14.82.163', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-12-15 08:04:34', 1),
(594, '10.14.82.159', 'nasirudin@astra-visteon.com', 'Avi123!', 24, '2021-12-15 09:28:21', 1),
(595, '10.14.82.206', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-12-15 15:26:27', 1),
(596, '10.14.83.26', 'ian.aliansyah@astra-visteon.com', 'Avi123!', 36, '2021-12-15 15:28:54', 1),
(597, '10.14.82.163', 'admin@astra-visteon.com', 'Avi123!', 1, '2021-12-16 07:59:01', 1),
(598, '10.14.82.206', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-12-16 11:13:52', 1),
(599, '10.14.82.34', 'ade.sarastiti@astra-visteon.com', 'Avi123!', 39, '2021-12-16 14:46:02', 1),
(600, '10.14.82.153', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-12-16 14:57:32', 1),
(601, '10.14.82.153', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-12-16 14:58:18', 1),
(602, '10.14.82.170', 'awang.andika@astra-visteon.com', 'Avi123!', 76, '2021-12-16 16:19:37', 1),
(603, '10.14.82.206', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-12-16 16:31:17', 1),
(604, '10.14.83.26', 'ian.aliansyah@astra-visteon.com', 'Avi123!', 36, '2021-12-16 16:42:47', 1),
(605, '10.14.82.163', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-12-17 07:50:10', 1),
(606, '10.14.82.163', 'reza.andriady@astra-visteon.com', 'Avi123!', 22, '2021-12-17 08:25:23', 1),
(607, '10.14.82.206', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-12-17 10:01:40', 1),
(608, '10.14.82.206', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-12-17 13:22:59', 1),
(609, '10.14.82.34', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-12-20 09:45:17', 1),
(610, '10.14.82.206', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-12-21 13:32:31', 1),
(611, '10.14.82.170', 'awang.andika@astra-visteon.com', 'Avi123!', 76, '2021-12-21 13:34:02', 1),
(612, '10.14.82.153', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-12-22 11:09:30', 1),
(613, '10.14.82.152', 'reza.andriady@astra-visteon.com', 'Avi123!', 22, '2021-12-22 14:43:41', 1),
(614, '10.14.82.34', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2021-12-23 15:58:23', 1),
(615, '10.14.82.34', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2021-12-23 15:58:57', 1),
(616, '10.14.82.34', 'admin@astra-visteon.com', 'Avi123!', 1, '2022-01-03 11:43:02', 1),
(617, '10.14.82.34', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2022-01-03 11:45:08', 1),
(618, '10.14.82.34', 'amirudin.suryo@astra-visteon.com', 'Avi123!', 12, '2022-01-03 11:46:13', 1),
(619, '10.14.83.26', 'ian.aliansyah@astra-visteon.com', 'Avi123!', 36, '2022-01-03 13:47:55', 1),
(620, '10.14.82.34', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2022-01-03 14:20:15', 1),
(621, '10.14.83.26', 'ian.aliansyah@astra-visteon.com', 'Avi123!', 36, '2022-01-10 10:13:13', 1),
(622, '10.14.81.14', 'juang@astra-visteon.com', 'Avi123!', NULL, '2022-02-03 11:03:46', 0),
(623, '10.14.81.14', 'juang@astra-visteon.com', 'Avi123!', NULL, '2022-02-03 11:04:00', 0),
(624, '10.14.82.34', 'admin@astra-visteon.com', 'Avi123!', 1, '2022-02-03 11:30:40', 1),
(625, '10.14.232.211', 'sallim.fauzy@astra-visteon.com', 'Avi123!', 38, '2022-02-18 16:38:47', 1),
(626, '10.14.82.152', 'admin@visteon.com', 'Avi123!', NULL, '2022-02-19 07:57:10', 0),
(627, '10.14.82.152', 'admin@visteon.com', 'Avi123!', NULL, '2022-02-19 07:57:17', 0),
(628, '10.14.82.152', 'reza.andriady@astra-visteon.com', 'Avi123!', 22, '2022-02-19 07:58:18', 1),
(629, '10.14.83.26', 'ian.aliansyah@astra-visteon.com', 'Avi123!', 36, '2022-02-19 13:23:57', 1),
(630, '10.14.81.14', 'juang@astra-visteon.com', 'Avi1 23!', NULL, '2022-03-08 08:09:21', 0),
(631, '10.14.81.14', 'admin@astra-visteon.com', 'Avi123!', 1, '2022-03-08 08:10:19', 1),
(632, '10.14.82.34', 'admin@astra-visteon.com', 'Avi123!', 1, '2022-03-18 13:27:35', 1),
(633, '10.14.82.153', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2022-03-18 13:49:34', 1),
(634, '10.14.82.153', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2022-04-12 11:15:49', 1),
(635, '10.14.82.184', 'sallim.fauzy@astra-visteon.com', 'Avi123!', 38, '2022-04-12 11:15:52', 1),
(636, '10.14.82.184', 'sallim.fauzy@astra-visteon.com', 'Avi123!', 38, '2022-05-17 13:57:22', 1),
(637, '10.14.82.34', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2022-05-18 08:43:37', 1),
(638, '10.14.82.184', 'sallim.fauzy@astra-visteon.com', 'Avi123!', 38, '2022-05-18 09:01:25', 1),
(639, '10.14.82.152', 'bimo.prakoso@astra-visteon.com', 'Avi123!', 28, '2022-05-18 13:55:11', 1),
(640, '10.14.82.184', 'sallim.fauzy@astra-visteon.com', 'Avi123!', 38, '2022-05-19 08:50:05', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_permissions`
--

CREATE TABLE `auth_permissions` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `auth_permissions`
--

INSERT INTO `auth_permissions` (`id`, `name`, `description`) VALUES
(1, 'manage-users', 'Manage All Users'),
(2, 'manage-profile', 'Manage user profile');

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_reset_attempts`
--

CREATE TABLE `auth_reset_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_tokens`
--

CREATE TABLE `auth_tokens` (
  `id` int(11) UNSIGNED NOT NULL,
  `selector` varchar(255) NOT NULL,
  `hashedValidator` varchar(255) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `expires` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_users_permissions`
--

CREATE TABLE `auth_users_permissions` (
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `avqs`
--

CREATE TABLE `avqs` (
  `id` int(11) NOT NULL,
  `avqs_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `avqs`
--

INSERT INTO `avqs` (`id`, `avqs_name`) VALUES
(1, 'Policy'),
(2, 'Procedure'),
(3, 'WI-Checklist-Form'),
(4, 'Record Data');

-- --------------------------------------------------------

--
-- Struktur dari tabel `avqs_dir1`
--

CREATE TABLE `avqs_dir1` (
  `id` int(11) NOT NULL,
  `avqs_id` int(11) NOT NULL,
  `dir` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `avqs_dir1`
--

INSERT INTO `avqs_dir1` (`id`, `avqs_id`, `dir`) VALUES
(7, 1, 'Policy Dir 1'),
(9, 2, 'Procedure 1'),
(14, 1, 'Policy Folder 2'),
(15, 3, 'New Folder 1'),
(16, 1, 'Policy Folder 1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `avqs_dir2`
--

CREATE TABLE `avqs_dir2` (
  `id` int(11) NOT NULL,
  `avqs_id` int(11) NOT NULL,
  `dir1_id` int(11) NOT NULL,
  `dir` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `avqs_dir2`
--

INSERT INTO `avqs_dir2` (`id`, `avqs_id`, `dir1_id`, `dir`) VALUES
(2, 1, 7, 'Folder 2'),
(6, 3, 15, 'New Folder 1'),
(7, 1, 7, 'Folder 1'),
(8, 1, 14, 'Dir 2 Policy');

-- --------------------------------------------------------

--
-- Struktur dari tabel `avqs_file`
--

CREATE TABLE `avqs_file` (
  `id` int(11) NOT NULL,
  `avqs_id` int(11) NOT NULL,
  `dir1_id` int(11) NOT NULL,
  `dir2_id` int(11) NOT NULL,
  `file` varchar(255) NOT NULL,
  `upload_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `avqs_file`
--

INSERT INTO `avqs_file` (`id`, `avqs_id`, `dir1_id`, `dir2_id`, `file`, `upload_at`) VALUES
(2, 1, 7, 2, 'cstmrdrawing.xlsx', '2021-10-07'),
(5, 1, 7, 2, 'dummies.pdf', '2021-10-07'),
(6, 1, 7, 2, 'dummiessss.pdf', '2021-10-07'),
(7, 1, 7, 7, 'equippointer.pdf', '2021-10-12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `baan_approval`
--

CREATE TABLE `baan_approval` (
  `id` int(11) NOT NULL,
  `id_baan` int(11) NOT NULL,
  `user_approval` int(11) UNSIGNED NOT NULL,
  `routes` int(11) NOT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `approve` int(11) NOT NULL,
  `approve_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `baan_approval`
--

INSERT INTO `baan_approval` (`id`, `id_baan`, `user_approval`, `routes`, `notes`, `approve`, `approve_status`) VALUES
(10, 2, 78, 1, 'Nice!', 1, 202);

-- --------------------------------------------------------

--
-- Struktur dari tabel `baan_file`
--

CREATE TABLE `baan_file` (
  `id` int(11) NOT NULL,
  `id_model` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `upload_date` date NOT NULL,
  `approve` int(11) NOT NULL,
  `approve_status` int(11) DEFAULT NULL,
  `uploader` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `baan_file`
--

INSERT INTO `baan_file` (`id`, `id_model`, `type_id`, `filename`, `status`, `description`, `upload_date`, `approve`, `approve_status`, `uploader`) VALUES
(2, 1, 1, 'dummies (1).zip', 'active', 'desc non bom item', '2021-11-19', 2, 1, 28);

-- --------------------------------------------------------

--
-- Struktur dari tabel `baan_type`
--

CREATE TABLE `baan_type` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `baan_type`
--

INSERT INTO `baan_type` (`id`, `type`) VALUES
(1, '(NEW) Non BOM item'),
(2, '(NEW) BOM item'),
(3, '(NEW) Cost Item'),
(4, '(NEW) Inventory Non BOM item'),
(5, '(NEW) Inventory BOM item'),
(6, '(NEW) BOM - Routing'),
(7, '(UPDATE) POU'),
(8, '(UPDATE) LOC ID'),
(9, '(UPDATE) Warehouse BOM Item'),
(10, '(UPDATE) Warehouse Non BOM Item'),
(11, '(UPDATE) L/T Ordering'),
(12, '(UPDATE) Data Safety Time'),
(13, '(UPDATE) Minimum Stock (MOQ)'),
(14, '(UPDATE) SPQ / LOT'),
(15, '(UPDATE) Warehouse Sales'),
(16, '(UPDATE) Item data Warehouse'),
(17, '(UPDATE) Qty in BOM'),
(18, '(UPDATE) Add/Reduce Child Part'),
(19, '(UPDATE) Warehouse Consumed'),
(20, '(UPDATE) Work Centre'),
(21, '(UPDATE) Cycle Time'),
(22, '(UPDATE) Product Type'),
(23, '(UPDATE) Product Class'),
(24, '(UPDATE) Product  Line'),
(25, '(UPDATE) Search Key Non BOM Item'),
(26, '(UPDATE) Search Key BOM Item');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bom_approval`
--

CREATE TABLE `bom_approval` (
  `id` int(11) NOT NULL,
  `id_bom` int(11) NOT NULL,
  `user_approval` int(11) UNSIGNED NOT NULL,
  `routes` int(11) NOT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `approve` int(11) NOT NULL,
  `approve_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `bom_approval`
--

INSERT INTO `bom_approval` (`id`, `id_bom`, `user_approval`, `routes`, `notes`, `approve`, `approve_status`) VALUES
(5, 15, 38, 1, NULL, 202, 0),
(6, 15, 36, 2, NULL, 202, 0),
(7, 16, 38, 1, NULL, 202, 0),
(8, 16, 36, 2, NULL, 202, 0),
(9, 17, 38, 1, NULL, 202, 0),
(10, 17, 36, 2, NULL, 202, 0),
(11, 18, 38, 1, 'Oke', 202, 0),
(12, 18, 36, 2, 'Sipp', 202, 0),
(15, 20, 38, 1, 'Approve', 202, 0),
(16, 20, 36, 2, 'good', 202, 0),
(17, 21, 38, 1, 'new file approve', 202, 0),
(18, 21, 36, 2, 'new file last approve', 202, 0),
(19, 22, 38, 1, 'Checked OK.', 202, 0),
(20, 22, 36, 2, 'Approved.', 202, 0),
(21, 23, 38, 1, 'Checked OK', 202, 0),
(22, 23, 36, 2, 'Approved.', 202, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `bom_approval_status`
--

CREATE TABLE `bom_approval_status` (
  `id` int(11) NOT NULL,
  `id_bom` int(11) NOT NULL,
  `request_status` varchar(255) NOT NULL,
  `user_approval` int(11) UNSIGNED NOT NULL,
  `reason` varchar(25) NOT NULL,
  `approve` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `bom_approval_status`
--

INSERT INTO `bom_approval_status` (`id`, `id_bom`, `request_status`, `user_approval`, `reason`, `approve`) VALUES
(1, 3, 'inactive', 38, '', 202),
(2, 17, 'inactive', 38, '', 202),
(3, 3, 'active', 38, '', 202),
(4, 16, 'inactive', 38, '', 202),
(5, 16, 'active', 38, 'please active', 202);

-- --------------------------------------------------------

--
-- Struktur dari tabel `bom_file`
--

CREATE TABLE `bom_file` (
  `id` int(11) NOT NULL,
  `id_model` int(11) NOT NULL,
  `nama_file` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `notes` varchar(255) NOT NULL,
  `upload_date` date NOT NULL,
  `approve` int(11) NOT NULL,
  `approve_status` int(11) NOT NULL,
  `uploader` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `bom_file`
--

INSERT INTO `bom_file` (`id`, `id_model`, `nama_file`, `status`, `notes`, `upload_date`, `approve`, `approve_status`, `uploader`) VALUES
(2, 2, 'dummies (10).pdf', 'inactive', 'notes ex', '2021-09-03', 3, 1, 1),
(15, 3, 'dummies.pdf', 'active', 'Bom ready', '2021-09-17', 3, 1, 28),
(16, 1, 'dummiessss.pdf', 'active', 'Example Desc', '2021-09-23', 3, 1, 28),
(17, 1, 'dummiessss (1).pdf', 'inactive', 'Ex desc', '2021-10-07', 3, 1, 28),
(18, 1, 'equipspec.pdf', 'active', 'Cobaa', '2021-10-13', 3, 1, 28),
(20, 1, 'dummies.pdf', 'active', 'Please approve', '2021-10-27', 3, 1, 38),
(21, 1, 'dummies.zip', 'active', 'Bom 27-10-21', '2021-10-27', 3, 1, 28),
(22, 5, 'BOM_K2SA_PP_rev3.1_TI_Maxim.pdf', 'active', '-Add reference\r\n-Label Desc.', '2021-11-17', 3, 1, 41),
(23, 2, 'BOM_K2PJ_rev4.1.pdf', 'active', 'Terlampir BOM K2PJ rev 4.1 \r\nMohon untuk dikoreksi pak', '2021-11-17', 3, 1, 40);

-- --------------------------------------------------------

--
-- Struktur dari tabel `bom_log`
--

CREATE TABLE `bom_log` (
  `id` int(11) NOT NULL,
  `user` int(11) UNSIGNED NOT NULL,
  `model` int(11) NOT NULL,
  `file` varchar(255) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `bom_log`
--

INSERT INTO `bom_log` (`id`, `user`, `model`, `file`, `date`) VALUES
(1, 1, 1, 'example (4).xlsx', '2021-09-02 15:45:01'),
(2, 28, 1, 'dummies.pdf', '2021-09-17 16:05:13'),
(3, 38, 1, 'CCTC-VideoScripts.pdf', '2021-10-27 10:39:45'),
(5, 38, 5, 'BOM_K2SA_PP_rev3.1_TI_Maxim.pdf', '2021-11-26 14:56:17'),
(6, 41, 5, 'BOM_K2SA_PP_rev3.1_TI_Maxim.pdf', '2021-11-26 15:09:38'),
(7, 1, 1, 'dummies.pdf', '2021-12-03 13:05:18'),
(8, 38, 2, 'BOM_K2PJ_rev4.1.pdf', '2021-12-10 11:31:48'),
(9, 28, 1, 'dummiessss (1).pdf', '2022-05-18 09:01:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `budget`
--

CREATE TABLE `budget` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `total` float NOT NULL,
  `tooling` float NOT NULL,
  `used_tooling` float NOT NULL,
  `smt` float NOT NULL,
  `used_smt` float NOT NULL,
  `fa` float NOT NULL,
  `used_fa` float NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `budget`
--

INSERT INTO `budget` (`id`, `project_id`, `total`, `tooling`, `used_tooling`, `smt`, `used_smt`, `fa`, `used_fa`, `updated_at`) VALUES
(1, 2, 1000000000, 500000000, 200000000, 300000000, 200000000, 100000000, 50000000, '2021-11-04 08:51:03'),
(6, 7, 0, 0, 0, 0, 0, 0, 0, '2021-11-11 07:50:21'),
(7, 8, 0, 0, 0, 0, 0, 0, 0, '2021-11-11 07:52:03'),
(8, 9, 0, 0, 0, 0, 0, 0, 0, '2021-11-11 07:57:08'),
(9, 10, 0, 0, 0, 0, 0, 0, 0, '2021-11-11 07:58:35'),
(10, 11, 0, 0, 0, 0, 0, 0, 0, '2021-11-11 08:00:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `child_rio`
--

CREATE TABLE `child_rio` (
  `id` int(11) NOT NULL,
  `rio_id` int(11) NOT NULL,
  `rio` varchar(255) NOT NULL,
  `due_date` varchar(255) NOT NULL,
  `pic` int(11) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `closing_statement` varchar(255) DEFAULT NULL,
  `approve` int(11) NOT NULL,
  `file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `child_rio`
--

INSERT INTO `child_rio` (`id`, `rio_id`, `rio`, `due_date`, `pic`, `status`, `description`, `closing_statement`, `approve`, `file`) VALUES
(2, 10, 'make approval ', '2021-10-22', 24, 'In Progress', 'descc', NULL, 0, 'Yes');

-- --------------------------------------------------------

--
-- Struktur dari tabel `child_rio_approval`
--

CREATE TABLE `child_rio_approval` (
  `id` int(11) NOT NULL,
  `child_rio_id` int(11) NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `approve_user` int(11) UNSIGNED NOT NULL,
  `update_date` date NOT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `approve` int(11) NOT NULL,
  `updated` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `child_rio_approval`
--

INSERT INTO `child_rio_approval` (`id`, `child_rio_id`, `file`, `approve_user`, `update_date`, `notes`, `approve`, `updated`) VALUES
(2, 2, NULL, 30, '2021-10-21', NULL, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `child_task`
--

CREATE TABLE `child_task` (
  `id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `concern` varchar(255) NOT NULL,
  `due_date` date NOT NULL,
  `pic` int(11) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL,
  `namafile` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `approve` int(11) NOT NULL,
  `file` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `child_task`
--

INSERT INTO `child_task` (`id`, `task_id`, `concern`, `due_date`, `pic`, `status`, `namafile`, `description`, `approve`, `file`, `updated_at`) VALUES
(11, 21, 'PPAP Approval PWB TI', '2021-11-19', 30, 'In Progress', NULL, NULL, 1, 'Yes', '2021-11-16 04:27:19'),
(15, 21, 'TC Approval PWBA TI', '2021-11-19', 30, 'In Progress', NULL, NULL, 1, 'Yes', '2021-11-18 01:40:10'),
(16, 21, 'TC Approval PWB Maxim', '2021-11-19', 30, 'In Progress', NULL, NULL, 1, 'Yes', '2021-11-18 01:40:53'),
(17, 21, 'TC Approval Appliq', '2021-11-22', 30, 'In Progress', NULL, NULL, 1, 'Yes', '2021-11-18 01:42:13'),
(18, 21, 'TC Approval Appliq', '2021-11-22', 30, 'In Progress', NULL, NULL, 1, 'Yes', '2021-11-18 01:43:37'),
(21, 26, 'Leak Test ulang + Air Sabun', '2021-11-19', 25, 'Done', 'Re-leaktest NG cluster LT K2SA 12nov2021.xlsx', '2 pcs cluster (NG) after re-leak test, still under analyzed from PD AVI', 2, 'Yes', '2021-11-23 04:27:27'),
(22, 26, 'Snoop+Bongakar+Analisa', '2021-11-22', 41, 'Done', 'Analysis leaktest NG cluster LT K2SA 12nov2021.xlsx', 'Dari 2pcs hasil NG Leak Test, sample NG 1pcs terdeteksi kebocoran krn missing glue di knob SET, 1pcs lagi tidak terdeteksi kebocoran saat snoop, perlu ditest ulang menggunakan leak test dlm kondisi lens assy saja.', 2, 'Yes', '2021-11-24 01:42:56'),
(23, 27, 'Verifikasi New Parameter Glue', '2021-11-25', 39, 'In Progress', NULL, NULL, 1, 'Yes', '2021-11-18 02:36:11'),
(24, 41, 'FCT Inline ETD EIIT Spain 26 Nov', '2021-11-26', 27, 'In Progress', NULL, NULL, 1, 'No', '2021-11-21 08:52:04'),
(25, 41, 'FCT Inline ETA AVI', '2021-12-06', 33, 'In Progress', NULL, NULL, 1, 'No', '2021-11-21 08:53:22'),
(26, 41, 'Engineering trial FCT Inline', '2021-12-07', 27, 'In Progress', NULL, NULL, 1, 'Yes', '2021-11-21 08:54:11'),
(27, 41, 'Verifikasi FCT Inline ', '2021-12-08', 39, 'In Progress', NULL, NULL, 1, 'Yes', '2021-11-21 08:55:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `child_task_approval`
--

CREATE TABLE `child_task_approval` (
  `id` int(11) NOT NULL,
  `child_task_id` int(11) NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `approve_user` int(11) UNSIGNED NOT NULL,
  `update_date` date NOT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `approve` int(11) NOT NULL,
  `routes` int(11) NOT NULL,
  `updated` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `child_task_approval`
--

INSERT INTO `child_task_approval` (`id`, `child_task_id`, `file`, `approve_user`, `update_date`, `notes`, `approve`, `routes`, `updated`, `updated_at`) VALUES
(3, 3, NULL, 22, '2021-09-28', 'Sipp', 202, 1, 1, '2021-11-04 01:05:09'),
(4, 4, 'dummies.pdf', 22, '2021-09-30', 'Bagusss', 202, 1, 1, '2021-11-04 01:05:09'),
(5, 5, 'dummiessss.pdf', 28, '2021-10-05', 'Sip', 202, 1, 1, '2021-11-04 01:05:09'),
(8, 8, NULL, 76, '2021-11-16', NULL, 1, 1, 0, '2021-11-16 03:34:41'),
(9, 9, NULL, 76, '2021-11-16', NULL, 1, 1, 0, '2021-11-16 04:22:29'),
(10, 10, NULL, 76, '2021-11-16', NULL, 1, 1, 0, '2021-11-16 04:25:11'),
(13, 13, NULL, 25, '2021-11-18', NULL, 1, 1, 0, '2021-11-18 01:35:15'),
(14, 14, NULL, 25, '2021-11-18', NULL, 1, 1, 0, '2021-11-18 01:36:44'),
(15, 15, NULL, 30, '2021-11-18', NULL, 1, 1, 0, '2021-11-18 01:40:10'),
(17, 17, NULL, 30, '2021-11-18', NULL, 1, 1, 0, '2021-11-18 01:42:13'),
(21, 21, 'Re-leaktest NG cluster LT K2SA 12nov2021.xlsx', 41, '2021-11-18', '', 202, 1, 1, '2021-11-23 04:27:27'),
(22, 22, 'Analysis leaktest NG cluster LT K2SA 12nov2021.xlsx', 41, '2021-11-18', '', 202, 1, 1, '2021-11-24 01:42:56'),
(23, 23, NULL, 25, '2021-11-18', NULL, 1, 1, 0, '2021-11-18 02:36:11'),
(24, 24, NULL, 27, '2021-11-21', NULL, 1, 1, 0, '2021-11-21 08:52:04'),
(25, 25, NULL, 27, '2021-11-21', NULL, 1, 1, 0, '2021-11-21 08:53:22'),
(26, 26, NULL, 27, '2021-11-21', NULL, 1, 1, 0, '2021-11-21 08:54:11'),
(27, 27, NULL, 27, '2021-11-21', NULL, 1, 1, 0, '2021-11-21 08:55:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `customer`
--

INSERT INTO `customer` (`id`, `customer_name`, `type`) VALUES
(1, 'AVV', '2 Wheel'),
(2, 'VETL', '2 Wheel'),
(3, 'AHM', '2 Wheel'),
(4, 'AJI', '2 Wheel'),
(5, 'DSO', '4 Wheel');

-- --------------------------------------------------------

--
-- Struktur dari tabel `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `depart_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `department`
--

INSERT INTO `department` (`id`, `depart_name`) VALUES
(0, '-'),
(1, 'Engineering & Maintenance'),
(2, 'Research and Development'),
(3, 'Quality'),
(4, 'PPIC, MP&L, Purchasing'),
(5, 'Manufacturing'),
(6, 'Finance & Accounting'),
(7, 'HRGA & EHS');

-- --------------------------------------------------------

--
-- Struktur dari tabel `design_standard`
--

CREATE TABLE `design_standard` (
  `id` int(11) NOT NULL,
  `area_id` int(11) NOT NULL,
  `item` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `best_practice` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `design_standard`
--

INSERT INTO `design_standard` (`id`, `area_id`, `item`, `photo`, `best_practice`) VALUES
(4, 2, 'Item 1', 'thermal.jpg', 'dummies.pdf'),
(5, 1, 'Screwtorsi', 'PHKJ-352.jpg', 'dummiessss.pdf'),
(6, 1, 'Item 2', 'default.png', 'dummiessss (1).pdf');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dwg_file`
--

CREATE TABLE `dwg_file` (
  `id` int(11) NOT NULL,
  `id_model` int(11) NOT NULL,
  `nama_file` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `type` varchar(25) NOT NULL,
  `uploader` int(11) UNSIGNED NOT NULL,
  `upload_for_dept` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `dwg_file`
--

INSERT INTO `dwg_file` (`id`, `id_model`, `nama_file`, `status`, `type`, `uploader`, `upload_for_dept`) VALUES
(2, 1, 'VPDS.xlsx', 'active', 'customer', 28, 3),
(3, 1, 'dummies.pdf', 'active', 'internal', 28, 3),
(4, 1, 'CCTC-VideoScripts.pdf', 'active', 'internal', 38, 3),
(5, 1, 'zzz.pdf', 'active', 'internal', 28, 3),
(6, 1, 'yyy.pdf', 'active', 'customer', 28, 5),
(7, 1, 'thermalmfg.pdf', 'active', 'customer', 28, 2),
(8, 1, 'dummies.zip', 'active', 'customer', 28, 1),
(9, 1, 'dummies.zip', 'active', 'customer', 28, 2),
(10, 1, 'Warehouse Rak FIFO - Guides.pdf', 'active', 'internal', 28, 1),
(11, 1, 'Warehouse Rak FIFO - Guides.pdf', 'active', 'internal', 28, 4),
(12, 1, 'Warehouse Rak FIFO - Guides.pdf', 'active', 'internal', 28, 5),
(14, 2, 'CCTC-VideoScripts.pdf', 'active', 'customer', 28, 2),
(15, 2, 'CCTC-VideoScripts.pdf', 'active', 'customer', 28, 3),
(16, 2, 'CCTC-VideoScripts.pdf', 'active', 'customer', 28, 4),
(17, 2, 'CCTC-VideoScripts.pdf', 'inactive', 'customer', 28, 5),
(18, 2, 'dummies.zip', 'active', 'customer', 28, 2),
(19, 2, 'zzz.pdf', 'active', 'internal', 28, 1),
(20, 2, 'zzz.pdf', 'active', 'internal', 28, 2),
(21, 2, 'zzz.pdf', 'active', 'internal', 28, 3),
(22, 1, 'dummies (1).pdf', 'active', 'customer', 28, 1),
(23, 1, 'dummies (1).pdf', 'active', 'customer', 28, 2),
(24, 1, 'dummies (1).pdf', 'active', 'customer', 28, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `dwg_log`
--

CREATE TABLE `dwg_log` (
  `id` int(11) NOT NULL,
  `user` int(11) UNSIGNED NOT NULL,
  `model` int(11) NOT NULL,
  `file` varchar(255) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `dwg_log`
--

INSERT INTO `dwg_log` (`id`, `user`, `model`, `file`, `date`) VALUES
(4, 28, 1, 'CCTC-VideoScripts.pdf', '2021-11-02 10:40:57'),
(5, 22, 1, 'Warehouse Rak FIFO - Guides.pdf', '2021-11-02 12:56:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dwg_model`
--

CREATE TABLE `dwg_model` (
  `id` int(11) NOT NULL,
  `model` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `dwg_model`
--

INSERT INTO `dwg_model` (`id`, `model`) VALUES
(1, 'K1ZA'),
(2, 'K2SA');

-- --------------------------------------------------------

--
-- Struktur dari tabel `engchange_4m`
--

CREATE TABLE `engchange_4m` (
  `id` int(11) NOT NULL,
  `fourm` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `engchange_4m`
--

INSERT INTO `engchange_4m` (`id`, `fourm`) VALUES
(1, 'Man'),
(2, 'Method'),
(3, 'Material'),
(4, 'Machine');

-- --------------------------------------------------------

--
-- Struktur dari tabel `engchange_approval`
--

CREATE TABLE `engchange_approval` (
  `id` int(11) NOT NULL,
  `req_id` int(11) NOT NULL,
  `approve_user` int(11) NOT NULL,
  `update_date` date DEFAULT NULL,
  `approve` int(11) NOT NULL,
  `routes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `engchange_approval`
--

INSERT INTO `engchange_approval` (`id`, `req_id`, `approve_user`, `update_date`, `approve`, `routes`) VALUES
(1, 1, 38, '2021-10-18', 202, 1),
(2, 1, 22, '2021-10-18', 202, 2),
(3, 1, 67, '2021-10-18', 202, 3),
(4, 1, 39, '2021-10-18', 202, 4),
(5, 1, 68, '2021-10-18', 202, 5),
(11, 1, 37, '2021-10-18', 202, 6),
(12, 4, 65, '2021-10-21', 202, 1),
(13, 4, 25, '2021-10-21', 202, 2),
(14, 4, 67, '2021-10-21', 202, 3),
(15, 4, 24, '2021-10-21', 202, 4),
(16, 4, 68, '2021-10-21', 202, 5),
(17, 5, 38, '2021-10-21', 202, 1),
(18, 5, 22, '2021-10-21', 202, 2),
(19, 5, 67, '2021-10-21', 202, 3),
(20, 5, 39, '2021-10-21', 202, 4),
(21, 5, 68, '2021-10-21', 202, 5),
(22, 5, 37, '2021-10-21', 202, 6),
(23, 6, 65, '2021-10-21', 202, 1),
(24, 6, 22, '2021-10-21', 202, 2),
(25, 6, 67, '2021-10-21', 202, 3),
(26, 6, 24, '2021-10-21', 202, 4),
(27, 6, 68, '2021-10-21', 202, 5),
(28, 6, 37, '2021-10-21', 202, 6),
(29, 7, 38, '2021-11-16', 202, 1),
(30, 7, 25, '2021-11-22', 202, 2),
(31, 7, 67, NULL, 3, 3),
(32, 7, 39, NULL, 4, 4),
(33, 7, 68, NULL, 5, 5),
(34, 8, 38, '2021-10-27', 202, 1),
(35, 8, 27, NULL, 2, 2),
(36, 8, 67, NULL, 3, 3),
(37, 8, 39, NULL, 4, 4),
(38, 8, 68, NULL, 5, 5),
(39, 9, 65, NULL, 1, 1),
(40, 9, 22, NULL, 2, 2),
(41, 9, 67, NULL, 3, 3),
(42, 9, 39, NULL, 4, 4),
(43, 9, 68, NULL, 5, 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `engchange_request`
--

CREATE TABLE `engchange_request` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `fourm_id` int(11) NOT NULL,
  `issuer` int(11) NOT NULL,
  `line` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `notesmgr` varchar(255) DEFAULT NULL,
  `testresult_eng` varchar(255) DEFAULT NULL,
  `acknowledge_ehs` varchar(255) DEFAULT NULL,
  `confirm_quality` varchar(255) DEFAULT NULL,
  `notes_dhqa` varchar(255) DEFAULT NULL,
  `notes_mkt` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `to_customer` varchar(255) DEFAULT NULL,
  `created_at` date NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `approve` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `engchange_request`
--

INSERT INTO `engchange_request` (`id`, `project_id`, `fourm_id`, `issuer`, `line`, `description`, `reason`, `notesmgr`, `testresult_eng`, `acknowledge_ehs`, `confirm_quality`, `notes_dhqa`, `notes_mkt`, `status`, `to_customer`, `created_at`, `file`, `approve`) VALUES
(1, 2, 2, 40, 'FA-1', 'Example desc 1', 'Example reason 1', 'Sip Lanjtukan!', 'Test okok', 'Aman', 'Ok', 'To customer', 'Ok nice!', 'Done', 'Yes', '2021-10-15', 'dummies.pdf', 7),
(4, 2, 1, 22, 'SMT-1', 'Exmple desc', 'Example reason', 'Oke lanjut', 'Nice', 'Good job', 'Ok', 'Oke', NULL, 'Done', 'No', '2021-10-21', NULL, 6),
(5, 2, 1, 28, 'SMT-1', 'Example description', 'Example reason', 'Good', 'Testing ok', 'Nice', 'Ok', 'Send to customer', 'Okey!', 'Done', 'Yes', '2021-10-21', 'dummies.zip', 7),
(6, 2, 3, 25, 'SMT-1', 'Example description', 'Example reason', 'Lanjut!', 'Good', 'Good Job!', 'Nice', 'Customer', 'Baguss', 'Done', 'Yes', '2021-10-21', 'dummiessss.pdf', 7),
(7, 2, 3, 28, 'FA-1', 'aaa', 'aaa', 'Silakan diproses', 'ok, ready to verification', NULL, NULL, NULL, NULL, 'Approve 2', NULL, '2021-10-21', NULL, 3),
(8, 2, 1, 28, 'SMT-1', 'Change TI to Maxim', 'Component shortage', 'Ok. Please proceed follow flow', NULL, NULL, NULL, NULL, NULL, 'Approve 1', NULL, '2021-10-27', 'Working Calendar - AVI 2021.pdf', 2),
(9, 2, 4, 25, 'FA-2', 'Pokayoke time to inspection antifog should be contolled  by automatically open-close sliding door and buzzer indicator', 'To ensure antifog permormance not decrease due to checking by steam too long', NULL, NULL, NULL, NULL, NULL, NULL, 'Waiting Approve', NULL, '2021-11-22', NULL, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `event_customer`
--

CREATE TABLE `event_customer` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `event_customer`
--

INSERT INTO `event_customer` (`id`, `project_id`, `event_name`, `start`, `end`) VALUES
(1, 2, 'DIE GO', '2021-09-02', '2021-09-10'),
(2, 2, 'HEARING AFTER DIE GO', '2021-09-11', '2021-09-24'),
(14, 7, 'PP1', '2021-07-27', '2021-08-04'),
(15, 7, 'PP2', '2021-11-08', '2021-11-15'),
(16, 7, 'PP3', '2021-12-28', '2022-01-03'),
(17, 7, 'Mass Pro', '2022-01-03', '2022-01-24'),
(18, 11, 'T0', '2021-09-17', '2021-10-16'),
(19, 11, 'PP1', '2021-10-15', '2021-11-01'),
(20, 11, 'PP2', '2022-01-24', '2022-01-31'),
(21, 11, 'PP3', '2022-02-14', '2022-02-21'),
(22, 11, 'MASS PRO', '2022-02-24', '2022-02-28'),
(23, 9, 'DIE GO', '2021-06-21', '2021-06-25'),
(24, 9, 'PP1', '2021-07-19', '2021-07-23'),
(25, 9, 'PP2', '2021-11-08', '2021-11-15'),
(26, 9, 'MASS PRO', '2021-11-29', '2021-12-13'),
(27, 10, 'PP1.1', '2021-08-02', '2021-08-05'),
(28, 10, 'PP1.2', '2021-11-01', '2021-11-10'),
(29, 10, 'PP2', '2022-01-03', '2022-01-05'),
(30, 10, 'PP3', '2022-02-21', '2022-02-25'),
(31, 10, 'MASS PRO', '2022-03-14', '2022-03-21'),
(32, 8, 'PP1', '2021-07-30', '2021-08-06'),
(33, 8, 'PP2', '2021-09-06', '2021-09-13'),
(34, 8, 'RAMP UP & MASS PRO', '2021-12-01', '2021-12-06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `event_internal`
--

CREATE TABLE `event_internal` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `flag` varchar(25) NOT NULL DEFAULT 'red',
  `start` date NOT NULL,
  `end` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `event_internal`
--

INSERT INTO `event_internal` (`id`, `project_id`, `event_name`, `flag`, `start`, `end`) VALUES
(1, 2, 'PP1', 'red', '2021-09-03', '2021-09-15'),
(2, 2, 'PP2', 'red', '2021-09-16', '2021-09-20'),
(3, 2, 'PP3', 'red', '2021-09-21', '2021-10-11'),
(4, 2, 'MASS PRO', 'green', '2021-11-11', '2021-11-30'),
(11, 7, 'Eng Trial', 'green', '2021-06-12', '2021-06-26'),
(12, 7, 'T0', 'green', '2021-07-01', '2021-07-05'),
(13, 7, 'PP1', 'green', '2021-07-05', '2021-07-12'),
(14, 7, 'PP2', 'green', '2021-10-18', '2021-11-02'),
(15, 7, 'N200', 'yellow', '2021-11-30', '2021-12-10'),
(16, 7, 'PP3', 'yellow', '2021-12-15', '2021-12-24'),
(17, 7, 'RAMP UP &  MASS PRO', 'yellow', '2022-01-06', '2022-01-19'),
(18, 11, 'T0', 'green', '2021-09-10', '2021-09-15'),
(19, 11, 'PP1', 'green', '2021-09-24', '2021-09-29'),
(20, 11, 'PP2', 'yellow', '2022-01-03', '2022-01-14'),
(21, 11, 'RAMP UP & MP', 'yellow', '2022-01-31', '2022-02-14'),
(22, 9, 'PP1', 'green', '2021-06-15', '2021-06-22'),
(23, 9, 'PP2', 'green', '2021-09-10', '2021-09-17'),
(24, 9, 'PP2.1', 'green', '2021-10-25', '2021-10-29'),
(25, 9, 'RAMP UP & MASS PRO', 'green', '2021-11-24', '2021-11-29'),
(26, 10, 'PP1.1', 'green', '2021-07-05', '2021-07-19'),
(27, 10, 'PP1.2', 'green', '2021-10-07', '2021-10-15'),
(28, 10, 'PP2', 'red', '2021-12-02', '2021-12-08'),
(29, 10, 'PP3', 'red', '2022-01-25', '2022-02-14'),
(30, 10, 'RAMP UP & MASS PRO', 'red', '2022-02-14', '2022-02-21'),
(31, 8, 'PP1', 'green', '2021-07-05', '2021-07-12'),
(32, 8, 'PP2', 'green', '2021-08-16', '2021-08-27'),
(33, 8, 'RAMP UP & MASS PRO', 'yellow', '2021-10-19', '2021-11-29'),
(34, 7, 'N200 SMT', 'yellow', '2021-12-01', '2021-12-03'),
(35, 7, 'N200 FA', 'yellow', '2021-12-07', '2021-12-08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `launch_cost`
--

CREATE TABLE `launch_cost` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `total` float NOT NULL,
  `pv` float NOT NULL,
  `used_pv` float NOT NULL,
  `launch` float NOT NULL,
  `used_launch` float NOT NULL,
  `other` float NOT NULL,
  `used_other` float NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `launch_cost`
--

INSERT INTO `launch_cost` (`id`, `project_id`, `total`, `pv`, `used_pv`, `launch`, `used_launch`, `other`, `used_other`, `updated_at`) VALUES
(2, 2, 500000000, 200000000, 70000000, 100000000, 75000000, 100000000, 25000000, '2021-11-03 09:41:01'),
(7, 7, 0, 0, 0, 0, 0, 0, 0, '2021-11-11 07:50:21'),
(8, 8, 0, 0, 0, 0, 0, 0, 0, '2021-11-11 07:52:03'),
(9, 9, 0, 0, 0, 0, 0, 0, 0, '2021-11-11 07:57:08'),
(10, 10, 0, 0, 0, 0, 0, 0, 0, '2021-11-11 07:58:35'),
(11, 11, 0, 0, 0, 0, 0, 0, 0, '2021-11-11 08:00:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lessonlearn`
--

CREATE TABLE `lessonlearn` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `source` varchar(255) NOT NULL,
  `problem` varchar(255) NOT NULL,
  `countermeasure` varchar(255) NOT NULL,
  `rootcause` varchar(255) NOT NULL,
  `prevention` varchar(255) NOT NULL,
  `remaks` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `lessonlearn`
--

INSERT INTO `lessonlearn` (`id`, `project_id`, `source`, `problem`, `countermeasure`, `rootcause`, `prevention`, `remaks`, `status`, `file`, `created_at`) VALUES
(18, 2, 'Customer', 'Short Shot at Lens (Locator for knob)', 'Segregate initial injection part (first 10 shoots)', 'No special treatment for initial injection \r\n\r\n', 'Make sure Injection supplier has specified area for initial injection process\r\n', 'No specific area, Due Date for next verification June 9th 2020\r\n', 'Open', NULL, '2021-11-09'),
(19, 2, 'Design', 'Fuzzy Parameter', 'Additional Quality Point related to the problem\r\n', 'FPC Assy not locked properly', 'Additional Quality Point related to the problem\r\n', 'Already stated on WI to make sure FPC locked properly (make sure click sound)\r\n', 'Closed', NULL, '2021-11-09'),
(20, 2, 'Manufacturing', 'Fuzzy Parameter', 'FPC Assy not locked properly', 'MSA Operator (Station Innercase Assy and PDI) ', 'MSA Operator (Station Innercase Assy and PDI) ', 'Operator already PASS MSA', 'Open', NULL, '2021-11-09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `level`
--

CREATE TABLE `level` (
  `id` int(11) NOT NULL,
  `level_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `level`
--

INSERT INTO `level` (`id`, `level_name`) VALUES
(1, 'Site Administrator'),
(2, 'BoD'),
(3, 'AME'),
(4, 'Project Manager'),
(5, 'Department Head'),
(6, 'Section Head'),
(7, 'Staff'),
(8, 'Operator');

-- --------------------------------------------------------

--
-- Struktur dari tabel `material_cost`
--

CREATE TABLE `material_cost` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `total` float NOT NULL,
  `mcomp` float NOT NULL,
  `used_mcomp` float NOT NULL,
  `ecomp` float NOT NULL,
  `used_ecomp` float NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `material_cost`
--

INSERT INTO `material_cost` (`id`, `project_id`, `total`, `mcomp`, `used_mcomp`, `ecomp`, `used_ecomp`, `updated_at`) VALUES
(2, 2, 300000000, 200000000, 150000000, 100000000, 50000000, '2021-11-04 00:40:22'),
(7, 7, 0, 0, 0, 0, 0, '2021-11-11 07:50:21'),
(8, 8, 0, 0, 0, 0, 0, '2021-11-11 07:52:03'),
(9, 9, 0, 0, 0, 0, 0, '2021-11-11 07:57:08'),
(10, 10, 0, 0, 0, 0, 0, '2021-11-11 07:58:35'),
(11, 11, 0, 0, 0, 0, 0, '2021-11-11 08:00:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mg_area`
--

CREATE TABLE `mg_area` (
  `id` int(11) NOT NULL,
  `area` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `mg_area`
--

INSERT INTO `mg_area` (`id`, `area`) VALUES
(1, 'PCBA Mfg'),
(2, 'Final Assembly'),
(3, 'Testing'),
(4, 'Component Mfg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mg_file`
--

CREATE TABLE `mg_file` (
  `id` int(11) NOT NULL,
  `area_id` int(11) NOT NULL,
  `process_id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `upload_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `mg_file`
--

INSERT INTO `mg_file` (`id`, `area_id`, `process_id`, `filename`, `upload_at`) VALUES
(7, 1, 3, 'dummiessss.pdf', '2021-10-01'),
(8, 1, 4, 'dummies.pdf', '2021-10-04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mg_process`
--

CREATE TABLE `mg_process` (
  `id` int(11) NOT NULL,
  `area_id` int(11) NOT NULL,
  `process_name` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `mfg_spec` varchar(255) NOT NULL,
  `equip_spec` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `mg_process`
--

INSERT INTO `mg_process` (`id`, `area_id`, `process_name`, `photo`, `mfg_spec`, `equip_spec`) VALUES
(4, 2, 'Screwing', 'screw.jpg', 'mfgspec.pdf', 'equipspec.pdf'),
(8, 2, 'Pointer Placement', 'pointerplacement.jpg', 'mfgpointer.pdf', 'equippointer.pdf'),
(10, 2, 'Thermal', 'thermal.jpg', 'thermalmfg.pdf', 'thermalequip.pdf'),
(11, 1, 'Screw', 'default.png', 'dummies.pdf', 'dummiessss.pdf');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2017-11-20-223112', 'Myth\\Auth\\Database\\Migrations\\CreateAuthTables', 'default', 'Myth\\Auth', 1625545347, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `model`
--

CREATE TABLE `model` (
  `id` int(11) NOT NULL,
  `model` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `model`
--

INSERT INTO `model` (`id`, `model`) VALUES
(1, 'K1ZA'),
(2, 'K2PJ'),
(3, 'K0JA'),
(4, 'K0JG'),
(5, 'K2SA');

-- --------------------------------------------------------

--
-- Struktur dari tabel `productivity`
--

CREATE TABLE `productivity` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `station` varchar(255) NOT NULL,
  `ct_target` int(11) NOT NULL,
  `ct_actual` int(11) NOT NULL,
  `ftt_target` int(11) NOT NULL,
  `ftt_actual` int(11) NOT NULL,
  `rr_target` int(11) NOT NULL,
  `rr_actual` int(11) NOT NULL,
  `at_target` int(11) NOT NULL,
  `at_actual` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `productivity`
--

INSERT INTO `productivity` (`id`, `project_id`, `event_id`, `station`, `ct_target`, `ct_actual`, `ftt_target`, `ftt_actual`, `rr_target`, `rr_actual`, `at_target`, `at_actual`, `updated_at`) VALUES
(1, 2, 1, 'ICT', 25, 24, 30, 31, 25, 23, 30, 25, '2021-11-04 01:49:29'),
(2, 2, 1, 'FCT', 25, 34, 30, 34, 25, 35, 30, 20, '2021-11-04 01:37:32'),
(4, 2, 2, 'Station 1', 30, 22, 25, 34, 35, 41, 40, 30, '2021-11-04 01:37:32'),
(5, 2, 2, 'Station 2', 30, 22, 25, 22, 35, 42, 40, 35, '2021-11-04 01:37:32'),
(6, 2, 3, 'Station 1', 80, 98, 20, 19, 30, 11, 40, 27, '2021-11-04 01:37:32'),
(9, 2, 1, 'EOL', 25, 24, 30, 25, 25, 15, 0, 0, '2021-11-04 01:37:32'),
(10, 2, 1, 'PDI', 25, 15, 30, 20, 25, 15, 30, 25, '2021-11-04 01:37:32'),
(11, 2, 1, 'AOI', 25, 20, 30, 25, 25, 10, 30, 15, '2021-11-04 01:37:32'),
(12, 2, 3, 'Station 2', 80, 40, 30, 20, 30, 35, 50, 30, '2021-11-04 01:37:32'),
(13, 2, 2, 'Station 3', 30, 35, 25, 15, 35, 40, 40, 25, '2021-11-04 01:37:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `project`
--

CREATE TABLE `project` (
  `id` int(11) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `end_product` varchar(255) NOT NULL,
  `start` date NOT NULL,
  `status` varchar(255) NOT NULL,
  `leader` int(11) UNSIGNED NOT NULL,
  `pict` varchar(255) NOT NULL DEFAULT 'default.png',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `project`
--

INSERT INTO `project` (`id`, `cust_id`, `project_name`, `end_product`, `start`, `status`, `leader`, `pict`, `created_at`) VALUES
(2, 1, 'Example', 'PWBA', '2021-09-07', 'In Progress', 12, '1633657183_8f8d2db106d771549c71.jpg', '2022-03-31 08:00:12'),
(7, 3, 'K2SA', 'Cluster', '2021-11-11', 'In Progress', 12, '1637043363_d59b94704bc4411a0e95.jpg', '2022-03-31 08:00:12'),
(8, 1, 'K2PJ', 'PWBA', '2021-11-11', 'In Progress', 12, 'default.png', '2022-03-31 08:00:12'),
(9, 4, 'K2SA LP', 'PWBA', '2021-11-11', 'In Progress', 12, '1637203618_fda52fe593e308aab34b.jpg', '2022-03-31 08:00:12'),
(10, 1, 'K3AA (K2ZA)', 'PWBA', '2021-11-11', 'In Progress', 12, 'default.png', '2022-03-31 08:00:12'),
(11, 3, 'K0JG', 'Cluster', '2021-11-11', 'In Progress', 12, '1637488218_a3e01738055ee54ff949.jpg', '2022-03-31 08:00:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `quality`
--

CREATE TABLE `quality` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `event` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `issue` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `lead` int(11) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL,
  `closing_action` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `quality`
--

INSERT INTO `quality` (`id`, `project_id`, `event`, `date`, `issue`, `description`, `lead`, `status`, `closing_action`, `updated_at`) VALUES
(2, 2, '1', '2021-09-08', 'Issue Quality 1', 'Description Issue Quality', 39, 'Closed', 'Closing Action Example 1', '2021-11-02 09:03:13'),
(3, 2, '2', '2021-11-01', 'example', 'descrr', 68, 'Closed', 'closs', '2021-11-03 09:03:09'),
(4, 2, '1', '2021-11-03', 'ABC', 'WNWOO', 39, 'Closed', 'YYYY', '2021-11-03 09:31:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `quality_cas`
--

CREATE TABLE `quality_cas` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `component` varchar(255) NOT NULL,
  `supplier` varchar(255) NOT NULL,
  `sc_point` int(11) NOT NULL,
  `all_point` int(11) NOT NULL,
  `cpcpk_compliance` int(11) NOT NULL,
  `visual` varchar(255) NOT NULL,
  `component_level_testing` varchar(255) NOT NULL,
  `eser_aar_status` varchar(255) NOT NULL,
  `remark` varchar(255) NOT NULL,
  `lead` int(11) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL,
  `flag` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `quality_cas`
--

INSERT INTO `quality_cas` (`id`, `project_id`, `component`, `supplier`, `sc_point`, `all_point`, `cpcpk_compliance`, `visual`, `component_level_testing`, `eser_aar_status`, `remark`, `lead`, `status`, `flag`, `updated_at`) VALUES
(1, 2, 'Mask', 'ASKI', 100, 85, 90, 'Clock Issue', 'N/A', 'Open', '-', 39, 'Open', 'Green', '2021-11-03 09:08:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `quality_custppap`
--

CREATE TABLE `quality_custppap` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `event` varchar(255) NOT NULL,
  `required_items` varchar(255) NOT NULL,
  `submission_date` date NOT NULL,
  `pic` int(11) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL,
  `flag` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `quality_custppap`
--

INSERT INTO `quality_custppap` (`id`, `project_id`, `event`, `required_items`, `submission_date`, `pic`, `status`, `flag`, `updated_at`) VALUES
(3, 2, '1', 'Example Items 1', '2021-09-15', 31, 'Open', 'Yellow', '2021-11-03 09:09:07'),
(4, 2, '1', 'Items example', '2021-11-17', 12, 'Closed', 'Green', '2021-11-11 08:45:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `quality_pvtest`
--

CREATE TABLE `quality_pvtest` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `test_item` varchar(255) NOT NULL,
  `plan_start` date NOT NULL,
  `plan_completed` date NOT NULL,
  `actual_start` date NOT NULL,
  `actual_completed` date NOT NULL,
  `result` varchar(255) NOT NULL,
  `flag` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `quality_pvtest`
--

INSERT INTO `quality_pvtest` (`id`, `project_id`, `test_item`, `plan_start`, `plan_completed`, `actual_start`, `actual_completed`, `result`, `flag`, `updated_at`) VALUES
(1, 2, 'Example test 1', '2021-09-09', '2021-09-16', '2021-09-10', '2021-09-17', 'Oke', 'Yellow', '2021-11-03 09:09:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `quality_pvtestsum`
--

CREATE TABLE `quality_pvtestsum` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `total_test` int(11) NOT NULL,
  `test_done` int(11) NOT NULL,
  `past_first_test` int(11) NOT NULL,
  `flag` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `quality_pvtestsum`
--

INSERT INTO `quality_pvtestsum` (`id`, `project_id`, `total_test`, `test_done`, `past_first_test`, `flag`, `updated_at`) VALUES
(1, 2, 11, 1, 50, 'Yellow', '2021-11-03 09:09:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `quality_safelaunch`
--

CREATE TABLE `quality_safelaunch` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `event` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `issue` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `lead` int(11) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL,
  `closing_action` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `quality_safelaunch`
--

INSERT INTO `quality_safelaunch` (`id`, `project_id`, `event`, `date`, `issue`, `description`, `lead`, `status`, `closing_action`, `updated_at`) VALUES
(2, 2, '1', '2021-09-08', 'Issue Safe Launch Quality 1', 'Description Issue Quality', 39, 'Closed', 'Closing Action Ex', '2021-11-03 09:10:06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `quality_supppap`
--

CREATE TABLE `quality_supppap` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `supplier` varchar(255) NOT NULL,
  `component` varchar(255) NOT NULL,
  `target_date` date NOT NULL,
  `pic` int(11) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL,
  `flag` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `quality_supppap`
--

INSERT INTO `quality_supppap` (`id`, `project_id`, `supplier`, `component`, `target_date`, `pic`, `status`, `flag`, `updated_at`) VALUES
(4, 2, 'Example supplier 1', 'Example componen 1', '2021-09-11', 22, 'Open', 'Yellow', '2021-11-03 09:10:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rio`
--

CREATE TABLE `rio` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `rio` varchar(255) NOT NULL,
  `due_date` date NOT NULL,
  `pic` int(11) UNSIGNED NOT NULL,
  `approve` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `closing_statement` varchar(255) DEFAULT NULL,
  `notes_file` varchar(255) DEFAULT NULL,
  `file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `rio`
--

INSERT INTO `rio` (`id`, `project_id`, `type`, `rio`, `due_date`, `pic`, `approve`, `status`, `description`, `closing_statement`, `notes_file`, `file`) VALUES
(3, 2, 'Oportunity', 'Example Oportunity 1', '2021-10-08', 28, 1, 'Done', 'Example description', 'Example clostat', 'Example note spesific required file', 'Yes'),
(5, 2, 'Risk', 'Example Risk 2', '2021-10-09', 25, 1, 'Done', 'ini description', 'ini closing statement', 'lampirkan file', 'Yes'),
(9, 2, 'Risk', 'Improve Mesin glue', '2021-10-28', 25, 1, 'Done', 'desz', 'Okee', '', 'Yes'),
(10, 2, 'Risk', 'Packaging approval', '2021-10-28', 30, 1, 'In Progress', 'Submit doc to AMir', 'zzz', '1121 supplier', 'Yes'),
(13, 2, 'Issue', 'Example Issue Rio 1', '2021-11-12', 28, 1, 'Done', 'Please fix it', 'done sir', '', 'No'),
(16, 7, 'Opportunity', 'Improvement Antifog K2VG', '2021-11-29', 25, 1, 'In Progress', 'Ship sample lens to AHM', NULL, '', 'No');

-- --------------------------------------------------------

--
-- Struktur dari tabel `section`
--

CREATE TABLE `section` (
  `id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `section_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `section`
--

INSERT INTO `section` (`id`, `department_id`, `section_name`) VALUES
(0, 0, '-'),
(1, 1, 'Automation & Testing'),
(2, 1, 'Engineering FA'),
(3, 1, 'Engineering SMT'),
(4, 1, 'Maintenace'),
(5, 3, 'Quality Assurance'),
(6, 3, 'Quality Control'),
(7, 4, 'PPIC'),
(8, 4, 'MP&L'),
(9, 4, 'Purhasing'),
(10, 7, 'HRGA'),
(11, 7, 'EHS'),
(12, 5, 'Manufacturing'),
(13, 2, 'Electrical'),
(14, 2, 'Mechanical'),
(15, 6, 'Finance'),
(16, 6, 'Accounting');

-- --------------------------------------------------------

--
-- Struktur dari tabel `task`
--

CREATE TABLE `task` (
  `id` int(11) NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `event` int(11) NOT NULL,
  `concern` varchar(255) DEFAULT NULL,
  `due_date` date NOT NULL DEFAULT current_timestamp(),
  `pic` int(11) UNSIGNED NOT NULL,
  `namafile` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `approve` int(11) NOT NULL,
  `file` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `request_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `task`
--

INSERT INTO `task` (`id`, `project_id`, `event`, `concern`, `due_date`, `pic`, `namafile`, `description`, `status`, `approve`, `file`, `created_at`, `updated_at`, `request_at`) VALUES
(5, 2, 3, 'Research Development', '2021-10-08', 28, 'dummiessss.pdf', 'Okay', 'Done', 2, 'No', '2021-11-04 02:17:58', '2021-10-11 02:02:05', '2021-10-10 09:14:08'),
(13, 2, 2, 'Test2', '2021-10-30', 22, NULL, 'Yak', 'Done', 2, 'No', '2021-11-04 02:17:58', '2021-10-22 03:08:13', '2021-10-22 00:00:00'),
(21, 7, 15, 'Global Part Readiness', '2021-11-30', 30, NULL, NULL, 'In Progress', 1, 'Yes', '2021-11-16 04:26:33', '2021-11-16 04:26:33', NULL),
(23, 7, 15, 'PPAP Approval Knob', '2021-11-23', 76, 'PPAP KNOB K2SA.zip', 'Plea find attached document', 'Waiting Approve', 1, 'Yes', '2021-11-18 02:24:57', '2021-12-16 09:20:56', '2021-12-16 00:00:00'),
(24, 7, 15, 'PPAP Approval Lens', '2021-11-23', 76, '1. PPAP LENS K2SA.zip', 'Please find attached document', 'Waiting Approve', 1, 'Yes', '2021-11-18 02:26:13', '2021-12-16 09:29:00', '2021-12-16 00:00:00'),
(25, 7, 15, 'PPAP Approval Inner Case', '2021-11-23', 76, '2. PPAP INNER CASE K2SA.zip', 'Please find attached document', 'Waiting Approve', 1, 'Yes', '2021-11-18 02:27:07', '2021-12-16 09:29:45', '2021-12-16 00:00:00'),
(26, 7, 15, 'Analisa Leak Test NG ', '2021-11-22', 41, 'Analysis leaktest NG cluster LT K2SA.xlsx', 'missing glue causing NG leak test', 'Approve 2', 1, 'Yes', '2021-11-18 02:28:52', '2021-11-30 05:22:23', '2021-11-24 00:00:00'),
(27, 7, 15, 'Problem Bubble di dalam Glue Knob', '2021-11-23', 25, NULL, NULL, 'In Progress', 1, 'Yes', '2021-11-18 02:35:01', '2021-11-18 02:35:01', NULL),
(28, 7, 15, 'PDR K2SA', '2021-11-29', 25, NULL, NULL, 'In Progress', 1, 'Yes', '2021-11-18 02:37:46', '2021-11-18 02:37:46', NULL),
(29, 9, 25, 'Flow Process Approved', '2021-11-18', 27, NULL, NULL, 'In Progress', 1, 'Yes', '2021-11-18 02:45:42', '2021-11-18 02:45:42', NULL),
(30, 9, 25, 'Line Evaluation (E2)', '2021-11-19', 12, 'E2 Form Supplier Evaluation Sheet_PP2_K2SA.XLSX', 'Document in running approval', 'Waiting Approve', 1, 'Yes', '2021-11-18 02:48:40', '2021-11-30 05:18:33', '2021-11-30 00:00:00'),
(31, 9, 25, 'LRR Final', '2021-11-23', 12, 'LRR K2SA LP Final.pdf', 'LRR Final done by 23 Nov 2021, Start Ramp up MP will be on 24 Nov 2021 shift 2.', 'Waiting Approve', 1, 'Yes', '2021-11-18 02:50:42', '2021-11-23 13:15:45', '2021-11-23 00:00:00'),
(32, 9, 25, 'Go Mass Pro Sign Off', '2021-11-24', 12, 'Go MassPro Commitment K2SA LP.pdf', 'Hard copy doc on running approval', 'Waiting Approve', 1, 'Yes', '2021-11-18 02:51:43', '2021-11-30 05:28:01', '2021-11-30 00:00:00'),
(33, 9, 25, 'Ramp Up Plan', '2021-11-19', 30, NULL, NULL, 'In Progress', 1, 'Yes', '2021-11-18 02:56:33', '2021-11-18 02:56:33', NULL),
(34, 7, 15, 'CF Review Inner case, Lens, Rear Cover', '2021-11-22', 24, NULL, NULL, 'In Progress', 1, 'No', '2021-11-21 07:47:23', '2021-11-21 07:47:23', NULL),
(35, 7, 15, 'Readiness material for N200 (Lens, Inner Case, Knob)', '2021-11-23', 76, NULL, 'Ready', 'Approve 1', 1, 'No', '2021-11-21 08:00:17', '2021-12-16 09:32:14', '2021-12-16 00:00:00'),
(36, 7, 15, 'Measurement & visual Result Rear Cover Trial #2', '2021-11-22', 76, '24-11-21 MEASURING CVR I-CLUS VPJHPF BY DRAWING 1122.pdf', 'Measurement Result attached', 'Approve 1', 1, 'Yes', '2021-11-21 08:13:27', '2021-12-16 09:33:38', '2021-12-16 00:00:00'),
(37, 7, 15, 'N200 SMT', '2021-12-01', 27, NULL, NULL, 'In Progress', 1, 'No', '2021-11-21 08:15:21', '2021-11-21 08:15:21', NULL),
(38, 7, 15, 'N200 FA', '2021-12-06', 25, NULL, NULL, 'In Progress', 1, 'No', '2021-11-21 08:18:11', '2021-11-21 08:18:11', NULL),
(39, 7, 15, 'LRR 1 N200 K2SA', '2021-11-24', 12, 'LRR K2SA N200 26 Nov 21.pdf', 'Next LRR will be on 2 Dec 2021', 'Waiting Approve', 1, 'Yes', '2021-11-21 08:19:49', '2021-11-30 05:33:37', '2021-11-30 00:00:00'),
(40, 8, 33, 'Start Proodukasi menggunakan ICT Inline ', '2021-11-23', 27, NULL, NULL, 'In Progress', 1, 'No', '2021-11-21 08:49:06', '2021-11-21 08:49:06', NULL),
(41, 8, 33, 'Running Produksi Menggunakan FCT Inline', '2021-12-09', 27, NULL, NULL, 'In Progress', 1, 'No', '2021-11-21 08:50:37', '2021-11-21 08:50:37', NULL),
(42, 8, 33, 'Manual Coating Jig dan equipment ready digunakan produksi (verified)', '2021-11-22', 27, NULL, NULL, 'In Progress', 1, 'Yes', '2021-11-21 08:58:31', '2021-11-21 08:58:31', NULL),
(43, 8, 33, 'Add OPL di st tauch up mengenai problem crack MOV', '2021-11-22', 65, NULL, NULL, 'In Progress', 1, 'Yes', '2021-11-21 09:00:08', '2021-11-21 09:00:08', NULL),
(44, 8, 33, 'Safelauch record plan vs actual vs delivery', '2021-11-22', 79, NULL, NULL, 'In Progress', 1, 'Yes', '2021-11-21 09:01:48', '2021-11-21 09:01:48', NULL),
(45, 8, 33, 'Safelaunch check record ', '2021-11-22', 24, NULL, NULL, 'In Progress', 1, 'Yes', '2021-11-21 09:03:45', '2021-11-21 09:03:45', NULL),
(46, 10, 28, 'PP2 K2ZA', '2021-12-02', 27, NULL, NULL, 'In Progress', 1, 'No', '2021-11-21 09:06:08', '2021-11-21 09:06:08', NULL),
(47, 10, 28, 'PR and PO released for Inline FCT', '2021-11-23', 27, NULL, NULL, 'In Progress', 1, 'Yes', '2021-11-21 09:19:29', '2021-11-21 09:19:29', NULL),
(48, 7, 15, 'Test sulfur Knob ', '2021-12-03', 30, NULL, NULL, 'In Progress', 1, 'Yes', '2021-11-30 06:46:14', '2021-11-30 06:46:14', NULL),
(49, 7, 15, 'Inject Rear cover for N200', '2021-12-06', 76, NULL, 'Done', 'Done', 2, 'No', '2021-11-30 06:51:45', '2021-12-16 09:33:22', '2021-12-16 00:00:00'),
(50, 7, 15, 'WI Rework Glue Knob', '2021-12-06', 25, NULL, NULL, 'In Progress', 1, 'Yes', '2021-12-03 12:25:07', '2021-12-03 12:25:07', NULL),
(51, 7, 17, 'Modify WO SMT untuk PWBA VPNHPF-15K520-AC/BC', '2021-12-21', 22, NULL, NULL, 'In Progress', 1, 'Yes', '2021-12-16 09:59:05', '2021-12-16 09:59:05', NULL),
(52, 7, 15, 'Incoming Part check dan Final check report share to team', '2021-12-17', 24, NULL, NULL, 'In Progress', 1, 'Yes', '2021-12-17 03:04:17', '2021-12-17 03:04:17', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `level_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL DEFAULT 0,
  `section_id` int(11) NOT NULL DEFAULT 0,
  `section` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `user_image` varchar(255) NOT NULL DEFAULT 'profile-image.png',
  `password_hash` varchar(255) NOT NULL,
  `reset_hash` varchar(255) DEFAULT NULL,
  `reset_at` datetime DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL,
  `activate_hash` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `status_message` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `force_pass_reset` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `email`, `fullname`, `level_id`, `department_id`, `section_id`, `section`, `role`, `user_image`, `password_hash`, `reset_hash`, `reset_at`, `reset_expires`, `activate_hash`, `status`, `status_message`, `active`, `force_pass_reset`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin@astra-visteon.com', 'Administrator', 1, 0, 0, '', 'admin', '1626310631_7a51cb522cfe67f2ca56.png', '$2y$10$PZ73bsJ7XxXBaWFecmDpUu6o8YpGLw/tXYKUK.zmi0tEYtqOOB11a', NULL, NULL, NULL, 'af2bc21f264963091002b606016a4009', NULL, NULL, 1, 0, '2021-07-06 02:58:37', '2021-07-06 02:58:37', NULL),
(12, 'amirudin.suryo@astra-visteon.com', 'Amirudin Suryo Atmojo', 3, 0, 0, 'AME', 'ame', '1637112488_cc2d825ac662b2d04efa.jpeg', '$2y$10$PZ73bsJ7XxXBaWFecmDpUu6o8YpGLw/tXYKUK.zmi0tEYtqOOB11a', NULL, NULL, NULL, '33210eece7a6e1e415820b9f1c213e71', NULL, NULL, 1, 0, '2021-07-07 14:09:51', '2021-07-07 14:09:51', NULL),
(22, 'reza.andriady@astra-visteon.com', 'Reza Andriady', 6, 1, 1, 'Automation & Testing', 'user', '1637547187_bb5c2fa2a69fd77fa3fd.jpeg', '$2y$10$PZ73bsJ7XxXBaWFecmDpUu6o8YpGLw/tXYKUK.zmi0tEYtqOOB11a', NULL, NULL, NULL, 'b40fd52a793a09927883227bee598e48', NULL, NULL, 1, 0, '2021-07-08 11:12:22', '2021-07-08 11:12:22', NULL),
(24, 'nasirudin@astra-visteon.com', 'Nasirudin', 6, 3, 6, 'Quality Control', 'user', 'profile-image.png', '$2y$10$PZ73bsJ7XxXBaWFecmDpUu6o8YpGLw/tXYKUK.zmi0tEYtqOOB11a', NULL, NULL, NULL, 'a9d79da36775711e6a7139702b2056be', NULL, NULL, 1, 0, '2021-07-13 10:16:53', '2021-07-13 10:16:53', NULL),
(25, 'bayu.putra@astra-visteon.com', 'Bayu Septiadi Putra', 6, 1, 2, 'Engineering FA', 'user', 'profile-image.png', '$2y$10$PZ73bsJ7XxXBaWFecmDpUu6o8YpGLw/tXYKUK.zmi0tEYtqOOB11a', NULL, NULL, NULL, '44f3b60d4c6a6888bb7a22df063cb5eb', NULL, NULL, 1, 0, '2021-07-13 10:18:32', '2021-07-13 10:18:32', NULL),
(27, 'prasetio.adi@astra-visteon.com', 'Prasetio Adi Sasono', 6, 1, 3, 'Engineering SMT', 'user', 'profile-image.png', '$2y$10$PZ73bsJ7XxXBaWFecmDpUu6o8YpGLw/tXYKUK.zmi0tEYtqOOB11a', NULL, NULL, NULL, '400b93330f160a6845839b9d06ec7a0d', NULL, NULL, 1, 0, '2021-07-14 07:44:57', '2021-07-14 07:44:57', NULL),
(28, 'bimo.prakoso@astra-visteon.com', 'Bimo Prakoso', 6, 2, 13, '', 'user', '1636689750_46d0b9d96ae995cd684f.png', '$2y$10$PZ73bsJ7XxXBaWFecmDpUu6o8YpGLw/tXYKUK.zmi0tEYtqOOB11a', NULL, NULL, NULL, 'cf4db1e3bf66d04824df0af3294e0b5b', NULL, NULL, 1, 0, '2021-07-14 07:45:27', '2021-07-14 07:45:27', NULL),
(30, 'tri.sativa@astra-visteon.com', 'Tri Adhi Sativa', 6, 4, 7, 'PPIC', 'user', 'profile-image.png', '$2y$10$PZ73bsJ7XxXBaWFecmDpUu6o8YpGLw/tXYKUK.zmi0tEYtqOOB11a', NULL, NULL, NULL, '9fa36bac0a1b6c912e5b7dbd7b6019a3', NULL, NULL, 1, 0, '2021-07-14 07:46:25', '2021-07-14 07:46:25', NULL),
(33, 'rizky.harnaningrum@astra-visteon.com', 'Rizky Novera', 6, 4, 8, 'MP&L', 'user', 'profile-image.png', '$2y$10$PZ73bsJ7XxXBaWFecmDpUu6o8YpGLw/tXYKUK.zmi0tEYtqOOB11a', NULL, NULL, NULL, '012a2e42ef938a91d04100d5a05633bd', NULL, NULL, 1, 0, '2021-07-15 13:06:24', '2021-07-15 13:06:24', NULL),
(36, 'ian.aliansyah@astra-visteon.com', 'Ian Aliansyah', 2, 0, 0, 'BoD', 'user', 'profile-image.png', '$2y$10$PZ73bsJ7XxXBaWFecmDpUu6o8YpGLw/tXYKUK.zmi0tEYtqOOB11a', NULL, NULL, NULL, '142d04bc785febab8909af4a12650b59', NULL, NULL, 1, 0, '2021-07-16 16:32:18', '2021-07-16 16:32:18', NULL),
(37, 'dhaniar.bayu@astra-visteon.com', 'Dhaniar Putra Bayu', 4, 0, 0, 'Project Manager', 'pm', 'profile-image.png', '$2y$10$PZ73bsJ7XxXBaWFecmDpUu6o8YpGLw/tXYKUK.zmi0tEYtqOOB11a', NULL, NULL, NULL, 'a9811f18a2bddf642b29d42aa90f1328', NULL, NULL, 1, 0, '2021-08-12 15:02:07', '2021-08-12 15:02:07', NULL),
(38, 'sallim.fauzy@astra-visteon.com', 'M. Sallim Syahied Fauzy', 5, 2, 0, 'RnD', 'manager', '1637116240_3d0396900f237a3c9b1f.jpg', '$2y$10$PZ73bsJ7XxXBaWFecmDpUu6o8YpGLw/tXYKUK.zmi0tEYtqOOB11a', NULL, NULL, NULL, '5f4d5e67319921b61cae394b366d2d3b', NULL, NULL, 1, 0, '2021-08-31 14:46:00', '2021-08-31 14:46:00', NULL),
(39, 'ade.sarastiti@astra-visteon.com', 'Ade Rukmi Sarastiti', 6, 3, 5, 'Quality Assurance', 'user', '1636096980_c05d0c4cd777f29ec762.png', '$2y$10$PZ73bsJ7XxXBaWFecmDpUu6o8YpGLw/tXYKUK.zmi0tEYtqOOB11a', NULL, NULL, NULL, '4ceb79f5af51b8d7ccff1ce7fc762f42', NULL, NULL, 1, 0, '2021-08-31 14:48:54', '2021-08-31 14:48:54', NULL),
(40, 'jemy.akvianto@astra-visteon.com', 'Jemy Akvianto', 6, 2, 14, 'RnD', 'user', 'profile-image.png', '$2y$10$PZ73bsJ7XxXBaWFecmDpUu6o8YpGLw/tXYKUK.zmi0tEYtqOOB11a', NULL, NULL, NULL, '1224770e74cca3c1e47069a3d2f4133a', NULL, NULL, 1, 0, '2021-09-09 09:30:24', '2021-09-09 09:30:24', NULL),
(41, 'zharfan.firas@astra-visteon.com', 'Zharfan Firas', 6, 2, 14, 'RnD', 'user', 'profile-image.png', '$2y$10$PZ73bsJ7XxXBaWFecmDpUu6o8YpGLw/tXYKUK.zmi0tEYtqOOB11a', NULL, NULL, NULL, '342cf0033a3fd24764051e28cfa6bdd3', NULL, NULL, 1, 0, '2021-09-09 09:31:09', '2021-09-09 09:31:09', NULL),
(65, 'nanang.kriscandono@astra-visteon.com', 'Nanang Kriscandono', 5, 1, 0, '', 'user', 'profile-image.png', '$2y$10$f8j9j9fPUf90REgs2ohG1emce0gZ1t2yc6o1Dkj0uTFFNhjXoW8g2', NULL, NULL, NULL, '30cad4a640961b089a032d2c88439257', NULL, NULL, 1, 0, '2021-10-12 16:36:03', '2021-10-12 16:36:03', NULL),
(66, 'bayu.wibisono@astra-visteon.com', 'Bayu Wibisono', 5, 5, 0, '', 'user', 'profile-image.png', '$2y$10$dAZj.vZzqeod8MJuyjwZCeA0Ac.EN0kuLf8M5gyQfEFiQYkuh8mX.', NULL, NULL, NULL, '15959a2e96c163b86c8b31c9d91780a1', NULL, NULL, 1, 0, '2021-10-12 16:38:22', '2021-10-12 16:38:22', NULL),
(67, 'veronica.verawaty@astra-visteon.com', 'Veronica Verawaty Manurung', 6, 7, 11, '', 'user', 'profile-image.png', '$2y$10$AOgRky6z2X.vT/llNsEkWusBsJFP9PTbOlrbILd3QK3.MpSvzzLiO', NULL, NULL, NULL, 'f0999a7e5359ad449f35731e107e103c', NULL, NULL, 1, 0, '2021-10-13 15:41:05', '2021-10-13 15:41:05', NULL),
(68, 'agung.budiyanto@astra-visteon.com', 'Agung Budiyanto', 5, 3, 0, '', 'user', 'profile-image.png', '$2y$10$Bi4/OrOsgwQ/arCmf9695.WCRQgEq9g0JkgxSXSZ0kueQmEyccHwK', NULL, NULL, NULL, '817c0ae228fb208f12994e3c2ac8352e', NULL, NULL, 1, 0, '2021-10-13 16:03:46', '2021-10-13 16:03:46', NULL),
(71, 'ali.zunan@astra-visteon.com', 'Ali Zunan', 2, 0, 0, '', 'user', 'profile-image.png', '$2y$10$kFE6H9hry0CUPoXZ2v2w5e75OW4zK2ctJaBVgk1s9kYqDZSO.GjhW', NULL, NULL, NULL, 'eb91fedf5a6c38cf98f9ba81548895de', NULL, NULL, 1, 0, '2021-10-26 09:18:51', '2021-10-26 09:18:51', NULL),
(72, 'erik.nugraha@astra-visteon.com', 'Erik Nugraha', 5, 4, 0, '', 'user', 'profile-image.png', '$2y$10$usTepddAkXc8AA//mY0NGeFWuQoXj.GImoxk.WRWP5.OO8eqreWkq', NULL, NULL, NULL, '1733f35cc69e2a88ceb8087f56f517e5', NULL, NULL, 1, 0, '2021-10-26 09:21:02', '2021-10-26 09:21:02', NULL),
(73, 'rizka.febrianita@astra-visteon.com', 'Rizka Febrianita', 5, 7, 0, '', 'user', 'profile-image.png', '$2y$10$gvNm3iErwZNth0OBhMtSTu9S3Xltaz8z0fLmjPxrIe7bxIPZlp/tS', NULL, NULL, NULL, '33e2701bf09cef5181637848799dde47', NULL, NULL, 1, 0, '2021-10-26 09:22:57', '2021-10-26 09:22:57', NULL),
(74, 'arif.setiawan@astra-visteon.com', 'Arif Setiawan', 6, 3, 5, '', 'user', 'profile-image.png', '$2y$10$qAOUAEgHhVhIf4E8QdZxAeQR.SW0K7wRPpGTabYV6U.85ZAfzZFpC', NULL, NULL, NULL, 'dd56d1d8249eaa4fac7b07b3f01555eb', NULL, NULL, 1, 0, '2021-10-26 09:24:03', '2021-10-26 09:24:03', NULL),
(75, 'sadtu.risdiyati@astra-visteon.com', 'Sadtu Risdiyati', 6, 7, 10, '', 'user', 'profile-image.png', '$2y$10$8ddbRJL29AyV4yRkveJOvui2qj37n57MuI48abO6cYvmKtU3/k/3W', NULL, NULL, NULL, '9384cc2964b489d689ff7a071e981ccb', NULL, NULL, 1, 0, '2021-10-26 09:26:51', '2021-10-26 09:26:51', NULL),
(76, 'awang.andika@astra-visteon.com', 'Awang Dwi Andika', 6, 4, 9, '', 'user', 'profile-image.png', '$2y$10$5x44Qev.DhnSidC/8nvh1OJpOE9UJkzgjmMTQXpaGqjLlUJ25ycF6', NULL, NULL, NULL, '57e87e2b390f7271de49570e4b887179', NULL, NULL, 1, 0, '2021-10-26 09:28:14', '2021-10-26 09:28:14', NULL),
(77, 'fajri.ramadhan@astra-visteon.com', 'Fajri Ramadhan', 6, 5, 12, '', 'user', 'profile-image.png', '$2y$10$vqQI7DRskod2mzG8CSnzf.PoJPii6Y/tRrG7wbekQkzKl/6a9dgai', NULL, NULL, NULL, '72eace4a2af91fc6352f66d437094e05', NULL, NULL, 1, 0, '2021-10-26 09:29:42', '2021-10-26 09:29:42', NULL),
(78, 'destya.wijayanti@astra-visteon.com', 'Destya Ardi Wijayanti', 6, 6, 15, '', 'user', 'profile-image.png', '$2y$10$9gujrFKjaXLtJSuui46k1.GIzyDcSr4vNnLbwqeelBNd5n/WcOB.y', NULL, NULL, NULL, '6b4e8b2dff638eda4858193409d71e6d', NULL, NULL, 1, 0, '2021-11-17 09:08:52', '2021-11-17 09:08:52', NULL),
(79, 'sony.haryadi@astra-visteon.com', 'Sony Haryadi', 6, 4, 7, '', 'user', 'profile-image.png', '$2y$10$0iYyosZ86vyK8ZYd6X9sQuO6ejFAzIjGZAa6efQEmpD4416GKsMuK', NULL, NULL, NULL, '89fc22498328cff581feb3c51c5af8ee', NULL, NULL, 1, 0, '2021-11-17 11:00:48', '2021-11-17 11:00:48', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `approval`
--
ALTER TABLE `approval`
  ADD PRIMARY KEY (`id`),
  ADD KEY `task_id` (`task_id`),
  ADD KEY `approve_user` (`approve_user`);

--
-- Indeks untuk tabel `approval_rio`
--
ALTER TABLE `approval_rio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rio_id` (`rio_id`),
  ADD KEY `approve_user` (`approve_user`);

--
-- Indeks untuk tabel `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `auth_groups`
--
ALTER TABLE `auth_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD KEY `auth_groups_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `group_id_permission_id` (`group_id`,`permission_id`);

--
-- Indeks untuk tabel `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD KEY `auth_groups_users_user_id_foreign` (`user_id`),
  ADD KEY `group_id_user_id` (`group_id`,`user_id`);

--
-- Indeks untuk tabel `auth_logins`
--
ALTER TABLE `auth_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `auth_permissions`
--
ALTER TABLE `auth_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_tokens_user_id_foreign` (`user_id`),
  ADD KEY `selector` (`selector`);

--
-- Indeks untuk tabel `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD KEY `auth_users_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `user_id_permission_id` (`user_id`,`permission_id`);

--
-- Indeks untuk tabel `avqs`
--
ALTER TABLE `avqs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `avqs_dir1`
--
ALTER TABLE `avqs_dir1`
  ADD PRIMARY KEY (`id`),
  ADD KEY `avqs_dir1_ibfk_1` (`avqs_id`);

--
-- Indeks untuk tabel `avqs_dir2`
--
ALTER TABLE `avqs_dir2`
  ADD PRIMARY KEY (`id`),
  ADD KEY `avqs_dir2_ibfk_1` (`avqs_id`),
  ADD KEY `avqs_dir2_ibfk_2` (`dir1_id`);

--
-- Indeks untuk tabel `avqs_file`
--
ALTER TABLE `avqs_file`
  ADD PRIMARY KEY (`id`),
  ADD KEY `avqs_id` (`avqs_id`),
  ADD KEY `dir1_id` (`dir1_id`),
  ADD KEY `dir2_id` (`dir2_id`);

--
-- Indeks untuk tabel `baan_approval`
--
ALTER TABLE `baan_approval`
  ADD PRIMARY KEY (`id`),
  ADD KEY `baan_appproval_ibfk_1` (`id_baan`),
  ADD KEY `user_approval` (`user_approval`);

--
-- Indeks untuk tabel `baan_file`
--
ALTER TABLE `baan_file`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `baan_type`
--
ALTER TABLE `baan_type`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `bom_approval`
--
ALTER TABLE `bom_approval`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bom_approval_ibfk_1` (`id_bom`);

--
-- Indeks untuk tabel `bom_approval_status`
--
ALTER TABLE `bom_approval_status`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `bom_file`
--
ALTER TABLE `bom_file`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_model` (`id_model`),
  ADD KEY `uploader` (`uploader`);

--
-- Indeks untuk tabel `bom_log`
--
ALTER TABLE `bom_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user`),
  ADD KEY `model` (`model`);

--
-- Indeks untuk tabel `budget`
--
ALTER TABLE `budget`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indeks untuk tabel `child_rio`
--
ALTER TABLE `child_rio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rio_id` (`rio_id`),
  ADD KEY `pic` (`pic`);

--
-- Indeks untuk tabel `child_rio_approval`
--
ALTER TABLE `child_rio_approval`
  ADD PRIMARY KEY (`id`),
  ADD KEY `child_rio_id` (`child_rio_id`),
  ADD KEY `approve_user` (`approve_user`);

--
-- Indeks untuk tabel `child_task`
--
ALTER TABLE `child_task`
  ADD PRIMARY KEY (`id`),
  ADD KEY `task_id` (`task_id`),
  ADD KEY `pic` (`pic`);

--
-- Indeks untuk tabel `child_task_approval`
--
ALTER TABLE `child_task_approval`
  ADD PRIMARY KEY (`id`),
  ADD KEY `child_task_id` (`child_task_id`),
  ADD KEY `approve_user` (`approve_user`);

--
-- Indeks untuk tabel `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `design_standard`
--
ALTER TABLE `design_standard`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `dwg_file`
--
ALTER TABLE `dwg_file`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uploader` (`uploader`),
  ADD KEY `dwg_file_ibfk_1` (`id_model`);

--
-- Indeks untuk tabel `dwg_log`
--
ALTER TABLE `dwg_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user`),
  ADD KEY `model` (`model`);

--
-- Indeks untuk tabel `dwg_model`
--
ALTER TABLE `dwg_model`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `engchange_4m`
--
ALTER TABLE `engchange_4m`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `engchange_approval`
--
ALTER TABLE `engchange_approval`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `engchange_request`
--
ALTER TABLE `engchange_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indeks untuk tabel `event_customer`
--
ALTER TABLE `event_customer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indeks untuk tabel `event_internal`
--
ALTER TABLE `event_internal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_internal_ibfk_1` (`project_id`);

--
-- Indeks untuk tabel `launch_cost`
--
ALTER TABLE `launch_cost`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indeks untuk tabel `lessonlearn`
--
ALTER TABLE `lessonlearn`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indeks untuk tabel `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `material_cost`
--
ALTER TABLE `material_cost`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indeks untuk tabel `mg_area`
--
ALTER TABLE `mg_area`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mg_file`
--
ALTER TABLE `mg_file`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mg_process`
--
ALTER TABLE `mg_process`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `model`
--
ALTER TABLE `model`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `productivity`
--
ALTER TABLE `productivity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indeks untuk tabel `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cust_id` (`cust_id`);

--
-- Indeks untuk tabel `quality`
--
ALTER TABLE `quality`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`),
  ADD KEY `lead` (`lead`);

--
-- Indeks untuk tabel `quality_cas`
--
ALTER TABLE `quality_cas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indeks untuk tabel `quality_custppap`
--
ALTER TABLE `quality_custppap`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`),
  ADD KEY `piv` (`pic`);

--
-- Indeks untuk tabel `quality_pvtest`
--
ALTER TABLE `quality_pvtest`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indeks untuk tabel `quality_pvtestsum`
--
ALTER TABLE `quality_pvtestsum`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indeks untuk tabel `quality_safelaunch`
--
ALTER TABLE `quality_safelaunch`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`),
  ADD KEY `lead` (`lead`);

--
-- Indeks untuk tabel `quality_supppap`
--
ALTER TABLE `quality_supppap`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`),
  ADD KEY `pic` (`pic`);

--
-- Indeks untuk tabel `rio`
--
ALTER TABLE `rio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pic` (`pic`),
  ADD KEY `project` (`project_id`);

--
-- Indeks untuk tabel `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`),
  ADD KEY `pic` (`pic`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `approval`
--
ALTER TABLE `approval`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT untuk tabel `approval_rio`
--
ALTER TABLE `approval_rio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `auth_groups`
--
ALTER TABLE `auth_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `auth_logins`
--
ALTER TABLE `auth_logins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=641;

--
-- AUTO_INCREMENT untuk tabel `auth_permissions`
--
ALTER TABLE `auth_permissions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `auth_tokens`
--
ALTER TABLE `auth_tokens`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `avqs`
--
ALTER TABLE `avqs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `avqs_dir1`
--
ALTER TABLE `avqs_dir1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `avqs_dir2`
--
ALTER TABLE `avqs_dir2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `avqs_file`
--
ALTER TABLE `avqs_file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `baan_approval`
--
ALTER TABLE `baan_approval`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `baan_file`
--
ALTER TABLE `baan_file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `baan_type`
--
ALTER TABLE `baan_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `bom_approval`
--
ALTER TABLE `bom_approval`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `bom_approval_status`
--
ALTER TABLE `bom_approval_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `bom_file`
--
ALTER TABLE `bom_file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `bom_log`
--
ALTER TABLE `bom_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `budget`
--
ALTER TABLE `budget`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `child_rio`
--
ALTER TABLE `child_rio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `child_rio_approval`
--
ALTER TABLE `child_rio_approval`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `child_task`
--
ALTER TABLE `child_task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `child_task_approval`
--
ALTER TABLE `child_task_approval`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `design_standard`
--
ALTER TABLE `design_standard`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `dwg_file`
--
ALTER TABLE `dwg_file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `dwg_log`
--
ALTER TABLE `dwg_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `dwg_model`
--
ALTER TABLE `dwg_model`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `engchange_4m`
--
ALTER TABLE `engchange_4m`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `engchange_approval`
--
ALTER TABLE `engchange_approval`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT untuk tabel `engchange_request`
--
ALTER TABLE `engchange_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `event_customer`
--
ALTER TABLE `event_customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `event_internal`
--
ALTER TABLE `event_internal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT untuk tabel `launch_cost`
--
ALTER TABLE `launch_cost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `lessonlearn`
--
ALTER TABLE `lessonlearn`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `level`
--
ALTER TABLE `level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `material_cost`
--
ALTER TABLE `material_cost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `mg_area`
--
ALTER TABLE `mg_area`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `mg_file`
--
ALTER TABLE `mg_file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `mg_process`
--
ALTER TABLE `mg_process`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `model`
--
ALTER TABLE `model`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `productivity`
--
ALTER TABLE `productivity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `project`
--
ALTER TABLE `project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `quality`
--
ALTER TABLE `quality`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `quality_cas`
--
ALTER TABLE `quality_cas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `quality_custppap`
--
ALTER TABLE `quality_custppap`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `quality_pvtest`
--
ALTER TABLE `quality_pvtest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `quality_pvtestsum`
--
ALTER TABLE `quality_pvtestsum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `quality_safelaunch`
--
ALTER TABLE `quality_safelaunch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `quality_supppap`
--
ALTER TABLE `quality_supppap`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `rio`
--
ALTER TABLE `rio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `section`
--
ALTER TABLE `section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `approval`
--
ALTER TABLE `approval`
  ADD CONSTRAINT `approval_ibfk_1` FOREIGN KEY (`task_id`) REFERENCES `task` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `approval_ibfk_2` FOREIGN KEY (`approve_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `approval_rio`
--
ALTER TABLE `approval_rio`
  ADD CONSTRAINT `approval_rio_ibfk_1` FOREIGN KEY (`approve_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `approval_rio_ibfk_2` FOREIGN KEY (`rio_id`) REFERENCES `rio` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD CONSTRAINT `auth_groups_permissions_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD CONSTRAINT `auth_groups_users_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD CONSTRAINT `auth_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD CONSTRAINT `auth_users_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_users_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `avqs_dir1`
--
ALTER TABLE `avqs_dir1`
  ADD CONSTRAINT `avqs_dir1_ibfk_1` FOREIGN KEY (`avqs_id`) REFERENCES `avqs` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `avqs_dir2`
--
ALTER TABLE `avqs_dir2`
  ADD CONSTRAINT `avqs_dir2_ibfk_1` FOREIGN KEY (`avqs_id`) REFERENCES `avqs` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `avqs_dir2_ibfk_2` FOREIGN KEY (`dir1_id`) REFERENCES `avqs_dir1` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `avqs_file`
--
ALTER TABLE `avqs_file`
  ADD CONSTRAINT `avqs_file_ibfk_1` FOREIGN KEY (`avqs_id`) REFERENCES `avqs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `avqs_file_ibfk_2` FOREIGN KEY (`dir1_id`) REFERENCES `avqs_dir1` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `avqs_file_ibfk_3` FOREIGN KEY (`dir2_id`) REFERENCES `avqs_dir2` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `baan_approval`
--
ALTER TABLE `baan_approval`
  ADD CONSTRAINT `baan_approval_ibfk_1` FOREIGN KEY (`id_baan`) REFERENCES `baan_file` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `baan_approval_ibfk_2` FOREIGN KEY (`user_approval`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `bom_approval`
--
ALTER TABLE `bom_approval`
  ADD CONSTRAINT `bom_approval_ibfk_1` FOREIGN KEY (`id_bom`) REFERENCES `bom_file` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `bom_file`
--
ALTER TABLE `bom_file`
  ADD CONSTRAINT `bom_file_ibfk_1` FOREIGN KEY (`id_model`) REFERENCES `model` (`id`),
  ADD CONSTRAINT `bom_file_ibfk_2` FOREIGN KEY (`uploader`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `bom_log`
--
ALTER TABLE `bom_log`
  ADD CONSTRAINT `bom_log_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `bom_log_ibfk_2` FOREIGN KEY (`model`) REFERENCES `model` (`id`);

--
-- Ketidakleluasaan untuk tabel `budget`
--
ALTER TABLE `budget`
  ADD CONSTRAINT `budget_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `child_rio`
--
ALTER TABLE `child_rio`
  ADD CONSTRAINT `child_rio_ibfk_1` FOREIGN KEY (`rio_id`) REFERENCES `rio` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `child_rio_approval`
--
ALTER TABLE `child_rio_approval`
  ADD CONSTRAINT `child_rio_approval_ibfk_1` FOREIGN KEY (`approve_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `child_rio_approval_ibfk_2` FOREIGN KEY (`child_rio_id`) REFERENCES `child_rio` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `child_task`
--
ALTER TABLE `child_task`
  ADD CONSTRAINT `child_task_ibfk_1` FOREIGN KEY (`pic`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `child_task_ibfk_2` FOREIGN KEY (`task_id`) REFERENCES `task` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `child_task_approval`
--
ALTER TABLE `child_task_approval`
  ADD CONSTRAINT `child_task_approval_ibfk_1` FOREIGN KEY (`approve_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `dwg_file`
--
ALTER TABLE `dwg_file`
  ADD CONSTRAINT `dwg_file_ibfk_1` FOREIGN KEY (`id_model`) REFERENCES `dwg_model` (`id`),
  ADD CONSTRAINT `dwg_file_ibfk_2` FOREIGN KEY (`uploader`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `dwg_log`
--
ALTER TABLE `dwg_log`
  ADD CONSTRAINT `dwg_log_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `dwg_log_ibfk_2` FOREIGN KEY (`model`) REFERENCES `dwg_model` (`id`);

--
-- Ketidakleluasaan untuk tabel `engchange_request`
--
ALTER TABLE `engchange_request`
  ADD CONSTRAINT `engchange_request_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `event_customer`
--
ALTER TABLE `event_customer`
  ADD CONSTRAINT `event_customer_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `event_internal`
--
ALTER TABLE `event_internal`
  ADD CONSTRAINT `event_internal_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `launch_cost`
--
ALTER TABLE `launch_cost`
  ADD CONSTRAINT `launch_cost_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `lessonlearn`
--
ALTER TABLE `lessonlearn`
  ADD CONSTRAINT `lessonlearn_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `material_cost`
--
ALTER TABLE `material_cost`
  ADD CONSTRAINT `material_cost_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `productivity`
--
ALTER TABLE `productivity`
  ADD CONSTRAINT `productivity_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `project_ibfk_1` FOREIGN KEY (`cust_id`) REFERENCES `customer` (`id`);

--
-- Ketidakleluasaan untuk tabel `quality`
--
ALTER TABLE `quality`
  ADD CONSTRAINT `quality_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `quality_cas`
--
ALTER TABLE `quality_cas`
  ADD CONSTRAINT `quality_cas_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `quality_custppap`
--
ALTER TABLE `quality_custppap`
  ADD CONSTRAINT `quality_custppap_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `quality_pvtest`
--
ALTER TABLE `quality_pvtest`
  ADD CONSTRAINT `quality_pvtest_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `quality_pvtestsum`
--
ALTER TABLE `quality_pvtestsum`
  ADD CONSTRAINT `quality_pvtestsum_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `quality_safelaunch`
--
ALTER TABLE `quality_safelaunch`
  ADD CONSTRAINT `quality_safelaunch_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `quality_supppap`
--
ALTER TABLE `quality_supppap`
  ADD CONSTRAINT `quality_supppap_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `rio`
--
ALTER TABLE `rio`
  ADD CONSTRAINT `rio_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `task_ibfk_1` FOREIGN KEY (`pic`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `task_ibfk_2` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
