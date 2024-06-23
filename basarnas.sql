-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2024 at 06:42 AM
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
  `Status_Absensi` enum('Hadir','Tidak Hadir') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `NIP_Admin` bigint(20) NOT NULL,
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
(12345, 0x363637366238613139373063362e6a7067, 'Syntax Squad', '2005-12-06', 18, 'Bandung', '+62 812-2272-8232', 'Tiga', 'Pria', '$2y$10$xGmPCeehCwkaNKGljJvbf.SiSwsIhFIKlpsW0eBsiN.oajHCf9fjO', '$2y$10$xGmPCeehCwkaNKGljJvbf.SiSwsIhFIKlpsW0eBsiN.oajHCf9fjO');

-- --------------------------------------------------------

--
-- Table structure for table `bmi`
--

CREATE TABLE `bmi` (
  `ID_BMI` int(11) NOT NULL,
  `NIP_Pengguna` bigint(20) NOT NULL,
  `Tanggal Pemeriksaan` date NOT NULL,
  `Tinggi_BMI` int(4) NOT NULL,
  `Berat_BMI` int(4) NOT NULL,
  `Skor` int(3) NOT NULL,
  `Keterangan` enum('Berat Badan Kurang','Berat Badan Normal','Berat Badan Lebih') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `garjas_pria_chin_up`
--

CREATE TABLE `garjas_pria_chin_up` (
  `ID_Pria_Chin_Up` int(11) NOT NULL,
  `NIP_Pengguna` bigint(20) NOT NULL,
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
  `Jumlah_Push_Up_Pria` int(4) NOT NULL,
  `Nilai_Push_Up_Pria` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `garjas_pria_push_up`
--

INSERT INTO `garjas_pria_push_up` (`ID_Push_Up_Pria`, `NIP_Pengguna`, `Jumlah_Push_Up_Pria`, `Nilai_Push_Up_Pria`) VALUES
(46, 555, 22, 38);

-- --------------------------------------------------------

--
-- Table structure for table `garjas_pria_shuttle_run`
--

CREATE TABLE `garjas_pria_shuttle_run` (
  `ID_Shuttle_Run_Pria` int(11) NOT NULL,
  `NIP_Pengguna` bigint(20) NOT NULL,
  `Waktu_Shuttle_Run_Pria` float NOT NULL,
  `Nilai_Shuttle_Run_Pria` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `garjas_pria_sit_up_kaki_di_tekuk`
--

CREATE TABLE `garjas_pria_sit_up_kaki_di_tekuk` (
  `ID_Sit_Up_Kaki_Di_Tekuk_Pria` int(11) NOT NULL,
  `NIP_Pengguna` bigint(20) NOT NULL,
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
  `Jumlah_Chin_Up_Wanita` int(4) NOT NULL,
  `Nilai_Chin_Up_Wanita` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `garjas_wanita_chin_up`
--

INSERT INTO `garjas_wanita_chin_up` (`ID_Wanita_Chin_Up`, `NIP_Pengguna`, `Jumlah_Chin_Up_Wanita`, `Nilai_Chin_Up_Wanita`) VALUES
(14, 1241231, 31, 54),
(15, 5555, 21, 36);

-- --------------------------------------------------------

--
-- Table structure for table `garjas_wanita_push_up`
--

CREATE TABLE `garjas_wanita_push_up` (
  `ID_Wanita_Push_Up` int(11) NOT NULL,
  `NIP_Pengguna` bigint(20) NOT NULL,
  `Jumlah_Push_Up_Wanita` int(4) NOT NULL,
  `Nilai_Push_Up_Wanita` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `garjas_wanita_push_up`
--

INSERT INTO `garjas_wanita_push_up` (`ID_Wanita_Push_Up`, `NIP_Pengguna`, `Jumlah_Push_Up_Wanita`, `Nilai_Push_Up_Wanita`) VALUES
(18, 5555, 44, 0),
(19, 1241231, 11, 43);

-- --------------------------------------------------------

--
-- Table structure for table `garjas_wanita_shuttle_run`
--

CREATE TABLE `garjas_wanita_shuttle_run` (
  `ID_Wanita_Shuttle_Run` int(11) NOT NULL,
  `NIP_Pengguna` bigint(20) NOT NULL,
  `Jumlah_Shuttle_Run_Wanita` int(4) NOT NULL,
  `Nilai_Shuttle_Run_Wanita` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `garjas_wanita_shuttle_run`
--

INSERT INTO `garjas_wanita_shuttle_run` (`ID_Wanita_Shuttle_Run`, `NIP_Pengguna`, `Jumlah_Shuttle_Run_Wanita`, `Nilai_Shuttle_Run_Wanita`) VALUES
(17, 1241231, 43, 0),
(18, 5555, 11, 43);

-- --------------------------------------------------------

--
-- Table structure for table `garjas_wanita_sit_up_kaki_di_tekuk`
--

CREATE TABLE `garjas_wanita_sit_up_kaki_di_tekuk` (
  `ID_Wanita_Sit_Up_Kaki_Di_Tekuk` int(11) NOT NULL,
  `NIP_Pengguna` bigint(20) NOT NULL,
  `Jumlah_Sit_Up_Kaki_Di_Tekuk_Wanita` int(4) NOT NULL,
  `Nilai_Sit_Up_Kaki_Di_Tekuk_Wanita` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `garjas_wanita_sit_up_kaki_di_tekuk`
--

INSERT INTO `garjas_wanita_sit_up_kaki_di_tekuk` (`ID_Wanita_Sit_Up_Kaki_Di_Tekuk`, `NIP_Pengguna`, `Jumlah_Sit_Up_Kaki_Di_Tekuk_Wanita`, `Nilai_Sit_Up_Kaki_Di_Tekuk_Wanita`) VALUES
(8, 5555, 38, 74),
(9, 1241231, 22, 38);

-- --------------------------------------------------------

--
-- Table structure for table `garjas_wanita_sit_up_kaki_lurus`
--

CREATE TABLE `garjas_wanita_sit_up_kaki_lurus` (
  `ID_Wanita_Sit_Up_Kaki_Lurus` int(11) NOT NULL,
  `NIP_Pengguna` bigint(20) NOT NULL,
  `Jumlah_Sit_Up_Kaki_Lurus_Wanita` int(4) NOT NULL,
  `Nilai_Sit_Up_Kaki_Lurus_Wanita` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `garjas_wanita_sit_up_kaki_lurus`
--

INSERT INTO `garjas_wanita_sit_up_kaki_lurus` (`ID_Wanita_Sit_Up_Kaki_Lurus`, `NIP_Pengguna`, `Jumlah_Sit_Up_Kaki_Lurus_Wanita`, `Nilai_Sit_Up_Kaki_Lurus_Wanita`) VALUES
(16, 5555, 44, 100),
(17, 1241231, 23, 40);

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

--
-- Dumping data for table `kompetensi`
--

INSERT INTO `kompetensi` (`ID_Kompetensi`, `NIP_Pengguna`, `File_Sertifikat`, `Nama_Sertifikat`, `Tanggal_Penerbitan_Sertifikat`, `Masa_Berlaku`, `Tanggal_Berakhir_Sertifikat`, `Kategori_Kompetensi`, `Status`) VALUES
(22, 210204, 0x363637363733653434373236612e706466, 'Laprak', '2022-02-12', 36, '2025-02-12', 'Pemula', 'Aktif'),
(23, 210204, 0x363637363734336235393638642e706466, 'GGS', '2020-02-02', 72, '2026-02-02', 'Terampil', 'Aktif'),
(25, 2250081109, 0x363637376131336231346561352e706466, 'KUY', '2024-02-07', 4, '2024-06-27', 'Mahir', 'Aktif'),
(26, 2250081109, 0x363637376131663539313231352e646f6378, 'WOY', '2024-01-09', 6, '2024-07-26', 'Pemula', 'Aktif'),
(27, 2250081109, 0x363637376137616230366264652e6a7067, 'AY', '2024-01-09', 5, '2024-06-28', 'Terampil', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `modul`
--

CREATE TABLE `modul` (
  `ID_Modul` int(11) NOT NULL,
  `NIP_Pengguna` bigint(20) NOT NULL,
  `File_Modul` longblob NOT NULL,
  `Nama_Modul` varchar(20) NOT NULL,
  `Judul_Modul` varchar(20) NOT NULL,
  `Tanggal_Terbit_Modul` date NOT NULL,
  `Deskripsi_Modul` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `modul`
--

INSERT INTO `modul` (`ID_Modul`, `NIP_Pengguna`, `File_Modul`, `Nama_Modul`, `Judul_Modul`, `Tanggal_Terbit_Modul`, `Deskripsi_Modul`) VALUES
(7, 2250081109, 0x363637373932306239333537352e706466, 'Modul 1', 'Cara Bulk', '2024-06-23', 'Turu Sajah'),
(8, 2250081109, 0x363637373939353263626630392e646f6378, 'Modul 2', 'Cara Cut', '2024-06-23', 'Tinggal Turu Ngak Usah Makan');

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
(555, 0x363637363333303462646533642e6a7067, 'Adrian', '2005-12-07', 18, 'bababa', '+62 781-2382-323', 'Satu', 'Pria', '$2y$10$zvkcKevqwg1vBLtEdakW1OCBiqzKUBxX8GeFs8qQOzlnRUFCm.ZEe', '$2y$10$zvkcKevqwg1vBLtEdakW1OCBiqzKUBxX8GeFs8qQOzlnRUFCm.ZEe'),
(5555, 0x363637363366646530383435632e6a7067, 'Sayang', '2005-10-07', 18, 'Bandung', '+62 812-2727-3232', 'Satu', 'Wanita', '$2y$10$cYUf/AlcDsdwpvhDXJ4LA.OLFNExy10U5V10YcUKWvUBdL9cfGIVq', '$2y$10$cYUf/AlcDsdwpvhDXJ4LA.OLFNExy10U5V10YcUKWvUBdL9cfGIVq'),
(210204, 0x363637363361393064346636632e6a7067, 'Sandro Ganteng', '2004-02-21', 20, 'Batujajar', '+62 822-1345-6788', 'Satu', 'Pria', '$2y$10$vnlx.UXjDxWps1G1fxPAM.MPG9APe7kGnl/2Tj6xxE.3x2mCBFgCi', '$2y$10$vnlx.UXjDxWps1G1fxPAM.MPG9APe7kGnl/2Tj6xxE.3x2mCBFgCi'),
(1241231, 0x363637363430353133303734362e6a7067, 'Yunaaa', '2006-12-07', 17, 'asdasdasdasd', '+62 812-2623-62322', 'Satu', 'Wanita', '$2y$10$9Y6lrviqOkNhpk1wB5Aq8ut.3o4flK89Au5CSASJ/c3IahL4JwyiK', '$2y$10$9Y6lrviqOkNhpk1wB5Aq8ut.3o4flK89Au5CSASJ/c3IahL4JwyiK'),
(2250081109, 0x363637363338323039326365382e6a7067, 'NaufalRacing777', '2001-04-14', 23, 'dfvb', '81284118344', 'Satu', 'Pria', '$2y$10$rp8dQfVEiaQac6UwO5RZy.OdbwnfoER.4k88PgTCZkZ2AcHWjphLG', '$2y$10$rp8dQfVEiaQac6UwO5RZy.OdbwnfoER.4k88PgTCZkZ2AcHWjphLG');

-- --------------------------------------------------------

--
-- Table structure for table `tes_jalan_pria`
--

CREATE TABLE `tes_jalan_pria` (
  `ID_Jalan_Pria` int(11) NOT NULL,
  `NIP_Pengguna` bigint(20) NOT NULL,
  `Waktu_Jalan_Pria` decimal(10,1) NOT NULL,
  `Nilai_Jalan_Pria` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tes_jalan_pria`
--

INSERT INTO `tes_jalan_pria` (`ID_Jalan_Pria`, `NIP_Pengguna`, `Waktu_Jalan_Pria`, `Nilai_Jalan_Pria`) VALUES
(43, 210204, 2.0, 0),
(44, 2250081109, 3.0, 0),
(45, 555, 22.0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tes_jalan_wanita`
--

CREATE TABLE `tes_jalan_wanita` (
  `ID_Jalan_Wanita` int(11) NOT NULL,
  `NIP_Pengguna` bigint(20) NOT NULL,
  `Waktu_Jalan_Wanita` decimal(10,1) NOT NULL,
  `Nilai_Jalan_Wanita` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tes_jalan_wanita`
--

INSERT INTO `tes_jalan_wanita` (`ID_Jalan_Wanita`, `NIP_Pengguna`, `Waktu_Jalan_Wanita`, `Nilai_Jalan_Wanita`) VALUES
(4, 5555, 22.0, 0),
(5, 1241231, 11.0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tes_lari_pria`
--

CREATE TABLE `tes_lari_pria` (
  `ID_Lari_Pria` int(11) NOT NULL,
  `NIP_Pengguna` bigint(20) NOT NULL,
  `Waktu_Lari_Pria` varchar(50) NOT NULL,
  `Nilai_Lari_Pria` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tes_lari_pria`
--

INSERT INTO `tes_lari_pria` (`ID_Lari_Pria`, `NIP_Pengguna`, `Waktu_Lari_Pria`, `Nilai_Lari_Pria`) VALUES
(11, 555, '22', 66),
(12, 210204, '21', 64),
(13, 2250081109, '31', 85);

-- --------------------------------------------------------

--
-- Table structure for table `tes_lari_wanita`
--

CREATE TABLE `tes_lari_wanita` (
  `ID_Lari_Wanita` int(11) NOT NULL,
  `NIP_Pengguna` bigint(20) NOT NULL,
  `Waktu_Lari_Wanita` varchar(50) NOT NULL,
  `Nilai_Lari_Wanita` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tes_lari_wanita`
--

INSERT INTO `tes_lari_wanita` (`ID_Lari_Wanita`, `NIP_Pengguna`, `Waktu_Lari_Wanita`, `Nilai_Lari_Wanita`) VALUES
(6, 5555, '1', 1),
(7, 1241231, '2', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tes_renang_pria`
--

CREATE TABLE `tes_renang_pria` (
  `ID_Renang_Pria` int(11) NOT NULL,
  `NIP_Pengguna` bigint(20) NOT NULL,
  `Waktu_Renang_Pria` varchar(50) NOT NULL,
  `Nama_Gaya_Renang_Pria` enum('Dada','Bebas','Lainnya','') NOT NULL,
  `Nilai_Renang_Pria` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tes_renang_pria`
--

INSERT INTO `tes_renang_pria` (`ID_Renang_Pria`, `NIP_Pengguna`, `Waktu_Renang_Pria`, `Nama_Gaya_Renang_Pria`, `Nilai_Renang_Pria`) VALUES
(38, 555, '00:22', 'Dada', 100);

-- --------------------------------------------------------

--
-- Table structure for table `tes_renang_wanita`
--

CREATE TABLE `tes_renang_wanita` (
  `ID_Renang_Wanita` int(11) NOT NULL,
  `NIP_Pengguna` bigint(20) NOT NULL,
  `Waktu_Renang_Wanita` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Nama_Gaya_Renang_Wanita` enum('Dada','Bebas','Lainnya','') NOT NULL,
  `Nilai_Renang_Wanita` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tes_renang_wanita`
--

INSERT INTO `tes_renang_wanita` (`ID_Renang_Wanita`, `NIP_Pengguna`, `Waktu_Renang_Wanita`, `Nama_Gaya_Renang_Wanita`, `Nilai_Renang_Wanita`) VALUES
(15, 5555, '0000-00-00 00:00:00', 'Bebas', 100),
(16, 1241231, '0000-00-00 00:00:00', 'Lainnya', 0);

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
  ADD PRIMARY KEY (`ID_Modul`),
  ADD KEY `NIP_Pengguna` (`NIP_Pengguna`);

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
-- Indexes for table `tes_jalan_wanita`
--
ALTER TABLE `tes_jalan_wanita`
  ADD PRIMARY KEY (`ID_Jalan_Wanita`),
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
  MODIFY `ID_Absensi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bmi`
--
ALTER TABLE `bmi`
  MODIFY `ID_BMI` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `garjas_pria_chin_up`
--
ALTER TABLE `garjas_pria_chin_up`
  MODIFY `ID_Pria_Chin_Up` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `garjas_pria_menggantung`
--
ALTER TABLE `garjas_pria_menggantung`
  MODIFY `ID_Menggantung_Pria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `garjas_pria_push_up`
--
ALTER TABLE `garjas_pria_push_up`
  MODIFY `ID_Push_Up_Pria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `garjas_pria_shuttle_run`
--
ALTER TABLE `garjas_pria_shuttle_run`
  MODIFY `ID_Shuttle_Run_Pria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `garjas_pria_sit_up_kaki_di_tekuk`
--
ALTER TABLE `garjas_pria_sit_up_kaki_di_tekuk`
  MODIFY `ID_Sit_Up_Kaki_Di_Tekuk_Pria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `garjas_pria_sit_up_kaki_lurus`
--
ALTER TABLE `garjas_pria_sit_up_kaki_lurus`
  MODIFY `ID_Sit_Up_Kaki_Lurus_Pria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `garjas_wanita_chin_up`
--
ALTER TABLE `garjas_wanita_chin_up`
  MODIFY `ID_Wanita_Chin_Up` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `garjas_wanita_push_up`
--
ALTER TABLE `garjas_wanita_push_up`
  MODIFY `ID_Wanita_Push_Up` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `garjas_wanita_shuttle_run`
--
ALTER TABLE `garjas_wanita_shuttle_run`
  MODIFY `ID_Wanita_Shuttle_Run` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `garjas_wanita_sit_up_kaki_di_tekuk`
--
ALTER TABLE `garjas_wanita_sit_up_kaki_di_tekuk`
  MODIFY `ID_Wanita_Sit_Up_Kaki_Di_Tekuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `garjas_wanita_sit_up_kaki_lurus`
--
ALTER TABLE `garjas_wanita_sit_up_kaki_lurus`
  MODIFY `ID_Wanita_Sit_Up_Kaki_Lurus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `kompetensi`
--
ALTER TABLE `kompetensi`
  MODIFY `ID_Kompetensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `modul`
--
ALTER TABLE `modul`
  MODIFY `ID_Modul` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tes_jalan_pria`
--
ALTER TABLE `tes_jalan_pria`
  MODIFY `ID_Jalan_Pria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `tes_jalan_wanita`
--
ALTER TABLE `tes_jalan_wanita`
  MODIFY `ID_Jalan_Wanita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tes_lari_pria`
--
ALTER TABLE `tes_lari_pria`
  MODIFY `ID_Lari_Pria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tes_lari_wanita`
--
ALTER TABLE `tes_lari_wanita`
  MODIFY `ID_Lari_Wanita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tes_renang_pria`
--
ALTER TABLE `tes_renang_pria`
  MODIFY `ID_Renang_Pria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `tes_renang_wanita`
--
ALTER TABLE `tes_renang_wanita`
  MODIFY `ID_Renang_Wanita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
-- Constraints for table `garjas_pria_push_up`
--
ALTER TABLE `garjas_pria_push_up`
  ADD CONSTRAINT `garjas_pria_push_up_ibfk_1` FOREIGN KEY (`NIP_Pengguna`) REFERENCES `pengguna` (`NIP_Pengguna`) ON DELETE CASCADE ON UPDATE CASCADE;

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
