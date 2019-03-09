<?php


namespace jdlc\citest\rabbitmq;


use ErrorException;

class ExchangeFanout extends Exchange implements AbstractQueueRead, AbstractQueueWrite
{
    const TYPE = 'fanout';

    /**
     * ExchangeFanout constructor.
     * @param $exchangeName
     */
    public function __construct($exchangeName)
    {
        parent::__construct($exchangeName, self::TYPE);
    }

    /**
     * @param string $message
     */
    public function publish(string $message)
    {
        $this->getChannel()->basic_publish(self::buildMessage($message), $this->getExchangeName());
        echo " [x] Sent $message\n";
    }

    /**
     * @throws ErrorException
     */
    public function receive()
    {
        list($queue_name, ,) = $this->getChannel()->queue_declare("");
        $this->getChannel()->queue_bind($queue_name, $this->getExchangeName());
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