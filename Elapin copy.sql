-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Des 2023 pada 02.55
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
-- Struktur dari tabel `uSER`
--

CREATE TABLE `user` (
  `id` int(5) NOT NULL,
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
-- Indeks untuk tabel `users`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT FIRST;

INSERT INTO `user` (`id`, `nama_pegawai`, `nippnpn`, `nik`, `spk`,`tgl_spk`, `jenis_kelamin`, `jabatan`, `username`, `pass`,`nama_atasan`, `nip_atasan`, `jabatan_atasan`) VALUES
('1', 'admin', '201219950120240002', '3402151231231230', '099/RT.04.01/SPK/KR.I.2023', '29 Desember 2023','L', 'Cleaning Service', 'admin', 'admin', 'Yussi Hendrayanti, S.Sos', '197406101998032001', 'Plt.Kepala Subbagian Umum'),
('2', 'Security', '201219950120240003', '3402151231231235', '069/RT.04.01/SPK/KR.I.2023','29 Desember 2023', 'L', 'Security', 'security', 'admin', 'Yussi Hendrayanti, S.Sos', '197406101998032001', 'Plt.Kepala Subbagian Umum');

CREATE TABLE `data_laporan` (
  `id_lap` int(6) NOT NULL,
  `id_peg` int NOT NULL,
  `tgl_lap` date NOT NULL,
  `bulan` int(2) NOT NULL,
  `tahun` int(4) NOT NULL,
  `uraian` varchar(255) NOT NULL,
  `output` int(3) NOT NULL,
  `satuan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
--
-- Indexes for table `data_laporan`
--
ALTER TABLE `data_laporan`
  ADD PRIMARY KEY (`id_lap`);

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `data_laporan`
  MODIFY `id_lap` int(6) NOT NULL AUTO_INCREMENT FIRST;


--
-- Database: `data_laporan`
--

CREATE TABLE `lap_bulanan` (
  `id_lapbul` int(6) NOT NULL,
  `id_peg` int NOT NULL,
  `bulan` int(2) NOT NULL,
  `tahun` int(4) NOT NULL,
  `jumlah_kegiatan` int(3) NOT NULL,
  `status1` varchar(50) NOT NULL,
  `status2` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
--
-- Indexes for table `bulanan`
--
ALTER TABLE `lap_bulanan`
  ADD PRIMARY KEY (`id_lapbul`);
--
-- AUTO_INCREMENT for table `bulanan`
--
ALTER TABLE `lap_bulanan`
  MODIFY `id_lapbul` int(6) NOT NULL AUTO_INCREMENT FIRST;

CREATE TABLE `cuti` (
  `id_cuti` int(6) NOT NULL,
  `id_peg` int NOT NULL,
  `jml_cuti` int(2) NOT NULL,
  `mulai_cuti` date NOT NULL,
  `selesai_cuti` date NOT NULL,
  `jenis_cuti` int(1) NOT NULL,
  `status_cuti` varchar(50) NULL,
  `alasan_cuti` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
--
-- Indeks untuk tabel `cuti`
--
ALTER TABLE `cuti`
  ADD PRIMARY KEY (`id_cuti`);
--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `cuti`
  MODIFY `id_cuti` int(6) NOT NULL AUTO_INCREMENT FIRST;

CREATE TABLE `izin` (
  `id_izin` int(6) NOT NULL,
  `id_peg` int NOT NULL,
  `jml_izin` int(2) NOT NULL,
  `mulai_izin` date NOT NULL,
  `jam_mulai` time NULL,
  `selesai_izin` date NOT NULL,
  `jam_selesai` time NULL,
  `jenis_izin` int(1) NOT NULL,
  `keterangan_izin` varchar(300) NOT NULL,
  `bukti_izin` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
--
-- Indeks untuk tabel `izin`
--
ALTER TABLE `izin`
  ADD PRIMARY KEY (`id_izin`);
--
-- AUTO_INCREMENT for table `izin`
--
ALTER TABLE `izin`
  MODIFY `id_izin` int(6) NOT NULL AUTO_INCREMENT FIRST;

CREATE TABLE `shift_kerja` (
  `id_shift` int(6) NOT NULL,
  `nama_shift`varchar(25) NOT NULL,
  `jam_datang_shift` time NOT NULL,
  `jam_pulang_shift` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `shift_kerja` (`id_shift`, `nama_shift`, `jam_datang_shift`, `jam_pulang_shift`) VALUES
('1', 'Fulltime', '07:30', '16:00'),
('2', 'Shift Malam', '19:30', '07:30'),
('3', 'Shift Pagi', '19:30', '07:30'),
('4', 'Sabtu', '07:30', '11:00');

--
-- Indexes for table `absensi`
--
ALTER TABLE `shift_kerja`
  ADD PRIMARY KEY (`id_shift`);
--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `shift_kerja`
  MODIFY `id_shift` int(6) NOT NULL AUTO_INCREMENT FIRST;


CREATE TABLE `kantor` (
  `id_kantor` int(6) NOT NULL,
  `nama_kantor`varchar(255) NOT NULL,
  `alamat`varchar(255) NOT NULL,
  `lat_long`varchar(255) NOT NULL,
  `radius` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
INSERT INTO `kantor` (`id_kantor`, `nama_kantor`, `alamat`, `lat_long`, `radius`) VALUES
('1', 'Kantor Regional I BKN Yogyakarta', 'jl.Magelang Km. 7,5, Jongke Tengah, Sendangadi, Mlati, Sleman Regency, Special Region of Yogyakarta 55285', '-7.7445764,110.366628', '3000'),
('2', 'Rumah Dinas', 'Jl. Gedongkuning, Rejowinangun, Kec. Kotagede, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55171', '-7.814661,110.4016561', '3000'),
('3', 'Limasan', 'Sidokarto, Godean, Sleman Regency, Special Region of Yogyakarta 55264', '-7.7857569,110.302588', '3000');

--
-- Indexes for table `absensi`
--
ALTER TABLE `kantor`
  ADD PRIMARY KEY (`id_kantor`);

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `kantor`
  MODIFY `id_kantor` int(6) NOT NULL AUTO_INCREMENT FIRST;



CREATE TABLE `absensi` (
  `id_absen` int(6) NOT NULL,
  `id_peg`int(10) NOT NULL,
  `id_kantor`int(2) NOT NULL,
  `id_shift`int(2) NOT NULL,
  `tgl_datang`date NOT NULL,
  `tgl_pulang`date NOT NULL,
  `jam_datang`time NOT NULL,
  `jam_pulang`time NOT NULL,
  `foto_datang`varchar(255) NOT NULL,
  `foto_pulang`varchar(255) NOT NULL,
  `status_datang`varchar(30) NOT NULL,
  `status_pulang`varchar(30) NOT NULL,
  `latlong_datang`varchar(55) NOT NULL,
  `latlong_pulang`varchar(55) NOT NULL,
  `keterangan`varchar(55) NOT NULL,
  `jumlah_jam_kerja`int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id_absen`);

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id_absen` int(6) NOT NULL AUTO_INCREMENT FIRST;
