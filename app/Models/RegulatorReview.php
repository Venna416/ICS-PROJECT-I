<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegulatorReview extends Model
{

protected $fillable = [

'seller_id',
'regulator_id',
'is_fair',
'reason',
'reviewed'

];



public function seller()
{

return $this->belongsTo(
SellerProfile::class,
'seller_id'
);

}


public function regulator()
{

return $this->belongsTo(
User::class,
'regulator_id'
);

}


}