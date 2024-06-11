-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2024 at 01:03 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `basarnas`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `NIP_Admin` int(20) NOT NULL,
  `Foto_Admin` longblob NOT NULL,
  `Nama_Lengkap_Admin` varchar(30) NOT NULL,
  `Tanggal_Lahir_Admin` date NOT NULL,
  `Umur_Admin` int(3) NOT NULL,
  `Alamat_Admin` text NOT NULL,
  `No_Telepon_Admin` varchar(20) NOT NULL,
  `Jabatan_Admin` enum('Satu','Dua','Tiga') NOT NULL,
  `Jenis_Kelamin_Admin` enum('Pria','Wanita') NOT NULL,
  `Kata_Sandi_Admin` varchar(100) NOT NULL,
  `Konfirmasi_Kata_Sandi_Admin` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`NIP_Admin`, `Foto_Admin`, `Nama_Lengkap_Admin`, `Tanggal_Lahir_Admin`, `Umur_Admin`, `Alamat_Admin`, `No_Telepon_Admin`, `Jabatan_Admin`, `Jenis_Kelamin_Admin`, `Kata_Sandi_Admin`, `Konfirmasi_Kata_Sandi_Admin`) VALUES
(12345678, 0x363636383132353763356566312e6a7067, 'Adrian Musa Alfauzan', '2006-01-31', 0, 'oawkdoawokdoakwodkaowkdawokdwa', '+62 081-2251-8720', 'Dua', 'Wanita', '$2y$10$9miiFe6kE48yFqECmLc4c.jt5Wl/w2ENBAQ6WtP1VxkDltJsh3hhC', 'Bandung123.'),
(2147483647, 0x363636383133626165316139322e6a7067, 'sayang', '2006-02-01', 18, 'halo baby', '+62 081-2227-128323', 'Dua', 'Pria', '$2y$10$0BKQ/ztnnhyFvj.F9.yNyuc/UJtGyQwjuC3DRqrxWEbdJa1jxeoDO', 'Kaka123.');

-- --------------------------------------------------------

--
-- Table structure for table `garjas_pria`
--

