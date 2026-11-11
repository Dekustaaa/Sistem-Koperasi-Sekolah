<?php
require_once __DIR__ . "/../repositories/employee-repository.php";

function employeeGenders()
{
  return ['M', 'F'];
}

function employeePositions()
{
  return ['Cashier', 'Warehouse Staff', 'Admin'];
}

function employeeGenderLabel($gender)
{
  return $gender === 'M' ? 'Laki-laki' : ($gender === 'F' ? 'Perempuan' : '-');
}

function getEmployeeRequest($request)
{
  return [
    'employee_id'     => intval($request['employee_id'] ?? 0),
    'employee_number' => trim(htmlspecialchars($request['employee_number'] ?? '')),
    'full_name'       => trim(htmlspecialchars($request['full_name'] ?? '')),
    'gender'          => trim(htmlspecialchars($request['gender'] ?? '')),
    'birth_date'      => trim(htmlspecialchars($request['birth_date'] ?? '')),
    'position'        => trim(htmlspecialchars($request['position'] ?? '')),
    'salary'          => trim(htmlspecialchars($request['salary'] ?? '')),
  ];
}

function validateEmployee($request)
{
  $errors = [];

  if ($request['employee_number'] === '') {
    $errors['employee_number'] = 'Nomor pegawai wajib diisi.';
  } elseif (mb_strlen($request['employee_number']) > 10) {
    $errors['employee_number'] = 'Nomor pegawai maksimal 10 karakter.';
  } elseif (isEmployeeNumberTaken($request['employee_number'], $request['employee_id'])) {
    $errors['employee_number'] = 'Nomor pegawai sudah dipakai.';
  }

  if ($request['full_name'] === '') {
    $errors['full_name'] = 'Nama lengkap wajib diisi.';
  } elseif (mb_strlen($request['full_name']) > 100) {
    $errors['full_name'] = 'Nama lengkap maksimal 100 karakter.';
  }

  if (!in_array($request['gender'], employeeGenders(), true)) {
    $errors['gender'] = 'Jenis kelamin harus dipilih.';
  }

  if ($request['birth_date'] === '') {
    $errors['birth_date'] = 'Tanggal lahir wajib diisi.';
  } else {
    $date = DateTime::createFromFormat('Y-m-d', $request['birth_date']);
    if (!$date || $date->format('Y-m-d') !== $request['birth_date']) {
      $errors['birth_date'] = 'Format tanggal lahir tidak valid.';
    } elseif ($date > new DateTime('today')) {
      $errors['birth_date'] = 'Tanggal lahir tidak boleh di masa depan.';
    }
  }

  if (!in_array($request['position'], employeePositions(), true)) {
    $errors['position'] = 'Jabatan harus dipilih sesuai pilihan.';
  }

  if ($request['salary'] === '') {
    $errors['salary'] = 'Gaji wajib diisi.';
  } elseif (!is_numeric($request['salary'])) {
    $errors['salary'] = 'Gaji harus berupa angka.';
  } elseif ((float) $request['salary'] < 0) {
    $errors['salary'] = 'Gaji tidak boleh negatif.';
  }

  return $errors;
}
