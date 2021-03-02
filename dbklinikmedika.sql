-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 18 Feb 2021 pada 14.38
-- Versi Server: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dbklinikmedika`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_admin`
--

CREATE TABLE IF NOT EXISTS `tb_admin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `kode_admin` varchar(20) NOT NULL,
  `nama_admin` varchar(100) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `role` varchar(50) NOT NULL COMMENT 'Admin,Pimpinan,SuperAdmin',
  `create_date` datetime NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `view_password` varchar(50) NOT NULL,
  `profile_image` varchar(50) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `kode_admin`, `nama_admin`, `jenis_kelamin`, `role`, `create_date`, `username`, `password`, `view_password`, `profile_image`, `status`) VALUES
(1, 'ADM-0001', 'Adminstrator', 'L', 'SuperAdmin', '2021-02-07 22:33:24', 'admin', '$2y$10$d/fy7Oo2HJTfwaT1.Q7jLe468jINC1D.pJFmFvnEnqxzu4l32jQJ.', 'admin', '', 0),
(2, 'ADM-0002', 'AdminUser', 'L', 'Admin', '2021-02-07 22:34:12', 'adminuser', '$2y$10$MElhD.zs/D6UuDQjss61iOpNhCu0aDJOuufsHTSATzLW65kwWqNve', 'adminuser', '', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_barang`
--

