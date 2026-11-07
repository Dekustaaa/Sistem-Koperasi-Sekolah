<?php
require_once
  __DIR__ . "/../repositories/category-repository.php";

function getCategoryRequest($request)
{
  // TODO: kembalikan array id, name, description
  //       id memakai ?? '' ; semuanya trim(htmlspecialchars(...))
  return [
    'name' => trim($request['name']),
    'description' => trim($request['description'])
  ];
}

// $ignoreId dipakai saat EDIT supaya nama milik kategori itu sendiri tidak dianggap duplikat
function validateCategory($request, $ignoreId = 0)
{
  $errors = [];

  // TODO name        : wajib, maksimal 50 karakter, belum dipakai (isCategoryNameTaken + $ignoreId)
  // TODO description : opsional, maksimal 200 karakter

  return $errors;
}
