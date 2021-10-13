-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2021 at 09:22 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `een`
--
CREATE DATABASE IF NOT EXISTS `een` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `een`;

-- --------------------------------------------------------

--
-- Table structure for table `capaian_ikk`
--

CREATE TABLE `capaian_ikk` (
  `id` int(11) NOT NULL,
  `ikk_id` int(11) NOT NULL,
  `pelaksana` varchar(255) NOT NULL,
  `capaian` text DEFAULT NULL,
  `analisa` text DEFAULT NULL,
  `kegiatan` text DEFAULT NULL,
  `kendala_hambatan` text DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `capaian_iku`
--

CREATE TABLE `capaian_iku` (
  `id` int(11) NOT NULL,
  `iku_id` int(11) NOT NULL,
  `capaian` text DEFAULT NULL,
  `analisa` text DEFAULT NULL,
  `kegiatan` text DEFAULT NULL,
  `kendala_hambatan` text DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dumas`
--

CREATE TABLE `dumas` (
  `id` int(11) NOT NULL,
  `satker_id` int(11) DEFAULT NULL,
  `berkas_masuk` double DEFAULT 0,
  `proses_auditor` double DEFAULT 0,
  `proses_irjen` double DEFAULT 0,
  `proses_menteri` double DEFAULT 0,
  `proses_kanwil` double DEFAULT 0,
  `jumlah_selesai` double DEFAULT 0,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dumas`
--

INSERT INTO `dumas` (`id`, `satker_id`, `berkas_masuk`, `proses_auditor`, `proses_irjen`, `proses_menteri`, `proses_kanwil`, `jumlah_selesai`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 123, 123, 3, 5, 6, 0, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:20'),
(2, 2, 0, 0, 4, 0, 6, 0, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:20'),
(3, 3, 0, 0, 0, 0, 0, 0, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:20'),
(4, 4, 0, 0, 0, 0, 0, 0, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:20'),
(5, 5, 0, 0, 0, 0, 0, 0, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:20'),
(6, 6, 0, 0, 0, 0, 0, 0, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:20'),
(7, 7, 0, 0, 0, 0, 0, 0, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:20'),
(8, 8, 0, 0, 0, 0, 0, 0, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:20'),
(9, 9, 0, 0, 0, 0, 0, 0, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:20'),
(10, 10, 0, 0, 0, 0, 0, 0, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:20'),
(11, 11, 0, 0, 0, 0, 0, 0, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:20'),
(12, 12, 0, 0, 0, 0, 0, 0, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:20'),
(13, 13, 0, 0, 0, 0, 0, 0, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:20'),
(14, 14, 0, 0, 0, 0, 0, 0, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:20'),
(15, 15, 0, 0, 0, 0, 0, 0, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:20'),
(16, 16, 0, 0, 0, 0, 0, 0, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:20'),
(17, 17, 0, 0, 0, 0, 0, 0, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:20'),
(18, 18, 0, 0, 0, 0, 0, 0, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:20'),
(19, 19, 0, 0, 0, 0, 0, 0, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:20'),
(20, 20, 0, 0, 0, 0, 0, 0, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:20'),
(21, 21, 0, 0, 0, 0, 0, 0, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:20'),
(22, 22, 0, 0, 0, 0, 0, 0, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:20'),
(23, 23, 0, 0, 0, 0, 0, 0, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:20'),
(24, 24, 0, 0, 0, 0, 0, 0, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:20'),
(25, 25, 0, 0, 0, 0, 0, 0, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:20'),
(26, 26, 0, 0, 0, 0, 0, 0, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:20'),
(27, 27, 0, 0, 0, 0, 0, 0, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:20'),
(28, 28, 0, 0, 0, 0, 0, 0, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:20'),
(29, 29, 0, 0, 0, 0, 0, 0, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:20'),
(30, 30, 0, 0, 0, 0, 0, 0, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:20'),
(31, 31, 0, 0, 0, 0, 0, 0, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:20'),
(32, 32, 0, 0, 0, 0, 0, 0, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:20'),
(33, 33, 0, 0, 0, 0, 0, 0, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:20'),
(34, 34, 0, 0, 0, 0, 0, 0, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:20'),
(35, 35, 0, 0, 0, 0, 0, 0, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:20'),
(36, 36, 0, 0, 0, 0, 0, 0, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:20'),
(37, 37, 0, 0, 0, 0, 0, 0, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:20'),
(38, 38, 0, 0, 0, 0, 0, 0, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:20'),
(39, 39, 0, 0, 0, 0, 0, 0, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:20'),
(40, 40, 0, 0, 0, 0, 0, 0, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:20'),
(41, 41, 0, 0, 0, 0, 0, 0, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:20'),
(42, 42, 0, 0, 0, 0, 0, 0, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:20'),
(43, 43, 0, 0, 0, 0, 0, 0, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:20'),
(44, 44, 0, 0, 0, 0, 0, 0, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:20');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `nama`, `file_path`, `created_at`, `updated_at`) VALUES
(4, 'template_laporan.docx', '/storage/uploads/template_laporan.docx', '2021-07-10 17:21:34', '2021-07-10 17:21:34');

-- --------------------------------------------------------

--
-- Table structure for table `hukdis`
--

CREATE TABLE `hukdis` (
  `id` int(11) NOT NULL,
  `satker_id` int(11) DEFAULT NULL,
  `berkas_masuk` double DEFAULT 0,
  `proses_auditor` double DEFAULT 0,
  `proses_irjen` double DEFAULT 0,
  `proses_menteri` double DEFAULT 0,
  `proses_setjen` double DEFAULT 0,
  `proses_satker` double DEFAULT 0,
  `sk_terbit` double DEFAULT 0,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hukdis`
--

INSERT INTO `hukdis` (`id`, `satker_id`, `berkas_masuk`, `proses_auditor`, `proses_irjen`, `proses_menteri`, `proses_setjen`, `proses_satker`, `sk_terbit`, `user_id`, `created_at`, `updated_at`) VALUES
(45, 1, 2, 4, 2, 0, NULL, NULL, NULL, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:37'),
(46, 2, 0, 0, 1, 1, NULL, NULL, NULL, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:37'),
(47, 3, 0, 0, 1, 1, NULL, NULL, NULL, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:37'),
(48, 4, 0, 0, 0, 0, NULL, NULL, NULL, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:37'),
(49, 5, 0, 0, 0, 0, NULL, NULL, NULL, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:37'),
(50, 6, 0, 0, 0, 0, NULL, NULL, NULL, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:37'),
(51, 7, 0, 0, 0, 0, NULL, NULL, NULL, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:37'),
(52, 8, 0, 0, 0, 0, NULL, NULL, NULL, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:37'),
(53, 9, 0, 0, 0, 0, NULL, NULL, NULL, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:37'),
(54, 10, 0, 0, 0, 0, NULL, NULL, NULL, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:37'),
(55, 11, 0, 0, 0, 0, NULL, NULL, NULL, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:37'),
(56, 12, 0, 0, 0, 0, NULL, NULL, NULL, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:37'),
(57, 13, 0, 0, 0, 0, NULL, NULL, NULL, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:37'),
(58, 14, 0, 0, 0, 0, NULL, NULL, NULL, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:37'),
(59, 15, 0, 0, 0, 0, NULL, NULL, NULL, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:37'),
(60, 16, 0, 0, 0, 0, NULL, NULL, NULL, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:37'),
(61, 17, 0, 0, 0, 0, NULL, NULL, NULL, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:37'),
(62, 18, 0, 0, 0, 0, NULL, NULL, NULL, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:37'),
(63, 19, 0, 0, 0, 0, NULL, NULL, NULL, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:37'),
(64, 20, 0, 0, 0, 0, NULL, NULL, NULL, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:37'),
(65, 21, 0, 0, 0, 0, NULL, NULL, NULL, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:37'),
(66, 22, 0, 0, 0, 0, NULL, NULL, NULL, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:37'),
(67, 23, 0, 0, 0, 0, NULL, NULL, NULL, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:37'),
(68, 24, 0, 0, 0, 0, NULL, NULL, NULL, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:37'),
(69, 25, 0, 0, 0, 0, NULL, NULL, NULL, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:37'),
(70, 26, 0, 0, 0, 0, NULL, NULL, NULL, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:37'),
(71, 27, 0, 0, 0, 0, NULL, NULL, NULL, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:37'),
(72, 28, 0, 0, 0, 0, NULL, NULL, NULL, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:37'),
(73, 29, 0, 0, 0, 0, NULL, NULL, NULL, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:37'),
(74, 30, 0, 0, 0, 0, NULL, NULL, NULL, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:37'),
(75, 31, 0, 0, 0, 0, NULL, NULL, NULL, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:37'),
(76, 32, 0, 0, 0, 0, NULL, NULL, NULL, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:37'),
(77, 33, 0, 0, 0, 0, NULL, NULL, NULL, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:37'),
(78, 34, 0, 0, 0, 0, NULL, NULL, NULL, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:37'),
(79, 35, 0, 0, 0, 0, NULL, NULL, NULL, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:37'),
(80, 36, 0, 0, 0, 0, NULL, NULL, NULL, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:37'),
(81, 37, 0, 0, 0, 0, NULL, NULL, NULL, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:37'),
(82, 38, 0, 0, 0, 0, NULL, NULL, NULL, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:37'),
(83, 39, 0, 0, 0, 0, NULL, NULL, NULL, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:37'),
(84, 40, 0, 0, 0, 0, NULL, NULL, NULL, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:37'),
(85, 41, 0, 0, 0, 0, NULL, NULL, NULL, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:37'),
(86, 42, 0, 0, 0, 0, NULL, NULL, NULL, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:37'),
(87, 43, 0, 0, 0, 0, NULL, NULL, NULL, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:37'),
(88, 44, 0, 0, 0, 0, NULL, NULL, NULL, 13, '2021-08-30 17:00:00', '2021-08-25 03:58:37');

-- --------------------------------------------------------

--
-- Table structure for table `indikator_ikk`
--

CREATE TABLE `indikator_ikk` (
  `id` int(11) NOT NULL,
  `nomor` int(11) DEFAULT NULL,
  `sk_id` int(11) NOT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  `pelaksana` enum('SEKRETARIAT INSPEKTORAT JENDERAL','INSPEKTORAT WILAYAH I','INSPEKTORAT WILAYAH II','INSPEKTORAT WILAYAH III','INSPEKTORAT WILAYAH IV','INSPEKTORAT WILAYAH V','INSPEKTORAT WILAYAH VI') DEFAULT NULL,
  `target` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `indikator_ikk`
--

INSERT INTO `indikator_ikk` (`id`, `nomor`, `sk_id`, `deskripsi`, `pelaksana`, `target`) VALUES
(1, 1, 1, 'Level IACM / Kapabilitas APIP ITJEN Kemenkumham', 'INSPEKTORAT WILAYAH I', '3 (Integrated)'),
(2, 2, 2, 'Persentase Pemanfaatan Penerapan Manajemen Risiko dalam Pelaksanaan Tugas dan Fungsi Satuan Kerja di Lingkungan Kerja Inspektorat Wilayah I', 'INSPEKTORAT WILAYAH I', '52%'),
(3, 3, 2, 'Persentase Peningkatan Pengelolaan Tindak Lanjut Rekomendasi Hasil Pengawasan Internal terkait pengembalian ke kas Negara di Lingkungan Kerja Inspektorat Wilayah I', 'INSPEKTORAT WILAYAH I', '62%'),
(4, 4, 2, 'Persentase Peningkatan Pengelolaan Tindak Lanjut Rekomendasi Hasil Pengawasan Internal terkait Administrasi di Lingkungan Kerja Inspektorat Wilayah I\r\n', 'INSPEKTORAT WILAYAH I', '82%'),
(5, 5, 2, 'Persentase Peningkatan Pengelolaan Tindak Lanjut Rekomendasi Hasil Pemeriksaan Eksternal terkait Kerugian Negara di Lingkungan Kerja Inspektorat Wilayah I', 'INSPEKTORAT WILAYAH I', '22%'),
(6, 6, 2, 'Persentase Peningkatan Pengelolaan Tindak Lanjut Rekomendasi Hasil Pemeriksaan Eksternal terkait Administrasi di Lingkungan Kerja Inspektorat Wilayah I\r\n', 'INSPEKTORAT WILAYAH I', '78%'),
(7, 7, 2, 'Persentase Satuan Kerja di Lingkungan Inspektorat Wilayah I yang mendapatkan Predikat WBK/WBBM ', 'INSPEKTORAT WILAYAH I', '6%'),
(8, 1, 3, 'Level IACM / Kapabilitas APIP ITJEN Kemenkumham', 'INSPEKTORAT WILAYAH II', '3 (Integrated)'),
(9, 2, 4, 'Persentase Pemanfaatan Penerapan Manajemen Risiko dalam Pelaksanaan Tugas dan Fungsi Satuan Kerja di Lingkungan Kerja Inspektorat Wilayah II', 'INSPEKTORAT WILAYAH II', '52%'),
(10, 3, 4, 'Persentase Peningkatan Pengelolaan Tindak Lanjut Rekomendasi Hasil Pengawasan Internal terkait pengembalian ke kas Negara di Lingkungan Kerja Inspektorat Wilayah II', 'INSPEKTORAT WILAYAH II', '62%'),
(11, 4, 4, 'Persentase Peningkatan Pengelolaan Tindak Lanjut Rekomendasi Hasil Pengawasan Internal terkait Administrasi di Lingkungan Kerja Inspektorat Wilayah II\r\n', 'INSPEKTORAT WILAYAH II', '82%'),
(12, 5, 4, 'Persentase Peningkatan Pengelolaan Tindak Lanjut Rekomendasi Hasil Pemeriksaan Eksternal terkait Kerugian Negara di Lingkungan Kerja Inspektorat Wilayah II', 'INSPEKTORAT WILAYAH II', '22%'),
(13, 6, 4, 'Persentase Peningkatan Pengelolaan Tindak Lanjut Rekomendasi Hasil Pemeriksaan Eksternal terkait Administrasi di Lingkungan Kerja Inspektorat Wilayah II\r\n', 'INSPEKTORAT WILAYAH II', '78%'),
(14, 7, 4, 'Persentase Satuan Kerja di Lingkungan Inspektorat Wilayah II yang mendapatkan Predikat WBK/WBBM ', 'INSPEKTORAT WILAYAH II', '6%'),
(15, 1, 5, 'Level IACM / Kapabilitas APIP ITJEN Kemenkumham', 'INSPEKTORAT WILAYAH III', '3 (Integrated)'),
(16, 2, 6, 'Persentase Pemanfaatan Penerapan Manajemen Risiko dalam Pelaksanaan Tugas dan Fungsi Satuan Kerja di Lingkungan Kerja Inspektorat Wilayah III', 'INSPEKTORAT WILAYAH III', '52%'),
(17, 3, 6, 'Persentase Peningkatan Pengelolaan Tindak Lanjut Rekomendasi Hasil Pengawasan Internal terkait pengembalian ke kas Negara di Lingkungan Kerja Inspektorat Wilayah III', 'INSPEKTORAT WILAYAH III', '62%'),
(18, 4, 6, 'Persentase Peningkatan Pengelolaan Tindak Lanjut Rekomendasi Hasil Pengawasan Internal terkait Administrasi di Lingkungan Kerja Inspektorat Wilayah III\r\n', 'INSPEKTORAT WILAYAH III', '82%'),
(19, 5, 6, 'Persentase Peningkatan Pengelolaan Tindak Lanjut Rekomendasi Hasil Pemeriksaan Eksternal terkait Kerugian Negara di Lingkungan Kerja Inspektorat Wilayah III', 'INSPEKTORAT WILAYAH III', '22%'),
(20, 6, 6, 'Persentase Peningkatan Pengelolaan Tindak Lanjut Rekomendasi Hasil Pemeriksaan Eksternal terkait Administrasi di Lingkungan Kerja Inspektorat Wilayah III\r\n', 'INSPEKTORAT WILAYAH III', '78%'),
(21, 7, 6, 'Persentase Satuan Kerja di Lingkungan Inspektorat Wilayah III yang mendapatkan Predikat WBK/WBBM ', 'INSPEKTORAT WILAYAH III', '6%'),
(22, 1, 7, 'Level IACM / Kapabilitas APIP ITJEN Kemenkumham', 'INSPEKTORAT WILAYAH IV', '3 (Integrated)'),
(23, 2, 8, 'Persentase Pemanfaatan Penerapan Manajemen Risiko dalam Pelaksanaan Tugas dan Fungsi Satuan Kerja di Lingkungan Kerja Inspektorat Wilayah IV', 'INSPEKTORAT WILAYAH IV', '52%'),
(24, 3, 8, 'Persentase Peningkatan Pengelolaan Tindak Lanjut Rekomendasi Hasil Pengawasan Internal terkait pengembalian ke kas Negara di Lingkungan Kerja Inspektorat Wilayah IV', 'INSPEKTORAT WILAYAH IV', '62%'),
(25, 4, 8, 'Persentase Peningkatan Pengelolaan Tindak Lanjut Rekomendasi Hasil Pengawasan Internal terkait Administrasi di Lingkungan Kerja Inspektorat Wilayah IV\r\n', 'INSPEKTORAT WILAYAH IV', '82%'),
(26, 5, 8, 'Persentase Peningkatan Pengelolaan Tindak Lanjut Rekomendasi Hasil Pemeriksaan Eksternal terkait Kerugian Negara di Lingkungan Kerja Inspektorat Wilayah IV', 'INSPEKTORAT WILAYAH IV', '22%'),
(27, 6, 8, 'Persentase Peningkatan Pengelolaan Tindak Lanjut Rekomendasi Hasil Pemeriksaan Eksternal terkait Administrasi di Lingkungan Kerja Inspektorat Wilayah IV\r\n', 'INSPEKTORAT WILAYAH IV', '78%'),
(28, 7, 8, 'Persentase Satuan Kerja di Lingkungan Inspektorat Wilayah IV yang mendapatkan Predikat WBK/WBBM ', 'INSPEKTORAT WILAYAH IV', '6%'),
(29, 1, 9, 'Level IACM / Kapabilitas APIP ITJEN Kemenkumham', 'INSPEKTORAT WILAYAH V', '3 (Integrated)'),
(30, 2, 10, 'Persentase Pemanfaatan Penerapan Manajemen Risiko dalam Pelaksanaan Tugas dan Fungsi Satuan Kerja di Lingkungan Kerja Inspektorat Wilayah V', 'INSPEKTORAT WILAYAH V', '52%'),
(31, 3, 10, 'Persentase Peningkatan Pengelolaan Tindak Lanjut Rekomendasi Hasil Pengawasan Internal terkait pengembalian ke kas Negara di Lingkungan Kerja Inspektorat Wilayah V', 'INSPEKTORAT WILAYAH V', '62%'),
(32, 4, 10, 'Persentase Peningkatan Pengelolaan Tindak Lanjut Rekomendasi Hasil Pengawasan Internal terkait Administrasi di Lingkungan Kerja Inspektorat Wilayah V\r\n', 'INSPEKTORAT WILAYAH V', '82%'),
(33, 5, 10, 'Persentase Peningkatan Pengelolaan Tindak Lanjut Rekomendasi Hasil Pemeriksaan Eksternal terkait Kerugian Negara di Lingkungan Kerja Inspektorat Wilayah V', 'INSPEKTORAT WILAYAH V', '22%'),
(34, 6, 10, 'Persentase Peningkatan Pengelolaan Tindak Lanjut Rekomendasi Hasil Pemeriksaan Eksternal terkait Administrasi di Lingkungan Kerja Inspektorat Wilayah V\r\n', 'INSPEKTORAT WILAYAH V', '78%'),
(35, 7, 10, 'Persentase Satuan Kerja di Lingkungan Inspektorat Wilayah V yang mendapatkan Predikat WBK/WBBM ', 'INSPEKTORAT WILAYAH V', '6%'),
(36, 1, 11, 'Level IACM / Kapabilitas APIP ITJEN Kemenkumham', 'INSPEKTORAT WILAYAH VI', '3 (Integrated)'),
(37, 2, 12, 'Persentase Pemanfaatan Penerapan Manajemen Risiko dalam Pelaksanaan Tugas dan Fungsi Satuan Kerja di Lingkungan Kerja Inspektorat Wilayah VI', 'INSPEKTORAT WILAYAH VI', '52%'),
(38, 3, 12, 'Persentase Peningkatan Pengelolaan Tindak Lanjut Rekomendasi Hasil Pengawasan Internal terkait pengembalian ke kas Negara di Lingkungan Kerja Inspektorat Wilayah VI', 'INSPEKTORAT WILAYAH VI', '62%'),
(39, 4, 12, 'Persentase Peningkatan Pengelolaan Tindak Lanjut Rekomendasi Hasil Pengawasan Internal terkait Administrasi di Lingkungan Kerja Inspektorat Wilayah VI\r\n', 'INSPEKTORAT WILAYAH VI', '82%'),
(40, 5, 12, 'Persentase Peningkatan Pengelolaan Tindak Lanjut Rekomendasi Hasil Pemeriksaan Eksternal terkait Kerugian Negara di Lingkungan Kerja Inspektorat Wilayah VI', 'INSPEKTORAT WILAYAH VI', '22%'),
(41, 6, 12, 'Persentase Peningkatan Pengelolaan Tindak Lanjut Rekomendasi Hasil Pemeriksaan Eksternal terkait Administrasi di Lingkungan Kerja Inspektorat Wilayah VI\r\n', 'INSPEKTORAT WILAYAH VI', '78%'),
(42, 7, 12, 'Persentase Satuan Kerja di Lingkungan Inspektorat Wilayah VI yang mendapatkan Predikat WBK/WBBM ', 'INSPEKTORAT WILAYAH VI', '6%'),
(43, 1, 13, 'Pengelolaan Unit Pemberantasan Pungutan Liar (UPP) Kementerian Hukum dan HAM', 'SEKRETARIAT INSPEKTORAT JENDERAL', '1 Rekomendasi'),
(44, 2, 14, 'Indeks RB Inspektorat Jenderal', 'SEKRETARIAT INSPEKTORAT JENDERAL', '14.17'),
(45, 3, 14, 'Nilai SAKIP Inspektorat Jenderal \"BAIK\"', 'SEKRETARIAT INSPEKTORAT JENDERAL', '82.88'),
(46, 4, 14, 'Nilai Maturitas SPIP Inspektorat Jenderal', 'SEKRETARIAT INSPEKTORAT JENDERAL', 'Level 3 (Terdefinisi)'),
(47, 5, 15, 'Persentase SDM yang memenuhi standar kompetensi', 'SEKRETARIAT INSPEKTORAT JENDERAL', '82%'),
(48, 6, 15, 'Tingkat internalisasi pegawai Inspektorat Jenderal atas Tata Nilai Kemenkumham', 'SEKRETARIAT INSPEKTORAT JENDERAL', '3'),
(49, 7, 16, 'Persentase pemenuhan pengembangan teknologi informasi yang menunjang proses bisnis bidang pengawasan/ pengendalian internal\r\n', 'SEKRETARIAT INSPEKTORAT JENDERAL', '82%'),
(50, 8, 17, 'Persentase realisasi layanan perkantoran yang akuntabel\r\n', 'SEKRETARIAT INSPEKTORAT JENDERAL', '85%'),
(51, 9, 17, 'Jumlah layanan fasilitas kerumahtanggaan, BMN, dan sarpras internal', 'SEKRETARIAT INSPEKTORAT JENDERAL', '12 Bulan Layanan'),
(52, 10, 18, 'Laporan keuangan Itjen yang akuntabel', 'SEKRETARIAT INSPEKTORAT JENDERAL', 'WTP'),
(53, 11, 18, 'Persentase efektivitas pemanfaatan anggaran Itjen', 'SEKRETARIAT INSPEKTORAT JENDERAL', '87%'),
(54, 12, 18, 'Persentase fasilitasi pengelolaan tindak lanjut rekomendasi penyusunan RKA-KL Itjen', 'SEKRETARIAT INSPEKTORAT JENDERAL', '95%');

-- --------------------------------------------------------

--
-- Table structure for table `indikator_iku`
--

CREATE TABLE `indikator_iku` (
  `id` int(11) NOT NULL,
  `nomor` int(11) DEFAULT NULL,
  `ss_id` int(11) NOT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  `target` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `indikator_iku`
--

INSERT INTO `indikator_iku` (`id`, `nomor`, `ss_id`, `deskripsi`, `target`) VALUES
(1, 1, 1, 'Opini Audit Eksternal Atas Laporan Keuangan Kemenkumham', 'WTP'),
(2, 2, 2, 'Nilai Maturitas SPIP Kemenkumham', 'Level 3 (Terdefinisi)'),
(3, 3, 3, 'Persentase Satuan Kerja yang Nilai AKIP minimal “BB”', '92%'),
(4, 4, 3, 'Persentase Satuan Kerja yang nilai capaian RB minimal 90\r\n', '92%'),
(5, 5, 3, 'Persentase Satuan Kerja yang berhasil memperoleh predikat WBK/WBBM', '6%'),
(6, 6, 3, 'Indeks Persepsi Integritas Kemenkumham', '66');

-- --------------------------------------------------------

--
-- Table structure for table `indikator_sk`
--

CREATE TABLE `indikator_sk` (
  `id` int(11) NOT NULL,
  `nomor` int(11) DEFAULT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  `pelaksana` enum('SEKRETARIAT INSPEKTORAT JENDERAL','INSPEKTORAT WILAYAH I','INSPEKTORAT WILAYAH II','INSPEKTORAT WILAYAH III','INSPEKTORAT WILAYAH IV','INSPEKTORAT WILAYAH V','INSPEKTORAT WILAYAH VI') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `indikator_sk`
--

INSERT INTO `indikator_sk` (`id`, `nomor`, `deskripsi`, `pelaksana`) VALUES
(1, 1, 'Meningkatkan peran Inspektorat Jenderal sebagai Quality Assurance dan Cosulting', 'INSPEKTORAT WILAYAH I'),
(2, 2, 'Perencanaan Pengawasan Intern Berbasis Risiko untuk Meningkatkan Kualitas Kinerja Kemenkumham dalam Pembangunan Zona Integritas WBK/WBBM', 'INSPEKTORAT WILAYAH I'),
(3, 3, 'Meningkatkan peran Inspektorat Jenderal sebagai Quality Assurance dan Cosulting', 'INSPEKTORAT WILAYAH II'),
(4, 4, 'Perencanaan Pengawasan Intern Berbasis Risiko untuk Meningkatkan Kualitas Kinerja Kemenkumham dalam Pembangunan Zona Integritas WBK/WBBM', 'INSPEKTORAT WILAYAH II'),
(5, 5, 'Meningkatkan peran Inspektorat Jenderal sebagai Quality Assurance dan Cosulting', 'INSPEKTORAT WILAYAH III'),
(6, 6, 'Perencanaan Pengawasan Intern Berbasis Risiko untuk Meningkatkan Kualitas Kinerja Kemenkumham dalam Pembangunan Zona Integritas WBK/WBBM', 'INSPEKTORAT WILAYAH III'),
(7, 7, 'Meningkatkan peran Inspektorat Jenderal sebagai Quality Assurance dan Cosulting', 'INSPEKTORAT WILAYAH IV'),
(8, 8, 'Perencanaan Pengawasan Intern Berbasis Risiko untuk Meningkatkan Kualitas Kinerja Kemenkumham dalam Pembangunan Zona Integritas WBK/WBBM', 'INSPEKTORAT WILAYAH IV'),
(9, 9, 'Meningkatkan peran Inspektorat Jenderal sebagai Quality Assurance dan Cosulting', 'INSPEKTORAT WILAYAH V'),
(10, 10, 'Perencanaan Pengawasan Intern Berbasis Risiko untuk Meningkatkan Kualitas Kinerja Kemenkumham dalam Pembangunan Zona Integritas WBK/WBBM', 'INSPEKTORAT WILAYAH V'),
(11, 11, 'Meningkatkan peran Inspektorat Jenderal sebagai Quality Assurance dan Cosulting', 'INSPEKTORAT WILAYAH VI'),
(12, 12, 'Perencanaan Pengawasan Intern Berbasis Risiko untuk Meningkatkan Kualitas Kinerja Kemenkumham dalam Pembangunan Zona Integritas WBK/WBBM', 'INSPEKTORAT WILAYAH VI'),
(13, 13, 'Terimplementasinya Kebijakan Pemerintah tentang Pencegahan dan Pemberantasan Pungutan Liar', 'SEKRETARIAT INSPEKTORAT JENDERAL'),
(14, 14, 'Mengoptimalkan efektifitas penyelenggaraan tata Kelola organisasi dan reformasi birokrasi Inspektorat Jenderal', 'SEKRETARIAT INSPEKTORAT JENDERAL'),
(15, 15, 'Mengembangkan Sumber Daya Manusia Inspektorat Jenderal yang berkualitas, berintegritas, dan profesional', 'SEKRETARIAT INSPEKTORAT JENDERAL'),
(16, 16, 'Mengembangkan kualitas sistem informasi di Lingkungan Inspektorat Jenderal yang andal dan responsif', 'SEKRETARIAT INSPEKTORAT JENDERAL'),
(17, 17, 'Terwujudnya layanan kantor yang akuntabel\r\n', 'SEKRETARIAT INSPEKTORAT JENDERAL'),
(18, 18, 'Meningkatkan pengelolaan keuangan Inspektorat Jenderal yang optimal dan akuntabel', 'SEKRETARIAT INSPEKTORAT JENDERAL');

-- --------------------------------------------------------

--
-- Table structure for table `indikator_ss`
--

CREATE TABLE `indikator_ss` (
  `id` int(11) NOT NULL,
  `nomor` int(11) DEFAULT NULL,
  `deskripsi` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `indikator_ss`
--

INSERT INTO `indikator_ss` (`id`, `nomor`, `deskripsi`) VALUES
(1, 1, 'Terwujudnya pengelolaan keuangan yang akuntabel'),
(2, 2, 'Meningkatkan Sistem Pengendalian Internal yang partisipatif dan professional dalam pelaksanaan pengawasan intern yang efektif dilingkungan Kemenkumham'),
(3, 3, 'Mewujudkan Tata Kelola Pemerintahan yang efektif dan efesien di lingkungan Kemenkumham');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_anggaran`
--

CREATE TABLE `jenis_anggaran` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jenis_belanja` varchar(255) NOT NULL,
  `jenis_kegiatan` varchar(255) NOT NULL,
  `pagu` double DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis_anggaran`
--

INSERT INTO `jenis_anggaran` (`id`, `nama`, `jenis_belanja`, `jenis_kegiatan`, `pagu`) VALUES
(1, 'LAYANAN AUDIT INTERNAL', 'BELANJA BARANG', 'INSPEKTORAT WILAYAH I', 4248972000),
(2, 'PRIORITAS NASIONAL', 'BELANJA BARANG', 'INSPEKTORAT WILAYAH I', 1042760000),
(3, 'LAYANAN AUDIT INTERNAL', 'BELANJA BARANG', 'INSPEKTORAT WILAYAH II', 4248972000),
(4, 'PRIORITAS NASIONAL', 'BELANJA BARANG', 'INSPEKTORAT WILAYAH II', 1042760000),
(5, 'LAYANAN AUDIT INTERNAL', 'BELANJA BARANG', 'INSPEKTORAT WILAYAH III', 4248972000),
(6, 'PRIORITAS NASIONAL', 'BELANJA BARANG', 'INSPEKTORAT WILAYAH III', 1042760000),
(7, 'LAYANAN AUDIT INTERNAL', 'BELANJA BARANG', 'INSPEKTORAT WILAYAH IV', 4248972000),
(8, 'PRIORITAS NASIONAL', 'BELANJA BARANG', 'INSPEKTORAT WILAYAH IV', 1042760000),
(9, 'LAYANAN AUDIT INTERNAL', 'BELANJA BARANG', 'INSPEKTORAT WILAYAH V', 4248972000),
(10, 'PRIORITAS NASIONAL', 'BELANJA BARANG', 'INSPEKTORAT WILAYAH V', 1042760000),
(11, 'LAYANAN AUDIT INTERNAL', 'BELANJA BARANG', 'INSPEKTORAT WILAYAH VI', 4590590000),
(12, 'PRIORITAS NASIONAL', 'BELANJA BARANG', 'INSPEKTORAT WILAYAH VI', 3750600000),
(13, 'LAYANAN PERKANTORAN', 'BELANJA BARANG', 'DUKUNGAN MANAJEMEN', 22883836000),
(14, 'LAYANAN PERENCANAAN DAN PENGANGGARAN INTERNAL', 'BELANJA BARANG', 'DUKUNGAN MANAJEMEN', 557393000),
(15, 'LAYANAN UMUM', 'BELANJA BARANG', 'DUKUNGAN MANAJEMEN', 1405256000),
(16, 'LAYANAN SARANA INTERNAL', 'BELANJA BARANG', 'DUKUNGAN MANAJEMEN', 5158158000),
(17, 'LAYANAN SDM', 'BELANJA BARANG', 'DUKUNGAN MANAJEMEN', 1100162000),
(18, 'LAYANAN ORGANISASI DAN TATA KELOLA INTERNAL', 'BELANJA BARANG', 'DUKUNGAN MANAJEMEN', 211030000),
(19, 'LAYANAN KEHUMASAN DAN PROTOKOLER', 'BELANJA BARANG', 'DUKUNGAN MANAJEMEN', 1889276000),
(20, 'LAYANAN DATA DAN INFORMASI', 'BELANJA BARANG', 'DUKUNGAN MANAJEMEN', 528928000),
(21, 'LAYANAN PENGAWASAN INTERNAL', 'BELANJA BARANG', 'DUKUNGAN MANAJEMEN', 500000000),
(22, 'LAYANAN MONITORING DAN EVALUASI INTERNAL', 'BELANJA BARANG', 'DUKUNGAN MANAJEMEN', 408439000);

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan`
--

CREATE TABLE `kegiatan` (
  `id` int(11) NOT NULL,
  `jenis` enum('AUDIT','REVIU','EVALUASI','PEMANTAUAN','PENGAWASAN LAINNYA','PEMERIKSAAN KHUSUS','DUKUNGAN MANAJEMEN') NOT NULL,
  `nama` varchar(512) NOT NULL,
  `pelaksana` enum('SEKRETARIAT INSPEKTORAT JENDERAL','INSPEKTORAT WILAYAH I','INSPEKTORAT WILAYAH II','INSPEKTORAT WILAYAH III','INSPEKTORAT WILAYAH IV','INSPEKTORAT WILAYAH V','INSPEKTORAT WILAYAH VI') NOT NULL,
  `surat_perintah` varchar(512) NOT NULL,
  `tanggal_surat_perintah` timestamp NULL DEFAULT NULL,
  `tanggal_pelaksanaan` varchar(512) NOT NULL,
  `lokasi` text NOT NULL,
  `temuan` text DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kegiatan`
--

INSERT INTO `kegiatan` (`id`, `jenis`, `nama`, `pelaksana`, `surat_perintah`, `tanggal_surat_perintah`, `tanggal_pelaksanaan`, `lokasi`, `temuan`, `keterangan`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'AUDIT', 'xxxxx', 'INSPEKTORAT WILAYAH I', 'xxx', '2021-08-25 13:21:00', '25 Aug, 2021 - 25 Sep, 2021', 'xxx', 'xx', NULL, 1, '2021-08-25 13:21:00', '2021-08-25 03:35:16', '2021-08-25 03:35:16'),
(2, 'AUDIT', 'asasd', 'INSPEKTORAT WILAYAH I', 'asdasd', '2021-08-25 13:21:00', '25 Aug, 2021 - 25 Sep, 2021', 'asd', 'asd', NULL, 1, '2021-08-25 13:21:00', '2021-08-25 03:36:26', '2021-08-25 03:36:26'),
(3, 'AUDIT', 'asdasd', 'INSPEKTORAT WILAYAH I', 'asd', '2021-08-25 13:21:00', '25 Aug, 2021 - 25 Sep, 2021', 'asd', 'asd', NULL, 1, '2021-08-12 13:21:00', '2021-08-25 03:53:44', '2021-08-25 03:53:44');

-- --------------------------------------------------------

--
-- Table structure for table `kinerja_lainnya`
--

CREATE TABLE `kinerja_lainnya` (
  `id` int(11) NOT NULL,
  `pelaksana` varchar(255) NOT NULL,
  `kegiatan` tinytext DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kinerja_lainnya`
--

INSERT INTO `kinerja_lainnya` (`id`, `pelaksana`, `kegiatan`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'PROGRAM HUBUNGAN MASYARAKAT DAN PELAPORAN', 'asdasdasdsad', 11, '2021-08-25 13:21:00', '2021-08-25 03:53:27', '2021-08-25 03:53:27'),
(2, 'INSPEKTORAT WILAYAH I', 'asdasdasdasd', 1, '2021-08-25 13:21:00', '2021-08-25 05:07:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kompetensi`
--

CREATE TABLE `kompetensi` (
  `id` int(11) NOT NULL,
  `nama` varchar(512) NOT NULL,
  `jumlah_peserta` double NOT NULL,
  `jumlah_hari` double NOT NULL,
  `waktu_penyelenggaraan` varchar(512) NOT NULL,
  `peserta` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kompetensi`
--

INSERT INTO `kompetensi` (`id`, `nama`, `jumlah_peserta`, `jumlah_hari`, `waktu_penyelenggaraan`, `peserta`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'asdasdasd', 213123, 1231231, '25 Aug, 2021 - 25 Sep, 2021', NULL, 12, '2021-08-25 13:21:00', '2021-08-25 04:02:58', '2021-08-25 04:02:58'),
(2, 'sdasd', 100, 1, '25 Aug, 2021 - 25 Sep, 2021', '1. asdasd\r\n2. sadasdas\r\n3. asdasdas', 12, '2021-08-25 13:21:00', '2021-08-25 04:02:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penyelesaian_lhp`
--

CREATE TABLE `penyelesaian_lhp` (
  `id` int(11) NOT NULL,
  `nomor_surat_perintah` varchar(512) DEFAULT NULL,
  `tanggal_surat_perintah` timestamp NULL DEFAULT NULL,
  `nomor_lhp` varchar(512) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penyelesaian_lhp`
--

INSERT INTO `penyelesaian_lhp` (`id`, `nomor_surat_perintah`, `tanggal_surat_perintah`, `nomor_lhp`, `keterangan`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '2312412', '2021-08-25 10:57:38', 'sasdasd', 'asdasdasd', 1, '2021-08-25 13:21:00', '2021-08-25 03:57:53', '2021-08-25 03:57:53'),
(2, '123123', '2021-08-11 13:21:00', 'asdsad', 'asdasd', 1, '2021-08-11 13:21:00', '2021-08-25 03:57:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `realisasi_anggaran`
--

CREATE TABLE `realisasi_anggaran` (
  `id` int(11) NOT NULL,
  `kro_id` int(11) NOT NULL,
  `pagu` double DEFAULT 0,
  `realisasi` double DEFAULT 0,
  `sisa` double DEFAULT 0,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `realisasi_anggaran`
--

INSERT INTO `realisasi_anggaran` (`id`, `kro_id`, `pagu`, `realisasi`, `sisa`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 1042760000, 104276000, 1041760000, 14, '2021-08-25 13:21:00', '2021-08-25 04:11:51', NULL),
(2, 4, 1042760000, 20000000, 1022760000, 14, '2021-08-25 13:21:00', '2021-08-25 04:12:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `satker`
--

CREATE TABLE `satker` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `eselon` enum('I','II') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `satker`
--

INSERT INTO `satker` (`id`, `nama`, `eselon`) VALUES
(1, 'INSPEKTORAT JENDERAL', 'I'),
(2, 'SEKRETARIAT JENDERAL', 'I'),
(3, 'DITJEN KEKAYAAN INTELEKTUAL', 'I'),
(4, 'DITJEN ADMINISTRASI HUKUM UMUM', 'I'),
(5, 'BALITBANG HUKUM DAN HAM', 'I'),
(6, 'BADAN PEMBINAAN HUKUM NASIONAL', 'I'),
(7, 'DITJEN HAK ASASI MANUSIA', 'I'),
(8, 'DITJEN PEMASYARAKATAN', 'I'),
(9, 'BADAN PENGEMBANGAN SUMBER DAYA MANUSIA', 'I'),
(10, 'DITJEN PERATURAN PERUNDANG - UNDANGAN', 'I'),
(11, 'DITJEN IMIGRASI', 'I'),
(12, 'ACEH', 'II'),
(13, 'BALI', 'II'),
(14, 'BANTEN', 'II'),
(15, 'BENGKULU', 'II'),
(16, 'DI YOGYAKARTA', 'II'),
(17, 'DKI JAKARTA', 'II'),
(18, 'GORONTALO', 'II'),
(19, 'JAMBI', 'II'),
(20, 'JAWA BARAT', 'II'),
(21, 'JAWA TENGAH', 'II'),
(22, 'JAWA TIMUR', 'II'),
(23, 'KALIMANTAN BARAT', 'II'),
(24, 'KALIMANTAN SELATAN', 'II'),
(25, 'KALIMANTAN TENGAH', 'II'),
(26, 'KALIMANTAN TIMUR', 'II'),
(27, 'KEPULAUAN BANGKA BELITUNG', 'II'),
(28, 'KEPULAUAN RIAU', 'II'),
(29, 'LAMPUNG', 'II'),
(30, 'MALUKU', 'II'),
(31, 'MALUKU UTARA', 'II'),
(32, 'NUSA TENGGARA BARAT', 'II'),
(33, 'NUSA TENGGARA TIMUR', 'II'),
(34, 'PAPUA', 'II'),
(35, 'PAPUA BARAT', 'II'),
(36, 'RIAU', 'II'),
(37, 'SULAWESI BARAT', 'II'),
(38, 'SULAWESI SELATAN', 'II'),
(39, 'SULAWESI TENGAH', 'II'),
(40, 'SULAWESI TENGGARA', 'II'),
(41, 'SULAWESI UTARA', 'II'),
(42, 'SUMATERA BARAT', 'II'),
(43, 'SUMATERA SELATAN', 'II'),
(44, 'SUMATERA UTARA', 'II');

-- --------------------------------------------------------

--
-- Table structure for table `surat_masuk`
--

CREATE TABLE `surat_masuk` (
  `id` int(11) NOT NULL,
  `pelaksana` varchar(255) DEFAULT NULL,
  `surat` double DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `surat_masuk`
--

INSERT INTO `surat_masuk` (`id`, `pelaksana`, `surat`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 'INSPEKTORAT WILAYAH I', 100, 1, '2021-08-30 17:00:00', '2021-08-25 05:06:51'),
(3, 'PROGRAM HUBUNGAN MASYARAKAT DAN PELAPORAN', 10, 11, '2021-08-30 17:00:00', '2021-08-25 05:07:51');

-- --------------------------------------------------------

--
-- Table structure for table `temuan_eksternal`
--

CREATE TABLE `temuan_eksternal` (
  `id` int(11) NOT NULL,
  `obrik` varchar(512) NOT NULL,
  `tahun` double DEFAULT NULL,
  `rekomendasi_jumlah` double DEFAULT 0,
  `rekomendasi_nominal` double DEFAULT 0,
  `sesuai_jumlah` double DEFAULT 0,
  `sesuai_nominal` double DEFAULT 0,
  `proses_tl_jumlah` double DEFAULT 0,
  `proses_tl_nominal` double DEFAULT 0,
  `belum_tl_jumlah` double DEFAULT 0,
  `belum_tl_nominal` double DEFAULT 0,
  `setor_uang_ke_negara` int(11) DEFAULT 0,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `temuan_internal`
--

CREATE TABLE `temuan_internal` (
  `id` int(11) NOT NULL,
  `obrik` varchar(512) NOT NULL,
  `tahun` double DEFAULT NULL,
  `temuan_jumlah` double DEFAULT 0,
  `temuan_nominal` double DEFAULT 0,
  `sudah_tl_jumlah` double DEFAULT 0,
  `sudah_tl_nominal` double DEFAULT 0,
  `belum_tl_jumlah` double DEFAULT 0,
  `belum_tl_nominal` double DEFAULT 0,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `eselon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `eselon_3` enum('PROGRAM HUBUNGAN MASYARAKAT DAN PELAPORAN','UMUM','SISTEM INFORMASI PENGAWASAN','KEUANGAN','KEPEGAWAIAN') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `menu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level` enum('ESELON I','ESELON II','ESELON III','ESELON IV') COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('ADMINISTRATOR','USER','IRWIL','') COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `eselon`, `eselon_3`, `menu`, `password`, `photo`, `level`, `role`, `deleted_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'INSPEKTORAT WILAYAH I', 'irwil1@itjen.com', 'INSPEKTORAT WILAYAH I', NULL, 'IRWIL', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, 'ESELON II', 'USER', NULL, 'Fyv8fyKZBwwroYiJayjrnklnC5tC8MhqrilmuaCY0gIgO5Pimw6OH9TbyLXB', NULL, NULL),
(2, 'INSPEKTORAT WILAYAH II', 'irwil2@itjen.com', 'INSPEKTORAT WILAYAH II', NULL, 'IRWIL', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, 'ESELON II', 'USER', NULL, 'lqs5EJdZZOigtWBHIS1dMsglODp8d50zV2RzLaoLHkyVOM4AYDqbQJD5FgQW', '2021-06-25 05:27:51', '2021-06-25 05:27:51'),
(3, 'ADMINISTRATOR', 'admin@admin.com', 'Administrator', NULL, 'ADMIN', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, 'ESELON I', 'ADMINISTRATOR', NULL, 'sZkyMnsPnuQI6iA988dWOX3D3zmKGNOU9RcPwesn8CpW3LxlpCwGOxeeZHZo', '2021-06-25 05:27:51', '2021-06-25 05:27:51'),
(11, 'BAGIAN PROGRAM HUBUNGAN MASYARAKAT DAN PELAPORAN', 'php@itjen.com', 'SEKRETARIAT INSPEKTORAT JENDERAL', 'PROGRAM HUBUNGAN MASYARAKAT DAN PELAPORAN', 'PHP', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, 'ESELON III', 'USER', NULL, 'Jpk8KaRSSzek0bn11TzyappArHXAc0fcLXZWAzuZos7MpwpCJfLK17BoGX8n', '2021-06-25 05:27:51', '2021-06-25 05:27:51'),
(12, 'BAGIAN KEPEGAWAIAN', 'kepeg@itjen.com', 'SEKRETARIAT INSPEKTORAT JENDERAL', 'KEPEGAWAIAN', 'KEPEG', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, 'ESELON III', 'USER', NULL, 'S9Fws7UNwsnpUxnfJsn9eZdDiWIsairwwf5gJXeszC0TPX0sX3vFF79RwDrQ', '2021-06-25 05:27:51', '2021-06-25 05:27:51'),
(13, 'BAGIAN SISTEM INFORMASI PENGAWASAN', 'sip@itjen.com', 'SEKRETARIAT INSPEKTORAT JENDERAL', 'SISTEM INFORMASI PENGAWASAN', 'SIP', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, 'ESELON III', 'USER', NULL, '0XQ8cOCub05DA8wexAiV57MIkzzgQymtO8KPIF5Cg3tT6c60VLIMQ8XpjqqX', '2021-06-25 05:27:51', '2021-06-25 05:27:51'),
(14, 'BAGIAN KEUANGAN', 'keuangan@itjen.com', 'SEKRETARIAT INSPEKTORAT JENDERAL', 'KEUANGAN', 'KEUANGAN', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, 'ESELON III', 'USER', NULL, 'HrPkMkpjyRNC6g6uIUNSii8qftvmBVHyEqqs3Oo2rdJ1XJ9hPphfVrWB5YU7', '2021-06-25 05:27:51', '2021-06-25 05:27:51'),
(15, 'BAGIAN UMUM', 'umum@itjen.com', 'SEKRETARIAT INSPEKTORAT JENDERAL', 'UMUM', 'UMUM', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, 'ESELON III', 'USER', NULL, 'aIuRjzRKHPMHJo6KQYhNJHXwVwAZlOca5nzkaH29XQuwm1ZCX90dL1GWDFQT', '2021-06-25 05:27:51', '2021-06-25 05:27:51'),
(18, 'INSPEKTORAT WILAYAH III', 'irwil3@itjen.com', 'INSPEKTORAT WILAYAH III', NULL, 'IRWIL', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, 'ESELON II', 'USER', NULL, 'lqs5EJdZZOigtWBHIS1dMsglODp8d50zV2RzLaoLHkyVOM4AYDqbQJD5FgQW', '2021-06-25 05:27:51', '2021-06-25 05:27:51'),
(22, 'INSPEKTORAT WILAYAH IV', 'irwil4@itjen.com', 'INSPEKTORAT WILAYAH IV', NULL, 'IRWIL', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, 'ESELON II', 'USER', NULL, 'Hu7CueWdH5K0S5Z3O23BJosg86Bua3volonBr2Ry7a43Z37GdS4zoyHvbyHZ', NULL, NULL),
(23, 'INSPEKTORAT WILAYAH V', 'irwil5@itjen.com', 'INSPEKTORAT WILAYAH V', NULL, 'IRWIL', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, 'ESELON II', 'USER', NULL, 'lqs5EJdZZOigtWBHIS1dMsglODp8d50zV2RzLaoLHkyVOM4AYDqbQJD5FgQW', '2021-06-25 05:27:51', '2021-06-25 05:27:51'),
(24, 'INSPEKTORAT WILAYAH VI', 'irwil6@itjen.com', 'INSPEKTORAT WILAYAH VI', NULL, 'IRWIL', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, 'ESELON II', 'USER', NULL, 'lqs5EJdZZOigtWBHIS1dMsglODp8d50zV2RzLaoLHkyVOM4AYDqbQJD5FgQW', '2021-06-25 05:27:51', '2021-06-25 05:27:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `capaian_ikk`
--
ALTER TABLE `capaian_ikk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `capaian_iku`
--
ALTER TABLE `capaian_iku`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dumas`
--
ALTER TABLE `dumas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hukdis`
--
ALTER TABLE `hukdis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `indikator_ikk`
--
ALTER TABLE `indikator_ikk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `indikator_iku`
--
ALTER TABLE `indikator_iku`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `indikator_sk`
--
ALTER TABLE `indikator_sk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `indikator_ss`
--
ALTER TABLE `indikator_ss`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_anggaran`
--
ALTER TABLE `jenis_anggaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kinerja_lainnya`
--
ALTER TABLE `kinerja_lainnya`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kompetensi`
--
ALTER TABLE `kompetensi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `penyelesaian_lhp`
--
ALTER TABLE `penyelesaian_lhp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `realisasi_anggaran`
--
ALTER TABLE `realisasi_anggaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `satker`
--
ALTER TABLE `satker`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat_masuk`
--
ALTER TABLE `surat_masuk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temuan_eksternal`
--
ALTER TABLE `temuan_eksternal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temuan_internal`
--
ALTER TABLE `temuan_internal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `capaian_ikk`
--
ALTER TABLE `capaian_ikk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `capaian_iku`
--
ALTER TABLE `capaian_iku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dumas`
--
ALTER TABLE `dumas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hukdis`
--
ALTER TABLE `hukdis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `indikator_ikk`
--
ALTER TABLE `indikator_ikk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `indikator_iku`
--
ALTER TABLE `indikator_iku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `indikator_sk`
--
ALTER TABLE `indikator_sk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `indikator_ss`
--
ALTER TABLE `indikator_ss`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jenis_anggaran`
--
ALTER TABLE `jenis_anggaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kinerja_lainnya`
--
ALTER TABLE `kinerja_lainnya`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kompetensi`
--
ALTER TABLE `kompetensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `penyelesaian_lhp`
--
ALTER TABLE `penyelesaian_lhp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `realisasi_anggaran`
--
ALTER TABLE `realisasi_anggaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `satker`
--
ALTER TABLE `satker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `surat_masuk`
--
ALTER TABLE `surat_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `temuan_eksternal`
--
ALTER TABLE `temuan_eksternal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `temuan_internal`
--
ALTER TABLE `temuan_internal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
