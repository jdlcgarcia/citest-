<?php

use jdlc\citest\rabbitmq\Worker;

include_once '../bootstrap.php';

$worker = new Worker("task_queue");
try {
    $worker->work();
} catch (ErrorException $e) {
    echo $e->getMessage();
}