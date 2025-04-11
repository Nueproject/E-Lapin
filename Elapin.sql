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


--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `nama_pegawai`, `nippnpn`, `nik`, `spk`, `tgl_spk`, `jenis_kelamin`, `jabatan`, `username`, `pass`, `nama_atasan`, `nip_atasan`, `jabatan_atasan`) VALUES
('1', 'Yussi Hendrayanti, S.Sos', '197406101998032001', '', '', '', 'Perempuan', 'admin', 'admin', '197406101998032001', '', '', ''),
('2', 'Sudimin', '201219950120240003', '3402151231231235', '069/RT.04.01/SPK/KR.I.2023', '29 Desember 2023', 'L', 'sudimin', 'sudimin', 'admin123', 'Yussi Hendrayanti, S.Sos', '197406101998032001', 'Plt.Kepala Subbagian Umum'),
('3', 'Dimas Dwi Nugroho', '26.202101.1.035', '3402152012950002', '030/RT.04.01/SPK/KR.I.2023', '29 Desember 2023', 'Laki-Laki', 'Tenaga Pramubakti', 'dimas', 'rahasia', 'Yussi Hendrayanti, S.Sos ', '197406101998032001', 'Plt.Kepala Subbagian Umum '),
('5', 'Eko Iswandono', '', '3404021911860001', '035/RT.04.01//SPK/KR.I.2023', '29 Desember 2023', 'Laki-Laki', 'Tenaga Pramubakti', 'iswan19', '19iswan11', 'Yussi Hendrayanti', '197406101998032001', 'Plt. Kepala Sub Bagian Umum'),
('6', 'MUHAMMAD SIDIQ NOVIANTORO', '262021011036', '3174080711810005', '033/RT.04.01/SPK/KR.I.2023', '29 Desember 2023', 'Laki-Laki', 'Tenaga Pramubakti', 'Sidiq', 'Bismilah1', 'YUSSI HENDRAYANTI, S.Sos.', '197406101998032001', 'Plt. Kepala Subbagian Umum'),
('7', 'AZOLLA SILVIANI', '26.201903.1.028', '3404124110900007', '029/RT.04.01/SPK/KR.I.2023 ', '29 Desember 2023', 'Perempuan', 'Tenaga Pramubakti', 'Azolla', 'Azollavivi90', 'Yussi Hendrayanti, S. Sos', '197406101998032001', 'Plt. Kepala Subbagian Umum'),
('8', 'Achmad Sidiq Asad', '26.202301.1.032', '1234567891012', '028/ /RT.04.01/SPK/KR.I.2023', '29 Desember 2023', 'Laki-Laki', 'Tenaga Pramubakti', 'achmadsidiqasad', '12345678', 'Yussi Hendrayanti, S.Sos', '197406101998032001', 'Plt. Kasubag Umum'),
('9', 'Fransisca Trigiasmi', '26.202211.2.037', '1801096405960001', '031/RT.04.01/SPK/KR.I.2023', '29 Desember 2023', 'Perempuan', 'Tenaga Pramubakti', 'Fransiscatrigiasmi', 'akulali123', 'Yussi Hendrayanti', '197406101998032001', 'Plt. Kepala subbagian umum');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

