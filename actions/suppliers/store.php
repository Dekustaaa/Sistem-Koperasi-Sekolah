<?php

require_once __DIR__ . "/../../config/auth.php";
requireAdmin();
require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../validations/supplier-validation.php";

if (isset($_POST['store']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
  $request = getSupplierRequest($_POST);
  $errors  = validateSupplier($request);

  if ($errors) {
    $_SESSION['errors'] = $errors;
    $_SESSION['old']    = $request;
    header('Location: /pages/suppliers/create.php');
    exit;
  }

  try {
    $pdo->beginTransaction();

    $stmt = $pdo->prepare(
      "INSERT INTO suppliers
        (supplier_name, email, phone, address, product_types, partnership_date)
       VALUES
        (:supplier_name, :email, :phone, :address, :product_types, :partnership_date)"
    );
    $stmt->execute([
      ':supplier_name'    => $request['supplier_name'],
      ':email'            => $request['email'],
      ':phone'            => $request['phone'],
      ':address'          => $request['address'],
      ':product_types'    => json_encode($request['product_types']),
      ':partnership_date' => $request['partnership_date'],
    ]);

    $pdo->commit();

    $_SESSION['success'] = 'Supplier berhasil ditambahkan.';
    header('Location: /pages/suppliers/index.php');
    exit;
  } catch (PDOException $e) {
    $pdo->rollBack();
    throw $e;
  }
}

header('Location: /pages/suppliers/create.php');
exit;
