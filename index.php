<?php
require_once __DIR__ . "/config/auth.php";
$user  = authUser();
$title = "Beranda - Sistem Koperasi Sekolah";
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title ?></title>
  <link rel="stylesheet" href="styles/index.css">
</head>

<body>
  <?php require_once __DIR__ . "/components/landing/header.php" ?>

  <section class="hero">
    <h1>Kelola Sistem Koperasi Sekolah Lebih Rapi</h1>
    <p>SKS membantu mencatat produk, supplier, dan pegawai koperasi sekolah secara sederhana.</p>
    <div class="hero-cta">
      <?php if ($user): ?>
        <a href="/pages/products/index.php" class="btn btn-primary">Masuk Dashboard</a>
      <?php else: ?>
        <a href="/pages/auth/login.php" class="btn btn-primary">Masuk ke Akun</a>
        <a href="/pages/auth/register.php" class="btn btn-outline">Daftar</a>
      <?php endif; ?>
    </div>
  </section>

  <section class="features">
    <div class="feature-card">
      <h3>Manajemen Produk</h3>
      <p>Admin dapat menambah, mengubah, dan menghapus produk koperasi.</p>
    </div>
    <div class="feature-card">
      <h3>Manajemen Supplier</h3>
      <p>Setiap supplier dikelompokkan berdasarkan jenis produk yang dipasok.</p>
    </div>
    <div class="feature-card">
      <h3>Manajemen Pegawai</h3>
      <p>Data pegawai, jabatan, dan gaji tersimpan rapi dalam satu tempat.</p>
    </div>
  </section>

  <?php require_once __DIR__ . "/components/landing/footer.php" ?>
</body>

</html>
