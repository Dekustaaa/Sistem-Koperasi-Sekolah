<?php
require_once
  __DIR__ . "/../repositories/category-repository.php";

function getCategoryRequest($request)
{

  return [
    'product_code' => trim(htmlspecialchars($request['code'] ?? '')),
    'product_name' => trim(htmlspecialchars($request['name'] ?? '')),
    'category' => trim(htmlspecialchars($request['category'] ?? '')),
    'unit' => trim(htmlspecialchars($request['unit'] ?? '')),
    'price' => trim(htmlspecialchars($request['price'] ?? '')),
    'stock' => trim(htmlspecialchars($request['stock'] ?? '')),
    'entry_date' => trim(htmlspecialchars($request['entry_date'] ?? '')),
    'description' => trim(htmlspecialchars($request['description'] ?? '')),
  ];
}

function validateCategory($request, $ignoreId = 0)
{
  $errors = [];

  return $errors;
}