CREATE TABLE IF NOT EXISTS `tb_barang` (
  `id_barang` int(11) NOT NULL AUTO_INCREMENT,
  `kode_barang` varchar(20) NOT NULL,
  `id_kategori` int(5) NOT NULL,
  `id_satuan` int(5) NOT NULL,
  `nama_barang` varchar(150) NOT NULL,
  `aturan_pakai` varchar(100) NOT NULL,
  `harga_jual` decimal(10,0) NOT NULL,
  `jumlah_stok` int(11) NOT NULL,
  `tanggal_input` datetime NOT NULL,
  `status` int(1) NOT NULL COMMENT '0=AKTIF 1=NON AKTIF',
  PRIMARY KEY (`id_barang`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data untuk tabel `tb_barang`
--

INSERT INTO `tb_barang` (`id_barang`, `kode_barang`, `id_kategori`, `id_satuan`, `nama_barang`, `aturan_pakai`, `harga_jual`, `jumlah_stok`, `tanggal_input`, `status`) VALUES
(1, 'OBT-001', 8, 4, 'MEFINAL 500 MG', 'Dikonsumsi sesudah makan.', '42400', 100, '2021-01-16 20:20:09', 0),
(3, 'OBT-003', 8, 4, 'ASAM MEFENAMAT 500 MG', 'Diberikan sesudah makan atau bersama dengan makan', '2300', 17, '2021-01-17 12:21:02', 0),
(4, 'OBT-004', 8, 4, 'CATAFLAM 50 MG', 'Sesudah makan', '64200', 10, '2021-01-17 13:51:39', 0),
(5, 'OBT-005', 11, 4, 'NEURALGIN RX', 'Sesudah makan', '24400', 45, '2021-01-17 18:28:41', 0),
(6, 'OBT-006', 11, 4, 'QWEQ', '', '0', 0, '2021-01-31 11:48:36', 1),
(7, 'OBT-006', 7, 4, 'RHINOS SR', 'Diminum sebelum atau sesudah makan', '59800', 197, '2021-02-04 18:47:54', 0),
(8, 'OBT-007', 7, 4, 'TREMENZA', 'Sesudah makan', '15800', 136, '2021-02-04 19:20:34', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_barang_masuk`
--

CREATE TABLE IF NOT EXISTS `tb_barang_masuk` (
  `id_barang_masuk` int(11) NOT NULL AUTO_INCREMENT,
  `no_transaksi` varchar(20) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `create_date` datetime NOT NULL,
  `status` int(1) NOT NULL COMMENT '0=AKTIF 1=NON AKTIF',
  PRIMARY KEY (`id_barang_masuk`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data untuk tabel `tb_barang_masuk`
--

INSERT INTO `tb_barang_masuk` (`id_barang_masuk`, `no_transaksi`, `id_supplier`, `tanggal_masuk`, `create_date`, `status`) VALUES
(1, 'BM-0121-000001', 3, '2021-01-21', '2021-01-21 13:58:53', 0),
(2, 'BM-0121-000002', 3, '2021-01-20', '2021-01-21 13:59:25', 0),
(3, 'BM-0121-000003', 3, '2021-01-19', '2021-01-21 13:59:52', 0),
(4, 'BM-0121-000004', 2, '2021-01-25', '2021-01-25 11:22:02', 0),
(5, 'BM-0121-000005', 2, '2021-01-25', '2021-01-25 18:31:49', 0),
(6, 'BM-0221-000006', 2, '2021-02-04', '2021-02-04 18:57:06', 0),
(7, 'BM-0221-000007', 2, '2021-02-04', '2021-02-04 18:59:56', 0),
(8, 'BM-0221-00008', 2, '2021-02-04', '2021-02-04 19:02:20', 0),
(9, 'BM-0221-00009', 2, '2021-02-04', '2021-02-04 19:25:35', 0),
(10, 'BM-0221-00010', 3, '2021-02-08', '2021-02-08 19:43:51', 0),
(11, 'BM-0221-00011', 2, '2021-02-08', '2021-02-08 20:31:19', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_daftar_pasien`
--

CREATE TABLE IF NOT EXISTS `tb_daftar_pasien` (
  `id_daftar_pasien` int(11) NOT NULL AUTO_INCREMENT,
  `no_rekam_medik` varchar(20) NOT NULL,
  `nama_pasien` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `golongan_darah` varchar(10) NOT NULL,
  `alamat_pasien` varchar(150) NOT NULL,
  `no_telepon` varchar(20) NOT NULL,
  `tanggal_daftar` date NOT NULL,
  `create_date` datetime NOT NULL,
  PRIMARY KEY (`id_daftar_pasien`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data untuk tabel `tb_daftar_pasien`
--

INSERT INTO `tb_daftar_pasien` (`id_daftar_pasien`, `no_rekam_medik`, `nama_pasien`, `tanggal_lahir`, `jenis_kelamin`, `golongan_darah`, `alamat_pasien`, `no_telepon`, `tanggal_daftar`, `create_date`) VALUES
(1, 'RM-0010121', 'Alexander Pierce', '1980-05-23', 'L', 'AB', 'Dummy Address Lorem Ipsum Sit Amet', '08675848883', '2021-01-28', '2021-01-29 19:32:10'),
(2, 'RM-0020121', 'James bond', '1989-07-20', 'L', 'o', 'California', '08978765464', '2021-01-28', '2021-01-30 09:10:02'),
(3, 'RM-0030121', 'Covid Taria', '1989-01-01', 'P', 'B', 'Wuhan', '064343452', '2021-01-28', '2021-01-30 09:11:42'),
(4, 'RM-0040121', 'Jaga jarak', '1989-01-30', 'L', 'AB', 'Dimana saja', '0987545433', '2021-01-28', '2021-01-30 10:08:23'),
(5, 'RM-0050121', 'Sosial Distancing', '1989-01-27', 'P', 'B', 'Protokol kesehatan', '06785645634', '2021-01-28', '2021-01-30 10:09:44'),
(6, 'RM-0060121', 'Cuci tangan', '1960-01-01', 'L', 'A', 'Pake sabun', '078563453453', '2021-01-28', '2021-01-30 10:10:27'),
(7, 'RM-0070121', 'Jas hujan', '1980-01-13', 'L', '-', 'Jakarta', '067567453434', '2021-01-28', '2021-01-30 14:25:24'),
(8, 'RM-0080121', 'Aril muah', '1987-01-06', 'L', '-', 'Bandung', '4234234231', '2021-01-28', '2021-01-30 14:26:00'),
(9, 'RM-0090121', 'Sinopak', '1990-01-07', 'L', 'AB', 'Wuhan', '098492428234', '2021-01-31', '2021-01-31 10:44:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_daftar_periksa`
--

CREATE TABLE IF NOT EXISTS `tb_daftar_periksa` (
  `id_daftar_periksa` int(11) NOT NULL AUTO_INCREMENT,
  `no_registrasi` varchar(20) NOT NULL,
  `id_daftar_pasien` int(11) NOT NULL,
  `id_detail_praktek` int(11) NOT NULL,
  `jam_daftar` time NOT NULL,
  `no_antrian` int(3) unsigned zerofill NOT NULL,
  `tanggal` date NOT NULL,
  `status_daftar` int(11) NOT NULL COMMENT '0=MENUNGGU 1=PROSES 2=PENDING 3=SELESAI',
  PRIMARY KEY (`id_daftar_periksa`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data untuk tabel `tb_daftar_periksa`
--

INSERT INTO `tb_daftar_periksa` (`id_daftar_periksa`, `no_registrasi`, `id_daftar_pasien`, `id_detail_praktek`, `jam_daftar`, `no_antrian`, `tanggal`, `status_daftar`) VALUES
(1, 'REG-0121-0001', 1, 13, '19:32:10', 001, '2021-01-28', 3),
(2, 'REG-0121-0002', 2, 10, '09:10:02', 001, '2021-01-28', 3),
(3, 'REG-0121-0003', 3, 11, '09:11:42', 001, '2021-01-28', 3),
(4, 'REG-0121-0004', 4, 13, '10:08:23', 002, '2021-01-28', 3),
(5, 'REG-0121-0005', 5, 12, '10:09:44', 001, '2021-01-28', 3),
(6, 'REG-0121-0006', 6, 12, '10:10:27', 002, '2021-01-28', 3),
(7, 'REG-0121-0007', 7, 10, '14:25:24', 002, '2021-01-28', 3),
(8, 'REG-0121-0008', 8, 10, '14:26:00', 003, '2021-01-28', 3),
(9, 'REG-0121-0009', 2, 14, '14:44:58', 001, '2021-01-31', 2),
(10, 'REG-0121-0010', 3, 14, '17:43:59', 002, '2021-01-31', 3),
(11, 'REG-0221-0011', 5, 14, '10:25:22', 003, '2021-01-31', 3),
(12, 'REG-0221-0012', 3, 15, '11:54:26', 001, '2021-02-01', 1),
(13, 'REG-0221-0013', 9, 14, '14:28:47', 004, '2021-01-31', 0),
(14, 'REG-0221-0014', 5, 22, '15:09:44', 001, '2021-02-07', 1),
(15, 'REG-0221-0015', 5, 23, '19:48:07', 001, '2021-02-08', 3),
(16, 'REG-0221-0016', 9, 23, '11:46:22', 002, '2021-02-08', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_detail_masuk`
--

CREATE TABLE IF NOT EXISTS `tb_detail_masuk` (
  `id_detail_masuk` int(11) NOT NULL AUTO_INCREMENT,
  `id_barang_masuk` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jumlah_masuk` int(11) NOT NULL,
  PRIMARY KEY (`id_detail_masuk`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data untuk tabel `tb_detail_masuk`
--

INSERT INTO `tb_detail_masuk` (`id_detail_masuk`, `id_barang_masuk`, `id_barang`, `jumlah_masuk`) VALUES
(1, 1, 5, 2),
(2, 1, 4, 2),
(3, 1, 3, 5),
(4, 2, 5, 5),
(5, 3, 5, 1),
(6, 4, 5, 13),
(7, 4, 4, 3),
(8, 4, 3, 4),
(9, 4, 1, 5),
(10, 5, 5, 2),
(11, 5, 4, 2),
(12, 6, 7, 200),
(13, 7, 5, 23),
(14, 8, 4, 4),
(15, 8, 3, 10),
(16, 9, 8, 100),
(17, 10, 8, 50),
(18, 11, 1, 100);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_detail_praktek`
--

CREATE TABLE IF NOT EXISTS `tb_detail_praktek` (
  `id_detail_praktek` int(11) NOT NULL AUTO_INCREMENT,
  `id_jadwal` int(11) NOT NULL,
  `deskripsi_jadwal` varchar(100) NOT NULL,
  `id_dokter` int(11) NOT NULL,
  `jam_start` time NOT NULL,
  `jam_end` time NOT NULL,
  `create_date` datetime NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id_detail_praktek`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data untuk tabel `tb_detail_praktek`
--

INSERT INTO `tb_detail_praktek` (`id_detail_praktek`, `id_jadwal`, `deskripsi_jadwal`, `id_dokter`, `jam_start`, `jam_end`, `create_date`, `status`) VALUES
(10, 8, 'Pagi', 2, '09:00:00', '10:00:00', '2021-01-28 14:04:59', 0),
(11, 9, 'Siang', 1, '10:00:00', '12:00:00', '2021-01-28 18:42:30', 0),
(12, 8, 'Sore', 1, '16:45:00', '18:00:00', '2021-01-29 16:43:11', 0),
(13, 8, 'Malam', 2, '19:00:00', '22:00:00', '2021-01-29 16:44:28', 0),
(14, 10, 'Malam', 2, '19:00:00', '22:00:00', '2021-01-31 14:44:41', 0),
(15, 11, 'Sore', 5, '17:00:00', '21:00:00', '2021-02-01 11:53:31', 0),
(16, 12, 'Sore', 4, '17:00:00', '21:00:00', '2021-02-01 11:53:52', 1),
(17, 13, 'Sore', 2, '17:00:00', '21:00:00', '2021-02-01 11:54:07', 1),
(18, 13, 'Malam', 4, '19:00:00', '22:00:00', '2021-02-01 19:37:42', 0),
(19, 15, 'Malam', 5, '18:00:00', '22:00:00', '2021-02-02 19:06:32', 0),
(20, 16, 'Malam', 4, '18:00:00', '22:00:00', '2021-02-02 19:06:48', 0),
(21, 17, 'Sore', 5, '17:00:00', '21:00:00', '2021-02-07 15:07:46', 1),
(22, 18, 'Sore', 5, '17:00:00', '21:00:00', '2021-02-07 15:09:23', 0),
(23, 19, 'Malam', 2, '17:00:00', '21:00:00', '2021-02-08 19:47:54', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_detail_transaksi_periksa`
--

CREATE TABLE IF NOT EXISTS `tb_detail_transaksi_periksa` (
  `id_detail_transaksi_periksa` int(11) NOT NULL AUTO_INCREMENT,
  `id_transaksi_periksa` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jumlah_obat` int(3) NOT NULL,
  `harga_satuan` decimal(10,0) NOT NULL,
  `sub_total` decimal(10,0) NOT NULL,
  `create_date` datetime NOT NULL,
  PRIMARY KEY (`id_detail_transaksi_periksa`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data untuk tabel `tb_detail_transaksi_periksa`
--

INSERT INTO `tb_detail_transaksi_periksa` (`id_detail_transaksi_periksa`, `id_transaksi_periksa`, `id_barang`, `jumlah_obat`, `harga_satuan`, `sub_total`, `create_date`) VALUES
(1, 1, 8, 2, '15800', '31600', '2021-02-06 18:06:16'),
(2, 1, 7, 1, '59800', '59800', '2021-02-06 18:06:16'),
(3, 2, 8, 8, '15800', '126400', '2021-02-06 18:09:06'),
(4, 3, 4, 1, '64200', '64200', '2021-02-06 22:14:17'),
(5, 3, 3, 1, '2300', '2300', '2021-02-06 22:14:17'),
(6, 4, 1, 3, '42400', '127200', '2021-02-06 22:16:14'),
(7, 5, 1, 2, '42400', '84800', '2021-02-06 22:18:22'),
(8, 6, 3, 1, '2300', '2300', '2021-02-06 22:20:00'),
(9, 9, 8, 1, '15800', '15800', '2021-02-07 10:26:58'),
(10, 10, 8, 1, '15800', '15800', '2021-02-07 11:55:35'),
(11, 10, 5, 1, '24400', '24400', '2021-02-07 11:55:35'),
(12, 11, 8, 1, '15800', '15800', '2021-02-08 16:11:31'),
(13, 11, 7, 1, '59800', '59800', '2021-02-08 16:11:31'),
(14, 12, 8, 1, '15800', '15800', '2021-02-08 19:49:51'),
(15, 12, 7, 1, '59800', '59800', '2021-02-08 19:49:51');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_discount_ppn`
--

CREATE TABLE IF NOT EXISTS `tb_discount_ppn` (
  `id_discount_ppn` int(2) NOT NULL AUTO_INCREMENT,
  `discount` int(2) NOT NULL,
  `ppn` int(2) NOT NULL,
  PRIMARY KEY (`id_discount_ppn`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `tb_discount_ppn`
--

INSERT INTO `tb_discount_ppn` (`id_discount_ppn`, `discount`, `ppn`) VALUES
(1, 10, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_dokter`
--

CREATE TABLE IF NOT EXISTS `tb_dokter` (
  `id_dokter` int(11) NOT NULL AUTO_INCREMENT,
  `nama_dokter` varchar(100) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` varchar(225) NOT NULL,
  `no_telepon` varchar(20) NOT NULL,
  `deskripsi` varchar(100) NOT NULL,
  `create_date` datetime NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id_dokter`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data untuk tabel `tb_dokter`
--

INSERT INTO `tb_dokter` (`id_dokter`, `nama_dokter`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `no_telepon`, `deskripsi`, `create_date`, `status`) VALUES
(1, 'Rizky Adriansyah,Dr M.Ked(ped)', 'L', '-', '2021-01-27', '-', '-', 'Dokter anak', '2021-01-27 07:31:10', 0),
(2, 'dr. Melany Taurusia', 'P', '-', '2021-01-27', '-', '-', 'Dokter Umum', '2021-01-27 07:35:11', 0),
(3, 'wer', 'L', 'wer', '2021-01-28', 'werwerw', 'erwer', 'rwer', '2021-01-28 06:54:42', 1),
(4, 'dr.Tirta', 'L', 'Jakarta', '1983-03-02', 'Jakarta', '08488483222', 'Dokter kandungan', '2021-02-01 10:57:03', 0),
(5, 'dr.Abidin', 'L', 'Semarang', '1990-02-07', 'Semarang', '08485738322', 'Dokter Mata', '2021-02-01 11:47:03', 0),
(6, 'dr.Abidin', 'L', 'Semarang', '1990-02-07', 'Semarang', '08485738322', 'Dokter Mata', '2021-02-01 11:47:10', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_informasi_klinik`
--

CREATE TABLE IF NOT EXISTS `tb_informasi_klinik` (
  `id_informasi` int(5) NOT NULL AUTO_INCREMENT,
  `nama_klinik` varchar(100) NOT NULL,
  `alamat_klinik` varchar(225) NOT NULL,
  `no_telpon` varchar(20) NOT NULL,
  `logo` varchar(50) NOT NULL,
  `favicon` varchar(50) NOT NULL,
  `bg_login` varchar(50) NOT NULL,
  PRIMARY KEY (`id_informasi`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `tb_informasi_klinik`
--

INSERT INTO `tb_informasi_klinik` (`id_informasi`, `nama_klinik`, `alamat_klinik`, `no_telpon`, `logo`, `favicon`, `bg_login`) VALUES
(1, 'Klinik Medika Narom', 'Jl. Jegang, Jayasampurna, Kec. Serang Baru, Bekasi, Jawa Barat', '(021) 89283669', 'logo.png', 'favicon1.ico', 'bg2.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jadwal_praktek`
--

CREATE TABLE IF NOT EXISTS `tb_jadwal_praktek` (
  `id_jadwal` int(11) NOT NULL AUTO_INCREMENT,
  `id_poliklinik` int(11) NOT NULL,
  `tanggal_praktek` date NOT NULL,
  `create_date` datetime NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id_jadwal`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data untuk tabel `tb_jadwal_praktek`
--

INSERT INTO `tb_jadwal_praktek` (`id_jadwal`, `id_poliklinik`, `tanggal_praktek`, `create_date`, `status`) VALUES
(8, 2, '2021-01-28', '2021-01-28 14:04:07', 0),
(9, 1, '2021-01-28', '2021-01-28 14:04:20', 0),
(10, 2, '2021-01-31', '2021-01-31 14:44:06', 0),
(11, 5, '2021-02-01', '2021-02-01 11:52:57', 0),
(12, 2, '2021-02-01', '2021-02-01 11:53:02', 1),
(13, 1, '2021-02-01', '2021-02-01 11:53:07', 0),
(14, 2, '2021-02-18', '2021-02-02 18:52:23', 1),
(15, 2, '2021-02-02', '2021-02-02 19:06:07', 0),
(16, 1, '2021-02-02', '2021-02-02 19:06:13', 0),
(17, 5, '2021-02-07', '2021-02-07 15:06:59', 1),
(18, 1, '2021-02-07', '2021-02-07 15:09:05', 0),
(19, 2, '2021-02-08', '2021-02-08 19:47:33', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kamar`
--

CREATE TABLE IF NOT EXISTS `tb_kamar` (
  `id_kamar` int(11) NOT NULL AUTO_INCREMENT,
  `id_kategori` int(11) NOT NULL,
  `kode_kamar` varchar(20) NOT NULL,
  `nama_kamar` varchar(100) NOT NULL,
  `harga_kamar` decimal(10,0) NOT NULL,
  `status_ready` enum('1','2','3') NOT NULL COMMENT '1=Ready 2=Booked  3=UnReady',
  `create_date` datetime NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id_kamar`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data untuk tabel `tb_kamar`
--

INSERT INTO `tb_kamar` (`id_kamar`, `id_kategori`, `kode_kamar`, `nama_kamar`, `harga_kamar`, `status_ready`, `create_date`, `status`) VALUES
(1, 1, 'KM-001', 'Ruangan No 103', '600000', '1', '2021-02-07 11:25:25', 0),
(2, 1, 'KM-002', 'Ruangan No 101', '600000', '1', '2021-02-07 21:20:39', 0),
(3, 1, 'KM-003', 'Ruangan No 102', '600000', '1', '2021-02-07 21:21:13', 0),
(4, 1, 'KM-004', 'eqwe', '3123', '1', '2021-02-07 21:30:49', 1),
(5, 1, 'KM-004', 'Ruangan No 104', '600000', '1', '2021-02-07 21:31:51', 0),
(6, 1, 'KM-005', 'Ruangan No 105', '600000', '1', '2021-02-07 21:32:02', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kategori`
--

CREATE TABLE IF NOT EXISTS `tb_kategori` (
  `id_kategori` int(5) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(150) NOT NULL,
  `create_date` datetime NOT NULL,
  `status` int(1) NOT NULL COMMENT '0=AKTIF 2=NON AKTIF',
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data untuk tabel `tb_kategori`
--

INSERT INTO `tb_kategori` (`id_kategori`, `nama_kategori`, `create_date`, `status`) VALUES
(1, 'Obat Bebas', '2020-11-19 11:30:10', 1),
(2, 'Obat Bebas Terbatas', '2020-11-19 11:30:10', 1),
(3, 'Obat Keras', '2020-11-19 11:30:10', 1),
(4, 'Obat Fitofarmaka', '2020-11-19 11:30:10', 1),
(5, 'Obat Herbal Terstandar (OHT)', '2020-11-19 11:30:10', 1),
(6, 'Obat Herbal (Jamu)', '2020-11-19 11:30:10', 1),
(7, 'Batuk dan Flu', '2020-11-19 11:30:10', 0),
(8, 'Anti-Nyeri', '2020-11-19 11:30:10', 0),
(11, 'Asma', '2020-11-19 11:30:10', 0),
(12, 'DDD', '2020-11-19 11:30:10', 1),
(13, 'ERWRE', '2020-11-19 11:30:10', 1),
(14, 'ssss', '2021-02-01 18:58:13', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kategori_kamar`
--

CREATE TABLE IF NOT EXISTS `tb_kategori_kamar` (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(100) NOT NULL,
  `fasilitas` varchar(225) NOT NULL,
  `create_date` datetime NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data untuk tabel `tb_kategori_kamar`
--

INSERT INTO `tb_kategori_kamar` (`id_kategori`, `nama_kategori`, `fasilitas`, `create_date`, `status`) VALUES
(1, 'KELAS VIP', 'Nurse Call, Free Wifi, Bed, Sofabed, Box Bayi, AC, TV LED, Lemari, Bedside Locker, Kulkas, Kamar Mandi, Washtafel, Termos Air Panas & Air Mineral, Parkir Ekslusif, Free Minuman dingin', '2021-02-07 19:27:10', 0),
(2, 'KELAS UTAMA', 'Nurse Call, Free Wifi, Bed, Sofabed, Box Bayi, AC, TV LED, Lemari, Bedside Locker, Kamar Mandi, Washtafel, Termos Air Panas & Air Mineral, Parkir Ekslusif, Ruangan lebih besar dari Kelas Pratama', '2021-02-07 13:26:31', 0),
(3, 'KELAS PRATAMA', 'Nurse Call, Free Wifi, Bed, Sofabed, Box Bayi, AC, TV LED, Lemari, Bedside Locker, Kamar Mandi, Washtafel, Termos Air Panas & Air Mineral.', '2021-02-07 19:27:13', 0),
(4, 'RUANG ANGGREK', 'Nurse Call, Free Wifi, Bed, AC, TV LED, Bedside Locker, Kamar Mandi, Air Mineral', '2021-02-07 19:27:21', 0),
(5, 'RUANG YASMIN', 'Nurse Call, Free Wifi, Bed, AC, TV LED, Bedside Locker, Kamar Mandi, Air Mineral', '2021-02-07 19:27:29', 0),
(6, 'RUANG AZALEA', 'Nurse Call, Free Wifi,, AC, Bed, TV, Box Bayi, Bedside Locker, Kamar Mandi, Air Mineral', '2021-02-07 19:27:40', 0),
(7, 'erte', '', '2021-02-07 19:27:53', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_layanan`
--

CREATE TABLE IF NOT EXISTS `tb_layanan` (
  `id_layanan` int(11) NOT NULL AUTO_INCREMENT,
  `id_poliklinik` int(11) NOT NULL,
  `deskripsi_layanan` varchar(100) NOT NULL,
  `harga_layanan` float NOT NULL,
  `create_date` datetime NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id_layanan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data untuk tabel `tb_layanan`
--

INSERT INTO `tb_layanan` (`id_layanan`, `id_poliklinik`, `deskripsi_layanan`, `harga_layanan`, `create_date`, `status`) VALUES
(1, 1, 'Konsultasi', 150000, '2021-02-01 18:25:32', 0),
(2, 1, 'Periksa', 100000, '2021-02-01 19:06:31', 1),
(3, 2, 'Konsultasi Gigi', 120000, '2021-02-01 19:07:17', 0),
(4, 5, 'Cekup', 100000, '2021-02-01 19:46:45', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_metode_bayar`
--

CREATE TABLE IF NOT EXISTS `tb_metode_bayar` (
  `id_metode` int(11) NOT NULL AUTO_INCREMENT,
  `deskripsi` varchar(100) NOT NULL,
  `title_label` varchar(50) NOT NULL,
  `status_form` int(1) NOT NULL COMMENT '0=TANPA FORM 1=MENAMPILKAN FORM',
  `create_date` datetime NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id_metode`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data untuk tabel `tb_metode_bayar`
--

INSERT INTO `tb_metode_bayar` (`id_metode`, `deskripsi`, `title_label`, `status_form`, `create_date`, `status`) VALUES
(1, 'BPJS Kesehatan', 'No Kartu BPJS', 1, '2021-02-01 20:18:12', 0),
(2, 'Tunai', '', 0, '2021-02-01 20:23:00', 0),
(3, 'Debit BCA', 'No Kartu BCA', 1, '2021-02-01 20:35:31', 0),
(4, 'Debit BRI', 'No Kartu BRI', 1, '2021-02-01 20:35:46', 0),
(5, 'Debit Mandiri', 'No Kartu Mandiri', 1, '2021-02-01 20:36:04', 0),
(6, 'testing', '', 0, '2021-02-01 20:44:50', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_poliklinik`
--

CREATE TABLE IF NOT EXISTS `tb_poliklinik` (
  `id_poliklinik` int(11) NOT NULL AUTO_INCREMENT,
  `nama_poliklinik` varchar(100) NOT NULL,
  `create_date` datetime NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id_poliklinik`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data untuk tabel `tb_poliklinik`
--

INSERT INTO `tb_poliklinik` (`id_poliklinik`, `nama_poliklinik`, `create_date`, `status`) VALUES
(1, 'KLINIK UMUM TERPADU', '2021-01-26 20:22:06', 0),
(2, 'KLINIK GIGI DAN MULUT', '2021-01-26 20:24:06', 0),
(3, 'e', '2021-01-26 20:32:39', 1),
(4, 'PANTEK', '2021-01-28 11:03:00', 1),
(5, 'KLINIK DARURAT', '2021-01-28 21:15:20', 0),
(6, 'ddd', '2021-02-01 11:50:50', 1),
(7, '335345', '2021-02-01 11:52:34', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_satuan`
--

CREATE TABLE IF NOT EXISTS `tb_satuan` (
  `id_satuan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_satuan` varchar(50) NOT NULL,
  `create_date` datetime NOT NULL,
  `status` int(1) NOT NULL COMMENT '0=AKTIF 1=NON AKTIF',
  PRIMARY KEY (`id_satuan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data untuk tabel `tb_satuan`
--

INSERT INTO `tb_satuan` (`id_satuan`, `nama_satuan`, `create_date`, `status`) VALUES
(1, 'Per Tube', '2021-01-18 13:54:08', 0),
(2, 'Per Tablet', '2021-01-18 13:54:18', 0),
(4, 'Per Strip', '2021-01-18 13:54:36', 0),
(5, 'erwe', '2021-01-31 11:12:26', 1),
(6, 'Per Botol', '2021-01-31 18:33:51', 0),
(7, 'Per 2 Strip', '2021-02-04 18:33:19', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_supplier`
--

CREATE TABLE IF NOT EXISTS `tb_supplier` (
  `id_supplier` int(11) NOT NULL AUTO_INCREMENT,
  `kode_supplier` varchar(20) NOT NULL,
  `nama_supplier` varchar(100) NOT NULL,
  `alamat_supplier` varchar(150) NOT NULL,
  `telepon` varchar(50) NOT NULL,
  `tanggal_input` datetime NOT NULL,
  `status` int(1) NOT NULL COMMENT '0=AKTIF 1=NON AKTIF',
  PRIMARY KEY (`id_supplier`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data untuk tabel `tb_supplier`
--

INSERT INTO `tb_supplier` (`id_supplier`, `kode_supplier`, `nama_supplier`, `alamat_supplier`, `telepon`, `tanggal_input`, `status`) VALUES
(1, 'SP-001', 'Kimia Farma', '-', '02161974095451', '2021-01-17 00:00:00', 0),
(2, 'SP-002', 'Kalbe Farma', '-', '082208255114', '2021-01-18 08:21:11', 0),
(3, 'SP-003', 'Guest', '-', '-', '2021-01-19 13:12:45', 0),
(4, 'SP-004', 'Kimia Farma', 'Jl.merdeka jakarta', '0778563534', '2021-01-31 05:02:22', 1),
(5, 'SP-005', 'rwer', 'erwer', 'werwr', '2021-01-31 05:04:25', 1),
(6, 'SP-004', 'EWWE', 'WERWER', 'WERW', '2021-01-31 05:06:56', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_temporary_masuk`
--

CREATE TABLE IF NOT EXISTS `tb_temporary_masuk` (
  `id_temporary` int(11) NOT NULL AUTO_INCREMENT,
  `id_supplier` int(11) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  PRIMARY KEY (`id_temporary`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_temporary_transaksi_periksa`
--

CREATE TABLE IF NOT EXISTS `tb_temporary_transaksi_periksa` (
  `id_temporary_transaksi_periksa` int(11) NOT NULL AUTO_INCREMENT,
  `id_daftar_periksa` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jumlah_obat` int(3) NOT NULL,
  PRIMARY KEY (`id_temporary_transaksi_periksa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_transaksi_periksa`
--

CREATE TABLE IF NOT EXISTS `tb_transaksi_periksa` (
  `id_transaksi_periksa` int(11) NOT NULL AUTO_INCREMENT,
  `no_transaksi` varchar(50) NOT NULL,
  `id_daftar_periksa` int(11) NOT NULL,
  `nama_poliklinik` varchar(100) NOT NULL,
  `id_layanan` int(11) NOT NULL,
  `biaya_layanan` decimal(10,0) NOT NULL,
  `biaya_obat` decimal(10,0) NOT NULL,
  `sub_total` decimal(10,0) NOT NULL,
  `diskon` int(3) NOT NULL,
  `ppn` int(3) NOT NULL,
  `bayar` decimal(10,0) NOT NULL,
  `id_metode` int(11) NOT NULL,
  `atas_nama` varchar(100) NOT NULL COMMENT 'NO KARTU ',
  `nama_kasir` varchar(100) NOT NULL,
  `jam_transaksi` time NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `create_date` datetime NOT NULL,
  PRIMARY KEY (`id_transaksi_periksa`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data untuk tabel `tb_transaksi_periksa`
--

INSERT INTO `tb_transaksi_periksa` (`id_transaksi_periksa`, `no_transaksi`, `id_daftar_periksa`, `nama_poliklinik`, `id_layanan`, `biaya_layanan`, `biaya_obat`, `sub_total`, `diskon`, `ppn`, `bayar`, `id_metode`, `atas_nama`, `nama_kasir`, `jam_transaksi`, `tanggal_transaksi`, `create_date`) VALUES
(1, 'TRS-0221-000000001', 8, 'KLINIK GIGI DAN MULUT', 3, '120000', '91400', '211400', 0, 0, '211400', 2, '', 'Admin', '18:06:16', '2021-01-28', '2021-02-07 13:16:26'),
(2, 'TRS-0221-000000002', 7, 'KLINIK GIGI DAN MULUT', 3, '120000', '126400', '246400', 0, 0, '246400', 2, '', 'Admin', '18:09:06', '2021-01-28', '2021-02-07 10:14:06'),
(3, 'TRS-0221-000000003', 6, 'KLINIK GIGI DAN MULUT', 3, '120000', '66500', '186500', 0, 0, '186500', 2, '', 'Admin', '22:14:17', '2021-01-28', '0000-00-00 00:00:00'),
(4, 'TRS-0221-000000004', 5, 'KLINIK GIGI DAN MULUT', 3, '120000', '127200', '247200', 0, 0, '247200', 2, '', 'Admin', '22:16:14', '2021-01-28', '0000-00-00 00:00:00'),
(5, 'TRS-0221-000000005', 4, 'KLINIK GIGI DAN MULUT', 3, '120000', '84800', '204800', 0, 0, '204800', 2, '', 'Admin', '22:18:22', '2021-01-28', '0000-00-00 00:00:00'),
(6, 'TRS-0221-000000006', 3, 'KLINIK UMUM TERPADU', 1, '150000', '2300', '152300', 0, 0, '152300', 2, '', 'Admin', '22:20:00', '2021-01-28', '0000-00-00 00:00:00'),
(8, 'TRS-0221-000000007', 2, 'KLINIK GIGI DAN MULUT', 3, '120000', '0', '120000', 0, 0, '120000', 2, '', 'Admin', '09:51:44', '2021-01-28', '0000-00-00 00:00:00'),
(9, 'TRS-0221-000000008', 1, 'KLINIK GIGI DAN MULUT', 3, '120000', '15800', '135800', 0, 0, '135800', 2, '', 'Admin', '10:26:58', '2021-01-28', '0000-00-00 00:00:00'),
(10, 'TRS-0221-000000009', 11, 'KLINIK GIGI DAN MULUT', 3, '120000', '40200', '160200', 0, 0, '160200', 2, '', 'Admin', '11:55:35', '2021-01-31', '2021-02-07 11:55:35'),
(11, 'TRS-0221-000000010', 10, 'KLINIK GIGI DAN MULUT', 3, '120000', '75600', '195600', 0, 0, '195600', 2, '', 'Admin', '16:11:31', '2021-01-31', '2021-02-08 16:11:31'),
(12, 'TRS-0221-000000011', 15, 'KLINIK GIGI DAN MULUT', 3, '120000', '75600', '195600', 19560, 0, '176040', 2, '', 'Admin', '19:49:51', '2021-02-08', '2021-02-08 19:49:51');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
