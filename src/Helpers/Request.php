<?php

namespace App\Helpers;

class Request
{
    public static function input(string $key): ?string
    {
        if (!isset($_REQUEST[$key])) return null;
        
        return htmlentities($_REQUEST[$key]);
    }

    public static function redirect(string $uri): void
    {
        header('Location: ' . $uri);
        exit();
    }
}