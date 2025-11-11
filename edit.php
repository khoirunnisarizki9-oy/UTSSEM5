<?php
require 'config.php';

// Ambil ID dari URL
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    header('Location: index.php');
    exit;
}

// Ambil data penyewa berdasarkan ID
$stmt = $pdo->prepare('SELECT * FROM penyewa WHERE id = :id');
$stmt->execute([':id' => $id]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$data) {
    die('Data tidak ditemukan.');
}

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
        $stmt = $pdo->prepare('UPDATE penyewa 
            SET nama = :nama, alat = :alat, tanggal_sewa = :ts, tanggal_kembali = :tk, 
                kontak = :kontak, keterangan = :ket 
            WHERE id = :id');
        $stmt->execute([
            ':nama' => $nama,
            ':alat' => $alat,
            ':ts' => $tanggal_sewa,
            ':tk' => $tanggal_kembali,
            ':kontak' => $kontak,
            ':ket' => $keterangan,
            ':id' => $id,
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
  <title>Edit Penyewa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
<div class="container">
  <h1 class="h4 mb-3">Edit Penyewa</h1>

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
      <input name="nama" class="form-control" value="<?= htmlspecialchars($_POST['nama'] ?? $data['nama']) ?>">
    </div>

    <div class="mb-3">
      <label class="form-label">Alat</label>
      <input name="alat" class="form-control" value="<?= htmlspecialchars($_POST['alat'] ?? $data['alat']) ?>">
    </div>

    <div class="row">
      <div class="col-md-6 mb-3">
        <label class="form-label">Tanggal Sewa</label>
        <input type="date" name="tanggal_sewa" class="form-control" value="<?= htmlspecialchars($_POST['tanggal_sewa'] ?? $data['tanggal_sewa']) ?>">
      </div>
      <div class="col-md-6 mb-3">
        <label class="form-label">Tanggal Kembali</label>
        <input type="date" name="tanggal_kembali" class="form-control" value="<?= htmlspecialchars($_POST['tanggal_kembali'] ?? $data['tanggal_kembali']) ?>">
      </div>
    </div>

    <div class="mb-3">
      <label class="form-label">Kontak</label>
      <input name="kontak" class="form-control" value="<?= htmlspecialchars($_POST['kontak'] ?? $data['kontak']) ?>">
    </div>

    <div class="mb-3">
      <label class="form-label">Keterangan</label>
      <textarea name="keterangan" class="form-control"><?= htmlspecialchars($_POST['keterangan'] ?? $data['keterangan']) ?></textarea>
    </div>

    <div>
      <a href="index.php" class="btn btn-secondary">Batal</a>
      <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
    </div>
  </form>
</div>
</body>
</html>
