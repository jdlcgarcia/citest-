<?php

use jdlc\citest\rabbitmq\ExchangeDirect;

include_once '../bootstrap.php';

$severity = isset($argv[1]) && !empty($argv[1]) ? $argv[1] : 'info';

$data = implode(' ', array_slice($argv, 2));
if (empty($data)) {
    $data = "Hello World!";
}

$direct = new ExchangeDirect("logs_severity");
$direct->publish($data, $severity);