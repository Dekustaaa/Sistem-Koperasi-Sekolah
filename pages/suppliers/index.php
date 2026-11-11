<?php
require_once __DIR__ . "/../../config/auth.php";
requireLogin();
require_once __DIR__ . "/../../repositories/supplier-repository.php";
require_once __DIR__ . "/../../validations/supplier-validation.php";

$flash   = pullFlash();
$success = $flash['success'];
$errors  = $flash['errors'];
$isAdmin = authIsAdmin();

$suppliers = getSuppliers();

$pageTitle    = "Manajemen Supplier";
$pageSubtitle = "Kelola data supplier koperasi sekolah";
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Supplier - Sistem Koperasi Sekolah</title>
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
            <a href="create.php" class="btn btn-primary">+ Tambah Supplier</a>
          </div>
        <?php endif; ?>

        <div class="card">
          <table>
            <thead>
              <tr>
                <th>Nama Supplier</th>
                <th>Email</th>
                <th>Telepon</th>
                <th>Alamat</th>
                <th>Jenis Produk</th>
                <th>Tanggal Kerja Sama</th>
                <?php if ($isAdmin): ?><th>Aksi</th><?php endif; ?>
              </tr>
            </thead>
            <tbody>
              <?php if (!$suppliers): ?>
                <tr>
                  <td colspan="<?= $isAdmin ? 7 : 6 ?>" class="empty">Belum ada data supplier.</td>
                </tr>
              <?php else: ?>
                <?php foreach ($suppliers as $supplier): ?>
                  <tr>
                    <td><?= htmlspecialchars($supplier['supplier_name']) ?></td>
                    <td><?= htmlspecialchars($supplier['email']) ?></td>
                    <td><?= htmlspecialchars($supplier['phone']) ?></td>
                    <td><?= htmlspecialchars($supplier['address']) ?></td>
                    <td><?= htmlspecialchars(implode(', ', decodeProductTypes($supplier['product_types']))) ?></td>
                    <td><?= htmlspecialchars($supplier['partnership_date']) ?></td>
                    <?php if ($isAdmin): ?>
                      <td class="actions">
                        <a href="edit.php?id=<?= (int) $supplier['supplier_id'] ?>" class="btn btn-outline btn-sm">Edit</a>
                        <a href="../../actions/suppliers/destroy.php?id=<?= (int) $supplier['supplier_id'] ?>"
                          class="btn btn-danger btn-sm"
                          onclick="return confirm('Yakin ingin menghapus supplier ini?')">Hapus</a>
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
