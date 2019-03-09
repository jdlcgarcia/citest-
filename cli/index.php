<?php
include_once '../bootstrap.php';

use jdlc\citest\Hello;
use jdlc\citest\rabbitmq\Sender;


$hello = new Hello();
$sender = new Sender("task_queue");
$sender->publish($hello->hi());