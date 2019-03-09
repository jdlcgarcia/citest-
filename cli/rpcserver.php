<?php


use jdlc\citest\rabbitmq\RPCServer;

include_once '../bootstrap.php';

$server = new RPCServer("rpc");
try {
    $server->receive();
} catch (ErrorException $e) {
    echo $e->getMessage();
}