-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2024 at 03:23 PM
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

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`ID_Absensi`, `NIP_Pengguna`, `Tanggal_Absensi`, `Hari_Absensi`, `Jam_Absen`, `Status_Absensi`) VALUES
(40, 123456789, '2024-06-27', 'Senin', '14:09:23', 'Hadir');

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
(12345, 0x363637366238613139373063362e6a7067, 'Syntax Squad brow', 'Super Admin', '2005-12-06', 18, '6281222728232', 'Terampil', 'Pria', '$2y$10$xGmPCeehCwkaNKGljJvbf.SiSwsIhFIKlpsW0eBsiN.oajHCf9fjO', '$2y$10$xGmPCeehCwkaNKGljJvbf.SiSwsIhFIKlpsW0eBsiN.oajHCf9fjO'),
(2250081020, 0x363637613438656465353036392e6a7067, 'Adrian Musa ', 'Admin', '2003-12-06', 20, '6281238283283', 'Terampil', 'Pria', '$2y$10$9fiZCJEOGNAhbSJmhWO3kO1ZOeydUK7TXT2W69hHsAhU1y5WIQKkm', '$2y$10$9fiZCJEOGNAhbSJmhWO3kO1ZOeydUK7TXT2W69hHsAhU1y5WIQKkm');

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
(7, 210204, '2024-06-29', 80, 100);

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
(6, 210204, '2024-06-29', 50, 100);

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
(62, 210204, '2024-06-18', 999, 100);

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
(31, 210204, '2000-12-06', 21.2, 40);

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
(7, 210204, '2024-07-01', 88, 100);

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
(15, 210204, '2024-07-20', 999, 100);

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
(19, 55555, '2024-06-29', 45, 56);

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
(32, 55555, '2024-06-29', 22, 66);

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
(77, 55555, '2024-06-18', 20.0, 0);

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
(12, 55555, '2024-07-06', 84, 100);

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
(22, 55555, '2024-06-28', 40, 78);

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
(29, 123456789, 0x363637623936643039396431392e6a7067, 'HUHUHU', '2024-01-30', 4, '2024-06-27', 'Mahir', 'Aktif');

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
(55555, 0x363637643237616239333637342e6a7067, 'Pacar Sandro', '2002-02-02', 22, '+62 822-7623-8766', 'Mahir', 'Wanita', '$2y$10$pdGLnkFcaJzUm04v2sKfnOzaiwk9.BKEnwWATWzy8iSqbD3SvKNhy', '$2y$10$pdGLnkFcaJzUm04v2sKfnOzaiwk9.BKEnwWATWzy8iSqbD3SvKNhy'),
(210204, 0x363637623965356536633930612e6a7067, 'Sandro', '2004-02-21', 20, '+62 822-7655-4322', 'Mahir', 'Pria', '$2y$10$H.famxo/muBSehaW/OCHuO5L45ejb2zp9llOQ./GnPNN1AmZmOShq', '$2y$10$H.famxo/muBSehaW/OCHuO5L45ejb2zp9llOQ./GnPNN1AmZmOShq'),
(123456789, 0x363637613537653731616664652e6a7067, 'User Testing Pengguna', '2000-12-06', 23, '+62 812-2251-8720', 'Mahir', 'Pria', '$2y$10$vnr9aaS98gazsPDkPpTPQOTvHgn93Sx0PNOvcK4W5wsVDLsrZZwQe', '$2y$10$vnr9aaS98gazsPDkPpTPQOTvHgn93Sx0PNOvcK4W5wsVDLsrZZwQe'),
(1919191919, 0x363637623936373433666139352e6a7067, 'Wanita satu', '2001-12-06', 22, '+62 812-2261-72823', 'Mahir', 'Wanita', '$2y$10$kBrVxV//.XauZlY.Gf862.RwFr5sj9XqtSa75sa71W69kfczZtqZW', '$2y$10$kBrVxV//.XauZlY.Gf862.RwFr5sj9XqtSa75sa71W69kfczZtqZW'),
(2250081109, 0x363637623965623461633332322e6a7067, 'q', '2003-06-27', 20, '1', 'Mahir', 'Pria', '$2y$10$v0Pn9D0FUNoY1UoBBEOtb./Wo3SZQrQS35SvsgP30wKqeK3mlN4uq', '$2y$10$v0Pn9D0FUNoY1UoBBEOtb./Wo3SZQrQS35SvsgP30wKqeK3mlN4uq'),
(2250081177, 0x363637626236316335633264302e6a7067, 'Aku Sang Gibran', '1998-03-03', 26, '+62 812-8411-5155', 'Terampil', 'Pria', '$2y$10$3z3n0Caa36sXsH3oT6heTeQADRcXfgWMuHdhIS8tSj6Pi5BP6Kbi6', '$2y$10$3z3n0Caa36sXsH3oT6heTeQADRcXfgWMuHdhIS8tSj6Pi5BP6Kbi6');

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
(48, 210204, '2024-07-05', 9.0, 100);

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
(157, 210204, '2024-06-29', 15.0, 46);

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

--
-- Dumping data for table `tes_lari_wanita`
--

INSERT INTO `tes_lari_wanita` (`ID_Lari_Wanita`, `NIP_Pengguna`, `Tanggal_Pelaksanaan_Tes_Lari_Wanita`, `Waktu_Lari_Wanita`, `Nilai_Lari_Wanita`) VALUES
(12, 55555, '2032-02-06', '13.2', 47);

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
(48, 210204, '2024-07-03', '0', 'Dada', 100);

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
-- Dumping data for table `tes_renang_wanita`
--

INSERT INTO `tes_renang_wanita` (`ID_Renang_Wanita`, `NIP_Pengguna`, `Tanggal_Pelaksanaan_Tes_Renang_Wanita`, `Waktu_Renang_Wanita`, `Nama_Gaya_Renang_Wanita`, `Nilai_Renang_Wanita`) VALUES
(18, 55555, '2024-06-21', '0000-00-00 00:00:00', 'Dada', 100);

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
