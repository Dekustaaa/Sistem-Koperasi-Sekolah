<?php
// ACTION LOGIN
//
// === TAHAP 2 - AUTENTIKASI ===
// Awali file dengan: session_start();  lalu require validations/auth-validation.php
//
// if (isset($_POST['login']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
//   1. $request = getLoginRequest($_POST); $errors = validateLogin($request);
//   2. Jika tidak ada error: $user = getUserByEmail($request['email']);
//      jika !$user ATAU !password_verify(...) -> $errors['login'] = "Email atau Kata Sandi salah";
//   3. Jika ada error: simpan ke $_SESSION['errors'], unset password dari $request,
//      simpan ke $_SESSION['old'], header('Location: ../../pages/auth/login.php'); exit;
//   4. session_regenerate_id(true);
//   5. $_SESSION['user'] = [id, name, email, role];   (JANGAN simpan password)
//   6. header('Location: ../../pages/products/index.php'); exit;
// }
//
// === TAHAP 3 - OTORISASI (terakhir) ===
// Ganti session_start(); dengan:
//   require_once __DIR__ . "/../../middleware/auth.php";
//   requireGuest();
