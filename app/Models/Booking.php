<?php

namespace App\Models;

use App\Scopes\SettingsScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'settings_id',
        'speaker_id',
        'talk_id',
        'chairman_id',
        'date',
        'time',
        'song',
        'exception',
        'custom_talk',
        'custom_speaker',
        'comments',
        'grade',
        'thanked',
        'identifier',
        'no_meeting'
    ];

    protected $with = ['speaker', 'talk', 'chairman', 'settings', 'user'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'exception' => 'boolean',
        'thanked' => 'boolean',
        'no_meeting' => 'boolean',
    ];

    protected static function booted()
    {
        static::addGlobalScope(new SettingsScope);
    }

    public function settings()
    {
        return $this->belongsTo(\App\Models\Settings::class);
    }

    public function speaker()
    {
        return $this->belongsTo(\App\Models\Speaker::class);
    }

    public function talk()
    {
        return $this->belongsTo(\App\Models\Talk::class)->withTrashed();
    }

    public function chairman()
    {
        return $this->belongsTo(\App\Models\Chairman::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
