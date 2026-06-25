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
    Schema::table('seller_profiles', function (Blueprint $table) {

        $table->boolean('missing_documents')
        ->default(false);

        $table->boolean('fraud_reports')
        ->default(false);

        $table->boolean('poor_reviews')
        ->default(false);

        $table->boolean('incomplete_information')
        ->default(false);

    });
}


public function down()
{
    Schema::table('seller_profiles', function (Blueprint $table) {

        $table->dropColumn([
            'missing_documents',
            'fraud_reports',
            'poor_reviews',
            'incomplete_information'
        ]);

    });
}
};
