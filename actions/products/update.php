<?php

require_once __DIR__ . "/../../config/auth.php";
requireAdmin();
require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../validations/product-validation.php";

if (isset($_POST['update']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
  $request = getProductRequest($_POST);
  $id      = $request['product_id'];
  $errors  = validateProduct($request, $id);

  if ($id <= 0) {
    $errors['product_id'] = 'Data produk tidak ditemukan.';
  }

  if ($errors) {
    $_SESSION['errors'] = $errors;
    $_SESSION['old']    = $request;
    header('Location: /pages/products/edit.php?id=' . urlencode($id));
    exit;
  }

  try {
    $pdo->beginTransaction();

    $stmt = $pdo->prepare(
      "UPDATE products SET
        product_code = :product_code,
        product_name = :product_name,
        category     = :category,
        unit         = :unit,
        price        = :price,
        stock        = :stock,
        entry_date   = :entry_date,
        description  = :description
       WHERE product_id = :id"
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
      ':id'           => $id,
    ]);

    $pdo->commit();

    $_SESSION['success'] = 'Data produk berhasil diperbarui.';
    header('Location: /pages/products/index.php');
    exit;
  } catch (PDOException $e) {
    $pdo->rollBack();

    if ($e->getCode() === '23000') {
      $_SESSION['errors'] = ['product_code' => 'Kode produk sudah dipakai.'];
      $_SESSION['old']    = $request;
      header('Location: /pages/products/edit.php?id=' . urlencode($id));
      exit;
    }

    throw $e;
  }
}

header('Location: /pages/products/index.php');
exit;
