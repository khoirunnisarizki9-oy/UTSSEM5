<?php
// home.php
// Halaman sambutan untuk aplikasi Penyewaan Alat Komunikasi
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda - Penyewaan Alat Komunikasi</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand fw-bold" href="home.php">Penyewaan Alat Komunikasi</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="home.php">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php">Data Alat</a></li>
                    <li class="nav-item"><a class="nav-link" href="create.php">Tambah Data</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Konten utama -->
    <div class="container text-center py-5">
        <h1 class="display-5 fw-bold text-primary">Selamat Datang di Sistem Penyewaan Alat Komunikasi</h1>
        <p class="lead mt-3">
            Aplikasi ini digunakan untuk mengelola data alat komunikasi, mulai dari menambah, mengedit,
            hingga menghapus data alat yang tersedia untuk disewa.
        </p>
        <img src="https://cdn-icons-png.flaticon.com/512/3068/3068413.png" alt="Icon alat komunikasi" width="150" class="my-4">
        <div>
            <a href="index.php" class="btn btn-success btn-lg me-2">Lihat Data Alat</a>
            <a href="create.php" class="btn btn-outline-primary btn-lg">Tambah Data Baru</a>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-light text-center py-3 mt-5 border-top">
        <small>&copy; <?= date('Y') ?> Aplikasi Penyewaan Alat Komunikasi</small>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
