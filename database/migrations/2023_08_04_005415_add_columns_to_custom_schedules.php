<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToCustomSchedules extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('custom_schedules', function (Blueprint $table) {
            $table->decimal('adult_price', 8, 2);
            $table->decimal('child_price', 8, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('custom_schedules', function (Blueprint $table) {
            $table->dropColumn('adult_price');
            $table->dropColumn('child_price');
        });
    }
}
