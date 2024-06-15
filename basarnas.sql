-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2024 at 02:51 AM
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
  `Detik_Push_Up_Pria` int(6) NOT NULL,
  `Nilai_Push_Up_Pria` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `garjas_pria_push_up`
--

INSERT INTO `garjas_pria_push_up` (`ID_Push_Up_Pria`, `NIP_Pengguna`, `Jumlah_Push_Up_Pria`, `Detik_Push_Up_Pria`, `Nilai_Push_Up_Pria`) VALUES
(25, 21, 44, 50, 0),
(26, 10011, 44, 58, 98),
(27, 10011, 43, 50, 96),
(28, 10011, 43, 54, 94),
(29, 10011, 43, 51, 95),
(30, 80, 44, 10, 100),
(31, 80, 44, 55, 100),
(32, 80, 44, 70, 0);

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
(2, 87, 33, 89);

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
(3, 5555, 33, 57),
(4, 87, 22, 38),
(5, 87, 55, 0);

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
(11, 0x313731383235393933315f352e6a706567, 'Istri Sandro', '2004-02-21', 20, 'Batujajar1RumahsamaSandro', '+62 877-3445-5677', 'Satu', 'Wanita', '$2y$10$wac4bpBJVdh.uvg8sLTYluok94KP8YecBXa1I4HVLOm90w5YuQ6Xu', '$2y$10$wac4bpBJVdh.uvg8sLTYluok94KP8YecBXa1I4HVLOm90w5YuQ6Xu'),
(21, 0x313731383235383234365f392e6a7067, 'SANDRO', '1996-05-02', 28, 'Batujajar', '+62 822-4557-7688', 'Satu', 'Pria', '$2y$10$lB/gdIf9Oi7NPjvqfougHuxSJ0.XHnVMGabC/yhWdz5bvHu9XKLRa', '$2y$10$lB/gdIf9Oi7NPjvqfougHuxSJ0.XHnVMGabC/yhWdz5bvHu9XKLRa'),
(80, 0x313731383236383235355f342e6a706567, 'Bodro', '2020-06-13', 4, '1', '+62 1--', 'Satu', 'Pria', '$2y$10$nrgzGOEgTfj3o66OVcsUPeJdEcJsf8XxPI.eO/2.zEpt6DpoP2CYu', '$2y$10$nrgzGOEgTfj3o66OVcsUPeJdEcJsf8XxPI.eO/2.zEpt6DpoP2CYu'),
(87, 0x313731383130323835335f342e6a706567, 'Salsa', '2002-09-09', 21, 'Batujajar', '+62 877-5441-1234', 'Satu', 'Wanita', '$2y$10$nHXQKafHpiklNhfOeAi7.OThpKIxGTpIUYC21Sew8zVAf.UYjJ8o2', '$2y$10$nHXQKafHpiklNhfOeAi7.OThpKIxGTpIUYC21Sew8zVAf.UYjJ8o2'),
(4545, 0x313731383336363438345f494d475f32303232313231385f3130323932362e6a7067, 'Adrian', '2005-03-04', 19, 'Bandung', '+62 085-9128-82772', 'Satu', 'Pria', '$2y$10$F/bb/E98VF.QsABJlReGtOi9V1o2WkRWpxP3o20DLuwQfLjZi6Rfe', '$2y$10$F/bb/E98VF.QsABJlReGtOi9V1o2WkRWpxP3o20DLuwQfLjZi6Rfe'),
(5555, 0x313731383336363430365f494d475f32303232313231385f3130323932362e6a7067, 'Adrian', '2003-03-04', 21, 'Bandung', '+62 081-2262-28239', 'Satu', 'Wanita', '$2y$10$kzXpZbpwj5p4AOOJTVPZhO.YUBN9T3ngpNruu1kV0tWDP5YXrsqkG', '$2y$10$kzXpZbpwj5p4AOOJTVPZhO.YUBN9T3ngpNruu1kV0tWDP5YXrsqkG'),
(10011, 0x313731383235363530335f392e6a7067, 'Sandro Anugrah Tambunan', '2004-02-21', 20, 'BatujajarBarat', '+62 822-6552-2341', 'Satu', 'Pria', '$2y$10$1bpr2GLdeYPFSjXVPGvcN.UpVlH3zqQJEpf.9Umn67.64UuSPg63a', '$2y$10$1bpr2GLdeYPFSjXVPGvcN.UpVlH3zqQJEpf.9Umn67.64UuSPg63a');

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
  MODIFY `ID_Push_Up_Pria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `garjas_wanita_chin_up`
--
ALTER TABLE `garjas_wanita_chin_up`
  MODIFY `ID_Wanita_Chin_Up` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `garjas_wanita_push_up`
--
ALTER TABLE `garjas_wanita_push_up`
  MODIFY `ID_Wanita_Push_Up` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `garjas_wanita_shuttle_run`
--
ALTER TABLE `garjas_wanita_shuttle_run`
  MODIFY `ID_Wanita_Shuttle_Run` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `garjas_wanita_sit_up_kaki_di_tekuk`
--
ALTER TABLE `garjas_wanita_sit_up_kaki_di_tekuk`
  MODIFY `ID_Wanita_Sit_Up_Kaki_Di_Tekuk` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `garjas_wanita_sit_up_kaki_lurus`
--
ALTER TABLE `garjas_wanita_sit_up_kaki_lurus`
  MODIFY `ID_Wanita_Sit_Up_Kaki_Lurus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
