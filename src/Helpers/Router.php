<?php

namespace App\Helpers;

use AltoRouter;

class Router
{
    private static $router;

    public static function init(): void
    {
        if (!isset(self::$router)) {
            self::$router = new AltoRouter();
        }
    }

    public static function map(string $method, string $route, callable $target, string $name = null): void
    {
        self::init();

        self::$router->map($method, $route, $target, $name);
    }

    public static function match(): array
    {
        self::init();

        return self::$router->match();
    }

    public static function generate(string $routeName, array $params = []): string
    {
        self::init();

        return self::$router->generate($routeName, $params);
    }

    public static function redirect(string $route): void
    {
        $url = self::generate($route);

        if (empty($url)) {
            $url = $route;
        }
        
        header('Location: ' . $url);
        exit();
    }
}
