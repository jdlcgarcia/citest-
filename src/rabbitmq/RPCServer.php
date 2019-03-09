<?php


namespace jdlc\citest\rabbitmq;


use ErrorException;
use jdlc\citest\Fibonacci;

class RPCServer extends Queue implements AbstractQueueRead
{
    /**
     * RPCServer constructor.
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
        echo " [x] Awaiting RPC requests\n";
        $callback = function ($req) {
            $n = intval($req->body);
            echo ' [.] fib(', $n, ")\n";
            $fibonacho = new Fibonacci();
            $msg = self::buildMessage((string)$fibonacho->getN($n), ['correlation_id' => $req->get('correlation_id')]);

            $req->delivery_info['channel']->basic_publish(
                $msg,
                '',
                $req->get('reply_to')
            );
            $req->delivery_info['channel']->basic_ack(
                $req->delivery_info['delivery_tag']
            );
        };
        $this->getChannel()->basic_qos(null, 1, null);
        $this->getChannel()->basic_consume($this->getQueueName(), '', false, false, false, false, $callback);
        while (count($this->getChannel()->callbacks)) {
            $this->getChannel()->wait();
        }
    }
}