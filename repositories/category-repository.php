<?php
require_once __DIR__ . "/../config/database.php";

function getCategories()
{
  global $pdo;

  return [];
}

function getCategory($id)
{
  global $pdo;

  return false;
}

function isCategoryExists($id)
{
  global $pdo;

  return false;
}

function isCategoryNameTaken($name, $ignoreId = 0)
{
  global $pdo;

  return false;
}
