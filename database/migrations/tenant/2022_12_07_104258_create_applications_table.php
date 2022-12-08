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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('clinic_id')->nullable();
            $table->unsignedBigInteger('doctor_id')->nullable();
            $table->string('visit_reason')->nullable();

            $table->timestamp('check_in_at')->nullable();
            $table->unsignedBigInteger('check_in_user_id')->nullable();

            $table->timestamp('patient_info_finished_at')->nullable();
            $table->unsignedBigInteger('patient_info_user_id')->nullable();

            $table->timestamp('vital_sign_finished_at')->nullable();
            $table->unsignedBigInteger('vital_sign_user_id')->nullable();

            $table->timestamp('research_form_finished_at')->nullable();
            $table->unsignedBigInteger('research_form_user_id')->nullable();


            $table->timestamp('clinic_encounter_finished_at')->nullable();
            $table->unsignedBigInteger('clinic_encounter_user_id')->nullable();

            $table->timestamp('pharmacy_order_finished_at')->nullable();
            $table->unsignedBigInteger('pharmacy_order_user_id')->nullable();

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
        Schema::dropIfExists('applications');
    }
};
