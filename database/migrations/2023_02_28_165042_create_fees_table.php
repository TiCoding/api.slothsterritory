<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fees', function (Blueprint $table) {
            $table->id();

            $table->decimal('amount_dollars', 8, 2);
            $table->decimal('amount_colones', 8, 2);

            $table->foreignId('payment_status_id')->constrained()->onDelete('restrict');
            $table->foreignId('reservation_id')->unique()->constrained()->onDelete('restrict');
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
        Schema::dropIfExists('fees');
    }
}
