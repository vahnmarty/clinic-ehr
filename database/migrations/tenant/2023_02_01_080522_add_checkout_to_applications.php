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
        Schema::table('applications', function (Blueprint $table) {
            $table->timestamp('check_out_at')->nullable()->after('pharmacy_order_user_id');
            $table->unsignedBigInteger('check_out_user_id')->nullable()->after('check_out_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropColumn('check_out_at');
            $table->dropColumn('check_out_user_id');
        });
    }
};
