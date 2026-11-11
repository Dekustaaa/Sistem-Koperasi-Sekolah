<?php
require_once __DIR__ . "/../repositories/product-repository.php";

function productCategories()
{
  return ['Food', 'Drink', 'Stationery', 'Uniform'];
}

function productUnits()
{
  return ['Pcs', 'Pack', 'Bottle'];
}

function getProductRequest($request)
{
  return [
    'product_id'   => intval($request['product_id'] ?? 0),
    'product_code' => trim(htmlspecialchars($request['product_code'] ?? '')),
    'product_name' => trim(htmlspecialchars($request['product_name'] ?? '')),
    'category'     => trim(htmlspecialchars($request['category'] ?? '')),
    'unit'         => trim(htmlspecialchars($request['unit'] ?? '')),
    'price'        => trim(htmlspecialchars($request['price'] ?? '')),
    'stock'        => trim(htmlspecialchars($request['stock'] ?? '')),
    'entry_date'   => trim(htmlspecialchars($request['entry_date'] ?? '')),
    'description'  => trim(htmlspecialchars($request['description'] ?? '')),
  ];
}

function validateProduct($request, $ignoreId = 0)
{
  $errors = [];

  if ($request['product_code'] === '') {
    $errors['product_code'] = 'Kode produk wajib diisi.';
  } elseif (mb_strlen($request['product_code']) > 10) {
    $errors['product_code'] = 'Kode produk maksimal 10 karakter.';
  } elseif (isProductCodeTaken($request['product_code'], $ignoreId)) {
    $errors['product_code'] = 'Kode produk sudah dipakai.';
  }

  if ($request['product_name'] === '') {
    $errors['product_name'] = 'Nama produk wajib diisi.';
  } elseif (mb_strlen($request['product_name']) > 100) {
    $errors['product_name'] = 'Nama produk maksimal 100 karakter.';
  }

  if (!in_array($request['category'], productCategories(), true)) {
    $errors['category'] = 'Kategori harus dipilih sesuai pilihan.';
  }

  if (!in_array($request['unit'], productUnits(), true)) {
    $errors['unit'] = 'Unit harus dipilih sesuai pilihan.';
  }

  if ($request['price'] === '') {
    $errors['price'] = 'Harga wajib diisi.';
  } elseif (!is_numeric($request['price'])) {
    $errors['price'] = 'Harga harus berupa angka.';
  } elseif ((float) $request['price'] < 0) {
    $errors['price'] = 'Harga tidak boleh negatif.';
  }

  if ($request['stock'] === '') {
    $errors['stock'] = 'Stok wajib diisi.';
  } elseif (!preg_match('/^\d+$/', $request['stock'])) {
    $errors['stock'] = 'Stok harus berupa bilangan bulat tidak negatif.';
  }

  if ($request['entry_date'] === '') {
    $errors['entry_date'] = 'Tanggal masuk wajib diisi.';
  } else {
    $date = DateTime::createFromFormat('Y-m-d', $request['entry_date']);
    if (!$date || $date->format('Y-m-d') !== $request['entry_date']) {
      $errors['entry_date'] = 'Format tanggal masuk tidak valid.';
    }
  }

  if (mb_strlen($request['description']) > 1000) {
    $errors['description'] = 'Deskripsi maksimal 1000 karakter.';
  }

  return $errors;
}
