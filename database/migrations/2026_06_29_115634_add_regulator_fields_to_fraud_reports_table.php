<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

public function up(): void
{

Schema::table('fraud_reports', function (Blueprint $table) {


$table->string('decision')
->nullable();


$table->string('action_taken')
->nullable();


$table->text('regulator_note')
->nullable();



});


}



public function down(): void
{

Schema::table('fraud_reports', function (Blueprint $table) {


$table->dropColumn([
'decision',
'action_taken',
'regulator_note'
]);


});


}

};