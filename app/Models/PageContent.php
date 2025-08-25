<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class PageContent extends Model
{
use HasFactory;


protected $fillable = ['page','key','value'];


public static function getValue(string $page, string $key, $default = null)
{
return static::where(compact('page','key'))->value('value') ?? $default;
}


public static function setValue(string $page, string $key, $value): void
{
static::updateOrCreate(['page'=>$page,'key'=>$key], ['value'=>$value]);
}
}