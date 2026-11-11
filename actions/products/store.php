<?php

require_once __DIR__ . "/../../config/auth.php";
requireAdmin();
require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../validations/product-validation.php";

if (isset($_POST['store']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
  $request = getProductRequest($_POST);
  $errors  = validateProduct($request);

  if ($errors) {
    $_SESSION['errors'] = $errors;
    $_SESSION['old']    = $request;
    header('Location: /pages/products/create.php');
    exit;
  }

  try {
    $pdo->beginTransaction();

    $stmt = $pdo->prepare(
      "INSERT INTO products
        (product_code, product_name, category, unit, price, stock, entry_date, description)
       VALUES
        (:product_code, :product_name, :category, :unit, :price, :stock, :entry_date, :description)"
    );
    $stmt->execute([
      ':product_code' => $request['product_code'],
      ':product_name' => $request['product_name'],
      ':category'     => $request['category'],
      ':unit'         => $request['unit'],
      ':price'        => $request['price'],
      ':stock'        => $request['stock'],
      ':entry_date'   => $request['entry_date'],
      ':description'  => $request['description'] !== '' ? $request['description'] : null,
    ]);

    $pdo->commit();

    $_SESSION['success'] = 'Produk berhasil ditambahkan.';
    header('Location: /pages/products/index.php');
    exit;
  } catch (PDOException $e) {
    $pdo->rollBack();

    if ($e->getCode() === '23000') {
      $_SESSION['errors'] = ['product_code' => 'Kode produk sudah dipakai.'];
      $_SESSION['old']    = $request;
      header('Location: /pages/products/create.php');
      exit;
    }

    throw $e;
  }
}

header('Location: /pages/products/create.php');
exit;
