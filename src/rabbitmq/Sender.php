<?php


namespace jdlc\citest\rabbitmq;

class Sender extends Queue implements AbstractQueueWrite
{
    /**
     * Sender constructor.
     * @param string $queueName
     */
    public function __construct(string $queueName)
    {
        parent::__construct($queueName);
        $this->getChannel()->queue_declare($this->getQueueName(), false, true, false, false);
    }

    /**
     * @param string $message
     */
    public function publish(string $message)
    {
        $this->getChannel()->basic_publish(self::buildMessage($message), '', $this->getQueueName());
        echo " [x] Sent $message\n";
    }
}