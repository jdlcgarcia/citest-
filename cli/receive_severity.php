<?php

use jdlc\citest\rabbitmq\ExchangeDirect;

include_once '../bootstrap.php';

$severities = array_slice($argv, 1);

if (empty($severities)) {
    file_put_contents('php://stderr', "Usage: $argv[0] [info] [warning] [error]\n");
    exit(1);
}

$direct = new ExchangeDirect("logs_severity");

try {
    $direct->receive($severities);
} catch (ErrorException $e) {
    echo $e->getMessage();
}
