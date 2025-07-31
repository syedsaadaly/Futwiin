<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPayment extends Model
{
    use HasFactory;

    protected $primaryKey = 'uuid';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'uuid',
        'plan_id',
        'user_id',
        'price',
        'payment_mode',
        'stripe_payment_id',
        'status'
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    public function plan()
    {
        return $this->belongsTo(Plan::class, 'plan_id', 'uuid');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'uuid');
    }
}
