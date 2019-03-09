<?php


namespace jdlc\citest\rabbitmq;


use ErrorException;

interface AbstractQueueRead extends AbstractQueue
{
    /**
     * @throws ErrorException
     */
    public function receive();
}