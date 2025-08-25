<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeTestimonial extends Model
{
    use HasFactory;
    protected $fillable = [
'rating','review','name','since_label','avatar','sort_order','status'
];


protected $casts = [
'status' => 'boolean',
];
}
