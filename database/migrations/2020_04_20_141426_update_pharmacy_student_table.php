<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePharmacyStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pharmacy_student', function(Blueprint $table) {
            $table->string('activation_code', 100)->nullable();
            $table->boolean('active')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pharmacy_student', function (Blueprint $table) {
            $table->dropColumn('activation_code');
            $table->dropColumn('active');
        });
    }
}
