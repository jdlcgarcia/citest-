<?php

use jdlc\citest\rabbitmq\RPCClient;

include_once '../bootstrap.php';

$data = implode(' ', array_slice($argv, 1));
if (empty($data)) {
    $data = "30";
}

$client = new RPCClient("rpc");
try {
    $response = $client->publish($data);
    echo ' [.] Got ', $response, "\n";
} catch (ErrorException $e) {
    echo $e->getMessage();
}
