<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saying extends Model
{
    use HasFactory;

    protected $table = 'sayings'; 

    protected $fillable = [
        'name', 'designation', 'rating', 'message'
    ];
}
