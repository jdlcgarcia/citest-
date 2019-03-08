<?php
use jdlc\citest\rabbitmq\Exchange;

include_once 'vendor/autoload.php';

$exchange = new Exchange("logs");
try {
    $exchange->receive();
} catch (ErrorException $e) {
    echo $e->getMessage();
}