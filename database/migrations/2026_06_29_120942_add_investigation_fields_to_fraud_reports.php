<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {

        Schema::table('fraud_reports', function (Blueprint $table) {


            if (!Schema::hasColumn('fraud_reports','action_taken')) {

                $table->string('action_taken')
                ->nullable();

            }



            if (!Schema::hasColumn('fraud_reports','regulator_note')) {

                $table->text('regulator_note')
                ->nullable();

            }



            if (!Schema::hasColumn('fraud_reports','reviewed')) {

                $table->boolean('reviewed')
                ->default(false);

            }



        });

    }



    public function down(): void
    {


        Schema::table('fraud_reports', function (Blueprint $table) {


            $columns = [];


            if (Schema::hasColumn('fraud_reports','action_taken')) {

                $columns[] = 'action_taken';

            }


            if (Schema::hasColumn('fraud_reports','regulator_note')) {

                $columns[] = 'regulator_note';

            }


            if (Schema::hasColumn('fraud_reports','reviewed')) {

                $columns[] = 'reviewed';

            }



            if(count($columns)){

                $table->dropColumn($columns);

            }



        });


    }

};