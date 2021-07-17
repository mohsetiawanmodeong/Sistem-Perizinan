-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 17, 2021 at 03:47 PM
-- Server version: 5.7.24
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perizinan`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_berkas`
--

CREATE TABLE `tbl_berkas` (
  `id_berkas` int(11) NOT NULL,
  `id_pengajuan` int(11) NOT NULL,
  `id_perusahaan` int(11) NOT NULL,
  `id_kabag` int(11) NOT NULL,
  `tanggal_upload` date NOT NULL,
  `nama_file` varchar(255) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_berkas`
--

INSERT INTO `tbl_berkas` (`id_berkas`, `id_pengajuan`, `id_perusahaan`, `id_kabag`, `tanggal_upload`, `nama_file`, `keterangan`) VALUES
(1, 2, 1, 3, '2021-07-11', 'Approve Document - Nama Perusahaan PT. Aplikasi Test SajaTanggal 2021-07-11 id 2.pdf', 'Lengkapi Document Yang Benar');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pengajuan`
--

CREATE TABLE `tbl_pengajuan` (
  `id_pengajuan` int(11) NOT NULL,
  `id_perizinan` int(11) NOT NULL,
  `tgl_pengajuan` date NOT NULL,
  `id_perusahaan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tgl_disetujui` date NOT NULL,
  `id_admin` int(11) NOT NULL,
  `id_kabag` int(11) NOT NULL,
  `id_status` int(11) NOT NULL,
  `nama_file` text NOT NULL,
  `catatan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pengajuan`
--

INSERT INTO `tbl_pengajuan` (`id_pengajuan`, `id_perizinan`, `tgl_pengajuan`, `id_perusahaan`, `id_user`, `tgl_disetujui`, `id_admin`, `id_kabag`, `id_status`, `nama_file`, `catatan`) VALUES
(1, 1, '2021-07-10', 1, 4, '2021-07-10', 2, 0, 2, '', 'Kurang Jelas Update'),
(2, 2, '2021-07-10', 1, 4, '2021-07-11', 2, 3, 3, 'Erwan_PWL_UP_200_juta_(THN)1.pdf', 'Lengkapi Document Yang Benar'),
(3, 3, '2021-07-16', 1, 4, '0000-00-00', 2, 0, 2, 'Approve_Document_-_Nama_Perusahaan_PT__Aplikasi_Test_SajaTanggal_2021-07-11_id_2.pdf', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_perizinan`
--

CREATE TABLE `tbl_perizinan` (
  `id_perizinan` int(11) NOT NULL,
  `nama_perizinan` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_perizinan`
--

INSERT INTO `tbl_perizinan` (`id_perizinan`, `nama_perizinan`) VALUES
(1, 'Bidang PRL'),
(2, 'Ijin LP'),
(3, 'Ijin Reklamasi Pantai'),
(4, 'sub menu'),
(5, 'Bidang PT'),
(6, 'sub menu'),
(7, 'sub menu');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_perusahaan`
--

CREATE TABLE `tbl_perusahaan` (
  `id_perusahaan` int(11) NOT NULL,
  `nama_perusahaan` varchar(128) NOT NULL,
  `alamat_perusahaan` varchar(255) NOT NULL,
  `npwp` varchar(64) NOT NULL,
  `email_perusahaan` varchar(128) NOT NULL,
  `no_telp_perusahaan` int(17) NOT NULL,
  `pic_perusahaan` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_perusahaan`
--

INSERT INTO `tbl_perusahaan` (`id_perusahaan`, `nama_perusahaan`, `alamat_perusahaan`, `npwp`, `email_perusahaan`, `no_telp_perusahaan`, `pic_perusahaan`) VALUES
(1, 'PT. Aplikasi Test Saja', 'Dimana Ya Bingung qweqw qweqw qweqw', '33323232323265656565', 'kasehungrama18@gmail.com', 2147483647, 'Testing PIC'),
(2, 'PT. Oke Jaya', 'Jalan Dimana Saja Asal Oke Oce', '33323232323265656565', 'erwan.widayat@yahoo.com', 2147483647, 'Testing PIC');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_role`
--

CREATE TABLE `tbl_role` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_role`
--

INSERT INTO `tbl_role` (`id`, `name`) VALUES
(1, 'Administrator'),
(2, 'User'),
(3, 'Kepala Bagian'),
(4, 'Administrasi');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_setting`
--

CREATE TABLE `tbl_setting` (
  `id` int(11) NOT NULL,
  `nama_aplikasi` varchar(128) DEFAULT NULL,
  `address` text,
  `favicon` varchar(64) DEFAULT NULL,
  `host` varchar(64) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(64) NOT NULL,
  `facebook` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_setting`
--

INSERT INTO `tbl_setting` (`id`, `nama_aplikasi`, `address`, `favicon`, `host`, `username`, `password`, `facebook`) VALUES
(1, 'Perisinan Oke', 'Jalan Dimana Saja Kapan Saja Yang Penting', 'favicon.ico', 'smtp.googlemail.com', 'kasehungrama18@gmail.com', 'txndafxsxbxxeqba', 'www.facebook.com/okeoce');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_status`
--

CREATE TABLE `tbl_status` (
  `id_status` int(11) NOT NULL,
  `keterangan` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_status`
--

INSERT INTO `tbl_status` (`id_status`, `keterangan`) VALUES
(1, 'Pengajuan Perizinan'),
(2, 'Sedang Di Proses Admin'),
(3, 'Di Setujui'),
(4, 'Di Tolak'),
(5, 'Pending'),
(6, 'Batal');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `name` varchar(128) DEFAULT NULL,
  `notelp` int(32) NOT NULL,
  `email` varchar(64) DEFAULT NULL,
  `username` varchar(32) DEFAULT NULL,
  `password` text,
  `role_id` int(2) NOT NULL DEFAULT '2',
  `id_perusahaan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `name`, `notelp`, `email`, `username`, `password`, `role_id`, `id_perusahaan`) VALUES
(1, 'Administrator aja', 8987987, 'erwan@aaaa.com', 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, NULL),
(2, 'users', 8987987, 'qweq@qweq.com', 'user', '21232f297a57a5a743894a0e4a801fc3', 4, NULL),
(3, 'Testing Kepala Bagian', 0, NULL, 'testkabag', '21232f297a57a5a743894a0e4a801fc3', 3, NULL),
(4, 'PT. Aplikasi Test Saja', 2147483647, 'kasehungrama18@gmail.com', 'kasehungrama18@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 2, 1),
(5, 'PT. Oke Jaya', 2147483647, 'erwan.widayat@yahoo.com', 'erwan.widayat@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 2, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_berkas`
--
ALTER TABLE `tbl_berkas`
  ADD PRIMARY KEY (`id_berkas`);

--
-- Indexes for table `tbl_pengajuan`
--
ALTER TABLE `tbl_pengajuan`
  ADD PRIMARY KEY (`id_pengajuan`);

--
-- Indexes for table `tbl_perizinan`
--
ALTER TABLE `tbl_perizinan`
  ADD PRIMARY KEY (`id_perizinan`);

--
-- Indexes for table `tbl_perusahaan`
--
ALTER TABLE `tbl_perusahaan`
  ADD PRIMARY KEY (`id_perusahaan`);

--
-- Indexes for table `tbl_role`
--
ALTER TABLE `tbl_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_setting`
--
ALTER TABLE `tbl_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_status`
--
ALTER TABLE `tbl_status`
  ADD PRIMARY KEY (`id_status`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_berkas`
--
ALTER TABLE `tbl_berkas`
  MODIFY `id_berkas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_pengajuan`
--
ALTER TABLE `tbl_pengajuan`
  MODIFY `id_pengajuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_perizinan`
--
ALTER TABLE `tbl_perizinan`
  MODIFY `id_perizinan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_perusahaan`
--
ALTER TABLE `tbl_perusahaan`
  MODIFY `id_perusahaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_role`
--
ALTER TABLE `tbl_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_setting`
--
ALTER TABLE `tbl_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_status`
--
ALTER TABLE `tbl_status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
