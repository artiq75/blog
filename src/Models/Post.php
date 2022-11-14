<?php

namespace App\Models;

class Post
{
    public int $id;

    public string $title;

    public string $slug;

    public string $body;

    public int $user_id;
    
    public int $create_at;
}
