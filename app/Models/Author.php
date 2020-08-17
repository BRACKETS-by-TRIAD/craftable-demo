<?php

namespace App\Models;

use Brackets\Media\HasMedia\HasMediaCollections;
use Brackets\Media\HasMedia\HasMediaCollectionsTrait;
use Brackets\Media\HasMedia\HasMediaThumbsTrait;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;
use Spatie\MediaLibrary\Media;

class Author extends Model implements HasMediaCollections, HasMediaConversions
{
    use HasMediaCollectionsTrait;
    use HasMediaThumbsTrait;

    protected $fillable = ['title'];

    protected $appends = [
        'abbr',
        'full_name',
        'first_name',
        'last_name',
        'email',
        'avatar_url'
    ];

    /* ************************ ACCESSOR ************************* */

    /**
     * @return string
     */
    public function getAbbrAttribute(): string
    {
        $nameArray = explode(" ", $this->title);

        if (isset($nameArray[1])) {
            return mb_strtoupper(mb_substr($nameArray[0], 0, 1)) . mb_strtoupper(mb_substr($nameArray[1], 0, 1));
        }

        return mb_substr($this->title, 0, 2);
    }

    public function getFullNameAttribute(): string
    {
        $nameArray = explode(" ", $this->title);

        if (isset($nameArray[1])) {
            return $nameArray[0] . ' ' . $nameArray[1];
        }

        return $this->title;
    }

    public function getFirstNameAttribute(): string
    {
        $nameArray = explode(" ", $this->title);

        if (isset($nameArray[0])) {
            return $nameArray[0];
        }

        return $this->title;
    }

    public function getLastNameAttribute(): string
    {
        $nameArray = explode(" ", $this->title);

        if (isset($nameArray[1])) {
            return $nameArray[1];
        }

        return $this->title;
    }

    public function getEmailAttribute(): string
    {
        $nameArray = explode(" ", $this->title);

        if (isset($nameArray[1])) {
            return  strtolower($nameArray[0]) . '.' . strtolower($nameArray[1]) . '@getcraftable.com';
        }

        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getAvatarUrlAttribute()
    {
        return $this->getFirstMediaUrl('photo', 'thumb_square') ?: false;
    }

    /* ************************ MEDIA ************************ */

    /**
     * @throws \Brackets\Media\Exceptions\Collections\MediaCollectionAlreadyDefined
     * @return array|void
     */
    public function registerMediaCollections()
    {
        $this->addMediaCollection('photo')
            ->maxFilesize(10 * 1024 * 1024)
            ->maxNumberOfFiles(1)
            ->accepts('image/*');
    }

    /**
     * @param Media|null $media
     * @throws \Spatie\Image\Exceptions\InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null)
    {
        $this->autoRegisterThumb200();

        $this->addMediaConversion('thumb_square')
            ->width(60)
            ->height(60)
            ->crop(Manipulations::CROP_CENTER, 60, 60)
            ->performOnCollections('photo')
            ->keepOriginalImageFormat()
            ->nonQueued();

        $this->addMediaConversion('medium_square')
            ->width(60)
            ->height(60)
            ->crop(Manipulations::CROP_CENTER, 160, 160)
            ->performOnCollections('photo')
            ->keepOriginalImageFormat()
            ->nonQueued();

        $this->addMediaConversion('detail_square')
            ->width(400)
            ->height(400)
            ->crop(Manipulations::CROP_CENTER, 400, 400)
            ->performOnCollections('photo')
            ->keepOriginalImageFormat()
            ->nonQueued();
    }

    /* ************************ RELATIONS ************************* */

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function articlesWithRelationships()
    {
        return $this->hasMany(ArticlesWithRelationship::class);
    }
}
