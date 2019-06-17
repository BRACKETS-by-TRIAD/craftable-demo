<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Brackets\Media\HasMedia\HasMediaCollections;
use Brackets\Media\HasMedia\HasMediaCollectionsTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;
use Spatie\MediaLibrary\Media;
use Brackets\Media\HasMedia\HasMediaThumbsTrait;

class Post extends Model implements HasMediaCollections, HasMediaConversions
{

    use HasMediaCollectionsTrait;
    use HasMediaThumbsTrait;
    
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

    public function getResourceUrlAttribute() {
        return url('/admin/posts/'.$this->getKey());
    }

    public function registerMediaCollections() {
        $this->addMediaCollection('cover')
            ->accepts('image/*');

        $this->addMediaCollection('gallery')
            ->accepts('image/*')
            ->maxNumberOfFiles(20);

        $this->addMediaCollection('pdf')
            ->accepts('application/pdf');
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->autoRegisterThumb200();
    }

    /* ************************ RELATIONS ************************* */

    public function author()
    {
        return $this->belongsTo(Author::class);
    }
}
