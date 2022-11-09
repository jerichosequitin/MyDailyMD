<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgressNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('progress_notes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->text('primaryDiagnosis')->nullable();
            $table->text('findings')->nullable();
            $table->text('treatmentPlan')->nullable();
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
        Schema::dropIfExists('progress_notes');
    }
}
