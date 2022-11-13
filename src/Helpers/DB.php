<?php

namespace App\Helpers;

use PDO;

class DB
{
    private static $pdo;

    private const ENGINE = 'mysql';

    private const HOST = 'localhost';

    private const NAME = 'blog';

    private const USER = 'root';

    private const PASSWORD = 'root';

    private const OPTIONS = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
    ];

    public static function connect(): PDO
    {
        if (!isset(self::$pdo)) 
        {
            self::$pdo = new PDO(
                self::ENGINE . ":host=" . self::HOST . ";dbname=" . self::NAME, 
                self::USER, 
                self::PASSWORD, 
                self::OPTIONS
            );
        }

        return self::$pdo;
    }
}