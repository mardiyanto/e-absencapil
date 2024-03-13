-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2024 at 09:57 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_absenkhanza`
--

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(100) NOT NULL,
  `kode_pegawai` varchar(100) NOT NULL,
  `nama_pegawai` varchar(100) NOT NULL,
  `status_pegawai` varchar(100) NOT NULL,
  `nik` varchar(100) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` varchar(100) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `kode_pegawai`, `nama_pegawai`, `status_pegawai`, `nik`, `tgl_lahir`, `jenis_kelamin`, `alamat`) VALUES
(1, 'KR001', 'MARDIYANTO', 'P3K', '1820706109100034', '1991-06-10', 'Laki-Laki', ''),
(3, 'KR002', 'WIDIANTO', 'P3K', '88927972', '0000-00-00', 'Laki-Laki', ''),
(4, 'KR004', 'SUHARJO', 'PNS', '7167866', '1991-12-16', 'Laki-Laki', '');

-- --------------------------------------------------------

--
-- Table structure for table `presensi_datang`
--

CREATE TABLE `presensi_datang` (
  `id_presensi_datang` int(100) NOT NULL,
  `gambar_datang` varchar(100) NOT NULL,
  `tanggal_absensi_datang` date NOT NULL,
  `jam_absensi_datang` varchar(100) NOT NULL,
  `id_pegawai` varchar(100) NOT NULL,
  `status_absensi_datang` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `presensi_datang`
--

INSERT INTO `presensi_datang` (`id_presensi_datang`, `gambar_datang`, `tanggal_absensi_datang`, `jam_absensi_datang`, `id_pegawai`, `status_absensi_datang`) VALUES
(1, 'absen_3_1710313000.jpg', '2024-03-13', '13:56:40', '3', 'datang'),
(2, 'absen_1_1710313044.jpg', '2024-03-13', '13:57:24', '1', 'datang'),
(3, 'absen_4_1710315170.jpg', '2024-03-13', '14:32:50', '4', 'datang');

-- --------------------------------------------------------

--
-- Table structure for table `presensi_pulang`
--

CREATE TABLE `presensi_pulang` (
  `id_presensi_pulang` int(100) NOT NULL,
  `gambar_pulang` varchar(100) NOT NULL,
  `tanggal_absensi_pulang` date NOT NULL,
  `jam_absensi_pulang` varchar(100) NOT NULL,
  `id_pegawai` varchar(100) NOT NULL,
  `status_absensi_pulang` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `presensi_pulang`
--

INSERT INTO `presensi_pulang` (`id_presensi_pulang`, `gambar_pulang`, `tanggal_absensi_pulang`, `jam_absensi_pulang`, `id_pegawai`, `status_absensi_pulang`) VALUES
(1, 'absen_3_1710313027.jpg', '2024-03-13', '13:57:07', '3', 'pulang'),
(3, 'absen_1_1710314227.jpg', '2024-03-13', '14:17:07', '1', 'pulang'),
(4, 'absen_4_1710318323.jpg', '2024-03-13', '15:25:23', '4', 'pulang');

-- --------------------------------------------------------

--
-- Table structure for table `profil`
--

CREATE TABLE `profil` (
  `id_profil` int(20) NOT NULL,
  `nama_app` varchar(100) NOT NULL,
  `tahun` varchar(250) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `alias` varchar(350) NOT NULL,
  `alamat` text NOT NULL,
  `isi` text NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `akabest` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profil`
--

INSERT INTO `profil` (`id_profil`, `nama_app`, `tahun`, `nama`, `alias`, `alamat`, `isi`, `gambar`, `akabest`) VALUES
(1, 'APP', '2022/2023', 'preeklampsia', 'IBU HAMIL', 'JL Wismarini No 09 Pringsewu Lampung', '', '26122022051024.jpg', 'mardybest@gmail.com'),
(2, 're', '', 'MARDIYANTO', '19081989578978975', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_nama` varchar(100) NOT NULL,
  `user_username` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_foto` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_nama`, `user_username`, `user_password`, `user_foto`) VALUES
(1, 'Adminatun Jhony', 'admin', '21232f297a57a5a743894a0e4a801fc3', '482937136_avatar.png'),
(10, 'aka', 'aka', 'c4ca4238a0b923820dcc509a6f75849b', '1869563217_ilustrasi-ikan-lele-1_169.jpeg'),
(11, 'tes', '123', '202cb962ac59075b964b07152d234b70', ''),
(12, 'bangsat', 'bangsat', '528f980649c80a7269402447b51e815a', '1638032220_17-52-06-IMG-20221008-WA0001.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indexes for table `presensi_datang`
--
ALTER TABLE `presensi_datang`
  ADD PRIMARY KEY (`id_presensi_datang`);

--
-- Indexes for table `presensi_pulang`
--
ALTER TABLE `presensi_pulang`
  ADD PRIMARY KEY (`id_presensi_pulang`);

--
-- Indexes for table `profil`
--
ALTER TABLE `profil`
  ADD PRIMARY KEY (`id_profil`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `presensi_datang`
--
ALTER TABLE `presensi_datang`
  MODIFY `id_presensi_datang` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `presensi_pulang`
--
ALTER TABLE `presensi_pulang`
  MODIFY `id_presensi_pulang` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `profil`
--
ALTER TABLE `profil`
  MODIFY `id_profil` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
