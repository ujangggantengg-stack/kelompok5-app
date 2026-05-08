<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromoBanner extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'badge_text',
        'discount_badge_text',
        'price_original',
        'price_promo',
        'background_image',
        'image_main',
        'image_second',
        'image_third',
        'end_time',
        'is_active',
    ];

    protected $casts = [
        'end_time' => 'datetime',
        'is_active' => 'boolean',
        'price_original' => 'decimal:2',
        'price_promo' => 'decimal:2',
    ];

    public function products()
    {
        return $this->hasMany(PromoProduct::class);
    }
}
