<?php

use App\Helpers\Router;

if ($posts) : ?>
    <?php foreach ($posts as $post) : ?>
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title"><?= $post->title ?></h5>
                <p class="card-text"><?= $post->body ?></p>
                <a href="<?= Router::generate('posts.show', ['slug' => $post->slug]) ?>" class="btn btn-primary">Lire l'article</a>
            </div>
        </div>
    <?php endforeach ?>
<?php endif ?>