-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2021 at 02:01 AM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.3.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `marketing`
--

-- --------------------------------------------------------

--
-- Table structure for table `dapok`
--

CREATE TABLE `dapok` (
  `kode` varchar(100) NOT NULL,
  `tabungan` varchar(100) NOT NULL,
  `kredit` varchar(100) NOT NULL,
  `tagihan_pok` varchar(100) NOT NULL,
  `tagihan_bung` varchar(100) NOT NULL,
  `npl` varchar(100) NOT NULL,
  `tahun` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dapok`
--

INSERT INTO `dapok` (`kode`, `tabungan`, `kredit`, `tagihan_pok`, `tagihan_bung`, `npl`, `tahun`) VALUES
('1', '2.000.000', '2.000.000', '1.500.000', '900.000', '1.300.000', 2020);

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan_awal`
--

CREATE TABLE `kegiatan_awal` (
  `kode` varchar(100) NOT NULL,
  `nama_kegiatan` varchar(100) NOT NULL,
  `nama_ao` varchar(255) NOT NULL,
  `target_noa` int(11) NOT NULL,
  `target_nom` int(11) NOT NULL,
  `target_pro` int(11) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kegiatan_awal`
--

INSERT INTO `kegiatan_awal` (`kode`, `nama_kegiatan`, `nama_ao`, `target_noa`, `target_nom`, `target_pro`, `tanggal`) VALUES
('KG135581', 'Tagihan', 'rangga', 0, 0, 0, '2020-12-28'),
('KG19240', 'Promosi', 'rangga', 0, 0, 0, '2020-12-28'),
('KG275313', 'Tabungan', 'demil', 0, 0, 0, '2021-01-12'),
('KG282999', 'Tabungan', 'rian', 0, 0, 0, '2020-12-27'),
('KG394732', 'Tabungan', 'rian', 0, 0, 0, '2021-01-12'),
('KG474938', 'Kegiatan Lain', 'rangga', 0, 0, 0, '2021-01-08'),
('KG521374', 'Tabungan', 'rangga', 0, 0, 0, '2021-01-08'),
('KG526490', 'Kegiatan Lain', 'rangga', 0, 0, 0, '2021-01-12'),
('KG529217', 'Tagihan', 'rangga', 3, 100000, 0, '2021-01-08'),
('KG532755', 'Promosi', 'rian', 0, 0, 0, '2020-12-22'),
('KG548970', 'Tabungan', 'rangga', 0, 0, 0, '2021-01-12'),
('KG570154', 'Promosi', 'rian', 0, 0, 0, '2020-12-23'),
('KG590387', 'Tabungan', 'rangga', 0, 0, 0, '2020-12-28'),
('KG604863', 'Tagihan', 'rian', 0, 0, 0, '2020-12-22'),
('KG617954', 'Tagihan', 'rangga', 4, 1200000, 0, '2021-01-11'),
('KG646771', 'Tagihan', 'rangga', 0, 1200000, 0, '2020-12-26'),
('KG672734', 'Promosi', 'rangga', 0, 950000, 0, '2020-12-22'),
('KG688613', 'Tagihan', 'rian', 0, 0, 0, '2020-12-26'),
('KG703083', 'Promosi', 'rangga', 0, 0, 5, '2021-01-09'),
('KG707762', 'Tagihan', 'rian', 0, 0, 0, '2020-12-28'),
('KG70879', 'Tabungan', 'rian', 0, 0, 0, '2020-12-22'),
('KG742845', 'Promosi', 'rangga', 0, 0, 6, '2021-01-11'),
('KG801949', 'Promosi', 'rangga', 0, 1000000, 0, '2020-12-27'),
('KG862153', 'Tabungan', 'aris', 0, 0, 0, '2021-01-12'),
('KG922842', 'Tabungan', 'rian', 0, 0, 0, '2020-12-25');

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan_lain`
--

CREATE TABLE `kegiatan_lain` (
  `kode` varchar(100) NOT NULL,
  `nama_keg` varchar(100) NOT NULL,
  `f_jam` time NOT NULL,
  `to_jam` time NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `ao` varchar(100) NOT NULL,
  `tgl` date NOT NULL,
  `id_keg` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kegiatan_lain`
--

INSERT INTO `kegiatan_lain` (`kode`, `nama_keg`, `f_jam`, `to_jam`, `keterangan`, `ao`, `tgl`, `id_keg`) VALUES
('KL295660', 'OJK', '10:51:00', '15:51:00', 'Ah', 'rangga', '2021-01-08', 'KG474938');

-- --------------------------------------------------------

--
-- Table structure for table `promosi`
--

CREATE TABLE `promosi` (
  `kode` varchar(100) NOT NULL,
  `wilayah` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `kep` varchar(100) NOT NULL,
  `produk` varchar(100) NOT NULL,
  `nominal` int(11) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `ao` varchar(100) NOT NULL,
  `tgl` date NOT NULL,
  `id_keg` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `promosi`
--

INSERT INTO `promosi` (`kode`, `wilayah`, `nama`, `alamat`, `no_hp`, `kep`, `produk`, `nominal`, `keterangan`, `ao`, `tgl`, `id_keg`) VALUES
('PRO164879', 'Soreang', 'Herman', 'Gading Rt01/01', '08588728919', 'Deal', 'Tabungan', 25000, 'Simaspro', 'rangga', '2021-01-08', 'KG703083'),
('PRO741694', 'Cisondari', 'Suci', 'cisondari RT01/012', '085871740847', '', '', 0, '', 'rangga', '2020-12-28', 'KG19240'),
('PRO757148', 'Cisondari', 'Ujang', 'cisondari RT01/011', '08283829189', '', '', 0, '', 'rangga', '2020-12-27', 'KG801949'),
('PRO855799', 'Ciwidey', 'Gugun', 'Pasirjambu Rt01/01', '085888728198', 'Deal', 'Tabungan', 30000, 'Bumbung', 'rangga', '2021-01-08', 'KG703083'),
('PRO903543', 'Pasirjambu', 'Hilman', 'Cisondari RT01/01', '085887198291', 'Deal', 'Tabungan', 30000, 'Simaspro', 'rangga', '2021-01-11', 'KG742845');

-- --------------------------------------------------------

--
-- Table structure for table `rbb_tabungan_all`
--

CREATE TABLE `rbb_tabungan_all` (
  `kode` varchar(100) NOT NULL,
  `periode` year(4) NOT NULL,
  `nominal` double NOT NULL,
  `nominal2` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rbb_tabungan_all`
--

INSERT INTO `rbb_tabungan_all` (`kode`, `periode`, `nominal`, `nominal2`) VALUES
('RTAB250', 2021, 4000000000, 4000000000),
('RTAB333', 2020, 5400000000, 5400000000);

-- --------------------------------------------------------

--
-- Table structure for table `rbb_tabungan_ao`
--

CREATE TABLE `rbb_tabungan_ao` (
  `kode` varchar(100) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nominal_ao` double NOT NULL,
  `kode_all` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rbb_tabungan_ao`
--

INSERT INTO `rbb_tabungan_ao` (`kode`, `id_user`, `nominal_ao`, `kode_all`) VALUES
('RAO11750', 1, 20000000, 'RTAB333'),
('RAO60867', 3, 22000000, 'RTAB333'),
('RAO61786', 3, 30000000, 'RTAB250'),
('RAO80135', 4, 34000000, 'RTAB250'),
('RAO94737', 5, 25400000, 'RTAB250'),
('RAO98482', 1, 25000000, 'RTAB250');

-- --------------------------------------------------------

--
-- Table structure for table `rbb_tabungan_wil`
--

CREATE TABLE `rbb_tabungan_wil` (
  `kode` varchar(100) NOT NULL,
  `wilayah` varchar(100) NOT NULL,
  `nominal_wil` double NOT NULL,
  `kode_all` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rbb_tabungan_wil`
--

INSERT INTO `rbb_tabungan_wil` (`kode`, `wilayah`, `nominal_wil`, `kode_all`) VALUES
('RWIL2314', 'Ciwidey 1', 300000000, 'RTAB250'),
('RWIL5100', 'Ciwidey 1', 300000000, 'RTAB333'),
('RWIL7100', 'Ciwidey 2', 200000000, 'RTAB333'),
('RWIL821', 'Ciwidey 2', 250000000, 'RTAB250'),
('RWIL9185', 'Ciwidey 3', 325000000, 'RTAB250');

-- --------------------------------------------------------

--
-- Table structure for table `tabungan`
--

CREATE TABLE `tabungan` (
  `kode` varchar(100) NOT NULL,
  `nominal` int(100) NOT NULL,
  `noa` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `ao` varchar(100) NOT NULL,
  `id_keg` varchar(100) NOT NULL,
  `wilayah` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tabungan`
--

INSERT INTO `tabungan` (`kode`, `nominal`, `noa`, `tgl`, `ao`, `id_keg`, `wilayah`) VALUES
('TB124328', 1500000, 8, '2021-01-12', 'demil', 'KG275313', 'Ciwidey 1'),
('TB143014', 1200000, 4, '2020-12-27', 'rian', 'KG282999', 'Ciwidey 3'),
('TB172829', 1000000, 5, '2021-01-12', 'rangga', 'KG548970', 'Ciwidey 1'),
('TB193509', 1750000, 7, '2020-12-08', 'demil', 'KG275313', 'Ciwidey 1'),
('TB270782', 2000000, 10, '2021-01-07', 'demil', 'KG275313', 'Ciwidey 1'),
('TB302469', 2000000, 10, '2020-12-12', 'demil', 'KG275313', 'Ciwidey 1'),
('TB378656', 1000000, 4, '2021-01-08', 'rangga', 'KG521374', 'Ciwidey 1'),
('TB421327', 1600000, 9, '2021-01-11', 'rian', 'KG394732', 'Ciwidey 3'),
('TB4304', 1300000, 8, '2021-01-12', 'rian', 'KG394732', 'Ciwidey 3'),
('TB451270', 2300000, 12, '2021-01-05', 'rangga', 'KG548970', 'Ciwidey 1'),
('TB549453', 2300000, 6, '2021-01-08', 'aris', 'KG862153', 'Ciwidey 2'),
('TB66680', 2101000, 6, '2021-01-09', 'rian', 'KG394732', 'Ciwidey 3'),
('TB706903', 2000000, 6, '2021-01-11', 'demil', 'KG275313', 'Ciwidey 1'),
('TB711574', 1600000, 8, '2021-01-11', 'rangga', 'KG548970', 'Ciwidey 1'),
('TB724542', 2300000, 9, '2021-01-11', 'aris', 'KG862153', 'Ciwidey 2'),
('TB769193', 3400000, 14, '2021-01-09', 'aris', 'KG862153', 'Ciwidey 2'),
('TB854719', 1000000, 7, '2021-01-10', 'demil', 'KG275313', 'Ciwidey 1'),
('TB910305', 2100000, 12, '2021-01-06', 'demil', 'KG275313', 'Ciwidey 1'),
('TB967427', 1600000, 7, '2020-12-12', 'rian', 'KG394732', 'Ciwidey 3'),
('TB980126', 1500000, 6, '2021-01-12', 'aris', 'KG862153', 'Ciwidey 2');

-- --------------------------------------------------------

--
-- Table structure for table `tagihan`
--

CREATE TABLE `tagihan` (
  `kode` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kolek` int(11) NOT NULL,
  `ket` varchar(100) NOT NULL,
  `jml_pokok` int(100) DEFAULT NULL,
  `jml_bunga` int(100) DEFAULT NULL,
  `jumlah` int(11) NOT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `tgl` date NOT NULL,
  `ao` varchar(100) NOT NULL,
  `id_keg` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tagihan`
--

INSERT INTO `tagihan` (`kode`, `nama`, `kolek`, `ket`, `jml_pokok`, `jml_bunga`, `jumlah`, `keterangan`, `tgl`, `ao`, `id_keg`) VALUES
('TG576553', 'Udin', 3, 'Bayar', 100000, 12000, 112000, '', '2021-01-11', 'rangga', 'KG617954'),
('TG580847', 'Endang', 1, 'Tidak Bayar', 0, 0, 0, 'covid', '2020-12-26', 'rangga', 'KG135581'),
('TG671258', 'Iman', 2, 'Tidak Bayar', 0, 0, 0, 'Covid', '2021-01-08', 'rangga', 'KG529217'),
('TG699613', 'Sukendar', 3, 'Tidak Bayar', 0, 0, 0, 'covid', '2020-12-26', 'rian', 'KG604863'),
('TG784516', 'Budi', 1, 'Bayar', 100000, 10000, 110000, '', '2021-01-08', 'rangga', 'KG529217'),
('TG785794', 'Mimin Aminah', 1, 'Bayar', 100000, 12000, 112000, '', '2020-12-26', 'rian', 'KG604863'),
('TG912307', 'Dadang', 1, 'Bayar', 100000, 12000, 112000, '', '2020-12-28', 'rangga', 'KG135581');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(20) NOT NULL,
  `wilayah` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `password`, `level`, `wilayah`) VALUES
(1, 'Rangga', 'rangga', 'rangga', 'AO', 'Ciwidey 1'),
(2, 'Admin', 'admin', 'admin', 'admin', ''),
(3, 'Aris', 'aris', 'aris', 'AO', 'Ciwidey 2'),
(4, 'Rian', 'rian', 'rian', 'AO', 'Ciwidey 3'),
(5, 'Demil', 'demil', 'demil', 'AO', 'Ciwidey 1'),
(7, 'Heri', 'heri', 'heri', 'AO', 'Ciwidey 2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dapok`
--
ALTER TABLE `dapok`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `kegiatan_awal`
--
ALTER TABLE `kegiatan_awal`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `kegiatan_lain`
--
ALTER TABLE `kegiatan_lain`
  ADD PRIMARY KEY (`kode`),
  ADD KEY `id_keg` (`id_keg`);

--
-- Indexes for table `promosi`
--
ALTER TABLE `promosi`
  ADD PRIMARY KEY (`kode`),
  ADD KEY `id_keg` (`id_keg`);

--
-- Indexes for table `rbb_tabungan_all`
--
ALTER TABLE `rbb_tabungan_all`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `rbb_tabungan_ao`
--
ALTER TABLE `rbb_tabungan_ao`
  ADD PRIMARY KEY (`kode`),
  ADD KEY `kode_all` (`kode_all`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `rbb_tabungan_wil`
--
ALTER TABLE `rbb_tabungan_wil`
  ADD PRIMARY KEY (`kode`),
  ADD KEY `kode_all` (`kode_all`);

--
-- Indexes for table `tabungan`
--
ALTER TABLE `tabungan`
  ADD PRIMARY KEY (`kode`),
  ADD KEY `id_keg` (`id_keg`);

--
-- Indexes for table `tagihan`
--
ALTER TABLE `tagihan`
  ADD PRIMARY KEY (`kode`),
  ADD KEY `id_keg` (`id_keg`),
  ADD KEY `id_keg_2` (`id_keg`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kegiatan_lain`
--
ALTER TABLE `kegiatan_lain`
  ADD CONSTRAINT `kegiatan_lain_ibfk_1` FOREIGN KEY (`id_keg`) REFERENCES `kegiatan_awal` (`kode`);

--
-- Constraints for table `promosi`
--
ALTER TABLE `promosi`
  ADD CONSTRAINT `promosi_ibfk_1` FOREIGN KEY (`id_keg`) REFERENCES `kegiatan_awal` (`kode`);

--
-- Constraints for table `rbb_tabungan_ao`
--
ALTER TABLE `rbb_tabungan_ao`
  ADD CONSTRAINT `rbb_tabungan_ao_ibfk_1` FOREIGN KEY (`kode_all`) REFERENCES `rbb_tabungan_all` (`kode`),
  ADD CONSTRAINT `rbb_tabungan_ao_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Constraints for table `rbb_tabungan_wil`
--
ALTER TABLE `rbb_tabungan_wil`
  ADD CONSTRAINT `rbb_tabungan_wil_ibfk_1` FOREIGN KEY (`kode_all`) REFERENCES `rbb_tabungan_all` (`kode`);

--
-- Constraints for table `tabungan`
--
ALTER TABLE `tabungan`
  ADD CONSTRAINT `tabungan_ibfk_1` FOREIGN KEY (`id_keg`) REFERENCES `kegiatan_awal` (`kode`);

--
-- Constraints for table `tagihan`
--
ALTER TABLE `tagihan`
  ADD CONSTRAINT `tagihan_ibfk_1` FOREIGN KEY (`id_keg`) REFERENCES `kegiatan_awal` (`kode`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
