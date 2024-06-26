<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomDatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_dates', function (Blueprint $table) {
            $table->id();
            $table->date('start_date')->index();
            $table->date('end_date')->index();

            $table->foreignId('agency_tour_id')->constrained('agency_tours')->onDelete('restrict');
            $table->softDeletes();

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
        Schema::dropIfExists('custom_dates');
    }
}
