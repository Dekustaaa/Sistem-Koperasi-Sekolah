<?php
// ACTION HAPUS produk (DELETE)
//
// === TAHAP 1 - CRUD ===
// Awali file dengan: session_start();  lalu require config/database.php
//
// if (isset($_GET['id']) && $_SERVER['REQUEST_METHOD'] === "GET") {
//   try {
//     1. $pdo->beginTransaction();
//     2. delete from categories where id = :id   (id dari $_GET['id'])
//     3. $pdo->commit(); header('Location: ../../pages/categories/index.php'); exit;
//   } catch (PDOException $e) {
//     $pdo->rollBack();
//     Jika $e->getCode() === '23000' (produk masih dipakai buku):
//       $_SESSION['errors'] = ['delete' => "produk masih dipakai oleh buku"];
//       header('Location: ../../pages/categories/index.php'); exit;
//     selain itu: throw $e;
//   }
// }
//
// === TAHAP 3 - OTORISASI (terakhir) ===
// Ganti session_start(); dengan:
//   require_once __DIR__ . "/../../middleware/auth.php";
//   requireRole(['admin']);
