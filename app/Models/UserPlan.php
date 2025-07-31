<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserPlan extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'uuid';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'uuid',
        'plan_id',
        'user_id',
        'price',
        'old_wallet',
        'new_wallet'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'old_wallet' => 'decimal:2',
        'new_wallet' => 'decimal:2',
    ];

    public function plan()
    {
        return $this->belongsTo(Plan::class, 'plan_id', 'uuid');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
