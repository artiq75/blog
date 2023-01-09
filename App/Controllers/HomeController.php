<?php

namespace App\Controllers;

use App\Helpers\DB;

class HomeController
{
    public static function index()
    {
        $db = DB::connect();
        $statement = $db->query('SELECT * FROM posts WHERE is_published = 1 ORDER BY created_at DESC');
        $posts = $statement->fetchAll();

        require dirname(__DIR__, 2) . '/views/home.php';
    }
}