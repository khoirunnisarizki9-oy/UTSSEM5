CREATE DATABASE IF NOT EXISTS db_penyewaalat;
USE db_penyewaalat;

CREATE TABLE penyewa (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100) NOT NULL,
  alat VARCHAR(100) NOT NULL,
  tanggal_sewa DATE NOT NULL,
  tanggal_kembali DATE DEFAULT NULL,
  kontak VARCHAR(50),
  keterangan TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
