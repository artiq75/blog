<?php

namespace App\Controllers\Auth;

use App\Helpers\Auth;
use App\Helpers\DB;
use App\Helpers\Request;
use App\Helpers\Router;
use App\Helpers\Session;

class Login
{
    public static function index(): void
    {
        if (Auth::id()) {
            Router::redirect('home');
        }

        require dirname(__DIR__, 3) . '/views/auth/login.php';
    }

    public static function login()
    {
        if (Auth::id()) {
            Router::redirect('home');
        }

        $email = Request::input('email');
        $password = Request::input('password');

        if (!$email || !$password) {
            Router::redirect('login.index');
        }

        $db = DB::connect();
        $stmt = $db->prepare('SELECT * FROM users WHERE email = ?');
        !$stmt->execute([$email, $password]);
        $user = $stmt->fetch();

        if ($user === false) {
            Router::redirect('login.index');
        }

        if (!password_verify($password, $user->password)) {
            Router::redirect('login.index');
        }

        Session::set(['auth' => $user->id]);

        Router::redirect('home');
    }

    public static function logout(): void
    {
        if (!Auth::id()) {
            Router::redirect('home');
        }

        Session::start();
        session_destroy();

        Router::redirect('home');
    }
}
