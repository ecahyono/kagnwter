-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 23 Jan 2018 pada 10.28
-- Versi Server: 10.1.19-MariaDB
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kangen_water`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `checkout`
--

CREATE TABLE `checkout` (
  `id_checkout` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_telepon` varchar(20) NOT NULL,
  `bukti_pembayaran` varchar(100) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `checkout`
--

INSERT INTO `checkout` (`id_checkout`, `nama`, `alamat`, `no_telepon`, `bukti_pembayaran`, `tanggal`) VALUES
(1, 'NurarkamiaBatubara', 'jl.sariasih 2 no 50 sarijadi bandung ', '08124758879876', 'Screenshot_2.jpg', '1999-02-26'),
(2, 'eko', 'cijerokasi ', '081373494107', 'Screenshot_2.jpg', '1998-10-19'),
(3, 'eko', 'weidjsfkwdiajsmjs ', '098765432', 'o.jpg', '1222-12-13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `konsumen`
--

CREATE TABLE `konsumen` (
  `id_konsumen` int(11) NOT NULL,
  `email_konsumen` varchar(100) NOT NULL,
  `password_konsumen` varchar(50) NOT NULL,
  `nama_konsumen` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `telepon_konsumen` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `konsumen`
--

INSERT INTO `konsumen` (`id_konsumen`, `email_konsumen`, `password_konsumen`, `nama_konsumen`, `tanggal_lahir`, `alamat`, `telepon_konsumen`) VALUES
(1, 'mia@gmail.com', 'mia', 'Nurarkhamia Batubara', '1999-02-26', 'jl.sariasih 2 no.50 sarijadi bandung', '091234847879');

-- --------------------------------------------------------

--
-- Struktur dari tabel `login_owner`
--

CREATE TABLE `login_owner` (
  `id_owner` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `login_owner`
--

INSERT INTO `login_owner` (`id_owner`, `username`, `password`, `nama_lengkap`) VALUES
(1, 'miabatbara', 'miabatubara', 'Nurarkhamia'),
(2, 'ekocahyo', 'ekocahyo', 'ekocahyoptro'),
(6, 'admin', 'admin', 'ekocahyono');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `id_konsumen` int(11) NOT NULL,
  `tanggal_pembelian` date NOT NULL,
  `total_pembelian` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `id_konsumen`, `tanggal_pembelian`, `total_pembelian`) VALUES
(1, 1, '2018-01-22', 266000),
(2, 1, '2018-01-22', 40000),
(3, 1, '2018-01-22', 50000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian_produk`
--

CREATE TABLE `pembelian_produk` (
  `id_pembelian_produk` int(11) NOT NULL,
  `id_checkout` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah_pembelian_produk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pembelian_produk`
--

INSERT INTO `pembelian_produk` (`id_pembelian_produk`, `id_checkout`, `id_pembelian`, `id_produk`, `jumlah_pembelian_produk`) VALUES
(1, 1, 1, 2, 1),
(2, 1, 1, 11, 1),
(3, 1, 1, 16, 1),
(4, 1, 1, 5, 2),
(5, 2, 2, 18, 1),
(6, 3, 3, 17, 1);

--
-- Trigger `pembelian_produk`
--
DELIMITER $$
CREATE TRIGGER `stok_berkurang` AFTER INSERT ON `pembelian_produk` FOR EACH ROW BEGIN
UPDATE produk SET stok_produk = stok_produk-NEW.jumlah_pembelian_produk
WHERE id_produk=NEW.id_produk;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga_produk` int(11) NOT NULL,
  `stok_produk` int(11) NOT NULL,
  `deskripsi_produk` varchar(100) NOT NULL,
  `foto_produk` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `harga_produk`, `stok_produk`, `deskripsi_produk`, `foto_produk`) VALUES
(2, 'KANGEN WATER Beauty Spray  ', 100000, 33, 'air untuk mempercantik kulit anda', 'beauty.png'),
(5, 'air kangen botol', 8000, 22, 'kangen water sehat dalam botol', 'kangen water.JPG'),
(11, 'Strong Kangen Water', 100000, 33, 'produk kangen water untuk menjaga kesahatn tubuh anda', 'Strong Kangen Water.jpg'),
(15, 'Drinking Water 5L', 35000, 27, 'air minum kangen water ukuran 5 L\r\n', 'Drinking Water.jpg'),
(16, 'kangen water galon', 50000, 28, 'INI AIR AIRAN SEJATI', 'galon.jpg'),
(17, 'Strong Acid', 50000, 21, 'produk kangen water untuk perawatan wajah', 'Strong Acid.jpg'),
(18, 'kangen water ph9,8', 40000, 29, 'airminum kesehatan', 'o.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekening`
--

CREATE TABLE `rekening` (
  `id_rekening` int(11) NOT NULL,
  `nama_rekening` varchar(50) NOT NULL,
  `nomor_rekening` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `rekening`
--

INSERT INTO `rekening` (`id_rekening`, `nama_rekening`, `nomor_rekening`) VALUES
(1, 'BNI', '497066293'),
(2, ' BRI', '399601008168535'),
(3, 'Mandiri', '1070010106211');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sementara`
--

CREATE TABLE `sementara` (
  `nama_produk` varchar(50) NOT NULL,
  `harga_produk` int(11) NOT NULL,
  `jumlah_beli` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `checkout`
--
ALTER TABLE `checkout`
  ADD PRIMARY KEY (`id_checkout`);

--
-- Indexes for table `konsumen`
--
ALTER TABLE `konsumen`
  ADD PRIMARY KEY (`id_konsumen`);

--
-- Indexes for table `login_owner`
--
ALTER TABLE `login_owner`
  ADD PRIMARY KEY (`id_owner`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`),
  ADD KEY `id_konsumen_fk2` (`id_konsumen`);

--
-- Indexes for table `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  ADD PRIMARY KEY (`id_pembelian_produk`),
  ADD KEY `id_pembeli_fk` (`id_pembelian`),
  ADD KEY `id_produk2_fk` (`id_produk`),
  ADD KEY `id_checkout` (`id_checkout`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `checkout`
--
ALTER TABLE `checkout`
  MODIFY `id_checkout` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `konsumen`
--
ALTER TABLE `konsumen`
  MODIFY `id_konsumen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `login_owner`
--
ALTER TABLE `login_owner`
  MODIFY `id_owner` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  MODIFY `id_pembelian_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `rekening`
--
ALTER TABLE `rekening`
  MODIFY `id_rekening` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD CONSTRAINT `id_konsumen_fk2` FOREIGN KEY (`id_konsumen`) REFERENCES `konsumen` (`id_konsumen`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  ADD CONSTRAINT `id_pembeli_fk` FOREIGN KEY (`id_pembelian`) REFERENCES `pembelian` (`id_pembelian`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_produk2_fk` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pembelian_produk_ibfk_1` FOREIGN KEY (`id_checkout`) REFERENCES `checkout` (`id_checkout`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
