<?php
// Created by lupix. All rights reserved.

namespace App\RabbitMQ\Receivers;

use App\RabbitMQ\RabbitMQ;
use App\RabbitMQ\Threads\ListenThread;
use PhpAmqpLib\Message\AMQPMessage;

abstract class Receiver extends RabbitMQ
{
    protected $listenThread;
    protected $isListening = false;

    public function listen()
    {
        if(is_null($this->listenThread))
        {
            $this->listenThread = new ListenThread($this);
            $this->listenThread->run();
            $this->isListening = true;
        }
    }

    public function isListening()
    {
        return $this->isListening();
    }

    abstract function onReceive(AMQPMessage $msg);
}