<?php

use App\Helpers\Router;
?>

<h1 class="mb-4">Articles</h1>

<a href="<?= Router::generate('admin.posts.create') ?>" class="btn btn-primary mb-4">Créer un nouvelle article</a>

<?php if ($posts) : ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Corps</th>
                <th>Date création</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($posts as $post) : ?>
                <tr>
                    <td>#<?= $post->id ?></td>
                    <td><?= $post->title ?></td>
                    <td><?= $post->body ?></td>
                    <td><?= date('d/m/Y', $post->created_at) ?></td>
                    <td class="d-flex">
                        <a href="<?= Router::generate('posts.show', ['slug' => $post->slug]) ?>" class="btn btn-info">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="<?= Router::generate('admin.posts.edit', ['id' => $post->id]) ?>" class="btn btn-primary">
                            <i class="bi bi-pen"></i>
                        </a>
                        <form action="<?= Router::generate('admin.posts.delete', ['id' => $post->id]) ?>" method="POST">
                            <button class="btn btn-danger" type="submit">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
<?php endif ?>