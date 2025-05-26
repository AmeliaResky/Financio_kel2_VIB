--Membuat database--
CREATE DATABASE money_app;

--Memilih database
USE money_app;

-- Struktur dari tabel `batas_pengeluaran`--
CREATE TABLE `batas_pengeluaran` (
  `id` int NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `batas` int NOT NULL,
  `user_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Struktur dari tabel `kategori_batas`--
CREATE TABLE `kategori_batas` (
  `id` int NOT NULL,
  `nama_kategori` varchar(100) NOT NULL,
  `batas` int NOT NULL,
  `user_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Struktur dari tabel `uang_keluar`--
CREATE TABLE `uang_keluar` (
  `id` int NOT NULL,
  `nominal` int DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `kategori` varchar(50) DEFAULT NULL,
  `keterangan` text,
  `user_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Struktur dari tabel `uang_masuk`--
CREATE TABLE `uang_masuk` (
  `id` int NOT NULL,
  `nominal` int DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `kategori` varchar(50) DEFAULT NULL,
  `keterangan` text,
  `user_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Struktur dari tabel `user`--

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

-- Indeks untuk tabel `batas_pengeluaran`--
ALTER TABLE `batas_pengeluaran`
  ADD PRIMARY KEY (`id`);

-- Indeks untuk tabel `kategori_batas`--
ALTER TABLE `kategori_batas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama_kategori` (`nama_kategori`);

-- Indeks untuk tabel `uang_keluar`--
ALTER TABLE `uang_keluar`
  ADD PRIMARY KEY (`id`);

-- Indeks untuk tabel `uang_masuk`--
ALTER TABLE `uang_masuk`
  ADD PRIMARY KEY (`id`);

-- Indeks untuk tabel `user`--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

-- AUTO_INCREMENT untuk tabel `batas_pengeluaran`--
ALTER TABLE `batas_pengeluaran`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

-- AUTO_INCREMENT untuk tabel `kategori_batas`--
ALTER TABLE `kategori_batas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

-- AUTO_INCREMENT untuk tabel `uang_keluar`--
ALTER TABLE `uang_keluar`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

-- AUTO_INCREMENT untuk tabel `uang_masuk`--
ALTER TABLE `uang_masuk`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

-- AUTO_INCREMENT untuk tabel `user`--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;
