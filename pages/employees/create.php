<?php
require_once __DIR__ . "/../../config/auth.php";
requireAdmin();
require_once __DIR__ . "/../../validations/employee-validation.php";

$flash  = pullFlash();
$errors = $flash['errors'];
$old    = $flash['old'];

$pageTitle    = "Tambah Pegawai";
$pageSubtitle = "Lengkapi data pegawai baru";
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Pegawai - Sistem Koperasi Sekolah</title>
  <link rel="stylesheet" href="../../styles/categories/create.css">
</head>

<body>
  <div class="layout">
    <?php require_once __DIR__ . "/../../components/admin/sidebar.php" ?>

    <main class="main">
      <?php require_once __DIR__ . "/../../components/admin/topbar.php" ?>

      <div class="content">
        <form method="POST" action="../../actions/employees/store.php" class="card">
          <div class="form-group">
            <label for="employee_number">Nomor Pegawai</label>
            <input type="text" id="employee_number" name="employee_number" maxlength="10"
              value="<?= htmlspecialchars($old['employee_number'] ?? '') ?>" placeholder="Contoh: EMP001">
            <?php if (!empty($errors['employee_number'])): ?>
              <p class="error-text"><?= htmlspecialchars($errors['employee_number']) ?></p>
            <?php endif; ?>
          </div>

          <div class="form-group">
            <label for="full_name">Nama Lengkap</label>
            <input type="text" id="full_name" name="full_name" maxlength="100"
              value="<?= htmlspecialchars($old['full_name'] ?? '') ?>">
            <?php if (!empty($errors['full_name'])): ?>
              <p class="error-text"><?= htmlspecialchars($errors['full_name']) ?></p>
            <?php endif; ?>
          </div>

          <div class="form-group">
            <label>Jenis Kelamin</label>
            <div class="form-radio">
              <label>
                <input type="radio" name="gender" value="M" <?= ($old['gender'] ?? '') === 'M' ? 'checked' : '' ?>>
                Laki-laki
              </label>
              <label>
                <input type="radio" name="gender" value="F" <?= ($old['gender'] ?? '') === 'F' ? 'checked' : '' ?>>
                Perempuan
              </label>
            </div>
            <?php if (!empty($errors['gender'])): ?>
              <p class="error-text"><?= htmlspecialchars($errors['gender']) ?></p>
            <?php endif; ?>
          </div>

          <div class="form-group">
            <label for="birth_date">Tanggal Lahir</label>
            <input type="date" id="birth_date" name="birth_date"
              value="<?= htmlspecialchars($old['birth_date'] ?? '') ?>">
            <?php if (!empty($errors['birth_date'])): ?>
              <p class="error-text"><?= htmlspecialchars($errors['birth_date']) ?></p>
            <?php endif; ?>
          </div>

          <div class="form-group">
            <label for="position">Jabatan</label>
            <select id="position" name="position">
              <option value="">-- Pilih Jabatan --</option>
              <?php foreach (employeePositions() as $position): ?>
                <option value="<?= htmlspecialchars($position) ?>"
                  <?= ($old['position'] ?? '') === $position ? 'selected' : '' ?>>
                  <?= htmlspecialchars($position) ?>
                </option>
              <?php endforeach; ?>
            </select>
            <?php if (!empty($errors['position'])): ?>
              <p class="error-text"><?= htmlspecialchars($errors['position']) ?></p>
            <?php endif; ?>
          </div>

          <div class="form-group">
            <label for="salary">Gaji (Rp)</label>
            <input type="number" id="salary" name="salary" min="0" step="0.01"
              value="<?= htmlspecialchars($old['salary'] ?? '') ?>">
            <?php if (!empty($errors['salary'])): ?>
              <p class="error-text"><?= htmlspecialchars($errors['salary']) ?></p>
            <?php endif; ?>
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
