<?php
// Created by lupix. All rights reserved.

namespace App\RabbitMQ\Receivers;

use App\RabbitMQ\RabbitMQ;
use App\RabbitMQ\Threads\ListenThread;
use PhpAmqpLib\Message\AMQPMessage;

abstract class Receiver extends RabbitMQ
{
    protected $listenThread;

    public function listen()
    {
        if(!is_null($this->queue))
        {

            if (is_null($this->listenThread)) {
                $this->listenThread = new ListenThread($this);
                $this->listenThread->run();
            }
        }
        else
        {
            echo '[' . __CLASS__ . '] Queue is not defined, aborting listen operation';
        }
    }

    public function isListening()
    {
        return !(is_null($this->listenThread)) && $this->listenThread->isRunning();
    }

    abstract function onReceive(AMQPMessage $msg);
}