<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
        'avatar',
        'phone',
        'address',
        'city',
        'province',
        'postal_code',
        'latitude',
        'longitude',
        'save_address',
        'notifications_enabled',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'save_address' => 'boolean',
        'notifications_enabled' => 'boolean',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
    ];

    /**
     * Get the customer's addresses
     */
    public function addresses()
    {
        return $this->hasMany(UserAddress::class, 'user_id');
    }

    /**
     * Get the customer's primary address
     */
    public function primaryAddress()
    {
        return $this->hasOne(UserAddress::class, 'user_id')->where('is_primary', true);
    }

    /**
     * Get the customer's orders
     */
    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id');
    }

    /**
     * Check if customer has Google account linked
     */
    public function hasGoogleAccount()
    {
        return !is_null($this->google_id);
    }

    /**
     * Get full name with avatar
     */
    public function getDisplayNameAttribute()
    {
        return $this->name;
    }

    /**
     * Get avatar URL
     */
    public function getAvatarUrlAttribute()
    {
        return $this->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&background=f97316&color=fff';
    }
}
