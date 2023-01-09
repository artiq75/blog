<?php
use App\Helpers\Router;
?>

<h1 class="mb-4">Catégories</h1>

<form action="<?= Router::generate('admin.categories.store') ?>" class="mb-4">
  <div class="form-group mb-2">
    <label for="name" class="form-label">Etiquètte</label>
    <input type="text" class="form-control" name="name" id="name" placeholder="Ajouter une catégorie">
  </div>

  <button type="submit" class="btn btn-primary">
    Ajouter la catégorie
  </button>
</form>

<table class="table">
  <thead>
    <tr>
      <th>ID</th>
      <th>Etiquètte</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($categories as $category): ?>
      <tr>
        <td><?= $category->id ?></td>
        <td>
        <?= $category->name ?>
        </td>
      </tr>
    <?php endforeach ?>
  </tbody>
</table>