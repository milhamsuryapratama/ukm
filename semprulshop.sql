-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 26 Feb 2019 pada 06.42
-- Versi Server: 10.1.13-MariaDB
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `semprulshop`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`) VALUES
(1, 'admin', 'b63d204bf086017e34d8bd27ab969f28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_produk`
--

CREATE TABLE `kategori_produk` (
  `id_kategori_produk` int(11) NOT NULL,
  `id_seller` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL,
  `kategori_slug` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori_produk`
--

INSERT INTO `kategori_produk` (`id_kategori_produk`, `id_seller`, `nama_kategori`, `kategori_slug`) VALUES
(1, 1, 'Baju', 'baju'),
(2, 1, 'Jaket', 'jaket'),
(3, 2, 'Baju', 'baju'),
(4, 1, 'Makanan', 'makanan'),
(5, 3, 'Baju', 'baju'),
(6, 3, 'Jaket', 'jaket');

-- --------------------------------------------------------

--
-- Struktur dari tabel `konfirmasi`
--

CREATE TABLE `konfirmasi` (
  `id_konfirmasi` int(11) NOT NULL,
  `kode_transaksi` varchar(50) NOT NULL,
  `total_transfer` varchar(50) NOT NULL,
  `id_rekening` int(11) NOT NULL,
  `nama_pengirim` varchar(50) NOT NULL,
  `tanggal_transfer` date NOT NULL,
  `bukti_transfer` varchar(100) NOT NULL,
  `waktu_konfirmasi` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `konfirmasi`
--

INSERT INTO `konfirmasi` (`id_konfirmasi`, `kode_transaksi`, `total_transfer`, `id_rekening`, `nama_pengirim`, `tanggal_transfer`, `bukti_transfer`, `waktu_konfirmasi`) VALUES
(1, 'trx-1547907927', 'Rp. 133,000', 1, 'Yolo Juni', '2019-01-19', 'd22e95b6c751341a4e7521b2ed9758ee.jpg', '2019-01-19 21:27:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_temp`
--

CREATE TABLE `order_temp` (
  `id_order_temp` int(11) NOT NULL,
  `id_session` varchar(100) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `id_ukuran` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `diskon` int(11) NOT NULL,
  `kurir` varchar(50) NOT NULL,
  `service` varchar(50) NOT NULL,
  `etd` varchar(50) NOT NULL,
  `ongkir` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `status` enum('Y','N') NOT NULL,
  `waktu_order_temp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `order_temp`
--

INSERT INTO `order_temp` (`id_order_temp`, `id_session`, `id_produk`, `id_ukuran`, `jumlah`, `harga_jual`, `diskon`, `kurir`, `service`, `etd`, `ongkir`, `total`, `satuan`, `status`, `waktu_order_temp`) VALUES
(1, '4fded1464736e77865df232cbcb4cd19', 4, 9, 1, 50000, 0, '', '', '', 0, 50000, '', 'N', '2019-01-21 14:04:11'),
(2, '4fded1464736e77865df232cbcb4cd19', 3, 5, 1, 65000, 0, '', '', '', 0, 65000, '', 'N', '2019-01-26 13:39:19'),
(3, '4fded1464736e77865df232cbcb4cd19', 5, 10, 1, 75000, 0, '', '', '', 0, 75000, '', 'N', '2019-01-26 13:39:53'),
(4, '4fded1464736e77865df232cbcb4cd19', 4, 9, 1, 50000, 0, '', '', '', 0, 50000, '', 'N', '2019-01-26 13:49:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengembalian`
--

CREATE TABLE `pengembalian` (
  `id` int(11) NOT NULL,
  `id_transaksi_detail` int(11) NOT NULL,
  `kode_transaksi` varchar(100) NOT NULL,
  `id_session` varchar(100) NOT NULL,
  `no_rek` varchar(50) NOT NULL,
  `total` int(11) NOT NULL,
  `waktu_pengajuan` datetime NOT NULL,
  `status_pengembalian` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengembalian`
--

INSERT INTO `pengembalian` (`id`, `id_transaksi_detail`, `kode_transaksi`, `id_session`, `no_rek`, `total`, `waktu_pengajuan`, `status_pengembalian`) VALUES
(1, 14, 'trx-1545873365', '4fded1464736e77865df232cbcb4cd19', '55421854897461', 118000, '2018-12-30 21:28:42', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `id_kategori_produk` int(11) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `produk_slug` varchar(255) NOT NULL,
  `stok` int(11) NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `harga_modal` int(11) NOT NULL,
  `harga_reseller` int(11) NOT NULL,
  `harga_konsumen` int(11) NOT NULL,
  `berat` int(11) NOT NULL,
  `diskon` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `keterangan` text NOT NULL,
  `username` varchar(50) NOT NULL,
  `waktu_input` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `id_kategori_produk`, `nama_produk`, `produk_slug`, `stok`, `satuan`, `harga_modal`, `harga_reseller`, `harga_konsumen`, `berat`, `diskon`, `gambar`, `keterangan`, `username`, `waktu_input`) VALUES
(1, 2, 'JAKET 1', 'jaket-1', 35, '', 0, 0, 50000, 1, 0, '57888d382463baf5c4ba7b7ea51503bd.JPG', 'JAKET 1 JAKET 1 JAKET 1 JAKET 1 ', 'UKM MAKMUR', '2019-01-20 00:09:00'),
(2, 4, 'NASI KOTAK', 'nasi-kotak', 30, '', 0, 0, 25000, 1, 0, 'c4145a5521995e8ab7026d652ecf2fce.JPG', 'NASI KOTAK NASI KOTAK NASI KOTAK ', 'UKM MAKMUR', '2019-01-19 23:33:43'),
(3, 1, 'KAOS 1', 'kaos-1', 50, '', 0, 0, 65000, 1, 0, '80c4d2462c5e2933eca042adfd70cd37.JPG', 'KAOS 1 KAOS 1 KAOS 1 ', 'UKM MAKMUR', '2019-01-19 23:33:59'),
(4, 5, 'BAJU 2', 'baju-2', 30, '', 50000, 0, 50000, 1, 0, 'c07501f86382382102a9b78a2b8074ca.JPG', 'BAJU 2 BAJU 2 BAJU 2 ', 'TOKO A', '2019-01-19 23:10:03'),
(5, 6, 'JAKET 3', 'jaket-3', 19, '', 0, 0, 75000, 1, 0, '1e9bce7c1b3aecca8ef03d7b68b33ef9.JPG', 'JAKET 3 JAKET 3 JAKET 3 ', 'TOKO A', '2019-01-19 21:22:18'),
(6, 1, 'OOO', 'ooo', 10, '', 0, 0, 90000, 1, 0, '484622aa07c3a55853f72b56b6d1e666.jpg', 'OOO', 'UKM MAKMUR', '2019-02-04 16:03:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekening`
--

CREATE TABLE `rekening` (
  `id_rekening` int(11) NOT NULL,
  `nama_bank` varchar(50) NOT NULL,
  `nomor_rekening` varchar(50) NOT NULL,
  `nama_pemilik` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `rekening`
--

INSERT INTO `rekening` (`id_rekening`, `nama_bank`, `nomor_rekening`, `nama_pemilik`) VALUES
(1, 'Mandiri', '547601016142539', 'M. Ilham Surya Pratama'),
(2, 'BRI', '6782287635', 'M. Ilham Surya Pratama');

-- --------------------------------------------------------

--
-- Struktur dari tabel `seller`
--

CREATE TABLE `seller` (
  `id_seller` int(11) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `seller_slug` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `provinsi_id` int(11) NOT NULL,
  `kota_id` int(11) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `id_session_seller` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `seller`
--

INSERT INTO `seller` (`id_seller`, `username`, `password`, `nama`, `nama_lengkap`, `seller_slug`, `email`, `alamat`, `provinsi_id`, `kota_id`, `foto`, `deskripsi`, `id_session_seller`) VALUES
(1, 'ukmmakmur', 'd5ab0df0553ecb4531157849cfe63346', 'UKM MAKMUR', '', 'ukm-makmur', '', 'Maron', 11, 369, '', '', 'd5ab0df0553ecb4531157849cfe63346'),
(2, 'ikmjaya', 'b1e9967c99444c90b2fc2c1154567904', 'IKM JAYA', 'Tatang', 'ikm-jaya', 'ilhamsurya26@gmail.com', 'Dusun Krajan RT 11 RW 03 Desa Wonorejo Kecamatan Maron', 11, 369, '', '', 'b1e9967c99444c90b2fc2c1154567904'),
(3, 'tokoa', 'caf4d37a0e309da2ca43e6c0c4cd1103', 'TOKO A', '', 'toko-a', '', '', 11, 369, '', '', 'caf4d37a0e309da2ca43e6c0c4cd1103'),
(4, 'tokob', '326a7a5babd6ea0001cb98659cce6b92', 'TOKO B', '', 'toko-b', '', '', 11, 369, '', '', '326a7a5babd6ea0001cb98659cce6b92'),
(5, 'tokoc', '111f8a6e4141cfad7149a0a9d72f3ea8', 'TOKO C', '', 'toko-c', '', '', 11, 369, '', '', '111f8a6e4141cfad7149a0a9d72f3ea8'),
(6, 'tokod', '2377b21234a5654c6a94706a464b2225', 'TOKO D', '', 'toko-d', '', '', 11, 369, '', '', '2377b21234a5654c6a94706a464b2225'),
(7, 'tokoe', '8c2a86ea1b80f953cb002d758bb79f1d', 'TOKO E', '', 'toko-e', '', '', 11, 369, '', '', '8c2a86ea1b80f953cb002d758bb79f1d'),
(10, 'ilham', 'b63d204bf086017e34d8bd27ab969f28', 'Toko Admin', '', 'toko-admin', '', '', 11, 369, '', '', 'b63d204bf086017e34d8bd27ab969f28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `test`
--

CREATE TABLE `test` (
  `id` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `file` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `test`
--

INSERT INTO `test` (`id`, `harga_jual`, `jumlah`, `file`) VALUES
(1, 225000, 2, ''),
(2, 35000, 1, ''),
(3, 65000, 1, ''),
(4, 65000, 4, ''),
(5, 35000, 8, ''),
(6, 65000, 4, ''),
(7, 35000, 8, ''),
(8, 225000, 2, ''),
(9, 35000, 1, ''),
(10, 65000, 1, ''),
(11, 225000, 2, ''),
(12, 35000, 1, ''),
(13, 65000, 1, ''),
(14, 225000, 2, ''),
(15, 35000, 1, ''),
(16, 65000, 1, ''),
(17, 65000, 4, ''),
(18, 35000, 8, ''),
(19, 240, 2, '49709a6866f2f05ce98959e46b335d36.jpg'),
(20, 240, 2, '7504ce95bb595332346d59f8a02a12b1.jpg'),
(21, 240, 2, 'f1a635ead2b54ac6172ca67688b524fc.png'),
(22, 240, 2, '68e577669c75b436b029a9af090664b4.png'),
(23, 240, 2, '8defa7d66fc1a7495cc7a51772006025.png'),
(24, 240, 2, 'dfdb8627898e9c7cc5c328c5f525d24a.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `kode_transaksi` varchar(50) NOT NULL,
  `id_pembeli` varchar(50) NOT NULL,
  `waktu_transaksi` datetime NOT NULL,
  `deadline_bayar` datetime NOT NULL,
  `konfirmasi` enum('0','1') NOT NULL,
  `status_transaksi` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `kode_transaksi`, `id_pembeli`, `waktu_transaksi`, `deadline_bayar`, `konfirmasi`, `status_transaksi`) VALUES
(1, 'trx-1547905382', '4fded1464736e77865df232cbcb4cd19', '2019-01-19 20:43:02', '2019-01-21 20:43:02', '0', '0'),
(2, 'trx-1547905836', '4fded1464736e77865df232cbcb4cd19', '2019-01-19 20:50:36', '2019-01-21 20:50:36', '0', '0'),
(3, 'trx-1547906059', '4fded1464736e77865df232cbcb4cd19', '2019-01-19 20:54:19', '2019-01-21 20:54:19', '0', '0'),
(4, 'trx-1547906258', '4fded1464736e77865df232cbcb4cd19', '2019-01-19 20:57:38', '2019-01-21 20:57:38', '0', '0'),
(5, 'trx-1547906355', '4fded1464736e77865df232cbcb4cd19', '2019-01-19 20:59:15', '2019-01-21 20:59:15', '0', '0'),
(6, 'trx-1547906519', '4fded1464736e77865df232cbcb4cd19', '2019-01-19 21:01:59', '2019-01-21 21:01:59', '0', '0'),
(7, 'trx-1547907927', '4fded1464736e77865df232cbcb4cd19', '2019-01-19 21:25:27', '2019-01-21 21:25:27', '1', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `id_transaksi_detail` int(11) NOT NULL,
  `kode_transaksi` varchar(50) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `id_ukuran` int(11) NOT NULL,
  `penjual` varchar(50) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `diskon` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `kurir` varchar(50) NOT NULL,
  `service` varchar(50) NOT NULL,
  `ongkir` int(11) NOT NULL,
  `etd` varchar(50) NOT NULL,
  `deadline_pengiriman` datetime NOT NULL,
  `status` enum('0','1','2','3','4','5') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaksi_detail`
--

INSERT INTO `transaksi_detail` (`id_transaksi_detail`, `kode_transaksi`, `id_produk`, `id_ukuran`, `penjual`, `jumlah`, `harga_jual`, `diskon`, `total`, `satuan`, `kurir`, `service`, `ongkir`, `etd`, `deadline_pengiriman`, `status`) VALUES
(1, 'trx-1547907927', 2, 0, 'UKM MAKMUR', 2, 25000, 0, 50000, '', 'jne', 'CTC', 4000, '1-2', '2019-01-21 21:27:58', '1'),
(2, 'trx-1547907927', 5, 10, 'TOKO A', 1, 75000, 0, 75000, '', 'jne', 'CTC', 4000, '1-2', '2019-01-21 21:27:58', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ukuran`
--

CREATE TABLE `ukuran` (
  `id` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `ukuran` varchar(20) NOT NULL,
  `stok_ukuran` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ukuran`
--

INSERT INTO `ukuran` (`id`, `id_produk`, `ukuran`, `stok_ukuran`) VALUES
(1, 1, 'S', 5),
(2, 1, 'M', 10),
(3, 1, 'XL', 10),
(4, 1, 'XXL', 10),
(5, 3, 'M', 20),
(6, 3, 'L', 15),
(7, 3, 'XL', 15),
(8, 4, 'L', 20),
(9, 4, 'XL', 10),
(10, 5, 'M', 9),
(11, 5, 'L', 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(60) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `alamat_lengkap` text NOT NULL,
  `provinsi_id` int(11) NOT NULL,
  `kota_id` int(11) NOT NULL,
  `no_hp` varchar(12) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `waktu_daftar` datetime NOT NULL,
  `id_session` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama_lengkap`, `email`, `jenis_kelamin`, `tanggal_lahir`, `tempat_lahir`, `alamat_lengkap`, `provinsi_id`, `kota_id`, `no_hp`, `foto`, `waktu_daftar`, `id_session`) VALUES
(1, 'yolo', '4fded1464736e77865df232cbcb4cd19', 'Yolo Juni', 'blogsayailham@gmail.com', 'Laki-laki', '0000-00-00', '', '<p>Dusun Paleran R 11 RW 03 Desa Maron Wetan Kecamatan Maron</p>', 11, 369, '085330150827', '', '2019-01-06 00:48:05', '4fded1464736e77865df232cbcb4cd19'),
(3, 'welek', '4d9f8c3d127adb42e286a3ccab5fb70d', 'Welek Jojo', 'myolshop.confirm@gmail.com', 'Laki-laki', '0000-00-00', '', '<p>Dusun Paleran RT 11 RW 03 Desa Maron Wetan Kecamatan Maron</p>', 11, 370, '085233441557', '', '2019-01-07 00:28:24', '4d9f8c3d127adb42e286a3ccab5fb70d');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `kategori_produk`
--
ALTER TABLE `kategori_produk`
  ADD PRIMARY KEY (`id_kategori_produk`);

--
-- Indexes for table `konfirmasi`
--
ALTER TABLE `konfirmasi`
  ADD PRIMARY KEY (`id_konfirmasi`);

--
-- Indexes for table `order_temp`
--
ALTER TABLE `order_temp`
  ADD PRIMARY KEY (`id_order_temp`);

--
-- Indexes for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `rekening`
--
ALTER TABLE `rekening`
  ADD PRIMARY KEY (`id_rekening`);

--
-- Indexes for table `seller`
--
ALTER TABLE `seller`
  ADD PRIMARY KEY (`id_seller`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD PRIMARY KEY (`id_transaksi_detail`);

--
-- Indexes for table `ukuran`
--
ALTER TABLE `ukuran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `kategori_produk`
--
ALTER TABLE `kategori_produk`
  MODIFY `id_kategori_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `konfirmasi`
--
ALTER TABLE `konfirmasi`
  MODIFY `id_konfirmasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `order_temp`
--
ALTER TABLE `order_temp`
  MODIFY `id_order_temp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `pengembalian`
--
ALTER TABLE `pengembalian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `rekening`
--
ALTER TABLE `rekening`
  MODIFY `id_rekening` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `seller`
--
ALTER TABLE `seller`
  MODIFY `id_seller` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  MODIFY `id_transaksi_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ukuran`
--
ALTER TABLE `ukuran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
