<?php
// Created by lupix. All rights reserved.

namespace App\RabbitMQ;

use PhpAmqpLib\Message\AMQPMessage;

class Receiver extends RabbitMQ
{
    public function receive(string $queue, callable $callback)
    {
        $this->channel->queue_declare($queue, false, false, false, false);
        $this->channel->basic_consume($queue, '', false, true, false, false, function(AMQPMessage $msg) use($callback) { $callback($msg); });

        while(count($this->channel->callbacks))
        {
            $this->channel->wait();
        }

    }
}