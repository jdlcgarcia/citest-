<?php


namespace jdlc\citest\rabbitmq;


use ErrorException;
use jdlc\citest\Fibonacci;

class RPCClient extends Queue implements AbstractQueueWrite
{
    private $callback_queue;
    private $response;
    private $corr_id;
    private $routingKey;

    /**
     * RPCServer constructor.
     * @param string $routingKey
     */
    public function __construct(string $routingKey)
    {
        parent::__construct("");
        list($this->callback_queue, ,) = $this->getChannel()->queue_declare("", false, false, true, false);
        $this->routingKey = $routingKey;
        $this->getChannel()->basic_consume($this->callback_queue, '', false, true, false, false, [$this, 'onResponse']);
    }

    /**
     * @param $rep
     */
    public function onResponse($rep)
    {
        if ($rep->get('correlation_id') == $this->corr_id) {
            $this->response = $rep->body;
        }
    }

    /**
     * @param string $message
     * @return int
     * @throws ErrorException
     */
    public function publish(string $message)
    {
        $this->response = null;
        $this->corr_id = uniqid();

        $msg = self::buildMessage($message, [
                'correlation_id' => $this->corr_id,
                'reply_to' => $this->callback_queue
            ]
        );
        $this->getChannel()->basic_publish($msg, '', $this->routingKey);
        echo ' [.] Requesting fib(', $message, ")\n";
        while (!$this->response) {
            $this->getChannel()->wait();
        }
        return intval($this->response);
    }
}