-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2024 at 03:02 AM
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
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `ID_Absensi` int(11) NOT NULL,
  `NIP_Pengguna` bigint(20) NOT NULL,
  `Tanggal_Absensi` date NOT NULL,
  `Hari_Absensi` enum('Senin','Rabu') NOT NULL,
  `Jam_Absen` time NOT NULL,
  `Status_Absensi` enum('Hadir','Tidak Hadir','Hadir Pagi','Hadir Sore') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `NIP_Admin` bigint(20) NOT NULL,
  `Foto_Admin` varchar(100) NOT NULL,
  `Nama_Lengkap_Admin` varchar(30) NOT NULL,
  `Peran_Admin` enum('Super Admin','Admin') NOT NULL,
  `Tanggal_Lahir_Admin` date NOT NULL,
  `Umur_Admin` int(3) NOT NULL,
  `No_Telepon_Admin` varchar(20) NOT NULL,
  `Jabatan_Admin` enum('Pemula','Terampil','Mahir') NOT NULL,
  `Jenis_Kelamin_Admin` enum('Pria','Wanita') NOT NULL,
  `Kata_Sandi_Admin` varchar(100) NOT NULL,
  `Konfirmasi_Kata_Sandi_Admin` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`NIP_Admin`, `Foto_Admin`, `Nama_Lengkap_Admin`, `Peran_Admin`, `Tanggal_Lahir_Admin`, `Umur_Admin`, `No_Telepon_Admin`, `Jabatan_Admin`, `Jenis_Kelamin_Admin`, `Kata_Sandi_Admin`, `Konfirmasi_Kata_Sandi_Admin`) VALUES
(12345, '6676b8a1970c6.jpg', 'Syntax Squad brow', 'Super Admin', '2005-12-06', 18, '6281222728232', 'Terampil', 'Pria', '$2y$10$xGmPCeehCwkaNKGljJvbf.SiSwsIhFIKlpsW0eBsiN.oajHCf9fjO', '$2y$10$xGmPCeehCwkaNKGljJvbf.SiSwsIhFIKlpsW0eBsiN.oajHCf9fjO');

-- --------------------------------------------------------

--
-- Table structure for table `bmi`
--

