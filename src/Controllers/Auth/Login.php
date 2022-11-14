<?php

namespace App\Controllers\Auth;

use App\Helpers\DB;
use App\Helpers\Request;
use App\Helpers\Router;
use App\Helpers\Session;

class Login
{
    public static function index(): void
    {
        require dirname(__DIR__, 3) . '/views/auth/login.php';
    }

    public static function login()
    {
        $email = Request::input('email');
        $password = Request::input('password');

        if (!$email || !$password) {
            Router::redirect('/connexion');
        }

        $db = DB::connect();
        $stmt = $db->prepare('SELECT * FROM users WHERE email = ? AND password = ?');
        !$stmt->execute([$email, $password]);
        $user = $stmt->fetch();

        if ($user === false) {
            Router::redirect('/connexion');
        }

        // if (!password_verify($password, $user->password)) {
        //     Router::redirect('/connexion');
        // }

        Session::set(['auth', $user->id]);

        Router::redirect('/');
    }

    public static function logout(): void
    {
        session_destroy();

        Router::redirect('/');
    }
}
