<?php
/**
 * Created by PhpStorm.
 * User: scrub
 * Date: 22/05/17
 * Time: 14:41
 */

namespace App\RabbitMQ\Receivers;


use App\Models\Traits\SingleInstance;
use PhpAmqpLib\Message\AMQPMessage;

class ClientReservationReceiver extends Receiver
{
    use SingleInstance;

    protected function __construct()
    {
        parent::__construct();
        $this->queue = 'new_HMS_order';
    }

    function onReceive(AMQPMessage $msg)
    {
       // $data = json_decode($msg->body);
    }
}