-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Bulan Mei 2022 pada 05.47
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_inventori_pmi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `id_barang_keluar` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) NOT NULL,
  `id_stok` bigint(20) NOT NULL,
  `kode_barang` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `stok_keluar` bigint(20) NOT NULL,
  `tanggal_barang_keluar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `barang_keluar`
--

INSERT INTO `barang_keluar` (`id_barang_keluar`, `id_user`, `id_stok`, `kode_barang`, `stok_keluar`, `tanggal_barang_keluar`) VALUES
(1, 1, 1, 'A001', 5, '2022-05-22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_user`
--

CREATE TABLE `detail_user` (
  `id_detail_user` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `nohp` bigint(20) NOT NULL,
  `alamat` varchar(191) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `detail_user`
--

INSERT INTO `detail_user` (`id_detail_user`, `username`, `nohp`, `alamat`) VALUES
(1, 'admin', 8123456, 'Kota Padang'),
(2, 'pimpinan', 8123456, 'Kota Padang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `connection` text COLLATE utf8_unicode_ci NOT NULL,
  `queue` text COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `histori_stok`
--

CREATE TABLE `histori_stok` (
  `id_histori_stok` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) NOT NULL,
  `kode_barang` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `stok_awal` bigint(20) NOT NULL,
  `stok` bigint(20) NOT NULL,
  `tanggal_input` date NOT NULL,
  `tanggal_expired` date DEFAULT NULL,
  `keterangan` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `histori_stok`
--

INSERT INTO `histori_stok` (`id_histori_stok`, `id_user`, `kode_barang`, `stok_awal`, `stok`, `tanggal_input`, `tanggal_expired`, `keterangan`) VALUES
(1, 1, 'A001', 10, 3, '2022-05-20', '2022-05-21', 'Tambah Data'),
(2, 1, 'A001', 5, 5, '2022-05-21', '2022-05-28', 'Tambah Data'),
(3, 1, 'A001', 10, 10, '2022-05-23', NULL, 'Tambah Data'),
(4, 1, 'A002', 10, 10, '2022-05-23', NULL, 'Tambah Data'),
(5, 1, 'A002', 5, 5, '2022-05-24', NULL, 'Tambah Data');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelola_barang`
--

CREATE TABLE `kelola_barang` (
  `id_kelola_barang` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) NOT NULL,
  `kode_barang` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `nama_barang` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `kelola_barang`
--

INSERT INTO `kelola_barang` (`id_kelola_barang`, `id_user`, `kode_barang`, `nama_barang`) VALUES
(1, 1, 'A001', 'Paracetamol'),
(2, 1, 'A002', 'Antimo');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan`
--

CREATE TABLE `laporan` (
  `id_laporan` bigint(20) UNSIGNED NOT NULL,
  `id_barang_keluar` bigint(20) NOT NULL,
  `id_stok` bigint(20) NOT NULL,
  `id_histori_stok` bigint(20) NOT NULL,
  `kode_barang` varchar(191) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `laporan`
--

INSERT INTO `laporan` (`id_laporan`, `id_barang_keluar`, `id_stok`, `id_histori_stok`, `kode_barang`) VALUES
(1, 1, 1, 1, 'A001');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2021_08_21_062043_create_histori_stok_table', 1),
(4, '2021_08_23_043802_create_laporan_table', 1),
(5, '2022_05_20_065110_create_detail_user_table', 1),
(6, '2022_05_20_070346_create_barang_keluar_table', 1),
(7, '2022_05_20_070736_create_stok_barang_table', 1),
(8, '2022_05_20_071025_create_kelola_barang_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `stok_barang`
--

CREATE TABLE `stok_barang` (
  `id_stok` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) NOT NULL,
  `kode_barang` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `stok` bigint(20) NOT NULL,
  `stok_awal` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `stok_barang`
--

INSERT INTO `stok_barang` (`id_stok`, `id_user`, `kode_barang`, `stok`, `stok_awal`) VALUES
(1, 1, 'A001', 13, 25),
(2, 1, 'A002', 15, 15);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `foto` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'admin.jpg',
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `foto`, `status`) VALUES
(1, 'Admin', 'admin', '$2y$10$RIVI3U9zUUt0jx2JKNu6YuEA2aL0.ba7hMy5i2xwpRJfqyoIFiNge', 'admin.jpg', 'admin'),
(2, 'Pimpinan', 'pimpinan', '$2y$10$owH4KodMLpMkVIxvevVYCuHOOvb.O/XX9mgY0f5Z/Mhg4s1kcvuUG', 'admin.jpg', 'pimpinan');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`id_barang_keluar`);

--
-- Indeks untuk tabel `detail_user`
--
ALTER TABLE `detail_user`
  ADD PRIMARY KEY (`id_detail_user`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `histori_stok`
--
ALTER TABLE `histori_stok`
  ADD PRIMARY KEY (`id_histori_stok`);

--
-- Indeks untuk tabel `kelola_barang`
--
ALTER TABLE `kelola_barang`
  ADD PRIMARY KEY (`id_kelola_barang`);

--
-- Indeks untuk tabel `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id_laporan`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `stok_barang`
--
ALTER TABLE `stok_barang`
  ADD PRIMARY KEY (`id_stok`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang_keluar`
--
ALTER TABLE `barang_keluar`
  MODIFY `id_barang_keluar` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `detail_user`
--
ALTER TABLE `detail_user`
  MODIFY `id_detail_user` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `histori_stok`
--
ALTER TABLE `histori_stok`
  MODIFY `id_histori_stok` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `kelola_barang`
--
ALTER TABLE `kelola_barang`
  MODIFY `id_kelola_barang` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id_laporan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `stok_barang`
--
ALTER TABLE `stok_barang`
  MODIFY `id_stok` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
