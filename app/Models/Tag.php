<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        "name",
    
    ];
    
    protected $hidden = [
    
    ];
    
    protected $dates = [
        "created_at",
        "updated_at",
    
    ];

    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/tags/'.$this->getKey());
    }

    /* ************************ RELATIONS ************************* */

    public function articlesWithRelationships()
    {
        $this->belongsToMany(ArticlesWithRelationship::class);
    }
}
