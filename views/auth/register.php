<?php
use App\Helpers\Router;
?>

<h1 class="mb-4">S'inscrire</h1>

<form action="<?= Router::generate('register') ?>" method="POST" novalidate>
    <div class="form-group mb-4">
        <label for="username" class="form-label">Identifiant</label>
        <input type="text" class="form-control" name="username" id="username">
    </div>
    <div class="form-group mb-4">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" name="email" id="email">
    </div>
    <div class="form-group mb-4">
        <label for="password" class="form-label">Mot de passe</label>
        <input type="password" class="form-control" name="password" id="password">
    </div>
    <button class="btn btn-primary" type="submit">S'inscrire</button>
</form>