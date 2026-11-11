<?php
require_once __DIR__ . "/../../config/auth.php";
requireAdmin();
require_once __DIR__ . "/../../validations/product-validation.php";

$id      = intval($_GET['id'] ?? 0);
$product = getProduct($id);

if (!$product) {
  $_SESSION['errors'] = ['delete' => 'Data produk tidak ditemukan.'];
  header('Location: /pages/products/index.php');
  exit;
}

$flash  = pullFlash();
$errors = $flash['errors'];
$old    = $flash['old'];
$data   = $old ?: $product;

$pageTitle    = "Edit Produk";
$pageSubtitle = "Perbarui data produk";
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Produk - Sistem Koperasi Sekolah</title>
  <link rel="stylesheet" href="../../styles/categories/edit.css">
</head>

<body>
  <div class="layout">
    <?php require_once __DIR__ . "/../../components/admin/sidebar.php" ?>

    <main class="main">
      <?php require_once __DIR__ . "/../../components/admin/topbar.php" ?>

      <div class="content">
        <form method="POST" action="../../actions/products/update.php" class="card">
          <input type="hidden" name="product_id" value="<?= (int) $product['product_id'] ?>">

          <div class="form-group">
            <label for="product_code">Kode Produk</label>
            <input type="text" id="product_code" name="product_code" maxlength="10"
              value="<?= htmlspecialchars($data['product_code'] ?? '') ?>">
            <?php if (!empty($errors['product_code'])): ?>
              <p class="error-text"><?= htmlspecialchars($errors['product_code']) ?></p>
            <?php endif; ?>
          </div>

          <div class="form-group">
            <label for="product_name">Nama Produk</label>
            <input type="text" id="product_name" name="product_name" maxlength="100"
              value="<?= htmlspecialchars($data['product_name'] ?? '') ?>">
            <?php if (!empty($errors['product_name'])): ?>
              <p class="error-text"><?= htmlspecialchars($errors['product_name']) ?></p>
            <?php endif; ?>
          </div>

          <div class="form-group">
            <label for="category">Kategori</label>
            <select id="category" name="category">
              <option value="">-- Pilih Kategori --</option>
              <?php foreach (productCategories() as $category): ?>
                <option value="<?= htmlspecialchars($category) ?>"
                  <?= ($data['category'] ?? '') === $category ? 'selected' : '' ?>>
                  <?= htmlspecialchars($category) ?>
                </option>
              <?php endforeach; ?>
            </select>
            <?php if (!empty($errors['category'])): ?>
              <p class="error-text"><?= htmlspecialchars($errors['category']) ?></p>
            <?php endif; ?>
          </div>

          <div class="form-group">
            <label>Unit</label>
            <div class="form-radio">
              <?php foreach (productUnits() as $unit): ?>
                <label>
                  <input type="radio" name="unit" value="<?= htmlspecialchars($unit) ?>"
                    <?= ($data['unit'] ?? '') === $unit ? 'checked' : '' ?>>
                  <?= htmlspecialchars($unit) ?>
                </label>
              <?php endforeach; ?>
            </div>
            <?php if (!empty($errors['unit'])): ?>
              <p class="error-text"><?= htmlspecialchars($errors['unit']) ?></p>
            <?php endif; ?>
          </div>

          <div class="form-group">
            <label for="price">Harga (Rp)</label>
            <input type="number" id="price" name="price" min="0" step="0.01"
              value="<?= htmlspecialchars($data['price'] ?? '') ?>">
            <?php if (!empty($errors['price'])): ?>
              <p class="error-text"><?= htmlspecialchars($errors['price']) ?></p>
            <?php endif; ?>
          </div>

          <div class="form-group">
            <label for="stock">Stok</label>
            <input type="number" id="stock" name="stock" min="0" step="1"
              value="<?= htmlspecialchars($data['stock'] ?? '') ?>">
            <?php if (!empty($errors['stock'])): ?>
              <p class="error-text"><?= htmlspecialchars($errors['stock']) ?></p>
            <?php endif; ?>
          </div>

          <div class="form-group">
            <label for="entry_date">Tanggal Masuk</label>
            <input type="date" id="entry_date" name="entry_date"
              value="<?= htmlspecialchars($data['entry_date'] ?? '') ?>">
            <?php if (!empty($errors['entry_date'])): ?>
              <p class="error-text"><?= htmlspecialchars($errors['entry_date']) ?></p>
            <?php endif; ?>
          </div>

          <div class="form-group">
            <label for="description">Deskripsi (opsional)</label>
            <textarea id="description" name="description" rows="3"><?= htmlspecialchars($data['description'] ?? '') ?></textarea>
            <?php if (!empty($errors['description'])): ?>
              <p class="error-text"><?= htmlspecialchars($errors['description']) ?></p>
            <?php endif; ?>
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
