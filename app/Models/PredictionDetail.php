<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PredictionDetail extends Model
{
    protected $fillable = ['prediction_id', 'plan_id', 'points_deduction'];

    public function plan()
    {
        return $this->belongsTo(Plan::class, 'plan_id');
    }

    public function prediction()
    {
        return $this->belongsTo(Pridection::class, 'prediction_id');
    }
}
