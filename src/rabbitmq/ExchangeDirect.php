<?php


namespace jdlc\citest\rabbitmq;


use ErrorException;

class ExchangeDirect extends Exchange implements AbstractQueueRead, AbstractQueueWrite
{
    const TYPE = 'direct';

    /** @var string[] */
    private $keys;

    /**
     * ExchangeFanout constructor.
     * @param $exchangeName
     * @param $keys
     */
    public function __construct($exchangeName, $keys)
    {
        parent::__construct($exchangeName, self::TYPE);
        $this->keys = $keys;
    }

    /**
     * @param string $message
     */
    public function publish(string $message)
    {
        $this->getChannel()->basic_publish(self::buildMessage($message), $this->getExchangeName(), $this->keys[0]);
        echo " [x] Sent $message\n";
    }

    /**
     * @throws ErrorException
     */
    public function receive()
    {
        list($queue_name, ,) = $this->getChannel()->queue_declare("");
        foreach($this->keys as $key) {
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