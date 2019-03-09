<?php


namespace jdlc\citest\rabbitmq;


use ErrorException;
use PhpAmqpLib\Message\AMQPMessage;

class Worker extends Receiver
{
    /**
     * @throws ErrorException
     */
    public function work()
    {
        $callback = function (AMQPMessage $msg) {
            echo ' [x] Received ', $msg->body, "\n";
            sleep(substr_count($msg->body, '.'));
            echo " [x] Done\n";
            $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
        };
        $this->getChannel()->basic_qos(null, 1, null);
        $this->getChannel()->basic_consume($this->getQueueName(), '', false, false, false, false, $callback);
        while (count($this->getChannel()->callbacks)) {
            $this->getChannel()->wait();
        }
    }
}