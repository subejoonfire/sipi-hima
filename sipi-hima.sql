-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2024 at 12:10 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sipi-hima`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `kdbarang` varchar(50) NOT NULL,
  `idkategori` int(11) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `kondisi_barang` varchar(50) NOT NULL,
  `foto_barang` varchar(50) NOT NULL,
  `tgl_masuk` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`kdbarang`, `idkategori`, `nama_barang`, `kondisi_barang`, `foto_barang`, `tgl_masuk`) VALUES
('EL_KOM_2024_001', 1, 'Komputer', 'Baik', '1720135842_bb4ea62aa520543b49d0.jpg', '2024-06-10'),
('EL_KOM_2024_002', 1, 'Komputer', 'Rusak Ringan', '1720136213_8179f3e88bcf49029f38.jpg', '2024-06-27'),
('EL_KOM_2024_003', 1, 'Komputer', 'Baik', '1720136312_60cc8f55ecbbfe6a8a39.jpg', '2024-07-02'),
('EL_PRI_2024_001', 1, 'Printer', 'Baik', '1721003256_ba4a49b50ce02a9e6bfd.png', '2024-07-15'),
('EL_SPE_2024_001', 1, 'Spekaer', 'Baik', '1721116522_8f2c7d6c348be1abfcdd.jpg', '2024-07-16'),
('FU_KURBES_2024_001', 2, 'Kursi Besi', 'Baik', '1721003070_b14b9c0e88198a80af56.jpg', '2024-07-15'),
('FU_KURBES_2024_002', 2, 'Kursi Besi', 'Rusak Berat', '1721003317_7762845a25cf01f049f0.jpg', '2024-07-15'),
('FU_MEJ_2024_001', 2, 'Meja', 'Baik', '1720136331_9f719c4104e07d244a02.jpg', '2024-06-27'),
('FU_MEJ_2024_002', 2, 'Meja', 'Baik', '1720136354_89c9a6d57638323076ee.jpg', '2024-06-27'),
('FU_MEJ_2024_003', 2, 'Meja', 'Baik', '1720136371_88697334c945ffd9a691.jpg', '2024-07-02');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `idkategori` int(11) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`idkategori`, `nama_kategori`, `deskripsi`) VALUES
(1, 'Elektronik', 'Komputer, Laptop, proyektor, printer, scanner, dan tablet untuk kegiatan akademis dan organisasi.'),
(2, 'Furniture', 'Meja kerja, kursi, lemari penyimpanan, rak buku, dan papan tulis.');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `idpelanggan` varchar(20) NOT NULL,
  `nama_pelanggan` varchar(50) NOT NULL,
  `no_kontak` varchar(20) NOT NULL,
  `delegasi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`idpelanggan`, `nama_pelanggan`, `no_kontak`, `delegasi`) VALUES
('198402022019032010', 'Winda Aprianti, M.Si', '08220134901', 'PRODI TI'),
('2201301000', 'Rusdi', '082382139318', 'BEM'),
('2201301001', 'Arta', '0851237487', 'HIMA-TI'),
('2201301005', 'Fatih', '085251192872', 'HIMA-TI'),
('2201301170', 'Serli', '085531213202', 'BISEPOL');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` int(11) NOT NULL,
  `kdbarang` varchar(25) NOT NULL,
  `idpelanggan` varchar(20) NOT NULL,
  `tanggal_peminjaman` date NOT NULL,
  `tanggal_pengembalian` date NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjaman`, `kdbarang`, `idpelanggan`, `tanggal_peminjaman`, `tanggal_pengembalian`, `status`) VALUES
(1, 'EL_KOM_2024_001', '2201301001', '2024-07-01', '2024-07-01', 'Diproses'),
(3, 'EL_PRI_2024_001', '198402022019032010', '2024-07-15', '2024-07-29', 'Selesai');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `iduser` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `level` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`iduser`, `username`, `password`, `nama`, `level`) VALUES
(1, 'admin', 'admin123', 'arta', 'admin'),
(3, 'fatih', '12345', 'Fatih', 'petugas');

-- --------------------------------------------------------

--
-- Table structure for table `penitipan`
--

CREATE TABLE `penitipan` (
  `id_penitipan` int(11) NOT NULL,
  `nama_barang` text NOT NULL,
  `jumlah_barang` text NOT NULL,
  `deskripsi` text NOT NULL,
  `tgl_titip` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  `idpelanggan` varchar(50) DEFAULT NULL,
  `status` varchar(50) NOT NULL,
  `foto_titip` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penitipan`
--

INSERT INTO `penitipan` (`id_penitipan`, `nama_barang`, `jumlah_barang`, `deskripsi`, `tgl_titip`, `tgl_kembali`, `idpelanggan`, `status`, `foto_titip`) VALUES
(5, 'Proyektor', '2', 'dititipkan dengan tas proyektor', '2024-07-15', '2024-07-31', '198402022019032010', 'selesai', '1721003933_9ef4cb48ba680e04f612.jpg'),
(6, 'Konsumsi', '30', 'terdapat 30 kotak konsumsi', '2024-07-15', '2024-07-22', '2201301000', 'belum selesai', '1721004094_ecda1a1caf24df88884d.jpg'),
(7, 'Sertifikat Kegiatan', '40', 'terdapat 40 lembar sertifikat', '2024-07-15', '2024-07-22', '2201301000', 'belum selesai', '1721004280_3af991847c713df69d28.png'),
(8, 'speaker', '1', 'untuk kegiatan family gathering', '2024-07-04', '2024-07-06', '198402022019032010', 'proses', '1722331685_61acab53bb116dca3dbc.png'),
(9, 'sdafadd', '1', 'buku matematika tahun 2022', '2024-07-05', '2024-07-30', '2201301001', 'proses', '1722334073_339334055a15eea74252.png'),
(11, '32', '23', '32', '2024-07-30', '2024-07-30', NULL, 'proses', '1722330052_779b141d86009b49fa5a.png'),
(12, 'sdfa', '32', '32', '2024-07-30', '2024-07-30', NULL, 'proses', '1722330812_db66cda8de12b95194c6.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`kdbarang`),
  ADD KEY `idkategori` (`idkategori`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`idkategori`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`idpelanggan`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`),
  ADD KEY `kdbarang` (`kdbarang`),
  ADD KEY `idpelanggan` (`idpelanggan`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`iduser`);

--
-- Indexes for table `penitipan`
--
ALTER TABLE `penitipan`
  ADD PRIMARY KEY (`id_penitipan`),
  ADD KEY `idpelanggan` (`idpelanggan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `idkategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `penitipan`
--
ALTER TABLE `penitipan`
  MODIFY `id_penitipan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`idkategori`) REFERENCES `kategori` (`idkategori`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`kdbarang`) REFERENCES `barang` (`kdbarang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`idpelanggan`) REFERENCES `pelanggan` (`idpelanggan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penitipan`
--
ALTER TABLE `penitipan`
  ADD CONSTRAINT `penitipan_ibfk_1` FOREIGN KEY (`idpelanggan`) REFERENCES `pelanggan` (`idpelanggan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
