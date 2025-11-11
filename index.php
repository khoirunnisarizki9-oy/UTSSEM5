<?php
require 'config.php';

$q = isset($_GET['q']) ? trim($_GET['q']) : '';
$params = [];
$sql = 'SELECT * FROM penyewa';
if ($q !== '') {
    $sql .= ' WHERE nama LIKE :q OR alat LIKE :q OR kontak LIKE :q';
    $params[':q'] = "%$q%";
}
$sql .= ' ORDER BY created_at DESC';
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Daftar Penyewa Alat</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>
<body class="p-4">
<div class="container">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3">Penyewa Alat</h1>
    <a href="create.php" class="btn btn-primary">+ Tambah Penyewa</a>
  </div>

  <form class="mb-3" method="get" action="">
    <div class="input-group">
      <input type="search" name="q" value="<?= htmlspecialchars($q) ?>" class="form-control" placeholder="Cari nama, alat, atau kontak...">
      <button class="btn btn-outline-secondary" type="submit">Cari</button>
    </div>
  </form>

  <?php if (count($rows) === 0): ?>
    <div class="alert alert-info">Belum ada data penyewa.</div>
  <?php else: ?>
    <div class="table-responsive">
      <table class="table table-striped table-bordered align-middle">
        <thead class="table-light">
          <tr>
            <th>#</th>
            <th>Nama</th>
            <th>Alat</th>
            <th>Tgl. Sewa</th>
            <th>Tgl. Kembali</th>
            <th>Kontak</th>
            <th>Keterangan</th>
            <th style="width:150px;">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($rows as $i => $r): ?>
          <tr>
            <td><?= $i + 1 ?></td>
            <td><?= htmlspecialchars($r['nama']) ?></td>
            <td><?= htmlspecialchars($r['alat']) ?></td>
            <td><?= htmlspecialchars($r['tanggal_sewa']) ?></td>
            <td><?= $r['tanggal_kembali'] ? htmlspecialchars($r['tanggal_kembali']) : '-' ?></td>
            <td><?= htmlspecialchars($r['kontak']) ?></td>
            <td><?= htmlspecialchars($r['keterangan']) ?></td>
            <td>
              <a href="edit.php?id=<?= $r['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
              <a href="delete.php?id=<?= $r['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?>
</div>
</body>
</html>
