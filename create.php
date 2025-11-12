<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama   = $_POST['nama'] ?? '';
    $alat   = $_POST['alat'] ?? '';
    $kontak = $_POST['kontak'] ?? '';

    $stmt = $pdo->prepare("INSERT INTO penyewa (nama, alat, kontak, created_at) VALUES (?, ?, ?, NOW())");
    $stmt->execute([$nama, $alat, $kontak]);
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Penyewa - Aplikasi Penyewaan Alat Komunikasi</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <header class="header">
    <div class="logo-area">
      <div class="logo-icon">📡</div>
      <h1 class="logo-text">Aplikasi Penyewaan Alat Komunikasi</h1>
    </div>
  </header>

  <main class="container fade-in">
    <div class="card">
      <h2 class="card-title">➕ Tambah Penyewa Baru</h2>
      <form method="post" class="form" autocomplete="off">
        <!-- Nama Penyewa -->
        <label>Nama Penyewa</label>
        <input type="text" name="nama" placeholder="Masukkan nama penyewa" required>

        <!-- Alat yang Disewa -->
        <label>Alat yang Disewa</label>
        <select name="alat" required>
          <option value="" disabled selected>Pilih alat</option>
          <option>Hp iPhone 11 Pro Max</option>
          <option>Hp iPhone 11</option>
          <option>Hp iPhone 12 Pro Max</option>
          <option>Hp iPhone 12</option>
          <option>Hp iPhone 13 Pro Max</option>
          <option>Hp iPhone 13</option>
          <option>Camera Nikon</option>
          <option>Camera Nikon 60D</option>
          <option>Camera Canon EOS 1500D</option>
          <option>Camera Canon EOS 60D</option>
          <option>Camera Canon EOS R8</option>
          <option>HT Icom Ic-v80</option>
          <option>HT XiR P3688</option>
          <option>HT XiR C2660</option>
          <option>HT UV-5R</option>
        </select>

        <!-- Kontak -->
        <label>Kontak</label>
        <input type="text" name="kontak" placeholder="Nomor telepon atau email" required>

        <!-- Tombol aksi -->
        <div class="form-actions">
          <a href="index.php" class="btn btn-secondary">⬅ Kembali</a>
          <button type="submit" class="btn btn-primary">💾 Simpan</button>
        </div>
      </form>
    </div>
  </main>

  <footer class="footer">
    © <?= date('Y'); ?> Aplikasi Penyewaan Alat Komunikasi
  </footer>

</body>
</html>
