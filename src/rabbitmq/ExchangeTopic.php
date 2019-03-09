<?php


namespace jdlc\citest\rabbitmq;


use ErrorException;

class ExchangeTopic extends Exchange
{
    const TYPE = 'topic';

    /**
     * ExchangeTopic constructor.
     * @param $exchangeName
     * @param $keys
     */
    public function __construct($exchangeName)
    {
        parent::__construct($exchangeName, self::TYPE);
    }

    /**
     * @param string $message
     * @param $routingKey
     */
    public function publish(string $message, $routingKey)
    {
        $this->getChannel()->basic_publish(self::buildMessage($message), $this->getExchangeName(), $routingKey);
        echo ' [x] Sent ', $routingKey, ':', $message, "\n";
    }

    /**
     * @param string[] $routingKeys
     * @throws ErrorException
     */
    public function receive($routingKeys)
    {
        list($queue_name, ,) = $this->getChannel()->queue_declare("");
        foreach($routingKeys as $key) {
            $this->getChannel()->queue_bind($queue_name, $this->getExchangeName(), $key);
        }
        echo " [*] Waiting for logs. To exit press CTRL+C\n";
        $callback = function ($msg) {
            echo ' [x] ', $msg->delivery_info['routing_key'], ':', $msg->body, "\n";
        };
        $this->getChannel()->basic_consume($queue_name, '', false, true, false, false, $callback);
        while (count($this->getChannel()->callbacks)) {
            $this->getChannel()->wait();
        }
    }
}