<?php
// Created by lupix. All rights reserved.

namespace App\Models\Traits;


trait SingleInstance
{
    private static $instance;

    private function __clone()
    {
        // TODO: Implement __clone() method.
    }

    private function __wakeup()
    {
        // TODO: Implement __wakeup() method.
    }

    public static function getInstance()
    {
        if(is_null(self::$instance))
            self::$instance = new self();

        return self::$instance;
    }
}