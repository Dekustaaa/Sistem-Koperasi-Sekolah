<?php
require_once __DIR__ . "/../config/database.php";

// Repository = tempat query SELECT. Selalu pakai prepared statement!

function isEmailTaken($email)
{
  global $pdo;

  // TODO: select count(id) from users where email = :email
  //       kembalikan true jika hasilnya > 0
  return false;
}

function getUserByEmail($email)
{
  global $pdo;

  // TODO: select * from users where email = :email  -> fetch()
  return false;
}
