<?php

namespace App\Controllers\Admin;

use App\Helpers\DB;
use App\Helpers\Request;
use App\Helpers\Router;

class CategoryController
{
  public static function index(): void
  {
    $db = DB::connect();
    $stmt = $db->query('SELECT * FROM categories');
    $categories = $stmt->fetchAll();

    require_once(APP_PATH . '/views/admin/categories/index.php');
  }

  public static function store(): void
  {
    $name = Request::input('name');

    if (empty($name)) {
      Router::redirect('admin.categories.index');
    }

    $db = DB::connect();
    $db->prepare('INSERT INTO categories (name) VALUES (?)');
    $db->execute([$name]);

    Router::redirect('admin.categories.index');
  }

  public static function edit(int $id): void
  {
    $db = DB::connect();
    $stmt = $db->prepare('SELECT * FROM categories WHERE id = ?');
    $db->execute([$id]);
    $categories = $stmt->fetchAll();

    require_once(APP_PATH . '/views/admin/categories/index.php');
  }

  public static function update(int $id): void
  {
    $name = Request::input('name');

    if (empty($name)) {
      Router::redirect('admin.categories.edit', ['id' => $id]);
    }

    $db = DB::connect();
    $db->prepare('UPDATE TABLE categories (name) SET (?) WHERE id = ?');
    $db->execute([$name, $id]);

    Router::redirect('admin.categories.edit', ['id' => $id]);
  }
}