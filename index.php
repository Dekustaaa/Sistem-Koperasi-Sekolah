<?php
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
    <p>SKS membantu mencatat kategori dan koleksi Koperasi sekolah secara sederhana.</p>
    <div class="hero-cta">
      <a href="pages/auth/login.php" class="btn btn-primary">Masuk ke Akun</a>
      <a href="pages/products/index.php" class="btn btn-outline">Lihat Prodcucts</a>
      <a href="pages/products/index.php" class="btn btn-outline">Lihat Suppliers</a>
    </div>
  </section>

  <section class="features">
    <div class="feature-card">
      <h3>Manajemen Produk</h3>
      <p>Admin dapat menambah, mengubah, dan menghapus kategori.</p>
    </div>
    <div class="feature-card">
      <h3>Manajemen Suppliers</h3>
      <p>Setiap suplier dikelompokkan ke dalam satu tempat.</p>
    </div>
    <div class="feature-card">
      <h3>Hak Akses</h3>
      <p>Admin mengelola data, member hanya dapat melihat.</p>
    </div>
  </section>

  <?php require_once __DIR__ . "/components/landing/footer.php" ?>
</body>

</html>
