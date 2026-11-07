<?php
// === TAHAP 1 - CRUD ===
// TODO 1 : session_start();   (TAHAP 3: ganti dengan require middleware + requireRole(['admin']))
// TODO 2 : ambil $_SESSION['errors'] dan ['old'] lalu unset()

$errors = [];
$old = [];

$pageTitle = "Tambah produk";
$pageSubtitle = "Lengkapi data produk baru";
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah produk - Sistem Koperasi Sekolah</title>
  <link rel="stylesheet" href="../../styles/categories/create.css">
</head>

<body>
  <div class="layout">
    <?php require_once __DIR__ . "/../../components/admin/sidebar.php" ?>

    <main class="main">
      <?php require_once __DIR__ . "/../../components/admin/topbar.php" ?>

      <div class="content">
        <form method="POST" action="../../actions/categories/store.php" class="card">
          <div class="form-group">
            <label for="code">Kode Produk</label>
            <!-- TODO 3: value = $old['name'] -->
            <input type="text" id="product_code" name="code" value="">
            <!-- TODO: tampilkan $errors['name'] di <p class="error-text"> jika ada -->
          </div>
          <div class="form-group">
            <label for="name">Nama Produk</label>
            <!-- TODO 3: value = $old['name'] -->
            <input type="text" id="product_name" name="name" value="">
            <!-- TODO: tampilkan $errors['name'] di <p class="error-text"> jika ada -->
          </div>
          <div class="form-group">
                <label for="category">Produk</label>
                <select id="category" name="category">
                    <option value="Food">
                      <p>Food</p>
                    </option>
                    <option value="Drink">
                      <p>Drink</p>
                    </option>
                    <option value="Stationery">
                      <p>Stationery</p>
                    </option>
                    <option value="Uniform">
                      <p>Uniform</p>
                    </option>
                </select>
            </div>
            <div class="form-radio">
              <label >Unit</label>

              <div>
                <label for="Pcs">Pcs</label>
                <input type="radio" id="unit" name="unit" value="Pcs">
              </div>
              <div>
                <label for="Pack">Pack</label>
                <input type="radio" id="unit" name="unit" value="Pack">
              </div>
              <div>
                <label for="Bottle">Bottle</label>
                <input type="radio" id="unit" name="unit" value="Bottle">
              </div>

          </div>
          <div class="form-group">
            <label for="price">Harga</label>
            <input type="number" id="price" name="price" value="stock">
          </div>
          <div class="form-group">
            <label for="stock">Stok</label>
            <input type="number" id="stock" name="stock" value="stock">
          </div>
          <div class="form-group">
            <label for="description">Deskripsi</label>
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
