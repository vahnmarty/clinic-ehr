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
        Schema::table('plan_medications', function(Blueprint $table){
            $table->string('order_number')->nullable();
            $table->integer('order_status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('plan_medications', function(Blueprint $table){
            $table->dropColumn('order_number');
            $table->dropColumn('order_status');
        });
    }
};
