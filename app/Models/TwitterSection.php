<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TwitterSection extends Model
{
    use HasFactory;

     protected $fillable = [
        'title',
        'description',
        'button_text',
        'button_link',
        // 'twitter_handle',
    ];

    public function items()
    {
        return $this->hasMany(TwitterItem::class);
    }
}
