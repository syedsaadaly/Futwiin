<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class TwitterPost extends Model
{
use HasFactory;


protected $fillable = [
'title','handle','content','sort_order','status'
];


protected $casts = [
'status' => 'boolean',
];
}
