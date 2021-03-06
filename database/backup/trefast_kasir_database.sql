#
# TABLE STRUCTURE FOR: barang
#

DROP TABLE IF EXISTS `barang`;

CREATE TABLE `barang` (
  `kd_barang` varchar(10) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_barang` varchar(50) NOT NULL,
  `stok_barang` int(10) NOT NULL,
  `harga_barang` int(25) NOT NULL,
  `gambar_barang` varchar(255) NOT NULL,
  `keterangan_barang` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO `barang` (`kd_barang`, `id`, `nama_barang`, `stok_barang`, `harga_barang`, `gambar_barang`, `keterangan_barang`) VALUES ('B00001', '1', 'Sprite girl', '71', '130000', 'user1-128x128.jpg', 'opo');
INSERT INTO `barang` (`kd_barang`, `id`, `nama_barang`, `stok_barang`, `harga_barang`, `gambar_barang`, `keterangan_barang`) VALUES ('B00003', '3', 'ujk', '10', '130000', 'user2-160x160.jpg', '                                                                        o\n                        \n                        \n                        ');
INSERT INTO `barang` (`kd_barang`, `id`, `nama_barang`, `stok_barang`, `harga_barang`, `gambar_barang`, `keterangan_barang`) VALUES ('B00004', '4', 'GgGG', '52', '130000', 'Screenshot from 2017-03-23 13-12-26.png', '                        kyy\n                        ');
INSERT INTO `barang` (`kd_barang`, `id`, `nama_barang`, `stok_barang`, `harga_barang`, `gambar_barang`, `keterangan_barang`) VALUES ('B00005', '5', 'Mantap', '2', '12000', 'Screenshot from 2017-03-16 14-55-48.png', 'dqwffqgg');


#
# TABLE STRUCTURE FOR: groups
#

DROP TABLE IF EXISTS `groups`;

CREATE TABLE `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO `groups` (`id`, `name`, `description`) VALUES ('1', 'admin', 'Administrator');
INSERT INTO `groups` (`id`, `name`, `description`) VALUES ('2', 'operator', 'General User Operator');
INSERT INTO `groups` (`id`, `name`, `description`) VALUES ('3', 'IT-Support', 'IT-Support');
INSERT INTO `groups` (`id`, `name`, `description`) VALUES ('4', 'Superadmin', 'General Superadmin');


#
# TABLE STRUCTURE FOR: login_attempts
#

DROP TABLE IF EXISTS `login_attempts`;

CREATE TABLE `login_attempts` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(16) NOT NULL,
  `login` varchar(100) DEFAULT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `login_attempts` (`id`, `ip_address`, `login`, `time`) VALUES ('1', '127.0.0.1', 'mucharomtzaka@gmail.com', '1491732559');


#
# TABLE STRUCTURE FOR: pelanggan
#

DROP TABLE IF EXISTS `pelanggan`;

CREATE TABLE `pelanggan` (
  `idlist` int(11) NOT NULL AUTO_INCREMENT,
  `kode_pelanggan` varchar(50) NOT NULL,
  `nama_pelanggan` varchar(255) NOT NULL,
  `tgl_register` datetime NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `tgl_lahir` date NOT NULL,
  `no_contact` varchar(12) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `alamat` tinytext NOT NULL,
  PRIMARY KEY (`idlist`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO `pelanggan` (`idlist`, `kode_pelanggan`, `nama_pelanggan`, `tgl_register`, `jenis_kelamin`, `tgl_lahir`, `no_contact`, `email`, `alamat`) VALUES ('5', 'P00001', 'Tamopkp', '2017-04-08 12:25:39', 'Perempuan', '2017-04-03', '-', 'sd@yahoo.co.id', '                                        GW\n                    \n                    ');


#
# TABLE STRUCTURE FOR: pengaturan
#

DROP TABLE IF EXISTS `pengaturan`;

CREATE TABLE `pengaturan` (
  `title_bar` varchar(80) DEFAULT NULL,
  `header` varchar(255) DEFAULT NULL,
  `footer` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` tinytext,
  `contact` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `pengaturan` (`title_bar`, `header`, `footer`, `email`, `address`, `contact`) VALUES ('Trefast', 'Trefast Swalayan', 'Trefast Swalayan', 'trefast_swalayan@yahoo.co.id', 'Jl.Pagersari-paturen, Kecamatan Patean , Kabupaten Kendal, Jawa Tengah 51364', '089692412261');


#
# TABLE STRUCTURE FOR: penjualan
#

DROP TABLE IF EXISTS `penjualan`;

CREATE TABLE `penjualan` (
  `id_penjualan` int(11) NOT NULL AUTO_INCREMENT,
  `kode_transaksi` varchar(100) NOT NULL,
  `kode_barang` varchar(100) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `harga_barang` varchar(100) NOT NULL,
  `jml` int(11) NOT NULL,
  `operator` varchar(255) NOT NULL,
  `total_harga` varchar(100) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `waktu` time DEFAULT NULL,
  `shift` varchar(50) DEFAULT NULL,
  `kode_pelanggan` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_penjualan`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

INSERT INTO `penjualan` (`id_penjualan`, `kode_transaksi`, `kode_barang`, `nama_barang`, `harga_barang`, `jml`, `operator`, `total_harga`, `tgl_transaksi`, `waktu`, `shift`, `kode_pelanggan`) VALUES ('1', 'TRANS01', 'B00001', 'Sprite girl', '130000', '1', 'cinta@yahoo.co.id', '130000', '2017-04-08', '21:35:51', '1', '-');
INSERT INTO `penjualan` (`id_penjualan`, `kode_transaksi`, `kode_barang`, `nama_barang`, `harga_barang`, `jml`, `operator`, `total_harga`, `tgl_transaksi`, `waktu`, `shift`, `kode_pelanggan`) VALUES ('2', 'TRANS02', 'B00005', 'Mantap', '12000', '1', 'cinta@yahoo.co.id', '12000', '2017-04-08', '21:50:28', '1', 'P00001');
INSERT INTO `penjualan` (`id_penjualan`, `kode_transaksi`, `kode_barang`, `nama_barang`, `harga_barang`, `jml`, `operator`, `total_harga`, `tgl_transaksi`, `waktu`, `shift`, `kode_pelanggan`) VALUES ('3', 'TRANS03', 'B00005', 'Mantap', '12000', '1', 'cinta@yahoo.co.id', '12000', '2017-04-08', '22:02:53', '1', '');
INSERT INTO `penjualan` (`id_penjualan`, `kode_transaksi`, `kode_barang`, `nama_barang`, `harga_barang`, `jml`, `operator`, `total_harga`, `tgl_transaksi`, `waktu`, `shift`, `kode_pelanggan`) VALUES ('4', 'TRANS04', 'B00004', 'GgGG', '130000', '1', 'cinta@yahoo.co.id', '130000', '2017-04-08', '22:08:39', '1', '');
INSERT INTO `penjualan` (`id_penjualan`, `kode_transaksi`, `kode_barang`, `nama_barang`, `harga_barang`, `jml`, `operator`, `total_harga`, `tgl_transaksi`, `waktu`, `shift`, `kode_pelanggan`) VALUES ('5', 'TRANS05', 'B00005', 'Mantap', '12000', '1', 'cinta@yahoo.co.id', '12000', '2017-04-08', '22:14:15', '1', '');
INSERT INTO `penjualan` (`id_penjualan`, `kode_transaksi`, `kode_barang`, `nama_barang`, `harga_barang`, `jml`, `operator`, `total_harga`, `tgl_transaksi`, `waktu`, `shift`, `kode_pelanggan`) VALUES ('6', 'TRANS06', 'B00005', 'Mantap', '12000', '1', 'cinta@yahoo.co.id', '12000', '2017-04-08', '22:20:24', '1', '');
INSERT INTO `penjualan` (`id_penjualan`, `kode_transaksi`, `kode_barang`, `nama_barang`, `harga_barang`, `jml`, `operator`, `total_harga`, `tgl_transaksi`, `waktu`, `shift`, `kode_pelanggan`) VALUES ('7', 'TRANS07', 'B00005', 'Mantap', '12000', '4', 'cinta@yahoo.co.id', '48000', '2017-04-08', '22:30:20', '1', '');


#
# TABLE STRUCTURE FOR: shift_operator
#

DROP TABLE IF EXISTS `shift_operator`;

CREATE TABLE `shift_operator` (
  `id_shift` int(11) NOT NULL AUTO_INCREMENT,
  `operator` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `shift1` tinyint(1) NOT NULL DEFAULT '0',
  `shift2` tinyint(1) NOT NULL DEFAULT '0',
  `shift3` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id_shift`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO `shift_operator` (`id_shift`, `operator`, `tanggal`, `shift1`, `shift2`, `shift3`) VALUES ('1', 'cinta', '2017-04-03', '1', '0', '0');
INSERT INTO `shift_operator` (`id_shift`, `operator`, `tanggal`, `shift1`, `shift2`, `shift3`) VALUES ('3', 'Nita', '2017-04-03', '0', '1', '0');


#
# TABLE STRUCTURE FOR: users
#

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(16) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(80) NOT NULL,
  `salt` varchar(40) NOT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('1', '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', '', NULL, NULL, '9XvwxyG8lHcV1S2TXsB90u', '1268889823', '1491741630', '1', 'Admin', 'istrator', 'ADMIN', '0');
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('3', '::1', 'cinta@yahoo.co.id', '$2y$08$3OSm1jsZvYnof4Pb6pXMd.va9qqGV0RD62r/hDzgJ0srk3Woy8Fw.', 'SpYbNDoDlL4S9WsLOI/bZO', 'cinta@yahoo.co.id', NULL, 'rjN8wpHFCRb2cI-jyvcZHe237982350c7492878e', '1488380019', NULL, '1487314984', '1491741675', '1', 'cinta', 'cinta', 'trefast development', '12245666');
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES ('4', '127.0.0.1', 'mucharomtzaka@yahoo.co.id', '$2y$08$ugK/B9Zy4cViGZwKyjAfDu8mhnpnw5QzY9Y5bTla/y9t3m5U4jMfW', 'Kn0sqhRbOQAdw4karWob1e', 'mucharomtzaka@yahoo.co.id', NULL, 'ZjyDQ6zz75iPMlDa1T7ISOca46ef9a93df3caca6', '1488481217', NULL, '1487943997', '1491742070', '1', 'Mucha', 'rom', 'Trefastsoft', '089692412261');


#
# TABLE STRUCTURE FOR: users_groups
#

DROP TABLE IF EXISTS `users_groups`;

CREATE TABLE `users_groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('8', '3', '2');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('27', '4', '4');
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES ('28', '1', '1');


