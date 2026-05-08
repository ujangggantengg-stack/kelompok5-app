<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromoProduct extends Model
{
    protected $fillable = [
        'promo_banner_id',
        'product_id',
        'order',
    ];

    public function banner()
    {
        return $this->belongsTo(PromoBanner::class, 'promo_banner_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
