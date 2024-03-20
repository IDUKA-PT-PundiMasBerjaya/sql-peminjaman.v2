-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2024 at 03:56 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL,
  `judul` varchar(100) DEFAULT NULL,
  `penulis` varchar(100) DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `gambar` varchar(100) DEFAULT NULL,
  `matapelajaran_idpelajaran` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `judul`, `penulis`, `keterangan`, `stok`, `gambar`, `matapelajaran_idpelajaran`) VALUES
(1, 'Bermain dengan Internet Of Things & Big Data', 'Dhoto', 'Pembahasan tentang Internet of Things & Big Data', 52, 'bermain dengan iot & big data.jpeg', 1),
(2, 'PDP-1 Manual', 'DEC', 'Manual for Digital Equipment Corp (DEC)', 32, 'pdp-1 manual book.jpeg', 2),
(3, 'Macintosh Book References', 'Apple', 'A Book about Macintosh Manual', 29, 'macintosh book references.png', 2),
(4, 'IBM 5150 Guide to Operations', 'IBM', 'A guide book to operate an IBM 5150 Personal Computer', 20, 'IBM_5150_Guide_to_Operations_6322510_1984-04.jpg', 2),
(5, 'IBM 5170 Installation and Setup', 'IBM', 'A guide book on how to Installation in IBM 5170 Personal Computer', 14, 'IBM_5170_Installation_and_Setup_1502491_1984-03.jpg', 2),
(6, 'Micromouse', 'IEEE UCSD', 'A book about micromouse', 29, 'micromouse.jpg', 1),
(7, 'Learning Modern Linux: A Handbook for the Cloud Native Practitioner', 'Michael Hauselblas', 'Everything you need to know about Linux', 24, '81n+DpnxtTL._AC_UF1000,1000_QL80_.jpg', 3);

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `idguru` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`idguru`, `nama`, `alamat`, `email`, `no_hp`) VALUES
(1, 'Pak Wahid', 'Batam', 'muhammadabdulrahmanwahid@gmail.com', '085555'),
(2, 'Pak Andri', 'Batam', 'andrijulius@gmail.com', '081231'),
(3, 'Pak Rihan', 'Batu Besar', 'rihanzahirul@gmail.com', '081112'),
(4, 'Pak Enno', 'Batam', 'enno@gmail.com', '081231312'),
(5, 'Prof. Denif', 'Batam', 'denifgaming123@gmail.com', '1231231');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `namakelas` varchar(100) DEFAULT NULL,
  `kursi` int(11) DEFAULT NULL,
  `meja` int(11) DEFAULT NULL,
  `gambar_kelas` varchar(500) DEFAULT NULL,
  `guru_idguru` int(11) DEFAULT NULL,
  `siswa_idsiswa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `namakelas`, `kursi`, `meja`, `gambar_kelas`, `guru_idguru`, `siswa_idsiswa`) VALUES
(1, 'XI PPLG 1', 37, 37, 'gambar kelas 1.jpg', 5, 6),
(2, 'XI PPLG 2', 38, 38, 'gambar kelas 2.jpeg', 2, 5),
(3, 'XI PPLG 3', 39, 39, 'gambar kelas 3.jpg', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `matapelajaran`
--

CREATE TABLE `matapelajaran` (
  `idpelajaran` int(11) NOT NULL,
  `namapelajaran` varchar(100) DEFAULT NULL,
  `guru_idguru` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `matapelajaran`
--

INSERT INTO `matapelajaran` (`idpelajaran`, `namapelajaran`, `guru_idguru`) VALUES
(1, 'Robotika', 1),
(2, 'Mikrotik', 2),
(3, 'Informatika', 4),
(4, '3D Desainer', 5);

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` int(11) NOT NULL,
  `tanggal_pinjam` date DEFAULT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `guru_idguru` int(11) DEFAULT NULL,
  `siswa_idsiswa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjaman`, `tanggal_pinjam`, `tanggal_kembali`, `guru_idguru`, `siswa_idsiswa`) VALUES
