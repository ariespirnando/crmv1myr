-- Dumping structure for table pjj2020.adm_tr_pelxsoal
DROP TABLE IF EXISTS `adm_tr_pelxsoal`;
CREATE TABLE IF NOT EXISTS `adm_tr_pelxsoal` (
  `guid_pelxsoal_adm` char(12) NOT NULL,
  `guid_conf_kelas` char(12) NOT NULL,
  `kode_pelajaran` char(15) DEFAULT NULL,
  `kode_kelpelajaran` char(15) DEFAULT NULL,
  `nama_soal` varchar(20) DEFAULT NULL,
  `keterangan` varchar(300) DEFAULT NULL,
  `type_soal` enum('Tugas','Ujian PKD','Ujian PAS') DEFAULT NULL,
  `ideleted` tinyint(1) DEFAULT 0,
  `status` enum('Active','Non Active') DEFAULT 'Non Active',
  `tgl_posting` datetime DEFAULT NULL,
  `waktu_pengerjaan` double DEFAULT 0,
  PRIMARY KEY (`guid_pelxsoal_adm`) USING BTREE,
  KEY `guid_conf_subkelasxpel_ideleted_status` (`guid_conf_kelas`,`ideleted`,`status`) USING BTREE,
  KEY `kode_pelajaran` (`kode_pelajaran`),
  KEY `kode_kelpelajaran` (`kode_kelpelajaran`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Dumping data for table pjj2020.adm_tr_pelxsoal: ~0 rows (approximately)
/*!40000 ALTER TABLE `adm_tr_pelxsoal` DISABLE KEYS */;
/*!40000 ALTER TABLE `adm_tr_pelxsoal` ENABLE KEYS */;

-- Dumping structure for table pjj2020.adm_tr_soal
DROP TABLE IF EXISTS `adm_tr_soal`;
CREATE TABLE IF NOT EXISTS `adm_tr_soal` (
  `guid_soal_adm` char(12) NOT NULL,
  `guid_pelxsoal_adm` char(12) NOT NULL,
  `pertanyaan` text DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `tipe_jawaban` tinyint(4) DEFAULT 0 COMMENT '0 Single 1 Multiple',
  `ideleted` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`guid_soal_adm`) USING BTREE,
  KEY `guid_pelxsoal_ideleted` (`guid_pelxsoal_adm`,`ideleted`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Dumping data for table pjj2020.adm_tr_soal: ~0 rows (approximately)
/*!40000 ALTER TABLE `adm_tr_soal` DISABLE KEYS */;
/*!40000 ALTER TABLE `adm_tr_soal` ENABLE KEYS */;

-- Dumping structure for table pjj2020.adm_tr_soalpilihan
DROP TABLE IF EXISTS `adm_tr_soalpilihan`;
CREATE TABLE IF NOT EXISTS `adm_tr_soalpilihan` (
  `guid_soalpilihan_adm` char(12) NOT NULL,
  `guid_soal_adm` char(12) NOT NULL,
  `option` text DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `score` double DEFAULT 0,
  `ideleted` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`guid_soalpilihan_adm`) USING BTREE,
  KEY `guid_pelxsoal_ideleted` (`guid_soal_adm`,`ideleted`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Dumping data for table pjj2020.adm_tr_soalpilihan: ~0 rows (approximately)
/*!40000 ALTER TABLE `adm_tr_soalpilihan` DISABLE KEYS */;
/*!40000 ALTER TABLE `adm_tr_soalpilihan` ENABLE KEYS */;

-- Dumping structure for table pjj2020.auth_email
DROP TABLE IF EXISTS `auth_email`;
CREATE TABLE IF NOT EXISTS `auth_email` (
  `guid_email` char(12) NOT NULL,
  `kode_user` char(15) NOT NULL,
  `email` varchar(80) NOT NULL,
  `ilock` tinyint(4) NOT NULL DEFAULT 0,
  `ivalid` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 Belom Valid - 1 Sudah Valid',
  `ideleted` tinyint(4) NOT NULL DEFAULT 0,
  `token` text DEFAULT NULL,
  PRIMARY KEY (`guid_email`),
  KEY `KEY` (`kode_user`,`email`,`ilock`,`ivalid`,`ideleted`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
 

-- Dumping structure for table pjj2020.auth_groups
DROP TABLE IF EXISTS `auth_groups`;
CREATE TABLE IF NOT EXISTS `auth_groups` (
  `guid_groups` char(12) NOT NULL,
  `kode_groups` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  `iTipe` varchar(50) DEFAULT '0' COMMENT '0 Internal 1 Public ',
  PRIMARY KEY (`guid_groups`),
  KEY `KEY` (`kode_groups`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table pjj2020.auth_groups: ~7 rows (approximately)
/*!40000 ALTER TABLE `auth_groups` DISABLE KEYS */;
INSERT INTO `auth_groups` (`guid_groups`, `kode_groups`, `description`, `iTipe`) VALUES
	('CA17EAEF2675', 'U-ADMIN', 'STAFF ADMIN', '0'),
	('CA1971FA2675', 'U-SISWA', 'SISWA', '1'),
	('CA1AD3C92675', 'U-GURU', 'STAFF GURU', '0'),
	('CA1BFED02675', 'U-KEPSEK', 'STAFF KEPSEK', '0'),
	('CA1D43EF2675', 'U-KURIKULUM', 'STAFF KURIKULUM', '0');
/*!40000 ALTER TABLE `auth_groups` ENABLE KEYS */;

-- Dumping structure for table pjj2020.auth_history
DROP TABLE IF EXISTS `auth_history`;
CREATE TABLE IF NOT EXISTS `auth_history` (
  `guid_history` char(12) NOT NULL,
  `guid_user` char(12) NOT NULL,
  `ip_address` varchar(50) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `type` enum('Login','Logout','Error404') NOT NULL,
  PRIMARY KEY (`guid_history`),
  KEY `KEY` (`guid_user`,`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
 
-- Dumping structure for table pjj2020.auth_user
DROP TABLE IF EXISTS `auth_user`;
CREATE TABLE IF NOT EXISTS `auth_user` (
  `guid_user` char(12) NOT NULL,
  `guid_groups` char(12) NOT NULL,
  `kode_user` char(15) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(80) NOT NULL,
  `iattempt` int(11) NOT NULL DEFAULT 0,
  `ilock` tinyint(4) NOT NULL DEFAULT 0,
  `ideleted` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`guid_user`),
  KEY `KEY` (`guid_groups`,`iattempt`,`kode_user`,`ilock`,`ideleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- Dumping data for table pjj2020.auth_user: ~13 rows (approximately)
/*!40000 ALTER TABLE `auth_user` DISABLE KEYS */;
INSERT INTO `auth_user` (`guid_user`, `guid_groups`, `kode_user`, `username`, `password`, `iattempt`, `ilock`, `ideleted`) VALUES
	('3B7A3F84E816', 'CA1971FA2675', 'SW-201205821816', '181910313', '593963e7ae9f182568fa3da39d321bb831369e80de71f13b728f1195b508e6046d4', 0, 0, 0),
	('550328953837', 'CA1AD3C92675', 'KR-20112724E837', 'PENGA6012', '560249b3781f781c20e792566d2cfe180120a2ef8b965d367aa2ff0c9195e4311fd', 0, 0, 0), 
	('76527617E816', 'CA1971FA2675', 'SW-201205135816', '181910333', '746e2197049891f6e0a696f919221c4933325ad13a47caca2205cd12ed1a1f78da2', 0, 0, 0),
	('895C981CA918', 'CA1AD3C92675', 'KR-20112782C918', 'PENGA1533', '5907032654b3a17f9cddea0e9296ff8f53369a091d3de8a2f9e7a6dee8855868e39', 0, 0, 0),
	('95CB69CE5816', 'CA1971FA2675', 'SW-201205CC7816', '181910329', 'f95eeb755852c36d9285aa2440cdd50332912ae4274905d5fd3830802421fa19730', 0, 0, 0),
	('999F0C4FC816', 'CA1971FA2675', 'SW-2012054DE816', '181910323', '8699b49b933b58855525da19efc5e7bf32352716a0f18ec31d7aa1882b0374dddbd', 0, 0, 0),
	('B536056F6816', 'CA1971FA2675', 'SW-2012056D5816', '181910331', 'b5be4baa467c9ea75c00c093193ee9ad3315ffaa69773963aeebadc685df46b00c5', 0, 0, 0),
	('E0F7844A4924', 'CA1D43EF2675', 'KR-201127014924', 'KURIK1945', '4c7ec31294694010fdb2ed6ea60a40289456acee62a368b14204992849cf47d9dc5', 0, 0, 0),
	('EEA11F0FB816', 'CA1971FA2675', 'SW-2012050DD816', '181910324', '367e8fe4927cbf25fd405c95d14c50363247034ccba9f2ae19e9319a4b3884d9d2b', 0, 0, 0),
	('F3158D268328', 'CA17EAEF2675', 'KR-2011279B5328', 'ADMIN6503', 'b4874758d80734b3c4e0616d01e257905035824bb6c688b3acbef2c74759457963c', 0, 0, 0),
	('FA069CAE8606', 'CA1BFED02675', 'KR-201127BC7606', 'KEPSE6434', 'ad82f5b7835b6b3917a63fb1b7e6118343490d5e7f2c0c191684e1698ac4fe1d10c', 0, 0, 0) ;
/*!40000 ALTER TABLE `auth_user` ENABLE KEYS */;

-- Dumping structure for table pjj2020.conf_kelas
DROP TABLE IF EXISTS `conf_kelas`;
CREATE TABLE IF NOT EXISTS `conf_kelas` (
  `guid_conf_kelas` char(12) NOT NULL,
  `kode_tahunajaran` char(15) DEFAULT NULL,
  `kode_kelas` char(15) DEFAULT NULL,
  `kode_jurusan` char(15) DEFAULT NULL,
  `ideleted` tinyint(1) DEFAULT 0,
  `validpelajaran` enum('Valid','Non Valid') DEFAULT 'Non Valid',
  `validsubkelas` enum('Valid','Non Valid') DEFAULT 'Non Valid',
  PRIMARY KEY (`guid_conf_kelas`),
  KEY `KEY` (`kode_tahunajaran`,`kode_kelas`,`kode_jurusan`,`ideleted`,`validpelajaran`,`validsubkelas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Dumping data for table pjj2020.conf_kelas: ~2 rows (approximately)
/*!40000 ALTER TABLE `conf_kelas` DISABLE KEYS */;
INSERT INTO `conf_kelas` (`guid_conf_kelas`, `kode_tahunajaran`, `kode_kelas`, `kode_jurusan`, `ideleted`, `validpelajaran`, `validsubkelas`) VALUES
	('13D2AC793751', 'TA-201207663706', 'KE-201113C92017', 'JR-201113447739', 0, 'Valid', 'Valid'),
	('C52535A87740', 'TA-201207663706', 'KE-201113C92017', 'JR-20111367A804', 0, 'Valid', 'Valid');
/*!40000 ALTER TABLE `conf_kelas` ENABLE KEYS */;

-- Dumping structure for table pjj2020.conf_kelasxpel
DROP TABLE IF EXISTS `conf_kelasxpel`;
CREATE TABLE IF NOT EXISTS `conf_kelasxpel` (
  `iconf_kelasxpel` int(11) NOT NULL AUTO_INCREMENT,
  `guid_conf_kelas` char(12) NOT NULL,
  `kode_pelajaran` char(15) DEFAULT NULL,
  `kode_kelpelajaran` char(15) DEFAULT NULL,
  `nama_pelajaran` varchar(80) DEFAULT NULL,
  `akronim` varchar(50) DEFAULT NULL,
  `iurutan` int(11) DEFAULT NULL,
  `kkm` double DEFAULT NULL,
  `ideleted` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`iconf_kelasxpel`) USING BTREE,
  KEY `KEY` (`guid_conf_kelas`,`kode_pelajaran`,`kode_kelpelajaran`,`ideleted`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Dumping data for table pjj2020.conf_kelasxpel: ~34 rows (approximately)
/*!40000 ALTER TABLE `conf_kelasxpel` DISABLE KEYS */;
INSERT INTO `conf_kelasxpel` (`iconf_kelasxpel`, `guid_conf_kelas`, `kode_pelajaran`, `kode_kelpelajaran`, `nama_pelajaran`, `akronim`, `iurutan`, `kkm`, `ideleted`) VALUES
	(1, '13D2AC793751', 'PE-2011137D8424', 'KP-2011137F6245', 'Pendidikan Agama dan Budi Pekerti', 'AGAMA', 1, 75, 0),
	(2, '13D2AC793751', 'PE-2011136A6642', 'KP-2011137F6245', 'Pendidikan Pancasila dan Kewarganegaraan', 'PKN', 2, 75, 0),
	(3, '13D2AC793751', 'PE-201113603654', 'KP-2011137F6245', 'Bahasa Indonesia', 'BINDO', 3, 75, 0),
	(4, '13D2AC793751', 'PE-201113401732', 'KP-2011137F6245', 'Matematika', 'MTKW', 4, 75, 0),
	(5, '13D2AC793751', 'PE-201113785746', 'KP-2011137F6245', 'Sejarah Indonesia', 'SEJW', 5, 75, 0),
	(6, '13D2AC793751', 'PE-201113734719', 'KP-2011137F6245', 'Bahasa Inggris', 'BING', 6, 75, 0),
	(7, '13D2AC793751', 'PE-201113DA3802', 'KP-2011131F3255', 'Seni Budaya', 'SBD', 7, 75, 0),
	(8, '13D2AC793751', 'PE-201113643902', 'KP-2011131F3255', 'Pendidikan Jasmani, Olahraga dan Kesehatan', 'PJOK', 8, 75, 0),
	(9, '13D2AC793751', 'PE-2011138D3814', 'KP-2011131F3255', 'Prakarya dan Kewirausahaan', 'PKWU', 9, 75, 0),
	(10, '13D2AC793751', 'PE-201113EB1048', 'KP-201113434304', 'Matematika Minat', 'MTKM', 10, 75, 0),
	(11, '13D2AC793751', 'PE-2011136D5100', 'KP-201113434304', 'Fisika', 'FISI', 11, 75, 0),
	(12, '13D2AC793751', 'PE-20111311B850', 'KP-201113434304', 'Kimia', 'KIMI', 12, 75, 0),
	(13, '13D2AC793751', 'PE-201113020127', 'KP-201113434304', 'Biologi', 'BIO', 13, 75, 0),
	(14, '13D2AC793751', 'PE-201113A50600', 'KP-201113C4D323', 'Ekonomi Lintas Minat', 'EKONLM', 14, 75, 0),
	(15, '13D2AC793751', 'PE-2011134A4116', 'KP-201113C4D323', 'Bahasa Jepang', 'BJEPANG', 15, 75, 0),
	(16, '13D2AC793751', 'PE-201113709629', 'KP-20111352E334', 'Bahasa Sunda', 'SUNDA', 16, 75, 0),
	(17, '13D2AC793751', 'PE-201113464037', 'KP-20111352E334', 'Lingkungan Hidup', 'LH', 17, 75, 0),
	(32, 'C52535A87740', 'PE-2011137D8424', 'KP-2011137F6245', 'Pendidikan Agama dan Budi Pekerti', 'AGAMA', 1, 75, 0),
	(33, 'C52535A87740', 'PE-2011136A6642', 'KP-2011137F6245', 'Pendidikan Pancasila dan Kewarganegaraan', 'PKN', 2, 75, 0),
	(34, 'C52535A87740', 'PE-201113603654', 'KP-2011137F6245', 'Bahasa Indonesia', 'BINDO', 3, 75, 0),
	(35, 'C52535A87740', 'PE-201113401732', 'KP-2011137F6245', 'Matematika', 'MTKW', 4, 75, 0),
	(36, 'C52535A87740', 'PE-201113785746', 'KP-2011137F6245', 'Sejarah Indonesia', 'SEJW', 5, 75, 0),
	(37, 'C52535A87740', 'PE-201113734719', 'KP-2011137F6245', 'Bahasa Inggris', 'BING', 6, 75, 0),
	(38, 'C52535A87740', 'PE-201113DA3802', 'KP-2011131F3255', 'Seni Budaya', 'SBD', 7, 75, 0),
	(39, 'C52535A87740', 'PE-201113643902', 'KP-2011131F3255', 'Pendidikan Jasmani, Olahraga dan Kesehatan', 'PJOK', 8, 75, 0),
	(40, 'C52535A87740', 'PE-2011138D3814', 'KP-2011131F3255', 'Prakarya dan Kewirausahaan', 'PKWU', 9, 75, 0),
	(41, 'C52535A87740', 'PE-201113BCA545', 'KP-201113434304', 'Sejarah', 'SEJM', 10, 75, 0),
	(42, 'C52535A87740', 'PE-201113B15438', 'KP-201113434304', 'Geografi', 'GEO', 11, 75, 0),
	(43, 'C52535A87740', 'PE-2011139B5613', 'KP-201113434304', 'Ekonomi', 'EKON', 12, 75, 0),
	(44, 'C52535A87740', 'PE-201113A26457', 'KP-201113434304', 'Sosiologi', 'SOSIO', 13, 75, 0),
	(45, 'C52535A87740', 'PE-201113321836', 'KP-201113C4D323', 'Kimia Lintas Minat', 'KIMILM', 14, 75, 0),
	(46, 'C52535A87740', 'PE-2011134A4116', 'KP-201113C4D323', 'Bahasa Jepang', 'BJEPANG', 15, 75, 0),
	(47, 'C52535A87740', 'PE-201113709629', 'KP-20111352E334', 'Bahasa Sunda', 'SUNDA', 16, 75, 0),
	(48, 'C52535A87740', 'PE-201113464037', 'KP-20111352E334', 'Lingkungan Hidup', 'LH', 17, 75, 0);
/*!40000 ALTER TABLE `conf_kelasxpel` ENABLE KEYS */;

-- Dumping structure for table pjj2020.conf_kelasxsubkelas
DROP TABLE IF EXISTS `conf_kelasxsubkelas`;
CREATE TABLE IF NOT EXISTS `conf_kelasxsubkelas` (
  `guid_conf_kelasxsubkelas` char(12) NOT NULL,
  `guid_conf_kelas` char(12) NOT NULL,
  `kode_karyawan` char(15) DEFAULT NULL,
  `nama_subkelas` varchar(12) DEFAULT NULL,
  `ideleted` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`guid_conf_kelasxsubkelas`),
  KEY `KEY` (`guid_conf_kelas`,`ideleted`,`kode_karyawan`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Dumping data for table pjj2020.conf_kelasxsubkelas: ~4 rows (approximately)
/*!40000 ALTER TABLE `conf_kelasxsubkelas` DISABLE KEYS */;
INSERT INTO `conf_kelasxsubkelas` (`guid_conf_kelasxsubkelas`, `guid_conf_kelas`, `kode_karyawan`, `nama_subkelas`, `ideleted`) VALUES
	('11D4E9198831', 'C52535A87740', 'KR-20112724E837', 'X IPS 1', 0),
	('39A5883E3820', '13D2AC793751', 'KR-20112724E837', 'X IPA 2', 0),
	('C4F95664D838', 'C52535A87740', 'KR-20112782C918', 'X IPS 2', 0),
	('FA8A56FF2814', '13D2AC793751', 'KR-20112782C918', 'X IPA 1', 0);
/*!40000 ALTER TABLE `conf_kelasxsubkelas` ENABLE KEYS */;

-- Dumping structure for table pjj2020.conf_subkelasxpel
DROP TABLE IF EXISTS `conf_subkelasxpel`;
CREATE TABLE IF NOT EXISTS `conf_subkelasxpel` (
  `guid_conf_subkelasxpel` char(12) NOT NULL,
  `guid_conf_kelasxsubkelas` char(12) NOT NULL,
  `kode_pelajaran` char(15) DEFAULT NULL,
  `kode_kelpelajaran` char(15) DEFAULT NULL,
  `nama_pelajaran` varchar(80) DEFAULT NULL,
  `iurutan` int(11) DEFAULT NULL,
  `kode_karyawan` char(15) DEFAULT NULL,
  `guid_hari` char(12) DEFAULT NULL,
  `jam_mulai` time DEFAULT NULL,
  `jam_selesai` time DEFAULT NULL,
  `status` enum('Active','Non Active') DEFAULT 'Non Active',
  `ideleted` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`guid_conf_subkelasxpel`),
  KEY `KEY` (`kode_pelajaran`,`kode_kelpelajaran`,`ideleted`,`guid_conf_kelasxsubkelas`,`kode_karyawan`,`guid_hari`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Dumping data for table pjj2020.conf_subkelasxpel: ~68 rows (approximately)
/*!40000 ALTER TABLE `conf_subkelasxpel` DISABLE KEYS */;
INSERT INTO `conf_subkelasxpel` (`guid_conf_subkelasxpel`, `guid_conf_kelasxsubkelas`, `kode_pelajaran`, `kode_kelpelajaran`, `nama_pelajaran`, `iurutan`, `kode_karyawan`, `guid_hari`, `jam_mulai`, `jam_selesai`, `status`, `ideleted`) VALUES
	('13BF6B8638A5', '39A5883E3820', 'PE-201113020127', 'KP-201113434304', 'Biologi', 13, NULL, NULL, NULL, NULL, 'Non Active', 0),
	('13BF774838A5', '39A5883E3820', 'PE-20111311B850', 'KP-201113434304', 'Kimia', 12, NULL, NULL, NULL, NULL, 'Non Active', 0),
	('13BF78DE38A5', '39A5883E3820', 'PE-201113401732', 'KP-2011137F6245', 'Matematika', 4, NULL, NULL, NULL, NULL, 'Non Active', 0),
	('13BF79C738A5', '39A5883E3820', 'PE-201113464037', 'KP-20111352E334', 'Lingkungan Hidup', 17, NULL, NULL, NULL, NULL, 'Non Active', 0),
	('13BF816238A5', '39A5883E3820', 'PE-2011134A4116', 'KP-201113C4D323', 'Bahasa Jepang', 15, NULL, NULL, NULL, NULL, 'Non Active', 0),
	('13BF825F38A5', '39A5883E3820', 'PE-201113603654', 'KP-2011137F6245', 'Bahasa Indonesia', 3, NULL, NULL, NULL, NULL, 'Non Active', 0),
	('13BF831D38A5', '39A5883E3820', 'PE-201113643902', 'KP-2011131F3255', 'Pendidikan Jasmani, Olahraga dan Kesehatan', 8, NULL, NULL, NULL, NULL, 'Non Active', 0),
	('13BF83DB38A5', '39A5883E3820', 'PE-2011136A6642', 'KP-2011137F6245', 'Pendidikan Pancasila dan Kewarganegaraan', 2, NULL, NULL, NULL, NULL, 'Non Active', 0),
	('13BF844438A5', '39A5883E3820', 'PE-2011136D5100', 'KP-201113434304', 'Fisika', 11, NULL, NULL, NULL, NULL, 'Non Active', 0),
	('13BF849038A5', '39A5883E3820', 'PE-201113709629', 'KP-20111352E334', 'Bahasa Sunda', 16, NULL, NULL, NULL, NULL, 'Non Active', 0),
	('13BF84DA38A5', '39A5883E3820', 'PE-201113734719', 'KP-2011137F6245', 'Bahasa Inggris', 6, NULL, NULL, NULL, NULL, 'Non Active', 0),
	('13BF852F38A5', '39A5883E3820', 'PE-201113785746', 'KP-2011137F6245', 'Sejarah Indonesia', 5, NULL, NULL, NULL, NULL, 'Non Active', 0),
	('13BF857C38A5', '39A5883E3820', 'PE-2011137D8424', 'KP-2011137F6245', 'Pendidikan Agama dan Budi Pekerti', 1, NULL, NULL, NULL, NULL, 'Non Active', 0),
	('13BF85C738A5', '39A5883E3820', 'PE-2011138D3814', 'KP-2011131F3255', 'Prakarya dan Kewirausahaan', 9, 'KR-20112724E837', 'D8DE8245C739', '08:00:00', '10:00:00', 'Active', 0),
	('13BF861138A5', '39A5883E3820', 'PE-201113A50600', 'KP-201113C4D323', 'Ekonomi Lintas Minat', 14, NULL, NULL, NULL, NULL, 'Non Active', 0),
	('13BF866D38A5', '39A5883E3820', 'PE-201113DA3802', 'KP-2011131F3255', 'Seni Budaya', 7, 'KR-20112782C918', 'B5838DDB0842', '11:00:00', '13:00:00', 'Active', 0),
	('13BF86E138A5', '39A5883E3820', 'PE-201113EB1048', 'KP-201113434304', 'Matematika Minat', 10, NULL, NULL, NULL, NULL, 'Non Active', 0),
	('13BFF22138A5', 'FA8A56FF2814', 'PE-201113020127', 'KP-201113434304', 'Biologi', 13, NULL, NULL, NULL, NULL, 'Non Active', 0),
	('13BFFBCB38A5', 'FA8A56FF2814', 'PE-20111311B850', 'KP-201113434304', 'Kimia', 12, NULL, NULL, NULL, NULL, 'Non Active', 0),
	('13BFFC6538A5', 'FA8A56FF2814', 'PE-201113401732', 'KP-2011137F6245', 'Matematika', 4, NULL, NULL, NULL, NULL, 'Non Active', 0),
	('13BFFCD438A5', 'FA8A56FF2814', 'PE-201113464037', 'KP-20111352E334', 'Lingkungan Hidup', 17, NULL, NULL, NULL, NULL, 'Non Active', 0),
	('13BFFD4238A5', 'FA8A56FF2814', 'PE-2011134A4116', 'KP-201113C4D323', 'Bahasa Jepang', 15, NULL, NULL, NULL, NULL, 'Non Active', 0),
	('13BFFD9B38A5', 'FA8A56FF2814', 'PE-201113603654', 'KP-2011137F6245', 'Bahasa Indonesia', 3, NULL, NULL, NULL, NULL, 'Non Active', 0),
	('13BFFDF638A5', 'FA8A56FF2814', 'PE-201113643902', 'KP-2011131F3255', 'Pendidikan Jasmani, Olahraga dan Kesehatan', 8, NULL, NULL, NULL, NULL, 'Non Active', 0),
	('13BFFE5238A5', 'FA8A56FF2814', 'PE-2011136A6642', 'KP-2011137F6245', 'Pendidikan Pancasila dan Kewarganegaraan', 2, NULL, NULL, NULL, NULL, 'Non Active', 0),
	('13BFFEB238A5', 'FA8A56FF2814', 'PE-2011136D5100', 'KP-201113434304', 'Fisika', 11, NULL, NULL, NULL, NULL, 'Non Active', 0),
	('13BFFF0738A5', 'FA8A56FF2814', 'PE-201113709629', 'KP-20111352E334', 'Bahasa Sunda', 16, 'KR-20112782C918', 'D8DE8245C739', '10:00:00', '12:00:00', 'Active', 0),
	('13BFFF5D38A5', 'FA8A56FF2814', 'PE-201113734719', 'KP-2011137F6245', 'Bahasa Inggris', 6, NULL, NULL, NULL, NULL, 'Non Active', 0),
	('13BFFFBC38A5', 'FA8A56FF2814', 'PE-201113785746', 'KP-2011137F6245', 'Sejarah Indonesia', 5, NULL, NULL, NULL, NULL, 'Non Active', 0),
	('13C0000F38A5', 'FA8A56FF2814', 'PE-2011137D8424', 'KP-2011137F6245', 'Pendidikan Agama dan Budi Pekerti', 1, NULL, NULL, NULL, NULL, 'Non Active', 0),
	('13C0006938A5', 'FA8A56FF2814', 'PE-2011138D3814', 'KP-2011131F3255', 'Prakarya dan Kewirausahaan', 9, NULL, NULL, NULL, NULL, 'Non Active', 0),
	('13C000BF38A5', 'FA8A56FF2814', 'PE-201113A50600', 'KP-201113C4D323', 'Ekonomi Lintas Minat', 14, NULL, NULL, NULL, NULL, 'Non Active', 0),
	('13C0011D38A5', 'FA8A56FF2814', 'PE-201113DA3802', 'KP-2011131F3255', 'Seni Budaya', 7, NULL, NULL, NULL, NULL, 'Non Active', 0),
	('13C0017538A5', 'FA8A56FF2814', 'PE-201113EB1048', 'KP-201113434304', 'Matematika Minat', 10, NULL, NULL, NULL, NULL, 'Non Active', 0),
	('14F8406938A5', '11D4E9198831', 'PE-201113321836', 'KP-201113C4D323', 'Kimia Lintas Minat', 14, NULL, NULL, NULL, NULL, 'Non Active', 0),
	('14F8498138A5', '11D4E9198831', 'PE-201113401732', 'KP-2011137F6245', 'Matematika', 4, 'KR-20112724E837', NULL, NULL, NULL, 'Non Active', 0),
	('14F84A7738A5', '11D4E9198831', 'PE-201113464037', 'KP-20111352E334', 'Lingkungan Hidup', 17, NULL, NULL, NULL, NULL, 'Non Active', 0),
	('14F84B0C38A5', '11D4E9198831', 'PE-2011134A4116', 'KP-201113C4D323', 'Bahasa Jepang', 15, NULL, NULL, NULL, NULL, 'Non Active', 0),
	('14F84BA938A5', '11D4E9198831', 'PE-201113603654', 'KP-2011137F6245', 'Bahasa Indonesia', 3, 'KR-20112724E837', '6A243068E804', '08:00:00', '10:00:00', 'Active', 0),
	('14F84C2B38A5', '11D4E9198831', 'PE-201113643902', 'KP-2011131F3255', 'Pendidikan Jasmani, Olahraga dan Kesehatan', 8, NULL, NULL, NULL, NULL, 'Non Active', 0),
	('14F84CB238A5', '11D4E9198831', 'PE-2011136A6642', 'KP-2011137F6245', 'Pendidikan Pancasila dan Kewarganegaraan', 2, NULL, NULL, NULL, NULL, 'Non Active', 0),
	('14F84D3938A5', '11D4E9198831', 'PE-201113709629', 'KP-20111352E334', 'Bahasa Sunda', 16, NULL, NULL, NULL, NULL, 'Non Active', 0),
	('14F84E7C38A5', '11D4E9198831', 'PE-201113734719', 'KP-2011137F6245', 'Bahasa Inggris', 6, 'KR-20112782C918', 'B5838DDB0842', '08:00:00', '10:00:00', 'Active', 0),
	('14F84FA738A5', '11D4E9198831', 'PE-201113785746', 'KP-2011137F6245', 'Sejarah Indonesia', 5, NULL, NULL, NULL, NULL, 'Non Active', 0),
	('14F8508438A5', '11D4E9198831', 'PE-2011137D8424', 'KP-2011137F6245', 'Pendidikan Agama dan Budi Pekerti', 1, NULL, NULL, NULL, NULL, 'Non Active', 0),
	('14F851AE38A5', '11D4E9198831', 'PE-2011138D3814', 'KP-2011131F3255', 'Prakarya dan Kewirausahaan', 9, NULL, NULL, NULL, NULL, 'Non Active', 0),
	('14F8526838A5', '11D4E9198831', 'PE-2011139B5613', 'KP-201113434304', 'Ekonomi', 12, NULL, NULL, NULL, NULL, 'Non Active', 0),
	('14F8532538A5', '11D4E9198831', 'PE-201113A26457', 'KP-201113434304', 'Sosiologi', 13, NULL, NULL, NULL, NULL, 'Non Active', 0),
	('14F853DE38A5', '11D4E9198831', 'PE-201113B15438', 'KP-201113434304', 'Geografi', 11, NULL, NULL, NULL, NULL, 'Non Active', 0),
	('14F854D538A5', '11D4E9198831', 'PE-201113BCA545', 'KP-201113434304', 'Sejarah', 10, NULL, NULL, NULL, NULL, 'Non Active', 0),
	('14F855B338A5', '11D4E9198831', 'PE-201113DA3802', 'KP-2011131F3255', 'Seni Budaya', 7, NULL, NULL, NULL, NULL, 'Non Active', 0),
	('14F8BAC638A5', 'C4F95664D838', 'PE-201113321836', 'KP-201113C4D323', 'Kimia Lintas Minat', 14, NULL, NULL, NULL, NULL, 'Non Active', 0),
	('14F8C6A738A5', 'C4F95664D838', 'PE-201113401732', 'KP-2011137F6245', 'Matematika', 4, 'KR-20112782C918', '6A243068E804', '13:00:00', '15:00:00', 'Active', 0),
	('14F8C77238A5', 'C4F95664D838', 'PE-201113464037', 'KP-20111352E334', 'Lingkungan Hidup', 17, NULL, NULL, NULL, NULL, 'Non Active', 0),
	('14F8C7F538A5', 'C4F95664D838', 'PE-2011134A4116', 'KP-201113C4D323', 'Bahasa Jepang', 15, NULL, NULL, NULL, NULL, 'Non Active', 0),
	('14F8C88138A5', 'C4F95664D838', 'PE-201113603654', 'KP-2011137F6245', 'Bahasa Indonesia', 3, NULL, NULL, NULL, NULL, 'Non Active', 0),
	('14F8C90038A5', 'C4F95664D838', 'PE-201113643902', 'KP-2011131F3255', 'Pendidikan Jasmani, Olahraga dan Kesehatan', 8, NULL, NULL, NULL, NULL, 'Non Active', 0),
	('14F8C97838A5', 'C4F95664D838', 'PE-2011136A6642', 'KP-2011137F6245', 'Pendidikan Pancasila dan Kewarganegaraan', 2, NULL, NULL, NULL, NULL, 'Non Active', 0),
	('14F8C9E838A5', 'C4F95664D838', 'PE-201113709629', 'KP-20111352E334', 'Bahasa Sunda', 16, NULL, NULL, NULL, NULL, 'Non Active', 0),
	('14F8CA6438A5', 'C4F95664D838', 'PE-201113734719', 'KP-2011137F6245', 'Bahasa Inggris', 6, NULL, NULL, NULL, NULL, 'Non Active', 0),
	('14F8CADA38A5', 'C4F95664D838', 'PE-201113785746', 'KP-2011137F6245', 'Sejarah Indonesia', 5, NULL, NULL, NULL, NULL, 'Non Active', 0),
	('14F8CB4838A5', 'C4F95664D838', 'PE-2011137D8424', 'KP-2011137F6245', 'Pendidikan Agama dan Budi Pekerti', 1, NULL, NULL, NULL, NULL, 'Non Active', 0),
	('14F8CBC638A5', 'C4F95664D838', 'PE-2011138D3814', 'KP-2011131F3255', 'Prakarya dan Kewirausahaan', 9, NULL, NULL, NULL, NULL, 'Non Active', 0),
	('14F8CC3538A5', 'C4F95664D838', 'PE-2011139B5613', 'KP-201113434304', 'Ekonomi', 12, NULL, NULL, NULL, NULL, 'Non Active', 0),
	('14F8CCA638A5', 'C4F95664D838', 'PE-201113A26457', 'KP-201113434304', 'Sosiologi', 13, NULL, NULL, NULL, NULL, 'Non Active', 0),
	('14F8CD1938A5', 'C4F95664D838', 'PE-201113B15438', 'KP-201113434304', 'Geografi', 11, NULL, NULL, NULL, NULL, 'Non Active', 0),
	('14F8CD9038A5', 'C4F95664D838', 'PE-201113BCA545', 'KP-201113434304', 'Sejarah', 10, 'KR-20112724E837', 'B5838DDB0842', '13:00:00', '15:00:00', 'Active', 0),
	('14F8CDFD38A5', 'C4F95664D838', 'PE-201113DA3802', 'KP-2011131F3255', 'Seni Budaya', 7, NULL, NULL, NULL, NULL, 'Non Active', 0);
/*!40000 ALTER TABLE `conf_subkelasxpel` ENABLE KEYS */;

-- Dumping structure for table pjj2020.conf_subkelasxsiswa
DROP TABLE IF EXISTS `conf_subkelasxsiswa`;
CREATE TABLE IF NOT EXISTS `conf_subkelasxsiswa` (
  `guid_conf_subkelasxsiswa` char(12) NOT NULL,
  `guid_conf_kelasxsubkelas` char(12) NOT NULL,
  `kode_siswa` char(15) DEFAULT NULL,
  `ideleted` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`guid_conf_subkelasxsiswa`),
  KEY `KEY` (`guid_conf_kelasxsubkelas`,`kode_siswa`,`ideleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Dumping data for table pjj2020.conf_subkelasxsiswa: ~7 rows (approximately)
/*!40000 ALTER TABLE `conf_subkelasxsiswa` DISABLE KEYS */;
INSERT INTO `conf_subkelasxsiswa` (`guid_conf_subkelasxsiswa`, `guid_conf_kelasxsubkelas`, `kode_siswa`, `ideleted`) VALUES
	('7C5793B46018', '11D4E9198831', 'SW-201205821816', 0),
	('06668A337919', '11D4E9198831', 'SW-201205CC7816', 0),
	('6B58AE7B4935', '39A5883E3820', 'SW-201205135816', 0),
	('3ABAEE1E9055', 'C4F95664D838', 'SW-2012050DD816', 0),
	('D06BDB26A943', 'C4F95664D838', 'SW-2012056D5816', 0),
	('897DF5D10953', 'FA8A56FF2814', 'SW-2012050DD816', 1),
	('3FCBEC6CF030', 'FA8A56FF2814', 'SW-2012054DE816', 0);
/*!40000 ALTER TABLE `conf_subkelasxsiswa` ENABLE KEYS */;

-- Dumping structure for table pjj2020.dt_jurusan
DROP TABLE IF EXISTS `dt_jurusan`;
CREATE TABLE IF NOT EXISTS `dt_jurusan` (
  `guid_jurusan` char(12) NOT NULL,
  `kode_jurusan` char(15) NOT NULL,
  `nama_jurusan` varchar(50) DEFAULT NULL,
  `akronim` varchar(10) DEFAULT NULL,
  `status` enum('Active','Non Active') DEFAULT 'Active',
  `ideleted` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`guid_jurusan`),
  KEY `KEY` (`kode_jurusan`,`status`,`ideleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Dumping data for table pjj2020.dt_jurusan: ~3 rows (approximately)
/*!40000 ALTER TABLE `dt_jurusan` DISABLE KEYS */;
INSERT INTO `dt_jurusan` (`guid_jurusan`, `kode_jurusan`, `nama_jurusan`, `akronim`, `status`, `ideleted`) VALUES
	('6A243068E804', 'JR-20111367A804', 'Ilmu Pengetahuan Sosial', 'IPS', 'Active', 0),
	('B5838DDB0842', 'JR-201113D9C842', 'Ilmu Bahasa dan Budaya', 'IBB', 'Active', 0),
	('D8DE8245C739', 'JR-201113447739', 'Ilmu Pengetahuan Alam', 'IPA', 'Active', 0);
/*!40000 ALTER TABLE `dt_jurusan` ENABLE KEYS */;

-- Dumping structure for table pjj2020.dt_karyawan
DROP TABLE IF EXISTS `dt_karyawan`;
CREATE TABLE IF NOT EXISTS `dt_karyawan` (
  `guid_karyawan` char(12) NOT NULL,
  `guid_groups` char(12) NOT NULL,
  `kode_karyawan` char(15) NOT NULL,
  `nama_karyawan` varchar(50) DEFAULT NULL,
  `nik_karyawan` varchar(12) DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `nohandpone` varchar(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `status` enum('Active','Non Active') DEFAULT 'Active',
  `ideleted` tinyint(1) DEFAULT 0,
  `tempat_lahir` varchar(20) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `pendidikan_terakhir` varchar(50) DEFAULT NULL,
  `jurusan` varchar(50) DEFAULT NULL,
  `dateinsupt` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`guid_karyawan`),
  KEY `KEY` (`kode_karyawan`,`jenis_kelamin`,`ideleted`,`status`,`guid_groups`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Dumping data for table pjj2020.dt_karyawan: ~6 rows (approximately)
/*!40000 ALTER TABLE `dt_karyawan` DISABLE KEYS */;
INSERT INTO `dt_karyawan` (`guid_karyawan`, `guid_groups`, `kode_karyawan`, `nama_karyawan`, `nik_karyawan`, `jenis_kelamin`, `nohandpone`, `alamat`, `status`, `ideleted`, `tempat_lahir`, `tanggal_lahir`, `pendidikan_terakhir`, `jurusan`, `dateinsupt`) VALUES
	('1A335B024924', 'CA1D43EF2675', 'KR-201127014924', 'KURIKULUM 1 PJJ', '-', 'Laki-laki', '', '', 'Active', 0, 'JAKARTA', '0001-01-01', 'SARJANA', 'BAHASA INGGRIS', '2020-11-27 19:33:44'),
	('4B13D69C6328', 'CA17EAEF2675', 'KR-2011279B5328', 'ADMIN 1 PJJ', '-', 'Laki-laki', '', '', 'Active', 0, 'JAKARTA', '0001-01-01', 'SARJANA', 'KOMPUTER', '2020-11-27 19:33:44'),
	('8CB75683B918', 'CA1AD3C92675', 'KR-20112782C918', 'PENGAJAR 2 PJJ', '00000002', 'Laki-laki', '', '', 'Active', 0, 'JAKARTA', '0001-01-01', 'SARJANA', 'EKONOMI', '2020-11-27 19:39:18'),
	('DD6AABBD8606', 'CA1BFED02675', 'KR-201127BC7606', 'KEPSEK 1 PJJ', '-', 'Laki-laki', '', '', 'Active', 0, 'JAKARTA', '0001-01-01', 'SARJANA', 'MANAJEMEN', '2020-11-27 19:36:06'),
	('DF9F5725D837', 'CA1AD3C92675', 'KR-20112724E837', 'PENGAJAR 1 PJJ', '00000001', 'Laki-laki', '', '', 'Active', 0, 'JAKARTA', '0001-01-01', 'SARJANA', 'PENDIDIKAN', '2020-11-27 19:38:37'),
	('FAF11F9A9804', 'CA1E6A8B2675', 'KR-201127999804', 'KEUANGAN 1 PJJ', '000005', 'Laki-laki', '082178547981', 'TES', 'Active', 0, 'JAKARTA', '1990-11-01', 'SARJANA', 'AKUNTANSI', '2020-11-30 21:21:19');
/*!40000 ALTER TABLE `dt_karyawan` ENABLE KEYS */;

-- Dumping structure for table pjj2020.dt_kelas
DROP TABLE IF EXISTS `dt_kelas`;
CREATE TABLE IF NOT EXISTS `dt_kelas` (
  `guid_kelas` char(12) NOT NULL,
  `kode_kelas` char(15) DEFAULT NULL,
  `akronim` varchar(10) DEFAULT NULL,
  `nama_kelas` varchar(50) DEFAULT NULL,
  `status` enum('Active','Non Active') DEFAULT 'Active',
  `ideleted` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`guid_kelas`),
  KEY `KEY` (`kode_kelas`,`status`,`ideleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table pjj2020.dt_kelas: ~3 rows (approximately)
/*!40000 ALTER TABLE `dt_kelas` DISABLE KEYS */;
INSERT INTO `dt_kelas` (`guid_kelas`, `kode_kelas`, `akronim`, `nama_kelas`, `status`, `ideleted`) VALUES
	('07B12210D031', 'KE-2011130F9031', 'XII', 'Kelas XII', 'Active', 0),
	('443393CA6017', 'KE-201113C92017', 'X', 'Kelas X', 'Active', 0),
	('AEDA6EC8A024', 'KE-201113C75024', 'XI', 'Kelas XI', 'Active', 0);
/*!40000 ALTER TABLE `dt_kelas` ENABLE KEYS */;

-- Dumping structure for table pjj2020.dt_kelpelajaran
DROP TABLE IF EXISTS `dt_kelpelajaran`;
CREATE TABLE IF NOT EXISTS `dt_kelpelajaran` (
  `guid_kelpelajaran` char(12) NOT NULL,
  `kode_kelpelajaran` char(15) NOT NULL,
  `nama_kelpelajaran` varchar(50) NOT NULL,
  `akronim` char(6) NOT NULL DEFAULT '',
  `status` enum('Active','Non Active') DEFAULT 'Active',
  `ideleted` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`guid_kelpelajaran`),
  KEY `KEY` (`kode_kelpelajaran`,`ideleted`,`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Dumping data for table pjj2020.dt_kelpelajaran: ~5 rows (approximately)
/*!40000 ALTER TABLE `dt_kelpelajaran` DISABLE KEYS */;
INSERT INTO `dt_kelpelajaran` (`guid_kelpelajaran`, `kode_kelpelajaran`, `nama_kelpelajaran`, `akronim`, `status`, `ideleted`) VALUES
	('1C51A1C61323', 'KP-201113C4D323', 'Kelompok D ( Lintas Minat)', 'KELD', 'Active', 0),
	('6A8402208255', 'KP-2011131F3255', 'Kelompok B (Umum)', 'KELB', 'Active', 0),
	('A9A61480F245', 'KP-2011137F6245', 'Kelompok A (Umum)', 'KELA', 'Active', 0),
	('C2F8A854F334', 'KP-20111352E334', 'Kelompok E ( Muatan Lokal)', 'KELE', 'Active', 0),
	('D0E46944B304', 'KP-201113434304', 'Kelompok C (Minat)', 'KELC', 'Active', 0);
/*!40000 ALTER TABLE `dt_kelpelajaran` ENABLE KEYS */;

-- Dumping structure for table pjj2020.dt_pelajaran
DROP TABLE IF EXISTS `dt_pelajaran`;
CREATE TABLE IF NOT EXISTS `dt_pelajaran` (
  `guid_pelajaran` char(12) NOT NULL,
  `kode_pelajaran` char(15) NOT NULL,
  `nama_pelajaran` varchar(50) NOT NULL,
  `akronim` varchar(10) DEFAULT NULL,
  `status` enum('Active','Non Active') DEFAULT 'Active',
  `ideleted` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`guid_pelajaran`),
  KEY `KEY` (`kode_pelajaran`,`ideleted`,`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Dumping data for table pjj2020.dt_pelajaran: ~29 rows (approximately)
/*!40000 ALTER TABLE `dt_pelajaran` DISABLE KEYS */;
INSERT INTO `dt_pelajaran` (`guid_pelajaran`, `kode_pelajaran`, `nama_pelajaran`, `akronim`, `status`, `ideleted`) VALUES
	('01D7BFA65600', 'PE-201113A50600', 'Ekonomi Lintas Minat', 'EKONLM', 'Active', 0),
	('05F834BDD545', 'PE-201113BCA545', 'Sejarah', 'SEJM', 'Active', 0),
	('08A4FAC66938', 'PE-201113C51938', 'Antropologi', 'ANTR', 'Active', 0),
	('0C49F3405926', 'PE-2011133EB926', 'Informatika', 'INFORM', 'Active', 0),
	('186709804424', 'PE-2011137D8424', 'Pendidikan Agama dan Budi Pekerti', 'AGAMA', 'Active', 0),
	('2DA25F6F8100', 'PE-2011136D5100', 'Fisika', 'FISI', 'Active', 0),
	('2F91884BD116', 'PE-2011134A4116', 'Bahasa Jepang', 'BJEPANG', 'Active', 0),
	('3CBBAB8F3814', 'PE-2011138D3814', 'Prakarya dan Kewirausahaan', 'PKWU', 'Active', 0),
	('47F0E8034127', 'PE-201113020127', 'Biologi', 'BIO', 'Active', 0),
	('4D5389290025', 'PE-20111326F025', 'Bahasa Jerman', 'BJRMN', 'Active', 0),
	('4DCA82418732', 'PE-201113401732', 'Matematika', 'MTKW', 'Active', 0),
	('50BBD09CA613', 'PE-2011139B5613', 'Ekonomi', 'EKON', 'Active', 0),
	('5362CCEC6048', 'PE-201113EB1048', 'Matematika Minat', 'MTKM', 'Active', 0),
	('55FD72798746', 'PE-201113785746', 'Sejarah Indonesia', 'SEJW', 'Active', 0),
	('6889070A8013', 'PE-201113095013', 'Bahasa dan Sastra Jepang', 'BNSJP', 'Active', 0),
	('68E9CC486037', 'PE-201113464037', 'Lingkungan Hidup', 'LH', 'Active', 0),
	('6EA6AE291915', 'PE-20111327C915', 'Jerman / Inggris', 'JERENG', 'Active', 0),
	('6F7BF8728629', 'PE-201113709629', 'Bahasa Sunda', 'SUNDA', 'Active', 0),
	('7D726A6BA642', 'PE-2011136A6642', 'Pendidikan Pancasila dan Kewarganegaraan', 'PKN', 'Active', 0),
	('8B8786335836', 'PE-201113321836', 'Kimia Lintas Minat', 'KIMILM', 'Active', 0),
	('8CE642748719', 'PE-201113734719', 'Bahasa Inggris', 'BING', 'Active', 0),
	('9CFE01618654', 'PE-201113603654', 'Bahasa Indonesia', 'BINDO', 'Active', 0),
	('A375B7EEB002', 'PE-201113ED6002', 'Bahasa dan Sastra Inggris', 'BNSEN', 'Active', 0),
	('B63158DC4802', 'PE-201113DA3802', 'Seni Budaya', 'SBD', 'Active', 0),
	('BEAF1A9E7950', 'PE-2011139CE950', 'Bahasa dan Sastra Indonesia', 'BNSID', 'Active', 0),
	('D0501AB2A438', 'PE-201113B15438', 'Geografi', 'GEO', 'Active', 0),
	('E1C9B712F850', 'PE-20111311B850', 'Kimia', 'KIMI', 'Active', 0),
	('F5C820A4D457', 'PE-201113A26457', 'Sosiologi', 'SOSIO', 'Active', 0),
	('F7202A658902', 'PE-201113643902', 'Pendidikan Jasmani, Olahraga dan Kesehatan', 'PJOK', 'Active', 0);
/*!40000 ALTER TABLE `dt_pelajaran` ENABLE KEYS */;

-- Dumping structure for table pjj2020.dt_pengumuman
DROP TABLE IF EXISTS `dt_pengumuman`;
CREATE TABLE IF NOT EXISTS `dt_pengumuman` (
  `guid_pengumuman` char(12) NOT NULL,
  `kode_pengumuman` char(15) NOT NULL,
  `nama_pengumuman` varchar(30) DEFAULT NULL,
  `isi_pengumuman` text DEFAULT NULL,
  `clasifikasi` enum('Internal','Public') DEFAULT NULL,
  `tgl_posting` datetime DEFAULT NULL,
  `status` enum('Active','Non Active') DEFAULT 'Active',
  `ideleted` tinyint(4) DEFAULT 0,
  PRIMARY KEY (`guid_pengumuman`),
  KEY `KEY` (`kode_pengumuman`,`clasifikasi`,`status`,`ideleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Dumping data for table pjj2020.dt_pengumuman: ~0 rows (approximately)
/*!40000 ALTER TABLE `dt_pengumuman` DISABLE KEYS */;
INSERT INTO `dt_pengumuman` (`guid_pengumuman`, `kode_pengumuman`, `nama_pengumuman`, `isi_pengumuman`, `clasifikasi`, `tgl_posting`, `status`, `ideleted`) VALUES
	('4D179D3EC236', 'PG-2011273DD236', 'PENGUMUMAN CUTI BERSAMA', 'DIBERITAHUKAN KEPADA SELURUH AKADIMISI SMA NEGERI 1 BEKASI, BAHWA PADA TANGGAL 25 DESEMBER 2020 - 31 DESEMBER 2020 LIBUR KEGIATAN KBM, DAN AKAN KEMBALI KEAKTIFITAS SEPERTI BIASA PADA TANGGAL 1 JANUARI 2021', 'Public', '2020-11-27 19:42:36', 'Active', 0);
/*!40000 ALTER TABLE `dt_pengumuman` ENABLE KEYS */;

-- Dumping structure for table pjj2020.dt_produk
DROP TABLE IF EXISTS `dt_produk`;
CREATE TABLE IF NOT EXISTS `dt_produk` (
  `guid_produk` char(12) NOT NULL,
  `kode_produk` char(15) NOT NULL,
  `nama_produk` varchar(50) DEFAULT NULL,
  `status` enum('Active','Non Active') DEFAULT 'Active',
  `ideleted` tinyint(1) DEFAULT 0,
  `iTipe` tinyint(1) DEFAULT 0 COMMENT '0 -> Manual 1 -> Generate',
  PRIMARY KEY (`guid_produk`),
  KEY `KEY` (`kode_produk`,`status`,`ideleted`,`iTipe`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Dumping data for table pjj2020.dt_produk: ~6 rows (approximately)
/*!40000 ALTER TABLE `dt_produk` DISABLE KEYS */;
INSERT INTO `dt_produk` (`guid_produk`, `kode_produk`, `nama_produk`, `status`, `ideleted`, `iTipe`) VALUES
	('33307089A336', 'OTH201124886336', 'Lainya', 'Active', 0, 0),
	('44E7A47A8439', 'EXK201113785439', 'Extra Kulikuler', 'Active', 0, 0),
	('4B05631A9429', 'BPL201113696429', 'Buku Pelajaran', 'Active', 0, 0),
	('4B05636A9429', 'KYW201113695429', 'Karya Wisata', 'Active', 0, 0),
	('FF1140DAA418', 'SPP201113D97418', 'SPP', 'Active', 0, 1),
	('GB05636A9429', 'BSS201113786439', 'Seragam', 'Active', 0, 0);
/*!40000 ALTER TABLE `dt_produk` ENABLE KEYS */;

-- Dumping structure for table pjj2020.dt_siswa
DROP TABLE IF EXISTS `dt_siswa`;
CREATE TABLE IF NOT EXISTS `dt_siswa` (
  `guid_siswa` char(12) NOT NULL,
  `kode_siswa` char(15) NOT NULL,
  `nama_siswa` varchar(30) DEFAULT NULL,
  `nik_siswa` varchar(20) DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `nohandpone` varchar(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `status` enum('Active','Non Active') DEFAULT 'Active',
  `ideleted` tinyint(1) DEFAULT 0,
  `tempat_lahir` varchar(20) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  PRIMARY KEY (`guid_siswa`),
  KEY `KEY` (`kode_siswa`,`jenis_kelamin`,`ideleted`,`nik_siswa`,`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Dumping data for table pjj2020.dt_siswa: ~6 rows (approximately)
/*!40000 ALTER TABLE `dt_siswa` DISABLE KEYS */;
INSERT INTO `dt_siswa` (`guid_siswa`, `kode_siswa`, `nama_siswa`, `nik_siswa`, `jenis_kelamin`, `nohandpone`, `alamat`, `status`, `ideleted`, `tempat_lahir`, `tanggal_lahir`) VALUES
	('1997F0CE2816', 'SW-201205CC7816', 'Junio Zidan Siahaan', '181910329', 'Laki-laki', '-', '-', 'Active', 0, '-', '0000-00-00'),
	('207B3217A816', 'SW-201205135816', 'Luthfan Syarafi', '181910333', 'Laki-laki', '-', '-', 'Active', 0, '-', '0000-00-00'),
	('221A176F0816', 'SW-2012056D5816', 'Khotrun Nada', '181910331', 'Perempuan', '-', '-', 'Active', 0, '-', '0000-00-00'),
	('8200770F8816', 'SW-2012050DD816', 'Farischa Ramandha Subiakto', '181910324', 'Perempuan', '-', '-', 'Active', 0, '-', '0000-00-00'),
	('D2F473841816', 'SW-201205821816', 'Adinda Dwi Nurul Aulia', '181910313', 'Perempuan', '-', '-', 'Active', 0, '-', '0000-00-00'),
	('F3415C4F9816', 'SW-2012054DE816', 'Devin Athallah Putra Wibowo', '181910323', 'Laki-laki', '-', '-', 'Active', 0, '-', '0000-00-00');
/*!40000 ALTER TABLE `dt_siswa` ENABLE KEYS */;

-- Dumping structure for table pjj2020.dt_tahunajaran
DROP TABLE IF EXISTS `dt_tahunajaran`;
CREATE TABLE IF NOT EXISTS `dt_tahunajaran` (
  `guid_tahunajaran` char(12) NOT NULL,
  `kode_tahunajaran` char(15) NOT NULL,
  `kode_karyawan` char(15) DEFAULT NULL,
  `nama_tahunajaran` varchar(50) DEFAULT NULL,
  `tahun_awal` varchar(50) DEFAULT NULL,
  `tahun_akhir` varchar(50) DEFAULT NULL,
  `semester` enum('Ganjil','Genap') DEFAULT NULL,
  `status` enum('Active','Non Active') DEFAULT 'Active',
  `validta` enum('Valid','Non Valid') DEFAULT 'Non Valid',
  `validkelas` enum('Valid','Non Valid') DEFAULT 'Non Valid',
  `validpelajaran` enum('Valid','Non Valid') DEFAULT 'Non Valid',
  `validsubkelas` enum('Valid','Non Valid') DEFAULT 'Non Valid',
  `ideleted` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`guid_tahunajaran`),
  KEY `KEY` (`kode_tahunajaran`,`kode_karyawan`,`semester`,`status`,`validkelas`,`validpelajaran`,`validsubkelas`,`ideleted`,`validta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Dumping data for table pjj2020.dt_tahunajaran: ~1 rows (approximately)
/*!40000 ALTER TABLE `dt_tahunajaran` DISABLE KEYS */;
INSERT INTO `dt_tahunajaran` (`guid_tahunajaran`, `kode_tahunajaran`, `kode_karyawan`, `nama_tahunajaran`, `tahun_awal`, `tahun_akhir`, `semester`, `status`, `validta`, `validkelas`, `validpelajaran`, `validsubkelas`, `ideleted`) VALUES
	('DBC25B683706', 'TA-201207663706', 'KR-201127BC7606', '2020 - 2021', '2020', '2021', 'Genap', 'Active', 'Valid', 'Valid', 'Valid', 'Valid', 0);
/*!40000 ALTER TABLE `dt_tahunajaran` ENABLE KEYS */;

-- Dumping structure for table pjj2020.dt_walisiswa
DROP TABLE IF EXISTS `dt_walisiswa`;
CREATE TABLE IF NOT EXISTS `dt_walisiswa` (
  `guid_walisiswa` char(12) NOT NULL,
  `kode_walisiswa` char(15) NOT NULL,
  `nama_walisiswa` varchar(50) DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `tempat_lahir` varchar(20) DEFAULT NULL,
  `pekerjaan` varchar(50) DEFAULT NULL,
  `nohandpone` varchar(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `status` enum('Active','Non Active') DEFAULT 'Active',
  `ideleted` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`guid_walisiswa`),
  KEY `KEY` (`kode_walisiswa`,`jenis_kelamin`,`ideleted`,`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Dumping data for table pjj2020.dt_walisiswa: ~0 rows (approximately)
/*!40000 ALTER TABLE `dt_walisiswa` DISABLE KEYS */;
INSERT INTO `dt_walisiswa` (`guid_walisiswa`, `kode_walisiswa`, `nama_walisiswa`, `jenis_kelamin`, `tanggal_lahir`, `tempat_lahir`, `pekerjaan`, `nohandpone`, `alamat`, `status`, `ideleted`) VALUES
	('0BDB1CD0B554', 'WS-201128CAB554', 'Suwondo', 'Laki-laki', '1960-01-08', 'Lampung Barat', 'Wirausaha', '082178547981', 'Jakarta Barat, DKI Jakarta', 'Active', 0);
/*!40000 ALTER TABLE `dt_walisiswa` ENABLE KEYS */;

-- Dumping structure for table pjj2020.dt_walisiswa_detail
DROP TABLE IF EXISTS `dt_walisiswa_detail`;
CREATE TABLE IF NOT EXISTS `dt_walisiswa_detail` (
  `guid_walisiswa_detail` char(12) NOT NULL,
  `kode_walisiswa` char(15) NOT NULL,
  `kode_siswa` char(15) DEFAULT NULL,
  `ideleted` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`guid_walisiswa_detail`),
  KEY `KEY` (`kode_walisiswa`,`kode_siswa`,`ideleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Dumping data for table pjj2020.dt_walisiswa_detail: ~2 rows (approximately)
/*!40000 ALTER TABLE `dt_walisiswa_detail` DISABLE KEYS */;
INSERT INTO `dt_walisiswa_detail` (`guid_walisiswa_detail`, `kode_walisiswa`, `kode_siswa`, `ideleted`) VALUES
	('0B6E945CC815', 'WS-201128CAB554', 'SW-2012050DD816', 0),
	('59A32C993820', 'WS-201128CAB554', 'SW-2012056D5816', 0),
	('EEBFCC28F824', 'WS-201128CAB554', 'SW-201205CC7816', 0);
/*!40000 ALTER TABLE `dt_walisiswa_detail` ENABLE KEYS */;

-- Dumping structure for table pjj2020.general_hari
DROP TABLE IF EXISTS `general_hari`;
CREATE TABLE IF NOT EXISTS `general_hari` (
  `guid_hari` char(12) NOT NULL,
  `nama_hari` varchar(50) NOT NULL,
  `nama_hari_en` varchar(50) NOT NULL,
  `iurutan` tinyint(4) NOT NULL,
  `ideleted` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`guid_hari`),
  KEY `KEY` (`ideleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Dumping data for table pjj2020.general_hari: ~7 rows (approximately)
/*!40000 ALTER TABLE `general_hari` DISABLE KEYS */;
INSERT INTO `general_hari` (`guid_hari`, `nama_hari`, `nama_hari_en`, `iurutan`, `ideleted`) VALUES
	('6A243068E804', 'Senin', 'Monday', 0, 0),
	('B5838DDB0842', 'Selasa', 'Tuesday', 1, 0),
	('D8DE8245C731', 'Kamis', 'Thursday', 3, 0),
	('D8DE8245C732', 'Jumat', 'Friday', 4, 0),
	('D8DE8245C733', 'Sabtu', 'Saturday', 5, 0),
	('D8DE8245C734', 'Minggu', 'Sunday', 6, 0),
	('D8DE8245C739', 'Rabu', 'Wednesday', 2, 0);
/*!40000 ALTER TABLE `general_hari` ENABLE KEYS */;

-- Dumping structure for table pjj2020.general_pay
DROP TABLE IF EXISTS `general_pay`;
CREATE TABLE IF NOT EXISTS `general_pay` (
  `guid_pay` char(12) NOT NULL,
  `kode` varchar(50) NOT NULL DEFAULT '',
  `value` text NOT NULL,
  `ideleted` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`guid_pay`) USING BTREE,
  KEY `KEY` (`ideleted`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Dumping data for table pjj2020.general_pay: ~6 rows (approximately)
/*!40000 ALTER TABLE `general_pay` DISABLE KEYS */;
INSERT INTO `general_pay` (`guid_pay`, `kode`, `value`, `ideleted`) VALUES
	('11122221', 'smtp_port', '', 0),
	('11122222', 'API_KEY', 'xnd_development_zFnlpy9uHJ75GzErrRQWDJ1byvZi3uItzjnBdRshoJmvjUDLFLC7qMNajp2lYpP', 0),
	('11122223', 'MAIL', 'achmad.ariespirnando@gmail.com', 0),
	('11122224', '', '', 0),
	('11122225', '', '', 0),
	('11122226', '', '', 0);
/*!40000 ALTER TABLE `general_pay` ENABLE KEYS */;

-- Dumping structure for procedure pjj2020.insert_aktifitas
DROP PROCEDURE IF EXISTS `insert_aktifitas`;
DELIMITER //
CREATE PROCEDURE `insert_aktifitas`(
	IN `P_KODE_USER` CHAR(15),
	IN `P_ISI` TEXT
)
BEGIN
INSERT INTO `nt_aktif` 
(`kode_user`, `isi_aktifitas`, `date_post`) VALUES (P_KODE_USER, P_ISI, NOW()); 
END//
DELIMITER ;

-- Dumping structure for procedure pjj2020.insert_notif
DROP PROCEDURE IF EXISTS `insert_notif`;
DELIMITER //
CREATE PROCEDURE `insert_notif`(
	IN `P_KODE_USER` CHAR(15),
	IN `P_ISI` TEXT,
	IN `P_ROUTE_URL` TEXT
)
BEGIN
INSERT INTO `nt_notif` 
(`kode_user`, `isi_notifikasi`,route_url, `date_post`) VALUES (P_KODE_USER, P_ISI, P_ROUTE_URL, NOW()); 
END//
DELIMITER ;

-- Dumping structure for procedure pjj2020.insert_notifraport
DROP PROCEDURE IF EXISTS `insert_notifraport`;
DELIMITER //
CREATE PROCEDURE `insert_notifraport`(
	IN `P_GUID_CONF_KELASXSUBKELAS` CHAR(15),
	IN `P_ISI` TEXT,
	IN `P_ROUTE_URL` TEXT
)
BEGIN 
INSERT INTO `nt_notif` 
(`kode_user`, `isi_notifikasi`,route_url, `date_post`) 
SELECT DISTINCT(conf_subkelasxsiswa.kode_siswa), P_ISI, P_ROUTE_URL, NOW() FROM conf_kelasxsubkelas 
JOIN conf_subkelasxsiswa ON conf_subkelasxsiswa.guid_conf_kelasxsubkelas = conf_kelasxsubkelas.guid_conf_kelasxsubkelas
WHERE conf_kelasxsubkelas.guid_conf_kelasxsubkelas = P_GUID_CONF_KELASXSUBKELAS
AND conf_kelasxsubkelas.ideleted = 0
AND conf_subkelasxsiswa.ideleted = 0;

INSERT INTO `nt_notif` 
(`kode_user`, `isi_notifikasi`,route_url, `date_post`) 
SELECT DISTINCT(dt_walisiswa_detail.kode_walisiswa), P_ISI, P_ROUTE_URL, NOW()  FROM conf_kelasxsubkelas 
JOIN conf_subkelasxsiswa ON conf_subkelasxsiswa.guid_conf_kelasxsubkelas = conf_kelasxsubkelas.guid_conf_kelasxsubkelas
JOIN dt_walisiswa_detail ON dt_walisiswa_detail.kode_siswa = conf_subkelasxsiswa.kode_siswa
WHERE conf_kelasxsubkelas.guid_conf_kelasxsubkelas = P_GUID_CONF_KELASXSUBKELAS
AND conf_kelasxsubkelas.ideleted = 0
AND conf_subkelasxsiswa.ideleted = 0
AND dt_walisiswa_detail.ideleted = 0;


END//
DELIMITER ;

-- Dumping structure for procedure pjj2020.insert_notiftosiswa
DROP PROCEDURE IF EXISTS `insert_notiftosiswa`;
DELIMITER //
CREATE PROCEDURE `insert_notiftosiswa`(
	IN `P_KODE_USER` CHAR(15),
	IN `P_ISI` TEXT,
	IN `P_ROUTE_URL` TEXT
)
BEGIN
INSERT INTO `nt_notif` 
(`kode_user`, `isi_notifikasi`,route_url, `date_post`) 
SELECT dt_walisiswa_detail.kode_siswa, P_ISI, P_ROUTE_URL, NOW() FROM dt_walisiswa_detail 
WHERE dt_walisiswa_detail.ideleted = 0 AND dt_walisiswa_detail.kode_walisiswa = P_KODE_USER;
END//
DELIMITER ;

-- Dumping structure for procedure pjj2020.insert_notiftowalisissa
DROP PROCEDURE IF EXISTS `insert_notiftowalisissa`;
DELIMITER //
CREATE PROCEDURE `insert_notiftowalisissa`(
	IN `P_KODE_USER` CHAR(15),
	IN `P_ISI` TEXT,
	IN `P_ROUTE_URL` TEXT
)
BEGIN 
INSERT INTO `nt_notif` 
(`kode_user`, `isi_notifikasi`,route_url, `date_post`) 
SELECT dt_walisiswa_detail.kode_walisiswa, P_ISI, P_ROUTE_URL, NOW() FROM dt_walisiswa_detail 
WHERE dt_walisiswa_detail.ideleted = 0 AND dt_walisiswa_detail.kode_siswa = P_KODE_USER;
END//
DELIMITER ;

-- Dumping structure for procedure pjj2020.insert_onlinemeet
DROP PROCEDURE IF EXISTS `insert_onlinemeet`;
DELIMITER //
CREATE PROCEDURE `insert_onlinemeet`(
	IN `P_GUID_CONF_SUBKELASXPEL` CHAR(12),
	IN `P_KODE_USER` CHAR(15),
	IN `P_TANGGAL_JOIN` CHAR(12),
	IN `P_JAM_JOIN` CHAR(12)
)
BEGIN

SELECT COUNT(tr_onlinemeet.guid_onlinemeet) INTO @COUNT FROM tr_onlinemeet WHERE tr_onlinemeet.guid_conf_subkelasxpel = P_GUID_CONF_SUBKELASXPEL AND
tr_onlinemeet.kode_user = P_KODE_USER AND tr_onlinemeet.tanggal_join = P_TANGGAL_JOIN;

IF @COUNT = 0 THEN
	
	INSERT INTO tr_onlinemeet (guid_conf_subkelasxpel,kode_user,tanggal_join, jam_join)
	VALUE (P_GUID_CONF_SUBKELASXPEL,P_KODE_USER,P_TANGGAL_JOIN,P_JAM_JOIN);

END IF;

END//
DELIMITER ;

-- Dumping structure for procedure pjj2020.insert_pelajaran
DROP PROCEDURE IF EXISTS `insert_pelajaran`;
DELIMITER //
CREATE PROCEDURE `insert_pelajaran`(
	IN `P_KODE_TAHUNAJARAN` CHAR(15)
)
BEGIN
DECLARE n, i INT DEFAULT 0; 
SELECT COUNT(conf_kelas.guid_conf_kelas) FROM conf_kelas 
WHERE conf_kelas.ideleted = 0 
AND conf_kelas.validpelajaran = 'Valid'
AND conf_kelas.kode_tahunajaran = P_KODE_TAHUNAJARAN
ORDER BY guid_conf_kelas ASC INTO n;

WHILE i<n DO 

	SELECT conf_kelas.kode_jurusan INTO @KODEJURUSAN FROM conf_kelas 
	WHERE conf_kelas.ideleted = 0 
	AND conf_kelas.validpelajaran = 'Valid'
	AND conf_kelas.kode_tahunajaran = P_KODE_TAHUNAJARAN
	ORDER BY guid_conf_kelas ASC LIMIT i,1;
	
	SELECT conf_kelas.kode_kelas INTO @KODEKELAS FROM conf_kelas 
	WHERE conf_kelas.ideleted = 0 
	AND conf_kelas.validpelajaran = 'Valid'
	AND conf_kelas.kode_tahunajaran = P_KODE_TAHUNAJARAN
	ORDER BY guid_conf_kelas ASC LIMIT i,1;

	SELECT conf_kelas.guid_conf_kelas INTO @GUIDCONFKELAS FROM conf_kelas 
	WHERE conf_kelas.ideleted = 0 
	AND conf_kelas.validpelajaran = 'Valid'
	AND conf_kelas.kode_tahunajaran = P_KODE_TAHUNAJARAN
	ORDER BY guid_conf_kelas ASC LIMIT i,1;
	
	INSERT INTO `conf_kelasxpel` 
	(`guid_conf_kelas`, `kode_pelajaran`, `kode_kelpelajaran`,nama_pelajaran, iurutan, akronim, kkm) 
	SELECT  @GUIDCONFKELAS, rp_jurxpelajaran.kode_pelajaran, rp_jurxpelajaran.kode_kelpelajaran, 
	dt_pelajaran.nama_pelajaran, rp_jurxpelajaran.iurutan, dt_pelajaran.akronim, rp_jurxpelajaran.kkm
	FROM rp_jurxpelajaran 
	JOIN dt_pelajaran ON dt_pelajaran.kode_pelajaran = rp_jurxpelajaran.kode_pelajaran 
	WHERE 
	rp_jurxpelajaran.kode_jurusan = @KODEJURUSAN  AND 
	rp_jurxpelajaran.kode_kelas = @KODEKELAS;
	SET i = i + 1;
END WHILE;


END//
DELIMITER ;

-- Dumping structure for procedure pjj2020.insert_randomsoal
DROP PROCEDURE IF EXISTS `insert_randomsoal`;
DELIMITER //
CREATE PROCEDURE `insert_randomsoal`(
	IN `P_GUID_PELXSOAL_SISWA` CHAR(12),
	IN `P_GUID_PELXSOAL` CHAR(12)
)
BEGIN

DELETE FROM tr_soalrandsiswa 
WHERE guid_pelxsoal_siswa = P_GUID_PELXSOAL_SISWA AND
guid_pelxsoal = P_GUID_PELXSOAL;

INSERT INTO tr_soalrandsiswa (
	guid_pelxsoal_siswa,
	guid_pelxsoal,
	guid_soal)
SELECT 
	P_GUID_PELXSOAL_SISWA, 
	P_GUID_PELXSOAL, 
	guid_soal 
FROM tr_soal WHERE tr_soal.ideleted = 0 order BY RAND();
END//
DELIMITER ;

-- Dumping structure for procedure pjj2020.jumlahaktifitasperbulan
DROP PROCEDURE IF EXISTS `jumlahaktifitasperbulan`;
DELIMITER //
CREATE PROCEDURE `jumlahaktifitasperbulan`()
BEGIN
DECLARE startv, endv, n, i INT DEFAULT 0; 
DECLARE value_data VARCHAR(100);
DECLARE KODEJURUSAN VARCHAR(15);
DROP TEMPORARY TABLE IF EXISTS datatagihan;
create TEMPORARY table datatagihan(
	id int not null auto_increment primary KEY,  
	akronim VARCHAR(10) not null,
	nama_jurusan VARCHAR(50) not null,
	valuetotal VARCHAR(100) not NULL
);


SELECT count(guid_jurusan) FROM dt_jurusan WHERE dt_jurusan.ideleted = 0 INTO n;

SET i=0;
WHILE i<n DO 
	SET startv = 1;
   SET endv = 12;
   SET value_data ="";
   
   SELECT kode_jurusan FROM dt_jurusan WHERE dt_jurusan.ideleted = 0 ORDER BY akronim LIMIT i,1 INTO KODEJURUSAN;
   while startv <= endv DO		 
			
		SELECT 
		COUNT(nt_aktif.auto_aktif) INTO @TOTALTG
		FROM nt_aktif 
		JOIN dt_siswa ON nt_aktif.kode_user = dt_siswa.kode_siswa 
		JOIN conf_subkelasxsiswa ON conf_subkelasxsiswa.kode_siswa = dt_siswa.kode_siswa
		JOIN conf_kelasxsubkelas ON conf_subkelasxsiswa.guid_conf_kelasxsubkelas = conf_kelasxsubkelas.guid_conf_kelasxsubkelas
		JOIN conf_kelas ON conf_kelas.guid_conf_kelas = conf_kelasxsubkelas.guid_conf_kelas
		WHERE YEAR(nt_aktif.date_post) = YEAR(NOW()) AND 
		MONTH(nt_aktif.date_post) = startv AND
		conf_kelas.kode_jurusan = KODEJURUSAN
		LIMIT 1;

		IF startv = 1 THEN 
			SET value_data = @TOTALTG;
		ELSE
			SELECT CONCAT(value_data,',',@TOTALTG) INTO value_data;
		END IF;
		
		SET startv = startv+1;
	END while;
   
	INSERT INTO datatagihan(akronim, nama_jurusan, valuetotal) SELECT akronim, nama_jurusan, value_data 
	FROM dt_jurusan WHERE dt_jurusan.ideleted = 0 ORDER BY akronim LIMIT i,1 ;
	
	SET i = i + 1;
END WHILE;

SELECT * FROM datatagihan;
END//
DELIMITER ;

-- Dumping structure for procedure pjj2020.jumlahloginperbulan
DROP PROCEDURE IF EXISTS `jumlahloginperbulan`;
DELIMITER //
CREATE PROCEDURE `jumlahloginperbulan`()
BEGIN
DECLARE startv, endv INT DEFAULT 0;
DROP TEMPORARY TABLE IF EXISTS loglogin;
create TEMPORARY table loglogin(
	id int not null auto_increment primary key,
	bulan int not null DEFAULT 0,
	internal int not null DEFAULT 0,
	public int not null DEFAULT 0
);

SET startv = 1;
SET endv = 12;

while startv <= endv DO

	SELECT COUNT(auth_history.guid_history) INTO @INTERNAL FROM auth_history JOIN auth_user ON auth_history.guid_user = auth_user.guid_user
	JOIN auth_groups ON auth_groups.guid_groups = auth_user.guid_groups
	WHERE auth_history.`type` = 'Login' AND auth_groups.iTipe = 0 AND YEAR(DATE) = YEAR(NOW())
	AND MONTH(DATE) = startv;
	
	SELECT COUNT(auth_history.guid_history) INTO @PUBLIC FROM auth_history JOIN auth_user ON auth_history.guid_user = auth_user.guid_user
	JOIN auth_groups ON auth_groups.guid_groups = auth_user.guid_groups
	WHERE auth_history.`type` = 'Login' AND auth_groups.iTipe = 1 AND YEAR(DATE) = YEAR(NOW())
	AND MONTH(DATE) = startv;

	insert into loglogin (bulan,internal,public) values ( startv, @INTERNAL, @PUBLIC);
	  
SET startv = startv+1;
end while;

SELECT * FROM loglogin ORDER BY bulan ASC;


END//
DELIMITER ;

-- Dumping structure for procedure pjj2020.jumlahtagihanperbulan
DROP PROCEDURE IF EXISTS `jumlahtagihanperbulan`;
DELIMITER //
CREATE PROCEDURE `jumlahtagihanperbulan`()
BEGIN
DECLARE startv, endv, n, i INT DEFAULT 0; 
DECLARE value_data VARCHAR(100);
DECLARE KODEPRODUK VARCHAR(15);
DROP TEMPORARY TABLE IF EXISTS datatagihan;
create TEMPORARY table datatagihan(
	id int not null auto_increment primary KEY,  
	kode_produk VARCHAR(15) not null,
	produk VARCHAR(100) not null,
	valuetagih VARCHAR(100) not NULL
);


SELECT count(guid_produk) FROM dt_produk WHERE dt_produk.ideleted = 0 INTO n;
SET i=0;
WHILE i<n DO 
	SET startv = 1;
   SET endv = 12;
   SET value_data ="";
   
   SELECT kode_produk FROM dt_produk WHERE dt_produk.ideleted = 0 ORDER BY nama_produk LIMIT i,1 INTO KODEPRODUK;
   while startv <= endv DO		
		SELECT COUNT(guid_tagihan) INTO @TOTALTG FROM tr_tagihan WHERE kode_produk = KODEPRODUK AND tr_tagihan.ideleted =0 
		AND YEAR(tgl_create) = YEAR(NOW()) AND MONTH(tgl_create) = startv; 
		IF startv = 1 THEN 
			SET value_data = @TOTALTG;
		ELSE
			SELECT CONCAT(value_data,',',@TOTALTG) INTO value_data;
		END IF;
		
		SET startv = startv+1;
	END while;
   
	INSERT INTO datatagihan(kode_produk, produk, valuetagih) SELECT kode_produk, nama_produk, value_data 
	FROM dt_produk WHERE dt_produk.ideleted = 0 ORDER BY nama_produk LIMIT i,1 ;
	
	SET i = i + 1;
END WHILE;

SELECT * FROM datatagihan;
END//
DELIMITER ;

-- Dumping structure for procedure pjj2020.jumlahtglunasnonlunas
DROP PROCEDURE IF EXISTS `jumlahtglunasnonlunas`;
DELIMITER //
CREATE PROCEDURE `jumlahtglunasnonlunas`(
	IN `P_KODE_WALISISWA` CHAR(15)
)
BEGIN

DROP TEMPORARY TABLE IF EXISTS loglogin;
create TEMPORARY table tagihan(
	id int not null auto_increment primary key,
	lunas double DEFAULT 0,
	nonlunas double DEFAULT 0
);

IF P_KODE_WALISISWA = "U-ADMIN" THEN
SELECT SUM(tr_tagihan.total_biaya) INTO @LUNAS FROM tr_tagihan  
WHERE tr_tagihan.ideleted = 0 AND tr_tagihan.status_tg = 'Lunas' LIMIT 1;
SELECT SUM(tr_tagihan.total_biaya) INTO @NONLUNAS FROM tr_tagihan 
WHERE tr_tagihan.ideleted = 0 AND tr_tagihan.status_tg <> 'Lunas'LIMIT 1;
INSERT INTO tagihan(lunas,nonlunas) VALUE(@LUNAS,@NONLUNAS);
ELSE
SELECT SUM(tr_tagihan.total_biaya) INTO @LUNAS FROM dt_walisiswa_detail
JOIN tr_tagihan ON dt_walisiswa_detail.kode_siswa = tr_tagihan.kode_siswa
WHERE tr_tagihan.ideleted = 0 AND tr_tagihan.status_tg = 'Lunas' AND dt_walisiswa_detail.kode_walisiswa = P_KODE_WALISISWA LIMIT 1;
SELECT SUM(tr_tagihan.total_biaya) INTO @NONLUNAS FROM dt_walisiswa_detail
JOIN tr_tagihan ON dt_walisiswa_detail.kode_siswa = tr_tagihan.kode_siswa
WHERE tr_tagihan.ideleted = 0 AND tr_tagihan.status_tg <> 'Lunas' AND dt_walisiswa_detail.kode_walisiswa = P_KODE_WALISISWA LIMIT 1;
INSERT INTO tagihan(lunas,nonlunas) VALUE(@LUNAS,@NONLUNAS);
END IF;
SELECT * FROM tagihan;

END//
DELIMITER ;

-- Dumping structure for procedure pjj2020.laporan_meet_siswa
DROP PROCEDURE IF EXISTS `laporan_meet_siswa`;
DELIMITER //
CREATE PROCEDURE `laporan_meet_siswa`(
	IN `P_GUID_CONF_SUBKELASPEL` CHAR(12)
)
BEGIN
SELECT dt_siswa.kode_siswa, dt_siswa.nama_siswa, tr_onlinemeet.tanggal_join, tr_onlinemeet.jam_join
FROM conf_subkelasxsiswa 
JOIN dt_siswa ON dt_siswa.kode_siswa = conf_subkelasxsiswa.kode_siswa
JOIN conf_subkelasxpel ON conf_subkelasxpel.guid_conf_kelasxsubkelas = conf_subkelasxsiswa.guid_conf_kelasxsubkelas
LEFT JOIN tr_onlinemeet ON tr_onlinemeet.kode_user = dt_siswa.kode_siswa 
AND tr_onlinemeet.guid_conf_subkelasxpel = conf_subkelasxpel.guid_conf_subkelasxpel
WHERE dt_siswa.ideleted = 0 AND conf_subkelasxsiswa.ideleted = 0  AND
conf_subkelasxpel.guid_conf_subkelasxpel = P_GUID_CONF_SUBKELASPEL;
END//
DELIMITER ;

-- Dumping structure for procedure pjj2020.logteraktiv_allguru
DROP PROCEDURE IF EXISTS `logteraktiv_allguru`;
DELIMITER //
CREATE PROCEDURE `logteraktiv_allguru`()
BEGIN
 
SELECT 
COUNT(dt_karyawan.kode_karyawan) AS TOTAL,
dt_karyawan.nama_karyawan,
MONTHNAME(nt_aktif.date_post) AS bulan,
YEAR(nt_aktif.date_post) AS tahun
FROM nt_aktif 
JOIN dt_karyawan ON nt_aktif.kode_user = dt_karyawan.kode_karyawan
JOIN auth_groups ON auth_groups.guid_groups = dt_karyawan.guid_groups
WHERE 
YEAR(nt_aktif.date_post) = YEAR(NOW()) AND 
MONTH(nt_aktif.date_post) = MONTH(NOW()) AND
auth_groups.kode_groups = 'U-GURU'
GROUP BY dt_karyawan.kode_karyawan
ORDER BY COUNT(dt_karyawan.kode_karyawan) DESC
LIMIT 1;
	
END//
DELIMITER ;

-- Dumping structure for procedure pjj2020.logteraktiv_allsiswa
DROP PROCEDURE IF EXISTS `logteraktiv_allsiswa`;
DELIMITER //
CREATE PROCEDURE `logteraktiv_allsiswa`()
BEGIN
 
SELECT 
COUNT(dt_siswa.kode_siswa) AS TOTAL,
dt_siswa.nama_siswa,
MONTHNAME(nt_aktif.date_post) AS bulan,
YEAR(nt_aktif.date_post) AS tahun
FROM nt_aktif 
JOIN dt_siswa ON nt_aktif.kode_user = dt_siswa.kode_siswa 
WHERE YEAR(nt_aktif.date_post) = YEAR(NOW()) AND MONTH(nt_aktif.date_post) = MONTH(NOW())
GROUP BY dt_siswa.kode_siswa
ORDER BY COUNT(dt_siswa.kode_siswa) DESC
LIMIT 1;
	
END//
DELIMITER ;

-- Dumping structure for procedure pjj2020.logteraktiv_allstaff
DROP PROCEDURE IF EXISTS `logteraktiv_allstaff`;
DELIMITER //
CREATE PROCEDURE `logteraktiv_allstaff`()
BEGIN
 
SELECT 
COUNT(dt_karyawan.kode_karyawan) AS TOTAL,
dt_karyawan.nama_karyawan,
MONTHNAME(nt_aktif.date_post) AS bulan,
YEAR(nt_aktif.date_post) AS tahun
FROM nt_aktif 
JOIN dt_karyawan ON nt_aktif.kode_user = dt_karyawan.kode_karyawan
JOIN auth_groups ON auth_groups.guid_groups = dt_karyawan.guid_groups
WHERE YEAR(nt_aktif.date_post) = YEAR(NOW()) AND MONTH(nt_aktif.date_post) = MONTH(NOW())
GROUP BY dt_karyawan.kode_karyawan
ORDER BY COUNT(dt_karyawan.kode_karyawan) DESC
LIMIT 1;
	
END//
DELIMITER ;

-- Dumping structure for table pjj2020.motifasi_day
DROP TABLE IF EXISTS `motifasi_day`;
CREATE TABLE IF NOT EXISTS `motifasi_day` (
  `imotifasi` tinyint(4) NOT NULL AUTO_INCREMENT,
  `kalimat_motifasi` text DEFAULT NULL,
  PRIMARY KEY (`imotifasi`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table pjj2020.motifasi_day: ~87 rows (approximately)
/*!40000 ALTER TABLE `motifasi_day` DISABLE KEYS */;
INSERT INTO `motifasi_day` (`imotifasi`, `kalimat_motifasi`) VALUES
	(1, 'Barang siapa bersungguh-sungguh, maka dia akan mendapatkan kesuksesan.'),
	(2, 'Lakukan yang terbaik di semua kesempatan yang kamu miliki.'),
	(3, 'Makin awal kamu memulai pekerjaan, makin awal pula kamu akan melihat hasilnya.'),
	(4, 'Masa depan adalah milik mereka yang menyiapkan hari ini.'),
	(5, 'Kalau impianmu tak bisa membuatmu takut, mungkin karena impianmu tak cukup besar.'),
	(6, 'Kegagalan adalah guru terbaikmu. Belajarlah darinya.'),
	(7, 'Pelajaran yang paling berharga adalah pelajaran yang Anda ajarkan untuk diri sendiri.'),
	(8, 'erdoa saja tidak cukup. Belajar dengan baik adalah bukti bahwa doa Anda serius. Belajar adalah ibadah.'),
	(9, 'Sedikit kemajuan setiap hari di dalam dirimu menambah sesuatu hingga hasil yang besar.'),
	(10, 'Bersemangatlah dalam mempelajari sesuatu yang bermanfaat.'),
	(11, 'Belajar tidak akan pernah membuat pikiran Anda lelah.'),
	(12, 'Belajar adalah pengalaman. Sedangkan yang lainnya hanyalah informasi.'),
	(13, 'Jangan takut melangkah karena jarak 1.000 mil dimulai dari satu langkah.'),
	(14, 'Hidup adalah tentang belajar. Jika Anda berhenti, maka Anda mati.'),
	(15, 'Apa pun kata orang lain, belajar dan bekerja keraslah untuk mencapai kesuksesan.'),
	(16, 'Kesuksesan seseorang berbanding lurus dengan kemauannya untuk belajar, bangkit, dan mencoba.'),
	(17, 'Memang baik merayakan kesuksesan, tapi hal yang lebih penting adalah untuk mengambil pelajaran dari kegagalan. - Bill Gates'),
	(18, 'Jangan mengharapkan semuanya bisa jadi lebih mudah, berharaplah agar dirimu bisa jadi lebih baik. - Jim Rohn'),
	(19, 'Lakukan! Kalau Anda sukses Anda berbahagia, kalau Anda gagal Anda belajar. - Mario Teguh'),
	(20, 'Petualangan dalam hidup adalah seberapa banyak Anda belajar.'),
	(21, 'Kita belajar dari kegagalan, bukan dari kesuksesan.'),
	(22, 'Mempelajari bagaimana cara belajar adalah kemampuan mahapenting dalam hidup.'),
	(23, 'Pendidikan bukan cuma pergi ke sekolah dan mendapatkan gelar. Tapi, juga soal memperluas pengetahuan dan menyerap ilmu kehidupan. - Shakuntala Devi'),
	(24, 'Jangan takut salah ketika menuntut ilmu karena banyak orang sukses belajar dari sebuah kesalahan.'),
	(25, 'Selalu ada sesuatu yang bisa dipelajari bahkan bagi seorang master sekalipun. - Master Shifu, Kung Fu Panda 3'),
	(26, 'Jangan malas untuk belajar karena ilmu adalah harta yang bisa kita bawa ke mana pun tanpa membebani kita.'),
	(27, 'Masa depan memang tak pasti, tapi kalo kita belajar dengan bekerja keras, kita akan sukses. - Mario Teguh'),
	(28, 'Anak muda yang malas belajar tidak pantas untuk masa depan yang baik.'),
	(29, 'Ubahlah hidupmu hari ini. Jangan bermain-main dengan masa depanmu, lakukan sekarang, jangan menunda. - Simone de Beauvoir'),
	(30, 'Barangsiapa tidak mau merasakan pahitnya belajar, ia akan merasakan hinanya kebodohan sepanjang hidupnya. - Imam Syafi’i'),
	(31, 'Sukses hanya bisa diraih melalui gigih belajar, kerja keras, dan doa yang ikhlas. Bukan hanya dengan lamunan.'),
	(32, 'Orang bijak belajar ketika mereka bisa. Orang bodoh belajar ketika mereka terpaksa. - Arthur Wellesley'),
	(33, 'Ikhlaslah belajar. Bahkan yang paling berilmu dan bijak di antara kita masih rajin belajar. - Mario Teguh'),
	(35, 'Tidak ada kata tua untuk belajar.'),
	(36, 'Hiduplah seolah engkau mati besok. Belajarlah seolah engkau hidup selamanya. - Mahatma Gandhi'),
	(37, 'Jangan pernah berhenti belajar karena hidup tak pernah berhenti mengajarkan.'),
	(38, 'Orang yang tak pernah membaca buku sama buruknya dengan mereka yang tak bisa membaca buku. - Mark Twain'),
	(39, 'Lakukan yang terbaik di semua kesempatan yang kamu miliki.'),
	(40, 'Jangan pernah menyerah, memulai adalah selalu hal yang tersulit.'),
	(41, 'Pendidikan adalah senjata paling ampuh untuk mengubah dunia.- Nelson Mandela'),
	(42, 'Kalau mau menunggu sampai siap, kita akan menghabiskan sisa hidup kita hanya untuk menunggu. (Lemony Snicket)'),
	(43, 'Orang bijak belajar ketika mereka bisa. Orang bodoh belajar ketika mereka terpaksa. (Arthur Wellesley)'),
	(44, 'Hiduplah seolah engkau mati besok. Belajarlah seolah engkau hidup selamanya. (Mahatma Gandhi)'),
	(45, 'Pendidikan adalah tiket ke masa depan. Hari esok dimiliki oleh orang-orang yang mempersiapkan dirinya sejak hari ini. (Malcolm X)'),
	(46, 'Orang-orang yang berhenti belajar akan menjadi pemilik masa lalu. Orang-orang yang masih terus belajar, akan menjadi pemilik masa depan. (Mario Teguh)'),
	(47, 'Adalah baik untuk merayakan kesuksesan, tapi hal yang lebih penting adalah untuk mengambil pelajaran dari kegagalan. (Bill Gates)'),
	(48, 'Seseorang yang berhenti belajar adalah orang lanjut usia, meskipun umurnya masih remaja. Seseorang yang tidak pernah berhenti belajar akan selamanya menjadi pemuda. (Hendry Ford)'),
	(49, 'Jika kamu tidak mengejar apa yang kamu inginkan, maka kamu tidak akan mendapatkannya. Jika kamu tidak bertanya maka jawabannya adalah tidak. Jika kamu tidak melangkah maju, kamu akan tetap berada di tempat yang sama. (Nora Roberts)'),
	(50, 'Masa depan adalah milik mereka yang menyiapkan hari ini. –Anonim'),
	(51, 'Orang yang tak pernah membaca buku sama buruknya dengan mereka yang tak bisa membaca buku. -Mark Twain'),
	(52, 'Pendidikan adalah satu-satunya kunci untuk membuka dunia ini, serta paspor untuk menuju kebebasan. -Oprah Winfrey'),
	(53, 'Tidak ada seorang pun yang bisa kembali ke masa lalu dan memulai awal yang baru lagi. Tapi semua orang bisa memulai hari ini dan membuat akhir yang baru. -Maria Robinson'),
	(54, 'Bila memiliki banyak harta, kita akan menjaga harta. Namun jika memiliki banyak ilmu, maka ilmu lah yang akan menjaga kita. -Aa Gym'),
	(55, 'Barangsiapa tidak mau merasakan pahitnya belajar, ia akan merasakan hinanya kebodohan sepanjang hidupnya. -Imam Syafii rahimahullah'),
	(56, 'Jangan menyerah. Menderitalah sekarang dan hiduplah sebagai juara nantinya. -Muhammad Ali'),
	(57, 'Hidup itu seperti bersepeda. Kalau kamu ingin menjaga keseimbanganmu, kamu harus terus bergerak maju. (Albert Einstein)'),
	(58, 'Jika kau menginginkan sesuatu dalam hidupmu yang tak pernah kau punya. Kau harus melakukan sesuatu yang belum pernah kau lakukan. -JD Houson'),
	(59, 'Jangan biarkan siapapun mengatakan kau tidak bisa melakukan sesuatu. Kau bermimpi, kau harus menjaganya. Kalau menginginkan sesuatu, raihlah. Titik. -Chris Gardner, The Pursuit of Happiness'),
	(60, 'Ikhlaslah belajar. Bahkan yang paling berilmu dan bijak di antara kita masih rajin belajar. –Mario Teguh'),
	(61, 'Tak ada jalan pintas ke tempat yang layak dituju. (Beverly Sills)'),
	(62, 'Persiapkan hari ini sebaik-baiknya untuk menghadapi hari esok yang baru.'),
	(63, 'Sebuah perjalanan ribuan mil dimulai dari langkah kecil.'),
	(64, 'Bermimpilah setinggi langit, jika engkau jatuh, engkau akan jatuh di antara bintang-bintang. (Soekarno)'),
	(65, 'Tanpa sasaran dan rencana meraihnya, Anda seperti kapal yang berlayar tanpa tujuan. (Fitzhugh Dodson)'),
	(66, 'Pendidikan bukan cuma pergi ke sekolah dan mendapatkan gelar. Tapi juga soal memperluas pengetahuan dan menyerap ilmu kehidupan. -Shakuntala Devi'),
	(67, ' Mulailah dari mana kau berada. Gunakan apa yang kau punya. Lakukan apa yang kau bisa. - Arthur Ashe'),
	(68, 'Fokuslah menjadi produktif, bukan sekadar sibuk saja. (Tim Ferris)'),
	(69, 'Kebesaran sebenarnya dapat ditemukan dalam hal hal kecil yang terkadang kita lewatkan.'),
	(70, 'Kalau impianmu tak bisa membuatmu takut, mungkin karena impianmu tak cukup besar. (Muhammad Ali)'),
	(71, 'Man jadda wajada. (Barang siapa bersungguh-sungguh, maka dia akan mendapatkan kesuksesan.)'),
	(72, 'Jarib wa laahidzh takun aarifan. (Cobalah dan perhatikanlah, niscaya kau jadi orang yang tahu.)'),
	(73, 'Man saaro alaa darbi wasola. (Barang siapa berjalan pada jalannya, maka dia akan sampai pada tujuannya.)'),
	(74, 'Innamaa yudzhibul-‘ilman-nisyaanu, wa tarkul-mudzaakarati. (Sesungguhnya yang menyebabkan ilmu hilang adalah lupa dan tidak mengulanginya.)'),
	(75, 'Laulal ilma lakaanannaasu kal bahaaim. (Kalaulah tidak karena ilmu niscaya manusia itu seperti binatang.)'),
	(76, 'Stop wishing. Start doing.'),
	(77, 'If you are not willing to learn, no one can help you. If you are determined to learn, no one can stop you.'),
	(78, 'Practice makes us right, repetitions make us perfect.'),
	(79, 'If we never try, we will never know.'),
	(80, 'Failures are your best teacher. Learn from them.'),
	(81, 'Never lost hope, because it is the key to achieve all your dreams.'),
	(82, 'Don’t be afraid to move, because the distance of 1000 miles starts by a single step.'),
	(83, 'It is what we know already that often prevents us from learning.'),
	(84, 'You must pass the bad days first to get the best day in the future.'),
	(85, 'Do not ever give up, the beginning is always the hardest.'),
	(86, 'A little progress each day in your self is add thing up to big result.'),
	(87, 'Change your life today. Dont gamble on the future, act now, without delay. -Simone de Beauvoir'),
	(88, 'Your biggest weakness is when you give up and your greatest power is when you try one more time.');
/*!40000 ALTER TABLE `motifasi_day` ENABLE KEYS */;

-- Dumping structure for procedure pjj2020.nilai_siswa
DROP PROCEDURE IF EXISTS `nilai_siswa`;
DELIMITER //
CREATE PROCEDURE `nilai_siswa`(
	IN `P_GUID_PELXSOAL` CHAR(12)
)
BEGIN
SELECT dt_siswa.kode_siswa, dt_siswa.nama_siswa, dt_siswa.nik_siswa, total_soal, score_final
FROM conf_subkelasxsiswa 
JOIN dt_siswa ON dt_siswa.kode_siswa = conf_subkelasxsiswa.kode_siswa
JOIN conf_subkelasxpel ON conf_subkelasxpel.guid_conf_kelasxsubkelas = conf_subkelasxsiswa.guid_conf_kelasxsubkelas
JOIN tr_pelxsoal ON tr_pelxsoal.guid_conf_subkelasxpel = conf_subkelasxpel.guid_conf_subkelasxpel
LEFT JOIN tr_pelxsoal_siswa ON tr_pelxsoal_siswa.kode_siswa = dt_siswa.kode_siswa 
AND tr_pelxsoal_siswa.guid_pelxsoal =  tr_pelxsoal.guid_pelxsoal
WHERE dt_siswa.ideleted = 0 AND conf_subkelasxsiswa.ideleted = 0 
AND tr_pelxsoal.guid_pelxsoal = P_GUID_PELXSOAL
ORDER BY score_final DESC;
END//
DELIMITER ;

-- Dumping structure for procedure pjj2020.notif_siswa
DROP PROCEDURE IF EXISTS `notif_siswa`;
DELIMITER //
CREATE PROCEDURE `notif_siswa`(
	IN `P_GUID_CONF_KELASXSUBKELAS` CHAR(12),
	IN `P_ISI_NOTIF` TEXT,
	IN `P_URL` TEXT
)
BEGIN

INSERT INTO nt_notif (kode_user, isi_notifikasi, route_url, date_post)
SELECT dt_siswa.kode_siswa,P_ISI_NOTIF,P_URL, NOW() FROM conf_subkelasxsiswa 
JOIN dt_siswa ON dt_siswa.kode_siswa = conf_subkelasxsiswa.kode_siswa
WHERE conf_subkelasxsiswa.ideleted = 0 AND dt_siswa.ideleted = 0
AND conf_subkelasxsiswa.guid_conf_kelasxsubkelas = P_GUID_CONF_KELASXSUBKELAS;

END//
DELIMITER ;

-- Dumping structure for table pjj2020.nt_aktif
DROP TABLE IF EXISTS `nt_aktif`;
CREATE TABLE IF NOT EXISTS `nt_aktif` (
  `auto_aktif` int(11) NOT NULL AUTO_INCREMENT,
  `kode_user` char(15) DEFAULT NULL,
  `isi_aktifitas` text DEFAULT NULL,
  `date_post` datetime DEFAULT NULL,
  `ideleted` tinyint(4) DEFAULT 0,
  PRIMARY KEY (`auto_aktif`) USING BTREE,
  KEY `kode_user_ideleted` (`kode_user`,`ideleted`)
) ENGINE=InnoDB AUTO_INCREMENT=175 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Dumping data for table pjj2020.nt_aktif: ~145 rows (approximately)
/*!40000 ALTER TABLE `nt_aktif` DISABLE KEYS */;
INSERT INTO `nt_aktif` (`auto_aktif`, `kode_user`, `isi_aktifitas`, `date_post`, `ideleted`) VALUES
	(1, 'KR-2011279B5328', 'Log In Applikasi PJJ', '2020-12-07 22:33:42', 0),
	(2, 'KR-2011279B5328', 'Log Out Applikasi PJJ', '2020-12-07 22:34:10', 0),
	(3, 'KR-201127BC7606', 'Log In Applikasi PJJ', '2020-12-07 22:34:26', 0),
	(4, 'KR-201127BC7606', 'Log Out Applikasi PJJ', '2020-12-07 22:40:46', 0),
	(5, 'KR-201127999804', 'Log In Applikasi PJJ', '2020-12-07 22:41:01', 0),
	(6, 'KR-201127999804', 'Log Out Applikasi PJJ', '2020-12-07 22:41:21', 0),
	(7, 'KR-201127014924', 'Log In Applikasi PJJ', '2020-12-07 22:41:30', 0),
	(8, 'KR-201127014924', 'Log Out Applikasi PJJ', '2020-12-07 22:42:03', 0),
	(9, 'KR-20112782C918', 'Log In Applikasi PJJ', '2020-12-07 22:42:13', 0),
	(10, 'KR-20112782C918', 'Log Out Applikasi PJJ', '2020-12-07 22:43:19', 0),
	(11, 'WS-201128CAB554', 'Log In Applikasi PJJ', '2020-12-07 22:43:35', 0),
	(12, 'WS-201128CAB554', 'Log Out Applikasi PJJ', '2020-12-07 22:54:40', 0),
	(13, 'KR-20112782C918', 'Log In Applikasi PJJ', '2020-12-07 22:55:23', 0),
	(14, 'KR-20112782C918', 'Log Out Applikasi PJJ', '2020-12-07 22:56:33', 0),
	(15, 'KR-201127014924', 'Log In Applikasi PJJ', '2020-12-07 22:56:42', 0),
	(16, 'KR-201127014924', 'Menambahkan data TA : 2020 - 2021', '2020-12-07 22:57:06', 0),
	(17, 'KR-201127014924', 'Mengatur KEPSEK data TA : 2020 - 2021, menjadi An : KEPSEK 1 PJJ', '2020-12-07 22:57:14', 0),
	(18, 'KR-201127014924', 'Memvalidasi data TA : 2020 - 2021', '2020-12-07 22:57:22', 0),
	(19, 'KR-201127014924', 'Menambahkan data Kelas TA : 2020 - 2021', '2020-12-07 22:57:40', 0),
	(20, 'KR-201127014924', 'Menambahkan data Kelas TA : 2020 - 2021', '2020-12-07 22:57:51', 0),
	(21, 'KR-201127014924', 'Memvalidasi data Kelas TA : 2020 - 2021', '2020-12-07 22:58:01', 0),
	(22, 'KR-201127014924', 'Menambah data subkelas : X IPA 1 , pada menu Konfigurasi TA', '2020-12-07 22:58:14', 0),
	(23, 'KR-201127014924', 'Menambah data subkelas : X IPA 2 , pada menu Konfigurasi TA', '2020-12-07 22:58:20', 0),
	(24, 'KR-201127014924', 'Menambah data subkelas : X IPS 1 , pada menu Konfigurasi TA', '2020-12-07 22:58:31', 0),
	(25, 'KR-201127014924', 'Menambah data subkelas : X IPS 2 , pada menu Konfigurasi TA', '2020-12-07 22:58:38', 0),
	(26, 'KR-201127014924', 'Memvalidasi data subkelas, pada menu Konfigurasi TA', '2020-12-07 22:58:41', 0),
	(27, 'KR-201127014924', 'Memvalidasi data subkelas, pada menu Konfigurasi TA', '2020-12-07 22:58:43', 0),
	(28, 'KR-201127014924', 'Menambahkan siswa An : Junio Zidan Siahaan di Kelas X IPS 1', '2020-12-07 22:59:19', 0),
	(29, 'KR-201127014924', 'Menambahkan siswa An : Luthfan Syarafi di Kelas X IPA 2', '2020-12-07 22:59:35', 0),
	(30, 'KR-201127014924', 'Menambahkan siswa An : Khotrun Nada di Kelas X IPS 2', '2020-12-07 22:59:43', 0),
	(31, 'KR-201127014924', 'Menambahkan siswa An : Farischa Ramandha Subiakto di Kelas X IPA 1', '2020-12-07 22:59:53', 0),
	(32, 'KR-201127014924', 'Menambahkan siswa An : Adinda Dwi Nurul Aulia di Kelas X IPS 1', '2020-12-07 23:00:18', 0),
	(33, 'KR-201127014924', 'Menambahkan siswa An : Devin Athallah Putra Wibowo di Kelas X IPA 1', '2020-12-07 23:00:30', 0),
	(34, 'KR-201127014924', 'Menghapus siswa An : Farischa Ramandha Subiakto di Kelas X IPA 1', '2020-12-07 23:00:49', 0),
	(35, 'KR-201127014924', 'Menambahkan siswa An : Farischa Ramandha Subiakto di Kelas X IPS 2', '2020-12-07 23:00:55', 0),
	(36, 'KR-201127014924', 'Mengubah walikelas X IPS 1 Menjadi An : PENGAJAR 1 PJJ', '2020-12-07 23:01:07', 0),
	(37, 'KR-201127014924', 'Mengubah walikelas X IPA 2 Menjadi An : PENGAJAR 1 PJJ', '2020-12-07 23:01:12', 0),
	(38, 'KR-201127014924', 'Mengubah walikelas X IPS 2 Menjadi An : PENGAJAR 1 PJJ', '2020-12-07 23:01:21', 0),
	(39, 'KR-201127014924', 'Mengubah walikelas X IPS 2 Menjadi An : PENGAJAR 2 PJJ', '2020-12-07 23:01:26', 0),
	(40, 'KR-201127014924', 'Mengubah walikelas X IPA 1 Menjadi An : PENGAJAR 2 PJJ', '2020-12-07 23:01:30', 0),
	(41, 'KR-201127014924', 'Mengatur guru pengampu Menjadi An : PENGAJAR 1 PJJ', '2020-12-07 23:01:44', 0),
	(42, 'KR-201127014924', 'Mengatur guru pengampu Menjadi An : PENGAJAR 2 PJJ', '2020-12-07 23:01:48', 0),
	(43, 'KR-201127014924', 'Mengubah jadwal pelajaran', '2020-12-07 23:02:16', 0),
	(44, 'KR-201127014924', 'Mengubah jadwal pelajaran', '2020-12-07 23:02:33', 0),
	(45, 'KR-201127014924', 'Mengatur guru pengampu Menjadi An : PENGAJAR 2 PJJ', '2020-12-07 23:02:45', 0),
	(46, 'KR-201127014924', 'Mengubah jadwal pelajaran', '2020-12-07 23:03:03', 0),
	(47, 'KR-201127014924', 'Mengubah jadwal pelajaran', '2020-12-07 23:03:33', 0),
	(48, 'KR-201127014924', 'Mengatur guru pengampu Menjadi An : PENGAJAR 1 PJJ', '2020-12-07 23:03:40', 0),
	(49, 'KR-201127014924', 'Mengatur guru pengampu Menjadi An : PENGAJAR 1 PJJ', '2020-12-07 23:03:51', 0),
	(50, 'KR-201127014924', 'Mengubah jadwal pelajaran', '2020-12-07 23:04:05', 0),
	(51, 'KR-201127014924', 'Mengatur guru pengampu Menjadi An : PENGAJAR 2 PJJ', '2020-12-07 23:04:15', 0),
	(52, 'KR-201127014924', 'Mengubah jadwal pelajaran', '2020-12-07 23:04:27', 0),
	(53, 'KR-201127014924', 'Mengatur guru pengampu Menjadi An : PENGAJAR 2 PJJ', '2020-12-07 23:04:41', 0),
	(54, 'KR-201127014924', 'Mengubah jadwal pelajaran', '2020-12-07 23:05:00', 0),
	(55, 'KR-201127014924', 'Log Out Applikasi PJJ', '2020-12-07 23:05:31', 0),
	(56, 'KR-20112782C918', 'Log In Applikasi PJJ', '2020-12-07 23:05:41', 0),
	(57, 'KR-20112782C918', 'Log Out Applikasi PJJ', '2020-12-07 23:06:52', 0),
	(58, 'SW-201205821816', 'Log In Applikasi PJJ', '2020-12-07 23:07:02', 0),
	(59, 'SW-201205821816', 'Log Out Applikasi PJJ', '2020-12-07 23:07:38', 0),
	(60, 'KR-2011279B5328', 'Log In Applikasi PJJ', '2020-12-07 23:07:56', 0),
	(61, 'KR-2011279B5328', 'Menambahkan Siswa An : Farischa Ramandha Subiakto, ke Walisiswa An :Suwondo', '2020-12-07 23:08:15', 0),
	(62, 'KR-2011279B5328', 'Menambahkan Siswa An : Khotrun Nada, ke Walisiswa An :Suwondo', '2020-12-07 23:08:20', 0),
	(63, 'KR-2011279B5328', 'Menambahkan Siswa An : Junio Zidan Siahaan, ke Walisiswa An :Suwondo', '2020-12-07 23:08:24', 0),
	(64, 'KR-2011279B5328', 'Log Out Applikasi PJJ', '2020-12-07 23:08:27', 0),
	(65, 'WS-201128CAB554', 'Log In Applikasi PJJ', '2020-12-07 23:08:40', 0),
	(66, 'KR-201127999804', 'Log In Applikasi PJJ', '2020-12-09 09:08:10', 0),
	(67, 'KR-201127999804', 'Membuat tagihan An : Adinda Dwi Nurul Aulia', '2020-12-09 09:18:48', 0),
	(68, 'KR-201127999804', 'Membuat tagihan An : Junio Zidan Siahaan', '2020-12-09 09:23:37', 0),
	(69, 'KR-201127999804', 'Membuat tagihan An : Khotrun Nada', '2020-12-09 09:24:07', 0),
	(70, 'KR-201127999804', 'Membuat tagihan An : Khotrun Nada', '2020-12-09 09:24:39', 0),
	(71, 'KR-201127999804', 'Membuat tagihan An : Luthfan Syarafi', '2020-12-09 09:25:11', 0),
	(72, 'KR-201127999804', 'Membuat tagihan An : Farischa Ramandha Subiakto', '2020-12-09 09:25:41', 0),
	(73, 'KR-201127999804', 'Membuat tagihan An : Devin Athallah Putra Wibowo', '2020-12-09 09:26:11', 0),
	(74, 'KR-201127999804', 'Log Out Applikasi PJJ', '2020-12-09 09:26:18', 0),
	(75, 'WS-201128CAB554', 'Log In Applikasi PJJ', '2020-12-09 09:26:38', 0),
	(76, 'WS-201128CAB554', 'Log Out Applikasi PJJ', '2020-12-09 09:39:44', 0),
	(77, 'KR-201127999804', 'Log In Applikasi PJJ', '2020-12-09 09:39:53', 0),
	(78, 'KR-201127999804', 'Mengubah tagihan An : Devin Athallah Putra Wibowo', '2020-12-09 09:40:16', 0),
	(79, 'KR-201127999804', 'Mengubah tagihan An : Devin Athallah Putra Wibowo', '2020-12-09 09:40:51', 0),
	(80, 'KR-201127999804', 'Mengubah tagihan An : Farischa Ramandha Subiakto', '2020-12-09 09:41:00', 0),
	(81, 'KR-201127999804', 'Mengubah tagihan An : Luthfan Syarafi', '2020-12-09 09:41:12', 0),
	(82, 'KR-201127999804', 'Mengubah tagihan An : Khotrun Nada', '2020-12-09 09:41:21', 0),
	(83, 'KR-201127999804', 'Mengubah tagihan An : Junio Zidan Siahaan', '2020-12-09 09:41:29', 0),
	(84, 'KR-201127999804', 'Mengubah tagihan An : Junio Zidan Siahaan', '2020-12-09 09:41:37', 0),
	(85, 'KR-201127999804', 'Mengubah tagihan An : Adinda Dwi Nurul Aulia', '2020-12-09 09:41:46', 0),
	(86, 'KR-201127999804', 'Log Out Applikasi PJJ', '2020-12-09 09:41:49', 0),
	(87, 'WS-201128CAB554', 'Log In Applikasi PJJ', '2020-12-09 09:42:04', 0),
	(88, 'WS-201128CAB554', 'Chekout Pembayaran dengan kode Invoice INV/20/12/09/94232', '2020-12-09 09:42:35', 0),
	(89, 'WS-201128CAB554', 'Chekout Pembayaran dengan kode Invoice INV/20/12/09/94321', '2020-12-09 09:43:25', 0),
	(90, 'WS-201128CAB554', 'Chekout Pembayaran dengan kode Invoice INV/20/12/09/94518', '2020-12-09 09:45:21', 0),
	(91, 'WS-201128CAB554', 'Log In Applikasi PJJ', '2020-12-09 10:28:20', 0),
	(92, 'WS-201128CAB554', 'Log Out Applikasi PJJ', '2020-12-09 11:11:47', 0),
	(93, 'KR-201127BC7606', 'Log In Applikasi PJJ', '2020-12-09 11:12:18', 0),
	(94, 'KR-201127BC7606', 'Log Out Applikasi PJJ', '2020-12-09 12:12:33', 0),
	(95, 'KR-201127999804', 'Log In Applikasi PJJ', '2020-12-09 12:12:53', 0),
	(96, 'KR-201127999804', 'Log Out Applikasi PJJ', '2020-12-09 12:16:53', 0),
	(97, 'KR-20112724E837', 'Log In Applikasi PJJ', '2020-12-09 12:17:19', 0),
	(98, 'KR-20112724E837', 'Log In Applikasi PJJ', '2020-12-09 13:41:03', 0),
	(99, 'KR-20112724E837', 'Log Out Applikasi PJJ', '2020-12-09 13:54:53', 0),
	(100, 'KR-201127BC7606', 'Log In Applikasi PJJ', '2020-12-09 13:55:03', 0),
	(101, 'KR-201127BC7606', 'Log Out Applikasi PJJ', '2020-12-09 13:55:14', 0),
	(102, 'KR-201127014924', 'Log In Applikasi PJJ', '2020-12-09 13:55:27', 0),
	(103, 'KR-201127014924', 'Log Out Applikasi PJJ', '2020-12-09 14:23:44', 0),
	(104, 'KR-201127BC7606', 'Log In Applikasi PJJ', '2020-12-09 14:23:53', 0),
	(105, 'KR-201127BC7606', 'Log Out Applikasi PJJ', '2020-12-09 14:27:20', 0),
	(106, 'KR-201127014924', 'Log In Applikasi PJJ', '2020-12-09 14:27:35', 0),
	(107, 'KR-201127014924', 'Log Out Applikasi PJJ', '2020-12-09 14:29:44', 0),
	(108, 'KR-20112724E837', 'Log In Applikasi PJJ', '2020-12-09 14:29:54', 0),
	(109, 'KR-20112724E837', 'Log Out Applikasi PJJ', '2020-12-09 14:34:04', 0),
	(110, 'SW-201205821816', 'Log In Applikasi PJJ', '2020-12-09 14:34:19', 0),
	(111, 'SW-201205821816', 'Log Out Applikasi PJJ', '2020-12-09 14:37:12', 0),
	(112, 'WS-201128CAB554', 'Log In Applikasi PJJ', '2020-12-09 14:37:27', 0),
	(113, 'WS-201128CAB554', 'Log Out Applikasi PJJ', '2020-12-09 14:39:45', 0),
	(114, 'KR-20112724E837', 'Log In Applikasi PJJ', '2020-12-09 14:40:09', 0),
	(115, 'KR-20112724E837', 'Log Out Applikasi PJJ', '2020-12-09 14:45:42', 0),
	(116, 'SW-201205135816', 'Log In Applikasi PJJ', '2020-12-09 14:46:00', 0),
	(117, 'SW-201205135816', 'Log Out Applikasi PJJ', '2020-12-09 14:48:57', 0),
	(118, 'WS-201128CAB554', 'Log In Applikasi PJJ', '2020-12-09 14:49:09', 0),
	(119, 'WS-201128CAB554', 'Log Out Applikasi PJJ', '2020-12-09 14:49:35', 0),
	(120, 'KR-20112724E837', 'Log In Applikasi PJJ', '2020-12-09 14:50:03', 0),
	(121, 'KR-20112724E837', 'Log Out Applikasi PJJ', '2020-12-09 14:53:54', 0),
	(122, 'SW-201205135816', 'Log In Applikasi PJJ', '2020-12-09 14:54:06', 0),
	(123, 'SW-201205135816', 'Log Out Applikasi PJJ', '2020-12-09 15:08:59', 0),
	(124, 'WS-201128CAB554', 'Log In Applikasi PJJ', '2020-12-09 15:09:08', 0),
	(125, 'WS-201128CAB554', 'Log Out Applikasi PJJ', '2020-12-09 15:11:39', 0),
	(126, 'KR-20112724E837', 'Log In Applikasi PJJ', '2020-12-09 15:16:56', 0),
	(127, 'KR-20112724E837', 'Log Out Applikasi PJJ', '2020-12-09 15:20:53', 0),
	(128, 'SW-201205135816', 'Log In Applikasi PJJ', '2020-12-09 15:21:07', 0),
	(129, 'SW-201205135816', 'Log Out Applikasi PJJ', '2020-12-09 15:21:20', 0),
	(130, 'KR-20112724E837', 'Log In Applikasi PJJ', '2020-12-09 15:21:39', 0),
	(131, 'KR-20112724E837', 'Log Out Applikasi PJJ', '2020-12-09 15:23:16', 0),
	(132, 'KR-201127014924', 'Log In Applikasi PJJ', '2020-12-09 15:23:33', 0),
	(133, 'KR-201127014924', 'Mengubah data TA : 2020 - 2021', '2020-12-09 15:23:44', 0),
	(134, 'KR-201127014924', 'Log Out Applikasi PJJ', '2020-12-09 15:25:47', 0),
	(135, 'KR-20112724E837', 'Log In Applikasi PJJ', '2020-12-09 15:26:01', 0),
	(136, 'KR-20112724E837', 'Log Out Applikasi PJJ', '2020-12-09 15:26:25', 0),
	(137, 'KR-20112782C918', 'Log In Applikasi PJJ', '2020-12-09 15:26:35', 0),
	(138, 'KR-20112782C918', 'Log Out Applikasi PJJ', '2020-12-09 15:27:31', 0),
	(139, 'KR-201127999804', 'Log In Applikasi PJJ', '2020-12-09 15:27:47', 0),
	(140, 'KR-201127999804', 'Log Out Applikasi PJJ', '2020-12-09 15:27:58', 0),
	(141, 'WS-201128CAB554', 'Log In Applikasi PJJ', '2020-12-09 15:28:13', 0),
	(142, 'WS-201128CAB554', 'Log Out Applikasi PJJ', '2020-12-09 15:38:09', 0),
	(143, 'KR-20112724E837', 'Log In Applikasi PJJ', '2020-12-09 15:38:23', 0),
	(144, 'KR-20112724E837', 'Log Out Applikasi PJJ', '2020-12-09 15:40:15', 0),
	(145, 'KR-2011279B5328', 'Log In Applikasi PJJ', '2020-12-09 15:40:32', 0),
	(146, 'KR-2011279B5328', 'Log Out Applikasi PJJ', '2020-12-09 15:41:11', 0),
	(147, 'KR-201127014924', 'Log In Applikasi PJJ', '2020-12-09 15:41:31', 0),
	(148, 'KR-201127014924', 'Log Out Applikasi PJJ', '2020-12-09 15:42:22', 0),
	(149, 'KR-201127BC7606', 'Log In Applikasi PJJ', '2020-12-09 15:42:30', 0),
	(150, 'KR-201127BC7606', 'Log Out Applikasi PJJ', '2020-12-09 15:43:05', 0),
	(151, 'KR-20112782C918', 'Log In Applikasi PJJ', '2020-12-09 15:43:13', 0),
	(152, 'KR-20112782C918', 'Log Out Applikasi PJJ', '2020-12-09 15:43:32', 0),
	(153, 'KR-20112724E837', 'Log In Applikasi PJJ', '2020-12-09 15:43:44', 0),
	(154, 'KR-20112724E837', 'Log Out Applikasi PJJ', '2020-12-09 15:46:25', 0),
	(155, 'KR-201127014924', 'Log In Applikasi PJJ', '2020-12-09 22:06:33', 0),
	(156, 'KR-201127014924', 'Log Out Applikasi PJJ', '2020-12-09 22:13:43', 0),
	(157, 'KR-201127014924', 'Log In Applikasi PJJ', '2020-12-09 22:35:12', 0),
	(158, 'KR-201127014924', 'Log Out Applikasi PJJ', '2020-12-09 22:40:40', 0),
	(159, 'KR-201127014924', 'Log In Applikasi PJJ', '2020-12-11 12:25:45', 0),
	(160, 'KR-20112782C918', 'Log In Applikasi PJJ', '2020-12-11 13:20:32', 0),
	(161, 'KR-20112782C918', 'Log Out Applikasi PJJ', '2020-12-11 13:20:50', 0),
	(162, 'KR-20112782C918', 'Log In Applikasi PJJ', '2020-12-11 13:55:58', 0),
	(163, 'KR-20112782C918', 'Log Out Applikasi PJJ', '2020-12-11 15:12:59', 0),
	(164, 'WS-201128CAB554', 'Log In Applikasi PJJ', '2020-12-11 15:13:25', 0),
	(165, 'KR-2011279B5328', 'Log In Applikasi PJJ', '2020-12-12 14:54:45', 0),
	(166, 'KR-2011279B5328', 'Log In Applikasi PJJ', '2020-12-12 15:30:45', 0),
	(167, 'KR-20112782C918', 'Log In Applikasi PJJ', '2020-12-13 10:30:58', 0),
	(168, 'KR-20112782C918', 'Log In Applikasi PJJ', '2020-12-13 10:30:58', 0),
	(169, 'KR-20112782C918', 'Log In Applikasi PJJ', '2020-12-13 10:34:18', 0),
	(170, 'KR-20112782C918', 'Log Out Applikasi PJJ', '2020-12-13 10:34:43', 0),
	(171, 'KR-2011279B5328', 'Log In Applikasi PJJ', '2020-12-13 10:34:58', 0),
	(172, 'KR-2011279B5328', 'Mengatur KEPSEK data TA : 2020 - 2021, menjadi An : KEPSEK 1 PJJ', '2020-12-13 10:42:04', 0),
	(173, 'KR-2011279B5328', 'Mengubah walikelas X IPA 2 Menjadi An : PENGAJAR 1 PJJ', '2020-12-13 10:42:56', 0),
	(174, 'KR-2011279B5328', 'Mengatur guru pengampu Menjadi An : PENGAJAR 1 PJJ', '2020-12-13 10:43:52', 0);
/*!40000 ALTER TABLE `nt_aktif` ENABLE KEYS */;

-- Dumping structure for table pjj2020.nt_notif
DROP TABLE IF EXISTS `nt_notif`;
CREATE TABLE IF NOT EXISTS `nt_notif` (
  `auto_notif` int(11) NOT NULL AUTO_INCREMENT,
  `kode_user` char(15) DEFAULT NULL,
  `isi_notifikasi` text DEFAULT NULL,
  `route_url` text DEFAULT NULL,
  `date_post` datetime DEFAULT NULL,
  `ideleted` tinyint(4) DEFAULT 0,
  PRIMARY KEY (`auto_notif`) USING BTREE,
  KEY `kode_siswa_ideleted` (`kode_user`,`ideleted`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4;
 
-- Dumping structure for table pjj2020.rp_jenisraport
DROP TABLE IF EXISTS `rp_jenisraport`;
CREATE TABLE IF NOT EXISTS `rp_jenisraport` (
  `ijenisraport` tinyint(4) NOT NULL AUTO_INCREMENT,
  `kode_jenisraport` char(3) DEFAULT NULL,
  `namaraport` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ijenisraport`) USING BTREE,
  KEY `kodejenisraport` (`kode_jenisraport`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COMMENT='rp_jenisraport';

-- Dumping data for table pjj2020.rp_jenisraport: ~2 rows (approximately)
/*!40000 ALTER TABLE `rp_jenisraport` DISABLE KEYS */;
INSERT INTO `rp_jenisraport` (`ijenisraport`, `kode_jenisraport`, `namaraport`) VALUES
	(1, 'PAS', 'Akhir Semester'),
	(2, 'PKD', 'Kompetensi Dasar');
/*!40000 ALTER TABLE `rp_jenisraport` ENABLE KEYS */;

-- Dumping structure for table pjj2020.rp_jurxpelajaran
DROP TABLE IF EXISTS `rp_jurxpelajaran`;
CREATE TABLE IF NOT EXISTS `rp_jurxpelajaran` (
  `ijurxpelajaran` int(11) NOT NULL AUTO_INCREMENT,
  `kode_jurusan` char(15) DEFAULT NULL,
  `kode_kelas` char(15) DEFAULT NULL,
  `kode_kelpelajaran` char(15) DEFAULT NULL,
  `kode_pelajaran` char(15) DEFAULT NULL,
  `iurutan` int(11) DEFAULT NULL,
  `kkm` double DEFAULT NULL,
  PRIMARY KEY (`ijurxpelajaran`) USING BTREE,
  KEY `kodekelas` (`kode_kelas`) USING BTREE,
  KEY `kodekelompok` (`kode_kelpelajaran`) USING BTREE,
  KEY `kodepelajaran` (`kode_pelajaran`) USING BTREE,
  KEY `kodejuruan` (`kode_jurusan`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=132 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table pjj2020.rp_jurxpelajaran: ~128 rows (approximately)
/*!40000 ALTER TABLE `rp_jurxpelajaran` DISABLE KEYS */;
INSERT INTO `rp_jurxpelajaran` (`ijurxpelajaran`, `kode_jurusan`, `kode_kelas`, `kode_kelpelajaran`, `kode_pelajaran`, `iurutan`, `kkm`) VALUES
	(1, 'JR-20111367A804', 'KE-201113C92017', 'KP-2011137F6245', 'PE-2011137D8424', 1, 75),
	(2, 'JR-20111367A804', 'KE-2011130F9031', 'KP-2011137F6245', 'PE-2011137D8424', 1, 75),
	(3, 'JR-201113D9C842', 'KE-201113C75024', 'KP-2011137F6245', 'PE-2011137D8424', 1, 75),
	(4, 'JR-201113D9C842', 'KE-201113C92017', 'KP-2011137F6245', 'PE-2011137D8424', 1, 75),
	(5, 'JR-20111367A804', 'KE-201113C75024', 'KP-2011137F6245', 'PE-2011137D8424', 1, 75),
	(6, 'JR-201113447739', 'KE-2011130F9031', 'KP-2011137F6245', 'PE-2011137D8424', 1, 75),
	(7, 'JR-201113447739', 'KE-201113C92017', 'KP-2011137F6245', 'PE-2011137D8424', 1, 75),
	(8, 'JR-201113447739', 'KE-201113C75024', 'KP-2011137F6245', 'PE-2011137D8424', 1, 75),
	(9, 'JR-20111367A804', 'KE-201113C92017', 'KP-2011137F6245', 'PE-2011136A6642', 2, 75),
	(10, 'JR-20111367A804', 'KE-2011130F9031', 'KP-2011137F6245', 'PE-2011136A6642', 2, 75),
	(11, 'JR-201113D9C842', 'KE-201113C75024', 'KP-2011137F6245', 'PE-2011136A6642', 2, 75),
	(12, 'JR-201113D9C842', 'KE-201113C92017', 'KP-2011137F6245', 'PE-2011136A6642', 2, 75),
	(13, 'JR-20111367A804', 'KE-201113C75024', 'KP-2011137F6245', 'PE-2011136A6642', 2, 75),
	(14, 'JR-201113447739', 'KE-2011130F9031', 'KP-2011137F6245', 'PE-2011136A6642', 2, 75),
	(15, 'JR-201113447739', 'KE-201113C92017', 'KP-2011137F6245', 'PE-2011136A6642', 2, 75),
	(16, 'JR-201113447739', 'KE-201113C75024', 'KP-2011137F6245', 'PE-2011136A6642', 2, 75),
	(17, 'JR-20111367A804', 'KE-201113C92017', 'KP-2011137F6245', 'PE-201113603654', 3, 75),
	(18, 'JR-20111367A804', 'KE-2011130F9031', 'KP-2011137F6245', 'PE-201113603654', 3, 75),
	(19, 'JR-201113D9C842', 'KE-201113C75024', 'KP-2011137F6245', 'PE-201113603654', 3, 75),
	(20, 'JR-201113D9C842', 'KE-201113C92017', 'KP-2011137F6245', 'PE-201113603654', 3, 75),
	(21, 'JR-20111367A804', 'KE-201113C75024', 'KP-2011137F6245', 'PE-201113603654', 3, 75),
	(22, 'JR-201113447739', 'KE-2011130F9031', 'KP-2011137F6245', 'PE-201113603654', 3, 75),
	(23, 'JR-201113447739', 'KE-201113C92017', 'KP-2011137F6245', 'PE-201113603654', 3, 75),
	(24, 'JR-201113447739', 'KE-201113C75024', 'KP-2011137F6245', 'PE-201113603654', 3, 75),
	(25, 'JR-20111367A804', 'KE-2011130F9031', 'KP-2011137F6245', 'PE-201113401732', 4, 75),
	(26, 'JR-201113D9C842', 'KE-201113C75024', 'KP-2011137F6245', 'PE-201113401732', 4, 75),
	(27, 'JR-201113D9C842', 'KE-201113C92017', 'KP-2011137F6245', 'PE-201113401732', 4, 75),
	(28, 'JR-20111367A804', 'KE-201113C75024', 'KP-2011137F6245', 'PE-201113401732', 4, 75),
	(29, 'JR-201113447739', 'KE-2011130F9031', 'KP-2011137F6245', 'PE-201113401732', 4, 75),
	(30, 'JR-201113447739', 'KE-201113C92017', 'KP-2011137F6245', 'PE-201113401732', 4, 75),
	(31, 'JR-201113447739', 'KE-201113C75024', 'KP-2011137F6245', 'PE-201113401732', 4, 75),
	(32, 'JR-20111367A804', 'KE-201113C92017', 'KP-2011137F6245', 'PE-201113401732', 4, 75),
	(33, 'JR-20111367A804', 'KE-2011130F9031', 'KP-2011137F6245', 'PE-201113785746', 5, 75),
	(34, 'JR-201113D9C842', 'KE-201113C75024', 'KP-2011137F6245', 'PE-201113785746', 5, 75),
	(35, 'JR-201113D9C842', 'KE-201113C92017', 'KP-2011137F6245', 'PE-201113785746', 5, 75),
	(36, 'JR-20111367A804', 'KE-201113C75024', 'KP-2011137F6245', 'PE-201113785746', 5, 75),
	(37, 'JR-201113447739', 'KE-2011130F9031', 'KP-2011137F6245', 'PE-201113785746', 5, 75),
	(38, 'JR-201113447739', 'KE-201113C92017', 'KP-2011137F6245', 'PE-201113785746', 5, 75),
	(39, 'JR-201113447739', 'KE-201113C75024', 'KP-2011137F6245', 'PE-201113785746', 5, 75),
	(40, 'JR-20111367A804', 'KE-201113C92017', 'KP-2011137F6245', 'PE-201113785746', 5, 75),
	(41, 'JR-20111367A804', 'KE-201113C92017', 'KP-2011137F6245', 'PE-201113734719', 6, 75),
	(42, 'JR-201113D9C842', 'KE-201113C75024', 'KP-2011137F6245', 'PE-201113734719', 6, 75),
	(43, 'JR-201113D9C842', 'KE-201113C92017', 'KP-2011137F6245', 'PE-201113734719', 6, 75),
	(44, 'JR-20111367A804', 'KE-201113C75024', 'KP-2011137F6245', 'PE-201113734719', 6, 75),
	(45, 'JR-201113447739', 'KE-2011130F9031', 'KP-2011137F6245', 'PE-201113734719', 6, 75),
	(46, 'JR-201113447739', 'KE-201113C92017', 'KP-2011137F6245', 'PE-201113734719', 6, 75),
	(47, 'JR-201113447739', 'KE-201113C75024', 'KP-2011137F6245', 'PE-201113734719', 6, 75),
	(48, 'JR-20111367A804', 'KE-2011130F9031', 'KP-2011137F6245', 'PE-201113734719', 6, 75),
	(49, 'JR-201113D9C842', 'KE-201113C92017', 'KP-2011131F3255', 'PE-201113DA3802', 7, 75),
	(50, 'JR-20111367A804', 'KE-201113C75024', 'KP-2011131F3255', 'PE-201113DA3802', 7, 75),
	(51, 'JR-201113447739', 'KE-2011130F9031', 'KP-2011131F3255', 'PE-201113DA3802', 7, 75),
	(52, 'JR-201113447739', 'KE-201113C92017', 'KP-2011131F3255', 'PE-201113DA3802', 7, 75),
	(53, 'JR-201113447739', 'KE-201113C75024', 'KP-2011131F3255', 'PE-201113DA3802', 7, 75),
	(54, 'JR-20111367A804', 'KE-201113C92017', 'KP-2011131F3255', 'PE-201113DA3802', 7, 75),
	(55, 'JR-20111367A804', 'KE-2011130F9031', 'KP-2011131F3255', 'PE-201113DA3802', 7, 75),
	(56, 'JR-201113D9C842', 'KE-201113C75024', 'KP-2011131F3255', 'PE-201113DA3802', 7, 75),
	(57, 'JR-20111367A804', 'KE-201113C75024', 'KP-2011131F3255', 'PE-201113643902', 8, 75),
	(58, 'JR-201113447739', 'KE-2011130F9031', 'KP-2011131F3255', 'PE-201113643902', 8, 75),
	(59, 'JR-201113447739', 'KE-201113C92017', 'KP-2011131F3255', 'PE-201113643902', 8, 75),
	(60, 'JR-201113447739', 'KE-201113C75024', 'KP-2011131F3255', 'PE-201113643902', 8, 75),
	(61, 'JR-20111367A804', 'KE-201113C92017', 'KP-2011131F3255', 'PE-201113643902', 8, 75),
	(62, 'JR-20111367A804', 'KE-2011130F9031', 'KP-2011131F3255', 'PE-201113643902', 8, 75),
	(63, 'JR-201113D9C842', 'KE-201113C75024', 'KP-2011131F3255', 'PE-201113643902', 8, 75),
	(64, 'JR-201113D9C842', 'KE-201113C92017', 'KP-2011131F3255', 'PE-201113643902', 8, 75),
	(65, 'JR-20111367A804', 'KE-201113C75024', 'KP-2011131F3255', 'PE-2011138D3814', 9, 75),
	(66, 'JR-201113447739', 'KE-2011130F9031', 'KP-2011131F3255', 'PE-2011138D3814', 9, 75),
	(67, 'JR-201113447739', 'KE-201113C92017', 'KP-2011131F3255', 'PE-2011138D3814', 9, 75),
	(68, 'JR-201113447739', 'KE-201113C75024', 'KP-2011131F3255', 'PE-2011138D3814', 9, 75),
	(69, 'JR-20111367A804', 'KE-201113C92017', 'KP-2011131F3255', 'PE-2011138D3814', 9, 75),
	(70, 'JR-20111367A804', 'KE-2011130F9031', 'KP-2011131F3255', 'PE-2011138D3814', 9, 75),
	(71, 'JR-201113D9C842', 'KE-201113C75024', 'KP-2011131F3255', 'PE-2011138D3814', 9, 75),
	(72, 'JR-201113D9C842', 'KE-201113C92017', 'KP-2011131F3255', 'PE-2011138D3814', 9, 75),
	(73, 'JR-201113447739', 'KE-2011130F9031', 'KP-201113434304', 'PE-201113EB1048', 10, 75),
	(74, 'JR-201113447739', 'KE-201113C92017', 'KP-201113434304', 'PE-201113EB1048', 10, 75),
	(75, 'JR-201113447739', 'KE-201113C75024', 'KP-201113434304', 'PE-201113EB1048', 10, 75),
	(76, 'JR-20111367A804', 'KE-201113C75024', 'KP-201113434304', 'PE-201113BCA545', 10, 75),
	(77, 'JR-20111367A804', 'KE-201113C92017', 'KP-201113434304', 'PE-201113BCA545', 10, 75),
	(78, 'JR-20111367A804', 'KE-2011130F9031', 'KP-201113434304', 'PE-201113BCA545', 10, 75),
	(79, 'JR-201113D9C842', 'KE-201113C75024', 'KP-201113434304', 'PE-201113C51938', 10, 75),
	(80, 'JR-201113D9C842', 'KE-201113C92017', 'KP-201113434304', 'PE-201113C51938', 10, 75),
	(81, 'JR-20111367A804', 'KE-201113C75024', 'KP-201113434304', 'PE-201113B15438', 11, 75),
	(82, 'JR-201113447739', 'KE-2011130F9031', 'KP-201113434304', 'PE-2011136D5100', 11, 75),
	(83, 'JR-201113447739', 'KE-201113C92017', 'KP-201113434304', 'PE-2011136D5100', 11, 75),
	(84, 'JR-201113447739', 'KE-201113C75024', 'KP-201113434304', 'PE-2011136D5100', 11, 75),
	(85, 'JR-20111367A804', 'KE-2011130F9031', 'KP-201113434304', 'PE-201113B15438', 11, 75),
	(86, 'JR-20111367A804', 'KE-201113C92017', 'KP-201113434304', 'PE-201113B15438', 11, 75),
	(87, 'JR-201113D9C842', 'KE-201113C75024', 'KP-201113434304', 'PE-2011139CE950', 11, 75),
	(88, 'JR-201113D9C842', 'KE-201113C92017', 'KP-201113434304', 'PE-2011139CE950', 11, 75),
	(89, 'JR-201113447739', 'KE-2011130F9031', 'KP-201113434304', 'PE-20111311B850', 12, 75),
	(90, 'JR-201113447739', 'KE-201113C92017', 'KP-201113434304', 'PE-20111311B850', 12, 75),
	(91, 'JR-201113447739', 'KE-201113C75024', 'KP-201113434304', 'PE-20111311B850', 12, 75),
	(92, 'JR-20111367A804', 'KE-201113C75024', 'KP-201113434304', 'PE-2011139B5613', 12, 75),
	(93, 'JR-20111367A804', 'KE-201113C92017', 'KP-201113434304', 'PE-2011139B5613', 12, 75),
	(94, 'JR-201113D9C842', 'KE-201113C75024', 'KP-201113434304', 'PE-201113ED6002', 12, 75),
	(95, 'JR-20111367A804', 'KE-2011130F9031', 'KP-201113434304', 'PE-2011139B5613', 12, 75),
	(96, 'JR-201113D9C842', 'KE-201113C92017', 'KP-201113434304', 'PE-201113ED6002', 12, 75),
	(97, 'JR-201113447739', 'KE-2011130F9031', 'KP-201113434304', 'PE-201113020127', 13, 75),
	(98, 'JR-201113447739', 'KE-201113C92017', 'KP-201113434304', 'PE-201113020127', 13, 75),
	(99, 'JR-201113447739', 'KE-201113C75024', 'KP-201113434304', 'PE-201113020127', 13, 75),
	(100, 'JR-20111367A804', 'KE-201113C75024', 'KP-201113434304', 'PE-201113A26457', 13, 75),
	(101, 'JR-20111367A804', 'KE-2011130F9031', 'KP-201113434304', 'PE-201113A26457', 13, 75),
	(102, 'JR-20111367A804', 'KE-201113C92017', 'KP-201113434304', 'PE-201113A26457', 13, 75),
	(103, 'JR-201113D9C842', 'KE-201113C75024', 'KP-201113434304', 'PE-201113095013', 13, 75),
	(104, 'JR-201113D9C842', 'KE-201113C92017', 'KP-201113434304', 'PE-201113095013', 13, 75),
	(105, 'JR-201113447739', 'KE-201113C92017', 'KP-201113C4D323', 'PE-201113A50600', 14, 75),
	(106, 'JR-201113447739', 'KE-2011130F9031', 'KP-201113C4D323', 'PE-20111327C915', 14, 75),
	(107, 'JR-201113447739', 'KE-201113C75024', 'KP-201113C4D323', 'PE-201113A50600', 14, 75),
	(108, 'JR-20111367A804', 'KE-201113C75024', 'KP-201113C4D323', 'PE-201113321836', 14, 75),
	(109, 'JR-20111367A804', 'KE-201113C92017', 'KP-201113C4D323', 'PE-201113321836', 14, 75),
	(110, 'JR-20111367A804', 'KE-2011130F9031', 'KP-201113C4D323', 'PE-2011134A4116', 14, 75),
	(111, 'JR-201113447739', 'KE-201113C92017', 'KP-201113C4D323', 'PE-2011134A4116', 15, 75),
	(112, 'JR-201113447739', 'KE-201113C75024', 'KP-20111352E334', 'PE-201113709629', 15, 75),
	(113, 'JR-20111367A804', 'KE-201113C75024', 'KP-20111352E334', 'PE-201113709629', 15, 75),
	(114, 'JR-20111367A804', 'KE-201113C92017', 'KP-201113C4D323', 'PE-2011134A4116', 15, 75),
	(115, 'JR-201113447739', 'KE-201113C92017', 'KP-20111352E334', 'PE-201113709629', 16, 75),
	(116, 'JR-20111367A804', 'KE-201113C92017', 'KP-20111352E334', 'PE-201113709629', 16, 75),
	(117, 'JR-201113D9C842', 'KE-201113C92017', 'KP-201113C4D323', 'PE-20111326F025', 16, 75),
	(118, 'JR-201113D9C842', 'KE-201113C75024', 'KP-201113C4D323', 'PE-20111326F025', 16, 75),
	(119, 'JR-201113447739', 'KE-201113C92017', 'KP-20111352E334', 'PE-201113464037', 17, 75),
	(120, 'JR-20111367A804', 'KE-201113C92017', 'KP-20111352E334', 'PE-201113464037', 17, 75),
	(121, 'JR-201113D9C842', 'KE-201113C75024', 'KP-20111352E334', 'PE-201113709629', 17, 75),
	(122, 'JR-201113D9C842', 'KE-201113C92017', 'KP-20111352E334', 'PE-201113709629', 17, 75),
	(123, 'JR-201113D9C842', 'KE-201113C75024', 'KP-201113C4D323', 'PE-2011133EB926', 18, 75),
	(124, 'JR-201113D9C842', 'KE-201113C92017', 'KP-201113C4D323', 'PE-2011134A4116', 18, 75),
	(125, 'JR-201113D9C842', 'KE-201113C75024', 'KP-20111352E334', 'PE-201113464037', 19, 75),
	(126, 'JR-201113D9C842', 'KE-201113C92017', 'KP-20111352E334', 'PE-201113464037', 19, 75),
	(128, 'JR-201113D9C842', 'KE-2011130F9031', 'KP-20111352E334', 'PE-20111326F025', 0, 75);
/*!40000 ALTER TABLE `rp_jurxpelajaran` ENABLE KEYS */;

-- Dumping structure for table pjj2020.rp_raport
DROP TABLE IF EXISTS `rp_raport`;
CREATE TABLE IF NOT EXISTS `rp_raport` (
  `guid_raport` varchar(50) NOT NULL,
  `statusspp` varchar(50) DEFAULT NULL,
  `statuskenaikan` varchar(50) DEFAULT NULL,
  `niksiswa` varchar(50) DEFAULT NULL,
  `kegiatanextra` varchar(50) DEFAULT NULL,
  `nilaikegiatanwajib` char(2) DEFAULT NULL,
  `nilaikegiatan` char(2) DEFAULT NULL,
  `guid_upload` varchar(12) NOT NULL,
  `guid_conf_kelasxsubkelas` varchar(12) DEFAULT NULL,
  `guid_tahunajaran` varchar(12) DEFAULT NULL,
  `guid_conf_kelas` varchar(12) DEFAULT NULL,
  `kode_jenisraport` varchar(3) DEFAULT NULL COMMENT 'PKD / PAS',
  PRIMARY KEY (`guid_raport`),
  KEY `keyjoin` (`guid_upload`,`guid_conf_kelasxsubkelas`,`guid_tahunajaran`,`guid_conf_kelas`),
  KEY `niksiswa` (`niksiswa`),
  KEY `kode_jenisraport_status` (`kode_jenisraport`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pjj2020.rp_raport: ~0 rows (approximately)
/*!40000 ALTER TABLE `rp_raport` DISABLE KEYS */;
/*!40000 ALTER TABLE `rp_raport` ENABLE KEYS */;

-- Dumping structure for table pjj2020.rp_raportdetail
DROP TABLE IF EXISTS `rp_raportdetail`;
CREATE TABLE IF NOT EXISTS `rp_raportdetail` (
  `guid_raportdetail` varchar(13) NOT NULL,
  `guid_raport` varchar(12) DEFAULT NULL,
  `guid_upload` varchar(12) NOT NULL,
  `kode_pelajaran` varchar(15) DEFAULT NULL,
  `kodenilai` char(4) DEFAULT NULL,
  `nilai` varchar(10) DEFAULT NULL,
  `iurutan` char(2) DEFAULT NULL,
  PRIMARY KEY (`guid_raportdetail`) USING BTREE,
  KEY `raportdetail` (`guid_raport`,`kode_pelajaran`,`kodenilai`) USING BTREE,
  KEY `guidupload` (`guid_upload`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table pjj2020.rp_raportdetail: ~0 rows (approximately)
/*!40000 ALTER TABLE `rp_raportdetail` DISABLE KEYS */;
/*!40000 ALTER TABLE `rp_raportdetail` ENABLE KEYS */;

-- Dumping structure for table pjj2020.rp_upload
DROP TABLE IF EXISTS `rp_upload`;
CREATE TABLE IF NOT EXISTS `rp_upload` (
  `guid_upload` varchar(12) NOT NULL,
  `guid_conf_kelasxsubkelas` varchar(12) DEFAULT NULL,
  `guid_tahunajaran` varchar(12) DEFAULT NULL,
  `guid_conf_kelas` varchar(12) DEFAULT NULL,
  `kode_jenisraport` varchar(3) DEFAULT NULL COMMENT 'PKD / PAS',
  `tgl_ditampilkan` date DEFAULT NULL,
  `tgl_upload` datetime DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `status` enum('Active','Non Active') DEFAULT NULL,
  `kode_karyawan_kepsek` varchar(15) DEFAULT NULL,
  `kode_karyawan_wali` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`guid_upload`),
  KEY `guid_conf_kelasxsubkelas_guid_tahunajaran_guid_conf_kelas` (`guid_conf_kelasxsubkelas`,`guid_tahunajaran`,`guid_conf_kelas`),
  KEY `kode_jenisraport_status` (`kode_jenisraport`,`status`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pjj2020.rp_upload: ~0 rows (approximately)
/*!40000 ALTER TABLE `rp_upload` DISABLE KEYS */;
/*!40000 ALTER TABLE `rp_upload` ENABLE KEYS */;

-- Dumping structure for table pjj2020.tr_invoice
DROP TABLE IF EXISTS `tr_invoice`;
CREATE TABLE IF NOT EXISTS `tr_invoice` (
  `guid_invoice` char(12) NOT NULL,
  `kode_invoice` char(18) DEFAULT NULL,
  `tgl_generate` datetime DEFAULT NULL,
  `tgl_expired` datetime DEFAULT NULL,
  `total_invoice` double DEFAULT NULL,
  `status` enum('PENDING','PAID','SETTLED','EXPIRED') DEFAULT NULL COMMENT 'PENDING invoice belum dibayar\r\nPAID invoice sudah berhasil dibayar\r\nSETTLED dana yang dibayarkan sudah masuk ke saldo\r\nEXPIRED invoice sudah kedaluwarsa ',
  `invoice_url` text DEFAULT NULL,
  `id_invoice` varchar(50) DEFAULT NULL,
  `userid_invoice` varchar(50) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `ideleted` tinyint(1) NOT NULL DEFAULT 0,
  `payment_method` varchar(50) DEFAULT NULL,
  `payment_channel` varchar(50) DEFAULT NULL,
  `payment_destination` varchar(50) DEFAULT NULL,
  `tgl_pembayaran` datetime DEFAULT NULL,
  PRIMARY KEY (`guid_invoice`),
  KEY `kode_invoice_status_ideleted` (`kode_invoice`,`status`,`ideleted`,`id_invoice`,`userid_invoice`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Dumping data for table pjj2020.tr_invoice: ~3 rows (approximately)
/*!40000 ALTER TABLE `tr_invoice` DISABLE KEYS */;
INSERT INTO `tr_invoice` (`guid_invoice`, `kode_invoice`, `tgl_generate`, `tgl_expired`, `total_invoice`, `status`, `invoice_url`, `id_invoice`, `userid_invoice`, `keterangan`, `ideleted`, `payment_method`, `payment_channel`, `payment_destination`, `tgl_pembayaran`) VALUES
	('35E98D786232', 'INV/20/12/09/94232', '2020-12-09 09:42:35', '2020-12-10 09:42:37', 84000, 'PENDING', 'https://checkout-staging.xendit.co/web/5fd0399dd6f4b5405ee8f9ea', '5fd0399dd6f4b5405ee8f9ea', '5fbd349c6b1f20404cc0948d', '[TG/SPP201209541-Farischa Ramandha Subiakto-SPP]', 0, NULL, NULL, NULL, NULL),
	('BB73342D0321', 'INV/20/12/09/94321', '2020-12-09 09:43:25', '2020-12-10 09:43:26', 90300, 'PENDING', 'https://checkout-staging.xendit.co/web/5fd039ced6f4b5405ee8f9ec', '5fd039ced6f4b5405ee8f9ec', '5fbd349c6b1f20404cc0948d', '[TG/SPP201209439-Khotrun Nada-SPP]', 0, NULL, NULL, NULL, NULL),
	('C1E5218CE518', 'INV/20/12/09/94518', '2020-12-09 09:45:21', '2020-12-10 09:45:22', 40500, 'SETTLED', 'https://checkout-staging.xendit.co/web/5fd03a42d6f4b5405ee8f9ee', '5fd03a42d6f4b5405ee8f9ee', '5fbd349c6b1f20404cc0948d', '[TG/EXK201209337-Junio Zidan Siahaan-Extra Kulikuler]', 0, 'BANK TRANSFER', 'MANDIRI', '8860895167736', '2020-12-09 09:46:04');
/*!40000 ALTER TABLE `tr_invoice` ENABLE KEYS */;

-- Dumping structure for table pjj2020.tr_invoice_det
DROP TABLE IF EXISTS `tr_invoice_det`;
CREATE TABLE IF NOT EXISTS `tr_invoice_det` (
  `guid_invoive_det` char(12) NOT NULL,
  `guid_invoice` char(12) NOT NULL,
  `guid_tagihan` char(12) DEFAULT NULL,
  `ideleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`guid_invoive_det`),
  KEY `KEY` (`guid_invoice`,`guid_tagihan`,`ideleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Dumping data for table pjj2020.tr_invoice_det: ~2 rows (approximately)
/*!40000 ALTER TABLE `tr_invoice_det` DISABLE KEYS */;
INSERT INTO `tr_invoice_det` (`guid_invoive_det`, `guid_invoice`, `guid_tagihan`, `ideleted`) VALUES
	('610BABBB5234', '35E98D786232', '2BA7F9DCC541', 0),
	('13D356A9D324', 'BB73342D0321', 'C0BD8FAC5439', 0),
	('6E3CB6B68519', 'C1E5218CE518', '1727F1707337', 0);
/*!40000 ALTER TABLE `tr_invoice_det` ENABLE KEYS */;

-- Dumping structure for table pjj2020.tr_onlinemeet
DROP TABLE IF EXISTS `tr_onlinemeet`;
CREATE TABLE IF NOT EXISTS `tr_onlinemeet` (
  `guid_onlinemeet` int(11) NOT NULL AUTO_INCREMENT,
  `guid_conf_subkelasxpel` char(12) NOT NULL,
  `kode_user` char(15) DEFAULT NULL,
  `tanggal_join` date DEFAULT NULL,
  `jam_join` time DEFAULT NULL,
  PRIMARY KEY (`guid_onlinemeet`) USING BTREE,
  KEY `guid_conf_subkelasxpel_ideleted_status` (`guid_conf_subkelasxpel`) USING BTREE,
  KEY `kode_user` (`kode_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Dumping data for table pjj2020.tr_onlinemeet: ~0 rows (approximately)
/*!40000 ALTER TABLE `tr_onlinemeet` DISABLE KEYS */;
/*!40000 ALTER TABLE `tr_onlinemeet` ENABLE KEYS */;

-- Dumping structure for table pjj2020.tr_pelxmateri
DROP TABLE IF EXISTS `tr_pelxmateri`;
CREATE TABLE IF NOT EXISTS `tr_pelxmateri` (
  `guid_pelxmateri` char(12) NOT NULL,
  `guid_conf_subkelasxpel` char(12) NOT NULL,
  `nama_materi` varchar(50) DEFAULT NULL,
  `keterangan` varchar(300) DEFAULT NULL,
  `path_upload` text DEFAULT NULL,
  `ideleted` tinyint(1) DEFAULT 0,
  `status` enum('Active','Non Active') DEFAULT 'Non Active',
  `tgl_posting` datetime DEFAULT NULL,
  PRIMARY KEY (`guid_pelxmateri`),
  KEY `guid_conf_subkelasxpel_ideleted_status` (`guid_conf_subkelasxpel`,`ideleted`,`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Dumping data for table pjj2020.tr_pelxmateri: ~0 rows (approximately)
/*!40000 ALTER TABLE `tr_pelxmateri` DISABLE KEYS */;
/*!40000 ALTER TABLE `tr_pelxmateri` ENABLE KEYS */;

-- Dumping structure for table pjj2020.tr_pelxsoal
DROP TABLE IF EXISTS `tr_pelxsoal`;
CREATE TABLE IF NOT EXISTS `tr_pelxsoal` (
  `guid_pelxsoal` char(12) NOT NULL,
  `guid_conf_subkelasxpel` char(12) NOT NULL,
  `nama_soal` varchar(20) DEFAULT NULL,
  `keterangan` varchar(300) DEFAULT NULL,
  `type_soal` enum('Tugas','Ujian PKD','Ujian PAS') DEFAULT NULL,
  `ideleted` tinyint(1) DEFAULT 0,
  `status` enum('Active','Non Active') DEFAULT 'Non Active',
  `tgl_posting` datetime DEFAULT NULL,
  `waktu_pengerjaan` double DEFAULT 0,
  PRIMARY KEY (`guid_pelxsoal`) USING BTREE,
  KEY `guid_conf_subkelasxpel_ideleted_status` (`guid_conf_subkelasxpel`,`ideleted`,`status`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Dumping data for table pjj2020.tr_pelxsoal: ~0 rows (approximately)
/*!40000 ALTER TABLE `tr_pelxsoal` DISABLE KEYS */;
/*!40000 ALTER TABLE `tr_pelxsoal` ENABLE KEYS */;

-- Dumping structure for table pjj2020.tr_pelxsoal_siswa
DROP TABLE IF EXISTS `tr_pelxsoal_siswa`;
CREATE TABLE IF NOT EXISTS `tr_pelxsoal_siswa` (
  `guid_pelxsoal_siswa` char(12) NOT NULL,
  `guid_pelxsoal` char(12) NOT NULL,
  `kode_siswa` char(15) NOT NULL,
  `score_awal` double DEFAULT 0,
  `total_soal` double DEFAULT 0,
  `score_final` double DEFAULT 0,
  `ideleted` tinyint(1) DEFAULT 0,
  `isubmit` tinyint(1) DEFAULT 0 COMMENT '1 ->Udah Submit Bisa Preview 0 -> Bisa dikerjakan lagi',
  `date_start` datetime DEFAULT NULL,
  `date_end` datetime DEFAULT NULL,
  PRIMARY KEY (`guid_pelxsoal_siswa`),
  KEY `guid_pelxsoal_kode_siswa_ideleted` (`guid_pelxsoal`,`kode_siswa`,`ideleted`,`isubmit`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Dumping data for table pjj2020.tr_pelxsoal_siswa: ~0 rows (approximately)
/*!40000 ALTER TABLE `tr_pelxsoal_siswa` DISABLE KEYS */;
/*!40000 ALTER TABLE `tr_pelxsoal_siswa` ENABLE KEYS */;

-- Dumping structure for table pjj2020.tr_pelxsoal_siswa_jawaban
DROP TABLE IF EXISTS `tr_pelxsoal_siswa_jawaban`;
CREATE TABLE IF NOT EXISTS `tr_pelxsoal_siswa_jawaban` (
  `guid_pelxsoal_siswa_jawaban` char(12) NOT NULL,
  `guid_pelxsoal_siswa` char(12) NOT NULL,
  `guid_soal` char(12) NOT NULL,
  `guid_soalpilihan` char(12) DEFAULT NULL,
  `score` double DEFAULT NULL,
  PRIMARY KEY (`guid_pelxsoal_siswa_jawaban`),
  KEY `KEY` (`guid_pelxsoal_siswa`,`guid_soal`,`guid_soalpilihan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Dumping data for table pjj2020.tr_pelxsoal_siswa_jawaban: ~0 rows (approximately)
/*!40000 ALTER TABLE `tr_pelxsoal_siswa_jawaban` DISABLE KEYS */;
/*!40000 ALTER TABLE `tr_pelxsoal_siswa_jawaban` ENABLE KEYS */;

-- Dumping structure for table pjj2020.tr_soal
DROP TABLE IF EXISTS `tr_soal`;
CREATE TABLE IF NOT EXISTS `tr_soal` (
  `guid_soal` char(12) NOT NULL,
  `guid_pelxsoal` char(12) NOT NULL,
  `pertanyaan` text DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `tipe_jawaban` tinyint(4) DEFAULT 0 COMMENT '0 Single 1 Multiple',
  `ideleted` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`guid_soal`),
  KEY `guid_pelxsoal_ideleted` (`guid_pelxsoal`,`ideleted`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Dumping data for table pjj2020.tr_soal: ~0 rows (approximately)
/*!40000 ALTER TABLE `tr_soal` DISABLE KEYS */;
/*!40000 ALTER TABLE `tr_soal` ENABLE KEYS */;

-- Dumping structure for table pjj2020.tr_soalpilihan
DROP TABLE IF EXISTS `tr_soalpilihan`;
CREATE TABLE IF NOT EXISTS `tr_soalpilihan` (
  `guid_soalpilihan` char(12) NOT NULL,
  `guid_soal` char(12) NOT NULL,
  `option` text DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `score` double DEFAULT 0,
  `ideleted` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`guid_soalpilihan`) USING BTREE,
  KEY `guid_pelxsoal_ideleted` (`guid_soal`,`ideleted`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Dumping data for table pjj2020.tr_soalpilihan: ~0 rows (approximately)
/*!40000 ALTER TABLE `tr_soalpilihan` DISABLE KEYS */;
/*!40000 ALTER TABLE `tr_soalpilihan` ENABLE KEYS */;

-- Dumping structure for table pjj2020.tr_soalrandsiswa
DROP TABLE IF EXISTS `tr_soalrandsiswa`;
CREATE TABLE IF NOT EXISTS `tr_soalrandsiswa` (
  `guid_soalrandsiswa` int(11) NOT NULL AUTO_INCREMENT,
  `guid_pelxsoal_siswa` char(12) DEFAULT NULL,
  `guid_pelxsoal` char(12) NOT NULL,
  `guid_soal` char(12) NOT NULL,
  PRIMARY KEY (`guid_soalrandsiswa`) USING BTREE,
  KEY `SISWAPERKELAS` (`guid_pelxsoal_siswa`,`guid_pelxsoal`,`guid_soal`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Dumping data for table pjj2020.tr_soalrandsiswa: ~0 rows (approximately)
/*!40000 ALTER TABLE `tr_soalrandsiswa` DISABLE KEYS */;
/*!40000 ALTER TABLE `tr_soalrandsiswa` ENABLE KEYS */;

-- Dumping structure for table pjj2020.tr_tagihan
DROP TABLE IF EXISTS `tr_tagihan`;
CREATE TABLE IF NOT EXISTS `tr_tagihan` (
  `guid_tagihan` char(12) NOT NULL,
  `kode_tagihan` char(15) DEFAULT NULL,
  `kode_siswa` char(15) DEFAULT NULL,
  `kode_produk` char(15) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `bulan` double DEFAULT NULL,
  `tahun` year(4) DEFAULT NULL,
  `total_biaya` double DEFAULT NULL,
  `status_tg` enum('Belum Lunas','Lunas') DEFAULT 'Belum Lunas',
  `tgl_create` datetime DEFAULT NULL,
  `ideleted` tinyint(1) DEFAULT 0,
  `guid_invoice` char(12) DEFAULT NULL COMMENT 'If status lunas update disini',
  PRIMARY KEY (`guid_tagihan`),
  KEY `KEYJOINDASAR` (`kode_tagihan`,`kode_siswa`,`kode_produk`),
  KEY `KEYSEARCH` (`bulan`,`tahun`,`status_tg`,`ideleted`),
  KEY `KEYINVOICE` (`guid_invoice`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Dumping data for table pjj2020.tr_tagihan: ~7 rows (approximately)
/*!40000 ALTER TABLE `tr_tagihan` DISABLE KEYS */;
INSERT INTO `tr_tagihan` (`guid_tagihan`, `kode_tagihan`, `kode_siswa`, `kode_produk`, `keterangan`, `bulan`, `tahun`, `total_biaya`, `status_tg`, `tgl_create`, `ideleted`, `guid_invoice`) VALUES
	('1727F1707337', 'TG/EXK201209337', 'SW-201205CC7816', 'EXK201113785439', 'Tagihan', 12, '2020', 40500, 'Lunas', '2020-12-09 09:23:37', 0, 'C1E5218CE518'),
	('2BA7F9DCC541', 'TG/SPP201209541', 'SW-2012050DD816', 'SPP201113D97418', 'PEMBAYARAN BUKU DES 2020', 12, '2020', 84000, 'Belum Lunas', '2020-12-09 09:25:41', 0, NULL),
	('5CEE27AB8511', 'TG/KYW201209511', 'SW-201205135816', 'KYW201113695429', 'KARYA WISATA\r\n', 12, '2020', 80250, 'Belum Lunas', '2020-12-09 09:25:11', 0, NULL),
	('78726F304848', 'TG/BSS201209848', 'SW-201205821816', 'BSS201113786439', 'Tagihan Seragam', 12, '2020', 95000, 'Belum Lunas', '2020-12-09 09:18:48', 0, NULL),
	('95740E763611', 'TG/BPL201209611', 'SW-2012054DE816', 'BPL201113696429', 'Pembelian Modul', 12, '2020', 85000, 'Belum Lunas', '2020-12-09 09:26:11', 0, NULL),
	('95F305B08407', 'TG/BPL201209407', 'SW-2012056D5816', 'BPL201113696429', 'Buku LKS', 12, '2020', 90000, 'Belum Lunas', '2020-12-09 09:24:07', 0, NULL),
	('C0BD8FAC5439', 'TG/SPP201209439', 'SW-2012056D5816', 'SPP201113D97418', 'BIAYA SPP', 12, '2020', 90300, 'Belum Lunas', '2020-12-09 09:24:39', 0, NULL);
/*!40000 ALTER TABLE `tr_tagihan` ENABLE KEYS */;

-- Dumping structure for procedure pjj2020.update_end_time
DROP PROCEDURE IF EXISTS `update_end_time`;
DELIMITER //
CREATE PROCEDURE `update_end_time`(
	IN `p_totalsoal` DOUBLE,
	IN `p_guid_pelxsoal` CHAR(12),
	IN `p_guid_pelxsoal_siswa` CHAR(12),
	IN `p_kode_siswa` CHAR(15),
	IN `p_timer` DOUBLE
)
BEGIN
IF p_timer = 0 THEN
UPDATE tr_pelxsoal_siswa SET date_end=date_start, total_soal = p_totalsoal  WHERE 
guid_pelxsoal = p_guid_pelxsoal AND 
guid_pelxsoal_siswa = p_guid_pelxsoal_siswa AND 
kode_siswa = p_kode_siswa;
ELSE 
UPDATE tr_pelxsoal_siswa SET date_end=(date_start + INTERVAL p_timer+5 MINUTE) , total_soal = p_totalsoal  WHERE 
guid_pelxsoal = p_guid_pelxsoal AND 
guid_pelxsoal_siswa = p_guid_pelxsoal_siswa AND 
kode_siswa = p_kode_siswa;
END IF;
END//
DELIMITER ;

-- Dumping structure for procedure pjj2020.update_score_jawaban
DROP PROCEDURE IF EXISTS `update_score_jawaban`;
DELIMITER //
CREATE PROCEDURE `update_score_jawaban`(
	IN `P_GUID_PELXSOAL` CHAR(12),
	IN `P_GUID_PELXSOAL_SISWA` CHAR(12),
	IN `P_KODE_SISWA` CHAR(15)
)
BEGIN
UPDATE tr_pelxsoal_siswa_jawaban psj
SET psj.score = (SELECT ts.score 
						FROM tr_soalpilihan ts 
						WHERE ts.guid_soalpilihan = psj.guid_soalpilihan AND 
						ts.guid_soal =psj.guid_soal) 
WHERE psj.guid_pelxsoal_siswa= P_GUID_PELXSOAL_SISWA;

SELECT SUM(score) INTO @SCOREAWAL FROM tr_pelxsoal_siswa_jawaban WHERE guid_pelxsoal_siswa = P_GUID_PELXSOAL_SISWA;

SELECT total_soal INTO @TOTALSOAL FROM tr_pelxsoal_siswa WHERE 
guid_pelxsoal = P_GUID_PELXSOAL AND 
guid_pelxsoal_siswa = P_GUID_PELXSOAL_SISWA AND 
kode_siswa = P_KODE_SISWA;

UPDATE tr_pelxsoal_siswa SET isubmit=1, score_awal = @SCOREAWAL , score_final = (@SCOREAWAL/@TOTALSOAL)*100 WHERE 
guid_pelxsoal = P_GUID_PELXSOAL AND 
guid_pelxsoal_siswa = P_GUID_PELXSOAL_SISWA AND 
kode_siswa = P_KODE_SISWA;

END//
DELIMITER ;

-- Dumping structure for trigger pjj2020.rp_upload_after_delete
DROP TRIGGER IF EXISTS `rp_upload_after_delete`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `rp_upload_after_delete` AFTER DELETE ON `rp_upload` FOR EACH ROW BEGIN
DELETE FROM rp_raport WHERE rp_raport.guid_upload = OLD.guid_upload;
DELETE FROM rp_raportdetail WHERE rp_raportdetail.guid_upload = OLD.guid_upload; 
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
