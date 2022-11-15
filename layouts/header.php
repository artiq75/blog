<?php

use App\Controllers\Auth\Auth;
use App\Helpers\Router;
$user = Auth::user();
?>
<!doctype html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Blog</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
  <div class="container">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
      <a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
        <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
          <use xlink:href="#bootstrap"></use>
        </svg>
      </a>

      <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
        <li><a href="<?= Router::generate('home') ?>" class="nav-link px-2 link-secondary">Accueil</a></li>
        <li><a href="<?= Router::generate('admin') ?>" class="nav-link px-2 link-secondary">Admin</a></li>
      </ul>

      <div class="col-md-3 text-end">
        <?php if (!$user) : ?>
          <a href="<?= Router::generate('login.index') ?>" class="btn btn-outline-primary">Connexion</a>
          <a href="<?= Router::generate('register.index') ?>" class="btn btn-primary">Inscription</a>
          <?php else : ?>
            <span><?= $user->username ?></span>
            <a href="<?= Router::generate('logout') ?>" class="btn btn-danger">Déconnexion</a>
        <?php endif ?>
      </div>
    </header>