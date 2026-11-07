<?php
// ACTION REGISTER
//
// === TAHAP 2 - AUTENTIKASI ===
// Awali file dengan: session_start();  lalu require config/database.php
// dan validations/auth-validation.php (pakai __DIR__ . "/../../...")
//
// if (isset($_POST['register']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
//   try {
//     1. $pdo->beginTransaction();
//     2. $request = getRegisterRequest($_POST); $errors = validateRegister($request);
//     3. Jika ada error: simpan $errors ke $_SESSION['errors'],
//        unset password & password_confirmation dari $request,
//        simpan $request ke $_SESSION['old'],
//        header('Location: ../../pages/auth/register.php'); exit;
//     4. insert into users (name, email, password, role)
//        password = password_hash($request['password'], PASSWORD_BCRYPT)
//        role     = 'member'   (ditulis di kode, BUKAN dari form)
//     5. $pdo->commit(); $_SESSION['success'] = "Registrasi pengguna baru sudah berhasil";
//        header('Location: ../../pages/auth/login.php'); exit;
//   } catch (PDOException $e) { $pdo->rollBack(); throw $e; }
// }
//
// === TAHAP 3 - OTORISASI (terakhir) ===
// Ganti session_start(); dengan:
//   require_once __DIR__ . "/../../middleware/auth.php";
//   requireGuest();
