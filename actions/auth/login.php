<?php

require_once __DIR__ . "/../../config/auth.php";
requireGuest();
require_once __DIR__ . "/../../validations/auth-validation.php";

if (isset($_POST['login']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
  $request = getLoginRequest($_POST);
  $errors  = validateLogin($request);

  if (!$errors) {
    $user = getUserByEmail($request['email']);

    if (!$user || !verifyUserPassword($user, $request['password'])) {
      $errors['login'] = 'Email atau kata sandi salah.';
    }
  }

  if ($errors) {
    $_SESSION['errors'] = $errors;
    unset($request['password']);
    $_SESSION['old'] = $request;
    header('Location: /pages/auth/login.php');
    exit;
  }

  session_regenerate_id(true);
  $_SESSION['user'] = [
    'id'    => $user['id'],
    'name'  => $user['name'],
    'email' => $user['email'],
    'role'  => $user['role'],
  ];

  header('Location: /pages/products/index.php');
  exit;
}

header('Location: /pages/auth/login.php');
exit;
