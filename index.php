<?php
require 'config.php';

// Ambil parameter pencarian
$q = isset($_GET['q']) ? trim($_GET['q']) : '';
$params = [];

// Query utama
$sql = 'SELECT * FROM penyewa';
if ($q !== '') {
    $sql .= ' WHERE nama LIKE :q OR alat LIKE :q OR kontak LIKE :q';
    $params[':q'] = "%$q%";
}
$sql .= ' ORDER BY created_at DESC';

// Eksekusi query
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$penyewa = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Beranda - Aplikasi Penyewaan Alat Komunikasi</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <!-- Header -->
  <header class="header">
    <div class="logo-area">
      <div class="logo-icon">📡</div>
      <h1 class="logo-text">Aplikasi Penyewaan Alat Komunikasi</h1>
    </div>
  </header>

  <!-- Konten Utama -->
  <main class="container fade-in">
    <div class="table-container">

      <!-- 🔍 Pencarian dan ➕ Tambah Penyewa -->
      <div class="action-bar">
        <form method="get" class="search-box">
          <input
            type="text"
            name="q"
            value="<?= htmlspecialchars($q) ?>"
            placeholder="🔍 Cari nama, alat, atau kontak..."
          >
        </form>
        <a href="create.php" class="btn-tambah">
          <span class="icon">➕</span> Tambah Penyewa
        </a>
      </div>

      <!-- Tabel Data -->
      <table>
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Penyewa</th>
            <th>Alat yang Disewa</th>
            <th>Kontak</th>
            <th>Tanggal</th>
            <th style="text-align:center;">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php if ($penyewa): ?>
            <?php foreach ($penyewa as $i => $p): ?>
              <tr>
                <td><?= $i + 1 ?></td>
                <td><?= htmlspecialchars($p['nama']) ?></td>
                <td><?= htmlspecialchars($p['alat']) ?></td>
                <td><?= htmlspecialchars($p['kontak']) ?></td>
                <td><?= htmlspecialchars($p['created_at']) ?></td>
                <td>
                  <div class="aksi-container">
                    <a href="edit.php?id=<?= $p['id'] ?>" class="btn-aksi edit">✏ Edit</a>
                    <a
                      href="delete.php?id=<?= $p['id'] ?>"
                      class="btn-aksi delete"
                      onclick="return confirm('Yakin ingin menghapus data ini?')"
                    >🗑 Hapus</a>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="6" style="text-align:center; color:#6b7280;">
                Tidak ada data penyewa ditemukan.
              </td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </main>

  <!-- Footer -->
  <footer class="footer">
    © <?= date('Y'); ?> Aplikasi Penyewaan Alat Komunikasi
  </footer>

</body>
</html>
