<?php
require_once
  __DIR__ . "/../repositories/category-repository.php";

function getCategoryRequest($request)
{
  // TODO: kembalikan array id, name, description
  //       id memakai ?? '' ; semuanya trim(htmlspecialchars(...))
  return [];
}

// $ignoreId dipakai saat EDIT supaya nama milik produk itu sendiri tidak dianggap duplikat
function validateCategory($request, $ignoreId = 0)
{
  $errors = [];

  // TODO name        : wajib, maksimal 50 karakter, belum dipakai (isCategoryNameTaken + $ignoreId)
  // TODO description : opsional, maksimal 200 karakter

  return $errors;
}
