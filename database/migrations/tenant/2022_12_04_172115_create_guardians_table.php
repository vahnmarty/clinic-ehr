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
        Schema::create('guardians', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id');
            $table->string('parent_type');
            $table->string('first_name');
            $table->string('last_name');
            $table->date('date_of_birth');
            $table->string('primary_language')->nullable();
            $table->string('racial_identity')->nullable();
            $table->string('marital_status');
            $table->boolean('is_primary_caregiver')->nullable();
            $table->string('different_caregiver', 1024)->nullable();
            $table->string('cellphone')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('email')->nullable();
            $table->string('address1')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('district')->nullable();
            $table->string('dpi_number')->nullable();
            $table->boolean('is_migrant')->nullable();
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
        Schema::dropIfExists('guardians');
    }
};
