<?php


namespace jdlc\citest\rabbitmq;

class Tasker extends Sender
{
    public function addTask(string $data)
    {
        parent::send($data);
    }
}