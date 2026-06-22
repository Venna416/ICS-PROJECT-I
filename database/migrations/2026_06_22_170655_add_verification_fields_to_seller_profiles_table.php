<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::table('seller_profiles', function (Blueprint $table) {

            $table->boolean('verified')
                ->default(false)
                ->after('verification_status');

            $table->integer('risk_score')
                ->nullable()
                ->after('verified');

            $table->integer('trust_score')
                ->nullable()
                ->after('risk_score');

        });
    }


    public function down(): void
    {
        Schema::table('seller_profiles', function (Blueprint $table) {

            $table->dropColumn([
                'verified',
                'risk_score',
                'trust_score'
            ]);

        });
    }

};
