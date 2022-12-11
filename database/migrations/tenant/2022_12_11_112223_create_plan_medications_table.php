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
        Schema::create('plan_medications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('clinic_encounter_id')->nullable();
            $table->unsignedBigInteger('patient_id');
            $table->string('drug');
            $table->string('description');
            $table->string('dosage');
            $table->string('period');
            $table->string('dosage_form');
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
        Schema::dropIfExists('plan_medications');
    }
};
