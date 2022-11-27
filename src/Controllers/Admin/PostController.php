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
        $userId = Auth::id();

        if (!$userId) {
            Router::redirect('home');
        }

        $query = 'SELECT 
        p.id, p.title, 
        p.slug, p.body, 
        p.is_published, 
        p.created_at, p.user_id, 
        c.name as category_name
        FROM posts p 
        INNER JOIN users u 
        ON p.user_id = u.id
        INNER JOIN categories c
        ON p.category_id = c.id
        WHERE p.user_id = ?';

        $db = DB::connect();
        $statement = $db->prepare($query);
        $statement->execute([$userId]);
        $posts = $statement->fetchAll();

        require dirname(__DIR__, 3) . '/views/admin/posts/index.php';
    }

    public static function show(string $slug): void
    {
        $slug = htmlspecialchars($slug);

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
        $userId = Auth::id();

        if (!$userId) {
            Router::redirect('home');
        }

        $title = Request::input('title');
        $slug = Request::input('slug');
        $body = Request::input('body');
        $isPublished = Request::boolean('is_published') ? 1 : 0;
        $categoryId = (int) Request::input('category_id');

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
            $statement->execute([$title, $slug, $body, $isPublished, $userId, $categoryId]);
        } catch (PDOException) {
            Router::redirect('admin.posts.create');
        }

        Router::redirect('admin');
    }

    public static function edit(int $id): void
    {
        $userId = Auth::id();

        if (!$userId) {
            Router::redirect('home');
        }

        $db = DB::connect();
        $statement = $db->prepare('SELECT * FROM posts WHERE id = ? AND user_id = ?');
        $statement->execute([$id, $userId]);
        
        $categoriesStmt = $db->query('SELECT * FROM categories');

        $categories = $categoriesStmt->fetchAll();
        $post = $statement->fetch();

        require dirname(__DIR__, 3) . '/views/admin/posts/edit.php';
    }

    public static function update(int $id): void
    {
        $userId = Auth::id();

        if (!$userId) {
            Router::redirect('home');
        }

        $title = Request::input('title');
        $slug = Request::input('slug');
        $body = Request::input('body');
        $isPublished = Request::boolean('is_published') ? 1 : 0;
        $categoryId = intval(Request::input('category_id'));
        $createdAt = time();

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
        SET title = ?, slug = ?, body = ?, is_published = ?, user_id = ?, category_id = ?, created_at = ? WHERE id = ?');
        $statement->execute([$title, $slug, $body, $isPublished, $userId, $categoryId, $createdAt, $id]);

        Router::redirect('admin');
    }

    public static function delete(int $id): void
    {
        $userId = Auth::id();

        if (!$userId) {
            Router::redirect('home');
        }

        $db = DB::connect();
        $statement = $db->prepare('DELETE FROM posts WHERE id = ? AND user_id = ?');
        $statement->execute([$id, $userId]);

        Router::redirect('admin');
    }
}
