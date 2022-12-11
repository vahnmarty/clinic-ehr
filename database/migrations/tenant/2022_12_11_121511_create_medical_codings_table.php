<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_codings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('clinic_encounter_id')->nullable();
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('medical_code_id')->nullable();
            $table->string('medical_code');
            $table->string('code');
            $table->string('description');
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
        Schema::dropIfExists('medical_codings');
    }
};
