<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PredictionDetail extends Model
{
    protected $fillable = ['id','prediction_id', 'plan_id', 'points_deduction'];

    public $incrementing = false;
    protected $keyType = 'string';

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->id) {
                $model->id = (string) Str::uuid();
            }
        });
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class, 'plan_id');
    }

    public function prediction()
    {
        return $this->belongsTo(Pridection::class, 'prediction_id');
    }
}
