CREATE DATABASE IF NOT EXISTS db_cooperative
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE db_cooperative;

DROP TABLE IF EXISTS users;
CREATE TABLE users (
  id         INT PRIMARY KEY AUTO_INCREMENT,
  name       VARCHAR(100) NOT NULL,
  email      VARCHAR(100) NOT NULL UNIQUE,
  password   VARCHAR(255) NOT NULL,
  role       ENUM('admin', 'member') NOT NULL DEFAULT 'member',
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO users (name, email, password, role) VALUES
('Administrator', 'admin@sks.test', 'admin123', 'admin'),
('Siswa Demo', 'siswa@sks.test', 'admin123', 'member');

DROP TABLE IF EXISTS products;
CREATE TABLE products (
  product_id   INT PRIMARY KEY AUTO_INCREMENT,
  product_code VARCHAR(10) NOT NULL UNIQUE,
  product_name VARCHAR(100) NOT NULL,
  category     ENUM('Food', 'Drink', 'Stationery', 'Uniform') NOT NULL,
  unit         ENUM('Pcs', 'Pack', 'Bottle') NOT NULL,
  price        DECIMAL(10, 2) NOT NULL DEFAULT 0,
  stock        INT NOT NULL DEFAULT 0,
  entry_date   DATE NOT NULL,
  description  TEXT NULL
);

INSERT INTO products (product_code, product_name, category, unit, price, stock, entry_date, description) VALUES
('PRD001', 'Buku Tulis', 'Stationery', 'Pcs', 5000.00, 100, '2026-01-05', 'Buku tulis 38 lembar'),
('PRD002', 'Air Mineral', 'Drink', 'Bottle', 4000.00, 60, '2026-01-06', 'Air mineral 600 ml'),
('PRD003', 'Roti Bakar', 'Food', 'Pack', 8000.00, 30, '2026-01-07', 'Roti bakar isi cokelat'),
('PRD004', 'Seragam Olahraga', 'Uniform', 'Pcs', 85000.00, 20, '2026-01-08', 'Seragam olahraga sekolah');

DROP TABLE IF EXISTS suppliers;
CREATE TABLE suppliers (
  supplier_id      INT PRIMARY KEY AUTO_INCREMENT,
  supplier_name    VARCHAR(100) NOT NULL,
  email            VARCHAR(100) NOT NULL,
  phone            VARCHAR(15) NOT NULL,
  address          TEXT NOT NULL,
  product_types    VARCHAR(100) NOT NULL,
  partnership_date DATE NOT NULL
);

INSERT INTO suppliers (supplier_name, email, phone, address, product_types, partnership_date) VALUES
('CV Sumber Makmur', 'sales@sumbermakmur.test', '081234567890', 'Jl. Merdeka No. 10, Pontianak', '["Food","Drink"]', '2025-07-01'),
('Toko Alat Tulis Ceria', 'cs@atkceria.test', '089876543210', 'Jl. Gajah Mada No. 22, Pontianak', '["Stationery","Uniform"]', '2025-08-15');

DROP TABLE IF EXISTS employees;
CREATE TABLE employees (
  employee_id     INT PRIMARY KEY AUTO_INCREMENT,
  employee_number VARCHAR(10) NOT NULL UNIQUE,
  full_name       VARCHAR(100) NOT NULL,
  gender          ENUM('M', 'F') NOT NULL,
  birth_date      DATE NOT NULL,
  position        ENUM('Cashier', 'Warehouse Staff', 'Admin') NOT NULL,
  salary          DECIMAL(12, 2) NOT NULL DEFAULT 0
);

INSERT INTO employees (employee_number, full_name, gender, birth_date, position, salary) VALUES
('EMP001', 'Andi Saputra', 'M', '2005-03-12', 'Cashier', 2500000.00),
('EMP002', 'Maria Lestari', 'F', '2006-06-20', 'Warehouse Staff', 2300000.00),
('EMP003', 'Yohanes Pratama', 'M', '2004-11-02', 'Admin', 3000000.00);
