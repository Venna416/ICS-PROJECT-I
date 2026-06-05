<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
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
            $table->string('phone_number');
            $table->string('location');
            $table->string('social_platform');
            $table->string('shop_link')->nullable();
            $table->text('description')->nullable();
            $table->string('verification_status')->default('pending');
            $table->decimal('trust_score', 5, 2)->default(0);
            $table->string('risk_level')->default('medium');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seller_profiles');
    }
};