CREATE TABLE `data_laporan` (
  `id_lap` int(10) NOT NULL,
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
-- Dumping data untuk tabel `data_laporan`
--

INSERT INTO `data_laporan` (`id_lap`, `id_peg`, `tgl_lap`, `bulan`, `tahun`, `uraian`, `output`, `satuan`) VALUES
(1, 3, '2024-01-01', 1, 2024, 'Libur Tahun Baru', 0, ''),
(2, 1, '2024-01-01', 1, 2024, 'Libur Tahun Baru', 0, ''),
(4, 3, '2024-01-03', 1, 2024, 'Dokumentasi Acara Natal dan Tahun Baru', 1, 'Kegiatan'),
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
(29, 3, '2024-01-31', 1, 2024, 'Membuat program aplikasi', 1, 'Kegiatan'),
(30, 3, '2024-02-01', 2, 2024, 'Membuat aplikasi E-Lapin (Elektronik Laporan Kinerja)', 1, 'Kegiatan'),
(31, 3, '2024-02-02', 2, 2024, 'Melanjutkan pembuatan aplikasi E-Lapin (Elektronik Laporan Kinerja)', 1, 'Kegiatan'),
(32, 3, '2024-02-05', 2, 2024, 'Melanjutkan pembuatan aplikasi E-Lapin (Elektronik Laporan Kinerja)', 1, 'Kegiatan'),
(33, 3, '2024-02-06', 2, 2024, 'Membuat aplikasi E-Lapin (Elektronik Laporan Kinerja)', 1, 'Kegiatan'),
(34, 3, '2024-02-07', 2, 2024, 'Membuat aplikasi E-Lapin (Elektronik Laporan Kinerja)', 1, 'Kegiatan'),
(35, 3, '2024-02-07', 2, 2024, 'Menjaga Resepsionis karena 2 ppnpn tidak hadir', 1, 'Kegiatan'),
(36, 3, '2024-02-12', 2, 2024, 'Melanjutkan pembuatan aplikasi elapin', 1, 'Kegiatan'),
(37, 3, '2024-02-13', 2, 2024, 'Membuat aplikasi absensi', 1, 'Kegiatan'),
(38, 3, '2024-02-15', 2, 2024, 'Membuat server agar bisa diakses online', 1, 'Kegiatan'),
(39, 38, '2024-02-15', 2, 2024, 'Membuat server agar bisa diakses online', 1, 'Kegiatan'),
(40, 3, '2024-02-16', 2, 2024, 'Setting server dengan domain aplikasi', 1, 'Kegiatan'),
(41, 3, '2024-02-19', 2, 2024, 'Membuat menu Izin di Aplikasi MyBKN E-lapin', 1, 'Kegiatan'),
(42, 5, '2024-02-05', 2, 2024, 'Menyiapkan peralatan kerja. Menerima berkas/surat/paket dari Pos, penghubung & sekretaris. Membuka & memeriksa surat/berkas. Scanning surat/berkas fisik. Input surat/berkas ke Srikandi. Membuat dokumen bukti pengantaran surat/berkas. Mendistribusikan surat/berkas ke bidang sesuai dengan isi surat/berkas. Merapikan file hasil scanning surat/berkas di komputer. ', 1, 'Kegiatan'),
(43, 5, '2024-02-02', 2, 2024, 'Menyiapkan peralatan kerja. Menerima berkas/surat/paket dari Pos, penghubung & sekretaris. Membuka & memeriksa surat/berkas. Scanning surat/berkas fisik. Input surat/berkas ke Srikandi. Membuat dokumen bukti pengantaran surat/berkas. Mendistribusikan surat/berkas ke bidang sesuai dengan isi surat/berkas. Merapikan file hasil scanning surat/berkas di komputer. ', 1, 'Kegiatan'),
(44, 5, '2024-02-06', 2, 2024, 'Menyiapkan peralatan kerja. Menerima berkas/surat/paket dari Pos, penghubung & sekretaris. Membuka & memeriksa surat/berkas. Scanning surat/berkas fisik. Input surat/berkas ke Srikandi. Membuat dokumen bukti pengantaran surat/berkas. Mendistribusikan sura', 1, 'Kegiatan'),
(45, 5, '2024-02-01', 2, 2024, 'Menyiapkan peralatan kerja. Menerima berkas/surat/paket dari Pos, penghubung & sekretaris. Membuka & memeriksa surat/berkas. Scanning surat/berkas fisik. Input surat/berkas ke Srikandi. Membuat dokumen bukti pengantaran surat/berkas. Mendistribusikan surat/berkas ke bidang sesuai dengan isi surat/berkas. Merapikan file hasil scanning surat/berkas di komputer. ', 1, 'Kegiatan'),
(46, 43, '2024-02-02', 2, 2024, 'Menyiapkan peralatan kerja. Menerima berkas/surat/paket dari Pos, penghubung & sekretaris. Membuka & memeriksa surat/berkas. Scanning surat/berkas fisik. Input surat/berkas ke Srikandi. Membuat dokumen bukti pengantaran surat/berkas. Mendistribusikan sura', 1, 'Kegiatan'),
(47, 45, '2024-02-01', 2, 2024, 'Menyiapkan peralatan kerja. Menerima berkas/surat/paket dari Pos, penghubung & sekretaris. Membuka & memeriksa surat/berkas. Scanning surat/berkas fisik. Input surat/berkas ke Srikandi. Membuat dokumen bukti pengantaran surat/berkas. Mendistribusikan surat/berkas ke bidang sesuai dengan isi surat/berkas. Merapikan file hasil scanning surat/berkas di komputer. ', 1, 'Kegiatan'),
(48, 43, '2024-02-02', 2, 2024, 'Menyiapkan peralatan kerja. Menerima berkas/surat/paket dari Pos, penghubung & sekretaris. Membuka & memeriksa surat/berkas. Scanning surat/berkas fisik. Input surat/berkas ke Srikandi. Membuat dokumen bukti pengantaran surat/berkas. Mendistribusikan surat/berkas ke bidang sesuai dengan isi surat/berkas. Merapikan file hasil scanning surat/berkas di komputer. ', 1, 'Kegiatan'),
(49, 42, '2024-02-06', 2, 2024, 'Menyiapkan peralatan kerja. Menerima berkas/surat/paket dari Pos, penghubung & sekretaris. Membuka & memeriksa surat/berkas. Scanning surat/berkas fisik. Input surat/berkas ke Srikandi. Membuat dokumen bukti pengantaran surat/berkas. Mendistribusikan surat/berkas ke bidang sesuai dengan isi surat/berkas. Merapikan file hasil scanning surat/berkas di komputer. ', 1, 'Kegiatan'),
(50, 42, '2024-02-07', 2, 2024, 'Menyiapkan peralatan kerja. Menerima berkas/surat/paket dari Pos, penghubung & sekretaris. Membuka & memeriksa surat/berkas. Scanning surat/berkas fisik. Input surat/berkas ke Srikandi. Membuat dokumen bukti pengantaran surat/berkas. Mendistribusikan surat/berkas ke bidang sesuai dengan isi surat/berkas. Merapikan file hasil scanning surat/berkas di komputer. ', 1, 'Kegiatan'),
(51, 42, '2024-02-08', 2, 2024, 'Menyiapkan peralatan kerja. Menerima berkas/surat/paket dari Pos, penghubung & sekretaris. Membuka & memeriksa surat/berkas. Scanning surat/berkas fisik. Input surat/berkas ke Srikandi. Membuat dokumen bukti pengantaran surat/berkas. Mendistribusikan surat/berkas ke bidang sesuai dengan isi surat/berkas. Merapikan file hasil scanning surat/berkas di komputer. ', 1, 'Kegiatan'),
(52, 42, '2024-02-05', 2, 2024, 'Menyiapkan peralatan kerja. Menerima berkas/surat/paket dari Pos, penghubung & sekretaris. Membuka & memeriksa surat/berkas. Scanning surat/berkas fisik. Input surat/berkas ke Srikandi. Membuat dokumen bukti pengantaran surat/berkas. Mendistribusikan surat/berkas ke bidang sesuai dengan isi surat/berkas. Merapikan file hasil scanning surat/berkas di komputer. ', 1, 'Kegiatan'),
(53, 44, '2024-02-06', 2, 2024, 'Menyiapkan peralatan kerja. Menerima berkas/surat/paket dari Pos, penghubung & sekretaris. Membuka & memeriksa surat/berkas. Scanning surat/berkas fisik. Input surat/berkas ke Srikandi. Membuat dokumen bukti pengantaran surat/berkas. Mendistribusikan sura', 1, 'Kegiatan'),
(54, 5, '2024-02-07', 2, 2024, 'Menyiapkan peralatan kerja. Menerima berkas/surat/paket dari Pos, penghubung & sekretaris. Membuka & memeriksa surat/berkas. Scanning surat/berkas fisik. Input surat/berkas ke Srikandi. Membuat dokumen bukti pengantaran surat/berkas. Mendistribusikan surat/berkas ke bidang sesuai dengan isi surat/berkas. Merapikan file hasil scanning surat/berkas di komputer. ', 1, 'Kegiatan'),
(55, 5, '2024-02-08', 2, 2024, 'Menyiapkan peralatan kerja. Menerima berkas/surat/paket dari Pos, penghubung & sekretaris. Membuka & memeriksa surat/berkas. Scanning surat/berkas fisik. Input surat/berkas ke Srikandi. Membuat dokumen bukti pengantaran surat/berkas. Mendistribusikan surat/berkas ke bidang sesuai dengan isi surat/berkas. Merapikan file hasil scanning surat/berkas di komputer. ', 1, 'Kegiatan'),
(56, 5, '2024-02-09', 2, 2024, 'Menyiapkan peralatan kerja. Menerima berkas/surat/paket dari Pos, penghubung & sekretaris. Membuka & memeriksa surat/berkas. Scanning surat/berkas fisik. Input surat/berkas ke Srikandi. Membuat dokumen bukti pengantaran surat/berkas. Mendistribusikan surat/berkas ke bidang sesuai dengan isi surat/berkas. Merapikan file hasil scanning surat/berkas di komputer. ', 1, 'Kegiatan'),
(57, 5, '2024-02-12', 2, 2024, 'Menyiapkan peralatan kerja. Menerima berkas/surat/paket dari Pos, penghubung & sekretaris. Membuka & memeriksa surat/berkas. Scanning surat/berkas fisik. Input surat/berkas ke Srikandi. Membuat dokumen bukti pengantaran surat/berkas. Mendistribusikan surat/berkas ke bidang sesuai dengan isi surat/berkas. Merapikan file hasil scanning surat/berkas di komputer. ', 1, 'Kegiatan'),
(58, 5, '2024-02-13', 2, 2024, 'Menyiapkan peralatan kerja. Menerima berkas/surat/paket dari Pos, penghubung & sekretaris. Membuka & memeriksa surat/berkas. Scanning surat/berkas fisik. Input surat/berkas ke Srikandi. Membuat dokumen bukti pengantaran surat/berkas. Mendistribusikan surat/berkas ke bidang sesuai dengan isi surat/berkas. Merapikan file hasil scanning surat/berkas di komputer. ', 1, 'Kegiatan'),
(59, 5, '2024-02-14', 2, 2024, 'Menyiapkan peralatan kerja. Menerima berkas/surat/paket dari Pos, penghubung & sekretaris. Membuka & memeriksa surat/berkas. Scanning surat/berkas fisik. Input surat/berkas ke Srikandi. Membuat dokumen bukti pengantaran surat/berkas. Mendistribusikan surat/berkas ke bidang sesuai dengan isi surat/berkas. Merapikan file hasil scanning surat/berkas di komputer. ', 1, 'Kegiatan'),
(60, 5, '2024-02-15', 2, 2024, 'Menyiapkan peralatan kerja. Menerima berkas/surat/paket dari Pos, penghubung & sekretaris. Membuka & memeriksa surat/berkas. Scanning surat/berkas fisik. Input surat/berkas ke Srikandi. Membuat dokumen bukti pengantaran surat/berkas. Mendistribusikan surat/berkas ke bidang sesuai dengan isi surat/berkas. Merapikan file hasil scanning surat/berkas di komputer. ', 1, 'Kegiatan'),
(61, 5, '2024-02-16', 2, 2024, 'Menyiapkan peralatan kerja. Menerima berkas/surat/paket dari Pos, penghubung & sekretaris. Membuka & memeriksa surat/berkas. Scanning surat/berkas fisik. Input surat/berkas ke Srikandi. Membuat dokumen bukti pengantaran surat/berkas. Mendistribusikan surat/berkas ke bidang sesuai dengan isi surat/berkas. Merapikan file hasil scanning surat/berkas di komputer. ', 1, 'Kegiatan'),
(62, 5, '2024-02-19', 2, 2024, 'Menyiapkan peralatan kerja. Menerima berkas/surat/paket dari Pos, penghubung & sekretaris. Membuka & memeriksa surat/berkas. Scanning surat/berkas fisik. Input surat/berkas ke Srikandi. Membuat dokumen bukti pengantaran surat/berkas. Mendistribusikan surat/berkas ke bidang sesuai dengan isi surat/berkas. Merapikan file hasil scanning surat/berkas di komputer. ', 1, 'Kegiatan'),
(63, 5, '2024-02-20', 2, 2024, 'Menyiapkan peralatan kerja. Menerima berkas/surat/paket dari Pos, penghubung & sekretaris. Membuka & memeriksa surat/berkas. Scanning surat/berkas fisik. Input surat/berkas ke Srikandi. Membuat dokumen bukti pengantaran surat/berkas. Mendistribusikan surat/berkas ke bidang sesuai dengan isi surat/berkas. Merapikan file hasil scanning surat/berkas di komputer. ', 1, 'Kegiatan'),
(64, 5, '2024-02-21', 2, 2024, 'Menyiapkan peralatan kerja. Menerima berkas/surat/paket dari Pos, penghubung & sekretaris. Membuka & memeriksa surat/berkas. Scanning surat/berkas fisik. Input surat/berkas ke Srikandi. Membuat dokumen bukti pengantaran surat/berkas. Mendistribusikan surat/berkas ke bidang sesuai dengan isi surat/berkas. Merapikan file hasil scanning surat/berkas di komputer. ', 1, 'Kegiatan'),
(65, 5, '2024-02-22', 2, 2024, 'Menyiapkan peralatan kerja. Menerima berkas/surat/paket dari Pos, penghubung & sekretaris. Membuka & memeriksa surat/berkas. Scanning surat/berkas fisik. Input surat/berkas ke Srikandi. Membuat dokumen bukti pengantaran surat/berkas. Mendistribusikan surat/berkas ke bidang sesuai dengan isi surat/berkas. Merapikan file hasil scanning surat/berkas di komputer. ', 1, 'Kegiatan'),
(66, 5, '2024-02-22', 2, 2024, 'Menyiapkan peralatan kerja. Menerima berkas/surat/paket dari Pos, penghubung & sekretaris. Membuka & memeriksa surat/berkas. Scanning surat/berkas fisik. Input surat/berkas ke Srikandi. Membuat dokumen bukti pengantaran surat/berkas. Mendistribusikan surat/berkas ke bidang sesuai dengan isi surat/berkas. Merapikan file hasil scanning surat/berkas di komputer. ', 1, 'Kegiatan'),
(67, 5, '2024-02-23', 2, 2024, 'Menyiapkan peralatan kerja. Menerima berkas/surat/paket dari Pos, penghubung & sekretaris. Membuka & memeriksa surat/berkas. Scanning surat/berkas fisik. Input surat/berkas ke Srikandi. Membuat dokumen bukti pengantaran surat/berkas. Mendistribusikan surat/berkas ke bidang sesuai dengan isi surat/berkas. Merapikan file hasil scanning surat/berkas di komputer. ', 1, 'Kegiatan'),
(68, 5, '2024-02-26', 2, 2024, 'Menyiapkan peralatan kerja. Menerima berkas/surat/paket dari Pos, penghubung & sekretaris. Membuka & memeriksa surat/berkas. Scanning surat/berkas fisik. Input surat/berkas ke Srikandi. Membuat dokumen bukti pengantaran surat/berkas. Mendistribusikan surat/berkas ke bidang sesuai dengan isi surat/berkas. Merapikan file hasil scanning surat/berkas di komputer. ', 1, 'Kegiatan'),
(69, 5, '2024-02-27', 2, 2024, 'Menyiapkan peralatan kerja. Menerima berkas/surat/paket dari Pos, penghubung & sekretaris. Membuka & memeriksa surat/berkas. Scanning surat/berkas fisik. Input surat/berkas ke Srikandi. Membuat dokumen bukti pengantaran surat/berkas. Mendistribusikan surat/berkas ke bidang sesuai dengan isi surat/berkas. Merapikan file hasil scanning surat/berkas di komputer. ', 1, 'Kegiatan'),
(70, 5, '2024-02-28', 2, 2024, 'Menyiapkan peralatan kerja. Menerima berkas/surat/paket dari Pos, penghubung & sekretaris. Membuka & memeriksa surat/berkas. Scanning surat/berkas fisik. Input surat/berkas ke Srikandi. Membuat dokumen bukti pengantaran surat/berkas. Mendistribusikan surat/berkas ke bidang sesuai dengan isi surat/berkas. Merapikan file hasil scanning surat/berkas di komputer. ', 1, 'Kegiatan'),
(71, 5, '2024-02-29', 2, 2024, 'Menyiapkan peralatan kerja. Menerima berkas/surat/paket dari Pos, penghubung & sekretaris. Membuka & memeriksa surat/berkas. Scanning surat/berkas fisik. Input surat/berkas ke Srikandi. Membuat dokumen bukti pengantaran surat/berkas. Mendistribusikan surat/berkas ke bidang sesuai dengan isi surat/berkas. Merapikan file hasil scanning surat/berkas di komputer. ', 1, 'Kegiatan'),
(72, 7, '2024-02-01', 2, 2024, 'Melakukan penginputan & pencatatan administrasi persuratan, mendigitalisasikan dokumen kantor, Melaksanakan tugas & perintah Kakanreg, Pelayanan tamu, Menerima telepon konsultasi, mengantarkan surat, koordinasi kegiatan kakanreg maupun kegiatan bidang', 1, 'Kegiatan'),
(73, 7, '2024-02-02', 2, 2024, 'SKJ, Melakukan penginputan & pencatatan administrasi persuratan, mendigitalisasikan dokumen kantor, Melaksanakan tugas & perintah Kakanreg, Pelayanan tamu, Menerima telepon konsultasi, mengantarkan surat, koordinasi kegiatan kakanreg maupun kegiatan bidang', 1, 'Kegiatan'),
(74, 7, '2024-02-05', 2, 2024, 'Melakukan penginputan & pencatatan administrasi persuratan, mendigitalisasikan dokumen kantor, Melaksanakan tugas & perintah Kakanreg, Pelayanan tamu, Menerima telepon konsultasi, mengantarkan surat, koordinasi kegiatan kakanreg maupun kegiatan bidang,  menyiapkan konsumsi', 1, 'Kegiatan'),
(75, 7, '2024-02-06', 2, 2024, 'Melakukan penginputan & pencatatan administrasi persuratan, mendigitalisasikan dokumen kantor, Melaksanakan tugas & perintah Kakanreg, Pelayanan tamu, Menerima telepon konsultasi, mengantarkan surat, koordinasi kegiatan kakanreg maupun kegiatan bidang,  menyiapkan konsumsi', 1, 'Kegiatan'),
(76, 7, '2024-02-07', 2, 2024, 'Melakukan penginputan & pencatatan administrasi persuratan, mendigitalisasikan dokumen kantor, Melaksanakan tugas & perintah Kakanreg, Pelayanan tamu, Menerima telepon konsultasi, mengantarkan surat, koordinasi kegiatan kakanreg maupun kegiatan bidang,  menyiapkan konsumsi', 1, 'Kegiatan'),
(77, 7, '2024-02-08', 2, 2024, 'Melakukan penginputan & pencatatan administrasi persuratan, mendigitalisasikan dokumen kantor, Melaksanakan tugas & perintah Kakanreg, Pelayanan tamu, Menerima telepon konsultasi, mengantarkan surat, koordinasi kegiatan kakanreg maupun kegiatan bidang,  menyiapkan konsumsi', 1, 'Kegiatan'),
(78, 7, '2024-02-09', 2, 2024, 'SKJ, Melakukan penginputan & pencatatan administrasi persuratan, mendigitalisasikan dokumen kantor, Melaksanakan tugas & perintah Kakanreg, Pelayanan tamu, Menerima telepon konsultasi, mengantarkan surat, koordinasi kegiatan kakanreg maupun kegiatan bidang,  menyiapkan konsumsi', 1, 'Kegiatan'),
(79, 7, '2024-02-12', 2, 2024, 'Melakukan penginputan & pencatatan administrasi persuratan, mendigitalisasikan dokumen kantor, Melaksanakan tugas & perintah Kakanreg, Pelayanan tamu, Menerima telepon konsultasi, mengantarkan surat, koordinasi kegiatan kakanreg maupun kegiatan bidang,  menyiapkan konsumsi', 1, 'Kegiatan'),
(80, 7, '2024-02-13', 2, 2024, 'Melakukan penginputan & pencatatan administrasi persuratan, mendigitalisasikan dokumen kantor, Melaksanakan tugas & perintah Kakanreg, Pelayanan tamu, Menerima telepon konsultasi, mengantarkan surat, koordinasi kegiatan kakanreg maupun kegiatan bidang,  menyiapkan konsumsi', 1, 'Kegiatan'),
(81, 7, '2024-02-15', 2, 2024, 'Melakukan penginputan & pencatatan administrasi persuratan, mendigitalisasikan dokumen kantor, Melaksanakan tugas & perintah Kakanreg, Pelayanan tamu, Menerima telepon konsultasi, mengantarkan surat, koordinasi kegiatan kakanreg maupun kegiatan bidang,  menyiapkan konsumsi', 1, 'Kegiatan'),
(82, 7, '2024-02-03', 2, 2024, 'Pengarahan oleh Plt. Kepala Subbagian Umum kepada seluruh PPNPN Kanreg I berkaitan dengan potongan Bpjs Tenagakerja dan evaluasi kinerja Ppnpn', 1, 'Kegiatan'),
(83, 7, '2024-02-16', 2, 2024, 'SKJ, Melakukan penginputan & pencatatan administrasi persuratan, mendigitalisasikan dokumen kantor, Melaksanakan tugas & perintah Kakanreg, Pelayanan tamu, Menerima telepon konsultasi, mengantarkan surat, koordinasi kegiatan kakanreg maupun kegiatan bidang,  menyiapkan konsumsi', 1, 'Kegiatan'),
(84, 7, '2024-02-19', 2, 2024, 'Melakukan penginputan & pencatatan administrasi persuratan, mendigitalisasikan dokumen kantor, Melaksanakan tugas & perintah Kakanreg, Pelayanan tamu, Menerima telepon konsultasi, mengantarkan surat, koordinasi kegiatan kakanreg maupun kegiatan bidang,  menyiapkan konsumsi', 1, 'Kegiatan'),
(85, 7, '2024-02-20', 2, 2024, 'Melakukan penginputan & pencatatan administrasi persuratan, mendigitalisasikan dokumen kantor, Melaksanakan tugas & perintah Kakanreg, Pelayanan tamu, Menerima telepon konsultasi, mengantarkan surat, koordinasi kegiatan kakanreg maupun kegiatan bidang,  menyiapkan konsumsi', 1, 'Kegiatan'),
(86, 5, '2024-02-29', 2, 2024, 'Menyiapkan peralatan kerja. Menerima berkas/surat/paket dari Pos, penghubung & sekretaris. Membuka & memeriksa surat/berkas. Scanning surat/berkas fisik. Input surat/berkas ke Srikandi. Membuat dokumen bukti pengantaran surat/berkas. Mendistribusikan surat/berkas ke bidang sesuai dengan isi surat/berkas. Merapikan file hasil scanning surat/berkas di komputer. ', 1, 'Kegiatan'),
(87, 7, '2024-02-19', 2, 2024, 'Melakukan penginputan & pencatatan administrasi persuratan, mendigitalisasikan dokumen kantor, Melaksanakan tugas & perintah Kakanreg, Pelayanan tamu, Menerima telepon konsultasi, mengantarkan surat, koordinasi kegiatan kakanreg maupun kegiatan bidang,  menyiapkan konsumsi', 1, 'Kegiatan'),
(88, 3, '2024-02-20', 2, 2024, 'Mencoba tes debugging aplikasi Elapin', 1, 'Kegiatan'),
(89, 3, '2024-02-21', 2, 2024, 'Membuat menu dashboard admin untuk aplikasi E-Lapin', 1, 'Kegiatan'),
(90, 5, '2024-02-13', 2, 2024, 'Mengganti/memasang Backdrop di panggung Sasono Panggih Ageng', 1, 'Kegiatan'),
(91, 3, '2024-02-22', 2, 2024, 'Melanjutkan Aplikasi E-lapin', 1, 'Kegiatan'),
(92, 3, '2024-02-23', 2, 2024, 'Membuat page admin pada aplikasi E-Lapin', 1, 'Kegiatan'),
(93, 3, '2024-02-26', 2, 2024, 'Melanjutkan edit page admin aplikasi elapin', 1, 'Kegiatan'),
(94, 7, '2024-02-21', 2, 2024, 'Melakukan penginputan & pencatatan administrasi persuratan, mendigitalisasikan dokumen kantor, Melaksanakan tugas & perintah Kakanreg, Pelayanan tamu, Menerima telepon konsultasi, mengantarkan surat, koordinasi kegiatan kakanreg maupun kegiatan bidang,  menyiapkan konsumsi', 1, 'Kegiatan'),
(95, 7, '2024-02-22', 2, 2024, 'Melakukan penginputan & pencatatan administrasi persuratan, mendigitalisasikan dokumen kantor, Melaksanakan tugas & perintah Kakanreg, Pelayanan tamu, Menerima telepon konsultasi, mengantarkan surat, koordinasi kegiatan kakanreg maupun kegiatan bidang,  menyiapkan konsumsi', 1, 'Kegiatan'),
(96, 7, '2024-02-23', 2, 2024, 'SKJ, Melakukan penginputan & pencatatan administrasi persuratan, mendigitalisasikan dokumen kantor, Melaksanakan tugas & perintah Kakanreg, Pelayanan tamu, Menerima telepon konsultasi, mengantarkan surat, koordinasi kegiatan kakanreg maupun kegiatan bidang,  menyiapkan konsumsi', 1, 'Kegiatan'),
(97, 96, '2024-02-23', 2, 2024, 'SKJ Melakukan penginputan & pencatatan administrasi persuratan, mendigitalisasikan dokumen kantor, Melaksanakan tugas & perintah Kakanreg, Pelayanan tamu, Menerima telepon konsultasi, mengantarkan surat, koordinasi kegiatan kakanreg maupun kegiatan bidang,  menyiapkan konsumsi', 1, 'Kegiatan'),
(98, 96, '2024-02-23', 2, 2024, 'SKJ, Melakukan penginputan & pencatatan administrasi persuratan, mendigitalisasikan dokumen kantor, Melaksanakan tugas & perintah Kakanreg, Pelayanan tamu, Menerima telepon konsultasi, mengantarkan surat, koordinasi kegiatan kakanreg maupun kegiatan bidang,  menyiapkan konsumsi', 1, 'Kegiatan'),
(99, 7, '2024-02-26', 2, 2024, 'Melakukan penginputan & pencatatan administrasi persuratan, mendigitalisasikan dokumen kantor, Melaksanakan tugas & perintah Kakanreg, Pelayanan tamu, Menerima telepon konsultasi, mengantarkan surat, koordinasi kegiatan kakanreg maupun kegiatan bidang,  menyiapkan konsumsi', 1, 'Kegiatan'),
(100, 7, '2024-02-27', 2, 2024, 'Melakukan penginputan & pencatatan administrasi persuratan, mendigitalisasikan dokumen kantor, Melaksanakan tugas & perintah Kakanreg, Pelayanan tamu, Menerima telepon konsultasi, mengantarkan surat, koordinasi kegiatan kakanreg maupun kegiatan bidang,  menyiapkan konsumsi', 1, 'Kegiatan'),
(101, 7, '2024-02-28', 2, 2024, 'Melakukan penginputan & pencatatan administrasi persuratan, mendigitalisasikan dokumen kantor, Melaksanakan tugas & perintah Kakanreg, Pelayanan tamu, Menerima telepon konsultasi, mengantarkan surat, koordinasi kegiatan kakanreg maupun kegiatan bidang,  menyiapkan konsumsi', 1, 'Kegiatan'),
(102, 7, '2024-02-29', 2, 2024, 'Melakukan penginputan & pencatatan administrasi persuratan, mendigitalisasikan dokumen kantor, Melaksanakan tugas & perintah Kakanreg, Pelayanan tamu, Menerima telepon konsultasi, mengantarkan surat, koordinasi kegiatan kakanreg maupun kegiatan bidang,  menyiapkan konsumsi', 1, 'Kegiatan'),
(103, 73, '2024-02-02', 2, 2024, 'SKJ, Melakukan penginputan & pencatatan administrasi persuratan, mendigitalisasikan dokumen kantor, Melaksanakan tugas & perintah Kakanreg, Pelayanan tamu, Menerima telepon konsultasi, mengantarkan surat, koordinasi kegiatan kakanreg maupun kegiatan bidang', 1, 'Kegiatan'),
(104, 78, '2024-02-09', 2, 2024, 'SKJ, Melakukan penginputan & pencatatan administrasi persuratan, mendigitalisasikan dokumen kantor, Melaksanakan tugas & perintah Kakanreg, Pelayanan tamu, Menerima telepon konsultasi, mengantarkan surat, koordinasi kegiatan kakanreg maupun kegiatan bidang,  menyiapkan konsumsi', 1, 'Kegiatan'),
(105, 83, '2024-02-16', 2, 2024, 'SKJ, Melakukan penginputan & pencatatan administrasi persuratan, mendigitalisasikan dokumen kantor, Melaksanakan tugas & perintah Kakanreg, Pelayanan tamu, Menerima telepon konsultasi, mengantarkan surat, koordinasi kegiatan kakanreg maupun kegiatan bidang,  menyiapkan konsumsi', 1, 'Kegiatan'),
(106, 3, '2024-02-27', 2, 2024, 'Melanjutkan aplikasi absensi dan laporan untuk ppnpn', 1, 'Kegiatan'),
(107, 3, '2024-02-28', 2, 2024, 'Dokumentasi Coaching klinik SIASN ', 1, 'Kegiatan'),
(108, 3, '2024-02-28', 2, 2024, 'Melanjutkan pembuatan aplikasi dan absensi ppnpn', 1, 'Kegiatan'),
(109, 3, '2024-02-29', 2, 2024, 'Dokumentasi penyerahan hasil pemetaan dan kompetensi Grobogan oleh Kepala Kantor Regional I BKN', 1, 'Kegiatan'),
(110, 3, '2024-02-29', 2, 2024, 'Menyiapkan acara dan Dokumentasi Kegiatan  Capacity Building kab. Grobogan', 2, 'Kegiatan'),
(112, 3, '2024-02-29', 2, 2024, 'Posting berita di Sosmed Kantor Regional I BKN Yogyakarta', 1, 'Kegiatan');

-- --------------------------------------------------------


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

  
--
-- Dumping data untuk tabel `lap_bulanan`
--

INSERT INTO `lap_bulanan` (`id_lapbul`, `id_peg`, `bulan`, `tahun`, `jumlah_kegiatan`, `status1`, `status2`) VALUES
(1, 3, 1, 2024, 23, 0, 0),
(2, 7, 2, 2024, 22, 0, 0),
(3, 3, 2, 2024, 23, 0, 0),
(4, 3, 1, 2024, 20, 0, 0);

-- --------------------------------------------------------


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
('2', 'Rumah Dinas', 'Jl. Gedongkuning, Rejowinangun, Kec. Kotagede, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55171', '-7.814661,110.4016561', '2000'),
('3', 'Limasan', 'Sidokarto, Godean, Sleman Regency, Special Region of Yogyakarta 55264', '-7.7857569,110.302588', '2000');

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
  `id_absen` int(10) NOT NULL,
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


--
-- Dumping data untuk tabel `absensi`
--
INSERT INTO `absensi` (`id_absen`, `id_peg`, `id_kantor`, `id_shift`, `tgl_datang`, `tgl_pulang`, `jam_datang`, `jam_pulang`, `foto_datang`, `foto_pulang`, `status_datang`, `status_pulang`, `latlong_datang`, `latlong_pulang`, `keterangan`, `jumlah_jam_kerja`) VALUES
(1, 3, 1, 1, '2024-02-15', '2024-02-15', '12:47:45', '16:01:09', 'dimas_datang15022024124745.png', 'dimas_pulang15022024160109.png', 'Telat 318 menit', 'Tepat Waktu', '-7.7386381,110.3641078', '-7.7389769,110.3643649', '', 3),
(2, 3, 1, 1, '2024-02-16', '2024-02-27', '10:20:32', '16:09:56', 'dimas_datang16022024102032.png', 'Azolla_pulang27022024160956.png', 'Telat 171 menit', 'Tepat Waktu', '-7.7386092,110.3641113', '-7.7390396,110.3641186', '', 9),
(3, 3, 1, 1, '2024-02-19', '2024-02-19', '07:24:55', '16:01:07', 'dimas_datang19022024072455.png', 'dimas_pulang19022024160107.png', 'Tepat Waktu', 'Tepat Waktu', '-7.7385097,110.3643342', '-7.7386817,110.3640983', '', 9),
(4, 3, 1, 1, '2024-02-20', '2024-02-20', '07:13:52', '16:04:24', 'dimas_datang20022024071352.png', 'dimas_pulang20022024160424.png', 'Tepat Waktu', 'Tepat Waktu', '-7.7386374,110.3641065', '-7.7386607,110.3641079', '', 9),
(5, 6, 1, 1, '2024-02-20', '0000-00-00', '08:41:39', '00:00:00', 'Sidiq_datang20022024084139.png', '', 'Telat 72 menit', '', '-7.7387054,110.3640912', '', '', 0),
(6, 6, 1, 1, '2024-02-21', '2024-02-27', '06:57:56', '16:09:56', 'Sidiq_datang21022024065756.png', 'Azolla_pulang27022024160956.png', 'Tepat Waktu', 'Tepat Waktu', '-7.7391452,110.3627181', '-7.7390396,110.3641186', '', 9),
(7, 3, 1, 1, '2024-02-21', '2024-02-21', '07:27:44', '16:05:03', 'dimas_datang21022024072744.png', 'dimas_pulang21022024160503.png', 'Tepat Waktu', 'Tepat Waktu', '-7.738965,110.3643757', '-7.7389113,110.3643746', '', 9),
(8, 6, 1, 1, '2024-02-22', '0000-00-00', '07:01:37', '00:00:00', 'Sidiq_datang22022024070137.png', '', 'Tepat Waktu', '', '-7.738712,110.3640919', '', '', 0),
(9, 3, 1, 1, '2024-02-22', '2024-02-22', '07:10:49', '16:02:16', 'dimas_datang22022024071049.png', 'dimas_pulang22022024160216.png', 'Tepat Waktu', 'Tepat Waktu', '-7.7389557,110.3644106', '-7.7387079,110.3640912', '', 9),
(10, 3, 1, 1, '2024-02-23', '2024-02-23', '07:06:20', '16:11:24', 'dimas_datang23022024070620.png', 'dimas_pulang23022024161124.png', 'Tepat Waktu', 'Tepat Waktu', '-7.738673,110.364103', '-7.7388634,110.3643423', '', 9),
(11, 6, 1, 1, '2024-02-23', '0000-00-00', '07:08:02', '00:00:00', 'Sidiq_datang23022024070802.png', '', 'Tepat Waktu', '', '-7.7386995,110.3640912', '', '', 0),
(12, 9, 1, 1, '2024-02-23', '0000-00-00', '15:46:40', '00:00:00', 'Fransiscatrigiasmi_datang23022024154640.png', '', 'Telat 497 menit', '', '-7.7389198,110.3640788', '', '', 0),
(13, 3, 1, 1, '2024-02-26', '2024-02-26', '07:25:24', '16:01:49', 'dimas_datang26022024072524.png', 'dimas_pulang26022024160149.png', 'Tepat Waktu', 'Tepat Waktu', '-7.73861,110.3641209', '-7.7387091,110.3641712', '', 9),
(14, 7, 1, 1, '2024-02-26', '0000-00-00', '08:36:00', '00:00:00', 'Azolla_datang26022024083600.png', '', 'Telat 66 menit', '', '-7.7390549,110.364112', '', '', 0),
(15, 7, 1, 1, '2024-02-27', '2024-02-27', '07:05:20', '16:09:56', 'Azolla_datang27022024070520.png', 'Azolla_pulang27022024160956.png', 'Tepat Waktu', 'Tepat Waktu', '-7.7390173,110.3641182', '-7.7390396,110.3641186', '', 9),
(16, 5, 1, 1, '2024-02-27', '0000-00-00', '07:08:06', '00:00:00', 'iswan19_datang27022024070806.png', '', 'Tepat Waktu', '', '-7.7393349,110.3644964', '', '', 0),
(17, 3, 1, 1, '2024-02-27', '2024-02-27', '07:08:51', '16:02:40', 'dimas_datang27022024070851.png', 'dimas_pulang27022024160240.png', 'Tepat Waktu', 'Tepat Waktu', '-7.7388699,110.3646367', '-7.7388427,110.3643192', '', 9),
(18, 6, 1, 1, '2024-02-28', '0000-00-00', '06:56:13', '00:00:00', 'Sidiq_datang28022024065613.png', '', 'Tepat Waktu', '', '-7.7382344,110.3639067', '', '', 0),
(19, 7, 1, 1, '2024-02-28', '0000-00-00', '07:05:48', '00:00:00', 'Azolla_datang28022024070548.png', '', 'Tepat Waktu', '', '-7.7390047,110.3641202', '', '', 0),
(20, 3, 1, 1, '2024-02-28', '2024-02-28', '07:09:00', '16:02:10', 'dimas_datang28022024070900.png', 'dimas_pulang28022024160210.png', 'Tepat Waktu', 'Tepat Waktu', '-7.7389918,110.3643754', '-7.7388576,110.364323', '', 9),
(21, 6, 1, 1, '2024-02-29', '0000-00-00', '07:24:09', '00:00:00', 'Sidiq_datang29022024072409.png', '', 'Tepat Waktu', '', '-7.7387497,110.3641115', '', '', 0),
(22, 3, 1, 1, '2024-02-29', '0000-00-00', '07:27:43', '00:00:00', 'dimas_datang29022024072743.png', '', 'Tepat Waktu', '', '-7.7389811,110.3643632', '', '', 0);

-- --------------------------------------------------------