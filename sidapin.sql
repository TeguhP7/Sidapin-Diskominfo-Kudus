-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 01, 2020 at 03:29 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sidapin`
--

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

CREATE TABLE `assets` (
  `id_assets` int(11) NOT NULL,
  `kode_aset` text NOT NULL,
  `nama_aset` text NOT NULL,
  `tahun` text NOT NULL,
  `kondisi` enum('Baik','Rusak') NOT NULL,
  `ket_lain` text NOT NULL,
  `foto_aset` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assets`
--

INSERT INTO `assets` (`id_assets`, `kode_aset`, `nama_aset`, `tahun`, `kondisi`, `ket_lain`, `foto_aset`) VALUES
(1, '23487672HH', 'Laptop Asus Core i7', '2018', 'Rusak', 'Ga ada', '729.jpg'),
(2, '897778GT11', 'Printer JET 86', '2018', 'Rusak', 'Ga ada', '4.jpg'),
(3, '342432432POT', 'Komputer DELL Series 10A', '2018', 'Rusak', 'Ga ada', '14216.jpg'),
(7, '1117287NUBB', 'Daikin AC 9000', '2012', 'Rusak', 'Masih di gudang', 'OR68WI0.jpg'),
(8, '1117287CV', 'Laptop Asus 2 Core i7', '2018', 'Rusak', 'Lancar', 'bg6.png'),
(9, '1117287COC', 'Digitec Wireless Mouse 110', '2018', 'Baik', 'OK', '62042.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `inven`
--

CREATE TABLE `inven` (
  `id` int(11) NOT NULL,
  `id_assets` bigint(50) NOT NULL,
  `id_peg` bigint(50) NOT NULL,
  `ket_lain` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inven`
--

INSERT INTO `inven` (`id`, `id_assets`, `id_peg`, `ket_lain`) VALUES
(1, 1, 8, 'Ga ada ah'),
(2, 2, 4, 'Ga ada'),
(3, 3, 4, 'Ga ada'),
(7, 7, 1, 'Masih di gudang'),
(8, 8, 1, 'Lancar'),
(9, 9, 8, 'OK'),
(10, 8, 11, 'ndak'),
(16, 8, 12, 's'),
(19, 7, 9, 'sip');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_peg` bigint(50) NOT NULL,
  `nip_pegawai` bigint(50) NOT NULL,
  `nama_pegawai` varchar(50) NOT NULL,
  `jabatan` text NOT NULL,
  `telepon` text NOT NULL,
  `status_p` enum('PNS','Honorer / Kontrak','Lainnya') NOT NULL,
  `alamat` text NOT NULL,
  `jenis_k` enum('Laki-laki','Perempuan') NOT NULL,
  `agama` varchar(20) NOT NULL,
  `status` enum('Lajang','Menikah') NOT NULL,
  `nama_file` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_peg`, `nip_pegawai`, `nama_pegawai`, `jabatan`, `telepon`, `status_p`, `alamat`, `jenis_k`, `agama`, `status`, `nama_file`) VALUES
(1, 11962176120, 'Dartii', 'Staff', '0874152417', 'PNS', 'Jl. Poll', 'Perempuan', 'Islam', 'Lajang', 'user3x4.png'),
(4, 11962341261, 'Rudi', 'Umum', '0895671282', 'PNS', 'Jl. Menara umum', 'Laki-laki', 'Islam', 'Lajang', 'user3x4.png'),
(8, 11962514321, 'Budiono Wong', 'Kepala Dinas', '082991345672', 'PNS', 'Jl. Mager no. 77, Ds. Jati Kulon', 'Laki-laki', 'Kristen', 'Lajang', 'user3x4.png'),
(9, 11962666091, 'Sunarto', 'Teller', '081245678666', 'PNS', 'Jl. jalankuy', 'Laki-laki', 'Kristen', 'Menikah', 'user3x4.png'),
(11, 11920206712, 'Odading', 'Kepala Divisi', '082177653452', 'PNS', 'Jl. Sambat', 'Laki-laki', 'Islam', 'Menikah', 'user3x4.png'),
(12, 11920288712, 'Arifin', 'Sekretaris', '082177653452', 'PNS', 'Jl. Magang meneh', 'Laki-laki', 'Islam', 'Lajang', 'user3x4.png'),
(13, 11920206888, 'Catur', 'Ketua Pramuka', '083178653153', 'Lainnya', 'Jl. Deket', 'Laki-laki', 'Islam', 'Lajang', 'user3x4.png'),
(14, 11920288714, 'Dadang', 'Kabid', '082177653777', 'PNS', 'Jl. juga', 'Laki-laki', 'Islam', 'Lajang', 'user3x4.png'),
(15, 11976506888, 'Pinta', 'Ibu Negaraa', '082877659354', 'PNS', 'Jl. in aja', 'Perempuan', 'Islam', 'Lajang', 'user3x4.png'),
(16, 11920288564, 'Sari', 'Ibu Negara ', '08217765435', 'PNS', 'Jl. jalankuyy', 'Perempuan', 'Islam', 'Lajang', ''),
(17, 11962514777, 'Teguh', 'Developer', '0895342432727', 'Lainnya', 'Jl. PLN', 'Laki-laki', 'Islam', 'Lajang', '3x4.JPG');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` enum('admin','pegawai') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `status`) VALUES
('admin', 'admin', 'admin'),
('bot', 'bot', 'pegawai'),
('kominfo', 'kominfo', 'admin'),
('teguh', 'teguh', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assets`
--
ALTER TABLE `assets`
  ADD PRIMARY KEY (`id_assets`);

--
-- Indexes for table `inven`
--
ALTER TABLE `inven`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_peg`) USING BTREE,
  ADD UNIQUE KEY `id` (`nip_pegawai`) USING BTREE;

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assets`
--
ALTER TABLE `assets`
  MODIFY `id_assets` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `inven`
--
ALTER TABLE `inven`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_peg` bigint(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
