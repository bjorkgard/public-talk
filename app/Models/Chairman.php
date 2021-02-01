<?php

namespace App\Models;

use App\Scopes\UserScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
        'user_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
    ];

    public function lastBooking()
    {
        return $this->hasOne(Booking::class)->orderBy('date', 'desc');
    }

    protected static function booted()
    {
        static::addGlobalScope(new UserScope);
    }

    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    public function bookings()
    {
        return $this->hasMany(\App\Models\Booking::class);
    }
}
