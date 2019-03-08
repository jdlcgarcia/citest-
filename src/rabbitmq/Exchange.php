<?php


namespace jdlc\citest\rabbitmq;

class Exchange extends Queue
{
    const FANOUT = 'fanout';

    /** @var string */
    private $exchangeName;

    /**
     * Exchange constructor.
     * @param string $exchangeName
     */
    public function __construct(string $exchangeName)
    {
        parent::__construct($exchangeName);
        $this->exchangeName = $exchangeName;
    }


    /**
     * @return string
     */
    public function getExchangeName()
    {
        return $this->exchangeName;
    }
}