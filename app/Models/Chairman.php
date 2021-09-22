<?php

namespace App\Models;

use App\Scopes\SettingsScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Propaganistas\LaravelPhone\PhoneNumber;

class Chairman extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected static function boot()
    {
        parent::boot();

        // Order by name ASC
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('name', 'asc');
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'phone_country',
        'settings_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'settings_id' => 'integer',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'formated_phone'
    ];

    /**
     * Set the user's phone number.
     *
     * @param  string  $value
     * @return void
     */
    public function setPhoneAttribute($value)
    {
        $this->attributes['phone'] = PhoneNumber::make($value, $this->attributes['phone_country']);
    }

    /**
     * Get the users's formated phone
     * 
     * @return string
     */
    public function getFormatedPhoneAttribute()
    {
        return PhoneNumber::make($this->phone, $this->phone_country)->formatNational();
    }

    public function lastBooking()
    {
        return $this->hasOne(Booking::class)->orderBy('date', 'desc')->setEagerLoads([]);
    }

    protected static function booted()
    {
        static::addGlobalScope(new SettingsScope);
    }

    public function settings()
    {
        return $this->belongsTo(\App\Settings::class);
    }

    public function bookings()
    {
        return $this->hasMany(\App\Models\Booking::class);
    }
}
