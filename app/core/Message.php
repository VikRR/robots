<?php

namespace robots\app\core;


class Message
{

    private static $message = [];

    public static function includeMess()
    {
        self::$message = include_once ROOT.'/app/config/message.php';
    }

    /**
     * @return array
     */
    public static function getMessage()
    {
        return self::$message;
    }



}