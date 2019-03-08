<?php

use jdlc\citest\rabbitmq\Exchange;

include_once 'vendor/autoload.php';

$data = implode(' ', array_slice($argv, 1));
if (empty($data)) {
    $data = "Hello World!";
}

$exchange = new Exchange("logs");
$exchange->publish($data);