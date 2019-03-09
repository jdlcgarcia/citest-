<?php

use jdlc\citest\rabbitmq\ExchangeFanout;

include_once '../bootstrap.php';

$fanout = new ExchangeFanout("logs");
try {
    $fanout->receive();
} catch (ErrorException $e) {
    echo $e->getMessage();
}