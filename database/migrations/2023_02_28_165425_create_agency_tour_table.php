<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgencyTourTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agency_tour', function (Blueprint $table) {
            $table->id();
            $table->decimal('adult_price', 8, 2);
            $table->decimal('child_price', 8, 2);

            $table->foreignId('agency_id')->constrained('agencies')->onDelete('restrict');
            $table->foreignId('tour_id')->constrained('tours')->onDelete('restrict');

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
        Schema::dropIfExists('agency_tour');
    }
}
