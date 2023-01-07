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
        Schema::create('research_agricultural_forms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id');

            $table->boolean('has_available_land')->nullable();
            $table->string('rent_status')->nullable();
            $table->string('area_size')->nullable();
            $table->string('area_land')->nullable();
            $table->boolean('has_irrigation_farm')->nullable();
            $table->boolean('has_grow_food')->nullable();
            $table->string('crops_type')->nullable();
            $table->boolean('animal_husbandry')->nullable();
            $table->string('animal_husbandry_type')->nullable();
            $table->string('immunization')->nullable();
            $table->boolean('is_compost')->nullable();
            $table->string('compost_seeds')->nullable();
            $table->boolean('using_fertilisers')->nullable();
            $table->string('decrease_production')->nullable();
            $table->boolean('has_pets')->nullable();
            $table->string('pets_explanation')->nullable();
            $table->timestamps();
        });

        Schema::table('research', function(Blueprint $table){
            $table->unsignedBigInteger('agricultural_id')->nullable()->after('form_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('research_agricultural_forms');

        Schema::table('research', function(Blueprint $table){
            $table->dropColumn('agricultural_id');
        });
    }
};
