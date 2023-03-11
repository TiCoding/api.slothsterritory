<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTourGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tour_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('date');
            $table->time('schedule');

            $table->foreignId('guide_id')->constrained('guides')->onDelete('restrict');
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
        Schema::dropIfExists('tour_groups');
    }
}