CREATE TABLE `garjas_pria` (
  `ID_Garjas_Pria` int(11) NOT NULL,
  `ID_Pengguna` int(11) NOT NULL,
  `Umur_Garjas_Pria` enum('<25','25-34','35-44','45-54','55-59') NOT NULL,
  `Detik_Garjas_Pria` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Nama_Garjas_Pria` enum('Menggantung','Chin Ups','SIt Up Kaki Di Tekuk','Sit Up Kaki Lurus','Push Ups','Shuttle Run') NOT NULL,
  `Jumlah_Garjas_Pria` int(3) DEFAULT NULL,
  `Point_Garjas_Pria` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `garjas_wanita`
--

CREATE TABLE `garjas_wanita` (
  `ID_Garjas_Wanita` int(11) NOT NULL,
  `ID_Pengguna` int(11) NOT NULL,
  `Umur_Garjas_Wanita` enum('<25','25-34','35-44','45-54','55-59') NOT NULL,
  `Nama_Garjas_Wanita` enum('Push Up','Shuttle Run','Sit Up Kaki Di Tekuk','Chinning') NOT NULL,
  `Jumlah_Garjas_Wanita` int(3) NOT NULL,
  `Point_Garjas_Wanita` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `NIP_Pengguna` int(20) NOT NULL,
  `Foto_Pengguna` longblob NOT NULL,
  `Nama_Lengkap_Pengguna` varchar(30) NOT NULL,
  `Tanggal_Lahir_Pengguna` date NOT NULL,
  `Umur_Pengguna` int(3) NOT NULL,
  `Alamat_Pengguna` text NOT NULL,
  `No_Telepon_Pengguna` varchar(20) NOT NULL,
  `Jabatan_Pengguna` enum('Satu','Dua','Tiga') NOT NULL,
  `Jenis_Kelamin_Pengguna` enum('Pria','Wanita') NOT NULL,
  `Kata_Sandi_Pengguna` varchar(100) NOT NULL,
  `Konfirmasi_Kata_Sandi_Pengguna` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`NIP_Pengguna`, `Foto_Pengguna`, `Nama_Lengkap_Pengguna`, `Tanggal_Lahir_Pengguna`, `Umur_Pengguna`, `Alamat_Pengguna`, `No_Telepon_Pengguna`, `Jabatan_Pengguna`, `Jenis_Kelamin_Pengguna`, `Kata_Sandi_Pengguna`, `Konfirmasi_Kata_Sandi_Pengguna`) VALUES
(21, 0x313731383130303331315f312e6a706567, 'Istri Sandro', '2004-02-21', 20, 'Batujajar', '+62 822-4557-7688', 'Satu', 'Pria', '$2y$10$lB/gdIf9Oi7NPjvqfougHuxSJ0.XHnVMGabC/yhWdz5bvHu9XKLRa', '$2y$10$lB/gdIf9Oi7NPjvqfougHuxSJ0.XHnVMGabC/yhWdz5bvHu9XKLRa'),
(87, 0x313731383130323835335f342e6a706567, 'Salsa', '2002-09-09', 21, 'Batujajar', '+62 877-5441-1234', 'Satu', 'Wanita', '$2y$10$nHXQKafHpiklNhfOeAi7.OThpKIxGTpIUYC21Sew8zVAf.UYjJ8o2', '$2y$10$nHXQKafHpiklNhfOeAi7.OThpKIxGTpIUYC21Sew8zVAf.UYjJ8o2');

-- --------------------------------------------------------

--
-- Table structure for table `test_jalan_kaki`
--

CREATE TABLE `test_jalan_kaki` (
  `ID_Jalan_Kaki` int(11) NOT NULL,
  `ID_Pengguna` int(11) NOT NULL,
  `Umur_Jalan_Kaki` enum('< 25','25 - 34','35 - 44','45 - 54','55 - 59') NOT NULL,
  `Waktu_Jalan_Kaki` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Nilai_Jalan_Kaki` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `test_lari`
--

CREATE TABLE `test_lari` (
  `ID_Test_Lari` int(11) NOT NULL,
  `ID_Pengguna` int(11) NOT NULL,
  `Jenis_Kelamin_Test_Lari` enum('Pria','Wanita') NOT NULL,
  `Umur` enum('< 25','25 - 34','35 - 44','45 - 54','55 - 59') NOT NULL,
  `Waktu_Test_Lari` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Nilai_Test_Lari` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `test_renang`
--

CREATE TABLE `test_renang` (
  `ID_Renang` int(11) NOT NULL,
  `ID_Pengguna` int(11) NOT NULL,
  `Umur` enum('18-25','26-30','31-35','36-40','41-43','44-46','47-49','50-52','53-55','56-58') NOT NULL,
  `Gaya_Renang` enum('Dada','Bebas','Lain','') NOT NULL,
  `Waktu` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Nilai_Renang` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`NIP_Admin`);

--
-- Indexes for table `garjas_pria`
--
ALTER TABLE `garjas_pria`
  ADD PRIMARY KEY (`ID_Garjas_Pria`),
  ADD KEY `ID_Pengguna` (`ID_Pengguna`);

--
-- Indexes for table `garjas_wanita`
--
ALTER TABLE `garjas_wanita`
  ADD PRIMARY KEY (`ID_Garjas_Wanita`),
  ADD KEY `ID_Pengguna` (`ID_Pengguna`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`NIP_Pengguna`);

--
-- Indexes for table `test_jalan_kaki`
--
ALTER TABLE `test_jalan_kaki`
  ADD PRIMARY KEY (`ID_Jalan_Kaki`),
  ADD KEY `ID_Pengguna` (`ID_Pengguna`);

--
-- Indexes for table `test_lari`
--
ALTER TABLE `test_lari`
  ADD PRIMARY KEY (`ID_Test_Lari`),
  ADD KEY `ID_Pengguna` (`ID_Pengguna`);

--
-- Indexes for table `test_renang`
--
ALTER TABLE `test_renang`
  ADD PRIMARY KEY (`ID_Renang`),
  ADD KEY `ID_Admin` (`ID_Pengguna`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `garjas_pria`
--
ALTER TABLE `garjas_pria`
  MODIFY `ID_Garjas_Pria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `garjas_wanita`
--
ALTER TABLE `garjas_wanita`
  MODIFY `ID_Garjas_Wanita` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `test_jalan_kaki`
--
ALTER TABLE `test_jalan_kaki`
  MODIFY `ID_Jalan_Kaki` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `test_lari`
--
ALTER TABLE `test_lari`
  MODIFY `ID_Test_Lari` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `test_renang`
--
ALTER TABLE `test_renang`
  MODIFY `ID_Renang` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
