<?php

namespace App\Models;

use Brackets\Translatable\Traits\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class TranslatableArticle extends Model
{
    use HasTranslations;

    
    protected $fillable = [
        "title",
        "perex",
        "published_at",
        "enabled",
    
    ];
    
    protected $hidden = [
    
    ];
    
    protected $dates = [
        "published_at",
        "created_at",
        "updated_at",
    
    ];
    
    // these attributes are translatable
    public $translatable = [
        "title",
        "perex",
    
    ];
    
    
    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute()
    {
        return url('/admin/translatable-articles/'.$this->getKey());
    }
}
