<?php


namespace jdlc\citest\rabbitmq;


use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class Queue
{
    /** @var AMQPStreamConnection  */
    private $connection;

    /** @var AMQPChannel  */
    private $channel;

    /** @var string  */
    private $queueName;

    /**
     * Sender constructor.
     * @param string $queueName
     */
    protected function __construct(string $queueName)
    {
        $this->connection = new AMQPStreamConnection($_ENV['RABBITMQ_HOST'], $_ENV['RABBITMQ_PORT'], $_ENV['RABBITMQ_USER'], $_ENV['RABBITMQ_PASSWD']);
        $this->channel = $this->connection->channel();
        $this->queueName = $queueName;
    }

    /**
     * @return AMQPChannel
     */
    public function getChannel(): AMQPChannel
    {
        return $this->channel;
    }

    /**
     * @return string
     */
    public function getQueueName(): string
    {
        return $this->queueName;
    }

    /**
     * @param $message
     * @param array $config
     * @return AMQPMessage
     */
    public function buildMessage($message, $config = ['delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT]) {
        return new AMQPMessage($message, $config);
    }

    public function close()
    {
        $this->channel->close();
        $this->connection->close();
    }
}