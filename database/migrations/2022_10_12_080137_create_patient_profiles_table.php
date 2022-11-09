<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id');
            $table->date('birthdate')->nullable();
            $table->string('sex')->nullable();
            $table->text('maritalStatus')->nullable();
            $table->text('address')->nullable();
            $table->text('city')->nullable();
            $table->text('postalCode')->nullable();
            $table->text('mobileNumber')->nullable();
            $table->text('landlineNumber')->nullable();
            $table->text('emergencyContact')->nullable();
            $table->text('emergencyContactNumber')->nullable();
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
        Schema::dropIfExists('patient_profiles');
    }
}
