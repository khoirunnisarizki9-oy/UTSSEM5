<?php
require 'config.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: index.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM penyewa WHERE id = ?");
$stmt->execute([$id]);
$data = $stmt->fetch();

if (!$data) {
    echo "Data tidak ditemukan!";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama   = $_POST['nama'] ?? '';
    $alat   = $_POST['alat'] ?? '';
    $kontak = $_POST['kontak'] ?? '';

    $stmt = $pdo->prepare("UPDATE penyewa SET nama=?, alat=?, kontak=? WHERE id=?");
    $stmt->execute([$nama, $alat, $kontak, $id]);
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Penyewa - Aplikasi Penyewaan Alat Komunikasi</title>
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
      <h2 class="card-title">✏ Edit Data Penyewa</h2>
      <form method="post" class="form" autocomplete="off">
        <label>Nama Penyewa</label>
        <input type="text" name="nama" value="<?= htmlspecialchars($data['nama']) ?>" required>

        <label>Alat yang Disewa</label>
        <input type="text" name="alat" value="<?= htmlspecialchars($data['alat']) ?>" required>

        <label>Kontak</label>
        <input type="text" name="kontak" value="<?= htmlspecialchars($data['kontak']) ?>" required>

        <div class="form-actions">
          <a href="index.php" class="btn btn-secondary">⬅ Batal</a>
          <button type="submit" class="btn btn-primary">💾 Update</button>
        </div>
      </form>
    </div>
  </main>

  <footer class="footer">
    © <?= date('Y'); ?> Aplikasi Penyewaan Alat Komunikasi
  </footer>

</body>
</html>
