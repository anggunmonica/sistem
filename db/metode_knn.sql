-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Agu 2023 pada 15.24
-- Versi server: 10.4.19-MariaDB
-- Versi PHP: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `metode_knn`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `akun`
--

CREATE TABLE `akun` (
  `kode_akun` char(20) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `level` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `akun`
--

INSERT INTO `akun` (`kode_akun`, `nama_lengkap`, `username`, `password`, `level`) VALUES
('adm01', 'Dimas Rukmana', 'dimas', '123321', 'persediaan'),
('adm03', 'Retno', 'retno', '212321', 'admin'),
('adm04', 'Ari teguh', 'ari', '1234543', 'persediaan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `alternatif`
--

CREATE TABLE `alternatif` (
  `kode_alternatif` char(30) NOT NULL,
  `nama_alternatif` varchar(50) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `distance` double NOT NULL,
  `rangking` int(20) NOT NULL,
  `nilaik` int(50) NOT NULL,
  `tindakan` varchar(50) NOT NULL,
  `alat` varchar(100) NOT NULL,
  `keterangan_alat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `alternatif`
--

INSERT INTO `alternatif` (`kode_alternatif`, `nama_alternatif`, `keterangan`, `distance`, `rangking`, `nilaik`, `tindakan`, `alat`, `keterangan_alat`) VALUES
('A01', 'Ganggren Pulpa', 'Menurun', 490.07448413481, 10, 0, 'Pengobatan', 'Bengkok, kaca mulut, pinset, sonde.', 'Lengkap'),
('A02', 'Persistensi', 'Menurun', 69.634761434215, 4, 0, 'Pengobatan', 'Bengkok, kaca mulut, sonde, pinset.', 'Lengkap'),
('A03', 'Bukoversi', 'Menurun', 35.185224171518, 3, 0, 'Pencabutan Gigi Terpendam', 'Syringe, enjector, rontgen, intra oral camera.', 'Tidak Lengkap'),
('A04', 'Karies Media', 'Meningkat', 166.29191201018, 9, 0, 'Penambalan', 'Bengkok, kaca mulut, sonde, pinset, plastis filling, bur gigi, ekskavator, light curing, suction.', 'Lengkap'),
('A05', 'Impacted', 'Meningkat', 141.27986409959, 8, 0, 'Pencabutan Gigi Terpendam', 'Syringe, enjector, rontgen, intra oral camera.', 'Tidak Lengkap'),
('A06', 'Mobility', 'Menurun', 25.961509971494, 2, 0, 'Cabut gigi', 'Syringe, enjector, intra oral camera.', 'Tidak Lengkap'),
('A07', 'Odontolus', 'Menurun', 7.6157731058639, 1, 0, 'Pencabutan Gigi Terpendam', 'Syringe, enjector, rontgen, intra oral camera.', 'Tidak Lengkap'),
('A08', 'Pulpitis', 'Meningkat', 118.98739429032, 6, 0, 'Pencabutan Gigi Terpendam', 'Syringe, enjector, rontgen, intra oral camera.', 'Tidak Lengkap'),
('A09', 'Abses', 'Meningkat', 136.30113719261, 7, 0, 'Pengobatan', 'Bengkok, kaca mulut, sonde, pinset.', 'Lengkap'),
('A10', 'Radix', 'Menurun', 78.032044699598, 5, 0, 'Pencabutan Gigi Terpendam', 'Syringe, enjector, rontgen, intra oral camera.', 'Tidak Lengkap');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE `kriteria` (
  `kode_kriteria` char(30) NOT NULL,
  `nama_kriteria` varchar(50) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`kode_kriteria`, `nama_kriteria`, `keterangan`) VALUES
('K01', 'Jumlah Pasien Tahun 2020', 'Meningkat'),
('k02', 'Jumlah Pasien Tahun 2021', 'Meningkat'),
('k03', 'Jumlah Pasien Tahun 2022', 'Meningkat');

-- --------------------------------------------------------

--
-- Struktur dari tabel `subkriteria`
--

CREATE TABLE `subkriteria` (
  `kode_subkriteria` char(30) NOT NULL,
  `nama_subkriteria` varchar(50) NOT NULL,
  `kode_kriteria` char(30) NOT NULL,
  `nilai_subkriteria` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `subkriteria`
--

INSERT INTO `subkriteria` (`kode_subkriteria`, `nama_subkriteria`, `kode_kriteria`, `nilai_subkriteria`) VALUES
('S01', 'Jumlah Pasien Ganggren Pulpa Tahun 2020', 'K01', 466),
('S02', 'Jumlah Pasien Persistensi Tahun 2020', 'K01', 48),
('S03', 'Jumlah Pasien Bukoversi Tahun 2020', 'K01', 33),
('S04', 'Jumlah Pasien Karies Media Tahun 2020', 'K01', 22),
('S05', 'Jumlah Pasien Impacted Tahun 2020', 'K01', 60),
('S06', 'Jumlah Pasien Mobility Tahun 2020', 'K01', 23),
('S07', 'Jumlah Pasien Odontolus Tahun 2020', 'K01', 7),
('S08', 'Jumlah Pasien Pulpitis Tahun 2020', 'K01', 39),
('S09', 'Jumlah Pasien Abses Tahun 2020', 'K01', 64),
('S10', 'Jumlah Pasien Radix Tahun 2020', 'K01', 74),
('S11', 'Jumlah Pasien Ganggren Pulpa Tahun 2021', 'k02', 141),
('S12', 'Jumlah Pasien Persistensi Tahun 2021', 'k02', 39),
('S13', 'Jumlah Pasien Bukoversi Tahun 2021', 'k02', 10),
('S14', 'Jumlah Pasien Karies Media Tahun 2021', 'k02', 87),
('S15', 'Jumlah Pasien Impacted Tahun 2021', 'k02', 114),
('S16', 'Jumlah Pasien Mobility Tahun 2021', 'k02', 9),
('S17', 'Jumlah Pasien Odontolus Tahun 2021', 'k02', 3),
('S18', 'Jumlah Pasien Pulpitis Tahun 2021', 'k02', 66),
('S19', 'Jumlah Pasien Abses Tahun 2021', 'k02', 89),
('S20', 'Jumlah Pasien Radix Tahun 2021', 'k02', 18),
('S21', 'Jumlah Pasien Ganggren Pulpa Tahun 2022', 'k03', 56),
('S22', 'Jumlah Pasien Persistensi Tahun 2022', 'k03', 32),
('S23', 'Jumlah Pasien Bukoversi Tahun 2022', 'k03', 7),
('S24', 'Jumlah Pasien Karies Media Tahun 2022', 'k03', 140),
('S25', 'Jumlah Pasien Impacted Tahun 2022', 'k03', 58),
('S26', 'Jumlah Pasien Mobility Tahun 2022', 'k03', 8),
('S27', 'Jumlah Pasien Odontolus Tahun 2022', 'k03', 0),
('S28', 'Jumlah Pasien Pulpitis Tahun 2022', 'k03', 91),
('S29', 'Jumlah Pasien Abses Tahun 2022', 'k03', 81),
('S30', 'Jumlah Pasien Radix Tahun 2022', 'k03', 17),
('S31', 'Jumlah Pasien Calculus Tahun 2020', 'K01', 10),
('S32', 'Jumlah Pasien Calculus Tahun 2021', 'k02', 3),
('S33', 'Jumlah Pasien Calculus Tahun 2022', 'k03', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `testing`
--

CREATE TABLE `testing` (
  `kode_testing` int(20) NOT NULL,
  `kode_alternatif` char(50) NOT NULL,
  `nama_alternatif` varchar(50) NOT NULL,
  `kode_kriteria` char(50) NOT NULL,
  `nilai_testing` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `testing`
--

INSERT INTO `testing` (`kode_testing`, `kode_alternatif`, `nama_alternatif`, `kode_kriteria`, `nilai_testing`) VALUES
(217, 'A01', 'Calculus', 'K01', 10),
(218, 'A01', 'Calculus', 'k02', 3),
(219, 'A01', 'Calculus', 'k03', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `training`
--

CREATE TABLE `training` (
  `kode_training` int(40) NOT NULL,
  `kode_alternatif` char(30) NOT NULL,
  `kode_kriteria` char(30) NOT NULL,
  `kode_subkriteria` char(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `training`
--

INSERT INTO `training` (`kode_training`, `kode_alternatif`, `kode_kriteria`, `kode_subkriteria`) VALUES
(595, 'A01', 'K01', 'S01'),
(596, 'A01', 'k02', 'S11'),
(597, 'A01', 'k03', 'S21'),
(598, 'A02', 'K01', 'S02'),
(599, 'A02', 'k02', 'S12'),
(600, 'A02', 'k03', 'S22'),
(601, 'A03', 'K01', 'S03'),
(602, 'A03', 'k02', 'S13'),
(603, 'A03', 'k03', 'S23'),
(604, 'A04', 'K01', 'S04'),
(605, 'A04', 'k02', 'S14'),
(606, 'A04', 'k03', 'S24'),
(607, 'A05', 'K01', 'S05'),
(608, 'A05', 'k02', 'S15'),
(609, 'A05', 'k03', 'S25'),
(610, 'A06', 'K01', 'S06'),
(611, 'A06', 'k02', 'S16'),
(612, 'A06', 'k03', 'S26'),
(613, 'A07', 'K01', 'S07'),
(614, 'A07', 'k02', 'S17'),
(615, 'A07', 'k03', 'S27'),
(616, 'A08', 'K01', 'S08'),
(617, 'A08', 'k02', 'S18'),
(618, 'A08', 'k03', 'S28'),
(619, 'A09', 'K01', 'S09'),
(620, 'A09', 'k02', 'S19'),
(621, 'A09', 'k03', 'S29'),
(622, 'A10', 'K01', 'S10'),
(623, 'A10', 'k02', 'S20'),
(624, 'A10', 'k03', 'S30');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`kode_akun`);

--
-- Indeks untuk tabel `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`kode_alternatif`);

--
-- Indeks untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`kode_kriteria`);

--
-- Indeks untuk tabel `subkriteria`
--
ALTER TABLE `subkriteria`
  ADD PRIMARY KEY (`kode_subkriteria`);

--
-- Indeks untuk tabel `testing`
--
ALTER TABLE `testing`
  ADD PRIMARY KEY (`kode_testing`);

--
-- Indeks untuk tabel `training`
--
ALTER TABLE `training`
  ADD PRIMARY KEY (`kode_training`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `testing`
--
ALTER TABLE `testing`
  MODIFY `kode_testing` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=220;

--
-- AUTO_INCREMENT untuk tabel `training`
--
ALTER TABLE `training`
  MODIFY `kode_training` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=625;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
