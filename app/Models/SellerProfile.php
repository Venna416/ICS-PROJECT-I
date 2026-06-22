<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    // verification fields
    'verification_status',
    'verified',
    'risk_score',
    'trust_score',
    'verification_reason',
];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'seller_id');
    }

    public function documents()
{

return $this->hasMany(
SellerDocument::class
);

}
}