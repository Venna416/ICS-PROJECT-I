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



// online presence

'social_platform',

'shop_link',

'description',



// images

'profile_photo',

'id_front',

'id_back',



// verification factors

'valid_documents',

'complete_profile',

'business_license',

'good_reviews',

'limited_reviews',


'no_fraud_reports',


'missing_documents',

'fraud_reports',

'poor_reviews',

'incomplete_information',



// scores

'trust_score',

'risk_score',



// status

'verification_status',

'verified',

'verification_reason',


];







public function user(): BelongsTo
{

return $this->belongsTo(User::class);

}







public function documents(): HasMany
{

return $this->hasMany(
SellerDocument::class
);

}







public function reviews(): HasMany
{

return $this->hasMany(
Review::class,
'seller_id'
);

}






public function regulatorReviews(): HasMany
{

return $this->hasMany(
RegulatorReview::class,
'seller_id'
);

}



}