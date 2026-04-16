-- --------------------------------------------------------
-- Database: `21_dwiaditya1`
-- Dibuat oleh: Dwi Aditya
-- --------------------------------------------------------

CREATE DATABASE IF NOT EXISTS `21_dwiaditya1` CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `21_dwiaditya1`;

-- --------------------------------------------------------
-- Table: `admin`
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `admin` (`username`, `password`) VALUES
('admin', 'Dlanggu');

-- --------------------------------------------------------
-- Table: `kegiatan`
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `kegiatan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `tanggal` date NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `kegiatan` (`judul`, `deskripsi`, `tanggal`, `gambar`) VALUES
('Pelantikan OSIS SMKN 1 Dlanggu 2024/2025', 'Kegiatan pelantikan pengurus OSIS baru SMKN 1 Dlanggu untuk periode 2024/2025 berlangsung dengan khidmat di aula sekolah. Acara dihadiri oleh seluruh dewan guru dan siswa perwakilan kelas.', '2025-03-15', NULL),
('Peringatan Hari Kartini', 'SMKN 1 Dlanggu memperingati Hari Kartini dengan berbagai kegiatan seni budaya. Seluruh siswa dan guru mengenakan pakaian adat nusantara dan menampilkan berbagai pertunjukan seni.', '2025-04-21', NULL),
('Lomba Kompetensi Siswa (LKS) Tingkat Kabupaten', 'Siswa-siswi SMKN 1 Dlanggu berhasil meraih prestasi gemilang dalam ajang Lomba Kompetensi Siswa tingkat kabupaten. Berbagai bidang keahlian diikutsertakan dalam kompetisi bergengsi ini.', '2025-02-10', NULL),
('Workshop Digital Marketing untuk Siswa SMK', 'Kegiatan workshop digital marketing diselenggarakan untuk meningkatkan kompetensi siswa di bidang pemasaran digital. Narasumber dari praktisi industri memberikan materi yang sangat bermanfaat.', '2025-01-20', NULL),
('Kunjungan Industri Jurusan TKJ ke Surabaya', 'Siswa jurusan Teknik Komputer dan Jaringan SMKN 1 Dlanggu melaksanakan kunjungan industri ke berbagai perusahaan IT di Surabaya. Kegiatan ini bertujuan untuk menambah wawasan dunia kerja.', '2024-12-05', NULL),
('Penerimaan Peserta Didik Baru (PPDB) 2025/2026', 'SMKN 1 Dlanggu membuka pendaftaran Penerimaan Peserta Didik Baru untuk tahun ajaran 2025/2026. Tersedia berbagai jurusan unggulan yang siap mencetak lulusan berkompeten dan siap kerja.', '2025-05-01', NULL);
