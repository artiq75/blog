<?php

namespace App\Helpers;

class Session
{
    public static function isStart()
    {
        return session_status() === PHP_SESSION_ACTIVE;
    }

    public static function start()
    {
        if (!self::isStart())
        {
            session_start();
        }
    }

    public static function set(array $params): void
    {
        self::start();

        $_SESSION = array_merge($_SESSION, $params);
    }

    public static function get(string $key)
    {
        self::start();
        
        return $_SESSION[$key] ?? null;
    }
}