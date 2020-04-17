<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePharmacyAndPharmacistsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pharmacy_student', function(Blueprint $table) {
            $table->dateTime('placement_start');
            $table->dateTime('placement_end');
        });

        Schema::table('pharmacist_student', function(Blueprint $table) {
            $table->dateTime('tutor_start');
            $table->dateTime('tutor_end');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pharmacy_student', function(Blueprint $table) {
            $table->dropColumn('placement_start');
            $table->dropColumn('placement_end');
        });

        Schema::table('pharmacist_student', function(Blueprint $table) {
            $table->dropColumn('tutor_start');
            $table->dropColumn('tutor_end');
        });
    }
}
