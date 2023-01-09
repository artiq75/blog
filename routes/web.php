<?php

use App\Controllers\Admin\CategoryController;
use App\Controllers\Admin\PostController;
use App\Controllers\Auth\Auth;
use App\Controllers\Auth\Login;
use App\Controllers\Auth\Register;
use App\Controllers\HomeController;
use App\Helpers\Router;

Router::map('GET', '/', [HomeController::class, "index"], 'home');
Router::map('GET', '/connexion', [Login::class, "index"], 'login.index');
Router::map('POST', '/connexion', [Login::class, "login"], 'login');
Router::map('GET', '/deconnexion', [Auth::class, "logout"], 'logout');
Router::map('GET', '/inscription', [Register::class, "index"], 'register.index');
Router::map('POST', '/inscription', [Register::class, "register"], 'register');
Router::map('GET', '/admin', [PostController::class, "index"], 'admin');
Router::map('GET', '/articles/[*:slug]', [PostController::class, "show"], 'posts.show');
Router::map('GET', '/admin/posts/create', [PostController::class, "create"], 'admin.posts.create');
Router::map('POST', '/admin/posts/store', [PostController::class, "store"], 'admin.posts.store');
Router::map('GET', '/admin/posts/[i:id]/edit', [PostController::class, "edit"], 'admin.posts.edit');
Router::map('POST', '/admin/posts/[i:id]/update', [PostController::class, "update"], 'admin.posts.update');
Router::map('POST', '/admin/posts/[i:id]', [PostController::class, "delete"], 'admin.posts.delete');
Router::map('GET', '/admin/categories', [CategoryController::class, "index"], 'admin.categories.index');
Router::map('GET', '/admin/categories/[i:id]/edit', [CategoryController::class, "edit"], 'admin.categories.edit');
Router::map('POST', '/admin/categories/[i:id]', [CategoryController::class, "store"], 'admin.categories.store');