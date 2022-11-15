<?php

namespace App\Controllers\Admin;

use App\Controllers\Auth\Auth;
use App\Helpers\Request;
use App\Helpers\DB;
use App\Helpers\Router;
use PDOException;

class PostController
{
    public static function index(): void
    {
        if (!Auth::check()) {
            Router::redirect('home');
        }

        $query = 'SELECT p.id, p.title, p.slug, p.body, p.is_published, p.created_at, p.user_id, c.name as category_name
        FROM posts AS p 
        INNER JOIN users AS u 
        ON p.user_id = u.id
        INNER JOIN categories AS c
        ON p.category_id = c.id
        WHERE p.user_id = ?
        GROUP BY created_at DESC';

        $db = DB::connect();
        $statement = $db->prepare($query);
        $statement->execute([Auth::id()]);
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
        if (!Auth::check()) {
            Router::redirect('home');
        }

        $db = DB::connect();
        $statement = $db->query('SELECT * FROM categories');
        $categories = $statement->fetchAll();

        require dirname(__DIR__, 3) . '/views/admin/posts/create.php';
    }

    public static function store(): void
    {
        if (!Auth::check()) {
            Router::redirect('home');
        }

        $title = Request::input('title');
        $slug = Request::input('slug');
        $body = Request::input('body');
        $is_published = (bool) Request::input('is_published');
        $category_id = (int) Request::input('category_id');

        if (empty($title)) {
            Router::redirect('admin.posts.create');
        }

        if (empty($slug)) {
            Router::redirect('admin.posts.create');
        }

        if (empty($body)) {
            Router::redirect('admin.posts.create');
        }

        try {
            $db = DB::connect();
            $statement = $db->prepare('INSERT INTO posts (title, slug, body, is_published, user_id, category_id) VALUES (?,?,?,?,?,?)');
            $statement->execute([$title, $slug, $body, $is_published, Auth::id(), $category_id]);
        } catch (PDOException) {
            Router::redirect('admin.posts.create');
        }

        Router::redirect('admin');
    }

    public static function edit(int $id): void
    {
        if (!Auth::check()) {
            Router::redirect('home');
        }

        $db = DB::connect();
        $statement = $db->prepare('SELECT * FROM posts WHERE id = ? AND user_id = ?');
        $statement->execute([$id, Auth::id()]);
        
        $categoriesStmt = $db->query('SELECT * FROM categories');

        $categories = $categoriesStmt->fetchAll();
        $post = $statement->fetch();

        require dirname(__DIR__, 3) . '/views/admin/posts/edit.php';
    }

    public static function update(int $id): void
    {
        if (!Auth::check()) {
            Router::redirect('home');
        }

        $title = Request::input('title');
        $slug = Request::input('slug');
        $body = Request::input('body');
        $is_published = (bool) Request::input('is_published');
        $category_id = (int) Request::input('category_id');

        if (empty($title)) {
            Router::redirect('admin');
        }

        if (empty($slug)) {
            Router::redirect('admin');
        }

        if (empty($body)) {
            Router::redirect('admin');
        }

        $db = DB::connect();
        $statement = $db->prepare('UPDATE posts 
        SET title = ?, slug = ?, body = ?, is_published = ?, user_id = ?, category_id = ? 
        WHERE id = ? AND user_id = ?');
        $statement->execute([$title, $slug, $body, $is_published, Auth::id(), $id, Auth::id(), $category_id]);

        Router::redirect('admin');
    }

    public static function delete(int $id): void
    {
        if (!Auth::check()) {
            Router::redirect('home');
        }

        $db = DB::connect();
        $statement = $db->prepare('DELETE FROM posts WHERE id = ? AND user_id = ?');
        $statement->execute([$id, Auth::id()]);

        Router::redirect('admin');
    }
}
