<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Order extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('orders', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->bigInteger('customer_id')->unsigned();
            $table->string('address');
            $table->integer('total_price');
            $table->integer('pm');
            $table->integer('payment_status')->default(1);
            $table->timestamps();
            $table->foreign('customer_id')->references('id')->on('users')->onCascade('delete');

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
