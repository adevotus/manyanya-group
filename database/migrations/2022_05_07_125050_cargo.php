<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Cargo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cargos', function (Blueprint $table) {
            $table->id();
            $table->string('invoice');
            $table->string('name');
            $table->string('customername');
            $table->string('customerphone');
            $table->string('customeremail');
            $table->double('amount', 100, 0);
            $table->double('weight', 10, 0);
            $table->string('status')->default('pending');
            $table->string('payment')->default('unpaid');
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
        Schema::dropIfExists('cargos');
    }
}
