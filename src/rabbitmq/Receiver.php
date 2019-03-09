<?php


namespace jdlc\citest\rabbitmq;


use ErrorException;

class Receiver extends Queue implements AbstractQueueRead
{
    /**
     * Receiver constructor.
     * @param string $queueName
     */
    public function __construct(string $queueName)
    {
        parent::__construct($queueName);
        $this->getChannel()->queue_declare($this->getQueueName(), false, true, false, false);
    }

    /**
     * @throws ErrorException
     */
    public function receive()
    {
        echo " [*] Waiting for messages. To exit press CTRL+C\n";
        $callback = function ($msg) {
            echo ' [x] Received ', $msg->body, "\n";
        };
        $this->getChannel()->basic_consume($this->getQueueName(), '', false, true, false, false, $callback);
        while (count($this->getChannel()->callbacks)) {
            $this->getChannel()->wait();
        }
    }
}