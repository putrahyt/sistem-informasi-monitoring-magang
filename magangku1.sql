-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 25, 2026 at 04:37 AM
-- Server version: 9.6.0
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `magangku1`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id_absensi` int NOT NULL,
  `username_peserta` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `mentor_magang` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `absen_masuk` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jam_masuk` int DEFAULT NULL,
  `absen_pulang` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jam_pulang` int DEFAULT NULL,
  `izin_absen` text COLLATE utf8mb4_general_ci,
  `bukti_izin` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `img_absensi_masuk` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `img_absensi_pulang` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`id_absensi`, `username_peserta`, `mentor_magang`, `absen_masuk`, `jam_masuk`, `absen_pulang`, `jam_pulang`, `izin_absen`, `bukti_izin`, `img_absensi_masuk`, `img_absensi_pulang`, `tanggal`) VALUES
(29, 'peserta', 'mentor', 'true', 1777091521, 'true', 1777091589, NULL, NULL, 'absen_masuk_peserta_20260425_113201.jpeg', 'absen_pulang_peserta_20260425_113309.jpeg', '2026-04-25');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(256) COLLATE utf8mb4_general_ci NOT NULL,
  `role` char(10) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `date_created` int NOT NULL,
  `reset_token_hash` varchar(64) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `reset_token_expires_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`, `role`, `email`, `date_created`, `reset_token_hash`, `reset_token_expires_at`) VALUES
('adminmagang', '$2y$10$toqA69hdXhUhrAeInbvCfefFqQfMkSN5F758DneVQnTiDA90N/AAO', 'admin', 'appmagangku@gmail.com', 1744603157, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `aktivitas`
--

CREATE TABLE `aktivitas` (
  `id_aktivitas` int NOT NULL,
  `username_peserta` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL,
  `tanggal` int NOT NULL,
  `aktivitas` text COLLATE utf8mb4_general_ci NOT NULL,
  `catatan` text COLLATE utf8mb4_general_ci,
  `file_laporan` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `link_laporan` text COLLATE utf8mb4_general_ci,
  `catatan_mentor` text COLLATE utf8mb4_general_ci,
  `mentor_magang` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `is_seen` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aktivitas`
--

