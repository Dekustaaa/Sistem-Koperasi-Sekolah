<aside class="sidebar">
  <div class="brand">Sistem Koperasi Sekolah</div>

  <?php
  $sidebarUser = $_SESSION['user'] ?? null;
  $sidebarIsAdmin = ($sidebarUser['role'] ?? '') === 'admin';
  ?>
  <?php if ($sidebarUser): ?>
    <div class="sidebar-user">
      <strong><?= htmlspecialchars($sidebarUser['name']) ?></strong>
      <span class="badge"><?= htmlspecialchars($sidebarUser['role']) ?></span>
    </div>
  <?php endif; ?>

  <nav>
    <a href="/index.php">Beranda</a>
    <a href="/pages/products/index.php">Produk</a>
    <a href="/pages/suppliers/index.php">Supplier</a>
    <a href="/pages/employees/index.php">Pegawai</a>
    <?php if ($sidebarIsAdmin): ?>
      <a href="/pages/products/create.php">+ Produk Baru</a>
    <?php endif; ?>
    <a onclick="return confirm('Yakin ingin logout?')"
      href="/actions/auth/logout.php" class="logout">Logout</a>
  </nav>
</aside>
