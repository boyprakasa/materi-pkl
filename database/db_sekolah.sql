-- =========================================================
-- Database untuk aplikasi belajar CRUD PHP Native + Bootstrap
-- Import file ini lewat phpMyAdmin atau: mysql -u root -p < db_sekolah.sql
-- =========================================================

CREATE DATABASE IF NOT EXISTS db_sekolah CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE db_sekolah;

-- ---------------------------------------------------------
-- Tabel guru
-- ---------------------------------------------------------
CREATE TABLE IF NOT EXISTS guru (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nip VARCHAR(30) NOT NULL,
    nama_guru VARCHAR(100) NOT NULL,
    jenis_kelamin ENUM('Laki-laki', 'Perempuan') NOT NULL,
    alamat TEXT,
    no_hp VARCHAR(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ---------------------------------------------------------
-- Tabel kelas (wali_kelas_id merujuk ke guru.id)
-- ---------------------------------------------------------
CREATE TABLE IF NOT EXISTS kelas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_kelas VARCHAR(50) NOT NULL,
    tingkat VARCHAR(10) NOT NULL,
    wali_kelas_id INT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (wali_kelas_id) REFERENCES guru(id) ON DELETE SET NULL
);

-- ---------------------------------------------------------
-- Tabel siswa (kelas_id merujuk ke kelas.id)
-- ---------------------------------------------------------
CREATE TABLE IF NOT EXISTS siswa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nis VARCHAR(30) NOT NULL,
    nama_siswa VARCHAR(100) NOT NULL,
    jenis_kelamin ENUM('Laki-laki', 'Perempuan') NOT NULL,
    tanggal_lahir DATE,
    alamat TEXT,
    kelas_id INT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (kelas_id) REFERENCES kelas(id) ON DELETE SET NULL
);

-- ---------------------------------------------------------
-- Data contoh (opsional, boleh dihapus)
-- ---------------------------------------------------------
INSERT INTO guru (nip, nama_guru, jenis_kelamin, alamat, no_hp) VALUES
('198001012010011001', 'Budi Santoso, S.Pd', 'Laki-laki', 'Jl. Merdeka No. 1, Surabaya', '081234567890'),
('198203152011012002', 'Siti Aminah, S.Pd', 'Perempuan', 'Jl. Anggrek No. 5, Surabaya', '081298765432');

INSERT INTO kelas (nama_kelas, tingkat, wali_kelas_id) VALUES
('VII-A', '7', 1),
('VIII-A', '8', 2);

INSERT INTO siswa (nis, nama_siswa, jenis_kelamin, tanggal_lahir, alamat, kelas_id) VALUES
('2024001', 'Ahmad Fauzi', 'Laki-laki', '2011-05-12', 'Jl. Kenanga No. 3, Surabaya', 1),
('2024002', 'Dewi Lestari', 'Perempuan', '2011-08-20', 'Jl. Melati No. 7, Surabaya', 1);
