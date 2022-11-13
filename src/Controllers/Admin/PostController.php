<?php

namespace App\Controllers\Admin;

use App\Helpers\Request;
use App\Helpers\DB;
use PDOException;

class PostController
{
    public static function index(): void
    {
        $db = DB::connect();
        $statement = $db->query('SELECT * FROM posts');
        $posts = $statement->fetchAll();

        require dirname(__DIR__, 3) . '/views/admin/index.php';
    }

    public static function create(): void
    {
        require dirname(__DIR__, 3) . '/views/admin/create.php';
    }

    public static function store(): void
    {
        $title = Request::input('title');
        $slug = Request::input('slug');
        $body = Request::input('body');

        if (empty($title)) {
            Request::redirect('/admin/posts/create');
        }

        if (empty($slug)) {
            Request::redirect('/admin/posts/create');
        }

        if (empty($body)) {
            Request::redirect('/admin/posts/create');
        }

        try {
            $db = DB::connect();
            $statement = $db->prepare('INSERT INTO posts (title, slug, body) VALUES (?,?,?)');
            $statement->execute([$title, $slug, $body]);
        } catch (PDOException) {
            Request::redirect('/admin/posts/create');
        }

        Request::redirect('/admin');
    }

    public static function delete(int $id): void
    {
        $db = DB::connect();
        $statement = $db->prepare('DELETE FROM posts WHERE id = ?');
        $statement->execute([$id]);
        Request::redirect('/admin');
    }
}
