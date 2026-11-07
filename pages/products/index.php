<?php
require_once __DIR__ . "/../../config/database.php";
// === TAHAP 1 - CRUD ===
// TODO 1 : session_start();   (TAHAP 3: ganti dengan require middleware + requireAuth())
// TODO 2 : require_once repositories/category-repository.php
// TODO 3 : $categories = getCategories();
// TODO 4 : ambil $_SESSION['errors'] lalu unset()  (untuk pesan gagal hapus)
// === TAHAP 3 - OTORISASI (terakhir) ===
// TODO 5 : $isAdmin = hasRole(['admin']);

$categories = [];
$isAdmin = true;
$errors = [];

$pageTitle = "Manajemen Produk";
$pageSubtitle = "Kelola data produk";
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Produk - Sistem Koperasi Sekolah</title>
  <link rel="stylesheet" href="../../styles/categories/index.css">
</head>

<body>
  <div class="layout">
    <?php require_once __DIR__ . "/../../components/admin/sidebar.php" ?>

    <main class="main">
      <?php require_once __DIR__ . "/../../components/admin/topbar.php" ?>

      <div class="content">
        <!-- TODO 6: jika $errors['delete'] ada -> <div class="alert alert-error"> -->

        <!-- TODO 7 (TAHAP 3): tombol Tambah hanya untuk admin (if $isAdmin) -->
        <div class="toolbar">
          <a href="create.php" class="btn btn-primary">+ Tambah produk</a>
        </div>

        <div class="card">
          <table>
            <thead>
              <tr>
                <th>Nama</th>
                <th>Deskripsi</th>
                <!-- TODO 8 (TAHAP 3): kolom Aksi hanya untuk admin -->
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <!--
                TODO 9: foreach ($categories as $category) -> satu <tr> per produk:
                  <td> nama, <td> deskripsi
                  <td class="actions"> (TAHAP 3: hanya admin):
                     - link Edit  -> edit.php?id=...
                     - link Hapus -> ../../actions/categories/destroy.php?id=...
                       dengan onclick="return confirm('Yakin ingin menghapus?')"
              -->

              <!-- TODO 10: jika $categories kosong -> baris "Belum ada produk" (colspan="3") -->
            </tbody>
          </table>
        </div>
      </div>
    </main>
  </div>
</body>

</html>
