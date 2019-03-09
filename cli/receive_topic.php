<?php

use jdlc\citest\rabbitmq\ExchangeTopic;

include_once '../bootstrap.php';

$binding_keys = array_slice($argv, 1);

if (empty($binding_keys)) {
    file_put_contents('php://stderr', "Usage: $argv[0] [binding_key]\n");
    exit(1);
}

$direct = new ExchangeTopic("topic_log");

try {
    $direct->receive($binding_keys);
} catch (ErrorException $e) {
    echo $e->getMessage();
}
