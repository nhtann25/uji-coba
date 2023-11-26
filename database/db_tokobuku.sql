-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2020 at 04:28 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_tokobuku`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_buku`
--

CREATE TABLE `tbl_buku` (
  `id_buku` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `judul` varchar(128) NOT NULL,
  `penerbit` varchar(128) NOT NULL,
  `pengarang` varchar(128) NOT NULL,
  `jml_halaman` varchar(50) NOT NULL,
  `harga` varchar(50) NOT NULL,
  `stok` varchar(50) NOT NULL,
  `gambar` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_buku`
--

INSERT INTO `tbl_buku` (`id_buku`, `id_kategori`, `judul`, `penerbit`, `pengarang`, `jml_halaman`, `harga`, `stok`, `gambar`) VALUES
(16, 3, 'Lost', 'Gagas Media', 'Evi Shi', '319', '78300', '-1', '210120030947_lost.png'),
(17, 3, 'Danur', 'Kawah Media, 5', 'Risa Saraswati', '216', '54000', '44', '150120112749_danur.png'),
(18, 4, 'Berhenti di kamu', 'Mizania', 'Gia Pratama', '284', '43200', '18', '150120112806_berhentidikamu.jpg'),
(19, 2, 'Assalamualaikum Beijing', 'Nourabooks', 'Asma Nadia', '356', '76000', '37', '150120112820_beijing.jpg'),
(20, 2, 'Laskar Pelangi', 'Bentang Pustaka, Yogyakarta', 'Andrea Hirata', '529', '67000', '21', '150120112833_pelangi.jpg'),
(21, 2, 'Perahu Kertas', 'Treudee Pustaka Sejati & Bentang Pustaka', 'Dewi Lestari (Dee)', '444', '50000', '17', '150120112846_perahu_kertas.jpeg'),
(23, 1, 'Cewek Smart', 'Gema Insani', 'Ria Fariana', '200', '45000', '55', '150120112938_images-23.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invoice`
--

CREATE TABLE `tbl_invoice` (
  `id_invoice` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `tgl_pesan` datetime NOT NULL,
  `batas_bayar` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_invoice`
--

INSERT INTO `tbl_invoice` (`id_invoice`, `nama`, `alamat`, `tgl_pesan`, `batas_bayar`) VALUES
(49, 'Mela Santika', 'Bogor', '2020-01-16 18:11:31', '2020-01-17 18:11:31'),
(50, 'Santika', 'Bandung', '2020-01-16 18:12:04', '2020-01-17 18:12:04'),
(51, 'Juwita', 'Palembang', '2020-01-16 18:13:07', '2020-01-17 18:13:07');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kategori`
--

CREATE TABLE `tbl_kategori` (
  `id_kategori` int(11) NOT NULL,
  `kategori` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_kategori`
--

INSERT INTO `tbl_kategori` (`id_kategori`, `kategori`) VALUES
(1, 'NonFiction'),
(2, 'Fiction'),
(3, 'Horror'),
(4, 'Romance');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pesanan`
--

CREATE TABLE `tbl_pesanan` (
  `id_pesan` int(11) NOT NULL,
  `id_invoice` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `nama_buku` varchar(50) NOT NULL,
  `jumlah` int(3) NOT NULL,
  `harga` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_pesanan`
--

INSERT INTO `tbl_pesanan` (`id_pesan`, `id_invoice`, `id_buku`, `nama_buku`, `jumlah`, `harga`) VALUES
(51, 44, 10, 'Milea', 1, 62500),
(52, 44, 8, 'Dilan', 1, 55200),
(53, 45, 8, 'Dilan', 1, 55200),
(54, 46, 11, 'Bad Romance', 1, 64000),
(55, 47, 10, 'Milea', 1, 62500),
(56, 48, 10, 'Milea', 1, 62500),
(57, 48, 8, 'Dilan', 1, 55200),
(58, 49, 17, 'Danur', 1, 54000),
(59, 49, 18, 'Berhenti di kamu', 1, 43200),
(60, 50, 23, 'Cewek Smart', 1, 45000),
(61, 50, 21, 'Perahu Kertas', 1, 50000),
(62, 50, 20, 'Laskar Pelangi', 1, 67000),
(63, 51, 20, 'Laskar Pelangi', 1, 67000),
(64, 51, 18, 'Berhenti di kamu', 1, 43200),
(65, 51, 16, 'Lost', 1, 78300);

--
-- Triggers `tbl_pesanan`
--
DELIMITER $$
CREATE TRIGGER `pesanan_penjualan` AFTER INSERT ON `tbl_pesanan` FOR EACH ROW BEGIN 
	UPDATE tbl_buku SET stok = stok-NEW.jumlah
    WHERE id_buku = NEW.id_buku;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(5, 'Mela', 'mela@gmail.com', 'gambar1.jpg', '$2y$10$tw380xyuaEr4qznQ9Y.CmOjr9mGH39mKly88XzbI.CiQuCV2EMC2y', 1, 1, 1576903028),
(6, 'Mela Santika', 'melasantika1602@gmail.com', 'default.jpg', '$2y$10$MEwwM9wqMFanu3y1LIKF4.mhu6wpH0phjiMPJxjOKn3KqvnNeqKV2', 2, 1, 1576992240),
(7, 'lala', 'lala@gmail.com', 'default.jpg', '$2y$10$qioDtjbj5B.e6yewMC7V5.25/kB7EOx/mfQc/MI3Tj7FwGmCF1s0u', 2, 1, 1577851727);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 2),
(4, 1, 3),
(9, 1, 5),
(10, 1, 6),
(11, 1, 7),
(12, 2, 7),
(13, 1, 8),
(14, 2, 8),
(15, 1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Admin'),
(2, 'User'),
(3, 'Menu'),
(7, 'Dashboard'),
(8, 'Category');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Administrator'),
(2, 'Member');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt', 1),
(2, 2, 'My Profile', 'user', 'fas fa-fw fa-user', 1),
(3, 2, 'Edit Profile', 'user/edit', 'fas fa-fw fa-user-edit', 1),
(4, 3, 'Menu Management', 'menu', 'fas fa-fw fa-folder', 1),
(5, 3, 'Submenu Management', 'menu/submenu', 'fas fa-fw fa-folder-open', 1),
(7, 1, 'Role', 'admin/role', 'fas fa-fw fa-user-tie', 1),
(8, 2, 'Change Password', 'user/changepassword', 'fas fa-fw fa-key', 1),
(10, 7, 'All Products', 'dashboard', 'fas fa-fw fa-swatchbook', 1),
(11, 1, 'Book Data', 'admin/bookdata', 'fas fa-fw fa-database', 1),
(13, 1, 'Invoice', 'admin/invoice', 'fas fa-fw fa-file-invoice', 1),
(14, 8, 'NonFiction', 'category/nonfiction', 'fas fa-fw fa-book', 1),
(15, 8, 'Fiction', 'category/fiction', 'fas fa-fw fa-book', 1),
(16, 8, 'Horror', 'category/horror', 'fas fa-fw fa-book', 1),
(17, 8, 'Romance', 'category/romance', 'fas fa-fw fa-book', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_buku`
--
ALTER TABLE `tbl_buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indexes for table `tbl_invoice`
--
ALTER TABLE `tbl_invoice`
  ADD PRIMARY KEY (`id_invoice`);

--
-- Indexes for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tbl_pesanan`
--
ALTER TABLE `tbl_pesanan`
  ADD PRIMARY KEY (`id_pesan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_buku`
--
ALTER TABLE `tbl_buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbl_invoice`
--
ALTER TABLE `tbl_invoice`
  MODIFY `id_invoice` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_pesanan`
--
ALTER TABLE `tbl_pesanan`
  MODIFY `id_pesan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
