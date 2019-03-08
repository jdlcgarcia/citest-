<?php


namespace jdlc\citest\rabbitmq;


use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class Sender
{
    /** @var AMQPStreamConnection  */
    private $connection;

    /** @var AMQPChannel  */
    private $channel;

    /**
     * Sender constructor.
     */
    public function __construct()
    {
        $this->connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
        $this->channel = $this->connection->channel();

    }

    /**
     * @param $message string
     */
    public function send($message)
    {
        $this->channel->queue_declare('hello', false, false, false, false);
        $msg = new AMQPMessage($message);
        $this->channel->basic_publish($msg, '', 'hello');
        echo " [x] Sent $message\n";
    }

    public function close()
    {
        $this->channel->close();
        $this->connection->close();
    }
}