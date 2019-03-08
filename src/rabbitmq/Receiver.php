<?php


namespace jdlc\citest\rabbitmq;


use ErrorException;
use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class Receiver extends RabbitMQConfig
{
    /** @var AMQPStreamConnection  */
    private $connection;

    /** @var AMQPChannel  */
    private $channel;

    /** @var string */
    private $queueName;

    /**
     * Receiver constructor.
     * @param string $queueName
     */
    public function __construct(string $queueName)
    {
        $this->connection = new AMQPStreamConnection(self::HOST, self::PORT, self::USER, self::PASSWORD);
        $this->channel = $this->connection->channel();
        $this->queueName = $queueName;
        $this->channel->queue_declare($this->queueName, false, false, false, false);
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
        $this->channel->basic_consume($this->queueName, '', false, true, false, false, $callback);
        while (count($this->channel->callbacks)) {
            $this->channel->wait();
        }
    }
}