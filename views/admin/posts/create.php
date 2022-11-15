<?php

use App\Helpers\Router;
?>

<h1 class="mb-4">Ajouter un nouveau article</h1>

<form action="<?= Router::generate('admin.posts.store') ?>" method="POST">
    <div class="form-group mb-4">
        <label for="title" class="form-label">Titre</label>
        <input type="text" class="form-control" name="title" id="title">
    </div>
    <div class="form-group mb-4">
        <label for="slug" class="form-label">Slug</label>
        <input type="text" class="form-control" name="slug" id="slug">
    </div>
    <div class="form-group mb-4">
        <label for="body" class="form-label">Corps</label>
        <textarea class="form-control" name="body" id="body"></textarea>
    </div>
    <select name="category_id" id="category_id" class="form-select mb-4">
        <?php foreach ($categories as $category) : ?>
            <option value="<?= $category->id ?>"><?= $category->name ?></option>
        <?php endforeach ?>
    </select>
    <div class="form-check mb-4">
        <label for="is_published" class="form-check-label">Publier ?</label>
        <input type="checkbox" class="form-check-input" name="is_published" id="is_published">
    </div>
    <button class="btn btn-primary" type="submit">Ajouter</button>
</form>