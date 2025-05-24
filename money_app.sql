-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 24 Bulan Mei 2025 pada 12.16
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
(1, 'print', 500000, NULL),
(2, 'lampu', 200000, 9);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int NOT NULL,
  `tanggal` date NOT NULL,
  `nominal` int NOT NULL,
  `kategori` varchar(100) DEFAULT NULL,
  `user_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
(1, 2000, '2025-05-18', 'elektronik', '', NULL),
(2, 1000000, '2025-05-18', 'elektronik', NULL, NULL),
(3, 100000, '2025-05-18', 'aksesoris', '', NULL),
(4, 10000, '2025-05-22', 'pakaian', 'celana', NULL),
(5, 20000, '2025-05-22', 'makanan', 'seblak', NULL),
(6, 301000, '2025-05-22', 'print', 'makalah', NULL),
(7, 201000, '2025-05-24', 'lampu', 'kos', NULL);

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
(1, 1000000, '2025-05-18', 'Pakaian', '', NULL),
(2, 100000, '2025-05-18', 'Pakaian', '', NULL),
(3, 1000, '2025-05-18', 'Elektronik', '', NULL),
(4, 1000, '2025-05-18', 'Makanan', '', NULL),
(5, 12000, '2025-05-18', 'Makanan', '', NULL),
(6, 10000000, '2025-05-19', 'pakaian', NULL, NULL),
(7, 100000, '2025-05-18', 'elektronik', '', NULL),
(8, 100000, '2025-05-18', 'aksesoris', '', NULL),
(9, 2000, '2025-05-22', 'aksesoris', 'jajan', NULL),
(10, 4000, '2025-05-22', 'aksesoris', 'hidup', NULL),
(11, 201000, '2025-05-24', 'lampu', 'kos', NULL),
(12, 201000, '2025-05-24', 'lampu', 'kos', NULL),
(13, 10000, '2025-05-24', 'Pakaian', '', NULL),
(14, 1000000, '2025-05-24', 'Elektronik', '', NULL);

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
  `reset_token` varchar(255) DEFAULT NULL,
  `reset_token_expire` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `nama`, `email`, `password`, `phone`, `foto`, `created_at`, `role`, `reset_token`, `reset_token_expire`, `updated_at`) VALUES
(1, 'najma', '', '', NULL, 'uploads/default.png', '2025-05-18 07:47:22', 'user', NULL, NULL, '2025-05-24 04:10:01'),
(3, 'najma', 'naj@gmail.com', '$2y$10$VzTIwchmxkEykgTg.mu2R.9aMUwPtPUCFRr0jgns4danyXk9aqmia', '081233333332', 'uploads/default.png', '2025-05-22 01:41:03', 'user', NULL, NULL, NULL),
(4, 'riz', 'rur@gmail.com', '$2y$10$Twm9JAf5mFjVrlXdlg2lMOZyxqeokvIEc4eHrUKolKml/peLPmh3y', '081233333334', 'uploads/default.png', '2025-05-22 12:06:32', 'user', '03562148f60371c7a5bcf952040ee071bda19da7863353583f4e3bf8c7fb7b17030b4bedd23ade602b6e0965de21538caa64', '2025-05-23 06:02:43', '2025-05-23 12:21:53'),
(6, 'najma', 'ra@gmail.com', '$2y$10$tn5KuI2qOyFMl3Y1GOnMseXp8WNvTd1ASkzZfsa45lrP2g8vKIPtm', '081233333331', 'uploads/default.png', '2025-05-23 12:28:43', 'user', NULL, NULL, NULL),
(7, 'roar', 'roar@gmail.com', '$2y$10$kkxP23IvFm0oui/z19c45ezzUILmJYBNKgvD8.kOFlPkym2MYqQIq', '081233333336', 'uploads/default.png', '2025-05-23 23:37:15', 'user', NULL, NULL, NULL),
(8, 're', 're@gmail.com', '$2y$10$YJSMnMc2KdA5VqtneNiz0.rxmlJjoJjVO9QmH9GtLENWKqNuvk6gO', '081233333335', 'uploads/default.png', '2025-05-23 23:59:52', 'user', NULL, NULL, NULL),
(9, 'amel', 'amel@gmail.com', '$2y$10$oZ.ugtYFGiqqChrnDNUeY.KFMCm4Ms0Ks3vWuLttDcNLs9K8KcZ3y', '081233333338', 'uploads/133874784200758171.jpg', '2025-05-24 00:10:42', 'user', NULL, NULL, '2025-05-24 05:08:00'),
(10, 'riz', 'riz@gmail.com', '$2y$10$IrWRZZcHZc2IPrG8.wB./.SUJ5SdKZahFZiiLN7OFshZdYr4Z7Fsu', '081233333339', 'uploads/default.png', '2025-05-24 11:43:52', 'user', NULL, NULL, NULL);

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
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kategori_batas`
--
ALTER TABLE `kategori_batas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `uang_keluar`
--
ALTER TABLE `uang_keluar`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `uang_masuk`
--
ALTER TABLE `uang_masuk`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
