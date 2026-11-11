<?php
require_once __DIR__ . "/../../config/auth.php";
requireLogin();
http_response_code(403);
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Akses Ditolak - Sistem Koperasi Sekolah</title>
  <link rel="stylesheet" href="../../styles/base.css">
</head>

<body class="center-page">
  <div class="card text-center">
    <h1 class="big-code">403</h1>
    <p>Anda tidak memiliki izin untuk mengakses halaman ini.</p>
    <br>
    <a href="../products/index.php" class="btn btn-primary">Kembali ke Beranda</a>
  </div>
</body>

</html>
