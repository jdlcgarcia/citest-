<?php

use jdlc\citest\rabbitmq\Receiver;

include_once 'vendor/autoload.php';

$receiver = new Receiver();

try {
    $receiver->receive();
} catch (ErrorException $e) {
    echo $e->getMessage();
}