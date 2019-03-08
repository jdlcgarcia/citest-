<?php


namespace jdlc\citest\rabbitmq;

class Exchange extends Queue
{
    /** @var string */
    private $exchangeName;

    /**
     * Exchange constructor.
     * @param string $exchangeName
     * @param $type
     */
    public function __construct(string $exchangeName, $type)
    {
        parent::__construct($exchangeName);
        $this->exchangeName = $exchangeName;
        $this->getChannel()->exchange_declare($this->getExchangeName(), $type, false, false, false);
    }


    /**
     * @return string
     */
    public function getExchangeName()
    {
        return $this->exchangeName;
    }
}