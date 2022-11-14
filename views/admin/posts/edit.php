<?php
use App\Helpers\Router;
?>

<h1 class="mb-4">Modification: <?= $post->title ?></h1>

<form action="<?= Router::generate('admin.posts.update', ['id' => $post->id]) ?>" method="POST">
    <div class="form-group mb-4">
        <label for="title" class="form-label">Titre</label>
        <input type="text" class="form-control" name="title" id="title" value="<?= $post->title ?? '' ?>">
    </div>
    <div class="form-group mb-4">
        <label for="slug" class="form-label">Slug</label>
        <input type="text" class="form-control" name="slug" id="slug" value="<?= $post->slug ?? '' ?>">
    </div>
    <div class="form-group mb-4">
        <label for="body" class="form-label">Corps</label>
        <textarea class="form-control" name="body" id="body">
        <?= $post->body ?? '' ?>
        </textarea>
    </div>
    <button class="btn btn-primary" type="submit">Ajouter</button>
</form>