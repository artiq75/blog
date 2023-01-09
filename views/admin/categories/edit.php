<?php
use App\Helpers\Router;
?>

<form action="<?= Router::generate('admin.categories.store', ['id' => $category->id]) ?>">
    <div class="form-group mb-2">
        <label for="name" class="form-label">Etiquètte</label>
        <input type="text" class="form-control" name="name" id="name" value="<?= $category->name ?? '' ?>"
            placeholder="Ajouter une catégorie">
    </div>

    <button class="btn btn-primary">
        Modifier la catégorie
    </button>
</form>