<?php

namespace App\Models;

use App\Scopes\SettingsScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Speaker extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected static function boot()
    {
        parent::boot();

        // Order by name ASC
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('firstname', 'asc');
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'settings_id',
        'lastname',
        'firstname',
        'congregation',
        'phone',
        'email',
        'comments'
    ];

    protected $appends = ['full_name'];

    protected $with = ['talks'];

    protected static function booted()
    {
        static::addGlobalScope(new SettingsScope);
    }

    public function getFullNameAttribute()
    {
        return "{$this->firstname} {$this->lastname}";
    }

    public function lastBooking()
    {
        return $this->hasOne(Booking::class)->orderBy('date', 'desc');
    }

    /**
     * RELATIONSHIPS
     */
    public function settings()
    {
        return $this->belongsTo(\App\Models\Settings::class);
    }

    public function talks()
    {
        return $this->belongsToMany(\App\Models\Talk::class);
    }

    public function bookings()
    {
        return $this->hasMany(\App\Models\Booking::class);
    }
}
