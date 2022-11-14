<?php

namespace App\Controllers\Admin;

use App\Helpers\Request;
use App\Helpers\DB;
use App\Helpers\Router;
use PDOException;

class PostController
{
    public static function index(): void
    {
        $db = DB::connect();
        $statement = $db->query('SELECT * FROM posts');
        $posts = $statement->fetchAll();

        require dirname(__DIR__, 3) . '/views/admin/posts/index.php';
    }

    public static function show(string $slug): void
    {
        $slug = htmlentities($slug);

        $db = DB::connect();
        $statement = $db->prepare('SELECT * FROM posts WHERE slug = ?');
        $statement->execute([$slug]);
        $post = $statement->fetch();

        require dirname(__DIR__, 3) . '/views/posts/show.php';
    }

    public static function create(): void
    {
        require dirname(__DIR__, 3) . '/views/admin/posts/create.php';
    }

    public static function store(): void
    {
        $title = Request::input('title');
        $slug = Request::input('slug');
        $body = Request::input('body');

        if (empty($title)) {
            Router::redirect('/admin/posts/create');
        }

        if (empty($slug)) {
            Router::redirect('/admin/posts/create');
        }

        if (empty($body)) {
            Router::redirect('/admin/posts/create');
        }

        try {
            $db = DB::connect();
            $statement = $db->prepare('INSERT INTO posts (title, slug, body) VALUES (?,?,?)');
            $statement->execute([$title, $slug, $body]);
        } catch (PDOException) {
            Router::redirect('/admin/posts/create');
        }

        Router::redirect('/admin');
    }

    public static function edit(int $id): void
    {
        $db = DB::connect();
        $statement = $db->prepare('SELECT * FROM posts WHERE id = ?');
        $statement->execute([$id]);
        $post = $statement->fetch();

        require dirname(__DIR__, 3) . '/views/admin/posts/edit.php';
    }

    public static function update(int $id): void
    {
        $title = Request::input('title');
        $slug = Request::input('slug');
        $body = Request::input('body');

        if (empty($title)) {
            Router::redirect('/admin');
        }

        if (empty($slug)) {
            Router::redirect('/admin');
        }

        if (empty($body)) {
            Router::redirect('/admin');
        }

        $db = DB::connect();
        $statement = $db->prepare('UPDATE posts SET title = ?, slug = ?, body = ? WHERE id = ?');
        $statement->execute([$title, $slug, $body, $id]);

        Router::redirect('/admin');
    }

    public static function delete(int $id): void
    {
        $db = DB::connect();
        $statement = $db->prepare('DELETE FROM posts WHERE id = ?');
        $statement->execute([$id]);
        
        Router::redirect('/admin');
    }
}
