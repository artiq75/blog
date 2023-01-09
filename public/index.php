<?php

require '../vendor/autoload.php';

define('APP_PATH', dirname(__DIR__));

use App\Helpers\Router;

require_once(APP_PATH . '/routes/web.php');

$match = Router::match();

require APP_PATH . '/views/layouts/header.php';
if (is_array($match) && is_callable($match['target'])) 
{
    call_user_func_array($match['target'], $match['params']);
} else 
{
    require APP_PATH . '/views/404.php';
}
require APP_PATH . '/views/layouts/footer.php';