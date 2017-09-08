<?php

require_once __DIR__ . "/../app/autoload.php";

$greeting = new \Model\Greeting();
echo json_encode(["message" => $greeting->getMessage()]);
