<h1 class="mb-4">Ajouter un nouveau article</h1>

<form action="/admin/posts" method="POST">
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
    <button class="btn btn-primary" type="submit">Ajouter</button>
</form>