<?php
require_once __DIR__ . "/../../config/auth.php";
requireAdmin();
require_once __DIR__ . "/../../validations/supplier-validation.php";

$id       = intval($_GET['id'] ?? 0);
$supplier = getSupplier($id);

if (!$supplier) {
  $_SESSION['errors'] = ['delete' => 'Data supplier tidak ditemukan.'];
  header('Location: /pages/suppliers/index.php');
  exit;
}

$flash  = pullFlash();
$errors = $flash['errors'];
$old    = $flash['old'];
$data   = $old ?: $supplier;

$selectedTypes = decodeProductTypes($data['product_types'] ?? []);

$pageTitle    = "Edit Supplier";
$pageSubtitle = "Perbarui data supplier";
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Supplier - Sistem Koperasi Sekolah</title>
  <link rel="stylesheet" href="../../styles/categories/edit.css">
</head>

<body>
  <div class="layout">
    <?php require_once __DIR__ . "/../../components/admin/sidebar.php" ?>

    <main class="main">
      <?php require_once __DIR__ . "/../../components/admin/topbar.php" ?>

      <div class="content">
        <form method="POST" action="../../actions/suppliers/update.php" class="card">
          <input type="hidden" name="supplier_id" value="<?= (int) $supplier['supplier_id'] ?>">

          <div class="form-group">
            <label for="supplier_name">Nama Supplier</label>
            <input type="text" id="supplier_name" name="supplier_name" maxlength="100"
              value="<?= htmlspecialchars($data['supplier_name'] ?? '') ?>">
            <?php if (!empty($errors['supplier_name'])): ?>
              <p class="error-text"><?= htmlspecialchars($errors['supplier_name']) ?></p>
            <?php endif; ?>
          </div>

          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" maxlength="100"
              value="<?= htmlspecialchars($data['email'] ?? '') ?>">
            <?php if (!empty($errors['email'])): ?>
              <p class="error-text"><?= htmlspecialchars($errors['email']) ?></p>
            <?php endif; ?>
          </div>

          <div class="form-group">
            <label for="phone">Nomor Telepon</label>
            <input type="tel" id="phone" name="phone" maxlength="15"
              value="<?= htmlspecialchars($data['phone'] ?? '') ?>">
            <?php if (!empty($errors['phone'])): ?>
              <p class="error-text"><?= htmlspecialchars($errors['phone']) ?></p>
            <?php endif; ?>
          </div>

          <div class="form-group">
            <label for="address">Alamat</label>
            <textarea id="address" name="address" rows="3"><?= htmlspecialchars($data['address'] ?? '') ?></textarea>
            <?php if (!empty($errors['address'])): ?>
              <p class="error-text"><?= htmlspecialchars($errors['address']) ?></p>
            <?php endif; ?>
          </div>

          <div class="form-group">
            <label>Jenis Produk (boleh lebih dari satu)</label>
            <div class="form-radio">
              <?php foreach (supplierProductTypeOptions() as $type): ?>
                <label>
                  <input type="checkbox" name="product_types[]" value="<?= htmlspecialchars($type) ?>"
                    <?= in_array($type, $selectedTypes, true) ? 'checked' : '' ?>>
                  <?= htmlspecialchars($type) ?>
                </label>
              <?php endforeach; ?>
            </div>
            <?php if (!empty($errors['product_types'])): ?>
              <p class="error-text"><?= htmlspecialchars($errors['product_types']) ?></p>
            <?php endif; ?>
          </div>

          <div class="form-group">
            <label for="partnership_date">Tanggal Kerja Sama</label>
            <input type="date" id="partnership_date" name="partnership_date"
              value="<?= htmlspecialchars($data['partnership_date'] ?? '') ?>">
            <?php if (!empty($errors['partnership_date'])): ?>
              <p class="error-text"><?= htmlspecialchars($errors['partnership_date']) ?></p>
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
