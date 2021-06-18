<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Propaganistas\LaravelPhone\PhoneNumber;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone_country',
        'phone',
        'password',
        'role',
        'settings_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'owner' => 'boolean'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
        'formated_phone'
    ];

    protected $with = [
        'settings'
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

    public function settings()
    {
        return $this->belongsTo(\App\Models\Settings::class);
    }

    public function myBookings()
    {
        return $this->hasMany(\App\Models\Booking::class);
    }

    public function message_logs()
    {
        return $this->hasMany(\App\Models\MessageLog::class);
    }

    public function speakers()
    {
        return $this->hasManyThrough(\App\Models\Speaker::class, \App\Models\Settings::class);
    }

    public function bookings()
    {
        return $this->hasManyThrough(\App\Models\Booking::class, \App\Models\Settings::class);
    }

    public function chairmen()
    {
        return $this->hasManyThrough(\App\Models\Chairman::class, \App\Models\Settings::class);
    }
}
