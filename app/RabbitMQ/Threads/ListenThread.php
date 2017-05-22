<?php
// Created by lupix. All rights reserved.

namespace App\RabbitMQ\Threads;

use App\RabbitMQ\Receivers\Receiver;
use Thread;
use PhpAmqpLib\Message\AMQPMessage;

class ListenThread extends Thread
{
    private $receiver;

    public function __construct(Receiver $receiver)
    {
        $this->receiver = $receiver;
    }

    public function run()
    {
        $this->receiver->getChannel()->queue_declare($this->receiver->getQueue(), false, false, false, false);
        $this->receiver->getChannel()->basic_consume($this->receiver->getQueue(), '', false, true, false, false, function(AMQPMessage $msg) { $this->receiver->onReceive($msg); });

        while(count($this->receiver->getChannel()->callbacks))
        {
            $this->receiver->getChannel()->wait();
        }
    }
}