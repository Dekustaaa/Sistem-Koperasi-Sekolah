<?php
require_once __DIR__ . "/../../config/auth.php";
requireLogin();
require_once __DIR__ . "/../../repositories/employee-repository.php";
require_once __DIR__ . "/../../validations/employee-validation.php";

$flash   = pullFlash();
$success = $flash['success'];
$errors  = $flash['errors'];
$isAdmin = authIsAdmin();

$employees = getEmployees();

$pageTitle    = "Manajemen Pegawai";
$pageSubtitle = "Kelola data pegawai koperasi sekolah";
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pegawai - Sistem Koperasi Sekolah</title>
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
            <a href="create.php" class="btn btn-primary">+ Tambah Pegawai</a>
          </div>
        <?php endif; ?>

        <div class="card">
          <table>
            <thead>
              <tr>
                <th>Nomor Pegawai</th>
                <th>Nama Lengkap</th>
                <th>Jenis Kelamin</th>
                <th>Tanggal Lahir</th>
                <th>Jabatan</th>
                <th>Gaji</th>
                <?php if ($isAdmin): ?><th>Aksi</th><?php endif; ?>
              </tr>
            </thead>
            <tbody>
              <?php if (!$employees): ?>
                <tr>
                  <td colspan="<?= $isAdmin ? 7 : 6 ?>" class="empty">Belum ada data pegawai.</td>
                </tr>
              <?php else: ?>
                <?php foreach ($employees as $employee): ?>
                  <tr>
                    <td><?= htmlspecialchars($employee['employee_number']) ?></td>
                    <td><?= htmlspecialchars($employee['full_name']) ?></td>
                    <td><?= htmlspecialchars(employeeGenderLabel($employee['gender'])) ?></td>
                    <td><?= htmlspecialchars($employee['birth_date']) ?></td>
                    <td><?= htmlspecialchars($employee['position']) ?></td>
                    <td>Rp <?= number_format((float) $employee['salary'], 0, ',', '.') ?></td>
                    <?php if ($isAdmin): ?>
                      <td class="actions">
                        <a href="edit.php?id=<?= (int) $employee['employee_id'] ?>" class="btn btn-outline btn-sm">Edit</a>
                        <a href="../../actions/employees/destroy.php?id=<?= (int) $employee['employee_id'] ?>"
                          class="btn btn-danger btn-sm"
                          onclick="return confirm('Yakin ingin menghapus pegawai ini?')">Hapus</a>
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