CREATE TABLE `bmi` (
  `ID_BMI` int(11) NOT NULL,
  `NIP_Pengguna` bigint(20) NOT NULL,
  `Tanggal_Pemeriksaan` date NOT NULL,
  `Tinggi_BMI` int(4) NOT NULL,
  `Berat_BMI` int(4) NOT NULL,
  `Skor` int(3) NOT NULL,
  `Keterangan` enum('Berat Badan Kurang','Berat Badan Normal','Berat Badan Lebih','Obesitas') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `garjas_pria_chin_up`
--

CREATE TABLE `garjas_pria_chin_up` (
  `ID_Pria_Chin_Up` int(11) NOT NULL,
  `NIP_Pengguna` bigint(20) NOT NULL,
  `Tanggal_Pelaksanaan_Chin_Up_Pria` date NOT NULL,
  `Jumlah_Chin_Up_Pria` int(4) NOT NULL,
  `Nilai_Chin_Up_Pria` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `garjas_pria_menggantung`
--

CREATE TABLE `garjas_pria_menggantung` (
  `ID_Menggantung_Pria` int(11) NOT NULL,
  `NIP_Pengguna` bigint(20) NOT NULL,
  `Tanggal_Pelaksanaan_Pria_Menggantung` date NOT NULL,
  `Waktu_Menggantung_Pria` int(4) NOT NULL,
  `Nilai_Menggantung_Pria` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `garjas_pria_push_up`
--

CREATE TABLE `garjas_pria_push_up` (
  `ID_Push_Up_Pria` int(11) NOT NULL,
  `NIP_Pengguna` bigint(20) NOT NULL,
  `Tanggal_Pelaksanaan_Push_Up_Pria` date NOT NULL,
  `Jumlah_Push_Up_Pria` int(4) NOT NULL,
  `Nilai_Push_Up_Pria` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `garjas_pria_shuttle_run`
--

CREATE TABLE `garjas_pria_shuttle_run` (
  `ID_Shuttle_Run_Pria` int(11) NOT NULL,
  `NIP_Pengguna` bigint(20) NOT NULL,
  `Tanggal_Pelaksanaan_Shuttle_Run_Pria` date NOT NULL,
  `Waktu_Shuttle_Run_Pria` decimal(10,1) NOT NULL,
  `Nilai_Shuttle_Run_Pria` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `garjas_pria_sit_up_kaki_di_tekuk`
--

CREATE TABLE `garjas_pria_sit_up_kaki_di_tekuk` (
  `ID_Sit_Up_Kaki_Di_Tekuk_Pria` int(11) NOT NULL,
  `NIP_Pengguna` bigint(20) NOT NULL,
  `Tanggal_Pelaksanaan_Sit_Up_Kaki_Di_Tekuk` date NOT NULL,
  `Jumlah_Sit_Up_Kaki_Di_Tekuk_Pria` int(4) NOT NULL,
  `Nilai_Sit_Up_Kaki_Di_Tekuk_Pria` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `garjas_pria_sit_up_kaki_lurus`
--

CREATE TABLE `garjas_pria_sit_up_kaki_lurus` (
  `ID_Sit_Up_Kaki_Lurus_Pria` int(11) NOT NULL,
  `NIP_Pengguna` bigint(20) NOT NULL,
  `Tanggal_Pelaksanaan_Sit_Up_Kaki_Lurus_Pria` date NOT NULL,
  `Jumlah_Sit_Up_Kaki_Lurus_Pria` int(4) NOT NULL,
  `Nilai_Sit_Up_Kaki_Lurus_Pria` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `garjas_wanita_chin_up`
--

CREATE TABLE `garjas_wanita_chin_up` (
  `ID_Wanita_Chin_Up` int(11) NOT NULL,
  `NIP_Pengguna` bigint(20) NOT NULL,
  `Tanggal_Pelaksanaan_Chin_Up_Wanita` date NOT NULL,
  `Jumlah_Chin_Up_Wanita` int(4) NOT NULL,
  `Nilai_Chin_Up_Wanita` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `garjas_wanita_push_up`
--

CREATE TABLE `garjas_wanita_push_up` (
  `ID_Wanita_Push_Up` int(11) NOT NULL,
  `NIP_Pengguna` bigint(20) NOT NULL,
  `Tanggal_Pelaksanaan_Push_Up_Wanita` date NOT NULL,
  `Jumlah_Push_Up_Wanita` int(4) NOT NULL,
  `Nilai_Push_Up_Wanita` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `garjas_wanita_shuttle_run`
--

CREATE TABLE `garjas_wanita_shuttle_run` (
  `ID_Wanita_Shuttle_Run` int(11) NOT NULL,
  `NIP_Pengguna` bigint(20) NOT NULL,
  `Tanggal_Pelaksanaan_Shuttle_Run_Wanita` date NOT NULL,
  `Jumlah_Shuttle_Run_Wanita` decimal(10,1) NOT NULL,
  `Nilai_Shuttle_Run_Wanita` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `garjas_wanita_sit_up_kaki_di_tekuk`
--

CREATE TABLE `garjas_wanita_sit_up_kaki_di_tekuk` (
  `ID_Wanita_Sit_Up_Kaki_Di_Tekuk` int(11) NOT NULL,
  `NIP_Pengguna` bigint(20) NOT NULL,
  `Tanggal_Pelaksanaan_Sit_Up_Kaki_Di_Tekuk_Wanita` date NOT NULL,
  `Jumlah_Sit_Up_Kaki_Di_Tekuk_Wanita` int(4) NOT NULL,
  `Nilai_Sit_Up_Kaki_Di_Tekuk_Wanita` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `garjas_wanita_sit_up_kaki_lurus`
--

CREATE TABLE `garjas_wanita_sit_up_kaki_lurus` (
  `ID_Wanita_Sit_Up_Kaki_Lurus` int(11) NOT NULL,
  `NIP_Pengguna` bigint(20) NOT NULL,
  `Tanggal_Pelaksanaan_Sit_Up_Kaki_Lurus_Wanita` date NOT NULL,
  `Jumlah_Sit_Up_Kaki_Lurus_Wanita` int(4) NOT NULL,
  `Nilai_Sit_Up_Kaki_Lurus_Wanita` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kompetensi`
--

CREATE TABLE `kompetensi` (
  `ID_Kompetensi` int(11) NOT NULL,
  `NIP_Pengguna` bigint(20) NOT NULL,
  `File_Sertifikat` longblob NOT NULL,
  `Nama_Sertifikat` varchar(50) NOT NULL,
  `Tanggal_Penerbitan_Sertifikat` date NOT NULL,
  `Masa_Berlaku` int(4) NOT NULL,
  `Tanggal_Berakhir_Sertifikat` date NOT NULL,
  `Kategori_Kompetensi` enum('Pemula','Terampil','Mahir') NOT NULL,
  `Status` enum('Aktif','Tidak Aktif') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `modul`
--

CREATE TABLE `modul` (
  `ID_Modul` int(11) NOT NULL,
  `File_Modul` longblob NOT NULL,
  `Nama_Modul` varchar(20) NOT NULL,
  `Judul_Modul` varchar(20) NOT NULL,
  `Tanggal_Terbit_Modul` date NOT NULL,
  `Deskripsi_Modul` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `modul`
--

INSERT INTO `modul` (`ID_Modul`, `File_Modul`, `Nama_Modul`, `Judul_Modul`, `Tanggal_Terbit_Modul`, `Deskripsi_Modul`) VALUES
(10, 0x363637643030313537643537312e706466, 'KUY', 'AH APA', '2024-07-01', 'Ini Modulnya'),
(11, 0x363637643033623336366434322e706466, 'A', 'P', '2024-07-03', 'a');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `NIP_Pengguna` bigint(20) NOT NULL,
  `Foto_Pengguna` longblob NOT NULL,
  `Nama_Lengkap_Pengguna` varchar(30) NOT NULL,
  `Tanggal_Lahir_Pengguna` date NOT NULL,
  `Umur_Pengguna` int(3) NOT NULL,
  `No_Telepon_Pengguna` varchar(20) NOT NULL,
  `Jabatan_Pengguna` enum('Pemula','Terampil','Mahir') NOT NULL,
  `Jenis_Kelamin_Pengguna` enum('Pria','Wanita') NOT NULL,
  `Kata_Sandi_Pengguna` varchar(100) NOT NULL,
  `Konfirmasi_Kata_Sandi_Pengguna` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tes_jalan_pria`
--

CREATE TABLE `tes_jalan_pria` (
  `ID_Jalan_Pria` int(11) NOT NULL,
  `NIP_Pengguna` bigint(20) NOT NULL,
  `Tanggal_Pelaksanaan_Tes_Jalan_Pria` date NOT NULL,
  `Waktu_Jalan_Pria` decimal(10,1) NOT NULL,
  `Nilai_Jalan_Pria` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tes_lari_pria`
--

CREATE TABLE `tes_lari_pria` (
  `ID_Lari_Pria` int(11) NOT NULL,
  `NIP_Pengguna` bigint(20) NOT NULL,
  `Tanggal_Pelaksanaan_Tes_Lari_Pria` date NOT NULL,
  `Waktu_Lari_Pria` decimal(10,1) NOT NULL,
  `Nilai_Lari_Pria` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tes_lari_wanita`
--

CREATE TABLE `tes_lari_wanita` (
  `ID_Lari_Wanita` int(11) NOT NULL,
  `NIP_Pengguna` bigint(20) NOT NULL,
  `Tanggal_Pelaksanaan_Tes_Lari_Wanita` date NOT NULL,
  `Waktu_Lari_Wanita` varchar(50) NOT NULL,
  `Nilai_Lari_Wanita` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tes_renang_pria`
--

CREATE TABLE `tes_renang_pria` (
  `ID_Renang_Pria` int(11) NOT NULL,
  `NIP_Pengguna` bigint(20) NOT NULL,
  `Tanggal_Pelaksanaan_Tes_Renang_Pria` date NOT NULL,
  `Waktu_Renang_Pria` varchar(50) NOT NULL,
  `Nama_Gaya_Renang_Pria` enum('Dada','Bebas','Lainnya','') NOT NULL,
  `Nilai_Renang_Pria` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tes_renang_wanita`
--

CREATE TABLE `tes_renang_wanita` (
  `ID_Renang_Wanita` int(11) NOT NULL,
  `NIP_Pengguna` bigint(20) NOT NULL,
  `Tanggal_Pelaksanaan_Tes_Renang_Wanita` date NOT NULL,
  `Waktu_Renang_Wanita` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Nama_Gaya_Renang_Wanita` enum('Dada','Bebas','Lainnya','') NOT NULL,
  `Nilai_Renang_Wanita` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`ID_Absensi`),
  ADD KEY `NIP_Pengguna` (`NIP_Pengguna`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`NIP_Admin`);

--
-- Indexes for table `bmi`
--
ALTER TABLE `bmi`
  ADD PRIMARY KEY (`ID_BMI`),
  ADD KEY `ID_Pengguna` (`NIP_Pengguna`),
  ADD KEY `NIP_Pengguna` (`NIP_Pengguna`);

--
-- Indexes for table `garjas_pria_chin_up`
--
ALTER TABLE `garjas_pria_chin_up`
  ADD PRIMARY KEY (`ID_Pria_Chin_Up`),
  ADD KEY `NIP_Pengguna` (`NIP_Pengguna`);

--
-- Indexes for table `garjas_pria_menggantung`
--
ALTER TABLE `garjas_pria_menggantung`
  ADD PRIMARY KEY (`ID_Menggantung_Pria`),
  ADD KEY `NIP_Pengguna` (`NIP_Pengguna`);

--
-- Indexes for table `garjas_pria_push_up`
--
ALTER TABLE `garjas_pria_push_up`
  ADD PRIMARY KEY (`ID_Push_Up_Pria`),
  ADD KEY `NIP_Pengguna` (`NIP_Pengguna`);

--
-- Indexes for table `garjas_pria_shuttle_run`
--
ALTER TABLE `garjas_pria_shuttle_run`
  ADD PRIMARY KEY (`ID_Shuttle_Run_Pria`),
  ADD KEY `NIP_Pengguna` (`NIP_Pengguna`);

--
-- Indexes for table `garjas_pria_sit_up_kaki_di_tekuk`
--
ALTER TABLE `garjas_pria_sit_up_kaki_di_tekuk`
  ADD PRIMARY KEY (`ID_Sit_Up_Kaki_Di_Tekuk_Pria`),
  ADD KEY `NIP_Pengguna` (`NIP_Pengguna`);

--
-- Indexes for table `garjas_pria_sit_up_kaki_lurus`
--
ALTER TABLE `garjas_pria_sit_up_kaki_lurus`
  ADD PRIMARY KEY (`ID_Sit_Up_Kaki_Lurus_Pria`),
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
-- Indexes for table `kompetensi`
--
ALTER TABLE `kompetensi`
  ADD PRIMARY KEY (`ID_Kompetensi`),
  ADD KEY `NIP` (`NIP_Pengguna`);

--
-- Indexes for table `modul`
--
ALTER TABLE `modul`
  ADD PRIMARY KEY (`ID_Modul`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`NIP_Pengguna`);

--
-- Indexes for table `tes_jalan_pria`
--
ALTER TABLE `tes_jalan_pria`
  ADD PRIMARY KEY (`ID_Jalan_Pria`),
  ADD KEY `NIP_Pengguna` (`NIP_Pengguna`);

--
-- Indexes for table `tes_lari_pria`
--
ALTER TABLE `tes_lari_pria`
  ADD PRIMARY KEY (`ID_Lari_Pria`),
  ADD KEY `NIP_Pengguna` (`NIP_Pengguna`);

--
-- Indexes for table `tes_lari_wanita`
--
ALTER TABLE `tes_lari_wanita`
  ADD PRIMARY KEY (`ID_Lari_Wanita`),
  ADD KEY `NIP_Pengguna` (`NIP_Pengguna`);

--
-- Indexes for table `tes_renang_pria`
--
ALTER TABLE `tes_renang_pria`
  ADD PRIMARY KEY (`ID_Renang_Pria`),
  ADD KEY `NIP_Pengguna` (`NIP_Pengguna`);

--
-- Indexes for table `tes_renang_wanita`
--
ALTER TABLE `tes_renang_wanita`
  ADD PRIMARY KEY (`ID_Renang_Wanita`),
  ADD KEY `NIP_Pengguna` (`NIP_Pengguna`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `ID_Absensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `bmi`
--
ALTER TABLE `bmi`
  MODIFY `ID_BMI` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `garjas_pria_chin_up`
--
ALTER TABLE `garjas_pria_chin_up`
  MODIFY `ID_Pria_Chin_Up` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `garjas_pria_menggantung`
--
ALTER TABLE `garjas_pria_menggantung`
  MODIFY `ID_Menggantung_Pria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `garjas_pria_push_up`
--
ALTER TABLE `garjas_pria_push_up`
  MODIFY `ID_Push_Up_Pria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `garjas_pria_shuttle_run`
--
ALTER TABLE `garjas_pria_shuttle_run`
  MODIFY `ID_Shuttle_Run_Pria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `garjas_pria_sit_up_kaki_di_tekuk`
--
ALTER TABLE `garjas_pria_sit_up_kaki_di_tekuk`
  MODIFY `ID_Sit_Up_Kaki_Di_Tekuk_Pria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `garjas_pria_sit_up_kaki_lurus`
--
ALTER TABLE `garjas_pria_sit_up_kaki_lurus`
  MODIFY `ID_Sit_Up_Kaki_Lurus_Pria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `garjas_wanita_chin_up`
--
ALTER TABLE `garjas_wanita_chin_up`
  MODIFY `ID_Wanita_Chin_Up` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `garjas_wanita_push_up`
--
ALTER TABLE `garjas_wanita_push_up`
  MODIFY `ID_Wanita_Push_Up` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `garjas_wanita_shuttle_run`
--
ALTER TABLE `garjas_wanita_shuttle_run`
  MODIFY `ID_Wanita_Shuttle_Run` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `garjas_wanita_sit_up_kaki_di_tekuk`
--
ALTER TABLE `garjas_wanita_sit_up_kaki_di_tekuk`
  MODIFY `ID_Wanita_Sit_Up_Kaki_Di_Tekuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `garjas_wanita_sit_up_kaki_lurus`
--
ALTER TABLE `garjas_wanita_sit_up_kaki_lurus`
  MODIFY `ID_Wanita_Sit_Up_Kaki_Lurus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `kompetensi`
--
ALTER TABLE `kompetensi`
  MODIFY `ID_Kompetensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `modul`
--
ALTER TABLE `modul`
  MODIFY `ID_Modul` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tes_jalan_pria`
--
ALTER TABLE `tes_jalan_pria`
  MODIFY `ID_Jalan_Pria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `tes_lari_pria`
--
ALTER TABLE `tes_lari_pria`
  MODIFY `ID_Lari_Pria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT for table `tes_lari_wanita`
--
ALTER TABLE `tes_lari_wanita`
  MODIFY `ID_Lari_Wanita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tes_renang_pria`
--
ALTER TABLE `tes_renang_pria`
  MODIFY `ID_Renang_Pria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `tes_renang_wanita`
--
ALTER TABLE `tes_renang_wanita`
  MODIFY `ID_Renang_Wanita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `absensi_ibfk_1` FOREIGN KEY (`NIP_Pengguna`) REFERENCES `pengguna` (`NIP_Pengguna`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bmi`
--
ALTER TABLE `bmi`
  ADD CONSTRAINT `bmi_ibfk_1` FOREIGN KEY (`NIP_Pengguna`) REFERENCES `pengguna` (`NIP_Pengguna`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `garjas_pria_chin_up`
--
ALTER TABLE `garjas_pria_chin_up`
  ADD CONSTRAINT `garjas_pria_chin_up_ibfk_1` FOREIGN KEY (`NIP_Pengguna`) REFERENCES `pengguna` (`NIP_Pengguna`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `garjas_pria_menggantung`
--
ALTER TABLE `garjas_pria_menggantung`
  ADD CONSTRAINT `garjas_pria_menggantung_ibfk_1` FOREIGN KEY (`NIP_Pengguna`) REFERENCES `pengguna` (`NIP_Pengguna`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `garjas_pria_push_up`
--
ALTER TABLE `garjas_pria_push_up`
  ADD CONSTRAINT `garjas_pria_push_up_ibfk_1` FOREIGN KEY (`NIP_Pengguna`) REFERENCES `pengguna` (`NIP_Pengguna`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `garjas_pria_shuttle_run`
--
ALTER TABLE `garjas_pria_shuttle_run`
  ADD CONSTRAINT `garjas_pria_shuttle_run_ibfk_1` FOREIGN KEY (`NIP_Pengguna`) REFERENCES `pengguna` (`NIP_Pengguna`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `garjas_pria_sit_up_kaki_di_tekuk`
--
ALTER TABLE `garjas_pria_sit_up_kaki_di_tekuk`
  ADD CONSTRAINT `garjas_pria_sit_up_kaki_di_tekuk_ibfk_1` FOREIGN KEY (`NIP_Pengguna`) REFERENCES `pengguna` (`NIP_Pengguna`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `garjas_pria_sit_up_kaki_lurus`
--
ALTER TABLE `garjas_pria_sit_up_kaki_lurus`
  ADD CONSTRAINT `garjas_pria_sit_up_kaki_lurus_ibfk_1` FOREIGN KEY (`NIP_Pengguna`) REFERENCES `pengguna` (`NIP_Pengguna`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `garjas_wanita_chin_up`
--
ALTER TABLE `garjas_wanita_chin_up`
  ADD CONSTRAINT `garjas_wanita_chin_up_ibfk_1` FOREIGN KEY (`NIP_Pengguna`) REFERENCES `pengguna` (`NIP_Pengguna`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `garjas_wanita_push_up`
--
ALTER TABLE `garjas_wanita_push_up`
  ADD CONSTRAINT `garjas_wanita_push_up_ibfk_1` FOREIGN KEY (`NIP_Pengguna`) REFERENCES `pengguna` (`NIP_Pengguna`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `garjas_wanita_shuttle_run`
--
ALTER TABLE `garjas_wanita_shuttle_run`
  ADD CONSTRAINT `garjas_wanita_shuttle_run_ibfk_1` FOREIGN KEY (`NIP_Pengguna`) REFERENCES `pengguna` (`NIP_Pengguna`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `garjas_wanita_sit_up_kaki_di_tekuk`
--
ALTER TABLE `garjas_wanita_sit_up_kaki_di_tekuk`
  ADD CONSTRAINT `garjas_wanita_sit_up_kaki_di_tekuk_ibfk_1` FOREIGN KEY (`NIP_Pengguna`) REFERENCES `pengguna` (`NIP_Pengguna`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `garjas_wanita_sit_up_kaki_lurus`
--
ALTER TABLE `garjas_wanita_sit_up_kaki_lurus`
  ADD CONSTRAINT `garjas_wanita_sit_up_kaki_lurus_ibfk_1` FOREIGN KEY (`NIP_Pengguna`) REFERENCES `pengguna` (`NIP_Pengguna`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kompetensi`
--
ALTER TABLE `kompetensi`
  ADD CONSTRAINT `kompetensi_ibfk_1` FOREIGN KEY (`NIP_Pengguna`) REFERENCES `pengguna` (`NIP_Pengguna`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tes_jalan_pria`
--
ALTER TABLE `tes_jalan_pria`
  ADD CONSTRAINT `tes_jalan_pria_ibfk_1` FOREIGN KEY (`NIP_Pengguna`) REFERENCES `pengguna` (`NIP_Pengguna`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tes_lari_pria`
--
ALTER TABLE `tes_lari_pria`
  ADD CONSTRAINT `tes_lari_pria_ibfk_1` FOREIGN KEY (`NIP_Pengguna`) REFERENCES `pengguna` (`NIP_Pengguna`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tes_lari_wanita`
--
ALTER TABLE `tes_lari_wanita`
  ADD CONSTRAINT `tes_lari_wanita_ibfk_1` FOREIGN KEY (`NIP_Pengguna`) REFERENCES `pengguna` (`NIP_Pengguna`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tes_renang_pria`
--
ALTER TABLE `tes_renang_pria`
  ADD CONSTRAINT `tes_renang_pria_ibfk_1` FOREIGN KEY (`NIP_Pengguna`) REFERENCES `pengguna` (`NIP_Pengguna`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tes_renang_wanita`
--
ALTER TABLE `tes_renang_wanita`
  ADD CONSTRAINT `tes_renang_wanita_ibfk_1` FOREIGN KEY (`NIP_Pengguna`) REFERENCES `pengguna` (`NIP_Pengguna`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
