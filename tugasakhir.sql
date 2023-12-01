-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2023 at 11:13 AM
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
-- Database: `tugasakhir`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID_Admin` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID_Admin`, `nama`, `username`, `password`, `no_telp`, `alamat`) VALUES
(1, 'John Doe', 'john_doe', '123', '123456789', 'Jl. Contoh No. 123');

-- --------------------------------------------------------

--
-- Table structure for table `baju`
--

CREATE TABLE `baju` (
  `ID_Baju` int(11) NOT NULL,
  `nama_baju` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `baju`
--

INSERT INTO `baju` (`ID_Baju`, `nama_baju`, `harga`, `stok`, `created_at`, `deleted_at`) VALUES
(3, 'Kemeja Putih', 50000, 12, '2023-11-30 01:58:27', NULL),
(4, 'Celana Jeans', 75000, 15, '2023-11-30 01:58:27', NULL),
(5, 'Sweater Rajut', 100000, 10, '2023-11-30 01:58:27', NULL),
(6, 'Sepatu Sneakers', 120000, 25, '2023-11-30 01:58:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `ID_Pelanggan` int(11) NOT NULL,
  `Nama` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`ID_Pelanggan`, `Nama`, `username`, `password`, `no_telp`, `alamat`, `created_at`, `deleted_at`) VALUES
(1, 'John Doe', 'john_doe', '123', '123456789', '123 Main St', '2023-01-01 03:00:00', NULL),
(2, 'Jane Smith', 'jane_smith', '456', '987654321', '456 Oak St', '2023-01-02 05:30:00', NULL),
(3, 'Bob Johnson', 'bob_johnson', 'password789', '456789012', '789 Maple St', '2023-01-03 01:15:00', NULL),
(4, 'yosia', 'john_doe123', '1234', '82271507532', 'Jl. Contoh No. 123', '2023-11-30 23:06:30', NULL),
(5, 'yosia', 'yosia123', '1234', '0888888888', 'Jl. Contoh No. 123', '2023-12-01 06:07:47', NULL),
(6, 'yosia12345', 'john_doe1234', '123', '0888888888', 'Jl. Contoh No. 123', '2023-12-01 10:02:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `ID_Transaksi` int(11) NOT NULL,
  `ID_Pelanggan` int(11) DEFAULT NULL,
  `ID_Baju` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `total_harga` decimal(10,2) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `metode_pembayaran` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`ID_Transaksi`, `ID_Pelanggan`, `ID_Baju`, `tanggal`, `jumlah`, `total_harga`, `alamat`, `metode_pembayaran`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 1, 3, '2023-12-01', 1, 50000.00, 'Jl. Contoh No. 123', 'BRI', 'proses', '2023-11-30 22:08:27', '2023-12-01 10:07:30', '2023-12-01 10:07:30'),
(7, 1, 3, '2023-12-01', 1, 50000.00, 'Jl. Contoh No. 123', 'BRI', 'proses', '2023-11-30 22:28:07', '2023-12-01 10:07:30', '2023-12-01 10:07:30'),
(8, 2, 3, '2023-12-01', 1, 50000.00, 'Jl. Contoh No. 123', 'BRI', 'tiba', '2023-11-30 22:39:25', '2023-12-01 09:45:15', NULL),
(9, 6, 3, '2023-12-01', 2, 100000.00, 'Jl. Contoh No. 123', 'BRI', 'proses', '2023-12-01 03:03:35', '2023-12-01 10:04:05', '2023-12-01 10:04:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID_Admin`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `baju`
--
ALTER TABLE `baju`
  ADD PRIMARY KEY (`ID_Baju`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`ID_Pelanggan`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`ID_Transaksi`),
  ADD KEY `ID_Pelanggan` (`ID_Pelanggan`),
  ADD KEY `ID_Baju` (`ID_Baju`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `baju`
--
ALTER TABLE `baju`
  MODIFY `ID_Baju` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `ID_Pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `ID_Transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`ID_Pelanggan`) REFERENCES `pelanggan` (`ID_Pelanggan`),
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`ID_Baju`) REFERENCES `baju` (`ID_Baju`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
