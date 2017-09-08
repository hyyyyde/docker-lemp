<?php

require __DIR__ . '/autoload.php';

Container::setEnvironment("test");

putenv("MYSQL_MASTER_DB_NAME=docker_test");
