<?php
require_once
  __DIR__ . "/../repositories/user-repository.php";

// Pola: getXxxRequest() membersihkan input, validateXxx() mengembalikan array $errors.

function getRegisterRequest($request)
{
  // TODO: kembalikan array name, email, password, password_confirmation
  //       name & email: trim(htmlspecialchars(...)); password TIDAK di-htmlspecialchars
  return [];
}

function validateRegister($request)
{
  $errors = [];

  // TODO name  : wajib, maksimal 100 karakter
  // TODO email : wajib, format valid (filter_var + FILTER_VALIDATE_EMAIL), belum terdaftar
  // TODO password : wajib, minimal 8 karakter
  // TODO password_confirmation : harus sama dengan password
  // Format: $errors['nama_field'] = "Pesan error";

  return $errors;
}

function getLoginRequest($request)
{
  // TODO: kembalikan array email dan password
  return [];
}

function validateLogin($request)
{
  $errors = [];

  // TODO email    : wajib diisi
  // TODO password : wajib diisi

  return $errors;
}
