<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Cart extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('carts', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->ipAddress('customer_ip');
          $table->bigInteger('customer_id')->unsigned();
          $table->bigInteger('medicine_id')->unsigned();
          $table->bigInteger('quantity');
          $table->bigInteger('price');
          $table->foreign('customer_id')->references('id')->on('users')->onCascade('delete');
          $table->foreign('medicine_id')->references('id')->on('medicines')->onCascade('delete');

      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
