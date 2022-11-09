<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->text('name')->nullable();
            $table->text('dosage')->nullable();
            $table->text('frequency')->nullable();
            $table->text('physician')->nullable();
            $table->date('startDate')->nullable();
            $table->date('endDate')->nullable();
            $table->text('purpose')->nullable();
            $table->string('createdBy_user_id')->nullable();
            $table->text('createdBy')->nullable();
            $table->string('modifiedBy_user_id')->nullable();
            $table->text('modifiedBy')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('medications');
    }
}
