-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 07, 2020 at 07:18 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbspp`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbljurusan`
--

CREATE TABLE `tbljurusan` (
  `id_jurusan` int(11) NOT NULL,
  `jurusan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbljurusan`
--

INSERT INTO `tbljurusan` (`id_jurusan`, `jurusan`) VALUES
(1, 'Rekayasa Perangkat Lunak'),
(3, 'Teknik Komputer Jaringan'),
(4, 'Akuntansi');

-- --------------------------------------------------------

--
-- Table structure for table `tblkelas`
--

CREATE TABLE `tblkelas` (
  `id_kelas` int(11) NOT NULL,
  `id_jurusan` int(11) NOT NULL,
  `kelas` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblkelas`
--

INSERT INTO `tblkelas` (`id_kelas`, `id_jurusan`, `kelas`) VALUES
(2, 1, 'X RPL 1'),
(5, 3, 'X TKJ 1');

-- --------------------------------------------------------

--
-- Table structure for table `tblpembayaran`
--

CREATE TABLE `tblpembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `nisn` char(10) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tglbayar` date NOT NULL,
  `jumlah_bayar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblsekolah`
--

CREATE TABLE `tblsekolah` (
  `id` int(11) NOT NULL,
  `identitas` varchar(50) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblsekolah`
--

INSERT INTO `tblsekolah` (`id`, `identitas`, `value`) VALUES
(1, 'nama_sekolah', 'SMK MULTISTUDI HIGHSCHOOL'),
(2, 'alamat', 'Jalan Kuda Laut Kavling 121');

-- --------------------------------------------------------

--
-- Table structure for table `tblsiswa`
--

CREATE TABLE `tblsiswa` (
  `nisn` char(10) NOT NULL,
  `nis` char(6) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_spp` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `nohp` char(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblspp`
--

CREATE TABLE `tblspp` (
  `id_spp` int(11) NOT NULL,
  `tahun` int(4) NOT NULL,
  `nominal` int(11) NOT NULL,
  `remarks` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(16) NOT NULL,
  `password` varchar(100) NOT NULL,
  `privilege` enum('admin','petugas') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbljurusan`
--
ALTER TABLE `tbljurusan`
  ADD PRIMARY KEY (`id_jurusan`);

--
-- Indexes for table `tblkelas`
--
ALTER TABLE `tblkelas`
  ADD PRIMARY KEY (`id_kelas`),
  ADD KEY `id_jurusan` (`id_jurusan`);

--
-- Indexes for table `tblpembayaran`
--
ALTER TABLE `tblpembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `nisn` (`nisn`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tblsekolah`
--
ALTER TABLE `tblsekolah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblsiswa`
--
ALTER TABLE `tblsiswa`
  ADD PRIMARY KEY (`nisn`),
  ADD KEY `id_kelas` (`id_kelas`),
  ADD KEY `id_spp` (`id_spp`);

--
-- Indexes for table `tblspp`
--
ALTER TABLE `tblspp`
  ADD PRIMARY KEY (`id_spp`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbljurusan`
--
ALTER TABLE `tbljurusan`
  MODIFY `id_jurusan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblkelas`
--
ALTER TABLE `tblkelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblpembayaran`
--
ALTER TABLE `tblpembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblsekolah`
--
ALTER TABLE `tblsekolah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblspp`
--
ALTER TABLE `tblspp`
  MODIFY `id_spp` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblkelas`
--
ALTER TABLE `tblkelas`
  ADD CONSTRAINT `tblkelas_ibfk_1` FOREIGN KEY (`id_jurusan`) REFERENCES `tbljurusan` (`id_jurusan`);

--
-- Constraints for table `tblpembayaran`
--
ALTER TABLE `tblpembayaran`
  ADD CONSTRAINT `tblpembayaran_ibfk_1` FOREIGN KEY (`nisn`) REFERENCES `tblsiswa` (`nisn`),
  ADD CONSTRAINT `tblpembayaran_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `tbluser` (`id_user`);

--
-- Constraints for table `tblsiswa`
--
ALTER TABLE `tblsiswa`
  ADD CONSTRAINT `tblsiswa_ibfk_1` FOREIGN KEY (`id_spp`) REFERENCES `tblspp` (`id_spp`),
  ADD CONSTRAINT `tblsiswa_ibfk_2` FOREIGN KEY (`id_kelas`) REFERENCES `tblkelas` (`id_kelas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
