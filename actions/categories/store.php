<?php
require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../validations/category-validation.php";

if(isset($_POST['store']) && $_SERVER['REQUEST_METHOD'] === "POST") {
    try {

        $request = getCategoryRequest($_POST);
        $query = "INSERT INTO products (product_code, product_name, category, unit, price, stock, entry_date, description) 
                    values(:product_code,:product_name, :category, :unit, :price, :stock, :entry_date, :description)";
        $stmt = $pdo->query("SHOW COLUMNS FROM products LIKE 'category'");
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        preg_match("/^enum\((.*)\)$/", $row['Type'], $matches);
        $categories = str_getcsv($matches[1], ",", "'");
        $stmt = $pdo -> prepare($query);
        $stmt->execute([
                        "product_code" => $request['product_code'],
                        "product_name" => $request['product_name'],
                        "category"     => $request['category'],
                        "unit"         => $request['unit'],
                        "price"        => $request['price'],
                        "stock"        => $request['stock'],
                        "entry_date"   => $request['entry_date'],
                        "description"  => $request['description']
                    ]);
        header('location: ../../pages/categories/index.php');
        exit;
    } catch(PDOException $e) {
        throw $e;
    }

}
