<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyerProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'email',
        'phone_number',
        'full_name',
        'location',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
