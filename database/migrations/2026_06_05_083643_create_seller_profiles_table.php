<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
    Schema::create('seller_profiles', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->foreignId('seller_profile_id')->constrained()->onDelete('cascade');
    $table->string('brand_name')->nullable();
    $table->string('business_category')->nullable();   // ✅ not business_category
    $table->string('location')->nullable();
    $table->string('phone_number')->nullable();      // ✅ not phone_number
    $table->string('social_platform')->nullable();
    $table->string('shop_link')->nullable();
    $table->text('description')->nullable();

    $table->string('profile_photo')->nullable();
    $table->string('id_front')->nullable();
    $table->string('id_back')->nullable();

    $table->enum('verification_status', ['pending', 'verified', 'rejected'])->default('pending');
    $table->timestamps();
     });

    }

    public function down(): void
    {
        Schema::dropIfExists('seller_profiles');
    }
};
