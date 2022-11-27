<?php

namespace App\Controllers\Auth;

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

        $db = DB::connect();
        $stmt = $db->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user) {
            Router::redirect('register.index');
        }

        $password_hashed = password_hash($password, PASSWORD_BCRYPT);

        $stmt = $db->prepare('INSERT INTO users (username, email, password) VALUES (?,?,?)');
        $isOk = $stmt->execute([$username, $email, $password_hashed]);

        if (!$isOk) {
            Router::redirect('register.index');
        }

        $stmt = $db->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->execute([$email]);
        $user = $stmt->fetchObject();

        if (!$user) {
            Router::redirect('register.index');
        }
        
        if (!password_verify($password, $user->password)) {
            Router::redirect('login.index');
        }

        Session::set(['auth' => $user->id]);

        Router::redirect('home');
    }
}
