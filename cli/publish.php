<?php

use jdlc\citest\rabbitmq\ExchangeFanout;

include_once '../bootstrap.php';

$data = implode(' ', array_slice($argv, 1));
if (empty($data)) {
    $data = "Hello World!";
}

$fanout = new ExchangeFanout("logs");
$fanout->publish($data);