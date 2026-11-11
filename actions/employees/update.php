<?php

require_once __DIR__ . "/../../config/auth.php";
requireAdmin();
require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../validations/employee-validation.php";

if (isset($_POST['update']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
  $request = getEmployeeRequest($_POST);
  $id      = $request['employee_id'];
  $errors  = validateEmployee($request);

  if ($id <= 0) {
    $errors['employee_id'] = 'Data pegawai tidak ditemukan.';
  }

  if ($errors) {
    $_SESSION['errors'] = $errors;
    $_SESSION['old']    = $request;
    header('Location: /pages/employees/edit.php?id=' . urlencode($id));
    exit;
  }

  try {
    $pdo->beginTransaction();

    $stmt = $pdo->prepare(
      "UPDATE employees SET
        employee_number = :employee_number,
        full_name       = :full_name,
        gender          = :gender,
        birth_date      = :birth_date,
        position        = :position,
        salary          = :salary
       WHERE employee_id = :id"
    );
    $stmt->execute([
      ':employee_number' => $request['employee_number'],
      ':full_name'       => $request['full_name'],
      ':gender'          => $request['gender'],
      ':birth_date'      => $request['birth_date'],
      ':position'        => $request['position'],
      ':salary'          => $request['salary'],
      ':id'              => $id,
    ]);

    $pdo->commit();

    $_SESSION['success'] = 'Data pegawai berhasil diperbarui.';
    header('Location: /pages/employees/index.php');
    exit;
  } catch (PDOException $e) {
    $pdo->rollBack();

    if ($e->getCode() === '23000') {
      $_SESSION['errors'] = ['employee_number' => 'Nomor pegawai sudah dipakai.'];
      $_SESSION['old']    = $request;
      header('Location: /pages/employees/edit.php?id=' . urlencode($id));
      exit;
    }

    throw $e;
  }
}

header('Location: /pages/employees/index.php');
exit;
