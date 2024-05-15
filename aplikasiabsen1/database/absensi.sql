-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Bulan Mei 2024 pada 13.35
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
-- Database: `absensi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `absensi`
--

CREATE TABLE `absensi` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `class` varchar(50) NOT NULL,
  `status_kehadiran` varchar(50) NOT NULL,
  `hari` date NOT NULL,
  `foto` longblob NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `absensi`
--

INSERT INTO `absensi` (`id`, `username`, `class`, `status_kehadiran`, `hari`, `foto`, `created_at`) VALUES
(1, 'Dana Raga', 'X PPLG 2', 'Hadir', '2024-05-13', '', '2024-05-13 11:22:06'),
(2, 'Dana Raga', 'X PPLG 2', 'Tidak Hadir', '2024-05-14', 0x2e2e2f2e2e2f61646d696e2f75706c6f6164732f53637265656e73686f7420323032342d30352d3036203138343933382e706e67, '2024-05-13 11:22:28'),
(3, 'Dana Raga', 'X PPLG 2', 'Tidak Hadir', '2024-05-15', 0x2e2e2f2e2e2f61646d696e2f75706c6f6164732f53637265656e73686f7420323032342d30352d3036203137333731362e706e67, '2024-05-13 11:24:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `referral_code` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`, `referral_code`) VALUES
(1, 'admin@gmail.com', '$2y$10$p1fmPn6FOMGBWNYIebgSaukLpabnmHwlH1lzInGJRIs0DDMRW0a86', '123456');

-- --------------------------------------------------------

--
-- Struktur dari tabel `request`
--

CREATE TABLE `request` (
  `id` int(11) NOT NULL,
  `request` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `request`
--

INSERT INTO `request` (`id`, `request`) VALUES
(1, 'Muhammad Rasyad Helza Kurniawan 10 PPLG 2'),
(2, 'Aiufa 10 PPLG 2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `class`, `password`, `created_at`) VALUES
(1, 'Dana Raga', 'danaraga@gmail.com', 'X PPLG 2', '$2y$10$5K1GpW75LZPFikbQczHSIezomjVOE0Pk1ukzfos13s79x0SATEHyO', '2024-05-04 13:25:01'),
(2, 'Muhammad Rasyad Helza Kurniawan', 'rasyad@gmail.com', 'X PPLG 2', '$2y$10$pADhR56NFeX0cHy2f7E2xeGLBlt5vsP7XsrRYwTP0bIXYIAcEYB/W', '2024-05-05 15:02:08'),
(3, 'Aufa Ziya Khairi', 'aufa@gmail.com', 'X PPLG 2', '$2y$10$U1aF/ZnFB3LOqnZ7iV03iesKPo6/ySp0ulqapNqKn2A.weIL.k2TS', '2024-05-05 15:03:57'),
(4, 'Muhammad Fathan Sulaeman', 'fathan@gmail.com', 'X PPLG 1', '$2y$10$AlivsTd1g/uwFZT15RvOcuF8baM.siL0USAdslOuSiASh6z9KcMgK', '2024-05-05 15:05:22'),
(5, 'Muhammad Gibran ArRafi', 'gibran@gmail.com', 'X PPLG 2', '$2y$10$z9XKlfzXLaEAjNuNsfSWYeHEUNS5PlRqbiSZKWJKKF40uUdSE0qtq', '2024-05-05 23:37:46'),
(6, 'Fajri Muhammad Ikhsan', 'fajri@gmail.com', 'X PPLG 1', '$2y$10$TmiKr61TG.YSEhXZyu3PFeUL3A9dEgPbGtx3qiBcZajI0KNo6f.sK', '2024-05-10 00:36:22'),
(7, 'Abyaz Azka Kurniawan', 'abyaz@gmail.com', 'X PPLG 2', '$2y$10$7jnPOW83aSAjtrwjnUBqDehfCNQ4rkTqgwDrLQsJBPHxD/6gEUNQW', '2024-05-13 11:26:39');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `request`
--
ALTER TABLE `request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
