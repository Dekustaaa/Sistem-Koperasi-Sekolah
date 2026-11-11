<?php
$user = $_SESSION['user'] ?? null;
?>
<header class="topbar">
  <div>
    <h1><?= htmlspecialchars($pageTitle ?? '') ?></h1>
    <p><?= htmlspecialchars($pageSubtitle ?? '') ?></p>
  </div>

  <div class="topbar-user">
    <?= htmlspecialchars($user['name'] ?? 'Tamu') ?>
    <span class="badge"><?= htmlspecialchars($user['role'] ?? '-') ?></span>
  </div>
</header>
