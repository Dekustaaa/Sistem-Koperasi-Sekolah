<?php
// === TAHAP 2 - AUTENTIKASI ===
// TODO 1 : session_start();   (TAHAP 3: ganti dengan require middleware + requireGuest())
// TODO 2 : ambil $_SESSION['errors'] dan ['old'] lalu unset()

$errors = [];
$old = [];
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

    <form method="POST" action="../../actions/auth/register.php">
      <div class="form-group">
        <label for="name">Nama Lengkap</label>
        <!-- TODO: value = $old['name'] -->
        <input type="text" id="name" name="name" value="">
        <!-- TODO: tampilkan $errors['name'] di <p class="error-text"> jika ada -->
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <!-- TODO: value = $old['email'] -->
        <input type="email" id="email" name="email" value="">
        <!-- TODO: tampilkan $errors['email'] di <p class="error-text"> jika ada -->
      </div>
      <div class="form-group">
        <label for="password">Kata Sandi</label>
        <input type="password" id="password" name="password">
        <!-- TODO: tampilkan $errors['password'] di <p class="error-text"> jika ada -->
      </div>
      <div class="form-group">
        <label for="password_confirmation">Ulangi Kata Sandi</label>
        <input type="password" id="password_confirmation" name="password_confirmation">
        <!-- TODO: tampilkan $errors['password_confirmation'] di <p class="error-text"> jika ada -->
      </div>

      <button name="register" type="submit" class="btn btn-primary btn-block">Daftar</button>
    </form>

    <p class="auth-link">Sudah punya akun? <a href="login.php">Masuk</a></p>
  </div>
</body>

</html>
