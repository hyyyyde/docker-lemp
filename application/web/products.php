<?php

require_once __DIR__ . "/../app/autoload.php";

$product = new \Model\Product();
$product_array = $product->getAll();

if (!$product_array) {
    echo "Not found products";
}

foreach ($product_array as $row) {
    echo sprintf("[id: %s] [name: %s]<br>\n", $row["id"], $row["name"]);
}
