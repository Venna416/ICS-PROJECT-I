<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class SellerDocument extends Model
{

protected $fillable=[

'seller_profile_id',
'document_type',
'file_path'

];



public function seller()
{

return $this->belongsTo(
SellerProfile::class
);

}


}