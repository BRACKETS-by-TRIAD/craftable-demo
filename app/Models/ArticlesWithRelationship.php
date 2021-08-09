<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticlesWithRelationship extends Model
{
    protected $fillable = [
        "title",
        "perex",
        "published_at",
        "enabled",
        "author_id",

    ];

    protected $hidden = [

    ];

    protected $dates = [
        "published_at",
        "created_at",
        "updated_at",

    ];

    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/articles-with-relationships/' . $this->getKey());
    }

    /* ************************ RELATIONS ************************* */

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
