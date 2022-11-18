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
        Schema::create('vital_signs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id');

            // Input
            $table->date('date_of_visit');
            $table->integer('age_in_days');
            $table->float('bmi')->nullable();
            $table->float('height')->comment('cm')->nullable();
            $table->float('weight')->comment('kg')->nullable();
            $table->float('head_circumference')->comment('cm')->nullable();
            $table->float('muac')->comment('cm')->nullable();
            $table->float('tricep_skinfold')->comment('mm')->nullable();
            $table->float('subscapular_skinfold')->comment('mm')->nullable();
            $table->boolean('edema')->nullable();
            $table->boolean('measured_recumbent')->nullable();

            // Output
            $table->float('weight_for_length')->nullable();
            $table->float('weight_for_age')->nullable();
            $table->float('length_for_age')->nullable();
            $table->float('bmi_for_age')->nullable();
            $table->float('hc_for_age')->nullable();
            $table->float('muac_for_age')->nullable();
            $table->float('tsf_for_age')->nullable();
            $table->float('ssf_for_age')->nullable();


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
        Schema::dropIfExists('vital_signs');
    }
};
