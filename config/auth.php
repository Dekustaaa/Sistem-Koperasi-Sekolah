<?php

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

function authUser()
{
  return $_SESSION['user'] ?? null;
}

function authCheck()
{
  return authUser() !== null;
}

function authIsAdmin()
{
  return (authUser()['role'] ?? '') === 'admin';
}

function requireLogin()
{
  if (!authCheck()) {
    $_SESSION['errors']['login'] = 'Silakan login terlebih dahulu.';
    header('Location: /pages/auth/login.php');
    exit;
  }
}

function requireAdmin()
{
  requireLogin();
  if (!authIsAdmin()) {
    $_SESSION['errors']['delete'] = 'Hanya admin yang boleh melakukan aksi ini.';
    header('Location: /pages/products/index.php');
    exit;
  }
}

function requireGuest()
{
  if (authCheck()) {
    header('Location: /pages/products/index.php');
    exit;
  }
}

function pullFlash()
{
  $flash = [
    'success' => $_SESSION['success'] ?? '',
    'errors'  => $_SESSION['errors'] ?? [],
    'old'     => $_SESSION['old'] ?? [],
  ];
  unset($_SESSION['success'], $_SESSION['errors'], $_SESSION['old']);
  return $flash;
}
