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
        Schema::create('regulator_reviews', function (Blueprint $table) {

    $table->id();


    $table->foreignId('seller_id')
    ->constrained('seller_profiles')
    ->cascadeOnDelete();


    $table->foreignId('regulator_id')
    ->constrained('users')
    ->cascadeOnDelete();


    $table->boolean('is_fair')
    ->default(true);


    $table->text('reason')
    ->nullable();


    $table->timestamps();

});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('regulator_reviews');
    }
};
