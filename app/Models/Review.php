<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'seller_name',
        'rating',
        'review',
    ];
    public function sellerProfile()
{
    return $this->belongsTo(SellerProfile::class);
}
}


