<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    
    
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
    
    
    
    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute() {
        return url('/admin/articles/'.$this->getKey());
    }

    
}
