<?php


namespace jdlc\citest\rabbitmq;


use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class Sender extends RabbitMQConfig
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
    public function __construct(string $queueName)
    {
        $this->connection = new AMQPStreamConnection(self::HOST, self::PORT, self::USER, self::PASSWORD);
        $this->channel = $this->connection->channel();
        $this->queueName = $queueName;
        $this->channel->queue_declare($this->queueName, false, false, false, false);
    }

    /**
     * @param $message string
     * @param $key
     */
    public function send($message)
    {
        $msg = new AMQPMessage($message);
        $this->channel->basic_publish($msg, '', $this->queueName);
        echo " [x] Sent $message\n";
    }

    public function close()
    {
        $this->channel->close();
        $this->connection->close();
    }
}