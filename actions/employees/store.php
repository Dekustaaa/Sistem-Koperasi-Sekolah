<?php

require_once __DIR__ . "/../../config/auth.php";
requireAdmin();
require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../validations/employee-validation.php";

if (isset($_POST['store']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
  $request = getEmployeeRequest($_POST);
  $errors  = validateEmployee($request);

  if ($errors) {
    $_SESSION['errors'] = $errors;
    $_SESSION['old']    = $request;
    header('Location: /pages/employees/create.php');
    exit;
  }

  try {
    $pdo->beginTransaction();

    $stmt = $pdo->prepare(
      "INSERT INTO employees
        (employee_number, full_name, gender, birth_date, position, salary)
       VALUES
        (:employee_number, :full_name, :gender, :birth_date, :position, :salary)"
    );
    $stmt->execute([
      ':employee_number' => $request['employee_number'],
      ':full_name'       => $request['full_name'],
      ':gender'          => $request['gender'],
      ':birth_date'      => $request['birth_date'],
      ':position'        => $request['position'],
      ':salary'          => $request['salary'],
    ]);

    $pdo->commit();

    $_SESSION['success'] = 'Pegawai berhasil ditambahkan.';
    header('Location: /pages/employees/index.php');
    exit;
  } catch (PDOException $e) {
    $pdo->rollBack();

    if ($e->getCode() === '23000') {
      $_SESSION['errors'] = ['employee_number' => 'Nomor pegawai sudah dipakai.'];
      $_SESSION['old']    = $request;
      header('Location: /pages/employees/create.php');
      exit;
    }

    throw $e;
  }
}

header('Location: /pages/employees/create.php');
exit;
