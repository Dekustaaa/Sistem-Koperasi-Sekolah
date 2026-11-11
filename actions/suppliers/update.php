<?php

require_once __DIR__ . "/../../config/auth.php";
requireAdmin();
require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../validations/supplier-validation.php";

if (isset($_POST['update']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
  $request = getSupplierRequest($_POST);
  $id      = $request['supplier_id'];
  $errors  = validateSupplier($request);

  if ($id <= 0) {
    $errors['supplier_id'] = 'Data supplier tidak ditemukan.';
  }

  if ($errors) {
    $_SESSION['errors'] = $errors;
    $_SESSION['old']    = $request;
    header('Location: /pages/suppliers/edit.php?id=' . urlencode($id));
    exit;
  }

  try {
    $pdo->beginTransaction();

    $stmt = $pdo->prepare(
      "UPDATE suppliers SET
        supplier_name    = :supplier_name,
        email            = :email,
        phone            = :phone,
        address          = :address,
        product_types    = :product_types,
        partnership_date = :partnership_date
       WHERE supplier_id = :id"
    );
    $stmt->execute([
      ':supplier_name'    => $request['supplier_name'],
      ':email'            => $request['email'],
      ':phone'            => $request['phone'],
      ':address'          => $request['address'],
      ':product_types'    => json_encode($request['product_types']),
      ':partnership_date' => $request['partnership_date'],
      ':id'               => $id,
    ]);

    $pdo->commit();

    $_SESSION['success'] = 'Data supplier berhasil diperbarui.';
    header('Location: /pages/suppliers/index.php');
    exit;
  } catch (PDOException $e) {
    $pdo->rollBack();
    throw $e;
  }
}

header('Location: /pages/suppliers/index.php');
exit;
