<?php
// Created by lupix. All rights reserved.

namespace App\RabbitMQ;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Channel\AMQPChannel;

abstract class RabbitMQ
{
    protected $connection;
    protected $channel;
    protected $queue;

    protected function __construct()
    {
        $this->connection = new AMQPStreamConnection('10.3.51.37', 5672, 'invoiceninja', 'secret');
        $this->channel = $this->connection->channel();
    }

    public function __destruct()
    {
        $this->channel->close();
        $this->connection->close();
    }

    public function getQueue()
    {
        return $this->queue;
    }

    public function getChannel()
    {
        return $this->getChannel();
    }
}