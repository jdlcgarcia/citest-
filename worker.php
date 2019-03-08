<?php

use jdlc\citest\rabbitmq\Worker;

include_once 'vendor/autoload.php';

$worker = new Worker("task_queue");
try {
    $worker->work();
} catch (ErrorException $e) {
    echo $e->getMessage();
}