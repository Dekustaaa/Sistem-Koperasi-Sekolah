<?php
require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../validations/category-validation.php";
// ACTION TAMBAH KATEGORI (CREATE)
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
//        header('Location: ../../pages/products/create.php'); exit;
//     4. insert into products (name, description) values (:name, :description)
//     5. $pdo->commit(); header('Location: ../../pages/products/index.php'); exit;
//   } catch (PDOException $e) { $pdo->rollBack(); throw $e; }
// }
//
// === TAHAP 3 - OTORISASI (terakhir) ===
// Ganti session_start(); dengan:
//   require_once __DIR__ . "/../../middleware/auth.php";
//   requireRole(['admin']);

if(isset($_POST['store']) && $_SERVER['REQUEST_METHOD'] === "POST") {
    try {
        // $pdo->beginTransaction();
        $request = getCategoryRequest($_POST);
        $query = "INSERT INTO products (name, description) values(:name, :description)";
        $stmt = $pdo -> prepare($query);
        $stmt->execute([
            "name" => $request['name'],
            "description" => $request['description']
        ]);
        header('location: ../../pages/products/index.php');
        exit;
    } catch(PDOException $e) {
        throw $e;
    }

}