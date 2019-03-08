<?php

use jdlc\citest\rabbitmq\Receiver;

include_once 'vendor/autoload.php';

$receiver = new Receiver("task_queue");

try {
    $receiver->receive();
} catch (ErrorException $e) {
    echo $e->getMessage();
}