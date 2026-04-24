CREATE TABLE admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE,
    password VARCHAR(255),
    nama_lengkap VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
-- Password default: admin123
INSERT INTO admin (username, password, nama_lengkap) VALUES ('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Admin Masjid');

CREATE TABLE setting_website (
    id INT PRIMARY KEY DEFAULT 1,
    banner_judul VARCHAR(200),
    banner_subjudul TEXT,
    banner_foto VARCHAR(255),
    tombol_donasi_teks VARCHAR(50),
    tombol_program_teks VARCHAR(50),
    alamat TEXT,
    email VARCHAR(100),
    no_telp VARCHAR(20),
    rekening_bank TEXT,
    qris_img VARCHAR(255)
);
INSERT INTO setting_website (id) VALUES (1);

CREATE TABLE metode_donasi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_metode VARCHAR(100),
    no_rek_akun VARCHAR(100),
    atas_nama VARCHAR(100),
    logo VARCHAR(255)
);