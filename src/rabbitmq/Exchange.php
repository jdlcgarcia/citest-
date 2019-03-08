<?php


namespace jdlc\citest\rabbitmq;

class Exchange extends Queue
{
    const FANOUT = 'fanout';

    /** @var string */
    private $exchangeName;

    /**
     * @return string
     */
    public function getExchangeName()
    {
        return $this->exchangeName;
    }
}