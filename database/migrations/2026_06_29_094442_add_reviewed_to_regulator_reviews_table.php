<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{

public function up(): void
{

Schema::table('regulator_reviews', function (Blueprint $table) {


$table->boolean('reviewed')

->default(true);


});


}



public function down(): void
{

Schema::table('regulator_reviews', function (Blueprint $table) {


$table->dropColumn('reviewed');


});


}


};
