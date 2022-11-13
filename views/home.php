<?php if ($posts) : ?>
    <?php foreach ($posts as $post) : ?>
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title"><?= $post->title ?></h5>
                <p class="card-text"><?= $post->body ?></p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
    <?php endforeach ?>
<?php endif ?>