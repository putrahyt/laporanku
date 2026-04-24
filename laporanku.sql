-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Feb 2024 pada 18.30
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laporanku`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporanakhir`
--

CREATE TABLE `laporanakhir` (
  `id` int(11) NOT NULL,
  `tanggal` int(11) DEFAULT NULL,
  `gambar` varchar(128) NOT NULL,
  `username` varchar(50) NOT NULL,
  `fullname` varchar(128) NOT NULL,
  `status` varchar(2) NOT NULL,
  `aktivitas` text NOT NULL,
  `dokumen` varchar(128) DEFAULT NULL,
  `url` text DEFAULT NULL,
  `catatan_mentor` mediumtext DEFAULT NULL,
  `mentor` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `laporanakhir`
--

INSERT INTO `laporanakhir` (`id`, `tanggal`, `gambar`, `username`, `fullname`, `status`, `aktivitas`, `dokumen`, `url`, `catatan_mentor`, `mentor`) VALUES
(36, 1706060217, 'default.jpg', 'putrahyt', 'Putra Hidayat', '1', 'Laporan Akhir', 'Putra Hidayat_65b069b9e03e6.pdf', NULL, 'test', 'mentorai'),
(37, 1706071183, 'default.jpg', 'putri', 'Putri Rahmayani', '1', 'Laporan Akhir', 'Putri Rahmayani_65b0948f79320.pdf', NULL, NULL, 'mentorti'),
(38, 1706072227, '65b09857b5e63.png', 'peserta', 'Peserta', '0', 'Laporan Akhir', 'Peserta_65b098a3a2161.pdf', NULL, NULL, 'mentorai');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporanharian`
--

CREATE TABLE `laporanharian` (
  `id` int(11) NOT NULL,
  `username` varchar(40) DEFAULT NULL,
  `fullname` varchar(120) NOT NULL,
  `status` varchar(3) NOT NULL,
  `tanggal` int(11) DEFAULT NULL,
  `aktivitas` text DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `dokumentasi` varchar(128) DEFAULT NULL,
  `url` text DEFAULT NULL,
  `catatan_mentor` mediumtext DEFAULT NULL,
  `mentor` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `laporanharian`
--

INSERT INTO `laporanharian` (`id`, `username`, `fullname`, `status`, `tanggal`, `aktivitas`, `catatan`, `dokumentasi`, `url`, `catatan_mentor`, `mentor`) VALUES
(56, 'putrahyt', 'Putra Hidayat', '1', 1706060142, 'test', 'test', NULL, 'http://google.com', NULL, 'mentorai'),
(57, 'putrahyt', 'Putra Hidayat', '0', 1706072609, 'asd', 'teste', NULL, 'https://google.com', NULL, 'mentorai'),
(58, 'putrahyt', 'Putra Hidayat', '0', 1706078121, 'dfg', 'dfg', NULL, 'http://google.com', NULL, 'mentorai'),
(59, 'peserta', 'Peserta', '0', 1706846726, 'dadasd', 'asaddsaasdasdsaddas', NULL, 'http://google.com', NULL, 'mentorai');

-- --------------------------------------------------------

--
-- Struktur dari tabel `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `reset_token_hash` varchar(64) DEFAULT NULL,
  `reset_token_expires_at` varchar(20) DEFAULT NULL,
  `role` varchar(20) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `login`
--

INSERT INTO `login` (`id`, `username`, `password`, `email`, `reset_token_hash`, `reset_token_expires_at`, `role`, `date_created`) VALUES
(4, 'adminkominfo', '$2y$10$sAijdUdwATuWvKt8yGJk4uxX9ao0Q4IfmIt1u4scQzNdNba3DCwAy', 'mylaporanku@gmail.com', NULL, '0', 'admin', 1701658831),
(76, 'mentorai', '$2y$10$V1xHRSHBqu7oc.0ufu70aeigtA3GfL94B5FZ0CWLM7R9w7SjS9Ita', NULL, NULL, NULL, 'mentor', 1705630013),
(77, 'mentorti', '$2y$10$sx4u6oVNxdLPBRFq9zOoE.hw/gGUoyFCdXHVaPf3sdFakCpwvm7lO', NULL, NULL, NULL, 'mentor', 1705630047),
(81, 'putrahyt', '$2y$10$7P1BewpAzsa2ofjnaF2TAOChJoKlOYh.joYadS1rInrlh7CLolks.', 'putrahidayat629@gmail.com', NULL, NULL, 'peserta', 1706060088),
(82, 'putri', '$2y$10$URGhU8oS43wHf7cY.C1S/OhTZ66sTTbV/WuYJr6wQhZthyKZ.ZgWq', 'putra@gmail.com', NULL, NULL, 'peserta', 1706071140),
(83, 'peserta', '$2y$10$QNFHcD0JByTHgP5wTEUsNO0NT7xLnPbuD1XIw9UCDJXUTr60Su7Oy', 'test@test.com', NULL, NULL, 'peserta', 1706072103),
(84, 'ilham', '$2y$10$x9Y/NmQCt2EXf1CeZXRyS.Ttru8TP6Sa17080/C2.CMdcP5c11xxS', 'asd@test.com', NULL, NULL, 'peserta', 1706846967);

-- --------------------------------------------------------

--
-- Struktur dari tabel `mentor`
--

CREATE TABLE `mentor` (
  `id` int(11) NOT NULL,
  `full_name` varchar(128) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `email` varchar(128) DEFAULT NULL,
  `jabatan` varchar(100) DEFAULT NULL,
  `divisi` varchar(50) DEFAULT NULL,
  `noHP` varchar(13) DEFAULT NULL,
  `image` varchar(128) NOT NULL,
  `date_created` int(11) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `mentor`
--

INSERT INTO `mentor` (`id`, `full_name`, `username`, `password`, `email`, `jabatan`, `divisi`, `noHP`, `image`, `date_created`, `role`) VALUES
(49, 'Mentor AI', 'mentorai', '$2y$10$NDYLg/DYDEH/nwUiEcvGlOHeo7KRLC3Q85/i2MoMSmXxY/ZXuNgn2', NULL, 'Ketua Tim AI', NULL, NULL, 'default.jpg', 1705630013, 'mentor'),
(50, 'Mentor Ti', 'mentorti', '$2y$10$mm3DVsSurrSptBk/RRdjNOTst5E06JeV1cLu8FS8sb.aAH8AZ/DMK', NULL, 'Ketua Tim TI', NULL, NULL, 'default.jpg', 1705630047, 'mentor');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peserta`
--

CREATE TABLE `peserta` (
  `id` int(11) NOT NULL,
  `fullname` varchar(128) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `instansi` varchar(128) NOT NULL,
  `jurusan` varchar(128) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mentor` varchar(128) NOT NULL,
  `divisi` varchar(128) NOT NULL,
  `npm` int(20) NOT NULL,
  `noHP` varchar(13) NOT NULL,
  `image` varchar(128) NOT NULL,
  `is_actived` int(1) NOT NULL,
  `date_created` int(11) NOT NULL,
  `role` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `peserta`
--

INSERT INTO `peserta` (`id`, `fullname`, `username`, `password`, `instansi`, `jurusan`, `email`, `mentor`, `divisi`, `npm`, `noHP`, `image`, `is_actived`, `date_created`, `role`) VALUES
(55, 'Putra Hidayat', 'putrahyt', '$2y$10$hasrFcqwlWqwcNTfxEOLpu0vWBV0x9llIYvE3fvBQruKduvgCqMle', 'Universitas Pembangunan Panca Budi', 'Sistem Komputer', 'putrahidayat629@gmail.com', 'mentorai', 'Aplikasi Informatika', 0, '0', 'default.jpg', 1, 1706060088, 'peserta'),
(56, 'Putri Rahmayani', 'putri', '$2y$10$qErAxqritP46xh2Fkr2YNeWh1444BL94aTrTz1DomCfmYVRSLLiSi', 'Universitas Pembangunan Panca Budi', 'Sistem Komputer', 'putra@gmail.com', 'mentorti', 'Teknologi Informatika', 0, '0', 'default.jpg', 1, 1706071140, 'peserta'),
(57, 'Peserta', 'peserta', '$2y$10$lMa0e.V1Mg/jkM.tNL/CTufjvE3ueODi9eKQrxLAgziKSuwZRPG1W', 'Universitas Pembangunan Panca Budi', 'Sistem Komputer', 'test@test.com', 'mentorai', 'Teknologi Informatika', 0, '0', '65b09857b5e63.png', 1, 1706072103, 'peserta'),
(58, 'Ilham Buckhari', 'ilham', '$2y$10$0n5vjBaOW.sD9idhEUsOoep0zyKOj1yEYzSPaKa3bNWegWKWtUPS2', 'Universitas Pembangunan Panca Budi', 'Sistem Komputer', 'asd@test.com', 'mentorai', 'Komunikasi Publik', 0, '0', 'default.jpg', 1, 1706846967, 'peserta');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `laporanakhir`
--
ALTER TABLE `laporanakhir`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `laporanharian`
--
ALTER TABLE `laporanharian`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reset_token_hash` (`reset_token_hash`);

--
-- Indeks untuk tabel `mentor`
--
ALTER TABLE `mentor`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `peserta`
--
ALTER TABLE `peserta`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `laporanakhir`
--
ALTER TABLE `laporanakhir`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT untuk tabel `laporanharian`
--
ALTER TABLE `laporanharian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT untuk tabel `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT untuk tabel `mentor`
--
ALTER TABLE `mentor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT untuk tabel `peserta`
--
ALTER TABLE `peserta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
