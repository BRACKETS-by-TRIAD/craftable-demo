<?php

namespace App\Models;

class Author
{
    protected $fillable = ['title'];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}