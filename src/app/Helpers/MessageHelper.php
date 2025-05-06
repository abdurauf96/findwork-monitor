<?php

namespace App\Helpers;

class MessageHelper
{
    public static function set($message, $type = 'info', $timer = 15)
    {
        session()->put('_message', $message);
        session()->put('_type', $type);
        session()->put('_timer', $timer * 1000);
    }

    public static function success($message, $timer = 15)
    {
        self::set($message, 'success', $timer);
    }

    public static function error($message, $timer = 15)
    {
        self::set($message, 'error', $timer);
    }

    public static function warning($message, $timer = 15)
    {
        self::set($message, 'warning', $timer);
    }

    public static function info($message, $timer = 15)
    {
        self::set($message, 'info', $timer);
    }

    public static function clear()
    {
        session()->pull('_message');
        session()->pull('_type');
        session()->pull('_timer');
    }
}