(1, '2024-03-01', '2024-03-03', 1, NULL),
(2, '2024-03-01', '2024-03-08', NULL, 4),
(3, '2024-03-01', '2024-03-05', 4, NULL),
(4, '2024-03-01', '2024-03-14', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman_buku`
--

CREATE TABLE `peminjaman_buku` (
  `id_peminjaman` int(11) NOT NULL,
  `jumlah_buku` int(11) DEFAULT NULL,
  `buku_id_buku` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `peminjaman_buku`
--

INSERT INTO `peminjaman_buku` (`id_peminjaman`, `jumlah_buku`, `buku_id_buku`) VALUES
(1, 1, 1),
(2, 2, 2),
(2, 2, 3),
(3, 1, 1),
(3, 1, 2),
(3, 1, 3),
(4, 1, 6),
(4, 2, 7);

--
-- Triggers `peminjaman_buku`
--
DELIMITER $$
CREATE TRIGGER `peminjaman` AFTER INSERT ON `peminjaman_buku` FOR EACH ROW BEGIN
	UPDATE buku SET stok = stok - NEW.jumlah_buku
    WHERE id_buku = NEW.buku_id_buku;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `pengembalian_buku`
--

CREATE TABLE `pengembalian_buku` (
  `id_pengembalian` int(11) NOT NULL,
  `jumlah_buku` int(11) DEFAULT NULL,
  `tanggal_pengembalian` date DEFAULT NULL,
  `buku_id_buku` int(11) NOT NULL,
  `peminjaman_id_peminjaman` int(11) NOT NULL,
  `denda` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengembalian_buku`
--

INSERT INTO `pengembalian_buku` (`id_pengembalian`, `jumlah_buku`, `tanggal_pengembalian`, `buku_id_buku`, `peminjaman_id_peminjaman`, `denda`) VALUES
(1, 1, '2024-03-20', 1, 1, 0),
(2, 1, '2024-03-20', 2, 2, 0),
(2, 1, '2024-03-20', 4, 2, 0),
(3, 1, '2024-03-20', 3, 3, 15000),
(3, 1, '2024-03-20', 5, 3, 15000),
(3, 1, '2024-03-20', 7, 3, 15000);

--
-- Triggers `pengembalian_buku`
--
DELIMITER $$
CREATE TRIGGER `pengembalian` AFTER INSERT ON `pengembalian_buku` FOR EACH ROW BEGIN
	UPDATE buku SET stok = stok + NEW.jumlah_buku
	WHERE id_buku = NEW.buku_id_buku;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `idsiswa` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `users_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`idsiswa`, `nama`, `alamat`, `email`, `no_hp`, `users_id`) VALUES
(1, 'Alief ', 'Batam', 'monb04973@gmail.com', '085264562334', 1),
(2, 'Enno ', 'Batam', 'rivetchan@gmail.com', '085162538471', 2),
(3, 'Denif', 'Batam', 'denifgaming123@gmail.com', '085554', 4),
(4, 'Hamza', 'Atlantis', 'hamza@gmail.com', '0812341', 3),
(5, 'Arfi', 'Batam', 'arfi@gmail.com', '0814234', 5),
(6, 'Danudenta', 'Batam', 'danu@gmail.com', '0123128', 6);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'miko', '123'),
(2, 'Rivet', '123'),
(3, 'ryuu', '123'),
(4, 'kaze', '123'),
(5, 'kanaeru', '123'),
(6, 'sunwokong', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD KEY `buku_ibfk_1` (`matapelajaran_idpelajaran`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`idguru`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`),
  ADD KEY `guru_idguru` (`guru_idguru`),
  ADD KEY `siswa_idsiswa` (`siswa_idsiswa`);

--
-- Indexes for table `matapelajaran`
--
ALTER TABLE `matapelajaran`
  ADD PRIMARY KEY (`idpelajaran`),
  ADD KEY `matapelajaran_ibfk_1` (`guru_idguru`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`),
  ADD KEY `guru_idguru` (`guru_idguru`),
  ADD KEY `siswa_idsiswa` (`siswa_idsiswa`);

--
-- Indexes for table `peminjaman_buku`
--
ALTER TABLE `peminjaman_buku`
  ADD KEY `buku_id_buku` (`buku_id_buku`);

--
-- Indexes for table `pengembalian_buku`
--
ALTER TABLE `pengembalian_buku`
  ADD KEY `fk_pengembalian_buku_buku1_idx` (`buku_id_buku`),
  ADD KEY `fk_pengembalian_buku_peminjaman1_idx` (`peminjaman_id_peminjaman`),
  ADD KEY `idx_id_pengembalian` (`id_pengembalian`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`idsiswa`),
  ADD KEY `users_id` (`users_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_ibfk_1` FOREIGN KEY (`matapelajaran_idpelajaran`) REFERENCES `matapelajaran` (`idpelajaran`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `kelas_ibfk_1` FOREIGN KEY (`guru_idguru`) REFERENCES `guru` (`idguru`),
  ADD CONSTRAINT `kelas_ibfk_2` FOREIGN KEY (`siswa_idsiswa`) REFERENCES `siswa` (`idsiswa`);

--
-- Constraints for table `matapelajaran`
--
ALTER TABLE `matapelajaran`
  ADD CONSTRAINT `matapelajaran_ibfk_1` FOREIGN KEY (`guru_idguru`) REFERENCES `guru` (`idguru`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`guru_idguru`) REFERENCES `guru` (`idguru`),
  ADD CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`siswa_idsiswa`) REFERENCES `siswa` (`idsiswa`);

--
-- Constraints for table `peminjaman_buku`
--
ALTER TABLE `peminjaman_buku`
  ADD CONSTRAINT `peminjaman_buku_ibfk_1` FOREIGN KEY (`buku_id_buku`) REFERENCES `buku` (`id_buku`);

--
-- Constraints for table `pengembalian_buku`
--
ALTER TABLE `pengembalian_buku`
  ADD CONSTRAINT `fk_pengembalian_buku_buku1` FOREIGN KEY (`buku_id_buku`) REFERENCES `buku` (`id_buku`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pengembalian_buku_peminjaman1` FOREIGN KEY (`peminjaman_id_peminjaman`) REFERENCES `peminjaman` (`id_peminjaman`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
