<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Talk extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected static function boot()
    {
        parent::boot();

        // Order by name ASC
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('number', 'asc');
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'number',
        'theme',
        'subject'
    ];

    protected $appends = ['full_theme'];

    public function lastBooking()
    {
        return $this->hasOne(Booking::class)->orderBy('date', 'desc');
    }

    public function getFullThemeAttribute()
    {
        return "{$this->number} - {$this->theme}";
    }

    /**
     * RELATIONSHIPS
     */
    public function speakers()
    {
        return $this->belongsToMany(\App\Models\Speaker::class);
    }

    public function bookings()
    {
        return $this->hasMany(\App\Models\Booking::class);
    }
}
