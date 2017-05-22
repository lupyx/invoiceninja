<?php
// Created by lupix. All rights reserved.

namespace App\RabbitMQ;

use PhpAmqpLib\Message\AMQPMessage;

abstract class Receiver extends RabbitMQ
{
    public function listen()
    {
        $this->channel->queue_declare($this->queue, false, false, false, false);
        $this->channel->basic_consume($this->queue, '', false, true, false, false, function(AMQPMessage $msg) { $this->onReceive($msg); });

        while(count($this->channel->callbacks))
        {
            $this->channel->wait();
        }

    }

    abstract function onReceive(AMQPMessage $msg);
}