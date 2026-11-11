<?php
require_once __DIR__ . "/../../config/auth.php";
requireGuest();

$flash  = pullFlash();
$errors = $flash['errors'];
$old    = $flash['old'];
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar - Sistem Koperasi Sekolah</title>
  <link rel="stylesheet" href="../../styles/auth/register.css">
</head>

<body class="center-page">
  <div class="card auth-card">
    <h1>Buat Akun Baru</h1>

    <?php if (!empty($errors['login'])): ?>
      <div class="alert alert-error"><?= htmlspecialchars($errors['login']) ?></div>
    <?php endif; ?>

    <form method="POST" action="../../actions/auth/register.php">
      <div class="form-group">
        <label for="name">Nama Lengkap</label>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($old['name'] ?? '') ?>" autofocus>
        <?php if (!empty($errors['name'])): ?>
          <p class="error-text"><?= htmlspecialchars($errors['name']) ?></p>
        <?php endif; ?>
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($old['email'] ?? '') ?>">
        <?php if (!empty($errors['email'])): ?>
          <p class="error-text"><?= htmlspecialchars($errors['email']) ?></p>
        <?php endif; ?>
      </div>
      <div class="form-group">
        <label for="password">Kata Sandi</label>
        <input type="password" id="password" name="password">
        <?php if (!empty($errors['password'])): ?>
          <p class="error-text"><?= htmlspecialchars($errors['password']) ?></p>
        <?php endif; ?>
        <p class="error-text" style="color: var(--muted)">Minimal 8 karakter.</p>
      </div>
      <div class="form-group">
        <label for="password_confirmation">Ulangi Kata Sandi</label>
        <input type="password" id="password_confirmation" name="password_confirmation">
        <?php if (!empty($errors['password_confirmation'])): ?>
          <p class="error-text"><?= htmlspecialchars($errors['password_confirmation']) ?></p>
        <?php endif; ?>
      </div>

      <button name="register" type="submit" class="btn btn-primary btn-block">Daftar</button>
    </form>

    <p class="auth-link">Sudah punya akun? <a href="login.php">Masuk</a></p>
  </div>
</body>

</html>
