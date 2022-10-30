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
            $table->unsignedBigInteger('user_id');
            $table->date('birthdate')->nullable();
            $table->string('sex')->nullable();
            $table->string('contactNumber')->nullable();
            $table->string('specialization')->nullable();
            $table->time('workingHours')->nullable();
            $table->string('digitalSignature')->nullable();
            $table->integer('prcNumber')->nullable();
            $table->string('licenseType')->nullable();
            $table->date('licenseExpiryDate')->nullable();
            $table->string('prcImage')->nullable();
            $table->string('clinicName')->nullable();
            $table->string('clinicAddress')->nullable();
            $table->string('clinicMobileNumber')->nullable();
            $table->string('clinicTelephoneNumber')->nullable();
            $table->string('isVerified')->nullable();
            $table->timestamps();

            $table->index('user_id');
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
