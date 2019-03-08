<?php


namespace jdlc\citest\rabbitmq;


use ErrorException;
use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class Exchange extends RabbitMQConfig
{
    const FANOUT = 'fanout';
    /** @var AMQPStreamConnection  */
    private $connection;

    /** @var AMQPChannel  */
    private $channel;

    /** @var string */
    private $exchangeName;

    /**
     * Receiver constructor.
     * @param string $exchangeName
     */
    public function __construct(string $exchangeName)
    {
        $this->connection = new AMQPStreamConnection(self::HOST, self::PORT, self::USER, self::PASSWORD);
        $this->channel = $this->connection->channel();
        $this->exchangeName = $exchangeName;
        $this->channel->exchange_declare($this->exchangeName, self::FANOUT, false, false, false);
    }

    /**
     * @param string $message
     */
    public function publish(string $message)
    {
        $msg = new AMQPMessage($message, ['delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT]);
        $this->channel->basic_publish($msg, $this->exchangeName);
        echo " [x] Sent $message\n";
    }

    /**
     * @throws ErrorException
     */
    public function receive()
    {
        list($queue_name, ,) = $this->channel->queue_declare("");
        $this->channel->queue_bind($queue_name, $this->exchangeName);
        echo " [*] Waiting for logs. To exit press CTRL+C\n";
        $callback = function ($msg) {
            echo ' [x] ', $msg->body, "\n";
        };
        $this->channel->basic_consume($queue_name, '', false, true, false, false, $callback);
        while (count($this->channel->callbacks)) {
            $this->channel->wait();
        }
    }
}