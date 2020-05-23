<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Pharmacist extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('pharmacists', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->bigInteger('role_id')->unsigned();
          $table->string('name', 100);
          $table->bigInteger('phone');
          $table->string('email', 100);
          $table->foreign('role_id')->references('id')->on('roles')->onCascade('delete');

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
