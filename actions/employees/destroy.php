<?php

require_once __DIR__ . "/../../config/auth.php";
requireAdmin();
require_once __DIR__ . "/../../config/database.php";

if (isset($_GET['id']) && $_SERVER['REQUEST_METHOD'] === 'GET') {
  try {
    $pdo->beginTransaction();

    $stmt = $pdo->prepare("DELETE FROM employees WHERE employee_id = :id");
    $stmt->execute([':id' => intval($_GET['id'])]);

    $pdo->commit();
    $_SESSION['success'] = 'Pegawai berhasil dihapus.';
  } catch (PDOException $e) {
    $pdo->rollBack();
    $_SESSION['errors'] = ['delete' => 'Pegawai gagal dihapus.'];
  }
}

header('Location: /pages/employees/index.php');
exit;
