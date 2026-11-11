<?php
require_once __DIR__ . "/../config/database.php";

function getSuppliers()
{
  global $pdo;

  $stmt = $pdo->query("SELECT * FROM suppliers ORDER BY supplier_id DESC");
  return $stmt->fetchAll();
}

function getSupplier($id)
{
  global $pdo;

  $stmt = $pdo->prepare("SELECT * FROM suppliers WHERE supplier_id = :id LIMIT 1");
  $stmt->execute([':id' => intval($id)]);

  $supplier = $stmt->fetch();
  return $supplier ?: false;
}
