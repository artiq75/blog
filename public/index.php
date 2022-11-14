<?php

require '../vendor/autoload.php';

use App\Controllers\HomeController;
use App\Controllers\Admin\PostController;
use App\Controllers\Auth\Login;
use App\Helpers\Router;

Router::map('GET', '/', [HomeController::class, "index"], 'home');
Router::map('GET', '/connexion', [Login::class, "index"], 'login.index');
Router::map('POST', '/connexion', [Login::class, "login"], 'login');
Router::map('GET', '/deconnexion', [Login::class, "logout"], 'logout');
Router::map('GET', '/admin', [PostController::class, "index"], 'admin');
Router::map('GET', '/posts/[*:slug]', [PostController::class, "show"], 'posts.show');
Router::map('GET', '/admin/posts/create', [PostController::class, "create"], 'admin.posts.create');
Router::map('POST', '/admin/posts/store', [PostController::class, "store"], 'admin.posts.store');
Router::map('GET', '/admin/posts/[i:id]/edit', [PostController::class, "edit"], 'admin.posts.edit');
Router::map('POST', '/admin/posts/[i:id]/update', [PostController::class, "update"], 'admin.posts.update');
Router::map('POST', '/admin/posts/[i:id]', [PostController::class, "delete"], 'admin.posts.delete');

$match = Router::match();

require '../layouts/header.php';
if (is_array($match) && is_callable($match['target'])) 
{
    call_user_func_array($match['target'], $match['params']);
} else 
{
    require '../views/404.php';
}
require '../layouts/footer.php';