<?php

namespace App\Models;

class Post
{
    public int $id;

    public string $title;

    public string $slug;

    public string $body;

    public int $create_at;
}
