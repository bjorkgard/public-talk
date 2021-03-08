<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Cashier\Billable;

class Settings extends Model
{
    use Billable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'congregation',
        'meeting',
        'extra',
        'notifications',
        'stripe_id',
        'card_brand',
        'card_last_four',
        'trials_ends_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'congregation' => 'object',
        'meeting' => 'object',
        'extra' => 'array',
        'notifications' => 'object',
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'congregation' => '{"name" : ""}',
        'meeting' => '{"day" : "Sunday", "time" : ""}',
        'extra' => '[]',
        'notifications' => '{"confirmation" : false, "reminder" : false, "thanks" : false, "chairman" : false}',
    ];

    public function users()
    {
        return $this->hasMany(\App\Models\User::class);
    }

    public function speakers()
    {
        return $this->hasMany(\App\Models\Speaker::class);
    }

    public function bookings()
    {
        return $this->hasMany(\App\Models\Booking::class);
    }

    public function chairmen()
    {
        return $this->hasMany(\App\Models\Chairman::class);
    }
}
