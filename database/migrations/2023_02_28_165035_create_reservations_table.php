<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->integer('amount_adults');
            $table->integer('amount_children');
            $table->integer('amount_children_free');
            $table->decimal('total_price_dollars', 8, 2);
            $table->decimal('total_price_colones', 8, 2);
            $table->decimal('discount_dollars', 8, 2);
            $table->decimal('discount_colones', 8, 2);
            $table->decimal('taxes_dollars', 8, 2);
            $table->decimal('taxes_colones', 8, 2);
            $table->decimal('net_price_dollars', 8, 2);
            $table->decimal('net_price_colones', 8, 2);
            $table->string('invoice')->index()->nullable();
            $table->text('comments')->nullable();
            $table->date('date')->index();
            $table->decimal('adult_price_dollars', 8, 2);
            $table->decimal('adult_price_colones', 8, 2);
            $table->decimal('child_price_dollars', 8, 2);
            $table->decimal('child_price_colones', 8, 2);
            $table->time('schedule')->index();

            $table->foreignId('agency_id')->constrained()->onDelete('restrict');
            $table->foreignId('customer_id')->constrained()->onDelete('restrict');
            $table->foreignId('payment_status_id')->constrained()->onDelete('restrict');
            $table->foreignId('reservation_status_id')->constrained()->onDelete('restrict');
            $table->foreignId('tour_id')->constrained()->onDelete('restrict');
            $table->foreignId('tour_group_id')->constrained()->onDelete('restrict');

            $table->date('deleted_at')->nullable();


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
        Schema::dropIfExists('reservations');
    }
}
