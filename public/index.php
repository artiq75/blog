<?php

require '../vendor/autoload.php';

use App\Controllers\HomeController;
use App\Controllers\Admin\PostController;

$router = new AltoRouter();

$router->map('GET', '/', [HomeController::class, "index"], 'home');
$router->map('GET', '/admin', [PostController::class, "index"], 'admin');
$router->map('POST', '/admin/posts/[i:id]', [PostController::class, "delete"], 'posts-delete');

$match = $router->match();

require '../layouts/header.php';
if (is_array($match) && is_callable($match['target'])) 
{
    call_user_func_array($match['target'], $match['params']);
} else 
{
    require '../views/404.php';
}
require '../layouts/footer.php';