<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class UserPredictionLog extends Model
{
    use SoftDeletes;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'pred_id',
        'user_id',
        'plan_id',
        'old_wallet',
        'new_wallet',
        'points_deduction'
    ];

    protected $casts = [
        'old_wallet' => 'decimal:2',
        'new_wallet' => 'decimal:2',
        'points_deduction' => 'decimal:2',
    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = Str::uuid()->toString();
            }
        });
    }

    public function prediction()
    {
        return $this->belongsTo(Pridection::class, 'pred_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
