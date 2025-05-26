-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 26 Bulan Mei 2025 pada 01.31
-- Versi server: 8.0.30
-- Versi PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `money_app`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `batas_pengeluaran`
--

CREATE TABLE `batas_pengeluaran` (
  `id` int NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `batas` int NOT NULL,
  `user_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `batas_pengeluaran`
--

INSERT INTO `batas_pengeluaran` (`id`, `kategori`, `batas`, `user_id`) VALUES
(1, 'elektronik', 1000000, 1),
(2, 'makanan', 15000, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_batas`
--

CREATE TABLE `kategori_batas` (
  `id` int NOT NULL,
  `nama_kategori` varchar(100) NOT NULL,
  `batas` int NOT NULL,
  `user_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `kategori_batas`
--

INSERT INTO `kategori_batas` (`id`, `nama_kategori`, `batas`, `user_id`) VALUES
(1, 'print', 500000, 1),
(2, 'lampu', 1300000, 1),
(3, 'air', 700000, 1),
(4, 'token', 800000, 1),
(5, 'hp', 300000, 1),
(6, 'laptop', 3000000, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `uang_keluar`
--

CREATE TABLE `uang_keluar` (
  `id` int NOT NULL,
  `nominal` int DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `kategori` varchar(50) DEFAULT NULL,
  `keterangan` text,
  `user_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `uang_keluar`
--

INSERT INTO `uang_keluar` (`id`, `nominal`, `tanggal`, `kategori`, `keterangan`, `user_id`) VALUES
(1, 2000, '2025-05-18', 'elektronik', '', 1),
(2, 1000000, '2025-05-18', 'elektronik', NULL, 1),
(3, 100000, '2025-05-18', 'aksesoris', '', 1),
(4, 10000, '2025-05-22', 'pakaian', 'celana', 1),
(5, 20000, '2025-05-22', 'makanan', 'seblak', 1),
(6, 301000, '2025-05-22', 'print', 'makalah', 1),
(7, 201000, '2025-05-24', 'lampu', 'kos', 1),
(8, 1000000, '2025-05-26', 'lampu', '', 1),
(9, 210000, '2025-05-26', 'hp', '', 1),
(10, 2300000, '2025-05-26', 'laptop', '', 1),
(11, 100000, '2025-05-26', 'elektronik', 'kipas', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `uang_masuk`
--

CREATE TABLE `uang_masuk` (
  `id` int NOT NULL,
  `nominal` int DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `kategori` varchar(50) DEFAULT NULL,
  `keterangan` text,
  `user_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `uang_masuk`
--

INSERT INTO `uang_masuk` (`id`, `nominal`, `tanggal`, `kategori`, `keterangan`, `user_id`) VALUES
(1, 1000000, '2025-05-18', 'Pakaian', '', 1),
(2, 100000, '2025-05-18', 'Pakaian', '', 1),
(3, 1000, '2025-05-18', 'Elektronik', '', 1),
(4, 1000, '2025-05-18', 'Makanan', '', 1),
(5, 12000, '2025-05-18', 'Makanan', '', 1),
(6, 10000000, '2025-05-19', 'pakaian', NULL, 1),
(7, 100000, '2025-05-18', 'elektronik', '', 1),
(8, 100000, '2025-05-18', 'aksesoris', '', 1),
(9, 2000, '2025-05-22', 'aksesoris', 'jajan', 1),
(10, 4000, '2025-05-22', 'aksesoris', 'hidup', 1),
(11, 201000, '2025-05-24', 'lampu', 'kos', 1),
(12, 201000, '2025-05-24', 'lampu', 'kos', 1),
(13, 10000, '2025-05-24', 'Pakaian', '', 1),
(14, 1000000, '2025-05-24', 'Elektronik', '', 1),
(15, 1000000, '2025-05-26', 'Aksesoris', '', 1),
(16, 100000, '2025-05-26', 'Pakaian', '', 1),
(17, 1000000, '2025-05-26', 'Pakaian', 'baju', 1),
(18, 1000000, '2025-05-26', 'lampu', NULL, 1),
(19, 1000000, '2025-05-26', 'lampu', '', 1),
(20, 1000000, '2025-05-26', 'print', '', 1),
(21, 100000, '2025-05-26', 'Elektronik', 'kipas', 1),
(22, 100000, '2025-05-26', 'lampu', '', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `foto` varchar(255) DEFAULT 'uploads/default.png',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `nama`, `email`, `password`, `phone`, `foto`, `created_at`, `role`, `updated_at`) VALUES
(1, 'rizta', 'killa@gmail.com', '$2y$10$RlOm7/LYvw/887Mv1GcqSu69I3TxILGaiRq54xUY8WKXXLakEDUvS', '08123456789', 'uploads/133885707936550459.jpg', '2025-05-18 07:47:22', 'user', '2025-05-25 19:41:30'),
(2, 'Kelompok 2', 'kel2@gmail.com', '$2y$10$eJQIyrkCq99YfHRP0GJdg.9K2x6NTkwEs5HxE/twoFbRe2wtxbVNS', NULL, 'uploads/default.png', '2025-05-25 19:24:45', 'admin', '2025-05-25 21:07:38'),
(3, 'najma', 'amel@gmail.com', '$2y$10$EfnS5ggV/8bpCZHED9JdbunS6ncVlLW3LelXSYJMazbn0MbYQJvuS', '081233333331', 'uploads/default.png', '2025-05-25 20:46:35', 'user', NULL),
(4, 'aqyl n', 'mel@gmail.com', '$2y$10$ruriny0ijxSUMya1oA51.eu0Kp7emuxtXRdriq51IzvJGwY5eGMtu', '081233333336', 'uploads/133874784200758171.jpg', '2025-05-25 21:01:11', 'user', '2025-05-25 21:02:01');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `batas_pengeluaran`
--
ALTER TABLE `batas_pengeluaran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategori_batas`
--
ALTER TABLE `kategori_batas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama_kategori` (`nama_kategori`);

--
-- Indeks untuk tabel `uang_keluar`
--
ALTER TABLE `uang_keluar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `uang_masuk`
--
ALTER TABLE `uang_masuk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `batas_pengeluaran`
--
ALTER TABLE `batas_pengeluaran`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `kategori_batas`
--
ALTER TABLE `kategori_batas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `uang_keluar`
--
ALTER TABLE `uang_keluar`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `uang_masuk`
--
ALTER TABLE `uang_masuk`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
