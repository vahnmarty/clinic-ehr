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
        Schema::create('research_parental_history_forms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id');

            $table->string('age')->nullable();
            $table->float('height')->nullable();
            $table->float('weight')->nullable();
            $table->float('abdominal_circumference')->nullable();
            $table->float('bmi')->nullable();

            $table->string('highest_schooling')->nullable();
            $table->string('occupation')->nullable();
            $table->string('marital_relationship')->nullable();

            $table->boolean('is_father_with_family')->nullable();
            $table->boolean('is_father_expenses')->nullable();
            $table->boolean('us_migrant')->nullable();

            $table->string('department_in_guatemala')->nullable();
            $table->string('migrant_duration')->nullable();
            $table->boolean('is_father_send_remittance')->nullable();
            $table->string('medical_illness')->nullable();
            $table->string('age_sexual')->nullable();
            $table->string('age_first_child')->nullable();
            $table->string('interpregnancy_period')->nullable();
            $table->string('children')->nullable();
            $table->string('partners')->nullable();
            $table->string('age_when_pregnant')->nullable();
            $table->string('contraception')->nullable();
            $table->string('planned_children')->nullable();
            $table->boolean('use_alcohol')->nullable();
            $table->boolean('use_cigarettes')->nullable();
            $table->string('other_substance')->nullable();
            $table->boolean('family_history_substance')->nullable();
            $table->string('family_members_of_abuse')->nullable();
            $table->string('grandparents_health')->nullable();


            $table->timestamps();
        });

        Schema::table('research', function(Blueprint $table){
            $table->unsignedBigInteger('parental_history_id')->nullable()->after('form_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('research_parental_history_forms');

        Schema::table('research', function(Blueprint $table){
            $table->dropColumn('parental_history_id');
        });
    }
};
