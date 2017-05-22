<?php
// Created by lupix. All rights reserved.

namespace App\RabbitMQ\Receivers;

use App\Models\Currency;
use App\Models\Traits\SingleInstance;
use PhpAmqpLib\Message\AMQPMessage;

class FoodOrderReceiver extends Receiver
{
    use SingleInstance;

    protected function __construct()
    {
        parent::__construct();
        $this->queue = 'new_POS_order';
    }

    function onReceive(AMQPMessage $msg)
    {
       /* $data = json_decode($msg->body);
        $currency = Currency::where('name', $data->currency)->first();

        if(is_null($currency))
            $currency = Currency::create(['name' => $currency]);*/
    }


}