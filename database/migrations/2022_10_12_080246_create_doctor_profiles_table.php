<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('middleInitial')->nullable();
            $table->integer('phoneNumber')->nullable();
            $table->string('specialization')->nullable();
            $table->integer('prcNumber')->nullable();
            $table->string('licenseType')->nullable();
            $table->date('licenseExpiryDate')->nullable();
            $table->string('prcImage')->nullable();
            $table->string('clinicName')->nullable();
            $table->string('clinicAddress')->nullable();
            $table->integer('clinicMobileNumber')->nullable();
            $table->integer('clinicTelephoneNumber')->nullable();
            $table->integer('isVerified')->nullable();
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
        Schema::dropIfExists('doctor_profiles');
    }
}
