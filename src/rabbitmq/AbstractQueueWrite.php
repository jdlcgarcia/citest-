<?php


namespace jdlc\citest\rabbitmq;


interface AbstractQueueWrite
{
    /**
     * @param string $message
     */
    public function publish(string $message);
}