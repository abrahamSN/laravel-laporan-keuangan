-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 26 Jul 2017 pada 12.51
-- Versi Server: 10.0.29-MariaDB-0ubuntu0.16.04.1
-- PHP Version: 7.0.18-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laporan_keuangan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `jasa`
--

CREATE TABLE `jasa` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_jasa` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_jasa` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jasa`
--

INSERT INTO `jasa` (`id`, `nama_jasa`, `keterangan`, `harga_jasa`) VALUES
(1, 'Web Company Profile', 'membuat web company profile', '3000000'),
(2, 'Web Portal', 'web stndar', '2000000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_07_19_170303_entrust_setup_tables', 1),
(7, '2017_07_20_081315_create_jasa_table', 2),
(8, '2017_07_21_232353_create_pemasukan_table', 3),
(9, '2017_07_22_111034_create_pengeluaran_table', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemasukan`
--

CREATE TABLE `pemasukan` (
  `id` int(10) UNSIGNED NOT NULL,
  `jasa_id` int(10) UNSIGNED NOT NULL,
  `jumlah` tinyint(4) NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` decimal(10,0) NOT NULL,
  `foto_bukti` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pemasukan`
--

INSERT INTO `pemasukan` (`id`, `jasa_id`, `jumlah`, `keterangan`, `total`, `foto_bukti`, `tanggal`) VALUES
(5, 1, 2, 'anjay', '6000000', 'Saitama_OK.jpg', '2017-07-21'),
(6, 1, 1, 'pembuatan wweb di pt xtz', '3000000', 'composer_notes.jpg', '2017-07-22'),
(7, 1, 3, 'pembuatan web profile dinas kabupaten lampung', '9000000', 'petrucci_lick.jpg', '2017-07-22'),
(8, 1, 1, 'Pembuatan web profil cv mulya', '3000000', 'certiport.png', '2017-07-21'),
(9, 2, 2, 'membuat web', '4000000', 'Screenshot from 2017-07-04 13-48-38.png', '2017-07-24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah` tinyint(4) NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` decimal(10,0) NOT NULL,
  `foto_bukti` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pengeluaran`
--

INSERT INTO `pengeluaran` (`id`, `nama`, `jumlah`, `keterangan`, `total`, `foto_bukti`, `tanggal`) VALUES
(1, 'pulpen', 1, 'pulpen standar ok', '3500', 'certiport.png', '2017-07-22'),
(2, 'buku', 3, 'alat tulis', '20000', 'Screenshot from 2017-07-04 13-48-38.png', '2017-07-24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'permission-view', 'Permission View', 'hak untuk view permission', '2017-07-20 17:00:00', '2017-07-20 17:00:00'),
(2, 'permission-create', 'Permission Create', 'hak untuk menambah permission', '2017-07-20 17:00:00', '2017-07-20 17:00:00'),
(3, 'permission-edit', 'Permission Edit', 'hak untuk edit permission', '2017-07-20 20:01:37', '2017-07-20 20:01:37'),
(4, 'permission-delete', 'Permission Delete', 'hak untuk hapus permission', '2017-07-20 20:06:54', '2017-07-21 01:08:49'),
(5, 'user-view', 'User View', 'hak untuk melijat user', '2017-07-20 20:32:57', '2017-07-20 20:32:57'),
(6, 'user-create', 'User Create', 'hak untuk tambah user', '2017-07-20 20:34:42', '2017-07-20 20:34:42'),
(7, 'user-edit', 'User Edit', 'hak untuk edit user', '2017-07-20 20:35:11', '2017-07-20 20:35:11'),
(8, 'user-delete', 'User Delete', 'hak untuk menghapus user', '2017-07-20 20:36:42', '2017-07-20 20:36:42'),
(9, 'role-view', 'Role View', 'hak untuk melihat role', '2017-07-20 20:37:18', '2017-07-20 20:37:18'),
(10, 'role-create', 'Role Create', 'hak untuk menambah role', '2017-07-20 20:38:26', '2017-07-20 20:38:26'),
(11, 'role-edit', 'Role Edit', 'hak untuk edit role', '2017-07-20 20:38:55', '2017-07-20 20:38:55'),
(12, 'role-delete', 'Role Delete', 'hak untuk hapus role', '2017-07-21 04:52:03', '2017-07-21 04:52:03'),
(13, 'jasa-view', 'Jasa View', 'hak akses untuk view jasa', '2017-07-21 09:26:10', '2017-07-21 09:26:10'),
(14, 'jasa-create', 'Jasa Create', 'hak akses untuk menambah jasa', '2017-07-21 09:27:16', '2017-07-21 09:27:16'),
(15, 'jasa-edit', 'Jasa Edit', 'hak akses untuk edit jasa', '2017-07-21 09:29:37', '2017-07-21 09:29:37'),
(16, 'jasa-delete', 'Jasa Delete', 'hak akses untuk menghapus jasa', '2017-07-21 09:30:08', '2017-07-21 09:30:08'),
(17, 'pemasukan-view', 'Pemasukan View', 'hak akses untuk melihat pemasukan', '2017-07-21 17:18:54', '2017-07-21 17:18:54'),
(18, 'pemasukan-create', 'Pemasukan Create', 'hak akses untuk tambah pemasukan', '2017-07-21 17:23:17', '2017-07-21 17:23:17'),
(19, 'pemasukan-edit', 'Pemasukan Edit', 'hak akses untuk edit pemasukan', '2017-07-21 17:24:11', '2017-07-21 17:24:11'),
(20, 'pemasukan-delete', 'Pemasukan Delete', 'hak akses untuk menghapus pemasukan', '2017-07-21 17:24:47', '2017-07-21 17:24:47'),
(21, 'pengeluaran-view', 'Pengeluaran View', 'hak untuk melihat view pengeluaran', '2017-07-22 04:03:18', '2017-07-22 04:03:18'),
(22, 'pengeluaran-create', 'Pengeluaran Create', 'hak untuk menambah pengeluaran', '2017-07-22 04:04:45', '2017-07-22 04:04:45'),
(23, 'pengeluaran-edit', 'Pengeluaran Edit', 'hak untuk mengedit pengeluaran', '2017-07-22 04:06:00', '2017-07-22 04:06:00'),
(24, 'pengeluaran-delete', 'Pengeluaran Delete', 'hak untuk menghapus pengeluaran', '2017-07-22 04:07:10', '2017-07-22 04:07:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(13, 2),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(17, 2),
(18, 1),
(18, 2),
(19, 1),
(20, 1),
(21, 1),
(21, 2),
(22, 1),
(22, 2),
(23, 1),
(24, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Admin', 'ini adalah role admin', '2017-07-20 17:00:00', '2017-07-20 17:00:00'),
(2, 'user', 'User', 'ini adalah user', '2017-07-21 05:06:52', '2017-07-21 05:06:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role_user`
--

CREATE TABLE `role_user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(4, 2),
(5, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(4, 'user', 'user@user.com', '$2y$10$.LRGPAn7hI3G6B0qzutcqODUutBfMnVW.EyImWuowNxVK9Kq2JL6G', 'NBHaGZI8xW1yxS2ocPAeLVDMKMvFf9G38r9iOIYCZf6GT4acicKNntF0wmgw', '2017-07-23 10:19:36', '2017-07-23 10:19:36'),
(5, 'admin', 'admin@admin.com', '$2y$10$phxDyRhIXpi.TAitaMzeCO7eckdsFOLGa6rmo7AJBg9X4EE6qQh4y', 'JTvmVAp54mu2mIQ2Hf7O0sEqSVaP6UVFEP00okiq7lINrihfSdke6SEW4zR0', '2017-07-23 10:31:25', '2017-07-23 10:31:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jasa`
--
ALTER TABLE `jasa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pemasukan`
--
ALTER TABLE `pemasukan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pemasukan_jasa_id_index` (`jasa_id`);

--
-- Indexes for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jasa`
--
ALTER TABLE `jasa`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `pemasukan`
--
ALTER TABLE `pemasukan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pemasukan`
--
ALTER TABLE `pemasukan`
  ADD CONSTRAINT `pemasukan_jasa_id_foreign` FOREIGN KEY (`jasa_id`) REFERENCES `jasa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
