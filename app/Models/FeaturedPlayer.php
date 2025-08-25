<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeaturedPlayer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','club','age','position','nationality','image','stats','description'
    ];
}
