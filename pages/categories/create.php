<?php
// === TAHAP 1 - CRUD ===
// TODO 1 : session_start();   (TAHAP 3: ganti dengan require middleware + requireRole(['admin']))
// TODO 2 : ambil $_SESSION['errors'] dan ['old'] lalu unset()

$errors = [];
$old = [];

$pageTitle = "Tambah Kategori";
$pageSubtitle = "Lengkapi data kategori baru";
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Kategori - BukuKita</title>
  <link rel="stylesheet" href="../../styles/products/create.css">
</head>

<body>
  <div class="layout">
    <?php require_once __DIR__ . "/../../components/admin/sidebar.php" ?>

    <main class="main">
      <?php require_once __DIR__ . "/../../components/admin/topbar.php" ?>

      <div class="content">
        <form method="POST" action="../../actions/products/store.php" class="card">
          <div class="form-group">
            <label for="name">Nama Kategori</label>
            <!-- TODO 3: value = $old['name'] -->
            <input type="text" id="name" name="name" value="">
            <!-- TODO: tampilkan $errors['name'] di <p class="error-text"> jika ada -->
          </div>
          <div class="form-group">
            <label for="description">Deskripsi (opsional)</label>
            <!-- TODO 4: isi textarea dengan $old['description'] -->
            <textarea id="description" name="description" rows="3"></textarea>
            <!-- TODO: tampilkan $errors['description'] di <p class="error-text"> jika ada -->
          </div>

          <div class="form-actions">
            <a href="index.php" class="btn btn-outline">Batal</a>
            <button type="submit" name="store" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
    </main>
  </div>
</body>

</html>
