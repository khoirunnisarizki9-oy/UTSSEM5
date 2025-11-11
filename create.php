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
        <label>Nama Penyewa</label>
        <input type="text" name="nama" placeholder="Masukkan nama penyewa" required>

        <label>Alat yang Disewa</label>
        <input type="text" name="alat" placeholder="Contoh: HT, Radio, Walkie Talkie" required>

        <label>Kontak</label>
        <input type="text" name="kontak" placeholder="Nomor telepon atau email" required>

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
