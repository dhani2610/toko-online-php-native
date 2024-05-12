-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Bulan Mei 2024 pada 10.18
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko_online`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pemesanan`
--

CREATE TABLE `detail_pemesanan` (
  `id_detail_pesanan` int(20) NOT NULL,
  `id_pesanan` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama`) VALUES
(6, 'Sepatu Pria'),
(7, 'Sepatu Wanita'),
(8, 'Sepatu Anak-anak');

-- --------------------------------------------------------

--
-- Struktur dari tabel `metode_pembayaran`
--

CREATE TABLE `metode_pembayaran` (
  `metode_pembayaran` int(11) NOT NULL,
  `nama_metode` enum('COD','Transfer Bank') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `id_user`) VALUES
(1, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `tanggal_pesanan` date NOT NULL,
  `status_pemesanan` enum('dalam perjalanan','dikirim','selesai','') NOT NULL,
  `metode_pembayaran` int(11) NOT NULL,
  `total_harga` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `harga` double NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `detail` text DEFAULT NULL,
  `ketersediaan_stok` enum('habis','tersedia') DEFAULT 'tersedia'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `id_kategori`, `nama`, `harga`, `foto`, `detail`, `ketersediaan_stok`) VALUES
(7, 6, 'Naise airmax', 499000, 'LU0zFE9wsuOOGHk0DVgt.png', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis, officia. Reiciendis praesentium nulla quidem officia ipsum pariatur laborum deserunt, dolorem vel laudantium quia quasi perferendis corporis accusantium doloremque, vitae est veritatis totam sapiente optio? Tempore odit, quia deleniti error veniam numquam, nobis, architecto itaque mollitia eaque possimus doloremque beatae. Odio ut maiores ab eius cupiditate perferendis nihil adipisci rerum provident itaque. Eum nihil facere, quam doloremque ducimus numquam architecto accusamus eaque neque quis non laborum corporis itaque quibusdam adipisci quaerat voluptatem omnis repellat quos deserunt rerum et accusantium! Aliquid hic sunt error voluptatem nostrum omnis cum recusandae autem veritatis? Nam.\r\n', 'tersedia'),
(8, 6, 'Naise Dunk', 499000, 'qwc44IrsDG2TWqhPcxzW.png', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis, officia. Reiciendis praesentium nulla quidem officia ipsum pariatur laborum deserunt, dolorem vel laudantium quia quasi perferendis corporis accusantium doloremque, vitae est veritatis totam sapiente optio? Tempore odit, quia deleniti error veniam numquam, nobis, architecto itaque mollitia eaque possimus doloremque beatae. Odio ut maiores ab eius cupiditate perferendis nihil adipisci rerum provident itaque. Eum nihil facere, quam doloremque ducimus numquam architecto accusamus eaque neque quis non laborum corporis itaque quibusdam adipisci quaerat voluptatem omnis repellat quos deserunt rerum et accusantium! Aliquid hic sunt error voluptatem nostrum omnis cum recusandae autem veritatis? Nam.', 'tersedia'),
(9, 6, 'Naise Dunk High', 499000, 'TF82BZxfZEks4gURPG64.png', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis, officia. Reiciendis praesentium nulla quidem officia ipsum pariatur laborum deserunt, dolorem vel laudantium quia quasi perferendis corporis accusantium doloremque, vitae est veritatis totam sapiente optio? Tempore odit, quia deleniti error veniam numquam, nobis, architecto itaque mollitia eaque possimus doloremque beatae. Odio ut maiores ab eius cupiditate perferendis nihil adipisci rerum provident itaque. Eum nihil facere, quam doloremque ducimus numquam architecto accusamus eaque neque quis non laborum corporis itaque quibusdam adipisci quaerat voluptatem omnis repellat quos deserunt rerum et accusantium! Aliquid hic sunt error voluptatem nostrum omnis cum recusandae autem veritatis? Nam.', 'tersedia'),
(10, 7, 'Naise airforce', 499000, 'fkSv9hGVFLUie3X4frXr.png', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis, officia. Reiciendis praesentium nulla quidem officia ipsum pariatur laborum deserunt, dolorem vel laudantium quia quasi perferendis corporis accusantium doloremque, vitae est veritatis totam sapiente optio? Tempore odit, quia deleniti error veniam numquam, nobis, architecto itaque mollitia eaque possimus doloremque beatae. Odio ut maiores ab eius cupiditate perferendis nihil adipisci rerum provident itaque. Eum nihil facere, quam doloremque ducimus numquam architecto accusamus eaque neque quis non laborum corporis itaque quibusdam adipisci quaerat voluptatem omnis repellat quos deserunt rerum et accusantium! Aliquid hic sunt error voluptatem nostrum omnis cum recusandae autem veritatis? Nam.', 'tersedia'),
(11, 7, 'Naise DunkLow', 499000, 'w4t3Q0lPYebgiyLemYmO.png', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis, officia. Reiciendis praesentium nulla quidem officia ipsum pariatur laborum deserunt, dolorem vel laudantium quia quasi perferendis corporis accusantium doloremque, vitae est veritatis totam sapiente optio? Tempore odit, quia deleniti error veniam numquam, nobis, architecto itaque mollitia eaque possimus doloremque beatae. Odio ut maiores ab eius cupiditate perferendis nihil adipisci rerum provident itaque. Eum nihil facere, quam doloremque ducimus numquam architecto accusamus eaque neque quis non laborum corporis itaque quibusdam adipisci quaerat voluptatem omnis repellat quos deserunt rerum et accusantium! Aliquid hic sunt error voluptatem nostrum omnis cum recusandae autem veritatis? Nam.', 'tersedia'),
(12, 7, 'Naise Jordan', 499000, 'a1Rw5Z4X7e6Qzv5A1vso.png', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis, officia. Reiciendis praesentium nulla quidem officia ipsum pariatur laborum deserunt, dolorem vel laudantium quia quasi perferendis corporis accusantium doloremque, vitae est veritatis totam sapiente optio? Tempore odit, quia deleniti error veniam numquam, nobis, architecto itaque mollitia eaque possimus doloremque beatae. Odio ut maiores ab eius cupiditate perferendis nihil adipisci rerum provident itaque. Eum nihil facere, quam doloremque ducimus numquam architecto accusamus eaque neque quis non laborum corporis itaque quibusdam adipisci quaerat voluptatem omnis repellat quos deserunt rerum et accusantium! Aliquid hic sunt error voluptatem nostrum omnis cum recusandae autem veritatis? Nam.', 'tersedia'),
(13, 8, 'Naise Jordan23', 499000, '26GUKmf5hj6muHrqkQyo.png', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis, officia. Reiciendis praesentium nulla quidem officia ipsum pariatur laborum deserunt, dolorem vel laudantium quia quasi perferendis corporis accusantium doloremque, vitae est veritatis totam sapiente optio? Tempore odit, quia deleniti error veniam numquam, nobis, architecto itaque mollitia eaque possimus doloremque beatae. Odio ut maiores ab eius cupiditate perferendis nihil adipisci rerum provident itaque. Eum nihil facere, quam doloremque ducimus numquam architecto accusamus eaque neque quis non laborum corporis itaque quibusdam adipisci quaerat voluptatem omnis repellat quos deserunt rerum et accusantium! Aliquid hic sunt error voluptatem nostrum omnis cum recusandae autem veritatis? Nam.', 'tersedia'),
(14, 8, 'Naise Blazer', 499000, '3pqXCBAGgfV2ThJPioUH.png', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis, officia. Reiciendis praesentium nulla quidem officia ipsum pariatur laborum deserunt, dolorem vel laudantium quia quasi perferendis corporis accusantium doloremque, vitae est veritatis totam sapiente optio? Tempore odit, quia deleniti error veniam numquam, nobis, architecto itaque mollitia eaque possimus doloremque beatae. Odio ut maiores ab eius cupiditate perferendis nihil adipisci rerum provident itaque. Eum nihil facere, quam doloremque ducimus numquam architecto accusamus eaque neque quis non laborum corporis itaque quibusdam adipisci quaerat voluptatem omnis repellat quos deserunt rerum et accusantium! Aliquid hic sunt error voluptatem nostrum omnis cum recusandae autem veritatis? Nam.', 'tersedia'),
(15, 8, 'Naise Jordankids', 499000, 'NMTEh4p1dLqClBoE89K3.png', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis, officia. Reiciendis praesentium nulla quidem officia ipsum pariatur laborum deserunt, dolorem vel laudantium quia quasi perferendis corporis accusantium doloremque, vitae est veritatis totam sapiente optio? Tempore odit, quia deleniti error veniam numquam, nobis, architecto itaque mollitia eaque possimus doloremque beatae. Odio ut maiores ab eius cupiditate perferendis nihil adipisci rerum provident itaque. Eum nihil facere, quam doloremque ducimus numquam architecto accusamus eaque neque quis non laborum corporis itaque quibusdam adipisci quaerat voluptatem omnis repellat quos deserunt rerum et accusantium! Aliquid hic sunt error voluptatem nostrum omnis cum recusandae autem veritatis? Nam.', 'tersedia');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE `role` (
  `id_role` int(11) NOT NULL,
  `nama_role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `role`
--

INSERT INTO `role` (`id_role`, `nama_role`) VALUES
(1, 'admin'),
(2, 'customer');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `id_role`, `username`, `password`) VALUES
(1, 1, 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(2, 2, 'customer', '91ec1f9324753048c0096d036a694f86');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detail_pemesanan`
--
ALTER TABLE `detail_pemesanan`
  ADD PRIMARY KEY (`id_detail_pesanan`),
  ADD KEY `id_pesanan` (`id_pesanan`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `metode_pembayaran`
--
ALTER TABLE `metode_pembayaran`
  ADD PRIMARY KEY (`metode_pembayaran`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indeks untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD KEY `metode_pembayaran` (`metode_pembayaran`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `nama` (`nama`(191)),
  ADD KEY `kategori_produk` (`id_kategori`);

--
-- Indeks untuk tabel `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_role` (`id_role`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail_pemesanan`
--
ALTER TABLE `detail_pemesanan`
  MODIFY `id_detail_pesanan` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `metode_pembayaran`
--
ALTER TABLE `metode_pembayaran`
  MODIFY `metode_pembayaran` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_pemesanan`
--
ALTER TABLE `detail_pemesanan`
  ADD CONSTRAINT `detail_pemesanan_ibfk_1` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`) ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_pemesanan_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`id_pesanan`) REFERENCES `pelanggan` (`id_pelanggan`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pesanan_ibfk_2` FOREIGN KEY (`metode_pembayaran`) REFERENCES `metode_pembayaran` (`metode_pembayaran`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `kategori_produk` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`);

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
