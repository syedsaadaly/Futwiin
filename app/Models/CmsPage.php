<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class CmsPage extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'name',
        'slug',
        'content',
        'meta_title',
        'meta_description',
        'meta_keyword',
    ];

    public function cmsImages($collection_name)
{
    return $this->getMedia($collection_name)->first()
        ? $this->getMedia($collection_name)->first()->getUrl()
        : asset('images/No-Image.png');
}


    public function scopePageBySlug($q, $slug)
    {
        return $q->where('slug', $slug);
    }

}
