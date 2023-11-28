-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 28, 2023 at 08:54 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tokokopi`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id_cart` int NOT NULL,
  `id_user` int NOT NULL,
  `id_produk` int NOT NULL,
  `qty_cart` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id_detail` int NOT NULL,
  `id_transaksi` int NOT NULL,
  `id_produk` int NOT NULL,
  `qty_transaksi` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id_detail`, `id_transaksi`, `id_produk`, `qty_transaksi`) VALUES
(26, 15, 8, 2),
(27, 15, 12, 1),
(28, 16, 11, 2),
(29, 16, 10, 3),
(30, 17, 9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `jenis` varchar(50) NOT NULL,
  `harga_produk` int NOT NULL,
  `qty_produk` int NOT NULL,
  `gambar_produk` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `jenis`, `harga_produk`, `qty_produk`, `gambar_produk`) VALUES
(7, 'Cappuccino', 'Minuman', 15000, 50, 'capucino.jpg'),
(8, 'Ice Coffee Milk', 'Minuman', 18000, 48, 'icecoffemilk.jpg'),
(9, 'Coffee Latte', 'Minuman', 20000, 49, 'kopilatte.jpg'),
(10, 'Banana Chocolate', 'Makanan', 23000, 47, 'bananachocolate.jpg'),
(11, 'Beef Burger With Egg', 'Makanan', 25000, 48, 'burger.jpg'),
(12, 'Nasi Goreng Spicy', 'Makanan', 25000, 49, 'nasigoreng.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int NOT NULL,
  `id_pesanan` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `id_user` int NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `total_transaksi` int NOT NULL,
  `bukti_bayar` varchar(50) NOT NULL,
  `no_meja` varchar(20) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_pesanan`, `id_user`, `tanggal_transaksi`, `total_transaksi`, `bukti_bayar`, `no_meja`, `status`) VALUES
(15, 'NRJ1701060692', 7, '2023-11-27', 61000, 'AND.jpg', 'A1', 'Sedang Diproses'),
(16, 'NRJ1701061283', 7, '2023-11-27', 119000, 'Andstronout safe flight.jpg', 'A1', 'Selesai Diproses'),
(17, 'NRJ1701061382', 7, '2023-11-27', 20000, 'AH.jpg', 'B3', 'Selesai Diproses');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int NOT NULL,
  `nama_user` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nomor_hp` varchar(20) NOT NULL,
  `level` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `email`, `password`, `nomor_hp`, `level`) VALUES
(1, 'Admin', 'admin@kopi.com', '7815696ecbf1c96e6894b779456d330e', '123123', 2),
(2, 'User', 'user@kopi.com', '7815696ecbf1c96e6894b779456d330e', '123123', 1),
(4, 'Owner', 'owner@kopi.com', '7815696ecbf1c96e6894b779456d330e', '123123', 3),
(7, 'EGI NURHAKIM', 'egi@kopi.com', '7815696ecbf1c96e6894b779456d330e', '12312000', 1),
(8, 'asd', 'asd@asd.com', '7815696ecbf1c96e6894b779456d330e', '089630754729', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id_cart`);

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id_cart` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id_detail` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
