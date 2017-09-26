<?php

require_once __DIR__ . "/../app/autoload.php";

$product = new \Model\Product();
$stmt = $product->getAll();


foreach ($stmt as $row) {
    $rows[] = $row;
}

if (isset($rows)) {
    echo json_encode($rows);
} else {
    echo "Not found products." . PHP_EOL;
}
