<?php
// Created by lupix. All rights reserved.

namespace App\RabbitMQ;

use PhpAmqpLib\Message\AMQPMessage;

class Sender extends RabbitMQ
{
    public function send(array $params)
    {
        $queue = $params['queue'];
        $this->channel->queue_declare($queue, false, false, false, false);
        $msg = new AMQPMessage(json_encode($params['data']['message']));
        $this->channel->basic_publish($msg, '', $queue);
    }
}