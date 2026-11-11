<?php
require_once __DIR__ . "/../../config/auth.php";
requireLogin();
require_once __DIR__ . "/../../repositories/product-repository.php";

$flash   = pullFlash();
$success = $flash['success'];
$errors  = $flash['errors'];
$isAdmin = authIsAdmin();

$products = getProducts();

$pageTitle    = "Manajemen Produk";
$pageSubtitle = "Kelola data produk koperasi sekolah";
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
        <?php if ($success): ?>
          <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>

        <?php if (!empty($errors['delete'])): ?>
          <div class="alert alert-error"><?= htmlspecialchars($errors['delete']) ?></div>
        <?php endif; ?>

        <?php if ($isAdmin): ?>
          <div class="toolbar">
            <a href="create.php" class="btn btn-primary">+ Tambah Produk</a>
          </div>
        <?php endif; ?>

        <div class="card">
          <table>
            <thead>
              <tr>
                <th>Kode</th>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Unit</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Tanggal Masuk</th>
                <th>Deskripsi</th>
                <?php if ($isAdmin): ?><th>Aksi</th><?php endif; ?>
              </tr>
            </thead>
            <tbody>
              <?php if (!$products): ?>
                <tr>
                  <td colspan="<?= $isAdmin ? 9 : 8 ?>" class="empty">Belum ada data produk.</td>
                </tr>
              <?php else: ?>
                <?php foreach ($products as $product): ?>
                  <tr>
                    <td><?= htmlspecialchars($product['product_code']) ?></td>
                    <td><?= htmlspecialchars($product['product_name']) ?></td>
                    <td><?= htmlspecialchars($product['category']) ?></td>
                    <td><?= htmlspecialchars($product['unit']) ?></td>
                    <td>Rp <?= number_format((float) $product['price'], 0, ',', '.') ?></td>
                    <td><?= (int) $product['stock'] ?></td>
                    <td><?= htmlspecialchars($product['entry_date']) ?></td>
                    <td><?= htmlspecialchars($product['description'] ?? '-') ?></td>
                    <?php if ($isAdmin): ?>
                      <td class="actions">
                        <a href="edit.php?id=<?= (int) $product['product_id'] ?>" class="btn btn-outline btn-sm">Edit</a>
                        <a href="../../actions/products/destroy.php?id=<?= (int) $product['product_id'] ?>"
                          class="btn btn-danger btn-sm"
                          onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus</a>
                      </td>
                    <?php endif; ?>
                  </tr>
                <?php endforeach; ?>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </main>
  </div>
</body>

</html>
