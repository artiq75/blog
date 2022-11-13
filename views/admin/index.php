<?php
$router = new AltoRouter();
?>

<h1 class="mb-4">Articles</h1>

<a href="/admin/posts/create" class="btn btn-primary mb-4">Créer un nouvelle article</a>

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
                    <td>
                        <form action="<?= $router->generate('posts-delete', ['id' => $post->id]) ?>" method="POST">
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