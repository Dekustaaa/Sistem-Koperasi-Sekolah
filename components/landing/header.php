<?php
$headerUser = $_SESSION['user'] ?? null;
?>
<header>
  <nav class="navbar">
    <a href="/index.php" class="brand">Sistem Koperasi Sekolah</a>
    <div class="nav-actions">
      <?php if ($headerUser): ?>
        <a href="/pages/products/index.php" class="btn btn-outline btn-sm">
          <?= htmlspecialchars($headerUser['name']) ?>
        </a>
        <a href="/actions/auth/logout.php" class="btn btn-primary btn-sm"
          onclick="return confirm('Yakin ingin logout?')">Logout</a>
      <?php else: ?>
        <a href="/pages/auth/login.php" class="btn btn-outline btn-sm">Masuk</a>
        <a href="/pages/auth/register.php" class="btn btn-primary btn-sm">Daftar</a>
      <?php endif; ?>
    </div>
  </nav>
</header>
