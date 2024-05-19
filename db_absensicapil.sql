-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 19 Mei 2024 pada 10.30
-- Versi Server: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_absensicapil`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `kritik`
--

CREATE TABLE `kritik` (
  `id_kritik` int(40) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `pesan` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kritik`
--

INSERT INTO `kritik` (`id_kritik`, `nama`, `email`, `pesan`) VALUES
(1, 'ok', 'o@g.com', 'app eror');

-- --------------------------------------------------------

--
-- Struktur dari tabel `map`
--

CREATE TABLE `map` (
  `id_map` int(100) NOT NULL,
  `latitude` varchar(100) NOT NULL,
  `longitude` varchar(100) NOT NULL,
  `status` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `map`
--

INSERT INTO `map` (`id_map`, `latitude`, `longitude`, `status`) VALUES
(1, '-5.343558', '104.963722', 'aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
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
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `kode_pegawai`, `nama_pegawai`, `status_pegawai`, `nik`, `tgl_lahir`, `jenis_kelamin`, `alamat`) VALUES
(1, 'KR001', 'DARWIN', 'TKS', '1806111811840003', '1984-01-18', 'Laki-Laki', ''),
(2, 'KR002', 'MUHAMMAD TAUFIQ RAIHAN', 'TKS', '1871070603960005', '1996-03-06', 'Laki-Laki', ''),
(3, 'KR003', 'SUSANEN', 'TKS', '1810040505850006', '1985-05-05', 'Laki-Laki', ''),
(4, 'KR004', 'JUWANDA', 'TKS', '1806250707870006', '1987-07-07', 'Laki-Laki', ''),
(5, 'KR005', 'LAILA PARAMITHA', 'TKS', '1806115804900002', '1990-04-18', 'Perempuan', ''),
(6, 'KR006', 'SOFIA. R', 'TKS', '1806044702840001', '1984-02-07', 'Perempuan', ''),
(7, 'KR007', 'BINA LESTARI', 'TKS', '1810014508920004', '1992-08-05', 'Perempuan', ''),
(8, 'KR008', 'RIANSYAH', 'TKS', '1806112005920004', '1992-05-20', 'Laki-Laki', ''),
(9, 'KR009', 'PURNAMA SARI', 'TKS', '1806116710880010', '1988-10-27', 'Perempuan', ''),
(10, 'KR010', 'NELDA FITRIYANI', 'TKS', '1810055504910002', '1991-04-15', 'Perempuan', ''),
(11, 'KR010', 'EFRIYANI', 'TKS', '1810016509880003', '1988-09-25', 'Perempuan', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `presensi_datang`
--

CREATE TABLE `presensi_datang` (
  `id_presensi_datang` int(100) NOT NULL,
  `gambar_datang` varchar(100) NOT NULL,
  `tanggal_absensi_datang` date NOT NULL,
  `jam_absensi_datang` varchar(100) NOT NULL,
  `id_pegawai` int(100) NOT NULL,
  `status_absensi_datang` varchar(100) NOT NULL,
  `status_absensi` varchar(100) DEFAULT NULL,
  `status_hadir` varchar(100) DEFAULT NULL,
  `latitude` varchar(100) DEFAULT NULL,
  `longitude` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `presensi_datang`
--

INSERT INTO `presensi_datang` (`id_presensi_datang`, `gambar_datang`, `tanggal_absensi_datang`, `jam_absensi_datang`, `id_pegawai`, `status_absensi_datang`, `status_absensi`, `status_hadir`, `latitude`, `longitude`) VALUES
(1, 'absen_1_1716105910.jpg', '2024-05-19', '15:05:10', 1, 'datang', 'pagi', 'hadir', '-5.3484755', '104.9651819');

-- --------------------------------------------------------

--
-- Struktur dari tabel `presensi_pulang`
--

CREATE TABLE `presensi_pulang` (
  `id_presensi_pulang` int(100) NOT NULL,
  `gambar_pulang` varchar(100) NOT NULL,
  `tanggal_absensi_pulang` date NOT NULL,
  `jam_absensi_pulang` varchar(100) NOT NULL,
  `id_pegawai` int(100) NOT NULL,
  `status_absensi_pulang` varchar(100) NOT NULL,
  `latitude` varchar(100) DEFAULT NULL,
  `longitude` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `presensi_pulang`
--

INSERT INTO `presensi_pulang` (`id_presensi_pulang`, `gambar_pulang`, `tanggal_absensi_pulang`, `jam_absensi_pulang`, `id_pegawai`, `status_absensi_pulang`, `latitude`, `longitude`) VALUES
(1, 'absen_1_1716105949.jpg', '2024-05-19', '15:05:49', 1, 'pulang', '-5.3484755', '104.9651819');

-- --------------------------------------------------------

--
-- Struktur dari tabel `profil`
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
-- Dumping data untuk tabel `profil`
--

INSERT INTO `profil` (`id_profil`, `nama_app`, `tahun`, `nama`, `alias`, `alamat`, `isi`, `gambar`, `akabest`) VALUES
(1, 'E-ABSENSI', '089789783784635', 'ABSENSI ONLINE DISDUK CAPIL PRINGSEWU', ' disdukcapilpringsewu@gmail.com', 'Komplek Perkantoran Pemerintah Daerah Pringsewu Lampung', 'Dinas Kependudukan dan Pencatatan Sipil (Disduk Capil) Pringsewu memiliki peran sentral dalam mengelola aspek kependudukan di wilayahnya yang melibatkan berbagai fungsi dan tugas yaitumenangani pencatatan semua peristiwa penting kependudukan, termasuk kelahiran, kematian, perkawinan, dan perceraian. Dinas Kependudukan dan Pencatatan Sipil (Disduk Capil) Pringsewu juga memberikan pelayanan terkait dokumen kependudukan, seperti akta kelahiran, akta kematian, dan dokumen lainnya kepada masyarakat dan bertanggung jawab atas perekaman dan pengelolaan data penduduk secara akurat dan terkini.Dinas Kependudukan dan Pencatatan Sipil (Disduk Capil) Pringsewu terletak di Jl. Jogyakarta, Kecamatan Gading Rejo, Kabupaten Pringsewu, Lampung, 35372, yang berada dalam Komplek Perkantoran Pemerintah Daerah Pringsewu Lampung, lembaga ini bertanggung jawab atas data kependudukan yang ada di daerah Kabupaten Pringsewu', '26122022051024.jpg', 'mardybest@gmail.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_nama` varchar(100) NOT NULL,
  `user_username` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_foto` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`user_id`, `user_nama`, `user_username`, `user_password`, `user_foto`) VALUES
(1, 'Adminatun Jhony', 'admin', '21232f297a57a5a743894a0e4a801fc3', '482937136_avatar.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kritik`
--
ALTER TABLE `kritik`
  ADD PRIMARY KEY (`id_kritik`);

--
-- Indexes for table `map`
--
ALTER TABLE `map`
  ADD PRIMARY KEY (`id_map`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indexes for table `presensi_datang`
--
ALTER TABLE `presensi_datang`
  ADD PRIMARY KEY (`id_presensi_datang`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indexes for table `presensi_pulang`
--
ALTER TABLE `presensi_pulang`
  ADD PRIMARY KEY (`id_presensi_pulang`),
  ADD KEY `id_pegawai` (`id_pegawai`);

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
-- AUTO_INCREMENT for table `kritik`
--
ALTER TABLE `kritik`
  MODIFY `id_kritik` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `map`
--
ALTER TABLE `map`
  MODIFY `id_map` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `presensi_datang`
--
ALTER TABLE `presensi_datang`
  MODIFY `id_presensi_datang` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `presensi_pulang`
--
ALTER TABLE `presensi_pulang`
  MODIFY `id_presensi_pulang` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `profil`
--
ALTER TABLE `profil`
  MODIFY `id_profil` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `presensi_datang`
--
ALTER TABLE `presensi_datang`
  ADD CONSTRAINT `presensi_datang_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `presensi_pulang`
--
ALTER TABLE `presensi_pulang`
  ADD CONSTRAINT `presensi_pulang_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
