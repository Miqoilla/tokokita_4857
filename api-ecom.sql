-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Jul 2024 pada 16.23
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `api-ecom`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `harga` decimal(15,2) NOT NULL,
  `stok` int(11) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id`, `nama_barang`, `deskripsi`, `harga`, `stok`, `gambar`, `created_at`) VALUES
(1, 'Nike Air Jordan 1 Zoom CMFT 2', 'Premium suede and Jordan Brand\'s signature Formula 23 foam come together to give you an extra luxurious (and extra cosy) AJ1. You don\'t need to play \"either or\" when it comes to choosing style or comfort with this one—which is nice, \'cause you deserve both.', 2.25, 50, 'Screenshot_2024-07-14_181350.png', '2024-07-14 03:00:00'),
(2, 'Adidas Yeezy Boost 350', 'Sepatu casual dengan teknologi Boost.', 220.00, 30, 'Converst1.jpg', '2024-07-14 03:00:00'),
(3, 'Converse Chuck Taylor All Star', 'Sepatu kanvas dengan desain klasik.', 60.00, 100, 'Screenshot_2024-07-14_181514.png', '2024-07-14 03:00:00'),
(4, 'Vans Old Skool', 'Sepatu skate dengan motif sidestripe.', 70.00, 80, 'Screenshot_2024-07-14_181528.png', '2024-07-14 03:00:00'),
(5, 'Puma Suede Classic', 'Sepatu casual dengan bahan suede.', 80.00, 60, 'Screenshot_2024-07-14_181841.png', '2024-07-14 03:00:00'),
(6, 'New Balance 574', 'Sepatu lari dengan teknologi ENCAP.', 90.00, 40, 'Screenshot_2024-07-14_181831.png', '2024-07-14 03:00:00'),
(7, 'Reebok Classic Leather', 'Sepatu retro dengan bahan kulit.', 75.00, 70, 'Screenshot_2024-07-14_181952.png', '2024-07-14 03:00:00'),
(8, 'Under Armour HOVR Phantom', 'Sepatu lari dengan teknologi HOVR.', 140.00, 45, 'Screenshot_2024-07-14_181720.png', '2024-07-14 03:00:00'),
(9, 'Asics Gel-Kayano 27', 'Sepatu lari dengan teknologi FlyteFoam.', 160.00, 25, 'Screenshot_2024-07-14_181707.png', '2024-07-14 03:00:00'),
(11, 'CHUCK 70 (Converst)', 'Di tahun 1970, Chuck Taylor All Star berubah menjadi salah satu sneakers basket terbaik yang pernah ada. Chuck 70 merayakan warisan tersebut dengan menyatukan detail yang berasal dari arsip-arsip dengan pembaharuan modern. Bantalan insole Ortholite dan jahitan lidah bersayap menjadikan kenyamanan jauh lebih baik lagi. Midsole egret glossy dan patch bintang pergelangan kaki yang khas menguarkan gaya vintage dan ikonik dari sepatu ini. Terbaharui dalam warna-warna arsip pada kanvas premium.', 15000.00, 70, 'da614c881523b1f31c4cb7d6a11752cb.jpg', '2024-07-14 10:20:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `order`
--

CREATE TABLE `order` (
  `id` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `status` varchar(255) NOT NULL,
  `jumlah_harga` int(11) NOT NULL,
  `bukti_bayar` varchar(255) DEFAULT NULL,
  `catatan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_detail`
--

CREATE TABLE `order_detail` (
  `id` bigint(20) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `username`, `password`, `created_at`) VALUES
(1, 'Sulthan', 'linlol674@gmail.com', 'admin', '$2y$10$XQZvZbT.ekvSj3hQ8LvnfOSz.f9JTcI3k/DsdgnGK2jFzs2rmNHBm', '2024-07-13 14:15:59'),
(2, 'Justin albert', 'justin@gmail.com', 'Justin', '$2y$10$tar/mjihpY7rxA8T52zU4umu66Z2kVKs1JLrezqAdXKVf6/lvA34i', '2024-07-13 14:18:27'),
(3, 'denur', 'denur@gmail.com', 'Kakadenn', '$2y$10$J3CS63oHheBNz8z.V2xwS.S2Ry2m9vB6YErNKNZcs4cheQlptYUDO', '2024-07-14 12:44:06');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `order`
--
ALTER TABLE `order`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
