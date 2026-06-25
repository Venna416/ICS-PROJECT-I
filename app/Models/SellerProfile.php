<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SellerProfile extends Model
{
    protected $fillable=[

'user_id',

'brand_name',

'business_category',

'location',

'phone_number',

'valid_documents',

'complete_profile',

'business_license',

'good_reviews',

'no_fraud_reports',

'trust_score',

'risk_score',

'verification_status',

'verified',

'verification_reason',

'missing_documents',

'fraud_reports',

'poor_reviews',

'incomplete_information',

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