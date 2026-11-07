<?php
require_once __DIR__ . "/../config/database.php";

function getproducts()
{
  global $pdo;

  // TODO: select * from products order by id  -> fetchAll()
  return [];
}

function getCategory($id)
{
  global $pdo;

  // TODO: select * from products where id = :id  -> fetch()
  //       jika tidak ditemukan: header("Location: ../products/index.php"); exit;
  return false;
}

function isCategoryExists($id)
{
  global $pdo;

  // TODO (dipakai latihan buku): select count(id) from products where id = :id
  return false;
}

function isCategoryNameTaken($name, $ignoreId = 0)
{
  global $pdo;

  // TODO: select count(id) from products where name = :name and id != :id
  //       kembalikan true jika > 0   (gunakan intval($ignoreId))
  return false;
}
