<?php
// ======================================================
// MIDDLEWARE: penjaga halaman
//
// TAHAP 2 - AUTENTIKASI: konstanta URL, startSession, isLoggedIn, getAuthUser
// TAHAP 3 - OTORISASI (terakhir): hasRole, requireAuth, requireRole, requireGuest
// ======================================================

// ---------- TAHAP 2 ----------
// TODO 1: buat 3 konstanta URL
//   LOGIN_URL     = '/pages/auth/login.php'
//   HOME_URL      = '/pages/categories/index.php'
//   FORBIDDEN_URL = '/pages/errors/403.php'

function startSession()
{
  // TODO 2: session_start() HANYA jika session belum aktif
  //         (cek: session_status() === PHP_SESSION_NONE)
}

function isLoggedIn()
{
  // TODO 3: startSession(), lalu cek $_SESSION['user']['id'] sudah ada
  return false;
}

function getAuthUser()
{
  // TODO 4: startSession(), kembalikan $_SESSION['user'] (atau null)
  return null;
}

// ---------- TAHAP 3 ----------
function hasRole(array $roles)
{
  // TODO 5: ambil user dengan getAuthUser(); true jika user ada DAN
  //         role-nya ada di $roles (in_array)
  return false;
}

function requireAuth()
{
  // TODO 6: jika belum login -> simpan 'Silakan login dulu' ke
  //         $_SESSION['errors']['login'], lalu
  //         header('Location: ' . LOGIN_URL); exit;
}

function requireRole(array $roles)
{
  // TODO 7: requireAuth() dulu; jika role TIDAK sesuai ->
  //         header('Location: ' . FORBIDDEN_URL); exit;
}

function requireGuest()
{
  // TODO 8: jika sudah login -> header('Location: ' . HOME_URL); exit;
}
