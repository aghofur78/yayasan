CREATE DATABASE db_masjid;
USE db_masjid;

CREATE TABLE pengurus (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100),
    jabatan VARCHAR(100),
    foto VARCHAR(255)
);

CREATE TABLE program (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(200),
    deskripsi TEXT,
    kategori ENUM('Dakwah','Pendidikan','Sosial','Pembangunan'),
    thumbnail VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE berita (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(200),
    konten TEXT,
    thumbnail VARCHAR(255),
    penulis VARCHAR(100),
    tanggal_publish DATE
);

CREATE TABLE galeri (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(200),
    file_foto VARCHAR(255),
    kategori VARCHAR(100)
);

CREATE TABLE donasi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_donatur VARCHAR(100),
    jumlah INT,
    jenis ENUM('Zakat','Infaq','Sedekah','Wakaf','Pembangunan'),
    bukti_tf VARCHAR(255),
    status ENUM('Pending','Terkonfirmasi') DEFAULT 'Pending',
    tanggal TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE relawan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100),
    no_wa VARCHAR(20),
    alamat TEXT,
    bidang_minat VARCHAR(100),
    status ENUM('Pending','Aktif') DEFAULT 'Pending'
);

CREATE TABLE pesan_kontak (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100),
    email VARCHAR(100),
    pesan TEXT,
    tanggal TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);