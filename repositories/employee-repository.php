<?php
require_once __DIR__ . "/../config/database.php";

function getEmployees()
{
  global $pdo;

  $stmt = $pdo->query("SELECT * FROM employees ORDER BY employee_id DESC");
  return $stmt->fetchAll();
}

function getEmployee($id)
{
  global $pdo;

  $stmt = $pdo->prepare("SELECT * FROM employees WHERE employee_id = :id LIMIT 1");
  $stmt->execute([':id' => intval($id)]);

  $employee = $stmt->fetch();
  return $employee ?: false;
}

function isEmployeeNumberTaken($number, $ignoreId = 0)
{
  global $pdo;

  $stmt = $pdo->prepare(
    "SELECT COUNT(employee_id) FROM employees
     WHERE employee_number = :number AND employee_id != :id"
  );
  $stmt->execute([
    ':number' => $number,
    ':id'     => intval($ignoreId),
  ]);

  return (int) $stmt->fetchColumn() > 0;
}
