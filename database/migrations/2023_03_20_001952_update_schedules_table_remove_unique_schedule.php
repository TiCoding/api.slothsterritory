<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateSchedulesTableRemoveUniqueSchedule extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->dropUnique('schedules_schedule_tour_id_unique');
            $table->time('schedule')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->unique('schedules_schedule_tour_id_unique');
            $table->time('schedule')->unique()->change();
        });
    }
}
