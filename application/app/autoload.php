<?php

require __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/Container.php';
require_once __DIR__ . '/SplClassLoader.php';

$src_directory = __DIR__ . "/../src";
$d = dir($src_directory);
while (false !== ($entry = $d->read())) {
    if ("." === substr($entry, 0, 1)) {
        continue;
    }
    $namespace = $entry;
    $class_loader = new SplClassLoader($namespace, $src_directory);
    $class_loader->register();
}
