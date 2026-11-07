<?php
// ACTION UBAH KATEGORI (UPDATE)
//
// === TAHAP 1 - CRUD ===
// Awali file dengan: session_start();  lalu require config/database.php
// dan validations/category-validation.php
//
// if (isset($_POST['update']) && $_SERVER['REQUEST_METHOD'] === "POST") {
//   try {
//     1. $pdo->beginTransaction();
//     2. $request = getCategoryRequest($_POST);
//        $errors = validateCategory($request, $request['id']);   // abaikan nama sendiri
//     3. Jika ada error: simpan errors & old ke session,
//        header('Location: ../../pages/products/edit.php?id=' . urlencode($request['id'])); exit;
//     4. update products set name = :name, description = :description where id = :id
//     5. $pdo->commit(); header('Location: ../../pages/products/index.php'); exit;
//   } catch (PDOException $e) { $pdo->rollBack(); throw $e; }
// }
//
// === TAHAP 3 - OTORISASI (terakhir) ===
// Ganti session_start(); dengan:
//   require_once __DIR__ . "/../../middleware/auth.php";
//   requireRole(['admin']);
