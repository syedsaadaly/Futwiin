<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Support\Str;

/**
 * Class Pridection.
 *
 * @package namespace App\Models;
 */
class Pridection extends Model implements Transformable, HasMedia
{
    use SoftDeletes, InteractsWithMedia ,TransformableTrait;

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'team_1_id',
        'team_2_id',
        'title',
        'match_date',
        'match_time',
        'text',
        'teaser_text',
        'is_teaser',
        'league_id',
        'end_time',
        'timezone',
    ];

    protected $dates = ['match_date'];
    protected $casts = ['is_teaser' => 'boolean'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = Str::uuid()->toString();
            }
        });
    }

    public function team1()
    {
        return $this->belongsTo(Team::class, 'team_1_id');
    }

    public function team2()
    {
        return $this->belongsTo(Team::class, 'team_2_id');
    }

    public function league()
    {
        return $this->belongsTo(League::class, 'league_id');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('prediction_images')
            ->singleFile()
            ->useDisk('public');
    }

    public function predictionDetails()
    {
        return $this->hasMany(PredictionDetail::class, 'prediction_id');
    }

    public function details()
    {
        return $this->hasMany(PredictionDetail::class, 'prediction_id');
    }

    public static function getRecentPredictions($limit = 5)
    {
        return self::with(['team1', 'team2'])->latest()->take($limit)->get();
    }

    public function isLive()
    {
        $timezone = config('app.timezone', 'Asia/Karachi');
        $now = Carbon::now($timezone);
        $matchTime = Carbon::createFromFormat('Y-m-d H:i:s', $this->match_date->format('Y-m-d') . ' ' . $this->match_time, $timezone);

        $endTime = $this->end_time
            ? Carbon::createFromFormat('Y-m-d H:i:s', $this->match_date->format('Y-m-d') . ' ' . $this->end_time, $timezone)
            : $matchTime->copy()->addHours(2);

        return $now->between($matchTime, $endTime);
    }

    public function getTimezoneAbbreviation()
    {
        $map = [
            'UTC' => 'UTC',
            'Europe/London' => 'GMT',
            'America/New_York' => 'EST',
            'Europe/Belfast' => 'BST'
        ];

        return $map[$this->timezone] ?? 'UTC';
    }
}
