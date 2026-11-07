<?php
// ACTION TAMBAH produk (CREATE)
//
// === TAHAP 1 - CRUD ===
// Awali file dengan: session_start();  lalu require config/database.php
// dan validations/category-validation.php
//
// if (isset($_POST['store']) && $_SERVER['REQUEST_METHOD'] === "POST") {
//   try {
//     1. $pdo->beginTransaction();
//     2. $request = getCategoryRequest($_POST); $errors = validateCategory($request);
//     3. Jika ada error: $_SESSION['errors'] = $errors; $_SESSION['old'] = $request;
//        header('Location: ../../pages/categories/create.php'); exit;
//     4. insert into categories (name, description) values (:name, :description)
//     5. $pdo->commit(); header('Location: ../../pages/categories/index.php'); exit;
//   } catch (PDOException $e) { $pdo->rollBack(); throw $e; }
// }
//
// === TAHAP 3 - OTORISASI (terakhir) ===
// Ganti session_start(); dengan:
//   require_once __DIR__ . "/../../middleware/auth.php";
//   requireRole(['admin']);
