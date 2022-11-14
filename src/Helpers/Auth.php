<?php

namespace App\Helpers;

use App\Models\User;

class Auth
{

    public static function id(): ?int
    {
        return Session::get('auth');
    }

    public static function user(): ?User
    {
        $id = self::id();
        $user = null;

        if ($id) {
            $db = DB::connect();
            $stmt = $db->prepare('SELECT * FROM users WHERE id = ?');
            $stmt->execute([$id]);
            $user = $stmt->fetchObject(User::class);
        }

        return $user;
    }
}
