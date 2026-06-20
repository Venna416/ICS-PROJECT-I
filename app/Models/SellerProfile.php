<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SellerProfile extends Model
{
    protected $fillable = [
        'user_id',
        'brand_name',
        'business_category',
        'location',
        'phone_number',
        'social_platform',
        'shop_link',
        'description',
        'profile_photo',
        'id_front',
        'id_back',
        'verification_status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'seller_id');
    }
}