<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FraudReport extends Model
{

    use HasFactory;



    protected $fillable = [


        'user_id',

        'seller_profile_id',

        'seller_name',

        'brand_name',

        'shop_link',

        'description',

        'evidence',

        'contact',


        'status',


        // investigation fields

        'decision',

        'action_taken',

        'regulator_note',

        'reviewed'


    ];





    public function user()
    {

        return $this->belongsTo(
            User::class,
            'user_id'
        );

    }







    public function sellerProfile()
    {

        return $this->belongsTo(
            SellerProfile::class,
            'seller_profile_id'
        );

    }


}