<?php


namespace jdlc\citest\rabbitmq;


use ErrorException;

class ExchangeDirect extends Exchange
{
    const TYPE = 'direct';

    /**
     * ExchangeDirect constructor.
     * @param $exchangeName
     * @param $keys
     */
    public function __construct($exchangeName)
    {
        parent::__construct($exchangeName, self::TYPE);
    }

    /**
     * @param string $message
     * @param $key
     */
    public function publish(string $message, $key)
    {
        $this->getChannel()->basic_publish(self::buildMessage($message), $this->getExchangeName(), $key);
        echo " [x] Sent $message\n";
    }

    /**
     * @param $keys
     * @throws ErrorException
     */
    public function receive($keys)
    {
        list($queue_name, ,) = $this->getChannel()->queue_declare("");
        foreach($keys as $key) {
            $this->getChannel()->queue_bind($queue_name, $this->getExchangeName(), $key);
        }
        echo " [*] Waiting for logs. To exit press CTRL+C\n";
        $callback = function ($msg) {
            echo ' [x] ', $msg->body, "\n";
        };
        $this->getChannel()->basic_consume($queue_name, '', false, true, false, false, $callback);
        while (count($this->getChannel()->callbacks)) {
            $this->getChannel()->wait();
        }
    }
}