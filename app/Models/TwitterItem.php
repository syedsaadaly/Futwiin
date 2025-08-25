<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TwitterItem extends Model
{
    use HasFactory;

    protected $fillable = ['twitter_section_id','username','handle','content'];

    public function section()
    {
        return $this->belongsTo(TwitterSection::class, 'twitter_section_id');
    }
}
