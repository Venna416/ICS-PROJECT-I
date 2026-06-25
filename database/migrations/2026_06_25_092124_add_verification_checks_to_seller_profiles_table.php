<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{

public function up(): void
{

Schema::table('seller_profiles', function(Blueprint $table){


$table->boolean('valid_documents')
->default(false);


$table->boolean('complete_profile')
->default(false);


$table->boolean('business_license')
->default(false);


$table->boolean('good_reviews')
->default(false);


$table->boolean('no_fraud_reports')
->default(false);


});


}



public function down(): void
{

Schema::table('seller_profiles', function(Blueprint $table){


$table->dropColumn([

'valid_documents',
'complete_profile',
'business_license',
'good_reviews',
'no_fraud_reports'

]);


});

}


};