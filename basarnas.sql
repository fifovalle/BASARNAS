-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2024 at 09:56 AM
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
  `Foto_Admin` longblob NOT NULL,
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
(12345, 0x363638663839333661316339642e6a7067, 'Syntax Squad', 'Super Admin', '2001-06-01', 23, '+62 822-6788-9559', 'Mahir', 'Pria', '$2y$10$vv0BCII34Hm3pDffNvtduONcVQ9kHWL59R.I7.kjUFw/hzpIvdVWm', '$2y$10$vv0BCII34Hm3pDffNvtduONcVQ9kHWL59R.I7.kjUFw/hzpIvdVWm');

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

--
-- Dumping data for table `garjas_pria_chin_up`
--

INSERT INTO `garjas_pria_chin_up` (`ID_Pria_Chin_Up`, `NIP_Pengguna`, `Tanggal_Pelaksanaan_Chin_Up_Pria`, `Jumlah_Chin_Up_Pria`, `Nilai_Chin_Up_Pria`) VALUES
(8, 2250081109, '2024-07-16', 1, 20);

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

--
-- Dumping data for table `garjas_pria_menggantung`
--

INSERT INTO `garjas_pria_menggantung` (`ID_Menggantung_Pria`, `NIP_Pengguna`, `Tanggal_Pelaksanaan_Pria_Menggantung`, `Waktu_Menggantung_Pria`, `Nilai_Menggantung_Pria`) VALUES
(7, 2250081109, '2024-07-08', 100, 100);

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

--
-- Dumping data for table `garjas_pria_push_up`
--

INSERT INTO `garjas_pria_push_up` (`ID_Push_Up_Pria`, `NIP_Pengguna`, `Tanggal_Pelaksanaan_Push_Up_Pria`, `Jumlah_Push_Up_Pria`, `Nilai_Push_Up_Pria`) VALUES
(65, 2250081109, '2024-07-10', 100, 100);

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

--
-- Dumping data for table `garjas_pria_shuttle_run`
--

INSERT INTO `garjas_pria_shuttle_run` (`ID_Shuttle_Run_Pria`, `NIP_Pengguna`, `Tanggal_Pelaksanaan_Shuttle_Run_Pria`, `Waktu_Shuttle_Run_Pria`, `Nilai_Shuttle_Run_Pria`) VALUES
(33, 2250081109, '2024-07-09', 1.0, 100);

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

--
-- Dumping data for table `garjas_pria_sit_up_kaki_di_tekuk`
--

INSERT INTO `garjas_pria_sit_up_kaki_di_tekuk` (`ID_Sit_Up_Kaki_Di_Tekuk_Pria`, `NIP_Pengguna`, `Tanggal_Pelaksanaan_Sit_Up_Kaki_Di_Tekuk`, `Jumlah_Sit_Up_Kaki_Di_Tekuk_Pria`, `Nilai_Sit_Up_Kaki_Di_Tekuk_Pria`) VALUES
(8, 2250081109, '2024-07-08', 100, 100);

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

--
-- Dumping data for table `garjas_pria_sit_up_kaki_lurus`
--

INSERT INTO `garjas_pria_sit_up_kaki_lurus` (`ID_Sit_Up_Kaki_Lurus_Pria`, `NIP_Pengguna`, `Tanggal_Pelaksanaan_Sit_Up_Kaki_Lurus_Pria`, `Jumlah_Sit_Up_Kaki_Lurus_Pria`, `Nilai_Sit_Up_Kaki_Lurus_Pria`) VALUES
(18, 2250081109, '2024-07-09', 100, 100);

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

--
-- Dumping data for table `garjas_wanita_chin_up`
--

INSERT INTO `garjas_wanita_chin_up` (`ID_Wanita_Chin_Up`, `NIP_Pengguna`, `Tanggal_Pelaksanaan_Chin_Up_Wanita`, `Jumlah_Chin_Up_Wanita`, `Nilai_Chin_Up_Wanita`) VALUES
(21, 2250081177, '2024-07-01', 1, 1);

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

--
-- Dumping data for table `garjas_wanita_push_up`
--

INSERT INTO `garjas_wanita_push_up` (`ID_Wanita_Push_Up`, `NIP_Pengguna`, `Tanggal_Pelaksanaan_Push_Up_Wanita`, `Jumlah_Push_Up_Wanita`, `Nilai_Push_Up_Wanita`) VALUES
(36, 2250081177, '2024-07-13', 34, 92);

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

--
-- Dumping data for table `garjas_wanita_shuttle_run`
--

