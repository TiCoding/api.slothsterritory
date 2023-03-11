<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgencyToursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agency_tours', function (Blueprint $table) {
            $table->id();

            $table->foreignId('agency_id')->constrained('agencies')->onDelete('restrict');
            $table->foreignId('tour_id')->constrained('tours')->onDelete('restrict');

            $table->unique(['agency_id', 'tour_id']);
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
        Schema::dropIfExists('agency_tours');
    }
}
