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
        Schema::create('research_maternal_health_forms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id');


            $table->float('mother_height');
            $table->float('mother_weight');
            $table->float('abdominal_circumference');
            $table->float('bmi');


            $table->string('highest_schooling')->nullable();
            $table->string('occupation')->nullable();
            $table->string('marital_relationship')->nullable();

            $table->string('menarche_age')->nullable();
            $table->date('last_menstrual_period')->nullable();
            $table->string('menstrual_pattern')->nullable();
            $table->string('menstrual_cycle_length')->nullable();
            $table->string('menstrual_duration_flow')->nullable();
            $table->string('menstrual_amount_flow')->nullable();
            $table->boolean('has_associated_pain');
            $table->boolean('has_intermenstrual_bleeding');
            $table->boolean('has_vasomor_symptoms');
            $table->boolean('has_hormone_therapy');
            $table->boolean('has_menopause');
            $table->string('bleeding_pattern')->nullable();
            $table->boolean('is_using_contraception');
            $table->string('contraception_method')->nullable();
            $table->string('previous_contraception')->nullable();


            $table->string('recent_pap_smear')->nullable();
            $table->boolean('has_abnormal_pap_smear');
            $table->string('abnormal_pap_smear_details')->nullable();
            $table->boolean('has_infection_history');
            $table->boolean('has_sti_history');
            $table->string('sti_explanation')->nullable();
            $table->boolean('has_vaginitis_history');
            $table->string('vaginitis_explanation')->nullable();
            $table->boolean('has_pelvic_disease');
            $table->string('pelvic_disease_explanation')->nullable();
            $table->boolean('has_fertility_problems');
            $table->boolean('desire_future_fertility');
            $table->string('pregnancy_previous_evaluation')->nullable();
            $table->timestamps();
        });

        Schema::table('research', function(Blueprint $table){
            $table->unsignedBigInteger('maternal_health_id')->nullable()->after('form_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('research_maternal_health_forms');

        Schema::table('research', function(Blueprint $table){
            $table->dropColumn('maternal_health_id');
        });
    }
};
