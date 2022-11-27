<?php

namespace App\Controllers\Auth;

use App\Helpers\DB;
use App\Helpers\Router;
use App\Helpers\Session;

class Auth
{
    public static function id(): ?int
    {
        return Session::get('auth');
    }

    public static function user(): ?object
    {
        $id = self::id();
        $user = null;
        
        if ($id) {
            $db = DB::connect();
            $stmt = $db->prepare('SELECT * FROM users WHERE id = ?');
            $stmt->execute([$id]);
            $user = $stmt->fetchObject();
        }

        return $user;
    }

    public static function check(): bool
    {
        return self::id() !== null;
    }
    
    public static function logout(): void
    {
        if (!self::id()) {
            Router::redirect('home');
        }

        Session::start();
        session_destroy();

        Router::redirect('home');
    }
}
