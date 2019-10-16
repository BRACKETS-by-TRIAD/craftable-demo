<?php namespace App\Models;

use Brackets\AdminAuth\Models\AdminUser;
use Illuminate\Database\Eloquent\Model;
use Brackets\Craftable\Traits\UpdatedByAdminUserTrait;

class Article extends Model
{
        use UpdatedByAdminUserTrait;

    
    protected $fillable = [
        "title",
        "perex",
        "published_at",
        "enabled",
        "updated_by_admin_user_id",
    
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
