<?php

require_once __DIR__ . "/../../config/auth.php";
requireGuest();
require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../validations/auth-validation.php";

if (isset($_POST['register']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
  $request = getRegisterRequest($_POST);
  $errors  = validateRegister($request);

  if ($errors) {
    $_SESSION['errors'] = $errors;
    unset($request['password'], $request['password_confirmation']);
    $_SESSION['old'] = $request;
    header('Location: /pages/auth/register.php');
    exit;
  }

  try {
    $pdo->beginTransaction();

    createUser(
      $request['name'],
      $request['email'],
      $request['password'],
      'member'
    );

    $pdo->commit();

    $_SESSION['success'] = 'Registrasi pengguna baru sudah berhasil. Silakan login.';
    header('Location: /pages/auth/login.php');
    exit;
  } catch (PDOException $e) {
    $pdo->rollBack();

    if ($e->getCode() === '23000') {
      $_SESSION['errors'] = ['email' => 'Email sudah terdaftar.'];
      unset($request['password'], $request['password_confirmation']);
      $_SESSION['old'] = $request;
      header('Location: /pages/auth/register.php');
      exit;
    }

    throw $e;
  }
}

header('Location: /pages/auth/register.php');
exit;
