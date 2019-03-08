<?php

use jdlc\citest\rabbitmq\Tasker;

include_once '../bootstrap.php';

$data = implode(' ', array_slice($argv, 1));
if (empty($data)) {
    $data = "Hello World!";
}

$tasker = new Tasker("task_queue");
$tasker->addTask($data);