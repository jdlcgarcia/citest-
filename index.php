<?php
include_once 'vendor/autoload.php';

use jdlc\citest\Hello;
use jdlc\citest\rabbitmq\Sender;


$hello = new Hello();
$sender = new Sender("task_queue");
$sender->send($hello->hi());