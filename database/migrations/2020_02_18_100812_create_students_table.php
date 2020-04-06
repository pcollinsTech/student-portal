<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('registration_id')->nullable();
            $table->integer('pharmacy_id')->unsigned()->nullable();
            $table->integer('pharmacist_id')->unsigned()->nullable();
            $table->enum('title', ['mr', 'ms', 'miss', 'mrs', 'dr'] );
            $table->string('forenames');
            $table->string('surname');
            $table->string('known_as')->nullable();
            $table->string('previous_name')->nullable();
            $table->string('home_address_1');
            $table->string('home_address_2')->nullable();
            $table->string('city');
            $table->string('county');
            $table->string('postcode');
            $table->string('phone_mobile');
            $table->string('phone_home')->nullable();
            $table->date('date_of_birth');
            $table->string('university_id');
            $table->date('entry_date');
            $table->boolean('previous_training');
            $table->longText('previous_training_details')->nullable();
            $table->json('terms');
            $table->boolean('pharmacy_accepted')->default(false);
            $table->boolean('pharmacist_accepted')->default(false);
            $table->boolean('pharmacy_2_accepted')->default(false);
            $table->boolean('pharmacist_2_accepted')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
