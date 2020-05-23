<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Stock extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('stocks', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->bigInteger('medicine_id')->unsigned();
          $table->bigInteger('quantity');
          $table->bigInteger('pharmacist_id')->unsigned();
          $table->foreign('pharmacist_id')->references('id')->on('users')->onCascade('delete');
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
