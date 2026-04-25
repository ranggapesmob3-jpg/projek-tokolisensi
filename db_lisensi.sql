-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Apr 24, 2026 at 04:59 PM
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
-- Database: `db_lisensi`
--

-- --------------------------------------------------------

--
-- Table structure for table `lisensi`
--

CREATE TABLE `lisensi` (
  `id` int(11) NOT NULL,
  `produk_id` int(11) DEFAULT NULL,
  `kode` varchar(100) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'tersedia'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lisensi`
--

INSERT INTO `lisensi` (`id`, `produk_id`, `kode`, `status`) VALUES
(1, 1, 'WIN11-AAA1', 'terjual'),
(2, 1, 'WIN11-AAA2', 'terjual'),
(3, 2, 'PS-1111', 'tersedia'),
(4, 2, 'PS-2222', 'tersedia'),
(5, 3, 'OFF-1234', 'tersedia'),
(6, 4, 'ANTIV-888', 'tersedia'),
(7, 5, 'STEAM-50K', 'tersedia'),
(8, 6, 'VPN-777', 'terjual');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `nama`, `harga`) VALUES
(1, 'Windows 11 Pro', 150000),
(2, 'Adobe Photoshop', 120000),
(3, 'Microsoft Office', 100000),
(4, 'Antivirus', 80000),
(5, 'Steam Wallet', 50000),
(6, 'VPN', 70000);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `no_telp` varchar(20) DEFAULT NULL,
  `produk_id` int(11) DEFAULT NULL,
  `lisensi_id` int(11) DEFAULT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `nama`, `email`, `no_telp`, `produk_id`, `lisensi_id`, `tanggal`) VALUES
(1, 'rangga', 'ranggapesmob3@gmail.com', '082939287873', 1, 2, '2026-04-24 14:54:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lisensi`
--
ALTER TABLE `lisensi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lisensi`
--
ALTER TABLE `lisensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
