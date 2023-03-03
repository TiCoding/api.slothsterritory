<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->decimal('dollar_amount', 8, 2);
            $table->decimal('colones_amount', 8, 2);
            $table->date('payment_date');
            $table->string('path_file')->nullable();
            $table->morphs('paymentable');


            $table->foreignId('payment_method_id')->constrained()->onDelete('restrict');
            $table->foreignId('payment_type_id')->constrained()->onDelete('restrict');
            $table->boolean('deleted')->default(false);

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
        Schema::dropIfExists('payments');
    }
}
