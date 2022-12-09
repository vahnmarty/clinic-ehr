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
        Schema::create('research_intermittent_health_forms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id');

            // Fieldset 1
            $table->boolean('has_diarrhea')->nullable();
            $table->boolean('has_diarrheal_stools')->nullable();
            $table->boolean('has_toilet')->nullable();
            $table->boolean('has_diagnosed_gastrointestinal')->nullable();
            $table->boolean('has_presented_anything')->nullable();
            $table->string('diarrhea_last')->nullable();

            // Fieldset 2
            $table->boolean('has_cough')->nullable();
            $table->boolean('has_fever')->nullable();
            $table->boolean('has_hospitalized')->nullable();
            $table->integer('days_hospitalized')->nullable();
            $table->boolean('has_respiratory_distress')->nullable();
            $table->boolean('has_rapid_breathing')->nullable();
            $table->boolean('has_intercostal_retractions')->nullable();
            $table->boolean('has_green_yellow_mucous')->nullable();

            // Fieldset 3
            $table->boolean('has_no_food_symptoms')->nullable();
            $table->boolean('has_abdominal_pain')->nullable();
            $table->boolean('has_difficulty_swallowing')->nullable();
            $table->boolean('has_reflux')->nullable();
            $table->boolean('has_rash')->nullable();
            $table->boolean('has_needed_steroid')->nullable();
            $table->boolean('has_diarrhea_scraps')->nullable();
            $table->boolean('has_glossitis')->nullable();



            $table->timestamps();
        });

        Schema::table('research', function(Blueprint $table){
            $table->unsignedBigInteger('intermittent_form_id')->nullable()->after('form_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('research_intermittent_health_forms');

        Schema::table('research', function(Blueprint $table){
            $table->dropColumn('intermittent_form_id');
        });
    }
};
