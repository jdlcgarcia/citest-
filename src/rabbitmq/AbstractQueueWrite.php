<?php


namespace jdlc\citest\rabbitmq;


interface AbstractQueueWrite extends AbstractQueue
{
    /**
     * @param string $message
     */
    public function publish(string $message);
}