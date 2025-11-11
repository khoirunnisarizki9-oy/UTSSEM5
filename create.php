<?php
require 'config.php';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama'] ?? '');
    $alat = trim($_POST['alat'] ?? '');
    $tanggal_sewa = $_POST['tanggal_sewa'] ?? '';
    $tanggal_kembali = $_POST['tanggal_kembali'] ?: null;
    $kontak = trim($_POST['kontak'] ?? '');
    $keterangan = trim($_POST['keterangan'] ?? '');

    if ($nama === '') $errors[] = 'Nama wajib diisi.';
    if ($alat === '') $errors[] = 'Jenis alat wajib diisi.';
    if ($tanggal_sewa === '') $errors[] = 'Tanggal sewa wajib diisi.';

    if (empty($errors)) {
        $stmt = $pdo->prepare('INSERT INTO penyewa (nama, alat, tanggal_sewa, tanggal_kembali, kontak, keterangan) VALUES (:nama,:alat,:ts,:tk,:kontak,:ket)');
        $stmt->execute([
            ':nama' => $nama,
            ':alat' => $alat,
            ':ts' => $tanggal_sewa,
            ':tk' => $tanggal_kembali,
            ':kontak' => $kontak,
            ':ket' => $keterangan,
        ]);
        header('Location: index.php');
        exit;
    }
}
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tambah Penyewa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
<div class="container">
  <h1 class="h4 mb-3">Tambah Penyewa Alat</h1>

  <?php if ($errors): ?>
    <div class="alert alert-danger">
      <ul class="mb-0">
        <?php foreach ($errors as $e): ?>
          <li><?= htmlspecialchars($e) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  <?php endif; ?>

  <form method="post">
    <div class="mb-3">
      <label class="form-label">Nama</label>
      <input name="nama" class="form-control" value="<?= htmlspecialchars($_POST['nama'] ?? '') ?>">
    </div>
    <div class="mb-3">
      <label class="form-label">Alat</label>
      <input name="alat" class="form-control" value="<?= htmlspecialchars($_POST['alat'] ?? '') ?>">
    </div>
    <div class="row">
      <div class="col-md-6 mb-3">
        <label class="form-label">Tanggal Sewa</label>
        <input type="date" name="tanggal_sewa" class="form-control" value="<?= htmlspecialchars($_POST['tanggal_sewa'] ?? '') ?>">
      </div>
      <div class="col-md-6 mb-3">
        <label class="form-label">Tanggal Kembali (opsional)</label>
        <input type="date" name="tanggal_kembali" class="form-control" value="<?= htmlspecialchars($_POST['tanggal_kembali'] ?? '') ?>">
      </div>
    </div>
    <div class="mb-3">
      <label class="form-label">Kontak</label>
      <input name="kontak" class="form-control" value="<?= htmlspecialchars($_POST['kontak'] ?? '') ?>">
    </div>
    <div class="mb-3">
      <label class="form-label">Keterangan</label>
      <textarea name="keterangan" class="form-control"><?= htmlspecialchars($_POST['keterangan'] ?? '') ?></textarea>
    </div>
    <div>
      <a href="index.php" class="btn btn-secondary">Batal</a>
      <button class="btn btn-primary" type="submit">Simpan</button>
    </div>
  </form>
</div>
</body>
</html>
