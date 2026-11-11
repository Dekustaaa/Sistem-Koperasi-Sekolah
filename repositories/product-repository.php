<?php
require_once __DIR__ . "/../config/database.php";

function getProducts()
{
  global $pdo;

  $stmt = $pdo->query("SELECT * FROM products ORDER BY product_id DESC");
  return $stmt->fetchAll();
}

function getProduct($id)
{
  global $pdo;

  $stmt = $pdo->prepare("SELECT * FROM products WHERE product_id = :id LIMIT 1");
  $stmt->execute([':id' => intval($id)]);

  $product = $stmt->fetch();
  return $product ?: false;
}

function isProductCodeTaken($code, $ignoreId = 0)
{
  global $pdo;

  $stmt = $pdo->prepare(
    "SELECT COUNT(product_id) FROM products
     WHERE product_code = :code AND product_id != :id"
  );
  $stmt->execute([
    ':code' => $code,
    ':id'   => intval($ignoreId),
  ]);

  return (int) $stmt->fetchColumn() > 0;
}
