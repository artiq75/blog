<?php

namespace App\Controllers\Auth;

use App\Helpers\Auth;
use App\Helpers\DB;
use App\Helpers\Request;
use App\Helpers\Router;
use App\Helpers\Session;

class Register
{
    public static function index(): void
    {
        if (Auth::id()) {
            Router::redirect('home');
        }

        require dirname(__DIR__, 3) . '/views/auth/register.php';
    }

    public static function register()
    {
        if (Auth::id()) {
            Router::redirect('home');
        }

        $username = Request::input('username');
        $email = Request::input('email');
        $password = Request::input('password');

        if (!$username || !$email || !$password) {
            Router::redirect('register.index');
        }

        $password = password_hash($password, PASSWORD_BCRYPT);

        $db = DB::connect();
        $stmt = $db->prepare('INSERT INTO users (username, email, password) VALUES (?,?,?)');
        $isOk = $stmt->execute([$username, $email, $password]);

        if (!$isOk) {
            Router::redirect('register.index');
        }

        // $stmt = $db->prepare('SELECT * FROM users WHERE email = ? AND password = ?');

        Router::redirect('home');
    }
}
