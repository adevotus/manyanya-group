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
            $table->String('description')->nullable();
            $table->string('payment_method')->default('bank');
            $table->double('price', 100, 0)->nullable();
            $table->double('installed', 100, 0)->nullable();
            $table->double('remaining', 100, 0)->nullable();

            $table->bigInteger('route_id')->unsigned();
            $table->foreign('route_id')->references('id')->on('routes')->onDelete('cascade');

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
