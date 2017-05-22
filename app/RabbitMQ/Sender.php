<?php
// Created by lupix. All rights reserved.

namespace App\RabbitMQ;

use PhpAmqpLib\Message\AMQPMessage;

abstract class Sender extends RabbitMQ
{
    public function send(array $data)
    {
        $this->channel->queue_declare($this->queue, false, false, false, false);
        $msg = new AMQPMessage(json_encode($data['message']));
        $this->channel->basic_publish($msg, '', $this->queue);
    }
}