-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2024 at 10:35 AM
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
(453, 0x363636643030323035393837312e6a706567, 'Salsa', '2002-02-22', 22, 'jadbfkj', '+62 822-5432-6788', 'Satu', 'Wanita', '$2y$10$Ntp76WGYnjyU6/V/cQWZNOS6Mtw/GvHcjxTbjeL9Mc2nBR6w4mB/K', 'Salsa123.'),
(123456789, 0x363636613634633961346234322e6a7067, 'Sayang jaja', '2000-02-19', 24, 'apaaa', '+62 812-2251-8720', 'Satu', 'Pria', '$2y$10$xGZ/R8GUhNm.YX0WnBF7Lu6kB02xktkGLWGleGaGwTcD4ncFgwKAW', 'Bandung123.'),
(2147483647, 0x363636613833363862336562362e6a7067, 'kakakak', '2005-02-08', 19, 'nananannanana', '+62 812-2257-6397', 'Satu', 'Pria', '$2y$10$rJf6NrIGzEJO1Xbo22FwseU/4W35RnwvPs3.cBguIqFCPzFoVUzMC', 'Bandung12345.');

-- --------------------------------------------------------

--
-- Table structure for table `garjas_pria_push_up`
--

CREATE TABLE `garjas_pria_push_up` (
  `ID_Push_Up_Pria` int(11) NOT NULL,
  `NIP_Pengguna` int(20) NOT NULL,
  `Jumlah_Push_Up_Pria` int(4) NOT NULL,
  `Nilai_Push_Up_Pria` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `garjas_pria_push_up`
--

INSERT INTO `garjas_pria_push_up` (`ID_Push_Up_Pria`, `NIP_Pengguna`, `Jumlah_Push_Up_Pria`, `Nilai_Push_Up_Pria`) VALUES
(34, 736721, 39, 87);

-- --------------------------------------------------------

--
-- Table structure for table `garjas_wanita_chin_up`
--

CREATE TABLE `garjas_wanita_chin_up` (
  `ID_Wanita_Chin_Up` int(11) NOT NULL,
  `NIP_Pengguna` int(20) NOT NULL,
  `Jumlah_Chin_Up_Wanita` int(4) NOT NULL,
  `Nilai_Chin_Up_Wanita` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `garjas_wanita_chin_up`
--

INSERT INTO `garjas_wanita_chin_up` (`ID_Wanita_Chin_Up`, `NIP_Pengguna`, `Jumlah_Chin_Up_Wanita`, `Nilai_Chin_Up_Wanita`) VALUES
(6, 235235, 33, 57),
(7, 123123, 11, 19);

-- --------------------------------------------------------

--
-- Table structure for table `garjas_wanita_push_up`
--

CREATE TABLE `garjas_wanita_push_up` (
  `ID_Wanita_Push_Up` int(11) NOT NULL,
  `NIP_Pengguna` int(20) NOT NULL,
  `Jumlah_Push_Up_Wanita` int(4) NOT NULL,
  `Nilai_Push_Up_Wanita` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `garjas_wanita_push_up`
--

INSERT INTO `garjas_wanita_push_up` (`ID_Wanita_Push_Up`, `NIP_Pengguna`, `Jumlah_Push_Up_Wanita`, `Nilai_Push_Up_Wanita`) VALUES
(4, 66565, 32, 100);

-- --------------------------------------------------------

--
-- Table structure for table `garjas_wanita_shuttle_run`
--

CREATE TABLE `garjas_wanita_shuttle_run` (
  `ID_Wanita_Shuttle_Run` int(11) NOT NULL,
  `NIP_Pengguna` int(20) NOT NULL,
  `Jumlah_Shuttle_Run_Wanita` int(4) NOT NULL,
  `Nilai_Shuttle_Run_Wanita` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `garjas_wanita_shuttle_run`
--

INSERT INTO `garjas_wanita_shuttle_run` (`ID_Wanita_Shuttle_Run`, `NIP_Pengguna`, `Jumlah_Shuttle_Run_Wanita`, `Nilai_Shuttle_Run_Wanita`) VALUES
(6, 546645, 33, 89),
(7, 123123, 22, 66);

-- --------------------------------------------------------

--
-- Table structure for table `garjas_wanita_sit_up_kaki_di_tekuk`
--

CREATE TABLE `garjas_wanita_sit_up_kaki_di_tekuk` (
  `ID_Wanita_Sit_Up_Kaki_Di_Tekuk` int(11) NOT NULL,
  `NIP_Pengguna` int(20) NOT NULL,
  `Jumlah_Sit_Up_Kaki_Di_Tekuk_Wanita` int(4) NOT NULL,
  `Nilai_Sit_Up_Kaki_Di_Tekuk_Wanita` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `garjas_wanita_sit_up_kaki_lurus`
--

CREATE TABLE `garjas_wanita_sit_up_kaki_lurus` (
  `ID_Wanita_Sit_Up_Kaki_Lurus` int(11) NOT NULL,
  `NIP_Pengguna` int(20) NOT NULL,
  `Jumlah_Sit_Up_Kaki_Lurus_Wanita` int(4) NOT NULL,
  `Nilai_Sit_Up_Kaki_Lurus_Wanita` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `garjas_wanita_sit_up_kaki_lurus`
--

INSERT INTO `garjas_wanita_sit_up_kaki_lurus` (`ID_Wanita_Sit_Up_Kaki_Lurus`, `NIP_Pengguna`, `Jumlah_Sit_Up_Kaki_Lurus_Wanita`, `Nilai_Sit_Up_Kaki_Lurus_Wanita`) VALUES
(8, 546645, 22, 38);

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
(10011, 0x313731383235363530335f392e6a7067, 'Sandro Anugrah Tambunan', '2004-02-21', 20, 'BatujajarBarat', '+62 822-6552-2341', 'Satu', 'Pria', '$2y$10$1bpr2GLdeYPFSjXVPGvcN.UpVlH3zqQJEpf.9Umn67.64UuSPg63a', '$2y$10$1bpr2GLdeYPFSjXVPGvcN.UpVlH3zqQJEpf.9Umn67.64UuSPg63a'),
(66565, 0x313731383433343336385f323533343031353132322e6a7067, 'Akulah Sang Prabu', '1970-06-13', 54, 'asdvfb', '+62 264-8548-8', 'Satu', 'Wanita', '$2y$10$ArOag.QG/WPiGaBEhzG2neTRDY9tIEdxvMCKYHLHOzXO7KE2V5uQC', '$2y$10$ArOag.QG/WPiGaBEhzG2neTRDY9tIEdxvMCKYHLHOzXO7KE2V5uQC'),
(123123, 0x313731383432313031395f61352e6a7067, 'Sayang', '2003-12-08', 20, 'ewrwer', '+62 081-2261-18238', 'Satu', 'Wanita', '$2y$10$eRU7Cc4hhiVgU26JIAPjjeb0Lz4tTq63Ds2HhnKVL9QSvVbHCLZjS', '$2y$10$eRU7Cc4hhiVgU26JIAPjjeb0Lz4tTq63Ds2HhnKVL9QSvVbHCLZjS'),
(235235, 0x313731383432363834365f79756e612e6a7067, 'Adrian Musa', '2004-02-03', 20, 'asdasdas', '+62 081-3823-3873', 'Satu', 'Wanita', '$2y$10$YIhsi6iVPUE9Upt8wlq5fut9CnUpcUKmLyXAi9tg6ZtC4TBz8VZmK', '$2y$10$YIhsi6iVPUE9Upt8wlq5fut9CnUpcUKmLyXAi9tg6ZtC4TBz8VZmK'),
(546645, 0x313731383432313035345f41312e6a7067, 'Adrian', '2006-08-31', 17, 'pawkdpawpdk', '+62 082-8281-128283', 'Satu', 'Wanita', '$2y$10$ormjRB1xpvlRy60JKn/PK.pH51JAWdDmBrUQ60/REvNWdTgBfjf/.', '$2y$10$ormjRB1xpvlRy60JKn/PK.pH51JAWdDmBrUQ60/REvNWdTgBfjf/.'),
(736721, 0x313731383432303133335f352e6a706567, 'Istri Sandro', '1995-02-02', 29, 'Rumah Sandro', '+62 822-1334-4567', 'Satu', 'Pria', '$2y$10$NenIHskNuK/zMWWmMspcz.ss80Ggc5YRgDVyXJLDNd2hxDk.dVcAS', '$2y$10$NenIHskNuK/zMWWmMspcz.ss80Ggc5YRgDVyXJLDNd2hxDk.dVcAS'),
(34358347, 0x313731383431393630365f332e6a706567, 'Rara Cantik', '2002-02-02', 22, 'Siantar', '+62 822-6552-2321', 'Satu', 'Wanita', '$2y$10$jFUOR3Fai39QbQHuV/TwIewAb2dprelCu60p7Tv7vnBeW4pEyPByu', '$2y$10$jFUOR3Fai39QbQHuV/TwIewAb2dprelCu60p7Tv7vnBeW4pEyPByu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`NIP_Admin`);

--
-- Indexes for table `garjas_pria_push_up`
--
ALTER TABLE `garjas_pria_push_up`
  ADD PRIMARY KEY (`ID_Push_Up_Pria`),
  ADD KEY `NIP_Pengguna` (`NIP_Pengguna`);

--
-- Indexes for table `garjas_wanita_chin_up`
--
ALTER TABLE `garjas_wanita_chin_up`
  ADD PRIMARY KEY (`ID_Wanita_Chin_Up`),
  ADD KEY `NIP_Pengguna` (`NIP_Pengguna`);

--
-- Indexes for table `garjas_wanita_push_up`
--
ALTER TABLE `garjas_wanita_push_up`
  ADD PRIMARY KEY (`ID_Wanita_Push_Up`),
  ADD KEY `NIP_Pengguna` (`NIP_Pengguna`);

--
-- Indexes for table `garjas_wanita_shuttle_run`
--
ALTER TABLE `garjas_wanita_shuttle_run`
  ADD PRIMARY KEY (`ID_Wanita_Shuttle_Run`),
  ADD KEY `NIP_Pengguna` (`NIP_Pengguna`);

--
-- Indexes for table `garjas_wanita_sit_up_kaki_di_tekuk`
--
ALTER TABLE `garjas_wanita_sit_up_kaki_di_tekuk`
  ADD PRIMARY KEY (`ID_Wanita_Sit_Up_Kaki_Di_Tekuk`),
  ADD KEY `NIP_Pengguna` (`NIP_Pengguna`);

--
-- Indexes for table `garjas_wanita_sit_up_kaki_lurus`
--
ALTER TABLE `garjas_wanita_sit_up_kaki_lurus`
  ADD PRIMARY KEY (`ID_Wanita_Sit_Up_Kaki_Lurus`),
  ADD KEY `NIP_Pengguna` (`NIP_Pengguna`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`NIP_Pengguna`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `garjas_pria_push_up`
--
ALTER TABLE `garjas_pria_push_up`
  MODIFY `ID_Push_Up_Pria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `garjas_wanita_chin_up`
--
ALTER TABLE `garjas_wanita_chin_up`
  MODIFY `ID_Wanita_Chin_Up` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `garjas_wanita_push_up`
--
ALTER TABLE `garjas_wanita_push_up`
  MODIFY `ID_Wanita_Push_Up` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `garjas_wanita_shuttle_run`
--
ALTER TABLE `garjas_wanita_shuttle_run`
  MODIFY `ID_Wanita_Shuttle_Run` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `garjas_wanita_sit_up_kaki_di_tekuk`
--
ALTER TABLE `garjas_wanita_sit_up_kaki_di_tekuk`
  MODIFY `ID_Wanita_Sit_Up_Kaki_Di_Tekuk` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `garjas_wanita_sit_up_kaki_lurus`
--
ALTER TABLE `garjas_wanita_sit_up_kaki_lurus`
  MODIFY `ID_Wanita_Sit_Up_Kaki_Lurus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `garjas_pria_push_up`
--
ALTER TABLE `garjas_pria_push_up`
  ADD CONSTRAINT `garjas_pria_push_up_ibfk_1` FOREIGN KEY (`NIP_Pengguna`) REFERENCES `pengguna` (`NIP_Pengguna`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
