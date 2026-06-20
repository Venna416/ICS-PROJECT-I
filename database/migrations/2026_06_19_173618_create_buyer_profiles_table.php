<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('buyer_profiles', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->string('email')->unique();
        $table->string('phone_number')->nullable();
        $table->string('full_name')->nullable();
        $table->string('location')->nullable();
        $table->timestamps();
    });
    

}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buyer_profiles');
        Schema::table('buyer_profiles', function (Blueprint $table) {
        $table->dropColumn('email');
});
    }
};
