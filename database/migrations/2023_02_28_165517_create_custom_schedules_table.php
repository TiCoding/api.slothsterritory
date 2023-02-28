<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_schedules', function (Blueprint $table) {
            $table->id();
            $table->time('schedule');
            $table->integer('capacity');
            $table->time('deadline_hour');

            $table->foreignId('custom_date_id')->constrained('custom_dates')->onDelete('restrict');

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
        Schema::dropIfExists('custom_schedules');
    }
}
