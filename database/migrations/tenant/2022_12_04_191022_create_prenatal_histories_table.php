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
        Schema::create('prenatal_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id');
            $table->string('prenatal_course')->nullable();
            $table->string('pregnancy_number')->nullable();
            $table->boolean('high_risk')->nullable();
            $table->boolean('abortion_risk')->nullable();
            $table->boolean('premature_parturition_risk')->nullable();
            $table->longtext('diagnosis')->nullable();
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
        Schema::dropIfExists('prenatal_histories');
    }
};
