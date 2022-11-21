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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('patient_id')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->nullable();
            $table->date('date_of_birth');
            $table->string('avatar')->nullable();
            $table->enum('sex', ['male', 'female']);

            // Demographics
            $table->string('address1')->nullable();
            $table->string('address2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('country')->nullable();
            $table->string('dpi_number')->nullable();
            $table->string('identity')->nullable();
            $table->string('primary_language')->nullable();
            $table->string('cellphone')->nullable();
            $table->string('telephone')->nullable();

            // Birth Info (values)
            $table->float('birth_weight')->comment('kg')->nullable();
            $table->float('birth_length')->comment('cm')->nullable();
            $table->float('apgar_score')->nullable();
            $table->integer('age_started_solid_food')->nullable();

            // Birth info (booleans)
            $table->boolean('skin_to_skin')->nullable();
            $table->boolean('immediate_breastfeeding')->nullable();
            $table->boolean('history_of_respiratory_distress')->nullable();
            $table->boolean('jaundice')->nullable();
            $table->boolean('sepsis')->nullable();
            $table->boolean('infant_required_hospitalization')->nullable();
            $table->boolean('fresh_fruit')->nullable();



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
        Schema::dropIfExists('patients');
    }
};
