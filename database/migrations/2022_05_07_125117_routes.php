<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Routes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routes', function (Blueprint $table) {
            $table->id();
            $table->string('route');
            $table->string('fuel')->nullable();
            $table->string('trip')->nullable();
            $table->date('date')->nullable();
            $table->double('drive_allowance', 100, 0)->nullable();
            $table->string('status')->default('pending');
            $table->string('vehicle_status')->nullable();
            $table->string('vehicle_description')->nullable();
            $table->double('price', 100, 0)->default(0);
            $table->string('mode')->nullable();
            $table->string('payment_method')->default('bank');
            $table->double('i_price', 100, 0)->nullable();
            $table->double('r_price', 100, 0)->nullable();
            $table->string('description')->nullable();


            $table->timestamps();

            $table->bigInteger('cargo_id')->unsigned();
            $table->foreign('cargo_id')->references('id')->on('cargos')->onDelete('cascade');

            $table->bigInteger('driver_id')->unsigned();
            $table->foreign('driver_id')->references('id')->on('users')->onDelete('cascade');

            $table->bigInteger('vehicle_id')->unsigned();
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('routes');
    }
}
