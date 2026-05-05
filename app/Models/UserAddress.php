<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'label',
        'recipient_name',
        'phone',
        'address',
        'house_number',
        'rt_rw',
        'address_detail',
        'city',
        'district',
        'province',
        'postal_code',
        'latitude',
        'longitude',
        'is_primary',
        'is_active',
    ];

    protected $casts = [
        'is_primary' => 'boolean',
        'is_active' => 'boolean',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
    ];

    /**
     * Get the customer that owns the address
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'user_id');
    }

    /**
     * Get the user that owns the address (alias for customer)
     */
    public function user()
    {
        return $this->customer();
    }

    /**
     * Scope for primary address
     */
    public function scopePrimary($query)
    {
        return $query->where('is_primary', true);
    }

    /**
     * Scope for active addresses
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Set this address as primary
     */
    public function setPrimary()
    {
        // Remove primary from other addresses
        static::where('user_id', $this->user_id)
            ->where('id', '!=', $this->id)
            ->update(['is_primary' => false]);

        // Set this as primary
        $this->update(['is_primary' => true]);
    }

    /**
     * Get full address string
     */
    public function getFullAddressAttribute()
    {
        $parts = array_filter([
            $this->address,
            $this->address_detail,
            $this->district,
            $this->city,
            $this->province,
            $this->postal_code,
        ]);

        return implode(', ', $parts);
    }
}
