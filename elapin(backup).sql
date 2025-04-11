-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Feb 2024 pada 07.47
-- Versi server: 10.4.19-MariaDB
-- Versi PHP: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elapin`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_laporan`
--

CREATE TABLE `data_laporan` (
  `id_lap` int(6) NOT NULL,
  `id_peg` int(11) NOT NULL,
  `tgl_lap` date NOT NULL,
  `bulan` int(2) NOT NULL,
  `tahun` int(4) NOT NULL,
  `uraian` varchar(255) NOT NULL,
  `output` int(3) NOT NULL,
  `satuan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `data_laporan`
--

INSERT INTO `data_laporan` (`id_lap`, `id_peg`, `tgl_lap`, `bulan`, `tahun`, `uraian`, `output`, `satuan`) VALUES
(1, 3, '2024-01-01', 1, 2024, 'Libur Tahun Baru', 0, ''),
(2, 1, '2024-01-01', 1, 2024, 'Libur Tahun Baru', 0, ''),
(4, 3, '2024-01-03', 1, 2024, 'Dokumentasi Acara Natal dan Tahun Baru', 1, 'Kegiatan'),
(5, 3, '2024-01-03', 1, 2024, 'Edit video acara Natal dan Tahun Baru', 1, 'Kegiatan'),
(6, 3, '2024-01-04', 1, 2024, 'Membuat program aplikasi', 1, 'Kegiatan'),
(7, 3, '2024-01-08', 1, 2024, 'desain dan membuat program aplikasi', 1, 'Kegiatan'),
(8, 3, '2024-01-09', 1, 2024, 'Susun Rencana Anggaran Peralatan Humas', 1, 'Kegiatan'),
(9, 3, '2024-01-09', 1, 2024, 'Membuat Naskah Video dan Dokumentasi ', 1, 'Kegiatan'),
(10, 3, '2024-01-10', 1, 2024, 'Mengarsipkan data Dokumentasi lama', 1, 'Kegiatan'),
(11, 3, '2024-01-12', 1, 2024, 'Membangun server lokal humas', 1, 'Kegiatan'),
(12, 11, '2024-01-12', 1, 2024, 'Membangun server lokal humas', 1, 'Kegiatan'),
(13, 11, '2024-01-15', 1, 2024, 'Membangun server lokal humas', 1, 'Kegiatan'),
(14, 11, '2024-01-12', 1, 2024, 'Membangun server lokal humas', 1, 'Kegiatan'),
(15, 3, '2024-01-15', 1, 2024, 'Membangun server lokal humas', 1, 'Kegiatan'),
(16, 3, '2024-01-16', 1, 2024, 'Mengkonsep ulang Video Company Profile', 1, 'Kegiatan'),
(17, 3, '2024-01-17', 1, 2024, 'Dokumentasi acara Rapat di ruang mutas', 1, 'Kegiatan'),
(18, 3, '2024-01-17', 1, 2024, 'Mengirim Foto Acara Rapat Mutasi', 1, 'Kegiatan'),
(19, 3, '2024-01-18', 1, 2024, 'Membangun server lokal humas', 1, 'Kegiatan'),
(20, 3, '2024-01-19', 1, 2024, 'Membangun server lokal humas', 1, 'Kegiatan'),
(21, 3, '2024-01-22', 1, 2024, 'Membangun server lokal humas', 1, 'Kegiatan'),
(22, 3, '2024-01-23', 1, 2024, 'Membuat program aplikasi', 1, 'Kegiatan'),
(23, 3, '2024-01-24', 1, 2024, 'Membuat program aplikasi', 1, 'Kegiatan'),
(24, 3, '2024-01-25', 1, 2024, 'Membuat program aplikasi', 1, 'Kegiatan'),
(25, 3, '2024-01-26', 1, 2024, 'Olah data dan Arsip peserta magang', 1, 'Kegiatan'),
(26, 3, '2024-01-29', 1, 2024, 'Menyambut peserta magang baru', 1, 'Kegiatan'),
(27, 3, '2024-01-29', 1, 2024, 'Membuatkan Absensi untuk peserta magang baru', 1, 'Kegiatan'),
(28, 3, '2024-01-30', 1, 2024, 'Membuat program aplikasi', 1, 'Kegiatan'),
(29, 3, '2024-01-31', 1, 2024, 'Membuat program aplikasi', 1, 'Kegiatan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lap_bulanan`
--

CREATE TABLE `lap_bulanan` (
  `id_lapbul` int(6) NOT NULL,
  `id_peg` int(11) NOT NULL,
  `bulan` int(2) NOT NULL,
  `tahun` int(4) NOT NULL,
  `jumlah_kegiatan` int(3) NOT NULL,
  `status1` int(1) NOT NULL,
  `status2` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `lap_bulanan`
--

INSERT INTO `lap_bulanan` (`id_lapbul`, `id_peg`, `bulan`, `tahun`, `jumlah_kegiatan`, `status1`, `status2`) VALUES
(1, 3, 1, 2024, 23, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` char(5) NOT NULL,
  `nama_pegawai` varchar(255) NOT NULL,
  `nippnpn` varchar(30) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `spk` varchar(30) NOT NULL,
  `tgl_spk` varchar(30) NOT NULL,
  `jenis_kelamin` varchar(30) NOT NULL,
  `jabatan` varchar(30) NOT NULL,
  `username` varchar(35) NOT NULL,
  `pass` varchar(35) NOT NULL,
  `nama_atasan` varchar(35) NOT NULL,
  `nip_atasan` varchar(35) NOT NULL,
  `jabatan_atasan` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `nama_pegawai`, `nippnpn`, `nik`, `spk`, `tgl_spk`, `jenis_kelamin`, `jabatan`, `username`, `pass`, `nama_atasan`, `nip_atasan`, `jabatan_atasan`) VALUES
('1', 'admin', '201219950120240002', '3402151231231230', '099/RT.04.01/SPK/KR.I.2023', '29 Desember 2023', 'Laki-Laki', 'Cleaning Service', 'admin', 'admin', 'Yussi Hendrayanti, S.Sos', '197406101998032001', 'Plt. Kepala Sub Bagian Umum'),
('2', 'Security', '201219950120240003', '3402151231231235', '069/RT.04.01/SPK/KR.I.2023', '29 Desember 2023', 'L', 'Security', 'security', 'admin', 'Yussi Hendrayanti, S.Sos', '197406101998032001', 'Plt.Kepala Subbagian Umum'),
('3', 'Dimas Dwi Nugroho', '26.202101.1.035', '3402152012950002', '030/RT.04.01/SPK/KR.I.2023', '29 Desember 2023', 'Laki-Laki', 'Tenaga Pramubakti', 'dimas', 'rahasia', 'Yussi Hendrayanti, S.Sos ', '197406101998032001', 'Plt.Kepala Subbagian Umum ');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
