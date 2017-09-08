<?php

require_once __DIR__ . "/../../app/autoload.php";

$product = new \Model\Product();
$product->create();

$product->truncate();

$product->insert("test product!!");
