<?php
require_once __DIR__ . "/../repositories/supplier-repository.php";

function supplierProductTypeOptions()
{
  return ['Food', 'Drink', 'Stationery', 'Uniform'];
}

function decodeProductTypes($value)
{
  if (is_array($value)) {
    return $value;
  }

  if ($value === null || $value === '') {
    return [];
  }

  $decoded = json_decode($value, true);
  return is_array($decoded) ? $decoded : [];
}

function getSupplierRequest($request)
{
  $types = $request['product_types'] ?? [];
  if (!is_array($types)) {
    $types = [];
  }

  $types = array_values(array_filter(array_map(
    fn($type) => trim(htmlspecialchars($type)),
    $types
  )));

  return [
    'supplier_id'      => intval($request['supplier_id'] ?? 0),
    'supplier_name'    => trim(htmlspecialchars($request['supplier_name'] ?? '')),
    'email'            => trim(htmlspecialchars($request['email'] ?? '')),
    'phone'            => trim(htmlspecialchars($request['phone'] ?? '')),
    'address'          => trim(htmlspecialchars($request['address'] ?? '')),
    'product_types'    => $types,
    'partnership_date' => trim(htmlspecialchars($request['partnership_date'] ?? '')),
  ];
}

function validateSupplier($request)
{
  $errors = [];

  if ($request['supplier_name'] === '') {
    $errors['supplier_name'] = 'Nama supplier wajib diisi.';
  } elseif (mb_strlen($request['supplier_name']) > 100) {
    $errors['supplier_name'] = 'Nama supplier maksimal 100 karakter.';
  }

  if ($request['email'] === '') {
    $errors['email'] = 'Email wajib diisi.';
  } elseif (!filter_var($request['email'], FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'Format email tidak valid.';
  } elseif (mb_strlen($request['email']) > 100) {
    $errors['email'] = 'Email maksimal 100 karakter.';
  }

  if ($request['phone'] === '') {
    $errors['phone'] = 'Nomor telepon wajib diisi.';
  } elseif (mb_strlen($request['phone']) > 15) {
    $errors['phone'] = 'Nomor telepon maksimal 15 karakter.';
  } elseif (!preg_match('/^[0-9+\-\s]+$/', $request['phone'])) {
    $errors['phone'] = 'Nomor telepon hanya boleh berisi angka, +, - atau spasi.';
  }

  if ($request['address'] === '') {
    $errors['address'] = 'Alamat wajib diisi.';
  } elseif (mb_strlen($request['address']) > 500) {
    $errors['address'] = 'Alamat maksimal 500 karakter.';
  }

  if (!$request['product_types']) {
    $errors['product_types'] = 'Pilih minimal satu jenis produk.';
  } else {
    $invalid = array_diff($request['product_types'], supplierProductTypeOptions());
    if ($invalid) {
      $errors['product_types'] = 'Jenis produk tidak sesuai pilihan.';
    }
  }

  if ($request['partnership_date'] === '') {
    $errors['partnership_date'] = 'Tanggal kerja sama wajib diisi.';
  } else {
    $date = DateTime::createFromFormat('Y-m-d', $request['partnership_date']);
    if (!$date || $date->format('Y-m-d') !== $request['partnership_date']) {
      $errors['partnership_date'] = 'Format tanggal kerja sama tidak valid.';
    }
  }

  return $errors;
}
