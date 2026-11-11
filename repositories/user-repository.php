<?php
require_once __DIR__ . "/../config/database.php";

function isEmailTaken($email, $ignoreId = 0)
{
  global $pdo;

  $stmt = $pdo->prepare(
    "SELECT COUNT(id) FROM users WHERE email = :email AND id != :id"
  );
  $stmt->execute([
    ':email' => $email,
    ':id'    => intval($ignoreId),
  ]);

  return (int) $stmt->fetchColumn() > 0;
}

function getUserByEmail($email)
{
  global $pdo;

  $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
  $stmt->execute([':email' => $email]);

  $user = $stmt->fetch();
  return $user ?: false;
}

function createUser($name, $email, $password, $role = 'member')
{
  global $pdo;

  $stmt = $pdo->prepare(
    "INSERT INTO users (name, email, password, role)
     VALUES (:name, :email, :password, :role)"
  );

  return $stmt->execute([
    ':name'     => $name,
    ':email'    => $email,
    ':password' => $password,
    ':role'     => $role,
  ]);
}

function verifyUserPassword($user, $password)
{
  return hash_equals($user['password'] ?? '', (string) $password);
}
