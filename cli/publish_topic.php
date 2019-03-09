<?php

use jdlc\citest\rabbitmq\ExchangeTopic;

include_once '../bootstrap.php';

$routing_key = isset($argv[1]) && !empty($argv[1]) ? $argv[1] : 'anonymous.info';

$data = implode(' ', array_slice($argv, 2));
if (empty($data)) {
    $data = "Hello World!";
}

$direct = new ExchangeTopic("topic_log", $routing_key);
$direct->publish($data, $routing_key);