<?php
use App\Helpers\Router;
?>

<h1 class="mb-4">Se connecter</h1>

<form action="<?= Router::generate('login') ?>" method="POST" novalidate>
    <div class="form-group mb-4">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" name="email" id="email">
    </div>
    <div class="form-group mb-4">
        <label for="password" class="form-label">Mot de passe</label>
        <input type="password" class="form-control" name="password" id="password">
    </div>
    <button class="btn btn-primary" type="submit">Se connecter</button>
</form>