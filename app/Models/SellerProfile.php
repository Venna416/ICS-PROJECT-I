<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
        'verification_status'
    ];

     /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('seller_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->string('brand_name');
            $table->string('business_category');
            $table->string('location');
            $table->string('phone_number');

            $table->string('social_platform');
            $table->string('shop_link')->nullable();

            $table->text('description')->nullable();
            $table->enum('verification_status', [
                'pending',
                'verified',
                'rejected'
            ])->default('pending');
            $table->timestamps();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
