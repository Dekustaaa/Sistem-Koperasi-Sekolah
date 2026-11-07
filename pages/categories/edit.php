<?php
// === TAHAP 1 - CRUD ===
// TODO 1 : session_start();   (TAHAP 3: ganti dengan require middleware + requireRole(['admin']))
// TODO 2 : require_once repositories/category-repository.php
// TODO 3 : $category = getCategory($_GET['id'] ?? 0);
// TODO 4 : ambil $_SESSION['errors'] dan ['old'] lalu unset()
// TODO 5 : $data = $old ?: $category;   // input lama jika validasi gagal, jika tidak data dari DB

$category = ['id' => ''];
$errors = [];
$old = [];
$data = [];

$pageTitle = "Edit Kategori";
$pageSubtitle = "Perbarui data kategori";
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Kategori - BukuKita</title>
  <link rel="stylesheet" href="../../styles/products/edit.css">
</head>

<body>
  <div class="layout">
    <?php require_once __DIR__ . "/../../components/admin/sidebar.php" ?>

    <main class="main">
      <?php require_once __DIR__ . "/../../components/admin/topbar.php" ?>

      <div class="content">
        <form method="POST" action="../../actions/products/update.php" class="card">
          <!-- TODO 6: value = $category['id'] -->
          <input type="hidden" name="id" value="">

          <div class="form-group">
            <label for="name">Nama Kategori</label>
            <!-- TODO 7: value = $data['name'] -->
            <input type="text" id="name" name="name" value="">
            <!-- TODO: tampilkan $errors['name'] di <p class="error-text"> jika ada -->
          </div>
          <div class="form-group">
            <label for="description">Deskripsi (opsional)</label>
            <!-- TODO 8: isi textarea dengan $data['description'] -->
            <textarea id="description" name="description" rows="3"></textarea>
            <!-- TODO: tampilkan $errors['description'] di <p class="error-text"> jika ada -->
          </div>

          <div class="form-actions">
            <a href="index.php" class="btn btn-outline">Batal</a>
            <button type="submit" name="update" class="btn btn-primary">Simpan Perubahan</button>
          </div>
        </form>
      </div>
    </main>
  </div>
</body>

</html>