INSERT INTO `aktivitas` (`id_aktivitas`, `username_peserta`, `status`, `tanggal`, `aktivitas`, `catatan`, `file_laporan`, `link_laporan`, `catatan_mentor`, `mentor_magang`, `is_seen`) VALUES
(41, 'peserta', 2, 1777027800, 'Coba File', 'coba tambah file', 'Peserta_69eb4b0458253.png', '', 'keren', 'mentor', 1),
(42, 'peserta', 1, 1777027860, 'Coba URL', 'coba tambah url', NULL, 'https://www.google.com', 'mantap', 'mentor', 1),
(43, 'peserta', 0, 1777027860, 'Coba File dan  URL', 'coba file dan url', 'Peserta_69eb4b58d8ce2.png', 'https://www.google.com', NULL, 'mentor', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bimbingan`
--

CREATE TABLE `bimbingan` (
  `id_bimbingan` int NOT NULL,
  `pengirim` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `penerima` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `pesan` text COLLATE utf8mb4_general_ci,
  `tanggapan` text COLLATE utf8mb4_general_ci,
  `pesan_dilihat` enum('belum','sudah') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tanggapan_dibalas` enum('belum','sudah') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date_created_pesan` int NOT NULL,
  `date_created_tanggapan` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bimbingan`
--

INSERT INTO `bimbingan` (`id_bimbingan`, `pengirim`, `penerima`, `pesan`, `tanggapan`, `pesan_dilihat`, `tanggapan_dibalas`, `date_created_pesan`, `date_created_tanggapan`) VALUES
(36, 'peserta', 'mentor', 'Test bimbingan', 'test', 'sudah', 'sudah', 1777027984, 1777091731),
(37, 'mentor', 'peserta', 'Halo', NULL, 'belum', 'belum', 1777091743, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `datadiripeserta`
--

CREATE TABLE `datadiripeserta` (
  `username` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `tempat_lahir` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal_lahir` int NOT NULL,
  `jenis_kelamin` char(10) COLLATE utf8mb4_general_ci NOT NULL,
  `noHP` char(13) COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` varchar(256) COLLATE utf8mb4_general_ci NOT NULL,
  `jurusan` varchar(128) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `datadiripeserta`
--

INSERT INTO `datadiripeserta` (`username`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `noHP`, `alamat`, `jurusan`) VALUES
('peserta', 'Medan', 1776963600, 'Laki-Laki', '123', 'Medan', 'Sistem Komputer');

-- --------------------------------------------------------

--
-- Table structure for table `mentor`
--

CREATE TABLE `mentor` (
  `id_mentor` int NOT NULL,
  `fullname` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(256) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(60) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `noHP` char(13) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jabatan` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `divisi` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date_created` int NOT NULL,
  `image` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `role` char(10) COLLATE utf8mb4_general_ci NOT NULL,
  `reset_token_hash` varchar(64) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `reset_token_expires_at` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mentor`
--

INSERT INTO `mentor` (`id_mentor`, `fullname`, `username`, `password`, `email`, `noHP`, `jabatan`, `divisi`, `date_created`, `image`, `role`, `reset_token_hash`, `reset_token_expires_at`) VALUES
(51, 'Mentor', 'mentor', '$2y$10$FNczP3OMQJx1C2ydGgTubudsUAmmLejWhJ8DHRNLoUf1kwPUW5sHm', NULL, NULL, NULL, NULL, 1777027494, 'profile.jpg', 'mentor', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pengaturan`
--

CREATE TABLE `pengaturan` (
  `id_pengaturan` int NOT NULL,
  `latitude` char(15) COLLATE utf8mb4_general_ci NOT NULL,
  `longitude` char(15) COLLATE utf8mb4_general_ci NOT NULL,
  `jarak` char(15) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengaturan`
--

INSERT INTO `pengaturan` (`id_pengaturan`, `latitude`, `longitude`, `jarak`) VALUES
(1, '3.62617', '98.68406', '6000');

-- --------------------------------------------------------

--
-- Table structure for table `penilaian`
--

CREATE TABLE `penilaian` (
  `id_penilaian` int NOT NULL,
  `username_peserta` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `mentor` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `n_disiplin` char(3) COLLATE utf8mb4_general_ci NOT NULL,
  `n_kejujuran` char(3) COLLATE utf8mb4_general_ci NOT NULL,
  `n_etika` char(3) COLLATE utf8mb4_general_ci NOT NULL,
  `n_tanggungjawab` char(3) COLLATE utf8mb4_general_ci NOT NULL,
  `n_ilmujurusan` char(3) COLLATE utf8mb4_general_ci NOT NULL,
  `n_penggunaansoftware` char(3) COLLATE utf8mb4_general_ci NOT NULL,
  `n_hasilkerja` char(3) COLLATE utf8mb4_general_ci NOT NULL,
  `n_kerjatim` char(3) COLLATE utf8mb4_general_ci NOT NULL,
  `n_komunikatif` char(3) COLLATE utf8mb4_general_ci NOT NULL,
  `n_aktifdiskusi` char(3) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penilaian`
--

INSERT INTO `penilaian` (`id_penilaian`, `username_peserta`, `mentor`, `n_disiplin`, `n_kejujuran`, `n_etika`, `n_tanggungjawab`, `n_ilmujurusan`, `n_penggunaansoftware`, `n_hasilkerja`, `n_kerjatim`, `n_komunikatif`, `n_aktifdiskusi`) VALUES
(6, 'peserta', 'mentor', '99', '99', '99', '99', '99', '99', '99', '99', '99', '99');

-- --------------------------------------------------------

--
-- Table structure for table `peserta`
--

CREATE TABLE `peserta` (
  `id_peserta` int NOT NULL,
  `fullname_peserta` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(256) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `mentor_magang` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `instansi` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `divisi_magang` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `date_created` int NOT NULL,
  `role` char(10) COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `reset_token_hash` varchar(64) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `reset_token_expires_at` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `peserta`
--

INSERT INTO `peserta` (`id_peserta`, `fullname_peserta`, `username`, `password`, `email`, `mentor_magang`, `instansi`, `divisi_magang`, `date_created`, `role`, `image`, `reset_token_hash`, `reset_token_expires_at`) VALUES
(15, 'Peserta', 'peserta', '$2y$10$YhHZMF1Ci5JwV8muwZm49.2RNTlbKYLusNzC6aAgVHuxgDzwUXiOO', 'peserta@gmail.com', 'mentor', 'Indonesia', 'Aplikasi Informatika', 1777027683, 'peserta', '69eb4bdfce8dd.jpg', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id_absensi`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `aktivitas`
--
ALTER TABLE `aktivitas`
  ADD PRIMARY KEY (`id_aktivitas`);

--
-- Indexes for table `bimbingan`
--
ALTER TABLE `bimbingan`
  ADD PRIMARY KEY (`id_bimbingan`);

--
-- Indexes for table `datadiripeserta`
--
ALTER TABLE `datadiripeserta`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `mentor`
--
ALTER TABLE `mentor`
  ADD PRIMARY KEY (`id_mentor`);

--
-- Indexes for table `pengaturan`
--
ALTER TABLE `pengaturan`
  ADD PRIMARY KEY (`id_pengaturan`);

--
-- Indexes for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`id_penilaian`);

--
-- Indexes for table `peserta`
--
ALTER TABLE `peserta`
  ADD PRIMARY KEY (`id_peserta`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id_absensi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `aktivitas`
--
ALTER TABLE `aktivitas`
  MODIFY `id_aktivitas` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `bimbingan`
--
ALTER TABLE `bimbingan`
  MODIFY `id_bimbingan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `mentor`
--
ALTER TABLE `mentor`
  MODIFY `id_mentor` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `id_penilaian` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `peserta`
--
ALTER TABLE `peserta`
  MODIFY `id_peserta` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