INSERT INTO `garjas_wanita_shuttle_run` (`ID_Wanita_Shuttle_Run`, `NIP_Pengguna`, `Tanggal_Pelaksanaan_Shuttle_Run_Wanita`, `Jumlah_Shuttle_Run_Wanita`, `Nilai_Shuttle_Run_Wanita`) VALUES
(86, 2250081177, '2024-07-12', 17.5, 97);

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

--
-- Dumping data for table `garjas_wanita_sit_up_kaki_di_tekuk`
--

INSERT INTO `garjas_wanita_sit_up_kaki_di_tekuk` (`ID_Wanita_Sit_Up_Kaki_Di_Tekuk`, `NIP_Pengguna`, `Tanggal_Pelaksanaan_Sit_Up_Kaki_Di_Tekuk_Wanita`, `Jumlah_Sit_Up_Kaki_Di_Tekuk_Wanita`, `Nilai_Sit_Up_Kaki_Di_Tekuk_Wanita`) VALUES
(14, 2250081177, '2024-07-16', 80, 88);

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

--
-- Dumping data for table `garjas_wanita_sit_up_kaki_lurus`
--

INSERT INTO `garjas_wanita_sit_up_kaki_lurus` (`ID_Wanita_Sit_Up_Kaki_Lurus`, `NIP_Pengguna`, `Tanggal_Pelaksanaan_Sit_Up_Kaki_Lurus_Wanita`, `Jumlah_Sit_Up_Kaki_Lurus_Wanita`, `Nilai_Sit_Up_Kaki_Lurus_Wanita`) VALUES
(24, 2250081177, '2024-07-17', 40, 78);

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

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`NIP_Pengguna`, `Foto_Pengguna`, `Nama_Lengkap_Pengguna`, `Tanggal_Lahir_Pengguna`, `Umur_Pengguna`, `No_Telepon_Pengguna`, `Jabatan_Pengguna`, `Jenis_Kelamin_Pengguna`, `Kata_Sandi_Pengguna`, `Konfirmasi_Kata_Sandi_Pengguna`) VALUES
(210204, 0x363638663838633838623965632e6a7067, 'Sandro Anugrah Tambunan', '2004-02-21', 20, '+62 822-7655-4322', 'Mahir', 'Pria', '$2y$10$nNe7tLKk9C8Eak68tt7O9.lyS8cejkbq/91nRmCV7WgkXbRyXcz22', '$2y$10$nNe7tLKk9C8Eak68tt7O9.lyS8cejkbq/91nRmCV7WgkXbRyXcz22'),
(2250081109, 0x363638613530303863386437612e6a7067, 'Naufal FIFA', '2002-02-10', 22, '81223652490', 'Mahir', 'Pria', '$2y$10$oXWO81ANCsmBzrJpneDne.UtndWiB2FLggTssNHS1Dn5lwwJ/XNN6', '$2y$10$oXWO81ANCsmBzrJpneDne.UtndWiB2FLggTssNHS1Dn5lwwJ/XNN6'),
(2250081177, 0x363638613664383663346261652e6a7067, 'Putri Gibran Anjayy', '2002-07-07', 22, '+62 812-8411-8554', 'Terampil', 'Wanita', '$2y$10$z.K2lXw464Ie/EigpJORBeCyd9AD6a57uDPWqHq8f1Hvod4gyDMPy', '$2y$10$z.K2lXw464Ie/EigpJORBeCyd9AD6a57uDPWqHq8f1Hvod4gyDMPy');

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

--
-- Dumping data for table `tes_jalan_pria`
--

INSERT INTO `tes_jalan_pria` (`ID_Jalan_Pria`, `NIP_Pengguna`, `Tanggal_Pelaksanaan_Tes_Jalan_Pria`, `Waktu_Jalan_Pria`, `Nilai_Jalan_Pria`) VALUES
(53, 2250081109, '2024-07-08', 1.0, 100);

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

--
-- Dumping data for table `tes_lari_pria`
--

INSERT INTO `tes_lari_pria` (`ID_Lari_Pria`, `NIP_Pengguna`, `Tanggal_Pelaksanaan_Tes_Lari_Pria`, `Waktu_Lari_Pria`, `Nilai_Lari_Pria`) VALUES
(160, 2250081109, '2024-07-08', 1.0, 100);

-- --------------------------------------------------------

--
-- Table structure for table `tes_lari_wanita`
--

