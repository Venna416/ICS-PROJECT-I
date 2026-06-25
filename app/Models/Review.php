<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;



class Review extends Model
{


protected $fillable = [


'user_id',

'seller_name',

'brand_name',

'rating',

'review',

'status',


];


}