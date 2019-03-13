<?php


namespace jdlc\citest\rabbitmq;


use ErrorException;

interface AbstractQueueRead
{
    /**
     * @throws ErrorException
     */
    public function receive();
}