CREATE TABLE `tes_lari_wanita` (
  `ID_Lari_Wanita` int(11) NOT NULL,
  `NIP_Pengguna` bigint(20) NOT NULL,
  `Tanggal_Pelaksanaan_Tes_Lari_Wanita` date NOT NULL,
  `Waktu_Lari_Wanita` decimal(10,1) NOT NULL,
  `Nilai_Lari_Wanita` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tes_lari_wanita`
--

INSERT INTO `tes_lari_wanita` (`ID_Lari_Wanita`, `NIP_Pengguna`, `Tanggal_Pelaksanaan_Tes_Lari_Wanita`, `Waktu_Lari_Wanita`, `Nilai_Lari_Wanita`) VALUES
(16, 2250081177, '2024-07-16', 1.0, 100);

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

--
-- Dumping data for table `tes_renang_pria`
--

INSERT INTO `tes_renang_pria` (`ID_Renang_Pria`, `NIP_Pengguna`, `Tanggal_Pelaksanaan_Tes_Renang_Pria`, `Waktu_Renang_Pria`, `Nama_Gaya_Renang_Pria`, `Nilai_Renang_Pria`) VALUES
(50, 2250081109, '2024-07-08', '00:26', 'Bebas', 100);

-- --------------------------------------------------------

--
-- Table structure for table `tes_renang_wanita`
--

CREATE TABLE `tes_renang_wanita` (
  `ID_Renang_Wanita` int(11) NOT NULL,
  `NIP_Pengguna` bigint(20) NOT NULL,
  `Tanggal_Pelaksanaan_Tes_Renang_Wanita` date NOT NULL,
  `Waktu_Renang_Wanita` varchar(50) NOT NULL,
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
  MODIFY `ID_Absensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `bmi`
--
ALTER TABLE `bmi`
  MODIFY `ID_BMI` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `garjas_pria_chin_up`
--
ALTER TABLE `garjas_pria_chin_up`
  MODIFY `ID_Pria_Chin_Up` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `garjas_pria_menggantung`
--
ALTER TABLE `garjas_pria_menggantung`
  MODIFY `ID_Menggantung_Pria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `garjas_pria_push_up`
--
ALTER TABLE `garjas_pria_push_up`
  MODIFY `ID_Push_Up_Pria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `garjas_pria_shuttle_run`
--
ALTER TABLE `garjas_pria_shuttle_run`
  MODIFY `ID_Shuttle_Run_Pria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `garjas_pria_sit_up_kaki_di_tekuk`
--
ALTER TABLE `garjas_pria_sit_up_kaki_di_tekuk`
  MODIFY `ID_Sit_Up_Kaki_Di_Tekuk_Pria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `garjas_pria_sit_up_kaki_lurus`
--
ALTER TABLE `garjas_pria_sit_up_kaki_lurus`
  MODIFY `ID_Sit_Up_Kaki_Lurus_Pria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `garjas_wanita_chin_up`
--
ALTER TABLE `garjas_wanita_chin_up`
  MODIFY `ID_Wanita_Chin_Up` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `garjas_wanita_push_up`
--
ALTER TABLE `garjas_wanita_push_up`
  MODIFY `ID_Wanita_Push_Up` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `garjas_wanita_shuttle_run`
--
ALTER TABLE `garjas_wanita_shuttle_run`
  MODIFY `ID_Wanita_Shuttle_Run` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `garjas_wanita_sit_up_kaki_di_tekuk`
--
ALTER TABLE `garjas_wanita_sit_up_kaki_di_tekuk`
  MODIFY `ID_Wanita_Sit_Up_Kaki_Di_Tekuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `garjas_wanita_sit_up_kaki_lurus`
--
ALTER TABLE `garjas_wanita_sit_up_kaki_lurus`
  MODIFY `ID_Wanita_Sit_Up_Kaki_Lurus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `kompetensi`
--
ALTER TABLE `kompetensi`
  MODIFY `ID_Kompetensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `modul`
--
ALTER TABLE `modul`
  MODIFY `ID_Modul` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tes_jalan_pria`
--
ALTER TABLE `tes_jalan_pria`
  MODIFY `ID_Jalan_Pria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `tes_lari_pria`
--
ALTER TABLE `tes_lari_pria`
  MODIFY `ID_Lari_Pria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;

--
-- AUTO_INCREMENT for table `tes_lari_wanita`
--
ALTER TABLE `tes_lari_wanita`
  MODIFY `ID_Lari_Wanita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tes_renang_pria`
--
ALTER TABLE `tes_renang_pria`
  MODIFY `ID_Renang_Pria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

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
