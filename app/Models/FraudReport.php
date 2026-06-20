<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FraudReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'seller_name',
        'shop_name',
        'shop_link',
        'description',
        'evidence',
        'contact',
    ];

    // Optional: link back to the user who submitted the report
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function sellerProfile()
{
    return $this->belongsTo(SellerProfile::class);
}
}

