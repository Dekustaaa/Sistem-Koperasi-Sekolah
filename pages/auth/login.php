<?php
// === TAHAP 2 - AUTENTIKASI ===
// TODO 1 : session_start();   (TAHAP 3: ganti dengan require middleware + requireGuest())
// TODO 2 : ambil $_SESSION['success'], ['errors'], ['old'] lalu unset() (flash: tampil sekali)

$success = '';
$errors = [];
$old = [];
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - BukuKita</title>
  <link rel="stylesheet" href="../../styles/auth/login.css">
</head>

<body class="center-page">
  <div class="card auth-card">
    <h1>Masuk ke BukuKita</h1>

    <!-- TODO 3: jika $success ada -> <div class="alert alert-success"> -->

    <!-- TODO 4: jika $errors['login'] ada -> <div class="alert alert-error"> -->

    <form method="POST" action="../../actions/auth/login.php">
      <div class="form-group">
        <label for="email">Email</label>
        <!-- TODO 5: value = $old['email'] -->
        <input type="email" id="email" name="email" value="">
        <!-- TODO: tampilkan $errors['email'] di <p class="error-text"> jika ada -->
      </div>
      <div class="form-group">
        <label for="password">Kata Sandi</label>
        <input type="password" id="password" name="password">
        <!-- TODO: tampilkan $errors['password'] di <p class="error-text"> jika ada -->
      </div>

      <button name="login" type="submit" class="btn btn-primary btn-block">Masuk</button>
    </form>

    <p class="auth-link">Belum punya akun? <a href="register.php">Daftar</a></p>
  </div>
</body>

</html>
