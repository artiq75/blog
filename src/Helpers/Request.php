<?php

namespace App\Helpers;

class Request
{
    public static function input(string $key): ?string
    {
        return htmlspecialchars($_REQUEST[$key] ?? null);
    }

    public static function boolean(string $key): bool
    {
        $input = $_REQUEST[$key] ?? false;
        
        return filter_var($input, FILTER_VALIDATE_BOOLEAN);
    }
}